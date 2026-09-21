<?php
/**
 * Admin Contact Submissions Controller
 * Pokemon Calculator Hub Custom CMS
 */

namespace App\Admin;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Core\Database;

class ContactController {
    public function index(Request $request): void {
        Auth::requireAuth();

        $messages = Database::fetchAll("
            SELECT * FROM contact_submissions 
            ORDER BY created_at DESC
        ");

        View::render('admin/contact/index', [
            'title'        => 'Contact Messages Inbox',
            'messages'     => $messages,
            'flashes'      => Auth::getFlashes(),
            'active_menu'  => 'contact'
        ], 'admin');
    }

    public function markRead(Request $request, array $params = []): void {
        Auth::requireAuth();
        $id = intval($params['id'] ?? $request->get('id', 0));

        if ($id > 0) {
            Database::execute("UPDATE contact_submissions SET is_read = 1 WHERE id = ?", [$id]);
            Auth::setFlash('success', 'Marked message as read.');
        }
        Response::redirect(home_url('admin/contact'));
    }

    public function delete(Request $request, array $params = []): void {
        Auth::requireAuth();
        $id = intval($params['id'] ?? $request->post('id', 0));

        if (!Auth::verifyCsrf($request->post('_csrf_token'))) {
            Auth::setFlash('error', 'CSRF validation failed.');
            Response::redirect(home_url('admin/contact'));
            return;
        }

        if ($id > 0) {
            Database::execute("DELETE FROM contact_submissions WHERE id = ?", [$id]);
            Auth::setFlash('success', 'Message deleted successfully.');
        }
        Response::redirect(home_url('admin/contact'));
    }
}
