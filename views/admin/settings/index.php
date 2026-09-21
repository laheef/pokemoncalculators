<?php
/**
 * Admin Site Settings View
 * Pokemon Calculator Hub Custom CMS
 */
?>

<div class="pkm-admin-header">
    <div>
        <h1 class="pkm-admin-title">Site & Theme Settings</h1>
        <p class="pkm-admin-subtitle">Configure Google Ads, Custom Header Scripts, Google Search Site Name Schema, and Color Tokens.</p>
    </div>
</div>

<form method="POST" action="<?= esc_url(home_url('admin/settings/update')) ?>">
    <?= \App\Admin\Auth::csrfInput() ?>

    <div class="pkm-tabs-nav">
        <button type="button" class="pkm-tab-btn active" data-tab="tab-general">General Identity</button>
        <button type="button" class="pkm-tab-btn" data-tab="tab-header-code">Custom Header Code</button>
        <button type="button" class="pkm-tab-btn" data-tab="tab-ads">Google Ads & Monetization</button>
        <button type="button" class="pkm-tab-btn" data-tab="tab-seo">SEO & Site Name Schema</button>
        <button type="button" class="pkm-tab-btn" data-tab="tab-theme">Theme & Color Tokens</button>
        <button type="button" class="pkm-tab-btn" data-tab="tab-social">Social Links</button>
    </div>

    <!-- TAB 1: GENERAL IDENTITY -->
    <div id="tab-general" class="pkm-tab-pane pkm-card" style="display:block;">
        <div class="pkm-card-header">
            <h2 class="pkm-card-title">General Site Configuration</h2>
        </div>

        <div class="pkm-form-row">
            <div class="pkm-form-group">
                <label class="pkm-form-label" for="site_name">Official Website Name</label>
                <input type="text" id="site_name" name="site_name" class="pkm-form-control"
                       value="<?= esc_attr($settings['site_name'] ?? 'Pokemon Calculator Hub') ?>" required>
                <span class="pkm-form-help">Appears in site header, Google Search title, and WebSite schema.</span>
            </div>
            <div class="pkm-form-group">
                <label class="pkm-form-label" for="site_tagline">Tagline</label>
                <input type="text" id="site_tagline" name="site_tagline" class="pkm-form-control"
                       value="<?= esc_attr($settings['site_tagline'] ?? 'Pokemon GO & Competitive Calculators') ?>">
            </div>
        </div>

        <div class="pkm-form-group">
            <label class="pkm-form-label" for="site_alternate_names">Alternate Site Names (for Google Search Console & SERP)</label>
            <input type="text" id="site_alternate_names" name="site_alternate_names" class="pkm-form-control"
                   value="<?= esc_attr($settings['site_alternate_names'] ?? 'Pokémon Calculator Hub, PokemonCalculators, PKM Calc Hub') ?>">
            <span class="pkm-form-help">Comma-separated alternative names for Google Search `WebSite.alternateName` schema. Helps Google accurately display your brand name in search results.</span>
        </div>

        <div class="pkm-form-row">
            <div class="pkm-form-group">
                <label class="pkm-form-label" for="admin_email">Contact & Admin Email</label>
                <input type="email" id="admin_email" name="admin_email" class="pkm-form-control"
                       value="<?= esc_attr($settings['admin_email'] ?? 'admin@pokemoncalculators.test') ?>">
            </div>
            <div class="pkm-form-group">
                <label class="pkm-form-label" for="footer_copyright">Footer Copyright Text</label>
                <input type="text" id="footer_copyright" name="footer_copyright" class="pkm-form-control"
                       value="<?= esc_attr($settings['footer_copyright'] ?? '© 2026 Pokemon Calculator Hub. Pokemon and Pokemon character names are trademarks of Nintendo.') ?>">
            </div>
        </div>

        <!-- Language Mode Configuration -->
        <div class="pkm-form-group" style="background:var(--pkm-bg-3); padding:20px; border-radius:var(--pkm-radius); border:1px solid var(--pkm-border); margin-top:20px;">
            <label class="pkm-form-label" style="font-size:1.05rem; font-weight:700; margin-bottom:8px; color:var(--pkm-text);">🌐 Website Language Mode (Multilingual vs English Only)</label>
            <p style="font-size:0.875rem; color:var(--pkm-text-muted); margin-bottom:16px; line-height:1.5;">
                Choose whether your website operates as a full multilingual portal (with language switcher, localized paths, and flag navigation) or as a clean English-only site.
            </p>
            
            <div style="display:flex; flex-direction:column; gap:12px;">
                <label style="display:flex; align-items:flex-start; gap:12px; cursor:pointer; background:var(--pkm-bg-2); padding:14px 16px; border-radius:var(--pkm-radius-sm); border:1px solid var(--pkm-border);">
                    <input type="radio" name="enable_multilingual" value="1" <?= (($settings['enable_multilingual'] ?? '1') !== '0') ? 'checked' : '' ?> style="margin-top:3px;">
                    <div>
                        <strong style="color:var(--pkm-text); font-size:0.95rem;">🌐 Multilingual Enabled (English, Spanish, Portuguese, French, German)</strong>
                        <div style="font-size:0.85rem; color:var(--pkm-text-muted); margin-top:3px;">
                            Shows language switcher dropdown in header, language selector flags in mobile menu, supports <code>/es/</code>, <code>/pt-br/</code>, <code>/fr/</code>, <code>/de/</code> prefixes, and includes alternate hreflang tags for international SEO.
                        </div>
                    </div>
                </label>

                <label style="display:flex; align-items:flex-start; gap:12px; cursor:pointer; background:var(--pkm-bg-2); padding:14px 16px; border-radius:var(--pkm-radius-sm); border:1px solid var(--pkm-border);">
                    <input type="radio" name="enable_multilingual" value="0" <?= (($settings['enable_multilingual'] ?? '1') === '0') ? 'checked' : '' ?> style="margin-top:3px;">
                    <div>
                        <strong style="color:var(--pkm-text); font-size:0.95rem;">🇺🇸 English Only (Single-Language Mode)</strong>
                        <div style="font-size:0.85rem; color:var(--pkm-text-muted); margin-top:3px;">
                            Completely hides and disables the language switcher dropdown, hides all translation flags from the mobile drawer, suppresses alternate language links, and runs purely in English.
                        </div>
                    </div>
                </label>
            </div>
        </div>
    </div>

    <!-- TAB 2: CUSTOM HEADER & FOOTER CODE -->
    <div id="tab-header-code" class="pkm-tab-pane pkm-card" style="display:none;">
        <div class="pkm-card-header">
            <h2 class="pkm-card-title">Custom Header & Footer Code Injection</h2>
        </div>

        <div style="background:var(--pkm-bg-3); border:1px solid var(--pkm-border); border-left:4px solid var(--pkm-primary); padding:14px 16px; border-radius:var(--pkm-radius-sm); margin-bottom:20px; font-size:0.9rem; line-height:1.5;">
            <strong>Header Code Instructions:</strong> Paste any custom HTML tags, tracking scripts, Google Tag Manager &lt;head&gt; snippets, Meta verification tags, or custom CSS into the field below. Code will be injected directly inside the document <code>&lt;head&gt;...&lt;/head&gt;</code> on every frontend page.
        </div>

        <div class="pkm-form-group">
            <label class="pkm-form-label" for="custom_header_code">
                Custom Header Code (<code>&lt;head&gt;</code>)
            </label>
            <textarea id="custom_header_code" name="custom_header_code" class="pkm-form-control" style="min-height:160px; font-family:monospace; font-size:0.85rem;"
                      placeholder="<!-- Paste your custom <head> scripts, meta tags, or Google Tag Manager code here -->"><?= esc_html($settings['custom_header_code'] ?? $settings['header_code'] ?? '') ?></textarea>
            <span class="pkm-form-help">Injected synchronously in <code>&lt;head&gt;</code> before stylesheets and body render.</span>
        </div>

        <div class="pkm-form-group" style="margin-top:20px;">
            <label class="pkm-form-label" for="custom_footer_code">
                Custom Footer / Body End Code (<code>&lt;/body&gt;</code>)
            </label>
            <textarea id="custom_footer_code" name="custom_footer_code" class="pkm-form-control" style="min-height:120px; font-family:monospace; font-size:0.85rem;"
                      placeholder="<!-- Paste custom tracking scripts, conversion pixels, or chat widgets to run before </body> -->"><?= esc_html($settings['custom_footer_code'] ?? $settings['footer_code'] ?? '') ?></textarea>
            <span class="pkm-form-help">Injected just before closing <code>&lt;/body&gt;</code> tag for non-blocking analytics and pixels.</span>
        </div>
    </div>

    <!-- TAB 3: GOOGLE ADS & MONETIZATION -->
    <div id="tab-ads" class="pkm-tab-pane pkm-card" style="display:none;">
        <div class="pkm-card-header">
            <h2 class="pkm-card-title">Google AdSense & Ad Unit Configuration</h2>
        </div>

        <div style="background:var(--pkm-bg-3); border:1px solid var(--pkm-border); border-left:4px solid #F59E0B; padding:14px 16px; border-radius:var(--pkm-radius-sm); margin-bottom:20px; font-size:0.9rem; line-height:1.5;">
            <strong>Conditional Ad Display:</strong> Ad slot containers only render on frontend pages when ad code is provided in the fields below. If an ad slot is left blank, no empty boxes or layout gaps are displayed.
        </div>

        <div class="pkm-form-row">
            <div class="pkm-form-group">
                <label class="pkm-form-label" for="adsense_client_id">Google AdSense Publisher ID</label>
                <input type="text" id="adsense_client_id" name="adsense_client_id" class="pkm-form-control"
                       value="<?= esc_attr($settings['adsense_client_id'] ?? '') ?>" placeholder="ca-pub-1234567890123456">
                <span class="pkm-form-help">Automatically loads official Google AdSense script in <code>&lt;head&gt;</code> when filled.</span>
            </div>
            <div class="pkm-form-group">
                <label class="pkm-form-label" for="analytics_id">Google Analytics 4 / GTM ID</label>
                <input type="text" id="analytics_id" name="analytics_id" class="pkm-form-control"
                       value="<?= esc_attr($settings['analytics_id'] ?? '') ?>" placeholder="G-XXXXXXXXXX">
                <span class="pkm-form-help">Loads gtag.js measurement tag.</span>
            </div>
        </div>

        <h3 style="font-size:1.05rem; font-weight:700; margin:24px 0 12px; color:var(--pkm-text);">Individual Ad Unit Slots</h3>

        <div class="pkm-form-group">
            <label class="pkm-form-label" for="ad_slot_top">Top / Header Banner Unit (Above Calculator)</label>
            <textarea id="ad_slot_top" name="ad_slot_top" class="pkm-form-control" style="min-height:80px; font-family:monospace; font-size:0.85rem;"
                      placeholder="<!-- Paste Top Leaderboard 728x90 or Responsive AdSense <ins> code -->"><?= esc_html($settings['ad_slot_top'] ?? $settings['ad_header_code'] ?? '') ?></textarea>
        </div>

        <div class="pkm-form-group">
            <label class="pkm-form-label" for="ad_slot_below_result">Below Calculator Result Card</label>
            <textarea id="ad_slot_below_result" name="ad_slot_below_result" class="pkm-form-control" style="min-height:80px; font-family:monospace; font-size:0.85rem;"
                      placeholder="<!-- Paste High-CTR In-Article / Display Ad code -->"><?= esc_html($settings['ad_slot_below_result'] ?? '') ?></textarea>
        </div>

        <div class="pkm-form-group">
            <label class="pkm-form-label" for="ad_slot_mid_content">Mid-Content / Article Break Unit</label>
            <textarea id="ad_slot_mid_content" name="ad_slot_mid_content" class="pkm-form-control" style="min-height:80px; font-family:monospace; font-size:0.85rem;"
                      placeholder="<!-- Paste In-Article Fluid Ad Code -->"><?= esc_html($settings['ad_slot_mid_content'] ?? '') ?></textarea>
        </div>

        <div class="pkm-form-group">
            <label class="pkm-form-label" for="ad_slot_mid_faq">FAQ Section Ad Unit</label>
            <textarea id="ad_slot_mid_faq" name="ad_slot_mid_faq" class="pkm-form-control" style="min-height:80px; font-family:monospace; font-size:0.85rem;"
                      placeholder="<!-- Paste FAQ Ad Code -->"><?= esc_html($settings['ad_slot_mid_faq'] ?? '') ?></textarea>
        </div>

        <div class="pkm-form-row">
            <div class="pkm-form-group">
                <label class="pkm-form-label" for="ad_slot_sky_left">Left Skyscraper Unit (160x600 / 120x600)</label>
                <textarea id="ad_slot_sky_left" name="ad_slot_sky_left" class="pkm-form-control" style="min-height:80px; font-family:monospace; font-size:0.85rem;"
                          placeholder="<!-- Paste Left Sticky Skyscraper 160x600 Code -->"><?= esc_html($settings['ad_slot_sky_left'] ?? '') ?></textarea>
                <span class="pkm-form-help">Sticky desktop banner flanking the left side of pages on wide screens.</span>
            </div>
            <div class="pkm-form-group">
                <label class="pkm-form-label" for="ad_slot_sky_right">Right Skyscraper Unit (160x600 / 120x600)</label>
                <textarea id="ad_slot_sky_right" name="ad_slot_sky_right" class="pkm-form-control" style="min-height:80px; font-family:monospace; font-size:0.85rem;"
                          placeholder="<!-- Paste Right Sticky Skyscraper 160x600 Code -->"><?= esc_html($settings['ad_slot_sky_right'] ?? '') ?></textarea>
                <span class="pkm-form-help">Sticky desktop banner flanking the right side of pages on wide screens.</span>
            </div>
        </div>

        <div class="pkm-form-row">
            <div class="pkm-form-group">
                <label class="pkm-form-label" for="ad_slot_sidebar">Desktop In-Content Sidebar Unit (300x250 / 300x600)</label>
                <textarea id="ad_slot_sidebar" name="ad_slot_sidebar" class="pkm-form-control" style="min-height:80px; font-family:monospace; font-size:0.85rem;"
                          placeholder="<!-- Paste 300x250 or 300x600 Sidebar Code -->"><?= esc_html($settings['ad_slot_sidebar'] ?? '') ?></textarea>
            </div>
            <div class="pkm-form-group">
                <label class="pkm-form-label" for="ad_slot_bottom">Bottom / Above Footer Unit</label>
                <textarea id="ad_slot_bottom" name="ad_slot_bottom" class="pkm-form-control" style="min-height:80px; font-family:monospace; font-size:0.85rem;"
                          placeholder="<!-- Paste Bottom Banner Code -->"><?= esc_html($settings['ad_slot_bottom'] ?? '') ?></textarea>
            </div>
        </div>
    </div>

    <!-- TAB 4: SEO & SCHEMA -->
    <div id="tab-seo" class="pkm-tab-pane pkm-card" style="display:none;">
        <div class="pkm-card-header">
            <h2 class="pkm-card-title">SEO, Structured Data & Google Site Name Schema</h2>
        </div>

        <div style="background:var(--pkm-bg-3); border:1px solid var(--pkm-border); border-left:4px solid #10B981; padding:14px 16px; border-radius:var(--pkm-radius-sm); margin-bottom:20px; font-size:0.9rem; line-height:1.5;">
            <strong>Google Search Site Name Verification:</strong> Google Search uses the JSON-LD <code>WebSite</code> schema, <code>name</code>, <code>alternateName</code>, and <code>og:site_name</code> tags to show your brand name prominently in search results above the URL snippet.
        </div>

        <!-- Visual SERP Snippet Preview -->
        <div style="background:var(--pkm-bg-2); border:1px solid var(--pkm-border); padding:16px 20px; border-radius:var(--pkm-radius-md); margin-bottom:24px;">
            <div style="font-size:0.75rem; text-transform:uppercase; color:var(--pkm-text-muted); font-weight:700; margin-bottom:8px;">
                Google SERP Site Name Preview
            </div>
            <div style="display:flex; align-items:center; gap:8px; margin-bottom:4px;">
                <div style="width:24px; height:24px; border-radius:50%; background:var(--pkm-primary); display:flex; align-items:center; justify-content:center; color:#FFF; font-size:12px; font-weight:bold;">P</div>
                <div>
                    <div style="font-weight:700; font-size:0.95rem; color:var(--pkm-text); line-height:1.2;">
                        <?= esc_html($settings['site_name'] ?? 'Pokemon Calculator Hub') ?>
                    </div>
                    <div style="font-size:0.75rem; color:var(--pkm-text-muted); line-height:1.2;">
                        https://pokemoncalculators.com &rsaquo; pokemon-go-cp-calculator
                    </div>
                </div>
            </div>
            <div style="color:#1a0dab; font-size:1.15rem; font-weight:500; margin-top:6px; cursor:pointer;">
                Pokemon GO CP Calculator — <?= esc_html($settings['site_name'] ?? 'Pokemon Calculator Hub') ?>
            </div>
            <div style="color:var(--pkm-text-muted); font-size:0.85rem; margin-top:4px;">
                Calculate exact Combat Power (CP), IV spreads, and Level 50 stats with official CPM multipliers...
            </div>
        </div>

        <div class="pkm-form-group">
            <label class="pkm-form-label" for="meta_title_default">Default Title Format</label>
            <input type="text" id="meta_title_default" name="meta_title_default" class="pkm-form-control"
                   value="<?= esc_attr($settings['meta_title_default'] ?? 'Pokemon Calculator Hub - IV, CP & Damage Calculators') ?>">
        </div>

        <div class="pkm-form-group">
            <label class="pkm-form-label" for="meta_description_default">Default Meta Description</label>
            <textarea id="meta_description_default" name="meta_description_default" class="pkm-form-control" style="min-height:80px;"><?= esc_html($settings['meta_description_default'] ?? 'Accurate Pokemon GO and VGC calculators for IVs, CP, evolution, stardust costs, damage calculation, speed tiers, and catch rate.') ?></textarea>
        </div>

        <div class="pkm-form-group">
            <label class="pkm-form-label" for="og_image_default">Default OpenGraph Image URL</label>
            <input type="text" id="og_image_default" name="og_image_default" class="pkm-form-control"
                   value="<?= esc_attr($settings['og_image_default'] ?? '') ?>" placeholder="assets/img/og-banner.png">
        </div>
    </div>

    <!-- TAB 5: THEME & COLOR TOKENS -->
    <div id="tab-theme" class="pkm-tab-pane pkm-card" style="display:none;">
        <div class="pkm-card-header">
            <h2 class="pkm-card-title">Theme Tokens & Color Palettes</h2>
        </div>

        <div class="pkm-form-row">
            <div class="pkm-form-group">
                <label class="pkm-form-label" for="theme_default_mode">Default Color Mode</label>
                <select id="theme_default_mode" name="theme_default_mode" class="pkm-form-control">
                    <option value="light" <?= ($settings['theme_default_mode'] ?? 'light') === 'light' ? 'selected' : '' ?>>Light Theme Default</option>
                    <option value="dark" <?= ($settings['theme_default_mode'] ?? '') === 'dark' ? 'selected' : '' ?>>Dark Theme Default</option>
                </select>
            </div>
            <div class="pkm-form-group">
                <label class="pkm-form-label" for="theme_primary_color">Primary Accent Color</label>
                <input type="color" id="theme_primary_color" name="theme_primary_color" class="pkm-form-control" style="height:44px; padding:4px;"
                       value="<?= esc_attr($settings['theme_primary_color'] ?? '#3B82F6') ?>">
            </div>
        </div>

        <div class="pkm-form-row">
            <div class="pkm-form-group">
                <label class="pkm-form-label" for="theme_light_bg">Light Theme Background</label>
                <input type="text" id="theme_light_bg" name="theme_light_bg" class="pkm-form-control"
                       value="<?= esc_attr($settings['theme_light_bg'] ?? '#F4F6F9') ?>">
                <span class="pkm-form-help">Default: <code>#F4F6F9</code></span>
            </div>
            <div class="pkm-form-group">
                <label class="pkm-form-label" for="theme_light_text">Light Theme Text Base</label>
                <input type="text" id="theme_light_text" name="theme_light_text" class="pkm-form-control"
                       value="<?= esc_attr($settings['theme_light_text'] ?? '#1A1F2E') ?>">
                <span class="pkm-form-help">Default: <code>#1A1F2E</code></span>
            </div>
        </div>

        <div class="pkm-form-row">
            <div class="pkm-form-group">
                <label class="pkm-form-label" for="theme_dark_bg">Dark Theme Background</label>
                <input type="text" id="theme_dark_bg" name="theme_dark_bg" class="pkm-form-control"
                       value="<?= esc_attr($settings['theme_dark_bg'] ?? '#0D1117') ?>">
                <span class="pkm-form-help">Default: <code>#0D1117</code></span>
            </div>
            <div class="pkm-form-group">
                <label class="pkm-form-label" for="theme_dark_text">Dark Theme Foreground Text</label>
                <input type="text" id="theme_dark_text" name="theme_dark_text" class="pkm-form-control"
                       value="<?= esc_attr($settings['theme_dark_text'] ?? '#E6EDF3') ?>">
                <span class="pkm-form-help">Default: <code>#E6EDF3</code></span>
            </div>
        </div>
    </div>

    <!-- TAB 6: SOCIAL LINKS -->
    <div id="tab-social" class="pkm-tab-pane pkm-card" style="display:none;">
        <div class="pkm-card-header">
            <h2 class="pkm-card-title">Social Channels & Communities</h2>
        </div>

        <div class="pkm-form-row">
            <div class="pkm-form-group">
                <label class="pkm-form-label" for="social_twitter">Twitter / X URL</label>
                <input type="url" id="social_twitter" name="social_twitter" class="pkm-form-control"
                       value="<?= esc_attr($settings['social_twitter'] ?? 'https://twitter.com') ?>">
            </div>
            <div class="pkm-form-group">
                <label class="pkm-form-label" for="social_discord">Discord Community URL</label>
                <input type="url" id="social_discord" name="social_discord" class="pkm-form-control"
                       value="<?= esc_attr($settings['social_discord'] ?? 'https://discord.com') ?>">
            </div>
        </div>

        <div class="pkm-form-row">
            <div class="pkm-form-group">
                <label class="pkm-form-label" for="social_youtube">YouTube Channel</label>
                <input type="url" id="social_youtube" name="social_youtube" class="pkm-form-control"
                       value="<?= esc_attr($settings['social_youtube'] ?? 'https://youtube.com') ?>">
            </div>
            <div class="pkm-form-group">
                <label class="pkm-form-label" for="social_github">GitHub Repository</label>
                <input type="url" id="social_github" name="social_github" class="pkm-form-control"
                       value="<?= esc_attr($settings['social_github'] ?? 'https://github.com') ?>">
            </div>
        </div>
    </div>

    <div style="margin-top:24px;">
        <button type="submit" class="pkm-btn pkm-btn-primary" style="padding:12px 28px; font-size:1rem;">
            Save All Settings
        </button>
    </div>
</form>
