<?php
/**
 * Admin Users & Team Manager Controller
 * Pokemon Calculator Hub Custom CMS
 */

namespace App\Admin;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Core\Database;

class UsersController {
    /**
     * List all administrator and staff accounts
     */
    public function index(Request $request): void {
        Auth::requireRole('admin');

        $users = Database::fetchAll("
            SELECT u.id, u.username, u.email, u.role, u.created_at, u.updated_at,
                   (SELECT COUNT(*) FROM posts WHERE author_id = u.id) as posts_count
            FROM users u
            ORDER BY u.id ASC
        ");

        View::render('admin/users/index', [
            'title'       => 'Users & Team Management',
            'users'       => $users,
            'flashes'     => Auth::getFlashes(),
            'active_menu' => 'users'
        ], 'admin');
    }

    /**
     * Create user form
     */
    public function create(Request $request): void {
        Auth::requireRole('admin');

        View::render('admin/users/form', [
            'title'       => 'Add New User',
            'edit_user'   => null,
            'flashes'     => Auth::getFlashes(),
            'active_menu' => 'users'
        ], 'admin');
    }

    /**
     * Store new user
     */
    public function store(Request $request): void {
        Auth::requireRole('admin');

        if (!Auth::verifyCsrf($request->post('_csrf_token'))) {
            Auth::setFlash('error', 'CSRF validation failed.');
            Response::redirect(home_url('admin/users/create'));
            return;
        }

        $username = trim($request->post('username', ''));
        $email    = trim($request->post('email', ''));
        $password = $request->post('password', '');
        $role     = $request->post('role', 'editor');

        if (empty($username) || empty($email) || empty($password)) {
            Auth::setFlash('error', 'Username, email, and password are all required.');
            Response::redirect(home_url('admin/users/create'));
            return;
        }

        if (!in_array($role, ['admin', 'editor', 'author'])) {
            $role = 'editor';
        }

        // Check if username or email is already in use
        $exists = Database::fetchOne("SELECT id FROM users WHERE username = ? OR email = ?", [$username, $email]);
        if ($exists) {
            Auth::setFlash('error', 'A user with that username or email address already exists.');
            Response::redirect(home_url('admin/users/create'));
            return;
        }

        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        Database::execute("
            INSERT INTO users (username, email, password_hash, role, created_at, updated_at)
            VALUES (?, ?, ?, ?, NOW(), NOW())
        ", [$username, $email, $passwordHash, $role]);

        Auth::setFlash('success', "User '{$username}' created successfully as " . ucfirst($role) . ".");
        Response::redirect(home_url('admin/users'));
    }

    /**
     * Edit user form
     */
    public function edit(Request $request, array $params = []): void {
        Auth::requireRole('admin');
        $id = intval($params['id'] ?? $request->get('id', 0));

        $user = Database::fetchOne("SELECT id, username, email, role, created_at FROM users WHERE id = ?", [$id]);
        if (!$user) {
            Auth::setFlash('error', 'User not found.');
            Response::redirect(home_url('admin/users'));
            return;
        }

        View::render('admin/users/form', [
            'title'       => "Edit User: {$user['username']}",
            'edit_user'   => $user,
            'flashes'     => Auth::getFlashes(),
            'active_menu' => 'users'
        ], 'admin');
    }

    /**
     * Update user details
     */
    public function update(Request $request, array $params = []): void {
        Auth::requireRole('admin');
        $id = intval($params['id'] ?? $request->post('id', 0));

        if (!Auth::verifyCsrf($request->post('_csrf_token'))) {
            Auth::setFlash('error', 'CSRF validation failed.');
            Response::redirect(home_url('admin/users'));
            return;
        }

        $user = Database::fetchOne("SELECT * FROM users WHERE id = ?", [$id]);
        if (!$user) {
            Auth::setFlash('error', 'User not found.');
            Response::redirect(home_url('admin/users'));
            return;
        }

        $username = trim($request->post('username', ''));
        $email    = trim($request->post('email', ''));
        $password = $request->post('password', '');
        $role     = $request->post('role', $user['role']);

        if (empty($username) || empty($email)) {
            Auth::setFlash('error', 'Username and email cannot be empty.');
            Response::redirect(home_url('admin/users/edit?id=' . $id));
            return;
        }

        if (!in_array($role, ['admin', 'editor', 'author'])) {
            $role = $user['role'];
        }

        // Prevent demoting the last remaining admin
        if ($user['role'] === 'admin' && $role !== 'admin') {
            $adminCount = Database::fetchColumn("SELECT COUNT(*) FROM users WHERE role = 'admin'");
            if ($adminCount <= 1) {
                Auth::setFlash('error', 'Cannot demote the only remaining Administrator account.');
                Response::redirect(home_url('admin/users/edit?id=' . $id));
                return;
            }
        }

        // Check for duplicate username/email
        $exists = Database::fetchOne("SELECT id FROM users WHERE (username = ? OR email = ?) AND id != ?", [$username, $email, $id]);
        if ($exists) {
            Auth::setFlash('error', 'Another user already uses that username or email.');
            Response::redirect(home_url('admin/users/edit?id=' . $id));
            return;
        }

        if (!empty($password)) {
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            Database::execute("
                UPDATE users 
                SET username = ?, email = ?, password_hash = ?, role = ?, updated_at = NOW()
                WHERE id = ?
            ", [$username, $email, $passwordHash, $role, $id]);
        } else {
            Database::execute("
                UPDATE users 
                SET username = ?, email = ?, role = ?, updated_at = NOW()
                WHERE id = ?
            ", [$username, $email, $role, $id]);
        }

        Auth::setFlash('success', "User '{$username}' updated successfully.");
        Response::redirect(home_url('admin/users'));
    }

    /**
     * Delete user account
     */
    public function delete(Request $request, array $params = []): void {
        Auth::requireRole('admin');
        $id = intval($params['id'] ?? $request->post('id', 0));

        if (!Auth::verifyCsrf($request->post('_csrf_token'))) {
            Auth::setFlash('error', 'CSRF validation failed.');
            Response::redirect(home_url('admin/users'));
            return;
        }

        $currentUser = Auth::user();
        if ($currentUser && intval($currentUser['id']) === $id) {
            Auth::setFlash('error', 'You cannot delete your own logged-in account.');
            Response::redirect(home_url('admin/users'));
            return;
        }

        $targetUser = Database::fetchOne("SELECT * FROM users WHERE id = ?", [$id]);
        if (!$targetUser) {
            Auth::setFlash('error', 'User not found.');
            Response::redirect(home_url('admin/users'));
            return;
        }

        if ($targetUser['role'] === 'admin') {
            $adminCount = Database::fetchColumn("SELECT COUNT(*) FROM users WHERE role = 'admin'");
            if ($adminCount <= 1) {
                Auth::setFlash('error', 'Cannot delete the only remaining Administrator account.');
                Response::redirect(home_url('admin/users'));
                return;
            }
        }

        // Reassign user's posts to current admin to prevent orphan entries
        Database::execute("UPDATE posts SET author_id = ? WHERE author_id = ?", [$currentUser['id'], $id]);
        Database::execute("DELETE FROM users WHERE id = ?", [$id]);

        Auth::setFlash('success', "User '{$targetUser['username']}' deleted successfully.");
        Response::redirect(home_url('admin/users'));
    }
}
