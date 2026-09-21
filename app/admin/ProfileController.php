<?php
/**
 * Admin Profile Controller
 * Pokemon Calculator Hub Custom CMS
 */

namespace App\Admin;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Core\Database;

class ProfileController {
    /**
     * Show profile edit view
     */
    public function index(Request $request): void {
        Auth::requireAuth();
        $user = Auth::user();

        View::render('admin/profile/index', [
            'title'       => 'My Profile & Account',
            'user'        => $user,
            'flashes'     => Auth::getFlashes(),
            'active_menu' => 'profile'
        ], 'admin');
    }

    /**
     * Update profile details and password
     */
    public function update(Request $request): void {
        Auth::requireAuth();
        $currentUser = Auth::user();

        if (!Auth::verifyCsrf($request->post('_csrf_token'))) {
            Auth::setFlash('error', 'CSRF validation failed.');
            Response::redirect(home_url('admin/profile'));
            return;
        }

        $username        = trim($request->post('username', ''));
        $email           = trim($request->post('email', ''));
        $currentPassword = $request->post('current_password', '');
        $newPassword     = $request->post('new_password', '');
        $confirmPassword = $request->post('confirm_password', '');

        if (empty($username) || empty($email)) {
            Auth::setFlash('error', 'Username and email are required.');
            Response::redirect(home_url('admin/profile'));
            return;
        }

        // Check if username/email already exists for someone else
        $exists = Database::fetchOne("SELECT id FROM users WHERE (username = ? OR email = ?) AND id != ?", [$username, $email, $currentUser['id']]);
        if ($exists) {
            Auth::setFlash('error', 'That username or email is already taken.');
            Response::redirect(home_url('admin/profile'));
            return;
        }

        // If user wants to change password
        if (!empty($newPassword)) {
            $userRecord = Database::fetchOne("SELECT password_hash FROM users WHERE id = ?", [$currentUser['id']]);
            if (!password_verify($currentPassword, $userRecord['password_hash'])) {
                Auth::setFlash('error', 'Current password was incorrect.');
                Response::redirect(home_url('admin/profile'));
                return;
            }

            if (strlen($newPassword) < 6) {
                Auth::setFlash('error', 'New password must be at least 6 characters.');
                Response::redirect(home_url('admin/profile'));
                return;
            }

            if ($newPassword !== $confirmPassword) {
                Auth::setFlash('error', 'New passwords do not match.');
                Response::redirect(home_url('admin/profile'));
                return;
            }

            $newHash = password_hash($newPassword, PASSWORD_BCRYPT);
            Database::execute("
                UPDATE users 
                SET username = ?, email = ?, password_hash = ?, updated_at = NOW()
                WHERE id = ?
            ", [$username, $email, $newHash, $currentUser['id']]);
        } else {
            Database::execute("
                UPDATE users 
                SET username = ?, email = ?, updated_at = NOW()
                WHERE id = ?
            ", [$username, $email, $currentUser['id']]);
        }

        $_SESSION['admin_username'] = $username;
        Auth::setFlash('success', 'Your profile information has been updated successfully.');
        Response::redirect(home_url('admin/profile'));
    }
}
