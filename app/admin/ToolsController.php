<?php
/**
 * Admin Tools Manager Controller
 * Pokemon Calculator Hub Custom CMS
 */

namespace App\Admin;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Core\Database;

class ToolsController {
    /**
     * List all calculator tools
     */
    public function index(Request $request): void {
        Auth::requireAuth();

        $tools = Database::fetchAll("
            SELECT t.*, c.name as category_name 
            FROM tools t
            LEFT JOIN categories c ON t.category_id = c.id
            ORDER BY t.menu_order ASC, t.id ASC
        ");

        // Normalize file_name
        foreach ($tools as &$t) {
            $t['file_name'] = basename($t['file_path'] ?? '');
            $t['sort_order'] = $t['menu_order'] ?? 0;
        }

        View::render('admin/tools/index', [
            'title'       => 'Calculators & Tools Manager',
            'tools'       => $tools,
            'flashes'     => Auth::getFlashes(),
            'active_menu' => 'tools'
        ], 'admin');
    }

    /**
     * Show create tool form
     */
    public function create(Request $request): void {
        Auth::requireAuth();

        $categories = Database::fetchAll("SELECT * FROM categories WHERE type = 'tool' OR type = 'general' ORDER BY menu_order ASC");
        
        $availableFiles = [
            'cp-calculator.php',
            'iv-calculator.php',
            'evolution-cp.php',
            'stardust-calculator.php',
            'damage-calc.php',
            'speed-tiers.php',
            'go-stat-calc.php',
            'catch-rate-calculator.php'
        ];

        View::render('admin/tools/form', [
            'title'           => 'Add New Calculator',
            'tool'            => null,
            'categories'      => $categories,
            'available_files' => $availableFiles,
            'flashes'         => Auth::getFlashes(),
            'active_menu'     => 'tools'
        ], 'admin');
    }

    /**
     * Store new calculator tool in database
     */
    public function store(Request $request): void {
        Auth::requireAuth();

        if (!Auth::verifyCsrf($request->post('_csrf_token'))) {
            Auth::setFlash('error', 'CSRF validation failed.');
            Response::redirect(home_url('admin/tools/create'));
            return;
        }

        $name        = trim($request->post('name', ''));
        $short_name  = trim($request->post('short_name', $name));
        $slug        = trim($request->post('slug', ''));
        $short_desc  = trim($request->post('short_description', ''));
        $category_id = $request->post('category_id') ? intval($request->post('category_id')) : null;
        $file_name   = trim($request->post('file_name', ''));
        $file_path   = 'pkm-calculators/' . basename($file_name);
        $icon_svg    = trim($request->post('icon_svg', ''));
        $sort_order  = intval($request->post('sort_order', $request->post('menu_order', 10)));
        $is_active   = $request->post('is_active') ? 1 : 0;
        $meta_title  = trim($request->post('meta_title', ''));
        $meta_desc   = trim($request->post('meta_description', $request->post('meta_desc', '')));

        if (empty($name)) {
            Auth::setFlash('error', 'Tool name is required.');
            Response::redirect(home_url('admin/tools/create'));
            return;
        }

        if (empty($slug)) {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));
        }

        // Check for slug duplication
        $exists = Database::fetchOne("SELECT id FROM tools WHERE slug = ?", [$slug]);
        if ($exists) {
            Auth::setFlash('error', 'A tool with this slug/URL already exists. Please choose a unique slug.');
            Response::redirect(home_url('admin/tools/create'));
            return;
        }

        Database::execute("
            INSERT INTO tools (slug, name, short_name, icon_svg, short_description, category_id, file_path, menu_order, is_active, meta_title, meta_desc, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
        ", [$slug, $name, $short_name, $icon_svg, $short_desc, $category_id, $file_path, $sort_order, $is_active, $meta_title, $meta_desc]);

        Auth::setFlash('success', "Calculator '{$name}' created successfully!");
        Response::redirect(home_url('admin/tools'));
    }

    /**
     * Show edit tool form
     */
    public function edit(Request $request, array $params = []): void {
        Auth::requireAuth();
        $id = intval($params['id'] ?? $request->get('id', 0));

        $tool = Database::fetchOne("SELECT * FROM tools WHERE id = ?", [$id]);
        if (!$tool) {
            Auth::setFlash('error', 'Tool not found.');
            Response::redirect(home_url('admin/tools'));
            return;
        }

        $tool['file_name'] = basename($tool['file_path'] ?? '');
        $tool['sort_order'] = $tool['menu_order'] ?? 0;
        $tool['meta_description'] = $tool['meta_desc'] ?? '';

        $categories = Database::fetchAll("SELECT * FROM categories WHERE type = 'tool' OR type = 'general' ORDER BY menu_order ASC");
        
        $availableFiles = [
            'cp-calculator.php',
            'iv-calculator.php',
            'evolution-cp.php',
            'stardust-calculator.php',
            'damage-calc.php',
            'speed-tiers.php',
            'go-stat-calc.php',
            'catch-rate-calculator.php'
        ];

        View::render('admin/tools/form', [
            'title'           => "Edit Tool: {$tool['name']}",
            'tool'            => $tool,
            'categories'      => $categories,
            'available_files' => $availableFiles,
            'flashes'         => Auth::getFlashes(),
            'active_menu'     => 'tools'
        ], 'admin');
    }

    /**
     * Update existing calculator tool
     */
    public function update(Request $request, array $params = []): void {
        Auth::requireAuth();
        $id = intval($params['id'] ?? $request->post('id', 0));

        if (!Auth::verifyCsrf($request->post('_csrf_token'))) {
            Auth::setFlash('error', 'CSRF validation failed.');
            Response::redirect(home_url('admin/tools'));
            return;
        }

        $tool = Database::fetchOne("SELECT * FROM tools WHERE id = ?", [$id]);
        if (!$tool) {
            Auth::setFlash('error', 'Tool not found.');
            Response::redirect(home_url('admin/tools'));
            return;
        }

        $name        = trim($request->post('name', ''));
        $short_name  = trim($request->post('short_name', $name));
        $slug        = trim($request->post('slug', ''));
        $short_desc  = trim($request->post('short_description', ''));
        $category_id = $request->post('category_id') ? intval($request->post('category_id')) : null;
        $file_name   = trim($request->post('file_name', ''));
        $file_path   = 'pkm-calculators/' . basename($file_name);
        $icon_svg    = trim($request->post('icon_svg', ''));
        $sort_order  = intval($request->post('sort_order', $request->post('menu_order', 10)));
        $is_active   = $request->post('is_active') ? 1 : 0;
        $meta_title  = trim($request->post('meta_title', ''));
        $meta_desc   = trim($request->post('meta_description', $request->post('meta_desc', '')));

        if (empty($name)) {
            Auth::setFlash('error', 'Tool name is required.');
            Response::redirect(home_url('admin/tools/edit?id=' . $id));
            return;
        }

        if (empty($slug)) {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));
        }

        // Check for slug duplication with other tools
        $exists = Database::fetchOne("SELECT id FROM tools WHERE slug = ? AND id != ?", [$slug, $id]);
        if ($exists) {
            Auth::setFlash('error', 'Another tool already uses this slug/URL.');
            Response::redirect(home_url('admin/tools/edit?id=' . $id));
            return;
        }

        Database::execute("
            UPDATE tools 
            SET slug = ?, name = ?, short_name = ?, icon_svg = ?, short_description = ?, category_id = ?, file_path = ?, menu_order = ?, is_active = ?, meta_title = ?, meta_desc = ?, updated_at = NOW()
            WHERE id = ?
        ", [$slug, $name, $short_name, $icon_svg, $short_desc, $category_id, $file_path, $sort_order, $is_active, $meta_title, $meta_desc, $id]);

        Auth::setFlash('success', "Tool '{$name}' updated successfully.");
        Response::redirect(home_url('admin/tools'));
    }

    /**
     * Toggle tool status (Active / Inactive)
     */
    public function toggle(Request $request, array $params = []): void {
        Auth::requireAuth();
        $id = intval($params['id'] ?? $request->get('id', 0));

        $tool = Database::fetchOne("SELECT id, is_active, name FROM tools WHERE id = ?", [$id]);
        if ($tool) {
            $newStatus = $tool['is_active'] ? 0 : 1;
            Database::execute("UPDATE tools SET is_active = ? WHERE id = ?", [$newStatus, $id]);
            $msg = $newStatus ? "Activated '{$tool['name']}'" : "Deactivated '{$tool['name']}'";
            Auth::setFlash('success', $msg);
        }

        Response::redirect(home_url('admin/tools'));
    }

    /**
     * Delete calculator tool
     */
    public function delete(Request $request, array $params = []): void {
        Auth::requireAuth();
        $id = intval($params['id'] ?? $request->post('id', 0));

        if (!Auth::verifyCsrf($request->post('_csrf_token'))) {
            Auth::setFlash('error', 'CSRF verification failed.');
            Response::redirect(home_url('admin/tools'));
            return;
        }

        $tool = Database::fetchOne("SELECT name FROM tools WHERE id = ?", [$id]);
        if ($tool) {
            Database::execute("DELETE FROM tools WHERE id = ?", [$id]);
            Auth::setFlash('success', "Tool '{$tool['name']}' deleted.");
        }

        Response::redirect(home_url('admin/tools'));
    }
}
