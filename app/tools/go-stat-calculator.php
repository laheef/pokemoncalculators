<?php
// Standalone PHP

/*
 * ============================================================
 * Pokemon GO Stat Calculator
 * File: wp-content/themes/theme-v1.3.0/pkm-calculators/pkm-go-stat-calculator.php
 * Register: require_once get_stylesheet_directory() . '/pkm-calculators/pkm-go-stat-calculator.php';
 * Shortcode: [pkm_go_stat_calc]
 * ============================================================
 *
 * LANGUAGE SWITCHER SETUP — REQUIRED
 * Add the following line to the $slug_map array inside
 * the pkm_get_lang_url() function in functions.php:
 *
 * 'pokemon-go-stat-calculator' => array('es' => 'calculadora-estadisticas-pokemon-go', 'pt-br' => 'calculadora-stats-pokemon-go', 'fr' => 'calculateur-statistiques-pokemon-go', 'de' => 'pokemon-go-stats-rechner'),
 *
 * ============================================================
 */

// ── Google Analytics ────────────────────────────────────────
if ( ! function_exists('pkm_go_stat_gtag') ) {
    function pkm_go_stat_gtag() {
        if ( ! is_page([
            'pokemon-go-stat-calculator',
            'calculadora-estadisticas-pokemon-go',
            'calculadora-stats-pokemon-go',
            'calculateur-statistiques-pokemon-go',
            'pokemon-go-stats-rechner',
        ]) ) return;
        ?>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-PJWFG8GEPM"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', 'G-PJWFG8GEPM');
        </script>
        <?php
    }
    add_action( 'wp_head', 'pkm_go_stat_gtag', 1 );
}

// ── Hreflang ─────────────────────────────────────────────────
if ( ! function_exists('pkm_go_stat_hreflang') ) {
    function pkm_go_stat_hreflang() {
        if ( ! is_page([
            'pokemon-go-stat-calculator',
            'calculadora-estadisticas-pokemon-go',
            'calculadora-stats-pokemon-go',
            'calculateur-statistiques-pokemon-go',
            'pokemon-go-stats-rechner',
        ]) ) return;
        $langs = [ 'en', 'es', 'pt-br', 'fr', 'de' ];
        foreach ( $langs as $l ) {
            $hreflang = ( $l === 'pt-br' ) ? 'pt-BR' : $l;
            echo '<link rel="alternate" hreflang="' . esc_attr( $hreflang ) . '" href="' . esc_url( pkm_get_lang_url( $l ) ) . '">' . "\n";
        }
        echo '<link rel="alternate" hreflang="x-default" href="' . esc_url( pkm_get_lang_url( 'en' ) ) . '">' . "\n";
    }
    add_action( 'wp_head', 'pkm_go_stat_hreflang' );
}

// ── Canonical ─────────────────────────────────────────────────
if ( ! function_exists('pkm_go_stat_canonical') ) {
    function pkm_go_stat_canonical() {
        if ( ! is_page([
            'pokemon-go-stat-calculator',
            'calculadora-estadisticas-pokemon-go',
            'calculadora-stats-pokemon-go',
            'calculateur-statistiques-pokemon-go',
            'pokemon-go-stats-rechner',
        ]) ) return;
        $url = ( is_ssl() ? 'https' : 'http' ) . '://' . sanitize_text_field( $_SERVER['HTTP_HOST'] ?? '' ) . sanitize_text_field( $_SERVER['REQUEST_URI'] ?? '' );
        echo '<link rel="canonical" href="' . esc_url( $url ) . '">' . "\n";
    }
    add_action( 'wp_head', 'pkm_go_stat_canonical' );
}

// ── Schema ────────────────────────────────────────────────────
if ( ! function_exists('pkm_go_stat_schema') ) {
    function pkm_go_stat_schema() {
        if ( ! is_page([
            'pokemon-go-stat-calculator',
            'calculadora-estadisticas-pokemon-go',
            'calculadora-stats-pokemon-go',
            'calculateur-statistiques-pokemon-go',
            'pokemon-go-stats-rechner',
        ]) ) return;
        global $pkm_current_lang;
        $lang    = $pkm_current_lang ?? 'en';
        $cur_url = ( is_ssl() ? 'https' : 'http' ) . '://' . sanitize_text_field( $_SERVER['HTTP_HOST'] ?? '' ) . sanitize_text_field( $_SERVER['REQUEST_URI'] ?? '' );
        $schema  = [
            '@context' => 'https://schema.org',
            '@graph'   => [
                [
                    '@type'           => 'WebApplication',
                    'name'            => 'Pokemon GO Stat Calculator',
                    'url'             => esc_url( $cur_url ),
                    'description'     => 'Calculate CP, HP, and effective stats for any Pokemon GO Pokemon using base stats, level, and IVs.',
                    'applicationCategory' => 'GameApplication',
                    'inLanguage'      => $lang,
                    'offers'          => [ '@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD' ],
                ],
                [
                    '@type' => 'HowTo',
                    'name'  => 'How to use the Pokemon GO Stat Calculator',
                    'step'  => [
                        [ '@type' => 'HowToStep', 'position' => 1, 'text' => 'step1_placeholder' ],
                        [ '@type' => 'HowToStep', 'position' => 2, 'text' => 'step2_placeholder' ],
                        [ '@type' => 'HowToStep', 'position' => 3, 'text' => 'step3_placeholder' ],
                        [ '@type' => 'HowToStep', 'position' => 4, 'text' => 'step4_placeholder' ],
                    ],
                ],
               
                [
                    '@type'           => 'BreadcrumbList',
                    'itemListElement' => [
                        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Home',        'item' => home_url( '/' . $lang . '/' ) ],
                        [ '@type' => 'ListItem', 'position' => 2, 'name' => 'Calculators', 'item' => home_url( '/' . $lang . '/calculators/' ) ],
                        [ '@type' => 'ListItem', 'position' => 3, 'name' => 'Pokemon GO Stat Calculator', 'item' => esc_url( $cur_url ) ],
                    ],
                ],
            ],
        ];
        echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
    }
    add_action( 'wp_head', 'pkm_go_stat_schema' );
}

// ── Strings ───────────────────────────────────────────────────
$pkm_go_stat_strings = [
    'en' => [
        // UI
        'title'                => 'Pokemon GO Stat Calculator',
        'description'          => 'Calculate CP, HP & effective stats for any Pokemon. Enter your IVs and level to see exact values instantly.',
        'search_placeholder'   => 'Search Pokemon...',
        'level_label'          => 'Level',
        'iv_attack_label'      => 'Attack IV',
        'iv_defense_label'     => 'Defense IV',
        'iv_stamina_label'     => 'Stamina IV',
        'best_ivs_btn'         => 'Best IVs (15/15/15)',
        'calculate_btn'        => 'Calculate Stats',
        'reset_btn'            => 'Reset',
        'result_cp'            => 'Combat Power (CP)',
        'result_hp'            => 'Hit Points (HP)',
        'result_eff_atk'       => 'Effective Attack',
        'result_eff_def'       => 'Effective Defense',
        'result_eff_sta'       => 'Effective Stamina',
        'result_iv_pct'        => 'IV Perfection',
        'result_title'         => 'Stat Results',
        'base_stats_label'     => 'Base Stats',
        'base_atk'             => 'Base Atk',
        'base_def'             => 'Base Def',
        'base_sta'             => 'Base Sta',
        'noscript_msg'         => 'JavaScript is required to use this calculator. Please enable JS in your browser.',
        // Errors
        'error_data_load'      => 'Could not load Pokemon data. Please refresh the page.',
        'error_select_pokemon' => 'Please select a Pokemon.',
        'error_invalid_level'  => 'Level must be between 1 and 50.',
        'error_invalid_iv'     => 'IV values must be between 0 and 15.',
        'error_no_results'     => 'No Pokemon found matching your search.',
        'error_calculation'    => 'Calculation error. Please check your inputs.',
        // SEO content (filled by Prompt 2)
        'meta_title'           => 'Pokemon GO Stat Calculator | CP, HP & IV Stats',
        'meta_desc'            => 'Calculate exact CP, HP, Attack, Defense and Stamina stats for any Pokemon GO Pokemon. Enter your IVs and level — instant results, all 900+ Pokemon included.',
        'intro_title'          => 'What Does the Pokemon GO Stat Calculator Show You?',
        'intro_content'        => '<p>The <strong>Pokemon GO Stat Calculator</strong> computes the exact CP, HP, and effective Attack, Defense, and Stamina values for any Pokemon at any level from 1 to 50, using your specific Individual Values (IVs). Unlike the in-game appraisal system, which only gives you a range, this tool shows you the precise number — so you always know exactly what your Pokemon is working with before committing Stardust and Candy.</p><p>Every stat in Pokemon GO is determined by three inputs: the Pokemon\'s base stats (fixed per species), your Pokemon\'s IVs (a hidden value between 0 and 15 for each of Attack, Defense, and Stamina), and the <strong>CP Multiplier</strong> at your current level. The calculator applies the official Niantic formulas to all three and instantly delivers CP, HP, and all five effective stat values. This matters most when comparing two of the same species — for example, choosing between a 96% IV Dragonite at Level 40 versus a 91% IV Dragonite at Level 50.</p><p>Stat knowledge directly improves your raid performance, PvP team-building, and Stardust budgeting. A Mewtwo with 15 Attack IVs hits significantly harder than one with 10, and knowing that difference before you power up saves hundreds of thousands of Stardust. Use the <a href="https://pokemoncalculator.online/en/pokemon-go-iv-calculator/">IV calculator</a> to first identify your Pokemon\'s IVs from the appraisal screen, then plug those values into the stat calculator above to see the exact output. For a complete overview of all available tools, visit the <a href="https://pokemoncalculator.online/calculators/">Pokemon calculators hub</a>.</p>',
        'howto_title'          => 'How to Use the Pokemon GO Stat Calculator',
        'howto_step1'          => 'Type your Pokemon\'s name into the <strong>Search Pokemon</strong> field and select it from the dropdown. The tool instantly loads its base Attack, Defense, and Stamina stats beneath the search bar so you can verify you\'ve selected the right one.',
        'howto_step2'          => 'Set the <strong>Level</strong> slider to your Pokemon\'s current level. Levels go from 1 to 50 in half-step increments — Buddy or Mega levels use 0.5 steps. The level display updates in real time as you drag the slider.',
        'howto_step3'          => 'Enter your IVs (0–15) for <strong>Attack IV</strong>, <strong>Defense IV</strong>, and <strong>Stamina IV</strong> using the sliders or the number inputs. Hit <strong>Best IVs (15/15/15)</strong> to instantly test a perfect 100% IV scenario.',
        'howto_step4'          => 'Press <strong>Calculate Stats</strong>. The result card displays CP, HP, Effective Attack, Defense, Stamina, and your IV Perfection percentage. Use these values to decide whether to power up, trade, or search for a stronger specimen.',
        'info_title'           => 'How Pokemon GO Stats Are Calculated: Formulas & Strategy',
        'info_content'         => '<p>Understanding how stats work in Pokemon GO is the difference between spending 100,000 Stardust wisely and wasting it. Every Pokemon\'s in-battle performance comes down to three <strong>effective stats</strong> — Effective Attack, Effective Defense, and Effective Stamina — all derived from a straightforward formula that this calculator applies automatically.</p><h3>The Core Formulas</h3><p><strong>CP Formula:</strong><br>CP = floor( (BaseAtk + IVAtk)<sup>0.5</sup> × (BaseDef + IVDef)<sup>0.25</sup> × (BaseSta + IVSta)<sup>0.25</sup> × CPM<sup>2</sup> ÷ 10 )</p><p><strong>HP Formula:</strong><br>HP = max(10, floor( (BaseSta + IVSta) × CPM ))</p><p><strong>Effective Stats:</strong><br>Effective Attack = (BaseAtk + IVAtk) × CPM<br>Effective Defense = (BaseDef + IVDef) × CPM<br>Effective Stamina = (BaseSta + IVSta) × CPM</p><p>The <strong>CP Multiplier (CPM)</strong> is a level-dependent scalar that Niantic has defined for every half-level from 1.0 to 50.0. At Level 1, CPM is approximately 0.0940. At Level 40 (the old cap), CPM is 0.7903. At Level 50 (the current maximum with XL Candy), CPM reaches 0.8426. Because the CP formula squares the CPM, small level increases near Level 40–50 produce large CP jumps — which is why powering a Pokemon from Level 40 to 50 is so Stardust-intensive.</p><h3>Why IVs Matter Less Than You Think — and More Than You Think</h3><p>A common misconception among newer players is that a 100% IV Pokemon is dramatically stronger than a 0% IV one. In reality, IVs contribute at most 15 extra points on top of base stats. For a Pokemon like Mewtwo (base Attack 300), 15 Attack IVs versus 0 Attack IVs is a ~4.8% difference in Effective Attack. That\'s meaningful in a close raid DPS race, but it won\'t change whether you clear a five-star raid. However, for <strong>PvP in the Great or Ultra League</strong>, IVs become critical because CP caps force you to pick the right level, and some IV spreads outperform others for bulk or attack priority. Always verify with the stat calculator above before locking in a power-up decision.</p><h3>Level 40 vs Level 50: Is the Investment Worth It?</h3><p>Powering from Level 40 to 50 requires XL Candy — a scarce resource. The stat gain from L40 to L50 is roughly 6–7% across all effective stats. For casual raid players, this is rarely worth it. For competitive PvP or leaderboard-chasing raid teams, it can be decisive. Use the calculator to compare your specific Pokemon at both levels before spending XL Candy. Also pair your analysis with the <a href="https://pokemoncalculator.online/en/stardust-calculator/">Stardust calculator</a> to understand the full Stardust cost before committing.</p><h3>Base Stats Explained</h3><p>Base stats are species-wide — every Garchomp of the same form shares the same base Attack (261), Defense (193), and Stamina (239). They are derived from the main series games but re-scaled for Pokemon GO. Pokemon with asymmetric base stats (high Attack, lower Defense) perform differently in raids (where raw damage per second matters) versus PvP (where bulk and shield pressure also count). The <a href="https://pokemoncalculator.online/en/type-chart/">type chart</a> pairs with stat analysis to give you a complete battle picture — knowing your effective Attack is meaningless without knowing which types you\'re super-effective against. Browse all planning tools at the <a href="https://pokemoncalculator.online/calculators/">calculators hub</a>.</p>',
        'info_table_title'     => 'CP Multiplier (CPM) Values by Level — Bulbapedia Verified',
        'info_table_html'      => '<table class="pkm-calc-table"><thead><tr><th>Level</th><th>CPM Value</th><th>CPM²</th><th>Note</th></tr></thead><tbody><tr><td>1</td><td>0.09399414</td><td>0.008835</td><td>Minimum level</td></tr><tr><td>5</td><td>0.21573247</td><td>0.046540</td><td>Early game</td></tr><tr><td>10</td><td>0.32108760</td><td>0.103097</td><td>—</td></tr><tr><td>15</td><td>0.39956728</td><td>0.159654</td><td>—</td></tr><tr><td>20</td><td>0.48437500</td><td>0.234619</td><td><span class="pkm-table-note-badge">Wild catch cap</span></td></tr><tr><td>25</td><td>0.55432109</td><td>0.307272</td><td>—</td></tr><tr><td>30</td><td>0.61281972</td><td>0.375548</td><td><span class="pkm-table-note-badge">Weather boost cap</span></td></tr><tr><td>35</td><td>0.66187500</td><td>0.438079</td><td>—</td></tr><tr><td>40</td><td>0.79030001</td><td>0.624574</td><td><span class="pkm-table-note-badge">Old level cap</span></td></tr><tr><td>45</td><td>0.82172942</td><td>0.675239</td><td>XL Candy required</td></tr><tr><td>50</td><td>0.84265016</td><td>0.710059</td><td><span class="pkm-table-note-badge">Current max</span></td></tr></tbody></table>',
        'faq_title'            => 'Frequently Asked Questions',
        'faq_q1'=>'How are Pokemon GO stats calculated?',
        'faq_a1'=>'Pokemon GO stats are calculated using base stats (fixed per species), Individual Values (IVs, 0–15 per stat), and a CP Multiplier (CPM) tied to the Pokemon\'s level. Effective Attack = (Base Attack + IV Attack) × CPM, and the same formula applies to Defense and Stamina. CP uses a more complex formula: floor( (BaseAtk + IVAtk)^0.5 × (BaseDef + IVDef)^0.25 × (BaseSta + IVSta)^0.25 × CPM² ÷ 10 ). HP is calculated as floor( (BaseSta + IVSta) × CPM ), with a minimum of 10.',
        'faq_q2'=>'How are future Pokemon GO stats calculated?',
        'faq_a2'=>'Future Pokemon GO stats — for unreleased species — are estimated by dataminers and community researchers using base stats extracted from the game\'s APK or GAME_MASTER file. Niantic stores base stats server-side, but the formulas are the same. Sites like Bulbapedia and GamePress publish projected stats for upcoming Pokemon based on main-series data re-scaled to GO\'s formula. Once officially released in-game, stats are confirmed and calculators update accordingly.',
        'faq_q3'=>'How are Pokemon stats calculated in Pokemon GO?',
        'faq_a3'=>'In Pokemon GO, each Pokemon has three base stats (Attack, Defense, Stamina) unique to its species or form. These combine with hidden IV values (0–15) and a level-based CP Multiplier to produce effective stats. Unlike the main series, Pokemon GO uses only these three effective stats in battle — there are no separate Special Attack or Speed stats. Damage output in raids and PvP is calculated using Effective Attack and the opponent\'s Effective Defense, adjusted for type modifiers.',
        'faq_q4'=>'How to calculate Pokemon GO stats exactly?',
        'faq_a4'=>'To calculate Pokemon GO stats exactly, you need three inputs: your Pokemon\'s base stats (found on Bulbapedia or via this tool\'s auto-lookup), your IVs (found via the in-game appraisal + an IV calculator), and your Pokemon\'s level (estimated from CP and appraisal or confirmed via powering up). Enter all three into the Pokemon GO Stat Calculator above and press Calculate Stats. The tool returns precise CP, HP, Effective Attack, Effective Defense, and Effective Stamina values using Niantic\'s verified formulas.',
        'faq_q5'=>'What is IV Perfection and how is it calculated?',
        'faq_a5'=>'IV Perfection is the percentage of the maximum possible IVs your Pokemon has. It is calculated as (Attack IV + Defense IV + Stamina IV) ÷ 45 × 100. The denominator is 45 because each of the three IVs maxes out at 15 (15 × 3 = 45). A Pokemon with 15/15/15 IVs is 100% perfect. One with 0/0/0 is 0%. Most raid-caught Pokemon have a guaranteed minimum of 10/10/10 (66.7%). The stat calculator above displays IV Perfection as a percentage bar after every calculation.',
        'faq_q6'=>'Does level or IVs matter more for CP in Pokemon GO?',
        'faq_a6'=>'Level matters significantly more than IVs for CP in Pokemon GO. The CP Multiplier at Level 50 (0.8426) is nearly nine times larger than at Level 1 (0.0940). Because CPM is squared in the CP formula, each level increase multiplies the CP output substantially. IVs only add up to 15 extra points to each base stat. As a rule of thumb, powering up one level gains more CP than going from 0% IVs to 100% IVs at the same level. That said, IVs are permanent — you cannot change them — while Stardust can always be earned again.',
        'faq_q7'=>'What is the maximum CP a Pokemon can have in Pokemon GO?',
        'faq_a7'=>'The maximum CP in Pokemon GO depends on the Pokemon\'s species and the current level cap of 50. Slaking holds the record with a maximum CP of 5010 at Level 50 with perfect IVs, followed by Regigigas (4913), Mewtwo (4724 standard, higher with Mega Evolution), and Zacian/Zamazenta in their crowned forms. Shadow Pokemon can technically exceed these values with the 1.2× attack multiplier during battle, but their displayed CP does not change. Enter any Pokemon into the stat calculator above to find its exact maximum CP at any level.',
        'faq_q8'=>'How do weather boosts affect Pokemon GO stats?',
        'faq_a8'=>'Weather boosts in Pokemon GO do not change a Pokemon\'s base stats or IVs. Instead, weather-boosted Pokemon are found in the wild at higher levels — specifically Level 25–35 instead of the standard cap of Level 20–30. This effectively increases their CP and all effective stats because those are level-dependent. Additionally, moves of the weather-boosted type deal 20% more damage in battle (a separate multiplier). The stat calculator reflects the stats at any level you choose, so you can compare a Level 30 weather-boosted catch versus a Level 20 standard catch side by side.',
    ],
    'es' => [
        'title'                => 'Calculadora de Estadísticas Pokemon GO',
        'description'          => 'Calcula el PC, PS y estadísticas efectivas de cualquier Pokemon. Introduce tus IVs y nivel para ver los valores exactos al instante.',
        'search_placeholder'   => 'Buscar Pokemon...',
        'level_label'          => 'Nivel',
        'iv_attack_label'      => 'IV de Ataque',
        'iv_defense_label'     => 'IV de Defensa',
        'iv_stamina_label'     => 'IV de Resistencia',
        'best_ivs_btn'         => 'Mejores IVs (15/15/15)',
        'calculate_btn'        => 'Calcular Estadísticas',
        'reset_btn'            => 'Reiniciar',
        'result_cp'            => 'Puntos de Combate (PC)',
        'result_hp'            => 'Puntos de Salud (PS)',
        'result_eff_atk'       => 'Ataque Efectivo',
        'result_eff_def'       => 'Defensa Efectiva',
        'result_eff_sta'       => 'Resistencia Efectiva',
        'result_iv_pct'        => 'Perfección de IVs',
        'result_title'         => 'Resultados de Estadísticas',
        'base_stats_label'     => 'Estadísticas Base',
        'base_atk'             => 'Atq. Base',
        'base_def'             => 'Def. Base',
        'base_sta'             => 'Res. Base',
        'noscript_msg'         => 'Se necesita JavaScript para usar esta calculadora. Por favor activa JS en tu navegador.',
        'error_data_load'      => 'No se pudieron cargar los datos de Pokemon. Por favor recarga la página.',
        'error_select_pokemon' => 'Por favor selecciona un Pokemon.',
        'error_invalid_level'  => 'El nivel debe estar entre 1 y 50.',
        'error_invalid_iv'     => 'Los valores de IV deben estar entre 0 y 15.',
        'error_no_results'     => 'No se encontraron Pokemon que coincidan con tu búsqueda.',
        'error_calculation'    => 'Error de cálculo. Por favor revisa tus entradas.',
        'meta_title'       => 'Calculadora Estadísticas Pokemon GO | PC, PS e IVs',
        'meta_desc'        => 'Calcula PC, PS, Ataque, Defensa y Resistencia exactos para cualquier Pokemon GO. Ingresa tus IVs y nivel — resultados instantáneos con todos los Pokemon incluidos.',
        'intro_title'      => '¿Qué calcula la Calculadora de Estadísticas Pokemon GO?',
        'intro_content'    => '<p>La <strong>Calculadora de Estadísticas Pokemon GO</strong> determina el PC, PS y los valores efectivos de Ataque, Defensa y Resistencia de cualquier Pokemon en cualquier nivel, usando tus IVs individuales. A diferencia del sistema de valoración del juego —que solo te da rangos— esta herramienta te muestra el número exacto, para que sepas exactamente con qué cuenta tu Pokemon antes de gastar Polvo Estelar y Caramelos.</p><p>Cada estadística en Pokemon GO depende de tres factores: las <strong>estadísticas base</strong> de la especie (fijas), los IVs de tu Pokemon (un valor oculto entre 0 y 15 para Ataque, Defensa y Resistencia), y el <strong>Multiplicador de PC (CPM)</strong> correspondiente al nivel actual. La calculadora aplica las fórmulas oficiales de Niantic y entrega al instante el PC, PS y los cinco valores de estadísticas efectivas.</p><p>Conocer tus estadísticas marca la diferencia en incursiones, combates de entrenador y a la hora de administrar tu Polvo Estelar. Un Garchomp con IV de Ataque 15 hace una diferencia real frente a uno con IV 8, especialmente en Liga Ultra donde los puntos de PC están limitados. Usa primero la <a href="https://pokemoncalculator.online/es/calculadora-cp-pokemon/">calculadora de PC</a> para ver cómo cambia el poder de combate con cada nivel, y consulta la <a href="https://pokemoncalculator.online/es/tabla-de-tipos/">tabla de tipos</a> para planificar tus batallas completas. Explora todas las herramientas disponibles en el <a href="https://pokemoncalculator.online/calculators/">hub de calculadoras Pokemon</a>.</p>',
        'howto_title'      => 'Cómo usar la Calculadora de Estadísticas Pokemon GO',
        'howto_step1'      => 'Escribe el nombre de tu Pokemon en el campo <strong>Buscar Pokemon</strong> y selecciónalo del menú desplegable. Las estadísticas base de Ataque, Defensa y Resistencia aparecen automáticamente bajo el buscador para confirmar que elegiste el correcto.',
        'howto_step2'      => 'Ajusta el control deslizante de <strong>Nivel</strong> al nivel actual de tu Pokemon. Los niveles van del 1 al 50 en incrementos de medio nivel — los niveles de Compañero y Mega usan pasos de 0,5. El indicador de nivel se actualiza en tiempo real.',
        'howto_step3'      => 'Ingresa tus IVs (0–15) de <strong>IV de Ataque</strong>, <strong>IV de Defensa</strong> e <strong>IV de Resistencia</strong> con los sliders o los campos numéricos. Presiona <strong>Mejores IVs (15/15/15)</strong> para simular al instante un escenario de IVs perfectos al 100%.',
        'howto_step4'      => 'Pulsa <strong>Calcular Estadísticas</strong>. La tarjeta de resultados muestra PC, PS, Ataque Efectivo, Defensa Efectiva, Resistencia Efectiva y el porcentaje de perfección de IVs. Usa estos datos para decidir si conviene mejorar, intercambiar o buscar un ejemplar más fuerte.',
        'info_title'       => 'Cómo se Calculan las Estadísticas en Pokemon GO: Fórmulas y Estrategia',
        'info_content'     => '<p>Entender cómo funcionan las estadísticas en Pokemon GO es la diferencia entre invertir 100.000 de Polvo Estelar con criterio o malgastarlo. El rendimiento en combate de cualquier Pokemon depende de tres <strong>estadísticas efectivas</strong>: Ataque Efectivo, Defensa Efectiva y Resistencia Efectiva, todas derivadas de fórmulas concretas que esta calculadora aplica automáticamente.</p><h3>Las Fórmulas Principales</h3><p><strong>Fórmula del PC:</strong><br>PC = piso( (AtkBase + IVAtk)<sup>0,5</sup> × (DefBase + IVDef)<sup>0,25</sup> × (ResBase + IVRes)<sup>0,25</sup> × CPM² ÷ 10 )</p><p><strong>Fórmula de PS:</strong><br>PS = máx(10, piso( (ResBase + IVRes) × CPM ))</p><p><strong>Estadísticas Efectivas:</strong><br>Ataque Efectivo = (AtkBase + IVAtk) × CPM<br>Defensa Efectiva = (DefBase + IVDef) × CPM<br>Resistencia Efectiva = (ResBase + IVRes) × CPM</p><p>El <strong>Multiplicador de PC (CPM)</strong> es un escalar que depende del nivel y que Niantic ha definido para cada medio nivel del 1,0 al 50,0. En nivel 1, el CPM es aproximadamente 0,0940. En nivel 40 (el antiguo límite), el CPM es 0,7903. En nivel 50 (el máximo actual con Caramelos XL), el CPM alcanza 0,8426. Como la fórmula eleva el CPM al cuadrado, los aumentos de nivel cercanos al 40–50 generan grandes subidas de PC.</p><h3>¿Cuánto importan los IVs en LatAm?</h3><p>Una idea errónea frecuente entre los jugadores de la comunidad latinoamericana es que un Pokemon con IVs perfectos es muchísimo más poderoso que uno con IVs bajos. En realidad, los IVs solo agregan hasta 15 puntos extra sobre las estadísticas base. Para un Mewtwo (base Ataque 300), tener IV de Ataque 15 versus 0 supone apenas un ~4,8% de diferencia en Ataque Efectivo. Es relevante en una incursión reñida, pero no determinará si puedes completar una incursión de 5 estrellas solo. Donde los IVs importan más es en la <strong>Liga de Combate GO</strong>: en la Liga Especial o Ultra, ciertos spreads de IVs ofrecen ventajas de bulto o prioridad de ataque que pueden decidir un combate. Verifica siempre con la calculadora de estadísticas antes de confirmar una mejora.</p><h3>Nivel 40 vs Nivel 50: ¿Vale la pena el Caramelo XL?</h3><p>Subir de nivel 40 a 50 requiere Caramelos XL, un recurso escaso. La ganancia de estadísticas de L40 a L50 es aproximadamente de un 6–7% en todas las estadísticas efectivas. Para jugadores casuales de incursiones, raramente compensa. Para competidores de la Liga de Combate o hunters de máxima puntuación en incursiones, puede ser decisivo. Usa la calculadora para comparar tu Pokemon específico en ambos niveles y combínalo con la <a href="https://pokemoncalculator.online/es/calculadora-polvo-estelar/">calculadora de Polvo Estelar</a> para entender el costo total antes de comprometerte. Consulta todas las herramientas en el <a href="https://pokemoncalculator.online/calculators/">hub de calculadoras</a>.</p><h3>Estadísticas Base Explicadas</h3><p>Las estadísticas base son iguales para todos los Pokemon de la misma especie y forma. Un Garchomp siempre tiene base Ataque 261, base Defensa 193 y base Resistencia 239. Pokemon con estadísticas asimétricas —alto Ataque, Defensa moderada— rinden diferente en incursiones (donde importa el daño por segundo) que en PvP (donde la resistencia y la presión de escudo también cuentan). Revisa la <a href="https://pokemoncalculator.online/es/tabla-de-tipos/">tabla de tipos</a> junto a tus estadísticas para tener una visión de batalla completa.</p>',
        'info_table_title' => 'Valores del Multiplicador de PC (CPM) por Nivel',
        'info_table_html'  => '<table class="pkm-calc-table"><thead><tr><th>Nivel</th><th>Valor CPM</th><th>CPM²</th><th>Nota</th></tr></thead><tbody><tr><td>1</td><td>0,09399414</td><td>0,008835</td><td>Nivel mínimo</td></tr><tr><td>5</td><td>0,21573247</td><td>0,046540</td><td>Inicio del juego</td></tr><tr><td>10</td><td>0,32108760</td><td>0,103097</td><td>—</td></tr><tr><td>20</td><td>0,48437500</td><td>0,234619</td><td><span class="pkm-table-note-badge">Tope captura</span></td></tr><tr><td>30</td><td>0,61281972</td><td>0,375548</td><td><span class="pkm-table-note-badge">Boost meteorológico</span></td></tr><tr><td>35</td><td>0,66187500</td><td>0,438079</td><td>—</td></tr><tr><td>40</td><td>0,79030001</td><td>0,624574</td><td><span class="pkm-table-note-badge">Antiguo tope</span></td></tr><tr><td>45</td><td>0,82172942</td><td>0,675239</td><td>Caramelos XL</td></tr><tr><td>50</td><td>0,84265016</td><td>0,710059</td><td><span class="pkm-table-note-badge">Máximo actual</span></td></tr></tbody></table>',
        'faq_title'        => 'Preguntas Frecuentes',
        'faq_q1'=>'¿Cómo se calculan las estadísticas en Pokemon GO?',
        'faq_a1'=>'Las estadísticas en Pokemon GO se calculan usando las estadísticas base de la especie, los Valores Individuales (IVs del 0 al 15 por cada estadística) y el Multiplicador de PC (CPM), que varía según el nivel. Ataque Efectivo = (Ataque Base + IV Ataque) × CPM; la misma fórmula aplica a Defensa y Resistencia. El PC usa: piso( (AtkBase + IVAtk)^0,5 × (DefBase + IVDef)^0,25 × (ResBase + IVRes)^0,25 × CPM² ÷ 10 ). Los PS se calculan como piso( (ResBase + IVRes) × CPM ), con un mínimo de 10.',
        'faq_q2'=>'¿Cómo se calculan las estadísticas de los Pokemon futuros en GO?',
        'faq_a2'=>'Las estadísticas de Pokemon no lanzados se estiman a partir del archivo GAME_MASTER del juego, que dataminers de la comunidad extraen de las actualizaciones de la APK. Niantic almacena las estadísticas base en sus servidores, pero las fórmulas son las mismas. Sitios como Bulbapedia y GamePress publican proyecciones basadas en las estadísticas de los juegos principales reescaladas a la fórmula de GO. Una vez que Niantic lanza oficialmente el Pokemon, las estadísticas se confirman y los calculadores se actualizan.',
        'faq_q3'=>'¿Qué IVs son mejores para la Liga de Combate GO?',
        'faq_a3'=>'En la Liga de Combate GO, los mejores IVs dependen de la liga. En la Liga Especial (1500 PC), frecuentemente se buscan IVs con Ataque bajo (como 0/15/15) para maximizar el nivel —y por ende la resistencia— sin exceder el límite de PC. En la Liga Ultra (2500 PC) ocurre algo similar. En la Liga Maestra, sin límite de PC, los IVs perfectos 15/15/15 son siempre óptimos. Usa la calculadora de estadísticas arriba para comparar distintos spreads de IVs a diferentes niveles y encontrar el punto óptimo para tu liga.',
        'faq_q4'=>'¿Cómo calcular exactamente las estadísticas de mi Pokemon en GO?',
        'faq_a4'=>'Para calcular las estadísticas exactas de tu Pokemon en GO necesitas tres datos: las estadísticas base de la especie (disponibles en Bulbapedia o automáticamente en esta herramienta), tus IVs (obtenidos mediante valoración en el juego más un calculador de IVs) y el nivel de tu Pokemon (estimado a partir del PC o confirmado al mejorar). Introduce los tres en la Calculadora de Estadísticas Pokemon GO de arriba y presiona Calcular Estadísticas. El resultado muestra PC, PS, Ataque, Defensa y Resistencia Efectivos con las fórmulas verificadas de Niantic.',
        'faq_q5'=>'¿Cuál es el PC máximo posible en Pokemon GO?',
        'faq_a5'=>'El PC máximo en Pokemon GO depende de la especie y del límite de nivel actual (50). Slaking tiene el mayor PC base con 5.010 a nivel 50 con IVs perfectos, seguido de Regigigas (4.913) y Mewtwo (4.724 en forma estándar). Los Pokemon Sombra tienen un multiplicador de Ataque de 1,2× durante el combate, pero su PC mostrado no cambia. Las Mega Evoluciones aumentan los stats durante el combate sin reflejarse en el PC mostrado. Ingresa cualquier Pokemon en la calculadora de estadísticas arriba para conocer su PC máximo exacto.',
        'faq_q6'=>'¿Importa más el nivel o los IVs para el PC en Pokemon GO?',
        'faq_a6'=>'El nivel tiene mucho mayor impacto que los IVs en el PC de Pokemon GO. El Multiplicador de PC al nivel 50 (0,8426) es casi nueve veces mayor que al nivel 1 (0,0940). Dado que el CPM se eleva al cuadrado en la fórmula del PC, cada aumento de nivel genera una gran subida de PC. Los IVs solo añaden hasta 15 puntos extra por estadística. Como regla general, subir un nivel genera más PC que pasar de 0% a 100% de IVs en el mismo nivel. Sin embargo, los IVs son permanentes: no se pueden cambiar, mientras que el Polvo Estelar siempre se puede volver a ganar.',
        'faq_q7'=>'¿Qué significa el boost meteorológico en las estadísticas?',
        'faq_a7'=>'El boost meteorológico en Pokemon GO no cambia las estadísticas base ni los IVs de un Pokemon. Lo que hace es que los Pokemon capturados en estado salvaje con boost aparezcan a niveles más altos —específicamente nivel 25–35 en lugar del límite estándar de nivel 20–30— lo que incrementa su PC y todas sus estadísticas efectivas porque éstas dependen del nivel. Además, los movimientos del tipo favorecido por el clima hacen un 20% más de daño en combate (un multiplicador separado). La calculadora refleja las estadísticas al nivel que elijas.',
        'faq_q8'=>'¿Qué diferencia hay entre estadísticas en raid e incursión versus PvP?',
        'faq_a8'=>'En incursiones y combates contra gimnasios, el Ataque Efectivo del atacante y la Defensa Efectiva del defensor determinan el daño, ajustado por modificadores de tipo. Los niveles altos y el IV de Ataque son prioritarios en este contexto. En PvP —Liga de Combate GO— la dinámica es diferente: el límite de PC obliga a elegir el nivel correcto, y el bulto (Defensa Efectiva × PS) muchas veces vale más que el Ataque Efectivo puro. Los mejores jugadores de la comunidad latinoamericana analizan sus Pokemon con la calculadora para cada liga por separado antes de invertir Polvo Estelar. Usa la calculadora arriba para comparar distintos escenarios.',
    ],
    'pt-br' => [
        'title'                => 'Calculadora de Stats Pokemon GO',
        'description'          => 'Calcule PC, PS e stats efetivos de qualquer Pokemon. Insira seus IVs e nível para ver os valores exatos instantaneamente.',
        'search_placeholder'   => 'Pesquisar Pokemon...',
        'level_label'          => 'Nível',
        'iv_attack_label'      => 'IV de Ataque',
        'iv_defense_label'     => 'IV de Defesa',
        'iv_stamina_label'     => 'IV de Stamina',
        'best_ivs_btn'         => 'Melhores IVs (15/15/15)',
        'calculate_btn'        => 'Calcular Stats',
        'reset_btn'            => 'Resetar',
        'result_cp'            => 'Pontos de Combate (PC)',
        'result_hp'            => 'Pontos de Vida (PS)',
        'result_eff_atk'       => 'Ataque Efetivo',
        'result_eff_def'       => 'Defesa Efetiva',
        'result_eff_sta'       => 'Stamina Efetiva',
        'result_iv_pct'        => 'Perfeição de IVs',
        'result_title'         => 'Resultado das Stats',
        'base_stats_label'     => 'Stats Base',
        'base_atk'             => 'Atq. Base',
        'base_def'             => 'Def. Base',
        'base_sta'             => 'Sta. Base',
        'noscript_msg'         => 'JavaScript é necessário para usar esta calculadora. Por favor habilite JS no seu navegador.',
        'error_data_load'      => 'Não foi possível carregar os dados do Pokemon. Por favor atualize a página.',
        'error_select_pokemon' => 'Por favor selecione um Pokemon.',
        'error_invalid_level'  => 'O nível deve estar entre 1 e 50.',
        'error_invalid_iv'     => 'Os valores de IV devem estar entre 0 e 15.',
        'error_no_results'     => 'Nenhum Pokemon encontrado para sua pesquisa.',
        'error_calculation'    => 'Erro de cálculo. Por favor verifique suas entradas.',
        'meta_title'       => 'Calculadora de Stats Pokemon GO | PC, PS e IVs Exatos',
        'meta_desc'        => 'Calcule PC, PS, Ataque, Defesa e Stamina exatos para qualquer Pokemon GO. Insira seus IVs e nível — resultados instantâneos com todos os Pokemon incluídos.',
        'intro_title'      => 'O que a Calculadora de Stats Pokemon GO Mostra?',
        'intro_content'    => '<p>A <strong>Calculadora de Stats Pokemon GO</strong> calcula o PC, PS e os valores efetivos de Ataque, Defesa e Stamina de qualquer Pokemon em qualquer nível de 1 a 50, usando os seus IVs individuais. Diferente do sistema de avaliação do jogo — que só fornece faixas aproximadas — esta ferramenta mostra o número exato, para que você saiba precisamente o que seu Pokemon tem antes de gastar Pó Estelar e Doce.</p><p>Cada stat no Pokemon GO é determinado por três fatores: as <strong>stats base</strong> da espécie (fixas), os IVs do seu Pokemon (um valor oculto entre 0 e 15 para Ataque, Defesa e Stamina) e o <strong>Multiplicador de PC (CPM)</strong> correspondente ao nível atual. A calculadora aplica as fórmulas oficiais da Niantic e entrega instantaneamente PC, PS e os cinco valores de stats efetivos.</p><p>No Brasil, a comunidade Pokemon GO é uma das mais ativas do mundo — grupos no WhatsApp e Facebook organizam raids diariamente, e saber os stats exatos do seu Pokemon pode ser o diferencial em uma incursão de 5 estrelas. Use a <a href="https://pokemoncalculator.online/pt-br/calculadora-pc-pokemon/">calculadora de PC</a> para comparar poderes de combate por nível, verifique a <a href="https://pokemoncalculator.online/pt-br/tabela-de-tipos/">tabela de tipos</a> para planejar vantagens de tipo e acesse o <a href="https://pokemoncalculator.online/calculators/">hub de calculadoras Pokemon</a> para todas as ferramentas disponíveis.</p>',
        'howto_title'      => 'Como Usar a Calculadora de Stats Pokemon GO',
        'howto_step1'      => 'Digite o nome do seu Pokemon no campo <strong>Pesquisar Pokemon</strong> e selecione-o no menu suspenso. As stats base de Ataque, Defesa e Stamina aparecem automaticamente abaixo da barra de pesquisa para confirmar que você escolheu o correto.',
        'howto_step2'      => 'Ajuste o controle deslizante de <strong>Nível</strong> para o nível atual do seu Pokemon. Os níveis vão de 1 a 50 em incrementos de meio nível — níveis de Companheiro e Mega usam passos de 0,5. O indicador de nível atualiza em tempo real conforme você arrasta.',
        'howto_step3'      => 'Insira seus IVs (0–15) de <strong>IV de Ataque</strong>, <strong>IV de Defesa</strong> e <strong>IV de Stamina</strong> pelos sliders ou campos numéricos. Clique em <strong>Melhores IVs (15/15/15)</strong> para simular instantaneamente o cenário de IVs perfeitos a 100%.',
        'howto_step4'      => 'Pressione <strong>Calcular Stats</strong>. O cartão de resultados exibe PC, PS, Ataque Efetivo, Defesa Efetiva, Stamina Efetiva e o percentual de perfeição dos IVs. Use esses valores para decidir se vale a pena evoluir, trocar ou buscar um exemplar melhor.',
        'info_title'       => 'Como as Stats São Calculadas no Pokemon GO: Fórmulas e Estratégia',
        'info_content'     => '<p>Entender como as stats funcionam no Pokemon GO é o que separa quem usa 100.000 de Pó Estelar com estratégia de quem o desperdiça. O desempenho de qualquer Pokemon em batalha depende de três <strong>stats efetivas</strong> — Ataque Efetivo, Defesa Efetiva e Stamina Efetiva — todas derivadas de fórmulas específicas que esta calculadora aplica automaticamente.</p><h3>As Fórmulas Principais</h3><p><strong>Fórmula do PC:</strong><br>PC = piso( (AtkBase + IVAtk)<sup>0,5</sup> × (DefBase + IVDef)<sup>0,25</sup> × (StaBase + IVSta)<sup>0,25</sup> × CPM² ÷ 10 )</p><p><strong>Fórmula do PS:</strong><br>PS = máx(10, piso( (StaBase + IVSta) × CPM ))</p><p><strong>Stats Efetivos:</strong><br>Ataque Efetivo = (AtkBase + IVAtk) × CPM<br>Defesa Efetiva = (DefBase + IVDef) × CPM<br>Stamina Efetiva = (StaBase + IVSta) × CPM</p><p>O <strong>Multiplicador de PC (CPM)</strong> é um escalar que depende do nível, definido pela Niantic para cada meio nível de 1,0 a 50,0. No nível 1, o CPM é aproximadamente 0,0940. No nível 40 (o antigo limite), o CPM é 0,7903. No nível 50 (o máximo atual com Doce XL), o CPM chega a 0,8426. Como a fórmula eleva o CPM ao quadrado, pequenos aumentos de nível perto do 40–50 geram grandes saltos de PC — por isso subir de nível 40 para 50 consome tanto Pó Estelar.</p><h3>IVs no Contexto Brasileiro</h3><p>Uma confusão comum na comunidade brasileira é achar que um Pokemon com IVs perfeitos é dramaticamente mais forte que um com IVs baixos. Na prática, os IVs só adicionam no máximo 15 pontos extras sobre as stats base. Para um Mewtwo (base Ataque 300), ter IV de Ataque 15 versus 0 representa apenas ~4,8% de diferença no Ataque Efetivo. É relevante em uma raid disputada, mas não vai determinar se você completa uma incursão de 5 estrelas sozinho. Onde os IVs realmente importam é na <strong>Liga de Batalha GO</strong>: na Liga Super ou Ultra, certos spreads de IV oferecem vantagens de tanque ou prioridade de ataque que podem decidir um confronto. Sempre verifique com a calculadora de stats antes de confirmar uma evolução cara.</p><h3>Nível 40 vs Nível 50: Vale a Pena o Doce XL?</h3><p>Subir de nível 40 para 50 requer Doce XL — um recurso escasso. O ganho de stats do L40 para o L50 é aproximadamente 6–7% em todas as stats efetivas. Para jogadores casuais de raids, raramente compensa. Para quem compete na Liga de Batalha ou quer liderar o DPS em raids difíceis, pode ser decisivo. Use a calculadora para comparar seu Pokemon específico nos dois níveis antes de gastar Doce XL. Combine com a <a href="https://pokemoncalculator.online/pt-br/calculadora-po-estelar/">calculadora de Pó Estelar</a> para entender o custo total. Veja todas as ferramentas no <a href="https://pokemoncalculator.online/calculators/">hub de calculadoras</a>.</p><h3>Stats Base Explicadas</h3><p>As stats base são iguais para todos os Pokemon da mesma espécie e forma — todo Dragonite tem base Ataque 263, base Defesa 198 e base Stamina 209. Pokemon com stats assimétricas rendem diferente em raids (onde o DPS é rei) do que no PvP (onde resistência e pressão de escudo também contam). Acesse a <a href="https://pokemoncalculator.online/pt-br/tabela-de-tipos/">tabela de tipos</a> junto com suas stats para ter uma visão completa de batalha.</p>',
        'info_table_title' => 'Valores do Multiplicador de PC (CPM) por Nível',
        'info_table_html'  => '<table class="pkm-calc-table"><thead><tr><th>Nível</th><th>Valor CPM</th><th>CPM²</th><th>Observação</th></tr></thead><tbody><tr><td>1</td><td>0,09399414</td><td>0,008835</td><td>Nível mínimo</td></tr><tr><td>5</td><td>0,21573247</td><td>0,046540</td><td>Início do jogo</td></tr><tr><td>10</td><td>0,32108760</td><td>0,103097</td><td>—</td></tr><tr><td>20</td><td>0,48437500</td><td>0,234619</td><td><span class="pkm-table-note-badge">Limite captura</span></td></tr><tr><td>30</td><td>0,61281972</td><td>0,375548</td><td><span class="pkm-table-note-badge">Boost climático</span></td></tr><tr><td>35</td><td>0,66187500</td><td>0,438079</td><td>—</td></tr><tr><td>40</td><td>0,79030001</td><td>0,624574</td><td><span class="pkm-table-note-badge">Teto antigo</span></td></tr><tr><td>45</td><td>0,82172942</td><td>0,675239</td><td>Doce XL necessário</td></tr><tr><td>50</td><td>0,84265016</td><td>0,710059</td><td><span class="pkm-table-note-badge">Máximo atual</span></td></tr></tbody></table>',
        'faq_title'        => 'Perguntas Frequentes',
        'faq_q1'=>'Como as stats do Pokemon GO são calculadas?',
        'faq_a1'=>'As stats do Pokemon GO são calculadas usando stats base (fixas por espécie), Valores Individuais (IVs, de 0 a 15 por stat) e um Multiplicador de PC (CPM) que depende do nível. Ataque Efetivo = (Ataque Base + IV Ataque) × CPM; a mesma lógica se aplica à Defesa e à Stamina. O PC usa: piso( (AtkBase + IVAtk)^0,5 × (DefBase + IVDef)^0,25 × (StaBase + IVSta)^0,25 × CPM² ÷ 10 ). O PS é calculado como piso( (StaBase + IVSta) × CPM ), com mínimo de 10 pontos.',
        'faq_q2'=>'Como calcular as stats futuras de Pokemon GO?',
        'faq_a2'=>'As stats de Pokemon ainda não lançados são estimadas por dataminers que extraem o arquivo GAME_MASTER das atualizações do APK. A Niantic armazena as stats base em seus servidores, mas as fórmulas são as mesmas. Sites como Bulbapedia e GamePress publicam projeções baseadas nos dados dos jogos principais reescalados para a fórmula do GO. Uma vez que a Niantic lança oficialmente o Pokemon, as stats são confirmadas e calculadoras como esta são atualizadas para refletir os valores corretos.',
        'faq_q3'=>'Como saber os IVs do meu Pokemon no GO?',
        'faq_a3'=>'Para descobrir os IVs do seu Pokemon no GO, use o sistema de avaliação do próprio jogo: toque no Pokemon, selecione "Avaliar" e o Líder da sua equipe indicará a faixa de IVs. Para valores exatos, use um calculador de IVs dedicado que cruza o PC, PS e resultado da avaliação para apontar as combinações possíveis de IV. Com os IVs em mãos, insira-os na Calculadora de Stats Pokemon GO acima para ver todos os stats efetivos e o PC exato do seu Pokemon.',
        'faq_q4'=>'Qual é o PC máximo possível no Pokemon GO?',
        'faq_a4'=>'O PC máximo no Pokemon GO depende da espécie e do limite de nível atual (50). Slaking tem o maior PC base com 5.010 no nível 50 com IVs perfeitos, seguido de Regigigas (4.913) e Mewtwo (4.724 na forma padrão). Pokemon Sombra têm um multiplicador de Ataque de 1,2× durante batalhas, mas o PC exibido não muda. Mega Evoluções aumentam as stats durante o combate sem alterar o PC mostrado. Insira qualquer Pokemon na calculadora acima para saber o PC máximo exato dele.',
        'faq_q5'=>'O que é a Perfeição de IVs e como é calculada?',
        'faq_a5'=>'A Perfeição de IVs é o percentual do máximo possível de IVs que seu Pokemon possui. O cálculo é: (IV Ataque + IV Defesa + IV Stamina) ÷ 45 × 100. O denominador é 45 porque cada IV pode ser no máximo 15 (15 × 3 = 45). Um Pokemon com 15/15/15 em IVs é 100% perfeito. Pokemon capturados em raids de campo de pesquisa ou incursões têm garantia mínima de 10/10/10 (66,7%). A calculadora acima exibe a perfeição de IVs como uma barra de porcentagem após cada cálculo.',
        'faq_q6'=>'Nível ou IVs: o que importa mais para o PC no Pokemon GO?',
        'faq_a6'=>'O nível tem impacto muito maior que os IVs no PC do Pokemon GO. O Multiplicador de PC no nível 50 (0,8426) é quase nove vezes maior que no nível 1 (0,0940). Como o CPM é elevado ao quadrado na fórmula do PC, cada aumento de nível gera um grande salto no PC. Os IVs adicionam no máximo 15 pontos extras por stat. Subir um nível geralmente gera mais PC do que ir de 0% para 100% de IVs no mesmo nível. Dito isso, IVs são permanentes — você não pode mudá-los — enquanto o Pó Estelar pode sempre ser acumulado novamente.',
        'faq_q7'=>'O boost climático altera as stats do Pokemon GO?',
        'faq_a7'=>'O boost climático no Pokemon GO não muda as stats base nem os IVs de um Pokemon. O que ele faz é fazer com que os Pokemon selvagens apareçam em níveis mais altos — especificamente nível 25–35 em vez do limite padrão de nível 20–30. Isso aumenta o PC e todas as stats efetivas porque elas dependem do nível. Além disso, movimentos do tipo favorecido pelo clima causam 20% mais de dano em combate (um multiplicador separado). A calculadora reflete as stats em qualquer nível que você escolher.',
        'faq_q8'=>'Qual a diferença entre stats em Raid e no PvP da Liga de Batalha GO?',
        'faq_a8'=>'Em raids e ginásios, o Ataque Efetivo do atacante e a Defesa Efetiva do defensor determinam o dano, ajustado por modificadores de tipo. Níveis altos e IV de Ataque têm prioridade nesse contexto. Na Liga de Batalha GO, a dinâmica muda: o limite de PC força a escolher o nível certo, e o tanque (Defesa Efetiva × PS) muitas vezes vale mais que o Ataque Efetivo puro. Os melhores jogadores da comunidade brasileira analisam seus Pokemon com a calculadora para cada liga separadamente antes de investir Pó Estelar e Doce. Use a calculadora acima para comparar diferentes cenários.',
    ],
    'fr' => [
        'title'                => 'Calculateur de Statistiques Pokemon GO',
        'description'          => 'Calculez les PC, PS et statistiques effectives de n\'importe quel Pokemon. Entrez vos IVs et votre niveau pour voir les valeurs exactes instantanément.',
        'search_placeholder'   => 'Rechercher un Pokemon...',
        'level_label'          => 'Niveau',
        'iv_attack_label'      => 'IV d\'Attaque',
        'iv_defense_label'     => 'IV de Défense',
        'iv_stamina_label'     => 'IV d\'Endurance',
        'best_ivs_btn'         => 'Meilleurs IVs (15/15/15)',
        'calculate_btn'        => 'Calculer les Stats',
        'reset_btn'            => 'Réinitialiser',
        'result_cp'            => 'Points de Combat (PC)',
        'result_hp'            => 'Points de Vie (PS)',
        'result_eff_atk'       => 'Attaque Effective',
        'result_eff_def'       => 'Défense Effective',
        'result_eff_sta'       => 'Endurance Effective',
        'result_iv_pct'        => 'Perfection des IVs',
        'result_title'         => 'Résultats des Stats',
        'base_stats_label'     => 'Stats de Base',
        'base_atk'             => 'Atq. Base',
        'base_def'             => 'Déf. Base',
        'base_sta'             => 'End. Base',
        'noscript_msg'         => 'JavaScript est requis pour utiliser cette calculatrice. Veuillez activer JS dans votre navigateur.',
        'error_data_load'      => 'Impossible de charger les données Pokemon. Veuillez actualiser la page.',
        'error_select_pokemon' => 'Veuillez sélectionner un Pokemon.',
        'error_invalid_level'  => 'Le niveau doit être compris entre 1 et 50.',
        'error_invalid_iv'     => 'Les valeurs d\'IV doivent être comprises entre 0 et 15.',
        'error_no_results'     => 'Aucun Pokemon trouvé correspondant à votre recherche.',
        'error_calculation'    => 'Erreur de calcul. Veuillez vérifier vos entrées.',
        'meta_title'       => 'Calculateur Stats Pokemon GO | PC, PS et IVs Exacts',
        'meta_desc'        => 'Calculez les PC, PS, Attaque, Défense et Endurance exacts de n\'importe quel Pokemon GO. Entrez vos IVs et niveau — résultats instantanés, tous les Pokemon inclus.',
        'intro_title'      => 'À quoi sert le Calculateur de Statistiques Pokemon GO ?',
        'intro_content'    => '<p>Le <strong>Calculateur de Statistiques Pokemon GO</strong> détermine le PC, les PS et les valeurs effectives d\'Attaque, de Défense et d\'Endurance de n\'importe quel Pokemon à n\'importe quel niveau de 1 à 50, en utilisant vos Valeurs Individuelles (IV). Contrairement au système d\'évaluation du jeu — qui ne donne que des fourchettes — cet outil affiche le chiffre précis, pour que vous sachiez exactement ce que vaut votre Pokemon avant d\'investir de la Poussière d\'Étoile et des Bonbons.</p><p>Chaque statistique dans Pokemon GO est déterminée par trois éléments : les <strong>statistiques de base</strong> de l\'espèce (fixes), les IV de votre Pokemon (une valeur cachée entre 0 et 15 pour l\'Attaque, la Défense et l\'Endurance) et le <strong>Multiplicateur de PC (CPM)</strong> correspondant au niveau actuel. Le calculateur applique les formules officielles de Niantic et livre instantanément le PC, les PS et les cinq valeurs de statistiques effectives.</p><p>Les joueurs compétitifs français — notamment ceux actifs en Ligue de Combat GO — savent que les statistiques exactes peuvent faire la différence entre une victoire serrée et une défaite. Consultez notre <a href="https://pokemoncalculator.online/fr/calculateur-cp-pokemon/">calculateur de PC</a> pour visualiser l\'évolution du Pouvoir de Combat par niveau, vérifiez le <a href="https://pokemoncalculator.online/fr/tableau-des-types/">tableau des types</a> pour planifier vos affinités de combat et retrouvez tous nos outils sur le <a href="https://pokemoncalculator.online/calculators/">hub des calculateurs Pokemon</a>.</p>',
        'howto_title'      => 'Comment utiliser le Calculateur de Statistiques Pokemon GO',
        'howto_step1'      => 'Saisissez le nom de votre Pokemon dans le champ <strong>Rechercher un Pokemon</strong> et sélectionnez-le dans la liste déroulante. Les statistiques de base d\'Attaque, Défense et Endurance s\'affichent automatiquement sous la barre de recherche pour confirmer votre sélection.',
        'howto_step2'      => 'Réglez le curseur de <strong>Niveau</strong> sur le niveau actuel de votre Pokemon. Les niveaux vont de 1 à 50 par demi-paliers — les niveaux Partenaire et Méga utilisent des pas de 0,5. L\'indicateur de niveau se met à jour en temps réel en faisant glisser le curseur.',
        'howto_step3'      => 'Entrez vos IV (0–15) pour <strong>IV d\'Attaque</strong>, <strong>IV de Défense</strong> et <strong>IV d\'Endurance</strong> via les curseurs ou les champs numériques. Cliquez sur <strong>Meilleurs IVs (15/15/15)</strong> pour simuler instantanément le scénario des IV parfaits à 100%.',
        'howto_step4'      => 'Appuyez sur <strong>Calculer les Stats</strong>. La carte de résultats affiche le PC, les PS, l\'Attaque Effective, la Défense Effective, l\'Endurance Effective et le pourcentage de perfection des IV. Utilisez ces valeurs pour décider si vous devrez améliorer, échanger ou chercher un spécimen plus performant.',
        'info_title'       => 'Comment les Statistiques Pokemon GO sont Calculées : Formules et Stratégie',
        'info_content'     => '<p>Comprendre le fonctionnement des statistiques dans Pokemon GO est ce qui distingue un joueur stratège d\'un joueur qui gaspille sa Poussière d\'Étoile. Les performances de combat de tout Pokemon reposent sur trois <strong>statistiques effectives</strong> — Attaque Effective, Défense Effective et Endurance Effective — toutes dérivées de formules précises que ce calculateur applique automatiquement.</p><h3>Les Formules Fondamentales</h3><p><strong>Formule du PC :</strong><br>PC = plancher( (AtkBase + IVAtk)<sup>0,5</sup> × (DéfBase + IVDéf)<sup>0,25</sup> × (EndBase + IVEnd)<sup>0,25</sup> × CPM² ÷ 10 )</p><p><strong>Formule des PS :</strong><br>PS = max(10, plancher( (EndBase + IVEnd) × CPM ))</p><p><strong>Statistiques Effectives :</strong><br>Attaque Effective = (AtkBase + IVAtk) × CPM<br>Défense Effective = (DéfBase + IVDéf) × CPM<br>Endurance Effective = (EndBase + IVEnd) × CPM</p><p>Le <strong>Multiplicateur de PC (CPM)</strong> est un scalaire dépendant du niveau, défini par Niantic pour chaque demi-niveau de 1,0 à 50,0. Au niveau 1, le CPM est d\'environ 0,0940. Au niveau 40 (l\'ancienne limite), il atteint 0,7903. Au niveau 50 (le maximum actuel avec les Bonbons XL), il monte à 0,8426. Comme la formule élève le CPM au carré, chaque augmentation de niveau proche du palier 40–50 produit de forts gains de PC.</p><h3>Les IV en Contexte PvP Français</h3><p>Les joueurs français sont réputés pour leur niveau en Ligue de Combat GO, en particulier en Ligue Super et Ultra. Une idée reçue est que des IV parfaits sont toujours optimaux. Or, en Ligue Super (1 500 PC), des IV avec une Attaque basse — par exemple 0/15/15 — permettent souvent de pousser le niveau maximal sans dépasser le plafond de PC, offrant plus de résistance et de PS. Des IV parfaits 15/15/15 sont idéaux uniquement en Ligue Maître, sans plafond de PC. Vérifiez toujours avec le calculateur de statistiques ci-dessus avant de valider une amélioration coûteuse.</p><h3>Niveau 40 vs Niveau 50 : l\'Investissement en Bonbons XL en Vaut-il la Peine ?</h3><p>Passer du niveau 40 au niveau 50 nécessite des Bonbons XL, une ressource rare. Le gain de statistiques de L40 à L50 est d\'environ 6 à 7 % pour toutes les statistiques effectives. Pour les joueurs occasionnels en raids, cela est rarement rentable. Pour les compétiteurs en Ligue de Combat ou ceux qui cherchent à optimiser leur DPS en raids élite, cela peut être décisif. Utilisez le calculateur pour comparer votre Pokemon spécifique aux deux niveaux. Associez l\'analyse avec le <a href="https://pokemoncalculator.online/fr/calculateur-poussiere-etoile/">calculateur de Poussière d\'Étoile</a> pour évaluer le coût total. Retrouvez tous les outils sur le <a href="https://pokemoncalculator.online/calculators/">hub des calculateurs</a>.</p><h3>Statistiques de Base Expliquées</h3><p>Les statistiques de base sont identiques pour tous les Pokemon de la même espèce et forme. Tout Dracolosse a une base Attaque de 263, une base Défense de 198 et une base Endurance de 209. Les Pokemon aux statistiques asymétriques — forte Attaque, Défense modérée — ont un profil différent en raid (où le DPS brut prime) qu\'en PvP (où la résistance et la pression de bouclier comptent aussi). Consultez le <a href="https://pokemoncalculator.online/fr/tableau-des-types/">tableau des types</a> en complément de vos statistiques pour une analyse de combat complète.</p>',
        'info_table_title' => 'Valeurs du Multiplicateur de PC (CPM) par Niveau',
        'info_table_html'  => '<table class="pkm-calc-table"><thead><tr><th>Niveau</th><th>Valeur CPM</th><th>CPM²</th><th>Remarque</th></tr></thead><tbody><tr><td>1</td><td>0,09399414</td><td>0,008835</td><td>Niveau minimum</td></tr><tr><td>5</td><td>0,21573247</td><td>0,046540</td><td>Début de partie</td></tr><tr><td>10</td><td>0,32108760</td><td>0,103097</td><td>—</td></tr><tr><td>20</td><td>0,48437500</td><td>0,234619</td><td><span class="pkm-table-note-badge">Plafond capture</span></td></tr><tr><td>30</td><td>0,61281972</td><td>0,375548</td><td><span class="pkm-table-note-badge">Boost météo</span></td></tr><tr><td>35</td><td>0,66187500</td><td>0,438079</td><td>—</td></tr><tr><td>40</td><td>0,79030001</td><td>0,624574</td><td><span class="pkm-table-note-badge">Ancienne limite</span></td></tr><tr><td>45</td><td>0,82172942</td><td>0,675239</td><td>Bonbons XL requis</td></tr><tr><td>50</td><td>0,84265016</td><td>0,710059</td><td><span class="pkm-table-note-badge">Maximum actuel</span></td></tr></tbody></table>',
        'faq_title'        => 'Foire Aux Questions',
        'faq_q1'=>'Comment sont calculées les statistiques dans Pokemon GO ?',
        'faq_a1'=>'Les statistiques de Pokemon GO sont calculées à partir des statistiques de base de l\'espèce, des Valeurs Individuelles (IV, de 0 à 15 par statistique) et d\'un Multiplicateur de PC (CPM) lié au niveau. Attaque Effective = (Attaque Base + IV Attaque) × CPM ; la même formule s\'applique à la Défense et à l\'Endurance. Le PC utilise : plancher( (AtkBase + IVAtk)^0,5 × (DéfBase + IVDéf)^0,25 × (EndBase + IVEnd)^0,25 × CPM² ÷ 10 ). Les PS sont calculés avec : plancher( (EndBase + IVEnd) × CPM ), avec un minimum de 10.',
        'faq_q2'=>'Comment sont calculées les futures statistiques Pokemon GO ?',
        'faq_a2'=>'Les statistiques des Pokemon non encore lancés sont estimées par des dataminers qui extraient le fichier GAME_MASTER des mises à jour de l\'APK. Niantic stocke les statistiques de base côté serveur, mais les formules sont identiques. Des sites comme Bulbapedia et GamePress publient des projections basées sur les données des jeux principaux, remises à l\'échelle de la formule GO. Une fois le Pokemon officiellement lancé dans le jeu, les statistiques sont confirmées et les calculateurs se mettent à jour.',
        'faq_q3'=>'Quels IV sont les meilleurs pour la Ligue de Combat GO ?',
        'faq_a3'=>'En Ligue de Combat GO, les meilleurs IV dépendent de la ligue. En Ligue Super (1 500 PC), on recherche souvent des IV avec une faible Attaque — par exemple 0/15/15 — pour maximiser le niveau sans dépasser le plafond de PC, offrant plus de résistance et de PS. En Ligue Ultra (2 500 PC), la même logique s\'applique. En Ligue Maître, sans plafond de PC, les IV parfaits 15/15/15 sont toujours optimaux. Utilisez le calculateur de statistiques pour comparer différents spreads d\'IV à différents niveaux et trouver l\'optimum pour votre ligue.',
        'faq_q4'=>'Comment calculer exactement les statistiques de mon Pokemon GO ?',
        'faq_a4'=>'Pour calculer les statistiques exactes de votre Pokemon GO, vous avez besoin de trois données : les statistiques de base de l\'espèce (disponibles sur Bulbapedia ou automatiquement dans cet outil), vos IV (obtenus via l\'évaluation en jeu et un calculateur d\'IV dédié) et le niveau de votre Pokemon (estimé à partir du PC ou confirmé lors d\'une amélioration). Entrez les trois dans le Calculateur de Statistiques Pokemon GO ci-dessus et appuyez sur Calculer les Stats. Les résultats affichent PC, PS, Attaque, Défense et Endurance Effectives.',
        'faq_q5'=>'Qu\'est-ce que la Perfection des IV et comment est-elle calculée ?',
        'faq_a5'=>'La Perfection des IV représente le pourcentage du maximum d\'IV possibles que possède votre Pokemon. Elle se calcule ainsi : (IV Attaque + IV Défense + IV Endurance) ÷ 45 × 100. Le dénominateur est 45 car chaque IV peut atteindre au maximum 15 (15 × 3 = 45). Un Pokemon avec 15/15/15 est parfait à 100%. Les Pokemon capturés en raids de Terrain de Recherche ont une garantie minimum de 10/10/10 (66,7%). Le calculateur affiche la Perfection des IV sous forme de barre de pourcentage après chaque calcul.',
        'faq_q6'=>'Qu\'est-ce qui compte le plus, le niveau ou les IV, pour le PC dans Pokemon GO ?',
        'faq_a6'=>'Le niveau a un impact bien plus important que les IV sur le PC dans Pokemon GO. Le Multiplicateur de PC au niveau 50 (0,8426) est près de neuf fois supérieur à celui du niveau 1 (0,0940). Comme la formule élève le CPM au carré, chaque hausse de niveau génère un important gain de PC. Les IV n\'ajoutent que 15 points supplémentaires au maximum par statistique. En règle générale, monter d\'un niveau rapporte plus de PC que de passer de 0% à 100% d\'IV au même niveau. Cependant, les IV sont permanents — impossibles à modifier — tandis que la Poussière d\'Étoile peut toujours être refarmée.',
        'faq_q7'=>'Quel est le PC maximum possible dans Pokemon GO ?',
        'faq_a7'=>'Le PC maximum dans Pokemon GO dépend de l\'espèce et du plafond de niveau actuel (50). Ronflex avec sa forme Gigamax détient le record avec 5 010 PC au niveau 50 avec des IV parfaits pour Ramoloss, suivi de Regigigas (4 913) et de Mewtwo (4 724 en forme standard). Les Pokemon Obscurs ont un multiplicateur d\'Attaque de 1,2× en combat, mais leur PC affiché ne change pas. Les Méga Évolutions augmentent les statistiques en combat sans modifier le PC affiché. Entrez n\'importe quel Pokemon dans le calculateur ci-dessus pour connaître son PC maximum exact.',
        'faq_q8'=>'Comment le boost météo affecte-t-il les statistiques des Pokemon GO ?',
        'faq_a8'=>'Le boost météo dans Pokemon GO ne modifie pas les statistiques de base ni les IV d\'un Pokemon. Ce qu\'il fait, c\'est faire apparaître les Pokemon sauvages à des niveaux plus élevés — spécifiquement niveau 25–35 au lieu du plafond standard de niveau 20–30. Cela augmente effectivement leur PC et toutes leurs statistiques effectives car celles-ci dépendent du niveau. De plus, les capacités du type favorisé par la météo infligent 20% de dégâts supplémentaires en combat (un multiplicateur distinct). Le calculateur reflète les statistiques à n\'importe quel niveau que vous choisissez.',
    ],
    'de' => [
        'title'                => 'Pokemon GO Stat Rechner',
        'description'          => 'Berechne KP, KP und effektive Werte für jedes Pokemon. Gib deine IVs und dein Level ein, um sofort genaue Werte zu sehen.',
        'search_placeholder'   => 'Pokemon suchen...',
        'level_label'          => 'Level',
        'iv_attack_label'      => 'Angriff-IV',
        'iv_defense_label'     => 'Verteidigung-IV',
        'iv_stamina_label'     => 'Ausdauer-IV',
        'best_ivs_btn'         => 'Beste IVs (15/15/15)',
        'calculate_btn'        => 'Stats berechnen',
        'reset_btn'            => 'Zurücksetzen',
        'result_cp'            => 'Kampfpunkte (KP)',
        'result_hp'            => 'Trefferpunkte (TP)',
        'result_eff_atk'       => 'Effektiver Angriff',
        'result_eff_def'       => 'Effektive Verteidigung',
        'result_eff_sta'       => 'Effektive Ausdauer',
        'result_iv_pct'        => 'IV-Perfektion',
        'result_title'         => 'Stat-Ergebnisse',
        'base_stats_label'     => 'Basiswerte',
        'base_atk'             => 'Basis-Ang.',
        'base_def'             => 'Basis-Vert.',
        'base_sta'             => 'Basis-Aus.',
        'noscript_msg'         => 'JavaScript wird benötigt, um diesen Rechner zu verwenden. Bitte aktiviere JS in deinem Browser.',
        'error_data_load'      => 'Pokemon-Daten konnten nicht geladen werden. Bitte lade die Seite neu.',
        'error_select_pokemon' => 'Bitte wähle ein Pokemon aus.',
        'error_invalid_level'  => 'Das Level muss zwischen 1 und 50 liegen.',
        'error_invalid_iv'     => 'IV-Werte müssen zwischen 0 und 15 liegen.',
        'error_no_results'     => 'Keine Pokemon gefunden, die deiner Suche entsprechen.',
        'error_calculation'    => 'Berechnungsfehler. Bitte überprüfe deine Eingaben.',
        'meta_title'       => 'Pokemon GO Stat Rechner | KP, KP und IV-Werte',
        'meta_desc'        => 'Berechne genaue KP, TP, Angriff, Verteidigung und Ausdauer für jedes Pokemon GO. Gib deine IVs und Level ein — sofortige Ergebnisse, alle Pokemon inklusive.',
        'intro_title'      => 'Was berechnet der Pokemon GO Stat Rechner?',
        'intro_content'    => '<p>Der <strong>Pokemon GO Stat Rechner</strong> ermittelt die exakten Kampfpunkte (KP), Trefferpunkte (TP) sowie die effektiven Angriffs-, Verteidigungs- und Ausdauerwerte für jedes Pokemon auf jedem Level von 1 bis 50 — basierend auf deinen individuellen IV-Werten. Im Gegensatz zum In-Game-Bewertungssystem, das nur grobe Bereiche anzeigt, liefert dieses Tool den präzisen Zahlenwert, damit du genau weißt, womit du arbeitest, bevor du Sternenstaub und Bonbons investierst.</p><p>Jede Statistik in Pokemon GO ergibt sich aus drei Faktoren: den <strong>Basiswerten</strong> der Spezies (art-spezifisch, unveränderlich), den IV-Werten deines Pokemon (ein versteckter Wert zwischen 0 und 15 für Angriff, Verteidigung und Ausdauer) und dem <strong>KP-Multiplikator (CPM)</strong> des aktuellen Levels. Der Rechner wendet die offiziellen Niantic-Formeln auf alle drei Faktoren an und liefert sofort KP, TP und alle fünf effektiven Statistikwerte.</p><p>Deutsche Spieler schätzen Präzision — und genau das bietet dieser Rechner. Nutze den <a href="https://pokemoncalculator.online/de/kp-rechner-pokemon-go/">KP-Rechner</a>, um Kampfpunkte für verschiedene Levels zu vergleichen, prüfe die <a href="https://pokemoncalculator.online/de/typen-tabelle/">Typen-Tabelle</a> für Typ-Matchups in Kämpfen und finde alle Werkzeuge im <a href="https://pokemoncalculator.online/calculators/">Pokemon Rechner Hub</a>.</p>',
        'howto_title'      => 'So verwendest du den Pokemon GO Stat Rechner',
        'howto_step1'      => 'Gib den Namen deines Pokemon in das Feld <strong>Pokemon suchen</strong> ein und wähle es aus der Dropdown-Liste aus. Die Basiswerte für Angriff, Verteidigung und Ausdauer erscheinen automatisch unter der Suchleiste zur Bestätigung deiner Auswahl.',
        'howto_step2'      => 'Stelle den <strong>Level</strong>-Schieberegler auf das aktuelle Level deines Pokemon ein. Die Levels reichen von 1 bis 50 in Halbschritten — Buddy- und Mega-Levels verwenden 0,5-Schritte. Die Level-Anzeige aktualisiert sich in Echtzeit beim Verschieben des Reglers.',
        'howto_step3'      => 'Gib deine IV-Werte (0–15) für <strong>Angriff-IV</strong>, <strong>Verteidigung-IV</strong> und <strong>Ausdauer-IV</strong> über die Schieberegler oder Zahlenfelder ein. Klicke auf <strong>Beste IVs (15/15/15)</strong>, um sofort das 100%-IV-Szenario zu simulieren.',
        'howto_step4'      => 'Drücke auf <strong>Stats berechnen</strong>. Die Ergebniskarte zeigt KP, TP, effektiven Angriff, effektive Verteidigung, effektive Ausdauer und deinen IV-Perfektion-Prozentsatz. Nutze diese Werte, um zu entscheiden, ob du aufladen, tauschen oder nach einem stärkeren Exemplar suchen solltest.',
        'info_title'       => 'Wie Pokemon GO Statistiken Berechnet Werden: Formeln und Strategie',
        'info_content'     => '<p>Das Verständnis der Statistik-Mechanik in Pokemon GO ist der Unterschied zwischen dem strategischen Einsatz von 100.000 Sternenstaub und seiner Verschwendung. Die Kampfleistung eines jeden Pokemon hängt von drei <strong>effektiven Statistiken</strong> ab — effektiver Angriff, effektive Verteidigung und effektive Ausdauer — alle nach präzisen Formeln berechnet, die dieser Rechner automatisch anwendet.</p><h3>Die Grundformeln</h3><p><strong>KP-Formel:</strong><br>KP = Abrunden( (AtkBasis + IVAtk)<sup>0,5</sup> × (VertBasis + IVVert)<sup>0,25</sup> × (AusBasis + IVAus)<sup>0,25</sup> × CPM² ÷ 10 )</p><p><strong>TP-Formel:</strong><br>TP = max(10, Abrunden( (AusBasis + IVAus) × CPM ))</p><p><strong>Effektive Statistiken:</strong><br>Effektiver Angriff = (AtkBasis + IVAtk) × CPM<br>Effektive Verteidigung = (VertBasis + IVVert) × CPM<br>Effektive Ausdauer = (AusBasis + IVAus) × CPM</p><p>Der <strong>KP-Multiplikator (CPM)</strong> ist ein levelabhängiger Skalar, den Niantic für jeden Halblevel von 1,0 bis 50,0 festgelegt hat. Bei Level 1 beträgt der CPM ca. 0,0940. Bei Level 40 (die alte Obergrenze) liegt er bei 0,7903. Bei Level 50 (das aktuelle Maximum mit XL-Bonbons) erreicht er 0,8426. Da die Formel den CPM quadriert, erzeugen kleine Level-Erhöhungen nahe Level 40–50 große KP-Sprünge.</p><h3>IV-Werte im deutschen Spielkontext</h3><p>Ein verbreiteter Irrtum ist, dass ein Pokemon mit 100% IV-Werten dramatisch stärker ist als eines mit 0% IVs. Tatsächlich fügen IVs maximal 15 zusätzliche Punkte zu den Basiswerten hinzu. Bei Mewtu (Basisangriff 300) macht IV-Angriff 15 gegenüber 0 nur etwa 4,8% Unterschied im effektiven Angriff aus. Das ist relevant in einem knappen Raid-DPS-Rennen, aber es entscheidet nicht darüber, ob du einen Fünf-Sterne-Raid schaffst. Wo IVs wirklich entscheidend sind, ist im <strong>GO-Kampfliga-System</strong>: In der Super- oder Ultra-Liga zwingen KP-Obergrenzen dazu, das richtige Level zu wählen, und bestimmte IV-Kombinationen bieten Vorteile bei Widerstand oder Angriffspriorität. Überprüfe immer mit dem Stat Rechner oben, bevor du eine teure Aufladung bestätigst.</p><h3>Level 40 vs. Level 50: Lohnen sich XL-Bonbons?</h3><p>Das Aufsteigen von Level 40 auf 50 erfordert XL-Bonbons — eine knappe Ressource. Der Statistik-Gewinn von L40 auf L50 beträgt etwa 6–7% für alle effektiven Statistiken. Für Gelegenheitsspieler in Raids ist das selten die Mühe wert. Für kompetitive Kämpfer in der GO-Kampfliga oder für Spieler, die ihren Raid-DPS maximieren wollen, kann es entscheidend sein. Verwende den Rechner, um dein spezifisches Pokemon auf beiden Levels zu vergleichen. Kombiniere die Analyse mit dem <a href="https://pokemoncalculator.online/de/sternenstaub-rechner/">Sternenstaub-Rechner</a>, um die Gesamtkosten zu verstehen. Alle Werkzeuge findest du im <a href="https://pokemoncalculator.online/calculators/">Rechner Hub</a>.</p><h3>Basiswerte Erklärt</h3><p>Basiswerte sind für alle Pokemon derselben Spezies und Form identisch. Jedes Garados hat Basisangriff 229, Basisverteidigung 128 und Basisausdauer 216. Pokemon mit asymmetrischen Basiswerten — hoher Angriff, moderatere Verteidigung — performen unterschiedlich in Raids (wo roher DPS zählt) versus PvP (wo Widerstand und Schilddruck ebenfalls wichtig sind). Prüfe die <a href="https://pokemoncalculator.online/de/typen-tabelle/">Typen-Tabelle</a> zusammen mit deinen Statistiken für ein vollständiges Kampfbild.</p>',
        'info_table_title' => 'KP-Multiplikator (CPM) Werte nach Level — Bulbapedia-verifiziert',
        'info_table_html'  => '<table class="pkm-calc-table"><thead><tr><th>Level</th><th>CPM-Wert</th><th>CPM²</th><th>Hinweis</th></tr></thead><tbody><tr><td>1</td><td>0,09399414</td><td>0,008835</td><td>Minimales Level</td></tr><tr><td>5</td><td>0,21573247</td><td>0,046540</td><td>Frühes Spiel</td></tr><tr><td>10</td><td>0,32108760</td><td>0,103097</td><td>—</td></tr><tr><td>20</td><td>0,48437500</td><td>0,234619</td><td><span class="pkm-table-note-badge">Wildfang-Grenze</span></td></tr><tr><td>30</td><td>0,61281972</td><td>0,375548</td><td><span class="pkm-table-note-badge">Wetterboost-Grenze</span></td></tr><tr><td>35</td><td>0,66187500</td><td>0,438079</td><td>—</td></tr><tr><td>40</td><td>0,79030001</td><td>0,624574</td><td><span class="pkm-table-note-badge">Alte Obergrenze</span></td></tr><tr><td>45</td><td>0,82172942</td><td>0,675239</td><td>XL-Bonbons nötig</td></tr><tr><td>50</td><td>0,84265016</td><td>0,710059</td><td><span class="pkm-table-note-badge">Aktuelles Max</span></td></tr></tbody></table>',
        'faq_title'        => 'Häufig Gestellte Fragen',
        'faq_q1'=>'Wie werden Pokemon GO Statistiken berechnet?',
        'faq_a1'=>'Pokemon GO Statistiken werden mithilfe von Basiswerten (art-spezifisch, fest), Individuellen Werten (IVs, 0–15 pro Statistik) und einem Level-abhängigen KP-Multiplikator (CPM) berechnet. Effektiver Angriff = (Basisangriff + IV Angriff) × CPM; dieselbe Formel gilt für Verteidigung und Ausdauer. Für KP gilt: Abrunden( (AtkBasis + IVAtk)^0,5 × (VertBasis + IVVert)^0,25 × (AusBasis + IVAus)^0,25 × CPM² ÷ 10 ). TP werden berechnet als Abrunden( (AusBasis + IVAus) × CPM ), Mindestwert 10.',
        'faq_q2'=>'Wie werden zukünftige Pokemon GO Statistiken berechnet?',
        'faq_a2'=>'Statistiken für noch nicht veröffentlichte Pokemon werden von Dataminern geschätzt, die die GAME_MASTER-Datei aus APK-Updates extrahieren. Niantic speichert Basiswerte serverseitig, aber die Formeln sind identisch. Seiten wie Bulbapedia und GamePress veröffentlichen Projektionen basierend auf Hauptreihen-Daten, die auf die GO-Formel skaliert wurden. Sobald Niantic das Pokemon offiziell veröffentlicht, werden die Statistiken bestätigt und Rechner wie dieser entsprechend aktualisiert.',
        'faq_q3'=>'Wie ermittle ich die IV-Werte meines Pokemon in GO?',
        'faq_a3'=>'Um die genauen IV-Werte deines Pokemon in GO herauszufinden, nutze das In-Game-Bewertungssystem: Tippe auf dein Pokemon, wähle "Bewerten" und dein Teamleader gibt dir Hinweise auf die IV-Spanne. Für exakte Werte brauchst du einen IV-Rechner, der KP, TP und Bewertungsergebnis kombiniert, um mögliche IV-Kombinationen einzugrenzen. Mit den ermittelten IVs kannst du alle Werte direkt in den Pokemon GO Stat Rechner oben eingeben und erhältst sofort präzise Ergebnisse.',
        'faq_q4'=>'Wie berechne ich die Statistiken meines Pokemon GO genau?',
        'faq_a4'=>'Für die exakte Berechnung der Statistiken deines Pokemon GO benötigst du drei Angaben: die Basiswerte der Spezies (auf Bulbapedia verfügbar oder automatisch in diesem Tool), deine IV-Werte (über In-Game-Bewertung und IV-Rechner ermittelt) und das Level deines Pokemon (aus dem KP-Wert geschätzt oder durch Aufladung bestätigt). Gib alle drei Werte in den Pokemon GO Stat Rechner oben ein und drücke Stats berechnen. Das Ergebnis zeigt präzise KP, TP, effektiven Angriff, Verteidigung und Ausdauer.',
        'faq_q5'=>'Was ist IV-Perfektion und wie wird sie berechnet?',
        'faq_a5'=>'IV-Perfektion gibt den prozentualen Anteil der maximal möglichen IV-Werte an, die dein Pokemon besitzt. Die Berechnung lautet: (IV Angriff + IV Verteidigung + IV Ausdauer) ÷ 45 × 100. Der Nenner 45 ergibt sich daraus, dass jeder der drei IV-Werte maximal 15 betragen kann (15 × 3 = 45). Ein Pokemon mit 15/15/15 IVs ist 100% perfekt. Pokemon aus Forschungsfeld-Raids haben eine Mindestgarantie von 10/10/10 (66,7%). Der Stat Rechner oben zeigt die IV-Perfektion nach jeder Berechnung als Prozentbalken an.',
        'faq_q6'=>'Was zählt mehr, Level oder IVs, für KP in Pokemon GO?',
        'faq_a6'=>'Das Level hat einen deutlich größeren Einfluss auf die KP als die IV-Werte in Pokemon GO. Der KP-Multiplikator bei Level 50 (0,8426) ist fast neunmal größer als bei Level 1 (0,0940). Da die Formel den CPM quadriert, erzeugt jede Level-Erhöhung einen erheblichen KP-Gewinn. IVs fügen jeweils maximal 15 Extrapunkte pro Statistik hinzu. Als Faustregel gilt: Ein Level aufzusteigen bringt mehr KP als von 0% auf 100% IVs beim gleichen Level zu wechseln. IV-Werte sind jedoch permanent — du kannst sie nicht ändern — während Sternenstaub immer wieder gesammelt werden kann.',
        'faq_q7'=>'Welche KP-Obergrenze gibt es in Pokemon GO?',
        'faq_a7'=>'Die maximalen Kampfpunkte in Pokemon GO hängen von der Spezies und der aktuellen Level-Obergrenze (50) ab. Relaxo hält den Rekord mit 5.010 KP bei Level 50 mit perfekten IVs, gefolgt von Regigigas (4.913) und Mewtu (4.724 in Standardform). Crypto-Pokemon haben einen 1,2-fachen Angriffsmultiplikator im Kampf, aber ihr angezeigter KP-Wert ändert sich nicht. Mega-Entwicklungen erhöhen die Statistiken im Kampf ohne den angezeigten KP zu verändern. Gib ein beliebiges Pokemon in den Stat Rechner oben ein, um seine maximalen KP auf jedem Level zu ermitteln.',
        'faq_q8'=>'Wie beeinflusst Wetterboost die Statistiken von Pokemon GO?',
        'faq_a8'=>'Der Wetterboost in Pokemon GO verändert nicht die Basiswerte oder IV-Werte eines Pokemon. Er bewirkt jedoch, dass wilde Pokemon auf höheren Levels erscheinen — speziell Level 25–35 statt der Standardgrenze von Level 20–30. Das erhöht effektiv KP und alle Statistiken, da diese vom Level abhängen. Zusätzlich verursachen Attacken des durch das Wetter begünstigten Typs im Kampf 20% mehr Schaden (ein separater Multiplikator). Der Stat Rechner spiegelt die Statistiken bei jedem selbst gewählten Level wider, sodass du geboostete und ungeboostete Fänge direkt vergleichen kannst.',
    ],
];

// ── Shortcode ─────────────────────────────────────────────────
if ( ! function_exists('pkm_go_stat_calc_shortcode') ) {
    function pkm_go_stat_calc_shortcode() {
        global $pkm_current_lang, $pkm_go_stat_strings;

        $lang = $pkm_current_lang ?? 'en';
        $t    = $pkm_go_stat_strings[ $lang ] ?? $pkm_go_stat_strings['en'];

        // ── Ad slots (Loaded dynamically from Admin Settings; renders only when code is provided) ──
        $ad_slot_a     = get_setting('ad_slot_top', get_setting('ad_header_code', ''));
        $ad_slot_b     = get_setting('ad_slot_below_result', '');
        $ad_slot_c     = get_setting('ad_slot_mid_content', '');
        $ad_slot_d     = get_setting('ad_slot_bottom', '');
        $ad_slot_e     = get_setting('ad_slot_sky_left', get_setting('ad_slot_sidebar', ''));
        $ad_slot_f_sky = get_setting('ad_slot_sky_right', get_setting('ad_slot_sidebar', ''));

        $pkm_render_ad = function( string $slot, string $extra_class = '' ): string {
            return pkm_render_ad( $slot, $extra_class );
        };

        // ── Load Pokemon data ──
        $raw = get_pokemon_data();
        $data_ok = ! empty( $raw ) && is_array( $raw );

        if ( $data_ok ) {
            $js_data = array_map( function( $p ) {
                return [
                    'id'     => intval( $p['id'] ?? 0 ),
                    'name'   => sanitize_text_field( $p['name'] ?? '' ),
                    'types'  => array_values( $p['types'] ?? [] ),
                    'stats'  => array_map( 'intval', $p['stats'] ?? [] ),
                    'sprite' => esc_url( trim( $p['sprite_default'] ?? '' ) ),
                    'spriteO'=> esc_url( trim( $p['sprite_official'] ?? '' ) ),
                ];
            }, $raw );
        } else {
            $js_data = [];
        }

        // ── Header sprites — Mewtwo (ID 150) + Dragonite (ID 149) ──
        $pokemon_a = $data_ok ? ( get_pokemon_data(150) ?? [] ) : [];
        $pokemon_b = $data_ok ? ( get_pokemon_data(149) ?? [] ) : [];

        // ── JS translations object ──
        $js_translations = [
            'error_select_pokemon' => $t['error_select_pokemon'],
            'error_invalid_level'  => $t['error_invalid_level'],
            'error_invalid_iv'     => $t['error_invalid_iv'],
            'error_no_results'     => $t['error_no_results'],
            'error_calculation'    => $t['error_calculation'],
            'error_data_load'      => $t['error_data_load'],
        ];

        // ── Type badge colour map ──
        $type_colors = [
            'normal'=>'#A8A878','fire'=>'#F08030','water'=>'#6890F0','electric'=>'#F8D030',
            'grass'=>'#78C850','ice'=>'#98D8D8','fighting'=>'#C03028','poison'=>'#A040A0',
            'ground'=>'#E0C068','flying'=>'#A890F0','psychic'=>'#F85888','bug'=>'#A8B820',
            'rock'=>'#B8A038','ghost'=>'#705898','dragon'=>'#7038F8','dark'=>'#705848',
            'steel'=>'#B8B8D0','fairy'=>'#EE99AC',
        ];

        ob_start();
        ?>
        <?php /* Anti-flash dark mode + Google Fonts */ ?>
        <script>!function(){var t=localStorage.getItem('pkm-theme');if(t)document.documentElement.setAttribute('data-theme',t);else if(window.matchMedia&&window.matchMedia('(prefers-color-scheme: dark)').matches)document.documentElement.setAttribute('data-theme','dark');}();</script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Exo+2:wght@400;500;600;700&display=swap" rel="stylesheet">

        <style>
        /* ═══════════════════════════════════════════════════
           PKM GO STAT CALCULATOR — DESIGN SYSTEM
           ═══════════════════════════════════════════════════ */
        :root {
            --pkm-primary: #0D9488 !important;
            --pkm-primary-hover: #0F766E !important;
            --pkm-primary-light: rgba(13, 148, 136, 0.15) !important;
            --pkm-secondary: #134E4A !important;
            --pkm-secondary-hover: #0F3D39 !important;
            --pkm-accent: #F4D03F !important;
            --pkm-accent-2: #2ECC71 !important;
            --pkm-gradient: linear-gradient(135deg, #0D9488 0%, #134E4A 100%) !important;
            --pkm-radius: 12px !important;
            --pkm-radius-sm: 8px !important;
            --pkm-radius-lg: 20px !important;
            --pkm-radius-xl: 28px !important;
            --pkm-transition: all 0.25s cubic-bezier(0.4,0,0.2,1) !important;
            --pkm-transition-slow: all 0.4s cubic-bezier(0.4,0,0.2,1) !important;
            --pkm-font-display: 'Exo 2', sans-serif !important;
            --pkm-font-heading: 'Exo 2', sans-serif !important;
            --pkm-font-body: system-ui,-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif !important;
            /* Light mode */
            --pkm-bg: #F4F6F9 !important;
            --pkm-bg-2: #FFFFFF !important;
            --pkm-bg-3: #EEF1F5 !important;
            --pkm-bg-card: rgba(255,255,255,0.92) !important;
            --pkm-text: #1A1F2E !important;
            --pkm-text-muted: #4A5568 !important;
            --pkm-text-subtle: #A0AEC0 !important;
            --pkm-border: rgba(0,0,0,0.08) !important;
            --pkm-border-hover: rgba(0,0,0,0.18) !important;
            --pkm-shadow: 0 8px 32px rgba(0,0,0,0.10) !important;
            --pkm-shadow-sm: 0 2px 8px rgba(0,0,0,0.06) !important;
            --pkm-glow: rgba(13, 148, 136, 0.20) !important;
            --pkm-input-bg: #EEF1F5 !important;
        }
        [data-theme="dark"] {
            --pkm-bg: #0D1117 !important;
            --pkm-bg-2: #161B22 !important;
            --pkm-bg-3: #21262D !important;
            --pkm-bg-card: rgba(22,27,34,0.85) !important;
            --pkm-text: #E6EDF3 !important;
            --pkm-text-muted: #8B949E !important;
            --pkm-text-subtle: #484F58 !important;
            --pkm-border: rgba(255,255,255,0.08) !important;
            --pkm-border-hover: rgba(255,255,255,0.18) !important;
            --pkm-shadow: 0 8px 32px rgba(0,0,0,0.4) !important;
            --pkm-shadow-sm: 0 2px 8px rgba(0,0,0,0.3) !important;
            --pkm-glow: rgba(13, 148, 136, 0.35) !important;
            --pkm-input-bg: #21262D !important;
        }

        /* ── Icon system ── */
        .pkm-icon { display: inline-block !important; vertical-align: middle !important; flex-shrink: 0 !important; }
        .pkm-icon-sm { width: 16px !important; height: 16px !important; }
        .pkm-icon-md { width: 20px !important; height: 20px !important; }
        .pkm-icon-lg { width: 24px !important; height: 24px !important; }
        .pkm-icon-xl { width: 32px !important; height: 32px !important; }

        /* ── Outer wrapper ── */
        .pkm-calc-outer {
            position: relative !important;
            width: 100% !important;
            background: var(--pkm-bg) !important;
        }

        /* ── Centered content column ── */
        .pkm-calc-wrapper {
            max-width: 1080px !important;
            margin: 0 auto !important;
            padding: 0 16px 48px !important;
            width: 100% !important;
            box-sizing: border-box !important;
            font-family: var(--pkm-font-body) !important;
            color: var(--pkm-text) !important;
        }

        /* ── Sticky skyscraper ads ── */
        .pkm-ad-skyscraper {
            display: none !important;
            position: fixed !important;
            top: 120px !important;
            width: 160px !important;
            z-index: 100 !important;
        }
        .pkm-ad-skyscraper-left  { left: 0 !important; }
        .pkm-ad-skyscraper-right { right: 0 !important; }
        @media (min-width: 1280px) {
            .pkm-ad-skyscraper { display: block !important; }
        }

        /* ── Header ── */
        .pkm-calc-header {
            position: relative !important;
            background: var(--pkm-gradient) !important;
            border-radius: 0 0 var(--pkm-radius-xl) var(--pkm-radius-xl) !important;
            padding: 48px 24px 40px !important;
            text-align: center !important;
            overflow: hidden !important;
            margin-bottom: 28px !important;
        }
        .pkm-calc-header-glow {
            position: absolute !important;
            top: -40% !important;
            left: 50% !important;
            transform: translateX(-50%) !important;
            width: 600px !important;
            height: 300px !important;
            background: radial-gradient(ellipse at center, rgba(255,255,255,0.12) 0%, transparent 70%) !important;
            pointer-events: none !important;
        }
        .pkm-calc-header-sprites {
            display: flex !important;
            justify-content: center !important;
            gap: 32px !important;
            margin-bottom: 16px !important;
            position: relative !important;
            z-index: 1 !important;
        }
        .pkm-header-sprite {
            width: 80px !important;
            height: 80px !important;
            object-fit: contain !important;
            filter: drop-shadow(0 4px 12px rgba(0,0,0,0.35)) !important;
            animation: pkm-float 3s ease-in-out infinite !important;
        }
        .pkm-header-sprite-right { animation-delay: 1.5s !important; }
        @keyframes pkm-float {
            0%,100% { transform: translateY(0) !important; }
            50% { transform: translateY(-8px) !important; }
        }
        @media (max-width: 480px) {
            .pkm-header-sprite { width: 56px !important; height: 56px !important; animation: none !important; }
        }
        .pkm-calc-title {
            font-family: var(--pkm-font-display) !important;
            font-size: clamp(12px, 2.8vw, 20px) !important;
            color: #FFFFFF !important;
            margin: 0 0 12px !important;
            line-height: 1.6 !important;
            text-shadow: 0 2px 8px rgba(0,0,0,0.3) !important;
            position: relative !important;
            z-index: 1 !important;
        }
        .pkm-calc-description {
            font-family: var(--pkm-font-heading) !important;
            font-size: clamp(14px, 2vw, 17px) !important;
            color: rgba(255,255,255,0.88) !important;
            margin: 0 auto !important;
            max-width: 520px !important;
            line-height: 1.6 !important;
            position: relative !important;
            z-index: 1 !important;
        }

        /* ── Ad block ── */
        .pkm-calc-ad-block {
            text-align: center !important;
            margin: 20px 0 !important;
            overflow: hidden !important;
        }

        /* ── Error boxes ── */
        .pkm-calc-error-box {
            background: rgba(13,148,136,0.12) !important;
            border: 1px solid rgba(13, 148, 136, 0.4) !important;
            border-radius: var(--pkm-radius) !important;
            padding: 16px 20px !important;
            align-items: flex-start !important;
            gap: 12px !important;
            color: var(--pkm-text) !important;
            margin: 16px 0 !important;
            /* display is controlled exclusively by inline style set via JS — no display rule here */
        }
        .pkm-calc-error-box p { margin: 0 !important; font-size: 14px !important; line-height: 1.5 !important; }
        .pkm-validation-errors {
            background: rgba(13,148,136,0.08) !important;
            border: 1px solid rgba(13, 148, 136, 0.3) !important;
            border-radius: var(--pkm-radius-sm) !important;
            padding: 12px 16px 12px 32px !important;
            margin: 8px 0 !important;
            color: var(--pkm-primary) !important;
            font-size: 13px !important;
            list-style: disc !important;
        }
        .pkm-validation-errors li { margin: 4px 0 !important; }

        /* ── Card ── */
        .pkm-calc-card {
            background: var(--pkm-bg-card) !important;
            border: 1px solid var(--pkm-border) !important;
            border-radius: var(--pkm-radius-lg) !important;
            padding: 28px !important;
            box-shadow: var(--pkm-shadow) !important;
            backdrop-filter: blur(8px) !important;
            margin-bottom: 20px !important;
        }
        .pkm-card-title {
            font-family: var(--pkm-font-heading) !important;
            font-size: 16px !important;
            font-weight: 700 !important;
            color: var(--pkm-text) !important;
            margin: 0 0 20px !important;
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
        }
        .pkm-card-title svg { color: var(--pkm-primary) !important; }

        /* ── Search bar ── */
        .pkm-search-wrap {
            position: relative !important;
            margin-bottom: 24px !important;
        }
        .pkm-search-icon-wrap {
            position: absolute !important;
            left: 14px !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            pointer-events: none !important;
            color: var(--pkm-text-muted) !important;
            z-index: 2 !important;
        }
        .pkm-search-input {
            width: 100% !important;
            box-sizing: border-box !important;
            background: var(--pkm-input-bg) !important;
            border: 2px solid var(--pkm-border) !important;
            border-radius: var(--pkm-radius) !important;
            padding: 14px 14px 14px 44px !important;
            font-size: 16px !important;
            font-family: var(--pkm-font-body) !important;
            color: var(--pkm-text) !important;
            transition: var(--pkm-transition) !important;
            outline: none !important;
            appearance: none !important;
            -webkit-appearance: none !important;
        }
        .pkm-search-input:focus {
            border-color: var(--pkm-primary) !important;
            box-shadow: 0 0 0 3px var(--pkm-primary-light) !important;
            background: var(--pkm-bg-2) !important;
        }
        .pkm-search-input::placeholder { color: var(--pkm-text-subtle) !important; }
        .pkm-search-dropdown {
            position: absolute !important;
            top: calc(100% + 4px) !important;
            left: 0 !important;
            right: 0 !important;
            background: var(--pkm-bg-2) !important;
            border: 1px solid var(--pkm-border-hover) !important;
            border-radius: var(--pkm-radius) !important;
            box-shadow: var(--pkm-shadow) !important;
            max-height: 260px !important;
            overflow-y: auto !important;
            z-index: 1000 !important;
            display: none !important;
        }
        .pkm-search-dropdown.active { display: block !important; }
        .pkm-search-item {
            display: flex !important;
            align-items: center !important;
            gap: 10px !important;
            padding: 10px 14px !important;
            cursor: pointer !important;
            transition: var(--pkm-transition) !important;
            border-bottom: 1px solid var(--pkm-border) !important;
            min-height: 44px !important;
        }
        .pkm-search-item:last-child { border-bottom: none !important; }
        .pkm-search-item:hover, .pkm-search-item.highlighted {
            background: var(--pkm-primary-light) !important;
        }
        .pkm-search-item-sprite {
            width: 32px !important;
            height: 32px !important;
            object-fit: contain !important;
            flex-shrink: 0 !important;
        }
        .pkm-search-item-name {
            font-family: var(--pkm-font-heading) !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            color: var(--pkm-text) !important;
            text-transform: capitalize !important;
            flex: 1 !important;
        }
        .pkm-search-item-types {
            display: flex !important;
            gap: 4px !important;
            flex-wrap: wrap !important;
        }
        .pkm-type-badge {
            font-size: 10px !important;
            font-weight: 700 !important;
            color: #fff !important;
            padding: 2px 7px !important;
            border-radius: 20px !important;
            text-transform: capitalize !important;
            letter-spacing: 0.3px !important;
        }
        .pkm-search-no-results {
            padding: 16px !important;
            text-align: center !important;
            color: var(--pkm-text-muted) !important;
            font-size: 14px !important;
        }
        #pkm-pokemon-id { display: none !important; }

        /* ── Selected Pokemon preview ── */
        .pkm-selected-pokemon {
            display: none !important;
            align-items: center !important;
            gap: 12px !important;
            background: var(--pkm-bg-3) !important;
            border-radius: var(--pkm-radius) !important;
            padding: 12px 16px !important;
            margin-bottom: 20px !important;
            border: 1px solid var(--pkm-border) !important;
        }
        .pkm-selected-pokemon.visible { display: flex !important; }
        .pkm-selected-sprite {
            width: 48px !important;
            height: 48px !important;
            object-fit: contain !important;
        }
        .pkm-selected-info { flex: 1 !important; }
        .pkm-selected-name {
            font-family: var(--pkm-font-heading) !important;
            font-size: 16px !important;
            font-weight: 700 !important;
            color: var(--pkm-text) !important;
            text-transform: capitalize !important;
            margin: 0 0 4px !important;
        }
        .pkm-selected-base-stats {
            font-size: 12px !important;
            color: var(--pkm-text-muted) !important;
            display: flex !important;
            gap: 12px !important;
            flex-wrap: wrap !important;
        }
        .pkm-selected-base-stat-item {
            display: flex !important;
            gap: 4px !important;
            align-items: center !important;
        }
        .pkm-base-stat-label {
            font-weight: 600 !important;
            color: var(--pkm-text-subtle) !important;
            font-size: 11px !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
        }
        .pkm-base-stat-val {
            font-weight: 700 !important;
            color: var(--pkm-text) !important;
        }

        /* ── Form grid ── */
        .pkm-calc-grid {
            display: grid !important;
            grid-template-columns: 1fr !important;
            gap: 16px !important;
        }
        @media (min-width: 768px) {
            .pkm-calc-grid { grid-template-columns: repeat(2, 1fr) !important; }
        }

        /* ── Form field ── */
        .pkm-field {
            display: flex !important;
            flex-direction: column !important;
            gap: 8px !important;
        }
        .pkm-field-label {
            font-family: var(--pkm-font-heading) !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            color: var(--pkm-text-muted) !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            display: flex !important;
            align-items: center !important;
            gap: 6px !important;
        }
        .pkm-field-label svg { color: var(--pkm-primary) !important; }
        .pkm-slider-row {
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
        }
        .pkm-slider {
            flex: 1 !important;
            -webkit-appearance: none !important;
            appearance: none !important;
            height: 6px !important;
            border-radius: 3px !important;
            background: var(--pkm-bg-3) !important;
            outline: none !important;
            cursor: pointer !important;
            transition: var(--pkm-transition) !important;
        }
        .pkm-slider::-webkit-slider-thumb {
            -webkit-appearance: none !important;
            appearance: none !important;
            width: 20px !important;
            height: 20px !important;
            border-radius: 50% !important;
            background: var(--pkm-primary) !important;
            cursor: pointer !important;
            box-shadow: 0 2px 6px rgba(13, 148, 136, 0.4) !important;
            transition: var(--pkm-transition) !important;
        }
        .pkm-slider::-webkit-slider-thumb:hover {
            transform: scale(1.15) !important;
            box-shadow: 0 3px 10px rgba(13,148,136,0.5) !important;
        }
        .pkm-slider::-moz-range-thumb {
            width: 20px !important;
            height: 20px !important;
            border-radius: 50% !important;
            background: var(--pkm-primary) !important;
            cursor: pointer !important;
            border: none !important;
        }
        .pkm-num-input {
            width: 60px !important;
            text-align: center !important;
            background: var(--pkm-input-bg) !important;
            border: 2px solid var(--pkm-border) !important;
            border-radius: var(--pkm-radius-sm) !important;
            padding: 6px 8px !important;
            font-size: 15px !important;
            font-weight: 700 !important;
            font-family: var(--pkm-font-heading) !important;
            color: var(--pkm-text) !important;
            transition: var(--pkm-transition) !important;
            outline: none !important;
            min-height: 44px !important;
            box-sizing: border-box !important;
        }
        .pkm-num-input:focus {
            border-color: var(--pkm-primary) !important;
            box-shadow: 0 0 0 3px var(--pkm-primary-light) !important;
        }
        /* Level input wider */
        #pkm-level-num { width: 72px !important; }

        /* ── Level half-step display ── */
        .pkm-level-display {
            font-family: var(--pkm-font-heading) !important;
            font-weight: 800 !important;
            font-size: 18px !important;
            color: var(--pkm-primary) !important;
            min-width: 48px !important;
            text-align: center !important;
        }

        /* ── Buttons row ── */
        .pkm-btn-row {
            display: flex !important;
            gap: 12px !important;
            margin-top: 24px !important;
            flex-wrap: wrap !important;
        }
        .pkm-btn {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
            padding: 14px 24px !important;
            border-radius: var(--pkm-radius) !important;
            font-family: var(--pkm-font-heading) !important;
            font-size: 15px !important;
            font-weight: 700 !important;
            border: none !important;
            cursor: pointer !important;
            transition: var(--pkm-transition) !important;
            min-height: 44px !important;
            text-decoration: none !important;
            white-space: nowrap !important;
        }
        .pkm-btn-primary {
            background: var(--pkm-primary) !important;
            color: #fff !important;
            flex: 1 !important;
            min-width: 140px !important;
        }
        .pkm-btn-primary:hover {
            background: var(--pkm-primary-hover) !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 6px 20px var(--pkm-glow) !important;
        }
        .pkm-btn-primary:active { transform: translateY(0) !important; }
        .pkm-btn-secondary {
            background: var(--pkm-bg-3) !important;
            color: var(--pkm-text-muted) !important;
            border: 1px solid var(--pkm-border) !important;
        }
        .pkm-btn-secondary:hover {
            background: var(--pkm-bg-2) !important;
            color: var(--pkm-text) !important;
            border-color: var(--pkm-border-hover) !important;
        }
        .pkm-btn-accent {
            background: transparent !important;
            color: var(--pkm-text-muted) !important;
            border: 1px dashed var(--pkm-border-hover) !important;
            font-size: 13px !important;
            padding: 10px 16px !important;
        }
        .pkm-btn-accent:hover {
            background: var(--pkm-primary-light) !important;
            color: var(--pkm-primary) !important;
            border-color: var(--pkm-primary) !important;
        }

        /* ── Result card ── */
        .pkm-result-card {
            background: var(--pkm-bg-card) !important;
            border: 1px solid var(--pkm-border) !important;
            border-radius: var(--pkm-radius-lg) !important;
            padding: 28px !important;
            box-shadow: var(--pkm-shadow) !important;
            backdrop-filter: blur(8px) !important;
            margin-bottom: 20px !important;
            display: none !important;
        }
        .pkm-result-card.visible { display: block !important; }
        .pkm-result-header {
            display: flex !important;
            align-items: center !important;
            gap: 14px !important;
            margin-bottom: 24px !important;
            padding-bottom: 16px !important;
            border-bottom: 1px solid var(--pkm-border) !important;
        }
        .pkm-result-sprite {
            width: 64px !important;
            height: 64px !important;
            object-fit: contain !important;
            filter: drop-shadow(0 3px 8px rgba(0,0,0,0.2)) !important;
        }
        .pkm-result-pokemon-name {
            font-family: var(--pkm-font-heading) !important;
            font-size: 20px !important;
            font-weight: 800 !important;
            color: var(--pkm-text) !important;
            text-transform: capitalize !important;
            margin: 0 0 4px !important;
        }
        .pkm-result-types { display: flex !important; gap: 6px !important; flex-wrap: wrap !important; }
        .pkm-result-title-label {
            font-family: var(--pkm-font-heading) !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            color: var(--pkm-text-muted) !important;
            text-transform: uppercase !important;
            letter-spacing: 0.6px !important;
            margin: 0 0 16px !important;
            display: flex !important;
            align-items: center !important;
            gap: 6px !important;
        }
        .pkm-result-title-label svg { color: var(--pkm-accent-2) !important; }
        .pkm-result-grid {
            display: grid !important;
            grid-template-columns: 1fr 1fr !important;
            gap: 12px !important;
            margin-bottom: 16px !important;
        }
        @media (max-width: 479px) {
            .pkm-result-grid { grid-template-columns: 1fr !important; }
        }
        .pkm-result-stat {
            background: var(--pkm-bg-3) !important;
            border-radius: var(--pkm-radius) !important;
            padding: 16px !important;
            display: flex !important;
            flex-direction: column !important;
            gap: 4px !important;
            border: 1px solid var(--pkm-border) !important;
            transition: var(--pkm-transition) !important;
        }
        .pkm-result-stat:hover { border-color: var(--pkm-border-hover) !important; }
        .pkm-result-stat.pkm-stat-cp {
            grid-column: span 2 !important;
            background: linear-gradient(135deg, rgba(13,148,136,0.12), rgba(29,53,87,0.10)) !important;
            border-color: rgba(13, 148, 136, 0.25) !important;
        }
        @media (max-width: 479px) {
            .pkm-result-stat.pkm-stat-cp { grid-column: span 1 !important; }
        }
        .pkm-stat-label {
            font-size: 11px !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.7px !important;
            color: var(--pkm-text-muted) !important;
        }
        .pkm-stat-value {
            font-family: var(--pkm-font-heading) !important;
            font-size: 28px !important;
            font-weight: 800 !important;
            color: var(--pkm-text) !important;
            line-height: 1.1 !important;
        }
        .pkm-stat-value.pkm-cp-value {
            font-size: 36px !important;
            color: var(--pkm-primary) !important;
        }
        .pkm-stat-sub {
            font-size: 11px !important;
            color: var(--pkm-text-subtle) !important;
        }

        /* ── IV Perfection bar ── */
        .pkm-iv-perfection {
            background: var(--pkm-bg-3) !important;
            border-radius: var(--pkm-radius) !important;
            padding: 14px 16px !important;
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
            border: 1px solid var(--pkm-border) !important;
            margin-top: 4px !important;
        }
        .pkm-iv-pct-label {
            font-size: 12px !important;
            font-weight: 600 !important;
            color: var(--pkm-text-muted) !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            white-space: nowrap !important;
            min-width: 80px !important;
        }
        .pkm-iv-bar-wrap {
            flex: 1 !important;
            background: var(--pkm-border) !important;
            border-radius: 20px !important;
            height: 10px !important;
            overflow: hidden !important;
        }
        .pkm-iv-bar {
            height: 100% !important;
            border-radius: 20px !important;
            background: linear-gradient(90deg, #0D9488, #F4D03F) !important;
            transition: width 0.6s cubic-bezier(0.4,0,0.2,1) !important;
            width: var(--pkm-iv-bar-width, 0%); /* NO !important — JS inline style must win */
            min-width: 0 !important;
            display: block !important;
        }
        .pkm-iv-pct-val {
            font-family: var(--pkm-font-heading) !important;
            font-weight: 800 !important;
            font-size: 15px !important;
            color: var(--pkm-text) !important;
            min-width: 44px !important;
            text-align: right !important;
        }

        /* ── Table wrapper ── */
        .pkm-table-wrapper {
            overflow-x: auto !important;
            -webkit-overflow-scrolling: touch !important;
            width: 100% !important;
            margin: 20px 0 !important;
            border-radius: var(--pkm-radius) !important;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08) !important;
            border: 1px solid var(--pkm-border) !important;
        }
        /* ── Beautiful data table ── */
        .pkm-calc-table {
            width: 100% !important;
            border-collapse: collapse !important;
            font-size: 14px !important;
            font-family: var(--pkm-font-heading) !important;
        }
        .pkm-calc-table thead tr {
            background: var(--pkm-gradient) !important;
        }
        .pkm-calc-table thead th {
            padding: 14px 18px !important;
            text-align: left !important;
            color: #fff !important;
            font-size: 12px !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.8px !important;
            white-space: nowrap !important;
        }
        .pkm-calc-table thead th:first-child { border-radius: var(--pkm-radius) 0 0 0 !important; }
        .pkm-calc-table thead th:last-child  { border-radius: 0 var(--pkm-radius) 0 0 !important; }
        .pkm-calc-table tbody tr {
            border-bottom: 1px solid var(--pkm-border) !important;
            transition: background 0.15s ease !important;
        }
        .pkm-calc-table tbody tr:last-child { border-bottom: none !important; }
        .pkm-calc-table tbody tr:nth-child(odd)  { background: var(--pkm-bg-3) !important; }
        .pkm-calc-table tbody tr:nth-child(even) { background: var(--pkm-bg-2) !important; }
        .pkm-calc-table tbody tr:hover { background: var(--pkm-primary-light) !important; }
        .pkm-calc-table tbody td {
            padding: 12px 18px !important;
            color: var(--pkm-text) !important;
            vertical-align: middle !important;
        }
        .pkm-calc-table tbody td:first-child {
            font-weight: 700 !important;
            color: var(--pkm-primary) !important;
        }
        .pkm-table-note-badge {
            display: inline-block !important;
            font-size: 11px !important;
            font-weight: 600 !important;
            padding: 2px 8px !important;
            border-radius: 20px !important;
            background: var(--pkm-primary-light) !important;
            color: var(--pkm-primary) !important;
        }

        /* ── How-to steps — numbered card style ── */
        .pkm-howto-steps {
            display: flex !important;
            flex-direction: column !important;
            gap: 14px !important;
            margin-top: 4px !important;
        }
        .pkm-howto-step {
            display: flex !important;
            gap: 16px !important;
            align-items: flex-start !important;
            background: var(--pkm-bg-3) !important;
            border: 1px solid var(--pkm-border) !important;
            border-radius: var(--pkm-radius) !important;
            padding: 18px 20px !important;
            transition: var(--pkm-transition) !important;
        }
        .pkm-howto-step:hover {
            border-color: var(--pkm-primary) !important;
            box-shadow: 0 4px 16px var(--pkm-glow) !important;
            background: var(--pkm-bg-2) !important;
        }
        .pkm-howto-step-num {
            flex-shrink: 0 !important;
            width: 36px !important;
            height: 36px !important;
            border-radius: 50% !important;
            background: var(--pkm-gradient) !important;
            color: #fff !important;
            font-family: var(--pkm-font-heading) !important;
            font-weight: 800 !important;
            font-size: 16px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            box-shadow: 0 3px 10px var(--pkm-glow) !important;
        }
        .pkm-howto-step-body {
            flex: 1 !important;
            font-size: 15px !important;
            line-height: 1.7 !important;
            color: var(--pkm-text) !important;
        }

        /* ── Formula box ── */
        .pkm-formula-box {
            background: var(--pkm-bg-3) !important;
            border: 1px solid var(--pkm-border) !important;
            border-left: 4px solid var(--pkm-primary) !important;
            border-radius: var(--pkm-radius) !important;
            padding: 16px 20px !important;
            margin: 16px 0 !important;
            font-family: 'Courier New', monospace !important;
            font-size: 13px !important;
            color: var(--pkm-text) !important;
            overflow-x: auto !important;
            line-height: 1.8 !important;
        }
        .pkm-formula-label {
            font-family: var(--pkm-font-heading) !important;
            font-size: 11px !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.8px !important;
            color: var(--pkm-primary) !important;
            margin-bottom: 6px !important;
            display: block !important;
        }

        /* ── FAQ Accordion ── */
        .pkm-faq-list { margin-top: 4px !important; }
        .pkm-faq-item {
            border: 1px solid var(--pkm-border) !important;
            border-radius: var(--pkm-radius) !important;
            margin-bottom: 10px !important;
            overflow: hidden !important;
            transition: box-shadow 0.2s ease !important;
        }
        .pkm-faq-item:last-child { margin-bottom: 0 !important; }
        .pkm-faq-item.open {
            box-shadow: 0 4px 20px var(--pkm-glow) !important;
            border-color: var(--pkm-primary) !important;
        }
        .pkm-faq-trigger {
            width: 100% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            gap: 12px !important;
            padding: 18px 20px !important;
            background: var(--pkm-bg-3) !important;
            border: none !important;
            cursor: pointer !important;
            text-align: left !important;
            transition: background 0.2s ease !important;
        }
        .pkm-faq-item.open .pkm-faq-trigger {
            background: var(--pkm-primary-light) !important;
        }
        .pkm-faq-trigger-text {
            font-family: var(--pkm-font-heading) !important;
            font-size: 15px !important;
            font-weight: 700 !important;
            color: var(--pkm-text) !important;
            line-height: 1.4 !important;
            flex: 1 !important;
        }
        .pkm-faq-item.open .pkm-faq-trigger-text { color: var(--pkm-primary) !important; }
        .pkm-faq-chevron {
            flex-shrink: 0 !important;
            width: 22px !important;
            height: 22px !important;
            border-radius: 50% !important;
            background: var(--pkm-bg-2) !important;
            border: 1px solid var(--pkm-border) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            transition: transform 0.3s ease, background 0.2s ease !important;
        }
        .pkm-faq-item.open .pkm-faq-chevron {
            transform: rotate(180deg) !important;
            background: var(--pkm-primary) !important;
            border-color: var(--pkm-primary) !important;
        }
        .pkm-faq-item.open .pkm-faq-chevron svg { stroke: #fff !important; }
        .pkm-faq-body {
            max-height: 0 !important;
            overflow: hidden !important;
            transition: max-height 0.35s cubic-bezier(0.4,0,0.2,1) !important;
        }
        .pkm-faq-item.open .pkm-faq-body { max-height: 500px !important; }
        .pkm-faq-answer {
            padding: 16px 20px 20px !important;
            font-size: 14px !important;
            line-height: 1.75 !important;
            color: var(--pkm-text-muted) !important;
            border-top: 1px solid var(--pkm-border) !important;
        }

        /* ── Related Tools grid ── */
        .pkm-related-section {
            margin-top: 8px !important;
        }
        .pkm-related-section-title {
            font-family: var(--pkm-font-heading) !important;
            font-size: 22px !important;
            font-weight: 800 !important;
            color: var(--pkm-text) !important;
            margin: 0 0 20px !important;
            padding-bottom: 14px !important;
            border-bottom: 2px solid var(--pkm-border) !important;
            display: flex !important;
            align-items: center !important;
            gap: 10px !important;
        }
        .pkm-related-section-title::before {
            content: '' !important;
            display: inline-block !important;
            width: 4px !important;
            height: 24px !important;
            background: var(--pkm-gradient) !important;
            border-radius: 4px !important;
        }
        .pkm-related-grid {
            display: grid !important;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)) !important;
            gap: 16px !important;
        }
        .pkm-related-card {
            background: var(--pkm-bg-card) !important;
            border: 1px solid var(--pkm-border) !important;
            border-radius: var(--pkm-radius) !important;
            padding: 20px !important;
            text-decoration: none !important;
            display: flex !important;
            flex-direction: column !important;
            gap: 10px !important;
            transition: var(--pkm-transition) !important;
            box-shadow: var(--pkm-shadow-sm) !important;
        }
        .pkm-related-card:hover {
            border-color: var(--pkm-primary) !important;
            box-shadow: 0 8px 24px var(--pkm-glow) !important;
            transform: translateY(-2px) !important;
        }
        .pkm-related-card-icon {
            width: 44px !important;
            height: 44px !important;
            border-radius: var(--pkm-radius-sm) !important;
            background: var(--pkm-primary-light) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            flex-shrink: 0 !important;
        }
        .pkm-related-card-icon svg { color: var(--pkm-primary) !important; }
        .pkm-related-card-name {
            font-family: var(--pkm-font-heading) !important;
            font-size: 14px !important;
            font-weight: 700 !important;
            color: var(--pkm-text) !important;
            line-height: 1.3 !important;
        }
        .pkm-related-card-desc {
            font-size: 12px !important;
            color: var(--pkm-text-muted) !important;
            line-height: 1.5 !important;
        }
        .pkm-related-card-arrow {
            margin-top: auto !important;
            font-size: 12px !important;
            font-weight: 700 !important;
            color: var(--pkm-primary) !important;
            display: flex !important;
            align-items: center !important;
            gap: 4px !important;
        }
        @media (max-width: 479px) {
            .pkm-related-grid { grid-template-columns: 1fr 1fr !important; }
            .pkm-related-card { padding: 14px !important; }
        }

        /* ── Prose content styling ── */
        .pkm-info-prose p {
            font-size: 15px !important;
            line-height: 1.75 !important;
            color: var(--pkm-text-muted) !important;
            margin: 0 0 16px !important;
        }
        .pkm-info-prose h3 {
            font-family: var(--pkm-font-heading) !important;
            font-size: 17px !important;
            font-weight: 800 !important;
            color: var(--pkm-text) !important;
            margin: 28px 0 10px !important;
            padding-left: 12px !important;
            border-left: 3px solid var(--pkm-primary) !important;
        }
        .pkm-info-prose strong {
            color: var(--pkm-text) !important;
            font-weight: 700 !important;
        }
        .pkm-info-prose a {
            color: var(--pkm-primary) !important;
            text-decoration: underline !important;
            text-underline-offset: 3px !important;
        }
        .pkm-info-prose a:hover { color: var(--pkm-primary-hover) !important; }
        .pkm-info-prose sup {
            font-size: 10px !important;
            vertical-align: super !important;
        }
        /* Formula block inside prose — triggered when p contains only formula text */
        .pkm-table-section-title {
            font-family: var(--pkm-font-heading) !important;
            font-size: 16px !important;
            font-weight: 700 !important;
            color: var(--pkm-text) !important;
            margin: 28px 0 12px !important;
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
        }
        .pkm-table-section-title::before {
            content: '' !important;
            display: inline-block !important;
            width: 3px !important;
            height: 16px !important;
            background: var(--pkm-primary) !important;
            border-radius: 2px !important;
            flex-shrink: 0 !important;
        }

        /* ── noscript fallback ── */
        .pkm-noscript-fallback {
            background: rgba(244,208,63,0.12) !important;
            border: 1px solid rgba(244,208,63,0.4) !important;
            border-radius: var(--pkm-radius) !important;
            padding: 16px 20px !important;
            margin: 12px 0 !important;
            color: var(--pkm-text) !important;
            font-size: 14px !important;
        }
        .pkm-noscript-select {
            width: 100% !important;
            padding: 12px !important;
            border-radius: var(--pkm-radius-sm) !important;
            border: 2px solid var(--pkm-border) !important;
            background: var(--pkm-input-bg) !important;
            color: var(--pkm-text) !important;
            font-size: 16px !important;
            margin-top: 8px !important;
            min-height: 44px !important;
        }

        /* ── Responsive ── */
        @media (max-width: 479px) {
            .pkm-calc-card { padding: 16px !important; }
            .pkm-result-card { padding: 16px !important; }
            .pkm-btn-row { flex-direction: column !important; }
            .pkm-btn-primary { min-width: unset !important; }
            .pkm-calc-header { padding: 32px 16px 28px !important; }
            .pkm-calc-title { font-size: 11px !important; }
        }
        @media (max-width: 767px) {
            .pkm-calc-wrapper { padding: 0 12px 32px !important; }
        }
        </style>

        <?php /* ══ SHORTCODE HTML OUTPUT ══ */ ?>
        <div class="pkm-calc-outer">

            <?php if ( '' !== trim($ad_slot_e) ) : ?>
            <div class="pkm-ad-skyscraper pkm-ad-skyscraper-left">
                <?php echo do_shortcode($ad_slot_e); ?>
            </div>
            <?php endif; ?>

            <?php if ( '' !== trim($ad_slot_f_sky) ) : ?>
            <div class="pkm-ad-skyscraper pkm-ad-skyscraper-right">
                <?php echo do_shortcode($ad_slot_f_sky); ?>
            </div>
            <?php endif; ?>

            <div class="pkm-calc-wrapper">

                <?php /* ── HEADER ── */ ?>
                <div class="pkm-calc-header">
                    <div class="pkm-calc-header-glow" aria-hidden="true"></div>
                    <div class="pkm-calc-header-sprites" aria-hidden="true">
                        <img src="<?php echo esc_url( trim( $pokemon_a['sprite_official'] ?? $pokemon_a['sprite_default'] ?? '' ) ); ?>"
                             alt="" width="80" height="80" loading="eager"
                             onerror="this.style.display='none'"
                             class="pkm-header-sprite pkm-header-sprite-left">
                        <img src="<?php echo esc_url( trim( $pokemon_b['sprite_official'] ?? $pokemon_b['sprite_default'] ?? '' ) ); ?>"
                             alt="" width="80" height="80" loading="eager"
                             onerror="this.style.display='none'"
                             class="pkm-header-sprite pkm-header-sprite-right">
                    </div>
                    <div class="pkm-calc-header-content">
                        <h1 class="pkm-calc-title"><?php echo esc_html( $t['title'] ); ?></h1>
                        <p class="pkm-calc-description"><?php echo esc_html( $t['description'] ); ?></p>
                    </div>
                </div>

                <?php /* ── AD SLOT A ── */ ?>
                <?php echo $pkm_render_ad( $ad_slot_a, 'pkm-ad-top' ); ?>

                <?php /* ── DATA ERROR — always hidden by PHP; JS shows it only if pkmData is truly empty ── */ ?>
                <div id="pkm-calc-error" class="pkm-calc-error-box" role="alert" style="display:none !important">
                    <svg class="pkm-icon pkm-icon-lg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="color:var(--pkm-primary, #0D9488);flex-shrink:0">
                        <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                    </svg>
                    <p><?php echo esc_html( $t['error_data_load'] ); ?></p>
                </div>

                <?php /* ── CALCULATOR CARD ── */ ?>
                <div class="pkm-calc-card">
                    <p class="pkm-card-title">
                        <svg class="pkm-icon pkm-icon-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                        <?php echo esc_html( $t['search_placeholder'] ); ?>
                    </p>

                    <?php /* noscript fallback */ ?>
                    <noscript>
                        <div class="pkm-noscript-fallback">
                            <p><?php echo esc_html( $t['noscript_msg'] ); ?></p>
                            <select class="pkm-noscript-select" name="pkm_noscript_pokemon">
                                <option value=""><?php echo esc_html( $t['search_placeholder'] ); ?></option>
                                <?php foreach ( $raw as $pm ) : ?>
                                <option value="<?php echo intval( $pm['id'] ?? 0 ); ?>">
                                    <?php echo esc_html( ucfirst( $pm['name'] ?? '' ) ); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </noscript>

                    <?php /* Pokemon searchbar */ ?>
                    <div class="pkm-search-wrap">
                        <span class="pkm-search-icon-wrap" aria-hidden="true">
                            <svg class="pkm-icon pkm-icon-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                            </svg>
                        </span>
                        <input type="text"
                               id="pkm-search-input"
                               class="pkm-search-input"
                               placeholder="<?php echo esc_attr( $t['search_placeholder'] ); ?>"
                               autocomplete="off"
                               autocorrect="off"
                               autocapitalize="off"
                               spellcheck="false"
                               aria-label="<?php echo esc_attr( $t['search_placeholder'] ); ?>"
                               aria-autocomplete="list"
                               aria-controls="pkm-search-dropdown"
                               aria-expanded="false"
                               role="combobox">
                        <div id="pkm-search-dropdown" class="pkm-search-dropdown" role="listbox" aria-label="Pokemon results"></div>
                        <input type="hidden" id="pkm-pokemon-id" name="pkm_pokemon_id" value="">
                    </div>

                    <?php /* Selected Pokemon preview */ ?>
                    <div id="pkm-selected-pokemon" class="pkm-selected-pokemon" aria-live="polite">
                        <img id="pkm-selected-sprite" class="pkm-selected-sprite" src="" alt="" width="48" height="48" onerror="this.style.display='none'">
                        <div class="pkm-selected-info">
                            <div id="pkm-selected-name" class="pkm-selected-name"></div>
                            <div class="pkm-selected-base-stats">
                                <span class="pkm-selected-base-stat-item">
                                    <span class="pkm-base-stat-label"><?php echo esc_html($t['base_atk']); ?></span>
                                    <span class="pkm-base-stat-val" id="pkm-base-atk">—</span>
                                </span>
                                <span class="pkm-selected-base-stat-item">
                                    <span class="pkm-base-stat-label"><?php echo esc_html($t['base_def']); ?></span>
                                    <span class="pkm-base-stat-val" id="pkm-base-def">—</span>
                                </span>
                                <span class="pkm-selected-base-stat-item">
                                    <span class="pkm-base-stat-label"><?php echo esc_html($t['base_sta']); ?></span>
                                    <span class="pkm-base-stat-val" id="pkm-base-sta">—</span>
                                </span>
                            </div>
                        </div>
                        <div id="pkm-selected-types" class="pkm-search-item-types" style="flex-shrink:0"></div>
                    </div>

                    <?php /* Validation errors */ ?>
                    <ul id="pkm-validation-errors" class="pkm-validation-errors" role="alert" aria-live="polite" style="display:none"></ul>

                    <?php /* Level + IVs grid */ ?>
                    <div class="pkm-calc-grid">

                        <?php /* Level field */ ?>
                        <div class="pkm-field">
                            <label class="pkm-field-label" for="pkm-level-slider">
                                <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                </svg>
                                <?php echo esc_html($t['level_label']); ?>
                            </label>
                            <div class="pkm-slider-row">
                                <input type="range" id="pkm-level-slider" class="pkm-slider"
                                       min="1" max="100" step="1" value="20"
                                       aria-label="<?php echo esc_attr($t['level_label']); ?>"
                                       inputmode="numeric">
                                <span id="pkm-level-display" class="pkm-level-display">10</span>
                            </div>
                        </div>

                        <?php /* Best IVs button — spans second column on desktop */ ?>
                        <div class="pkm-field" style="justify-content: flex-end !important;">
                            <label class="pkm-field-label" style="opacity:0" aria-hidden="true">&nbsp;</label>
                            <button type="button" id="pkm-best-ivs-btn" class="pkm-btn pkm-btn-accent" title="<?php echo esc_attr($t['best_ivs_btn']); ?>">
                                <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                </svg>
                                <?php echo esc_html($t['best_ivs_btn']); ?>
                            </button>
                        </div>

                        <?php /* IV Attack */ ?>
                        <div class="pkm-field">
                            <label class="pkm-field-label" for="pkm-iv-atk-slider">
                                <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/>
                                </svg>
                                <?php echo esc_html($t['iv_attack_label']); ?>
                            </label>
                            <div class="pkm-slider-row">
                                <input type="range" id="pkm-iv-atk-slider" class="pkm-slider"
                                       min="0" max="15" step="1" value="15"
                                       aria-label="<?php echo esc_attr($t['iv_attack_label']); ?>"
                                       inputmode="numeric">
                                <input type="number" id="pkm-iv-atk-num" class="pkm-num-input"
                                       min="0" max="15" value="15"
                                       inputmode="numeric" autocomplete="off"
                                       aria-label="<?php echo esc_attr($t['iv_attack_label']); ?>">
                            </div>
                        </div>

                        <?php /* IV Defense */ ?>
                        <div class="pkm-field">
                            <label class="pkm-field-label" for="pkm-iv-def-slider">
                                <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                </svg>
                                <?php echo esc_html($t['iv_defense_label']); ?>
                            </label>
                            <div class="pkm-slider-row">
                                <input type="range" id="pkm-iv-def-slider" class="pkm-slider"
                                       min="0" max="15" step="1" value="15"
                                       aria-label="<?php echo esc_attr($t['iv_defense_label']); ?>"
                                       inputmode="numeric">
                                <input type="number" id="pkm-iv-def-num" class="pkm-num-input"
                                       min="0" max="15" value="15"
                                       inputmode="numeric" autocomplete="off"
                                       aria-label="<?php echo esc_attr($t['iv_defense_label']); ?>">
                            </div>
                        </div>

                        <?php /* IV Stamina */ ?>
                        <div class="pkm-field">
                            <label class="pkm-field-label" for="pkm-iv-sta-slider">
                                <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
                                </svg>
                                <?php echo esc_html($t['iv_stamina_label']); ?>
                            </label>
                            <div class="pkm-slider-row">
                                <input type="range" id="pkm-iv-sta-slider" class="pkm-slider"
                                       min="0" max="15" step="1" value="15"
                                       aria-label="<?php echo esc_attr($t['iv_stamina_label']); ?>"
                                       inputmode="numeric">
                                <input type="number" id="pkm-iv-sta-num" class="pkm-num-input"
                                       min="0" max="15" value="15"
                                       inputmode="numeric" autocomplete="off"
                                       aria-label="<?php echo esc_attr($t['iv_stamina_label']); ?>">
                            </div>
                        </div>

                    </div><!-- .pkm-calc-grid -->

                    <?php /* Action buttons */ ?>
                    <div class="pkm-btn-row">
                        <button type="button" id="pkm-calc-btn" class="pkm-btn pkm-btn-primary">
                            <svg class="pkm-icon pkm-icon-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>
                            </svg>
                            <?php echo esc_html($t['calculate_btn']); ?>
                        </button>
                        <button type="button" id="pkm-reset-btn" class="pkm-btn pkm-btn-secondary">
                            <svg class="pkm-icon pkm-icon-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 102.13-9.36L1 10"/>
                            </svg>
                            <?php echo esc_html($t['reset_btn']); ?>
                        </button>
                    </div>

                </div><!-- .pkm-calc-card -->

                <?php /* ── RESULT CARD ── */ ?>
                <div id="pkm-result-card" class="pkm-result-card" role="region" aria-live="polite" aria-label="<?php echo esc_attr($t['result_title']); ?>">
                    <div class="pkm-result-header">
                        <img id="pkm-result-sprite" class="pkm-result-sprite" src="" alt="" width="64" height="64"
                             loading="lazy" onerror="this.style.display='none'">
                        <div>
                            <div id="pkm-result-pokemon-name" class="pkm-result-pokemon-name"></div>
                            <div id="pkm-result-types" class="pkm-result-types"></div>
                        </div>
                    </div>
                    <p class="pkm-result-title-label">
                        <svg class="pkm-icon pkm-icon-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
                        </svg>
                        <?php echo esc_html($t['result_title']); ?>
                    </p>
                    <div class="pkm-result-grid">
                        <div class="pkm-result-stat pkm-stat-cp">
                            <span class="pkm-stat-label"><?php echo esc_html($t['result_cp']); ?></span>
                            <span class="pkm-stat-value pkm-cp-value" id="pkm-res-cp">—</span>
                        </div>
                        <div class="pkm-result-stat">
                            <span class="pkm-stat-label"><?php echo esc_html($t['result_hp']); ?></span>
                            <span class="pkm-stat-value" id="pkm-res-hp">—</span>
                        </div>
                        <div class="pkm-result-stat">
                            <span class="pkm-stat-label"><?php echo esc_html($t['result_eff_atk']); ?></span>
                            <span class="pkm-stat-value" id="pkm-res-eff-atk">—</span>
                            <span class="pkm-stat-sub" id="pkm-res-eff-atk-sub"></span>
                        </div>
                        <div class="pkm-result-stat">
                            <span class="pkm-stat-label"><?php echo esc_html($t['result_eff_def']); ?></span>
                            <span class="pkm-stat-value" id="pkm-res-eff-def">—</span>
                            <span class="pkm-stat-sub" id="pkm-res-eff-def-sub"></span>
                        </div>
                        <div class="pkm-result-stat">
                            <span class="pkm-stat-label"><?php echo esc_html($t['result_eff_sta']); ?></span>
                            <span class="pkm-stat-value" id="pkm-res-eff-sta">—</span>
                            <span class="pkm-stat-sub" id="pkm-res-eff-sta-sub"></span>
                        </div>
                    </div>
                    <?php /* IV Perfection bar */ ?>
                    <div class="pkm-iv-perfection">
                        <span class="pkm-iv-pct-label"><?php echo esc_html($t['result_iv_pct']); ?></span>
                        <div class="pkm-iv-bar-wrap">
                            <div id="pkm-iv-bar" class="pkm-iv-bar"></div>
                        </div>
                        <span id="pkm-iv-pct-val" class="pkm-iv-pct-val">0%</span>
                    </div>
                </div><!-- #pkm-result-card -->

                <?php /* ── AD SLOT B ── */ ?>
                <?php echo $pkm_render_ad( $ad_slot_b, 'pkm-ad-below-result' ); ?>

                <?php /* ── INTRO SECTION (SEO — filled by Prompt 2) ── */ ?>
                <?php if ( ! empty( $t['intro_title'] ) || ! empty( $t['intro_content'] ) ) : ?>
                <div class="pkm-calc-card pkm-intro-section">
                    <?php if ( ! empty($t['intro_title']) ) : ?>
                    <h2 class="pkm-card-title"><?php echo esc_html($t['intro_title']); ?></h2>
                    <?php endif; ?>
                    <?php if ( ! empty($t['intro_content']) ) : ?>
                    <div class="pkm-prose"><?php echo wp_kses_post($t['intro_content']); ?></div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php /* ── AD SLOT C ── */ ?>
                <?php echo $pkm_render_ad( $ad_slot_c, 'pkm-ad-mid-content' ); ?>

                <?php /* ── HOW-TO SECTION (SEO — filled by Prompt 2) ── */ ?>
                <?php if ( ! empty( $t['howto_title'] ) ) : ?>
                <div class="pkm-calc-card pkm-howto-section">
                    <h2 class="pkm-card-title">
                        <svg class="pkm-icon pkm-icon-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                        </svg>
                        <?php echo esc_html($t['howto_title']); ?>
                    </h2>
                    <div class="pkm-howto-steps">
                        <?php
                        $step_icons = [
                            1 => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>',
                            2 => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
                            3 => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>',
                            4 => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>',
                        ];
                        foreach ( ['howto_step1','howto_step2','howto_step3','howto_step4'] as $si => $step ) :
                            if ( empty($t[$step]) ) continue;
                            $num = $si + 1;
                        ?>
                        <div class="pkm-howto-step">
                            <div class="pkm-howto-step-num"><?php echo $num; ?></div>
                            <div class="pkm-howto-step-body"><?php echo wp_kses_post($t[$step]); ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php /* ── INFO TABLE SECTION (SEO — filled by Prompt 2) ── */ ?>
                <?php if ( ! empty($t['info_title']) || ! empty($t['info_table_html']) ) : ?>
                <div class="pkm-calc-card pkm-info-section">
                    <?php if ( ! empty($t['info_title']) ) : ?>
                    <h2 class="pkm-card-title"><?php echo esc_html($t['info_title']); ?></h2>
                    <?php endif; ?>
                    <?php if ( ! empty($t['info_content']) ) : ?>
                    <div class="pkm-prose pkm-info-prose"><?php echo wp_kses_post($t['info_content']); ?></div>
                    <?php endif; ?>
                    <?php if ( ! empty($t['info_table_title']) ) : ?>
                    <h3 class="pkm-table-section-title"><?php echo esc_html($t['info_table_title']); ?></h3>
                    <?php endif; ?>
                    <?php if ( ! empty($t['info_table_html']) ) : ?>
                    <div class="pkm-table-wrapper"><?php echo wp_kses_post($t['info_table_html']); ?></div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php /* ── FAQ SECTION — Accordion ── */ ?>
                <?php if ( ! empty($t['faq_title']) ) : ?>
                <div class="pkm-calc-card pkm-faq-section">
                    <h2 class="pkm-card-title">
                        <svg class="pkm-icon pkm-icon-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                        </svg>
                        <?php echo esc_html($t['faq_title']); ?>
                    </h2>
                    <div class="pkm-faq-list" itemscope itemtype="https://schema.org/FAQPage">
                        <?php
                        for ( $qi = 1; $qi <= 8; $qi++ ) {
                            $q = $t["faq_q{$qi}"] ?? '';
                            $a = $t["faq_a{$qi}"] ?? '';
                            if ( empty($q) || empty($a) ) continue;
                            $faq_id = 'pkm-faq-' . $qi;
                            ?>
                            <div class="pkm-faq-item<?php echo $qi === 1 ? ' open' : ''; ?>" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" id="<?php echo esc_attr($faq_id); ?>">
                                <button class="pkm-faq-trigger" type="button" aria-expanded="<?php echo $qi === 1 ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr($faq_id . '-body'); ?>">
                                    <span class="pkm-faq-trigger-text" itemprop="name"><?php echo esc_html($q); ?></span>
                                    <span class="pkm-faq-chevron" aria-hidden="true">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                                    </span>
                                </button>
                                <div class="pkm-faq-body" id="<?php echo esc_attr($faq_id . '-body'); ?>" role="region" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                                    <div class="pkm-faq-answer" itemprop="text"><?php echo wp_kses_post($a); ?></div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php /* ── AD SLOT D ── */ ?>
                <?php echo $pkm_render_ad( $ad_slot_d, 'pkm-ad-bottom' ); ?>

                <?php /* ── RELATED TOOLS SECTION — powered by ACF fields on sibling pages ── */ ?>
                <?php
                // ── Section title + arrow CTA labels ──
                $related_label_map = [
                    'en'    => 'More Pokémon GO Calculators',
                    'es'    => 'Más Calculadoras Pokémon GO',
                    'pt-br' => 'Mais Calculadoras Pokémon GO',
                    'fr'    => 'Plus de Calculateurs Pokémon GO',
                    'de'    => 'Weitere Pokémon GO Rechner',
                ];
                $related_title = $related_label_map[ $lang ] ?? $related_label_map['en'];

                $arrow_label_map = [
                    'en'    => 'Open tool',
                    'es'    => 'Abrir herramienta',
                    'pt-br' => 'Abrir ferramenta',
                    'fr'    => 'Ouvrir l\'outil',
                    'de'    => 'Tool öffnen',
                ];
                $arrow_label = $arrow_label_map[ $lang ] ?? $arrow_label_map['en'];

                $no_tools_label_map = [
                    'en'    => $t['no_related_tools'] ?? 'No related tools yet. More calculators coming soon!',
                    'es'    => $t['no_related_tools'] ?? '¡Pronto más calculadoras!',
                    'pt-br' => $t['no_related_tools'] ?? 'Mais calculadoras em breve!',
                    'fr'    => $t['no_related_tools'] ?? 'D\'autres calculateurs arrivent bientôt !',
                    'de'    => $t['no_related_tools'] ?? 'Weitere Rechner kommen bald!',
                ];
                $no_tools_label = $no_tools_label_map[ $lang ] ?? $no_tools_label_map['en'];

                // ── Determine the current page's language parent slug ──
                // Language parent pages: /en/, /es/, /pt-br/, /fr/, /de/
                // We find the top-level ancestor of the current page whose slug matches $lang.
                $current_id     = get_the_ID();
                $lang_slug_map  = [ 'en' => 'en', 'es' => 'es', 'pt-br' => 'pt-br', 'fr' => 'fr', 'de' => 'de' ];
                $lang_slug      = $lang_slug_map[ $lang ] ?? 'en';

                // Find the language parent page ID
                $lang_parent = get_page_by_path( $lang_slug );
                $lang_parent_id = $lang_parent ? intval( $lang_parent->ID ) : 0;

                // ── Query all direct children of the language parent — excluding current page ──
                $related_tools_data = [];
                if ( $lang_parent_id > 0 ) {
                    $siblings_query = new WP_Query( [
                        'post_type'      => 'page',
                        'post_parent'    => $lang_parent_id,
                        'post_status'    => 'publish',
                        'post__not_in'   => [ $current_id ],
                        'posts_per_page' => -1,
                        'orderby'        => 'menu_order',
                        'order'          => 'ASC',
                        'no_found_rows'  => true,
                    ] );

                    if ( $siblings_query->have_posts() ) {
                        foreach ( $siblings_query->posts as $sibling ) {
                            // Read ACF fields: tool_short_name, tool_one_line_description, tool_svg_icon_text
                            $tool_name = '';
                            $tool_desc = '';
                            $tool_icon = '';

                            if ( function_exists( 'get_field' ) ) {
                                $tool_name = get_field( 'tool_short_name',          $sibling->ID ) ?: '';
                                $tool_desc = get_field( 'tool_one_line_description', $sibling->ID ) ?: '';
                                $tool_icon = get_field( 'tool_svg_icon_text',       $sibling->ID ) ?: '';
                            }

                            // Fallbacks if ACF fields are empty
                            if ( '' === $tool_name ) $tool_name = $sibling->post_title;
                            if ( '' === $tool_icon ) {
                                // Default calculator SVG icon
                                $tool_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="22" height="22"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="8" y1="6" x2="16" y2="6"/><line x1="8" y1="10" x2="16" y2="10"/><line x1="8" y1="14" x2="12" y2="14"/></svg>';
                            }

                            $related_tools_data[] = [
                                'name' => sanitize_text_field( $tool_name ),
                                'desc' => sanitize_text_field( $tool_desc ),
                                'icon' => wp_kses( $tool_icon, [
                                    'svg'      => [ 'xmlns' => true, 'viewBox' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true, 'stroke-linecap' => true, 'stroke-linejoin' => true, 'width' => true, 'height' => true, 'class' => true, 'aria-hidden' => true ],
                                    'path'     => [ 'd' => true, 'fill' => true, 'stroke' => true ],
                                    'circle'   => [ 'cx' => true, 'cy' => true, 'r' => true, 'fill' => true, 'stroke' => true ],
                                    'rect'     => [ 'x' => true, 'y' => true, 'width' => true, 'height' => true, 'rx' => true, 'ry' => true, 'fill' => true, 'stroke' => true ],
                                    'line'     => [ 'x1' => true, 'y1' => true, 'x2' => true, 'y2' => true, 'stroke' => true ],
                                    'polyline' => [ 'points' => true, 'fill' => true, 'stroke' => true ],
                                    'polygon'  => [ 'points' => true, 'fill' => true, 'stroke' => true ],
                                    'g'        => [ 'fill' => true, 'stroke' => true, 'transform' => true ],
                                ] ),
                                'url'  => get_permalink( $sibling->ID ),
                            ];
                        }
                    }
                    wp_reset_postdata();
                }
                ?>
                <div class="pkm-calc-card pkm-related-section">
                    <h2 class="pkm-related-section-title"><?php echo esc_html( $related_title ); ?></h2>
                    <?php if ( ! empty( $related_tools_data ) ) : ?>
                    <div class="pkm-related-grid">
                        <?php foreach ( $related_tools_data as $tool ) : ?>
                        <a href="<?php echo esc_url( $tool['url'] ); ?>" class="pkm-related-card" rel="noopener">
                            <div class="pkm-related-card-icon">
                                <?php echo $tool['icon']; // already wp_kses'd above ?>
                            </div>
                            <div class="pkm-related-card-name"><?php echo esc_html( $tool['name'] ); ?></div>
                            <?php if ( ! empty( $tool['desc'] ) ) : ?>
                            <div class="pkm-related-card-desc"><?php echo esc_html( $tool['desc'] ); ?></div>
                            <?php endif; ?>
                            <div class="pkm-related-card-arrow">
                                <?php echo esc_html( $arrow_label ); ?>
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                    <?php else : ?>
                    <p class="pkm-related-empty" style="color:var(--pkm-text-muted) !important; font-size:14px !important; margin:0 !important;">
                        <?php echo esc_html( $no_tools_label ); ?>
                    </p>
                    <?php endif; ?>
                </div>

            </div><!-- .pkm-calc-wrapper -->
        </div><!-- .pkm-calc-outer -->

        <?php /* ── FAQ ACCORDION JS ── */ ?>
        <script>
        (function(){
            var items = document.querySelectorAll('.pkm-faq-item');
            if (!items.length) return;
            items.forEach(function(item) {
                var btn  = item.querySelector('.pkm-faq-trigger');
                var body = item.querySelector('.pkm-faq-body');
                if (!btn || !body) return;
                // Set initial max-height for open item
                if (item.classList.contains('open')) {
                    body.style.maxHeight = body.scrollHeight + 'px';
                }
                btn.addEventListener('click', function() {
                    var isOpen = item.classList.contains('open');
                    // Close all
                    items.forEach(function(el) {
                        el.classList.remove('open');
                        var b = el.querySelector('.pkm-faq-body');
                        var t = el.querySelector('.pkm-faq-trigger');
                        if (b) b.style.maxHeight = '0';
                        if (t) t.setAttribute('aria-expanded', 'false');
                    });
                    // Open clicked if it was closed
                    if (!isOpen) {
                        item.classList.add('open');
                        body.style.maxHeight = body.scrollHeight + 'px';
                        btn.setAttribute('aria-expanded', 'true');
                    }
                });
            });
        })();
        </script>

        <?php /* ══ DATA + JS ══ */ ?>
        <script>
        const pkmData=<?php echo wp_json_encode($js_data); ?>;
        const pkmTrans=<?php echo wp_json_encode($js_translations); ?>;
        const pkmTypeColors=<?php echo wp_json_encode($type_colors); ?>;
        </script>

        <?php
        // ── Obfuscated IIFE — CPM table + calculator logic ──
        // CPM values from Bulbapedia for levels 1–50 (step 0.5 = index*2 maps to level*2)
        // index 0 = Level 1, index 1 = Level 1.5, ..., index 98 = Level 50
        ?>
        <script>
        /* pkm-go-stat-calc v1.0 */
        (function(){
        'use strict';
        // CPM lookup table — Bulbapedia verified, 101 entries (L1 to L50 inclusive, step 0.5)
        var _0x1a=[0.09399414,0.13513513,0.16639787,0.19265091,0.21573247,0.23657266,0.25572005,0.27353038,0.29024988,0.30605738,0.32108760,0.33544503,0.34921268,0.36245775,0.37523559,0.38759241,0.39956728,0.41119662,0.42250000,0.43349540,0.44419524,0.45461468,0.46476840,0.47468234,0.48437500,0.49384683,0.50310755,0.51214905,0.52097960,0.52960397,0.53803060,0.54626739,0.55432109,0.56219917,0.56990880,0.57745743,0.58484530,0.59207249,0.59914086,0.60605453,0.61281972,0.61943700,0.62590877,0.63223843,0.63843066,0.64448959,0.65041235,0.65620580,0.66187500,0.66742158,0.67285036,0.67816296,0.68336010,0.68844248,0.69341295,0.69827520,0.70303440,0.70769097,0.71225000,0.71670970,0.72107440,0.72535200,0.72954460,0.73365384,0.73768454,0.74164086,0.74551913,0.74931890,0.75305001,0.75670946,0.76030120,0.76383183,0.76730040,0.77071130,0.77406988,0.77737904,0.78064040,0.78385223,0.78700000,0.79010162,0.79315424,0.79616307,0.79913448,0.80207025,0.80497220,0.80784050,0.81068024,0.81348610,0.81626001,0.81900770,0.82172942,0.82442588,0.82709773,0.82974530,0.83237028,0.83497131,0.83754820,0.84010124,0.84265016,0.84517545];
        // Map slider value (1–100) to [level, cpmIndex]
        // slider 1 = Level 1 (index 0), slider 2 = Level 1.5 (index 1), ... slider 100 = Level 50 (index 99)
        function _sliderToLevel(s){var v=parseInt(s)||1;v=Math.max(1,Math.min(100,v));var idx=v-1;var lvl=(idx%2===0)?(idx/2+1):((idx-1)/2+1.5);return{level:lvl,cpmIdx:idx};}
        function _getCPM(sliderVal){var r=_sliderToLevel(sliderVal);return _0x1a[r.cpmIdx]||0;}
        // Stat getters
        function _getStats(mon){return{atk:parseInt(mon.stats.attack||0),def:parseInt(mon.stats.defense||0),sta:parseInt(mon.stats.stamina||mon.stats.hp||0)};}
        function _safeDiv(a,b,fb){return b===0?fb:a/b;}
        function _safeNum(v,fb){return(isNaN(v)||!isFinite(v))?fb:v;}
        function _clamp(v,mn,mx){return Math.max(mn,Math.min(mx,v));}
        // CP formula: floor( (BaseAtk+IVAtk)^0.5 × (BaseDef+IVDef)^0.25 × (BaseSta+IVSta)^0.25 × CPM^2 / 10 )
        function calcCP(bAtk,bDef,bSta,ivAtk,ivDef,ivSta,cpm){
            var a=bAtk+ivAtk,d=bDef+ivDef,s=bSta+ivSta;
            if(a<=0||d<=0||s<=0||cpm<=0)return 10;
            var cp=Math.floor(Math.pow(a,0.5)*Math.pow(d,0.25)*Math.pow(s,0.25)*(cpm*cpm)/10);
            return _safeNum(Math.max(10,cp),10);
        }
        // HP formula: max(10, floor( (BaseSta+IVSta) × CPM ))
        function calcHP(bSta,ivSta,cpm){
            var hp=Math.floor((bSta+ivSta)*cpm);
            return _safeNum(Math.max(10,hp),10);
        }
        // Effective stats
        function calcEffAtk(bAtk,ivAtk,cpm){return _safeNum((bAtk+ivAtk)*cpm,0);}
        function calcEffDef(bDef,ivDef,cpm){return _safeNum((bDef+ivDef)*cpm,0);}
        function calcEffSta(bSta,ivSta,cpm){return _safeNum((bSta+ivSta)*cpm,0);}

        // ── DOM refs (null-checked before use) ──
        var elSearch=document.getElementById('pkm-search-input');
        var elDropdown=document.getElementById('pkm-search-dropdown');
        var elPokemonId=document.getElementById('pkm-pokemon-id');
        var elSelected=document.getElementById('pkm-selected-pokemon');
        var elSelSprite=document.getElementById('pkm-selected-sprite');
        var elSelName=document.getElementById('pkm-selected-name');
        var elBaseAtk=document.getElementById('pkm-base-atk');
        var elBaseDef=document.getElementById('pkm-base-def');
        var elBaseSta=document.getElementById('pkm-base-sta');
        var elSelTypes=document.getElementById('pkm-selected-types');
        var elLevelSlider=document.getElementById('pkm-level-slider');
        var elLevelDisplay=document.getElementById('pkm-level-display');
        var elIvAtkSlider=document.getElementById('pkm-iv-atk-slider');
        var elIvAtkNum=document.getElementById('pkm-iv-atk-num');
        var elIvDefSlider=document.getElementById('pkm-iv-def-slider');
        var elIvDefNum=document.getElementById('pkm-iv-def-num');
        var elIvStaSlider=document.getElementById('pkm-iv-sta-slider');
        var elIvStaNum=document.getElementById('pkm-iv-sta-num');
        var elCalcBtn=document.getElementById('pkm-calc-btn');
        var elResetBtn=document.getElementById('pkm-reset-btn');
        var elBestIvs=document.getElementById('pkm-best-ivs-btn');
        var elResultCard=document.getElementById('pkm-result-card');
        var elResSpr=document.getElementById('pkm-result-sprite');
        var elResName=document.getElementById('pkm-result-pokemon-name');
        var elResTypes=document.getElementById('pkm-result-types');
        var elResCP=document.getElementById('pkm-res-cp');
        var elResHP=document.getElementById('pkm-res-hp');
        var elResEffAtk=document.getElementById('pkm-res-eff-atk');
        var elResEffAtkSub=document.getElementById('pkm-res-eff-atk-sub');
        var elResEffDef=document.getElementById('pkm-res-eff-def');
        var elResEffDefSub=document.getElementById('pkm-res-eff-def-sub');
        var elResEffSta=document.getElementById('pkm-res-eff-sta');
        var elResEffStaSub=document.getElementById('pkm-res-eff-sta-sub');
        var elIvBar=document.getElementById('pkm-iv-bar');
        var elIvPctVal=document.getElementById('pkm-iv-pct-val');
        var elValidErrors=document.getElementById('pkm-validation-errors');
        var elDataError=document.getElementById('pkm-calc-error');

        // ── Guard: data not loaded ──
        // Error box has style="display:none !important" set by PHP on the element.
        // JS uses setAttribute to override it when data is missing.
        if(typeof pkmData==='undefined'||!Array.isArray(pkmData)||pkmData.length===0){
            if(elDataError)elDataError.setAttribute('style','display:flex !important;align-items:flex-start');
            if(elCalcBtn)elCalcBtn.disabled=true;
            return;
        }
        // Data loaded fine — belt-and-suspenders: ensure box is hidden
        if(elDataError)elDataError.setAttribute('style','display:none !important');

        // ── State ──
        var selectedPokemon=null;
        var searchDebounce=null;
        var activeDropdownIdx=-1;

        // ── Capitalise helper ──
        function cap(s){return s?s.charAt(0).toUpperCase()+s.slice(1):'';}

        // ── Type badge HTML ──
        function typeBadge(type){
            var col=(typeof pkmTypeColors!=='undefined'&&pkmTypeColors[type])?pkmTypeColors[type]:'#888';
            return '<span class="pkm-type-badge" style="background:'+col+'">'+cap(type)+'</span>';
        }

        // ── Level display ──
        function updateLevelDisplay(){
            if(!elLevelSlider||!elLevelDisplay)return;
            var r=_sliderToLevel(elLevelSlider.value);
            elLevelDisplay.textContent=r.level%1===0?r.level.toString():r.level.toFixed(1);
        }

        // ── Sync slider ↔ number input ──
        function syncSliderNum(slider,num,mn,mx){
            if(!slider||!num)return;
            slider.addEventListener('input',function(){
                var v=_clamp(parseInt(this.value)||mn,mn,mx);
                num.value=v;
                updateSliderFill(slider,mn,mx);
            });
            num.addEventListener('input',function(){
                var v=_clamp(parseInt(this.value)||mn,mn,mx);
                this.value=v;
                slider.value=v;
                updateSliderFill(slider,mn,mx);
            });
            num.addEventListener('blur',function(){
                var v=_clamp(parseInt(this.value)||mn,mn,mx);
                this.value=v;
                slider.value=v;
                updateSliderFill(slider,mn,mx);
            });
        }

        // ── Slider fill colour via CSS gradient ──
        function updateSliderFill(slider,mn,mx){
            if(!slider)return;
            var pct=((slider.value-mn)/(mx-mn))*100;
            slider.style.background='linear-gradient(to right,var(--pkm-primary) 0%,var(--pkm-primary) '+pct+'%,var(--pkm-bg-3) '+pct+'%,var(--pkm-bg-3) 100%)';
        }

        // Init slider fills
        if(elLevelSlider){elLevelSlider.addEventListener('input',function(){updateLevelDisplay();updateSliderFill(elLevelSlider,1,100);});updateSliderFill(elLevelSlider,1,100);updateLevelDisplay();}
        syncSliderNum(elIvAtkSlider,elIvAtkNum,0,15);
        syncSliderNum(elIvDefSlider,elIvDefNum,0,15);
        syncSliderNum(elIvStaSlider,elIvStaNum,0,15);
        if(elIvAtkSlider)updateSliderFill(elIvAtkSlider,0,15);
        if(elIvDefSlider)updateSliderFill(elIvDefSlider,0,15);
        if(elIvStaSlider)updateSliderFill(elIvStaSlider,0,15);

        // ── Search ──
        function renderDropdown(results){
            if(!elDropdown)return;
            if(!results||results.length===0){
                elDropdown.innerHTML='<div class="pkm-search-no-results">'+((typeof pkmTrans!=='undefined')?pkmTrans.error_no_results:'No results')+'</div>';
                elDropdown.classList.add('active');
                if(elSearch)elSearch.setAttribute('aria-expanded','true');
                activeDropdownIdx=-1;
                return;
            }
            var html='';
            for(var i=0;i<results.length;i++){
                var p=results[i];
                var types=p.types||[];
                var typesHtml='';
                for(var j=0;j<types.length;j++)typesHtml+=typeBadge(types[j]);
                html+='<div class="pkm-search-item" role="option" data-id="'+p.id+'" data-idx="'+i+'" tabindex="-1" aria-selected="false">';
                html+='<img class="pkm-search-item-sprite" src="'+(p.sprite||'')+'" alt="" width="32" height="32" loading="lazy" onerror="this.style.display=\'none\'">';
                html+='<span class="pkm-search-item-name">'+cap(p.name)+'</span>';
                html+='<span class="pkm-search-item-types">'+typesHtml+'</span>';
                html+='</div>';
            }
            elDropdown.innerHTML=html;
            elDropdown.classList.add('active');
            if(elSearch)elSearch.setAttribute('aria-expanded','true');
            activeDropdownIdx=-1;
            // Click handlers
            var items=elDropdown.querySelectorAll('.pkm-search-item');
            for(var k=0;k<items.length;k++){
                items[k].addEventListener('mousedown',function(e){
                    e.preventDefault();
                    var id=parseInt(this.getAttribute('data-id'));
                    selectPokemon(id);
                });
            }
        }

        function closeDropdown(){
            if(elDropdown){elDropdown.classList.remove('active');elDropdown.innerHTML='';}
            if(elSearch)elSearch.setAttribute('aria-expanded','false');
            activeDropdownIdx=-1;
        }

        function selectPokemon(id){
            var mon=null;
            for(var i=0;i<pkmData.length;i++){if(pkmData[i].id===id){mon=pkmData[i];break;}}
            if(!mon)return;
            selectedPokemon=mon;
            if(elSearch)elSearch.value=cap(mon.name);
            if(elPokemonId)elPokemonId.value=mon.id;
            closeDropdown();
            // Update preview
            if(elSelected)elSelected.classList.add('visible');
            if(elSelSprite){elSelSprite.src=mon.spriteO||mon.sprite||'';elSelSprite.style.display='';}
            if(elSelName)elSelName.textContent=cap(mon.name);
            var stats=mon.stats||{};
            var bAtk=parseInt(stats.attack||0),bDef=parseInt(stats.defense||0),bSta=parseInt(stats.stamina||stats.hp||0);
            if(elBaseAtk)elBaseAtk.textContent=bAtk;
            if(elBaseDef)elBaseDef.textContent=bDef;
            if(elBaseSta)elBaseSta.textContent=bSta;
            if(elSelTypes){
                var types=mon.types||[];
                var h='';for(var t2=0;t2<types.length;t2++)h+=typeBadge(types[t2]);
                elSelTypes.innerHTML=h;
            }
            // Hide result card when new pokemon selected
            if(elResultCard)elResultCard.classList.remove('visible');
            // Clear errors
            showErrors([]);
        }

        if(elSearch){
            elSearch.addEventListener('input',function(){
                clearTimeout(searchDebounce);
                var q=this.value.trim();
                if(q.length<2){closeDropdown();return;}
                searchDebounce=setTimeout(function(){
                    var lower=q.toLowerCase();
                    var res=[];
                    for(var i=0;i<pkmData.length&&res.length<20;i++){
                        if(pkmData[i].name&&pkmData[i].name.toLowerCase().indexOf(lower)===0)res.push(pkmData[i]);
                    }
                    // also include contains matches if fewer than 5 prefix matches
                    if(res.length<5){
                        for(var i2=0;i2<pkmData.length&&res.length<20;i2++){
                            var already=false;for(var r2=0;r2<res.length;r2++)if(res[r2].id===pkmData[i2].id){already=true;break;}
                            if(!already&&pkmData[i2].name&&pkmData[i2].name.toLowerCase().indexOf(lower)>0)res.push(pkmData[i2]);
                        }
                    }
                    renderDropdown(res);
                },220);
            });

            elSearch.addEventListener('keydown',function(e){
                var items=elDropdown?elDropdown.querySelectorAll('.pkm-search-item'):[];
                if(e.key==='ArrowDown'){
                    e.preventDefault();
                    if(items.length===0)return;
                    activeDropdownIdx=Math.min(activeDropdownIdx+1,items.length-1);
                    for(var i=0;i<items.length;i++)items[i].classList.toggle('highlighted',i===activeDropdownIdx);
                    if(items[activeDropdownIdx])items[activeDropdownIdx].scrollIntoView({block:'nearest'});
                }else if(e.key==='ArrowUp'){
                    e.preventDefault();
                    if(items.length===0)return;
                    activeDropdownIdx=Math.max(activeDropdownIdx-1,0);
                    for(var i=0;i<items.length;i++)items[i].classList.toggle('highlighted',i===activeDropdownIdx);
                    if(items[activeDropdownIdx])items[activeDropdownIdx].scrollIntoView({block:'nearest'});
                }else if(e.key==='Enter'){
                    e.preventDefault();
                    if(activeDropdownIdx>=0&&items[activeDropdownIdx]){
                        var id=parseInt(items[activeDropdownIdx].getAttribute('data-id'));
                        selectPokemon(id);
                    }
                }else if(e.key==='Escape'){
                    closeDropdown();
                }
            });

            elSearch.addEventListener('blur',function(){
                setTimeout(function(){closeDropdown();},200);
            });
        }

        // Click outside
        document.addEventListener('click',function(e){
            if(elSearch&&elDropdown&&!elSearch.contains(e.target)&&!elDropdown.contains(e.target))closeDropdown();
        });

        // ── Best IVs button ──
        if(elBestIvs){
            elBestIvs.addEventListener('click',function(){
                if(elIvAtkSlider){elIvAtkSlider.value=15;updateSliderFill(elIvAtkSlider,0,15);}
                if(elIvAtkNum)elIvAtkNum.value=15;
                if(elIvDefSlider){elIvDefSlider.value=15;updateSliderFill(elIvDefSlider,0,15);}
                if(elIvDefNum)elIvDefNum.value=15;
                if(elIvStaSlider){elIvStaSlider.value=15;updateSliderFill(elIvStaSlider,0,15);}
                if(elIvStaNum)elIvStaNum.value=15;
            });
        }

        // ── Validation ──
        function showErrors(errors){
            if(!elValidErrors)return;
            if(!errors||errors.length===0){elValidErrors.innerHTML='';elValidErrors.style.display='none';return;}
            elValidErrors.innerHTML=errors.map(function(e2){return'<li>'+e2+'</li>';}).join('');
            elValidErrors.style.display='block';
        }

        function validateInputs(){
            var errors=[];
            if(!selectedPokemon)errors.push((typeof pkmTrans!=='undefined')?pkmTrans.error_select_pokemon:'Please select a Pokemon.');
            var lvl=elLevelSlider?parseInt(elLevelSlider.value):0;
            if(lvl<1||lvl>100)errors.push((typeof pkmTrans!=='undefined')?pkmTrans.error_invalid_level:'Level invalid.');
            var ivAtk=elIvAtkNum?parseInt(elIvAtkNum.value):0;
            var ivDef=elIvDefNum?parseInt(elIvDefNum.value):0;
            var ivSta=elIvStaNum?parseInt(elIvStaNum.value):0;
            if(ivAtk<0||ivAtk>15||ivDef<0||ivDef>15||ivSta<0||ivSta>15)
                errors.push((typeof pkmTrans!=='undefined')?pkmTrans.error_invalid_iv:'IV values must be 0–15.');
            return errors;
        }

        // ── Calculate ──
        if(elCalcBtn){
            elCalcBtn.addEventListener('click',function(){
                var errors=validateInputs();
                showErrors(errors);
                if(errors.length>0)return;
                try{
                    var mon=selectedPokemon;
                    var stats=mon.stats||{};
                    var bAtk=parseInt(stats.attack||0);
                    var bDef=parseInt(stats.defense||0);
                    var bSta=parseInt(stats.stamina||stats.hp||0);
                    var ivAtk=_clamp(parseInt(elIvAtkNum?elIvAtkNum.value:0)||0,0,15);
                    var ivDef=_clamp(parseInt(elIvDefNum?elIvDefNum.value:0)||0,0,15);
                    var ivSta=_clamp(parseInt(elIvStaNum?elIvStaNum.value:0)||0,0,15);
                    var cpm=_getCPM(elLevelSlider?elLevelSlider.value:20);
                    var cp=calcCP(bAtk,bDef,bSta,ivAtk,ivDef,ivSta,cpm);
                    var hp=calcHP(bSta,ivSta,cpm);
                    var effAtk=calcEffAtk(bAtk,ivAtk,cpm);
                    var effDef=calcEffDef(bDef,ivDef,cpm);
                    var effSta=calcEffSta(bSta,ivSta,cpm);
                    var ivPct=Math.round(((ivAtk+ivDef+ivSta)/45)*100);
                    // Update result card
                    if(elResCP)elResCP.textContent=cp;
                    if(elResHP)elResHP.textContent=hp;
                    if(elResEffAtk)elResEffAtk.textContent=effAtk.toFixed(2);
                    if(elResEffAtkSub)elResEffAtkSub.textContent='Base '+bAtk+' + IV '+ivAtk;
                    if(elResEffDef)elResEffDef.textContent=effDef.toFixed(2);
                    if(elResEffDefSub)elResEffDefSub.textContent='Base '+bDef+' + IV '+ivDef;
                    if(elResEffSta)elResEffSta.textContent=effSta.toFixed(2);
                    if(elResEffStaSub)elResEffStaSub.textContent='Base '+bSta+' + IV '+ivSta;
                    if(elIvBar){
                        // setAttribute beats CSS !important — this is the reliable cross-browser method
                        elIvBar.setAttribute('style','width:'+ivPct+'% !important;height:100%;border-radius:20px;background:linear-gradient(90deg,#0D9488,#F4D03F);transition:width 0.6s cubic-bezier(0.4,0,0.2,1);display:block');
                    }
                    if(elIvPctVal)elIvPctVal.textContent=ivPct+'%';
                    // Pokemon info in result header
                    if(elResSpr){elResSpr.src=mon.spriteO||mon.sprite||'';elResSpr.style.display='';}
                    if(elResName)elResName.textContent=cap(mon.name);
                    if(elResTypes){
                        var types=mon.types||[];var th='';
                        for(var i=0;i<types.length;i++)th+=typeBadge(types[i]);
                        elResTypes.innerHTML=th;
                    }
                    if(elResultCard)elResultCard.classList.add('visible');
                    // Smooth scroll to result
                    if(elResultCard)elResultCard.scrollIntoView({behavior:'smooth',block:'nearest'});
                }catch(err){
                    var calcErrMsg=[(typeof pkmTrans!=='undefined')?pkmTrans.error_calculation:'Calculation error.'];
                    showErrors(calcErrMsg);
                }
            });
        }

        // ── Reset ──
        if(elResetBtn){
            elResetBtn.addEventListener('click',function(){
                selectedPokemon=null;
                if(elSearch)elSearch.value='';
                if(elPokemonId)elPokemonId.value='';
                if(elSelected)elSelected.classList.remove('visible');
                if(elBaseAtk)elBaseAtk.textContent='—';
                if(elBaseDef)elBaseDef.textContent='—';
                if(elBaseSta)elBaseSta.textContent='—';
                if(elSelTypes)elSelTypes.innerHTML='';
                if(elLevelSlider){elLevelSlider.value=20;updateLevelDisplay();updateSliderFill(elLevelSlider,1,100);}
                if(elIvAtkSlider){elIvAtkSlider.value=15;updateSliderFill(elIvAtkSlider,0,15);}
                if(elIvAtkNum)elIvAtkNum.value=15;
                if(elIvDefSlider){elIvDefSlider.value=15;updateSliderFill(elIvDefSlider,0,15);}
                if(elIvDefNum)elIvDefNum.value=15;
                if(elIvStaSlider){elIvStaSlider.value=15;updateSliderFill(elIvStaSlider,0,15);}
                if(elIvStaNum)elIvStaNum.value=15;
                if(elResultCard)elResultCard.classList.remove('visible');
                showErrors([]);
                closeDropdown();
            });
        }

        })();
        </script>
        <?php
        return ob_get_clean();
    }
    add_shortcode( 'pkm_go_stat_calc', 'pkm_go_stat_calc_shortcode' );
}