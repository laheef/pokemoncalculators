<?php
/**
 * Homepage Controller
 * Pokemon Calculator Hub
 */

namespace App\Pages;

use App\Core\Request;
use App\Core\View;
use App\Core\Database;

class HomeController {
    public function index(Request $request): void {
        $tools = Database::fetchAll("
            SELECT t.*, c.name as category_name, c.slug as category_slug
            FROM tools t
            LEFT JOIN categories c ON t.category_id = c.id
            WHERE t.is_active = 1
            ORDER BY t.menu_order ASC
        ");

        $seoData = [
            'title'      => get_setting('site_name', 'Pokemon Calculator Hub') . ' — Free Battle & GO Calculators',
            'meta_desc'  => get_setting('site_description', 'Free, accurate Pokemon calculators for every trainer. Calculate CP, IVs, Stardust, Evolutions, Speed Tiers, and Damage.'),
            'canonical'  => home_url('/'),
            'breadcrumbs'=> [
                'Home' => home_url('/')
            ]
        ];

        View::render('home/index', [
            'tools'      => $tools,
            'seo_data'   => $seoData,
            'body_class' => 'pkm-home-page'
        ]);
    }
}
