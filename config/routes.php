<?php
/**
 * Route Registrations
 * Pokemon Calculator Hub - Standalone Custom PHP CMS
 */

use App\Core\Router;
use App\Core\Request;
use App\Core\Response;
use App\Pages\HomeController;
use App\Pages\CalculatorsController;
use App\Pages\TypeChartController;
use App\Pages\PageController;
use App\Blog\BlogController as FrontendBlogController;
use App\Core\SitemapController;

// Admin Controllers
use App\Admin\AuthController;
use App\Admin\DashboardController;
use App\Admin\ToolsController;
use App\Admin\PagesController;
use App\Admin\BlogController;
use App\Admin\CategoriesController;
use App\Admin\MediaController;
use App\Admin\SettingsController;
use App\Admin\ContactController;
use App\Admin\UsersController;
use App\Admin\ProfileController;

$router = new Router();

// ==========================================
// 1. PUBLIC FRONTEND MAIN ROUTES
// ==========================================
$router->get('', [HomeController::class, 'index']);
$router->get('calculators', [CalculatorsController::class, 'index']);
$router->get('type-chart', [TypeChartController::class, 'index']);

// Core Pages Routes & Aliases
$router->get('about', function(Request $request) {
    (new PageController())->show($request, ['slug' => 'about-us']);
});
$router->get('about-us', function(Request $request) {
    (new PageController())->show($request, ['slug' => 'about-us']);
});

$router->get('contact', function(Request $request) {
    (new PageController())->show($request, ['slug' => 'contact-us']);
});
$router->get('contact-us', function(Request $request) {
    (new PageController())->show($request, ['slug' => 'contact-us']);
});

$router->get('privacy-policy', function(Request $request) {
    (new PageController())->show($request, ['slug' => 'privacy-policy']);
});

$router->get('cookie-policy', function(Request $request) {
    (new PageController())->show($request, ['slug' => 'cookie-policy']);
});

$router->get('terms-and-conditions', function(Request $request) {
    (new PageController())->show($request, ['slug' => 'terms-and-conditions']);
});

// Blog routes
$router->get('blog', [FrontendBlogController::class, 'index']);
$router->get('blog/{slug}', [FrontendBlogController::class, 'show']);

// Contact form submission POST endpoint
$router->post('contact/submit', [PageController::class, 'submitContact']);
$router->post('contact', [PageController::class, 'submitContact']);

// Direct Registered Tool Slugs
$toolsList = [
    'pokemon-go-cp-calculator',
    'pokemon-go-iv-calculator',
    'pokemon-go-evolution-cp-calculator',
    'stardust-calculator',
    'pokemon-go-stat-calculator',
    'pokemon-go-catch-rate-calculator',
    'pokemon-damage-calculator',
    'speed-tiers'
];

foreach ($toolsList as $toolSlug) {
    $router->get($toolSlug, function(Request $request) use ($toolSlug) {
        $controller = new CalculatorsController();
        $controller->show($request, ['slug' => $toolSlug]);
    });
}

// Tool URL Pattern: /tools/{slug}
$router->get('tools/{slug}', [CalculatorsController::class, 'show']);

// ==========================================
// 2. TECHNICAL SEO & SITEMAP ROUTES
// ==========================================
$router->get('sitemap.xml', [SitemapController::class, 'index']);
$router->get('robots.txt', function(Request $request) {
    header('Content-Type: text/plain; charset=utf-8');
    echo "User-agent: *\nAllow: /\nDisallow: /admin/\nDisallow: /wp-admin/\nDisallow: /api/\n\nSitemap: " . esc_url(home_url('sitemap.xml')) . "\n";
    exit;
});

// ==========================================
// 3. ADMIN PANEL ROUTES
// ==========================================
// Auth
$router->get('admin/login', [AuthController::class, 'loginForm']);
$router->post('admin/login', [AuthController::class, 'login']);
$router->get('admin/logout', [AuthController::class, 'logout']);

// Dashboard
$router->get('admin', [DashboardController::class, 'index']);
$router->get('admin/dashboard', [DashboardController::class, 'index']);

// Tools Manager
$router->get('admin/tools', [ToolsController::class, 'index']);
$router->get('admin/tools/create', [ToolsController::class, 'create']);
$router->post('admin/tools/store', [ToolsController::class, 'store']);
$router->get('admin/tools/edit', [ToolsController::class, 'edit']);
$router->post('admin/tools/update', [ToolsController::class, 'update']);
$router->get('admin/tools/toggle', [ToolsController::class, 'toggle']);
$router->post('admin/tools/delete', [ToolsController::class, 'delete']);

// Pages Manager
$router->get('admin/pages', [PagesController::class, 'index']);
$router->get('admin/pages/create', [PagesController::class, 'create']);
$router->post('admin/pages/store', [PagesController::class, 'store']);
$router->get('admin/pages/edit', [PagesController::class, 'edit']);
$router->post('admin/pages/update', [PagesController::class, 'update']);
$router->post('admin/pages/delete', [PagesController::class, 'delete']);

// Blog Manager
$router->get('admin/blog', [BlogController::class, 'index']);
$router->get('admin/blog/create', [BlogController::class, 'create']);
$router->post('admin/blog/store', [BlogController::class, 'store']);
$router->get('admin/blog/edit', [BlogController::class, 'edit']);
$router->post('admin/blog/update', [BlogController::class, 'update']);
$router->post('admin/blog/delete', [BlogController::class, 'delete']);

// Categories Manager
$router->get('admin/categories', [CategoriesController::class, 'index']);
$router->post('admin/categories/store', [CategoriesController::class, 'store']);
$router->get('admin/categories/edit', [CategoriesController::class, 'edit']);
$router->post('admin/categories/update', [CategoriesController::class, 'update']);
$router->post('admin/categories/delete', [CategoriesController::class, 'delete']);

// Media Library
$router->get('admin/media', [MediaController::class, 'index']);
$router->post('admin/media/upload', [MediaController::class, 'upload']);
$router->post('admin/media/delete', [MediaController::class, 'delete']);

// Users & Team Manager
$router->get('admin/users', [UsersController::class, 'index']);
$router->get('admin/users/create', [UsersController::class, 'create']);
$router->post('admin/users/store', [UsersController::class, 'store']);
$router->get('admin/users/edit', [UsersController::class, 'edit']);
$router->post('admin/users/update', [UsersController::class, 'update']);
$router->post('admin/users/delete', [UsersController::class, 'delete']);

// Profile & Account Settings
$router->get('admin/profile', [ProfileController::class, 'index']);
$router->post('admin/profile/update', [ProfileController::class, 'update']);

// Site & Theme Settings
$router->get('admin/settings', [SettingsController::class, 'index']);
$router->post('admin/settings/update', [SettingsController::class, 'update']);

// Google Indexing API & Search Console URL Inspection
$router->get('admin/indexing', [\App\Admin\IndexingController::class, 'index']);
$router->post('admin/indexing/submit', [\App\Admin\IndexingController::class, 'submit']);
$router->post('admin/indexing/batch-submit', [\App\Admin\IndexingController::class, 'batchSubmit']);
$router->post('admin/indexing/inspect', [\App\Admin\IndexingController::class, 'inspect']);
$router->post('admin/indexing/save-settings', [\App\Admin\IndexingController::class, 'saveSettings']);
$router->post('admin/indexing/clear-logs', [\App\Admin\IndexingController::class, 'clearLogs']);

// Contact Messages Inbox
$router->get('admin/contact', [ContactController::class, 'index']);
$router->get('admin/contact/read', [ContactController::class, 'markRead']);
$router->post('admin/contact/delete', [ContactController::class, 'delete']);

// ==========================================
// 4. LEGACY WORDPRESS 301 REDIRECTS & ALIASES
// ==========================================
$router->redirect('cp-calculator', 'pokemon-go-cp-calculator', 301);
$router->redirect('iv-calculator', 'pokemon-go-iv-calculator', 301);
$router->redirect('evolution-calculator', 'pokemon-go-evolution-cp-calculator', 301);
$router->redirect('damage-calculator', 'pokemon-damage-calculator', 301);
$router->redirect('catch-rate-calculator', 'pokemon-go-catch-rate-calculator', 301);

$router->redirect('privacy', 'privacy-policy', 301);
$router->redirect('cookies', 'cookie-policy', 301);
$router->redirect('terms', 'terms-and-conditions', 301);
$router->redirect('terms-of-service', 'terms-and-conditions', 301);

// ==========================================
// 5. API & AJAX ENDPOINTS
// ==========================================
$router->get('api/pokemon', function(Request $request) {
    $id = $request->get('id');
    $data = get_pokemon_data($id);
    Response::json(['success' => true, 'data' => $data]);
});

$router->post('api/calc/catch-rate', function(Request $request) {
    require_once APP_DIR . '/tools/catch-rate-calculator.php';
    $params = $request->all();
    $result = pkm_calc_catch_rate_core($params);
    Response::json(['success' => true, 'data' => $result]);
});

// WordPress admin-ajax.php fallback emulation
$router->any('wp-admin/admin-ajax.php', function(Request $request) {
    $action = $request->input('action');
    if ($action === 'pkm_get_pokemon_list') {
        $raw = get_pokemon_data();
        $js_data = array_map(function($p) {
            return [
                'id'     => intval($p['id'] ?? 0),
                'name'   => $p['name'] ?? '',
                'types'  => array_values($p['types'] ?? []),
                'sprite' => $p['sprite_default'] ?? '',
            ];
        }, $raw ?: []);
        Response::json(['success' => true, 'data' => $js_data]);
    } elseif ($action === 'pkm_calc_catch_rate') {
        require_once APP_DIR . '/tools/catch-rate-calculator.php';
        $result = pkm_calc_catch_rate_core($request->all());
        Response::json(['success' => true, 'data' => $result]);
    } else {
        Response::json(['success' => false, 'message' => 'Action not found']);
    }
});

return $router;
