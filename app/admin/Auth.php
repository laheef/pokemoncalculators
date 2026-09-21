<?php
/**
 * Admin Authentication & Session Management
 * Pokemon Calculator Hub Custom CMS
 */

namespace App\Admin;

use App\Core\Database;
use App\Core\Response;

class Auth {
    /**
     * Check if user is currently logged in
     */
    public static function check(): bool {
        return !empty($_SESSION['admin_user_id']) && !empty($_SESSION['admin_logged_in']);
    }

    /**
     * Get current logged-in user record
     */
    public static function user(): ?array {
        if (!self::check()) {
            return null;
        }
        $id = intval($_SESSION['admin_user_id']);
        return Database::fetchOne("SELECT id, username, email, role, created_at FROM users WHERE id = ?", [$id]);
    }

    /**
     * Role checks
     */
    public static function role(): string {
        return $_SESSION['admin_role'] ?? 'author';
    }

    public static function isAdmin(): bool {
        return self::check() && self::role() === 'admin';
    }

    public static function isEditor(): bool {
        return self::check() && in_array(self::role(), ['admin', 'editor']);
    }

    public static function isAuthor(): bool {
        return self::check();
    }

    /**
     * Require minimum role
     */
    public static function requireRole(string $minRole = 'admin'): void {
        self::requireAuth();
        
        $roleHierarchy = ['author' => 1, 'editor' => 2, 'admin' => 3];
        $userLevel = $roleHierarchy[self::role()] ?? 0;
        $requiredLevel = $roleHierarchy[$minRole] ?? 3;

        if ($userLevel < $requiredLevel) {
            self::setFlash('error', 'Access denied. You do not have permission to view that administrative section.');
            Response::redirect(home_url('admin'));
            exit;
        }
    }

    /**
     * Attempt login with username/email and password
     */
    public static function attempt(string $login, string $password): bool {
        $user = Database::fetchOne(
            "SELECT * FROM users WHERE (username = ? OR email = ?) LIMIT 1",
            [$login, $login]
        );

        if ($user && password_verify($password, $user['password_hash'])) {
            // Regenerate session to prevent fixation
            session_regenerate_id(true);
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_user_id']   = $user['id'];
            $_SESSION['admin_username']  = $user['username'];
            $_SESSION['admin_role']      = $user['role'];
            return true;
        }

        return false;
    }

    /**
     * Log out current user
     */
    public static function logout(): void {
        unset($_SESSION['admin_logged_in'], $_SESSION['admin_user_id'], $_SESSION['admin_username'], $_SESSION['admin_role']);
        session_regenerate_id(true);
    }

    /**
     * Require login or redirect to login screen
     */
    public static function requireAuth(): void {
        if (!self::check()) {
            $_SESSION['admin_redirect_url'] = $_SERVER['REQUEST_URI'] ?? '/admin';
            Response::redirect(home_url('admin/login'));
            exit;
        }
    }

    /**
     * Set a flash message
     */
    public static function setFlash(string $type, string $message): void {
        if (!isset($_SESSION['flash_messages'])) {
            $_SESSION['flash_messages'] = [];
        }
        $_SESSION['flash_messages'][] = ['type' => $type, 'message' => $message];
    }

    /**
     * Retrieve single flash message of a given type
     */
    public static function getFlash(string $type): ?string {
        if (!isset($_SESSION['flash_messages'])) {
            return null;
        }
        foreach ($_SESSION['flash_messages'] as $k => $msg) {
            if ($msg['type'] === $type) {
                $text = $msg['message'];
                unset($_SESSION['flash_messages'][$k]);
                $_SESSION['flash_messages'] = array_values($_SESSION['flash_messages']);
                return $text;
            }
        }
        return null;
    }

    /**
     * Retrieve and clear all flash messages
     */
    public static function getFlashes(): array {
        $messages = $_SESSION['flash_messages'] ?? [];
        unset($_SESSION['flash_messages']);
        return $messages;
    }

    /**
     * Generate or return existing CSRF token
     */
    public static function csrfToken(): string {
        if (empty($_SESSION['_csrf_token'])) {
            $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['_csrf_token'];
    }

    /**
     * Render hidden CSRF input field
     */
    public static function csrfInput(): string {
        $token = self::csrfToken();
        return '<input type="hidden" name="_csrf_token" value="' . esc_attr($token) . '">';
    }

    /**
     * Validate CSRF Token
     */
    public static function verifyCsrf(?string $token = null): bool {
        if ($token === null) {
            $token = $_POST['_csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
        }
        return !empty($token) && hash_equals($_SESSION['_csrf_token'] ?? '', $token);
    }
}
