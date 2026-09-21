<header class="pkm-header" id="pkm-header">
    <div class="pkm-header-inner">
        <!-- Logo -->
        <a href="<?= esc_url(home_url(pkm_get_current_lang() === 'en' ? '/' : pkm_get_current_lang())) ?>" class="pkm-logo" aria-label="<?= esc_attr(pkm_t('site_name', 'Pokemon Calculator')) ?>">
            <?= pkm_get_logo_svg() ?>
        </a>
        
        <!-- Desktop Navigation -->
        <nav class="pkm-nav" aria-label="<?= esc_attr(pkm_t('nav_aria_label', 'Main Navigation')) ?>">
            <!-- Home -->
            <div class="pkm-nav-item">
                <a href="<?= esc_url(home_url(pkm_get_current_lang() === 'en' ? '/' : pkm_get_current_lang())) ?>" class="pkm-nav-link">
                    <?= esc_html(pkm_t('nav_home', 'Home')) ?>
                </a>
            </div>
            
            <!-- Pokemon GO Dropdown -->
            <div class="pkm-nav-item">
                <a href="#" class="pkm-nav-link" onclick="return false;">
                    <?= esc_html(pkm_t('nav_pokemon_go', 'Pokemon GO')) ?>
                    <span class="pkm-nav-link-arrow">▼</span>
                </a>
                <div class="pkm-dropdown">
                    <a href="<?= esc_url(home_url('pokemon-go-cp-calculator')) ?>" class="pkm-dropdown-link">
                        <span class="pkm-dropdown-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg></span>
                        <?= esc_html(pkm_t('nav_cp_calculator', 'CP Calculator')) ?>
                    </a>
                    <a href="<?= esc_url(home_url('pokemon-go-iv-calculator')) ?>" class="pkm-dropdown-link">
                        <span class="pkm-dropdown-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg></span>
                        <?= esc_html(pkm_t('nav_iv_calculator', 'IV Calculator')) ?>
                    </a>
                    <a href="<?= esc_url(home_url('pokemon-go-evolution-cp-calculator')) ?>" class="pkm-dropdown-link">
                        <span class="pkm-dropdown-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg></span>
                        <?= esc_html(pkm_t('nav_evolution_calc', 'Evolution Calculator')) ?>
                    </a>
                    <a href="<?= esc_url(home_url('stardust-calculator')) ?>" class="pkm-dropdown-link">
                        <span class="pkm-dropdown-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9.5 7.5-2 2a4.95 4.95 0 1 0 7 7l2-2a4.95 4.95 0 1 0-7-7Z"/><path d="M14 6.5v10"/><path d="M10 7.5v10"/><path d="m16 7 1-5 1.37.68A3 3 0 0 0 19.7 3H21v1.3a3 3 0 0 0 .32 1.33L22 7l-5 1Z"/><path d="m8 17-1 5-1.37-.68A3 3 0 0 0 4.3 21H3v-1.3a3 3 0 0 0-.32-1.33L2 17l5-1Z"/></svg></span>
                        Stardust Calculator
                    </a>
                    <a href="<?= esc_url(home_url('pokemon-go-stat-calculator')) ?>" class="pkm-dropdown-link">
                        <span class="pkm-dropdown-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg></span>
                        GO Stat Calculator
                    </a>
                    <a href="<?= esc_url(home_url('pokemon-go-catch-rate-calculator')) ?>" class="pkm-dropdown-link">
                        <span class="pkm-dropdown-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/><line x1="12" y1="2" x2="12" y2="9"/><line x1="12" y1="15" x2="12" y2="22"/></svg></span>
                        <?= esc_html(pkm_t('nav_catch_rate', 'Catch Rate Calculator')) ?>
                    </a>
                </div>
            </div>
            
            <!-- Main Series Dropdown -->
            <div class="pkm-nav-item">
                <a href="#" class="pkm-nav-link" onclick="return false;">
                    <?= esc_html(pkm_t('nav_main_series', 'Main Series')) ?>
                    <span class="pkm-nav-link-arrow">▼</span>
                </a>
                <div class="pkm-dropdown">
                    <a href="<?= esc_url(home_url('type-chart')) ?>" class="pkm-dropdown-link">
                        <span class="pkm-dropdown-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></span>
                        <?= esc_html(pkm_t('nav_type_chart', 'Type Chart')) ?>
                    </a>
                    <a href="<?= esc_url(home_url('pokemon-damage-calculator')) ?>" class="pkm-dropdown-link">
                        <span class="pkm-dropdown-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m14.5 12.5-8 8a2.119 2.119 0 0 1-3-3l8-8"/><path d="m16 16 6-6"/><path d="m8 8 6-6"/></svg></span>
                        <?= esc_html(pkm_t('nav_damage_calc', 'Damage Calculator')) ?>
                    </a>
                </div>
            </div>
            
            <!-- Competitive Dropdown -->
            <div class="pkm-nav-item">
                <a href="#" class="pkm-nav-link" onclick="return false;">
                    <?= esc_html(pkm_t('nav_competitive', 'Competitive')) ?>
                    <span class="pkm-nav-link-arrow">▼</span>
                </a>
                <div class="pkm-dropdown">
                    <a href="<?= esc_url(home_url('speed-tiers')) ?>" class="pkm-dropdown-link">
                        <span class="pkm-dropdown-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg></span>
                        <?= esc_html(pkm_t('nav_speed_tiers', 'Speed Tiers')) ?>
                    </a>
                    <a href="<?= esc_url(home_url('calculators')) ?>" class="pkm-dropdown-link">
                        <span class="pkm-dropdown-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M3 15h18M9 3v18M15 3v18"/></svg></span>
                        <?= esc_html(pkm_t('nav_all_tools', 'All Calculators')) ?>
                    </a>
                </div>
            </div>
            
            <!-- All Calculators -->
            <div class="pkm-nav-item">
                <a href="<?= esc_url(home_url('calculators')) ?>" class="pkm-nav-link">
                    <?= esc_html(pkm_t('nav_all_tools', 'All Tools')) ?>
                </a>
            </div>

            <!-- Blog -->
            <div class="pkm-nav-item">
                <a href="<?= esc_url(home_url('blog')) ?>" class="pkm-nav-link">
                    <?= esc_html(pkm_t('nav_blog', 'Blog')) ?>
                </a>
            </div>
            
            <!-- About -->
            <div class="pkm-nav-item">
                <a href="<?= esc_url(home_url('about')) ?>" class="pkm-nav-link">
                    <?= esc_html(pkm_t('nav_about', 'About')) ?>
                </a>
            </div>
        </nav>

        <!-- Right Side Actions -->
        <div class="pkm-header-actions">
            <!-- Language Switcher Component (Hidden by default in English-only mode) -->
            <?php if (pkm_is_multilingual_enabled()): ?>
                <?= pkm_render_language_switcher() ?>
            <?php endif; ?>

            <!-- Theme Toggle -->
            <button class="pkm-theme-toggle" id="pkm-theme-btn" type="button" aria-label="Toggle theme" onclick="pkmToggleTheme()">
                <span class="pkm-theme-icon">🌙</span>
            </button>
            
            <!-- Mobile Menu Toggle Button -->
            <button class="pkm-mobile-menu-toggle" id="pkm-mobile-menu-toggle" type="button" aria-label="Open mobile menu">
                <span class="pkm-menu-icon"></span>
            </button>
        </div>
    </div>
</header>

<!-- Mobile Menu Drawer -->
<div class="pkm-mobile-backdrop" id="pkm-mobile-backdrop" style="display:none;"></div>
<aside class="pkm-mobile-nav" id="pkm-mobile-nav" aria-label="Mobile Navigation" style="display:none;">
    <div class="pkm-mobile-header">
        <?= pkm_get_logo_svg() ?>
        <button class="pkm-mobile-close" id="pkm-mobile-close" type="button" aria-label="Close menu">&times;</button>
    </div>
    
    <?php if (pkm_is_multilingual_enabled()): ?>
    <!-- Mobile Language Selector -->
    <div style="padding:12px 16px; border-bottom:1px solid var(--pkm-border);">
        <div style="font-size:0.8rem; font-weight:700; color:var(--pkm-text-muted); margin-bottom:8px; text-transform:uppercase;">Language / Idioma</div>
        <div style="display:flex; gap:6px; flex-wrap:wrap;">
            <?php foreach (\App\Core\I18n::getSupportedLanguages() as $lCode => $lInfo): ?>
                <a href="<?= esc_url(pkm_get_lang_url($lCode)) ?>" 
                   style="padding:6px 10px; border-radius:var(--pkm-radius-sm); font-size:0.85rem; text-decoration:none; display:inline-flex; align-items:center; gap:4px; <?= ($lCode === \App\Core\I18n::getCurrentLang()) ? 'background:var(--pkm-primary); color:#FFF; font-weight:700;' : 'background:var(--pkm-bg-3); color:var(--pkm-text); border:1px solid var(--pkm-border);' ?>">
                    <span><?= $lInfo['flag'] ?></span>
                    <span><?= esc_html($lInfo['name']) ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="pkm-mobile-links">
        <a href="<?= esc_url(home_url('/')) ?>" class="pkm-mobile-link"><?= esc_html(pkm_t('nav_home', 'Home')) ?></a>
        <a href="<?= esc_url(home_url('calculators')) ?>" class="pkm-mobile-link"><?= esc_html(pkm_t('nav_all_tools', 'All Calculators')) ?></a>
        <a href="<?= esc_url(home_url('pokemon-go-cp-calculator')) ?>" class="pkm-mobile-link">CP Calculator</a>
        <a href="<?= esc_url(home_url('pokemon-go-iv-calculator')) ?>" class="pkm-mobile-link">IV Calculator</a>
        <a href="<?= esc_url(home_url('pokemon-go-evolution-cp-calculator')) ?>" class="pkm-mobile-link">Evolution CP Calculator</a>
        <a href="<?= esc_url(home_url('stardust-calculator')) ?>" class="pkm-mobile-link">Stardust Calculator</a>
        <a href="<?= esc_url(home_url('pokemon-go-stat-calculator')) ?>" class="pkm-mobile-link">GO Stat Calculator</a>
        <a href="<?= esc_url(home_url('pokemon-go-catch-rate-calculator')) ?>" class="pkm-mobile-link">Catch Rate Calculator</a>
        <a href="<?= esc_url(home_url('pokemon-damage-calculator')) ?>" class="pkm-mobile-link">Damage Calculator</a>
        <a href="<?= esc_url(home_url('speed-tiers')) ?>" class="pkm-mobile-link">Speed Tiers</a>
        <a href="<?= esc_url(home_url('type-chart')) ?>" class="pkm-mobile-link">Type Chart</a>
        <a href="<?= esc_url(home_url('blog')) ?>" class="pkm-mobile-link"><?= esc_html(pkm_t('nav_blog', 'Blog')) ?></a>
        <a href="<?= esc_url(home_url('about')) ?>" class="pkm-mobile-link"><?= esc_html(pkm_t('nav_about', 'About')) ?></a>
        <a href="<?= esc_url(home_url('contact')) ?>" class="pkm-mobile-link"><?= esc_html(pkm_t('nav_contact', 'Contact')) ?></a>
    </div>
</aside>
