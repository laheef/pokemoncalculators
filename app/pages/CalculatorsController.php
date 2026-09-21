<?php
/**
 * Calculators Controller
 * Pokemon Calculator Hub
 */

namespace App\Pages;

use App\Core\Request;
use App\Core\View;
use App\Core\Database;

class CalculatorsController {
    /**
     * Calculators listing hub (/calculators)
     */
    public function index(Request $request): void {
        $tools = Database::fetchAll("
            SELECT t.*, c.name as category_name, c.slug as category_slug
            FROM tools t
            LEFT JOIN categories c ON t.category_id = c.id
            WHERE t.is_active = 1
            ORDER BY t.menu_order ASC
        ");

        $categories = Database::fetchAll("
            SELECT * FROM categories 
            WHERE type = 'tool' 
            ORDER BY menu_order ASC
        ");

        $seoData = [
            'title'      => 'All Pokemon Calculators & Interactive Battle Tools',
            'meta_desc'  => 'Browse our complete suite of free Pokemon GO and competitive calculators: CP, IV, Stardust, Damage, Speed Tiers, and Evolution predictions.',
            'canonical'  => home_url('calculators'),
            'breadcrumbs'=> [
                'Home'        => home_url('/'),
                'Calculators' => home_url('calculators')
            ]
        ];

        View::render('tools/index', [
            'tools'      => $tools,
            'categories' => $categories,
            'seo_data'   => $seoData,
            'body_class' => 'pkm-calculators-hub-page'
        ]);
    }

    /**
     * Show single calculator tool
     */
    public function show(Request $request, array $params): void {
        $slug = $params['slug'] ?? '';
        
        // Match aliases if needed
        $aliasMap = [
            'cp-calculator'         => 'pokemon-go-cp-calculator',
            'iv-calculator'         => 'pokemon-go-iv-calculator',
            'evolution-calculator'  => 'pokemon-go-evolution-cp-calculator',
            'damage-calculator'     => 'pokemon-damage-calculator',
            'catch-rate-calculator' => 'pokemon-go-catch-rate-calculator'
        ];
        if (isset($aliasMap[$slug])) {
            $slug = $aliasMap[$slug];
        }

        $tool = Database::fetchOne("
            SELECT t.*, c.name as category_name, c.slug as category_slug
            FROM tools t
            LEFT JOIN categories c ON t.category_id = c.id
            WHERE t.slug = ? AND t.is_active = 1
        ", [$slug]);

        if (!$tool) {
            http_response_code(404);
            View::render('pages/404', [
                'meta_title' => 'Tool Not Found — 404',
                'meta_desc' => 'The requested calculator tool was not found.'
            ]);
            return;
        }

        // Fetch related tools in same category or general
        $relatedTools = Database::fetchAll("
            SELECT t.*, c.name as category_name 
            FROM tools t
            LEFT JOIN categories c ON t.category_id = c.id
            WHERE t.id != ? AND t.is_active = 1
            ORDER BY (t.category_id = ?) DESC, t.menu_order ASC
            LIMIT 3
        ", [$tool['id'], $tool['category_id'] ?? 0]);

        // Load and execute tool file with global scope propagation
        $toolFilePath = ROOT_DIR . '/' . ltrim($tool['file_path'], '/');
        $toolHtml = '';

        if (file_exists($toolFilePath)) {
            // Ensure global string variables are populated in global scope
            global $pkm_current_lang, $pkm_cp_strings, $pkm_evo_cp_strings, $pkm_go_stat_strings, $pkm_speed_tiers_strings, $pkm_stardust_strings, $pkm_dmg_strings, $pkm_iv_strings;
            $pkm_current_lang = pkm_get_current_lang();
            
            // Require tool file
            require_once $toolFilePath;
            
            // Call appropriate render function based on slug
            switch ($tool['slug']) {
                case 'pokemon-go-cp-calculator':
                    if (function_exists('pkm_cp_calculator_calc')) {
                        $toolHtml = pkm_cp_calculator_calc();
                    }
                    break;
                case 'pokemon-go-iv-calculator':
                    if (function_exists('pkm_iv_calc_shortcode')) {
                        $toolHtml = pkm_iv_calc_shortcode([]);
                    }
                    break;
                case 'pokemon-go-evolution-cp-calculator':
                    if (function_exists('pkm_evolution_cp_calc_shortcode')) {
                        $toolHtml = pkm_evolution_cp_calc_shortcode([]);
                    }
                    break;
                case 'stardust-calculator':
                    if (function_exists('pkm_stardust_calc_shortcode')) {
                        $toolHtml = pkm_stardust_calc_shortcode([]);
                    }
                    break;
                case 'pokemon-go-stat-calculator':
                    if (function_exists('pkm_go_stat_calc_shortcode')) {
                        $toolHtml = pkm_go_stat_calc_shortcode([]);
                    }
                    break;
                case 'pokemon-damage-calculator':
                    if (function_exists('pkm_damage_calculator_shortcode')) {
                        $toolHtml = pkm_damage_calculator_shortcode([]);
                    }
                    break;
                case 'speed-tiers':
                    if (function_exists('pkm_speed_tiers_calc_shortcode')) {
                        $toolHtml = pkm_speed_tiers_calc_shortcode([]);
                    }
                    break;
                case 'pokemon-go-catch-rate-calculator':
                    if (function_exists('pkm_catch_rate_shortcode')) {
                        $toolHtml = pkm_catch_rate_shortcode();
                    }
                    break;
                default:
                    ob_start();
                    include $toolFilePath;
                    $toolHtml = ob_get_clean();
                    break;
            }
        }

        $seoData = [
            'title'       => $tool['meta_title'] ?: $tool['name'],
            'meta_desc'   => $tool['meta_desc'] ?: $tool['short_description'],
            'canonical'   => home_url($tool['slug']),
            'is_tool'     => true,
            'tool'        => $tool,
            'breadcrumbs' => [
                'Home'        => home_url('/'),
                'Calculators' => home_url('calculators'),
                $tool['short_name'] ?: $tool['name'] => home_url($tool['slug'])
            ]
        ];

        View::render('tools/show', [
            'tool'          => $tool,
            'tool_html'     => $toolHtml,
            'related_tools' => $relatedTools,
            'seo_data'      => $seoData,
            'body_class'    => 'pkm-tool-page pkm-tool-' . esc_attr($tool['slug'])
        ]);
    }
}
