<?php
/**
 * Admin Google Search Console Indexing & URL Inspection Controller
 * Pokemon Calculator Hub Custom CMS
 */

namespace App\Admin;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Core\Database;
use App\Core\GoogleIndexing;

class IndexingController {
    public function index(Request $request): void {
        Auth::requireRole('editor');

        $isConfigured = GoogleIndexing::isConfigured();
        $serviceAccount = GoogleIndexing::getServiceAccount();
        $allUrls = GoogleIndexing::getAllSiteUrls();

        // Fetch Recent Logs
        $logs = Database::fetchAll("
            SELECT * FROM indexing_logs 
            ORDER BY created_at DESC 
            LIMIT 50
        ");

        // Aggregated Stats
        $stats = [
            'total_submissions' => Database::fetchColumn("SELECT COUNT(*) FROM indexing_logs WHERE action IN ('URL_UPDATED', 'URL_DELETED')"),
            'total_inspections' => Database::fetchColumn("SELECT COUNT(*) FROM indexing_logs WHERE action = 'INSPECT'"),
            'indexed_count'     => Database::fetchColumn("SELECT COUNT(*) FROM indexing_logs WHERE verdict = 'PASS'"),
            'error_count'       => Database::fetchColumn("SELECT COUNT(*) FROM indexing_logs WHERE api_status = 'ERROR' OR verdict = 'FAIL'")
        ];

        $inspectResult = $_SESSION['last_inspect_result'] ?? null;
        unset($_SESSION['last_inspect_result']);

        View::render('admin/indexing/index', [
            'title'          => 'Google Search Console Indexing API & Inspection',
            'isConfigured'   => $isConfigured,
            'serviceAccount' => $serviceAccount,
            'allUrls'        => $allUrls,
            'logs'           => $logs,
            'stats'          => $stats,
            'inspectResult'  => $inspectResult,
            'flashes'        => Auth::getFlashes(),
            'active_menu'    => 'indexing'
        ], 'admin');
    }

    public function submit(Request $request): void {
        Auth::requireRole('editor');

        if (!Auth::verifyCsrf($request->post('_csrf_token'))) {
            Auth::setFlash('error', 'CSRF validation failed.');
            Response::redirect(home_url('admin/indexing'));
            return;
        }

        $url = trim($request->post('url', ''));
        $action = trim($request->post('action', 'URL_UPDATED'));

        if (empty($url) || !filter_var($url, FILTER_VALIDATE_URL)) {
            Auth::setFlash('error', 'Please provide a valid full URL (e.g. https://...).');
            Response::redirect(home_url('admin/indexing'));
            return;
        }

        $res = GoogleIndexing::publishUrl($url, $action);

        if ($res['success']) {
            Auth::setFlash('success', 'URL successfully submitted to Google Indexing API (' . esc_html($action) . ')! HTTP ' . $res['code']);
        } else {
            Auth::setFlash('error', 'Google Indexing API submission failed: ' . esc_html($res['error']));
        }

        Response::redirect(home_url('admin/indexing'));
    }

    public function batchSubmit(Request $request): void {
        Auth::requireRole('editor');

        if (!Auth::verifyCsrf($request->post('_csrf_token'))) {
            Auth::setFlash('error', 'CSRF validation failed.');
            Response::redirect(home_url('admin/indexing'));
            return;
        }

        $selectedUrls = $request->post('urls', []);
        if (empty($selectedUrls) || !is_array($selectedUrls)) {
            Auth::setFlash('error', 'No URLs selected for submission.');
            Response::redirect(home_url('admin/indexing'));
            return;
        }

        $successCount = 0;
        $errorCount = 0;
        $errors = [];

        foreach ($selectedUrls as $url) {
            $url = trim($url);
            if (!empty($url)) {
                $res = GoogleIndexing::publishUrl($url, 'URL_UPDATED');
                if ($res['success']) {
                    $successCount++;
                } else {
                    $errorCount++;
                    $errors[] = $url . ': ' . ($res['error'] ?? 'HTTP ' . $res['code']);
                }
            }
        }

        if ($errorCount === 0) {
            Auth::setFlash('success', "Successfully submitted all {$successCount} URLs to Google Indexing API!");
        } else {
            Auth::setFlash('warning', "Batch finished: {$successCount} submitted successfully, {$errorCount} failed. " . implode(' | ', array_slice($errors, 0, 3)));
        }

        Response::redirect(home_url('admin/indexing'));
    }

    public function inspect(Request $request): void {
        Auth::requireRole('editor');

        if (!Auth::verifyCsrf($request->post('_csrf_token'))) {
            Auth::setFlash('error', 'CSRF validation failed.');
            Response::redirect(home_url('admin/indexing'));
            return;
        }

        $url = trim($request->post('url', ''));
        if (empty($url) || !filter_var($url, FILTER_VALIDATE_URL)) {
            Auth::setFlash('error', 'Please provide a valid full URL to inspect.');
            Response::redirect(home_url('admin/indexing'));
            return;
        }

        $res = GoogleIndexing::inspectUrl($url);
        $_SESSION['last_inspect_result'] = array_merge($res, ['inspected_url' => $url]);

        if ($res['success']) {
            Auth::setFlash('success', "Google URL inspection completed for: {$url}");
        } else {
            Auth::setFlash('error', 'URL Inspection failed: ' . esc_html($res['error']));
        }

        Response::redirect(home_url('admin/indexing#inspector'));
    }

    public function saveSettings(Request $request): void {
        Auth::requireRole('admin');

        if (!Auth::verifyCsrf($request->post('_csrf_token'))) {
            Auth::setFlash('error', 'CSRF validation failed.');
            Response::redirect(home_url('admin/indexing'));
            return;
        }

        $json = trim($request->post('google_service_account_json', ''));

        if (!empty($json)) {
            $decoded = json_decode($json, true);
            if (!$decoded || empty($decoded['client_email']) || empty($decoded['private_key'])) {
                Auth::setFlash('error', 'Invalid Google Service Account JSON format. Must contain "client_email" and "private_key".');
                Response::redirect(home_url('admin/indexing'));
                return;
            }
        }

        Database::execute("
            INSERT INTO settings (setting_key, setting_value, setting_group, updated_at)
            VALUES ('google_service_account_json', ?, 'google_api', NOW())
            ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value), updated_at = NOW()
        ", [$json]);

        Auth::setFlash('success', 'Google Service Account credentials saved successfully!');
        Response::redirect(home_url('admin/indexing'));
    }

    public function clearLogs(Request $request): void {
        Auth::requireRole('admin');

        if (!Auth::verifyCsrf($request->post('_csrf_token'))) {
            Auth::setFlash('error', 'CSRF validation failed.');
            Response::redirect(home_url('admin/indexing'));
            return;
        }

        Database::execute("TRUNCATE TABLE indexing_logs");
        Auth::setFlash('success', 'All Google indexing and inspection logs have been cleared.');
        Response::redirect(home_url('admin/indexing'));
    }
}
