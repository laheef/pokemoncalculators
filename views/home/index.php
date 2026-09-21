<?php
// Homepage View — Complete 8 Sections
$current_lang = pkm_get_current_lang();
$current_lang = pkm_get_current_lang();

    /* ── SVG icon helper ── */
    $svg = array(
        'cp'         => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>',
        'iv'         => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>',
        'type'       => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
        'evolution'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>',
        'damage'     => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m14.5 12.5-8 8a2.119 2.119 0 0 1-3-3l8-8"/><path d="m16 16 6-6"/><path d="m8 8 6-6"/></svg>',
        'catch'      => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/><line x1="12" y1="2" x2="12" y2="9"/><line x1="12" y1="15" x2="12" y2="22"/></svg>',
        'team'       => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
        'speed'      => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>',
        'coverage'   => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M3 15h18M9 3v18M15 3v18"/></svg>',
        'raid'       => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
        'natures'    => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 22c1.25-.987 2.27-1.975 3.9-2.2a5.56 5.56 0 0 1 3.8 1.5 4 4 0 0 0 6.187-2.353 3.5 3.5 0 0 0 3.69-5.116A3.5 3.5 0 0 0 20.95 8 3.5 3.5 0 1 0 16 3.05a3.5 3.5 0 0 0-5.831 1.373 3.5 3.5 0 0 0-5.116 3.69 4 4 0 0 0-2.348 6.155C3.499 15.42 3.158 18.758 2 22Z"/></svg>',
        'go'         => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>',
        'game'       => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="6" y1="12" x2="10" y2="12"/><line x1="8" y1="10" x2="8" y2="14"/><line x1="15" y1="13" x2="15.01" y2="13"/><line x1="18" y1="11" x2="18.01" y2="11"/><rect x="2" y="6" width="20" height="12" rx="2"/></svg>',
        'trophy'     => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="8 3 8 8 12 11 16 8 16 3"/><path d="M8 3H5a2 2 0 0 0-2 2v3c0 2.2 1.5 4 3.5 4.5"/><path d="M16 3h3a2 2 0 0 1 2 2v3c0 2.2-1.5 4-3.5 4.5"/><path d="M12 11v7"/><path d="M8 21h8"/></svg>',
        'check'      => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>',
        'gift'       => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 12 20 22 4 22 4 12"/><rect x="2" y="7" width="20" height="5"/><line x1="12" y1="22" x2="12" y2="7"/><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"/><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/></svg>',
        'zap'        => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>',
        'refresh'    => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg>',
        'star'       => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
        'quote'      => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>',
        'candy'      => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9.5 7.5-2 2a4.95 4.95 0 1 0 7 7l2-2a4.95 4.95 0 1 0-7-7Z"/><path d="M14 6.5v10"/><path d="M10 7.5v10"/><path d="m16 7 1-5 1.37.68A3 3 0 0 0 19.7 3H21v1.3a3 3 0 0 0 .32 1.33L22 7l-5 1Z"/><path d="m8 17-1 5-1.37-.68A3 3 0 0 0 4.3 21H3v-1.3a3 3 0 0 0-.32-1.33L2 17l5-1Z"/></svg>',
        'target'     => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>',
        'egg'        => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c6.23-.05 7.87-5.57 7.5-10-.36-4.34-3.95-9.96-7.5-10-3.55.04-7.14 5.66-7.5 10-.37 4.43 1.27 9.95 7.5 10z"/></svg>',
        'pokeball'   => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><circle cx="12" cy="12" r="3"/></svg>',
    );
    ?>

<!-- Hero Section -->
<section class="pkm-hero" aria-label="Hero">
    <div class="pkm-hero-particles">
        <?php for($i=0;$i<8;$i++): ?>
        <div class="pkm-particle">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="var(--pkm-primary)" stroke-width="1.5" opacity="0.4">
                <circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><circle cx="12" cy="12" r="3"/>
            </svg>
        </div>
        <?php endfor; ?>
    </div>
    
    <div class="pkm-hero-inner">
        <div class="pkm-hero-content">
            <div class="pkm-hero-badge">
                <span class="pkm-hero-badge-icon"><?php echo $svg['zap']; ?></span>
                <?php pkm_e('site_tagline'); ?>
            </div>
            <h1 class="pkm-hero-title"><?php pkm_e('hero_title'); ?></h1>
            <p class="pkm-hero-subtitle"><?php pkm_e('hero_subtitle'); ?></p>
            <div class="pkm-hero-buttons">
                <a href="<?php echo esc_url(home_url('/calculators/')); ?>" class="pkm-btn pkm-btn-primary">
                    <?php pkm_e('hero_cta_primary'); ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
                <a href="<?php echo esc_url(home_url('/pokemon-go-cp-calculator/')); ?>" class="pkm-btn pkm-btn-secondary">
                    <?php pkm_e('hero_cta_secondary'); ?>
                </a>
            </div>
            <div class="pkm-hero-stats">
                <div class="pkm-hero-stat">
                    <div class="pkm-hero-stat-value">20+</div>
                    <div class="pkm-hero-stat-label"><?php pkm_e('hero_stats_tools'); ?></div>
                </div>
                <div class="pkm-hero-stat">
                    <div class="pkm-hero-stat-value">100%</div>
                    <div class="pkm-hero-stat-label">Free to Use</div>
                </div>
                <div class="pkm-hero-stat">
                    <div class="pkm-hero-stat-value">2M+</div>
                    <div class="pkm-hero-stat-label"><?php pkm_e('hero_stats_trainers'); ?></div>
                </div>
            </div>
        </div>
        <div class="pkm-hero-visual">
            <!-- Hero Pokemon Showcase — SVG-based Pokemon silhouettes + official artwork -->
            <div class="pkm-hero-pkm-scene">
                <!-- Central large featured Pokemon (Charizard) using official artwork -->
                <div class="pkm-hero-pkm-main">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/6.png"
                         alt="Charizard"
                         loading="eager"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                    <!-- SVG fallback: Charizard-inspired fire dragon silhouette -->
                    <svg style="display:none" class="pkm-hero-pkm-fallback-svg" viewBox="0 0 120 140" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <ellipse cx="60" cy="95" rx="28" ry="38" fill="var(--pkm-primary)" opacity="0.9"/>
                        <circle cx="60" cy="52" r="22" fill="var(--pkm-primary)"/>
                        <ellipse cx="44" cy="48" rx="7" ry="11" fill="var(--pkm-primary)" transform="rotate(-20,44,48)"/>
                        <ellipse cx="76" cy="48" rx="7" ry="11" fill="var(--pkm-primary)" transform="rotate(20,76,48)"/>
                        <ellipse cx="55" cy="54" rx="3" ry="4" fill="#1A1F2E"/>
                        <ellipse cx="65" cy="54" rx="3" ry="4" fill="#1A1F2E"/>
                        <path d="M55 63 Q60 68 65 63" stroke="#1A1F2E" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                        <ellipse cx="32" cy="100" rx="22" ry="8" fill="var(--pkm-primary)" opacity="0.8" transform="rotate(-35,32,100)"/>
                        <ellipse cx="88" cy="100" rx="22" ry="8" fill="var(--pkm-primary)" opacity="0.8" transform="rotate(35,88,100)"/>
                        <ellipse cx="60" cy="135" rx="6" ry="18" fill="var(--pkm-primary)" transform="rotate(15,60,135)"/>
                        <ellipse cx="60" cy="133" rx="3" ry="6" fill="#F4D03F" transform="rotate(15,60,133)"/>
                    </svg>
                </div>
                <!-- Floating secondary Pokemon -->
                <div class="pkm-hero-pkm-side pkm-hero-pkm-side-1">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/25.png"
                         alt="Pikachu" loading="lazy"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                    <svg style="display:none;width:70px;height:70px;opacity:0.6" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="var(--pkm-primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                </div>
                <div class="pkm-hero-pkm-side pkm-hero-pkm-side-2">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/150.png"
                         alt="Mewtwo" loading="lazy"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                    <svg style="display:none;width:70px;height:70px;opacity:0.6" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#F85888" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                </div>
                <div class="pkm-hero-pkm-side pkm-hero-pkm-side-3">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/143.png"
                         alt="Snorlax" loading="lazy"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                    <svg style="display:none;width:70px;height:70px;opacity:0.6" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#6890F0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <!-- Decorative pokeball SVGs in background -->
                <div class="pkm-hero-bg-ball pkm-hero-bg-ball-1">
                    <svg viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <circle cx="30" cy="30" r="28" fill="none" stroke="var(--pkm-primary)" stroke-width="2" opacity="0.2"/>
                        <line x1="2" y1="30" x2="58" y2="30" stroke="var(--pkm-primary)" stroke-width="2" opacity="0.2"/>
                        <circle cx="30" cy="30" r="8" fill="none" stroke="var(--pkm-primary)" stroke-width="2" opacity="0.2"/>
                    </svg>
                </div>
                <div class="pkm-hero-bg-ball pkm-hero-bg-ball-2">
                    <svg viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <circle cx="20" cy="20" r="18" fill="none" stroke="var(--pkm-accent)" stroke-width="1.5" opacity="0.25"/>
                        <line x1="2" y1="20" x2="38" y2="20" stroke="var(--pkm-accent)" stroke-width="1.5" opacity="0.25"/>
                        <circle cx="20" cy="20" r="5" fill="none" stroke="var(--pkm-accent)" stroke-width="1.5" opacity="0.25"/>
                    </svg>
                </div>
                <!-- Type badge decorations -->
                <div class="pkm-hero-type-badge pkm-hero-type-fire">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/></svg>
                    Fire
                </div>
                <div class="pkm-hero-type-badge pkm-hero-type-electric">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                    Electric
                </div>
                <div class="pkm-hero-type-badge pkm-hero-type-psychic">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                    Psychic
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Most Popular Tools — fetched from subpages of current language parent page -->
<?php echo pkm_render_popular_tools_section('en'); ?>

<!-- Pokemon Info & Fun Facts Section (replaces All Tools) -->
<?php
// ---- Pokemon Info Section Translations ----
$pkm_info_tr = array(
    'en' => array(
        'section_title'   => 'Pokémon World',
        'section_sub'     => 'Discover fascinating facts, meet iconic Pokémon, and deepen your trainer knowledge',
        'did_you_know'    => 'Did You Know?',
        'spotlight'       => 'Pokémon Spotlight',
        'generations'     => 'Game Generations',
        'type_quick'      => 'Type Quick Reference',
        'by_numbers'      => 'Pokémon by Numbers',
        'full_type_chart' => 'Full Type Chart',
        'strong_vs'       => 'Strong vs',
        'weak_to'         => 'Weak to',
        'total_species'   => 'Total Species',
        'pkm_types'       => 'Pokémon Types',
        'generations_lbl' => 'Generations',
        'max_base_stat'   => 'Max Base Stat Total',
        'main_series'     => 'Main Series Pokémon',
        'legendary'       => 'Legendary & Mythical',
        'facts' => array(
            'Pikachu\'s name comes from <em>pika</em> (electric crackling) + <em>chu</em> (mouse squeak)',
            'There are <strong>1,025+</strong> Pokémon species across all 9 generations',
            'Gengar is said to be the shadow of a Clefable — they share the same silhouette!',
            'Snorlax weighs <strong>460 kg</strong> (1,014 lbs) and sleeps up to 21 hours a day',
            'Magikarp can jump over mountains — despite looking completely useless in battle',
        ),
        'types' => array(
            array('type'=>'Fire',    'color'=>'#F08030','strong'=>'Grass, Ice, Bug, Steel','weak'=>'Water, Rock, Ground'),
            array('type'=>'Water',   'color'=>'#6890F0','strong'=>'Fire, Ground, Rock',   'weak'=>'Electric, Grass'),
            array('type'=>'Electric','color'=>'#F8D030','strong'=>'Water, Flying',         'weak'=>'Ground'),
            array('type'=>'Psychic', 'color'=>'#F85888','strong'=>'Fighting, Poison',      'weak'=>'Bug, Ghost, Dark'),
            array('type'=>'Dragon',  'color'=>'#6F35FC','strong'=>'Dragon',                'weak'=>'Ice, Dragon, Fairy'),
            array('type'=>'Ghost',   'color'=>'#705898','strong'=>'Psychic, Ghost',        'weak'=>'Ghost, Dark'),
        ),
    ),
    'es' => array(
        'section_title'   => 'Mundo Pokémon',
        'section_sub'     => 'Descubre datos fascinantes, conoce Pokémon icónicos y profundiza tu conocimiento como entrenador',
        'did_you_know'    => '¿Sabías que...?',
        'spotlight'       => 'Pokémon Destacados',
        'generations'     => 'Generaciones de Juegos',
        'type_quick'      => 'Referencia Rápida de Tipos',
        'by_numbers'      => 'Pokémon en Números',
        'full_type_chart' => 'Tabla Completa de Tipos',
        'strong_vs'       => 'Fuerte contra',
        'weak_to'         => 'Débil contra',
        'total_species'   => 'Especies Totales',
        'pkm_types'       => 'Tipos Pokémon',
        'generations_lbl' => 'Generaciones',
        'max_base_stat'   => 'Máx. Estadística Base',
        'main_series'     => 'Pokémon Serie Principal',
        'legendary'       => 'Legendarios y Míticos',
        'facts' => array(
            'El nombre Pikachu viene de <em>pika</em> (chispa eléctrica) + <em>chu</em> (chillido de ratón)',
            'Existen <strong>1,025+</strong> especies Pokémon en las 9 generaciones',
            '¡Se dice que Gengar es la sombra de Clefable — comparten la misma silueta!',
            'Snorlax pesa <strong>460 kg</strong> y duerme hasta 21 horas al día',
            'Magikarp puede saltar montañas — ¡a pesar de parecer inútil en batalla!',
        ),
        'types' => array(
            array('type'=>'Fuego',   'color'=>'#F08030','strong'=>'Planta, Hielo, Bicho, Acero','weak'=>'Agua, Roca, Tierra'),
            array('type'=>'Agua',    'color'=>'#6890F0','strong'=>'Fuego, Tierra, Roca',        'weak'=>'Eléctrico, Planta'),
            array('type'=>'Eléctrico','color'=>'#F8D030','strong'=>'Agua, Volador',             'weak'=>'Tierra'),
            array('type'=>'Psíquico','color'=>'#F85888','strong'=>'Lucha, Veneno',              'weak'=>'Bicho, Fantasma, Siniestro'),
            array('type'=>'Dragón',  'color'=>'#6F35FC','strong'=>'Dragón',                     'weak'=>'Hielo, Dragón, Hada'),
            array('type'=>'Fantasma','color'=>'#705898','strong'=>'Psíquico, Fantasma',         'weak'=>'Fantasma, Siniestro'),
        ),
    ),
    'pt-br' => array(
        'section_title'   => 'Mundo Pokémon',
        'section_sub'     => 'Descubra fatos fascinantes, conheça Pokémon icônicos e aprofunde seu conhecimento como treinador',
        'did_you_know'    => 'Você Sabia?',
        'spotlight'       => 'Destaque Pokémon',
        'generations'     => 'Gerações dos Jogos',
        'type_quick'      => 'Referência Rápida de Tipos',
        'by_numbers'      => 'Pokémon em Números',
        'full_type_chart' => 'Tabela Completa de Tipos',
        'strong_vs'       => 'Forte contra',
        'weak_to'         => 'Fraco contra',
        'total_species'   => 'Total de Espécies',
        'pkm_types'       => 'Tipos Pokémon',
        'generations_lbl' => 'Gerações',
        'max_base_stat'   => 'Máx. Estatística Base',
        'main_series'     => 'Pokémon da Série Principal',
        'legendary'       => 'Lendários e Místicos',
        'facts' => array(
            'O nome Pikachu vem de <em>pika</em> (faísca elétrica) + <em>chu</em> (guincho de rato)',
            'Existem <strong>1.025+</strong> espécies Pokémon em todas as 9 gerações',
            'Diz-se que Gengar é a sombra de Clefable — eles compartilham a mesma silhueta!',
            'Snorlax pesa <strong>460 kg</strong> e dorme até 21 horas por dia',
            'Magikarp pode pular montanhas — apesar de parecer completamente inútil em batalha!',
        ),
        'types' => array(
            array('type'=>'Fogo',    'color'=>'#F08030','strong'=>'Planta, Gelo, Inseto, Aço','weak'=>'Água, Pedra, Terra'),
            array('type'=>'Água',    'color'=>'#6890F0','strong'=>'Fogo, Terra, Pedra',       'weak'=>'Elétrico, Planta'),
            array('type'=>'Elétrico','color'=>'#F8D030','strong'=>'Água, Voador',             'weak'=>'Terra'),
            array('type'=>'Psíquico','color'=>'#F85888','strong'=>'Lutador, Veneno',          'weak'=>'Inseto, Fantasma, Sombrio'),
            array('type'=>'Dragão',  'color'=>'#6F35FC','strong'=>'Dragão',                   'weak'=>'Gelo, Dragão, Fada'),
            array('type'=>'Fantasma','color'=>'#705898','strong'=>'Psíquico, Fantasma',       'weak'=>'Fantasma, Sombrio'),
        ),
    ),
    'fr' => array(
        'section_title'   => 'Monde Pokémon',
        'section_sub'     => 'Découvrez des faits fascinants, rencontrez des Pokémon iconiques et approfondissez vos connaissances de dresseur',
        'did_you_know'    => 'Le Saviez-Vous ?',
        'spotlight'       => 'Pokémon à la Une',
        'generations'     => 'Générations de Jeux',
        'type_quick'      => 'Référence Rapide des Types',
        'by_numbers'      => 'Pokémon en Chiffres',
        'full_type_chart' => 'Tableau Complet des Types',
        'strong_vs'       => 'Fort contre',
        'weak_to'         => 'Faible contre',
        'total_species'   => 'Espèces Totales',
        'pkm_types'       => 'Types Pokémon',
        'generations_lbl' => 'Générations',
        'max_base_stat'   => 'Stat. de Base Max.',
        'main_series'     => 'Pokémon Série Principale',
        'legendary'       => 'Légendaires & Fabuleux',
        'facts' => array(
            'Le nom Pikachu vient de <em>pika</em> (crépitement électrique) + <em>chu</em> (couinement de souris)',
            'Il existe <strong>1 025+</strong> espèces Pokémon dans les 9 générations',
            'Ectoplasma serait l\'ombre de Mélofée — ils partagent la même silhouette !',
            'Ronflex pèse <strong>460 kg</strong> et dort jusqu\'à 21 heures par jour',
            'Magicarpe peut sauter par-dessus des montagnes — malgré son inutilité en combat !',
        ),
        'types' => array(
            array('type'=>'Feu',       'color'=>'#F08030','strong'=>'Plante, Glace, Insecte, Acier','weak'=>'Eau, Roche, Sol'),
            array('type'=>'Eau',       'color'=>'#6890F0','strong'=>'Feu, Sol, Roche',             'weak'=>'Électrik, Plante'),
            array('type'=>'Électrik',  'color'=>'#F8D030','strong'=>'Eau, Vol',                    'weak'=>'Sol'),
            array('type'=>'Psy',       'color'=>'#F85888','strong'=>'Combat, Poison',              'weak'=>'Insecte, Spectre, Ténèbres'),
            array('type'=>'Dragon',    'color'=>'#6F35FC','strong'=>'Dragon',                      'weak'=>'Glace, Dragon, Fée'),
            array('type'=>'Spectre',   'color'=>'#705898','strong'=>'Psy, Spectre',                'weak'=>'Spectre, Ténèbres'),
        ),
    ),
    'de' => array(
        'section_title'   => 'Pokémon-Welt',
        'section_sub'     => 'Entdecke faszinierende Fakten, triff ikonische Pokémon und vertiefe dein Trainer-Wissen',
        'did_you_know'    => 'Wusstest du schon?',
        'spotlight'       => 'Pokémon im Rampenlicht',
        'generations'     => 'Spielgenerationen',
        'type_quick'      => 'Typ-Schnellreferenz',
        'by_numbers'      => 'Pokémon in Zahlen',
        'full_type_chart' => 'Vollständige Typen-Tabelle',
        'strong_vs'       => 'Stark gegen',
        'weak_to'         => 'Schwach gegen',
        'total_species'   => 'Gesamtarten',
        'pkm_types'       => 'Pokémon-Typen',
        'generations_lbl' => 'Generationen',
        'max_base_stat'   => 'Max. Basiswert-Summe',
        'main_series'     => 'Hauptreihen-Pokémon',
        'legendary'       => 'Legendäre & Mystische',
        'facts' => array(
            'Der Name Pikachu kommt von <em>pika</em> (elektrisches Knistern) + <em>chu</em> (Mausquietschen)',
            'Es gibt <strong>1.025+</strong> Pokémon-Arten in allen 9 Generationen',
            'Gengar soll der Schatten von Clefairy sein — sie teilen dieselbe Silhouette!',
            'Relaxo wiegt <strong>460 kg</strong> und schläft bis zu 21 Stunden am Tag',
            'Karpador kann über Berge springen — obwohl es im Kampf völlig nutzlos wirkt!',
        ),
        'types' => array(
            array('type'=>'Feuer',    'color'=>'#F08030','strong'=>'Pflanze, Eis, Käfer, Stahl','weak'=>'Wasser, Gestein, Boden'),
            array('type'=>'Wasser',   'color'=>'#6890F0','strong'=>'Feuer, Boden, Gestein',    'weak'=>'Elektro, Pflanze'),
            array('type'=>'Elektro',  'color'=>'#F8D030','strong'=>'Wasser, Flug',             'weak'=>'Boden'),
            array('type'=>'Psycho',   'color'=>'#F85888','strong'=>'Kampf, Gift',              'weak'=>'Käfer, Geist, Unlicht'),
            array('type'=>'Drache',   'color'=>'#6F35FC','strong'=>'Drache',                   'weak'=>'Eis, Drache, Fee'),
            array('type'=>'Geist',    'color'=>'#705898','strong'=>'Psycho, Geist',            'weak'=>'Geist, Unlicht'),
        ),
    ),
);
$pit = isset($pkm_info_tr[$current_lang]) ? $pkm_info_tr[$current_lang] : $pkm_info_tr['en'];
$tc_url = pkm_get_type_chart_url($current_lang);

// Spotlight Pokemon names per language
$spotlight_names = array(
    'en'    => array(25=>'Pikachu',   6=>'Charizard', 150=>'Mewtwo',   248=>'Tyranitar', 384=>'Rayquaza', 716=>'Xerneas'),
    'es'    => array(25=>'Pikachu',   6=>'Charizard', 150=>'Mewtwo',   248=>'Tyranitar', 384=>'Rayquaza', 716=>'Xerneas'),
    'pt-br' => array(25=>'Pikachu',   6=>'Charizard', 150=>'Mewtwo',   248=>'Tyranitar', 384=>'Rayquaza', 716=>'Xerneas'),
    'fr'    => array(25=>'Pikachu',   6=>'Dracaufeu', 150=>'Mewtwo',   248=>'Tyranocif', 384=>'Rayquaza', 716=>'Xerneas'),
    'de'    => array(25=>'Pikachu',   6=>'Glurak',    150=>'Mewtu',    248=>'Despotar',  384=>'Rayquaza', 716=>'Xerneas'),
);
$sp_names = isset($spotlight_names[$current_lang]) ? $spotlight_names[$current_lang] : $spotlight_names['en'];
?>
<section class="pkm-pokemon-info" aria-labelledby="pkm-info-title">
    <div class="pkm-section-title">
        <div class="pkm-section-icon-title">
            <span class="pkm-section-icon-wrap">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><circle cx="12" cy="12" r="3"/></svg>
            </span>
            <h2 id="pkm-info-title"><?php echo esc_html($pit['section_title']); ?></h2>
        </div>
        <p><?php echo esc_html($pit['section_sub']); ?></p>
    </div>

    <!-- Row 1: 2-column — Fun Facts + Pokemon Spotlight -->
    <div class="pkm-info-row pkm-info-row-2col">

        <!-- Fun Facts -->
        <div class="pkm-info-card">
            <div class="pkm-info-card-header">
                <div class="pkm-info-icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                </div>
                <h3><?php echo esc_html($pit['did_you_know']); ?></h3>
            </div>
            <ul class="pkm-fun-facts-list">
                <?php
                $fact_icons = array(
                    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>',
                    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>',
                    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M8.56 2.75c4.37 6.03 6.02 9.42 8.03 17.72m2.54-15.38c-3.72 4.35-8.94 5.66-16.88 5.85m19.5 1.9c-3.5-.93-6.63-.82-8.94 0-2.58.92-5.01 2.86-7.44 6.32"/></svg>',
                    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M3 15h18M9 3v18M15 3v18"/></svg>',
                    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c6.23-.05 7.87-5.57 7.5-10-.36-4.34-3.95-9.96-7.5-10-3.55.04-7.14 5.66-7.5 10-.37 4.43 1.27 9.95 7.5 10z"/></svg>',
                );
                foreach ($pit['facts'] as $fi => $fact):
                ?>
                <li>
                    <span class="pkm-fact-icon"><?php echo $fact_icons[$fi % count($fact_icons)]; ?></span>
                    <span><?php echo $fact; ?></span>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Pokemon Spotlight -->
        <div class="pkm-info-card">
            <div class="pkm-info-card-header">
                <div class="pkm-info-icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                </div>
                <h3><?php echo esc_html($pit['spotlight']); ?></h3>
            </div>
            <div class="pkm-pokemon-spotlight-grid">
                <?php
                $spotlight_pokemon = array(
                    array('id'=>25,  'type'=>'Electric','type_color'=>'#F8D030'),
                    array('id'=>6,   'type'=>'Fire',    'type_color'=>'#F08030'),
                    array('id'=>150, 'type'=>'Psychic', 'type_color'=>'#F85888'),
                    array('id'=>248, 'type'=>'Rock',    'type_color'=>'#B8A038'),
                    array('id'=>384, 'type'=>'Dragon',  'type_color'=>'#6F35FC'),
                    array('id'=>716, 'type'=>'Fairy',   'type_color'=>'#EE99AC'),
                );
                foreach($spotlight_pokemon as $pkm):
                    $pkm_name = isset($sp_names[$pkm['id']]) ? $sp_names[$pkm['id']] : 'Pokémon';
                ?>
                <a href="<?php echo esc_url($tc_url); ?>" class="pkm-spotlight-card" style="text-decoration:none">
                    <div class="pkm-spotlight-img-wrap">
                        <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/<?php echo $pkm['id']; ?>.png"
                             alt="<?php echo esc_attr($pkm_name); ?>"
                             loading="lazy"
                             onerror="this.style.opacity='0.3'">
                    </div>
                    <strong><?php echo esc_html($pkm_name); ?></strong>
                    <span class="pkm-type-chip" style="background:<?php echo esc_attr($pkm['type_color']); ?>22;color:<?php echo esc_attr($pkm['type_color']); ?>;border:1px solid <?php echo esc_attr($pkm['type_color']); ?>55"><?php echo esc_html($pkm['type']); ?></span>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div><!-- /row 1 -->

    <!-- Row 2: 3-column — Generation Timeline + Type Quick Ref + Stats -->
    <div class="pkm-info-row pkm-info-row-3col">

        <!-- Generation Timeline -->
        <div class="pkm-info-card">
            <div class="pkm-info-card-header">
                <div class="pkm-info-icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                </div>
                <h3><?php echo esc_html($pit['generations']); ?></h3>
            </div>
            <div class="pkm-gen-timeline">
                <?php
                $gens = array(
                    array('gen'=>'Gen I',   'year'=>'1996','game'=>'Red & Blue',      'count'=>151,  'color'=>'#0D9488'),
                    array('gen'=>'Gen II',  'year'=>'1999','game'=>'Gold & Silver',   'count'=>251,  'color'=>'#F4D03F'),
                    array('gen'=>'Gen III', 'year'=>'2002','game'=>'Ruby & Sapphire', 'count'=>386,  'color'=>'#2ECC71'),
                    array('gen'=>'Gen IV',  'year'=>'2006','game'=>'Diamond & Pearl', 'count'=>493,  'color'=>'#6890F0'),
                    array('gen'=>'Gen V',   'year'=>'2010','game'=>'Black & White',   'count'=>649,  'color'=>'#A0A0A0'),
                    array('gen'=>'Gen VI',  'year'=>'2013','game'=>'X & Y',           'count'=>721,  'color'=>'#A33EA1'),
                    array('gen'=>'Gen VII', 'year'=>'2016','game'=>'Sun & Moon',      'count'=>809,  'color'=>'#FF7518'),
                    array('gen'=>'Gen VIII','year'=>'2019','game'=>'Sword & Shield',  'count'=>905,  'color'=>'#6F35FC'),
                    array('gen'=>'Gen IX',  'year'=>'2022','game'=>'Scarlet & Violet','count'=>1025, 'color'=>'#0D9488'),
                );
                foreach($gens as $g):
                ?>
                <div class="pkm-gen-row">
                    <div class="pkm-gen-dot" style="background:<?php echo esc_attr($g['color']); ?>"></div>
                    <div class="pkm-gen-info">
                        <strong><?php echo esc_html($g['gen']); ?></strong>
                        <span><?php echo esc_html($g['game']); ?> &bull; <?php echo esc_html($g['year']); ?></span>
                    </div>
                    <div class="pkm-gen-count" style="color:<?php echo esc_attr($g['color']); ?>"><?php echo $g['count']; ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Type Quick Reference -->
        <div class="pkm-info-card">
            <div class="pkm-info-card-header">
                <div class="pkm-info-icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m14.5 12.5-8 8a2.119 2.119 0 0 1-3-3l8-8"/><path d="m16 16 6-6"/><path d="m8 8 6-6"/></svg>
                </div>
                <h3><?php echo esc_html($pit['type_quick']); ?></h3>
            </div>
            <div class="pkm-type-quick-grid">
                <?php foreach($pit['types'] as $t): ?>
                <div class="pkm-type-ref-card">
                    <div class="pkm-type-ref-badge" style="background:<?php echo esc_attr($t['color']); ?>"><?php echo esc_html($t['type']); ?></div>
                    <div class="pkm-type-ref-detail">
                        <div class="pkm-type-eff">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#2ECC71" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="12" height="12"><polyline points="20 6 9 17 4 12"/></svg>
                            <span><?php echo esc_html($t['strong']); ?></span>
                        </div>
                        <div class="pkm-type-eff pkm-type-eff-weak">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#0D9488" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="12" height="12"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            <span><?php echo esc_html($t['weak']); ?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="pkm-info-card-footer">
                <a href="<?php echo esc_url($tc_url); ?>" class="pkm-btn pkm-btn-primary" style="font-size:0.8125rem;padding:10px 20px">
                    <?php echo esc_html($pit['full_type_chart']); ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>
        </div>

        <!-- Pokémon by the Numbers (stat card) -->
        <div class="pkm-info-card pkm-info-card-stats">
            <div class="pkm-info-card-header">
                <div class="pkm-info-icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                </div>
                <h3><?php echo esc_html($pit['by_numbers']); ?></h3>
            </div>
            <div class="pkm-stat-numbers">
                <?php
                $stat_nums = array(
                    array('icon'=>'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><circle cx="12" cy="12" r="3"/></svg>','value'=>'1,025+','label_key'=>'total_species','color'=>'var(--pkm-primary)'),
                    array('icon'=>'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>','value'=>'18','label_key'=>'pkm_types','color'=>'#F4D03F'),
                    array('icon'=>'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>','value'=>'9','label_key'=>'generations_lbl','color'=>'#2ECC71'),
                    array('icon'=>'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>','value'=>'780','label_key'=>'max_base_stat','color'=>'#6890F0'),
                    array('icon'=>'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>','value'=>'898','label_key'=>'main_series','color'=>'#F08030'),
                    array('icon'=>'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c6.23-.05 7.87-5.57 7.5-10-.36-4.34-3.95-9.96-7.5-10-3.55.04-7.14 5.66-7.5 10-.37 4.43 1.27 9.95 7.5 10z"/></svg>','value'=>'200+','label_key'=>'legendary','color'=>'#A33EA1'),
                );
                foreach($stat_nums as $sn):
                ?>
                <div class="pkm-stat-number-item">
                    <div class="pkm-stat-num-icon" style="color:<?php echo $sn['color']; ?>;background:<?php echo $sn['color']; ?>18"><?php echo $sn['icon']; ?></div>
                    <div class="pkm-stat-num-value" style="color:<?php echo $sn['color']; ?>"><?php echo $sn['value']; ?></div>
                    <div class="pkm-stat-num-label"><?php echo esc_html($pit[$sn['label_key']]); ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div><!-- /row 2 -->
</section>


<!-- How It Works -->
<section class="pkm-how" aria-labelledby="how-title">
    <div class="pkm-section-title">
        <h2 id="how-title"><?php pkm_e('how_title'); ?></h2>
    </div>
    <div class="pkm-how-grid">
        <div class="pkm-how-step">
            <div class="pkm-how-number">
                <?php echo $svg['target']; ?>
            </div>
            <h3><?php pkm_e('how_step1_title'); ?></h3>
            <p><?php pkm_e('how_step1_desc'); ?></p>
        </div>
        <div class="pkm-how-step">
            <div class="pkm-how-number">
                <?php echo $svg['cp']; ?>
            </div>
            <h3><?php pkm_e('how_step2_title'); ?></h3>
            <p><?php pkm_e('how_step2_desc'); ?></p>
        </div>
        <div class="pkm-how-step">
            <div class="pkm-how-number">
                <?php echo $svg['zap']; ?>
            </div>
            <h3><?php pkm_e('how_step3_title'); ?></h3>
            <p><?php pkm_e('how_step3_desc'); ?></p>
        </div>
    </div>
</section>

<!-- Trust Section -->
<section class="pkm-trust" aria-labelledby="trust-title">
    <div class="pkm-section-title">
        <h2 id="trust-title"><?php pkm_e('trust_title'); ?></h2>
    </div>
    <div class="pkm-trust-grid">
        <div class="pkm-trust-item">
            <div class="pkm-trust-icon"><?php echo $svg['check']; ?></div>
            <h3><?php pkm_e('trust_accuracy_title'); ?></h3>
            <p><?php pkm_e('trust_accuracy_desc'); ?></p>
        </div>
        <div class="pkm-trust-item">
            <div class="pkm-trust-icon"><?php echo $svg['gift']; ?></div>
            <h3><?php pkm_e('trust_free_title'); ?></h3>
            <p><?php pkm_e('trust_free_desc'); ?></p>
        </div>
        <div class="pkm-trust-item">
            <div class="pkm-trust-icon"><?php echo $svg['speed']; ?></div>
            <h3><?php pkm_e('trust_fast_title'); ?></h3>
            <p><?php pkm_e('trust_fast_desc'); ?></p>
        </div>
        <div class="pkm-trust-item">
            <div class="pkm-trust-icon"><?php echo $svg['refresh']; ?></div>
            <h3><?php pkm_e('trust_updated_title'); ?></h3>
            <p><?php pkm_e('trust_updated_desc'); ?></p>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="pkm-testimonials" aria-labelledby="testimonials-title">
    <div class="pkm-section-title">
        <h2 id="testimonials-title">What Trainers Say</h2>
        <p>Trusted by millions of Pokemon players worldwide</p>
    </div>
    <div class="pkm-testimonials-grid">
        <?php
        $testimonials = array(
            array(
                'name'   => 'AshKetchumFan99',
                'role'   => 'Pokemon GO — Level 50',
                'stars'  => 5,
                'avatar' => 'AK',
                'color'  => '#0D9488',
                'text'   => 'The IV calculator is insanely accurate. I found a perfect 100% Mewtwo thanks to this site. My whole raid group uses it now — nothing comes close.',
            ),
            array(
                'name'   => 'MistyWaterflower',
                'role'   => 'VGC Regionals Competitor',
                'stars'  => 5,
                'avatar' => 'MW',
                'color'  => '#6890F0',
                'text'   => 'The team builder and speed tier calculator helped me build my first Worlds-qualifying team. The data is always up to date with the latest format. Essential tool.',
            ),
            array(
                'name'   => 'BrockTakeshi',
                'role'   => 'Pokemon Sword — Shiny Hunter',
                'stars'  => 5,
                'avatar' => 'BT',
                'color'  => '#78C850',
                'text'   => 'I use the type chart every single day. It is fast, complete, and works perfectly on mobile while I am playing. Saved me from so many bad matchups in ranked.',
            ),
            array(
                'name'   => 'TrainerGary',
                'role'   => 'Pokemon GO Coordinator',
                'stars'  => 5,
                'avatar' => 'TG',
                'color'  => '#F4D03F',
                'text'   => 'Available in Spanish too! Perfect for my whole group. The CP calculator works perfectly for all evolution planning. We use it before every community day.',
            ),
            array(
                'name'   => 'EliteFourDrake',
                'role'   => 'Smogon OU Ladder Top 100',
                'stars'  => 5,
                'avatar' => 'ED',
                'color'  => '#7038F8',
                'text'   => 'The damage calculator covers every edge case — weather, terrain, items, abilities. I stopped using Showdown calculator because this one is cleaner and faster.',
            ),
            array(
                'name'   => 'PokéProfOak',
                'role'   => 'Pokedex Completionist',
                'stars'  => 5,
                'avatar' => 'PO',
                'color'  => '#F08030',
                'text'   => 'Finally a site that explains natures and EVs properly with an actual calculator. The evolution planner with candy cost estimates is incredible for Pokemon GO.',
            ),
        );
        foreach ($testimonials as $t) :
        ?>
        <div class="pkm-testimonial-card">
            <div class="pkm-testimonial-quote"><?php echo $svg['quote']; ?></div>
            <p class="pkm-testimonial-text"><?php echo esc_html($t['text']); ?></p>
            <div class="pkm-testimonial-stars">
                <?php for($s=0; $s<$t['stars']; $s++) echo '<span class="pkm-star">' . $svg['star'] . '</span>'; ?>
            </div>
            <div class="pkm-testimonial-author">
                <div class="pkm-testimonial-avatar" style="--avatar-color:<?php echo esc_attr($t['color']); ?>"><?php echo esc_html($t['avatar']); ?></div>
                <div>
                    <strong><?php echo esc_html($t['name']); ?></strong>
                    <span><?php echo esc_html($t['role']); ?></span>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Blog Section — pulls real WordPress posts -->
<section class="pkm-blog" aria-labelledby="blog-title">
    <div class="pkm-section-title">
        <h2 id="blog-title"><?php pkm_e('blog_title'); ?></h2>
        <p><?php pkm_e('blog_subtitle'); ?></p>
    </div>
    <div class="pkm-blog-grid">
        <?php
        /* Try to pull real blog posts first */
        $blog_posts = get_posts( array(
            'numberposts' => 3,
            'post_status' => 'publish',
            'orderby'     => 'date',
            'order'       => 'DESC',
        ) );

        /* Icon fallbacks for placeholder cards */
        $placeholder_icons = array( $svg['iv'], $svg['type'], $svg['cp'] );
        $placeholder_data  = array(
            array(
                'title'    => 'How to Calculate Perfect IVs in Pokemon GO',
                'excerpt'  => 'Learn the secrets to finding perfect IV Pokemon and understanding the appraisal system to maximise your team.',
                'cat'      => 'Guide',
                'date'     => 'Jan 15, 2026',
                'icon_idx' => 0,
            ),
            array(
                'title'    => 'Mastering Type Matchups for VGC 2026',
                'excerpt'  => 'Dominate the competitive scene with our comprehensive type coverage guide for the current VGC format.',
                'cat'      => 'Competitive',
                'date'     => 'Jan 12, 2026',
                'icon_idx' => 1,
            ),
            array(
                'title'    => 'Best CP Calculators for Every Generation',
                'excerpt'  => 'Compare CP calculation methods across all Pokemon games from Gen 1 to Gen 9 and find the right tool.',
                'cat'      => 'Tips',
                'date'     => 'Jan 10, 2026',
                'icon_idx' => 2,
            ),
        );

        if ( ! empty( $blog_posts ) ) :
            foreach ( $blog_posts as $post ) :
                $thumb = get_the_post_thumbnail( $post->ID, 'medium' );
                $cats  = get_the_category( $post->ID );
                $cat   = ! empty( $cats ) ? $cats[0]->name : 'Article';
        ?>
        <article class="pkm-blog-card">
            <div class="pkm-blog-image pkm-blog-image--real">
                <?php if ( $thumb ) : ?>
                    <?php echo $thumb; ?>
                <?php else : ?>
                    <div class="pkm-blog-image-placeholder"><?php echo $placeholder_icons[0]; ?></div>
                <?php endif; ?>
            </div>
            <div class="pkm-blog-content">
                <div class="pkm-blog-meta">
                    <span class="pkm-blog-category"><?php echo esc_html( $cat ); ?></span>
                    <span><?php echo get_the_date( 'M j, Y', $post ); ?></span>
                </div>
                <h3><a href="<?php echo esc_url( get_permalink( $post ) ); ?>"><?php echo esc_html( get_the_title( $post ) ); ?></a></h3>
                <p><?php echo esc_html( wp_trim_words( get_the_excerpt( $post ), 18 ) ); ?></p>
                <a href="<?php echo esc_url( get_permalink( $post ) ); ?>" class="pkm-blog-read-more">
                    <?php pkm_e('blog_read_more'); ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>
        </article>
        <?php endforeach;
        else :
            /* No posts yet — show nicely styled placeholder cards */
            foreach ( $placeholder_data as $ph ) :
        ?>
        <article class="pkm-blog-card">
            <div class="pkm-blog-image"><?php echo $placeholder_icons[ $ph['icon_idx'] ]; ?></div>
            <div class="pkm-blog-content">
                <div class="pkm-blog-meta">
                    <span class="pkm-blog-category"><?php echo esc_html( $ph['cat'] ); ?></span>
                    <span><?php echo esc_html( $ph['date'] ); ?></span>
                </div>
                <h3><a href="<?php echo esc_url( home_url('/blog/') ); ?>"><?php echo esc_html( $ph['title'] ); ?></a></h3>
                <p><?php echo esc_html( $ph['excerpt'] ); ?></p>
                <a href="<?php echo esc_url( home_url('/blog/') ); ?>" class="pkm-blog-read-more">
                    <?php pkm_e('blog_read_more'); ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>
        </article>
        <?php endforeach;
        endif;
        wp_reset_postdata();
        ?>
    </div>
    <div class="pkm-blog-view-all">
        <a href="<?php echo esc_url( home_url('/blog/') ); ?>" class="pkm-btn pkm-btn-primary">
            <?php pkm_e('blog_view_all'); ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </a>
    </div>
</section>

<!-- FAQ Section -->
<section class="pkm-faq" aria-labelledby="faq-title">
    <div class="pkm-section-title">
        <h2 id="faq-title"><?php pkm_e('faq_title'); ?></h2>
    </div>
    <div class="pkm-faq-list">
        <?php for ($qi = 1; $qi <= 5; $qi++) : ?>
        <div class="pkm-faq-item">
            <button class="pkm-faq-question" onclick="this.parentElement.classList.toggle('active')">
                <?php pkm_e('faq_q' . $qi); ?>
            </button>
            <div class="pkm-faq-answer"><p><?php pkm_e('faq_a' . $qi); ?></p></div>
        </div>
        <?php endfor; ?>
    </div>
</section>

<!-- CTA Section -->
<section class="pkm-cta" aria-labelledby="cta-title">
    <div class="pkm-cta-inner">
        <h2 id="cta-title"><?php pkm_e('cta_title'); ?></h2>
        <p><?php pkm_e('cta_subtitle'); ?></p>
        <a href="<?php echo esc_url(home_url('/calculators/')); ?>" class="pkm-btn pkm-btn-secondary">
            <?php pkm_e('cta_button'); ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </a>
    </div>
</section>

<script>
/* Tools grid: category filter + expand/collapse */
(function() {

    /* Category tab filter */
    window.pkmFilterCat = function(btn, cat) {
        // Update active tab
        document.querySelectorAll('.pkm-cat-tab').forEach(function(t){ t.classList.remove('active'); });
        btn.classList.add('active');

        // Show/hide cards — also respect the hidden toggle state
        var allCards = document.querySelectorAll('.pkm-tool-card');
        var visibleCount = 0;
        allCards.forEach(function(card) {
            var cardCat = card.getAttribute('data-cat');
            var matchesCat = (cat === 'all' || cardCat === cat);
            if (matchesCat) {
                card.style.display = '';   // show (let toggle handle extra hidden)
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Hide toggle button when a specific cat is chosen (all always visible)
        var toggleWrap = document.getElementById('pkm-tools-toggle-wrap');
        if (toggleWrap) {
            toggleWrap.style.display = cat === 'all' ? '' : 'none';
        }
    };

    /* Expand/collapse extra tools — after showing all, reveal "View All Calculators" link */
    window.pkmToggleTools = function() {
        var cards   = document.querySelectorAll('.pkm-tool-hidden');
        var chevD   = document.getElementById('pkm-toggle-chevron-down');
        var chevU   = document.getElementById('pkm-toggle-chevron-up');
        var label   = document.getElementById('pkm-tools-toggle-label');
        var allLink = document.getElementById('pkm-all-tools-link');
        var isHidden = cards[0] && cards[0].classList.contains('pkm-tool-hidden');
        cards.forEach(function(c){ c.classList.toggle('pkm-tool-hidden'); });
        chevD.style.display = isHidden ? 'none'  : 'block';
        chevU.style.display = isHidden ? 'block' : 'none';
        label.textContent   = isHidden ? 'Show Less' : 'Show All Tools';
        // Show "View All Calculators" button after user expands
        if (allLink) allLink.style.display = isHidden ? 'inline-flex' : 'none';
    };
})();
</script>

    <?php