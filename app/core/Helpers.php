<?php
/**
 * Global Helpers & Compatibility Functions
 * Pokemon Calculator Hub — Standalone Custom PHP CMS
 */

use App\Core\Database;
use App\Core\I18n;

// Escape HTML
if (!function_exists('esc_html')) {
    function esc_html($text): string {
        return htmlspecialchars((string)($text ?? ''), ENT_QUOTES, 'UTF-8');
    }
}

// Escape Attribute
if (!function_exists('esc_attr')) {
    function esc_attr($text): string {
        return htmlspecialchars((string)($text ?? ''), ENT_QUOTES, 'UTF-8');
    }
}

// Escape URL
if (!function_exists('esc_url')) {
    function esc_url($url): string {
        $url = trim((string)($url ?? ''));
        if ($url === '' || str_starts_with($url, '#')) return $url;
        return filter_var($url, FILTER_SANITIZE_URL) ?: '';
    }
}

// Escape JavaScript string
if (!function_exists('esc_js')) {
    function esc_js($str): string {
        return addslashes((string)($str ?? ''));
    }
}

// Base Home URL
if (!function_exists('home_url')) {
    function home_url(string $path = ''): string {
        $base = BASE_URL;
        $path = ltrim($path, '/');
        return $base . '/' . $path;
    }
}

// Absolute Full URL helper for SEO, Schema.org and OpenGraph
if (!function_exists('pkm_absolute_url')) {
    function pkm_absolute_url(string $path = ''): string {
        $path = ltrim($path, '/');
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'pokemoncalculator.online';
        return $scheme . '://' . $host . '/' . $path;
    }
}

// Site URL
if (!function_exists('site_url')) {
    function site_url(string $path = ''): string {
        return home_url($path);
    }
}

if (!function_exists('get_site_url')) {
    function get_site_url(): string {
        return home_url('/');
    }
}

if (!function_exists('get_stylesheet_directory')) {
    function get_stylesheet_directory(): string {
        return ROOT_DIR;
    }
}

if (!function_exists('get_template_directory')) {
    function get_template_directory(): string {
        return ROOT_DIR;
    }
}

// Admin URL
if (!function_exists('admin_url')) {
    function admin_url(string $path = ''): string {
        return home_url('admin/' . ltrim($path, '/'));
    }
}

// Translation helpers
if (!function_exists('pkm_t')) {
    function pkm_t(string $key, $replacements = []): string {
        if (is_string($replacements)) {
            $default = $replacements;
            $replacements = [];
        } else {
            $default = null;
        }

        $str = I18n::t($key, $default);
        if (is_array($replacements) && !empty($replacements)) {
            foreach ($replacements as $find => $replace) {
                $str = str_replace('%' . $find . '%', (string)$replace, $str);
            }
        }
        return $str;
    }
}

if (!function_exists('pkm_e')) {
    function pkm_e(string $key, array $replacements = []): void {
        echo pkm_t($key, $replacements);
    }
}

if (!function_exists('t')) {
    function t(string $key, ?string $default = null): string {
        return I18n::t($key, $default);
    }
}

// Current language code
if (!function_exists('pkm_get_current_lang')) {
    function pkm_get_current_lang(): string {
        return I18n::getCurrentLang();
    }
}

// Type Chart URL helper
if (!function_exists('pkm_get_type_chart_url')) {
    function pkm_get_type_chart_url(): string {
        return home_url('type-chart');
    }
}

// Language URL helper
if (!function_exists('pkm_get_lang_url')) {
    function pkm_get_lang_url(?string $lang = null, ?string $path = null): string {
        if (!$lang) $lang = I18n::getCurrentLang();
        if ($path === null) {
            $path = trim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), '/');
        } else {
            $path = trim($path, '/');
        }
        
        $parts = explode('/', $path);
        if (in_array($parts[0] ?? '', ['en', 'es', 'pt-br', 'fr', 'de'])) {
            array_shift($parts);
        }
        $cleanPath = implode('/', $parts);

        if ($lang === 'en') {
            return home_url($cleanPath ? $cleanPath : '');
        }
        return home_url($lang . '/' . ($cleanPath ? $cleanPath : ''));
    }
}

// Check if Multilingual mode is enabled
if (!function_exists('pkm_is_multilingual_enabled')) {
    function pkm_is_multilingual_enabled(): bool {
        return I18n::isMultilingualEnabled();
    }
}

// Render Language Switcher Component
if (!function_exists('pkm_render_language_switcher')) {
    function pkm_render_language_switcher(string $class = ''): string {
        if (!pkm_is_multilingual_enabled()) {
            return '';
        }

        $current = I18n::getCurrentLang();
        $languages = I18n::getSupportedLanguages();
        $currentInfo = $languages[$current] ?? $languages['en'];

        $html = '<div class="pkm-lang-switcher ' . esc_attr($class) . '" id="pkmLangSwitcher">';
        $html .= '<button class="pkm-lang-btn" id="pkmLangBtn" type="button" aria-haspopup="true" aria-expanded="false" aria-label="' . esc_attr(pkm_t('lang_switcher_label', 'Select Language')) . '">';
        $html .= '<span class="pkm-lang-flag">' . $currentInfo['flag'] . '</span> ';
        $html .= '<span class="pkm-lang-code">' . strtoupper($current) . '</span> ';
        $html .= '<span class="pkm-lang-arrow">▼</span>';
        $html .= '</button>';
        
        $html .= '<div class="pkm-lang-dropdown" id="pkmLangDropdown" role="menu">';
        foreach ($languages as $code => $lang) {
            $isActive = ($code === $current) ? 'active' : '';
            $url = pkm_get_lang_url($code);
            $html .= '<a href="' . esc_url($url) . '" class="pkm-lang-option ' . $isActive . '" role="menuitem" hreflang="' . esc_attr($code) . '">';
            $html .= '<span class="pkm-lang-flag">' . $lang['flag'] . '</span> ';
            $html .= '<span class="pkm-lang-name">' . esc_html($lang['native_name']) . '</span>';
            if ($isActive) {
                $html .= ' <span class="pkm-lang-check">✓</span>';
            }
            $html .= '</a>';
        }
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }
}

if (!function_exists('pkm_format_bytes')) {
    function pkm_format_bytes($bytes, $precision = 1): string {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max(intval($bytes), 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}

// Get Setting from Database (with caching)
if (!function_exists('get_setting')) {
    function get_setting(string $key, $default = null) {
        static $settings = null;
        if ($settings === null) {
            try {
                $rows = Database::fetchAll("SELECT setting_key, setting_value FROM settings");
                $settings = [];
                foreach ($rows as $r) {
                    $settings[$r['setting_key']] = $r['setting_value'];
                }
            } catch (Exception $e) {
                $settings = [];
            }
        }
        return $settings[$key] ?? $default;
    }
}

if (!function_exists('pkm_get_setting')) {
    function pkm_get_setting(string $key, $default = null) {
        return get_setting($key, $default);
    }
}

// Get Theme Mod replacement
if (!function_exists('get_theme_mod')) {
    function get_theme_mod(string $name, $default = false) {
        return get_setting($name, $default);
    }
}

// Load Pokémon Data (Robust Multi-Path Fallback Resolution)
if (!function_exists('get_pokemon_data')) {
    function get_pokemon_data($id = null) {
        static $data = null;
        if ($data === null) {
            $candidates = [
                defined('DATA_DIR') ? DATA_DIR . '/pkm-pokemon-data.json' : null,
                defined('ROOT_DIR') ? ROOT_DIR . '/data/pkm-pokemon-data.json' : null,
                defined('ROOT_DIR') ? ROOT_DIR . '/pkm-data/pkm-pokemon-data.json' : null,
                defined('PUBLIC_DIR') ? PUBLIC_DIR . '/data/pkm-pokemon-data.json' : null,
                dirname(__DIR__, 2) . '/data/pkm-pokemon-data.json',
                dirname(__DIR__, 2) . '/pkm-data/pkm-pokemon-data.json',
                dirname(__DIR__, 1) . '/data/pkm-pokemon-data.json',
                dirname(__DIR__, 1) . '/pkm-data/pkm-pokemon-data.json',
                ($_SERVER['DOCUMENT_ROOT'] ?? '') . '/data/pkm-pokemon-data.json',
                ($_SERVER['DOCUMENT_ROOT'] ?? '') . '/pkm-data/pkm-pokemon-data.json',
                ($_SERVER['DOCUMENT_ROOT'] ?? '') . '/../data/pkm-pokemon-data.json',
                ($_SERVER['DOCUMENT_ROOT'] ?? '') . '/../pkm-data/pkm-pokemon-data.json',
                __DIR__ . '/../../pkm-data/pkm-pokemon-data.json',
                __DIR__ . '/../../data/pkm-pokemon-data.json',
            ];

            $foundPath = null;
            foreach ($candidates as $cand) {
                if ($cand && @file_exists($cand) && @is_readable($cand) && @filesize($cand) > 1000) {
                    $foundPath = $cand;
                    break;
                }
            }

            if ($foundPath) {
                $raw = @file_get_contents($foundPath);
                $data = $raw ? json_decode($raw, true) : [];
                if (!is_array($data)) {
                    $data = [];
                }
            } else {
                $data = [];
            }
        }

        if ($id !== null) {
            if (empty($data)) return null;
            foreach ($data as $p) {
                if (($p['id'] ?? 0) == $id || (isset($p['name']) && strcasecmp((string)$p['name'], (string)$id) === 0)) {
                    return $p;
                }
            }
            return null;
        }

        return $data;
    }
}

// Sanitize text field
if (!function_exists('sanitize_text_field')) {
    function sanitize_text_field($str): string {
        return trim(strip_tags((string)($str ?? '')));
    }
}

// Generate CSRF token / nonce
if (!function_exists('csrf_token')) {
    function csrf_token(): string {
        if (empty($_SESSION['_csrf_token'])) {
            $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['_csrf_token'];
    }
}

if (!function_exists('wp_create_nonce')) {
    function wp_create_nonce(string $action = ''): string {
        return csrf_token();
    }
}

if (!function_exists('check_ajax_referer')) {
    function check_ajax_referer(string $action = '', string $query_arg = 'nonce'): bool {
        $token = $_REQUEST[$query_arg] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
        return !empty($token) && hash_equals($_SESSION['_csrf_token'] ?? '', $token);
    }
}

// SVG Logo Generator
if (!function_exists('pkm_get_logo_svg')) {
    function pkm_get_logo_svg(string $class = ''): string {
        $site_name = pkm_t('site_name', 'Pokemon Calculator');
        $svg  = '<svg class="pkm-logo-svg ' . esc_attr($class) . '" viewBox="0 0 250 44" xmlns="http://www.w3.org/2000/svg" aria-label="' . esc_attr($site_name) . '" role="img">';
        $svg .= '<g class="pkm-logo-mark">';
        $svg .= '<circle cx="22" cy="22" r="20" fill="var(--pkm-primary)"/>';
        $svg .= '<path d="M2,22 A20,20 0 0,0 42,22 Z" fill="rgba(255,255,255,0.92)"/>';
        $svg .= '<rect x="2" y="20" width="40" height="4" fill="#1A1F2E" rx="2"/>';
        $svg .= '<circle cx="22" cy="22" r="7" fill="#FFFFFF" stroke="#1A1F2E" stroke-width="2"/>';
        $svg .= '<circle cx="22" cy="22" r="4.8" fill="none" stroke="#1A1F2E" stroke-width="1" opacity="0.3"/>';
        $svg .= '<circle cx="22" cy="22" r="3" fill="#1A1F2E"/>';
        $svg .= '<circle cx="22" cy="22" r="1.3" fill="#FFFFFF" opacity="0.55"/>';
        $svg .= '</g>';
        $svg .= '<text x="50" y="28" font-family="Exo 2, sans-serif" font-size="16" font-weight="800" fill="var(--pkm-text)">' . esc_html($site_name) . '</text>';
        $svg .= '</svg>';
        return $svg;
    }
}

// Favicon Data URL
if (!function_exists('pkm_get_favicon_url')) {
    function pkm_get_favicon_url(): string {
        $f  = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">';
        $f .= '<circle cx="16" cy="16" r="15" fill="#0D9488"/>';
        $f .= '<path d="M1,16 A15,15 0 0,0 31,16 Z" fill="#F8F9FA"/>';
        $f .= '<rect x="1" y="14.5" width="30" height="3" fill="#1A1F2E" rx="1.5"/>';
        $f .= '<circle cx="16" cy="16" r="5.5" fill="#FFFFFF" stroke="#1A1F2E" stroke-width="1.5"/>';
        $f .= '<circle cx="16" cy="16" r="3.8" fill="none" stroke="#1A1F2E" stroke-width="0.8" opacity="0.4"/>';
        $f .= '<circle cx="16" cy="16" r="2.2" fill="#1A1F2E"/>';
        $f .= '<circle cx="16" cy="16" r="1" fill="#FFFFFF" opacity="0.55"/>';
        $f .= '</svg>';
        return 'data:image/svg+xml;base64,' . base64_encode($f);
    }
}

// JSON Output helpers
if (!function_exists('wp_send_json_success')) {
    function wp_send_json_success($data = null): void {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['success' => true, 'data' => $data]);
        exit;
    }
}

if (!function_exists('wp_send_json_error')) {
    function wp_send_json_error($data = null): void {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['success' => false, 'data' => $data]);
        exit;
    }
}

if (!function_exists('wp_json_encode')) {
    function wp_json_encode($data, $options = 0, $depth = 512): string {
        return (string)json_encode($data, $options, $depth);
    }
}

// Render Tool SVG Icon Helper
if (!function_exists('pkm_render_tool_icon')) {
    function pkm_render_tool_icon(string $svg, string $fallback = ''): string {
        $svg = trim($svg);
        if ($svg && str_starts_with($svg, '<svg')) {
            return $svg;
        }
        return $fallback ?: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>';
    }
}

if (!function_exists('pkm_default_tool_svg_icon')) {
    function pkm_default_tool_svg_icon(): string {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>';
    }
}

// WordPress compatibility stub for do_shortcode
if (!function_exists('do_shortcode')) {
    function do_shortcode($content) {
        return is_string($content) ? $content : '';
    }
}

// Ad Slot Helper - Smart conditional rendering for Google Ads & custom ad units
if (!function_exists('pkm_render_ad')) {
    function pkm_render_ad(string $slot = 'A', string $extra_class = ''): string {
        $code = trim($slot);

        // Map class or identifier keywords to setting keys
        $slotMap = [
            'pkm-ad-top'           => 'ad_slot_top',
            'top'                  => 'ad_slot_top',
            'pkm-ad-result'        => 'ad_slot_below_result',
            'pkm-ad-below-result'  => 'ad_slot_below_result',
            'below'                => 'ad_slot_below_result',
            'pkm-ad-mid'           => 'ad_slot_mid_content',
            'pkm-ad-mid-content'   => 'ad_slot_mid_content',
            'pkm-ad-content'       => 'ad_slot_mid_content',
            'mid'                  => 'ad_slot_mid_content',
            'pkm-ad-faq'           => 'ad_slot_mid_faq',
            'pkm-ad-mid-faq'       => 'ad_slot_mid_faq',
            'pkm-ad-below-faq'     => 'ad_slot_mid_faq',
            'pkm-ad-sidebar'       => 'ad_slot_sidebar',
            'sidebar'              => 'ad_slot_sidebar',
            'pkm-ad-sky'           => 'ad_slot_sidebar',
            'pkm-ad-sky-l'         => 'ad_slot_sky_left',
            'pkm-ad-sky-r'         => 'ad_slot_sky_right',
            'pkm-ad-skyscraper-left'  => 'ad_slot_sky_left',
            'pkm-ad-skyscraper-right' => 'ad_slot_sky_right',
            'pkm-skyscraper-left'     => 'ad_slot_sky_left',
            'pkm-skyscraper-right'    => 'ad_slot_sky_right',
            'pkm-ad-bottom'        => 'ad_slot_bottom',
            'bottom'               => 'ad_slot_bottom',
        ];

        // Check if raw argument is a known slot identifier
        if (isset($slotMap[$code])) {
            $code = get_setting($slotMap[$code], '');
        } elseif (empty($code) || strlen($code) <= 2) {
            // Check extra_class for known slot names
            foreach ($slotMap as $cls => $settingKey) {
                if (str_contains($extra_class, $cls)) {
                    $code = get_setting($settingKey, '');
                    break;
                }
            }
        }

        // If still empty and it's a top/header slot, check ad_header_code fallback
        if (empty($code) && (str_contains($extra_class, 'pkm-ad-top') || str_contains($extra_class, 'top'))) {
            $code = get_setting('ad_header_code', '');
        }

        // Only show ad container if code is actually configured and available
        if (empty(trim($code))) {
            return '';
        }

        $cleanClass = trim('pkm-calc-ad-block ' . $extra_class);
        return '<div class="' . esc_attr($cleanClass) . '">' . $code . '</div>';
    }
}

// Popular Tools Section on Homepage
if (!function_exists('pkm_render_popular_tools_section')) {
    function pkm_render_popular_tools_section($lang = null): void {
        $tools = Database::fetchAll("
            SELECT t.*, c.name as category_name, c.slug as category_slug
            FROM tools t
            LEFT JOIN categories c ON t.category_id = c.id
            WHERE t.is_active = 1
            ORDER BY t.menu_order ASC
            LIMIT 8
        ");
        ?>
        <section class="pkm-all-tools" aria-labelledby="popular-tools-title">
            <div class="pkm-section-title">
                <h2 id="popular-tools-title"><?= esc_html(pkm_t('popular_title', 'Most Popular Calculators')) ?></h2>
                <p><?= esc_html(pkm_t('popular_subtitle', 'Trusted by millions of trainers worldwide')) ?></p>
            </div>
            <div class="pkm-tools-grid" id="pkm-tools-grid">
                <?php 
                $count = 0;
                foreach ($tools as $t): 
                    $count++;
                    $isFirst = ($count === 1);
                ?>
                    <a href="<?= esc_url(home_url($t['slug'])) ?>"
                       class="pkm-tool-card <?= $isFirst ? 'pkm-tool-top1' : '' ?>"
                       data-cat="<?= esc_attr($t['category_slug'] ?? 'general') ?>"
                       aria-label="<?= esc_attr($t['short_name'] ?: $t['name']) ?>">
                        <div class="pkm-tool-cat-stripe"></div>
                        <div class="pkm-tool-top-row">
                            <div class="pkm-tool-icon"><?= pkm_render_tool_icon($t['icon_svg'] ?? '') ?></div>
                            <?php if (!empty($t['category_name'])): ?>
                                <span class="pkm-tool-cat-badge" style="--cat-bg:var(--pkm-primary);--cat-text:#fff">
                                    <?= esc_html($t['category_name']) ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <?php if ($isFirst): ?>
                            <div class="pkm-tool-rank-badge">
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg> #1
                            </div>
                        <?php endif; ?>
                        <h3><?= esc_html($t['short_name'] ?: $t['name']) ?></h3>
                        <p><?= esc_html($t['short_description'] ?? '') ?></p>
                        <div class="pkm-tool-footer">
                            <span class="pkm-tool-link-text"><?= esc_html(pkm_t('hero_cta_primary', 'Use Calculator')) ?> &rarr;</span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="pkm-view-all-wrap" style="text-align:center; margin-top:36px;">
                <a href="<?= esc_url(home_url('calculators')) ?>" class="pkm-btn pkm-btn-primary" style="display:inline-flex; align-items:center; gap:8px;">
                    <?= esc_html(pkm_t('nav_all_tools', 'Explore All Calculators')) ?> &rarr;
                </a>
            </div>
        </section>
        <?php
    }
}

// WordPress WP_Query Polyfill
if (!class_exists('WP_Query')) {
    class WP_Query {
        public array $posts = [];
        public int $post_count = 0;
        public int $current_post = -1;
        public $post = null;
        
        public function __construct($args = []) {
            try {
                $tools = Database::fetchAll("SELECT * FROM tools WHERE is_active = 1 ORDER BY menu_order ASC LIMIT 6");
                foreach ($tools as $t) {
                    $obj = new stdClass();
                    $obj->ID = $t['id'];
                    $obj->post_title = $t['name'];
                    $obj->post_name = $t['slug'];
                    $obj->post_excerpt = $t['short_description'];
                    $this->posts[] = $obj;
                }
            } catch (Exception $e) {
                $this->posts = [];
            }
            $this->post_count = count($this->posts);
        }
        
        public function have_posts(): bool {
            if ($this->current_post + 1 < $this->post_count) {
                return true;
            }
            return false;
        }

        public function the_post(): void {
            $this->current_post++;
            $this->post = $this->posts[$this->current_post] ?? null;
            $GLOBALS['post'] = $this->post;
        }

        public function rewind_posts(): void {
            $this->current_post = -1;
            $this->post = null;
        }
    }
}

// ACF get_field Polyfill
if (!function_exists('get_field')) {
    function get_field(string $selector, $post_id = false, $format_value = true) {
        if ($post_id) {
            $tool = Database::fetchOne("SELECT * FROM tools WHERE id = ?", [$post_id]);
            if ($tool) {
                if ($selector === 'tool_short_name') return $tool['short_name'];
                if ($selector === 'tool_one_line_description') return $tool['short_description'];
                if ($selector === 'tool_svg_icon_text') return $tool['icon_svg'];
            }
        }
        return '';
    }
}

// WordPress Polyfills
if (!function_exists('add_shortcode')) {
    function add_shortcode($tag, $callback) {}
}

if (!function_exists('add_action')) {
    function add_action($hook, $callback, $priority = 10, $accepted_args = 1) {}
}

if (!function_exists('add_filter')) {
    function add_filter($hook, $callback, $priority = 10, $accepted_args = 1) {}
}

if (!function_exists('has_action')) {
    function has_action($tag, $callback = false): bool { return false; }
}

if (!function_exists('has_filter')) {
    function has_filter($tag, $callback = false): bool { return false; }
}

if (!function_exists('wp_get_post_parent_id')) {
    function wp_get_post_parent_id($post_id = 0): int { return 0; }
}

if (!function_exists('get_queried_object_id')) {
    function get_queried_object_id(): int { return 0; }
}

if (!function_exists('get_page_by_path')) {
    function get_page_by_path($path, $output = 'OBJECT', $post_type = 'page') {
        $slug = basename(trim($path, '/'));
        try {
            $tool = Database::fetchOne("SELECT * FROM tools WHERE slug = ?", [$slug]);
            if ($tool) {
                $obj = new stdClass();
                $obj->ID = $tool['id'];
                $obj->post_title = $tool['name'];
                $obj->post_name = $tool['slug'];
                return $obj;
            }
        } catch (Exception $e) {}
        return null;
    }
}

if (!function_exists('get_pages')) {
    function get_pages($args = []): array {
        try {
            $tools = Database::fetchAll("SELECT * FROM tools WHERE is_active = 1 ORDER BY menu_order ASC");
            $objs = [];
            foreach ($tools as $t) {
                $obj = new stdClass();
                $obj->ID = $t['id'];
                $obj->post_title = $t['name'];
                $obj->post_name = $t['slug'];
                $objs[] = $obj;
            }
            return $objs;
        } catch (Exception $e) {
            return [];
        }
    }
}

if (!function_exists('wp_strip_all_tags')) {
    function wp_strip_all_tags($string, $remove_breaks = false): string {
        $string = preg_replace('@<(script|style)[^>]*?>.*?</\\1>@si', '', (string)$string);
        $string = strip_tags($string);
        if ($remove_breaks) {
            $string = preg_replace('/[\r\n\t ]+/', ' ', $string);
        }
        return trim($string);
    }
}

if (!function_exists('wp_trim_words')) {
    function wp_trim_words($text, $num_words = 55, $more = null): string {
        if ($more === null) $more = '&hellip;';
        $words = preg_split("/[\n\r\t ]+/", (string)$text, $num_words + 1, PREG_SPLIT_NO_EMPTY);
        if (count($words) > $num_words) {
            array_pop($words);
            $text = implode(' ', $words) . $more;
        } else {
            $text = implode(' ', $words);
        }
        return $text;
    }
}

if (!function_exists('wp_kses')) {
    function wp_kses($string, $allowed_html = []): string {
        return (string)$string;
    }
}

if (!function_exists('wp_kses_post')) {
    function wp_kses_post($string): string {
        return (string)$string;
    }
}

if (!function_exists('wp_reset_postdata')) {
    function wp_reset_postdata(): void {}
}

if (!function_exists('get_the_ID')) {
    function get_the_ID() { return 0; }
}

if (!function_exists('get_the_title')) {
    function get_the_title($id = 0): string { return ''; }
}

if (!function_exists('get_the_excerpt')) {
    function get_the_excerpt($id = 0): string { return ''; }
}

if (!function_exists('get_permalink')) {
    function get_permalink($id = 0): string { return home_url('/'); }
}

if (!function_exists('is_page')) {
    function is_page($page = ''): bool { return false; }
}

if (!function_exists('has_nav_menu')) {
    function has_nav_menu($location): bool { return false; }
}

if (!function_exists('wp_nav_menu')) {
    function wp_nav_menu($args = []) { return ''; }
}

if (!function_exists('get_the_category')) {
    function get_the_category($id = 0): array { return []; }
}

if (!function_exists('get_the_date')) {
    function get_the_date($format = 'F j, Y', $id = 0): string { return date($format); }
}

if (!function_exists('get_the_post_thumbnail')) {
    function get_the_post_thumbnail($id = 0, $size = '', $attr = ''): string { return ''; }
}

if (!function_exists('get_the_post_thumbnail_url')) {
    function get_the_post_thumbnail_url($id = 0, $size = ''): string { return ''; }
}

if (!function_exists('has_post_thumbnail')) {
    function has_post_thumbnail($id = 0): bool { return false; }
}

if (!function_exists('get_posts')) {
    function get_posts($args = []): array {
        try {
            return Database::fetchAll("SELECT * FROM posts WHERE status = 'published' ORDER BY published_at DESC LIMIT 3");
        } catch (Exception $e) {
            return [];
        }
    }
}
