<?php
/**
 * Admin Media Library Controller
 * Pokemon Calculator Hub Custom CMS
 */

namespace App\Admin;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Core\Database;

class MediaController {
    public function index(Request $request): void {
        Auth::requireAuth();

        $media = Database::fetchAll("
            SELECT m.*, u.username as uploader_name 
            FROM media m 
            LEFT JOIN users u ON m.uploaded_by = u.id 
            ORDER BY m.created_at DESC
        ");

        foreach ($media as &$item) {
            $item['original_name'] = $item['file_name'];
        }

        View::render('admin/media/index', [
            'title'       => 'Media Library',
            'media'       => $media,
            'flashes'     => Auth::getFlashes(),
            'active_menu' => 'media'
        ], 'admin');
    }

    public function upload(Request $request): void {
        Auth::requireAuth();

        if (!Auth::verifyCsrf($request->post('_csrf_token'))) {
            if ($request->isAjax()) {
                Response::json(['success' => false, 'message' => 'CSRF verification failed'], 403);
            }
            Auth::setFlash('error', 'CSRF verification failed.');
            Response::redirect(home_url('admin/media'));
            return;
        }

        $file = $_FILES['media_file'] ?? $_FILES['file'] ?? null;

        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            $msg = 'File upload failed or no file selected.';
            if ($request->isAjax()) {
                Response::json(['success' => false, 'message' => $msg], 400);
            }
            Auth::setFlash('error', $msg);
            Response::redirect(home_url('admin/media'));
            return;
        }

        $originalName = basename($file['name']);
        $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        $allowedExts = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg', 'ico'];

        if (!in_array($ext, $allowedExts)) {
            $msg = 'Invalid file type. Allowed formats: JPG, PNG, WEBP, GIF, SVG, ICO.';
            if ($request->isAjax()) {
                Response::json(['success' => false, 'message' => $msg], 400);
            }
            Auth::setFlash('error', $msg);
            Response::redirect(home_url('admin/media'));
            return;
        }

        $sanitizedBase = preg_replace('/[^a-zA-Z0-9-_]/', '-', pathinfo($originalName, PATHINFO_FILENAME));
        $filename = $sanitizedBase . '-' . time() . '.' . $ext;
        $uploadDir = PUBLIC_DIR . '/uploads';
        
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $targetPath = $uploadDir . '/' . $filename;
        $publicUrl = 'uploads/' . $filename;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            $size = filesize($targetPath);
            $mime = mime_content_type($targetPath) ?: 'image/' . $ext;
            $userId = $_SESSION['admin_user_id'] ?? 1;

            Database::execute("
                INSERT INTO media (file_name, file_path, file_type, file_size, alt_text, uploaded_by, created_at)
                VALUES (?, ?, ?, ?, ?, ?, NOW())
            ", [$originalName, $publicUrl, $mime, $size, $sanitizedBase, $userId]);

            $mediaId = Database::lastInsertId();

            if ($request->isAjax()) {
                Response::json([
                    'success'  => true,
                    'id'       => $mediaId,
                    'url'      => home_url($publicUrl),
                    'filename' => $filename
                ]);
            }

            Auth::setFlash('success', "File '{$originalName}' uploaded successfully.");
            Response::redirect(home_url('admin/media'));
            return;
        }

        $msg = 'Failed to move uploaded file to destination.';
        if ($request->isAjax()) {
            Response::json(['success' => false, 'message' => $msg], 500);
        }
        Auth::setFlash('error', $msg);
        Response::redirect(home_url('admin/media'));
    }

    public function delete(Request $request, array $params = []): void {
        Auth::requireAuth();
        $id = intval($params['id'] ?? $request->post('id', 0));

        if (!Auth::verifyCsrf($request->post('_csrf_token'))) {
            Auth::setFlash('error', 'CSRF validation failed.');
            Response::redirect(home_url('admin/media'));
            return;
        }

        $media = Database::fetchOne("SELECT * FROM media WHERE id = ?", [$id]);
        if ($media) {
            $localFile = PUBLIC_DIR . '/' . ltrim($media['file_path'], '/');
            if (file_exists($localFile)) {
                @unlink($localFile);
            }
            Database::execute("DELETE FROM media WHERE id = ?", [$id]);
            Auth::setFlash('success', 'Media file deleted successfully.');
        }

        Response::redirect(home_url('admin/media'));
    }
}
