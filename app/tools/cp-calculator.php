<?php
// Standalone PHP

// ============================================================
// FILE: pkm-calculators/pkm-cp-calculator.php
// SHORTCODE: [pkm_cp_calculator_calc]
// functions.php: require_once get_stylesheet_directory() . '/pkm-calculators/pkm-cp-calculator.php';
// ============================================================

// ----------------------------------------------------------
// HREFLANG
// ----------------------------------------------------------
function pkm_cp_calculator_hreflang() {
    if ( ! is_page( [ 'pokemon-go-cp-calculator', 'calculadora-cp-pokemon', 'calculadora-pc-pokemon', 'calculateur-cp-pokemon', 'kp-rechner-pokemon-go' ] ) ) return;
    $urls = [
        'en'    => home_url( '/en/pokemon-go-cp-calculator/' ),
        'es'    => home_url( '/es/calculadora-cp-pokemon/' ),
        'pt-BR' => home_url( '/pt-br/calculadora-pc-pokemon/' ),
        'fr'    => home_url( '/fr/calculateur-cp-pokemon/' ),
        'de'    => home_url( '/de/kp-rechner-pokemon-go/' ),
    ];
    foreach ( $urls as $hl => $url )
        echo '<link rel="alternate" hreflang="' . esc_attr( $hl ) . '" href="' . esc_url( $url ) . '">' . "\n";
    echo '<link rel="alternate" hreflang="x-default" href="' . esc_url( $urls['en'] ) . '">' . "\n";
}
add_action( 'wp_head', 'pkm_cp_calculator_hreflang' );

// ----------------------------------------------------------
// CANONICAL
// ----------------------------------------------------------
function pkm_cp_calculator_canonical() {
    if ( ! is_page( [ 'pokemon-go-cp-calculator', 'calculadora-cp-pokemon', 'calculadora-pc-pokemon', 'calculateur-cp-pokemon', 'kp-rechner-pokemon-go' ] ) ) return;
    $url = ( is_ssl() ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    echo '<link rel="canonical" href="' . esc_url( $url ) . '">' . "\n";
}
add_action( 'wp_head', 'pkm_cp_calculator_canonical' );

// ----------------------------------------------------------
// SCHEMA — WebApplication + HowTo + FAQPage + BreadcrumbList
// ----------------------------------------------------------

function pkm_cp_calculator_schema() {
    if ( ! is_page( [ 'pokemon-go-cp-calculator', 'calculadora-cp-pokemon', 'calculadora-pc-pokemon', 'calculateur-cp-pokemon', 'kp-rechner-pokemon-go' ] ) ) return;
    global $pkm_current_lang;
    $lang = $pkm_current_lang ?? 'en';

    $lang_map = [
        'en'    => [ 'name' => 'Pokemon GO CP Calculator',         'desc' => 'Free Pokemon GO CP calculator. Calculate combat power for any Pokemon after power-up, max CP at level 40/50, and predicted CP after evolution.',       'url' => home_url('/en/pokemon-go-cp-calculator/'),    'inLang' => 'en', 'breadHome' => 'Home', 'breadTools' => 'Calculators' ],
        'es'    => [ 'name' => 'Calculadora CP Pokémon GO',         'desc' => 'Calculadora gratuita de PC para Pokémon GO. Calcula el poder de combate tras subir de nivel, el PC máximo y el PC tras evolucionar.',                   'url' => home_url('/es/calculadora-cp-pokemon/'),      'inLang' => 'es', 'breadHome' => 'Inicio', 'breadTools' => 'Calculadoras' ],
        'pt-br' => [ 'name' => 'Calculadora de PC Pokémon GO',      'desc' => 'Calculadora gratuita de PC para Pokémon GO. Calcule o poder de combate após evoluir, PC máximo no nível 40/50 e custo de melhoramento.',              'url' => home_url('/pt-br/calculadora-pc-pokemon/'),   'inLang' => 'pt-BR', 'breadHome' => 'Início', 'breadTools' => 'Calculadoras' ],
        'fr'    => [ 'name' => 'Calculateur CP Pokémon GO',         'desc' => 'Calculateur CP Pokémon GO gratuit. Calculez les PC après amélioration, le CP maximum au niveau 40/50 et le CP prévu après évolution.',                 'url' => home_url('/fr/calculateur-cp-pokemon/'),      'inLang' => 'fr', 'breadHome' => 'Accueil', 'breadTools' => 'Calculateurs' ],
        'de'    => [ 'name' => 'Pokémon GO KP Rechner',             'desc' => 'Kostenloser Pokémon GO KP Rechner. Berechne Kampfpunkte nach Aufwertung, maximale KP auf Level 40/50 und vorhergesagte KP nach der Entwicklung.',        'url' => home_url('/de/kp-rechner-pokemon-go/'),       'inLang' => 'de', 'breadHome' => 'Startseite', 'breadTools' => 'Rechner' ],
    ];
    $d = $lang_map[ $lang ] ?? $lang_map['en'];

    $howto_steps_map = [
        'en'    => [ 'Search for your Pokémon by name using the search bar', 'Enter your Pokémon\'s IV values: Attack, Defense, and Stamina (0–15)', 'Set the current level using the slider or preset level buttons', 'Click Calculate to see CP, Max CP, Evolution CP, HP, and Stardust costs' ],
        'es'    => [ 'Busca tu Pokémon por nombre usando la barra de búsqueda', 'Introduce los valores IV de tu Pokémon: Ataque, Defensa y Aguante (0–15)', 'Establece el nivel actual usando el deslizador o los botones de nivel predeterminados', 'Haz clic en Calcular para ver PC, PC Máximo, PC de Evolución, PS y costes de Polvo Estelar' ],
        'pt-br' => [ 'Pesquise seu Pokémon pelo nome usando a barra de pesquisa', 'Insira os valores de IV do seu Pokémon: Ataque, Defesa e Vigor (0–15)', 'Defina o nível atual usando o controle deslizante ou os botões de nível predefinidos', 'Clique em Calcular para ver PC, PC Máximo, PC de Evolução, PS e custos de Pó Estelar' ],
        'fr'    => [ 'Recherchez votre Pokémon par nom avec la barre de recherche', 'Entrez les valeurs IV de votre Pokémon : Attaque, Défense et Endurance (0–15)', 'Définissez le niveau actuel avec le curseur ou les boutons de niveau prédéfinis', 'Cliquez sur Calculer pour voir CP, CP Max, CP d\'Évolution, PV et coûts en Poussière d\'Étoile' ],
        'de'    => [ 'Suche dein Pokémon per Name über die Suchleiste', 'Gib die IV-Werte deines Pokémon ein: Angriff, Verteidigung und Ausdauer (0–15)', 'Stelle das aktuelle Level mit dem Schieberegler oder den voreingestellten Level-Tasten ein', 'Klicke auf Berechnen, um KP, Max-KP, Entwicklungs-KP, KP und Sternenstaub-Kosten zu sehen' ],
    ];
    $steps = $howto_steps_map[ $lang ] ?? $howto_steps_map['en'];

    $steps_arr = $howto_steps_map[ $lang ] ?? $howto_steps_map['en'];

    $howto_schema_steps = [];
    foreach ( $steps_arr as $i => $step_text ) {
        $howto_schema_steps[] = [
            '@type'    => 'HowToStep',
            'position' => $i + 1,
            'name'     => $step_text,
            'text'     => $step_text,
        ];
    }

    $breadcrumb_labels = [
        'en'    => [ 'Home', 'Calculators', 'Pokemon GO CP Calculator' ],
        'es'    => [ 'Inicio', 'Calculadoras', 'Calculadora CP Pokémon GO' ],
        'pt-br' => [ 'Início', 'Calculadoras', 'Calculadora PC Pokémon GO' ],
        'fr'    => [ 'Accueil', 'Calculateurs', 'Calculateur CP Pokémon GO' ],
        'de'    => [ 'Startseite', 'Rechner', 'Pokémon GO KP Rechner' ],
    ];
    $bl = $breadcrumb_labels[ $lang ] ?? $breadcrumb_labels['en'];

    $schema = [
        '@context' => 'https://schema.org',
        '@graph'   => [
            [
                '@type'       => 'WebApplication',
                'name'        => $d['name'],
                'description' => $d['desc'],
                'url'         => $d['url'],
                'inLanguage'  => $d['inLang'],
                'applicationCategory' => 'GameApplication',
                'operatingSystem'     => 'Any',
                'offers'      => [ '@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD' ],
            ],
            [
                '@type' => 'HowTo',
                'name'  => $d['name'],
                'step'  => $howto_schema_steps,
            ],
            // REMOVED: FAQPage from here - it's now ONLY in the HTML microdata
            [
                '@type'           => 'BreadcrumbList',
                'itemListElement' => [
                    [ '@type' => 'ListItem', 'position' => 1, 'name' => $bl[0], 'item' => home_url('/') ],
                    [ '@type' => 'ListItem', 'position' => 2, 'name' => $bl[1], 'item' => home_url( '/' . $lang . '/' ) ],
                    [ '@type' => 'ListItem', 'position' => 3, 'name' => $bl[2], 'item' => $d['url'] ],
                ],
            ],
        ],
    ];

    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'pkm_cp_calculator_schema' );
// ----------------------------------------------------------
// RELATED TOOLS HELPER
// ----------------------------------------------------------
function pkm_get_related_tools( int $current_page_id ): array {
    if ( function_exists( 'pkm_get_related_tools_global' ) ) return pkm_get_related_tools_global( $current_page_id );
    $parent_id = wp_get_post_parent_id( $current_page_id );
    if ( ! $parent_id ) return [];
    $siblings = get_pages( [
        'parent'      => $parent_id,
        'post_status' => 'publish',
        'exclude'     => [ $current_page_id ],
        'sort_column' => 'menu_order',
        'number'      => 12,
    ] );
    if ( empty( $siblings ) ) return [];
    $tools = [];
    foreach ( $siblings as $s ) {
        $tools[] = [
            'title'       => get_field( 'short_tool_title', $s->ID ) ?: $s->post_title,
            'description' => get_field( 'short_description', $s->ID ) ?: '',
            'svg_icon'    => get_field( 'svg_icon', $s->ID ) ?: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>',
            'url'         => get_permalink( $s->ID ),
        ];
    }
    return $tools;
}

// ----------------------------------------------------------
// STRINGS — ALL 5 LANGUAGES (unchanged – keep as is)
// ----------------------------------------------------------
$pkm_cp_strings = [

// ══════════════════════════════════════════════════════════
'en' => [
    // UI
    'title'             => 'Pokémon GO CP Calculator',
    'description'       => 'Calculate Combat Power for any Pokémon — after power-up, at max level, and after evolution. Includes Stardust costs, Shadow/Purified toggle, and Weather Boost.',
    'calculate_btn'     => 'Calculate CP',
    'reset_btn'         => 'Reset',
    'no_related_tools'  => 'No related tools found. Check back soon!',
    'search_placeholder'=> 'Search Pokémon (e.g. Mewtwo)',
    'iv_attack_label'   => 'Attack IV',
    'iv_defense_label'  => 'Defense IV',
    'iv_stamina_label'  => 'Stamina IV',
    'level_label'       => 'Pokémon Level',
    'form_label'        => 'Form',
    'form_normal'       => 'Normal',
    'form_shadow'       => 'Shadow',
    'form_purified'     => 'Purified',
    'weather_label'     => 'Weather Boost',
    'weather_none'      => 'No Boost',
    'preset_label'      => 'Quick Level',
    'preset_raid'       => 'Raid (L20)',
    'preset_research'   => 'Research (L15)',
    'preset_egg'        => 'Egg/Buddy (L20)',
    'preset_weather'    => 'Weather (L25)',
    'preset_max40'      => 'Max (L40)',
    'preset_max50'      => 'Max XL (L50)',
    'result_cp'         => 'Current CP',
    'result_hp'         => 'Current HP',
    'result_max_cp_40'  => 'Max CP (Lv 40)',
    'result_max_cp_50'  => 'Max CP (Lv 50)',
    'result_evo_cp'     => 'Evolution CP',
    'result_stardust'   => 'Stardust to Max',
    'result_candy'      => 'Candy to Max',
    'result_iv_pct'     => 'IV Perfection',
    'no_evolution'      => 'No evolution available',
    'tooltip_shadow'    => 'Shadow: +20% Attack, −20% Defense',
    'tooltip_purified'  => 'Purified: +2 to all IVs (max 15)',
    'tooltip_weather'   => 'Weather-boosted Pokémon caught at +5 levels',
    'tooltip_iv'        => 'Individual Values: 0–15 for each stat',
    'tab_powerup'       => 'Power-Up',
    'tab_maxcp'         => 'Max CP',
    'tab_evolution'     => 'Evolution',
    'noscript_msg'      => 'JavaScript is required for the interactive calculator. You can still read the CP formula and data tables below.',
    // SEO Content
    'meta_title'        => 'Pokémon GO CP Calculator — Calculate Combat Power, Max CP & Evolution CP',
    'meta_desc'         => 'Free Pokémon GO CP calculator. Instantly calculate CP after power-up, max CP at level 40/50, and evolution CP for any Pokémon. Includes Stardust costs.',
    'intro_title'       => 'Pokémon GO CP Calculator: Calculate Combat Power Instantly',
    'intro_content'     => 'The <strong>Pokémon GO CP calculator</strong> on this page lets you calculate the exact Combat Power of any Pokémon after a power-up, at max level, and after evolution — all in one tool. Whether you\'re preparing for a raid, building a PvP team, or deciding which Pokémon to evolve first, knowing the exact CP saves you Stardust and Candy. Enter your Pokémon\'s species, its three IV values (Attack, Defense, Stamina), and the current level. The calculator applies the official CP formula used by Pokémon GO, including the CP Multiplier table for every half-level from 1 to 51. It also accounts for Shadow and Purified form bonuses and Weather Boost. You\'ll get the current CP, the max CP at both level 40 and level 50 (with XL Candy), the HP, the IV perfection percentage, the predicted CP after evolution, and the total Stardust and Candy needed to reach max level. Use the tool above to calculate your Pokémon\'s CP before spending a single piece of Stardust.',
    'howto_title'       => 'How to Use the Pokémon GO CP Calculator',
    'howto_step1'       => 'Type your Pokémon\'s name in the search bar — live results with sprites appear as you type. Click to select your Pokémon.',
    'howto_step2'       => 'Enter the three IV values (Attack, Defense, Stamina) from 0 to 15. Use the Appraise feature in-game to find your IVs, or check with a third-party IV app.',
    'howto_step3'       => 'Set the current Pokémon level with the slider (1–51) or tap a Quick Level preset: Raid (20), Research (15), Weather Boost (25), or Max Level (40/50).',
    'howto_step4'       => 'Click "Calculate CP" to instantly see current CP, max CP at level 40 and 50, HP, evolution CP for all evolutions, IV perfection percentage, and total Stardust + Candy to max out.',
    'info_title'        => 'How CP Is Calculated in Pokémon GO — The Complete Guide',
    'info_content'      => '<p>Combat Power (CP) in Pokémon GO is a single number that represents a Pokémon\'s overall battle strength. It is calculated using the following official formula:</p><p><strong>CP = Floor( (Attack × Defense^0.5 × Stamina^0.5 × CPM²) / 10 )</strong></p><p>Each of the three stats is the sum of the Pokémon\'s base stat and its corresponding IV (0–15). For example, a Mewtwo (base attack 300) with a 15 Attack IV has an effective Attack of 315. The Defense stat is raised to the power of 0.5 (square root), as is the Stamina stat — this means Attack is weighted more heavily in the CP formula, which is why high-Attack Pokémon like Mewtwo have dramatically higher CP than high-Defense Pokémon like Shuckle.</p><p>The <strong>CP Multiplier (CPM)</strong> is a level-based scalar that ranges from 0.094 at level 1 to 0.84029 at level 40 and 0.91708 at level 51. Because CPM is squared in the formula, small increases at high levels produce large CP gains — which is why powering a Pokémon from level 39 to 40 costs significantly more Stardust than going from level 1 to 2.</p><p><strong>Shadow Pokémon</strong> have a 20% boost to Attack and a 20% reduction to Defense in all calculations. This makes Shadow Pokémon higher CP than their Normal counterparts at the same level and IVs, but the Defense reduction means they take more damage in battle. <strong>Purified Pokémon</strong> receive +2 to all IVs (capped at 15), which is why purifying a 13/13/13 Shadow gives you a perfect 15/15/15 Pokémon.</p><p><strong>Weather Boost</strong> in Pokémon GO causes Pokémon caught in the wild during matching weather to appear at level 25 instead of the standard level 1–20 range. They also have a floor of 4 on all IVs instead of 0. This doesn\'t affect the CP formula itself — it just means these Pokémon start at a higher level and IV floor.</p><p><strong>Evolution CP</strong> is predicted by applying the species-specific evolution multiplier to the current CP. For example, Eevee has an average evolution multiplier of about 1.9 when evolving into Vaporeon, Jolteon, or Flareon. Because IVs remain constant through evolution, the IV percentage stays the same — only the base stats change. Always use the calculator above to verify the exact CP before evolving, since the multipliers vary slightly between evolutions.</p><p><strong>Stardust and Candy costs</strong> scale with the Pokémon\'s level at each power-up. Lower-level Pokémon are cheap to power up (200 Stardust per level at level 1–2), but costs rise steeply at higher levels (10,000+ Stardust for the level 39–40 range). XL Candy power-ups from level 40 to 50 require a separate XL Candy resource rather than standard Candy.</p>',
    'info_table_title'  => 'CP Multiplier Table by Pokémon Level',
    'info_table_html'   => '<table class="pkm-calc-table"><thead><tr><th>Level</th><th>CP Multiplier (CPM)</th><th>Stardust per Power-Up</th><th>Candy per Power-Up</th></tr></thead><tbody><tr><td>1</td><td>0.09400</td><td>200</td><td>1</td></tr><tr><td>5</td><td>0.26500</td><td>400</td><td>1</td></tr><tr><td>10</td><td>0.42240</td><td>1,000</td><td>2</td></tr><tr><td>15</td><td>0.51728</td><td>1,900</td><td>3</td></tr><tr><td>20</td><td>0.59740</td><td>2,500</td><td>4</td></tr><tr><td>25</td><td>0.66710</td><td>3,500</td><td>6</td></tr><tr><td>30</td><td>0.73280</td><td>4,500</td><td>8</td></tr><tr><td>35</td><td>0.78500</td><td>6,000</td><td>10</td></tr><tr><td>40</td><td>0.84029</td><td>8,000</td><td>12</td></tr><tr><td>45</td><td>0.87960</td><td>XL Candy</td><td>15 XL</td></tr><tr><td>50</td><td>0.91161</td><td>XL Candy</td><td>20 XL</td></tr></tbody></table>',
    'faq_title'         => 'Pokémon GO CP Calculator — Frequently Asked Questions',
    'faq_q1' => 'How is CP calculated in Pokémon GO?',
    'faq_a1' => 'CP in Pokémon GO is calculated using the formula: CP = (Attack × Defense^0.5 × Stamina^0.5 × CP_Multiplier²) / 10. The Attack stat combines the Pokémon\'s base attack with its Attack IV. Defense and Stamina stats are combined the same way. The CP Multiplier (CPM) depends on the Pokémon\'s current level, ranging from 0.094 at level 1 to 0.84029 at level 40 and 0.91708 at level 51.',
    'faq_q2' => 'What is the maximum CP in Pokémon GO?',
    'faq_a2' => 'The maximum CP in Pokémon GO depends on the Pokémon species and its IVs. With perfect IVs (15/15/15), Slaking has the highest max CP at 4,431, followed by Mewtwo at 4,724 (Shadow) and Eternatus at 5,007. Most meta-relevant Pokémon have max CPs between 3,000 and 4,500 at level 40. At level 50 with XL Candy, these values increase further.',
    'faq_q3' => 'How much CP does a Pokémon get after evolution?',
    'faq_a3' => 'When a Pokémon evolves in Pokémon GO, its CP is multiplied by a species-specific evolution multiplier. For example, Magikarp evolving into Gyarados multiplies its CP by approximately 10.4. IVs remain the same after evolution, so evolving a 100% IV Pokémon gives you a 100% IV evolved form. Use the tool above to calculate the exact CP your Pokémon will have after evolution.',
    'faq_q4' => 'Should I power up a Pokémon before or after evolving?',
    'faq_a4' => 'It is generally more cost-efficient to evolve first, then power up. Since CP multipliers scale with both level and the evolved form\'s base stats, you get more CP per Stardust after evolution. However, if you\'re hunting a high IV Pokémon for PvP Great or Ultra League, check the evolved CP cap first using the calculator above before spending any Stardust.',
    'faq_q5' => 'What are IVs in Pokémon GO?',
    'faq_a5' => 'IVs (Individual Values) are hidden stats in Pokémon GO that add bonus points to a Pokémon\'s Attack, Defense, and Stamina stats. Each IV ranges from 0 to 15. A Pokémon with 15/15/15 IVs (called a "hundo" or 100% IV) has the highest possible CP for its species and level. IVs are determined when the Pokémon is caught or hatched and cannot be changed.',
    'faq_q6' => 'What is a CP Multiplier in Pokémon GO?',
    'faq_a6' => 'The CP Multiplier (CPM) is a level-based value that scales a Pokémon\'s effective stats at each level. At level 1 the CPM is 0.094, and it increases with each half-level up to 0.84029 at level 40 and 0.91708 at level 51. This is why the same Pokémon with the same IVs has dramatically higher CP at level 40 than at level 20.',
    'faq_q7' => 'What are Shadow and Purified Pokémon CP differences?',
    'faq_a7' => 'Shadow Pokémon have a 20% increase in Attack but a 20% decrease in Defense. This slightly affects their CP calculation because Attack is weighted more heavily in the formula. Purified Pokémon gain +2 to all IVs (capped at 15), which can raise a near-perfect Shadow Pokémon to a full 100% IV, making purification worthwhile in some cases. Use the Shadow toggle in the tool above.',
    'faq_q8' => 'What are the best Pokémon to power up in Pokémon GO?',
    'faq_a8' => 'For raids and gym battles, the best Pokémon to power up are those with high max CP and strong move sets: Mewtwo, Rayquaza, Dragonite, Machamp, Kyogre, Groudon, and Garchomp. For PvP Great League, focus on Pokémon that hit specific CP caps efficiently, such as Medicham, Azumarill, and Galarian Stunfisk. Use the CP calculator above to determine exact power-up costs and results.',
    'related_title'     => 'Related Pokémon GO Tools',
    'offpage_title'     => 'Pokémon GO CP Calculator — Off-Page SEO & GSC Guide',
],

// ══════════════════════════════════════════════════════════
'es' => [
    'title'             => 'Calculadora CP Pokémon GO',
    'description'       => 'Calcula el Poder de Combate de cualquier Pokémon tras subir de nivel, al nivel máximo y después de evolucionar. Incluye costes de Polvo Estelar, modo Oscuro/Purificado y Bonificación Climática.',
    'calculate_btn'     => 'Calcular PC',
    'reset_btn'         => 'Reiniciar',
    'no_related_tools'  => 'No se encontraron herramientas relacionadas. ¡Vuelve pronto!',
    'search_placeholder'=> 'Buscar Pokémon (ej. Mewtwo)',
    'iv_attack_label'   => 'IV de Ataque',
    'iv_defense_label'  => 'IV de Defensa',
    'iv_stamina_label'  => 'IV de Aguante',
    'level_label'       => 'Nivel del Pokémon',
    'form_label'        => 'Forma',
    'form_normal'       => 'Normal',
    'form_shadow'       => 'Oscuro',
    'form_purified'     => 'Purificado',
    'weather_label'     => 'Bonificación Climática',
    'weather_none'      => 'Sin bonificación',
    'preset_label'      => 'Nivel Rápido',
    'preset_raid'       => 'Incursión (N20)',
    'preset_research'   => 'Investigación (N15)',
    'preset_egg'        => 'Huevo/Amigo (N20)',
    'preset_weather'    => 'Clima (N25)',
    'preset_max40'      => 'Máx (N40)',
    'preset_max50'      => 'Máx XL (N50)',
    'result_cp'         => 'PC Actual',
    'result_hp'         => 'PS Actuales',
    'result_max_cp_40'  => 'PC Máx (Nv 40)',
    'result_max_cp_50'  => 'PC Máx (Nv 50)',
    'result_evo_cp'     => 'PC tras Evolución',
    'result_stardust'   => 'Polvo Estelar para Máx',
    'result_candy'      => 'Caramelos para Máx',
    'result_iv_pct'     => 'Perfección de IVs',
    'no_evolution'      => 'No hay evolución disponible',
    'tooltip_shadow'    => 'Oscuro: +20% Ataque, −20% Defensa',
    'tooltip_purified'  => 'Purificado: +2 a todos los IVs (máx 15)',
    'tooltip_weather'   => 'Los Pokémon con bonificación climática se capturan en el nivel +5',
    'tooltip_iv'        => 'Valores Individuales: 0–15 para cada estadística',
    'tab_powerup'       => 'Subir Nivel',
    'tab_maxcp'         => 'PC Máximo',
    'tab_evolution'     => 'Evolución',
    'noscript_msg'      => 'Se requiere JavaScript para la calculadora interactiva. Puedes consultar la fórmula de PC y las tablas de datos a continuación.',
    'meta_title'        => 'Calculadora CP Pokémon GO — Calcula Poder de Combate, PC Máximo y PC de Evolución',
    'meta_desc'         => 'Calculadora gratuita de PC para Pokémon GO. Calcula el PC tras subir de nivel, el PC máximo en nivel 40/50 y el PC de evolución para cualquier Pokémon.',
    'intro_title'       => 'Calculadora CP Pokémon GO: Calcula el Poder de Combate al Instante',
    'intro_content'     => 'La <strong>calculadora CP de Pokémon GO</strong> de esta página te permite calcular el Poder de Combate exacto de cualquier Pokémon tras subir de nivel, al nivel máximo y después de evolucionar, todo en una sola herramienta. Tanto si te preparas para una incursión, construyes un equipo de PvP o decides qué Pokémon evolucionar primero, conocer el PC exacto te ahorra Polvo Estelar y Caramelos. Introduce la especie, los tres valores IV (Ataque, Defensa, Aguante) y el nivel actual. La calculadora aplica la fórmula oficial de PC de Pokémon GO, incluyendo la tabla de Multiplicadores de PC para cada medio nivel del 1 al 51. También tiene en cuenta las bonificaciones de forma Oscura y Purificada y la Bonificación Climática. Obtendrás el PC actual, el PC máximo en nivel 40 y 50, los PS, el porcentaje de perfección de IVs, el PC previsto tras la evolución y el total de Polvo Estelar y Caramelos necesarios para llegar al nivel máximo. Usa la herramienta de arriba para calcular el PC de tu Pokémon antes de gastar un solo Polvo Estelar.',
    'howto_title'       => 'Cómo Usar la Calculadora CP de Pokémon GO',
    'howto_step1'       => 'Escribe el nombre de tu Pokémon en la barra de búsqueda — aparecen resultados en tiempo real con sprites mientras escribes. Haz clic para seleccionar tu Pokémon.',
    'howto_step2'       => 'Introduce los tres valores IV (Ataque, Defensa, Aguante) del 0 al 15. Usa la función Valorar del juego para encontrar tus IVs o consulta una app externa de IVs.',
    'howto_step3'       => 'Ajusta el nivel actual del Pokémon con el deslizador (1–51) o pulsa un botón de Nivel Rápido: Incursión (20), Investigación (15), Bonificación Climática (25) o Nivel Máximo (40/50).',
    'howto_step4'       => 'Haz clic en "Calcular PC" para ver al instante el PC actual, el PC máximo en nivel 40 y 50, los PS, el PC de evolución para todas las evoluciones, el porcentaje de perfección de IVs y el total de Polvo Estelar y Caramelos para alcanzar el nivel máximo.',
    'info_title'        => 'Cómo se Calcula el PC en Pokémon GO — La Guía Completa',
    'info_content'      => '<p>El Poder de Combate (PC) en Pokémon GO es un único número que representa la fortaleza general de batalla de un Pokémon. Se calcula con la siguiente fórmula oficial:</p><p><strong>PC = Redondeo( (Ataque × Defensa^0,5 × Aguante^0,5 × CPM²) / 10 )</strong></p><p>Cada una de las tres estadísticas es la suma del stat base del Pokémon y su IV correspondiente (0–15). Por ejemplo, un Mewtwo (ataque base 300) con un IV de Ataque de 15 tiene un Ataque efectivo de 315. La Defensa y el Aguante se elevan a la potencia 0,5 (raíz cuadrada), lo que significa que el Ataque tiene más peso en la fórmula. El <strong>Multiplicador de PC (CPM)</strong> es un escalar basado en el nivel que va de 0,094 en nivel 1 a 0,84029 en nivel 40. Los <strong>Pokémon Oscuros</strong> tienen un 20% más de Ataque y un 20% menos de Defensa. Los <strong>Pokémon Purificados</strong> reciben +2 a todos los IVs (máximo 15). La <strong>Bonificación Climática</strong> hace que los Pokémon capturados en la naturaleza durante el clima correspondiente aparezcan en nivel 25 con un mínimo de IV de 4 en todos los stats. El <strong>PC de Evolución</strong> se predice aplicando el multiplicador de evolución específico de la especie al PC actual. Los IVs no cambian con la evolución. Los costes de Polvo Estelar y Caramelos escalan con el nivel del Pokémon en cada subida de nivel. Usa siempre la calculadora de arriba para verificar el PC exacto antes de evolucionar o subir de nivel.</p>',
    'info_table_title'  => 'Tabla de Multiplicadores de PC por Nivel',
    'info_table_html'   => '<table class="pkm-calc-table"><thead><tr><th>Nivel</th><th>Multiplicador de PC (CPM)</th><th>Polvo Estelar por Subida</th><th>Caramelos por Subida</th></tr></thead><tbody><tr><td>1</td><td>0,09400</td><td>200</td><td>1</td></tr><tr><td>5</td><td>0,26500</td><td>400</td><td>1</td></tr><tr><td>10</td><td>0,42240</td><td>1.000</td><td>2</td></tr><tr><td>15</td><td>0,51728</td><td>1.900</td><td>3</td></tr><tr><td>20</td><td>0,59740</td><td>2.500</td><td>4</td></tr><tr><td>25</td><td>0,66710</td><td>3.500</td><td>6</td></tr><tr><td>30</td><td>0,73280</td><td>4.500</td><td>8</td></tr><tr><td>35</td><td>0,78500</td><td>6.000</td><td>10</td></tr><tr><td>40</td><td>0,84029</td><td>8.000</td><td>12</td></tr><tr><td>45</td><td>0,87960</td><td>Caramelo XL</td><td>15 XL</td></tr><tr><td>50</td><td>0,91161</td><td>Caramelo XL</td><td>20 XL</td></tr></tbody></table>',
    'faq_title'         => 'Calculadora CP Pokémon GO — Preguntas Frecuentes',
    'faq_q1' => '¿Cómo se calcula el PC en Pokémon GO?',
    'faq_a1' => 'El PC en Pokémon GO se calcula con la fórmula: PC = (Ataque × Defensa^0,5 × Aguante^0,5 × CPM²) / 10. El stat de Ataque combina el ataque base del Pokémon con su IV de Ataque. La Defensa y el Aguante se combinan de la misma forma. El Multiplicador de PC (CPM) depende del nivel actual del Pokémon, yendo desde 0,094 en el nivel 1 hasta 0,84029 en el nivel 40.',
    'faq_q2' => '¿Cuál es el PC máximo en Pokémon GO?',
    'faq_a2' => 'El PC máximo en Pokémon GO depende de la especie y sus IVs. Con IVs perfectos (15/15/15), Slaking tiene el PC máximo más alto con 4.431, seguido de Mewtwo Oscuro con 4.724 y Eternatus con 5.007. La mayoría de los Pokémon relevantes en el meta tienen un PC máximo de entre 3.000 y 4.500 en nivel 40. Con Caramelo XL en nivel 50, estos valores aumentan aún más.',
    'faq_q3' => '¿Cuánto PC tendrá mi Pokémon al evolucionar?',
    'faq_a3' => 'Cuando un Pokémon evoluciona en Pokémon GO, su PC se multiplica por un multiplicador específico de evolución. Por ejemplo, un Magikarp que evoluciona a Gyarados multiplica su PC aproximadamente por 10,4. Los IVs no cambian con la evolución, así que un Pokémon con IVs perfectos seguirá teniéndolos al evolucionar. Usa la calculadora de arriba para calcular el PC exacto tras la evolución.',
    'faq_q4' => '¿Vale la pena subir PC antes de evolucionar?',
    'faq_a4' => 'Generalmente, es más eficiente evolucionar primero y luego subir de nivel. Dado que los multiplicadores de PC escalan con el nivel y los stats base de la forma evolucionada, obtienes más PC por Polvo Estelar después de evolucionar. Sin embargo, si juegas en la Liga Gran o Ultra de PvP, comprueba primero el límite de PC evolucionado con la calculadora antes de gastar Polvo Estelar.',
    'faq_q5' => '¿Qué son los IVs en Pokémon GO?',
    'faq_a5' => 'Los IVs (Valores Individuales) son estadísticas ocultas en Pokémon GO que añaden puntos adicionales a los stats de Ataque, Defensa y Aguante. Cada IV va de 0 a 15. Un Pokémon con 15/15/15 IVs (llamado "hundo" o 100% IV) tiene el PC máximo posible para su especie y nivel. Los IVs se determinan cuando el Pokémon es capturado o eclosionado y no se pueden cambiar.',
    'faq_q6' => '¿Qué es el Multiplicador de PC en Pokémon GO?',
    'faq_a6' => 'El Multiplicador de PC (CPM) es un valor basado en el nivel que escala los stats efectivos de un Pokémon. En nivel 1 el CPM es 0,094 y aumenta con cada medio nivel hasta 0,84029 en nivel 40. Por eso el mismo Pokémon con los mismos IVs tiene un PC mucho mayor en nivel 40 que en nivel 20.',
    'faq_q7' => '¿Cuál es la diferencia de PC entre Pokémon Oscuros y Purificados?',
    'faq_a7' => 'Los Pokémon Oscuros tienen un 20% más de Ataque pero un 20% menos de Defensa. Los Pokémon Purificados ganan +2 en todos los IVs (máximo 15), lo que puede elevar a un Pokémon Oscuro casi perfecto a un 100% IV. Usa el interruptor Oscuro/Purificado de la calculadora de arriba para comparar.',
    'faq_q8' => '¿Cuáles son los mejores Pokémon para subir de nivel en Pokémon GO?',
    'faq_a8' => 'Para incursiones y gimnasios, los mejores Pokémon son aquellos con alto PC máximo y movimientos potentes: Mewtwo, Rayquaza, Dragonite, Machamp, Kyogre, Groudon y Garchomp. Para el PvP, céntrate en Pokémon que alcancen topes de PC eficientes para cada liga. Usa la calculadora CP de arriba para calcular los costes exactos de subida y los resultados.',
    'related_title'     => 'Herramientas Relacionadas de Pokémon GO',
    'offpage_title'     => 'Calculadora CP Pokémon GO — Guía SEO y Google Search Console',
],

// ══════════════════════════════════════════════════════════
'pt-br' => [
    'title'             => 'Calculadora de PC Pokémon GO',
    'description'       => 'Calcule o Poder de Combate de qualquer Pokémon após melhoramento, no nível máximo e após a evolução. Inclui custos de Pó Estelar, alternância Sombrio/Purificado e Bônus Climático.',
    'calculate_btn'     => 'Calcular PC',
    'reset_btn'         => 'Reiniciar',
    'no_related_tools'  => 'Nenhuma ferramenta relacionada encontrada. Volte em breve!',
    'search_placeholder'=> 'Pesquisar Pokémon (ex: Mewtwo)',
    'iv_attack_label'   => 'IV de Ataque',
    'iv_defense_label'  => 'IV de Defesa',
    'iv_stamina_label'  => 'IV de Vigor',
    'level_label'       => 'Nível do Pokémon',
    'form_label'        => 'Forma',
    'form_normal'       => 'Normal',
    'form_shadow'       => 'Sombrio',
    'form_purified'     => 'Purificado',
    'weather_label'     => 'Bônus Climático',
    'weather_none'      => 'Sem bônus',
    'preset_label'      => 'Nível Rápido',
    'preset_raid'       => 'Reide (N20)',
    'preset_research'   => 'Pesquisa (N15)',
    'preset_egg'        => 'Ovo/Amigo (N20)',
    'preset_weather'    => 'Clima (N25)',
    'preset_max40'      => 'Máx (N40)',
    'preset_max50'      => 'Máx XL (N50)',
    'result_cp'         => 'PC Atual',
    'result_hp'         => 'PS Atuais',
    'result_max_cp_40'  => 'PC Máx (Nv 40)',
    'result_max_cp_50'  => 'PC Máx (Nv 50)',
    'result_evo_cp'     => 'PC após Evolução',
    'result_stardust'   => 'Pó Estelar para Máx',
    'result_candy'      => 'Balas para Máx',
    'result_iv_pct'     => 'Perfeição de IV',
    'no_evolution'      => 'Nenhuma evolução disponível',
    'tooltip_shadow'    => 'Sombrio: +20% Ataque, −20% Defesa',
    'tooltip_purified'  => 'Purificado: +2 em todos os IVs (máx 15)',
    'tooltip_weather'   => 'Pokémon com bônus climático capturados no nível +5',
    'tooltip_iv'        => 'Valores Individuais: 0–15 para cada stat',
    'tab_powerup'       => 'Melhorar',
    'tab_maxcp'         => 'PC Máximo',
    'tab_evolution'     => 'Evolução',
    'noscript_msg'      => 'JavaScript é necessário para a calculadora interativa. Você ainda pode ler a fórmula de PC e as tabelas de dados abaixo.',
    'meta_title'        => 'Calculadora de PC Pokémon GO — Calcule Poder de Combate, PC Máximo e PC de Evolução',
    'meta_desc'         => 'Calculadora gratuita de PC para Pokémon GO. Calcule o PC após melhoramento, PC máximo no nível 40/50 e PC de evolução para qualquer Pokémon.',
    'intro_title'       => 'Calculadora de PC Pokémon GO: Calcule o Poder de Combate na Hora',
    'intro_content'     => 'A <strong>calculadora de PC do Pokémon GO</strong> nesta página permite calcular o Poder de Combate exato de qualquer Pokémon após um melhoramento, no nível máximo e após a evolução — tudo em uma só ferramenta. Seja para se preparar para um reide, montar um time de PvP ou decidir qual Pokémon evoluir primeiro, saber o PC exato economiza Pó Estelar e Balas. Insira a espécie, os três valores de IV (Ataque, Defesa, Vigor) e o nível atual. A calculadora aplica a fórmula oficial de PC do Pokémon GO, incluindo a tabela de Multiplicadores de PC para cada meio nível de 1 a 51. Também considera os bônus das formas Sombria e Purificada e o Bônus Climático. Você verá o PC atual, o PC máximo nos níveis 40 e 50 (com Bala XL), os PS, o percentual de perfeição de IV, o PC previsto após a evolução e o total de Pó Estelar e Balas necessários para atingir o nível máximo. Use a ferramenta acima para calcular o PC do seu Pokémon antes de gastar um único Pó Estelar.',
    'howto_title'       => 'Como Usar a Calculadora de PC do Pokémon GO',
    'howto_step1'       => 'Digite o nome do seu Pokémon na barra de pesquisa — resultados ao vivo com sprites aparecem enquanto você digita. Clique para selecionar seu Pokémon.',
    'howto_step2'       => 'Insira os três valores de IV (Ataque, Defesa, Vigor) de 0 a 15. Use o recurso Avaliar no jogo para encontrar seus IVs ou consulte um aplicativo externo de IV.',
    'howto_step3'       => 'Defina o nível atual do Pokémon com o controle deslizante (1–51) ou toque em um botão de Nível Rápido: Reide (20), Pesquisa (15), Bônus Climático (25) ou Nível Máximo (40/50).',
    'howto_step4'       => 'Clique em "Calcular PC" para ver instantaneamente o PC atual, PC máximo nos níveis 40 e 50, PS, PC de evolução para todas as evoluções, percentual de perfeição de IV e total de Pó Estelar e Balas para atingir o nível máximo.',
    'info_title'        => 'Como o PC é Calculado no Pokémon GO — O Guia Completo',
    'info_content'      => '<p>O Poder de Combate (PC) no Pokémon GO é um número único que representa a força geral de batalha de um Pokémon. É calculado usando a seguinte fórmula oficial:</p><p><strong>PC = Arredondamento( (Ataque × Defesa^0,5 × Vigor^0,5 × CPM²) / 10 )</strong></p><p>Cada um dos três stats é a soma do stat base do Pokémon e seu IV correspondente (0–15). Por exemplo, um Mewtwo (ataque base 300) com IV de Ataque 15 tem um Ataque efetivo de 315. O <strong>Multiplicador de PC (CPM)</strong> é um escalar baseado em nível que vai de 0,094 no nível 1 a 0,84029 no nível 40. Os <strong>Pokémon Sombrios</strong> têm 20% mais Ataque e 20% menos Defesa. Os <strong>Pokémon Purificados</strong> recebem +2 em todos os IVs (máximo 15). O <strong>Bônus Climático</strong> faz com que os Pokémon capturados na natureza durante o clima correspondente apareçam no nível 25. O <strong>PC de Evolução</strong> é previsto aplicando o multiplicador de evolução específico da espécie ao PC atual. Use sempre a calculadora acima para verificar o PC exato antes de evoluir ou melhorar.</p>',
    'info_table_title'  => 'Tabela de Multiplicadores de PC por Nível',
    'info_table_html'   => '<table class="pkm-calc-table"><thead><tr><th>Nível</th><th>Multiplicador de PC (CPM)</th><th>Pó Estelar por Melhoria</th><th>Balas por Melhoria</th></tr></thead><tbody><tr><td>1</td><td>0,09400</td><td>200</td><td>1</td></tr><tr><td>5</td><td>0,26500</td><td>400</td><td>1</td></tr><tr><td>10</td><td>0,42240</td><td>1.000</td><td>2</td></tr><tr><td>15</td><td>0,51728</td><td>1.900</td><td>3</td></tr><tr><td>20</td><td>0,59740</td><td>2.500</td><td>4</td></tr><tr><td>25</td><td>0,66710</td><td>3.500</td><td>6</td></tr><tr><td>30</td><td>0,73280</td><td>4.500</td><td>8</td></tr><tr><td>35</td><td>0,78500</td><td>6.000</td><td>10</td></tr><tr><td>40</td><td>0,84029</td><td>8.000</td><td>12</td></tr><tr><td>45</td><td>0,87960</td><td>Bala XL</td><td>15 XL</td></tr><tr><td>50</td><td>0,91161</td><td>Bala XL</td><td>20 XL</td></tr></tbody></table>',
    'faq_title'         => 'Calculadora de PC Pokémon GO — Perguntas Frequentes',
    'faq_q1' => 'Como é calculado o PC no Pokémon GO?',
    'faq_a1' => 'O PC no Pokémon GO é calculado pela fórmula: PC = (Ataque × Defesa^0,5 × Vigor^0,5 × CPM²) / 10. O stat de Ataque combina o ataque base do Pokémon com seu IV de Ataque. Defesa e Vigor são combinados da mesma forma. O Multiplicador de PC (CPM) depende do nível atual do Pokémon, variando de 0,094 no nível 1 até 0,84029 no nível 40.',
    'faq_q2' => 'Qual é o PC máximo no Pokémon GO?',
    'faq_a2' => 'O PC máximo no Pokémon GO depende da espécie e dos seus IVs. Com IVs perfeitos (15/15/15), Slaking tem o maior PC máximo com 4.431, seguido por Mewtwo Sombrio com 4.724 e Eternatus com 5.007. A maioria dos Pokémon relevantes no meta têm PC máximo entre 3.000 e 4.500 no nível 40.',
    'faq_q3' => 'Quanto PC meu Pokémon terá ao evoluir?',
    'faq_a3' => 'Quando um Pokémon evolui no Pokémon GO, seu PC é multiplicado por um multiplicador de evolução específico da espécie. Por exemplo, um Magikarp que evolui para Gyarados tem seu PC multiplicado por aproximadamente 10,4. Os IVs não mudam com a evolução. Use a calculadora acima para calcular o PC exato após a evolução.',
    'faq_q4' => 'Vale a pena aumentar o PC antes de evoluir?',
    'faq_a4' => 'Geralmente é mais eficiente evoluir primeiro e depois melhorar o nível. Como os multiplicadores de PC escalam com o nível e os stats base da forma evoluída, você obtém mais PC por Pó Estelar após a evolução. Porém, se jogar na Liga Grande ou Ultra do PvP, verifique primeiro o teto de PC evoluído com a calculadora antes de gastar Pó Estelar.',
    'faq_q5' => 'O que são IVs no Pokémon GO?',
    'faq_a5' => 'IVs (Valores Individuais) são estatísticas ocultas no Pokémon GO que adicionam pontos bônus aos stats de Ataque, Defesa e Vigor. Cada IV vai de 0 a 15. Um Pokémon com 15/15/15 IVs (chamado de "hundo" ou 100% IV) tem o maior PC possível para sua espécie e nível.',
    'faq_q6' => 'O que é o Multiplicador de PC no Pokémon GO?',
    'faq_a6' => 'O Multiplicador de PC (CPM) é um valor baseado em nível que escala os stats efetivos de um Pokémon. No nível 1 o CPM é 0,094 e aumenta com cada meio nível até 0,84029 no nível 40. É por isso que o mesmo Pokémon com os mesmos IVs tem um PC muito maior no nível 40 do que no nível 20.',
    'faq_q7' => 'Qual é a diferença de PC entre Pokémon Sombrios e Purificados?',
    'faq_a7' => 'Pokémon Sombrios têm 20% mais de Ataque mas 20% menos de Defesa. Pokémon Purificados ganham +2 em todos os IVs (máximo 15), o que pode elevar um Pokémon Sombrio quase perfeito a 100% de IV. Use o seletor Sombrio/Purificado na calculadora acima para comparar.',
    'faq_q8' => 'Quais são os melhores Pokémon para melhorar no Pokémon GO?',
    'faq_a8' => 'Para reides e batalhas de ginásio, os melhores são aqueles com alto PC máximo e ataques fortes: Mewtwo, Rayquaza, Dragonite, Machamp, Kyogre, Groudon e Garchomp. Use a calculadora de PC acima para calcular os custos exatos de melhoria.',
    'related_title'     => 'Ferramentas Relacionadas do Pokémon GO',
    'offpage_title'     => 'Calculadora de PC Pokémon GO — Guia de SEO e Google Search Console',
],

// ══════════════════════════════════════════════════════════
'fr' => [
    'title'             => 'Calculateur CP Pokémon GO',
    'description'       => 'Calculez les PC de n\'importe quel Pokémon après amélioration, au niveau maximum et après évolution. Inclut les coûts en Poussière d\'Étoile, le mode Obscur/Purifié et le bonus météo.',
    'calculate_btn'     => 'Calculer CP',
    'reset_btn'         => 'Réinitialiser',
    'no_related_tools'  => 'Aucun outil connexe trouvé. Revenez bientôt !',
    'search_placeholder'=> 'Chercher Pokémon (ex : Mewtwo)',
    'iv_attack_label'   => 'IV Attaque',
    'iv_defense_label'  => 'IV Défense',
    'iv_stamina_label'  => 'IV Endurance',
    'level_label'       => 'Niveau du Pokémon',
    'form_label'        => 'Forme',
    'form_normal'       => 'Normal',
    'form_shadow'       => 'Obscur',
    'form_purified'     => 'Purifié',
    'weather_label'     => 'Bonus Météo',
    'weather_none'      => 'Sans bonus',
    'preset_label'      => 'Niveau Rapide',
    'preset_raid'       => 'Raid (N20)',
    'preset_research'   => 'Recherche (N15)',
    'preset_egg'        => 'Œuf/Ami (N20)',
    'preset_weather'    => 'Météo (N25)',
    'preset_max40'      => 'Max (N40)',
    'preset_max50'      => 'Max XL (N50)',
    'result_cp'         => 'CP Actuel',
    'result_hp'         => 'PV Actuels',
    'result_max_cp_40'  => 'CP Max (Nv 40)',
    'result_max_cp_50'  => 'CP Max (Nv 50)',
    'result_evo_cp'     => 'CP après Évolution',
    'result_stardust'   => 'Poussière d\'Étoile pour Max',
    'result_candy'      => 'Bonbons pour Max',
    'result_iv_pct'     => 'Perfection IV',
    'no_evolution'      => 'Aucune évolution disponible',
    'tooltip_shadow'    => 'Obscur : +20% Attaque, −20% Défense',
    'tooltip_purified'  => 'Purifié : +2 à tous les IV (max 15)',
    'tooltip_weather'   => 'Pokémon avec bonus météo capturés au niveau +5',
    'tooltip_iv'        => 'Valeurs Individuelles : 0–15 pour chaque stat',
    'tab_powerup'       => 'Améliorer',
    'tab_maxcp'         => 'CP Maximum',
    'tab_evolution'     => 'Évolution',
    'noscript_msg'      => 'JavaScript est requis pour la calculatrice interactive. Vous pouvez toujours consulter la formule CP et les tableaux de données ci-dessous.',
    'meta_title'        => 'Calculateur CP Pokémon GO — Calculez les PC, CP Max et CP d\'Évolution',
    'meta_desc'         => 'Calculateur CP Pokémon GO gratuit. Calculez les CP après amélioration, le CP maximum au niveau 40/50 et le CP d\'évolution pour n\'importe quel Pokémon.',
    'intro_title'       => 'Calculateur CP Pokémon GO : Calculez les PC Instantanément',
    'intro_content'     => 'Le <strong>calculateur CP Pokémon GO</strong> sur cette page vous permet de calculer les PC exacts de n\'importe quel Pokémon après une amélioration, au niveau maximum et après évolution — le tout dans un seul outil. Que vous vous prépariez pour un raid, construisiez une équipe PvP ou décidiez quel Pokémon faire évoluer en premier, connaître les CP exacts vous fait économiser de la Poussière d\'Étoile et des Bonbons. Entrez l\'espèce, les trois valeurs IV (Attaque, Défense, Endurance) et le niveau actuel. Le calculateur applique la formule officielle de CP de Pokémon GO, y compris le tableau des Multiplicateurs de CP pour chaque demi-niveau de 1 à 51. Il tient également compte des bonus de forme Obscure et Purifiée et du Bonus Météo. Vous obtiendrez les CP actuels, les CP max aux niveaux 40 et 50 (avec Bonbons XL), les PV, le pourcentage de perfection des IV, les CP prévus après évolution et le total de Poussière d\'Étoile et Bonbons nécessaires pour atteindre le niveau maximum. Utilisez l\'outil ci-dessus pour calculer les CP de votre Pokémon avant de dépenser le moindre Poussière d\'Étoile.',
    'howto_title'       => 'Comment Utiliser le Calculateur CP Pokémon GO',
    'howto_step1'       => 'Tapez le nom de votre Pokémon dans la barre de recherche — des résultats en direct avec sprites apparaissent au fil de la frappe. Cliquez pour sélectionner votre Pokémon.',
    'howto_step2'       => 'Entrez les trois valeurs IV (Attaque, Défense, Endurance) de 0 à 15. Utilisez la fonction Évaluation dans le jeu pour trouver vos IV ou consultez une application tierce.',
    'howto_step3'       => 'Définissez le niveau actuel du Pokémon avec le curseur (1–51) ou appuyez sur un bouton Niveau Rapide : Raid (20), Recherche (15), Bonus Météo (25) ou Niveau Max (40/50).',
    'howto_step4'       => 'Cliquez sur "Calculer CP" pour voir instantanément les CP actuels, CP max aux niveaux 40 et 50, PV, CP d\'évolution pour toutes les évolutions, pourcentage de perfection IV et total de Poussière d\'Étoile et Bonbons pour atteindre le niveau maximum.',
    'info_title'        => 'Comment le CP est Calculé dans Pokémon GO — Le Guide Complet',
    'info_content'      => '<p>Les Points de Combat (PC) dans Pokémon GO sont un nombre unique représentant la force de combat globale d\'un Pokémon. Ils sont calculés avec la formule officielle suivante :</p><p><strong>CP = Arrondi( (Attaque × Défense^0,5 × Endurance^0,5 × CPM²) / 10 )</strong></p><p>Chacun des trois stats est la somme du stat de base du Pokémon et de son IV correspondant (0–15). Le <strong>Multiplicateur de CP (CPM)</strong> est un scalaire basé sur le niveau allant de 0,094 au niveau 1 à 0,84029 au niveau 40. Les <strong>Pokémon Obscurs</strong> ont 20 % d\'Attaque en plus et 20 % de Défense en moins. Les <strong>Pokémon Purifiés</strong> reçoivent +2 à tous les IV (maximum 15). Le <strong>Bonus Météo</strong> fait apparaître les Pokémon sauvages au niveau 25. Le <strong>CP d\'Évolution</strong> est prédit en appliquant le multiplicateur d\'évolution propre à l\'espèce au CP actuel. Utilisez toujours le calculateur ci-dessus pour vérifier le CP exact avant de faire évoluer ou améliorer.</p>',
    'info_table_title'  => 'Tableau des Multiplicateurs de CP par Niveau',
    'info_table_html'   => '<table class="pkm-calc-table"><thead><tr><th>Niveau</th><th>Multiplicateur CP (CPM)</th><th>Poussière d\'Étoile par Amélioration</th><th>Bonbons par Amélioration</th></tr></thead><tbody><tr><td>1</td><td>0,09400</td><td>200</td><td>1</td></tr><tr><td>5</td><td>0,26500</td><td>400</td><td>1</td></tr><tr><td>10</td><td>0,42240</td><td>1 000</td><td>2</td></tr><tr><td>15</td><td>0,51728</td><td>1 900</td><td>3</td></tr><tr><td>20</td><td>0,59740</td><td>2 500</td><td>4</td></tr><tr><td>25</td><td>0,66710</td><td>3 500</td><td>6</td></tr><tr><td>30</td><td>0,73280</td><td>4 500</td><td>8</td></tr><tr><td>35</td><td>0,78500</td><td>6 000</td><td>10</td></tr><tr><td>40</td><td>0,84029</td><td>8 000</td><td>12</td></tr><tr><td>45</td><td>0,87960</td><td>Bonbon XL</td><td>15 XL</td></tr><tr><td>50</td><td>0,91161</td><td>Bonbon XL</td><td>20 XL</td></tr></tbody></table>',
    'faq_title'         => 'Calculateur CP Pokémon GO — Foire Aux Questions',
    'faq_q1' => 'Comment est calculé le CP dans Pokémon GO ?',
    'faq_a1' => 'Le CP dans Pokémon GO est calculé avec la formule : CP = (Attaque × Défense^0,5 × Endurance^0,5 × CPM²) / 10. La stat d\'Attaque combine l\'attaque de base du Pokémon et son IV d\'Attaque. Défense et Endurance sont combinées de la même façon. Le Multiplicateur de CP (CPM) dépend du niveau actuel du Pokémon, allant de 0,094 au niveau 1 à 0,84029 au niveau 40.',
    'faq_q2' => 'Quel est le CP maximum dans Pokémon GO ?',
    'faq_a2' => 'Le CP maximum dans Pokémon GO dépend de l\'espèce et de ses IV. Avec des IV parfaits (15/15/15), Ronflex-Géant a le CP max le plus élevé avec 4 431, suivi de Mewtwo Obscur avec 4 724 et d\'Eternatus avec 5 007. La plupart des Pokémon pertinents en méta ont un CP max entre 3 000 et 4 500 au niveau 40.',
    'faq_q3' => 'Combien de CP après évolution dans Pokémon GO ?',
    'faq_a3' => 'Quand un Pokémon évolue dans Pokémon GO, son CP est multiplié par un multiplicateur d\'évolution propre à l\'espèce. Par exemple, un Magicarpe qui évolue en Leviator multiplie son CP par environ 10,4. Les IV ne changent pas avec l\'évolution. Utilisez le calculateur ci-dessus pour calculer le CP exact après évolution.',
    'faq_q4' => 'Vaut-il mieux faire évoluer avant ou après avoir amélioré son Pokémon ?',
    'faq_a4' => 'Il est généralement plus économique de faire évoluer d\'abord, puis d\'améliorer. Les multiplicateurs de CP étant calculés sur les stats de base de la forme évoluée, vous obtenez plus de CP par Poussière d\'Étoile après l\'évolution. Cependant, pour le PvP Grande ou Ultra Ligue, vérifiez d\'abord le plafond de CP évolué avec le calculateur avant de dépenser de la Poussière d\'Étoile.',
    'faq_q5' => 'Que sont les IV dans Pokémon GO ?',
    'faq_a5' => 'Les IV (Valeurs Individuelles) sont des statistiques cachées dans Pokémon GO qui ajoutent des points bonus aux stats d\'Attaque, Défense et Endurance. Chaque IV va de 0 à 15. Un Pokémon avec 15/15/15 IV a le CP maximum possible pour son espèce et son niveau. Les IV sont déterminés à la capture ou à l\'éclosion et ne peuvent pas être modifiés.',
    'faq_q6' => 'Qu\'est-ce que le Multiplicateur de CP dans Pokémon GO ?',
    'faq_a6' => 'Le Multiplicateur de CP (CPM) est une valeur basée sur le niveau qui scale les stats effectives d\'un Pokémon. Au niveau 1 le CPM est 0,094 et augmente à chaque demi-niveau jusqu\'à 0,84029 au niveau 40. C\'est pourquoi le même Pokémon avec les mêmes IV a un CP nettement supérieur au niveau 40 qu\'au niveau 20.',
    'faq_q7' => 'Quelle est la différence de CP entre Pokémon Obscurs et Purifiés ?',
    'faq_a7' => 'Les Pokémon Obscurs ont 20 % d\'Attaque en plus mais 20 % de Défense en moins. Les Pokémon Purifiés gagnent +2 dans tous les IV (maximum 15), ce qui peut élever un Pokémon Obscur presque parfait à 100 % IV. Utilisez le bouton Obscur/Purifié dans le calculateur ci-dessus pour comparer.',
    'faq_q8' => 'Quels sont les meilleurs Pokémon à améliorer dans Pokémon GO ?',
    'faq_a8' => 'Pour les raids et les arènes, les meilleurs sont ceux avec un CP max élevé et de bons mouvements : Mewtwo, Rayquaza, Dragonite, Mackogneur, Kyogre, Groudon et Carchacrok. Utilisez le calculateur CP ci-dessus pour déterminer les coûts et résultats d\'amélioration.',
    'related_title'     => 'Outils Connexes Pokémon GO',
    'offpage_title'     => 'Calculateur CP Pokémon GO — Guide SEO et Google Search Console',
],

// ══════════════════════════════════════════════════════════
'de' => [
    'title'             => 'Pokémon GO KP Rechner',
    'description'       => 'Berechne die Kampfpunkte jedes Pokémon nach der Aufwertung, auf dem maximalen Level und nach der Entwicklung. Mit Sternenstaub-Kosten, Schatten/Gereinigt-Schalter und Wetterbonus.',
    'calculate_btn'     => 'KP Berechnen',
    'reset_btn'         => 'Zurücksetzen',
    'no_related_tools'  => 'Keine verwandten Tools gefunden. Schau bald wieder vorbei!',
    'search_placeholder'=> 'Pokémon suchen (z.B. Mewtu)',
    'iv_attack_label'   => 'Angriffs-IV',
    'iv_defense_label'  => 'Verteidigungs-IV',
    'iv_stamina_label'  => 'Ausdauer-IV',
    'level_label'       => 'Pokémon-Level',
    'form_label'        => 'Form',
    'form_normal'       => 'Normal',
    'form_shadow'       => 'Schatten',
    'form_purified'     => 'Gereinigt',
    'weather_label'     => 'Wetterbonus',
    'weather_none'      => 'Kein Bonus',
    'preset_label'      => 'Schnell-Level',
    'preset_raid'       => 'Raid (L20)',
    'preset_research'   => 'Forschung (L15)',
    'preset_egg'        => 'Ei/Kumpel (L20)',
    'preset_weather'    => 'Wetter (L25)',
    'preset_max40'      => 'Max (L40)',
    'preset_max50'      => 'Max XL (L50)',
    'result_cp'         => 'Aktuelle KP',
    'result_hp'         => 'Aktuelle KP',
    'result_max_cp_40'  => 'Max KP (Lv 40)',
    'result_max_cp_50'  => 'Max KP (Lv 50)',
    'result_evo_cp'     => 'Entwicklungs-KP',
    'result_stardust'   => 'Sternenstaub bis Max',
    'result_candy'      => 'Bonbons bis Max',
    'result_iv_pct'     => 'IV-Perfektion',
    'no_evolution'      => 'Keine Entwicklung verfügbar',
    'tooltip_shadow'    => 'Schatten: +20% Angriff, −20% Verteidigung',
    'tooltip_purified'  => 'Gereinigt: +2 auf alle IVs (max 15)',
    'tooltip_weather'   => 'Wettergeboostete Pokémon erscheinen auf Level +5',
    'tooltip_iv'        => 'Individuelle Werte: 0–15 für jeden Stat',
    'tab_powerup'       => 'Aufwerten',
    'tab_maxcp'         => 'Max KP',
    'tab_evolution'     => 'Entwicklung',
    'noscript_msg'      => 'JavaScript wird für den interaktiven Rechner benötigt. Du kannst trotzdem die KP-Formel und die Datentabellen unten lesen.',
    'meta_title'        => 'Pokémon GO KP Rechner — Kampfpunkte, Max KP & Entwicklungs-KP Berechnen',
    'meta_desc'         => 'Kostenloser Pokémon GO KP Rechner. Berechne KP nach Aufwertung, maximale KP auf Level 40/50 und Entwicklungs-KP für jedes Pokémon. Mit Sternenstaub-Kosten.',
    'intro_title'       => 'Pokémon GO KP Rechner: Kampfpunkte Sofort Berechnen',
    'intro_content'     => 'Der <strong>Pokémon GO KP Rechner</strong> auf dieser Seite berechnet die genauen Kampfpunkte jedes Pokémon nach einer Aufwertung, auf dem maximalen Level und nach der Entwicklung — alles in einem einzigen Tool. Ob du dich auf einen Raid vorbereitest, ein PvP-Team aufbaust oder entscheidest, welches Pokémon du zuerst entwickeln möchtest — die genauen KP zu kennen spart Sternenstaub und Bonbons. Gib die Art, die drei IV-Werte (Angriff, Verteidigung, Ausdauer) und das aktuelle Level ein. Der Rechner wendet die offizielle KP-Formel von Pokémon GO an, einschließlich der KP-Multiplikatortabelle für jedes Halblevel von 1 bis 51. Er berücksichtigt auch Schatten- und Gereinigte-Form-Boni sowie den Wetterbonus. Du erhältst die aktuellen KP, die maximalen KP auf Level 40 und 50 (mit XL-Bonbons), die KP, den IV-Perfektionsprozentsatz, die vorhergesagten KP nach der Entwicklung und den gesamten Sternenstaub und die Bonbons, die zum Erreichen des maximalen Levels benötigt werden. Nutze das Tool oben, um die KP deines Pokémon zu berechnen, bevor du einen einzigen Sternenstaub ausgibst.',
    'howto_title'       => 'So Verwendest Du den Pokémon GO KP Rechner',
    'howto_step1'       => 'Tippe den Namen deines Pokémon in die Suchleiste — Live-Ergebnisse mit Sprites erscheinen während der Eingabe. Klicke zur Auswahl deines Pokémon.',
    'howto_step2'       => 'Gib die drei IV-Werte (Angriff, Verteidigung, Ausdauer) von 0 bis 15 ein. Nutze die Bewerten-Funktion im Spiel für deine IVs oder eine Drittanbieter-IV-App.',
    'howto_step3'       => 'Stelle das aktuelle Pokémon-Level mit dem Schieberegler (1–51) ein oder tippe auf einen Schnell-Level-Knopf: Raid (20), Forschung (15), Wetterbonus (25) oder Max-Level (40/50).',
    'howto_step4'       => 'Klicke auf "KP Berechnen", um sofort die aktuellen KP, Max-KP auf Level 40 und 50, KP, Entwicklungs-KP für alle Entwicklungen, IV-Perfektionsprozentsatz und gesamten Sternenstaub und Bonbons für den Maximalausbau zu sehen.',
    'info_title'        => 'Wie KP in Pokémon GO Berechnet Wird — Der Komplette Leitfaden',
    'info_content'      => '<p>Kampfpunkte (KP) in Pokémon GO sind eine einzige Zahl, die die allgemeine Kampfstärke eines Pokémon repräsentiert. Sie werden mit der folgenden offiziellen Formel berechnet:</p><p><strong>KP = Abrunden( (Angriff × Verteidigung^0,5 × Ausdauer^0,5 × KPM²) / 10 )</strong></p><p>Jeder der drei Stats ist die Summe des Basiswerts des Pokémon und seines entsprechenden IV (0–15). Der <strong>KP-Multiplikator (KPM)</strong> ist ein levelbasierter Skalar, der von 0,094 auf Level 1 bis 0,84029 auf Level 40 reicht. <strong>Schatten-Pokémon</strong> haben 20 % mehr Angriff und 20 % weniger Verteidigung. <strong>Gereinigte Pokémon</strong> erhalten +2 auf alle IVs (maximal 15). Der <strong>Wetterbonus</strong> lässt wild gefangene Pokémon bei passendem Wetter auf Level 25 erscheinen. Die <strong>Entwicklungs-KP</strong> werden vorhergesagt, indem der artspezifische Entwicklungsmultiplikator auf die aktuellen KP angewendet wird. Nutze immer den Rechner oben, um die genauen KP vor dem Entwickeln oder Aufwerten zu überprüfen.</p>',
    'info_table_title'  => 'KP-Multiplikatortabelle nach Pokémon-Level',
    'info_table_html'   => '<table class="pkm-calc-table"><thead><tr><th>Level</th><th>KP-Multiplikator (KPM)</th><th>Sternenstaub pro Aufwertung</th><th>Bonbons pro Aufwertung</th></tr></thead><tbody><tr><td>1</td><td>0,09400</td><td>200</td><td>1</td></tr><tr><td>5</td><td>0,26500</td><td>400</td><td>1</td></tr><tr><td>10</td><td>0,42240</td><td>1.000</td><td>2</td></tr><tr><td>15</td><td>0,51728</td><td>1.900</td><td>3</td></tr><tr><td>20</td><td>0,59740</td><td>2.500</td><td>4</td></tr><tr><td>25</td><td>0,66710</td><td>3.500</td><td>6</td></tr><tr><td>30</td><td>0,73280</td><td>4.500</td><td>8</td></tr><tr><td>35</td><td>0,78500</td><td>6.000</td><td>10</td></tr><tr><td>40</td><td>0,84029</td><td>8.000</td><td>12</td></tr><tr><td>45</td><td>0,87960</td><td>XL-Bonbon</td><td>15 XL</td></tr><tr><td>50</td><td>0,91161</td><td>XL-Bonbon</td><td>20 XL</td></tr></tbody></table>',
    'faq_title'         => 'Pokémon GO KP Rechner — Häufig Gestellte Fragen',
    'faq_q1' => 'Wie wird KP in Pokémon GO berechnet?',
    'faq_a1' => 'KP in Pokémon GO wird mit der Formel berechnet: KP = (Angriff × Verteidigung^0,5 × Ausdauer^0,5 × KPM²) / 10. Der Angriffswert kombiniert den Basisangriff des Pokémon mit seinem Angriffs-IV. Verteidigung und Ausdauer werden genauso kombiniert. Der KP-Multiplikator (KPM) hängt vom aktuellen Level des Pokémon ab und reicht von 0,094 auf Level 1 bis 0,84029 auf Level 40.',
    'faq_q2' => 'Was ist das maximale KP in Pokémon GO?',
    'faq_a2' => 'Das maximale KP in Pokémon GO hängt von der Art und den IVs ab. Mit perfekten IVs (15/15/15) hat Relaxo-Max das höchste maximale KP mit 4.431, gefolgt von Schatten-Mewtu mit 4.724 und Eternatus mit 5.007. Die meisten Meta-relevanten Pokémon haben maximale KP zwischen 3.000 und 4.500 auf Level 40.',
    'faq_q3' => 'Wie viel KP hat ein Pokémon nach der Entwicklung?',
    'faq_a3' => 'Wenn ein Pokémon in Pokémon GO entwickelt wird, wird seine KP mit einem artspezifischen Entwicklungsmultiplikator multipliziert. Ein Karpador, das zu Garados entwickelt wird, multipliziert seine KP beispielsweise um etwa 10,4. Die IVs bleiben nach der Entwicklung gleich. Nutze den Rechner oben, um die genauen KP nach der Entwicklung zu berechnen.',
    'faq_q4' => 'Lohnt es sich, vor oder nach der Entwicklung aufzuwerten?',
    'faq_a4' => 'Es ist im Allgemeinen kosteneffizienter, zuerst zu entwickeln und dann aufzuwerten. Da KP-Multiplikatoren mit dem Level und den Basiswerten der entwickelten Form skalieren, erhältst du nach der Entwicklung mehr KP pro Sternenstaub. Wenn du jedoch PvP in der Groß- oder Hyperliga spielst, prüfe zuerst die entwickelte KP-Obergrenze mit dem Rechner.',
    'faq_q5' => 'Was sind IVs in Pokémon GO?',
    'faq_a5' => 'IVs (Individuelle Werte) sind versteckte Stats in Pokémon GO, die Bonuspunkte zu den Angriffs-, Verteidigungs- und Ausdauer-Stats eines Pokémon hinzufügen. Jeder IV reicht von 0 bis 15. Ein Pokémon mit 15/15/15 IVs hat die höchstmögliche KP für seine Art und sein Level. IVs werden beim Fangen oder Schlüpfen bestimmt und können nicht geändert werden.',
    'faq_q6' => 'Was ist der KP-Multiplikator in Pokémon GO?',
    'faq_a6' => 'Der KP-Multiplikator (KPM) ist ein levelbasierter Wert, der die effektiven Stats eines Pokémon auf jedem Level skaliert. Auf Level 1 beträgt der KPM 0,094 und steigt mit jedem Halblevel auf bis zu 0,84029 auf Level 40. Deshalb hat dasselbe Pokémon mit denselben IVs auf Level 40 deutlich höhere KP als auf Level 20.',
    'faq_q7' => 'Was ist der KP-Unterschied zwischen Schatten- und gereinigten Pokémon?',
    'faq_a7' => 'Schatten-Pokémon haben 20 % mehr Angriff, aber 20 % weniger Verteidigung. Gereinigte Pokémon gewinnen +2 auf alle IVs (maximal 15), was ein fast perfektes Schatten-Pokémon auf 100 % IV heben kann. Nutze den Schatten/Gereinigt-Schalter im Rechner oben zum Vergleich.',
    'faq_q8' => 'Welche Pokémon lohnen sich am meisten aufzuwerten in Pokémon GO?',
    'faq_a8' => 'Für Raids und Arenakämpfe sind die besten Pokémon jene mit hohem maximalen KP und starken Attacken: Mewtu, Rayquaza, Dragoran, Machomei, Kyogre, Groudon und Knakrack. Nutze den KP-Rechner oben, um genaue Aufwertungskosten zu berechnen.',
    'related_title'     => 'Verwandte Pokémon GO Tools',
    'offpage_title'     => 'Pokémon GO KP Rechner — Off-Page SEO & Google Search Console Leitfaden',
],

]; // end $pkm_cp_strings

// ----------------------------------------------------------
// SHORTCODE
// ----------------------------------------------------------
function pkm_cp_calculator_calc() {
    global $pkm_current_lang, $pkm_cp_strings;
    $lang = $pkm_current_lang ?? 'en';
    $t    = $pkm_cp_strings[ $lang ] ?? $pkm_cp_strings['en'];

    // ── AD SLOTS (Loaded dynamically from Admin Settings; renders only when code is provided) ──
    $ad_slot_a = get_setting('ad_slot_top', get_setting('ad_header_code', '')); // Top banner
    $ad_slot_b = get_setting('ad_slot_below_result', ''); // Below result
    $ad_slot_c = get_setting('ad_slot_mid_content', ''); // Content break
    $ad_slot_d = get_setting('ad_slot_mid_faq', ''); // Mid-FAQ
    $ad_slot_e = get_setting('ad_slot_sidebar', ''); // Sidebar 300x600 (desktop only, hidden < 1024px)
    $ad_slot_f = get_setting('ad_slot_bottom', ''); // Bottom

    $pkm_render_ad = function( string $slot, string $cls = '' ): string {
        return pkm_render_ad( $slot, $cls );
    };

    // ── POKEMON JS DATA ───────────────────────────────────
    $js_data = array_map( function( $p ) {
        return [
            'id'     => $p['id'] ?? 0,
            'name'   => $p['name'] ?? '',
            'types'  => array_values( $p['types'] ?? [] ),
            'stats'  => $p['stats'] ?? [],
            'sprite' => trim( $p['sprite_default'] ?? '' ),
        ];
    }, get_pokemon_data() );

    // ── EVOLUTION MULTIPLIERS (unchanged) ─────────────────
    $evo_data = [
    'bulbasaur'=>[['ivysaur',1.59],['venusaur',2.34]],
    'ivysaur'=>[['venusaur',1.47]],
    'charmander'=>[['charmeleon',1.52],['charizard',2.19]],
    'charmeleon'=>[['charizard',1.44]],
    'squirtle'=>[['wartortle',1.51],['blastoise',2.10]],
    'wartortle'=>[['blastoise',1.39]],
    'caterpie'=>[['metapod',1.06],['butterfree',1.35]],
    'metapod'=>[['butterfree',1.28]],
    'weedle'=>[['kakuna',1.05],['beedrill',1.35]],
    'kakuna'=>[['beedrill',1.29]],
    'pidgey'=>[['pidgeotto',1.58],['pidgeot',2.35]],
    'pidgeotto'=>[['pidgeot',1.49]],
    'rattata'=>[['raticate',1.47]],
    'spearow'=>[['fearow',1.73]],
    'ekans'=>[['arbok',1.63]],
    'pikachu'=>[['raichu',1.68]],
    'sandshrew'=>[['sandslash',1.74]],
    'nidoran-f'=>[['nidorina',1.39],['nidoqueen',2.04]],
    'nidorina'=>[['nidoqueen',1.47]],
    'nidoran-m'=>[['nidorino',1.38],['nidoking',2.05]],
    'nidorino'=>[['nidoking',1.49]],
    'clefairy'=>[['clefable',1.73]],
    'vulpix'=>[['ninetales',1.73]],
    'jigglypuff'=>[['wigglytuff',1.73]],
    'zubat'=>[['golbat',1.56],['crobat',2.16]],
    'golbat'=>[['crobat',1.38]],
    'oddish'=>[['gloom',1.52],['vileplume',2.03]],
    'gloom'=>[['vileplume',1.34],['bellossom',1.49]],
    'paras'=>[['parasect',1.61]],
    'venonat'=>[['venomoth',1.69]],
    'diglett'=>[['dugtrio',1.68]],
    'meowth'=>[['persian',1.54]],
    'psyduck'=>[['golduck',1.72]],
    'mankey'=>[['primeape',1.74]],
    'growlithe'=>[['arcanine',1.97]],
    'poliwag'=>[['poliwhirl',1.44],['poliwrath',2.07]],
    'poliwhirl'=>[['poliwrath',1.44],['politoed',1.44]],
    'abra'=>[['kadabra',1.70],['alakazam',2.28]],
    'kadabra'=>[['alakazam',1.34]],
    'machop'=>[['machoke',1.56],['machamp',2.27]],
    'machoke'=>[['machamp',1.46]],
    'bellsprout'=>[['weepinbell',1.49],['victreebel',2.19]],
    'weepinbell'=>[['victreebel',1.47]],
    'tentacool'=>[['tentacruel',1.68]],
    'geodude'=>[['graveler',1.60],['golem',2.18]],
    'graveler'=>[['golem',1.37]],
    'ponyta'=>[['rapidash',1.66]],
    'slowpoke'=>[['slowbro',1.65],['slowking',1.65]],
    'magnemite'=>[['magneton',1.65],['magnezone',2.20]],
    'magneton'=>[['magnezone',1.33]],
    'doduo'=>[['dodrio',1.74]],
    'seel'=>[['dewgong',1.50]],
    'grimer'=>[['muk',1.73]],
    'shellder'=>[['cloyster',2.03]],
    'gastly'=>[['haunter',1.61],['gengar',2.18]],
    'haunter'=>[['gengar',1.36]],
    'drowzee'=>[['hypno',1.75]],
    'krabby'=>[['kingler',1.74]],
    'voltorb'=>[['electrode',1.64]],
    'exeggcute'=>[['exeggutor',2.01]],
    'cubone'=>[['marowak',1.72]],
    'horsea'=>[['seadra',1.64],['kingdra',2.08]],
    'seadra'=>[['kingdra',1.27]],
    'goldeen'=>[['seaking',1.73]],
    'staryu'=>[['starmie',1.83]],
    'magikarp'=>[['gyarados',10.42]],
    'eevee'=>[['vaporeon',2.18],['jolteon',1.83],['flareon',2.12],['espeon',2.26],['umbreon',1.60],['leafeon',2.18],['glaceon',2.08],['sylveon',2.09]],
    'omanyte'=>[['omastar',1.73]],
    'kabuto'=>[['kabutops',1.71]],
    'dratini'=>[['dragonair',1.61],['dragonite',2.42]],
    'dragonair'=>[['dragonite',1.50]],
    'chikorita'=>[['bayleef',1.49],['meganium',2.09]],
    'bayleef'=>[['meganium',1.41]],
    'cyndaquil'=>[['quilava',1.50],['typhlosion',2.18]],
    'quilava'=>[['typhlosion',1.46]],
    'totodile'=>[['croconaw',1.49],['feraligatr',2.12]],
    'croconaw'=>[['feraligatr',1.42]],
    'sentret'=>[['furret',1.62]],
    'hoothoot'=>[['noctowl',1.61]],
    'ledyba'=>[['ledian',1.50]],
    'spinarak'=>[['ariados',1.62]],
    'mareep'=>[['flaaffy',1.45],['ampharos',1.95]],
    'flaaffy'=>[['ampharos',1.35]],
    'marill'=>[['azumarill',1.53]],
    'hoppip'=>[['skiploom',1.33],['jumpluff',1.60]],
    'skiploom'=>[['jumpluff',1.21]],
    'sunkern'=>[['sunflora',1.90]],
    'yanma'=>[['yanmega',1.60]],
    'wooper'=>[['quagsire',1.75]],
    'murkrow'=>[['honchkrow',1.71]],
    'misdreavus'=>[['mismagius',1.71]],
    'pineco'=>[['forretress',1.70]],
    'gligar'=>[['gliscor',1.68]],
    'sneasel'=>[['weavile',1.63]],
    'swinub'=>[['piloswine',1.56],['mamoswine',2.22]],
    'piloswine'=>[['mamoswine',1.43]],
    'remoraid'=>[['octillery',1.58]],
    'houndour'=>[['houndoom',1.76]],
    'phanpy'=>[['donphan',1.85]],
    'porygon'=>[['porygon2',1.48],['porygon-z',2.06]],
    'porygon2'=>[['porygon-z',1.40]],
    'treecko'=>[['grovyle',1.49],['sceptile',2.07]],
    'grovyle'=>[['sceptile',1.40]],
    'torchic'=>[['combusken',1.51],['blaziken',2.14]],
    'combusken'=>[['blaziken',1.42]],
    'mudkip'=>[['marshtomp',1.51],['swampert',2.08]],
    'marshtomp'=>[['swampert',1.38]],
    'poochyena'=>[['mightyena',1.71]],
    'ralts'=>[['kirlia',1.45],['gardevoir',2.09],['gallade',1.99]],
    'kirlia'=>[['gardevoir',1.44],['gallade',1.37]],
    'shroomish'=>[['breloom',1.73]],
    'slakoth'=>[['vigoroth',1.56],['slaking',2.22]],
    'vigoroth'=>[['slaking',1.42]],
    'nincada'=>[['ninjask',1.69]],
    'electrike'=>[['manectric',1.72]],
    'roselia'=>[['roserade',1.84]],
    'carvanha'=>[['sharpedo',1.71]],
    'wailmer'=>[['wailord',1.57]],
    'trapinch'=>[['vibrava',1.32],['flygon',1.93]],
    'vibrava'=>[['flygon',1.46]],
    'cacnea'=>[['cacturne',1.75]],
    'swablu'=>[['altaria',2.48]],
    'barboach'=>[['whiscash',1.73]],
    'corphish'=>[['crawdaunt',1.74]],
    'feebas'=>[['milotic',1.98]],
    'shuppet'=>[['banette',1.73]],
    'duskull'=>[['dusclops',1.69],['dusknoir',2.19]],
    'dusclops'=>[['dusknoir',1.29]],
    'snorunt'=>[['glalie',1.66],['froslass',1.60]],
    'spheal'=>[['sealeo',1.50],['walrein',2.02]],
    'sealeo'=>[['walrein',1.35]],
    'clamperl'=>[['huntail',1.60],['gorebyss',1.62]],
    'bagon'=>[['shelgon',1.44],['salamence',2.30]],
    'shelgon'=>[['salamence',1.59]],
    'beldum'=>[['metang',1.51],['metagross',2.11]],
    'metang'=>[['metagross',1.40]],
    'turtwig'=>[['grotle',1.49],['torterra',2.10]],
    'grotle'=>[['torterra',1.41]],
    'chimchar'=>[['monferno',1.51],['infernape',2.13]],
    'monferno'=>[['infernape',1.41]],
    'piplup'=>[['prinplup',1.48],['empoleon',2.04]],
    'prinplup'=>[['empoleon',1.38]],
    'starly'=>[['staravia',1.56],['staraptor',2.23]],
    'staravia'=>[['staraptor',1.43]],
    'bidoof'=>[['bibarel',1.57]],
    'shinx'=>[['luxio',1.54],['luxray',2.15]],
    'luxio'=>[['luxray',1.40]],
    'cranidos'=>[['rampardos',1.73]],
    'shieldon'=>[['bastiodon',1.86]],
    'shellos'=>[['gastrodon',1.72]],
    'drifloon'=>[['drifblim',1.71]],
    'buneary'=>[['lopunny',1.68]],
    'glameow'=>[['purugly',1.52]],
    'stunky'=>[['skuntank',1.64]],
    'bronzor'=>[['bronzong',1.92]],
    'gible'=>[['gabite',1.49],['garchomp',2.27]],
    'gabite'=>[['garchomp',1.52]],
    'hippopotas'=>[['hippowdon',1.84]],
    'skorupi'=>[['drapion',1.73]],
    'croagunk'=>[['toxicroak',1.75]],
    'finneon'=>[['lumineon',1.63]],
    'snover'=>[['abomasnow',1.83]],
    'snivy'=>[['servine',1.49],['serperior',2.08]],
    'servine'=>[['serperior',1.40]],
    'tepig'=>[['pignite',1.51],['emboar',2.09]],
    'pignite'=>[['emboar',1.38]],
    'oshawott'=>[['dewott',1.50],['samurott',2.05]],
    'dewott'=>[['samurott',1.37]],
    'lillipup'=>[['herdier',1.56],['stoutland',2.14]],
    'herdier'=>[['stoutland',1.37]],
    'purrloin'=>[['liepard',1.64]],
    'pidove'=>[['tranquill',1.56],['unfezant',2.12]],
    'tranquill'=>[['unfezant',1.36]],
    'blitzle'=>[['zebstrika',1.78]],
    'roggenrola'=>[['boldore',1.59],['gigalith',2.22]],
    'boldore'=>[['gigalith',1.40]],
    'woobat'=>[['swoobat',1.61]],
    'drilbur'=>[['excadrill',1.97]],
    'sewaddle'=>[['swadloon',1.22],['leavanny',1.79]],
    'swadloon'=>[['leavanny',1.46]],
    'cottonee'=>[['whimsicott',1.90]],
    'petilil'=>[['lilligant',1.95]],
    'sandile'=>[['krokorok',1.54],['krookodile',2.18]],
    'krokorok'=>[['krookodile',1.42]],
    'darumaka'=>[['darmanitan',1.94]],
    'dwebble'=>[['crustle',1.75]],
    'scraggy'=>[['scrafty',1.70]],
    'yamask'=>[['cofagrigus',1.84]],
    'tirtouga'=>[['carracosta',1.74]],
    'archen'=>[['archeops',1.79]],
    'trubbish'=>[['garbodor',1.80]],
    'zorua'=>[['zoroark',1.75]],
    'minccino'=>[['cinccino',1.84]],
    'gothita'=>[['gothorita',1.47],['gothitelle',2.01]],
    'gothorita'=>[['gothitelle',1.37]],
    'solosis'=>[['duosion',1.42],['reuniclus',2.05]],
    'duosion'=>[['reuniclus',1.44]],
    'ducklett'=>[['swanna',1.78]],
    'vanillite'=>[['vanillish',1.47],['vanilluxe',2.04]],
    'vanillish'=>[['vanilluxe',1.39]],
    'karrablast'=>[['escavalier',1.73]],
    'foongus'=>[['amoonguss',1.74]],
    'frillish'=>[['jellicent',1.73]],
    'joltik'=>[['galvantula',1.83]],
    'ferroseed'=>[['ferrothorn',1.88]],
    'klink'=>[['klang',1.59],['klinklang',2.20]],
    'klang'=>[['klinklang',1.38]],
    'cubchoo'=>[['beartic',1.80]],
    'shelmet'=>[['accelgor',1.87]],
    'golett'=>[['golurk',1.79]],
    'pawniard'=>[['bisharp',1.84],['kingambit',2.29]],
    'bisharp'=>[['kingambit',1.24]],
    'deino'=>[['zweilous',1.47],['hydreigon',2.09]],
    'zweilous'=>[['hydreigon',1.43]],
    'larvesta'=>[['volcarona',2.13]],
    'chespin'=>[['quilladin',1.48],['chesnaught',2.09]],
    'quilladin'=>[['chesnaught',1.41]],
    'fennekin'=>[['braixen',1.50],['delphox',2.12]],
    'braixen'=>[['delphox',1.41]],
    'froakie'=>[['frogadier',1.49],['greninja',2.11]],
    'frogadier'=>[['greninja',1.42]],
    'bunnelby'=>[['diggersby',1.72]],
    'fletchling'=>[['fletchinder',1.55],['talonflame',2.13]],
    'fletchinder'=>[['talonflame',1.38]],
    'litleo'=>[['pyroar',1.80]],
    'flabebe'=>[['floette',1.43],['florges',1.79]],
    'floette'=>[['florges',1.25]],
    'skiddo'=>[['gogoat',1.74]],
    'pancham'=>[['pangoro',1.81]],
    'espurr'=>[['meowstic',1.65]],
    'honedge'=>[['doublade',1.47],['aegislash',2.11]],
    'doublade'=>[['aegislash',1.44]],
    'inkay'=>[['malamar',1.74]],
    'binacle'=>[['barbaracle',1.82]],
    'skrelp'=>[['dragalge',1.77]],
    'clauncher'=>[['clawitzer',1.77]],
    'helioptile'=>[['heliolisk',1.87]],
    'tyrunt'=>[['tyrantrum',1.77]],
    'amaura'=>[['aurorus',1.75]],
    'goomy'=>[['sliggoo',1.49],['goodra',2.15]],
    'sliggoo'=>[['goodra',1.45]],
    'phantump'=>[['trevenant',1.74]],
    'pumpkaboo'=>[['gourgeist',1.72]],
    'bergmite'=>[['avalugg',1.77]],
    'noibat'=>[['noivern',2.05]],
    'rowlet'=>[['dartrix',1.48],['decidueye',2.10]],
    'dartrix'=>[['decidueye',1.42]],
    'litten'=>[['torracat',1.49],['incineroar',2.10]],
    'torracat'=>[['incineroar',1.41]],
    'popplio'=>[['brionne',1.48],['primarina',2.05]],
    'brionne'=>[['primarina',1.39]],
    'pikipek'=>[['trumbeak',1.54],['toucannon',2.10]],
    'trumbeak'=>[['toucannon',1.37]],
    'yungoos'=>[['gumshoos',1.60]],
    'grubbin'=>[['charjabug',1.19],['vikavolt',1.67]],
    'charjabug'=>[['vikavolt',1.40]],
    'crabrawler'=>[['crabominable',1.73]],
    'rockruff'=>[['lycanroc',1.76]],
    'morelull'=>[['shiinotic',1.67]],
    'salandit'=>[['salazzle',1.80]],
    'stufful'=>[['bewear',1.77]],
    'bounsweet'=>[['steenee',1.25],['tsareena',1.79]],
    'steenee'=>[['tsareena',1.43]],
    'wimpod'=>[['golisopod',1.88]],
    'sandygast'=>[['palossand',1.79]],
    'type-null'=>[['silvally',1.82]],
    'jangmo-o'=>[['hakamo-o',1.48],['kommo-o',2.14]],
    'hakamo-o'=>[['kommo-o',1.44]],
    'cosmog'=>[['cosmoem',1.58],['solgaleo',2.23]],
    'cosmoem'=>[['solgaleo',1.41],['lunala',1.39]],
    'grookey'=>[['thwackey',1.47],['rillaboom',2.09]],
    'thwackey'=>[['rillaboom',1.42]],
    'scorbunny'=>[['raboot',1.50],['cinderace',2.14]],
    'raboot'=>[['cinderace',1.42]],
    'sobble'=>[['drizzile',1.49],['inteleon',2.11]],
    'drizzile'=>[['inteleon',1.42]],
    'skwovet'=>[['greedent',1.62]],
    'rookidee'=>[['corvisquire',1.55],['corviknight',2.18]],
    'corvisquire'=>[['corviknight',1.41]],
    'blipbug'=>[['dottler',1.14],['orbeetle',1.59]],
    'dottler'=>[['orbeetle',1.40]],
    'nickit'=>[['thievul',1.62]],
    'gossifleur'=>[['eldegoss',1.87]],
    'wooloo'=>[['dubwool',1.62]],
    'chewtle'=>[['drednaw',1.78]],
    'yamper'=>[['boltund',1.77]],
    'rolycoly'=>[['carkol',1.47],['coalossal',2.12]],
    'carkol'=>[['coalossal',1.44]],
    'applin'=>[['flapple',1.73],['appletun',1.72]],
    'silicobra'=>[['sandaconda',1.76]],
    'arrokuda'=>[['barraskewda',1.74]],
    'toxel'=>[['toxtricity',1.84]],
    'sizzlipede'=>[['centiskorch',1.80]],
    'clobbopus'=>[['grapploct',1.77]],
    'sinistea'=>[['polteageist',1.82]],
    'hatenna'=>[['hattrem',1.44],['hatterene',2.07]],
    'hattrem'=>[['hatterene',1.43]],
    'impidimp'=>[['morgrem',1.43],['grimmsnarl',2.09]],
    'morgrem'=>[['grimmsnarl',1.46]],
    'milcery'=>[['alcremie',1.80]],
    'snom'=>[['frosmoth',1.80]],
    'cufant'=>[['copperajah',1.78]],
    'dreepy'=>[['drakloak',1.50],['dragapult',2.22]],
    'drakloak'=>[['dragapult',1.48]],
    'fuecoco'=>[['crocalor',1.50],['skeledirge',2.10]],
    'crocalor'=>[['skeledirge',1.40]],
    'quaxly'=>[['quaxwell',1.49],['quaquaval',2.10]],
    'quaxwell'=>[['quaquaval',1.41]],
    'sprigatito'=>[['floragato',1.49],['meowscarada',2.10]],
    'floragato'=>[['meowscarada',1.41]],
    'lechonk'=>[['oinkologne',1.62]],
    'tarountula'=>[['spidops',1.68]],
    'nymble'=>[['lokix',1.78]],
    'pawmi'=>[['pawmo',1.50],['pawmot',2.10]],
    'pawmo'=>[['pawmot',1.40]],
    'tandemaus'=>[['maushold',1.62]],
    'fidough'=>[['dachsbun',1.73]],
    'smoliv'=>[['dolliv',1.43],['arboliva',2.03]],
    'dolliv'=>[['arboliva',1.42]],
    'nacli'=>[['naclstack',1.47],['garganacl',2.09]],
    'naclstack'=>[['garganacl',1.42]],
    'charcadet'=>[['armarouge',1.82],['ceruledge',1.82]],
    'tadbulb'=>[['bellibolt',1.82]],
    'wattrel'=>[['kilowattrel',1.72]],
    'maschiff'=>[['mabosstiff',1.72]],
    'shroodle'=>[['grafaiai',1.73]],
    'bramblin'=>[['brambleghast',1.78]],
    'toedscool'=>[['toedscruel',1.77]],
    'capsakid'=>[['scovillain',1.80]],
    'rellor'=>[['rabsca',1.80]],
    'flittle'=>[['espathra',1.84]],
    'tinkatink'=>[['tinkatuff',1.47],['tinkaton',2.12]],
    'tinkatuff'=>[['tinkaton',1.44]],
    'wiglett'=>[['wugtrio',1.68]],
    'finizen'=>[['palafin',1.76]],
    'varoom'=>[['revavroom',1.76]],
    'glimmet'=>[['glimmora',1.80]],
    'greavard'=>[['houndstone',1.77]],
    'cetoddle'=>[['cetitan',1.86]],
    'chien-pao'=>[],'wo-chien'=>[],'ting-lu'=>[],'chi-yu'=>[],
];

    // ── STARDUST/CANDY COST TABLE (unchanged) ─────────────
    $power_up_costs = [
    1   => [200,1],   1.5 => [200,1],   2   => [200,1],   2.5 => [200,1],
    3   => [400,1],   3.5 => [400,1],   4   => [400,1],   4.5 => [400,1],
    5   => [400,1],   5.5 => [400,1],   6   => [400,1],   6.5 => [400,1],
    7   => [600,2],   7.5 => [600,2],   8   => [600,2],   8.5 => [600,2],
    9   => [600,2],   9.5 => [600,2],   10  => [600,2],   10.5 => [600,2],
    11  => [800,2],   11.5 => [800,2],   12  => [800,2],   12.5 => [800,2],
    13  => [1000,3],  13.5 => [1000,3],  14  => [1000,3],  14.5 => [1000,3],
    15  => [1000,3],  15.5 => [1000,3],  16  => [1000,3],  16.5 => [1000,3],
    17  => [1300,4],  17.5 => [1300,4],  18  => [1300,4],  18.5 => [1300,4],
    19  => [1600,4],  19.5 => [1600,4],  20  => [1600,4],  20.5 => [1600,4],
    21  => [1900,5],  21.5 => [1900,5],  22  => [1900,5],  22.5 => [1900,5],
    23  => [2200,6],  23.5 => [2200,6],  24  => [2200,6],  24.5 => [2200,6],
    25  => [2500,6],  25.5 => [2500,6],  26  => [2500,6],  26.5 => [2500,6],
    27  => [3000,8],  27.5 => [3000,8],  28  => [3000,8],  28.5 => [3000,8],
    29  => [3500,9],  29.5 => [3500,9],  30  => [3500,9],  30.5 => [3500,9],
    31  => [4000,10], 31.5 => [4000,10], 32  => [4000,10], 32.5 => [4000,10],
    33  => [4500,10], 33.5 => [4500,10], 34  => [4500,10], 34.5 => [4500,10],
    35  => [5000,10], 35.5 => [5000,10], 36  => [5000,10], 36.5 => [5000,10],
    37  => [6000,12], 37.5 => [6000,12], 38  => [6000,12], 38.5 => [6000,12],
    39  => [7000,12], 39.5 => [7000,12], 40  => [8000,12],
    40.5 => [8000,12], 41  => [9000,15], 41.5 => [9000,15], 42  => [9000,15],
    42.5 => [9000,15], 43  => [10000,15], 43.5 => [10000,15], 44  => [10000,15],
    44.5 => [10000,15], 45  => [11000,17], 45.5 => [11000,17], 46  => [11000,17],
    46.5 => [11000,17], 47  => [12000,18], 47.5 => [12000,18], 48  => [12000,18],
    48.5 => [12000,18], 49  => [13000,19], 49.5 => [13000,19], 50  => [15000,20],
];

    ob_start();
    ?>
<script>!function(){var t=localStorage.getItem('pkm-theme');t&&document.documentElement.setAttribute('data-theme',t)}();</script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Exo+2:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>
/* ============================================================
   POKEMON CP CALCULATOR — COMPLETE STYLES
   Root: all custom properties
   ============================================================ */
:root {
  --pkm-primary: #0D9488;
  --pkm-primary-hover: #0F766E;
  --pkm-primary-light: rgba(13, 148, 136, 0.12);
  --pkm-secondary: #134E4A;
  --pkm-accent: #F4D03F;
  --pkm-accent-2: #2ECC71;
  --pkm-gradient: linear-gradient(135deg, #0D9488 0%, #134E4A 100%);
  --pkm-radius: 12px;
  --pkm-radius-sm: 8px;
  --pkm-radius-lg: 20px;
  --pkm-transition: all 0.25s cubic-bezier(0.4,0,0.2,1);
  --pkm-font-heading: 'Exo 2', sans-serif;
  --pkm-font-body: system-ui,-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;
  --pkm-bg: #F4F6F9;
  --pkm-bg-2: #FFFFFF;
  --pkm-bg-3: #EEF1F5;
  --pkm-bg-card: rgba(255,255,255,0.95);
  --pkm-text: #1A1F2E;
  --pkm-text-muted: #4A5568;
  --pkm-text-subtle: #A0AEC0;
  --pkm-border: rgba(0,0,0,0.08);
  --pkm-border-hover: rgba(0,0,0,0.18);
  --pkm-shadow: 0 8px 32px rgba(0,0,0,0.10);
  --pkm-shadow-sm: 0 2px 8px rgba(0,0,0,0.06);
  --pkm-glow: rgba(13,148,136,0.22);
  --pkm-input-bg: #EEF1F5;
}
[data-theme="dark"] {
  --pkm-bg: #0D1117;
  --pkm-bg-2: #161B22;
  --pkm-bg-3: #21262D;
  --pkm-bg-card: rgba(22,27,34,0.92);
  --pkm-text: #E6EDF3;
  --pkm-text-muted: #8B949E;
  --pkm-text-subtle: #484F58;
  --pkm-border: rgba(255,255,255,0.08);
  --pkm-border-hover: rgba(255,255,255,0.18);
  --pkm-shadow: 0 8px 32px rgba(0,0,0,0.4);
  --pkm-shadow-sm: 0 2px 8px rgba(0,0,0,0.3);
  --pkm-glow: rgba(13, 148, 136, 0.35);
  --pkm-input-bg: #21262D;
}

/* ============================================================
   BOX SIZING RESET SCOPED TO WRAPPER
   ============================================================ */
#pkm-cp-calc-root, #pkm-cp-calc-root * { box-sizing: border-box !important; }

/* ============================================================
   OUTER WRAP — full-width block, no flex that causes 2-col
   ============================================================ */
#pkm-cp-calc-root.pkm-calc-wrap {
  display: block !important;
  width: 100% !important;
  font-family: var(--pkm-font-body) !important;
  background: var(--pkm-bg) !important;
  color: var(--pkm-text) !important;
}

/* ============================================================
   HEADER — full-bleed gradient banner
   ============================================================ */
#pkm-cp-calc-root .pkm-calc-header {
  display: block !important;
  width: 100% !important;
  text-align: center !important;
  padding: 44px 24px 72px !important;  /* extra bottom padding creates overlap space */
  background: var(--pkm-gradient) !important;
  position: relative !important;
  overflow: hidden !important;
}
#pkm-cp-calc-root .pkm-calc-header::before {
  content: '' !important;
  position: absolute !important;
  inset: 0 !important;
  background: radial-gradient(ellipse at 30% 50%, rgba(255,255,255,0.08) 0%, transparent 70%) !important;
  pointer-events: none !important;
}

/* ============================================================
   INNER WRAPPER — max-width centred container
   ============================================================ */
#pkm-cp-calc-root .pkm-calc-inner {
  display: block !important;
  width: 100% !important;
  max-width: 1080px !important;
  margin: -44px auto 0 !important;  /* negative margin pulls card UP into header */
  padding: 0 20px 48px !important;
  position: relative !important;
  z-index: 1 !important;
}

/* ============================================================
   LAYOUT — FORCE SINGLE COLUMN, override any external flex/grid
   ============================================================ */
#pkm-cp-calc-root .pkm-calc-layout {
  display: block !important;
  width: 100% !important;
  float: none !important;
}
#pkm-cp-calc-root .pkm-calc-layout > * {
  display: block !important;
  width: 100% !important;
  float: none !important;
}
/* Force-hide sidebar no matter what */
#pkm-cp-calc-root .pkm-calc-sidebar { display: none !important; }

/* ============================================================
   MAIN CONTENT AREA
   ============================================================ */
#pkm-cp-calc-root .pkm-calc-main {
  display: block !important;
  width: 100% !important;
  min-width: 0 !important;
  max-width: 100% !important;
}

/* ============================================================
   CARD
   ============================================================ */
#pkm-cp-calc-root .pkm-card {
  display: block !important;
  width: 100% !important;
  max-width: 100% !important;
  background: var(--pkm-bg-card) !important;
  border: 1px solid var(--pkm-border) !important;
  border-radius: var(--pkm-radius-lg) !important;
  padding: 28px !important;
  box-shadow: 0 -4px 0 0 rgba(13, 148, 136, 0.25), var(--pkm-shadow) !important;
  backdrop-filter: blur(8px) !important;
}

/* ============================================================
   CONTENT SECTIONS
   ============================================================ */
#pkm-cp-calc-root .pkm-calc-section {
  display: block !important;
  width: 100% !important;
  max-width: 100% !important;
  background: var(--pkm-bg-card) !important;
  border: 1px solid var(--pkm-border) !important;
  border-radius: var(--pkm-radius-lg) !important;
  padding: 32px 28px !important;
  margin-top: 24px !important;
}

/* ============================================================
   HEADER TYPOGRAPHY
   ============================================================ */
#pkm-cp-calc-root .pkm-calc-title-sprites {
  display: flex !important;
  justify-content: center !important;
  align-items: center !important;
  gap: 8px !important;
  margin-bottom: 16px !important;
}
#pkm-cp-calc-root .pkm-calc-title-sprites img {
  width: 56px !important; height: 56px !important;
  image-rendering: pixelated !important;
  filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3)) !important;
  animation: pkm-float 3s ease-in-out infinite !important;
}
#pkm-cp-calc-root .pkm-calc-title-sprites img:nth-child(2) { animation-delay: 0.5s !important; }
#pkm-cp-calc-root .pkm-calc-title-sprites img:nth-child(3) { animation-delay: 1s !important; }
@keyframes pkm-float {
  0%,100% { transform: translateY(0); }
  50% { transform: translateY(-6px); }
}
#pkm-cp-calc-root .pkm-calc-title {
  font-family: var(--pkm-font-heading) !important;
  font-size: clamp(22px,4vw,36px) !important;
  font-weight: 800 !important;
  color: #FFFFFF !important;
  margin: 0 0 12px !important;
  text-shadow: 0 2px 8px rgba(0,0,0,0.3) !important;
  line-height: 1.2 !important;
}
#pkm-cp-calc-root .pkm-calc-description {
  font-size: clamp(14px,2vw,16px) !important;
  color: rgba(255,255,255,0.85) !important;
  margin: 0 auto !important;
  max-width: 640px !important;
  line-height: 1.6 !important;
}

/* ============================================================
   SEARCH
   ============================================================ */
#pkm-cp-calc-root #pkm-cp-search-wrap {
  position: relative !important;
  margin-bottom: 24px !important;
}
#pkm-cp-calc-root #pkm-cp-search-input {
  width: 100% !important;
  padding: 14px 16px 14px 48px !important;
  background: var(--pkm-input-bg) !important;
  border: 2px solid var(--pkm-border) !important;
  border-radius: var(--pkm-radius) !important;
  font-size: 16px !important;
  font-family: var(--pkm-font-body) !important;
  color: var(--pkm-text) !important;
  transition: var(--pkm-transition) !important;
  outline: none !important;
  min-height: 52px !important;
  display: block !important;
}
#pkm-cp-calc-root #pkm-cp-search-input:focus {
  border-color: var(--pkm-primary) !important;
  box-shadow: 0 0 0 3px var(--pkm-glow) !important;
}
#pkm-cp-calc-root .pkm-search-icon {
  position: absolute !important;
  left: 16px !important;
  top: 50% !important;
  transform: translateY(-50%) !important;
  color: var(--pkm-text-muted) !important;
  pointer-events: none !important;
  display: flex !important;
}
#pkm-cp-calc-root #pkm-cp-search-dropdown {
  position: absolute !important;
  top: calc(100% + 4px) !important;
  left: 0 !important;
  right: 0 !important;
  background: var(--pkm-bg-2) !important;
  border: 1px solid var(--pkm-border) !important;
  border-radius: var(--pkm-radius) !important;
  box-shadow: var(--pkm-shadow) !important;
  z-index: 1000 !important;
  max-height: 280px !important;
  overflow-y: auto !important;
  display: none !important;
}
#pkm-cp-calc-root #pkm-cp-search-dropdown.open { display: block !important; }
#pkm-cp-calc-root .pkm-search-item {
  display: flex !important;
  align-items: center !important;
  gap: 12px !important;
  padding: 10px 16px !important;
  cursor: pointer !important;
  transition: var(--pkm-transition) !important;
  border-bottom: 1px solid var(--pkm-border) !important;
}
#pkm-cp-calc-root .pkm-search-item:last-child { border-bottom: none !important; }
#pkm-cp-calc-root .pkm-search-item:hover,
#pkm-cp-calc-root .pkm-search-item.active { background: var(--pkm-primary-light) !important; }
#pkm-cp-calc-root .pkm-search-item img {
  width: 36px !important; height: 36px !important;
  image-rendering: pixelated !important; flex-shrink: 0 !important;
}
#pkm-cp-calc-root .pkm-search-item-name {
  font-weight: 600 !important; font-size: 14px !important;
  color: var(--pkm-text) !important; text-transform: capitalize !important;
}
#pkm-cp-calc-root .pkm-search-item-meta {
  font-size: 12px !important; color: var(--pkm-text-muted) !important;
  text-transform: capitalize !important;
}

/* ============================================================
   SELECTED POKEMON BANNER
   ============================================================ */
#pkm-cp-calc-root #pkm-cp-selected {
  display: none !important;
  align-items: center !important;
  gap: 16px !important;
  padding: 14px 18px !important;
  background: linear-gradient(135deg, rgba(13,148,136,0.06) 0%, rgba(29,53,87,0.06) 100%) !important;
  border-radius: var(--pkm-radius) !important;
  margin-bottom: 24px !important;
  border: 1px solid rgba(13, 148, 136, 0.2) !important;
}
#pkm-cp-calc-root #pkm-cp-selected.visible { display: flex !important; }
#pkm-cp-calc-root #pkm-cp-selected-sprite {
  width: 88px !important; height: 88px !important;
  image-rendering: pixelated !important; flex-shrink: 0 !important;
  filter: drop-shadow(0 4px 8px rgba(0,0,0,0.15)) !important;
}
#pkm-cp-calc-root #pkm-cp-selected-name {
  font-family: var(--pkm-font-heading) !important;
  font-weight: 800 !important; font-size: 20px !important;
  text-transform: capitalize !important;
  color: var(--pkm-text) !important; margin: 0 0 4px !important;
}
#pkm-cp-calc-root #pkm-cp-selected-types { display: flex !important; gap: 6px !important; flex-wrap: wrap !important; }

/* ============================================================
   TYPE BADGES
   ============================================================ */
#pkm-cp-calc-root .pkm-type-badge {
  padding: 3px 10px !important; border-radius: 20px !important;
  font-size: 11px !important; font-weight: 700 !important;
  text-transform: uppercase !important; letter-spacing: 0.5px !important;
  color: #fff !important;
}
#pkm-cp-calc-root .pkm-type-normal{background:#A8A878 !important;}
#pkm-cp-calc-root .pkm-type-fire{background:#F08030 !important;}
#pkm-cp-calc-root .pkm-type-water{background:#6890F0 !important;}
#pkm-cp-calc-root .pkm-type-electric{background:#F8D030 !important;color:#333 !important;}
#pkm-cp-calc-root .pkm-type-grass{background:#78C850 !important;}
#pkm-cp-calc-root .pkm-type-ice{background:#98D8D8 !important;color:#333 !important;}
#pkm-cp-calc-root .pkm-type-fighting{background:#C03028 !important;}
#pkm-cp-calc-root .pkm-type-poison{background:#A040A0 !important;}
#pkm-cp-calc-root .pkm-type-ground{background:#E0C068 !important;color:#333 !important;}
#pkm-cp-calc-root .pkm-type-flying{background:#A890F0 !important;}
#pkm-cp-calc-root .pkm-type-psychic{background:#F85888 !important;}
#pkm-cp-calc-root .pkm-type-bug{background:#A8B820 !important;}
#pkm-cp-calc-root .pkm-type-rock{background:#B8A038 !important;}
#pkm-cp-calc-root .pkm-type-ghost{background:#705898 !important;}
#pkm-cp-calc-root .pkm-type-dragon{background:#7038F8 !important;}
#pkm-cp-calc-root .pkm-type-dark{background:#705848 !important;}
#pkm-cp-calc-root .pkm-type-steel{background:#B8B8D0 !important;color:#333 !important;}
#pkm-cp-calc-root .pkm-type-fairy{background:#EE99AC !important;color:#333 !important;}

/* ============================================================
   IV INPUTS GRID
   ============================================================ */
#pkm-cp-calc-root .pkm-inputs-grid {
  display: grid !important;
  grid-template-columns: 1fr 1fr 1fr !important;
  gap: 12px !important;
  margin-bottom: 20px !important;
}
@media(max-width:520px) {
  #pkm-cp-calc-root .pkm-inputs-grid { grid-template-columns: 1fr !important; }
}
#pkm-cp-calc-root .pkm-field label,
#pkm-cp-calc-root .pkm-field-with-tooltip label {
  display: block !important; font-size: 11px !important; font-weight: 700 !important;
  text-transform: uppercase !important; letter-spacing: 0.6px !important;
  color: var(--pkm-text-muted) !important; margin-bottom: 6px !important;
}
#pkm-cp-calc-root .pkm-field-with-tooltip {
  display: flex !important; align-items: center !important;
  gap: 6px !important; margin-bottom: 6px !important;
}
#pkm-cp-calc-root .pkm-field-with-tooltip label { margin-bottom: 0 !important; }
#pkm-cp-calc-root .pkm-tooltip {
  position: relative !important; cursor: help !important;
  display: inline-flex !important; color: var(--pkm-text-subtle) !important;
}
#pkm-cp-calc-root .pkm-tooltip:hover::after {
  content: attr(data-tip) !important;
  position: absolute !important; bottom: calc(100% + 8px) !important; left: 50% !important;
  transform: translateX(-50%) !important; background: var(--pkm-secondary) !important;
  color: #fff !important; padding: 6px 10px !important;
  border-radius: var(--pkm-radius-sm) !important; font-size: 12px !important;
  white-space: nowrap !important; z-index: 200 !important; pointer-events: none !important;
}
#pkm-cp-calc-root .pkm-input {
  width: 100% !important;
  padding: 11px 14px !important;
  background: var(--pkm-input-bg) !important;
  border: 2px solid var(--pkm-border) !important;
  border-radius: var(--pkm-radius) !important;
  font-size: 16px !important; font-family: var(--pkm-font-body) !important;
  color: var(--pkm-text) !important;
  transition: var(--pkm-transition) !important;
  outline: none !important; min-height: 46px !important;
  -moz-appearance: textfield !important;
  display: block !important;
}
#pkm-cp-calc-root .pkm-input::-webkit-outer-spin-button,
#pkm-cp-calc-root .pkm-input::-webkit-inner-spin-button { -webkit-appearance: none !important; margin: 0 !important; }
#pkm-cp-calc-root .pkm-input:focus {
  border-color: var(--pkm-primary) !important;
  box-shadow: 0 0 0 3px var(--pkm-glow) !important;
}
#pkm-cp-calc-root .pkm-input.pkm-input-error {
  border-color: var(--pkm-primary, #0D9488) !important;
  box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.2) !important;
  background: rgba(13,148,136,0.04) !important;
}
#pkm-cp-calc-root .pkm-field-error {
  display: none !important;
  font-size: 11px !important;
  color: var(--pkm-primary, #0D9488) !important;
  font-weight: 600 !important;
  margin-top: 4px !important;
  align-items: center !important;
  gap: 4px !important;
}
#pkm-cp-calc-root .pkm-field-error.visible { display: flex !important; }

/* ============================================================
   LEVEL SLIDER
   ============================================================ */
#pkm-cp-calc-root .pkm-level-section { margin-bottom: 20px !important; }
#pkm-cp-calc-root .pkm-level-header {
  display: flex !important; justify-content: space-between !important;
  align-items: center !important; margin-bottom: 10px !important;
}
#pkm-cp-calc-root .pkm-level-header label {
  font-size: 11px !important; font-weight: 700 !important;
  text-transform: uppercase !important; letter-spacing: 0.6px !important;
  color: var(--pkm-text-muted) !important;
}
#pkm-cp-calc-root #pkm-cp-level-display {
  font-family: var(--pkm-font-heading) !important;
  font-weight: 800 !important; font-size: 18px !important; color: var(--pkm-primary) !important;
}
#pkm-cp-calc-root #pkm-cp-level-slider {
  width: 100% !important; height: 6px !important;
  -webkit-appearance: none !important; appearance: none !important;
  background: linear-gradient(to right, var(--pkm-primary) 0%, var(--pkm-primary) var(--slider-pct,38%), var(--pkm-bg-3) var(--slider-pct,38%), var(--pkm-bg-3) 100%) !important;
  border-radius: 3px !important; outline: none !important; cursor: pointer !important;
  margin-bottom: 12px !important; display: block !important;
}
#pkm-cp-calc-root #pkm-cp-level-slider::-webkit-slider-thumb {
  -webkit-appearance: none !important; width: 22px !important; height: 22px !important;
  border-radius: 50% !important; background: var(--pkm-primary) !important;
  cursor: pointer !important; border: 3px solid #fff !important;
  box-shadow: 0 2px 6px rgba(0,0,0,0.25) !important;
}
#pkm-cp-calc-root #pkm-cp-level-slider::-moz-range-thumb {
  width: 22px !important; height: 22px !important; border-radius: 50% !important;
  background: var(--pkm-primary) !important; cursor: pointer !important;
  border: 3px solid #fff !important; box-shadow: 0 2px 6px rgba(0,0,0,0.25) !important;
}
#pkm-cp-calc-root .pkm-presets {
  display: flex !important; flex-wrap: wrap !important; gap: 8px !important; margin-bottom: 20px !important;
}
#pkm-cp-calc-root .pkm-preset-btn {
  padding: 7px 13px !important;
  background: var(--pkm-bg-3) !important;
  border: 1px solid var(--pkm-border) !important;
  border-radius: var(--pkm-radius-sm) !important;
  font-size: 12px !important; font-weight: 600 !important;
  color: var(--pkm-text-muted) !important; cursor: pointer !important;
  transition: var(--pkm-transition) !important; white-space: nowrap !important;
  min-height: 34px !important; font-family: var(--pkm-font-body) !important;
}
#pkm-cp-calc-root .pkm-preset-btn:hover,
#pkm-cp-calc-root .pkm-preset-btn.active {
  background: var(--pkm-primary-light) !important;
  border-color: var(--pkm-primary) !important; color: var(--pkm-primary) !important;
}

/* ============================================================
   FORM / WEATHER TOGGLES
   ============================================================ */
#pkm-cp-calc-root .pkm-form-row {
  display: grid !important; grid-template-columns: 1fr 1fr !important;
  gap: 16px !important; margin-bottom: 24px !important;
}
@media(max-width:520px) {
  #pkm-cp-calc-root .pkm-form-row { grid-template-columns: 1fr !important; }
}
#pkm-cp-calc-root .pkm-form-section label {
  display: block !important; font-size: 11px !important; font-weight: 700 !important;
  text-transform: uppercase !important; letter-spacing: 0.6px !important;
  color: var(--pkm-text-muted) !important; margin-bottom: 8px !important;
}
#pkm-cp-calc-root .pkm-toggle-group {
  display: flex !important; border: 1px solid var(--pkm-border) !important;
  border-radius: var(--pkm-radius) !important; overflow: hidden !important;
  background: var(--pkm-bg-3) !important;
}
#pkm-cp-calc-root .pkm-toggle-btn {
  flex: 1 !important; padding: 10px 6px !important;
  background: transparent !important; border: none !important;
  font-size: 12px !important; font-weight: 600 !important;
  color: var(--pkm-text-muted) !important; cursor: pointer !important;
  transition: var(--pkm-transition) !important; white-space: nowrap !important;
  min-height: 42px !important; font-family: var(--pkm-font-body) !important;
  text-align: center !important;
}
#pkm-cp-calc-root .pkm-toggle-btn.active {
  background: var(--pkm-primary) !important; color: #fff !important;
}

/* ============================================================
   BUTTON ROW — Calculate + Reset side by side
   ============================================================ */
#pkm-cp-calc-root .pkm-btn-row {
  display: grid !important;
  grid-template-columns: 1fr auto !important;
  gap: 12px !important;
  align-items: stretch !important;
}
@media(max-width:480px) {
  #pkm-cp-calc-root .pkm-btn-row { grid-template-columns: 1fr !important; }
}
#pkm-cp-calc-root #pkm-cp-calc-btn {
  width: 100% !important; padding: 16px 24px !important;
  background: var(--pkm-primary) !important; color: #fff !important;
  border: none !important; border-radius: var(--pkm-radius) !important;
  font-family: var(--pkm-font-heading) !important; font-size: 15px !important;
  font-weight: 800 !important; cursor: pointer !important;
  transition: var(--pkm-transition) !important; min-height: 56px !important;
  display: flex !important; align-items: center !important; justify-content: center !important;
  gap: 10px !important; letter-spacing: 0.5px !important;
  box-shadow: 0 4px 16px var(--pkm-glow) !important;
}
#pkm-cp-calc-root #pkm-cp-calc-btn:hover {
  background: var(--pkm-primary-hover) !important;
  transform: translateY(-2px) !important;
  box-shadow: 0 6px 20px var(--pkm-glow) !important;
}
#pkm-cp-calc-root #pkm-cp-calc-btn:active { transform: translateY(0) !important; }
#pkm-cp-calc-root #pkm-cp-reset-btn {
  padding: 14px 18px !important;
  background: var(--pkm-bg-3) !important; color: var(--pkm-text-muted) !important;
  border: 2px solid var(--pkm-border) !important; border-radius: var(--pkm-radius) !important;
  font-size: 13px !important; font-weight: 700 !important; cursor: pointer !important;
  transition: var(--pkm-transition) !important; min-height: 56px !important;
  min-width: 90px !important; font-family: var(--pkm-font-body) !important;
  display: flex !important; align-items: center !important; justify-content: center !important;
  gap: 6px !important; white-space: nowrap !important;
}
#pkm-cp-calc-root #pkm-cp-reset-btn:hover {
  background: var(--pkm-bg-2) !important; border-color: var(--pkm-border-hover) !important;
  color: var(--pkm-text) !important;
}

/* ============================================================
   RESULTS — REDESIGNED
   ============================================================ */
#pkm-cp-calc-root #pkm-cp-results {
  display: none !important; margin-top: 28px !important;
}
#pkm-cp-calc-root #pkm-cp-results.visible { display: block !important; }

/* Results header bar */
#pkm-cp-calc-root .pkm-results-header {
  display: flex !important; align-items: center !important; gap: 10px !important;
  margin-bottom: 16px !important;
}
#pkm-cp-calc-root .pkm-results-header-title {
  font-family: var(--pkm-font-heading) !important;
  font-size: 13px !important; font-weight: 700 !important;
  text-transform: uppercase !important; letter-spacing: 0.6px !important;
  color: var(--pkm-text-muted) !important;
}
#pkm-cp-calc-root .pkm-results-header-line {
  flex: 1 !important; height: 1px !important; background: var(--pkm-border) !important;
}

/* Main CP highlight card */
#pkm-cp-calc-root .pkm-result-main {
  background: linear-gradient(135deg, var(--pkm-primary) 0%, #c0392b 100%) !important;
  border-radius: var(--pkm-radius-lg) !important;
  padding: 24px 20px !important;
  text-align: center !important;
  margin-bottom: 14px !important;
  position: relative !important;
  overflow: hidden !important;
  box-shadow: 0 6px 24px var(--pkm-glow) !important;
}
#pkm-cp-calc-root .pkm-result-main::before {
  content: '' !important; position: absolute !important; inset: 0 !important;
  background: radial-gradient(ellipse at 70% 20%, rgba(255,255,255,0.12) 0%, transparent 60%) !important;
  pointer-events: none !important;
}
#pkm-cp-calc-root .pkm-result-main-label {
  font-size: 11px !important; font-weight: 700 !important; text-transform: uppercase !important;
  letter-spacing: 1px !important; color: rgba(255,255,255,0.75) !important;
  margin-bottom: 4px !important; display: block !important;
}
#pkm-cp-calc-root .pkm-result-main-value {
  font-family: var(--pkm-font-heading) !important;
  font-size: clamp(42px, 8vw, 64px) !important;
  font-weight: 800 !important; color: #fff !important;
  line-height: 1 !important; display: block !important;
  text-shadow: 0 2px 12px rgba(0,0,0,0.2) !important;
}
#pkm-cp-calc-root .pkm-result-main-unit {
  font-size: 14px !important; font-weight: 700 !important;
  color: rgba(255,255,255,0.7) !important; letter-spacing: 2px !important;
  text-transform: uppercase !important; margin-top: 4px !important; display: block !important;
}
#pkm-cp-calc-root .pkm-result-main-hp {
  display: inline-flex !important; align-items: center !important; gap: 5px !important;
  margin-top: 10px !important; padding: 4px 12px !important;
  background: rgba(255,255,255,0.18) !important; border-radius: 20px !important;
  font-size: 13px !important; font-weight: 700 !important; color: #fff !important;
}

/* Secondary stats grid (3 cards) */
#pkm-cp-calc-root .pkm-results-grid {
  display: grid !important;
  grid-template-columns: repeat(3, 1fr) !important;
  gap: 10px !important;
  margin-bottom: 14px !important;
}
@media(max-width:480px) {
  #pkm-cp-calc-root .pkm-results-grid { grid-template-columns: 1fr 1fr !important; }
}
#pkm-cp-calc-root .pkm-result-card {
  background: var(--pkm-bg-3) !important;
  border: 1px solid var(--pkm-border) !important;
  border-radius: var(--pkm-radius) !important;
  padding: 14px 12px !important; text-align: center !important;
  transition: var(--pkm-transition) !important;
}
#pkm-cp-calc-root .pkm-result-card:hover {
  border-color: var(--pkm-primary) !important;
  box-shadow: 0 0 0 2px var(--pkm-primary-light) !important;
  transform: translateY(-1px) !important;
}
#pkm-cp-calc-root .pkm-result-label {
  font-size: 10px !important; font-weight: 700 !important;
  text-transform: uppercase !important; letter-spacing: 0.5px !important;
  color: var(--pkm-text-muted) !important; margin-bottom: 6px !important; display: block !important;
}
#pkm-cp-calc-root .pkm-result-value {
  font-family: var(--pkm-font-heading) !important;
  font-size: clamp(18px, 3vw, 24px) !important;
  font-weight: 800 !important; color: var(--pkm-text) !important; line-height: 1 !important;
}
#pkm-cp-calc-root .pkm-result-unit {
  font-size: 10px !important; color: var(--pkm-text-muted) !important;
  margin-top: 3px !important; display: block !important;
}

/* IV perfection bar */
#pkm-cp-calc-root .pkm-iv-bar-wrap {
  margin-bottom: 14px !important;
  background: var(--pkm-bg-3) !important;
  border: 1px solid var(--pkm-border) !important;
  border-radius: var(--pkm-radius) !important;
  padding: 14px 16px !important;
}
#pkm-cp-calc-root .pkm-iv-bar-header {
  display: flex !important; justify-content: space-between !important;
  align-items: center !important; margin-bottom: 8px !important;
}
#pkm-cp-calc-root .pkm-iv-bar-label {
  font-size: 11px !important; font-weight: 700 !important;
  text-transform: uppercase !important; letter-spacing: 0.5px !important;
  color: var(--pkm-text-muted) !important;
}
#pkm-cp-calc-root #pkm-cp-r-iv-bar-pct {
  font-family: var(--pkm-font-heading) !important;
  font-size: 16px !important; font-weight: 800 !important; color: var(--pkm-accent-2) !important;
}
#pkm-cp-calc-root #pkm-cp-iv-bar {
  height: 14px !important;
  background: rgba(0,0,0,0.07) !important;
  border-radius: 7px !important;
  overflow: hidden !important;
  position: relative !important;
}
/* The fill colour is set dynamically by JS via a CSS custom property */
#pkm-cp-calc-root #pkm-cp-iv-bar-fill {
  display: block !important;
  height: 14px !important;
  border-radius: 7px !important;
  background: var(--bar-color, #0D9488) !important;
  transition: width 0.7s cubic-bezier(0.4,0,0.2,1), background 0.4s ease !important;
  width: 0% !important;
  min-width: 0 !important;
  max-width: 100% !important;
}
/* IV quality label badge */
#pkm-cp-calc-root .pkm-iv-quality {
  font-size: 11px !important; font-weight: 700 !important;
  padding: 2px 9px !important; border-radius: 20px !important;
  letter-spacing: 0.4px !important; text-transform: uppercase !important;
}
#pkm-cp-calc-root .pkm-iv-quality.iv-terrible  { background:rgba(231,76,60,0.15) !important;  color:#e74c3c !important; }
#pkm-cp-calc-root .pkm-iv-quality.iv-poor      { background:rgba(230,126,34,0.15) !important; color:#e67e22 !important; }
#pkm-cp-calc-root .pkm-iv-quality.iv-average   { background:rgba(241,196,15,0.15) !important; color:#d4ac0d !important; }
#pkm-cp-calc-root .pkm-iv-quality.iv-good      { background:rgba(39,174,96,0.15) !important;  color:#27ae60 !important; }
#pkm-cp-calc-root .pkm-iv-quality.iv-great     { background:rgba(41,128,185,0.15) !important; color:#2980b9 !important; }
#pkm-cp-calc-root .pkm-iv-quality.iv-perfect   { background:rgba(142,68,173,0.15) !important; color:#8e44ad !important; }

/* Stardust & Candy cost chips */
#pkm-cp-calc-root .pkm-cost-row {
  display: grid !important; grid-template-columns: 1fr 1fr !important;
  gap: 10px !important; margin-bottom: 14px !important;
}
#pkm-cp-calc-root .pkm-cost-chip {
  display: flex !important; align-items: center !important; gap: 10px !important;
  padding: 12px 14px !important;
  background: var(--pkm-bg-3) !important;
  border-radius: var(--pkm-radius) !important; border: 1px solid var(--pkm-border) !important;
}
#pkm-cp-calc-root .pkm-cost-chip svg { flex-shrink: 0 !important; }
#pkm-cp-calc-root .pkm-cost-chip-label {
  font-size: 10px !important; color: var(--pkm-text-muted) !important;
  font-weight: 700 !important; text-transform: uppercase !important; letter-spacing: 0.5px !important;
}
#pkm-cp-calc-root .pkm-cost-chip-value {
  font-family: var(--pkm-font-heading) !important;
  font-size: 16px !important; font-weight: 800 !important; color: var(--pkm-text) !important;
}

/* Evolution cards */
#pkm-cp-calc-root #pkm-cp-evo-results { margin-top: 4px !important; }
#pkm-cp-calc-root .pkm-evo-title {
  font-size: 11px !important; font-weight: 700 !important;
  text-transform: uppercase !important; letter-spacing: 0.6px !important;
  color: var(--pkm-text-muted) !important; margin-bottom: 10px !important; display: block !important;
}
#pkm-cp-calc-root #pkm-cp-evo-grid {
  display: grid !important;
  grid-template-columns: repeat(auto-fill, minmax(130px, 1fr)) !important;
  gap: 10px !important;
}
#pkm-cp-calc-root .pkm-evo-card {
  background: var(--pkm-bg-2) !important; border: 1px solid var(--pkm-border) !important;
  border-radius: var(--pkm-radius) !important; padding: 14px !important;
  text-align: center !important; display: flex !important; flex-direction: column !important;
  align-items: center !important; gap: 6px !important; transition: var(--pkm-transition) !important;
}
#pkm-cp-calc-root .pkm-evo-card:hover {
  border-color: var(--pkm-accent) !important; transform: translateY(-2px) !important;
  box-shadow: var(--pkm-shadow-sm) !important;
}
#pkm-cp-calc-root .pkm-evo-card img { width: 52px !important; height: 52px !important; image-rendering: pixelated !important; }
#pkm-cp-calc-root .pkm-evo-name { font-size: 12px !important; font-weight: 700 !important; text-transform: capitalize !important; color: var(--pkm-text) !important; }
#pkm-cp-calc-root .pkm-evo-cp { font-family: var(--pkm-font-heading) !important; font-size: 18px !important; font-weight: 800 !important; color: var(--pkm-accent) !important; }
#pkm-cp-calc-root .pkm-evo-cp-label { font-size: 10px !important; color: var(--pkm-text-muted) !important; margin-top: -2px !important; }

/* ============================================================
   CONTENT SECTIONS TYPOGRAPHY
   ============================================================ */
#pkm-cp-calc-root .pkm-calc-section h2 {
  font-family: var(--pkm-font-heading) !important;
  font-size: clamp(18px,3vw,24px) !important; font-weight: 800 !important;
  color: var(--pkm-text) !important; margin: 0 0 16px !important;
  display: flex !important; align-items: center !important; gap: 10px !important;
}
#pkm-cp-calc-root .pkm-calc-section h2 svg { color: var(--pkm-primary) !important; flex-shrink: 0 !important; }
#pkm-cp-calc-root .pkm-calc-section h3 {
  font-family: var(--pkm-font-heading) !important; font-size: 18px !important;
  font-weight: 700 !important; color: var(--pkm-text) !important; margin: 20px 0 12px !important;
}
#pkm-cp-calc-root .pkm-calc-section p {
  font-size: 15px !important; line-height: 1.75 !important;
  color: var(--pkm-text-muted) !important; margin-bottom: 12px !important;
}
#pkm-cp-calc-root .pkm-calc-section strong { color: var(--pkm-text) !important; font-weight: 700 !important; }
#pkm-cp-calc-root .pkm-calc-section ol { padding-left: 20px !important; margin: 0 !important; }
#pkm-cp-calc-root .pkm-calc-section ol li {
  font-size: 15px !important; line-height: 1.75 !important;
  color: var(--pkm-text-muted) !important; margin-bottom: 8px !important; padding-left: 8px !important;
}

/* ============================================================
   TABLE
   ============================================================ */
#pkm-cp-calc-root .pkm-table-wrapper {
  overflow-x: auto !important; border-radius: var(--pkm-radius) !important;
  border: 1px solid var(--pkm-border) !important; margin-top: 8px !important;
}
#pkm-cp-calc-root .pkm-calc-table { width: 100% !important; border-collapse: collapse !important; font-size: 14px !important; }
#pkm-cp-calc-root .pkm-calc-table th {
  background: var(--pkm-secondary) !important; color: #fff !important;
  padding: 12px 16px !important; text-align: left !important;
  font-weight: 700 !important; font-family: var(--pkm-font-heading) !important; white-space: nowrap !important;
}
#pkm-cp-calc-root .pkm-calc-table td {
  padding: 11px 16px !important; border-bottom: 1px solid var(--pkm-border) !important;
  color: var(--pkm-text-muted) !important; white-space: nowrap !important;
}
#pkm-cp-calc-root .pkm-calc-table tr:last-child td { border-bottom: none !important; }
#pkm-cp-calc-root .pkm-calc-table tr:nth-child(even) td { background: var(--pkm-bg-3) !important; }
[data-theme="dark"] #pkm-cp-calc-root .pkm-calc-table tr:nth-child(even) td { background: rgba(255,255,255,0.03) !important; }

/* ============================================================
   FAQ
   ============================================================ */
#pkm-cp-calc-root .pkm-faq-item {
  border: 1px solid var(--pkm-border) !important; border-radius: var(--pkm-radius) !important;
  margin-bottom: 10px !important; overflow: hidden !important;
}
#pkm-cp-calc-root .pkm-faq-q {
  width: 100% !important; display: flex !important; justify-content: space-between !important;
  align-items: center !important; gap: 16px !important; padding: 16px 20px !important;
  background: var(--pkm-bg-3) !important; border: none !important; cursor: pointer !important;
  text-align: left !important; transition: var(--pkm-transition) !important;
  min-height: 56px !important; font-family: var(--pkm-font-body) !important;
}
#pkm-cp-calc-root .pkm-faq-q:hover,
#pkm-cp-calc-root .pkm-faq-q.open { background: var(--pkm-primary-light) !important; }
#pkm-cp-calc-root .pkm-faq-q-text { font-weight: 700 !important; font-size: 15px !important; color: var(--pkm-text) !important; }
#pkm-cp-calc-root .pkm-faq-icon { flex-shrink: 0 !important; color: var(--pkm-primary) !important; transition: transform 0.25s ease !important; }
#pkm-cp-calc-root .pkm-faq-q.open .pkm-faq-icon { transform: rotate(180deg) !important; }
#pkm-cp-calc-root .pkm-faq-a {
  display: none !important; padding: 16px 20px !important; font-size: 15px !important;
  line-height: 1.75 !important; color: var(--pkm-text-muted) !important;
  background: var(--pkm-bg-2) !important; border-top: 1px solid var(--pkm-border) !important;
}
#pkm-cp-calc-root .pkm-faq-a.open { display: block !important; }

/* ============================================================
   RELATED TOOLS
   ============================================================ */
#pkm-cp-calc-root .pkm-related-grid {
  display: grid !important; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)) !important; gap: 16px !important;
}
#pkm-cp-calc-root .pkm-related-card {
  background: var(--pkm-bg-2) !important; border: 1px solid var(--pkm-border) !important;
  border-radius: var(--pkm-radius) !important; padding: 20px !important;
  text-decoration: none !important; transition: var(--pkm-transition) !important;
  display: flex !important; flex-direction: column !important; gap: 10px !important;
}
#pkm-cp-calc-root .pkm-related-card:hover {
  border-color: var(--pkm-primary) !important; transform: translateY(-3px) !important;
  box-shadow: var(--pkm-shadow) !important;
}
#pkm-cp-calc-root .pkm-related-icon {
  width: 40px !important; height: 40px !important; background: var(--pkm-primary-light) !important;
  border-radius: var(--pkm-radius-sm) !important; display: flex !important;
  align-items: center !important; justify-content: center !important; color: var(--pkm-primary) !important;
}
#pkm-cp-calc-root .pkm-related-card-title { font-weight: 700 !important; font-size: 14px !important; color: var(--pkm-text) !important; line-height: 1.3 !important; }
#pkm-cp-calc-root .pkm-related-card-desc { font-size: 13px !important; color: var(--pkm-text-muted) !important; line-height: 1.5 !important; }

/* ============================================================
   MISC
   ============================================================ */
#pkm-cp-calc-root .pkm-calc-ad-block { text-align: center !important; padding: 12px 0 !important; }
#pkm-cp-calc-root .pkm-noscript-msg {
  background: var(--pkm-accent) !important; color: #333 !important;
  padding: 16px 20px !important; border-radius: var(--pkm-radius) !important;
  font-weight: 600 !important; text-align: center !important; margin-bottom: 24px !important;
  display: flex !important; align-items: center !important; gap: 10px !important;
  justify-content: center !important; font-size: 14px !important;
}
#pkm-cp-theme-toggle {
  position: fixed !important; top: 20px !important; right: 20px !important;
  z-index: 9999 !important; background: var(--pkm-bg-2) !important;
  border: 1px solid var(--pkm-border) !important; border-radius: 50px !important;
  padding: 8px 16px !important; cursor: pointer !important;
  display: flex !important; align-items: center !important; gap: 8px !important;
  font-size: 13px !important; font-weight: 600 !important; color: var(--pkm-text) !important;
  box-shadow: var(--pkm-shadow-sm) !important; transition: var(--pkm-transition) !important;
  min-height: 44px !important;
}
#pkm-cp-theme-toggle:hover { background: var(--pkm-bg-3) !important; }

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media(max-width:767px) {
  #pkm-cp-calc-root .pkm-card { padding: 16px !important; }
  #pkm-cp-calc-root .pkm-calc-header { padding: 32px 16px 24px !important; }
  #pkm-cp-calc-root .pkm-calc-section { padding: 20px 16px !important; }
  #pkm-cp-calc-root .pkm-calc-inner { padding: 16px 12px 32px !important; }
  #pkm-cp-calc-root .pkm-results-grid { grid-template-columns: repeat(3,1fr) !important; }
}
@media(max-width:420px) {
  #pkm-cp-calc-root .pkm-results-grid { grid-template-columns: 1fr 1fr !important; }
}
</style>

<script>
const pkmData=<?php echo wp_json_encode( $js_data ); ?>;
const pkmEvoData=<?php echo wp_json_encode( $evo_data ); ?>;
const pkmCosts=<?php echo wp_json_encode( $power_up_costs ); ?>;
</script>

<div class="pkm-calc-wrap" id="pkm-cp-calc-root">



<div class="pkm-calc-header">
    <div class="pkm-calc-title-sprites">
        <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/150.png" alt="" width="56" height="56" loading="eager" onerror="this.style.display='none'">
        <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/149.png" alt="" width="56" height="56" loading="eager" onerror="this.style.display='none'">
        <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/68.png"  alt="" width="56" height="56" loading="eager" onerror="this.style.display='none'">
    </div>
    <h1 class="pkm-calc-title"><?php echo esc_html( $t['title'] ); ?></h1>
    <p class="pkm-calc-description"><?php echo esc_html( $t['description'] ); ?></p>
</div>

<div class="pkm-calc-inner">
<?php echo $pkm_render_ad( $ad_slot_a, 'pkm-ad-top' ); ?>
<div class="pkm-calc-layout" style="padding-top:24px !important;">
<div class="pkm-calc-main">

<noscript><div class="pkm-noscript-msg"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg><?php echo esc_html( $t['noscript_msg'] ); ?></div></noscript>

<div class="pkm-card">
    <div id="pkm-cp-search-wrap" class="pkm-search-wrap">
        <span class="pkm-search-icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></span>
        <input type="text" id="pkm-cp-search-input" class="pkm-search-input" placeholder="<?php echo esc_attr( $t['search_placeholder'] ); ?>" autocomplete="off" autocorrect="off" spellcheck="false" role="combobox" aria-expanded="false" aria-autocomplete="list" aria-controls="pkm-cp-search-dd">
        <div id="pkm-cp-search-dropdown" class="pkm-search-dropdown" role="listbox"></div>
    </div>
    <div id="pkm-cp-selected" class="pkm-selected-pokemon" aria-live="polite">
        <img id="pkm-cp-selected-sprite" src="" alt="" width="88" height="88" loading="lazy" onerror="this.style.display='none'">
        <div class="pkm-selected-info">
            <p id="pkm-cp-selected-name" class="pkm-selected-name"></p>
            <div id="pkm-cp-selected-types" class="pkm-selected-types"></div>
        </div>
    </div>
    <div class="pkm-inputs-grid">
        <div class="pkm-field">
            <div class="pkm-field-with-tooltip"><label for="pkm-cp-iv-atk"><?php echo esc_html( $t['iv_attack_label'] ); ?></label><span class="pkm-tooltip" data-tip="<?php echo esc_attr( $t['tooltip_iv'] ); ?>"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg></span></div>
            <input type="number" id="pkm-cp-iv-atk" class="pkm-input" min="0" max="15" value="15" inputmode="numeric" placeholder="0–15">
            <span class="pkm-field-error" id="pkm-err-atk"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>Must be 0–15</span>
        </div>
        <div class="pkm-field">
            <div class="pkm-field-with-tooltip"><label for="pkm-cp-iv-def"><?php echo esc_html( $t['iv_defense_label'] ); ?></label><span class="pkm-tooltip" data-tip="<?php echo esc_attr( $t['tooltip_iv'] ); ?>"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg></span></div>
            <input type="number" id="pkm-cp-iv-def" class="pkm-input" min="0" max="15" value="15" inputmode="numeric" placeholder="0–15">
            <span class="pkm-field-error" id="pkm-err-def"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>Must be 0–15</span>
        </div>
        <div class="pkm-field">
            <div class="pkm-field-with-tooltip"><label for="pkm-cp-iv-sta"><?php echo esc_html( $t['iv_stamina_label'] ); ?></label><span class="pkm-tooltip" data-tip="<?php echo esc_attr( $t['tooltip_iv'] ); ?>"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg></span></div>
            <input type="number" id="pkm-cp-iv-sta" class="pkm-input" min="0" max="15" value="15" inputmode="numeric" placeholder="0–15">
            <span class="pkm-field-error" id="pkm-err-sta"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>Must be 0–15</span>
        </div>
    </div>
    <div class="pkm-level-section">
        <div class="pkm-level-header">
            <label for="pkm-cp-level-slider"><?php echo esc_html( $t['level_label'] ); ?></label>
            <span class="pkm-level-value" id="pkm-cp-level-display">20</span>
        </div>
        <input type="range" id="pkm-cp-level-slider" class="pkm-slider" min="1" max="51" step="0.5" value="20" aria-valuemin="1" aria-valuemax="51" aria-valuenow="20">
        <div class="pkm-presets">
            <button class="pkm-preset-btn" data-level="15"><?php echo esc_html( $t['preset_research'] ); ?></button>
            <button class="pkm-preset-btn active" data-level="20"><?php echo esc_html( $t['preset_raid'] ); ?></button>
            <button class="pkm-preset-btn" data-level="25"><?php echo esc_html( $t['preset_weather'] ); ?></button>
            <button class="pkm-preset-btn" data-level="40"><?php echo esc_html( $t['preset_max40'] ); ?></button>
            <button class="pkm-preset-btn" data-level="50"><?php echo esc_html( $t['preset_max50'] ); ?></button>
        </div>
    </div>
    <div class="pkm-form-row">
        <div class="pkm-form-section">
            <div class="pkm-field-with-tooltip"><label><?php echo esc_html( $t['form_label'] ); ?></label><span class="pkm-tooltip" data-tip="Shadow:+20%ATK/-20%DEF | Purified:+2IVs"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg></span></div>
            <div class="pkm-toggle-group" role="group">
                <button class="pkm-toggle-btn active" data-form="normal"><?php echo esc_html( $t['form_normal'] ); ?></button>
                <button class="pkm-toggle-btn" data-form="shadow"><?php echo esc_html( $t['form_shadow'] ); ?></button>
                <button class="pkm-toggle-btn" data-form="purified"><?php echo esc_html( $t['form_purified'] ); ?></button>
            </div>
        </div>
        <div class="pkm-form-section">
            <div class="pkm-field-with-tooltip"><label><?php echo esc_html( $t['weather_label'] ); ?></label><span class="pkm-tooltip" data-tip="<?php echo esc_attr( $t['tooltip_weather'] ); ?>"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg></span></div>
            <div class="pkm-toggle-group" role="group">
                <button class="pkm-toggle-btn active" data-weather="0"><?php echo esc_html( $t['weather_none'] ); ?></button>
                <button class="pkm-toggle-btn" data-weather="1">+20%</button>
            </div>
        </div>
    </div>
    <div class="pkm-btn-row">
    <button class="pkm-calc-btn" id="pkm-cp-calc-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="3" y1="15" x2="21" y2="15"/><line x1="9" y1="3" x2="9" y2="21"/><line x1="15" y1="3" x2="15" y2="21"/></svg>
        <?php echo esc_html( $t['calculate_btn'] ); ?>
    </button>
    <button class="pkm-reset-btn" id="pkm-cp-reset-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-4.31"/></svg>
        <?php echo esc_html( $t['reset_btn'] ); ?>
    </button>
    </div>

    <div id="pkm-cp-results" class="pkm-results" role="region" aria-live="polite">
        <!-- Results header -->
        <div class="pkm-results-header">
            <div class="pkm-results-header-line"></div>
            <span class="pkm-results-header-title">Results</span>
            <div class="pkm-results-header-line"></div>
        </div>
        <!-- MAIN CP BIG CARD -->
        <div class="pkm-result-main">
            <span class="pkm-result-main-label"><?php echo esc_html( $t['result_cp'] ); ?></span>
            <span class="pkm-result-main-value" id="pkm-cp-r-cp">—</span>
            <span class="pkm-result-main-unit">Combat Power</span>
            <div><span class="pkm-result-main-hp"><svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg><span id="pkm-cp-r-hp">—</span> HP</span></div>
        </div>
        <!-- SECONDARY STAT CARDS -->
        <div class="pkm-results-grid">
            <div class="pkm-result-card"><span class="pkm-result-label"><?php echo esc_html( $t['result_max_cp_40'] ); ?></span><span class="pkm-result-value" id="pkm-cp-r-max40">—</span><span class="pkm-result-unit">CP @ Lv 40</span></div>
            <div class="pkm-result-card"><span class="pkm-result-label"><?php echo esc_html( $t['result_max_cp_50'] ); ?></span><span class="pkm-result-value" id="pkm-cp-r-max50">—</span><span class="pkm-result-unit">CP @ Lv 50</span></div>
            <div class="pkm-result-card" id="pkm-evo-main-card"><span class="pkm-result-label"><?php echo esc_html( $t['result_evo_cp'] ); ?></span><span class="pkm-result-value" id="pkm-cp-r-evo-main">—</span><span class="pkm-result-unit" id="pkm-evo-main-note">Next Evo CP</span></div>
        </div>
        <!-- IV BAR -->
        <div class="pkm-iv-bar-wrap">
            <div class="pkm-iv-bar-header">
                <span class="pkm-iv-bar-label"><?php echo esc_html( $t['result_iv_pct'] ); ?></span>
                <div style="display:flex;align-items:center;gap:8px;">
                    <span class="pkm-iv-quality" id="pkm-iv-quality-badge"></span>
                    <span id="pkm-cp-r-iv-bar-pct" style="font-family:var(--pkm-font-heading);font-size:16px;font-weight:800;"></span>
                </div>
            </div>
            <div id="pkm-cp-iv-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                <div id="pkm-cp-iv-bar-fill"></div>
            </div>
        </div>
        <!-- STARDUST & CANDY -->
        <div class="pkm-cost-row">
            <div class="pkm-cost-chip"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F4D03F" stroke-width="2" aria-hidden="true"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg><div class="pkm-cost-chip-info"><div class="pkm-cost-chip-label"><?php echo esc_html( $t['result_stardust'] ); ?></div><div class="pkm-cost-chip-value" id="pkm-cp-r-stardust">—</div></div></div>
            <div class="pkm-cost-chip"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2ECC71" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg><div class="pkm-cost-chip-info"><div class="pkm-cost-chip-label"><?php echo esc_html( $t['result_candy'] ); ?></div><div class="pkm-cost-chip-value" id="pkm-cp-r-candy">—</div></div></div>
        </div>
        <?php echo $pkm_render_ad( $ad_slot_b, 'pkm-ad-result' ); ?>
        <div class="pkm-evo-results" id="pkm-cp-evo-results" style="display:none !important;">
            <span class="pkm-evo-title"><?php echo esc_html( $t['result_evo_cp'] ); ?></span>
            <div class="pkm-evo-grid" id="pkm-cp-evo-grid"></div>
        </div>
    </div>
</div>

<?php echo $pkm_render_ad( $ad_slot_c, 'pkm-ad-mid' ); ?>

<section class="pkm-calc-section">
    <h2><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg><?php echo esc_html( $t['intro_title'] ); ?></h2>
    <p><?php echo wp_kses_post( $t['intro_content'] ); ?></p>
</section>

<section class="pkm-calc-section">
    <h2><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg><?php echo esc_html( $t['howto_title'] ); ?></h2>
    <ol><?php for ( $i = 1; $i <= 4; $i++ ) echo '<li>' . esc_html( $t["howto_step{$i}"] ) . '</li>'; ?></ol>
</section>

<section class="pkm-calc-section">
    <h2><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg><?php echo esc_html( $t['info_title'] ); ?></h2>
    <?php echo wp_kses_post( $t['info_content'] ); ?>
    <h3><?php echo esc_html( $t['info_table_title'] ); ?></h3>
    <div class="pkm-table-wrapper" style="overflow-x:auto !important;"><?php echo wp_kses_post( $t['info_table_html'] ); ?></div>
</section>

<?php echo $pkm_render_ad( $ad_slot_d, 'pkm-ad-faq' ); ?>

<section class="pkm-calc-section">
    <h2><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg><?php echo esc_html( $t['faq_title'] ); ?></h2>
    <div itemscope itemtype="https://schema.org/FAQPage">
    <?php for ( $i = 1; $i <= 8; $i++ ): ?>
    <div class="pkm-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <button class="pkm-faq-q" aria-expanded="false"><span class="pkm-faq-q-text" itemprop="name"><?php echo esc_html( $t["faq_q{$i}"] ); ?></span><svg class="pkm-faq-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg></button>
        <div class="pkm-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><p itemprop="text"><?php echo wp_kses_post( $t["faq_a{$i}"] ); ?></p></div>
    </div>
    <?php endfor; ?>
    </div>
</section>

<section class="pkm-calc-section">
    <h2><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg><?php echo esc_html( $t['related_title'] ); ?></h2>
    <?php
    $related = pkm_get_related_tools( get_the_ID() );
    if ( ! empty( $related ) ) :
    ?><div class="pkm-related-grid"><?php foreach ( $related as $tool ) : ?><a href="<?php echo esc_url( $tool['url'] ); ?>" class="pkm-related-card"><div class="pkm-related-icon"><?php echo wp_kses_post( $tool['svg_icon'] ); ?></div><div><div class="pkm-related-card-title"><?php echo esc_html( $tool['title'] ); ?></div><?php if ( $tool['description'] ) : ?><div class="pkm-related-card-desc"><?php echo esc_html( $tool['description'] ); ?></div><?php endif; ?></div></a><?php endforeach; ?></div>
    <?php else : ?>
    <p class="pkm-calc-no-related"><?php echo esc_html( $t['no_related_tools'] ); ?></p>
    <?php endif; ?>
</section>

<?php echo $pkm_render_ad( $ad_slot_f, 'pkm-ad-bottom' ); ?>

</div><!-- /.pkm-calc-main -->

<?php if ( ! empty( trim( $ad_slot_e ) ) ) : ?>
<aside class="pkm-calc-sidebar"><?php echo $pkm_render_ad( $ad_slot_e, 'pkm-ad-sidebar' ); ?></aside>
<?php endif; ?>

</div><!-- /.pkm-calc-layout -->
</div><!-- /.pkm-calc-inner -->
</div><!-- /#pkm-cp-calc-root -->

<script>
(function(){
'use strict';
var CPM={1:.094,1.5:.1351374,2:.16639787,2.5:.19291956,3:.21573247,3.5:.23611396,4:.25572005,4.5:.27353784,5:.29024988,5.5:.30605003,6:.32108760,6.5:.33544503,7:.34921268,7.5:.36245775,8:.37523559,8.5:.38759241,9:.39956728,9.5:.41119565,10:.42250001,10.5:.43350169,11:.44412796,11.5:.45439093,12:.46410985,12.5:.47337980,13:.48263070,13.5:.49153763,14:.50000001,14.5:.50753750,15:.51459509,15.5:.52220153,16:.52954993,16.5:.53663955,17:.54346918,17.5:.55007987,18:.55645735,18.5:.56260744,19:.56854249,19.5:.57426747,20:.57978600,20.5:.58510000,21:.59020896,21.5:.59512540,22:.59985881,22.5:.60441220,23:.60878956,23.5:.61300156,24:.61704862,24.5:.62093982,25:.62468166,25.5:.62827539,26:.63172483,26.5:.63503443,27:.63821468,27.5:.64127040,28:.64420812,28.5:.64703715,29:.64975635,29.5:.65237170,30:.65571250,30.5:.65837870,31:.66093790,31.5:.66340050,32:.66577290,32.5:.66806380,33:.67027390,33.5:.67240910,34:.67447850,34.5:.67648940,35:.67843780,35.5:.68033040,36:.68216940,36.5:.68395700,37:.68569670,37.5:.68739270,38:.68904840,38.5:.69066620,39:.69224810,39.5:.69379670,40:.69530000,40.5:.69677640,41:.69822090,41.5:.69963950,42:.70103080,42.5:.70239370,43:.70372800,43.5:.70503440,44:.70631310,44.5:.70756510,45:.70879990,45.5:.71001490,46:.71121040,46.5:.71238710,47:.71354530,47.5:.71468560,48:.71580900,48.5:.71691610,49:.71800800,49.5:.71908660,50:.72015160,50.5:.72122980,51:.72229760};
function cap(s){return s?s.charAt(0).toUpperCase()+s.slice(1):'';}
function tc(t){return'pkm-type-'+(t||'normal').toLowerCase();}
// State
var S={pokemon:null,level:20,form:'normal',weather:0};
// Search
var SI=document.getElementById('pkm-cp-search-input');
var SD=document.getElementById('pkm-cp-search-dropdown');
var FL=[],AI=-1;
function renderDD(list){FL=list;AI=-1;if(!list.length){SD.classList.remove('open');SD.innerHTML='';return;}var h='';list.forEach(function(p,i){var sp=p.sprite?'<img src="'+p.sprite+'" alt="" width="36" height="36" loading="lazy" onerror="this.style.display=\'none\'">':'<span style="width:36px;display:inline-block"></span>';var ty=p.types.map(function(t){return'<span class="pkm-type-badge '+tc(t)+'">'+cap(t)+'</span>';}).join('');h+='<div class="pkm-search-item" data-idx="'+i+'" role="option" tabindex="-1">'+sp+'<div class="pkm-search-item-info"><div class="pkm-search-item-name">'+cap(p.name)+'</div><div class="pkm-search-item-meta">'+ty+'</div></div></div>';});SD.innerHTML=h;SD.classList.add('open');SI.setAttribute('aria-expanded','true');SD.querySelectorAll('.pkm-search-item').forEach(function(el){el.addEventListener('mousedown',function(e){e.preventDefault();selPKM(FL[+this.dataset.idx]);});});}
SI.addEventListener('input',function(){var q=this.value.trim().toLowerCase();if(!q){SD.classList.remove('open');SD.innerHTML='';return;}renderDD(pkmData.filter(function(p){return p.name.indexOf(q)!==-1;}).slice(0,20));});
SI.addEventListener('keydown',function(e){if(!SD.classList.contains('open'))return;var its=SD.querySelectorAll('.pkm-search-item');if(e.key==='ArrowDown'){e.preventDefault();AI=Math.min(AI+1,its.length-1);its.forEach(function(el,i){el.classList.toggle('active',i===AI);});}else if(e.key==='ArrowUp'){e.preventDefault();AI=Math.max(AI-1,0);its.forEach(function(el,i){el.classList.toggle('active',i===AI);});}else if(e.key==='Enter'&&AI>=0){e.preventDefault();selPKM(FL[AI]);}else if(e.key==='Escape'){SD.classList.remove('open');SI.setAttribute('aria-expanded','false');}});
document.addEventListener('click',function(e){if(!SI.contains(e.target)&&!SD.contains(e.target)){SD.classList.remove('open');SI.setAttribute('aria-expanded','false');}});
function selPKM(p){S.pokemon=p;SI.value=cap(p.name);SD.classList.remove('open');SI.setAttribute('aria-expanded','false');var sel=document.getElementById('pkm-cp-selected');var sprEl=document.getElementById('pkm-cp-selected-sprite');if(p.sprite){sprEl.src=p.sprite;sprEl.alt=cap(p.name);sprEl.style.display='block';}else{sprEl.style.display='none';}document.getElementById('pkm-cp-selected-name').textContent=cap(p.name);document.getElementById('pkm-cp-selected-types').innerHTML=p.types.map(function(t){return'<span class="pkm-type-badge '+tc(t)+'">'+cap(t)+'</span>';}).join('');sel.classList.add('visible');}
// Slider
var SL=document.getElementById('pkm-cp-level-slider');var LD=document.getElementById('pkm-cp-level-display');
function setSlider(v){S.level=v;SL.value=v;LD.textContent=v;var pct=((v-1)/50*100).toFixed(1)+'%';SL.style.setProperty('--slider-pct',pct);document.querySelectorAll('.pkm-preset-btn').forEach(function(b){b.classList.toggle('active',parseFloat(b.dataset.level)===v);});}
SL.addEventListener('input',function(){setSlider(parseFloat(this.value));});
document.querySelectorAll('.pkm-preset-btn').forEach(function(b){b.addEventListener('click',function(){setSlider(parseFloat(this.dataset.level));});});
setSlider(20);
// Toggles
document.querySelectorAll('.pkm-toggle-btn[data-form]').forEach(function(b){b.addEventListener('click',function(){S.form=this.dataset.form;document.querySelectorAll('.pkm-toggle-btn[data-form]').forEach(function(x){x.classList.toggle('active',x.dataset.form===S.form);});});});
document.querySelectorAll('.pkm-toggle-btn[data-weather]').forEach(function(b){b.addEventListener('click',function(){S.weather=parseInt(this.dataset.weather);document.querySelectorAll('.pkm-toggle-btn[data-weather]').forEach(function(x){x.classList.toggle('active',x.dataset.weather==S.weather);});});});
// CP Formula
function calcCP(bA,bD,bS,iA,iD,iS,lv,form){var eA=bA+iA,eD=bD+iD,eS=bS+iS;if(form==='shadow'){eA=eA*1.2;eD=eD*0.8;}else if(form==='purified'){iA=Math.min(15,iA+2);iD=Math.min(15,iD+2);iS=Math.min(15,iS+2);eA=bA+iA;eD=bD+iD;eS=bS+iS;}var cpm=CPM[lv]||CPM[40];return Math.max(10,Math.floor(eA*Math.pow(eD,0.5)*Math.pow(eS,0.5)*cpm*cpm/10));}
function calcHP(bS,iS,lv,form){var eS=bS+iS;if(form==='purified')eS=bS+Math.min(15,iS+2);return Math.max(10,Math.floor(eS*(CPM[lv]||CPM[40])));}
function calcCost(curLv,maxLv){var d=0,c=0;Object.keys(pkmCosts).map(Number).sort(function(a,b){return a-b;}).forEach(function(lv){if(lv>curLv&&lv<=maxLv){d+=pkmCosts[lv][0];c+=pkmCosts[lv][1];}});return{d:d,c:c};}
// Calculate
function validateIV(inputId,errId){var el=document.getElementById(inputId);var errEl=document.getElementById(errId);var v=parseInt(el.value);var invalid=isNaN(v)||v<0||v>15||el.value.trim()==='';if(invalid){el.classList.add('pkm-input-error');errEl.classList.add('visible');return null;}else{el.classList.remove('pkm-input-error');errEl.classList.remove('visible');return v;}}
document.getElementById('pkm-cp-calc-btn').addEventListener('click',function(){
    var iA=validateIV('pkm-cp-iv-atk','pkm-err-atk');
    var iD=validateIV('pkm-cp-iv-def','pkm-err-def');
    var iS=validateIV('pkm-cp-iv-sta','pkm-err-sta');
    if(iA===null||iD===null||iS===null){return;}
    var p=S.pokemon;
    if(!p){var si=document.getElementById('pkm-cp-search-input');si.style.borderColor='#0D9488';si.style.boxShadow='0 0 0 3px rgba(13, 148, 136, 0.2)';si.placeholder='⚠ Please select a Pokémon first';setTimeout(function(){si.style.borderColor='';si.style.boxShadow='';si.placeholder=si.getAttribute('data-placeholder')||'Search Pokémon…';},3000);return;}
    var bA=p.stats.attack||0,bD=p.stats.defense||0,bS=p.stats.hp||0;
    var form=S.form,lv=S.level;
    var calcIA=iA,calcID=iD,calcIS=iS;
    if(form==='purified'){calcIA=Math.min(15,iA+2);calcID=Math.min(15,iD+2);calcIS=Math.min(15,iS+2);}
    var cp=calcCP(bA,bD,bS,iA,iD,iS,lv,form);
    var hp=calcHP(bS,iS,lv,form);
    var max40=calcCP(bA,bD,bS,15,15,15,40,form);
    var max50=calcCP(bA,bD,bS,15,15,15,50,form);
    var ivPct=Math.round((calcIA+calcID+calcIS)/45*100);
    var cost40=calcCost(lv,40);
    var evos=pkmEvoData[p.name.toLowerCase()]||[];
    var evoMain=evos.length>0?Math.floor(cp*evos[0][1]):null;
    document.getElementById('pkm-cp-r-cp').textContent=cp.toLocaleString();
    document.getElementById('pkm-cp-r-hp').textContent=hp.toLocaleString();
    document.getElementById('pkm-cp-r-max40').textContent=max40.toLocaleString();
    document.getElementById('pkm-cp-r-max50').textContent=max50.toLocaleString();
    // Evo main card — show CP or explain why no evo
    var evoMainEl=document.getElementById('pkm-cp-r-evo-main');
    var evoNoteEl=document.getElementById('pkm-evo-main-note');
    var evoCardEl=document.getElementById('pkm-evo-main-card');
    if(evoMain!==null){
        evoMainEl.textContent=evoMain.toLocaleString();
        evoMainEl.style.fontSize='';
        evoNoteEl.textContent='Next Evo CP';
        evoCardEl.style.opacity='1';
    }else{
        // Determine reason
        var pname=p.name.toLowerCase();
        var isLegendary=['mewtwo','mew','articuno','zapdos','moltres','raikou','entei','suicune','lugia','ho-oh','celebi','regirock','regice','registeel','latias','latios','kyogre','groudon','rayquaza','jirachi','deoxys','uxie','mesprit','azelf','dialga','palkia','heatran','regigigas','giratina','cresselia','phione','manaphy','darkrai','shaymin','arceus','victini','cobalion','terrakion','virizion','tornadus','thundurus','reshiram','zekrom','landorus','kyurem','keldeo','meloetta','genesect','xerneas','yveltal','zygarde','diancie','hoopa','volcanion','type-null','silvally','tapu-koko','tapu-lele','tapu-bulu','tapu-fini','cosmog','cosmoem','solgaleo','lunala','nihilego','buzzwole','pheromosa','xurkitree','celesteela','kartana','guzzlord','necrozma','magearna','marshadow','poipole','naganadel','stakataka','blacephalon','zeraora','meltan','melmetal','zacian','zamazenta','eternatus','kubfu','urshifu','zarude','regieleki','regidrago','glastrier','spectrier','calyrex','enamorus','wo-chien','chien-pao','ting-lu','chi-yu','koraidon','miraidon'].indexOf(pname)!==-1;
        var isFinalEvo=!pkmEvoData[pname]||pkmEvoData[pname].length===0;
        var isBaby=['pichu','cleffa','igglybuff','togepi','tyrogue','smoochum','elekid','magby','azurill','wynaut','budew','chingling','bonsly','mime-jr','happiny','munchlax','riolu','mantyke'].indexOf(pname)!==-1;
        if(isLegendary){evoMainEl.textContent='—';evoMainEl.style.fontSize='22px';evoNoteEl.textContent='Legendary — no evolution';}
        else if(isFinalEvo){evoMainEl.textContent='—';evoMainEl.style.fontSize='22px';evoNoteEl.textContent='Final evolution stage';}
        else if(isBaby){evoMainEl.textContent='—';evoMainEl.style.fontSize='22px';evoNoteEl.textContent='Baby form — evolves via friendship';}
        else{evoMainEl.textContent='—';evoMainEl.style.fontSize='22px';evoNoteEl.textContent='No evolution data';}
        evoCardEl.style.opacity='0.7';
    }
    document.getElementById('pkm-cp-r-stardust').textContent=lv>=40?'Maxed':cost40.d.toLocaleString();
    document.getElementById('pkm-cp-r-candy').textContent=lv>=40?'Maxed':cost40.c.toLocaleString();
    // IV bar: dynamic colour + quality label
    var ivBarFill=document.getElementById('pkm-cp-iv-bar-fill');
    var ivBarEl=document.getElementById('pkm-cp-iv-bar');
    var ivQuality,ivColor,ivGlow;
    if(ivPct===100){ivQuality='Perfect ✨';ivColor='linear-gradient(90deg,#8e44ad,#9b59b6)';ivGlow='rgba(142,68,173,0.5)';}
    else if(ivPct>=93){ivQuality='Great';ivColor='linear-gradient(90deg,#2980b9,#3498db)';ivGlow='rgba(52,152,219,0.45)';}
    else if(ivPct>=82){ivQuality='Good';ivColor='linear-gradient(90deg,#27ae60,#2ecc71)';ivGlow='rgba(46,204,113,0.45)';}
    else if(ivPct>=67){ivQuality='Average';ivColor='linear-gradient(90deg,#d4ac0d,#f1c40f)';ivGlow='rgba(241,196,15,0.45)';}
    else if(ivPct>=33){ivQuality='Poor';ivColor='linear-gradient(90deg,#d35400,#e67e22)';ivGlow='rgba(230,126,34,0.45)';}
    else{ivQuality='Terrible';ivColor='linear-gradient(90deg,#c0392b,#e74c3c)';ivGlow='rgba(231,76,60,0.45)';}
    ivBarFill.style.cssText='display:block !important;height:14px !important;border-radius:7px !important;max-width:100% !important;width:'+ivPct+'% !important;background:'+ivColor+' !important;box-shadow:0 2px 8px '+ivGlow+' !important;transition:width 0.7s cubic-bezier(0.4,0,0.2,1),background 0.4s ease !important;';
    ivBarEl.setAttribute('aria-valuenow',ivPct);
    var pctEl=document.getElementById('pkm-cp-r-iv-bar-pct');
    pctEl.textContent=ivPct+'%';
    pctEl.style.color=ivPct===100?'#8e44ad':ivPct>=93?'#2980b9':ivPct>=82?'#27ae60':ivPct>=67?'#d4ac0d':ivPct>=33?'#e67e22':'#e74c3c';
    var qBadge=document.getElementById('pkm-iv-quality-badge');
    var qClass=ivPct===100?'iv-perfect':ivPct>=93?'iv-great':ivPct>=82?'iv-good':ivPct>=67?'iv-average':ivPct>=33?'iv-poor':'iv-terrible';
    qBadge.className='pkm-iv-quality '+qClass;
    qBadge.textContent=ivQuality;
    var eg=document.getElementById('pkm-cp-evo-grid');eg.innerHTML='';
    if(evos.length>0){evos.forEach(function(evo){var ec=Math.floor(cp*evo[1]);var ed=null;for(var i=0;i<pkmData.length;i++){if(pkmData[i].name===evo[0]){ed=pkmData[i];break;}}var sp=ed&&ed.sprite?'<img src="'+ed.sprite+'" alt="'+evo[0]+'" width="52" height="52" loading="lazy" onerror="this.style.display=\'none\'">':'';eg.innerHTML+='<div class="pkm-evo-card">'+sp+'<div class="pkm-evo-name">'+cap(evo[0])+'</div><div class="pkm-evo-cp">'+ec.toLocaleString()+'</div><div class="pkm-evo-cp-label">CP</div></div>';});document.getElementById('pkm-cp-evo-results').style.cssText='display:block !important;';}else{document.getElementById('pkm-cp-evo-results').style.cssText='display:none !important;';}
    document.getElementById('pkm-cp-results').classList.add('visible');
    document.getElementById('pkm-cp-results').scrollIntoView({behavior:'smooth',block:'nearest'});
});
// Real-time IV validation on input
['pkm-cp-iv-atk','pkm-cp-iv-def','pkm-cp-iv-sta'].forEach(function(id,i){var errIds=['pkm-err-atk','pkm-err-def','pkm-err-sta'];document.getElementById(id).addEventListener('input',function(){var v=parseInt(this.value);var invalid=this.value.trim()!==''&&(isNaN(v)||v<0||v>15);this.classList.toggle('pkm-input-error',invalid);document.getElementById(errIds[i]).classList.toggle('visible',invalid);});});
// Reset
document.getElementById('pkm-cp-reset-btn').addEventListener('click',function(){S.pokemon=null;document.getElementById('pkm-cp-search-input').value='';document.getElementById('pkm-cp-selected').classList.remove('visible');document.getElementById('pkm-cp-iv-atk').value=15;document.getElementById('pkm-cp-iv-def').value=15;document.getElementById('pkm-cp-iv-sta').value=15;['pkm-cp-iv-atk','pkm-cp-iv-def','pkm-cp-iv-sta'].forEach(function(id){document.getElementById(id).classList.remove('pkm-input-error');});['pkm-err-atk','pkm-err-def','pkm-err-sta'].forEach(function(id){document.getElementById(id).classList.remove('visible');});S.form='normal';S.weather=0;document.querySelectorAll('.pkm-toggle-btn[data-form]').forEach(function(b){b.classList.toggle('active',b.dataset.form==='normal');});document.querySelectorAll('.pkm-toggle-btn[data-weather]').forEach(function(b){b.classList.toggle('active',b.dataset.weather==='0');});setSlider(20);document.getElementById('pkm-cp-results').classList.remove('visible');});
// FAQ
document.querySelectorAll('.pkm-faq-q').forEach(function(btn){btn.addEventListener('click',function(){var isO=this.classList.contains('open');document.querySelectorAll('.pkm-faq-q').forEach(function(b){b.classList.remove('open');b.setAttribute('aria-expanded','false');var a=b.nextElementSibling;if(a)a.classList.remove('open');});if(!isO){this.classList.add('open');this.setAttribute('aria-expanded','true');var ans=this.nextElementSibling;if(ans)ans.classList.add('open');}});});
}());
</script>
    <?php
    return ob_get_clean();
}
add_shortcode( 'pkm_cp_calculator_calc', 'pkm_cp_calculator_calc' );