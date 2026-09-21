<?php
/**
 * Admin Categories Manager Controller
 * Pokemon Calculator Hub Custom CMS
 */

namespace App\Admin;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Core\Database;

class CategoriesController {
    public function index(Request $request): void {
        Auth::requireAuth();

        $categories = Database::fetchAll("
            SELECT c.*, 
                   (SELECT COUNT(*) FROM tools WHERE category_id = c.id) as tool_count,
                   (SELECT COUNT(*) FROM pages WHERE category_id = c.id) as page_count,
                   (SELECT COUNT(*) FROM posts WHERE category_id = c.id) as post_count
            FROM categories c
            ORDER BY c.menu_order ASC, c.id ASC
        ");

        View::render('admin/categories/index', [
            'title'       => 'Categories Manager',
            'categories'  => $categories,
            'flashes'     => Auth::getFlashes(),
            'active_menu' => 'categories'
        ], 'admin');
    }

    public function create(Request $request): void {
        Response::redirect(home_url('admin/categories'));
    }

    public function store(Request $request): void {
        Auth::requireAuth();

        if (!Auth::verifyCsrf($request->post('_csrf_token'))) {
            Auth::setFlash('error', 'CSRF validation failed.');
            Response::redirect(home_url('admin/categories'));
            return;
        }

        $name        = trim($request->post('name', ''));
        $slug        = trim($request->post('slug', ''));
        $description = trim($request->post('description', ''));
        $type        = $request->post('type', 'tool');
        $menu_order  = intval($request->post('menu_order', 0));

        if (empty($name)) {
            Auth::setFlash('error', 'Category name is required.');
            Response::redirect(home_url('admin/categories'));
            return;
        }

        if (empty($slug)) {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));
        }

        $exists = Database::fetchOne("SELECT id FROM categories WHERE slug = ?", [$slug]);
        if ($exists) {
            Auth::setFlash('error', 'Category slug already exists.');
            Response::redirect(home_url('admin/categories'));
            return;
        }

        Database::execute("
            INSERT INTO categories (slug, name, description, type, menu_order, created_at)
            VALUES (?, ?, ?, ?, ?, NOW())
        ", [$slug, $name, $description, $type, $menu_order]);

        Auth::setFlash('success', "Category '{$name}' created successfully.");
        Response::redirect(home_url('admin/categories'));
    }

    public function edit(Request $request, array $params = []): void {
        Auth::requireAuth();
        $id = intval($params['id'] ?? $request->get('id', 0));

        $category = Database::fetchOne("SELECT * FROM categories WHERE id = ?", [$id]);
        if (!$category) {
            Auth::setFlash('error', 'Category not found.');
            Response::redirect(home_url('admin/categories'));
            return;
        }

        View::render('admin/categories/form', [
            'title'       => "Edit Category: {$category['name']}",
            'category'    => $category,
            'flashes'     => Auth::getFlashes(),
            'active_menu' => 'categories'
        ], 'admin');
    }

    public function update(Request $request, array $params = []): void {
        Auth::requireAuth();
        $id = intval($params['id'] ?? $request->post('id', 0));

        if (!Auth::verifyCsrf($request->post('_csrf_token'))) {
            Auth::setFlash('error', 'CSRF validation failed.');
            Response::redirect(home_url('admin/categories'));
            return;
        }

        $category = Database::fetchOne("SELECT * FROM categories WHERE id = ?", [$id]);
        if (!$category) {
            Auth::setFlash('error', 'Category not found.');
            Response::redirect(home_url('admin/categories'));
            return;
        }

        $name        = trim($request->post('name', ''));
        $slug        = trim($request->post('slug', ''));
        $description = trim($request->post('description', ''));
        $type        = $request->post('type', 'tool');
        $menu_order  = intval($request->post('menu_order', 0));

        if (empty($name)) {
            Auth::setFlash('error', 'Category name is required.');
            Response::redirect(home_url('admin/categories/edit?id=' . $id));
            return;
        }

        if (empty($slug)) {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));
        }

        $exists = Database::fetchOne("SELECT id FROM categories WHERE slug = ? AND id != ?", [$slug, $id]);
        if ($exists) {
            Auth::setFlash('error', 'Another category with this slug already exists.');
            Response::redirect(home_url('admin/categories/edit?id=' . $id));
            return;
        }

        Database::execute("
            UPDATE categories 
            SET slug = ?, name = ?, description = ?, type = ?, menu_order = ?
            WHERE id = ?
        ", [$slug, $name, $description, $type, $menu_order, $id]);

        Auth::setFlash('success', "Category '{$name}' updated successfully.");
        Response::redirect(home_url('admin/categories'));
    }

    public function delete(Request $request, array $params = []): void {
        Auth::requireAuth();
        $id = intval($params['id'] ?? $request->post('id', 0));

        if (!Auth::verifyCsrf($request->post('_csrf_token'))) {
            Auth::setFlash('error', 'CSRF validation failed.');
            Response::redirect(home_url('admin/categories'));
            return;
        }

        Database::execute("DELETE FROM categories WHERE id = ?", [$id]);
        Auth::setFlash('success', 'Category deleted successfully.');
        Response::redirect(home_url('admin/categories'));
    }
}
