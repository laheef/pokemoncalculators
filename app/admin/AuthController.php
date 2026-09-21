<?php
/**
 * Admin Auth Controller
 * Pokemon Calculator Hub Custom CMS
 */

namespace App\Admin;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;

class AuthController {
    /**
     * Show login form
     */
    public function showLogin(Request $request): void {
        $this->loginForm($request);
    }

    public function loginForm(Request $request): void {
        if (Auth::check()) {
            Response::redirect(home_url('admin'));
            return;
        }

        View::render('admin/auth/login', [
            'meta_title' => 'Admin Login — Pokemon Calculator Hub',
            'flashes'    => Auth::getFlashes()
        ], '');
    }

    /**
     * Process login form submission
     */
    public function login(Request $request): void {
        if (!Auth::verifyCsrf($request->post('_csrf_token'))) {
            Auth::setFlash('error', 'Invalid security token. Please try again.');
            Response::redirect(home_url('admin/login'));
            return;
        }

        $username = trim($request->post('username', ''));
        $password = $request->post('password', '');

        if (empty($username) || empty($password)) {
            Auth::setFlash('error', 'Please enter both username and password.');
            Response::redirect(home_url('admin/login'));
            return;
        }

        if (Auth::attempt($username, $password)) {
            Auth::setFlash('success', 'Welcome back, ' . esc_html($username) . '!');
            $redirect = $_SESSION['admin_redirect_url'] ?? home_url('admin');
            unset($_SESSION['admin_redirect_url']);
            Response::redirect($redirect);
            return;
        }

        Auth::setFlash('error', 'Invalid username/email or password.');
        Response::redirect(home_url('admin/login'));
    }

    /**
     * Process logout
     */
    public function logout(Request $request): void {
        Auth::logout();
        Auth::setFlash('success', 'You have been logged out successfully.');
        Response::redirect(home_url('admin/login'));
    }
}
