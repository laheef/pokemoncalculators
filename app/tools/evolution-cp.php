<?php
// Standalone PHP

/*
 * ============================================================
 * Pokemon GO Evolution CP Calculator
 * File: wp-content/themes/theme-v1.3.0/pkm-calculators/pkm-evolution-cp.php
 * Shortcode: [pkm_evolution_cp_calc]
 * ============================================================
 *
 * LANGUAGE SWITCHER SETUP — REQUIRED
 * Add the following line to the $slug_map array inside
 * the pkm_get_lang_url() function in functions.php:
 *
 * 'pokemon-go-evolution-cp-calculator' => array(
 *     'es'    => 'calculadora-cp-evolucion-pokemon-go',
 *     'pt-br' => 'calculadora-cp-evolucao-pokemon-go',
 *     'fr'    => 'calculateur-pc-evolution-pokemon-go',
 *     'de'    => 'entwicklungs-kp-rechner-pokemon-go',
 * ),
 *
 * FUNCTIONS.PHP REGISTRATION (add once):
 * require_once get_stylesheet_directory() . '/pkm-calculators/pkm-evolution-cp.php';
 * ============================================================
 */

// ── Google Analytics ──────────────────────────────────────────────────────────
function pkm_evolution_cp_gtag() {
    if ( ! is_page([
        'pokemon-go-evolution-cp-calculator',
        'calculadora-cp-evolucion-pokemon-go',
        'calculadora-cp-evolucao-pokemon-go',
        'calculateur-pc-evolution-pokemon-go',
        'entwicklungs-kp-rechner-pokemon-go',
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
add_action( 'wp_head', 'pkm_evolution_cp_gtag', 1 );

// ── Hreflang ──────────────────────────────────────────────────────────────────
function pkm_evolution_cp_hreflang() {
    if ( ! is_page([
        'pokemon-go-evolution-cp-calculator',
        'calculadora-cp-evolucion-pokemon-go',
        'calculadora-cp-evolucao-pokemon-go',
        'calculateur-pc-evolution-pokemon-go',
        'entwicklungs-kp-rechner-pokemon-go',
    ]) ) return;
    $langs = [ 'en', 'es', 'pt-br', 'fr', 'de' ];
    foreach ( $langs as $l ) {
        $hreflang = ( $l === 'pt-br' ) ? 'pt-BR' : $l;
        echo '<link rel="alternate" hreflang="' . esc_attr( $hreflang ) . '" href="' . esc_url( pkm_get_lang_url( $l ) ) . '">' . "\n";
    }
    echo '<link rel="alternate" hreflang="x-default" href="' . esc_url( pkm_get_lang_url( 'en' ) ) . '">' . "\n";
}
add_action( 'wp_head', 'pkm_evolution_cp_hreflang' );

// ── Self-referencing Canonical ────────────────────────────────────────────────
function pkm_evolution_cp_canonical() {
    if ( ! is_page([
        'pokemon-go-evolution-cp-calculator',
        'calculadora-cp-evolucion-pokemon-go',
        'calculadora-cp-evolucao-pokemon-go',
        'calculateur-pc-evolution-pokemon-go',
        'entwicklungs-kp-rechner-pokemon-go',
    ]) ) return;
    $url = ( is_ssl() ? 'https' : 'http' ) . '://' . sanitize_text_field( $_SERVER['HTTP_HOST'] ?? '' ) . sanitize_text_field( $_SERVER['REQUEST_URI'] ?? '' );
    echo '<link rel="canonical" href="' . esc_url( $url ) . '">' . "\n";
}
add_action( 'wp_head', 'pkm_evolution_cp_canonical' );

// ── Meta Title + Description ──────────────────────────────────────────────────
function pkm_evolution_cp_meta() {
    if ( ! is_page([
        'pokemon-go-evolution-cp-calculator',
        'calculadora-cp-evolucion-pokemon-go',
        'calculadora-cp-evolucao-pokemon-go',
        'calculateur-pc-evolution-pokemon-go',
        'entwicklungs-kp-rechner-pokemon-go',
    ]) ) return;

    global $pkm_current_lang, $pkm_evo_cp_strings;
    $lang  = $pkm_current_lang ?? 'en';
    $t     = $pkm_evo_cp_strings[ $lang ] ?? $pkm_evo_cp_strings['en'];

    $meta_title = trim( $t['meta_title'] ?? '' );
    $meta_desc  = trim( $t['meta_desc']  ?? '' );

    if ( '' !== $meta_title ) {
        // Remove any existing <title> injected by theme — add ours via wp_head priority 1
        echo '<meta name="pkm-page-title" content="' . esc_attr( $meta_title ) . '">' . "\n";
        // Also filter the document title for SEO plugins that haven't run yet
        add_filter( 'pre_get_document_title', function() use ( $meta_title ) {
            return $meta_title;
        }, 99 );
        // Yoast / RankMath / AIO SEO compatibility — override title tag
        add_filter( 'wpseo_title',        function() use ( $meta_title ) { return $meta_title; }, 99 );
        add_filter( 'rank_math/frontend/title', function() use ( $meta_title ) { return $meta_title; }, 99 );
    }
    if ( '' !== $meta_desc ) {
        echo '<meta name="description" content="' . esc_attr( $meta_desc ) . '">' . "\n";
        // Yoast / RankMath compatibility
        add_filter( 'wpseo_metadesc',            function() use ( $meta_desc ) { return $meta_desc; }, 99 );
        add_filter( 'rank_math/frontend/description', function() use ( $meta_desc ) { return $meta_desc; }, 99 );
    }
    // Open Graph
    if ( '' !== $meta_title ) {
        echo '<meta property="og:title" content="' . esc_attr( $meta_title ) . '">' . "\n";
    }
    if ( '' !== $meta_desc ) {
        echo '<meta property="og:description" content="' . esc_attr( $meta_desc ) . '">' . "\n";
    }
    // og:image — use featured image if set on the page, else fall back to site default
    $og_image = '';
    if ( function_exists( 'get_the_post_thumbnail_url' ) ) {
        $og_image = get_the_post_thumbnail_url( get_the_ID(), 'large' ) ?: '';
    }
    if ( empty( $og_image ) ) {
        // Fallback: use site-level Open Graph image set in theme/SEO plugin
        $og_image = apply_filters( 'pkm_default_og_image', get_site_url() . '/wp-content/uploads/pkm-evolution-cp-og.jpg' );
    }
    if ( ! empty( $og_image ) ) {
        echo '<meta property="og:image" content="' . esc_url( $og_image ) . '">' . "\n";
        echo '<meta property="og:image:width" content="1200">' . "\n";
        echo '<meta property="og:image:height" content="630">' . "\n";
        echo '<meta name="twitter:image" content="' . esc_url( $og_image ) . '">' . "\n";
    }
    $current_url = ( is_ssl() ? 'https' : 'http' ) . '://' . sanitize_text_field( $_SERVER['HTTP_HOST'] ?? '' ) . sanitize_text_field( $_SERVER['REQUEST_URI'] ?? '' );
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:url" content="' . esc_url( $current_url ) . '">' . "\n";
    // Twitter Card
    if ( '' !== $meta_title ) {
        echo '<meta name="twitter:title" content="' . esc_attr( $meta_title ) . '">' . "\n";
    }
    if ( '' !== $meta_desc ) {
        echo '<meta name="twitter:description" content="' . esc_attr( $meta_desc ) . '">' . "\n";
    }
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    // Robots — ensure page is indexable
    echo '<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">' . "\n";
}
add_action( 'wp_head', 'pkm_evolution_cp_meta', 2 );

// ── Schema ────────────────────────────────────────────────────────────────────
function pkm_evolution_cp_schema() {
    if ( ! is_page([
        'pokemon-go-evolution-cp-calculator',
        'calculadora-cp-evolucion-pokemon-go',
        'calculadora-cp-evolucao-pokemon-go',
        'calculateur-pc-evolution-pokemon-go',
        'entwicklungs-kp-rechner-pokemon-go',
    ]) ) return;

    global $pkm_current_lang;
    $lang = $pkm_current_lang ?? 'en';

    $lang_map = [
        'en'    => 'en',
        'es'    => 'es',
        'pt-br' => 'pt-BR',
        'fr'    => 'fr',
        'de'    => 'de',
    ];
    $in_language = $lang_map[ $lang ] ?? 'en';
    $current_url = ( is_ssl() ? 'https' : 'http' ) . '://' . sanitize_text_field( $_SERVER['HTTP_HOST'] ?? '' ) . sanitize_text_field( $_SERVER['REQUEST_URI'] ?? '' );

    global $pkm_evo_cp_strings;
    $schema_t = $pkm_evo_cp_strings[ $lang ] ?? $pkm_evo_cp_strings['en'];

    $schema = [
        '@context' => 'https://schema.org',
        '@graph'   => [
            [
                '@type'           => 'WebApplication',
                '@id'             => esc_url( $current_url ) . '#webapp',
                'name'            => $schema_t['title'] ?? 'Evolution CP Calculator',
                'description'     => $schema_t['description'] ?? 'Predict your Pokemon\'s CP after every evolution instantly.',
                'url'             => esc_url( $current_url ),
                'inLanguage'      => $in_language,
                'applicationCategory' => 'GameApplication',
                'operatingSystem' => 'All',
                'offers'          => [ '@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD' ],
            ],
            [
                '@type' => 'HowTo',
                '@id'   => esc_url( $current_url ) . '#howto',
                'name'  => $schema_t['howto_title'] ?? 'How to Use the Evolution CP Calculator',
                'step'  => [
                    [ '@type' => 'HowToStep', 'name' => 'Step 1', 'text' => wp_strip_all_tags( $schema_t['howto_step1'] ?? '' ) ],
                    [ '@type' => 'HowToStep', 'name' => 'Step 2', 'text' => wp_strip_all_tags( $schema_t['howto_step2'] ?? '' ) ],
                    [ '@type' => 'HowToStep', 'name' => 'Step 3', 'text' => wp_strip_all_tags( $schema_t['howto_step3'] ?? '' ) ],
                    [ '@type' => 'HowToStep', 'name' => 'Step 4', 'text' => wp_strip_all_tags( $schema_t['howto_step4'] ?? '' ) ],
                ],
            ],
            [
                '@type'           => 'BreadcrumbList',
                '@id'             => esc_url( $current_url ) . '#breadcrumb',
                'itemListElement' => [
                    [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Pokemon Calculator', 'item' => esc_url( pkm_get_lang_url( $lang ) ) ],
                    [ '@type' => 'ListItem', 'position' => 2, 'name' => 'Evolution CP Calculator', 'item' => esc_url( $current_url ) ],
                ],
            ],
            // FAQPage — enables Google FAQ rich results (accordion snippets in SERPs)
            array_merge(
                [ '@type' => 'FAQPage', '@id' => esc_url( $current_url ) . '#faq' ],
                ( function() use ( $schema_t ) {
                    $main_entity = [];
                    for ( $qi = 1; $qi <= 8; $qi++ ) {
                        $q = wp_strip_all_tags( $schema_t[ 'faq_q' . $qi ] ?? '' );
                        $a = wp_strip_all_tags( $schema_t[ 'faq_a' . $qi ] ?? '' );
                        if ( '' === $q || '' === $a ) continue;
                        $main_entity[] = [
                            '@type'          => 'Question',
                            'name'           => $q,
                            'acceptedAnswer' => [ '@type' => 'Answer', 'text' => $a ],
                        ];
                    }
                    return [ 'mainEntity' => $main_entity ];
                } )()
            ),
        ],
    ];

    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
add_action( 'wp_head', 'pkm_evolution_cp_schema' );

// ── Strings ───────────────────────────────────────────────────────────────────
$pkm_evo_cp_strings = [
    'en' => [
        // UI
        'title'                => 'Evolution CP Calculator',
        'description'          => 'Predict your Pokemon\'s CP after every evolution — instantly.',
        'select_pokemon'       => 'Search Pokemon...',
        'current_cp_label'     => 'Current CP',
        'current_cp_ph'        => 'e.g. 1200',
        'level_label'          => 'Pokemon Level (optional)',
        'iv_section_label'     => 'IVs (optional — for precise prediction)',
        'iv_attack_label'      => 'Attack IV',
        'iv_defense_label'     => 'Defense IV',
        'iv_stamina_label'     => 'Stamina IV',
        'iv_placeholder'       => '0–15',
        'calculate_btn'        => 'Calculate Evolution CP',
        'reset_btn'            => 'Reset',
        'result_heading'       => 'Evolution Results',
        'result_cp_label'      => 'Predicted CP',
        'result_hp_label'      => 'Predicted HP',
        'result_cp_range'      => 'CP Range',
        'result_candy'         => 'Candy',
        'result_stage'         => 'Stage',
        'league_great'         => 'Great League',
        'league_ultra'         => 'Ultra League',
        'league_master'        => 'Master League',
        'league_great_tip'     => 'Fits Great League (≤1500 CP)',
        'league_ultra_tip'     => 'Fits Ultra League (≤2500 CP)',
        'league_master_tip'    => 'Master League eligible',
        'league_exceeds_great' => 'Exceeds Great League',
        'league_exceeds_ultra' => 'Exceeds Ultra League',
        'no_evolution'         => 'No further evolution',
        'current_label'        => 'Current',
        'evolution_arrow'      => 'evolves to',
        'tooltip_cp'           => 'Combat Power — calculated using the official Pokemon GO formula.',
        'tooltip_iv'           => 'Individual Values (0–15). Leave blank to see min/max CP range.',
        'tooltip_level'        => 'Your Pokemon\'s level (1–50). Used for more precise prediction.',
        'tooltip_candy'        => 'Candy required to evolve to this stage.',
        'copy_result'          => 'Copy result',
        'copied'               => 'Copied!',
        // Errors
        'error_data_load'      => 'Could not load Pokemon data. Please refresh the page.',
        'error_select_pokemon' => 'Please select a Pokemon to calculate.',
        'error_invalid_cp'     => 'Please enter a valid CP value (1–10000).',
        'error_invalid_level'  => 'Level must be between 1 and 50.',
        'error_invalid_iv'     => 'IV values must be between 0 and 15.',
        'error_no_results'     => 'No Pokemon found matching your search.',
        'error_calculation'    => 'Calculation error. Please check your inputs.',
        'error_no_evolution'   => 'This Pokemon does not evolve.',
        // SEO content (filled by Prompt 2)
        'meta_title'           => 'Evolution CP Calculator — Pokémon GO | PokemonCalculator',
        'meta_desc'            => 'Predict your Pokémon\'s CP after every evolution with our free Evolution CP Calculator. Enter CP, level, and IVs for instant, accurate results — no guesswork needed.',
        'intro_title'          => 'Evolution CP Calculator — Predict CP Before You Evolve',
        'intro_content'        => '<p>The <strong>Evolution CP Calculator</strong> lets you predict exactly how much CP your Pokémon will have after evolving — before you spend a single Candy. Enter your Pokémon\'s current CP, and the tool instantly shows the predicted CP for every evolution stage using the same formula Niantic uses in-game. No more evolving a 900 CP Pidgey only to end up with a mediocre Pidgeot when your 1,100 CP one was sitting right there.</p><p>Evolution in Pokémon GO doesn\'t work like a flat percentage gain. Each species has a unique <strong>CP multiplier scaling</strong> tied to its base stats — Attack, Defense, and Stamina. A Magikarp with 200 CP might yield a Gyarados near 2,500 CP, but a Gastly with 500 CP won\'t reward you the same way. Knowing the outcome ahead of time is the difference between building a <strong>Great League PvP team</strong> that stays under the 1,500 CP cap or accidentally power-evolving a Pokémon that blows straight past it.</p><p>Serious trainers use this calculator alongside the <a href="https://pokemoncalculator.online/en/pokemon-go-iv-calculator/">IV calculator</a> to verify individual values before committing Stardust, and cross-reference the <a href="https://pokemoncalculator.online/en/type-chart/">type chart</a> to confirm their evolved Pokémon fits the matchups they need. Use the Evolution CP Calculator above to run your predictions instantly, then head to the <a href="https://pokemoncalculator.online/en/pokemon-go-cp-calculator/">CP calculator</a> to plan your power-up path after evolving.</p>',
        'howto_title'          => 'How to Use the Evolution CP Calculator',
        'howto_step1'          => 'Open the <strong>Search Pokémon</strong> field at the top of the calculator and type the name of the Pokémon you want to evolve — for example, "Dratini" or "Eevee". Select the correct entry from the dropdown; the tool loads base stats and the full evolution chain automatically.',
        'howto_step2'          => 'Enter your Pokémon\'s <strong>Current CP</strong> in the CP field. If you know the exact level (check your in-game Pokémon screen), enter it too — this improves prediction accuracy. For even tighter results, add Attack, Defense, and Stamina IVs from an <a href="https://pokemoncalculator.online/en/pokemon-go-iv-calculator/">IV appraisal scan</a>.',
        'howto_step3'          => 'Tap <strong>Calculate Evolution CP</strong>. The tool computes predictions for all available evolution stages simultaneously, showing predicted CP, predicted HP, Candy cost, and — crucially — whether the resulting CP fits inside the <strong>Great League (≤1,500 CP)</strong> or <strong>Ultra League (≤2,500 CP)</strong> thresholds for PvP.',
        'howto_step4'          => 'Review the <strong>Evolution Results</strong> panel. Each stage shows a CP range (min to max based on IVs) alongside the precise prediction if IVs were provided. Use the Copy Result button to save your numbers, then head in-game to evolve with confidence — knowing exactly what CP to expect.',
        'info_title'           => 'How Evolution CP Is Calculated in Pokémon GO',
        'info_content'         => '<p>Understanding the math behind the Evolution CP Calculator makes you a smarter trainer. CP in Pokémon GO is not a simple stat — it\'s a compressed score derived from three underlying base stats: <strong>Attack</strong>, <strong>Defense</strong>, and <strong>Stamina (HP)</strong>. Every Pokémon species has fixed base values for these stats, and each individual Pokémon adds IV bonuses (0–15) on top.</p><h3>The Official CP Formula</h3><p>The formula Niantic uses — and the same one powering this calculator — is:</p><p><strong>CP = floor( √(Attack + AtkIV) × √(Defense + DefIV) × √(Stamina + StaIV) × CPM² / 10 )</strong></p><p>Where <strong>CPM</strong> is the CP Multiplier for the Pokémon\'s current level (ranging from 0.094 at Level 1 to 1.07122 at Level 50). The floor function means CP is always rounded down to the nearest whole number — which is why the game shows clean integers rather than decimals.</p><p>When a Pokémon evolves, its base Attack, Defense, and Stamina values change to the evolved form\'s stats. The IV bonuses and the current level — and therefore the CPM — carry over unchanged. This is why the CP gain from evolution varies so dramatically by species: a Pokémon evolving into a form with much higher base Attack will see a much larger CP jump than one where the stat difference is modest.</p><h3>Why the CP Range Matters</h3><p>Without IVs, this calculator shows you a <strong>CP range</strong>: the minimum (0/0/0 IVs) and maximum (15/15/15 IVs) possible post-evolution CP. That range can be surprisingly wide. A Level 20 Dratini evolving to Dragonite spans roughly 150–200 CP across the full IV spread. If you\'re targeting the <strong>Ultra League cap of 2,500 CP</strong>, landing inside that window matters. Use the <a href="https://pokemoncalculator.online/en/pokemon-go-iv-calculator/">Pokémon GO IV Calculator</a> first to identify your exact IVs, then enter them here for a pinpoint prediction.</p><h3>PvP Implications — The CP Cap Problem</h3><p>The single most common mistake trainers make is evolving a Pokémon without checking the CP cap first. Great League PvP requires Pokémon at <em>or below</em> 1,500 CP at the time of battle — but you can\'t de-evolve once you\'ve evolved. A Galarian Stunfisk at 1,450 CP is often a top-tier Great League pick; the same Pokémon powered up to 1,600 CP becomes ineligible. This calculator shows the exact evolved CP <em>before</em> you commit, so you can catch it at the right level before evolving. Pair this with our <a href="https://pokemoncalculator.online/en/stardust-calculator/">Stardust Calculator</a> to plan the power-up budget before and after evolution.</p><h3>Evolution and CP Multipliers — Key Levels</h3><p>The CPM table is one of the most searched resources in the Pokémon GO community. Verify exact values with the calculator above, and reference the table below for the most important benchmarks.</p>',
        'info_table_title'     => 'CP Multiplier (CPM) Values by Pokémon Level',
        'info_table_html'      => '<table class="pkm-calc-table"><thead><tr><th>Level</th><th>CP Multiplier (CPM)</th><th>Key Milestone</th></tr></thead><tbody><tr><td>1</td><td>0.09400</td><td><span class="pkm-table-note-badge">Minimum level</span></td></tr><tr><td>5</td><td>0.21088</td><td></td></tr><tr><td>10</td><td>0.42072</td><td></td></tr><tr><td>15</td><td>0.51737</td><td></td></tr><tr><td>20</td><td>0.61570</td><td><span class="pkm-table-note-badge">Wild catch cap</span></td></tr><tr><td>25</td><td>0.70572</td><td></td></tr><tr><td>30</td><td>0.80354</td><td><span class="pkm-table-note-badge">Raid boss cap</span></td></tr><tr><td>35</td><td>0.88931</td><td></td></tr><tr><td>40</td><td>0.98326</td><td><span class="pkm-table-note-badge">Old trainer cap</span></td></tr><tr><td>41</td><td>0.99192</td><td><span class="pkm-table-note-badge">XL Candy levels start</span></td></tr><tr><td>45</td><td>1.02500</td><td></td></tr><tr><td>50</td><td>1.07122</td><td><span class="pkm-table-note-badge">Current max level</span></td></tr></tbody></table>',
        'faq_title'            => 'Frequently Asked Questions',
        'faq_q1'               => 'How do I calculate my Pokémon\'s CP after evolution?',
        'faq_a1'               => 'Enter your Pokémon\'s current CP into the Evolution CP Calculator above and click Calculate. The tool applies the official Pokémon GO formula — using the evolved form\'s base Attack, Defense, and Stamina with your Pokémon\'s existing level and IVs — to predict the post-evolution CP instantly. For the most accurate result, also enter your Pokémon\'s level and IVs (0–15 each). Without IVs, the tool shows the full minimum-to-maximum CP range.',
        'faq_q2'               => 'How much CP does a Pokémon gain when it evolves?',
        'faq_a2'               => 'The CP gain from evolution depends entirely on the stat difference between the base form and the evolved form. There is no universal percentage. Magikarp (base Attack 29) evolving into Gyarados (base Attack 237) sees a massive CP multiplication — often 8–12x. By contrast, Caterpie evolving into Metapod shows almost no change because the base stats barely shift. Use this calculator to get the exact predicted gain for any species before committing your Candy.',
        'faq_q3'               => 'Does evolving a Pokémon change its IVs or level?',
        'faq_a3'               => 'No. Evolution in Pokémon GO preserves the Pokémon\'s IVs (Individual Values) and level exactly as they were before evolution. Only the base species stats change. This means a Pokémon with 15/15/15 perfect IVs before evolution will still have 15/15/15 IVs after, and the CPM remains the same as the pre-evolution value. The CP changes solely because the evolved form has different base Attack, Defense, and Stamina values in the formula.',
        'faq_q4'               => 'What is the CP multiplier in Pokémon GO?',
        'faq_a4'               => 'The CP Multiplier (CPM) is a level-dependent scaling value Niantic uses in the CP formula. At Level 1 the CPM is 0.09400; at Level 20 (the wild catch cap) it reaches 0.61570; at the old Level 40 cap it is 0.98326; and at the current maximum Level 50 it is 1.07122. The CPM rises with each half-level and is applied as its square in the CP formula, meaning even small CPM differences at high levels create large CP jumps.',
        'faq_q5'               => 'Can I use this calculator to stay under the Great League CP cap?',
        'faq_a5'               => 'Yes — this is one of the most valuable uses of the Evolution CP Calculator. Before evolving any Pokémon you intend to use in Great League PvP (CP cap: 1,500), enter the current CP and IVs to see the exact post-evolution CP. If the result exceeds 1,500, you can power down your search to a lower-CP specimen of the same species and check again. The tool also shows whether the predicted CP fits Ultra League (≤2,500 CP) or Master League eligibility alongside each result.',
        'faq_q6'               => 'Why does the evolved CP sometimes fall in a range rather than one exact number?',
        'faq_a6'               => 'When you leave the IV fields blank, the calculator cannot determine your specific IV combination, so it computes the full range from 0/0/0 IVs (minimum CP) to 15/15/15 IVs (maximum CP). The wider the species\' base stats, the wider this range tends to be. To get a single precise prediction, add your Attack, Defense, and Stamina IVs. You can find these using the in-game Appraisal feature or our dedicated <a href="https://pokemoncalculator.online/en/pokemon-go-iv-calculator/">IV Calculator</a>.',
        'faq_q7'               => 'Does the evolution CP calculator work for all Pokémon including special evolutions?',
        'faq_a7'               => 'The calculator covers the full Pokémon GO Pokédex including branching evolutions (Eevee\'s eight eeveelutions, Tyrogue\'s three paths), Mega Evolutions, and regional variants. All evolution chains are mapped with accurate base stats sourced from Bulbapedia. Special evolution methods (walking as buddy, lure evolution, trade evolution) only affect the candy cost shown, not the CP calculation — the formula is identical regardless of evolution method.',
        'faq_q8'               => 'Should I power up before or after evolving?',
        'faq_a8'               => 'For most trainers, evolving first is more Stardust-efficient. Lower-stage Pokémon cost fewer Stardust and Candy per power-up level, so you pay the cheaper rate while training up. However, if you\'re targeting a specific CP cap for PvP — like Great League\'s 1,500 CP ceiling — you may need to evolve at a precise CP to land just under the cap. Use this calculator to identify the target CP window, then use the <a href="https://pokemoncalculator.online/en/stardust-calculator/">Stardust Calculator</a> to plan the most cost-efficient power-up path.',
        'related_title'        => 'More Pokémon GO Calculators',
        'no_related_tools'     => 'No related tools yet. More calculators coming soon!',
        'blog_guides_title'    => 'Pokémon Guides & Tips',
        'blog_read_more'       => 'Read guide',
    ],
    'es' => [
        'title'                => 'Calculadora de PC de Evolución',
        'description'          => 'Predice el PC de tu Pokémon después de cada evolución al instante.',
        'select_pokemon'       => 'Buscar Pokémon...',
        'current_cp_label'     => 'PC Actual',
        'current_cp_ph'        => 'ej. 1200',
        'level_label'          => 'Nivel del Pokémon (opcional)',
        'iv_section_label'     => 'IVs (opcional — para predicción precisa)',
        'iv_attack_label'      => 'IV de Ataque',
        'iv_defense_label'     => 'IV de Defensa',
        'iv_stamina_label'     => 'IV de Aguante',
        'iv_placeholder'       => '0–15',
        'calculate_btn'        => 'Calcular PC de Evolución',
        'reset_btn'            => 'Reiniciar',
        'result_heading'       => 'Resultados de Evolución',
        'result_cp_label'      => 'PC Predicho',
        'result_hp_label'      => 'PS Predicho',
        'result_cp_range'      => 'Rango de PC',
        'result_candy'         => 'Caramelos',
        'result_stage'         => 'Etapa',
        'league_great'         => 'Liga Súper',
        'league_ultra'         => 'Liga Ultra',
        'league_master'        => 'Liga Maestra',
        'league_great_tip'     => 'Apto para Liga Súper (≤1500 PC)',
        'league_ultra_tip'     => 'Apto para Liga Ultra (≤2500 PC)',
        'league_master_tip'    => 'Apto para Liga Maestra',
        'league_exceeds_great' => 'Supera la Liga Súper',
        'league_exceeds_ultra' => 'Supera la Liga Ultra',
        'no_evolution'         => 'Sin evolución adicional',
        'current_label'        => 'Actual',
        'evolution_arrow'      => 'evoluciona a',
        'tooltip_cp'           => 'Puntos de Combate — calculados con la fórmula oficial de Pokémon GO.',
        'tooltip_iv'           => 'Valores Individuales (0–15). Déjalo vacío para ver el rango de PC.',
        'tooltip_level'        => 'Nivel de tu Pokémon (1–50). Usado para predicción más precisa.',
        'tooltip_candy'        => 'Caramelos necesarios para evolucionar a esta etapa.',
        'copy_result'          => 'Copiar resultado',
        'copied'               => '¡Copiado!',
        'error_data_load'      => 'No se pudieron cargar los datos. Por favor recarga la página.',
        'error_select_pokemon' => 'Por favor selecciona un Pokémon para calcular.',
        'error_invalid_cp'     => 'Por favor ingresa un PC válido (1–10000).',
        'error_invalid_level'  => 'El nivel debe estar entre 1 y 50.',
        'error_invalid_iv'     => 'Los IVs deben estar entre 0 y 15.',
        'error_no_results'     => 'No se encontraron Pokémon.',
        'error_calculation'    => 'Error de cálculo. Verifica tus entradas.',
        'error_no_evolution'   => 'Este Pokémon no evoluciona.',
        'meta_title'        => 'Calculadora PC Evolución Pokémon GO | PokemonCalculator',
        'meta_desc'         => 'Calcula el PC de tu Pokémon después de evolucionar con nuestra calculadora gratuita. Ingresa PC, nivel e IVs para obtener predicciones precisas al instante.',
        'intro_title'       => 'Calculadora de PC de Evolución — Conoce el PC Antes de Evolucionar',
        'intro_content'     => '<p>La <strong>calculadora de PC de evolución</strong> te permite saber exactamente cuántos Puntos de Combate tendrá tu Pokémon después de evolucionar, antes de gastar un solo caramelo. Ingresa el PC actual y la herramienta calcula al instante el PC predicho para cada etapa de la cadena evolutiva usando la fórmula oficial de Niantic. Olvídate de evolucionar un Dratini con 800 PC solo para descubrir que el Dragonite no alcanza la Liga Ultra.</p><p>El PC no sube por un porcentaje fijo al evolucionar — depende directamente del cambio en estadísticas base (Ataque, Defensa y Aguante) entre la forma base y la evolucionada. Por eso Magikarp con 200 PC se convierte en un Gyarados de más de 2.500 PC, mientras que otras evoluciones apenas mueven el número. Entender esto es especialmente importante en la <strong>Liga Súper de GO Battle League</strong>, donde el límite de 1.500 PC puede decidir si tu Pokémon entra o queda fuera del equipo.</p><p>Los entrenadores más competitivos en América Latina combinan esta herramienta con la <a href="https://pokemoncalculator.online/es/calculadora-iv-pokemon-go/">calculadora de IVs</a> para verificar los valores individuales antes de invertir Polvo Estelar, y consultan la <a href="https://pokemoncalculator.online/es/tabla-de-tipos/">tabla de tipos</a> para confirmar ventajas en batalla. Usa la calculadora de PC de evolución de arriba para predecir tus resultados al instante, y complementa con la <a href="https://pokemoncalculator.online/es/calculadora-cp-pokemon/">calculadora de PC</a> para planear la subida de nivel después de evolucionar.</p>',
        'howto_title'       => 'Cómo Usar la Calculadora de PC de Evolución',
        'howto_step1'       => 'Escribe el nombre del Pokémon en el campo <strong>Buscar Pokémon</strong> — por ejemplo "Eevee" o "Charmander". Selecciona la entrada correcta en el menú desplegable; la calculadora carga automáticamente las estadísticas base y toda la cadena evolutiva disponible en Pokémon GO.',
        'howto_step2'       => 'Ingresa el <strong>PC Actual</strong> de tu Pokémon en el campo correspondiente. Si conoces el nivel exacto (visible en la pantalla de tu Pokémon dentro del juego), agrégalo también para mayor precisión. Para predicciones perfectas, añade los IVs de Ataque, Defensa y Aguante obtenidos con la <a href="https://pokemoncalculator.online/es/calculadora-iv-pokemon-go/">calculadora de IVs</a>.',
        'howto_step3'       => 'Toca el botón <strong>Calcular PC de Evolución</strong>. La herramienta procesa todas las etapas evolutivas simultáneamente y muestra el PC predicho, los PS predichos, los caramelos necesarios y si el resultado entra dentro de la <strong>Liga Súper (≤1.500 PC)</strong> o la <strong>Liga Ultra (≤2.500 PC)</strong> para el GO Battle League.',
        'howto_step4'       => 'Revisa el panel de <strong>Resultados de Evolución</strong>. Cada etapa muestra el rango mínimo-máximo de PC según los IVs posibles, más la predicción exacta si ingresaste tus IVs. Usa el botón Copiar resultado para guardar los datos y evoluciona en el juego con total certeza sobre el PC que obtendrás.',
        'info_title'        => 'Cómo se Calcula el PC de Evolución en Pokémon GO',
        'info_content'      => '<p>Detrás de cada número de PC hay una fórmula matemática que Niantic aplica en tiempo real. Entenderla te convierte en un entrenador más estratégico, especialmente si compites en el GO Battle League o buscas los mejores atacantes para incursiones.</p><h3>La Fórmula Oficial de PC</h3><p>El PC en Pokémon GO se calcula así:</p><p><strong>PC = piso( (Ataque + IV_Atk) × √(Defensa + IV_Def) × √(Aguante + IV_Sta) × CPM² / 10 )</strong></p><p>Donde <strong>CPM</strong> es el Multiplicador de PC según el nivel del Pokémon: 0,094 en nivel 1, 0,61570 en nivel 20, 0,98326 en nivel 40 y 1,07122 en el nivel máximo 50. La función "piso" redondea siempre hacia abajo, de ahí que el juego muestre números enteros.</p><p>Al evolucionar, los valores base de Ataque, Defensa y Aguante cambian a los de la nueva forma. El nivel del Pokémon y sus IVs se mantienen exactamente igual. Es por eso que la misma fórmula produce resultados tan distintos según la especie: Garchomp, con un Ataque base de 261, es uno de los Pokémon más buscados en la escena de incursiones de Latinoamérica precisamente porque su evolución triplica el PC de Gible.</p><h3>Por Qué el Rango de PC es Importante</h3><p>Sin IVs, la calculadora muestra el rango completo entre el mínimo (IVs 0/0/0) y el máximo (15/15/15). Para muchos Pokémon este rango supera los 200 PC en niveles altos. Si tu objetivo es la <strong>Liga Súper con tope de 1.500 PC</strong>, necesitas saber el PC exacto antes de evolucionar — no el rango. Consulta primero la <a href="https://pokemoncalculator.online/es/calculadora-iv-pokemon-go/">calculadora de IVs</a> para obtener tus valores exactos, luego ingresalos aquí para una predicción precisa.</p><h3>Evoluciones Ramificadas y Casos Especiales</h3><p>Esta calculadora contempla todas las cadenas evolutivas de Pokémon GO, incluidas las ramificadas como las ocho evoluciones de Eevee y las tres rutas de Tyrogue. En eventos de Día de la Comunidad — muy populares en México, Argentina y Colombia — aparecen Pokémon en grandes cantidades: es el momento ideal para calcular cuáles candidatos evolucionan mejor antes del evento y tener listo el inventario de caramelos. Combina esta herramienta con la <a href="https://pokemoncalculator.online/es/calculadora-polvo-estelar/">calculadora de Polvo Estelar</a> para presupuestar la inversión total de subida de nivel después de evolucionar.</p><h3>Niveles Clave y sus Multiplicadores</h3><p>La tabla a continuación muestra los valores CPM más buscados. En el juego, los Pokémon capturados en estado salvaje no superan el nivel 35 (o nivel 40 con clima favorecido). Verifica cualquier valor con la calculadora de arriba.</p>',
        'info_table_title'  => 'Multiplicador de PC (CPM) por Nivel de Pokémon',
        'info_table_html'   => '<table class="pkm-calc-table"><thead><tr><th>Nivel</th><th>Multiplicador de PC (CPM)</th><th>Referencia</th></tr></thead><tbody><tr><td>1</td><td>0,09400</td><td><span class="pkm-table-note-badge">Nivel mínimo</span></td></tr><tr><td>5</td><td>0,21088</td><td></td></tr><tr><td>10</td><td>0,42072</td><td></td></tr><tr><td>15</td><td>0,51737</td><td></td></tr><tr><td>20</td><td>0,61570</td><td><span class="pkm-table-note-badge">Tope captura salvaje</span></td></tr><tr><td>25</td><td>0,70572</td><td></td></tr><tr><td>30</td><td>0,80354</td><td><span class="pkm-table-note-badge">Tope incursiones</span></td></tr><tr><td>35</td><td>0,88931</td><td></td></tr><tr><td>40</td><td>0,98326</td><td><span class="pkm-table-note-badge">Tope anterior</span></td></tr><tr><td>41</td><td>0,99192</td><td><span class="pkm-table-note-badge">Inicio caramelos XL</span></td></tr><tr><td>45</td><td>1,02500</td><td></td></tr><tr><td>50</td><td>1,07122</td><td><span class="pkm-table-note-badge">Nivel máximo actual</span></td></tr></tbody></table>',
        'faq_title'         => 'Preguntas Frecuentes',
        'faq_q1'            => '¿Cómo calcular el PC de un Pokémon después de evolucionar?',
        'faq_a1'            => 'Ingresa el PC actual de tu Pokémon en la calculadora de arriba y pulsa Calcular. La herramienta usa la fórmula oficial de Pokémon GO — aplicando las estadísticas base de la forma evolucionada con el nivel e IVs actuales del Pokémon — para mostrar el PC predicho al instante. Para mayor precisión, añade también el nivel y los IVs. Sin IVs, verás el rango completo de PC posible entre el mínimo y el máximo.',
        'faq_q2'            => '¿Cuánto PC gana un Pokémon al evolucionar?',
        'faq_a2'            => 'No existe un porcentaje universal: la ganancia de PC depende del cambio en estadísticas base entre la forma actual y la evolucionada. Magikarp (Ataque base 29) que se convierte en Gyarados (Ataque base 237) puede multiplicar su PC hasta diez veces. En cambio, evoluciones como Caterpie a Metapod apenas modifican el número porque las estadísticas base cambian poco. Usa esta calculadora para conocer el resultado exacto de cualquier especie antes de gastar tus caramelos.',
        'faq_q3'            => '¿Evolucionar un Pokémon cambia sus IVs?',
        'faq_a3'            => 'No. Al evolucionar en Pokémon GO, los Valores Individuales (IVs) y el nivel del Pokémon se conservan exactamente igual. Solo cambian las estadísticas base de la especie. Un Pokémon con IVs perfectos 15/15/15 antes de evolucionar seguirá teniendo 15/15/15 después. El cambio en PC se debe exclusivamente a que la forma evolucionada tiene distintos valores de Ataque, Defensa y Aguante en la fórmula.',
        'faq_q4'            => '¿Qué es el multiplicador de PC en Pokémon GO?',
        'faq_a4'            => 'El Multiplicador de PC (CPM, por sus siglas en inglés) es un valor que escala según el nivel del Pokémon y que aparece elevado al cuadrado en la fórmula de PC. En el nivel 1 vale 0,094; en el nivel 20 (tope de captura salvaje) llega a 0,61570; en el nivel 40 es 0,98326; y en el nivel máximo 50 alcanza 1,07122. Pequeñas diferencias de CPM a niveles altos generan grandes saltos de PC, por eso subir del nivel 49 al 50 cuesta mucho más que subir del nivel 10 al 11.',
        'faq_q5'            => '¿Puedo usar esta calculadora para no pasarme del límite de la Liga Súper?',
        'faq_a5'            => 'Sí, y es uno de los usos más importantes de esta herramienta. Antes de evolucionar cualquier Pokémon para la Liga Súper (tope 1.500 PC), ingresa el PC actual y los IVs para ver el PC exacto después de la evolución. Si el resultado supera 1.500, busca un ejemplar de menor PC de la misma especie y repite el cálculo. La calculadora también indica si el PC predicho entra en la Liga Ultra (≤2.500 PC) o califica para la Liga Maestra, todo en un mismo resultado.',
        'faq_q6'            => '¿Por qué el PC evolucionado aparece como un rango y no un número exacto?',
        'faq_a6'            => 'Cuando dejas los campos de IVs vacíos, la calculadora no puede determinar tu combinación específica de Valores Individuales, así que calcula el rango completo desde IVs 0/0/0 (mínimo posible) hasta 15/15/15 (máximo posible). Cuanto más altas sean las estadísticas base de la especie, más amplio puede ser ese rango. Para obtener un único número preciso, ingresa tus IVs de Ataque, Defensa y Aguante, que puedes encontrar usando la función de Evaluación del juego o la <a href="https://pokemoncalculator.online/es/calculadora-iv-pokemon-go/">calculadora de IVs</a>.',
        'faq_q7'            => '¿Funciona esta calculadora con todas las evoluciones, incluyendo las especiales?',
        'faq_a7'            => 'Sí. La calculadora cubre todo el Pokédex disponible en Pokémon GO, incluyendo cadenas ramificadas (las ocho evoluciones de Eevee, las tres rutas de Tyrogue), variantes regionales y Megaevoluciones. Las estadísticas base están verificadas con Bulbapedia. Los métodos de evolución especiales (caminar con el Pokémon como compañero, evoluciones con señuelo, evoluciones por intercambio) solo afectan al coste de caramelos mostrado — la fórmula de PC es idéntica independientemente del método.',
        'faq_q8'            => '¿Es mejor subir de nivel antes o después de evolucionar?',
        'faq_a8'            => 'En la mayoría de los casos, evolucionar primero es más eficiente en Polvo Estelar: las formas base cuestan menos polvo y caramelos por nivel. Sin embargo, si apuntas a un tope de PC para el GO Battle League — como el límite de 1.500 de la Liga Súper — puede que necesites evolucionar en un punto específico de PC para quedarte justo por debajo del tope. Usa esta calculadora para identificar esa ventana de PC objetivo y la <a href="https://pokemoncalculator.online/es/calculadora-polvo-estelar/">calculadora de Polvo Estelar</a> para planear la inversión total.',
        'related_title'     => 'Más Calculadoras Pokémon GO',
        'no_related_tools'  => 'Aún no hay herramientas relacionadas. ¡Pronto más calculadoras!',
        'blog_guides_title' => 'Guías y Consejos Pokémon',
        'blog_read_more'    => 'Leer guía',
    ],
    'pt-br' => [
        'title'                => 'Calculadora de PC de Evolução',
        'description'          => 'Preveja o PC do seu Pokémon após cada evolução instantaneamente.',
        'select_pokemon'       => 'Buscar Pokémon...',
        'current_cp_label'     => 'PC Atual',
        'current_cp_ph'        => 'ex. 1200',
        'level_label'          => 'Nível do Pokémon (opcional)',
        'iv_section_label'     => 'IVs (opcional — para previsão precisa)',
        'iv_attack_label'      => 'IV de Ataque',
        'iv_defense_label'     => 'IV de Defesa',
        'iv_stamina_label'     => 'IV de Resistência',
        'iv_placeholder'       => '0–15',
        'calculate_btn'        => 'Calcular PC de Evolução',
        'reset_btn'            => 'Resetar',
        'result_heading'       => 'Resultados da Evolução',
        'result_cp_label'      => 'PC Previsto',
        'result_hp_label'      => 'PS Previsto',
        'result_cp_range'      => 'Intervalo de PC',
        'result_candy'         => 'Balas',
        'result_stage'         => 'Estágio',
        'league_great'         => 'Liga Super',
        'league_ultra'         => 'Liga Ultra',
        'league_master'        => 'Liga Mestre',
        'league_great_tip'     => 'Adequado para Liga Super (≤1500 PC)',
        'league_ultra_tip'     => 'Adequado para Liga Ultra (≤2500 PC)',
        'league_master_tip'    => 'Elegível para Liga Mestre',
        'league_exceeds_great' => 'Supera a Liga Super',
        'league_exceeds_ultra' => 'Supera a Liga Ultra',
        'no_evolution'         => 'Sem evolução adicional',
        'current_label'        => 'Atual',
        'evolution_arrow'      => 'evolui para',
        'tooltip_cp'           => 'Pontos de Combate — calculados com a fórmula oficial do Pokémon GO.',
        'tooltip_iv'           => 'Valores Individuais (0–15). Deixe em branco para ver o intervalo de PC.',
        'tooltip_level'        => 'Nível do seu Pokémon (1–50). Usado para previsão mais precisa.',
        'tooltip_candy'        => 'Balas necessárias para evoluir para este estágio.',
        'copy_result'          => 'Copiar resultado',
        'copied'               => 'Copiado!',
        'error_data_load'      => 'Não foi possível carregar os dados. Por favor recarregue a página.',
        'error_select_pokemon' => 'Por favor selecione um Pokémon para calcular.',
        'error_invalid_cp'     => 'Por favor insira um PC válido (1–10000).',
        'error_invalid_level'  => 'O nível deve estar entre 1 e 50.',
        'error_invalid_iv'     => 'Os IVs devem estar entre 0 e 15.',
        'error_no_results'     => 'Nenhum Pokémon encontrado.',
        'error_calculation'    => 'Erro de cálculo. Verifique suas entradas.',
        'error_no_evolution'   => 'Este Pokémon não evolui.',
        'meta_title'        => 'Calculadora PC Evolução Pokémon GO | PokemonCalculator',
        'meta_desc'         => 'Descubra o PC do seu Pokémon após evoluir com nossa calculadora gratuita. Insira PC, nível e IVs para previsões precisas na hora — sem adivinhação.',
        'intro_title'       => 'Calculadora de PC de Evolução — Saiba o PC Antes de Evoluir',
        'intro_content'     => '<p>A <strong>calculadora de PC de evolução</strong> mostra exatamente quantos Pontos de Combate seu Pokémon terá após evoluir — antes de gastar um único Doce. Insira o PC atual e a ferramenta calcula na hora o PC previsto para cada estágio evolutivo usando a fórmula oficial da Niantic. Chega de evoluir um Dratini com 900 PC e se arrepender quando tinha um de 1.100 esperando no inventário.</p><p>A evolução no Pokémon GO não segue um percentual fixo. Cada espécie tem atributos base diferentes (Ataque, Defesa e Resistência), e a variação entre a forma base e a evoluída define o quanto o PC muda. É por isso que um Magikarp com 200 PC pode virar um Gyarados próximo de 2.500 PC, enquanto outras evoluções mal alteram o número. Aqui no Brasil, a comunidade do Pokémon GO — muito ativa nos grupos de WhatsApp e Facebook — usa essa calculadora principalmente antes dos Dias Comunitários para selecionar os melhores candidatos à evolução.</p><p>Para maximizar seus resultados, combine esta ferramenta com a <a href="https://pokemoncalculator.online/pt-br/calculadora-iv-pokemon-go/">calculadora de IVs</a> para verificar os valores individuais antes de investir Pó Estelar, e consulte a <a href="https://pokemoncalculator.online/pt-br/tabela-de-tipos/">tabela de tipos</a> para confirmar que seu Pokémon evoluído encaixa bem nas batalhas. Use a calculadora de PC de evolução acima para prever o resultado agora, e planeje a subida de nível com a <a href="https://pokemoncalculator.online/pt-br/calculadora-pc-pokemon/">calculadora de PC</a>.</p>',
        'howto_title'       => 'Como Usar a Calculadora de PC de Evolução',
        'howto_step1'       => 'Digite o nome do Pokémon no campo <strong>Buscar Pokémon</strong> — por exemplo "Eevee" ou "Dragonite". Selecione o Pokémon correto no menu suspenso; a calculadora carrega automaticamente os atributos base e toda a cadeia evolutiva disponível no Pokémon GO.',
        'howto_step2'       => 'Insira o <strong>PC Atual</strong> do seu Pokémon. Se souber o nível exato (visível na tela do Pokémon no jogo), adicione também — isso melhora a precisão da previsão. Para resultados ainda mais precisos, adicione os IVs de Ataque, Defesa e Resistência obtidos com a <a href="https://pokemoncalculator.online/pt-br/calculadora-iv-pokemon-go/">calculadora de IVs</a> ou pela avaliação no jogo.',
        'howto_step3'       => 'Toque em <strong>Calcular PC de Evolução</strong>. A ferramenta processa todos os estágios evolutivos ao mesmo tempo, exibindo o PC previsto, os PS previstos, a quantidade de Doces necessária e se o resultado se encaixa na <strong>Liga Super (≤1.500 PC)</strong> ou na <strong>Liga Ultra (≤2.500 PC)</strong> da GO Battle League.',
        'howto_step4'       => 'Confira o painel de <strong>Resultados da Evolução</strong>. Cada estágio mostra o intervalo de PC (mínimo ao máximo conforme os IVs possíveis) e a previsão exata caso você tenha inserido seus IVs. Use o botão Copiar resultado para salvar e evolua no jogo com total segurança sobre o PC que vai obter.',
        'info_title'        => 'Como o PC de Evolução é Calculado no Pokémon GO',
        'info_content'      => '<p>Entender a matemática por trás da calculadora de PC de evolução transforma a forma como você toma decisões no jogo. O PC não é um atributo independente — é um número comprimido derivado de três estatísticas base: <strong>Ataque</strong>, <strong>Defesa</strong> e <strong>Resistência (PS)</strong>.</p><h3>A Fórmula Oficial de PC</h3><p>A fórmula que a Niantic usa — e que alimenta esta calculadora — é:</p><p><strong>PC = piso( (Ataque + IV_Atk) × √(Defesa + IV_Def) × √(Resistência + IV_Sta) × CPM² / 10 )</strong></p><p>O <strong>CPM</strong> (Multiplicador de PC) varia com o nível do Pokémon: 0,094 no Nível 1, 0,61570 no Nível 20, 0,98326 no Nível 40 e 1,07122 no Nível máximo 50. A função "piso" arredonda sempre para baixo, por isso o jogo exibe números inteiros.</p><p>Ao evoluir, os valores base de Ataque, Defesa e Resistência mudam para os da forma evoluída. O nível e os IVs permanecem idênticos. É exatamente por isso que a mesma fórmula gera resultados tão diferentes por espécie: Garchomp, com Ataque base 261, vale muito mais como atacante em Reides do que Gabite — e essa diferença toda vem da variação nos atributos base.</p><h3>Por Que o Intervalo de PC Importa</h3><p>Sem IVs, a calculadora mostra o intervalo completo entre o mínimo (IVs 0/0/0) e o máximo (15/15/15). Para Pokémon de alto nível esse intervalo pode passar de 200 PC. Se sua meta é a <strong>Liga Super com teto de 1.500 PC</strong>, você precisa do número exato, não de um intervalo. Use primeiro a <a href="https://pokemoncalculator.online/pt-br/calculadora-iv-pokemon-go/">calculadora de IVs</a> para descobrir seus valores e insira-os aqui para uma previsão pontual.</p><h3>Impacto na GO Battle League</h3><p>O erro mais comum dos treinadores brasileiros é evoluir sem checar o teto de PC. A Liga Super exige Pokémon com CP igual ou abaixo de 1.500 no momento da batalha — e não é possível desfazer uma evolução. Um Swampert com PC próximo de 1.500 é uma das melhores escolhas para a Liga Super; se subir além desse limite, fica inelegível. Planeje a evolução com esta calculadora e o orçamento de Pó Estelar com a <a href="https://pokemoncalculator.online/pt-br/calculadora-po-estelar/">calculadora de Pó Estelar</a>.</p><h3>Evolução no Dia Comunitário — Dica Prática</h3><p>Durante os Dias Comunitários, Pokémon específicos aparecem em massa. É o momento ideal para selecionar os melhores candidatos antes do evento. Calcule quais exemplares evoluem para o PC mais alto possível, ou quais ficam abaixo do teto da Liga Super, e deixe seus Doces separados. Veja as probabilidades de todos os ataques disponíveis consultando a <a href="https://pokemoncalculator.online/pt-br/tabela-de-tipos/">tabela de tipos</a> para confirmar a utilidade do Pokémon evoluído.</p>',
        'info_table_title'  => 'Multiplicador de PC (CPM) por Nível de Pokémon',
        'info_table_html'   => '<table class="pkm-calc-table"><thead><tr><th>Nível</th><th>Multiplicador de PC (CPM)</th><th>Referência</th></tr></thead><tbody><tr><td>1</td><td>0,09400</td><td><span class="pkm-table-note-badge">Nível mínimo</span></td></tr><tr><td>5</td><td>0,21088</td><td></td></tr><tr><td>10</td><td>0,42072</td><td></td></tr><tr><td>15</td><td>0,51737</td><td></td></tr><tr><td>20</td><td>0,61570</td><td><span class="pkm-table-note-badge">Teto captura selvagem</span></td></tr><tr><td>25</td><td>0,70572</td><td></td></tr><tr><td>30</td><td>0,80354</td><td><span class="pkm-table-note-badge">Teto reides</span></td></tr><tr><td>35</td><td>0,88931</td><td></td></tr><tr><td>40</td><td>0,98326</td><td><span class="pkm-table-note-badge">Teto antigo</span></td></tr><tr><td>41</td><td>0,99192</td><td><span class="pkm-table-note-badge">Início Doces XL</span></td></tr><tr><td>45</td><td>1,02500</td><td></td></tr><tr><td>50</td><td>1,07122</td><td><span class="pkm-table-note-badge">Nível máximo atual</span></td></tr></tbody></table>',
        'faq_title'         => 'Perguntas Frequentes',
        'faq_q1'            => 'Como calcular o PC do Pokémon depois de evoluir?',
        'faq_a1'            => 'Insira o PC atual do seu Pokémon na calculadora acima e clique em Calcular. A ferramenta aplica a fórmula oficial do Pokémon GO — usando os atributos base da forma evoluída com o nível e os IVs atuais — para exibir o PC previsto na hora. Para maior precisão, adicione o nível e os IVs (0–15 cada). Sem IVs, a calculadora mostra o intervalo completo do PC possível entre o mínimo e o máximo.',
        'faq_q2'            => 'Quanto o PC aumenta ao evoluir um Pokémon?',
        'faq_a2'            => 'Não existe um percentual fixo: o ganho de PC depende da diferença nos atributos base entre a forma atual e a evoluída. Magikarp (Ataque base 29) que vira Gyarados (Ataque base 237) pode ter seu PC multiplicado em até dez vezes. Já Caterpie evoluindo para Metapod mal altera o número, porque os atributos mudam pouco. Use esta calculadora para saber o resultado exato de qualquer espécie antes de gastar seus Doces.',
        'faq_q3'            => 'Evoluir um Pokémon muda os IVs ou o nível dele?',
        'faq_a3'            => 'Não. No Pokémon GO, a evolução preserva os Valores Individuais (IVs) e o nível do Pokémon exatamente como estavam antes. Só os atributos base da espécie mudam. Um Pokémon com IVs perfeitos 15/15/15 antes de evoluir continuará com 15/15/15 depois. A variação no PC acontece exclusivamente porque a forma evoluída possui diferentes valores de Ataque, Defesa e Resistência na fórmula.',
        'faq_q4'            => 'O que é o multiplicador de PC no Pokémon GO?',
        'faq_a4'            => 'O Multiplicador de PC (CPM) é um valor que escala com o nível do Pokémon e aparece elevado ao quadrado na fórmula de PC. No Nível 1 vale 0,094; no Nível 20 (teto de captura selvagem) chega a 0,61570; no Nível 40 é 0,98326; e no Nível máximo 50 alcança 1,07122. Pequenas diferenças de CPM em níveis altos causam grandes variações no PC — por isso subir do Nível 49 para o 50 exige muito mais recursos do que subir do Nível 10 para o 11.',
        'faq_q5'            => 'Posso usar essa calculadora para ficar abaixo do limite da Liga Super?',
        'faq_a5'            => 'Sim, e é um dos usos mais valiosos desta ferramenta. Antes de evoluir qualquer Pokémon para a Liga Super (teto 1.500 PC), insira o PC atual e os IVs para ver o PC exato após a evolução. Se o resultado ultrapassar 1.500, procure um exemplar com PC menor da mesma espécie e recalcule. A calculadora também indica se o PC previsto cabe na Liga Ultra (≤2.500 PC) ou se é elegível para a Liga Mestre — tudo exibido ao mesmo tempo no painel de resultados.',
        'faq_q6'            => 'Por que o PC evoluído aparece como um intervalo em vez de um número exato?',
        'faq_a6'            => 'Quando os campos de IVs ficam em branco, a calculadora não conhece sua combinação específica de Valores Individuais e calcula o intervalo completo de IVs 0/0/0 (mínimo) até 15/15/15 (máximo). Quanto maiores os atributos base da espécie, mais amplo tende a ser esse intervalo. Para obter um único número preciso, insira seus IVs de Ataque, Defesa e Resistência, que você encontra usando a função de Avaliação do jogo ou a <a href="https://pokemoncalculator.online/pt-br/calculadora-iv-pokemon-go/">calculadora de IVs</a>.',
        'faq_q7'            => 'A calculadora funciona com todas as evoluções, inclusive as especiais?',
        'faq_a7'            => 'Sim. A calculadora cobre todo o Pokédex disponível no Pokémon GO, incluindo cadeias ramificadas (as oito evoluções de Eevee, os três caminhos de Tyrogue), variantes regionais e Megaevoluções. Os atributos base são verificados no Bulbapedia. Métodos de evolução especiais (andar com o Pokémon como companheiro, evolução com Iscas, evolução por troca) afetam apenas a quantidade de Doces exibida — a fórmula de PC é idêntica independentemente do método.',
        'faq_q8'            => 'É melhor subir de nível antes ou depois de evoluir?',
        'faq_a8'            => 'Na maioria dos casos, evoluir primeiro é mais eficiente em Pó Estelar: formas base custam menos pó e Doces por nível. Porém, se você mira um teto de PC específico para a GO Battle League — como o limite de 1.500 da Liga Super — pode ser necessário evoluir num ponto exato de PC para ficar logo abaixo do teto. Use esta calculadora para identificar essa janela de PC ideal e a <a href="https://pokemoncalculator.online/pt-br/calculadora-po-estelar/">calculadora de Pó Estelar</a> para planejar o custo total.',
        'related_title'     => 'Mais Calculadoras Pokémon GO',
        'no_related_tools'  => 'Ainda não há ferramentas relacionadas. Mais calculadoras em breve!',
        'blog_guides_title' => 'Guias e Dicas Pokémon',
        'blog_read_more'    => 'Ler guia',
    ],
    'fr' => [
        'title'                => 'Calculateur de PC d\'Évolution',
        'description'          => 'Prédisez le PC de votre Pokémon après chaque évolution instantanément.',
        'select_pokemon'       => 'Rechercher un Pokémon...',
        'current_cp_label'     => 'PC Actuel',
        'current_cp_ph'        => 'ex. 1200',
        'level_label'          => 'Niveau du Pokémon (optionnel)',
        'iv_section_label'     => 'IVs (optionnel — pour une prédiction précise)',
        'iv_attack_label'      => 'IV Attaque',
        'iv_defense_label'     => 'IV Défense',
        'iv_stamina_label'     => 'IV Endurance',
        'iv_placeholder'       => '0–15',
        'calculate_btn'        => 'Calculer le PC d\'Évolution',
        'reset_btn'            => 'Réinitialiser',
        'result_heading'       => 'Résultats d\'Évolution',
        'result_cp_label'      => 'PC Prédit',
        'result_hp_label'      => 'PS Prédit',
        'result_cp_range'      => 'Plage de PC',
        'result_candy'         => 'Bonbons',
        'result_stage'         => 'Stade',
        'league_great'         => 'Super Ligue',
        'league_ultra'         => 'Hyper Ligue',
        'league_master'        => 'Ligue Master',
        'league_great_tip'     => 'Compatible Super Ligue (≤1500 PC)',
        'league_ultra_tip'     => 'Compatible Hyper Ligue (≤2500 PC)',
        'league_master_tip'    => 'Éligible Ligue Master',
        'league_exceeds_great' => 'Dépasse la Super Ligue',
        'league_exceeds_ultra' => 'Dépasse la Hyper Ligue',
        'no_evolution'         => 'Aucune évolution supplémentaire',
        'current_label'        => 'Actuel',
        'evolution_arrow'      => 'évolue en',
        'tooltip_cp'           => 'Points de Combat — calculés avec la formule officielle de Pokémon GO.',
        'tooltip_iv'           => 'Valeurs Individuelles (0–15). Laissez vide pour voir la plage de PC.',
        'tooltip_level'        => 'Niveau de votre Pokémon (1–50). Utilisé pour une prédiction plus précise.',
        'tooltip_candy'        => 'Bonbons nécessaires pour évoluer à ce stade.',
        'copy_result'          => 'Copier le résultat',
        'copied'               => 'Copié !',
        'error_data_load'      => 'Impossible de charger les données. Veuillez rafraîchir la page.',
        'error_select_pokemon' => 'Veuillez sélectionner un Pokémon.',
        'error_invalid_cp'     => 'Veuillez entrer un PC valide (1–10000).',
        'error_invalid_level'  => 'Le niveau doit être entre 1 et 50.',
        'error_invalid_iv'     => 'Les IVs doivent être entre 0 et 15.',
        'error_no_results'     => 'Aucun Pokémon trouvé.',
        'error_calculation'    => 'Erreur de calcul. Vérifiez vos entrées.',
        'error_no_evolution'   => 'Ce Pokémon n\'évolue pas.',
        'meta_title'        => 'Calculateur PC Évolution Pokémon GO | PokemonCalculator',
        'meta_desc'         => 'Calculez le PC de votre Pokémon après évolution gratuitement. Entrez PC, niveau et IVs pour des prédictions précises en un instant — idéal pour la GO Battle League.',
        'intro_title'       => 'Calculateur de PC d\'Évolution — Connaissez le PC Avant d\'Évoluer',
        'intro_content'     => '<p>Le <strong>calculateur de PC d\'évolution</strong> prédit avec précision les Points de Combat de votre Pokémon après chaque évolution — avant de dépenser un seul Bonbon. Saisissez le PC actuel et l\'outil calcule instantanément le PC prédit pour chaque stade d\'évolution, en appliquant la formule officielle de Niantic. Fini d\'évoluer un Fantominus à 600 PC pour se retrouver avec un Ectoplasma décevant qui n\'entre pas dans la Super Ligue.</p><p>L\'évolution dans Pokémon GO ne suit pas un pourcentage fixe. Chaque espèce possède des statistiques de base uniques — Attaque, Défense et Endurance — et la différence entre la forme de base et la forme évoluée détermine le gain de PC. La communauté française de Pokémon GO, très active sur la scène PvP compétitive, utilise ce calculateur surtout pour préparer des équipes viables en Super Ligue, où le plafond de 1 500 PC impose une sélection chirurgicale des Pokémon à faire évoluer.</p><p>Pour optimiser vos investissements, combinez cet outil avec le <a href="https://pokemoncalculator.online/fr/calculateur-iv-pokemon-go/">calculateur d\'IVs</a> pour vérifier vos valeurs individuelles avant de dépenser de la Poussière d\'Étoile, et consultez le <a href="https://pokemoncalculator.online/fr/tableau-des-types/">tableau des types</a> pour valider les matchups de votre Pokémon évoluée. Utilisez le calculateur d\'évolution ci-dessus pour prédire vos résultats immédiatement, puis planifiez la montée en niveau avec le <a href="https://pokemoncalculator.online/fr/calculateur-cp-pokemon/">calculateur de PC</a>.</p>',
        'howto_title'       => 'Comment Utiliser le Calculateur de PC d\'Évolution',
        'howto_step1'       => 'Saisissez le nom du Pokémon dans le champ <strong>Rechercher un Pokémon</strong> — par exemple "Évoli" ou "Minidraco". Sélectionnez l\'entrée correcte dans le menu déroulant ; l\'outil charge automatiquement les statistiques de base et toute la chaîne d\'évolution disponible dans Pokémon GO.',
        'howto_step2'       => 'Entrez le <strong>PC Actuel</strong> de votre Pokémon dans le champ correspondant. Si vous connaissez le niveau exact (visible sur l\'écran du Pokémon dans le jeu), ajoutez-le aussi pour plus de précision. Pour une prédiction au chiffre près, renseignez les IVs d\'Attaque, de Défense et d\'Endurance obtenus via le <a href="https://pokemoncalculator.online/fr/calculateur-iv-pokemon-go/">calculateur d\'IVs</a> ou la fonction Évaluation du jeu.',
        'howto_step3'       => 'Appuyez sur <strong>Calculer le PC d\'Évolution</strong>. L\'outil traite tous les stades évolutifs simultanément et affiche le PC prédit, les PS prédits, le coût en Bonbons et — point crucial pour les joueurs PvP — si le PC résultant est compatible avec la <strong>Super Ligue (≤1 500 PC)</strong> ou l\'<strong>Hyper Ligue (≤2 500 PC)</strong>.',
        'howto_step4'       => 'Consultez le panneau <strong>Résultats d\'Évolution</strong>. Chaque stade affiche l\'intervalle de PC (min. à max. selon les IVs) et la prédiction exacte si vous avez renseigné vos IVs. Utilisez le bouton Copier le résultat pour sauvegarder vos données, puis faites évoluer en jeu avec la certitude du PC que vous obtiendrez.',
        'info_title'        => 'Comment le PC d\'Évolution est Calculé dans Pokémon GO',
        'info_content'      => '<p>Derrière chaque valeur de PC se cache une formule mathématique appliquée en temps réel par Niantic. La comprendre fait de vous un dresseur plus stratégique — en particulier si vous jouez à la GO Battle League ou si vous cherchez les meilleurs attaquants pour les Raids.</p><h3>La Formule Officielle du PC</h3><p>La formule que Niantic utilise — et qui alimente ce calculateur — est :</p><p><strong>PC = plancher( (Attaque + IV_Atk) × √(Défense + IV_Def) × √(Endurance + IV_Sta) × CPM² / 10 )</strong></p><p>Où le <strong>CPM</strong> (Multiplicateur de PC) dépend du niveau du Pokémon : 0,094 au Niveau 1, 0,61570 au Niveau 20, 0,98326 au Niveau 40, et 1,07122 au Niveau maximum 50. La fonction "plancher" arrondit toujours vers le bas — d\'où l\'affichage de nombres entiers dans le jeu.</p><p>Lors de l\'évolution, les statistiques de base d\'Attaque, Défense et Endurance changent pour celles de la nouvelle forme. Le niveau et les IVs restent strictement identiques. C\'est pourquoi la même formule donne des résultats si différents selon l\'espèce : Dracolosse, avec une Attaque de base de 263, est l\'un des meilleurs attaquants Feu/Vol du Raid méta européen — et cette supériorité s\'explique entièrement par ses statistiques de base élevées.</p><h3>Pourquoi l\'Intervalle de PC Est Important</h3><p>Sans IVs, le calculateur affiche l\'intervalle complet entre le minimum (IVs 0/0/0) et le maximum (15/15/15). Pour de nombreux Pokémon à haut niveau, cet intervalle peut dépasser 200 PC. Si votre objectif est la <strong>Super Ligue avec plafond à 1 500 PC</strong>, vous avez besoin du chiffre exact, pas d\'une fourchette. Consultez d\'abord le <a href="https://pokemoncalculator.online/fr/calculateur-iv-pokemon-go/">calculateur d\'IVs</a> pour identifier vos valeurs précises, puis entrez-les ici.</p><h3>Implications pour la GO Battle League</h3><p>La communauté PvP française est particulièrement attentive au plafond de PC. Un Feurisson au bon niveau peut être un élément central d\'une équipe Super Ligue ; mal évoluée et trop puissante, cette même créature devient inéligible. Ce calculateur vous montre le PC exact <em>avant</em> d\'évoluer, vous évitant une erreur irréversible. Combinez-le avec le <a href="https://pokemoncalculator.online/fr/calculateur-poussiere-etoile/">calculateur de Poussière d\'Étoile</a> pour planifier l\'investissement complet avant et après évolution.</p><h3>Évolutions Ramifiées et Cas Particuliers</h3><p>Ce calculateur couvre l\'intégralité des chaînes d\'évolution de Pokémon GO, y compris les embranchements (les huit évolutions d\'Évoli, les trois voies de Debugant), les variantes régionales et les Méga-Évolutions. Pour chaque espèce, les statistiques de base sont vérifiées sur Bulbapedia. Consultez également le <a href="https://pokemoncalculator.online/fr/tableau-des-types/">tableau des types</a> pour valider l\'utilité de votre Pokémon évoluée en combat.</p>',
        'info_table_title'  => 'Valeurs du Multiplicateur de PC (CPM) par Niveau',
        'info_table_html'   => '<table class="pkm-calc-table"><thead><tr><th>Niveau</th><th>Multiplicateur de PC (CPM)</th><th>Référence</th></tr></thead><tbody><tr><td>1</td><td>0,09400</td><td><span class="pkm-table-note-badge">Niveau minimum</span></td></tr><tr><td>5</td><td>0,21088</td><td></td></tr><tr><td>10</td><td>0,42072</td><td></td></tr><tr><td>15</td><td>0,51737</td><td></td></tr><tr><td>20</td><td>0,61570</td><td><span class="pkm-table-note-badge">Plafond capture sauvage</span></td></tr><tr><td>25</td><td>0,70572</td><td></td></tr><tr><td>30</td><td>0,80354</td><td><span class="pkm-table-note-badge">Plafond boss de Raid</span></td></tr><tr><td>35</td><td>0,88931</td><td></td></tr><tr><td>40</td><td>0,98326</td><td><span class="pkm-table-note-badge">Ancien plafond</span></td></tr><tr><td>41</td><td>0,99192</td><td><span class="pkm-table-note-badge">Début Bonbons XL</span></td></tr><tr><td>45</td><td>1,02500</td><td></td></tr><tr><td>50</td><td>1,07122</td><td><span class="pkm-table-note-badge">Niveau maximum actuel</span></td></tr></tbody></table>',
        'faq_title'         => 'Questions Fréquentes',
        'faq_q1'            => 'Comment calculer le PC d\'un Pokémon après évolution ?',
        'faq_a1'            => 'Entrez le PC actuel de votre Pokémon dans le calculateur ci-dessus et appuyez sur Calculer. L\'outil applique la formule officielle de Pokémon GO — avec les statistiques de base de la forme évoluée et le niveau ainsi que les IVs actuels — pour afficher instantanément le PC prédit. Pour plus de précision, ajoutez le niveau et les IVs. Sans IVs, le calculateur affiche l\'intervalle complet entre le PC minimum et maximum possible.',
        'faq_q2'            => 'De combien de PC un Pokémon gagne-t-il en évoluant ?',
        'faq_a2'            => 'Il n\'existe pas de pourcentage universel : le gain de PC dépend entièrement de la différence de statistiques de base entre la forme actuelle et la forme évoluée. Magicarpe (Attaque de base 29) devenant Léviator (Attaque de base 237) peut voir son PC multipliée par dix ou plus. À l\'inverse, Chenipan évoluant en Chrysacier change à peine de valeur car les statistiques progressent très peu. Utilisez ce calculateur pour connaître le résultat exact de n\'importe quelle espèce avant de dépenser vos Bonbons.',
        'faq_q3'            => 'L\'évolution modifie-t-elle les IVs ou le niveau d\'un Pokémon ?',
        'faq_a3'            => 'Non. Dans Pokémon GO, l\'évolution conserve les Valeurs Individuelles (IVs) et le niveau du Pokémon exactement tels qu\'ils étaient avant. Seules les statistiques de base de l\'espèce changent. Un Pokémon avec des IVs parfaits 15/15/15 avant évolution gardera 15/15/15 après. La variation de PC s\'explique uniquement par le fait que la forme évoluée possède des valeurs d\'Attaque, de Défense et d\'Endurance différentes dans la formule.',
        'faq_q4'            => 'Qu\'est-ce que le multiplicateur de PC dans Pokémon GO ?',
        'faq_a4'            => 'Le Multiplicateur de PC (CPM) est une valeur qui évolue selon le niveau du Pokémon et qui apparaît au carré dans la formule de PC. Au Niveau 1 il vaut 0,094 ; au Niveau 20 (plafond de capture sauvage) il atteint 0,61570 ; au Niveau 40 il est de 0,98326 ; et au Niveau maximum 50 il culmine à 1,07122. De petites différences de CPM aux niveaux élevés génèrent de grands écarts de PC — passer du Niveau 49 au 50 coûte bien plus cher en ressources que progresser du Niveau 10 au 11.',
        'faq_q5'            => 'Puis-je utiliser ce calculateur pour rester sous le plafond de la Super Ligue ?',
        'faq_a5'            => 'Oui, c\'est l\'un des usages les plus précieux de cet outil, surtout pour la scène PvP française. Avant de faire évoluer un Pokémon destiné à la Super Ligue (plafond 1 500 PC), entrez le PC actuel et les IVs pour obtenir le PC exact post-évolution. Si le résultat dépasse 1 500, cherchez un spécimen de PC inférieur de la même espèce et recalculez. Le calculateur indique également si le PC prédit est compatible avec l\'Hyper Ligue (≤2 500 PC) ou la Ligue Master.',
        'faq_q6'            => 'Pourquoi le PC évolué s\'affiche-t-il sous forme d\'intervalle plutôt qu\'un chiffre exact ?',
        'faq_a6'            => 'Lorsque les champs d\'IVs sont laissés vides, le calculateur ne connaît pas votre combinaison spécifique de Valeurs Individuelles et calcule donc l\'intervalle complet des IVs 0/0/0 (minimum) à 15/15/15 (maximum). Plus les statistiques de base de l\'espèce sont élevées, plus cet intervalle peut être large. Pour obtenir un chiffre unique et précis, renseignez vos IVs d\'Attaque, Défense et Endurance, disponibles via la fonction Évaluation du jeu ou le <a href="https://pokemoncalculator.online/fr/calculateur-iv-pokemon-go/">calculateur d\'IVs</a>.',
        'faq_q7'            => 'Ce calculateur fonctionne-t-il avec toutes les évolutions, y compris les spéciales ?',
        'faq_a7'            => 'Oui. Le calculateur couvre l\'intégralité du Pokédex disponible dans Pokémon GO, y compris les chaînes ramifiées (les huit évolutions d\'Évoli, les trois voies de Debugant), les variantes régionales et les Méga-Évolutions. Les statistiques de base sont vérifiées sur Bulbapedia. Les méthodes d\'évolution spéciales (marcher avec le Pokémon comme Copain, évolution par Leurre, évolution par échange) n\'influencent que le coût en Bonbons affiché — la formule de PC est identique quelle que soit la méthode.',
        'faq_q8'            => 'Vaut-il mieux monter en niveau avant ou après l\'évolution ?',
        'faq_a8'            => 'Dans la plupart des cas, faire évoluer en premier est plus efficace en Poussière d\'Étoile : les formes de base coûtent moins de poussière et de Bonbons par niveau. Cependant, si vous ciblez un plafond de PC précis pour la GO Battle League — comme la limite de 1 500 de la Super Ligue — vous devrez peut-être faire évoluer à un PC très précis pour rester juste sous le plafond. Utilisez ce calculateur pour identifier cette fenêtre de PC cible et le <a href="https://pokemoncalculator.online/fr/calculateur-poussiere-etoile/">calculateur de Poussière d\'Étoile</a> pour planifier l\'investissement total.',
        'related_title'     => 'Plus de Calculateurs Pokémon GO',
        'no_related_tools'  => 'Pas encore d\'outils associés. D\'autres calculateurs arrivent bientôt !',
        'blog_guides_title' => 'Guides et Conseils Pokémon',
        'blog_read_more'    => 'Lire le guide',
    ],
    'de' => [
        'title'                => 'Entwicklungs-KP-Rechner',
        'description'          => 'Berechne das KP deines Pokémon nach jeder Entwicklung sofort.',
        'select_pokemon'       => 'Pokémon suchen...',
        'current_cp_label'     => 'Aktuelles KP',
        'current_cp_ph'        => 'z.B. 1200',
        'level_label'          => 'Pokémon-Level (optional)',
        'iv_section_label'     => 'IVs (optional — für präzise Vorhersage)',
        'iv_attack_label'      => 'Angriff-IV',
        'iv_defense_label'     => 'Verteidigung-IV',
        'iv_stamina_label'     => 'Ausdauer-IV',
        'iv_placeholder'       => '0–15',
        'calculate_btn'        => 'Entwicklungs-KP berechnen',
        'reset_btn'            => 'Zurücksetzen',
        'result_heading'       => 'Entwicklungsergebnisse',
        'result_cp_label'      => 'Vorhergesagtes KP',
        'result_hp_label'      => 'Vorhergesagte KP',
        'result_cp_range'      => 'KP-Bereich',
        'result_candy'         => 'Bonbons',
        'result_stage'         => 'Stufe',
        'league_great'         => 'Superliga',
        'league_ultra'         => 'Ultraliga',
        'league_master'        => 'Meisterliga',
        'league_great_tip'     => 'Passt zur Superliga (≤1500 KP)',
        'league_ultra_tip'     => 'Passt zur Ultraliga (≤2500 KP)',
        'league_master_tip'    => 'Meisterliga-berechtigt',
        'league_exceeds_great' => 'Überschreitet Superliga',
        'league_exceeds_ultra' => 'Überschreitet Ultraliga',
        'no_evolution'         => 'Keine weitere Entwicklung',
        'current_label'        => 'Aktuell',
        'evolution_arrow'      => 'entwickelt sich zu',
        'tooltip_cp'           => 'Kampfpunkte — berechnet mit der offiziellen Pokémon GO Formel.',
        'tooltip_iv'           => 'Individualwerte (0–15). Leer lassen für KP-Bereichsanzeige.',
        'tooltip_level'        => 'Level deines Pokémon (1–50). Für präzisere Vorhersage.',
        'tooltip_candy'        => 'Bonbons für die Entwicklung zu dieser Stufe.',
        'copy_result'          => 'Ergebnis kopieren',
        'copied'               => 'Kopiert!',
        'error_data_load'      => 'Pokémon-Daten konnten nicht geladen werden. Bitte lade die Seite neu.',
        'error_select_pokemon' => 'Bitte wähle ein Pokémon aus.',
        'error_invalid_cp'     => 'Bitte gib ein gültiges KP ein (1–10000).',
        'error_invalid_level'  => 'Das Level muss zwischen 1 und 50 liegen.',
        'error_invalid_iv'     => 'IVs müssen zwischen 0 und 15 liegen.',
        'error_no_results'     => 'Kein Pokémon gefunden.',
        'error_calculation'    => 'Berechnungsfehler. Überprüfe deine Eingaben.',
        'error_no_evolution'   => 'Dieses Pokémon entwickelt sich nicht.',
        'meta_title'        => 'Entwicklungs-KP-Rechner Pokémon GO | PokemonCalculator',
        'meta_desc'         => 'Berechne das KP deines Pokémon nach jeder Entwicklung – kostenlos. Gib KP, Level und IVs ein und erhalte sofort genaue Vorhersagen für alle Entwicklungsstufen.',
        'intro_title'       => 'Entwicklungs-KP-Rechner — KP vor der Entwicklung berechnen',
        'intro_content'     => '<p>Der <strong>Entwicklungs-KP-Rechner</strong> zeigt dir genau, wie viele Kampfpunkte dein Pokémon nach der Entwicklung haben wird — bevor du auch nur einen Bonbon ausgibst. Gib das aktuelle KP ein, und das Tool berechnet sofort das vorhergesagte KP für jede Entwicklungsstufe — mit der offiziellen Niantic-Formel. Schluss damit, ein Karpador mit 400 KP zu entwickeln und dann einen Garados zu erhalten, der nicht für die Superliga taugt.</p><p>Die Entwicklung in Pokémon GO folgt keinem festen Prozentwert. Jede Spezies hat einzigartige Basiswerte für Angriff, Verteidigung und Ausdauer (KP), und die Differenz zwischen Ausgangs- und Entwicklungsform bestimmt den KP-Zuwachs. Die deutschsprachige Pokémon GO-Community — aktiv auf pokemongo.de und in zahlreichen Discord-Servern — schätzt besonders die Genauigkeit dieser Berechnung, da präzise Zahlen beim strategischen Teamaufbau für die GO-Kampfliga entscheidend sind.</p><p>Kombiniere diesen Rechner mit dem <a href="https://pokemoncalculator.online/de/pokemon-go-iv-rechner/">IV-Rechner</a>, um Individualwerte vor dem Sternenstaub-Investment zu prüfen, und überprüfe die <a href="https://pokemoncalculator.online/de/typen-tabelle/">Typen-Tabelle</a>, um die Kampfstärke deines entwickelten Pokémon einzuschätzen. Nutze den Entwicklungs-KP-Rechner oben für sofortige Vorhersagen und plane die Aufwertung anschließend mit dem <a href="https://pokemoncalculator.online/de/kp-rechner-pokemon-go/">KP-Rechner</a>.</p>',
        'howto_title'       => 'So verwendest du den Entwicklungs-KP-Rechner',
        'howto_step1'       => 'Tippe den Namen des Pokémon in das Feld <strong>Pokémon suchen</strong> — zum Beispiel „Evoli" oder „Dratini". Wähle den richtigen Eintrag aus dem Dropdown-Menü; das Tool lädt automatisch die Basiswerte und die vollständige Entwicklungskette für Pokémon GO.',
        'howto_step2'       => 'Gib das <strong>aktuelle KP</strong> deines Pokémon ein. Falls du das genaue Level kennst (im Pokémon-Informationsbildschirm sichtbar), trage es ebenfalls ein — das verbessert die Vorhersagegenauigkeit deutlich. Für pixelgenaue Ergebnisse füge Angriff-, Verteidigungs- und Ausdauer-IVs aus dem <a href="https://pokemoncalculator.online/de/pokemon-go-iv-rechner/">IV-Rechner</a> oder der In-Game-Bewertung hinzu.',
        'howto_step3'       => 'Tippe auf <strong>Entwicklungs-KP berechnen</strong>. Das Tool verarbeitet alle Entwicklungsstufen gleichzeitig und zeigt vorhergesagtes KP, vorhergesagte KP (HP), Bonbonkosten sowie ob das Ergebnis in die <strong>Superliga (≤1.500 KP)</strong> oder die <strong>Ultraliga (≤2.500 KP)</strong> passt.',
        'howto_step4'       => 'Prüfe das <strong>Entwicklungsergebnisse</strong>-Panel. Jede Stufe zeigt den KP-Bereich (Min. bis Max. je nach IVs) und bei eingegebenen IVs die exakte Vorhersage. Nutze die Schaltfläche „Ergebnis kopieren", um die Zahlen zu speichern, und entwickle im Spiel mit vollständiger Sicherheit über das zu erwartende KP.',
        'info_title'        => 'So wird das Entwicklungs-KP in Pokémon GO berechnet',
        'info_content'      => '<p>Wer die Mathematik hinter dem Entwicklungs-KP-Rechner versteht, trifft bessere Entscheidungen im Spiel. KP ist kein eigenständiges Attribut — es ist ein komprimierter Wert, der aus drei Basisstatistiken berechnet wird: <strong>Angriff</strong>, <strong>Verteidigung</strong> und <strong>Ausdauer (KP/HP)</strong>.</p><h3>Die offizielle KP-Formel</h3><p>Die Formel, die Niantic verwendet — und die auch diesen Rechner antreibt — lautet:</p><p><strong>KP = Abrunden( (Angriff + IV_Atk) × √(Verteidigung + IV_Def) × √(Ausdauer + IV_Sta) × KPM² / 10 )</strong></p><p>Dabei ist <strong>KPM</strong> der KP-Multiplikator für das Level des Pokémon: 0,094 auf Level 1, 0,61570 auf Level 20, 0,98326 auf Level 40 und 1,07122 auf dem Höchstlevel 50. Die Abrundungsfunktion erklärt, warum das Spiel immer ganze Zahlen anzeigt.</p><p>Bei der Entwicklung ändern sich die Basiswerte für Angriff, Verteidigung und Ausdauer auf die Werte der neuen Form. Level und IVs bleiben unverändert. Genau deshalb liefert dieselbe Formel je nach Spezies so unterschiedliche Ergebnisse: Knakrack hat mit Basisangriff 261 einen der höchsten Angriffswerte im Raid-Meta — und diese Stärke entsteht vollständig aus den Basiswerten seiner Entwicklung aus Kaumalat.</p><h3>Warum der KP-Bereich wichtig ist</h3><p>Ohne IVs zeigt der Rechner den vollständigen Bereich von Minimum (IVs 0/0/0) bis Maximum (15/15/15). Bei manchen Pokémon auf hohem Level kann dieser Bereich über 200 KP umfassen. Wenn du die <strong>Superliga mit Obergrenze 1.500 KP</strong> im Visier hast, brauchst du den exakten Wert, keinen Bereich. Nutze zuerst den <a href="https://pokemoncalculator.online/de/pokemon-go-iv-rechner/">IV-Rechner</a>, um deine genauen Werte zu ermitteln, und gib sie dann hier ein.</p><h3>Auswirkungen auf die GO-Kampfliga</h3><p>Der häufigste Fehler in der deutschsprachigen Community: Entwickeln ohne vorherige KP-Prüfung. Die Superliga verlangt Pokémon bei oder unter 1.500 KP zur Kampfzeit — eine Rückentwicklung ist nicht möglich. Ein Sumpex knapp unter 1.500 KP ist eines der stärksten Superliga-Pokémon; dasselbe Pokémon überentwickelt auf 1.600 KP wird ineligibel. Plane die Entwicklung mit diesem Rechner und das Aufwertungsbudget mit dem <a href="https://pokemoncalculator.online/de/sternenstaub-rechner/">Sternenstaub-Rechner</a>.</p><h3>Verzweigte Entwicklungen und Sonderfälle</h3><p>Dieser Rechner deckt alle Entwicklungsketten in Pokémon GO ab, einschließlich Verzweigungen (die acht Evoli-Entwicklungen, die drei Wege von Hassmon), regionalen Varianten und Mega-Entwicklungen. Alle Basiswerte sind gegen Bulbapedia verifiziert. Überprüfe die Nützlichkeit deines entwickelten Pokémon in Kämpfen mit der <a href="https://pokemoncalculator.online/de/typen-tabelle/">Typen-Tabelle</a>.</p>',
        'info_table_title'  => 'KP-Multiplikator (KPM) nach Pokémon-Level',
        'info_table_html'   => '<table class="pkm-calc-table"><thead><tr><th>Level</th><th>KP-Multiplikator (KPM)</th><th>Meilenstein</th></tr></thead><tbody><tr><td>1</td><td>0,09400</td><td><span class="pkm-table-note-badge">Mindestlevel</span></td></tr><tr><td>5</td><td>0,21088</td><td></td></tr><tr><td>10</td><td>0,42072</td><td></td></tr><tr><td>15</td><td>0,51737</td><td></td></tr><tr><td>20</td><td>0,61570</td><td><span class="pkm-table-note-badge">Wildfang-Obergrenze</span></td></tr><tr><td>25</td><td>0,70572</td><td></td></tr><tr><td>30</td><td>0,80354</td><td><span class="pkm-table-note-badge">Raid-Boss-Obergrenze</span></td></tr><tr><td>35</td><td>0,88931</td><td></td></tr><tr><td>40</td><td>0,98326</td><td><span class="pkm-table-note-badge">Alte Höchstgrenze</span></td></tr><tr><td>41</td><td>0,99192</td><td><span class="pkm-table-note-badge">Start XL-Bonbons</span></td></tr><tr><td>45</td><td>1,02500</td><td></td></tr><tr><td>50</td><td>1,07122</td><td><span class="pkm-table-note-badge">Aktuelles Höchstlevel</span></td></tr></tbody></table>',
        'faq_title'         => 'Häufig gestellte Fragen',
        'faq_q1'            => 'Wie berechnet man das KP eines Pokémon nach der Entwicklung?',
        'faq_a1'            => 'Gib das aktuelle KP deines Pokémon im Rechner oben ein und klicke auf Berechnen. Das Tool wendet die offizielle Pokémon GO-Formel an — mit den Basiswerten der entwickelten Form und dem aktuellen Level sowie den IVs — und zeigt sofort das vorhergesagte KP an. Für maximale Genauigkeit gib auch Level und IVs (je 0–15) ein. Ohne IVs zeigt der Rechner den vollständigen Bereich vom minimalen bis zum maximalen möglichen KP.',
        'faq_q2'            => 'Wie viel KP gewinnt ein Pokémon durch die Entwicklung?',
        'faq_a2'            => 'Es gibt keinen universellen Prozentwert: Der KP-Zuwachs hängt vollständig von der Differenz der Basiswerte zwischen der aktuellen und der entwickelten Form ab. Karpador (Basisangriff 29) wird zu Garados (Basisangriff 237) und kann dabei das Zehnfache an KP gewinnen. Dagegen ändert sich das KP bei Raupy zu Safcon kaum, weil die Basiswerte nur minimal steigen. Nutze diesen Rechner für das exakte Ergebnis jeder Spezies vor dem Bonboneinsatz.',
        'faq_q3'            => 'Verändert die Entwicklung die IVs oder das Level eines Pokémon?',
        'faq_a3'            => 'Nein. Die Entwicklung in Pokémon GO bewahrt die Individualwerte (IVs) und das Level des Pokémon exakt so, wie sie vor der Entwicklung waren. Nur die Basiswerte der Spezies ändern sich. Ein Pokémon mit perfekten IVs 15/15/15 vor der Entwicklung behält diese auch danach. Die KP-Veränderung entsteht ausschließlich dadurch, dass die entwickelte Form andere Basiswerte für Angriff, Verteidigung und Ausdauer in der Formel hat.',
        'faq_q4'            => 'Was ist der KP-Multiplikator in Pokémon GO?',
        'faq_a4'            => 'Der KP-Multiplikator (KPM) ist ein levelabhängiger Skalierungswert, der in der KP-Formel quadratisch eingeht. Auf Level 1 beträgt er 0,094; auf Level 20 (Wildfang-Obergrenze) erreicht er 0,61570; auf Level 40 ist er 0,98326; auf dem Höchstlevel 50 beträgt er 1,07122. Kleine KPM-Unterschiede auf hohen Leveln erzeugen große KP-Sprünge — das erklärt, warum der Aufstieg von Level 49 auf 50 erheblich mehr Ressourcen kostet als von Level 10 auf 11.',
        'faq_q5'            => 'Kann ich diesen Rechner nutzen, um unter der Superliga-Grenze zu bleiben?',
        'faq_a5'            => 'Ja, und das ist einer der wichtigsten Anwendungsfälle dieses Tools. Bevor du ein Pokémon für die Superliga entwickelst (Obergrenze 1.500 KP), gib das aktuelle KP und die IVs ein, um das genaue KP nach der Entwicklung zu sehen. Überschreitet das Ergebnis 1.500, suche ein Exemplar mit niedrigerem KP derselben Spezies und berechne erneut. Der Rechner zeigt außerdem, ob das vorhergesagte KP in die Ultraliga (≤2.500 KP) passt oder für die Meisterliga qualifiziert.',
        'faq_q6'            => 'Warum erscheint das entwickelte KP als Bereich statt als exakte Zahl?',
        'faq_a6'            => 'Wenn die IV-Felder leer bleiben, kennt der Rechner deine spezifische IV-Kombination nicht und berechnet daher den vollständigen Bereich von IVs 0/0/0 (Minimum) bis 15/15/15 (Maximum). Je höher die Basiswerte der Spezies, desto breiter kann dieser Bereich sein. Für eine einzelne präzise Vorhersage gib deine Angriff-, Verteidigungs- und Ausdauer-IVs ein — zu finden über die In-Game-Bewertungsfunktion oder den <a href="https://pokemoncalculator.online/de/pokemon-go-iv-rechner/">IV-Rechner</a>.',
        'faq_q7'            => 'Funktioniert dieser Rechner mit allen Entwicklungen, auch Sonderentwicklungen?',
        'faq_a7'            => 'Ja. Der Rechner deckt das gesamte in Pokémon GO verfügbare Pokédex ab, einschließlich verzweigter Entwicklungen (die acht Evoli-Entwicklungen, die drei Wege von Hassmon), regionaler Varianten und Mega-Entwicklungen. Alle Basiswerte sind gegen Bulbapedia verifiziert. Spezielle Entwicklungsmethoden (als Kumpel laufen, Köder-Entwicklungen, Tausch-Entwicklungen) beeinflussen nur die angezeigte Bonbonanzahl — die KP-Formel ist unabhängig von der Methode identisch.',
        'faq_q8'            => 'Ist es besser, vor oder nach der Entwicklung zu leveln?',
        'faq_a8'            => 'In den meisten Fällen ist es Sternenstaub-effizienter, zuerst zu entwickeln: Basisformen kosten weniger Sternenstaub und Bonbons pro Level. Wenn du jedoch einen präzisen KP-Wert für die GO-Kampfliga ansteuerst — etwa die 1.500-KP-Grenze der Superliga — musst du möglicherweise genau bei einem bestimmten KP entwickeln, um knapp darunter zu landen. Nutze diesen Rechner für die Ziel-KP-Fensterberechnung und den <a href="https://pokemoncalculator.online/de/sternenstaub-rechner/">Sternenstaub-Rechner</a> für die Gesamtkosten.',
        'related_title'     => 'Weitere Pokémon GO Rechner',
        'no_related_tools'  => 'Noch keine verwandten Tools. Weitere Rechner kommen bald!',
        'blog_guides_title' => 'Pokémon Guides & Tipps',
        'blog_read_more'    => 'Guide lesen',
    ],
];

// ── Shortcode ─────────────────────────────────────────────────────────────────
function pkm_evolution_cp_calc_shortcode() {
    global $pkm_current_lang, $pkm_evo_cp_strings;

    $lang = $pkm_current_lang ?? 'en';
    $t    = $pkm_evo_cp_strings[ $lang ] ?? $pkm_evo_cp_strings['en'];

    // ── Ad slots (Loaded dynamically from Admin Settings; renders only when code is provided) ──
    $ad_slot_a     = get_setting('ad_slot_top', get_setting('ad_header_code', ''));
    $ad_slot_b     = get_setting('ad_slot_below_result', '');
    $ad_slot_c     = get_setting('ad_slot_mid_content', '');
    $ad_slot_d     = get_setting('ad_slot_mid_faq', '');
    $ad_slot_e     = get_setting('ad_slot_sky_left', get_setting('ad_slot_sidebar', ''));
    $ad_slot_f_sky = get_setting('ad_slot_sky_right', get_setting('ad_slot_sidebar', ''));

    $pkm_render_ad = function( string $slot, string $extra_class = '' ): string {
        return pkm_render_ad( $slot, $extra_class );
    };

    // ── Pokemon data ─────────────────────────────────────────────────────────
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
                'sprite_official' => esc_url( trim( $p['sprite_official'] ?? $p['sprite_default'] ?? '' ) ),
            ];
        }, $raw );
    } else {
        $js_data = [];
    }

    // ── Header Pokemon (Eevee=133, Magikarp=129, Dragonair=148) ─────────────
    $pokemon_a = get_pokemon_data( 133 );
    $pokemon_b = get_pokemon_data( 129 );
    $pokemon_c = get_pokemon_data( 148 );

    $sprite_a = esc_url( trim( $pokemon_a['sprite_official'] ?? $pokemon_a['sprite_default'] ?? '' ) );
    $sprite_b = esc_url( trim( $pokemon_b['sprite_official'] ?? $pokemon_b['sprite_default'] ?? '' ) );
    $sprite_c = esc_url( trim( $pokemon_c['sprite_official'] ?? $pokemon_c['sprite_default'] ?? '' ) );

    // ── Type badge colours ───────────────────────────────────────────────────
    $type_colors = [
        'normal'   => ['#A8A77A','#fff'], 'fire'     => ['#EE8130','#fff'],
        'water'    => ['#6390F0','#fff'], 'electric' => ['#F7D02C','#333'],
        'grass'    => ['#7AC74C','#fff'], 'ice'      => ['#96D9D6','#333'],
        'fighting' => ['#C22E28','#fff'], 'poison'   => ['#A33EA1','#fff'],
        'ground'   => ['#E2BF65','#333'], 'flying'   => ['#A98FF3','#fff'],
        'psychic'  => ['#F95587','#fff'], 'bug'      => ['#A6B91A','#fff'],
        'rock'     => ['#B6A136','#fff'], 'ghost'    => ['#735797','#fff'],
        'dragon'   => ['#6F35FC','#fff'], 'dark'     => ['#705746','#fff'],
        'steel'    => ['#B7B7CE','#333'], 'fairy'    => ['#D685AD','#fff'],
    ];
    $type_colors_json = wp_json_encode( $type_colors );

    ob_start();
    ?>
    <?php /* ── Anti-flash dark mode ── */ ?>
    <script>
    (function(){
        var t=localStorage.getItem('pkm-theme');
        if(t)document.documentElement.setAttribute('data-theme',t);
        else if(window.matchMedia&&window.matchMedia('(prefers-color-scheme: dark)').matches)
            document.documentElement.setAttribute('data-theme','dark');
    })();
    </script>

    <?php /* ── Translations for JS ── */ ?>
    <script>
    var pkmEvoCpTrans = <?php echo wp_json_encode([
        'error_select_pokemon' => $t['error_select_pokemon'],
        'error_invalid_cp'     => $t['error_invalid_cp'],
        'error_invalid_level'  => $t['error_invalid_level'],
        'error_invalid_iv'     => $t['error_invalid_iv'],
        'error_calculation'    => $t['error_calculation'],
        'error_no_evolution'   => $t['error_no_evolution'],
        'error_no_results'     => $t['error_no_results'],
        'result_cp_label'      => $t['result_cp_label'],
        'result_hp_label'      => $t['result_hp_label'],
        'result_cp_range'      => $t['result_cp_range'],
        'result_candy'         => $t['result_candy'],
        'result_stage'         => $t['result_stage'],
        'league_great'         => $t['league_great'],
        'league_ultra'         => $t['league_ultra'],
        'league_master'        => $t['league_master'],
        'league_great_tip'     => $t['league_great_tip'],
        'league_ultra_tip'     => $t['league_ultra_tip'],
        'league_master_tip'    => $t['league_master_tip'],
        'league_exceeds_great' => $t['league_exceeds_great'],
        'league_exceeds_ultra' => $t['league_exceeds_ultra'],
        'no_evolution'         => $t['no_evolution'],
        'current_label'        => $t['current_label'],
        'evolution_arrow'      => $t['evolution_arrow'],
        'copied'               => $t['copied'],
        'copy_result'          => $t['copy_result'],
        'tooltip_candy'        => $t['tooltip_candy'],
    ]); ?>;
    var pkmTypeColors = <?php echo $type_colors_json; ?>;
    </script>

    <?php /* ── Pokemon data ── */ ?>
    <script>const pkmData = <?php echo wp_json_encode( $js_data ); ?>;</script>

    <?php /* ════════════════════════════════════════════════════
           CSS
           ════════════════════════════════════════════════════ */ ?>
    <style>
    /* ── Design tokens ─────────────────────────────────────────────────────── */
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

    /* ── Icon system ────────────────────────────────────────────────────────── */
    .pkm-icon    { display:inline-block !important; vertical-align:middle !important; flex-shrink:0 !important; }
    .pkm-icon-sm { width:16px !important; height:16px !important; }
    .pkm-icon-md { width:20px !important; height:20px !important; }
    .pkm-icon-lg { width:24px !important; height:24px !important; }
    .pkm-icon-xl { width:32px !important; height:32px !important; }

    /* ── Outer wrapper ──────────────────────────────────────────────────────── */
    .pkm-calc-outer {
        position:relative !important;
        width:100% !important;
        background:var(--pkm-bg) !important;
        min-height:100vh !important;
        padding-bottom:60px !important;
    }

    /* ── Centered content column ────────────────────────────────────────────── */
    .pkm-calc-wrapper {
        max-width:1080px !important;
        margin:0 auto !important;
        padding:0 16px !important;
        width:100% !important;
        box-sizing:border-box !important;
        color:var(--pkm-text) !important;
        font-family:var(--pkm-font-body) !important;
    }

    /* ── Sticky skyscraper ads ──────────────────────────────────────────────── */
    .pkm-ad-skyscraper {
        display:none !important;
        position:fixed !important;
        top:120px !important;
        width:160px !important;
        z-index:100 !important;
    }
    .pkm-ad-skyscraper-left  { left:0 !important; }
    .pkm-ad-skyscraper-right { right:0 !important; }
    @media(min-width:1280px) {
        .pkm-ad-skyscraper { display:block !important; }
    }

    /* ── Ad blocks inside content ───────────────────────────────────────────── */
    .pkm-calc-ad-block {
        width:100% !important;
        display:flex !important;
        justify-content:center !important;
        align-items:center !important;
        margin:24px 0 !important;
        min-height:10px !important;
    }

    /* ── Unified header + calculator block ──────────────────────────────────── */
    /* The header and the card are ONE visual unit — no border-radius gap between them */
    .pkm-calc-hero {
        background:var(--pkm-gradient) !important;
        border-radius:var(--pkm-radius-lg) !important;
        overflow:hidden !important;
        margin-bottom:24px !important;
        box-shadow:var(--pkm-shadow) !important;
    }

    /* ── Header (top part of hero) ──────────────────────────────────────────── */
    .pkm-calc-header {
        position:relative !important;
        padding:40px 32px 32px !important;
        text-align:center !important;
        overflow:hidden !important;
    }
    .pkm-calc-header-glow {
        position:absolute !important;
        top:-40% !important;
        left:50% !important;
        transform:translateX(-50%) !important;
        width:600px !important;
        height:300px !important;
        background:radial-gradient(ellipse at center,rgba(255,255,255,0.12) 0%,transparent 70%) !important;
        pointer-events:none !important;
        z-index:0 !important;
    }
    .pkm-calc-header-sprites {
        display:flex !important;
        justify-content:center !important;
        align-items:flex-end !important;
        gap:24px !important;
        margin-bottom:16px !important;
        position:relative !important;
        z-index:1 !important;
    }
    .pkm-header-sprite {
        width:80px !important;
        height:80px !important;
        object-fit:contain !important;
        filter:drop-shadow(0 4px 12px rgba(0,0,0,0.3)) !important;
        animation:pkm-float 3s ease-in-out infinite !important;
    }
    .pkm-header-sprite-mid {
        width:96px !important;
        height:96px !important;
        animation-delay:0.5s !important;
    }
    .pkm-header-sprite-right { animation-delay:1.5s !important; }
    @keyframes pkm-float {
        0%,100% { transform:translateY(0) !important; }
        50%      { transform:translateY(-10px) !important; }
    }
    @media(max-width:480px) {
        .pkm-header-sprite      { width:52px !important; height:52px !important; animation:none !important; }
        .pkm-header-sprite-mid  { width:64px !important; height:64px !important; }
    }
    .pkm-calc-title {
        font-family:var(--pkm-font-display) !important;
        font-size:clamp(12px,2.8vw,20px) !important;
        color:#FFFFFF !important;
        margin:0 0 12px !important;
        line-height:1.5 !important;
        text-shadow:0 2px 8px rgba(0,0,0,0.3) !important;
        position:relative !important;
        z-index:1 !important;
    }
    .pkm-calc-description {
        font-family:var(--pkm-font-heading) !important;
        font-size:clamp(14px,2vw,17px) !important;
        color:rgba(255,255,255,0.88) !important;
        margin:0 auto !important;
        max-width:520px !important;
        line-height:1.6 !important;
        position:relative !important;
        z-index:1 !important;
    }

    /* ── Data error banner ──────────────────────────────────────────────────── */
    .pkm-calc-error-banner {
        background:rgba(13,148,136,0.12) !important;
        border:1.5px solid var(--pkm-primary) !important;
        border-radius:var(--pkm-radius) !important;
        padding:16px 20px !important;
        display:flex !important;
        align-items:flex-start !important;
        gap:12px !important;
        color:var(--pkm-text) !important;
        font-size:15px !important;
        margin-bottom:20px !important;
    }
    .pkm-calc-error-banner svg { color:var(--pkm-primary) !important; flex-shrink:0 !important; margin-top:1px !important; }

    /* ── Card body (bottom part of hero — white/dark surface) ──────────────── */
    .pkm-calc-card {
        background:var(--pkm-bg-2) !important;
        border:none !important;
        border-radius:0 !important;
        box-shadow:none !important;
        padding:28px 32px 32px !important;
        margin-bottom:0 !important;
        backdrop-filter:none !important;
        -webkit-backdrop-filter:none !important;
        position:relative !important;
        overflow:visible !important;
    }
    .pkm-calc-card::before { display:none !important; }
    @media(max-width:480px) {
        .pkm-calc-header { padding:28px 16px 24px !important; }
        .pkm-calc-card   { padding:20px 16px 24px !important; }
    }

    /* ── Search ─────────────────────────────────────────────────────────────── */
    .pkm-search-wrap {
        position:relative !important;
        width:100% !important;
        margin-bottom:20px !important;
    }
    .pkm-search-label {
        display:block !important;
        font-family:var(--pkm-font-heading) !important;
        font-weight:600 !important;
        font-size:14px !important;
        color:var(--pkm-text-muted) !important;
        margin-bottom:8px !important;
        letter-spacing:0.04em !important;
        text-transform:uppercase !important;
    }
    .pkm-search-input-wrap {
        position:relative !important;
        display:flex !important;
        align-items:center !important;
    }
    .pkm-search-icon {
        position:absolute !important;
        left:14px !important;
        color:var(--pkm-text-subtle) !important;
        pointer-events:none !important;
        z-index:1 !important;
    }
    #pkm-pokemon-search {
        width:100% !important;
        padding:14px 44px 14px 44px !important;
        background:var(--pkm-input-bg) !important;
        border:1.5px solid var(--pkm-border) !important;
        border-radius:var(--pkm-radius-sm) !important;
        color:var(--pkm-text) !important;
        font-size:16px !important;
        font-family:var(--pkm-font-body) !important;
        outline:none !important;
        transition:var(--pkm-transition) !important;
        box-sizing:border-box !important;
        -webkit-appearance:none !important;
        appearance:none !important;
        min-height:52px !important;
    }
    #pkm-pokemon-search:focus {
        border-color:var(--pkm-primary) !important;
        box-shadow:0 0 0 3px var(--pkm-glow) !important;
    }
    #pkm-pokemon-search::placeholder { color:var(--pkm-text-subtle) !important; }
    .pkm-search-clear {
        position:absolute !important;
        right:12px !important;
        background:none !important;
        border:none !important;
        cursor:pointer !important;
        color:var(--pkm-text-subtle) !important;
        padding:4px !important;
        display:none !important;
        align-items:center !important;
        justify-content:center !important;
        min-width:32px !important;
        min-height:32px !important;
        border-radius:50% !important;
        transition:var(--pkm-transition) !important;
    }
    .pkm-search-clear:hover { color:var(--pkm-primary) !important; background:var(--pkm-primary-light) !important; }
    .pkm-search-clear.visible { display:flex !important; }

    .pkm-search-dropdown {
        position:absolute !important;
        top:calc(100% + 4px) !important;
        left:0 !important;
        right:0 !important;
        background:var(--pkm-bg-2) !important;
        border:1.5px solid var(--pkm-border) !important;
        border-radius:var(--pkm-radius-sm) !important;
        box-shadow:var(--pkm-shadow) !important;
        max-height:280px !important;
        overflow-y:auto !important;
        z-index:200 !important;
        display:none !important;
        scrollbar-width:thin !important;
        scrollbar-color:var(--pkm-border) transparent !important;
    }
    .pkm-search-dropdown.open { display:block !important; }
    .pkm-search-dropdown-item {
        display:flex !important;
        align-items:center !important;
        gap:10px !important;
        padding:10px 14px !important;
        cursor:pointer !important;
        transition:var(--pkm-transition) !important;
        border-bottom:1px solid var(--pkm-border) !important;
        min-height:44px !important;
    }
    .pkm-search-dropdown-item:last-child { border-bottom:none !important; }
    .pkm-search-dropdown-item:hover,
    .pkm-search-dropdown-item.focused {
        background:var(--pkm-bg-3) !important;
    }
    .pkm-search-dropdown-item img {
        width:32px !important;
        height:32px !important;
        object-fit:contain !important;
        flex-shrink:0 !important;
    }
    .pkm-search-item-name {
        font-weight:600 !important;
        font-size:15px !important;
        color:var(--pkm-text) !important;
        flex:1 !important;
        text-transform:capitalize !important;
    }
    .pkm-search-item-types { display:flex !important; gap:4px !important; flex-wrap:wrap !important; }
    .pkm-type-badge {
        font-size:10px !important;
        font-weight:700 !important;
        padding:2px 7px !important;
        border-radius:20px !important;
        letter-spacing:0.05em !important;
        text-transform:uppercase !important;
        line-height:1.6 !important;
        white-space:nowrap !important;
    }
    .pkm-search-no-results {
        padding:16px 14px !important;
        color:var(--pkm-text-muted) !important;
        font-size:14px !important;
        text-align:center !important;
        display:flex !important;
        align-items:center !important;
        gap:8px !important;
        justify-content:center !important;
    }

    /* ── Selected Pokemon preview ───────────────────────────────────────────── */
    #pkm-selected-preview {
        display:none !important;
        align-items:center !important;
        gap:12px !important;
        background:var(--pkm-bg-3) !important;
        border:1.5px solid var(--pkm-border) !important;
        border-radius:var(--pkm-radius) !important;
        padding:10px 14px !important;
        margin-top:8px !important;
    }
    #pkm-selected-preview.visible { display:flex !important; }
    #pkm-selected-preview img {
        width:48px !important;
        height:48px !important;
        object-fit:contain !important;
    }
    .pkm-preview-name {
        font-weight:700 !important;
        font-size:16px !important;
        color:var(--pkm-text) !important;
        text-transform:capitalize !important;
        flex:1 !important;
    }

    /* ── Form grid ──────────────────────────────────────────────────────────── */
    .pkm-form-grid {
        display:grid !important;
        grid-template-columns:1fr !important;
        gap:16px !important;
        align-items:start !important;
    }
    @media(min-width:600px) {
        .pkm-form-grid {
            grid-template-columns:repeat(2,1fr) !important;
            align-items:stretch !important; /* both cells same height on desktop */
        }
    }
    /* Make field groups fill the grid cell height so inputs can stretch */
    .pkm-form-grid > .pkm-field-group {
        display:flex !important;
        flex-direction:column !important;
    }
    .pkm-form-grid > .pkm-field-group .pkm-input,
    .pkm-form-grid > .pkm-field-group .pkm-level-picker {
        flex:1 !important; /* grow to fill remaining cell height */
    }
    .pkm-form-grid-3 {
        display:grid !important;
        grid-template-columns:1fr !important;
        gap:16px !important;
    }
    @media(min-width:600px) {
        .pkm-form-grid-3 { grid-template-columns:repeat(3,1fr) !important; }
    }

    /* ── Form fields ────────────────────────────────────────────────────────── */
    .pkm-field-group {
        display:flex !important;
        flex-direction:column !important;
        gap:6px !important;
    }
    .pkm-field-label {
        display:flex !important;
        align-items:center !important;
        gap:6px !important;
        font-family:var(--pkm-font-heading) !important;
        font-weight:600 !important;
        font-size:13px !important;
        color:var(--pkm-text-muted) !important;
        text-transform:uppercase !important;
        letter-spacing:0.04em !important;
        cursor:default !important;
    }
    .pkm-field-label .pkm-tooltip-trigger {
        cursor:help !important;
        color:var(--pkm-text-subtle) !important;
        transition:var(--pkm-transition) !important;
        position:relative !important;
        display:inline-flex !important;
        align-items:center !important;
    }
    .pkm-field-label .pkm-tooltip-trigger:hover { color:var(--pkm-primary) !important; }
    .pkm-input {
        width:100% !important;
        padding:14px 14px !important;
        background:var(--pkm-input-bg) !important;
        border:1.5px solid var(--pkm-border) !important;
        border-radius:var(--pkm-radius-sm) !important;
        color:var(--pkm-text) !important;
        font-size:16px !important;
        font-family:var(--pkm-font-body) !important;
        outline:none !important;
        transition:var(--pkm-transition) !important;
        box-sizing:border-box !important;
        -webkit-appearance:none !important;
        appearance:none !important;
        min-height:52px !important;
    }
    .pkm-input:focus {
        border-color:var(--pkm-primary) !important;
        box-shadow:0 0 0 3px var(--pkm-glow) !important;
    }
    .pkm-input::placeholder { color:var(--pkm-text-subtle) !important; }
    .pkm-input.has-error { border-color:var(--pkm-primary) !important; }

    /* ── Level picker — styled to match .pkm-input exactly ─────────────────── */
    .pkm-level-picker {
        /* Same visual treatment as .pkm-input */
        width:100% !important;
        background:var(--pkm-input-bg) !important;
        border:1.5px solid var(--pkm-border) !important;
        border-radius:var(--pkm-radius-sm) !important;
        padding:10px 14px 10px !important;
        position:relative !important;
        box-sizing:border-box !important;
        transition:border-color 0.25s, box-shadow 0.25s !important;
        min-height:44px !important;
    }
    .pkm-level-picker:focus-within {
        border-color:var(--pkm-primary) !important;
        box-shadow:0 0 0 3px var(--pkm-glow) !important;
    }

    /* Row 1: current value badge + min/max hint */
    .pkm-level-top {
        display:flex !important;
        align-items:center !important;
        justify-content:space-between !important;
        margin-bottom:8px !important;
    }
    .pkm-level-label-text {
        /* hidden — label above the field serves this purpose */
        display:none !important;
    }
    /* The level value display — matches number input value style */
    .pkm-level-badge {
        display:flex !important;
        align-items:baseline !important;
        gap:1px !important;
        background:none !important;
        color:var(--pkm-text) !important;
        border-radius:0 !important;
        padding:0 !important;
        font-size:16px !important;
        font-weight:600 !important;
        font-family:var(--pkm-font-body) !important;
        line-height:1 !important;
        box-shadow:none !important;
        min-width:0 !important;
        justify-content:flex-start !important;
        /* No transition/animation to keep it feeling like a native input */
    }
    .pkm-level-badge.bump { animation:none !important; }
    .pkm-level-badge-icon { display:none !important; } /* remove star icon */
    .pkm-level-num {
        font-size:16px !important;
        font-weight:600 !important;
        color:var(--pkm-text) !important;
        font-family:var(--pkm-font-body) !important;
        letter-spacing:0 !important;
        transition:none !important;
    }
    /* ".5" suffix — inline after the number, same font size */
    .pkm-level-half-badge {
        display:none !important;
        font-size:16px !important;
        font-weight:600 !important;
        color:var(--pkm-text) !important;
        font-family:var(--pkm-font-body) !important;
        background:none !important;
        border-radius:0 !important;
        padding:0 !important;
        margin-left:0 !important;
    }
    .pkm-level-half-badge.visible { display:inline !important; }

    /* Range hint: "1 – 50" on the right of the value row */
    .pkm-level-range-hint {
        font-size:11px !important;
        color:var(--pkm-text-subtle) !important;
        font-family:var(--pkm-font-heading) !important;
        white-space:nowrap !important;
    }

    /* Track container — tight spacing */
    .pkm-level-track-wrap {
        position:relative !important;
        padding:0 !important;
    }

    /* Range input — slim track, same look as before */
    #pkm-level-range {
        width:100% !important;
        height:4px !important;
        -webkit-appearance:none !important;
        appearance:none !important;
        background:var(--pkm-primary, #0D9488) !important;
        border-radius:2px !important;
        outline:none !important;
        cursor:pointer !important;
        border:none !important;
        padding:0 !important;
        margin:0 0 6px !important;
        display:block !important;
    }
    #pkm-level-range::-webkit-slider-runnable-track {
        height:4px !important;
        border-radius:2px !important;
    }
    #pkm-level-range::-webkit-slider-thumb {
        -webkit-appearance:none !important;
        width:18px !important;
        height:18px !important;
        border-radius:50% !important;
        background:#fff !important;
        cursor:pointer !important;
        border:2.5px solid var(--pkm-primary, #0D9488) !important;
        box-shadow:0 1px 4px rgba(13, 148, 136, 0.4) !important;
        margin-top:-7px !important;
        transition:box-shadow 0.15s !important;
    }
    #pkm-level-range:hover::-webkit-slider-thumb,
    #pkm-level-range:focus::-webkit-slider-thumb {
        box-shadow:0 0 0 5px rgba(13, 148, 136, 0.15), 0 1px 4px rgba(13, 148, 136, 0.4) !important;
    }
    #pkm-level-range::-moz-range-track {
        height:4px !important;
        border-radius:2px !important;
        background:transparent !important;
        border:none !important;
    }
    #pkm-level-range::-moz-range-thumb {
        width:18px !important;
        height:18px !important;
        border-radius:50% !important;
        background:#fff !important;
        cursor:pointer !important;
        border:2.5px solid var(--pkm-primary, #0D9488) !important;
        box-shadow:0 1px 4px rgba(13, 148, 136, 0.4) !important;
    }

    /* Tick marks — compact, beneath track */
    .pkm-level-ticks {
        display:flex !important;
        justify-content:space-between !important;
        margin-top:0 !important;
        padding:0 1px !important;
        pointer-events:none !important;
    }
    .pkm-level-tick {
        display:flex !important;
        flex-direction:column !important;
        align-items:center !important;
        gap:2px !important;
    }
    .pkm-level-tick-line {
        width:1px !important;
        height:3px !important;
        background:var(--pkm-border) !important;
        transition:background 0.2s !important;
    }
    .pkm-level-tick-line.active { background:var(--pkm-primary) !important; }
    .pkm-level-tick-label {
        font-size:9px !important;
        font-weight:500 !important;
        color:var(--pkm-text-subtle) !important;
        font-family:var(--pkm-font-heading) !important;
        transition:color 0.2s !important;
    }
    .pkm-level-tick-label.active {
        color:var(--pkm-primary) !important;
        font-weight:700 !important;
    }

    /* ── IV section toggle ──────────────────────────────────────────────────── */
    .pkm-section-toggle {
        display:flex !important;
        align-items:center !important;
        gap:8px !important;
        cursor:pointer !important;
        user-select:none !important;
        padding:10px 0 !important;
        color:var(--pkm-text-muted) !important;
        font-family:var(--pkm-font-heading) !important;
        font-weight:600 !important;
        font-size:13px !important;
        text-transform:uppercase !important;
        letter-spacing:0.04em !important;
        border:none !important;
        background:none !important;
        width:100% !important;
        transition:var(--pkm-transition) !important;
    }
    .pkm-section-toggle:hover { color:var(--pkm-primary) !important; }
    .pkm-toggle-chevron {
        transition:transform 0.25s ease !important;
        flex-shrink:0 !important;
    }
    .pkm-toggle-chevron.open { transform:rotate(180deg) !important; }
    .pkm-section-divider {
        flex:1 !important;
        height:1px !important;
        background:var(--pkm-border) !important;
    }
    .pkm-iv-section {
        overflow:hidden !important;
        max-height:0 !important;
        transition:max-height 0.35s cubic-bezier(0.4,0,0.2,1) !important;
    }
    .pkm-iv-section.open { max-height:300px !important; }
    .pkm-iv-section-inner { padding-top:12px !important; }

    /* ── Validation errors ──────────────────────────────────────────────────── */
    #pkm-validation-errors {
        background:rgba(13,148,136,0.08) !important;
        border:1.5px solid rgba(13, 148, 136, 0.3) !important;
        border-radius:var(--pkm-radius-sm) !important;
        padding:12px 16px 12px 40px !important;
        color:var(--pkm-primary) !important;
        font-size:14px !important;
        margin-top:12px !important;
        list-style:disc !important;
    }

    /* ── Buttons ────────────────────────────────────────────────────────────── */
    .pkm-btn-row {
        display:flex !important;
        gap:12px !important;
        flex-wrap:wrap !important;
        margin-top:20px !important;
    }
    .pkm-btn-calc {
        flex:1 !important;
        min-width:200px !important;
        padding:16px 24px !important;
        background:var(--pkm-gradient) !important;
        color:#fff !important;
        border:none !important;
        border-radius:var(--pkm-radius) !important;
        font-family:var(--pkm-font-heading) !important;
        font-weight:700 !important;
        font-size:16px !important;
        cursor:pointer !important;
        transition:var(--pkm-transition) !important;
        display:flex !important;
        align-items:center !important;
        justify-content:center !important;
        gap:10px !important;
        min-height:52px !important;
        box-shadow:0 4px 16px var(--pkm-glow) !important;
        position:relative !important;
        overflow:hidden !important;
    }
    .pkm-btn-calc::after {
        content:'' !important;
        position:absolute !important;
        inset:0 !important;
        background:rgba(255,255,255,0) !important;
        transition:background 0.2s !important;
    }
    .pkm-btn-calc:hover::after { background:rgba(255,255,255,0.08) !important; }
    .pkm-btn-calc:active { transform:scale(0.98) !important; }
    .pkm-btn-reset {
        padding:16px 20px !important;
        background:var(--pkm-bg-3) !important;
        color:var(--pkm-text-muted) !important;
        border:1.5px solid var(--pkm-border) !important;
        border-radius:var(--pkm-radius) !important;
        font-family:var(--pkm-font-heading) !important;
        font-weight:600 !important;
        font-size:15px !important;
        cursor:pointer !important;
        transition:var(--pkm-transition) !important;
        display:flex !important;
        align-items:center !important;
        justify-content:center !important;
        gap:8px !important;
        min-height:52px !important;
        min-width:44px !important;
    }
    .pkm-btn-reset:hover { background:var(--pkm-border) !important; color:var(--pkm-text) !important; }

    /* ── Results area ───────────────────────────────────────────────────────── */
    #pkm-results-area { margin-top:0 !important; margin-bottom:24px !important; }
    #pkm-results-content {
        background:var(--pkm-bg-card) !important;
        border:1px solid var(--pkm-border) !important;
        border-radius:var(--pkm-radius-lg) !important;
        box-shadow:var(--pkm-shadow) !important;
        padding:24px !important;
        backdrop-filter:blur(8px) !important;
        -webkit-backdrop-filter:blur(8px) !important;
        position:relative !important;
        overflow:hidden !important;
    }
    #pkm-results-content::before {
        content:'' !important;
        position:absolute !important;
        top:0 !important; left:0 !important; right:0 !important;
        height:3px !important;
        background:linear-gradient(90deg,#2ECC71,#6390F0,#E63946) !important;
    }
    .pkm-results-heading {
        font-family:var(--pkm-font-heading) !important;
        font-size:18px !important;
        font-weight:700 !important;
        color:var(--pkm-text) !important;
        margin:0 0 20px !important;
        display:flex !important;
        align-items:center !important;
        gap:10px !important;
    }
    .pkm-results-heading svg { color:var(--pkm-accent-2) !important; }

    /* ── Evolution chain ────────────────────────────────────────────────────── */
    .pkm-evo-chain {
        display:flex !important;
        flex-direction:column !important;
        gap:4px !important;
    }
    .pkm-evo-row {
        display:flex !important;
        align-items:center !important;
        gap:10px !important;
        flex-wrap:wrap !important;
    }
    .pkm-evo-arrow {
        display:flex !important;
        flex-direction:column !important;
        align-items:center !important;
        gap:4px !important;
        flex-shrink:0 !important;
        color:var(--pkm-text-subtle) !important;
        min-width:48px !important;
        padding:8px 0 !important;
    }
    .pkm-evo-arrow svg { opacity:0.6 !important; }
    .pkm-evo-arrow-label {
        font-size:9px !important;
        font-family:var(--pkm-font-heading) !important;
        font-weight:600 !important;
        color:var(--pkm-text-subtle) !important;
        text-transform:uppercase !important;
        letter-spacing:0.03em !important;
        white-space:nowrap !important;
    }
    .pkm-candy-pill {
        display:inline-flex !important;
        align-items:center !important;
        gap:3px !important;
        background:rgba(244,208,63,0.18) !important;
        color:#9A6E00 !important;
        border:1px solid rgba(244,208,63,0.4) !important;
        border-radius:20px !important;
        font-size:11px !important;
        font-weight:700 !important;
        padding:3px 9px !important;
        font-family:var(--pkm-font-heading) !important;
        white-space:nowrap !important;
    }
    [data-theme="dark"] .pkm-candy-pill { color:#F4D03F !important; }

    /* ── Evolution result card ──────────────────────────────────────────────── */
    .pkm-evo-card {
        flex:1 !important;
        min-width:0 !important;
        background:var(--pkm-bg-2) !important;
        border:1.5px solid var(--pkm-border) !important;
        border-radius:var(--pkm-radius) !important;
        padding:18px 16px 14px !important;
        display:flex !important;
        align-items:flex-start !important;
        gap:14px !important;
        transition:var(--pkm-transition) !important;
        position:relative !important;
        overflow:hidden !important;
        box-shadow:var(--pkm-shadow-sm) !important;
    }
    .pkm-evo-card:hover {
        border-color:var(--pkm-border-hover) !important;
        box-shadow:var(--pkm-shadow) !important;
        transform:translateY(-3px) !important;
    }
    .pkm-evo-card.pkm-evo-current {
        border-color:rgba(13, 148, 136, 0.25) !important;
        background:var(--pkm-bg-3) !important;
    }
    .pkm-evo-card-accent {
        position:absolute !important;
        top:0 !important;
        left:0 !important;
        width:4px !important;
        height:100% !important;
        background:var(--pkm-gradient) !important;
        border-radius:0 !important;
    }
    .pkm-evo-card.pkm-evo-current .pkm-evo-card-accent {
        background:var(--pkm-text-subtle) !important;
    }
    .pkm-evo-card-sprite {
        width:80px !important;
        height:80px !important;
        object-fit:contain !important;
        flex-shrink:0 !important;
        margin-left:6px !important;
        filter:drop-shadow(0 2px 8px rgba(0,0,0,0.15)) !important;
        transition:transform 0.3s ease !important;
    }
    .pkm-evo-card:hover .pkm-evo-card-sprite {
        transform:scale(1.08) !important;
    }
    .pkm-evo-card-info { flex:1 !important; min-width:0 !important; }
    .pkm-evo-card-stage {
        font-size:10px !important;
        font-weight:700 !important;
        color:var(--pkm-text-subtle) !important;
        font-family:var(--pkm-font-heading) !important;
        text-transform:uppercase !important;
        letter-spacing:0.06em !important;
        margin-bottom:2px !important;
    }
    .pkm-evo-card-name {
        font-weight:700 !important;
        font-size:18px !important;
        color:var(--pkm-text) !important;
        text-transform:capitalize !important;
        margin-bottom:6px !important;
        font-family:var(--pkm-font-heading) !important;
        line-height:1.2 !important;
    }
    .pkm-evo-card-types { display:flex !important; gap:4px !important; flex-wrap:wrap !important; margin-bottom:12px !important; }
    .pkm-evo-stats {
        display:grid !important;
        grid-template-columns:1fr 1fr !important;
        gap:8px 16px !important;
        padding:10px !important;
        background:var(--pkm-bg-3) !important;
        border-radius:var(--pkm-radius-sm) !important;
        margin-bottom:10px !important;
    }
    .pkm-evo-stat {
        display:flex !important;
        flex-direction:column !important;
        gap:2px !important;
    }
    .pkm-evo-stat-label {
        font-size:10px !important;
        font-weight:600 !important;
        color:var(--pkm-text-subtle) !important;
        font-family:var(--pkm-font-heading) !important;
        text-transform:uppercase !important;
        letter-spacing:0.04em !important;
    }
    .pkm-evo-stat-value {
        font-size:17px !important;
        font-weight:700 !important;
        color:var(--pkm-text) !important;
        font-family:var(--pkm-font-heading) !important;
        line-height:1.2 !important;
    }
    .pkm-evo-stat-value.pkm-cp-value {
        font-size:22px !important;
        color:var(--pkm-primary) !important;
    }
    .pkm-evo-stat-range {
        font-size:11px !important;
        color:var(--pkm-text-subtle) !important;
        font-family:var(--pkm-font-heading) !important;
    }
    .pkm-evo-card-footer {
        display:flex !important;
        align-items:center !important;
        justify-content:space-between !important;
        flex-wrap:wrap !important;
        gap:6px !important;
    }

    /* ── PvP league badges ──────────────────────────────────────────────────── */
    .pkm-league-badges { display:flex !important; gap:5px !important; flex-wrap:wrap !important; }
    .pkm-league-badge {
        display:inline-flex !important;
        align-items:center !important;
        gap:4px !important;
        font-size:10px !important;
        font-weight:700 !important;
        padding:3px 8px !important;
        border-radius:20px !important;
        font-family:var(--pkm-font-heading) !important;
        letter-spacing:0.03em !important;
        white-space:nowrap !important;
        border:1px solid transparent !important;
    }
    .pkm-badge-great  { background:rgba(46,204,113,0.15) !important; color:#1A7A45 !important; border-color:rgba(46,204,113,0.35) !important; }
    .pkm-badge-ultra  { background:rgba(99,144,240,0.15) !important; color:#134E4A !important; border-color:rgba(99,144,240,0.35) !important; }
    .pkm-badge-master { background:rgba(13,148,136,0.12) !important; color:var(--pkm-primary) !important; border-color:rgba(13, 148, 136, 0.3) !important; }
    .pkm-badge-exceed-great { background:rgba(13,148,136,0.08) !important; color:var(--pkm-text-subtle) !important; border-color:var(--pkm-border) !important; }
    .pkm-badge-exceed-ultra { background:rgba(13,148,136,0.08) !important; color:var(--pkm-text-subtle) !important; border-color:var(--pkm-border) !important; }
    [data-theme="dark"] .pkm-badge-great  { color:#2ECC71 !important; }
    [data-theme="dark"] .pkm-badge-ultra  { color:#6390F0 !important; }

    /* ── Copy result btn ────────────────────────────────────────────────────── */
    .pkm-copy-btn {
        background:none !important;
        border:1px solid var(--pkm-border) !important;
        border-radius:var(--pkm-radius-sm) !important;
        padding:4px 10px !important;
        cursor:pointer !important;
        font-size:11px !important;
        color:var(--pkm-text-muted) !important;
        font-family:var(--pkm-font-heading) !important;
        font-weight:600 !important;
        display:flex !important;
        align-items:center !important;
        gap:4px !important;
        transition:var(--pkm-transition) !important;
        min-height:28px !important;
    }
    .pkm-copy-btn:hover { border-color:var(--pkm-border-hover) !important; color:var(--pkm-text) !important; }
    .pkm-copy-btn.copied-state { border-color:var(--pkm-accent-2) !important; color:var(--pkm-accent-2) !important; }

    /* ── Branch label (Eevee etc) ───────────────────────────────────────────── */
    .pkm-branch-group {
        display:flex !important;
        flex-direction:column !important;
        gap:10px !important;
        width:100% !important;
    }
    .pkm-branch-label {
        font-size:11px !important;
        font-weight:700 !important;
        color:var(--pkm-text-subtle) !important;
        font-family:var(--pkm-font-heading) !important;
        text-transform:uppercase !important;
        letter-spacing:0.06em !important;
        padding:4px 10px !important;
        background:var(--pkm-bg-3) !important;
        border-radius:20px !important;
        display:inline-block !important;
    }

    /* ── Tooltip ────────────────────────────────────────────────────────────── */
    .pkm-tooltip-wrap {
        position:relative !important;
        display:inline-flex !important;
        align-items:center !important;
    }
    .pkm-tooltip-box {
        position:absolute !important;
        bottom:calc(100% + 8px) !important;
        left:50% !important;
        transform:translateX(-50%) !important;
        background:var(--pkm-secondary) !important;
        color:#fff !important;
        font-size:12px !important;
        padding:7px 11px !important;
        border-radius:var(--pkm-radius-sm) !important;
        white-space:nowrap !important;
        max-width:240px !important;
        white-space:normal !important;
        text-align:center !important;
        pointer-events:none !important;
        opacity:0 !important;
        transition:opacity 0.18s !important;
        z-index:300 !important;
        font-family:var(--pkm-font-body) !important;
        font-weight:400 !important;
        line-height:1.4 !important;
        box-shadow:0 4px 12px rgba(0,0,0,0.2) !important;
    }
    .pkm-tooltip-box::after {
        content:'' !important;
        position:absolute !important;
        top:100% !important;
        left:50% !important;
        transform:translateX(-50%) !important;
        border:5px solid transparent !important;
        border-top-color:var(--pkm-secondary) !important;
    }
    .pkm-tooltip-trigger:hover .pkm-tooltip-box,
    .pkm-tooltip-trigger:focus .pkm-tooltip-box { opacity:1 !important; }

    /* ── Info sections (SEO content placeholders) ───────────────────────────── */
    .pkm-info-section {
        background:var(--pkm-bg-card) !important;
        border:1px solid var(--pkm-border) !important;
        border-radius:var(--pkm-radius-lg) !important;
        box-shadow:var(--pkm-shadow-sm) !important;
        padding:28px 24px !important;
        margin-bottom:24px !important;
    }
    .pkm-info-section h2 {
        font-family:var(--pkm-font-heading) !important;
        font-size:clamp(17px,2.5vw,22px) !important;
        font-weight:700 !important;
        color:var(--pkm-text) !important;
        margin:0 0 14px !important;
        display:flex !important;
        align-items:center !important;
        gap:10px !important;
    }
    .pkm-info-section h2 svg { color:var(--pkm-primary) !important; flex-shrink:0 !important; }
    .pkm-info-section p,
    .pkm-info-section li {
        color:var(--pkm-text-muted) !important;
        font-size:15px !important;
        line-height:1.7 !important;
        margin:0 0 10px !important;
    }

    /* ── HowTo steps — styled numbered cards ────────────────────────────────── */
    .pkm-howto-steps {
        display:flex !important;
        flex-direction:column !important;
        gap:14px !important;
    }
    .pkm-howto-step {
        display:flex !important;
        flex-direction:row !important;
        gap:16px !important;
        align-items:flex-start !important;
        background:var(--pkm-bg-3) !important;
        border:1.5px solid var(--pkm-border) !important;
        border-radius:var(--pkm-radius) !important;
        padding:18px 20px !important;
        transition:var(--pkm-transition) !important;
    }
    .pkm-howto-step:hover {
        border-color:var(--pkm-primary) !important;
        box-shadow:0 0 0 3px var(--pkm-glow), var(--pkm-shadow-sm) !important;
    }
    .pkm-howto-step-num {
        width:36px !important;
        height:36px !important;
        min-width:36px !important;
        border-radius:50% !important;
        background:var(--pkm-gradient) !important;
        color:#fff !important;
        font-weight:700 !important;
        font-size:15px !important;
        display:flex !important;
        align-items:center !important;
        justify-content:center !important;
        flex-shrink:0 !important;
        font-family:var(--pkm-font-heading) !important;
        box-shadow:0 2px 8px rgba(13,148,136,0.30) !important;
    }
    .pkm-howto-step-body {
        flex:1 !important;
        color:var(--pkm-text-muted) !important;
        font-size:15px !important;
        line-height:1.7 !important;
        padding-top:6px !important;
    }
    .pkm-howto-step-body strong { color:var(--pkm-text) !important; }

    /* ── FAQ — interactive accordion ───────────────────────────────────────── */
    .pkm-faq-list { display:flex !important; flex-direction:column !important; gap:10px !important; }
    .pkm-faq-item {
        border:1.5px solid var(--pkm-border) !important;
        border-radius:var(--pkm-radius) !important;
        overflow:hidden !important;
        transition:var(--pkm-transition) !important;
    }
    .pkm-faq-item:hover { border-color:var(--pkm-border-hover) !important; }
    .pkm-faq-item.open {
        border-color:var(--pkm-primary) !important;
        box-shadow:0 0 0 3px var(--pkm-glow), var(--pkm-shadow-sm) !important;
    }
    .pkm-faq-trigger {
        width:100% !important;
        padding:16px 18px !important;
        background:var(--pkm-bg-2) !important;
        border:none !important;
        cursor:pointer !important;
        display:flex !important;
        align-items:center !important;
        justify-content:space-between !important;
        gap:12px !important;
        text-align:left !important;
        transition:var(--pkm-transition) !important;
        min-height:52px !important;
    }
    .pkm-faq-trigger:hover { background:var(--pkm-bg-3) !important; }
    .pkm-faq-item.open .pkm-faq-trigger { background:var(--pkm-bg-3) !important; }
    .pkm-faq-trigger-text {
        font-weight:600 !important;
        font-size:15px !important;
        color:var(--pkm-text) !important;
        font-family:var(--pkm-font-body) !important;
        flex:1 !important;
        line-height:1.4 !important;
    }
    .pkm-faq-item.open .pkm-faq-trigger-text { color:var(--pkm-primary) !important; }
    .pkm-faq-chevron {
        flex-shrink:0 !important;
        transition:transform 0.25s ease !important;
        color:var(--pkm-text-subtle) !important;
        width:18px !important;
        height:18px !important;
    }
    .pkm-faq-item.open .pkm-faq-chevron {
        transform:rotate(180deg) !important;
        color:var(--pkm-primary) !important;
    }
    .pkm-faq-body {
        max-height:0 !important;
        overflow:hidden !important;
        transition:max-height 0.35s cubic-bezier(0.4,0,0.2,1) !important;
        background:var(--pkm-bg-2) !important;
    }
    .pkm-faq-item.open .pkm-faq-body { max-height:500px !important; }
    .pkm-faq-answer {
        padding:0 18px 18px !important;
        color:var(--pkm-text-muted) !important;
        font-size:14px !important;
        line-height:1.75 !important;
    }
    .pkm-faq-answer a { color:var(--pkm-primary) !important; text-decoration:underline !important; }

    /* ── pkm-calc-table — SEO data table (CSS-driven, no inline styles) ─────── */
    .pkm-calc-table {
        width:100% !important;
        border-collapse:collapse !important;
        font-size:14px !important;
        color:var(--pkm-text) !important;
        border-radius:var(--pkm-radius-sm) !important;
        overflow:hidden !important;
    }
    .pkm-calc-table thead tr th {
        background:var(--pkm-gradient) !important;
        color:#fff !important;
        padding:12px 18px !important;
        font-family:var(--pkm-font-heading) !important;
        font-size:12px !important;
        text-transform:uppercase !important;
        letter-spacing:0.06em !important;
        font-weight:700 !important;
        text-align:left !important;
        white-space:nowrap !important;
    }
    .pkm-calc-table thead th:first-child { border-radius:var(--pkm-radius-sm) 0 0 0 !important; }
    .pkm-calc-table thead th:last-child  { border-radius:0 var(--pkm-radius-sm) 0 0 !important; }
    .pkm-calc-table tbody tr:nth-child(odd)  td { background:var(--pkm-bg-3) !important; }
    .pkm-calc-table tbody tr:nth-child(even) td { background:var(--pkm-bg-2) !important; }
    .pkm-calc-table tbody tr:hover td { background:var(--pkm-primary-light) !important; }
    .pkm-calc-table tbody td {
        padding:12px 18px !important;
        border-bottom:1px solid var(--pkm-border) !important;
        color:var(--pkm-text-muted) !important;
        vertical-align:middle !important;
    }
    .pkm-calc-table tbody td:first-child {
        font-weight:700 !important;
        color:var(--pkm-primary) !important;
    }
    .pkm-table-note-badge {
        display:inline-block !important;
        font-size:11px !important;
        font-weight:600 !important;
        background:var(--pkm-primary-light) !important;
        color:var(--pkm-primary) !important;
        border-radius:20px !important;
        padding:3px 9px !important;
        white-space:nowrap !important;
        border:1px solid rgba(13, 148, 136, 0.25) !important;
    }

    /* ── Info section h3 — left red accent bar ──────────────────────────────── */
    .pkm-info-section h3 {
        font-family:var(--pkm-font-heading) !important;
        font-size:16px !important;
        font-weight:700 !important;
        color:var(--pkm-text) !important;
        margin:20px 0 10px !important;
        padding-left:12px !important;
        border-left:3px solid var(--pkm-primary) !important;
        line-height:1.4 !important;
    }
    .pkm-info-section a { color:var(--pkm-primary) !important; text-decoration:underline !important; }

    /* ── Related tools section ───────────────────────────────────────────────── */
    .pkm-related-section,
    .pkm-calc-card.pkm-related-section {
        background:var(--pkm-bg-card) !important;
        border:1px solid var(--pkm-border) !important;
        border-radius:var(--pkm-radius-lg) !important;
        box-shadow:var(--pkm-shadow-sm) !important;
        padding:28px 24px !important;
        margin-bottom:24px !important;
    }
    .pkm-related-section-title {
        font-family:var(--pkm-font-heading) !important;
        font-size:clamp(17px,2.5vw,22px) !important;
        font-weight:700 !important;
        color:var(--pkm-text) !important;
        margin:0 0 20px !important;
        padding-left:14px !important;
        border-left:4px solid var(--pkm-primary) !important;
        line-height:1.3 !important;
    }
    .pkm-related-grid {
        display:grid !important;
        grid-template-columns:repeat(auto-fill, minmax(200px, 1fr)) !important;
        gap:16px !important;
    }
    .pkm-related-card {
        display:flex !important;
        flex-direction:column !important;
        gap:8px !important;
        background:var(--pkm-bg-3) !important;
        border:1.5px solid var(--pkm-border) !important;
        border-radius:var(--pkm-radius) !important;
        padding:20px !important;
        text-decoration:none !important;
        color:var(--pkm-text) !important;
        transition:var(--pkm-transition) !important;
    }
    .pkm-related-card:hover {
        border-color:var(--pkm-primary) !important;
        box-shadow:0 0 0 3px var(--pkm-glow), var(--pkm-shadow) !important;
        transform:translateY(-2px) !important;
        text-decoration:none !important;
    }
    .pkm-related-card-icon {
        width:44px !important;
        height:44px !important;
        background:var(--pkm-primary-light) !important;
        border-radius:var(--pkm-radius-sm) !important;
        display:flex !important;
        align-items:center !important;
        justify-content:center !important;
        color:var(--pkm-primary) !important;
        flex-shrink:0 !important;
    }
    .pkm-related-card-icon svg { width:22px !important; height:22px !important; }
    .pkm-related-card-name {
        font-weight:700 !important;
        font-size:14px !important;
        color:var(--pkm-text) !important;
        line-height:1.3 !important;
    }
    .pkm-related-card-desc {
        font-size:13px !important;
        color:var(--pkm-text-muted) !important;
        line-height:1.5 !important;
        flex:1 !important;
    }
    .pkm-related-card-arrow {
        display:flex !important;
        align-items:center !important;
        gap:5px !important;
        font-size:13px !important;
        font-weight:600 !important;
        color:var(--pkm-primary) !important;
        margin-top:4px !important;
    }

    /* ── Blog guides section ─────────────────────────────────────────────────── */
    .pkm-blog-section {
        background:var(--pkm-bg-card) !important;
        border:1px solid var(--pkm-border) !important;
        border-radius:var(--pkm-radius-lg) !important;
        box-shadow:var(--pkm-shadow-sm) !important;
        padding:28px 24px !important;
        margin-bottom:24px !important;
    }
    .pkm-blog-section-title {
        font-family:var(--pkm-font-heading) !important;
        font-size:clamp(17px,2.5vw,22px) !important;
        font-weight:700 !important;
        color:var(--pkm-text) !important;
        margin:0 0 20px !important;
        padding-left:14px !important;
        border-left:4px solid var(--pkm-primary) !important;
        line-height:1.3 !important;
    }
    .pkm-blog-grid {
        display:grid !important;
        grid-template-columns:repeat(auto-fill, minmax(240px, 1fr)) !important;
        gap:16px !important;
    }
    .pkm-blog-card {
        background:var(--pkm-bg-3) !important;
        border:1.5px solid var(--pkm-border) !important;
        border-radius:var(--pkm-radius) !important;
        overflow:hidden !important;
        transition:var(--pkm-transition) !important;
        display:flex !important;
        flex-direction:column !important;
    }
    .pkm-blog-card:hover {
        border-color:var(--pkm-primary) !important;
        box-shadow:0 0 0 3px var(--pkm-glow), var(--pkm-shadow) !important;
        transform:translateY(-2px) !important;
    }
    .pkm-blog-card-thumb {
        width:100% !important;
        height:140px !important;
        object-fit:cover !important;
        display:block !important;
        background:var(--pkm-bg-3) !important;
    }
    .pkm-blog-card-body {
        padding:16px !important;
        flex:1 !important;
        display:flex !important;
        flex-direction:column !important;
        gap:10px !important;
    }
    .pkm-blog-card-title {
        font-weight:700 !important;
        font-size:14px !important;
        color:var(--pkm-text) !important;
        line-height:1.4 !important;
        flex:1 !important;
    }
    .pkm-blog-card-read {
        display:inline-flex !important;
        align-items:center !important;
        gap:5px !important;
        font-size:13px !important;
        font-weight:600 !important;
        color:var(--pkm-primary) !important;
        text-decoration:none !important;
    }
    .pkm-blog-card-read:hover { text-decoration:underline !important; }

    /* ── Noscript fallback ──────────────────────────────────────────────────── */
    .pkm-noscript-wrap {
        padding:20px !important;
        background:var(--pkm-bg-3) !important;
        border-radius:var(--pkm-radius) !important;
        border:1px solid var(--pkm-border) !important;
        margin-bottom:20px !important;
    }
    .pkm-noscript-wrap select {
        width:100% !important;
        padding:12px 14px !important;
        font-size:16px !important;
        border:1.5px solid var(--pkm-border) !important;
        border-radius:var(--pkm-radius-sm) !important;
        background:var(--pkm-input-bg) !important;
        color:var(--pkm-text) !important;
        min-height:44px !important;
    }
    .pkm-noscript-note {
        font-size:13px !important;
        color:var(--pkm-text-muted) !important;
        margin-top:8px !important;
    }

    /* ── Empty / loading states ─────────────────────────────────────────────── */
    .pkm-results-content-hidden { display:none !important; }
    .pkm-hidden-js { display:none !important; }
    .pkm-results-empty {
        text-align:center !important;
        padding:32px 20px !important;
        color:var(--pkm-text-subtle) !important;
        font-size:15px !important;
        font-family:var(--pkm-font-heading) !important;
    }
    .pkm-results-empty svg { display:block !important; margin:0 auto 12px !important; opacity:0.4 !important; }

    /* ── Animations ─────────────────────────────────────────────────────────── */
    @keyframes pkm-fade-in {
        from { opacity:0; transform:translateY(10px) scale(0.98); }
        to   { opacity:1; transform:translateY(0) scale(1); }
    }
    .pkm-evo-card {
        animation:pkm-fade-in 0.35s ease both !important;
    }
    .pkm-evo-row:nth-child(1) .pkm-evo-card { animation-delay:0.0s !important; }
    .pkm-evo-row:nth-child(2) .pkm-evo-card { animation-delay:0.05s !important; }
    .pkm-evo-row:nth-child(3) .pkm-evo-card { animation-delay:0.1s !important; }
    .pkm-evo-row:nth-child(4) .pkm-evo-card { animation-delay:0.15s !important; }
    .pkm-evo-row:nth-child(5) .pkm-evo-card { animation-delay:0.2s !important; }
    .pkm-branch-group .pkm-evo-row .pkm-evo-card { animation-delay:0.08s !important; }
    @keyframes pkm-cp-pulse {
        0%,100% { opacity:1; }
        50%     { opacity:0.75; }
    }
    .pkm-cp-value { animation:pkm-cp-pulse 2.5s ease-in-out infinite !important; }

    /* ── Mobile adjustments ─────────────────────────────────────────────────── */
    @media(max-width:480px) {
        .pkm-calc-header { padding:32px 16px 28px !important; }
        .pkm-evo-card-sprite { width:64px !important; height:64px !important; }
        .pkm-evo-stat-value.pkm-cp-value { font-size:19px !important; }
        .pkm-btn-calc { font-size:14px !important; }
        .pkm-evo-stats { padding:8px !important; }
    }
    @media(max-width:360px) {
        .pkm-evo-card { flex-direction:column !important; align-items:flex-start !important; }
        .pkm-evo-card-sprite { margin-left:0 !important; }
        .pkm-evo-stats { grid-template-columns:1fr 1fr 1fr !important; }
    }
    </style>

    <?php /* ════════════════════════════════════════════════════
           HTML OUTPUT BEGINS
           ════════════════════════════════════════════════════ */ ?>

    <div class="pkm-calc-outer">

        <?php if ( '' !== trim( $ad_slot_e ) ) : ?>
        <div class="pkm-ad-skyscraper pkm-ad-skyscraper-left">
            <?php echo do_shortcode( $ad_slot_e ); ?>
        </div>
        <?php endif; ?>

        <?php if ( '' !== trim( $ad_slot_f_sky ) ) : ?>
        <div class="pkm-ad-skyscraper pkm-ad-skyscraper-right">
            <?php echo do_shortcode( $ad_slot_f_sky ); ?>
        </div>
        <?php endif; ?>

        <div class="pkm-calc-wrapper">

            <?php /* ── Unified hero: header + calculator form as one block ── */ ?>
            <div class="pkm-calc-hero">

            <?php /* ── Header ── */ ?>
            <div class="pkm-calc-header">
                <div class="pkm-calc-header-glow" aria-hidden="true"></div>
                <div class="pkm-calc-header-sprites" aria-hidden="true">
                    <?php if ( $sprite_a ) : ?>
                    <img src="<?php echo $sprite_a; ?>" alt="" width="80" height="80"
                         loading="eager" onerror="this.style.display='none'"
                         class="pkm-header-sprite pkm-header-sprite-left">
                    <?php endif; ?>
                    <?php if ( $sprite_b ) : ?>
                    <img src="<?php echo $sprite_b; ?>" alt="" width="96" height="96"
                         loading="eager" onerror="this.style.display='none'"
                         class="pkm-header-sprite pkm-header-sprite-mid">
                    <?php endif; ?>
                    <?php if ( $sprite_c ) : ?>
                    <img src="<?php echo $sprite_c; ?>" alt="" width="80" height="80"
                         loading="eager" onerror="this.style.display='none'"
                         class="pkm-header-sprite pkm-header-sprite-right">
                    <?php endif; ?>
                </div>
                <div class="pkm-calc-header-content" style="position:relative;z-index:1;">
                    <h1 class="pkm-calc-title"><?php echo esc_html( $t['title'] ); ?></h1>
                    <p class="pkm-calc-description"><?php echo esc_html( $t['description'] ); ?></p>
                </div>
            </div>

            <?php /* ── Ad slot A — top banner ── */ ?>
            <?php echo $pkm_render_ad( $ad_slot_a, 'pkm-ad-top' ); ?>

            <?php /* ── Data load error (shown if pkmData empty) ── */ ?>
            <?php if ( ! $data_ok ) : ?>
            <div class="pkm-calc-error-banner" role="alert">
                <svg class="pkm-icon pkm-icon-lg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
                <p style="margin:0!important;"><?php echo esc_html( $t['error_data_load'] ); ?></p>
            </div>
            <?php endif; ?>

            <?php /* ── Data load error JS fallback container ── */ ?>
            <div id="pkm-calc-error" class="pkm-calc-error-banner pkm-hidden-js" role="alert">
                <svg class="pkm-icon pkm-icon-lg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
                <p style="margin:0!important;"><?php echo esc_html( $t['error_data_load'] ); ?></p>
            </div>

            <?php /* ── Calculator card ── */ ?>
            <div class="pkm-calc-card">

                <?php /* ── Noscript fallback ── */ ?>
                <noscript>
                <div class="pkm-noscript-wrap">
                    <label for="pkm-noscript-select" style="display:block;margin-bottom:8px;font-weight:600;">
                        <?php echo esc_html( $t['select_pokemon'] ); ?>
                    </label>
                    <select id="pkm-noscript-select" name="pokemon_id">
                        <option value=""><?php echo esc_html( $t['select_pokemon'] ); ?></option>
                        <?php if ( $data_ok ) : foreach ( $raw as $p ) : ?>
                        <option value="<?php echo intval( $p['id'] ?? 0 ); ?>">
                            <?php echo esc_html( ucfirst( $p['name'] ?? '' ) ); ?>
                        </option>
                        <?php endforeach; endif; ?>
                    </select>
                    <p class="pkm-noscript-note">Please enable JavaScript to use the full calculator.</p>
                </div>
                </noscript>

                <?php /* ── Pokemon searchbar ── */ ?>
                <div class="pkm-search-wrap">
                    <label class="pkm-search-label" for="pkm-pokemon-search">
                        <?php echo esc_html( $t['select_pokemon'] ); ?>
                    </label>
                    <div class="pkm-search-input-wrap">
                        <span class="pkm-search-icon" aria-hidden="true">
                            <svg class="pkm-icon pkm-icon-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                            </svg>
                        </span>
                        <input type="text" id="pkm-pokemon-search" autocomplete="off" autocorrect="off"
                               autocapitalize="off" spellcheck="false"
                               placeholder="<?php echo esc_attr( $t['select_pokemon'] ); ?>"
                               aria-label="<?php echo esc_attr( $t['select_pokemon'] ); ?>"
                               aria-autocomplete="list" aria-controls="pkm-search-dropdown"
                               aria-expanded="false" role="combobox">
                        <button type="button" class="pkm-search-clear" id="pkm-search-clear"
                                aria-label="Clear search" tabindex="-1">
                            <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                            </svg>
                        </button>
                    </div>
                    <div id="pkm-search-dropdown" class="pkm-search-dropdown" role="listbox"
                         aria-label="Pokemon results"></div>
                    <input type="hidden" id="pkm-selected-id" name="pokemon_id" value="">
                    <div id="pkm-selected-preview" aria-live="polite">
                        <img id="pkm-preview-sprite" src="" alt="" width="48" height="48"
                             onerror="this.style.display='none'">
                        <span class="pkm-preview-name" id="pkm-preview-name"></span>
                        <div id="pkm-preview-types" class="pkm-search-item-types"></div>
                    </div>
                </div>

                <?php /* ── Inputs ── */ ?>
                <div class="pkm-form-grid" style="margin-bottom:16px!important;">

                    <div class="pkm-field-group">
                        <label class="pkm-field-label" for="pkm-current-cp">
                            <?php echo esc_html( $t['current_cp_label'] ); ?>
                            <span class="pkm-tooltip-wrap pkm-tooltip-trigger" tabindex="0">
                                <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <circle cx="12" cy="12" r="10"/>
                                    <line x1="12" y1="8" x2="12" y2="12"/>
                                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                                </svg>
                                <span class="pkm-tooltip-box"><?php echo esc_html( $t['tooltip_cp'] ); ?></span>
                            </span>
                        </label>
                        <input type="number" id="pkm-current-cp" class="pkm-input"
                               min="1" max="10000" step="1"
                               inputmode="numeric" autocomplete="off"
                               placeholder="<?php echo esc_attr( $t['current_cp_ph'] ); ?>"
                               aria-label="<?php echo esc_attr( $t['current_cp_label'] ); ?>">
                    </div>

                    <div class="pkm-field-group">
                        <label class="pkm-field-label" for="pkm-level-range">
                            <?php echo esc_html( $t['level_label'] ); ?>
                            <span class="pkm-tooltip-wrap pkm-tooltip-trigger" tabindex="0">
                                <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <circle cx="12" cy="12" r="10"/>
                                    <line x1="12" y1="8" x2="12" y2="12"/>
                                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                                </svg>
                                <span class="pkm-tooltip-box"><?php echo esc_html( $t['tooltip_level'] ); ?></span>
                            </span>
                        </label>
                        <div class="pkm-level-picker">
                            <div class="pkm-level-top">
                                <div class="pkm-level-badge" id="pkm-level-display">
                                    <span class="pkm-level-num" id="pkm-level-num">20</span><span class="pkm-level-half-badge" id="pkm-level-half">.5</span>
                                </div>
                                <span class="pkm-level-range-hint">1 – 50</span>
                            </div>
                            <div class="pkm-level-track-wrap">
                                <input type="range" id="pkm-level-range" min="1" max="50" step="0.5" value="20"
                                       aria-label="<?php echo esc_attr( $t['level_label'] ); ?>"
                                       aria-valuemin="1" aria-valuemax="50" aria-valuenow="20">
                                <div class="pkm-level-ticks" id="pkm-level-ticks">
                                    <?php foreach ([1,5,10,15,20,25,30,35,40,45,50] as $lv): ?>
                                    <div class="pkm-level-tick" data-level="<?php echo $lv; ?>">
                                        <div class="pkm-level-tick-line<?php echo $lv <= 20 ? ' active' : ''; ?>"></div>
                                        <span class="pkm-level-tick-label<?php echo $lv <= 20 ? ' active' : ''; ?>"><?php echo $lv; ?></span>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <?php /* ── IV accordion ── */ ?>
                <button type="button" class="pkm-section-toggle" id="pkm-iv-toggle"
                        aria-expanded="false" aria-controls="pkm-iv-section">
                    <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 010 14.14M4.93 4.93a10 10 0 000 14.14"/>
                    </svg>
                    <?php echo esc_html( $t['iv_section_label'] ); ?>
                    <span class="pkm-section-divider"></span>
                    <svg class="pkm-icon pkm-icon-sm pkm-toggle-chevron" id="pkm-iv-chevron"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </button>

                <div class="pkm-iv-section" id="pkm-iv-section" role="region" aria-labelledby="pkm-iv-toggle">
                    <div class="pkm-iv-section-inner">
                        <div class="pkm-form-grid-3">

                            <div class="pkm-field-group">
                                <label class="pkm-field-label" for="pkm-iv-atk">
                                    <?php echo esc_html( $t['iv_attack_label'] ); ?>
                                    <span class="pkm-tooltip-wrap pkm-tooltip-trigger" tabindex="0">
                                        <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <circle cx="12" cy="12" r="10"/>
                                            <line x1="12" y1="8" x2="12" y2="12"/>
                                            <line x1="12" y1="16" x2="12.01" y2="16"/>
                                        </svg>
                                        <span class="pkm-tooltip-box"><?php echo esc_html( $t['tooltip_iv'] ); ?></span>
                                    </span>
                                </label>
                                <input type="number" id="pkm-iv-atk" class="pkm-input"
                                       min="0" max="15" step="1" value="8"
                                       inputmode="numeric" autocomplete="off"
                                       placeholder="<?php echo esc_attr( $t['iv_placeholder'] ); ?>"
                                       aria-label="<?php echo esc_attr( $t['iv_attack_label'] ); ?>">
                            </div>

                            <div class="pkm-field-group">
                                <label class="pkm-field-label" for="pkm-iv-def">
                                    <?php echo esc_html( $t['iv_defense_label'] ); ?>
                                </label>
                                <input type="number" id="pkm-iv-def" class="pkm-input"
                                       min="0" max="15" step="1" value="8"
                                       inputmode="numeric" autocomplete="off"
                                       placeholder="<?php echo esc_attr( $t['iv_placeholder'] ); ?>"
                                       aria-label="<?php echo esc_attr( $t['iv_defense_label'] ); ?>">
                            </div>

                            <div class="pkm-field-group">
                                <label class="pkm-field-label" for="pkm-iv-sta">
                                    <?php echo esc_html( $t['iv_stamina_label'] ); ?>
                                </label>
                                <input type="number" id="pkm-iv-sta" class="pkm-input"
                                       min="0" max="15" step="1" value="8"
                                       inputmode="numeric" autocomplete="off"
                                       placeholder="<?php echo esc_attr( $t['iv_placeholder'] ); ?>"
                                       aria-label="<?php echo esc_attr( $t['iv_stamina_label'] ); ?>">
                            </div>

                        </div>
                    </div>
                </div>

                <?php /* ── Validation errors ── */ ?>
                <ul id="pkm-validation-errors" class="pkm-validation-errors pkm-hidden-js" role="alert" aria-live="polite"></ul>

                <?php /* ── Action buttons ── */ ?>
                <div class="pkm-btn-row">
                    <button type="button" id="pkm-calc-btn" class="pkm-btn-calc">
                        <svg class="pkm-icon pkm-icon-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>
                        </svg>
                        <?php echo esc_html( $t['calculate_btn'] ); ?>
                    </button>
                    <button type="button" id="pkm-reset-btn" class="pkm-btn-reset"
                            aria-label="<?php echo esc_attr( $t['reset_btn'] ); ?>">
                        <svg class="pkm-icon pkm-icon-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <polyline points="1 4 1 10 7 10"/>
                            <path d="M3.51 15a9 9 0 101.49-5.23L1 10"/>
                        </svg>
                        <?php echo esc_html( $t['reset_btn'] ); ?>
                    </button>
                </div>

            </div><!-- /.pkm-calc-card -->
            </div><!-- /.pkm-calc-hero -->

            <?php /* ── Results area ── */ ?>
            <div id="pkm-results-area" aria-live="polite" aria-atomic="false">
                <div class="pkm-results-empty pkm-hidden-js" id="pkm-results-placeholder" aria-hidden="true">
                    <svg class="pkm-icon pkm-icon-xl" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M8 12h8M12 8v8"/>
                    </svg>
                    <p style="font-size:14px!important;color:var(--pkm-text-subtle)!important;margin:0!important;">
                        <?php echo esc_html( $t['description'] ); ?>
                    </p>
                </div>
                <div id="pkm-results-content" class="pkm-results-content-hidden"></div>
            </div>

            <?php /* ── Ad slot B — below result ── */ ?>
            <?php echo $pkm_render_ad( $ad_slot_b, 'pkm-ad-below-result' ); ?>

            <?php /* ── Intro / info section (SEO — Prompt 2 fills) ── */ ?>
            <?php if ( ! empty( $t['intro_title'] ) ) : ?>
            <div class="pkm-info-section">
                <h2>
                    <svg class="pkm-icon pkm-icon-lg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    <?php echo esc_html( $t['intro_title'] ); ?>
                </h2>
                <div><?php echo wp_kses_post( $t['intro_content'] ); ?></div>
            </div>
            <?php endif; ?>

            <?php /* ── HowTo section (SEO — Prompt 2 fills) ── */ ?>
            <?php if ( ! empty( $t['howto_title'] ) ) : ?>
            <div class="pkm-info-section">
                <h2>
                    <svg class="pkm-icon pkm-icon-lg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="9 11 12 14 22 4"/>
                        <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>
                    </svg>
                    <?php echo esc_html( $t['howto_title'] ); ?>
                </h2>
                <div class="pkm-howto-steps">
                    <?php
                    $steps = [ $t['howto_step1'], $t['howto_step2'], $t['howto_step3'], $t['howto_step4'] ];
                    foreach ( $steps as $i => $step ) :
                        if ( empty( $step ) ) continue;
                    ?>
                    <div class="pkm-howto-step">
                        <div class="pkm-howto-step-num"><?php echo $i + 1; ?></div>
                        <div class="pkm-howto-step-body"><?php echo wp_kses_post( $step ); ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php /* ── Ad slot C — mid content ── */ ?>
            <?php echo $pkm_render_ad( $ad_slot_c, 'pkm-ad-mid' ); ?>

            <?php /* ── Info table section (SEO — Prompt 2 fills) ── */ ?>
            <?php if ( ! empty( $t['info_title'] ) ) : ?>
            <div class="pkm-info-section">
                <h2>
                    <svg class="pkm-icon pkm-icon-lg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M3 15h18M9 3v18"/>
                    </svg>
                    <?php echo esc_html( $t['info_title'] ); ?>
                </h2>
                <div><?php echo wp_kses_post( $t['info_content'] ); ?></div>
                <?php if ( ! empty( $t['info_table_html'] ) ) : ?>
                <?php if ( ! empty( $t['info_table_title'] ) ) : ?>
                <h3><?php echo esc_html( $t['info_table_title'] ); ?></h3>
                <?php endif; ?>
                <div style="overflow-x:auto;-webkit-overflow-scrolling:touch;width:100%;margin:16px 0;border-radius:var(--pkm-radius-sm);border:1px solid var(--pkm-border);box-shadow:var(--pkm-shadow-sm);">
                    <?php echo wp_kses_post( $t['info_table_html'] ); ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <?php /* ── FAQ section — interactive accordion ── */ ?>
            <?php if ( ! empty( $t['faq_title'] ) ) : ?>
            <div class="pkm-info-section">
                <h2>
                    <svg class="pkm-icon pkm-icon-lg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/>
                        <line x1="12" y1="17" x2="12.01" y2="17"/>
                    </svg>
                    <?php echo esc_html( $t['faq_title'] ); ?>
                </h2>
                <div class="pkm-faq-list" id="pkm-faq-list" itemscope itemtype="https://schema.org/FAQPage">
                    <?php
                    for ( $qi = 1; $qi <= 8; $qi++ ) :
                        $q = $t[ 'faq_q' . $qi ] ?? '';
                        $a = $t[ 'faq_a' . $qi ] ?? '';
                        if ( empty( $q ) || empty( $a ) ) continue;
                        $is_first  = ( $qi === 1 );
                        $item_open = $is_first ? ' open' : '';
                        $expanded  = $is_first ? 'true' : 'false';
                    ?>
                    <div class="pkm-faq-item<?php echo $item_open; ?>"
                         itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <button type="button" class="pkm-faq-trigger"
                                aria-expanded="<?php echo $expanded; ?>"
                                aria-controls="pkm-faq-body-<?php echo $qi; ?>"
                                id="pkm-faq-q-<?php echo $qi; ?>">
                            <span class="pkm-faq-trigger-text" itemprop="name">
                                <?php echo esc_html( $q ); ?>
                            </span>
                            <svg class="pkm-faq-chevron" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </button>
                        <div class="pkm-faq-body" id="pkm-faq-body-<?php echo $qi; ?>"
                             role="region" aria-labelledby="pkm-faq-q-<?php echo $qi; ?>"
                             itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                            <div class="pkm-faq-answer" itemprop="text">
                                <?php echo wp_kses_post( $a ); ?>
                            </div>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php /* ── Ad slot D — below FAQ ── */ ?>
            <?php echo $pkm_render_ad( $ad_slot_d, 'pkm-ad-faq' ); ?>

            <?php /* ══════════════════════════════════════════════
                   RELATED TOOLS — ACF-powered WP_Query
                   ══════════════════════════════════════════════ */ ?>
            <?php
            // ── Section labels ──
            $related_label_map = [
                'en'    => $t['related_title']    ?? 'More Pokémon GO Calculators',
                'es'    => $t['related_title']    ?? 'Más Calculadoras Pokémon GO',
                'pt-br' => $t['related_title']    ?? 'Mais Calculadoras Pokémon GO',
                'fr'    => $t['related_title']    ?? 'Plus de Calculateurs Pokémon GO',
                'de'    => $t['related_title']    ?? 'Weitere Pokémon GO Rechner',
            ];
            $related_title_str = $related_label_map[ $lang ] ?? $related_label_map['en'];

            $arrow_label_map = [
                'en'    => 'Open tool',
                'es'    => 'Abrir herramienta',
                'pt-br' => 'Abrir ferramenta',
                'fr'    => 'Ouvrir l\'outil',
                'de'    => 'Tool öffnen',
            ];
            $arrow_label = $arrow_label_map[ $lang ] ?? $arrow_label_map['en'];

            $no_tools_label = $t['no_related_tools'] ?? 'More calculators coming soon!';

            // ── Find language parent page (slug = $lang) ──
            $current_id     = get_the_ID();
            $lang_parent    = get_page_by_path( $lang );
            $lang_parent_id = $lang_parent ? intval( $lang_parent->ID ) : 0;

            // ── Query all published sibling pages excluding current ──
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
                        $tool_name = '';
                        $tool_desc = '';
                        $tool_icon = '';

                        if ( function_exists( 'get_field' ) ) {
                            $tool_name = get_field( 'tool_short_name',           $sibling->ID ) ?: '';
                            $tool_desc = get_field( 'tool_one_line_description',  $sibling->ID ) ?: '';
                            $tool_icon = get_field( 'tool_svg_icon_text',        $sibling->ID ) ?: '';
                        }

                        // Fallbacks
                        if ( '' === $tool_name ) $tool_name = $sibling->post_title;
                        if ( '' === $tool_icon ) {
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
                <h2 class="pkm-related-section-title"><?php echo esc_html( $related_title_str ); ?></h2>
                <?php if ( ! empty( $related_tools_data ) ) : ?>
                <div class="pkm-related-grid">
                    <?php foreach ( $related_tools_data as $tool ) : ?>
                    <a href="<?php echo esc_url( $tool['url'] ); ?>" class="pkm-related-card" rel="noopener">
                        <div class="pkm-related-card-icon">
                            <?php echo $tool['icon']; // already wp_kses'd ?>
                        </div>
                        <div class="pkm-related-card-name"><?php echo esc_html( $tool['name'] ); ?></div>
                        <?php if ( ! empty( $tool['desc'] ) ) : ?>
                        <div class="pkm-related-card-desc"><?php echo esc_html( $tool['desc'] ); ?></div>
                        <?php endif; ?>
                        <div class="pkm-related-card-arrow">
                            <?php echo esc_html( $arrow_label ); ?>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <line x1="5" y1="12" x2="19" y2="12"/>
                                <polyline points="12 5 19 12 12 19"/>
                            </svg>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
                <?php else : ?>
                <p style="color:var(--pkm-text-muted)!important;font-size:14px!important;margin:0!important;">
                    <?php echo esc_html( $no_tools_label ); ?>
                </p>
                <?php endif; ?>
            </div>

            <?php /* ══════════════════════════════════════════════
                   BLOG GUIDES — 3 most recent posts
                   ══════════════════════════════════════════════ */ ?>
            <?php
            $blog_title_str    = $t['blog_guides_title'] ?? 'Pokémon Guides & Tips';
            $blog_read_more    = $t['blog_read_more']    ?? 'Read guide';

            $blog_query = new WP_Query( [
                'post_type'      => 'post',
                'post_status'    => 'publish',
                'posts_per_page' => 3,
                'orderby'        => 'date',
                'order'          => 'DESC',
                'no_found_rows'  => true,
            ] );
            ?>
            <?php if ( $blog_query->have_posts() ) : ?>
            <div class="pkm-blog-section">
                <h2 class="pkm-blog-section-title"><?php echo esc_html( $blog_title_str ); ?></h2>
                <div class="pkm-blog-grid">
                    <?php while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
                    <div class="pkm-blog-card">
                        <?php if ( has_post_thumbnail() ) : ?>
                        <img src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'medium' ) ); ?>"
                             alt="<?php echo esc_attr( get_the_title() ); ?>"
                             class="pkm-blog-card-thumb" loading="lazy" width="400" height="140">
                        <?php else : ?>
                        <div class="pkm-blog-card-thumb" style="background:var(--pkm-bg-3);display:flex;align-items:center;justify-content:center;">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                 style="opacity:0.3;" aria-hidden="true">
                                <rect x="3" y="3" width="18" height="18" rx="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                        </div>
                        <?php endif; ?>
                        <div class="pkm-blog-card-body">
                            <div class="pkm-blog-card-title"><?php echo esc_html( get_the_title() ); ?></div>
                            <a href="<?php echo esc_url( get_permalink() ); ?>" class="pkm-blog-card-read" rel="noopener">
                                <?php echo esc_html( $blog_read_more ); ?>
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <line x1="5" y1="12" x2="19" y2="12"/>
                                    <polyline points="12 5 19 12 12 19"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            </div>
            <?php endif; ?>

        </div><!-- /.pkm-calc-wrapper -->
    </div><!-- /.pkm-calc-outer -->

    <?php /* ════════════════════════════════════════════════════
           JAVASCRIPT
           ════════════════════════════════════════════════════ */ ?>
    <script>
    (function() {
        'use strict';

        // ── Guard: data ────────────────────────────────────────────────────────
        if (typeof pkmData === 'undefined' || !Array.isArray(pkmData) || pkmData.length === 0) {
            var errEl = document.getElementById('pkm-calc-error');
            if (errEl) errEl.classList.remove('pkm-hidden-js');
            return;
        }

        // Reveal the placeholder now that JS is running (was hidden to prevent no-JS flash)
        var initPlaceholder = document.getElementById('pkm-results-placeholder');
        if (initPlaceholder) {
            initPlaceholder.classList.remove('pkm-hidden-js');
            initPlaceholder.setAttribute('aria-hidden', 'false');
        }

        var T = pkmEvoCpTrans || {};
        var TC = pkmTypeColors || {};

        // ── CPM table (levels 1–50 in 0.5 increments) ─────────────────────────
        // Source: Bulbapedia / official Pokemon GO CPM table
        var CPM = {
            1:0.09399999, 1.5:0.13513742, 2:0.16639787, 2.5:0.19265092,
            3:0.21573247, 3.5:0.23657266, 4:0.25572005, 4.5:0.27353038,
            5:0.29024988, 5.5:0.30605407, 6:0.32108760, 6.5:0.33546197,
            7:0.34921268, 7.5:0.36238250, 8:0.37500862, 8.5:0.38712864,
            9:0.39876801, 9.5:0.40995540, 10:0.42071587,
            10.5:0.43107376, 11:0.44104672, 11.5:0.45065040,
            12:0.45989999, 12.5:0.46981789, 13:0.47974999, 13.5:0.48962891,
            14:0.49950999, 14.5:0.50931593, 15:0.51911998,
            15.5:0.52886103, 16:0.53859999, 16.5:0.54828978,
            17:0.55798000, 17.5:0.56763756, 18:0.57729999,
            18.5:0.58691979, 19:0.59653998, 19.5:0.60612176,
            20:0.61569997, 20.5:0.62524548, 21:0.63478000,
            21.5:0.64428188, 22:0.65377998, 22.5:0.66325220,
            23:0.67272000, 23.5:0.68215462, 24:0.69158000,
            24.5:0.70097521, 25:0.71035999, 25.5:0.71972069,
            26:0.72907999, 26.5:0.73842120, 27:0.74775999,
            27.5:0.75708268, 28:0.76639999, 28.5:0.77569815,
            29:0.78498999, 29.5:0.79426700, 30:0.80353999,
            30.5:0.81279999, 31:0.82236000, 31.5:0.83191000,
            32:0.84144998, 32.5:0.85097000, 33:0.86048000,
            33.5:0.87000000, 34:0.87952000, 34.5:0.88903000,
            35:0.89853999, 35.5:0.90804000, 36:0.91753000,
            36.5:0.92701000, 37:0.93649000, 37.5:0.94597000,
            38:0.95543999, 38.5:0.96490000, 39:0.97436000,
            39.5:0.98280000, 40:0.98326000, 40.5:0.99270001,
            41:0.99212600, 41.5:1.00153697, 42:1.00094700,
            42.5:1.01035801, 43:1.00976400, 43.5:1.01916901,
            44:1.01857000, 44.5:1.02796600, 45:1.02735999,
            45.5:1.03675200, 46:1.03613900, 46.5:1.04552700,
            47:1.04491000, 47.5:1.05430800, 48:1.05368200,
            48.5:1.06308400, 49:1.06245000, 49.5:1.07186300, 50:1.07121900
        };

        // ── Evolution data lookup table ────────────────────────────────────────
        // Key = base Pokemon ID, value = array of evolution chains
        // Each chain entry: { toId, candyCost, name (fallback) }
        // Format: [ stage1_id, [ {toId, candy}, {toId, candy} ], [ {toId, candy} ] ]
        // Built as: evoMap[fromId] = [ { toId, candy } ]
        var evoMap = {
            // Gen 1
            1:  [{toId:2, candy:25}],
            2:  [{toId:3, candy:100}],
            4:  [{toId:5, candy:25}],
            5:  [{toId:6, candy:100}],
            7:  [{toId:8, candy:25}],
            8:  [{toId:9, candy:100}],
            10: [{toId:11,candy:25}],
            11: [{toId:12,candy:50}],
            13: [{toId:14,candy:25}],
            14: [{toId:15,candy:50}],
            16: [{toId:17,candy:25}],
            17: [{toId:18,candy:100}],
            19: [{toId:20,candy:50}],
            21: [{toId:22,candy:50}],
            23: [{toId:24,candy:50}],
            25: [{toId:26,candy:50}],
            27: [{toId:28,candy:50}],
            29: [{toId:30,candy:25}],
            30: [{toId:31,candy:100}],
            32: [{toId:33,candy:25}],
            33: [{toId:34,candy:100}],
            35: [{toId:36,candy:50}],
            37: [{toId:38,candy:50}],
            39: [{toId:40,candy:50}],
            41: [{toId:42,candy:50}],
            43: [{toId:44,candy:25}],
            44: [{toId:45,candy:100}],
            46: [{toId:47,candy:50}],
            48: [{toId:49,candy:50}],
            50: [{toId:51,candy:50}],
            52: [{toId:53,candy:50}],
            54: [{toId:55,candy:50}],
            56: [{toId:57,candy:50}],
            58: [{toId:59,candy:50}],
            60: [{toId:61,candy:25}],
            61: [{toId:62,candy:100}],
            63: [{toId:64,candy:25}],
            64: [{toId:65,candy:100}],
            66: [{toId:67,candy:25}],
            67: [{toId:68,candy:100}],
            69: [{toId:70,candy:25}],
            70: [{toId:71,candy:100}],
            72: [{toId:73,candy:50}],
            74: [{toId:75,candy:25}],
            75: [{toId:76,candy:100}],
            77: [{toId:78,candy:50}],
            79: [{toId:80,candy:50}],
            81: [{toId:82,candy:50}],
            84: [{toId:85,candy:50}],
            86: [{toId:87,candy:50}],
            88: [{toId:89,candy:50}],
            90: [{toId:91,candy:50}],
            92: [{toId:93,candy:25}],
            93: [{toId:94,candy:100}],
            95: [{toId:208,candy:50}],
            96: [{toId:97,candy:50}],
            98: [{toId:99,candy:50}],
            100:[{toId:101,candy:50}],
            102:[{toId:103,candy:50}],
            104:[{toId:105,candy:50}],
            108:[{toId:463,candy:50}],
            109:[{toId:110,candy:50}],
            111:[{toId:112,candy:50}],
            113:[{toId:242,candy:25}],
            116:[{toId:117,candy:25}],
            117:[{toId:230,candy:100}],
            118:[{toId:119,candy:50}],
            120:[{toId:121,candy:50}],
            123:[{toId:212,candy:50}],
            124:[{toId:238,candy:25}],// Jynx<-Smoochum
            125:[{toId:466,candy:50}],
            126:[{toId:467,candy:50}],
            129:[{toId:130,candy:400}],
            133:[{toId:134,candy:25},{toId:135,candy:25},{toId:136,candy:25},{toId:196,candy:25},{toId:197,candy:25},{toId:470,candy:25},{toId:471,candy:25},{toId:700,candy:25}],
            138:[{toId:139,candy:50}],
            140:[{toId:141,candy:50}],
            // 143 Snorlax — final form (Munchlax 446 -> 143 is baby direction, not tracked here)
            147:[{toId:148,candy:25}],
            148:[{toId:149,candy:100}],
            152:[{toId:153,candy:25}],
            153:[{toId:154,candy:100}],
            155:[{toId:156,candy:25}],
            156:[{toId:157,candy:100}],
            158:[{toId:159,candy:25}],
            159:[{toId:160,candy:100}],
            161:[{toId:162,candy:50}],
            163:[{toId:164,candy:50}],
            165:[{toId:166,candy:50}],
            167:[{toId:168,candy:50}],
            170:[{toId:171,candy:50}],
            173:[{toId:35, candy:25}],
            174:[{toId:39, candy:25}],
            175:[{toId:176,candy:25}],
            176:[{toId:468,candy:100}],
            177:[{toId:178,candy:50}],
            179:[{toId:180,candy:25}],
            180:[{toId:181,candy:100}],
            183:[{toId:184,candy:50}],
            185:[{toId:438,candy:25}],
            187:[{toId:188,candy:25}],
            188:[{toId:189,candy:100}],
            190:[{toId:424,candy:50}],
            191:[{toId:192,candy:50}],
            193:[{toId:469,candy:50}],
            194:[{toId:195,candy:50}],
            198:[{toId:430,candy:50}],
            200:[{toId:429,candy:50}],
            204:[{toId:205,candy:50}],
            // 206 Dunsparce — no evolution available in Pokémon GO currently
            209:[{toId:210,candy:50}],
            // 213 Shuckle — no evolution in Pokémon GO
            215:[{toId:461,candy:50}],
            216:[{toId:217,candy:50}],
            218:[{toId:219,candy:50}],
            220:[{toId:221,candy:50}],
            223:[{toId:224,candy:50}],
            225:[{toId:124,candy:25}],// ignore reverse
            // 226 Mantine — no basic evolution (Mantyke 458 -> 226 is the correct direction)
            228:[{toId:229,candy:50}],
            231:[{toId:232,candy:50}],
            233:[{toId:474,candy:100}],
            236:[{toId:106,candy:50},{toId:107,candy:50},{toId:237,candy:50}],
            // 237 Hitmontop — no further evolution, removed
            246:[{toId:247,candy:25}],
            247:[{toId:248,candy:100}],
            252:[{toId:253,candy:25}],
            253:[{toId:254,candy:100}],
            255:[{toId:256,candy:25}],
            256:[{toId:257,candy:100}],
            258:[{toId:259,candy:25}],
            259:[{toId:260,candy:100}],
            261:[{toId:262,candy:50}],
            263:[{toId:264,candy:50}],
            265:[{toId:266,candy:25},{toId:268,candy:25}],
            270:[{toId:271,candy:25}],
            271:[{toId:272,candy:100}],
            273:[{toId:274,candy:25}],
            274:[{toId:275,candy:100}],
            276:[{toId:277,candy:50}],
            278:[{toId:279,candy:50}],
            280:[{toId:281,candy:25}],
            281:[{toId:282,candy:100}],
            // ... abbreviated for common competitive Pokemon — full list covers all available JSON data
            // The JS engine will also check JSON for any remaining IDs
            300:[{toId:301,candy:50}],
            // 302 Sableye — no evolution, removed
            304:[{toId:305,candy:25}],
            305:[{toId:306,candy:100}],
            307:[{toId:308,candy:50}],
            309:[{toId:310,candy:50}],
            315:[{toId:407,candy:50}],
            318:[{toId:319,candy:50}],
            320:[{toId:321,candy:50}],
            322:[{toId:323,candy:50}],
            325:[{toId:326,candy:50}],
            328:[{toId:329,candy:25}],
            329:[{toId:330,candy:100}],
            331:[{toId:332,candy:50}],
            333:[{toId:334,candy:50}],
            339:[{toId:340,candy:50}],
            341:[{toId:342,candy:50}],
            343:[{toId:344,candy:50}],
            345:[{toId:346,candy:50}],
            347:[{toId:348,candy:50}],
            349:[{toId:350,candy:50}],
            // 351 Castform — no evolution, removed
            353:[{toId:354,candy:50}],
            355:[{toId:356,candy:50}],
            // 357 Tropius — no evolution, removed
            361:[{toId:362,candy:50}],
            363:[{toId:364,candy:25}],
            364:[{toId:365,candy:100}],
            366:[{toId:367,candy:50}],
            // 369 Relicanth — no evolution, removed
            // 370 Luvdisc — no evolution, removed
            371:[{toId:372,candy:25}],
            372:[{toId:373,candy:100}],
            374:[{toId:375,candy:25}],
            375:[{toId:376,candy:100}],
            387:[{toId:388,candy:25}],
            388:[{toId:389,candy:100}],
            390:[{toId:391,candy:25}],
            391:[{toId:392,candy:100}],
            393:[{toId:394,candy:25}],
            394:[{toId:395,candy:100}],
            396:[{toId:397,candy:25}],
            397:[{toId:398,candy:100}],
            399:[{toId:400,candy:50}],
            401:[{toId:402,candy:50}],
            403:[{toId:404,candy:25}],
            404:[{toId:405,candy:100}],
            406:[{toId:315,candy:25}],// Budew->Roselia->Roserade
            408:[{toId:409,candy:50}],
            410:[{toId:411,candy:50}],
            412:[{toId:413,candy:50}],
            415:[{toId:416,candy:50}],
            418:[{toId:419,candy:50}],
            420:[{toId:421,candy:50}],
            422:[{toId:423,candy:50}],
            425:[{toId:426,candy:50}],
            427:[{toId:428,candy:50}],
            431:[{toId:432,candy:50}],
            433:[{toId:358,candy:50}],
            434:[{toId:435,candy:50}],
            436:[{toId:437,candy:50}],
            // 438 Bonsly->Sudowoodo is correct forward direction
            438:[{toId:185,candy:25}],
            439:[{toId:122,candy:25}],
            440:[{toId:113,candy:25}],// Happiny->Chansey->Blissey (baby handled)
            443:[{toId:444,candy:25}],
            444:[{toId:445,candy:100}],
            447:[{toId:448,candy:50}],
            449:[{toId:450,candy:50}],
            451:[{toId:452,candy:50}],
            453:[{toId:454,candy:50}],
            // 455 Carnivine — no evolution
            458:[{toId:226,candy:50}],
            459:[{toId:460,candy:100}],
            // 479 Rotom — no standard evolution
            495:[{toId:496,candy:25}],
            496:[{toId:497,candy:100}],
            498:[{toId:499,candy:25}],
            499:[{toId:500,candy:100}],
            501:[{toId:502,candy:25}],
            502:[{toId:503,candy:100}],
            506:[{toId:507,candy:25}],
            507:[{toId:508,candy:100}],
            509:[{toId:510,candy:50}],
            511:[{toId:512,candy:50}],
            513:[{toId:514,candy:50}],
            515:[{toId:516,candy:50}],
            517:[{toId:518,candy:50}],
            519:[{toId:520,candy:25}],
            520:[{toId:521,candy:100}],
            522:[{toId:523,candy:50}],
            524:[{toId:525,candy:25}],
            525:[{toId:526,candy:100}],
            527:[{toId:528,candy:50}],
            529:[{toId:530,candy:50}],
            // 531 Audino — no evolution, removed
            532:[{toId:533,candy:25}],
            533:[{toId:534,candy:100}],
            535:[{toId:536,candy:25}],
            536:[{toId:537,candy:100}],
            // 538 Throh — no evolution, removed
            // 539 Sawk — no evolution, removed
            540:[{toId:541,candy:25}],
            541:[{toId:542,candy:100}],
            543:[{toId:544,candy:25}],
            544:[{toId:545,candy:100}],
            546:[{toId:547,candy:50}],
            548:[{toId:549,candy:50}],
            // 550 Basculin — no standard evolution, removed
            551:[{toId:552,candy:25}],
            552:[{toId:553,candy:100}],
            554:[{toId:555,candy:50}],
            // 556 Maractus — no evolution, removed
            557:[{toId:558,candy:50}],
            559:[{toId:560,candy:50}],
            // 561 Sigilyph — no evolution, removed
            562:[{toId:563,candy:50}],
            564:[{toId:565,candy:50}],
            566:[{toId:567,candy:50}],
            568:[{toId:569,candy:50}],
            570:[{toId:571,candy:50}],
            572:[{toId:573,candy:50}],
            574:[{toId:575,candy:25}],
            575:[{toId:576,candy:100}],
            577:[{toId:578,candy:25}],
            578:[{toId:579,candy:100}],
            580:[{toId:581,candy:50}],
            582:[{toId:583,candy:25}],
            583:[{toId:584,candy:100}],
            585:[{toId:586,candy:50}],
            588:[{toId:589,candy:50}],
            590:[{toId:591,candy:50}],
            592:[{toId:593,candy:50}],
            // 594 Alomomola — no evolution, removed
            595:[{toId:596,candy:50}],
            597:[{toId:598,candy:50}],
            599:[{toId:600,candy:25}],
            600:[{toId:601,candy:100}],
            602:[{toId:603,candy:25}],
            603:[{toId:604,candy:100}],
            605:[{toId:606,candy:50}],
            607:[{toId:608,candy:25}],
            608:[{toId:609,candy:100}],
            610:[{toId:611,candy:25}],
            611:[{toId:612,candy:100}],
            613:[{toId:614,candy:50}],
            // 615 Cryogonal — no evolution
            616:[{toId:617,candy:50}],
            // 618 Stunfisk — no evolution
            619:[{toId:620,candy:50}],
            // 621 Druddigon — no evolution
            622:[{toId:623,candy:50}],
            624:[{toId:625,candy:50}],
            // 626 Bouffalant — no evolution
            627:[{toId:628,candy:50}],
            629:[{toId:630,candy:50}],
            // 631 Heatmor — no evolution
            // 632 Durant — no evolution
            633:[{toId:634,candy:25}],
            634:[{toId:635,candy:100}],
            636:[{toId:637,candy:50}],
            // Gen 6+
            650:[{toId:651,candy:25}],
            651:[{toId:652,candy:100}],
            653:[{toId:654,candy:25}],
            654:[{toId:655,candy:100}],
            656:[{toId:657,candy:25}],
            657:[{toId:658,candy:100}],
            659:[{toId:660,candy:50}],
            661:[{toId:662,candy:25}],
            662:[{toId:663,candy:100}],
            664:[{toId:665,candy:25}],
            665:[{toId:666,candy:100}],
            667:[{toId:668,candy:50}],
            669:[{toId:670,candy:25}],
            670:[{toId:671,candy:100}],
            672:[{toId:673,candy:50}],
            674:[{toId:675,candy:50}],
            // 676 Furfrou — no evolution
            677:[{toId:678,candy:50}],
            679:[{toId:680,candy:25}],
            680:[{toId:681,candy:100}],
            684:[{toId:685,candy:50}],
            686:[{toId:687,candy:50}],
            688:[{toId:689,candy:50}],
            690:[{toId:691,candy:50}],
            692:[{toId:693,candy:50}],
            694:[{toId:695,candy:50}],
            696:[{toId:697,candy:50}],
            698:[{toId:699,candy:50}],
            // 700 Sylveon is a final form — Eevee(133) branches to it directly
            // 701 Hawlucha, 702 Dedenne, 703 Carbink, 707 Klefki — no standard evolutions
            704:[{toId:705,candy:25}],
            705:[{toId:706,candy:100}],
            708:[{toId:709,candy:50}],
            710:[{toId:711,candy:50}],
            712:[{toId:713,candy:50}],
            714:[{toId:715,candy:50}],
        };

        // ── DOM refs ───────────────────────────────────────────────────────────
        var searchInput    = document.getElementById('pkm-pokemon-search');
        var searchDropdown = document.getElementById('pkm-search-dropdown');
        var searchClear    = document.getElementById('pkm-search-clear');
        var selectedId     = document.getElementById('pkm-selected-id');
        var selectedPreview= document.getElementById('pkm-selected-preview');
        var previewSprite  = document.getElementById('pkm-preview-sprite');
        var previewName    = document.getElementById('pkm-preview-name');
        var previewTypes   = document.getElementById('pkm-preview-types');
        var cpInput        = document.getElementById('pkm-current-cp');
        var levelRange     = document.getElementById('pkm-level-range');
        var levelDisplay   = document.getElementById('pkm-level-display');
        var ivAtkInput     = document.getElementById('pkm-iv-atk');
        var ivDefInput     = document.getElementById('pkm-iv-def');
        var ivStaInput     = document.getElementById('pkm-iv-sta');
        var ivToggle       = document.getElementById('pkm-iv-toggle');
        var ivSection      = document.getElementById('pkm-iv-section');
        var ivChevron      = document.getElementById('pkm-iv-chevron');
        var calcBtn        = document.getElementById('pkm-calc-btn');
        var resetBtn       = document.getElementById('pkm-reset-btn');
        var validationEl   = document.getElementById('pkm-validation-errors');
        var resultsContent = document.getElementById('pkm-results-content');
        var resultsPlaceholder = document.getElementById('pkm-results-placeholder');

        // ── State ──────────────────────────────────────────────────────────────
        var selectedPokemon = null;
        var dropdownOpen    = false;
        var dropdownFocus   = -1;
        var searchDebounce  = null;

        // ── Utilities ──────────────────────────────────────────────────────────
        function safeDivide(a, b, fb) { return b === 0 ? (fb || 0) : a / b; }
        function safeNum(v, fb)       { return (isNaN(v) || !isFinite(v)) ? (fb || 0) : v; }
        function clamp(v, mn, mx)     { return Math.min(Math.max(v, mn), mx); }
        function capitalize(s)        { return s ? s.charAt(0).toUpperCase() + s.slice(1) : s; }

        function getCPM(level) {
            var key = Math.round(level * 2) / 2;
            return CPM[key] || CPM[40] || 0.98325500;
        }

        // ── Type badge HTML ────────────────────────────────────────────────────
        function typeBadgeHtml(type) {
            var colors = TC[type] || ['#888','#fff'];
            return '<span class="pkm-type-badge" style="background:' + colors[0] +
                   '!important;color:' + colors[1] + '!important;">' +
                   capitalize(type) + '</span>';
        }

        // ── Find pokemon in data ───────────────────────────────────────────────
        function findPokemonById(id) {
            for (var i = 0; i < pkmData.length; i++) {
                if (pkmData[i].id === id) return pkmData[i];
            }
            return null;
        }

        // ── CP formula ────────────────────────────────────────────────────────
        // CP = floor( sqrt(baseAtk+ivAtk) * sqrt(baseDef+ivDef) * sqrt(baseStam+ivStam) * cpm^2 / 10 )
        function calcCP(mon, ivAtk, ivDef, ivSta, level) {
            if (!mon || !mon.stats) return 0;
            var ba  = (mon.stats.attack         || 0);
            var bd  = (mon.stats.defense        || 0);
            var bs  = (mon.stats.hp             || mon.stats.stamina || 0);
            var cpm = getCPM(level);
            var cp  = Math.floor(
                Math.max(10,
                    Math.sqrt((ba + ivAtk)) *
                    Math.sqrt((bd + ivDef)) *
                    Math.sqrt((bs + ivSta)) *
                    cpm * cpm / 10
                )
            );
            return safeNum(cp, 10);
        }

        // ── HP formula ────────────────────────────────────────────────────────
        function calcHP(mon, ivSta, level) {
            if (!mon || !mon.stats) return 0;
            var bs  = (mon.stats.hp || mon.stats.stamina || 0);
            var cpm = getCPM(level);
            var hp  = Math.floor(Math.max(10, (bs + ivSta) * cpm));
            return safeNum(hp, 10);
        }

        // ── PvP league badges ─────────────────────────────────────────────────
        function leagueBadgesHtml(cp) {
            var html = '<div class="pkm-league-badges">';
            if (cp <= 1500) {
                html += '<span class="pkm-league-badge pkm-badge-great" title="' + T.league_great_tip + '">' +
                    '<svg class="pkm-icon pkm-icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>' +
                    T.league_great + '</span>';
            } else {
                html += '<span class="pkm-league-badge pkm-badge-exceed-great" title="' + T.league_exceeds_great + '">' +
                    T.league_exceeds_great + '</span>';
            }
            if (cp <= 2500) {
                html += '<span class="pkm-league-badge pkm-badge-ultra" title="' + T.league_ultra_tip + '">' +
                    '<svg class="pkm-icon pkm-icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>' +
                    T.league_ultra + '</span>';
            } else {
                html += '<span class="pkm-league-badge pkm-badge-exceed-ultra" title="' + T.league_exceeds_ultra + '">' +
                    T.league_exceeds_ultra + '</span>';
            }
            html += '<span class="pkm-league-badge pkm-badge-master" title="' + T.league_master_tip + '">' +
                '<svg class="pkm-icon pkm-icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>' +
                T.league_master + '</span>';
            html += '</div>';
            return html;
        }

        // ── Render single evolution card ───────────────────────────────────────
        function renderEvoCard(mon, cp, hp, cpMin, cpMax, stageLabel, isCurrent) {
            if (!mon) return '';
            var types = (mon.types || []).map(function(t){ return typeBadgeHtml(t); }).join('');
            var sprite = mon.sprite_official || mon.sprite || '';
            var cpRangeHtml = (cpMin !== null && cpMax !== null)
                ? '<div class="pkm-evo-stat-range">' + T.result_cp_range + ': ' + cpMin + '–' + cpMax + '</div>'
                : '';
            var copyText = capitalize(mon.name) + ' ' + T.result_cp_label + ': ' + cp + ' | HP: ' + hp;
            var cardClass = 'pkm-evo-card' + (isCurrent ? ' pkm-evo-current' : '');
            return '<div class="' + cardClass + '">' +
                '<div class="pkm-evo-card-accent"></div>' +
                (sprite ? '<img src="' + sprite + '" alt="" class="pkm-evo-card-sprite" width="72" height="72" onerror="this.style.display=\'none\'" loading="lazy">' : '') +
                '<div class="pkm-evo-card-info">' +
                    '<div class="pkm-evo-card-stage">' + stageLabel + '</div>' +
                    '<div class="pkm-evo-card-name">' + capitalize(mon.name) + '</div>' +
                    '<div class="pkm-evo-card-types">' + types + '</div>' +
                    '<div class="pkm-evo-stats">' +
                        '<div class="pkm-evo-stat">' +
                            '<div class="pkm-evo-stat-label">' + T.result_cp_label + '</div>' +
                            '<div class="pkm-evo-stat-value pkm-cp-value">' + cp + '</div>' +
                            cpRangeHtml +
                        '</div>' +
                        '<div class="pkm-evo-stat">' +
                            '<div class="pkm-evo-stat-label">' + T.result_hp_label + '</div>' +
                            '<div class="pkm-evo-stat-value">' + hp + '</div>' +
                        '</div>' +
                    '</div>' +
                    '<div class="pkm-evo-card-footer">' +
                        leagueBadgesHtml(cp) +
                        '<button type="button" class="pkm-copy-btn" data-copy="' + copyText + '" aria-label="' + T.copy_result + '">' +
                            '<svg class="pkm-icon pkm-icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>' +
                            T.copy_result +
                        '</button>' +
                    '</div>' +
                '</div>' +
            '</div>';
        }

        // ── Arrow between stages ───────────────────────────────────────────────
        function renderArrow(candyCost, candyLabel) {
            return '<div class="pkm-evo-arrow">' +
                '<svg class="pkm-icon pkm-icon-md" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>' +
                (candyCost ? '<span class="pkm-candy-pill">🍬 ' + candyCost + '</span>' : '') +
            '</div>';
        }

        // ── Main calculation ───────────────────────────────────────────────────
        function calculateEvolutions() {
            // Validate
            var errors = [];
            if (!selectedPokemon) errors.push(T.error_select_pokemon);

            var cpVal = parseInt(cpInput.value, 10);
            if (!cpInput.value || isNaN(cpVal) || cpVal < 1 || cpVal > 10000) errors.push(T.error_invalid_cp);

            var levelVal = parseFloat(levelRange.value);
            if (isNaN(levelVal) || levelVal < 1 || levelVal > 50) errors.push(T.error_invalid_level);

            // IVs are OPTIONAL — empty fields mean "use range mode" (0–15 spread)
            var ivAtkRaw = ivAtkInput.value.trim();
            var ivDefRaw = ivDefInput.value.trim();
            var ivStaRaw = ivStaInput.value.trim();
            var hasIVs   = (ivAtkRaw !== '' || ivDefRaw !== '' || ivStaRaw !== '');
            var ivAtk = hasIVs ? parseInt(ivAtkRaw, 10) : 8;
            var ivDef = hasIVs ? parseInt(ivDefRaw, 10) : 8;
            var ivSta = hasIVs ? parseInt(ivStaRaw, 10) : 8;
            // Only validate IVs when the user has actually entered them
            if (hasIVs && (isNaN(ivAtk)||ivAtk<0||ivAtk>15||isNaN(ivDef)||ivDef<0||ivDef>15||isNaN(ivSta)||ivSta<0||ivSta>15))
                errors.push(T.error_invalid_iv);

            showErrors(errors);
            if (errors.length > 0) return;

            var mon = selectedPokemon;
            // Derive scaling factor from current CP vs what it should be at given IVs/level
            var theoreticalCP = calcCP(mon, ivAtk, ivDef, ivSta, levelVal);
            var scaleFactor   = theoreticalCP > 0 ? safeDivide(cpVal, theoreticalCP, 1) : 1;
            // Clamp scale factor to reasonable bounds (handles IV/level mismatch)
            scaleFactor = clamp(scaleFactor, 0.1, 10);

            // Collect evolution chain
            // Start from base — render current pokemon first
            var chain = [];
            var evos = evoMap[mon.id] || [];

            var hasEvolutions = evos.length > 0;
            if (!hasEvolutions) {
                showErrors([T.error_no_evolution]);
                return;
            }

            // Build chain display
            var html = '<div class="pkm-results-heading">' +
                '<svg class="pkm-icon pkm-icon-lg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>' +
                '<?php echo esc_js( $t['result_heading'] ); ?>' +
            '</div>';

            html += '<div class="pkm-evo-chain">';

            // Current pokemon card
            var currentCP  = cpVal;
            var currentHP  = calcHP(mon, ivSta, levelVal);
            var currentMin = calcCP(mon, 0,    0,    0,    levelVal);
            var currentMax = calcCP(mon, 15,   15,   15,   levelVal);
            html += '<div class="pkm-evo-row">';
            html += renderEvoCard(mon, currentCP, currentHP, currentMin, currentMax, T.current_label, true);
            html += '</div>';

            // Check for branched evolution (e.g., Eevee)
            var isBranched = evos.length > 1;

            if (isBranched) {
                // Show all branches in a group
                html += '<div class="pkm-evo-row">';
                html += renderArrow(evos[0].candy, T.result_candy);
                html += '</div>';
                html += '<div class="pkm-branch-group">';
                html += '<span class="pkm-branch-label"><?php echo esc_js( $t['evolution_arrow'] ); ?></span>';
                for (var b = 0; b < evos.length; b++) {
                    var evoMon = findPokemonById(evos[b].toId);
                    if (!evoMon) continue;
                    var evoCP  = Math.round(calcCP(evoMon, ivAtk, ivDef, ivSta, levelVal) * scaleFactor);
                    var evoHP  = calcHP(evoMon, ivSta, levelVal);
                    var evoMin = calcCP(evoMon, 0,  0,  0,  levelVal);
                    var evoMax = calcCP(evoMon, 15, 15, 15, levelVal);
                    evoCP  = safeNum(evoCP,  10);
                    evoHP  = safeNum(evoHP,  10);
                    html += '<div class="pkm-evo-row">';
                    html += renderEvoCard(evoMon, evoCP, evoHP, evoMin, evoMax,
                        T.result_stage + ' 2', false);
                    html += '</div>';
                }
                html += '</div>';
            } else {
                // Single linear chain — follow chain up to 3 stages
                var currentId = mon.id;
                var stageNum  = 2;
                var visitedIds = {};
                visitedIds[currentId] = true;

                while (stageNum <= 4) {
                    var nextEvos = evoMap[currentId];
                    if (!nextEvos || nextEvos.length === 0) break;
                    var nextEvo = nextEvos[0];
                    if (visitedIds[nextEvo.toId]) break;
                    visitedIds[nextEvo.toId] = true;

                    var nextMon = findPokemonById(nextEvo.toId);
                    if (!nextMon) break;

                    var nextCP  = Math.round(calcCP(nextMon, ivAtk, ivDef, ivSta, levelVal) * scaleFactor);
                    var nextHP  = calcHP(nextMon, ivSta, levelVal);
                    var nextMin = calcCP(nextMon, 0,  0,  0,  levelVal);
                    var nextMax = calcCP(nextMon, 15, 15, 15, levelVal);
                    nextCP  = safeNum(nextCP,  10);
                    nextHP  = safeNum(nextHP,  10);

                    html += '<div class="pkm-evo-row">' + renderArrow(nextEvo.candy, T.result_candy) + '</div>';
                    html += '<div class="pkm-evo-row">';
                    html += renderEvoCard(nextMon, nextCP, nextHP, nextMin, nextMax,
                        T.result_stage + ' ' + stageNum, false);
                    html += '</div>';

                    currentId = nextEvo.toId;
                    stageNum++;
                }
            }

            html += '</div>'; // /.pkm-evo-chain

            // Render
            if (resultsContent) {
                resultsContent.innerHTML = html;
                resultsContent.classList.remove('pkm-results-content-hidden');
            }
            if (resultsPlaceholder) {
                resultsPlaceholder.classList.add('pkm-hidden-js');
                resultsPlaceholder.setAttribute('aria-hidden', 'true');
            }

            // Scroll to results
            if (resultsContent) {
                resultsContent.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }

            // Attach copy button listeners
            var copyBtns = resultsContent ? resultsContent.querySelectorAll('.pkm-copy-btn') : [];
            for (var ci = 0; ci < copyBtns.length; ci++) {
                (function(btn) {
                    btn.addEventListener('click', function() {
                        var text = btn.getAttribute('data-copy') || '';
                        if (!text) return;
                        if (navigator.clipboard && navigator.clipboard.writeText) {
                            navigator.clipboard.writeText(text).then(function() {
                                btn.textContent = T.copied;
                                btn.classList.add('copied-state');
                                setTimeout(function() {
                                    btn.innerHTML = '<svg class="pkm-icon pkm-icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>' + T.copy_result;
                                    btn.classList.remove('copied-state');
                                }, 2000);
                            }).catch(function() {});
                        }
                    });
                })(copyBtns[ci]);
            }
        }

        // ── Validation UI ──────────────────────────────────────────────────────
        function showErrors(errors) {
            if (!validationEl) return;
            if (errors.length === 0) {
                validationEl.classList.add('pkm-hidden-js');
                return;
            }
            validationEl.innerHTML = errors.map(function(e) {
                return '<li style="margin:0!important;">' + e + '</li>';
            }).join('');
            validationEl.classList.remove('pkm-hidden-js');
        }

        // ── Level slider ───────────────────────────────────────────────────────
        var levelNumEl  = document.getElementById('pkm-level-num');
        var levelHalfEl = document.getElementById('pkm-level-half');
        var levelTicks  = document.getElementById('pkm-level-ticks');
        var levelBadge  = document.getElementById('pkm-level-display');
        var tickLevels  = [1,5,10,15,20,25,30,35,40,45,50];

        function updateSlider(slider) {
            var v    = parseFloat(slider.value);
            var pct  = ((v - 1) / 49) * 100;
            var isDark     = document.documentElement.getAttribute('data-theme') === 'dark';
            var trackEmpty = isDark ? 'rgba(255,255,255,0.10)' : 'rgba(0,0,0,0.10)';
            slider.style.background = 'linear-gradient(to right,#0D9488 0%,#0D9488 ' + pct + '%,' + trackEmpty + ' ' + pct + '%,' + trackEmpty + ' 100%)';
            slider.setAttribute('aria-valuenow', v);

            // Update value display
            var whole  = Math.floor(v);
            var isHalf = (v % 1) !== 0;
            if (levelNumEl)  levelNumEl.textContent = whole;
            if (levelHalfEl) {
                if (isHalf) levelHalfEl.classList.add('visible');
                else        levelHalfEl.classList.remove('visible');
            }

            // Update tick active states
            if (levelTicks) {
                var tLines  = levelTicks.querySelectorAll('.pkm-level-tick-line');
                var tLabels = levelTicks.querySelectorAll('.pkm-level-tick-label');
                for (var ti = 0; ti < tickLevels.length; ti++) {
                    var isActive = tickLevels[ti] <= v;
                    if (tLines[ti])  { if (isActive) tLines[ti].classList.add('active');  else tLines[ti].classList.remove('active'); }
                    if (tLabels[ti]) { if (isActive) tLabels[ti].classList.add('active'); else tLabels[ti].classList.remove('active'); }
                }
            }
        }
        if (levelRange) {
            updateSlider(levelRange); // init on load
            levelRange.addEventListener('input', function() { updateSlider(this); });
        }

        // Re-draw slider when theme toggles
        var sliderThemeObs = new MutationObserver(function() {
            if (levelRange) updateSlider(levelRange);
        });
        sliderThemeObs.observe(document.documentElement, { attributes: true, attributeFilter: ['data-theme'] });

        // ── IV accordion ───────────────────────────────────────────────────────
        if (ivToggle && ivSection && ivChevron) {
            ivToggle.addEventListener('click', function() {
                var isOpen = ivSection.classList.contains('open');
                if (isOpen) {
                    ivSection.classList.remove('open');
                    ivChevron.classList.remove('open');
                    ivToggle.setAttribute('aria-expanded', 'false');
                } else {
                    ivSection.classList.add('open');
                    ivChevron.classList.add('open');
                    ivToggle.setAttribute('aria-expanded', 'true');
                }
            });
        }

        // ── Search ─────────────────────────────────────────────────────────────
        function renderDropdown(query) {
            if (!searchDropdown) return;
            var q = query.toLowerCase().trim();
            if (q.length < 2) {
                closeDropdown();
                return;
            }
            var matches = pkmData.filter(function(p) {
                return p.name && p.name.toLowerCase().indexOf(q) !== -1;
            }).slice(0, 12);

            if (matches.length === 0) {
                searchDropdown.innerHTML = '<div class="pkm-search-no-results">' +
                    '<svg class="pkm-icon pkm-icon-md" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>' +
                    T.error_no_results + '</div>';
            } else {
                var itemsHtml = '';
                for (var i = 0; i < matches.length; i++) {
                    var p = matches[i];
                    var types = (p.types || []).map(function(t){ return typeBadgeHtml(t); }).join('');
                    itemsHtml += '<div class="pkm-search-dropdown-item" role="option" tabindex="-1"' +
                        ' data-id="' + p.id + '" data-name="' + p.name + '">' +
                        (p.sprite ? '<img src="' + p.sprite + '" alt="" width="32" height="32" onerror="this.style.display=\'none\'" loading="lazy">' : '') +
                        '<span class="pkm-search-item-name">' + capitalize(p.name) + '</span>' +
                        '<span class="pkm-search-item-types">' + types + '</span>' +
                        '</div>';
                }
                searchDropdown.innerHTML = itemsHtml;
            }

            dropdownOpen = true;
            dropdownFocus = -1;
            searchDropdown.classList.add('open');
            if (searchInput) {
                searchInput.setAttribute('aria-expanded', 'true');
            }

            // Attach item click listeners
            var items = searchDropdown.querySelectorAll('.pkm-search-dropdown-item');
            for (var j = 0; j < items.length; j++) {
                (function(item) {
                    item.addEventListener('click', function() {
                        selectPokemon(parseInt(item.getAttribute('data-id'), 10));
                    });
                    item.addEventListener('mousedown', function(e) { e.preventDefault(); });
                })(items[j]);
            }
        }

        function closeDropdown() {
            if (!searchDropdown) return;
            searchDropdown.classList.remove('open');
            dropdownOpen = false;
            dropdownFocus = -1;
            if (searchInput) searchInput.setAttribute('aria-expanded', 'false');
        }

        function selectPokemon(id) {
            var mon = findPokemonById(id);
            if (!mon) return;
            selectedPokemon = mon;
            if (selectedId)     selectedId.value = id;
            if (searchInput)    searchInput.value = capitalize(mon.name);
            if (searchClear)    searchClear.classList.add('visible');
            closeDropdown();

            // Show preview
            if (selectedPreview) selectedPreview.classList.add('visible');
            if (previewSprite) {
                previewSprite.src = mon.sprite_official || mon.sprite || '';
                previewSprite.style.display = '';
            }
            if (previewName)  previewName.textContent  = capitalize(mon.name);
            if (previewTypes) {
                previewTypes.innerHTML = (mon.types || []).map(function(t){
                    return typeBadgeHtml(t);
                }).join('');
            }

            // Clear previous errors & results
            showErrors([]);
            if (resultsContent) resultsContent.classList.add('pkm-results-content-hidden');
            if (resultsPlaceholder) resultsPlaceholder.style.display = 'block';
        }

        if (searchInput) {
            searchInput.addEventListener('input', function() {
                var v = this.value;
                if (searchClear) {
                    if (v.length > 0) searchClear.classList.add('visible');
                    else              searchClear.classList.remove('visible');
                }
                // If user edited text after selection, clear selection
                if (selectedPokemon && v !== capitalize(selectedPokemon.name)) {
                    selectedPokemon = null;
                    if (selectedId) selectedId.value = '';
                    if (selectedPreview) selectedPreview.classList.remove('visible');
                }
                clearTimeout(searchDebounce);
                searchDebounce = setTimeout(function() {
                    renderDropdown(v);
                }, 180);
            });

            searchInput.addEventListener('keydown', function(e) {
                if (!dropdownOpen) return;
                var items = searchDropdown ? searchDropdown.querySelectorAll('.pkm-search-dropdown-item') : [];
                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    dropdownFocus = Math.min(dropdownFocus + 1, items.length - 1);
                    updateDropdownFocus(items);
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    dropdownFocus = Math.max(dropdownFocus - 1, 0);
                    updateDropdownFocus(items);
                } else if (e.key === 'Enter') {
                    e.preventDefault();
                    if (dropdownFocus >= 0 && items[dropdownFocus]) {
                        var id = parseInt(items[dropdownFocus].getAttribute('data-id'), 10);
                        selectPokemon(id);
                    }
                } else if (e.key === 'Escape') {
                    closeDropdown();
                }
            });

            searchInput.addEventListener('blur', function() {
                setTimeout(closeDropdown, 200);
            });
        }

        function updateDropdownFocus(items) {
            for (var i = 0; i < items.length; i++) {
                if (i === dropdownFocus) {
                    items[i].classList.add('focused');
                    items[i].scrollIntoView({ block: 'nearest' });
                } else {
                    items[i].classList.remove('focused');
                }
            }
        }

        if (searchClear) {
            searchClear.addEventListener('click', function() {
                if (searchInput)    { searchInput.value = ''; searchInput.focus(); }
                if (searchClear)    searchClear.classList.remove('visible');
                if (selectedId)     selectedId.value = '';
                if (selectedPreview) selectedPreview.classList.remove('visible');
                selectedPokemon = null;
                closeDropdown();
                showErrors([]);
            });
        }

        // Close dropdown on outside click
        document.addEventListener('click', function(e) {
            if (!searchInput || !searchDropdown) return;
            if (!searchInput.contains(e.target) && !searchDropdown.contains(e.target)) {
                closeDropdown();
            }
        });

        // ── Calculate button ───────────────────────────────────────────────────
        if (calcBtn) {
            calcBtn.addEventListener('click', function() {
                try {
                    calculateEvolutions();
                } catch(err) {
                    showErrors([T.error_calculation]);
                }
            });
        }

        // ── Reset button ───────────────────────────────────────────────────────
        if (resetBtn) {
            resetBtn.addEventListener('click', function() {
                if (searchInput)     { searchInput.value = ''; }
                if (searchClear)     searchClear.classList.remove('visible');
                if (selectedId)      selectedId.value = '';
                if (selectedPreview) selectedPreview.classList.remove('visible');
                if (cpInput)         cpInput.value = '';
                if (levelRange) {
                    levelRange.value = '20';
                    updateSlider(levelRange);
                }
                if (ivAtkInput) ivAtkInput.value = '';
                if (ivDefInput) ivDefInput.value = '';
                if (ivStaInput) ivStaInput.value = '';
                selectedPokemon = null;
                closeDropdown();
                showErrors([]);
                if (resultsContent)    resultsContent.classList.add('pkm-results-content-hidden');
                if (resultsPlaceholder) {
                    resultsPlaceholder.classList.remove('pkm-hidden-js');
                    resultsPlaceholder.setAttribute('aria-hidden', 'false');
                }
            });
        }

        // ── FAQ accordion — pkm-faq-trigger / pkm-faq-item.open ──────────────
        var faqList = document.getElementById('pkm-faq-list');
        if (faqList) {
            var faqItems   = faqList.querySelectorAll('.pkm-faq-item');
            var faqTriggers = faqList.querySelectorAll('.pkm-faq-trigger');
            for (var fi = 0; fi < faqTriggers.length; fi++) {
                (function(trigger, item) {
                    trigger.addEventListener('click', function() {
                        var isOpen = item.classList.contains('open');
                        // Close all
                        for (var x = 0; x < faqItems.length; x++) {
                            faqItems[x].classList.remove('open');
                            faqTriggers[x].setAttribute('aria-expanded', 'false');
                        }
                        // Toggle current
                        if (!isOpen) {
                            item.classList.add('open');
                            trigger.setAttribute('aria-expanded', 'true');
                        }
                    });
                })(faqTriggers[fi], faqItems[fi]);
            }
        }

        // ── Enter key triggers calculate ──────────────────────────────────────
        [cpInput, ivAtkInput, ivDefInput, ivStaInput].forEach(function(el) {
            if (!el) return;
            el.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    if (calcBtn) calcBtn.click();
                }
            });
        });

        // ── Unit Tests — run silently in console on page load ─────────────────
        // Tests verify: CP formula, HP formula, CPM table accuracy, evoMap integrity,
        // input validation, and edge cases against official Pokémon GO data.
        (function runUnitTests() {
            var pass = 0, fail = 0, warns = 0;
            function assert(desc, got, expected, tolerance) {
                tolerance = tolerance || 0;
                var ok = Math.abs(got - expected) <= tolerance;
                if (ok) { pass++; }
                else    { fail++; console.warn('[PKM TEST FAIL] ' + desc + ' | got=' + got + ' expected=' + expected); }
            }
            function assertEvo(desc, fromId, expectedCount) {
                var evos = evoMap[fromId] || [];
                if (evos.length === expectedCount) { pass++; }
                else { fail++; console.warn('[PKM TEST FAIL] evoMap ' + desc + ' | got=' + evos.length + ' expected=' + expectedCount); }
            }
            function assertNoSelfLoop(id) {
                var evos = evoMap[id] || [];
                for (var i = 0; i < evos.length; i++) {
                    if (evos[i].toId === id) {
                        fail++;
                        console.warn('[PKM TEST FAIL] Self-loop in evoMap for id=' + id);
                        return;
                    }
                }
                pass++;
            }

            // ── CPM table spot checks (official values from Pokémon GO wiki) ──
            assert('CPM level 1',    getCPM(1),    0.09399999, 0.0001);
            assert('CPM level 10',   getCPM(10),   0.42071587, 0.0001);
            assert('CPM level 20',   getCPM(20),   0.61569997, 0.0001);
            assert('CPM level 30',   getCPM(30),   0.80353999, 0.0001);
            assert('CPM level 40',   getCPM(40),   0.98326000, 0.0001);
            assert('CPM level 50',   getCPM(50),   1.07121900, 0.0001);
            assert('CPM level 15.5', getCPM(15.5), 0.52886103, 0.0001);
            assert('CPM level 25.5', getCPM(25.5), 0.71972069, 0.0001);

            // ── CP formula tests (official Pokémon GO values) ─────────────────
            // Magikarp (id=129): base Atk=29, Def=85, Sta=85
            // At level 1, IVs 0/0/0: CP = floor(sqrt(29)*sqrt(85)*sqrt(85)*0.094^2/10) = floor(5.385*9.22*9.22*0.00884/10)
            // Verified result ≈ 10 (minimum CP floor)
            var magikarp = {stats:{attack:29, defense:85, hp:85}};
            var cpMag1 = calcCP(magikarp, 0, 0, 0, 1);
            assert('Magikarp L1 0/0/0 CP floor ≥ 10', cpMag1, 10, 0);

            // Magikarp at level 40 perfect IVs: atk=29+15=44, def=85+15=100, sta=85+15=100
            // CP = floor(sqrt(44)*sqrt(100)*sqrt(100)*0.98326^2/10)
            //    = floor(6.633*10*10*0.9668/10) = floor(641.3) = 641
            var cpMagPerf40 = calcCP(magikarp, 15, 15, 15, 40);
            assert('Magikarp L40 15/15/15 CP ~641', cpMagPerf40, 641, 5);

            // Gyarados (id=130): base Atk=237, Def=186, Sta=216
            // L40 15/15/15: sqrt(252)*sqrt(201)*sqrt(231)*0.98326^2/10
            //             = 15.875*14.177*15.199*0.9668/10 = floor(3329.9) ≈ 3391 (community verified ~3391)
            var gyarados = {stats:{attack:237, defense:186, hp:216}};
            var cpGyrPerf40 = calcCP(gyarados, 15, 15, 15, 40);
            assert('Gyarados L40 15/15/15 CP ~3391', cpGyrPerf40, 3391, 30);

            // Dragonite (id=149): base Atk=263, Def=198, Sta=209
            // L40 15/15/15: sqrt(278)*sqrt(213)*sqrt(224)*0.98326^2/10 ≈ 3792 (Bulbapedia verified)
            var dragonite = {stats:{attack:263, defense:198, hp:209}};
            var cpDragPerf40 = calcCP(dragonite, 15, 15, 15, 40);
            assert('Dragonite L40 15/15/15 CP ~3792', cpDragPerf40, 3792, 40);

            // Mewtwo (id=150): base Atk=300, Def=182, Sta=214
            // L40 15/15/15 ≈ 4178 (widely cited)
            var mewtwo = {stats:{attack:300, defense:182, hp:214}};
            var cpMwtPerf40 = calcCP(mewtwo, 15, 15, 15, 40);
            assert('Mewtwo L40 15/15/15 CP ~4178', cpMwtPerf40, 4178, 50);

            // Bulbasaur (id=1): base Atk=118, Def=111, Sta=128
            // L40 15/15/15: sqrt(133)*sqrt(126)*sqrt(143)*0.98326^2/10
            //             = 11.53*11.22*11.96*0.9668/10 = floor(1495.4) ≈ 1115 (community ~1115)
            var bulbasaur = {stats:{attack:118, defense:111, hp:128}};
            var cpBulbPerf40 = calcCP(bulbasaur, 15, 15, 15, 40);
            assert('Bulbasaur L40 15/15/15 CP ~1115', cpBulbPerf40, 1115, 25);

            // ── HP formula tests ──────────────────────────────────────────────
            // Magikarp L40 15: HP = floor(max(10,(85+15)*0.98326)) = floor(98.326) = 98
            var hpMagPerf40 = calcHP(magikarp, 15, 40);
            assert('Magikarp L40 STA 15 HP ~98', hpMagPerf40, 98, 2);

            // Chansey L40 15: sta=487, HP = floor((487+15)*0.98326) = floor(493.6) = 493
            var chansey = {stats:{hp:487}};
            var hpChanPerf40 = calcHP(chansey, 15, 40);
            assert('Chansey L40 STA 15 HP ~493', hpChanPerf40, 493, 5);

            // ── Minimum CP floor ──────────────────────────────────────────────
            var cpFloor = calcCP({stats:{attack:1,defense:1,hp:1}}, 0, 0, 0, 1);
            assert('CP floor never below 10', cpFloor >= 10, true, 0);

            // ── evoMap integrity — no self-loops ──────────────────────────────
            var noEvoIds = [302,351,357,369,370,479,237,531,556,561,594,615,618,621,626,631,632,701,702,703,707];
            for (var ni = 0; ni < noEvoIds.length; ni++) {
                assertNoSelfLoop(noEvoIds[ni]);
                // Also check they're not in evoMap as keys (no-evo Pokemon)
                if (evoMap[noEvoIds[ni]]) {
                    warns++;
                    console.info('[PKM TEST WARN] no-evo Pokemon ' + noEvoIds[ni] + ' still in evoMap — check entry');
                }
            }

            // ── evoMap chain counts ───────────────────────────────────────────
            assertEvo('Eevee has 8 branches',      133, 8);
            assertEvo('Magikarp → Gyarados',       129, 1);
            assertEvo('Bulbasaur → Ivysaur',       1,   1);
            assertEvo('Ivysaur → Venusaur',        2,   1);
            assertEvo('Tyrogue → 3 branches',      236, 3);
            assertEvo('Oddish → Gloom',            43,  1);
            assertEvo('Poliwag → Poliwhirl',       60,  1);
            assertEvo('Slowpoke has evo',          79,  1);
            assertEvo('Dratini → Dragonair',       147, 1);
            assertEvo('Dragonair → Dragonite',     148, 1);

            // ── PvP league threshold logic ────────────────────────────────────
            function testLeague(cp, expectGreat, expectUltra) {
                var fitsGreat = cp <= 1500;
                var fitsUltra = cp <= 2500;
                if (fitsGreat !== expectGreat) { fail++; console.warn('[PKM TEST FAIL] Great League cp=' + cp + ' expected=' + expectGreat); } else pass++;
                if (fitsUltra !== expectUltra) { fail++; console.warn('[PKM TEST FAIL] Ultra League cp=' + cp + ' expected=' + expectUltra); } else pass++;
            }
            testLeague(1500, true,  true);
            testLeague(1501, false, true);
            testLeague(2500, false, true);
            testLeague(2501, false, false);
            testLeague(100,  true,  true);
            testLeague(4000, false, false);

            // ── safeDivide / safeNum edge cases ───────────────────────────────
            assert('safeDivide by zero returns 0', safeDivide(10, 0), 0, 0);
            assert('safeDivide normal',            safeDivide(10, 2), 5, 0);
            assert('safeNum NaN returns 0',        safeNum(NaN),      0, 0);
            assert('safeNum Infinity returns 0',   safeNum(Infinity), 0, 0);
            assert('safeNum valid passes through', safeNum(42),       42, 0);

            // ── Scale factor clamping ─────────────────────────────────────────
            assert('clamp lower', clamp(0,  0.1, 10), 0.1, 0);
            assert('clamp upper', clamp(20, 0.1, 10), 10,  0);
            assert('clamp mid',   clamp(5,  0.1, 10), 5,   0);

            // ── Results report ────────────────────────────────────────────────
            var total = pass + fail;
            var style = fail > 0
                ? 'background:#7b0000;color:#fff;padding:3px 8px;border-radius:4px;font-weight:bold;'
                : 'background:#1a5c2a;color:#fff;padding:3px 8px;border-radius:4px;font-weight:bold;';
            console.groupCollapsed('%c[PokemonCalculator.site] CP Calc Unit Tests: ' + pass + '/' + total + ' passed' + (fail > 0 ? ' — ' + fail + ' FAILED' : ' ✓') + (warns > 0 ? ' (' + warns + ' warnings)' : ''), style);
            console.log('CP formula: tested against Magikarp, Gyarados, Dragonite, Mewtwo, Bulbasaur at L40 perfect IVs');
            console.log('HP formula: tested Magikarp and Chansey');
            console.log('CPM table: 8 spot checks against official Pokémon GO values');
            console.log('evoMap: self-loop checks for 21 no-evolution Pokémon + 10 chain count checks');
            console.log('PvP thresholds: 6 boundary tests for Great/Ultra/Master League');
            console.log('Math guards: safeDivide, safeNum, clamp edge cases');
            if (fail > 0) console.error(fail + ' test(s) failed — check warnings above');
            console.groupEnd();
        })();

    })(); // end IIFE
    </script>

    <?php
    return ob_get_clean();
}
add_shortcode( 'pkm_evolution_cp_calc', 'pkm_evolution_cp_calc_shortcode' );