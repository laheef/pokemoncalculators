<?php
/**
 * Admin Settings Controller
 * Pokemon Calculator Hub Custom CMS
 */

namespace App\Admin;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Core\Database;

class SettingsController {
    public function index(Request $request): void {
        Auth::requireRole('admin');

        $rows = Database::fetchAll("SELECT * FROM settings ORDER BY setting_group, setting_key");
        $settings = [];
        foreach ($rows as $r) {
            $settings[$r['setting_key']] = $r['setting_value'];
        }

        View::render('admin/settings/index', [
            'title'       => 'Site, SEO, Ads & Header Settings',
            'settings'    => $settings,
            'flashes'     => Auth::getFlashes(),
            'active_menu' => 'settings'
        ], 'admin');
    }

    public function update(Request $request): void {
        Auth::requireRole('admin');

        if (!Auth::verifyCsrf($request->post('_csrf_token'))) {
            Auth::setFlash('error', 'CSRF validation failed.');
            Response::redirect(home_url('admin/settings'));
            return;
        }

        $allFields = [
            // General Identity & Language Mode
            'site_name'                => 'general',
            'site_tagline'             => 'general',
            'site_alternate_names'     => 'general',
            'admin_email'              => 'general',
            'footer_copyright'         => 'general',
            'enable_multilingual'      => 'general',
            
            // Theme Tokens
            'theme_default_mode'       => 'theme',
            'theme_primary_color'      => 'theme',
            'theme_light_bg'           => 'theme',
            'theme_light_text'         => 'theme',
            'theme_dark_bg'            => 'theme',
            'theme_dark_text'          => 'theme',
            
            // SEO Defaults & Schema
            'meta_title_default'       => 'seo',
            'meta_description_default' => 'seo',
            'og_image_default'         => 'seo',
            
            // Custom Header & Footer Code Injection
            'custom_header_code'       => 'custom_code',
            'custom_footer_code'       => 'custom_code',
            
            // Social Media
            'social_twitter'           => 'social',
            'social_discord'           => 'social',
            'social_youtube'           => 'social',
            'social_github'            => 'social',
            
            // Google Ads & Monetization
            'adsense_client_id'        => 'monetization',
            'analytics_id'             => 'monetization',
            'ad_header_code'           => 'monetization',
            'ad_slot_top'              => 'monetization',
            'ad_slot_below_result'     => 'monetization',
            'ad_slot_mid_content'      => 'monetization',
            'ad_slot_mid_faq'          => 'monetization',
            'ad_slot_sky_left'         => 'monetization',
            'ad_slot_sky_right'        => 'monetization',
            'ad_slot_sidebar'          => 'monetization',
            'ad_slot_bottom'           => 'monetization'
        ];

        foreach ($allFields as $key => $group) {
            $val = $request->post($key);
            if ($val !== null) {
                Database::execute("
                    INSERT INTO settings (setting_key, setting_value, setting_group, updated_at) 
                    VALUES (?, ?, ?, NOW()) 
                    ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value), setting_group = VALUES(setting_group), updated_at = NOW()
                ", [$key, trim($val), $group]);
            }
        }

        Auth::setFlash('success', 'Site settings, Google Ads slots, custom header code, and schema configurations saved successfully!');
        Response::redirect(home_url('admin/settings'));
    }
}
