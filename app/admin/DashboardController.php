<?php
/**
 * Admin Dashboard Controller
 * Pokemon Calculator Hub Custom CMS
 */

namespace App\Admin;

use App\Core\Request;
use App\Core\View;
use App\Core\Database;

class DashboardController {
    public function index(Request $request): void {
        Auth::requireAuth();

        $counts = [
            'tools'           => Database::fetchColumn("SELECT COUNT(*) FROM tools WHERE is_active = 1"),
            'total_tools'     => Database::fetchColumn("SELECT COUNT(*) FROM tools"),
            'pages'           => Database::fetchColumn("SELECT COUNT(*) FROM pages WHERE is_active = 1"),
            'posts'           => Database::fetchColumn("SELECT COUNT(*) FROM posts WHERE status = 'published'"),
            'contacts'        => Database::fetchColumn("SELECT COUNT(*) FROM contact_submissions"),
            'unread_contacts' => Database::fetchColumn("SELECT COUNT(*) FROM contact_submissions WHERE is_read = 0"),
            'media'           => Database::fetchColumn("SELECT COUNT(*) FROM media"),
        ];

        $recentTools = Database::fetchAll("
            SELECT t.*, c.name as category_name 
            FROM tools t 
            LEFT JOIN categories c ON t.category_id = c.id 
            ORDER BY t.menu_order ASC, t.id ASC
        ");

        $recentPages = Database::fetchAll("
            SELECT p.*, c.name as category_name 
            FROM pages p 
            LEFT JOIN categories c ON p.category_id = c.id 
            ORDER BY p.updated_at DESC LIMIT 6
        ");

        $recentContacts = Database::fetchAll("
            SELECT * FROM contact_submissions 
            ORDER BY created_at DESC LIMIT 6
        ");

        View::render('admin/dashboard/index', [
            'title'          => 'Dashboard Overview',
            'counts'         => $counts,
            'tools'          => $recentTools,
            'pages'          => $recentPages,
            'contacts'       => $recentContacts,
            'flashes'        => Auth::getFlashes(),
            'active_menu'    => 'dashboard'
        ], 'admin');
    }
}
