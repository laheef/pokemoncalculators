<?php
$year = date('Y');
?>
<footer class="pkm-footer" role="contentinfo">
    <div class="pkm-footer-grid">
        <!-- Brand Column -->
        <div class="pkm-footer-brand">
            <div class="pkm-footer-logo">
                <?= pkm_get_logo_svg() ?>
            </div>
            <p class="pkm-footer-description">
                <?= esc_html(pkm_t('footer_description', 'Free, accurate Pokemon calculators and competitive tools for trainers worldwide. Calculate CP, IVs, Stardust, Evolutions, Speed Tiers, and Damage.')) ?>
            </p>
        </div>
        
        <!-- Popular Tools -->
        <div class="pkm-footer-column">
            <h4><?= esc_html(pkm_t('footer_popular', 'Popular Calculators')) ?></h4>
            <ul class="pkm-footer-links">
                <li><a href="<?= esc_url(home_url('pokemon-go-cp-calculator')) ?>"><?= esc_html(pkm_t('nav_cp_calculator', 'CP Calculator')) ?></a></li>
                <li><a href="<?= esc_url(home_url('pokemon-go-iv-calculator')) ?>"><?= esc_html(pkm_t('nav_iv_calculator', 'IV Calculator')) ?></a></li>
                <li><a href="<?= esc_url(home_url('pokemon-go-evolution-cp-calculator')) ?>"><?= esc_html(pkm_t('nav_evolution_calc', 'Evolution CP Calculator')) ?></a></li>
                <li><a href="<?= esc_url(home_url('stardust-calculator')) ?>">Stardust Calculator</a></li>
                <li><a href="<?= esc_url(home_url('pokemon-go-stat-calculator')) ?>">GO Stat Calculator</a></li>
                <li><a href="<?= esc_url(home_url('pokemon-go-catch-rate-calculator')) ?>"><?= esc_html(pkm_t('nav_catch_rate', 'Catch Rate Calculator')) ?></a></li>
            </ul>
        </div>
        
        <!-- Categories & Tools -->
        <div class="pkm-footer-column">
            <h4><?= esc_html(pkm_t('footer_categories', 'Categories & Tools')) ?></h4>
            <ul class="pkm-footer-links">
                <li><a href="<?= esc_url(home_url('pokemon-damage-calculator')) ?>"><?= esc_html(pkm_t('nav_damage_calc', 'Damage Calculator')) ?></a></li>
                <li><a href="<?= esc_url(home_url('speed-tiers')) ?>"><?= esc_html(pkm_t('nav_speed_tiers', 'Speed Tiers')) ?></a></li>
                <li><a href="<?= esc_url(home_url('type-chart')) ?>"><?= esc_html(pkm_t('nav_type_chart', 'Type Chart')) ?></a></li>
                <li><a href="<?= esc_url(home_url('calculators')) ?>"><?= esc_html(pkm_t('nav_all_tools', 'All Calculators Hub')) ?></a></li>
                <li><a href="<?= esc_url(home_url('blog')) ?>"><?= esc_html(pkm_t('nav_blog', 'Blog & Guides')) ?></a></li>
            </ul>
        </div>
        
        <!-- Resources & Legal -->
        <div class="pkm-footer-column">
            <h4><?= esc_html(pkm_t('footer_resources', 'Resources & Legal')) ?></h4>
            <ul class="pkm-footer-links">
                <li><a href="<?= esc_url(home_url('about')) ?>"><?= esc_html(pkm_t('nav_about', 'About Us')) ?></a></li>
                <li><a href="<?= esc_url(home_url('contact')) ?>"><?= esc_html(pkm_t('nav_contact', 'Contact Us')) ?></a></li>
                <li><a href="<?= esc_url(home_url('privacy-policy')) ?>"><?= esc_html(pkm_t('footer_privacy', 'Privacy Policy')) ?></a></li>
                <li><a href="<?= esc_url(home_url('cookie-policy')) ?>">Cookie Policy</a></li>
                <li><a href="<?= esc_url(home_url('terms-of-service')) ?>"><?= esc_html(pkm_t('footer_terms', 'Terms & Conditions')) ?></a></li>
            </ul>
        </div>
    </div>
    
    <!-- Footer Bottom -->
    <div class="pkm-footer-bottom">
        <div class="pkm-footer-bottom-inner">
            <p class="pkm-footer-copyright">
                &copy; <?= $year ?> Pokemon Calculator Hub. Fan-made toolset. Unaffiliated with Nintendo, Creatures, GAME FREAK, or Niantic.
            </p>
            <nav class="pkm-footer-legal" aria-label="Legal">
                <a href="<?= esc_url(home_url('privacy-policy')) ?>"><?= esc_html(pkm_t('footer_privacy', 'Privacy Policy')) ?></a>
                <a href="<?= esc_url(home_url('cookie-policy')) ?>">Cookie Policy</a>
                <a href="<?= esc_url(home_url('terms-of-service')) ?>"><?= esc_html(pkm_t('footer_terms', 'Terms & Conditions')) ?></a>
                <a href="<?= esc_url(home_url('contact')) ?>"><?= esc_html(pkm_t('footer_contact', 'Contact')) ?></a>
            </nav>
        </div>
    </div>
</footer>

<!-- Back to Top Button -->
<button class="pkm-back-to-top" id="pkm-back-to-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'})" aria-label="Back to top">
    ↑
</button>
