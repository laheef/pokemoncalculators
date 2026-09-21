<?php
/**
 * Admin Pages Manager Controller
 * Pokemon Calculator Hub Custom CMS
 */

namespace App\Admin;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Core\Database;

class PagesController {
    /**
     * List all pages
     */
    public function index(Request $request): void {
        Auth::requireAuth();

        $pages = Database::fetchAll("
            SELECT p.*, c.name as category_name, c.slug as category_slug
            FROM pages p
            LEFT JOIN categories c ON p.category_id = c.id
            ORDER BY p.menu_order ASC, p.id ASC
        ");

        foreach ($pages as &$p) {
            $p['status'] = (!empty($p['is_active'])) ? 'published' : 'draft';
        }

        View::render('admin/pages/index', [
            'title'       => 'Pages Manager',
            'pages'       => $pages,
            'flashes'     => Auth::getFlashes(),
            'active_menu' => 'pages'
        ], 'admin');
    }

    /**
     * Show create page form
     */
    public function create(Request $request): void {
        Auth::requireAuth();

        $categories = Database::fetchAll("SELECT * FROM categories ORDER BY menu_order ASC");

        View::render('admin/pages/form', [
            'title'       => 'Create New Page',
            'page'        => null,
            'categories'  => $categories,
            'flashes'     => Auth::getFlashes(),
            'active_menu' => 'pages'
        ], 'admin');
    }

    /**
     * Store new page
     */
    public function store(Request $request): void {
        Auth::requireAuth();

        if (!Auth::verifyCsrf($request->post('_csrf_token'))) {
            Auth::setFlash('error', 'CSRF validation failed.');
            Response::redirect(home_url('admin/pages/create'));
            return;
        }

        $title               = trim($request->post('title', ''));
        $slug                = trim($request->post('slug', ''));
        $content             = $request->post('content', '');
        $excerpt             = trim($request->post('excerpt', ''));
        $category_id         = $request->post('category_id') ? intval($request->post('category_id')) : null;
        $page_width_template = $request->post('page_width_template', 'boxed');
        $custom_width        = intval($request->post('custom_width', 1280));
        $status              = $request->post('status', 'published');
        $is_active           = ($status === 'published' || $request->post('is_active') == '1') ? 1 : 0;
        $meta_title          = trim($request->post('meta_title', ''));
        $meta_desc           = trim($request->post('meta_description', $request->post('meta_desc', '')));
        $og_image            = trim($request->post('og_image', ''));
        $menu_order          = intval($request->post('menu_order', 0));

        if (empty($title)) {
            Auth::setFlash('error', 'Page title is required.');
            Response::redirect(home_url('admin/pages/create'));
            return;
        }

        if (empty($slug)) {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
        }

        // Check for slug duplication
        $exists = Database::fetchOne("SELECT id FROM pages WHERE slug = ?", [$slug]);
        if ($exists) {
            Auth::setFlash('error', 'A page with this slug already exists. Please choose a unique slug.');
            Response::redirect(home_url('admin/pages/create'));
            return;
        }

        Database::execute("
            INSERT INTO pages (slug, title, content, excerpt, category_id, page_width_template, custom_width, is_active, meta_title, meta_desc, og_image, menu_order, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
        ", [$slug, $title, $content, $excerpt, $category_id, $page_width_template, $custom_width, $is_active, $meta_title, $meta_desc, $og_image, $menu_order]);

        Auth::setFlash('success', "Page '{$title}' published successfully!");
        Response::redirect(home_url('admin/pages'));
    }

    /**
     * Show edit page form
     */
    public function edit(Request $request, array $params = []): void {
        Auth::requireAuth();
        $id = intval($params['id'] ?? $request->get('id', 0));

        $page = Database::fetchOne("SELECT * FROM pages WHERE id = ?", [$id]);
        if (!$page) {
            Auth::setFlash('error', 'Page not found.');
            Response::redirect(home_url('admin/pages'));
            return;
        }

        $page['status'] = (!empty($page['is_active'])) ? 'published' : 'draft';
        $page['meta_description'] = $page['meta_desc'] ?? '';

        $categories = Database::fetchAll("SELECT * FROM categories ORDER BY menu_order ASC");

        View::render('admin/pages/form', [
            'title'       => "Edit Page: {$page['title']}",
            'page'        => $page,
            'categories'  => $categories,
            'flashes'     => Auth::getFlashes(),
            'active_menu' => 'pages'
        ], 'admin');
    }

    /**
     * Update existing page
     */
    public function update(Request $request, array $params = []): void {
        Auth::requireAuth();
        $id = intval($params['id'] ?? $request->post('id', 0));

        if (!Auth::verifyCsrf($request->post('_csrf_token'))) {
            Auth::setFlash('error', 'CSRF validation failed.');
            Response::redirect(home_url('admin/pages'));
            return;
        }

        $page = Database::fetchOne("SELECT * FROM pages WHERE id = ?", [$id]);
        if (!$page) {
            Auth::setFlash('error', 'Page not found.');
            Response::redirect(home_url('admin/pages'));
            return;
        }

        $title               = trim($request->post('title', ''));
        $slug                = trim($request->post('slug', ''));
        $content             = $request->post('content', '');
        $excerpt             = trim($request->post('excerpt', ''));
        $category_id         = $request->post('category_id') ? intval($request->post('category_id')) : null;
        $page_width_template = $request->post('page_width_template', 'boxed');
        $custom_width        = intval($request->post('custom_width', 1280));
        $status              = $request->post('status', 'published');
        $is_active           = ($status === 'published' || $request->post('is_active') == '1') ? 1 : 0;
        $meta_title          = trim($request->post('meta_title', ''));
        $meta_desc           = trim($request->post('meta_description', $request->post('meta_desc', '')));
        $og_image            = trim($request->post('og_image', ''));
        $menu_order          = intval($request->post('menu_order', 0));

        if (empty($title)) {
            Auth::setFlash('error', 'Page title is required.');
            Response::redirect(home_url('admin/pages/edit?id=' . $id));
            return;
        }

        if (empty($slug)) {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
        }

        // Check for slug duplication with other pages
        $exists = Database::fetchOne("SELECT id FROM pages WHERE slug = ? AND id != ?", [$slug, $id]);
        if ($exists) {
            Auth::setFlash('error', 'Another page already uses this slug.');
            Response::redirect(home_url('admin/pages/edit?id=' . $id));
            return;
        }

        Database::execute("
            UPDATE pages 
            SET slug = ?, title = ?, content = ?, excerpt = ?, category_id = ?, page_width_template = ?, custom_width = ?, is_active = ?, meta_title = ?, meta_desc = ?, og_image = ?, menu_order = ?, updated_at = NOW()
            WHERE id = ?
        ", [$slug, $title, $content, $excerpt, $category_id, $page_width_template, $custom_width, $is_active, $meta_title, $meta_desc, $og_image, $menu_order, $id]);

        Auth::setFlash('success', "Page '{$title}' updated successfully.");
        Response::redirect(home_url('admin/pages'));
    }

    /**
     * Delete page
     */
    public function delete(Request $request, array $params = []): void {
        Auth::requireAuth();
        $id = intval($params['id'] ?? $request->post('id', 0));

        if (!Auth::verifyCsrf($request->post('_csrf_token'))) {
            Auth::setFlash('error', 'CSRF validation failed.');
            Response::redirect(home_url('admin/pages'));
            return;
        }

        $page = Database::fetchOne("SELECT title FROM pages WHERE id = ?", [$id]);
        if ($page) {
            Database::execute("DELETE FROM pages WHERE id = ?", [$id]);
            Auth::setFlash('success', "Page '{$page['title']}' deleted.");
        }

        Response::redirect(home_url('admin/pages'));
    }
}
