<?php
/**
 * Google Search Console Indexing API & URL Inspection Client
 * Pure PHP implementation with RS256 JWT Service Account Authentication
 * Pokemon Calculator Hub Custom CMS
 */

namespace App\Core;

class GoogleIndexing {
    private static ?string $cachedToken = null;
    private static int $tokenExpiry = 0;

    /**
     * Parse service account credentials from database setting or JSON string
     */
    public static function getServiceAccount(): ?array {
        $json = get_setting('google_service_account_json', '');
        if (empty(trim($json))) {
            return null;
        }

        $data = json_decode($json, true);
        if (!is_array($data) || empty($data['client_email']) || empty($data['private_key'])) {
            return null;
        }

        return $data;
    }

    /**
     * Check if Google Service Account credentials are validly configured
     */
    public static function isConfigured(): bool {
        return self::getServiceAccount() !== null;
    }

    /**
     * Generate OAuth2 Access Token using RS256 JWT Signed Assertion
     */
    public static function getAccessToken(bool $forceRefresh = false): ?string {
        if (!$forceRefresh && self::$cachedToken && time() < self::$tokenExpiry - 60) {
            return self::$cachedToken;
        }

        // Check session cache
        if (!$forceRefresh && !empty($_SESSION['gsc_access_token']) && ($_SESSION['gsc_token_exp'] ?? 0) > time() + 60) {
            self::$cachedToken = $_SESSION['gsc_access_token'];
            self::$tokenExpiry = $_SESSION['gsc_token_exp'];
            return self::$cachedToken;
        }

        $sa = self::getServiceAccount();
        if (!$sa) {
            return null;
        }

        $now = time();
        $header = ['alg' => 'RS256', 'typ' => 'JWT'];
        $claims = [
            'iss'   => $sa['client_email'],
            'scope' => 'https://www.googleapis.com/auth/indexing https://www.googleapis.com/auth/webmasters.readonly',
            'aud'   => 'https://oauth2.googleapis.com/token',
            'exp'   => $now + 3600,
            'iat'   => $now
        ];

        $base64Header = self::base64UrlEncode(json_encode($header));
        $base64Claims = self::base64UrlEncode(json_encode($claims));
        $signatureInput = $base64Header . '.' . $base64Claims;

        $privateKey = openssl_pkey_get_private($sa['private_key']);
        if (!$privateKey) {
            error_log('GoogleIndexing: Invalid private key in Service Account JSON.');
            return null;
        }

        $signature = '';
        $success = openssl_sign($signatureInput, $signature, $privateKey, OPENSSL_ALGO_SHA256);
        if (!$success) {
            error_log('GoogleIndexing: Failed to generate RS256 signature.');
            return null;
        }

        $jwt = $signatureInput . '.' . self::base64UrlEncode($signature);

        // Exchange JWT for Access Token
        $ch = curl_init('https://oauth2.googleapis.com/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion'  => $jwt
        ]));
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        $res = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($code !== 200 || !$res) {
            error_log('GoogleIndexing: Token request failed with HTTP ' . $code . ': ' . $res);
            return null;
        }

        $json = json_decode($res, true);
        if (!empty($json['access_token'])) {
            self::$cachedToken = $json['access_token'];
            self::$tokenExpiry = $now + intval($json['expires_in'] ?? 3600);
            $_SESSION['gsc_access_token'] = self::$cachedToken;
            $_SESSION['gsc_token_exp'] = self::$tokenExpiry;
            return self::$cachedToken;
        }

        return null;
    }

    /**
     * Submit URL to Google Indexing API (URL_UPDATED or URL_DELETED)
     */
    public static function publishUrl(string $url, string $type = 'URL_UPDATED'): array {
        $token = self::getAccessToken();
        if (!$token) {
            $errMsg = 'Google Service Account credentials missing, invalid, or authentication failed with Google OAuth2.';
            Database::execute("
                INSERT INTO indexing_logs (url, action, http_status, api_status, raw_response, error_message, created_at)
                VALUES (?, ?, 401, 'ERROR', 'Auth Error', ?, NOW())
            ", [$url, $type, $errMsg]);

            return [
                'success' => false,
                'error'   => $errMsg,
                'code'    => 401
            ];
        }

        $endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';
        $payload = [
            'url'  => $url,
            'type' => $type
        ];

        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $json = json_decode($response, true);
        $isSuccess = ($httpCode >= 200 && $httpCode < 300);

        // Record log entry
        Database::execute("
            INSERT INTO indexing_logs (url, action, http_status, api_status, raw_response, error_message, created_at)
            VALUES (?, ?, ?, ?, ?, ?, NOW())
        ", [
            $url,
            $type,
            $httpCode,
            $isSuccess ? 'SUBMITTED' : 'ERROR',
            $response,
            $isSuccess ? null : ($json['error']['message'] ?? 'HTTP ' . $httpCode)
        ]);

        return [
            'success'  => $isSuccess,
            'code'     => $httpCode,
            'data'     => $json,
            'response' => $response,
            'error'    => $isSuccess ? null : ($json['error']['message'] ?? 'Request failed with status ' . $httpCode)
        ];
    }

    /**
     * Inspect URL using Google Search Console URL Inspection API
     */
    public static function inspectUrl(string $url, ?string $siteUrl = null): array {
        $token = self::getAccessToken();
        if (!$token) {
            $errMsg = 'Google Service Account credentials missing, invalid, or authentication failed with Google OAuth2.';
            Database::execute("
                INSERT INTO indexing_logs (
                    url, action, http_status, api_status, coverage_state, verdict, 
                    crawled_at, robot_txt_state, mobile_usability, rich_results_verdict, 
                    raw_response, error_message, created_at
                ) VALUES (?, 'INSPECT', 401, 'ERROR', 'Not Verified', 'FAIL', NULL, NULL, NULL, NULL, 'Auth Error', ?, NOW())
            ", [$url, $errMsg]);

            return [
                'success'         => false,
                'code'            => 401,
                'verdict'         => 'FAIL',
                'coverage_state'  => 'Authentication Failed',
                'crawled_at'      => null,
                'robots_state'    => 'UNKNOWN',
                'mobile_verdict'  => 'N/A',
                'rich_verdict'    => 'N/A',
                'error'           => $errMsg
            ];
        }

        if (empty($siteUrl)) {
            $siteUrl = rtrim(get_setting('site_url', pkm_absolute_url()), '/') . '/';
        }

        $endpoint = 'https://searchconsole.googleapis.com/v1/urlInspection/index:inspect';
        $payload = [
            'inspectionUrl' => $url,
            'siteUrl'       => $siteUrl,
            'languageCode'  => 'en-US'
        ];

        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $json = json_decode($response, true);
        $isSuccess = ($httpCode >= 200 && $httpCode < 300);

        $inspectionResult = $json['inspectionResult'] ?? [];
        $indexStatus = $inspectionResult['indexStatusResult'] ?? [];
        $mobileResult = $inspectionResult['mobileUsabilityResult'] ?? [];
        $richResult = $inspectionResult['richResultsResult'] ?? [];

        $verdict = $indexStatus['verdict'] ?? ($isSuccess ? 'UNKNOWN' : 'ERROR');
        $coverageState = $indexStatus['coverageState'] ?? ($json['error']['message'] ?? 'N/A');
        $crawledAt = !empty($indexStatus['lastCrawlTime']) ? date('Y-m-d H:i:s', strtotime($indexStatus['lastCrawlTime'])) : null;
        $robotState = $indexStatus['robotsTxtState'] ?? null;
        $mobileVerdict = $mobileResult['verdict'] ?? null;
        $richVerdict = $richResult['verdict'] ?? null;

        // Log result
        Database::execute("
            INSERT INTO indexing_logs (
                url, action, http_status, api_status, coverage_state, verdict, 
                crawled_at, robot_txt_state, mobile_usability, rich_results_verdict, 
                raw_response, error_message, created_at
            ) VALUES (?, 'INSPECT', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ", [
            $url,
            $httpCode,
            $isSuccess ? 'INSPECTED' : 'ERROR',
            $coverageState,
            $verdict,
            $crawledAt,
            $robotState,
            $mobileVerdict,
            $richVerdict,
            $response,
            $isSuccess ? null : ($json['error']['message'] ?? 'HTTP ' . $httpCode)
        ]);

        return [
            'success'         => $isSuccess,
            'code'            => $httpCode,
            'verdict'         => $verdict,
            'coverage_state'  => $coverageState,
            'crawled_at'      => $crawledAt,
            'robots_state'    => $robotState,
            'mobile_verdict'  => $mobileVerdict,
            'rich_verdict'    => $richVerdict,
            'data'            => $json,
            'error'           => $isSuccess ? null : ($json['error']['message'] ?? 'HTTP ' . $httpCode)
        ];
    }

    /**
     * Gather all site links for quick batch indexing submission
     */
    public static function getAllSiteUrls(): array {
        $urls = [];
        $baseUrl = rtrim(pkm_absolute_url(), '/');

        // Homepage & Catalog
        $urls[] = ['url' => $baseUrl . '/', 'title' => 'Homepage', 'type' => 'Home'];
        $urls[] = ['url' => $baseUrl . '/calculators', 'title' => 'All Calculators Catalog', 'type' => 'Hub'];
        $urls[] = ['url' => $baseUrl . '/blog', 'title' => 'Blog Index', 'type' => 'Blog'];

        // Tools / Calculators
        $tools = Database::fetchAll("SELECT slug, name FROM tools WHERE is_active = 1 ORDER BY menu_order ASC");
        foreach ($tools as $t) {
            $urls[] = [
                'url'   => $baseUrl . '/' . $t['slug'],
                'title' => $t['name'],
                'type'  => 'Calculator'
            ];
        }

        // CMS Pages
        $pages = Database::fetchAll("SELECT slug, title FROM pages WHERE is_active = 1 ORDER BY title ASC");
        foreach ($pages as $p) {
            $urls[] = [
                'url'   => $baseUrl . '/' . $p['slug'],
                'title' => $p['title'],
                'type'  => 'Page'
            ];
        }

        // Blog Posts
        $posts = Database::fetchAll("SELECT slug, title FROM posts WHERE status = 'published' ORDER BY published_at DESC");
        foreach ($posts as $b) {
            $urls[] = [
                'url'   => $baseUrl . '/blog/' . $b['slug'],
                'title' => $b['title'],
                'type'  => 'Article'
            ];
        }

        return $urls;
    }

    /**
     * Helper URL-safe base64 encoder
     */
    private static function base64UrlEncode(string $data): string {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}
