<?php
// Standalone PHP

/*
 * ============================================================
 * Pokemon GO Stardust Calculator
 * File: wp-content/themes/theme-v1.3.0/pkm-calculators/pkm-stardust.php
 * Shortcode: [pkm_stardust_calc]
 * ============================================================
 *
 * LANGUAGE SWITCHER SETUP — REQUIRED
 * Add the following line to the $slug_map array inside
 * the pkm_get_lang_url() function in functions.php:
 *
 * 'stardust-calculator' => array('es' => 'calculadora-polvo-estelar', 'pt-br' => 'calculadora-po-estelar', 'fr' => 'calculateur-poussiere-etoile', 'de' => 'sternenstaub-rechner'),
 *
 * ============================================================
 * FUNCTIONS.PHP — ADD THIS LINE:
 * require_once get_stylesheet_directory() . '/pkm-calculators/pkm-stardust.php';
 * ============================================================
 */

// ── Google Analytics ──────────────────────────────────────────
function pkm_stardust_gtag() {
    if ( ! is_page( [ 'stardust-calculator', 'calculadora-polvo-estelar', 'calculadora-po-estelar', 'calculateur-poussiere-etoile', 'sternenstaub-rechner' ] ) ) return;
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
add_action( 'wp_head', 'pkm_stardust_gtag', 1 );

// ── Hreflang ──────────────────────────────────────────────────
function pkm_stardust_hreflang() {
    if ( ! is_page( [ 'stardust-calculator', 'calculadora-polvo-estelar', 'calculadora-po-estelar', 'calculateur-poussiere-etoile', 'sternenstaub-rechner' ] ) ) return;
    $langs = [ 'en', 'es', 'pt-br', 'fr', 'de' ];
    foreach ( $langs as $l ) {
        $hreflang = ( $l === 'pt-br' ) ? 'pt-BR' : $l;
        echo '<link rel="alternate" hreflang="' . esc_attr( $hreflang ) . '" href="' . esc_url( pkm_get_lang_url( $l ) ) . '">' . "\n";
    }
    echo '<link rel="alternate" hreflang="x-default" href="' . esc_url( pkm_get_lang_url( 'en' ) ) . '">' . "\n";
}
add_action( 'wp_head', 'pkm_stardust_hreflang' );

// ── Canonical ─────────────────────────────────────────────────
function pkm_stardust_canonical() {
    if ( ! is_page( [ 'stardust-calculator', 'calculadora-polvo-estelar', 'calculadora-po-estelar', 'calculateur-poussiere-etoile', 'sternenstaub-rechner' ] ) ) return;
    $url = ( is_ssl() ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    echo '<link rel="canonical" href="' . esc_url( $url ) . '">' . "\n";
}
add_action( 'wp_head', 'pkm_stardust_canonical' );

// ── Schema ────────────────────────────────────────────────────
function pkm_stardust_schema() {
    if ( ! is_page( [ 'stardust-calculator', 'calculadora-polvo-estelar', 'calculadora-po-estelar', 'calculateur-poussiere-etoile', 'sternenstaub-rechner' ] ) ) return;
    global $pkm_current_lang;
    $lang     = $pkm_current_lang ?? 'en';
    $curr_url = ( is_ssl() ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $schema_names = [
        'en'    => 'Pokemon GO Stardust Calculator',
        'es'    => 'Calculadora de Polvo Estelar Pokemon GO',
        'pt-br' => 'Calculadora de Pó Estelar Pokemon GO',
        'fr'    => 'Calculateur de Poussière Étoile Pokemon GO',
        'de'    => 'Sternenstaub-Rechner für Pokémon GO',
    ];
    $schema_descs = [
        'en'    => 'Calculate stardust and candy costs to power up, max out, trade, or purify any Pokemon in Pokemon GO.',
        'es'    => 'Calcula el costo de polvo estelar y caramelos para mejorar, maximizar, intercambiar o purificar cualquier Pokemon en Pokemon GO.',
        'pt-br' => 'Calcule o custo de pó estelar e balas para melhorar, maximizar, trocar ou purificar qualquer Pokemon no Pokemon GO.',
        'fr'    => 'Calculez le coût en poussière étoile et en bonbons pour améliorer, maximiser, échanger ou purifier n\'importe quel Pokémon dans Pokémon GO.',
        'de'    => 'Berechne Sternenstaub- und Bonbon-Kosten zum Stärken, Maximieren, Tauschen oder Reinigen eines Pokémon in Pokémon GO.',
    ];
    $schema = [
        '@context' => 'https://schema.org',
        '@graph'   => [
            [
                '@type'       => 'WebApplication',
                'name'        => $schema_names[ $lang ] ?? $schema_names['en'],
                'description' => $schema_descs[ $lang ] ?? $schema_descs['en'],
                'url'         => $curr_url,
                'inLanguage'  => $lang === 'pt-br' ? 'pt-BR' : $lang,
                'applicationCategory' => 'GameApplication',
                'operatingSystem'     => 'Any',
                'isAccessibleForFree' => true,
            ],
            [
                '@type' => 'HowTo',
                'name'  => 'step1_placeholder',
                'step'  => [
                    [ '@type' => 'HowToStep', 'text' => 'step1_placeholder' ],
                    [ '@type' => 'HowToStep', 'text' => 'step2_placeholder' ],
                    [ '@type' => 'HowToStep', 'text' => 'step3_placeholder' ],
                    [ '@type' => 'HowToStep', 'text' => 'step4_placeholder' ],
                ],
            ],
            [
                '@type'      => 'FAQPage',
                'mainEntity' => [
                    [ '@type' => 'Question', 'name' => 'faq_q1_placeholder', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'faq_a1_placeholder' ] ],
                    [ '@type' => 'Question', 'name' => 'faq_q2_placeholder', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'faq_a2_placeholder' ] ],
                ],
            ],
            [
                '@type'           => 'BreadcrumbList',
                'itemListElement' => [
                    [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' . $lang . '/' ) ],
                    [ '@type' => 'ListItem', 'position' => 2, 'name' => $schema_names[ $lang ] ?? $schema_names['en'], 'item' => $curr_url ],
                ],
            ],
        ],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'pkm_stardust_schema' );

// ── Strings ───────────────────────────────────────────────────
$pkm_stardust_strings = [
    'en' => [
        'title'                  => 'Stardust Calculator',
        'description'            => 'Calculate exact stardust & candy costs to power up, max out, trade, or purify any Pokémon in GO.',
        'tab_powerup'            => 'Power Up',
        'tab_maxout'             => 'Max Out',
        'tab_trade'              => 'Trade',
        'tab_purify'             => 'Purify',
        'select_pokemon'         => 'Search Pokémon...',
        'current_level'          => 'Current Level',
        'target_level'           => 'Target Level',
        'toggle_lucky'           => 'Lucky Pokémon (–50% stardust)',
        'toggle_shadow'          => 'Shadow Pokémon (+20% stardust)',
        'toggle_buddy'           => 'Best Buddy (–10% stardust)',
        'toggle_xl_research'     => 'XL Candy from Research',
        'calculate_btn'          => 'Calculate',
        'reset_btn'              => 'Reset',
        'result_stardust'        => 'Total Stardust',
        'result_candy'           => 'Total Candy',
        'result_xl_candy'        => 'Total XL Candy',
        'result_steps'           => 'Power-Up Steps',
        'table_level'            => 'Level',
        'table_stardust'         => 'Stardust',
        'table_candy'            => 'Candy',
        'table_xl_candy'         => 'XL Candy',
        'table_cumulative'       => 'Cumulative ★',
        'max_level_label'        => 'Max Level',
        'max_level_40'           => 'Level 40 (Standard)',
        'max_level_50'           => 'Level 50 (Best Buddy / XL)',
        'trade_tier_label'       => 'Trade Type',
        'trade_tier_standard'    => 'Standard',
        'trade_tier_special'     => 'Special (New Pokédex entry)',
        'trade_tier_ultra'       => 'Ultra Beast',
        'trade_tier_legendary'   => 'Legendary / Mythical / Shiny',
        'friendship_label'       => 'Friendship Level',
        'friendship_good'        => 'Good Friend',
        'friendship_great'       => 'Great Friend',
        'friendship_ultra'       => 'Ultra Friend',
        'friendship_best'        => 'Best Friend',
        'result_trade_cost'      => 'Stardust Cost',
        'purify_result_stardust' => 'Stardust to Purify',
        'purify_result_candy'    => 'Candy to Purify',
        'purify_note'            => 'Purifying removes Shadow status and boosts IVs by +2 in each stat.',
        'copy_btn'               => 'Copy Results',
        'copied'                 => 'Copied!',
        'error_data_load'        => 'Could not load Pokémon data. Please refresh the page.',
        'error_select_pokemon'   => 'Please select a Pokémon first.',
        'error_invalid_level'    => 'Level must be between 1 and 50.',
        'error_invalid_iv'       => 'IV values must be between 0 and 15.',
        'error_no_results'       => 'No Pokémon found matching your search.',
        'error_calculation'      => 'Calculation error. Please check your inputs.',
        'error_same_level'       => 'Target level must be higher than current level.',
        'noscript_msg'           => 'Please enable JavaScript to use this calculator.',
        'meta_title'             => 'Pokemon GO Stardust Calculator | pokemoncalculator.online',
        'meta_desc'              => 'Calculate exact stardust and candy costs to power up any Pokémon in GO. Covers Lucky, Shadow, Best Buddy, trades, purify, and Level 50. Fast and free.',
        'intro_title'            => 'Pokemon GO Stardust Calculator: Power Up Costs Instantly',
        'intro_content'          => '<p>The <strong>Pokemon GO stardust calculator</strong> gives you the exact stardust and candy cost to power up any Pokémon from your current level to any target level — no guesswork, no spreadsheets. Enter your Pokémon, set your start and target levels, and the tool above delivers the total stardust cost in seconds.</p><p>Stardust is the most precious resource in Pokémon GO. Unlike candy, you spend it across your entire roster, which means every power-up decision matters. Whether you\'re pushing a raid attacker like <strong>Mewtwo</strong> from Level 30 to Level 40, or grinding an XL <strong>Garchomp</strong> for Master League, knowing the exact cost in advance lets you farm efficiently and avoid wasted effort. Use our <a href="https://pokemoncalculator.online/en/pokemon-go-cp-calculator/">CP calculator</a> alongside this tool to check whether the power-up is actually worth it before committing your stardust.</p><p>The calculator accounts for every modifier that changes your cost: <strong>Lucky Pokémon</strong> reduce stardust by 50%, <strong>Shadow Pokémon</strong> increase it by 20%, and the <strong>Best Buddy</strong> bonus knocks off another 10%. You can toggle each of these on the Power Up tab to get an accurate figure for your specific Pokémon. For PvP players preparing for the GO Battle League, pair this with our <a href="https://pokemoncalculator.online/en/type-chart/">Type Chart</a> to confirm your Pokémon\'s stat product at the right level. Use the stardust calculator above to plan every power-up before you spend a single dust.</p>',
        'howto_title'            => 'How to Use the Stardust Calculator',
        'howto_step1'            => 'Select the <strong>Power Up</strong>, <strong>Max Out</strong>, <strong>Trade</strong>, or <strong>Purify</strong> tab depending on what you want to calculate. Type your Pokémon\'s name in the search box and select it from the dropdown — the sprite and name confirm your selection.',
        'howto_step2'            => 'Set your <strong>Current Level</strong> using the slider. Check your Pokémon\'s level in-game by opening its summary page — the arc above the Pokémon shows roughly where it sits, or use the in-game Appraise feature for the precise reading.',
        'howto_step3'            => 'Set the <strong>Target Level</strong> you want to reach. Toggle on <strong>Lucky</strong>, <strong>Shadow</strong>, or <strong>Best Buddy</strong> if applicable. For Max Out, choose Level 40 (standard cap) or Level 50 (requires XL Candy and Best Buddy badge).',
        'howto_step4'            => 'Tap <strong>Calculate</strong> to see the total stardust, candy, and XL Candy required. The results table shows costs per level so you can decide exactly where to stop. Copy the results to your clipboard with the Copy button for easy reference.',
        'info_title'             => 'How Stardust Costs Work in Pokémon GO',
        'info_content'           => '<p>Stardust powers up Pokémon by raising their level in 0.5 increments. Each level bracket has a fixed stardust and candy cost that applies to every Pokémon species regardless of rarity. The cost increases as you push higher levels, and the jump between Level 30–40 and Level 40–50 is significant — which is exactly why planning with a calculator is essential before spending.</p><h3>The Power-Up Cost Formula</h3><p>Pokémon GO does not publish its cost tables officially, but the community has reverse-engineered them precisely. Each level from 1 to 40 costs a fixed stardust amount: levels 1–10 cost <strong>200–1,000 stardust</strong> per step, levels 11–20 cost <strong>1,300–2,500</strong>, levels 21–30 cost <strong>3,000–6,000</strong>, and levels 31–40 cost <strong>7,000–10,000</strong>. To go from Level 1 to 40 costs exactly <strong>272,500 stardust</strong> and 273 candy for a standard Pokémon. Pushing to Level 50 adds another <strong>296,000 stardust</strong> and 296 XL Candy on top of that — a total of 568,500 stardust to fully max a single Pokémon.</p><p>For <strong>Shadow Pokémon</strong>, the 20% surcharge applies to every step. The total from Level 1 to 40 rises to roughly <strong>327,000 stardust</strong>. This makes purifying before powering up sometimes the smarter economic choice — especially for bulk power-ups on budget Pokémon. Verify your specific scenario with the calculator above before deciding.</p><h3>Lucky Pokémon: The Best Discount in the Game</h3><p>Lucky Pokémon carry a permanent 50% stardust discount on every power-up. A standard L1–L40 push costs only <strong>136,250 stardust</strong> for a Lucky — the single biggest efficiency multiplier available. Lucky trades require Best Friend status or are obtained via trading Pokémon caught before July 2016. If you\'re planning a major resource commitment on an attacker like <strong>Rayquaza</strong> or <strong>Lucario</strong>, trying to get it Lucky first can save over 100,000 stardust. Pair your decision with our <a href="https://pokemoncalculator.online/en/type-chart/">Type Chart</a> if you\'re planning to evolve before powering up — always evolve first to avoid wasting resources on a Pokémon that might not reach its evolved CP cap.</p><h3>XL Candy and the Level 40–50 Wall</h3><p>Levels 41–50 were introduced in November 2020 and require a separate resource: <strong>XL Candy</strong>. You need 296 XL Candy total to go from Level 40 to 50 — that\'s 296 power-up actions each costing 1 XL Candy. The stardust cost for this range is also steep: 296,000 stardust. XL Candy is obtained by catching Pokémon (rare chance), transferring, walking 20km with a Buddy, or converting 100 regular candy to 1 XL. Only invest in Level 50 for Pokémon that are already 15/15/15 IVs or near-perfect PvP spreads — check with our <a href="https://pokemoncalculator.online/en/type-chart/">Type Chart</a> first.</p><h3>Trade Costs and Friendship Levels</h3><p>Trading costs stardust based on trade type and friendship level. Standard trades between Best Friends cost just 100 stardust. The same trade at Good Friend level costs 100 stardust for standard, but Legendary / Shiny trades jump to <strong>1,000,000 stardust</strong> at Good Friend and drop to just <strong>40,000</strong> at Best Friend. Building friendship before trading rare Pokémon is one of the highest-value stardust savings strategies in the game.</p>',
        'info_table_title'       => 'Stardust &amp; Candy Cost Per Level (Standard Pokémon)',
        'info_table_html'        => '<table class="pkm-calc-table"><thead><tr><th>Level</th><th>Stardust / Step</th><th>Candy / Step</th><th>XL Candy / Step</th><th>Cumulative Stardust (from Lv 1)</th></tr></thead><tbody><tr><td>1 → 1.5</td><td>200</td><td>1</td><td>—</td><td>200</td></tr><tr><td>5 → 5.5</td><td>400</td><td>1</td><td>—</td><td>2,200</td></tr><tr><td>10 → 10.5</td><td>800</td><td>1</td><td>—</td><td>7,000</td></tr><tr><td>15 → 15.5</td><td>1,600</td><td>2</td><td>—</td><td>22,000</td></tr><tr><td>20 → 20.5</td><td>2,500</td><td>2</td><td>—</td><td>48,500</td></tr><tr><td>25 → 25.5</td><td>4,000</td><td>3</td><td>—</td><td>96,000</td></tr><tr><td>30 → 30.5</td><td>6,000</td><td>3</td><td>—</td><td>159,500</td></tr><tr><td>35 → 35.5</td><td>8,000</td><td>4</td><td>—</td><td>222,500</td></tr><tr><td>40 → 40.5</td><td>10,000</td><td>6</td><td>—</td><td>272,500</td></tr><tr><td>41 → 41.5</td><td>12,000</td><td>—</td><td>8</td><td>284,500</td></tr><tr><td>45 → 45.5</td><td>15,000</td><td>—</td><td>10</td><td>380,500</td></tr><tr><td>50 (max)</td><td>—</td><td>—</td><td>—</td><td>568,500 total</td></tr></tbody></table>',
        'faq_title'              => 'Stardust Calculator — Frequently Asked Questions',
        'faq_q1' => 'How much stardust does it cost to power up a Pokémon to level 40?',
        'faq_a1' => 'Powering a standard Pokémon from Level 1 to Level 40 costs <strong>272,500 stardust</strong> and 273 candy. Lucky Pokémon halve this to 136,250 stardust. Shadow Pokémon cost roughly 327,000 stardust due to the 20% surcharge on every step. Use the calculator above to get the exact figure for any starting level.',
        'faq_q2' => 'How much stardust does it cost to max out a Pokémon to level 50?',
        'faq_a2' => 'A full Level 1 to 50 power-up costs <strong>568,500 stardust</strong> and 296 XL Candy (plus 273 regular candy). The Level 40–50 range alone costs 296,000 stardust and 296 XL Candy. Level 50 requires the Pokémon to have the Best Buddy ribbon and enough XL Candy for each step. Only invest in Pokémon with near-perfect IVs for raids or Master League.',
        'faq_q3' => 'How much stardust to trade a Legendary Pokémon?',
        'faq_a3' => 'Trading a Legendary, Mythical, or Shiny Pokémon costs <strong>1,000,000 stardust</strong> at Good Friend level. This drops dramatically as friendship increases: Great Friend (70,000), Ultra Friend (8,000), and Best Friend (40,000 for Legendaries that are already in your Pokédex, or 1,000,000 for a new Pokédex entry at Good Friend). Always reach Best Friend status before trading rare Pokémon to save hundreds of thousands of stardust.',
        'faq_q4' => 'Do Lucky Pokémon cost less stardust to power up?',
        'faq_a4' => 'Yes — Lucky Pokémon have a permanent <strong>50% stardust discount</strong> on every power-up step. This discount applies from Level 1 all the way to Level 50 and stacks with no other modifier except the Best Buddy bonus (–10%), potentially reducing costs by 55% combined. Lucky status is assigned randomly when trading and cannot be removed. It is the single most powerful cost-reduction mechanic in the game.',
        'faq_q5' => 'Does powering up a Shadow Pokémon cost more stardust?',
        'faq_a5' => '<strong>Shadow Pokémon cost 20% more stardust</strong> per power-up step compared to standard Pokémon. For a Level 1–40 push, this adds approximately 54,500 extra stardust. Purifying a Shadow Pokémon removes the 20% surcharge and also boosts each IV by +2, but purified Pokémon lose the 20% attack bonus. For high-IV Shadows destined for raids, most veteran players keep them Shadow and absorb the extra stardust cost. The calculator\'s Shadow toggle shows you the exact premium before you decide.',
        'faq_q6' => 'What is the Best Buddy stardust discount?',
        'faq_a6' => 'Reaching <strong>Best Buddy</strong> status with a Pokémon grants a permanent 10% stardust discount on all power-ups for that specific Pokémon. Buddy status is earned by walking, feeding, playing, and battling with your Buddy — reaching Best Buddy requires 300 Buddy Hearts total. The Best Buddy discount stacks with Lucky (–50%), making the combined discount 55% off standard cost. It also enables powering a Pokémon beyond Level 40 to Level 50 when combined with sufficient XL Candy.',
        'faq_q7' => 'How much stardust does it cost to purify a Shadow Pokémon?',
        'faq_a7' => 'Purification costs vary by Pokémon species tier. Common Pokémon like <strong>Rattata or Pidgey</strong> cost 1,000 stardust and 1 candy to purify. Uncommon species like Nidoran cost 3,000 stardust and 3 candy. Rare Pokémon (Larvitar, Beldum, Snorlax) cost 5,000 stardust and 5 candy. Purification removes Shadow status, boosts each IV by +2, and removes the 20% power-up surcharge. Use the Purify tab above to find the cost for any specific Pokémon.',
        'faq_q8' => 'How do I earn stardust fast in Pokémon GO?',
        'faq_a8' => 'The fastest stardust methods are: catching Pokémon with a Star Piece active (×1.5 multiplier), completing Research Breakthroughs (4,000–8,000 stardust), and opening Gifts from Best Friends (200 stardust each). Weather-boosted catches grant 125 stardust instead of 100. Hatching 10km Eggs awards 1,600–3,200 stardust. During Community Day events, stardust bonuses often stack with Star Pieces for extremely efficient farming windows.',
        'related_title'    => 'Related Pokémon GO Calculators',
        'no_related_tools' => 'No related tools yet. More calculators coming soon!',
        'blog_guides_title' => 'Pokémon GO Guides &amp; Tips',
        'blog_read_more'    => 'Read guide',
    ],
    'es' => [
        'title'                  => 'Calculadora de Polvo Estelar',
        'description'            => 'Calcula el costo exacto de polvo estelar y caramelos para mejorar, maximizar, intercambiar o purificar cualquier Pokémon.',
        'tab_powerup'            => 'Mejorar',
        'tab_maxout'             => 'Maximizar',
        'tab_trade'              => 'Intercambio',
        'tab_purify'             => 'Purificar',
        'select_pokemon'         => 'Buscar Pokémon...',
        'current_level'          => 'Nivel Actual',
        'target_level'           => 'Nivel Objetivo',
        'toggle_lucky'           => 'Pokémon Suertudo (–50% polvo)',
        'toggle_shadow'          => 'Pokémon Oscuro (+20% polvo)',
        'toggle_buddy'           => 'Mejor Compañero (–10% polvo)',
        'toggle_xl_research'     => 'Caramelos XL de investigación',
        'calculate_btn'          => 'Calcular',
        'reset_btn'              => 'Reiniciar',
        'result_stardust'        => 'Polvo Estelar Total',
        'result_candy'           => 'Caramelos Totales',
        'result_xl_candy'        => 'Caramelos XL Totales',
        'result_steps'           => 'Pasos de Mejora',
        'table_level'            => 'Nivel',
        'table_stardust'         => 'Polvo Estelar',
        'table_candy'            => 'Caramelos',
        'table_xl_candy'         => 'Caramelos XL',
        'table_cumulative'       => 'Acumulado ★',
        'max_level_label'        => 'Nivel Máximo',
        'max_level_40'           => 'Nivel 40 (Estándar)',
        'max_level_50'           => 'Nivel 50 (Mejor Compañero / XL)',
        'trade_tier_label'       => 'Tipo de Intercambio',
        'trade_tier_standard'    => 'Estándar',
        'trade_tier_special'     => 'Especial (nueva entrada Pokédex)',
        'trade_tier_ultra'       => 'Ultra Criatura',
        'trade_tier_legendary'   => 'Legendario / Mítico / Shiny',
        'friendship_label'       => 'Nivel de Amistad',
        'friendship_good'        => 'Buen Amigo',
        'friendship_great'       => 'Gran Amigo',
        'friendship_ultra'       => 'Superamigo',
        'friendship_best'        => 'Mejor Amigo',
        'result_trade_cost'      => 'Costo en Polvo Estelar',
        'purify_result_stardust' => 'Polvo Estelar para Purificar',
        'purify_result_candy'    => 'Caramelos para Purificar',
        'purify_note'            => 'Purificar elimina el estado Oscuro y aumenta los IVs en +2 por estadística.',
        'copy_btn'               => 'Copiar Resultados',
        'copied'                 => '¡Copiado!',
        'error_data_load'        => 'No se pudieron cargar los datos. Por favor, actualiza la página.',
        'error_select_pokemon'   => 'Por favor, selecciona un Pokémon primero.',
        'error_invalid_level'    => 'El nivel debe estar entre 1 y 50.',
        'error_invalid_iv'       => 'Los valores de IV deben estar entre 0 y 15.',
        'error_no_results'       => 'No se encontraron Pokémon con esa búsqueda.',
        'error_calculation'      => 'Error de cálculo. Por favor, verifica tus datos.',
        'error_same_level'       => 'El nivel objetivo debe ser superior al actual.',
        'noscript_msg'           => 'Por favor, activa JavaScript para usar esta calculadora.',
        'meta_title' => 'Calculadora de Polvo Estelar Pokémon GO | pokemoncalculator.online',
        'meta_desc' => 'Calcula el polvo estelar y caramelos exactos para mejorar cualquier Pokémon en GO. Compatible con Suertudo, Oscuro, Mejor Compañero, intercambios y purificación.',
        'intro_title' => 'Calculadora de Polvo Estelar para Pokémon GO',
        'intro_content' => '<p>La <strong>calculadora de polvo estelar de Pokémon GO</strong> te indica exactamente cuánto polvo estelar y caramelos necesitas para mejorar cualquier Pokémon desde su nivel actual hasta el nivel que quieras alcanzar. Selecciona tu Pokémon, ajusta los niveles y obtén el resultado al instante, sin hojas de cálculo ni estimaciones.</p><p>El polvo estelar es el recurso más escaso del juego — se comparte entre todos tus Pokémon y cada mejora cuenta. Si estás preparando un atacante para las Incursiones como <strong>Garchomp</strong> o planificando tu equipo para la Liga de Combate GO con un <strong>Registeel</strong> a nivel 50, esta herramienta te da los números exactos para organizar tu farmeo. Combínala con nuestra <a href="https://pokemoncalculator.online/es/calculadora-cp-pokemon/">calculadora de CP</a> para verificar que los IVs de tu Pokémon justifican la inversión antes de gastar ni un solo polvo.</p><p>La calculadora incluye todos los modificadores que afectan al coste: los <strong>Pokémon Suertudos</strong> reducen el polvo un 50%, los <strong>Pokémon Oscuros</strong> lo aumentan un 20%, y el bonus de <strong>Mejor Compañero</strong> resta otro 10%. También puedes calcular costes de intercambio según el nivel de amistad o usar la pestaña de purificación para saber cuánto cuesta limpiar un Pokémon Oscuro. Usa la calculadora de arriba para planificar cada mejora antes de comprometer tu polvo estelar.</p>',
        'howto_title' => 'Cómo usar la calculadora de polvo estelar',
        'howto_step1' => 'Selecciona la pestaña que corresponda: <strong>Mejorar</strong>, <strong>Maximizar</strong>, <strong>Intercambio</strong> o <strong>Purificar</strong>. Escribe el nombre del Pokémon en el buscador y selecciónalo de la lista desplegable para confirmar tu selección.',
        'howto_step2' => 'Ajusta el <strong>Nivel Actual</strong> con el deslizador. Puedes consultar el nivel exacto de tu Pokémon en el juego abriendo su ficha — el arco de poder encima del Pokémon muestra su posición aproximada entre el nivel mínimo y máximo posibles.',
        'howto_step3' => 'Define el <strong>Nivel Objetivo</strong> al que quieres llegar. Activa los modificadores pertinentes: <strong>Suertudo</strong>, <strong>Oscuro</strong> o <strong>Mejor Compañero</strong>. Si usas la pestaña Maximizar, elige entre el nivel máximo 40 o el nivel 50 con Caramelos XL.',
        'howto_step4' => 'Pulsa <strong>Calcular</strong> para obtener el total de polvo estelar, caramelos y Caramelos XL necesarios. La tabla de resultados desglosa el coste paso a paso. Copia los resultados con el botón Copiar para tenerlos a mano durante el juego.',
        'info_title' => 'Cómo se calcula el polvo estelar en Pokémon GO',
        'info_content' => '<p>El polvo estelar sube a los Pokémon de nivel en incrementos de 0,5 por mejora. Cada nivel tiene un coste fijo de polvo y caramelos que es igual para todas las especies — no importa si es un Magikarp o un Mewtwo, los costes por nivel son idénticos. La diferencia real está en los modificadores aplicados a ese coste base.</p><h3>Costes por rango de nivel</h3><p>Los niveles del 1 al 10 cuestan entre <strong>200 y 1.000 polvo</strong> por mejora. Del 11 al 20, entre <strong>1.300 y 2.500</strong>. Del 21 al 30, entre <strong>3.000 y 6.000</strong>. Del 31 al 40, entre <strong>7.000 y 10.000</strong>. Subir un Pokémon estándar del nivel 1 al 40 cuesta exactamente <strong>272.500 de polvo estelar</strong> y 273 caramelos. Pasar del nivel 40 al 50 añade otros <strong>296.000 de polvo</strong> y 296 Caramelos XL — un total de 568.500 de polvo para llegar al máximo absoluto.</p><h3>Los Pokémon Oscuros: ¿merece la pena el sobrecoste?</h3><p>Los Pokémon Oscuros tienen un <strong>20% más de coste en cada mejora</strong>. Subir uno del nivel 1 al 40 supone un gasto aproximado de 327.000 de polvo. Muchos jugadores de LatAm optan por purificar a sus Oscuros con IVs mediocres para ahorrar polvo, pero conservan los de IVs altos. El bono de ataque del 20% que ofrecen los Oscuros los convierte en los mejores atacantes del juego en incursiones — especialmente Pokémon como <strong>Salamence Oscuro</strong> o <strong>Chandelure Oscuro</strong>. Consulta también nuestra <a href="https://pokemoncalculator.online/es/tabla-de-tipos/">tabla de tipos</a> para estimar el PC máximo que alcanzará tu Pokémon Oscuro al subirlo.</p><h3>Pokémon Suertudos: el mayor ahorro del juego</h3><p>Los Pokémon Suertudos aplican un descuento permanente del <strong>50% en polvo estelar</strong> en cada mejora. Subir un Suertudo del nivel 1 al 40 solo cuesta 136.250 de polvo. El estado Suertudo se obtiene al intercambiar ciertos Pokémon con un Mejor Amigo o al canjear Pokémon capturados antes de julio de 2016. Si tienes pensado invertir mucho polvo en un atacante de incursiones como <strong>Rayquaza</strong>, intentar obtenerlo como Suertudo primero puede ahorrarte más de 100.000 de polvo. Comprueba la viabilidad del intercambio con nuestra <a href="https://pokemoncalculator.online/es/calculadora-cp-pokemon/">calculadora de CP</a> para asegurarte de que tiene los IV necesarios.</p><h3>Costes de intercambio según la amistad</h3><p>Los intercambios de Legendarios, Míticos o Shiny tienen coste de polvo variable según el nivel de amistad. Con un Buen Amigo, un Legendario que ya tienes en la Pokédex cuesta <strong>20.000 de polvo</strong>; con Mejor Amigo, baja a <strong>800</strong>. Un Legendario nuevo (no en tu Pokédex) cuesta <strong>1.000.000</strong> con Buen Amigo y <strong>40.000</strong> con Mejor Amigo. Construir la amistad antes de intercambiar Pokémon raros es la estrategia de ahorro de polvo más rentable de todo el juego.</p>',
        'info_table_title' => 'Coste de polvo estelar y caramelos por nivel (Pokémon estándar)',
        'info_table_html' => '<table class="pkm-calc-table"><thead><tr><th>Nivel</th><th>Polvo / Mejora</th><th>Caramelos / Mejora</th><th>Caramelos XL / Mejora</th><th>Polvo Acumulado (desde Nv 1)</th></tr></thead><tbody><tr><td>1 → 1.5</td><td>200</td><td>1</td><td>—</td><td>200</td></tr><tr><td>5 → 5.5</td><td>400</td><td>1</td><td>—</td><td>2.200</td></tr><tr><td>10 → 10.5</td><td>800</td><td>1</td><td>—</td><td>7.000</td></tr><tr><td>15 → 15.5</td><td>1.600</td><td>2</td><td>—</td><td>22.000</td></tr><tr><td>20 → 20.5</td><td>2.500</td><td>2</td><td>—</td><td>48.500</td></tr><tr><td>25 → 25.5</td><td>4.000</td><td>3</td><td>—</td><td>96.000</td></tr><tr><td>30 → 30.5</td><td>6.000</td><td>3</td><td>—</td><td>159.500</td></tr><tr><td>35 → 35.5</td><td>8.000</td><td>4</td><td>—</td><td>222.500</td></tr><tr><td>40 → 40.5</td><td>10.000</td><td>6</td><td>—</td><td>272.500</td></tr><tr><td>41 → 41.5</td><td>12.000</td><td>—</td><td>8</td><td>284.500</td></tr><tr><td>45 → 45.5</td><td>15.000</td><td>—</td><td>10</td><td>380.500</td></tr><tr><td>50 (máx.)</td><td>—</td><td>—</td><td>—</td><td>568.500 total</td></tr></tbody></table>',
        'faq_title' => 'Preguntas frecuentes sobre la calculadora de polvo estelar',
        'faq_q1' => '¿Cuánto polvo estelar cuesta subir un Pokémon al nivel 40?',
        'faq_a1' => 'Subir un Pokémon estándar del nivel 1 al 40 cuesta <strong>272.500 de polvo estelar</strong> y 273 caramelos. Para Pokémon Suertudos el coste se reduce a 136.250. Los Oscuros llegan a unas 327.000 unidades por el recargo del 20%. Usa la calculadora para obtener el coste exacto desde cualquier nivel de partida.',
        'faq_q2' => '¿Cuánto polvo estelar se necesita para llegar al nivel 50?',
        'faq_a2' => 'Subir del nivel 1 al 50 cuesta en total <strong>568.500 de polvo estelar</strong>, 273 caramelos normales y 296 Caramelos XL. Solo el tramo del 40 al 50 consume 296.000 de polvo y 296 Caramelos XL. Para desbloquear el nivel 50 necesitas la medalla de Mejor Compañero y los Caramelos XL suficientes. Solo merece la pena para Pokémon con IVs casi perfectos.',
        'faq_q3' => '¿Cuánto polvo estelar cuesta intercambiar un Pokémon Legendario?',
        'faq_a3' => 'Intercambiar un Pokémon Legendario que ya tienes en la Pokédex cuesta <strong>20.000 de polvo</strong> con un Buen Amigo y solo <strong>800</strong> con un Mejor Amigo. Si el Legendario es nuevo en tu Pokédex, el coste sube a 1.000.000 con Buen Amigo y baja a 40.000 con Mejor Amigo. Siempre alcanza el nivel Mejor Amigo antes de hacer intercambios de Pokémon raros o shiny para ahorrar cientos de miles de polvo.',
        'faq_q4' => '¿Los Pokémon Suertudos cuestan menos polvo para mejorar?',
        'faq_a4' => 'Sí — los Pokémon Suertudos tienen un <strong>descuento permanente del 50%</strong> en cada mejora de nivel. Este descuento se aplica desde el nivel 1 hasta el 50 y se puede combinar con el bono de Mejor Compañero (–10%) para alcanzar un ahorro total del 55%. El estado Suertudo se asigna aleatoriamente al intercambiar y no se puede eliminar. Es la mecánica de reducción de costes más poderosa del juego.',
        'faq_q5' => '¿Los Pokémon Oscuros gastan más polvo estelar al mejorar?',
        'faq_a5' => 'Sí, los <strong>Pokémon Oscuros tienen un recargo del 20%</strong> en polvo por cada mejora. Para el tramo del 1 al 40 esto supone unas 54.500 unidades de polvo adicionales respecto al coste estándar. Si piensas invertir mucho polvo en un Oscuro con buenos IVs — como un <strong>Tyranitar Oscuro</strong> para incursiones — la calculadora con el modificador Oscuro activado te mostrará el coste real antes de decidir si purificar o mantenerlo.',
        'faq_q6' => '¿Qué descuento de polvo estelar da el Mejor Compañero?',
        'faq_a6' => 'Alcanzar el rango de <strong>Mejor Compañero</strong> con un Pokémon te otorga un descuento permanente del 10% en polvo para ese Pokémon específico. Este descuento se acumula con el de los Suertudos (–50%) para un ahorro combinado del 55%. Para llegar a Mejor Compañero necesitas 300 Corazones de Compañero en total, lo que requiere varios días de interacción diaria. Además, el rango Mejor Compañero es obligatorio para poder subir a los niveles 41–50.',
        'faq_q7' => '¿Cuánto polvo estelar cuesta purificar un Pokémon Oscuro?',
        'faq_a7' => 'El coste de purificación varía según la especie. Los Pokémon comunes como Rattata o Pidgey cuestan <strong>1.000 de polvo</strong> y 1 caramelo. Las especies poco comunes como Nidoran cuestan 3.000 y 3 caramelos. Las especies raras como Larvitar, Beldum o Snorlax cuestan 5.000 de polvo y 5 caramelos. Purificar elimina el estado Oscuro, aumenta cada IV en +2 y elimina el recargo del 20% en polvo. Usa la pestaña Purificar para consultar el coste de cualquier especie.',
        'faq_q8' => '¿Cómo conseguir polvo estelar rápido en Pokémon GO?',
        'faq_a8' => 'Los métodos más eficientes son: capturar Pokémon con una Pieza Estelar activa (×1,5), completar Investigaciones de Campo que premian polvo, y abrir Regalos de Mejores Amigos (200 polvo cada uno). Las capturas con potenciación meteorológica dan 125 de polvo en lugar de 100. Eclosionar Huevos de 10 km otorga entre 1.600 y 3.200 de polvo. Durante los Días de la Comunidad, los bonos de polvo y la Pieza Estelar combinados crean las mejores ventanas de farmeo del año.',
        'related_title'    => 'Calculadoras Pokémon GO Relacionadas',
        'no_related_tools' => 'Aún no hay herramientas relacionadas. ¡Más calculadoras próximamente!',
        'blog_guides_title' => 'Guías y Consejos de Pokémon GO',
        'blog_read_more'    => 'Leer guía',
    ],
    'pt-br' => [
        'title'                  => 'Calculadora de Pó Estelar',
        'description'            => 'Calcule o custo exato de pó estelar e balas para melhorar, maximizar, trocar ou purificar qualquer Pokémon.',
        'tab_powerup'            => 'Melhorar',
        'tab_maxout'             => 'Maximizar',
        'tab_trade'              => 'Troca',
        'tab_purify'             => 'Purificar',
        'select_pokemon'         => 'Buscar Pokémon...',
        'current_level'          => 'Nível Atual',
        'target_level'           => 'Nível Alvo',
        'toggle_lucky'           => 'Pokémon da Sorte (–50% pó)',
        'toggle_shadow'          => 'Pokémon Sombrio (+20% pó)',
        'toggle_buddy'           => 'Melhor Parceiro (–10% pó)',
        'toggle_xl_research'     => 'Balas XL de Pesquisa',
        'calculate_btn'          => 'Calcular',
        'reset_btn'              => 'Resetar',
        'result_stardust'        => 'Pó Estelar Total',
        'result_candy'           => 'Balas Totais',
        'result_xl_candy'        => 'Balas XL Totais',
        'result_steps'           => 'Etapas de Melhoria',
        'table_level'            => 'Nível',
        'table_stardust'         => 'Pó Estelar',
        'table_candy'            => 'Balas',
        'table_xl_candy'         => 'Balas XL',
        'table_cumulative'       => 'Acumulado ★',
        'max_level_label'        => 'Nível Máximo',
        'max_level_40'           => 'Nível 40 (Padrão)',
        'max_level_50'           => 'Nível 50 (Melhor Parceiro / XL)',
        'trade_tier_label'       => 'Tipo de Troca',
        'trade_tier_standard'    => 'Padrão',
        'trade_tier_special'     => 'Especial (nova entrada na Pokédex)',
        'trade_tier_ultra'       => 'Ultra Fera',
        'trade_tier_legendary'   => 'Lendário / Mítico / Shiny',
        'friendship_label'       => 'Nível de Amizade',
        'friendship_good'        => 'Bom Amigo',
        'friendship_great'       => 'Grande Amigo',
        'friendship_ultra'       => 'Super Amigo',
        'friendship_best'        => 'Melhor Amigo',
        'result_trade_cost'      => 'Custo em Pó Estelar',
        'purify_result_stardust' => 'Pó Estelar para Purificar',
        'purify_result_candy'    => 'Balas para Purificar',
        'purify_note'            => 'Purificar remove o status Sombrio e aumenta os IVs em +2 em cada atributo.',
        'copy_btn'               => 'Copiar Resultados',
        'copied'                 => 'Copiado!',
        'error_data_load'        => 'Não foi possível carregar os dados. Por favor, atualize a página.',
        'error_select_pokemon'   => 'Por favor, selecione um Pokémon primeiro.',
        'error_invalid_level'    => 'O nível deve estar entre 1 e 50.',
        'error_invalid_iv'       => 'Os valores de IV devem estar entre 0 e 15.',
        'error_no_results'       => 'Nenhum Pokémon encontrado.',
        'error_calculation'      => 'Erro de cálculo. Por favor, verifique seus dados.',
        'error_same_level'       => 'O nível alvo deve ser maior que o atual.',
        'noscript_msg'           => 'Por favor, ative o JavaScript para usar esta calculadora.',
        'meta_title' => 'Calculadora de Pó Estelar Pokémon GO | pokemoncalculator.online',
        'meta_desc' => 'Calcule exatamente quanto pó estelar e balas você precisa para fortalecer qualquer Pokémon no GO. Suporte a Sortudo, Sombrio, Melhor Parceiro, trocas e purificação.',
        'intro_title' => 'Calculadora de Pó Estelar Pokémon GO: Saiba Quanto Vai Gastar',
        'intro_content' => '<p>A <strong>calculadora de pó estelar do Pokémon GO</strong> mostra exatamente quanto pó estelar e quantas balas você precisa para fortalecer qualquer Pokémon do nível atual até o nível desejado — sem chute, sem planilha. Escolha o Pokémon, defina os níveis e veja o resultado na hora.</p><p>No Brasil, a comunidade de Pokémon GO é uma das mais ativas do mundo — grupos no WhatsApp e no Facebook estão sempre compartilhando estratégias de raids e trocas. Antes de gastar seu pó num <strong>Metagross</strong> para raid ou num <strong>Medicham</strong> para a Liga Hiperball, use a calculadora acima e saiba o custo exato. Combine com a nossa <a href="https://pokemoncalculator.online/pt-br/calculadora-pc-pokemon/">calculadora de PC</a> para confirmar se os atributos do seu Pokémon justificam o investimento.</p><p>A ferramenta já leva em conta todos os bônus que alteram o custo: <strong>Pokémon da Sorte</strong> custam 50% menos pó, <strong>Pokémon Sombrios</strong> custam 20% a mais, e o bônus de <strong>Melhor Parceiro</strong> reduz mais 10%. Na aba Troca você calcula o custo conforme o nível de amizade, e na aba Purificar descobre quanto custa limpar um Sombrio. Não gaste nem uma unidade de pó sem antes conferir o valor exato aqui. Também vale cruzar com nossa <a href="https://pokemoncalculator.online/pt-br/tabela-de-tipos/">tabela de tipos</a> para planejar a ordem certa de fortalecer e evoluir.</p>',
        'howto_title' => 'Como usar a calculadora de pó estelar',
        'howto_step1' => 'Escolha a aba correta: <strong>Melhorar</strong>, <strong>Maximizar</strong>, <strong>Troca</strong> ou <strong>Purificar</strong>. Digite o nome do Pokémon no campo de busca e selecione-o na lista que aparecer — o sprite e o nome confirmam que você escolheu o Pokémon certo.',
        'howto_step2' => 'Ajuste o <strong>Nível Atual</strong> pelo controle deslizante. Para saber o nível exato do seu Pokémon no jogo, abra o perfil dele — o arco de poder acima do Pokémon indica a posição entre o nível mínimo e máximo para o seu nível de treinador.',
        'howto_step3' => 'Defina o <strong>Nível Alvo</strong>. Ative os modificadores que se aplicam: <strong>Pokémon da Sorte</strong>, <strong>Sombrio</strong> ou <strong>Melhor Parceiro</strong>. Na aba Maximizar, escolha entre o nível 40 (padrão) ou nível 50 (requer Balas XL e o badge de Melhor Parceiro).',
        'howto_step4' => 'Clique em <strong>Calcular</strong> para ver o total de pó estelar, balas e Balas XL necessários. A tabela de resultados detalha o custo passo a passo por nível. Use o botão Copiar para guardar o resultado e compartilhar no seu grupo de WhatsApp ou Discord.',
        'info_title' => 'Como funciona o custo de pó estelar no Pokémon GO',
        'info_content' => '<p>O pó estelar sobe o nível dos Pokémon em incrementos de 0,5 por fortalecimento. Cada faixa de nível tem um custo fixo de pó e balas que vale para todas as espécies — o custo por nível de um Magikarp é idêntico ao de um Dragonite. O que varia é o modificador aplicado sobre esse custo base, dependendo do tipo do Pokémon e dos bônus ativos.</p><h3>Custos por faixa de nível</h3><p>Do nível 1 ao 10, cada fortalecimento custa entre <strong>200 e 1.000 de pó</strong>. Do 11 ao 20, entre <strong>1.300 e 2.500</strong>. Do 21 ao 30, entre <strong>3.000 e 6.000</strong>. Do 31 ao 40, entre <strong>7.000 e 10.000</strong>. Subir do nível 1 ao 40 custa exatamente <strong>272.500 de pó estelar</strong> e 273 balas para um Pokémon padrão. A faixa do 40 ao 50 adiciona mais <strong>296.000 de pó</strong> e 296 Balas XL — totalizando 568.500 de pó para chegar ao máximo absoluto.</p><h3>Pokémon Sombrios: vale a pena gastar mais?</h3><p>Os Pokémon Sombrios custam <strong>20% a mais de pó estelar</strong> em cada fortalecimento. Do nível 1 ao 40, isso representa aproximadamente 54.500 a mais. A comunidade brasileira costuma manter Sombrios com IVs altos e absorver o custo extra — afinal, o bônus de 20% no ataque torna espécies como <strong>Salamence Sombrio</strong> e <strong>Machamp Sombrio</strong> os melhores atacantes das raids. Use a calculadora acima com o modificador Sombrio ativado para saber exatamente quanto vai gastar antes de decidir se purifica ou não. Compare também o PC pós-purificação com nossa <a href="https://pokemoncalculator.online/pt-br/tabela-de-tipos/">tabela de tipos</a>.</p><h3>Pokémon da Sorte: o maior desconto do jogo</h3><p>Pokémon da Sorte têm um descuento permanente de <strong>50% em pó estelar</strong> em todos os fortalecimentos. Subir um Pokémon da Sorte do nível 1 ao 40 custa apenas 136.250 de pó. O status de Sorte é atribuído aleatoriamente nas trocas — trocas com Melhores Amigos têm maior chance. Para um atacante de raid caro como <strong>Rayquaza</strong> ou <strong>Lucario</strong>, tentar conseguir o status de Sorte pode economizar mais de 100.000 de pó. Verifique os IVs com nossa <a href="https://pokemoncalculator.online/pt-br/calculadora-pc-pokemon/">calculadora de PC</a> antes de fechar a troca.</p><h3>Custos de troca por nível de amizade</h3><p>Trocar Pokémon Lendários ou Brilhantes tem custo variável. Um Lendário que você já tem na Pokédex custa <strong>20.000 de pó</strong> com Bom Amigo e apenas <strong>800</strong> com Melhor Amigo. Um Lendário novo (entrada nova na Pokédex) custa <strong>1.000.000</strong> com Bom Amigo e 40.000 com Melhor Amigo. Sempre construa a amizade antes de fazer trocas de Pokémon raros — é a maior economia de pó que o jogo oferece.</p>',
        'info_table_title' => 'Custo de pó estelar e balas por nível (Pokémon padrão)',
        'info_table_html' => '<table class="pkm-calc-table"><thead><tr><th>Nível</th><th>Pó / Fortalec.</th><th>Balas / Fortalec.</th><th>Balas XL / Fortalec.</th><th>Pó Acumulado (do Nv 1)</th></tr></thead><tbody><tr><td>1 → 1.5</td><td>200</td><td>1</td><td>—</td><td>200</td></tr><tr><td>5 → 5.5</td><td>400</td><td>1</td><td>—</td><td>2.200</td></tr><tr><td>10 → 10.5</td><td>800</td><td>1</td><td>—</td><td>7.000</td></tr><tr><td>15 → 15.5</td><td>1.600</td><td>2</td><td>—</td><td>22.000</td></tr><tr><td>20 → 20.5</td><td>2.500</td><td>2</td><td>—</td><td>48.500</td></tr><tr><td>25 → 25.5</td><td>4.000</td><td>3</td><td>—</td><td>96.000</td></tr><tr><td>30 → 30.5</td><td>6.000</td><td>3</td><td>—</td><td>159.500</td></tr><tr><td>35 → 35.5</td><td>8.000</td><td>4</td><td>—</td><td>222.500</td></tr><tr><td>40 → 40.5</td><td>10.000</td><td>6</td><td>—</td><td>272.500</td></tr><tr><td>41 → 41.5</td><td>12.000</td><td>—</td><td>8</td><td>284.500</td></tr><tr><td>45 → 45.5</td><td>15.000</td><td>—</td><td>10</td><td>380.500</td></tr><tr><td>50 (máx.)</td><td>—</td><td>—</td><td>—</td><td>568.500 total</td></tr></tbody></table>',
        'faq_title' => 'Perguntas frequentes sobre a calculadora de pó estelar',
        'faq_q1' => 'Quanto pó estelar custa para fortalecer um Pokémon até o nível 40?',
        'faq_a1' => 'Fortalecer um Pokémon padrão do nível 1 ao 40 custa <strong>272.500 de pó estelar</strong> e 273 balas. Para Pokémon da Sorte o custo cai para 136.250. Pokémon Sombrios chegam a aproximadamente 327.000 de pó pelo acréscimo de 20%. Use a calculadora acima para obter o custo exato a partir de qualquer nível inicial.',
        'faq_a2' => 'Subir do nível 1 ao 50 custa no total <strong>568.500 de pó estelar</strong>, 273 balas comuns e 296 Balas XL. Somente a faixa do nível 40 ao 50 consome 296.000 de pó e 296 Balas XL. Para desbloquear o nível 50, o Pokémon precisa ter o badge de Melhor Parceiro e Balas XL suficientes. Só vale para Pokémon com IVs quase perfeitos.',
        'faq_q2' => 'Quanto pó estelar precisa para chegar ao nível 50?',
        'faq_q3' => 'Quanto custa trocar um Pokémon Lendário?',
        'faq_a3' => 'Trocar um Lendário que você já tem na Pokédex custa <strong>20.000 de pó</strong> com Bom Amigo e apenas <strong>800</strong> com Melhor Amigo. Se o Lendário é uma entrada nova na sua Pokédex, o custo sobe para 1.000.000 com Bom Amigo e cai para 40.000 com Melhor Amigo. Sempre construa a amizade máxima antes de trocar Pokémon raros ou Brilhantes para economizar centenas de milhares de pó.',
        'faq_q4' => 'Pokémon da Sorte gastam menos pó para fortalecer?',
        'faq_a4' => 'Sim — Pokémon da Sorte têm um <strong>desconto permanente de 50%</strong> em pó estelar em todos os fortalecimentos. O desconto vale do nível 1 ao 50 e pode ser combinado com o bônus de Melhor Parceiro (–10%) para um desconto total de 55%. O status de Sorte é atribuído aleatoriamente nas trocas e não pode ser removido. É o redutor de custo mais poderoso do jogo.',
        'faq_q5' => 'Pokémon Sombrio gasta mais pó para fortalecer?',
        'faq_a5' => 'Sim, <strong>Pokémon Sombrios custam 20% a mais de pó</strong> em cada fortalecimento. Do nível 1 ao 40, isso representa cerca de 54.500 de pó extra. A comunidade brasileira geralmente mantém Sombrios com IVs altos e absorve o custo extra para aproveitar o bônus de ataque. Use o modificador Sombrio na calculadora acima para ver o custo real e decidir se vale purificar ou manter o status.',
        'faq_q6' => 'Qual o desconto de pó estelar do Melhor Parceiro?',
        'faq_a6' => 'Chegar ao nível <strong>Melhor Parceiro</strong> com um Pokémon garante um desconto permanente de 10% em pó para aquele Pokémon específico. Para alcançar Melhor Parceiro são necessários 300 Corações de Parceiro no total, exigindo vários dias de interação diária. O desconto se acumula com o de Pokémon da Sorte (–50%) para um total de 55% de economia. Além disso, o nível Melhor Parceiro é obrigatório para desbloquear os fortalecimentos do nível 41 ao 50.',
        'faq_q7' => 'Quanto custa purificar um Pokémon Sombrio?',
        'faq_a7' => 'O custo de purificação varia por espécie. Pokémon comuns como Rattata ou Pidgey custam <strong>1.000 de pó</strong> e 1 bala. Espécies incomuns como Nidoran custam 3.000 e 3 balas. Espécies raras como Larvitar, Beldum ou Snorlax custam 5.000 de pó e 5 balas. Purificar remove o status Sombrio, aumenta cada IV em +2 e elimina o acréscimo de 20% no pó. Use a aba Purificar acima para consultar o custo de qualquer espécie.',
        'faq_q8' => 'Como conseguir pó estelar rápido no Pokémon GO?',
        'faq_a8' => 'Os métodos mais eficientes são: capturar Pokémon com Peça Estelar ativa (×1,5), completar Pesquisas de Campo que recompensam pó, e abrir Presentes de Melhores Amigos (200 de pó cada). Capturas com bônus meteorológico dão 125 de pó ao invés de 100. Chocar Ovos de 10 km concede entre 1.600 e 3.200 de pó. Durante os Dias Comunitários no Brasil — sempre muito populares — os bônus de pó combinados com Peça Estelar criam as melhores janelas de farm do ano.',
        'related_title'    => 'Calculadoras Pokémon GO Relacionadas',
        'no_related_tools' => 'Ainda não há ferramentas relacionadas. Mais calculadoras em breve!',
        'blog_guides_title' => 'Guias e Dicas de Pokémon GO',
        'blog_read_more'    => 'Ler guia',
    ],
    'fr' => [
        'title'                  => 'Calculateur de Poussière Étoile',
        'description'            => 'Calculez le coût exact en poussière étoile et bonbons pour améliorer, maximiser, échanger ou purifier n\'importe quel Pokémon.',
        'tab_powerup'            => 'Améliorer',
        'tab_maxout'             => 'Maximiser',
        'tab_trade'              => 'Échange',
        'tab_purify'             => 'Purifier',
        'select_pokemon'         => 'Rechercher un Pokémon...',
        'current_level'          => 'Niveau Actuel',
        'target_level'           => 'Niveau Cible',
        'toggle_lucky'           => 'Pokémon Chançard (–50% poussière)',
        'toggle_shadow'          => 'Pokémon Obscur (+20% poussière)',
        'toggle_buddy'           => 'Meilleur Compagnon (–10% poussière)',
        'toggle_xl_research'     => 'Bonbons XL de Recherche',
        'calculate_btn'          => 'Calculer',
        'reset_btn'              => 'Réinitialiser',
        'result_stardust'        => 'Poussière Étoile Totale',
        'result_candy'           => 'Bonbons Totaux',
        'result_xl_candy'        => 'Bonbons XL Totaux',
        'result_steps'           => 'Étapes d\'Amélioration',
        'table_level'            => 'Niveau',
        'table_stardust'         => 'Poussière Étoile',
        'table_candy'            => 'Bonbons',
        'table_xl_candy'         => 'Bonbons XL',
        'table_cumulative'       => 'Cumulé ★',
        'max_level_label'        => 'Niveau Maximum',
        'max_level_40'           => 'Niveau 40 (Standard)',
        'max_level_50'           => 'Niveau 50 (Meilleur Compagnon / XL)',
        'trade_tier_label'       => 'Type d\'Échange',
        'trade_tier_standard'    => 'Standard',
        'trade_tier_special'     => 'Spécial (nouvelle entrée Pokédex)',
        'trade_tier_ultra'       => 'Ultra-Créature',
        'trade_tier_legendary'   => 'Légendaire / Mythique / Chromatique',
        'friendship_label'       => 'Niveau d\'Amitié',
        'friendship_good'        => 'Bon Ami',
        'friendship_great'       => 'Grand Ami',
        'friendship_ultra'       => 'Super Ami',
        'friendship_best'        => 'Meilleur Ami',
        'result_trade_cost'      => 'Coût en Poussière Étoile',
        'purify_result_stardust' => 'Poussière Étoile pour Purifier',
        'purify_result_candy'    => 'Bonbons pour Purifier',
        'purify_note'            => 'Purifier supprime le statut Obscur et augmente les IV de +2 dans chaque statistique.',
        'copy_btn'               => 'Copier les Résultats',
        'copied'                 => 'Copié !',
        'error_data_load'        => 'Impossible de charger les données. Veuillez actualiser la page.',
        'error_select_pokemon'   => 'Veuillez sélectionner un Pokémon d\'abord.',
        'error_invalid_level'    => 'Le niveau doit être compris entre 1 et 50.',
        'error_invalid_iv'       => 'Les valeurs d\'IV doivent être comprises entre 0 et 15.',
        'error_no_results'       => 'Aucun Pokémon trouvé.',
        'error_calculation'      => 'Erreur de calcul. Veuillez vérifier vos entrées.',
        'error_same_level'       => 'Le niveau cible doit être supérieur au niveau actuel.',
        'noscript_msg'           => 'Veuillez activer JavaScript pour utiliser cette calculatrice.',
        'meta_title' => 'Calculateur Poussière Étoile Pokémon GO | pokemoncalculator.online',
        'meta_desc' => 'Calculez le coût exact en poussière étoile pour améliorer n\'importe quel Pokémon dans GO. Prend en charge Chanceux, Obscur, Meilleur Compagnon, échanges et purification.',
        'intro_title' => 'Calculateur de Poussière Étoile Pokémon GO',
        'intro_content' => '<p>Le <strong>calculateur de poussière étoile Pokémon GO</strong> vous indique précisément combien de poussière étoile et de bonbons il vous faut pour améliorer n\'importe quel Pokémon du niveau actuel jusqu\'au niveau cible — aucune approximation, aucun tableau Excel. Sélectionnez votre Pokémon, réglez les niveaux et obtenez le résultat immédiatement.</p><p>La poussière étoile est la ressource la plus stratégique du jeu — elle se partage entre tous vos Pokémon, et chaque amélioration est un choix qui engage votre progression. Que vous prépariez un <strong>Mewtwo</strong> pour les raids T5 ou un <strong>Giratine Origine</strong> pour la Master League en Ligue de Combat GO, connaître le coût exact vous permet de planifier votre farming avec précision. Associez cet outil à notre <a href="https://pokemoncalculator.online/fr/calculateur-cp-pokemon/">calculateur de CP</a> pour vérifier que les statistiques cachées de votre Pokémon méritent cet investissement.</p><p>Le calculateur intègre tous les modificateurs qui changent votre coût : les <strong>Pokémon Chanceux</strong> réduisent la poussière de 50 %, les <strong>Pokémon Obscurs</strong> l\'augmentent de 20 %, et le bonus <strong>Meilleur Compagnon</strong> vous offre 10 % de réduction supplémentaire. L\'onglet Échange affiche les coûts selon votre niveau d\'amitié, et l\'onglet Purifier calcule le coût exact pour tout Pokémon Obscur. La communauté PvP française est reconnue pour son niveau de jeu élevé — utilisez le calculateur ci-dessus pour optimiser chaque décision de ressources. Complétez votre analyse avec notre <a href="https://pokemoncalculator.online/fr/tableau-des-types/">tableau des types</a> pour estimer le PC final après amélioration.</p>',
        'howto_title' => 'Comment utiliser le calculateur de poussière étoile',
        'howto_step1' => 'Sélectionnez l\'onglet souhaité : <strong>Améliorer</strong>, <strong>Maximiser</strong>, <strong>Échange</strong> ou <strong>Purifier</strong>. Tapez le nom du Pokémon dans le champ de recherche et sélectionnez-le dans la liste déroulante — le sprite et le nom confirment votre choix.',
        'howto_step2' => 'Réglez le <strong>Niveau Actuel</strong> avec le curseur. Pour connaître le niveau exact de votre Pokémon dans le jeu, consultez sa fiche — l\'arc de puissance au-dessus du Pokémon indique sa position entre le niveau minimum et maximum pour votre niveau de dresseur.',
        'howto_step3' => 'Définissez le <strong>Niveau Cible</strong>. Activez les modificateurs pertinents : <strong>Chanceux</strong>, <strong>Obscur</strong> ou <strong>Meilleur Compagnon</strong>. Dans l\'onglet Maximiser, choisissez entre le niveau 40 (standard) et le niveau 50 (nécessite des Bonbons XL et le badge Meilleur Compagnon).',
        'howto_step4' => 'Appuyez sur <strong>Calculer</strong> pour afficher le total de poussière étoile, bonbons et Bonbons XL requis. Le tableau des résultats détaille le coût étape par étape. Copiez les résultats avec le bouton Copier pour les noter facilement.',
        'info_title' => 'Comment fonctionne le coût en poussière étoile dans Pokémon GO',
        'info_content' => '<p>La poussière étoile fait progresser les Pokémon par paliers de 0,5 niveau à chaque amélioration. Chaque plage de niveaux a un coût fixe en poussière et en bonbons, identique pour toutes les espèces — améliorer un Ronflex ou un Ferosinge au même niveau coûte exactement pareil. Ce qui varie, c\'est le modificateur appliqué sur ce coût de base selon le type de Pokémon et les bonus actifs.</p><h3>Coûts par plage de niveaux</h3><p>Du niveau 1 au 10, chaque amélioration coûte entre <strong>200 et 1 000 de poussière</strong>. Du 11 au 20, entre <strong>1 300 et 2 500</strong>. Du 21 au 30, entre <strong>3 000 et 6 000</strong>. Du 31 au 40, entre <strong>7 000 et 10 000</strong>. Monter un Pokémon standard du niveau 1 au 40 coûte exactement <strong>272 500 de poussière étoile</strong> et 273 bonbons. La plage 40–50 ajoute <strong>296 000 de poussière</strong> et 296 Bonbons XL — soit un total de 568 500 de poussière pour le niveau maximum absolu.</p><h3>Les Pokémon Obscurs : conserver ou purifier ?</h3><p>Les Pokémon Obscurs coûtent <strong>20 % de poussière supplémentaire</strong> à chaque amélioration. Pour une montée du niveau 1 au 40, cela représente environ 54 500 de poussière en plus. La communauté PvP française conserve généralement les Obscurs à IVs élevés pour profiter du bonus d\'attaque de 20 % — des Pokémon comme <strong>Ectoplasma Obscur</strong> ou <strong>Dracaufeu Obscur</strong> sont des références absolues en raids. Le calculateur avec le modificateur Obscur activé vous montre le surcoût réel avant de décider. Comparez aussi le PC résultant avec notre <a href="https://pokemoncalculator.online/fr/tableau-des-types/">tableau des types</a>.</p><h3>Pokémon Chanceux : la meilleure réduction du jeu</h3><p>Un Pokémon Chanceux bénéficie d\'une réduction permanente de <strong>50 % sur la poussière étoile</strong> à chaque amélioration. Monter un Chanceux du niveau 1 au 40 ne coûte que 136 250 de poussière. Le statut Chanceux est attribué aléatoirement lors des échanges, avec une probabilité plus élevée pour les échanges entre Meilleurs Amis ou pour les Pokémon capturés avant juillet 2016. Pour un investissement majeur sur un attaquant de raids comme <strong>Rayquaza</strong>, tenter d\'obtenir le statut Chanceux peut économiser plus de 100 000 de poussière. Vérifiez les IV avec notre <a href="https://pokemoncalculator.online/fr/calculateur-cp-pokemon/">calculateur de CP</a> avant de finaliser l\'échange.</p><h3>Coûts d\'échange et niveaux d\'amitié</h3><p>Échanger un Pokémon Légendaire ou Chromatique coûte de la poussière selon le niveau d\'amitié. Un Légendaire déjà dans votre Pokédex coûte <strong>20 000 de poussière</strong> avec un Bon Ami et seulement <strong>800</strong> avec un Meilleur Ami. Un Légendaire nouveau dans votre Pokédex coûte 1 000 000 avec un Bon Ami et 40 000 avec un Meilleur Ami. Construire l\'amitié avant d\'échanger des Pokémon rares est la stratégie d\'économie de poussière la plus rentable du jeu.</p>',
        'info_table_title' => 'Coût en poussière étoile et bonbons par niveau (Pokémon standard)',
        'info_table_html' => '<table class="pkm-calc-table"><thead><tr><th>Niveau</th><th>Poussière / Amélio.</th><th>Bonbons / Amélio.</th><th>Bonbons XL / Amélio.</th><th>Poussière Cumulée (depuis Nv 1)</th></tr></thead><tbody><tr><td>1 → 1.5</td><td>200</td><td>1</td><td>—</td><td>200</td></tr><tr><td>5 → 5.5</td><td>400</td><td>1</td><td>—</td><td>2 200</td></tr><tr><td>10 → 10.5</td><td>800</td><td>1</td><td>—</td><td>7 000</td></tr><tr><td>15 → 15.5</td><td>1 600</td><td>2</td><td>—</td><td>22 000</td></tr><tr><td>20 → 20.5</td><td>2 500</td><td>2</td><td>—</td><td>48 500</td></tr><tr><td>25 → 25.5</td><td>4 000</td><td>3</td><td>—</td><td>96 000</td></tr><tr><td>30 → 30.5</td><td>6 000</td><td>3</td><td>—</td><td>159 500</td></tr><tr><td>35 → 35.5</td><td>8 000</td><td>4</td><td>—</td><td>222 500</td></tr><tr><td>40 → 40.5</td><td>10 000</td><td>6</td><td>—</td><td>272 500</td></tr><tr><td>41 → 41.5</td><td>12 000</td><td>—</td><td>8</td><td>284 500</td></tr><tr><td>45 → 45.5</td><td>15 000</td><td>—</td><td>10</td><td>380 500</td></tr><tr><td>50 (max.)</td><td>—</td><td>—</td><td>—</td><td>568 500 total</td></tr></tbody></table>',
        'faq_title' => 'Foire aux questions — Calculateur de Poussière Étoile',
        'faq_q1' => 'Combien de poussière étoile pour monter un Pokémon au niveau 40 ?',
        'faq_a1' => 'Monter un Pokémon standard du niveau 1 au 40 coûte <strong>272 500 de poussière étoile</strong> et 273 bonbons. Pour un Pokémon Chanceux, le coût est divisé par deux : 136 250 de poussière. Les Pokémon Obscurs coûtent environ 327 000 en raison de la majoration de 20 %. Utilisez le calculateur ci-dessus pour obtenir le chiffre exact à partir de n\'importe quel niveau de départ.',
        'faq_q2' => 'Combien de poussière étoile pour atteindre le niveau 50 ?',
        'faq_a2' => 'Monter du niveau 1 au 50 coûte en tout <strong>568 500 de poussière étoile</strong>, 273 bonbons normaux et 296 Bonbons XL. La plage 40–50 seule consomme 296 000 de poussière et 296 Bonbons XL. Le niveau 50 nécessite le badge Meilleur Compagnon et suffisamment de Bonbons XL. N\'investissez que sur des Pokémon aux IVs quasi parfaits pour les raids ou la Master League.',
        'faq_q3' => 'Combien coûte l\'échange d\'un Pokémon Légendaire en poussière étoile ?',
        'faq_a3' => 'Échanger un Légendaire déjà dans votre Pokédex coûte <strong>20 000 de poussière</strong> avec un Bon Ami et seulement <strong>800</strong> avec un Meilleur Ami. Si le Légendaire est une nouvelle entrée dans votre Pokédex, le coût monte à 1 000 000 avec un Bon Ami et descend à 40 000 avec un Meilleur Ami. Atteignez toujours le niveau Meilleur Ami avant d\'échanger des Pokémon rares ou Chromatiques pour économiser des centaines de milliers de poussière.',
        'faq_q4' => 'Les Pokémon Chanceux consomment-ils moins de poussière étoile ?',
        'faq_a4' => 'Oui — les Pokémon Chanceux bénéficient d\'une <strong>réduction permanente de 50 %</strong> sur la poussière étoile à chaque amélioration. Cette réduction s\'applique du niveau 1 au 50 et se cumule avec le bonus Meilleur Compagnon (–10 %) pour une économie totale de 55 %. Le statut Chanceux est attribué aléatoirement lors des échanges et ne peut pas être retiré. C\'est le mécanisme de réduction de coût le plus puissant du jeu.',
        'faq_q5' => 'Les Pokémon Obscurs coûtent-ils plus de poussière étoile à améliorer ?',
        'faq_a5' => 'Oui, les <strong>Pokémon Obscurs coûtent 20 % de poussière supplémentaire</strong> à chaque amélioration. Pour une montée du niveau 1 au 40, cela représente environ 54 500 de poussière en plus. Les joueurs PvP français gardent généralement les Obscurs à IVs élevés pour profiter du bonus d\'attaque. Activez le modificateur Obscur dans le calculateur pour voir le surcoût précis avant de décider si vous purifiez ou non.',
        'faq_q6' => 'Quelle est la réduction de poussière du bonus Meilleur Compagnon ?',
        'faq_a6' => 'Atteindre le rang <strong>Meilleur Compagnon</strong> avec un Pokémon offre une réduction permanente de 10 % sur la poussière étoile pour ce Pokémon spécifique. Le rang Meilleur Compagnon nécessite 300 Cœurs de Compagnon au total, ce qui demande plusieurs jours d\'interaction quotidienne. La réduction se cumule avec le statut Chanceux (–50 %) pour une économie totale de 55 %. De plus, le rang Meilleur Compagnon est obligatoire pour débloquer les améliorations au-delà du niveau 40.',
        'faq_q7' => 'Combien de poussière étoile coûte la purification d\'un Pokémon Obscur ?',
        'faq_a7' => 'Le coût de purification varie selon l\'espèce. Les Pokémon communs comme Roucool ou Rattata coûtent <strong>1 000 de poussière</strong> et 1 bonbon. Les espèces peu communes comme Nidoran coûtent 3 000 et 3 bonbons. Les espèces rares comme Larvitar, Metang ou Ronflex coûtent 5 000 de poussière et 5 bonbons. La purification supprime le statut Obscur, augmente chaque IV de +2 et élimine la majoration de 20 %. Utilisez l\'onglet Purifier pour consulter le coût de n\'importe quelle espèce.',
        'faq_q8' => 'Comment gagner de la poussière étoile rapidement dans Pokémon GO ?',
        'faq_a8' => 'Les méthodes les plus efficaces sont : capturer des Pokémon avec un Météo en cours (125 de poussière au lieu de 100) et une Pièce Étoile active (×1,5), compléter les Recherches de Terrain qui récompensent de la poussière, et ouvrir les Cadeaux des Meilleurs Amis (200 de poussière chacun). Éclore des Œufs de 10 km rapporte entre 1 600 et 3 200 de poussière. Pendant les Journées Communauté, les bonus de poussière combinés à la Pièce Étoile offrent les meilleures fenêtres de farming de l\'année.',
        'related_title'    => 'Calculateurs Pokémon GO Associés',
        'no_related_tools' => 'Pas encore d\'outils associés. D\'autres calculateurs arrivent bientôt !',
        'blog_guides_title' => 'Guides et Conseils Pokémon GO',
        'blog_read_more'    => 'Lire le guide',
    ],
    'de' => [
        'title'                  => 'Sternenstaub-Rechner',
        'description'            => 'Berechne den genauen Sternenstaub- und Bonbon-Bedarf zum Stärken, Maximieren, Tauschen oder Reinigen deines Pokémon.',
        'tab_powerup'            => 'Stärken',
        'tab_maxout'             => 'Maximieren',
        'tab_trade'              => 'Tauschen',
        'tab_purify'             => 'Reinigen',
        'select_pokemon'         => 'Pokémon suchen...',
        'current_level'          => 'Aktuelles Level',
        'target_level'           => 'Ziellevel',
        'toggle_lucky'           => 'Glücks-Pokémon (–50% Sternenstaub)',
        'toggle_shadow'          => 'Schatten-Pokémon (+20% Sternenstaub)',
        'toggle_buddy'           => 'Bester Kumpel (–10% Sternenstaub)',
        'toggle_xl_research'     => 'XL-Bonbons aus Forschung',
        'calculate_btn'          => 'Berechnen',
        'reset_btn'              => 'Zurücksetzen',
        'result_stardust'        => 'Gesamter Sternenstaub',
        'result_candy'           => 'Gesamte Bonbons',
        'result_xl_candy'        => 'Gesamte XL-Bonbons',
        'result_steps'           => 'Stärkungs-Schritte',
        'table_level'            => 'Level',
        'table_stardust'         => 'Sternenstaub',
        'table_candy'            => 'Bonbons',
        'table_xl_candy'         => 'XL-Bonbons',
        'table_cumulative'       => 'Kumuliert ★',
        'max_level_label'        => 'Maximales Level',
        'max_level_40'           => 'Level 40 (Standard)',
        'max_level_50'           => 'Level 50 (Bester Kumpel / XL)',
        'trade_tier_label'       => 'Tauschtyp',
        'trade_tier_standard'    => 'Standard',
        'trade_tier_special'     => 'Besonders (neuer Pokédex-Eintrag)',
        'trade_tier_ultra'       => 'Ultrabestie',
        'trade_tier_legendary'   => 'Legendär / Mythisch / Schillernd',
        'friendship_label'       => 'Freundschaftsstufe',
        'friendship_good'        => 'Guter Freund',
        'friendship_great'       => 'Großer Freund',
        'friendship_ultra'       => 'Superfreund',
        'friendship_best'        => 'Bester Freund',
        'result_trade_cost'      => 'Sternenstaub-Kosten',
        'purify_result_stardust' => 'Sternenstaub zum Reinigen',
        'purify_result_candy'    => 'Bonbons zum Reinigen',
        'purify_note'            => 'Reinigen entfernt den Schattenstatus und erhöht jeden IV um +2.',
        'copy_btn'               => 'Ergebnisse kopieren',
        'copied'                 => 'Kopiert!',
        'error_data_load'        => 'Pokémon-Daten konnten nicht geladen werden. Bitte die Seite aktualisieren.',
        'error_select_pokemon'   => 'Bitte zuerst ein Pokémon auswählen.',
        'error_invalid_level'    => 'Das Level muss zwischen 1 und 50 liegen.',
        'error_invalid_iv'       => 'IV-Werte müssen zwischen 0 und 15 liegen.',
        'error_no_results'       => 'Kein Pokémon gefunden.',
        'error_calculation'      => 'Berechnungsfehler. Bitte Eingaben überprüfen.',
        'error_same_level'       => 'Das Ziellevel muss höher als das aktuelle Level sein.',
        'noscript_msg'           => 'Bitte JavaScript aktivieren, um diesen Rechner zu nutzen.',
        'meta_title' => 'Pokémon GO Sternenstaub-Rechner | pokemoncalculator.online',
        'meta_desc' => 'Berechne den genauen Sternenstaub- und Bonbon-Bedarf für jedes Pokémon in GO. Unterstützt Glücks-, Schatten-, Bester-Kumpel-Bonus, Tausch und Reinigung.',
        'intro_title' => 'Pokémon GO Sternenstaub-Rechner: Kosten präzise berechnen',
        'intro_content' => '<p>Der <strong>Pokémon GO Sternenstaub-Rechner</strong> zeigt dir den genauen Sternenstaub- und Bonbon-Bedarf, um ein beliebiges Pokémon von seinem aktuellen Level auf ein Ziellevel zu stärken — keine Schätzungen, keine Tabellen. Wähle dein Pokémon, stelle die Level ein und erhalte das Ergebnis sofort.</p><p>Sternenstaub ist die knappste Ressource im Spiel — er wird über alle deine Pokémon hinweg verbraucht, und jede Stärkungsentscheidung zählt. Ob du einen <strong>Garados</strong> für Raids auf Level 40 bringen willst oder einen <strong>Knakrack</strong> für die Master League auf Level 50 pushen möchtest, dieser Rechner gibt dir die exakten Zahlen für eine fundierte Farmplanung. Kombiniere ihn mit unserem <a href="https://pokemoncalculator.online/de/kp-rechner-pokemon-go/">KP-Rechner</a>, um sicherzustellen, dass die versteckten Werte deines Pokémon die Investition rechtfertigen.</p><p>Der Rechner berücksichtigt alle relevanten Modifikatoren: <strong>Glücks-Pokémon</strong> senken den Sternenstaub um 50 %, <strong>Schatten-Pokémon</strong> erhöhen ihn um 20 %, und der <strong>Bester-Kumpel-Bonus</strong> reduziert weitere 10 %. Im Tab Tauschen werden die Kosten nach Freundschaftsstufe angezeigt, und im Tab Reinigen siehst du den genauen Preis für jedes Schatten-Pokémon. Deutsche Spieler schätzen Präzision — nutze den Rechner oben, um jede Stärkungsentscheidung mit exakten Zahlen zu treffen. Ergänze deine Analyse mit unserem <a href="https://pokemoncalculator.online/de/typen-tabelle/">Typen-Tabelle</a> für den finalen KP-Wert nach dem Stärken.</p>',
        'howto_title' => 'So verwendest du den Sternenstaub-Rechner',
        'howto_step1' => 'Wähle den passenden Tab: <strong>Stärken</strong>, <strong>Maximieren</strong>, <strong>Tauschen</strong> oder <strong>Reinigen</strong>. Tippe den Namen des Pokémon in das Suchfeld und wähle es aus der Dropdown-Liste — Sprite und Name bestätigen deine Auswahl.',
        'howto_step2' => 'Stelle das <strong>Aktuelle Level</strong> mit dem Schieberegler ein. Das genaue Level deines Pokémon findest du im Spiel, indem du sein Profil öffnest — der Stärkungsbogen über dem Pokémon zeigt seine Position zwischen Minimal- und Maximallevel an.',
        'howto_step3' => 'Lege das <strong>Ziellevel</strong> fest. Aktiviere die zutreffenden Modifikatoren: <strong>Glücks-Pokémon</strong>, <strong>Schatten-Pokémon</strong> oder <strong>Bester Kumpel</strong>. Im Tab „Maximieren" wähle zwischen Level 40 (Standard) und Level 50 (erfordert XL-Bonbons und das Bester-Kumpel-Abzeichen).',
        'howto_step4' => 'Klicke auf <strong>Berechnen</strong>, um den Gesamtbedarf an Sternenstaub, Bonbons und XL-Bonbons zu sehen. Die Ergebnistabelle zeigt die Kosten Schritt für Schritt. Kopiere die Ergebnisse mit dem Kopieren-Button für bequemen Zugriff unterwegs.',
        'info_title' => 'Wie die Sternenstaub-Kosten in Pokémon GO funktionieren',
        'info_content' => '<p>Sternenstaub stärkt Pokémon in 0,5-Level-Schritten pro Verbesserung. Jede Levelspanne hat fixe Sternenstaub- und Bonbon-Kosten, die für alle Arten identisch sind — eine Stärkung von Karpador und Mewtu auf demselben Level kostet gleich viel. Was variiert, sind die Modifikatoren auf diesen Basiskosten, abhängig vom Typ des Pokémon und aktiven Boni.</p><h3>Kosten nach Levelbereich</h3><p>Von Level 1 bis 10 kostet jede Stärkung zwischen <strong>200 und 1.000 Sternenstaub</strong>. Von 11 bis 20 zwischen <strong>1.300 und 2.500</strong>. Von 21 bis 30 zwischen <strong>3.000 und 6.000</strong>. Von 31 bis 40 zwischen <strong>7.000 und 10.000</strong>. Ein Standard-Pokémon von Level 1 auf Level 40 zu bringen kostet exakt <strong>272.500 Sternenstaub</strong> und 273 Bonbons. Der Bereich 40–50 addiert weitere <strong>296.000 Sternenstaub</strong> und 296 XL-Bonbons — insgesamt 568.500 Sternenstaub für das absolute Maximum.</p><h3>Schatten-Pokémon: 20 % Aufpreis, aber auch 20 % mehr Angriff</h3><p>Schatten-Pokémon kosten bei jeder Stärkung <strong>20 % mehr Sternenstaub</strong> als Standard-Pokémon. Von Level 1 auf 40 entspricht das rund 54.500 extra Sternenstaub. Die deutsche Community bei pokemongo.de diskutiert regelmäßig, wann es sich lohnt, ein Schatten-Pokémon zu behalten oder zu reinigen. Schatten-Pokémon wie <strong>Garados Schatten</strong> oder <strong>Lavados Schatten</strong> gehören zu den stärksten Raidern — der 20 %-Angriffsbonus überwiegt oft die Mehrkosten. Aktiviere den Schatten-Modifikator im Rechner oben, um die genauen Kosten zu sehen, bevor du entscheidest. Vergleiche danach den KP-Wert mit unserem <a href="https://pokemoncalculator.online/de/typen-tabelle/">Typen-Tabelle</a>.</p><h3>Glücks-Pokémon: größte Ersparnis im Spiel</h3><p>Glücks-Pokémon erhalten einen dauerhaften Rabatt von <strong>50 % auf den Sternenstaub</strong> bei jeder Stärkung. Von Level 1 auf 40 kostet ein Glücks-Pokémon nur 136.250 Sternenstaub. Der Glücks-Status wird zufällig beim Tauschen vergeben — Tausche mit Besten Freunden haben eine höhere Chance. Für einen teuren Raid-Angreifer wie <strong>Rayquaza</strong> oder <strong>Mewtu</strong> kann der Glücks-Status mehr als 100.000 Sternenstaub sparen. Prüfe die IV-Werte vorher mit unserem <a href="https://pokemoncalculator.online/de/kp-rechner-pokemon-go/">KP-Rechner</a>, um sicherzugehen, dass das Pokémon die Kriterien erfüllt.</p><h3>Tauschkosten und Freundschaftsstufen</h3><p>Das Tauschen von Legendären oder Schillernden Pokémon kostet Sternenstaub abhängig von der Freundschaftsstufe. Ein Legendäres Pokémon, das du bereits hast, kostet <strong>20.000 Sternenstaub</strong> mit einem Guten Freund und nur <strong>800</strong> mit einem Besten Freund. Ein neues Legendäres (neuer Pokédex-Eintrag) kostet 1.000.000 bei Gutem Freund und 40.000 bei Bestem Freund. Die Freundschaft vor teuren Tauschen aufzubauen ist die effektivste Sternenstaub-Sparstrategie des Spiels.</p>',
        'info_table_title' => 'Sternenstaub- und Bonbon-Kosten pro Level (Standard-Pokémon)',
        'info_table_html' => '<table class="pkm-calc-table"><thead><tr><th>Level</th><th>Sternenstaub / Stärkung</th><th>Bonbons / Stärkung</th><th>XL-Bonbons / Stärkung</th><th>Kum. Sternenstaub (ab Lv 1)</th></tr></thead><tbody><tr><td>1 → 1,5</td><td>200</td><td>1</td><td>—</td><td>200</td></tr><tr><td>5 → 5,5</td><td>400</td><td>1</td><td>—</td><td>2.200</td></tr><tr><td>10 → 10,5</td><td>800</td><td>1</td><td>—</td><td>7.000</td></tr><tr><td>15 → 15,5</td><td>1.600</td><td>2</td><td>—</td><td>22.000</td></tr><tr><td>20 → 20,5</td><td>2.500</td><td>2</td><td>—</td><td>48.500</td></tr><tr><td>25 → 25,5</td><td>4.000</td><td>3</td><td>—</td><td>96.000</td></tr><tr><td>30 → 30,5</td><td>6.000</td><td>3</td><td>—</td><td>159.500</td></tr><tr><td>35 → 35,5</td><td>8.000</td><td>4</td><td>—</td><td>222.500</td></tr><tr><td>40 → 40,5</td><td>10.000</td><td>6</td><td>—</td><td>272.500</td></tr><tr><td>41 → 41,5</td><td>12.000</td><td>—</td><td>8</td><td>284.500</td></tr><tr><td>45 → 45,5</td><td>15.000</td><td>—</td><td>10</td><td>380.500</td></tr><tr><td>50 (max.)</td><td>—</td><td>—</td><td>—</td><td>568.500 gesamt</td></tr></tbody></table>',
        'faq_title' => 'Häufig gestellte Fragen zum Sternenstaub-Rechner',
        'faq_q1' => 'Wie viel Sternenstaub kostet es, ein Pokémon auf Level 40 zu bringen?',
        'faq_a1' => 'Ein Standard-Pokémon von Level 1 auf Level 40 zu stärken kostet <strong>272.500 Sternenstaub</strong> und 273 Bonbons. Für Glücks-Pokémon halbiert sich der Betrag auf 136.250. Schatten-Pokémon kosten rund 327.000 Sternenstaub durch den 20 %-Aufpreis. Nutze den Rechner oben für den genauen Wert ab beliebigem Startlevel.',
        'faq_q2' => 'Wie viel Sternenstaub brauche ich für Level 50?',
        'faq_a2' => 'Ein vollständiger Aufstieg von Level 1 auf 50 kostet insgesamt <strong>568.500 Sternenstaub</strong>, 273 normale Bonbons und 296 XL-Bonbons. Allein der Bereich 40–50 verbraucht 296.000 Sternenstaub und 296 XL-Bonbons. Für Level 50 werden das Bester-Kumpel-Abzeichen und ausreichend XL-Bonbons benötigt. Nur für Pokémon mit nahezu perfekten IVs lohnt sich diese Investition.',
        'faq_q3' => 'Wie viel Sternenstaub kostet der Tausch eines Legendären Pokémon?',
        'faq_a3' => 'Ein Legendäres Pokémon, das du bereits besitzt, zu tauschen kostet <strong>20.000 Sternenstaub</strong> bei Gutem Freund und nur <strong>800</strong> bei Bestem Freund. Ein neues Legendäres (neuer Pokédex-Eintrag) kostet 1.000.000 bei Gutem Freund und 40.000 bei Bestem Freund. Baue immer zuerst die Freundschaft auf, bevor du seltene oder Schillernde Pokémon tauschst — das spart Hunderttausende Sternenstaub.',
        'faq_q4' => 'Kostet ein Glücks-Pokémon weniger Sternenstaub beim Stärken?',
        'faq_a4' => 'Ja — Glücks-Pokémon erhalten einen dauerhaften <strong>Rabatt von 50 %</strong> auf den Sternenstaub bei jeder Stärkung. Dieser Rabatt gilt von Level 1 bis 50 und lässt sich mit dem Bester-Kumpel-Bonus (–10 %) kombinieren, was insgesamt 55 % Ersparnis ergibt. Der Glücks-Status wird beim Tauschen zufällig vergeben und kann nicht entfernt werden. Es ist der stärkste Kostenreduktions-Mechanismus im Spiel.',
        'faq_q5' => 'Kosten Schatten-Pokémon mehr Sternenstaub beim Stärken?',
        'faq_a5' => 'Ja, <strong>Schatten-Pokémon kosten 20 % mehr Sternenstaub</strong> pro Stärkung. Von Level 1 auf 40 sind das rund 54.500 zusätzliche Sternenstaub. Viele erfahrene Spieler behalten Schatten-Pokémon mit hohen IVs und nehmen den Aufpreis in Kauf, weil der 20 %-Angriffsbonus sie zu den besten Angreifern macht. Aktiviere den Schatten-Modifikator im Rechner, um den genauen Mehrpreis zu sehen, bevor du dich entscheidest.',
        'faq_q6' => 'Welchen Sternenstaub-Rabatt gibt der Bester-Kumpel-Bonus?',
        'faq_a6' => 'Das Erreichen des <strong>Bester-Kumpel</strong>-Ranges mit einem Pokémon gewährt einen dauerhaften Rabatt von 10 % auf den Sternenstaub für genau dieses Pokémon. Für den Bester-Kumpel-Status werden 300 Kumpel-Herzen benötigt — das erfordert mehrere Tage täglicher Interaktion. Der Rabatt stackt mit dem Glücks-Status (–50 %) auf insgesamt 55 % Ersparnis. Außerdem ist der Bester-Kumpel-Status Voraussetzung, um Pokémon über Level 40 hinaus zu stärken.',
        'faq_q7' => 'Wie viel Sternenstaub kostet die Reinigung eines Schatten-Pokémon?',
        'faq_a7' => 'Die Reinigungskosten variieren je nach Art. Häufige Pokémon wie Rattfratz oder Taubsi kosten <strong>1.000 Sternenstaub</strong> und 1 Bonbon. Ungewöhnliche Arten wie Nidoran kosten 3.000 und 3 Bonbons. Seltene Arten wie Larvitar, Metang oder Relaxo kosten 5.000 Sternenstaub und 5 Bonbons. Reinigen entfernt den Schatten-Status, erhöht jeden IV um +2 und beseitigt den 20 %-Sternenstaub-Aufpreis. Nutze den Reinigen-Tab oben, um den Preis jeder Art nachzuschlagen.',
        'faq_q8' => 'Wie bekomme ich schnell Sternenstaub in Pokémon GO?',
        'faq_a8' => 'Die effizientesten Methoden sind: Pokémon mit aktivem Sternenstück fangen (×1,5), Feldforschungen abschließen, die Sternenstaub als Belohnung bieten, und Geschenke von Besten Freunden öffnen (je 200 Sternenstaub). Witterungsverstärkte Fänge geben 125 statt 100 Sternenstaub. Das Schlüpfen von 10-km-Eiern bringt 1.600–3.200 Sternenstaub. Während der Community Days — auch in Deutschland sehr beliebt — kombinieren Sternenstaub-Boni und Sternenstück die besten Farming-Fenster des Jahres.',
        'related_title'    => 'Verwandte Pokémon GO Rechner',
        'no_related_tools' => 'Noch keine verwandten Tools. Weitere Rechner kommen bald!',
        'blog_guides_title' => 'Pokémon GO Guides &amp; Tipps',
        'blog_read_more'    => 'Guide lesen',
    ],
];

// ── Shortcode ──────────────────────────────────────────────────
function pkm_stardust_calc_shortcode() {
    global $pkm_current_lang, $pkm_stardust_strings;

    $lang = $pkm_current_lang ?? 'en';
    $t    = $pkm_stardust_strings[ $lang ] ?? $pkm_stardust_strings['en'];

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

    // ── Pokemon data ──
    static $pkm_data_cache = null;
    static $pkm_data_loaded = false;

    if ( ! $pkm_data_loaded ) {
        $pkm_data_cache  = get_pokemon_data();
        $pkm_data_loaded = true;
    }
    $raw = $pkm_data_cache;

    $data_error = false;
    if ( $raw === null || ! is_array( $raw ) || count( $raw ) === 0 ) {
        $data_error = true;
        $js_data    = [];
    } else {
        $js_data = array_map( function( $p ) {
            $types_raw = $p['types'] ?? [];
            $types     = is_array( $types_raw ) ? array_values( $types_raw ) : [];

            return [
                'id'     => intval( $p['id'] ?? 0 ),
                'name'   => sanitize_text_field( $p['name'] ?? '' ),
                'types'  => $types,
                'stats'  => array_map( 'intval', is_array( $p['stats'] ?? null ) ? $p['stats'] : [] ),
                'sprite' => esc_url( trim( $p['sprite_default'] ?? '' ) ),
            ];
        }, $raw );
        $js_data = array_values( array_filter( $js_data, function( $p ) { return $p['id'] > 0; } ) );
    }

    $pokemon_a = [];
    $pokemon_b = [];
    if ( ! $data_error && is_array( $raw ) ) {
        foreach ( $raw as $_p ) {
            if ( ( $_p['id'] ?? 0 ) == 25  ) $pokemon_a = $_p;
            if ( ( $_p['id'] ?? 0 ) == 150 ) $pokemon_b = $_p;
            if ( $pokemon_a && $pokemon_b ) break;
        }
    }
    if ( ! isset( $pokemon_a['sprite_default'] ) ) $pokemon_a = [];
    if ( ! isset( $pokemon_b['sprite_default'] ) ) $pokemon_b = [];

    $sprite_a = esc_url( trim( $pokemon_a['sprite_official'] ?? $pokemon_a['sprite_default'] ?? 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/25.png' ) );
    $sprite_b = esc_url( trim( $pokemon_b['sprite_official'] ?? $pokemon_b['sprite_default'] ?? 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/150.png' ) );

    $js_trans = [
        'error_select_pokemon'   => $t['error_select_pokemon'],
        'error_invalid_level'    => $t['error_invalid_level'],
        'error_no_results'       => $t['error_no_results'],
        'error_calculation'      => $t['error_calculation'],
        'error_same_level'       => $t['error_same_level'],
        'error_data_load'        => $t['error_data_load'],
        'copied'                 => $t['copied'],
        'copy_btn'               => $t['copy_btn'],
        'result_stardust'        => $t['result_stardust'],
        'result_candy'           => $t['result_candy'],
        'result_xl_candy'        => $t['result_xl_candy'],
        'result_steps'           => $t['result_steps'],
        'result_trade_cost'      => $t['result_trade_cost'],
        'purify_result_stardust' => $t['purify_result_stardust'],
        'purify_result_candy'    => $t['purify_result_candy'],
        'table_level'            => $t['table_level'],
        'table_stardust'         => $t['table_stardust'],
        'table_candy'            => $t['table_candy'],
        'table_xl_candy'         => $t['table_xl_candy'],
        'table_cumulative'       => $t['table_cumulative'],
        'purify_note'            => $t['purify_note'],
    ];

    $noscript_options = '';
    if ( ! $data_error ) {
        foreach ( $js_data as $mon ) {
            $name = ucfirst( $mon['name'] ?? '' );
            $id   = intval( $mon['id'] ?? 0 );
            if ( $name && $id ) {
                $noscript_options .= '<option value="' . esc_attr( $id ) . '">' . esc_html( $name ) . '</option>';
            }
        }
    }

    ob_start();
    ?>
    <script>!function(){var t=localStorage.getItem('pkm-theme');if(t)document.documentElement.setAttribute('data-theme',t);else if(window.matchMedia('(prefers-color-scheme: dark)').matches)document.documentElement.setAttribute('data-theme','dark');}();</script>

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Exo+2:wght@400;500;600;700;800&display=swap');

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
        --pkm-font-body: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
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
        --pkm-stardust-color: #F4D03F !important;
        --pkm-candy-color: #E91E63 !important;
        --pkm-xl-candy-color: #9C27B0 !important;
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

    .pkm-icon { display: inline-block !important; vertical-align: middle !important; flex-shrink: 0 !important; }
    .pkm-icon-sm { width: 16px !important; height: 16px !important; }
    .pkm-icon-md { width: 20px !important; height: 20px !important; }
    .pkm-icon-lg { width: 24px !important; height: 24px !important; }
    .pkm-icon-xl { width: 32px !important; height: 32px !important; }

    .pkm-calc-outer {
        position: relative !important;
        width: 100% !important;
        background: var(--pkm-bg) !important;
        min-height: 100px !important;
        font-family: var(--pkm-font-body) !important;
        color: var(--pkm-text) !important;
        box-sizing: border-box !important;
    }
    .pkm-calc-outer *, .pkm-calc-outer *::before, .pkm-calc-outer *::after {
        box-sizing: border-box !important;
    }

    .pkm-calc-wrapper {
        max-width: 1080px !important;
        margin: 0 auto !important;
        padding: 0 16px 40px !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }

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

    .pkm-calc-ad-block {
        text-align: center !important;
        margin: 0 !important;
        padding: 0 !important;
        overflow: hidden !important;
    }

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
        z-index: 0 !important;
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
        filter: drop-shadow(0 4px 12px rgba(0,0,0,0.3)) !important;
        animation: pkm-float 3s ease-in-out infinite !important;
    }
    .pkm-header-sprite-right { animation-delay: 1.5s !important; }
    @keyframes pkm-float {
        0%, 100% { transform: translateY(0); }
        50%       { transform: translateY(-8px); }
    }
    @media (max-width: 480px) {
        .pkm-header-sprite { width: 56px !important; height: 56px !important; animation: none !important; }
    }
    .pkm-calc-header-content {
        position: relative !important;
        z-index: 1 !important;
    }
    .pkm-calc-title {
        font-family: var(--pkm-font-display) !important;
        font-size: clamp(13px, 3vw, 20px) !important;
        color: #FFFFFF !important;
        margin: 0 0 12px !important;
        line-height: 1.6 !important;
        text-shadow: 0 2px 8px rgba(0,0,0,0.3) !important;
    }
    .pkm-calc-description {
        font-family: var(--pkm-font-heading) !important;
        font-size: clamp(14px, 2vw, 16px) !important;
        color: rgba(255,255,255,0.88) !important;
        margin: 0 auto !important;
        max-width: 520px !important;
        line-height: 1.6 !important;
    }

    .pkm-tabs {
        display: flex !important;
        gap: 4px !important;
        background: var(--pkm-bg-3) !important;
        border-radius: var(--pkm-radius) !important;
        padding: 4px !important;
        margin-bottom: 24px !important;
        overflow-x: auto !important;
        -webkit-overflow-scrolling: touch !important;
    }
    .pkm-tab-btn {
        flex: 1 !important;
        min-width: 80px !important;
        padding: 10px 12px !important;
        border: none !important;
        background: transparent !important;
        color: var(--pkm-text-muted) !important;
        font-family: var(--pkm-font-heading) !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        border-radius: var(--pkm-radius-sm) !important;
        cursor: pointer !important;
        transition: var(--pkm-transition) !important;
        white-space: nowrap !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 6px !important;
        min-height: 44px !important;
    }
    .pkm-tab-btn:hover {
        background: var(--pkm-bg-2) !important;
        color: var(--pkm-text) !important;
    }
    .pkm-tab-btn.pkm-tab-active {
        background: var(--pkm-primary) !important;
        color: #FFFFFF !important;
        box-shadow: 0 2px 8px var(--pkm-glow) !important;
    }
    @media (max-width: 480px) {
        .pkm-tab-btn { font-size: 11px !important; padding: 8px 8px !important; }
        .pkm-tab-icon { display: none !important; }
    }

    .pkm-card {
        background: var(--pkm-bg-card) !important;
        border: 1px solid var(--pkm-border) !important;
        border-radius: var(--pkm-radius-lg) !important;
        padding: 24px !important;
        margin-bottom: 20px !important;
        box-shadow: var(--pkm-shadow-sm) !important;
    }
    .pkm-card-title {
        font-family: var(--pkm-font-heading) !important;
        font-size: 16px !important;
        font-weight: 700 !important;
        color: var(--pkm-text) !important;
        margin: 0 0 16px !important;
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
    }

    .pkm-search-wrapper {
        position: relative !important;
        margin-bottom: 20px !important;
    }
    .pkm-search-icon {
        position: absolute !important;
        left: 12px !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        color: var(--pkm-text-subtle) !important;
        pointer-events: none !important;
        z-index: 2 !important;
    }
    .pkm-search-input {
        width: 100% !important;
        padding: 12px 12px 12px 40px !important;
        background: var(--pkm-input-bg) !important;
        border: 2px solid var(--pkm-border) !important;
        border-radius: var(--pkm-radius) !important;
        font-family: var(--pkm-font-body) !important;
        font-size: 15px !important;
        color: var(--pkm-text) !important;
        outline: none !important;
        transition: var(--pkm-transition) !important;
        min-height: 48px !important;
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
        border: 1px solid var(--pkm-border) !important;
        border-radius: var(--pkm-radius) !important;
        box-shadow: var(--pkm-shadow) !important;
        max-height: 280px !important;
        overflow-y: auto !important;
        z-index: 1000 !important;
        display: none !important;
    }
    .pkm-search-dropdown.pkm-dropdown-open { display: block !important; }
    .pkm-search-result-item {
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        padding: 10px 14px !important;
        cursor: pointer !important;
        transition: background 0.15s ease !important;
        border-bottom: 1px solid var(--pkm-border) !important;
        min-height: 48px !important;
    }
    .pkm-search-result-item:last-child { border-bottom: none !important; }
    .pkm-search-result-item:hover,
    .pkm-search-result-item.pkm-result-focused {
        background: var(--pkm-primary-light) !important;
    }
    .pkm-search-result-sprite {
        width: 32px !important;
        height: 32px !important;
        object-fit: contain !important;
        flex-shrink: 0 !important;
    }
    .pkm-search-result-name {
        font-family: var(--pkm-font-heading) !important;
        font-weight: 600 !important;
        font-size: 14px !important;
        color: var(--pkm-text) !important;
        flex: 1 !important;
    }
    .pkm-search-result-types {
        display: flex !important;
        gap: 4px !important;
        flex-shrink: 0 !important;
    }
    .pkm-type-badge {
        font-size: 10px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        padding: 2px 6px !important;
        border-radius: 4px !important;
        color: #FFFFFF !important;
        letter-spacing: 0.5px !important;
    }
    .pkm-type-normal   { background: #A8A878 !important; }
    .pkm-type-fire     { background: #F08030 !important; }
    .pkm-type-water    { background: #6890F0 !important; }
    .pkm-type-electric { background: #F8D030 !important; color: #333 !important; }
    .pkm-type-grass    { background: #78C850 !important; }
    .pkm-type-ice      { background: #98D8D8 !important; color: #333 !important; }
    .pkm-type-fighting { background: #C03028 !important; }
    .pkm-type-poison   { background: #A040A0 !important; }
    .pkm-type-ground   { background: #E0C068 !important; color: #333 !important; }
    .pkm-type-flying   { background: #A890F0 !important; }
    .pkm-type-psychic  { background: #F85888 !important; }
    .pkm-type-bug      { background: #A8B820 !important; }
    .pkm-type-rock     { background: #B8A038 !important; }
    .pkm-type-ghost    { background: #705898 !important; }
    .pkm-type-dragon   { background: #7038F8 !important; }
    .pkm-type-dark     { background: #705848 !important; }
    .pkm-type-steel    { background: #B8B8D0 !important; color: #333 !important; }
    .pkm-type-fairy    { background: #EE99AC !important; color: #333 !important; }
    .pkm-no-results {
        padding: 16px !important;
        color: var(--pkm-text-muted) !important;
        font-size: 14px !important;
        text-align: center !important;
    }

    .pkm-selected-pokemon {
        display: none !important;
        align-items: center !important;
        gap: 12px !important;
        padding: 12px 16px !important;
        background: var(--pkm-primary-light) !important;
        border: 1px solid rgba(13, 148, 136, 0.25) !important;
        border-radius: var(--pkm-radius) !important;
        margin-bottom: 20px !important;
    }
    .pkm-selected-pokemon.pkm-has-selection { display: flex !important; }
    .pkm-selected-sprite {
        width: 48px !important;
        height: 48px !important;
        object-fit: contain !important;
        flex-shrink: 0 !important;
    }
    .pkm-selected-name {
        font-family: var(--pkm-font-heading) !important;
        font-weight: 700 !important;
        font-size: 16px !important;
        color: var(--pkm-text) !important;
        flex: 1 !important;
    }
    .pkm-clear-selection {
        background: none !important;
        border: none !important;
        cursor: pointer !important;
        color: var(--pkm-text-muted) !important;
        padding: 4px !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        transition: var(--pkm-transition) !important;
        min-width: 32px !important;
        min-height: 32px !important;
    }
    .pkm-clear-selection:hover { background: var(--pkm-border) !important; color: var(--pkm-primary) !important; }

    .pkm-form-group {
        margin-bottom: 16px !important;
    }
    .pkm-label {
        display: block !important;
        font-family: var(--pkm-font-heading) !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        color: var(--pkm-text-muted) !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        margin-bottom: 6px !important;
    }
    .pkm-input, .pkm-select {
        width: 100% !important;
        padding: 11px 14px !important;
        background: var(--pkm-input-bg) !important;
        border: 2px solid var(--pkm-border) !important;
        border-radius: var(--pkm-radius) !important;
        font-family: var(--pkm-font-body) !important;
        font-size: 15px !important;
        color: var(--pkm-text) !important;
        outline: none !important;
        transition: var(--pkm-transition) !important;
        min-height: 48px !important;
        appearance: none !important;
        -webkit-appearance: none !important;
    }
    .pkm-input:focus, .pkm-select:focus {
        border-color: var(--pkm-primary) !important;
        box-shadow: 0 0 0 3px var(--pkm-primary-light) !important;
        background: var(--pkm-bg-2) !important;
    }
    .pkm-select {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%238B949E' stroke-width='2' fill='none' stroke-linecap='round'/%3E%3C/svg%3E") !important;
        background-repeat: no-repeat !important;
        background-position: right 14px center !important;
        padding-right: 40px !important;
        cursor: pointer !important;
    }

    .pkm-slider-wrapper {
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
    }
    .pkm-slider {
        flex: 1 !important;
        -webkit-appearance: none !important;
        appearance: none !important;
        height: 6px !important;
        background: var(--pkm-border) !important;
        border-radius: 3px !important;
        outline: none !important;
        cursor: pointer !important;
        min-height: 44px !important;
        padding: 18px 0 !important;
        background-clip: content-box !important;
    }
    .pkm-slider::-webkit-slider-thumb {
        -webkit-appearance: none !important;
        width: 22px !important;
        height: 22px !important;
        border-radius: 50% !important;
        background: var(--pkm-primary) !important;
        cursor: pointer !important;
        box-shadow: 0 2px 6px rgba(13, 148, 136, 0.4) !important;
        transition: var(--pkm-transition) !important;
    }
    .pkm-slider::-webkit-slider-thumb:hover { background: var(--pkm-primary-hover) !important; transform: scale(1.15) !important; }
    .pkm-slider::-moz-range-thumb {
        width: 22px !important;
        height: 22px !important;
        border-radius: 50% !important;
        background: var(--pkm-primary) !important;
        cursor: pointer !important;
        border: none !important;
    }
    .pkm-slider-value {
        font-family: var(--pkm-font-heading) !important;
        font-weight: 700 !important;
        font-size: 18px !important;
        color: var(--pkm-primary) !important;
        min-width: 42px !important;
        text-align: right !important;
    }

    .pkm-toggles {
        display: grid !important;
        grid-template-columns: 1fr !important;
        gap: 10px !important;
        margin-bottom: 20px !important;
    }
    @media (min-width: 480px) {
        .pkm-toggles { grid-template-columns: repeat(2, 1fr) !important; }
    }
    .pkm-toggle-label {
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        cursor: pointer !important;
        padding: 10px 14px !important;
        background: var(--pkm-bg-3) !important;
        border: 1px solid var(--pkm-border) !important;
        border-radius: var(--pkm-radius-sm) !important;
        transition: var(--pkm-transition) !important;
        min-height: 44px !important;
        user-select: none !important;
        -webkit-user-select: none !important;
    }
    .pkm-toggle-label:hover { border-color: var(--pkm-border-hover) !important; background: var(--pkm-bg-2) !important; }
    .pkm-toggle-label input[type="checkbox"] {
        width: 0 !important;
        height: 0 !important;
        opacity: 0 !important;
        position: absolute !important;
    }
    .pkm-toggle-switch {
        width: 36px !important;
        height: 20px !important;
        background: var(--pkm-text-subtle) !important;
        border-radius: 10px !important;
        position: relative !important;
        flex-shrink: 0 !important;
        transition: var(--pkm-transition) !important;
    }
    .pkm-toggle-switch::after {
        content: '' !important;
        position: absolute !important;
        width: 14px !important;
        height: 14px !important;
        background: #FFFFFF !important;
        border-radius: 50% !important;
        top: 3px !important;
        left: 3px !important;
        transition: var(--pkm-transition) !important;
    }
    .pkm-toggle-label input:checked + .pkm-toggle-switch { background: var(--pkm-primary) !important; }
    .pkm-toggle-label input:checked + .pkm-toggle-switch::after { left: 19px !important; }
    .pkm-toggle-text {
        font-family: var(--pkm-font-body) !important;
        font-size: 13px !important;
        color: var(--pkm-text) !important;
        line-height: 1.4 !important;
    }

    .pkm-calc-grid {
        display: grid !important;
        grid-template-columns: 1fr !important;
        gap: 16px !important;
        margin-bottom: 20px !important;
    }
    @media (min-width: 768px) {
        .pkm-calc-grid { grid-template-columns: repeat(2, 1fr) !important; }
    }

    .pkm-btn-row {
        display: flex !important;
        gap: 12px !important;
        flex-wrap: wrap !important;
        margin-top: 4px !important;
    }
    .pkm-btn-primary {
        flex: 1 !important;
        min-height: 52px !important;
        padding: 14px 24px !important;
        background: var(--pkm-primary) !important;
        color: #FFFFFF !important;
        border: none !important;
        border-radius: var(--pkm-radius) !important;
        font-family: var(--pkm-font-heading) !important;
        font-size: 15px !important;
        font-weight: 700 !important;
        cursor: pointer !important;
        transition: var(--pkm-transition) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        box-shadow: 0 4px 12px var(--pkm-glow) !important;
        min-width: 120px !important;
    }
    .pkm-btn-primary:hover {
        background: var(--pkm-primary-hover) !important;
        transform: translateY(-1px) !important;
        box-shadow: 0 6px 20px var(--pkm-glow) !important;
    }
    .pkm-btn-primary:active { transform: translateY(0) !important; }
    .pkm-btn-secondary {
        min-height: 52px !important;
        padding: 14px 20px !important;
        background: var(--pkm-bg-3) !important;
        color: var(--pkm-text-muted) !important;
        border: 1px solid var(--pkm-border) !important;
        border-radius: var(--pkm-radius) !important;
        font-family: var(--pkm-font-heading) !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        cursor: pointer !important;
        transition: var(--pkm-transition) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        min-width: 100px !important;
    }
    .pkm-btn-secondary:hover {
        background: var(--pkm-bg-2) !important;
        border-color: var(--pkm-border-hover) !important;
        color: var(--pkm-text) !important;
    }

    .pkm-results-section {
        display: none !important;
        animation: pkm-fade-in 0.35s ease !important;
    }
    .pkm-results-section.pkm-results-visible { display: block !important; }
    @keyframes pkm-fade-in {
        from { opacity: 0; transform: translateY(8px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .pkm-result-summary {
        display: grid !important;
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 12px !important;
        margin-bottom: 20px !important;
    }
    @media (min-width: 600px) {
        .pkm-result-summary { grid-template-columns: repeat(3, 1fr) !important; }
    }
    .pkm-result-card {
        background: var(--pkm-bg-2) !important;
        border: 1px solid var(--pkm-border) !important;
        border-radius: var(--pkm-radius) !important;
        padding: 16px 14px !important;
        text-align: center !important;
        transition: var(--pkm-transition) !important;
    }
    .pkm-result-card:hover { box-shadow: var(--pkm-shadow-sm) !important; border-color: var(--pkm-border-hover) !important; }
    .pkm-result-card-icon {
        width: 28px !important;
        height: 28px !important;
        margin: 0 auto 8px !important;
        display: block !important;
    }
    .pkm-result-card-icon svg {
        width: 100% !important;
        height: 100% !important;
    }
    .pkm-result-card-value {
        font-family: var(--pkm-font-heading) !important;
        font-size: clamp(20px, 4vw, 28px) !important;
        font-weight: 800 !important;
        line-height: 1 !important;
        margin-bottom: 4px !important;
    }
    .pkm-result-card-label {
        font-size: 11px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        color: var(--pkm-text-muted) !important;
    }
    .pkm-result-stardust .pkm-result-card-value { color: var(--pkm-stardust-color) !important; }
    .pkm-result-candy    .pkm-result-card-value { color: var(--pkm-candy-color) !important; }
    .pkm-result-xl       .pkm-result-card-value { color: var(--pkm-xl-candy-color) !important; }
    .pkm-result-steps    .pkm-result-card-value { color: var(--pkm-accent-2) !important; }
    .pkm-result-trade    .pkm-result-card-value { color: var(--pkm-stardust-color) !important; }

    .pkm-copy-btn {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        padding: 8px 16px !important;
        background: var(--pkm-bg-3) !important;
        border: 1px solid var(--pkm-border) !important;
        border-radius: var(--pkm-radius-sm) !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        color: var(--pkm-text-muted) !important;
        cursor: pointer !important;
        transition: var(--pkm-transition) !important;
        margin-bottom: 16px !important;
        min-height: 36px !important;
    }
    .pkm-copy-btn:hover { background: var(--pkm-bg-2) !important; border-color: var(--pkm-border-hover) !important; color: var(--pkm-text) !important; }
    .pkm-copy-btn.pkm-copied { color: var(--pkm-accent-2) !important; border-color: var(--pkm-accent-2) !important; }

    .pkm-step-table {
        width: 100% !important;
        border-collapse: collapse !important;
        font-size: 13px !important;
        min-width: 400px !important;
    }
    .pkm-step-table th {
        background: var(--pkm-bg-3) !important;
        color: var(--pkm-text-muted) !important;
        font-family: var(--pkm-font-heading) !important;
        font-weight: 700 !important;
        font-size: 11px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        padding: 10px 12px !important;
        text-align: left !important;
        white-space: nowrap !important;
    }
    .pkm-step-table td {
        padding: 9px 12px !important;
        border-bottom: 1px solid var(--pkm-border) !important;
        color: var(--pkm-text) !important;
        font-family: var(--pkm-font-body) !important;
    }
    .pkm-step-table tr:last-child td { border-bottom: none !important; }
    .pkm-step-table tr:hover td { background: var(--pkm-primary-light) !important; }
    .pkm-step-table .pkm-col-stardust { color: var(--pkm-stardust-color) !important; font-weight: 600 !important; }
    .pkm-step-table .pkm-col-candy    { color: var(--pkm-candy-color) !important; font-weight: 600 !important; }
    .pkm-step-table .pkm-col-xl       { color: var(--pkm-xl-candy-color) !important; font-weight: 600 !important; }
    .pkm-step-table .pkm-col-cumul    { color: var(--pkm-text-muted) !important; font-size: 12px !important; }
    .pkm-step-table .pkm-row-total td {
        background: var(--pkm-bg-3) !important;
        font-weight: 700 !important;
        border-top: 2px solid var(--pkm-border-hover) !important;
    }

    .pkm-purify-note {
        background: var(--pkm-primary-light) !important;
        border: 1px solid rgba(13, 148, 136, 0.25) !important;
        border-radius: var(--pkm-radius-sm) !important;
        padding: 12px 14px !important;
        font-size: 13px !important;
        color: var(--pkm-text-muted) !important;
        margin-top: 12px !important;
        display: flex !important;
        align-items: flex-start !important;
        gap: 8px !important;
    }

    .pkm-calc-error-box {
        background: rgba(13, 148, 136, 0.1) !important;
        border: 1px solid rgba(13, 148, 136, 0.3) !important;
        border-radius: var(--pkm-radius) !important;
        padding: 16px 20px !important;
        margin-bottom: 20px !important;
        display: none !important;
        align-items: flex-start !important;
        gap: 10px !important;
        color: var(--pkm-primary) !important;
    }
    .pkm-calc-error-box.pkm-error-visible {
        display: flex !important;
    }
    .pkm-calc-error-box p { margin: 0 !important; font-size: 14px !important; line-height: 1.5 !important; }
    .pkm-validation-errors {
        background: rgba(13,148,136,0.08) !important;
        border: 1px solid rgba(13, 148, 136, 0.25) !important;
        border-radius: var(--pkm-radius-sm) !important;
        padding: 10px 16px !important;
        margin-bottom: 16px !important;
        list-style: none !important;
        color: var(--pkm-primary) !important;
        font-size: 13px !important;
        display: none !important;
    }
    .pkm-validation-errors.pkm-error-visible {
        display: block !important;
    }
    .pkm-validation-errors li { padding: 3px 0 !important; }
    .pkm-validation-errors li::before { content: '⚠ ' !important; }

    .pkm-tab-panel { display: none !important; }
    .pkm-tab-panel.pkm-panel-active { display: block !important; }

    .pkm-section {
         margin-bottom: 0 !important;
         margin-top: 0 !important;
         padding: 20px 0 !important;
    }
    .pkm-section-title {
        font-family: var(--pkm-font-heading) !important;
        font-size: clamp(18px, 3vw, 22px) !important;
        font-weight: 700 !important;
        color: var(--pkm-text) !important;
        margin: 0 0 16px !important;
        padding-bottom: 10px !important;
        border-bottom: 2px solid var(--pkm-border) !important;
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
    }
    .pkm-section p {
        color: var(--pkm-text-muted) !important;
        line-height: 1.7 !important;
        font-size: 15px !important;
        margin: 0 0 12px !important;
    }

    .pkm-howto-steps {
        counter-reset: pkm-step !important;
        list-style: none !important;
        padding: 0 !important;
        margin: 0 !important;
    }
    .pkm-howto-steps li {
        counter-increment: pkm-step !important;
        display: flex !important;
        gap: 14px !important;
        margin-bottom: 16px !important;
        align-items: flex-start !important;
    }
    .pkm-howto-steps li::before {
        content: counter(pkm-step) !important;
        min-width: 32px !important;
        height: 32px !important;
        background: var(--pkm-primary) !important;
        color: #FFFFFF !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-weight: 700 !important;
        font-size: 14px !important;
        flex-shrink: 0 !important;
        margin-top: 2px !important;
    }
    .pkm-howto-steps li span {
        color: var(--pkm-text-muted) !important;
        font-size: 15px !important;
        line-height: 1.6 !important;
    }

    .pkm-faq-item {
        border: 1px solid var(--pkm-border) !important;
        border-radius: var(--pkm-radius-sm) !important;
        margin-bottom: 8px !important;
        overflow: hidden !important;
    }
    .pkm-faq-question {
        width: 100% !important;
        background: var(--pkm-bg-2) !important;
        border: none !important;
        padding: 14px 16px !important;
        text-align: left !important;
        font-family: var(--pkm-font-heading) !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        color: var(--pkm-text) !important;
        cursor: pointer !important;
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        gap: 10px !important;
        transition: var(--pkm-transition) !important;
        min-height: 52px !important;
    }
    .pkm-faq-question:hover { background: var(--pkm-bg-3) !important; }
    .pkm-faq-question[aria-expanded="true"] { color: var(--pkm-primary) !important; }
    .pkm-faq-chevron {
        flex-shrink: 0 !important;
        transition: transform 0.25s ease !important;
        color: var(--pkm-text-subtle) !important;
    }
    .pkm-faq-question[aria-expanded="true"] .pkm-faq-chevron { transform: rotate(180deg) !important; }
    .pkm-faq-answer {
        display: none !important;
        padding: 0 16px 16px !important;
        font-size: 14px !important;
        line-height: 1.7 !important;
        color: var(--pkm-text-muted) !important;
        background: var(--pkm-bg-2) !important;
    }
    .pkm-faq-answer.pkm-faq-open { display: block !important; }

    .pkm-noscript-fallback {
        background: var(--pkm-bg-card) !important;
        border: 1px solid var(--pkm-border) !important;
        border-radius: var(--pkm-radius) !important;
        padding: 20px !important;
        text-align: center !important;
        color: var(--pkm-text-muted) !important;
        font-size: 15px !important;
        margin-bottom: 20px !important;
    }
    .pkm-noscript-fallback select {
        display: block !important;
        margin: 12px auto 0 !important;
        padding: 10px 14px !important;
        border-radius: var(--pkm-radius-sm) !important;
        border: 1px solid var(--pkm-border) !important;
        font-size: 15px !important;
        max-width: 300px !important;
        width: 100% !important;
        background: var(--pkm-input-bg) !important;
        color: var(--pkm-text) !important;
    }
    /* ═══════════════════════════════════════════════════════════════════════
       AD SLOT EMPTY STATE
    ═══════════════════════════════════════════════════════════════════════ */
    .pkm-calc-ad-block:empty { display: none !important; }
    .pkm-calc-ad-block:not(:empty) { margin: 16px auto !important; }

    /* ═══════════════════════════════════════════════════════════════════════
       SEO INFO TABLE  (.pkm-calc-table)
    ═══════════════════════════════════════════════════════════════════════ */
    .pkm-calc-table {
        width: 100% !important;
        border-collapse: collapse !important;
        font-size: 13px !important;
        min-width: 400px !important;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
    }
    .pkm-calc-table thead tr {
        background: linear-gradient(135deg, #0D9488 0%, #134E4A 100%) !important;
    }
    .pkm-calc-table thead th {
        color: #ffffff !important;
        font-family: 'Exo 2', sans-serif !important;
        font-weight: 700 !important;
        font-size: 11px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.6px !important;
        padding: 12px 16px !important;
        text-align: left !important;
        white-space: nowrap !important;
        border: none !important;
        background: transparent !important;
    }
    .pkm-calc-table tbody tr { border: none !important; }
    .pkm-calc-table tbody td {
        padding: 10px 16px !important;
        border: none !important;
        border-bottom: 1px solid rgba(0,0,0,0.06) !important;
        color: #1A1F2E !important;
        font-size: 13px !important;
        white-space: nowrap !important;
        background: transparent !important;
    }
    .pkm-calc-table tbody tr:nth-child(even) td {
        background: #f5f7fa !important;
    }
    .pkm-calc-table tbody tr:last-child td {
        border-bottom: none !important;
    }
    .pkm-calc-table tbody tr:hover td {
        background: rgba(13,148,136,0.08) !important;
    }
    .pkm-calc-table tbody td:first-child {
        font-weight: 700 !important;
        color: #7B5E00 !important;
    }
    .pkm-calc-table tbody td:nth-child(2) {
        font-weight: 600 !important;
        color: #D4A017 !important;
    }
    .pkm-calc-table tbody td:nth-child(3) { color: #C2185B !important; }
    .pkm-calc-table tbody td:nth-child(4) { color: #7B1FA2 !important; }
    .pkm-calc-table tbody td:nth-child(5) { color: #4A5568 !important; font-size: 12px !important; }
    /* dark mode */
    [data-theme="dark"] .pkm-table-wrapper { background: #161B22 !important; border-color: rgba(255,255,255,0.08) !important; }
    [data-theme="dark"] .pkm-calc-table tbody td { color: #E6EDF3 !important; border-bottom-color: rgba(255,255,255,0.06) !important; }
    [data-theme="dark"] .pkm-calc-table tbody tr:nth-child(even) td { background: #21262D !important; }
    [data-theme="dark"] .pkm-calc-table tbody td:first-child { color: #F4D03F !important; }
    [data-theme="dark"] .pkm-calc-table tbody td:nth-child(2) { color: #F4D03F !important; }
    [data-theme="dark"] .pkm-calc-table tbody td:nth-child(5) { color: #8B949E !important; }

    /* ═══════════════════════════════════════════════════════════════════════
       RELATED TOOLS GRID
    ═══════════════════════════════════════════════════════════════════════ */
    .pkm-related-section { padding-top: 4px !important; }
    .pkm-related-grid {
        display: grid !important;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)) !important;
        gap: 14px !important;
        margin-top: 12px !important;
    }
    .pkm-related-card {
        display: flex !important;
        flex-direction: column !important;
        gap: 6px !important;
        padding: 16px !important;
        background: #ffffff !important;
        border: 1.5px solid rgba(0,0,0,0.08) !important;
        border-radius: 12px !important;
        text-decoration: none !important;
        transition: all 0.22s ease !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06) !important;
        min-height: 80px !important;
    }
    [data-theme="dark"] .pkm-related-card {
        background: #161B22 !important;
        border-color: rgba(255,255,255,0.10) !important;
    }
    .pkm-related-card:hover {
        border-color: var(--pkm-primary, #0D9488) !important;
        box-shadow: 0 6px 20px rgba(13,148,136,0.18) !important;
        transform: translateY(-3px) !important;
    }
    .pkm-related-card-icon {
        display: block !important;
        width: 32px !important;
        height: 32px !important;
        color: var(--pkm-primary, #0D9488) !important;
        flex-shrink: 0 !important;
        margin-bottom: 2px !important;
        line-height: 1 !important;
    }
    .pkm-related-card-icon svg,
    .pkm-related-card-icon img {
        display: block !important;
        width: 32px !important;
        height: 32px !important;
        stroke: var(--pkm-primary, #0D9488) !important;
        fill: none !important;
    }
    .pkm-related-card-label {
        font-family: 'Exo 2', sans-serif !important;
        font-weight: 700 !important;
        font-size: 14px !important;
        color: var(--pkm-primary, #0D9488) !important;
        line-height: 1.3 !important;
    }
    [data-theme="dark"] .pkm-related-card-label { color: #FF6B7A !important; }
    .pkm-related-card-desc {
        font-size: 12px !important;
        color: #4A5568 !important;
        line-height: 1.55 !important;
    }
    [data-theme="dark"] .pkm-related-card-desc { color: #8B949E !important; }
    .pkm-no-related { color: #4A5568 !important; font-size: 14px !important; margin-top: 8px !important; }

    </style>

    <div class="pkm-calc-outer" id="pkm-stardust-outer">

        <?php if ( '' !== trim( $ad_slot_e ) ) : ?>
        <div class="pkm-ad-skyscraper pkm-ad-skyscraper-left" aria-hidden="true">
            <?php echo do_shortcode( $ad_slot_e ); ?>
        </div>
        <?php endif; ?>

        <?php if ( '' !== trim( $ad_slot_f_sky ) ) : ?>
        <div class="pkm-ad-skyscraper pkm-ad-skyscraper-right" aria-hidden="true">
            <?php echo do_shortcode( $ad_slot_f_sky ); ?>
        </div>
        <?php endif; ?>

        <div class="pkm-calc-header">
            <div class="pkm-calc-header-glow" aria-hidden="true"></div>
            <div class="pkm-calc-header-sprites" aria-hidden="true">
                <img src="<?php echo $sprite_a; ?>" alt="" width="80" height="80"
                     loading="eager" onerror="this.style.display='none'"
                     class="pkm-header-sprite pkm-header-sprite-left">
                <img src="<?php echo $sprite_b; ?>" alt="" width="80" height="80"
                     loading="eager" onerror="this.style.display='none'"
                     class="pkm-header-sprite pkm-header-sprite-right">
            </div>
            <div class="pkm-calc-header-content">
                <h1 class="pkm-calc-title"><?php echo esc_html( $t['title'] ); ?></h1>
                <p class="pkm-calc-description"><?php echo esc_html( $t['description'] ); ?></p>
            </div>
        </div>

        <div class="pkm-calc-wrapper">

            <?php echo $pkm_render_ad( $ad_slot_a, 'pkm-ad-top' ); ?>

            <?php if ( $data_error ) : ?>
            <div class="pkm-calc-error-box pkm-error-visible" id="pkm-php-data-error" role="alert">
                <svg class="pkm-icon pkm-icon-lg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/>
                    <line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
                <p><?php echo esc_html( $t['error_data_load'] ); ?></p>
            </div>
            <?php endif; ?>

            <div id="pkm-calc-error" class="pkm-calc-error-box" role="alert">
                <svg class="pkm-icon pkm-icon-lg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/>
                    <line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
                <p><?php echo esc_html( $t['error_data_load'] ); ?></p>
            </div>

            <noscript>
                <div class="pkm-noscript-fallback">
                    <p><?php echo esc_html( $t['noscript_msg'] ); ?></p>
                    <?php if ( ! $data_error && $noscript_options ) : ?>
                    <select name="pkm_pokemon_fallback" aria-label="<?php echo esc_attr( $t['select_pokemon'] ); ?>">
                        <option value=""><?php echo esc_html( $t['select_pokemon'] ); ?></option>
                        <?php echo $noscript_options; ?>
                    </select>
                    <?php endif; ?>
                </div>
            </noscript>

            <div class="pkm-tabs" role="tablist" aria-label="Calculator modes" id="pkm-tabs">
                <button class="pkm-tab-btn pkm-tab-active" role="tab" aria-selected="true"
                        aria-controls="pkm-panel-powerup" id="pkm-tab-powerup"
                        data-tab="powerup" type="button">
                    <svg class="pkm-icon pkm-icon-sm pkm-tab-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>
                    </svg>
                    <?php echo esc_html( $t['tab_powerup'] ); ?>
                </button>
                <button class="pkm-tab-btn" role="tab" aria-selected="false"
                        aria-controls="pkm-panel-maxout" id="pkm-tab-maxout"
                        data-tab="maxout" type="button">
                    <svg class="pkm-icon pkm-icon-sm pkm-tab-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                    </svg>
                    <?php echo esc_html( $t['tab_maxout'] ); ?>
                </button>
                <button class="pkm-tab-btn" role="tab" aria-selected="false"
                        aria-controls="pkm-panel-trade" id="pkm-tab-trade"
                        data-tab="trade" type="button">
                    <svg class="pkm-icon pkm-icon-sm pkm-tab-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M7 16V4M7 4L3 8M7 4l4 4"/>
                        <path d="M17 8v12m0 0l4-4m-4 4l-4-4"/>
                    </svg>
                    <?php echo esc_html( $t['tab_trade'] ); ?>
                </button>
                <button class="pkm-tab-btn" role="tab" aria-selected="false"
                        aria-controls="pkm-panel-purify" id="pkm-tab-purify"
                        data-tab="purify" type="button">
                    <svg class="pkm-icon pkm-icon-sm pkm-tab-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        <path d="M12 8v4"/>
                        <path d="M12 16h.01"/>
                    </svg>
                    <?php echo esc_html( $t['tab_purify'] ); ?>
                </button>
            </div>

            <div class="pkm-tab-panel pkm-panel-active" id="pkm-panel-powerup"
                 role="tabpanel" aria-labelledby="pkm-tab-powerup">

                <div class="pkm-card">
                    <p class="pkm-card-title">
                        <svg class="pkm-icon pkm-icon-md" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="11" cy="11" r="8"/>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                        <?php echo esc_html( $t['select_pokemon'] ); ?>
                    </p>

                    <div class="pkm-search-wrapper" id="pkm-pu-search-wrapper">
                        <span class="pkm-search-icon" aria-hidden="true">
                            <svg class="pkm-icon pkm-icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"/>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                            </svg>
                        </span>
                        <input type="text" class="pkm-search-input" id="pkm-pu-search"
                               placeholder="<?php echo esc_attr( $t['select_pokemon'] ); ?>"
                               autocomplete="off" autocorrect="off" autocapitalize="off"
                               spellcheck="false" aria-label="<?php echo esc_attr( $t['select_pokemon'] ); ?>"
                               aria-expanded="false" aria-owns="pkm-pu-dropdown" role="combobox">
                        <input type="hidden" id="pkm-pu-pokemon-id" value="">
                        <div class="pkm-search-dropdown" id="pkm-pu-dropdown" role="listbox"></div>
                    </div>

                    <div class="pkm-selected-pokemon" id="pkm-pu-selected">
                        <img src="" alt="" class="pkm-selected-sprite" id="pkm-pu-selected-sprite"
                             width="48" height="48" onerror="this.style.display='none'">
                        <span class="pkm-selected-name" id="pkm-pu-selected-name"></span>
                        <button type="button" class="pkm-clear-selection" id="pkm-pu-clear"
                                aria-label="Clear selection">
                            <svg class="pkm-icon pkm-icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <line x1="18" y1="6" x2="6" y2="18"/>
                                <line x1="6" y1="6" x2="18" y2="18"/>
                            </svg>
                        </button>
                    </div>

                    <div class="pkm-calc-grid">
                        <div class="pkm-form-group">
                            <label class="pkm-label" for="pkm-pu-current-level"><?php echo esc_html( $t['current_level'] ); ?></label>
                            <div class="pkm-slider-wrapper">
                                <input type="range" class="pkm-slider" id="pkm-pu-current-level"
                                       min="1" max="50" step="0.5" value="1"
                                       aria-label="<?php echo esc_attr( $t['current_level'] ); ?>">
                                <span class="pkm-slider-value" id="pkm-pu-current-val">1</span>
                            </div>
                        </div>
                        <div class="pkm-form-group">
                            <label class="pkm-label" for="pkm-pu-target-level"><?php echo esc_html( $t['target_level'] ); ?></label>
                            <div class="pkm-slider-wrapper">
                                <input type="range" class="pkm-slider" id="pkm-pu-target-level"
                                       min="1" max="50" step="0.5" value="40"
                                       aria-label="<?php echo esc_attr( $t['target_level'] ); ?>">
                                <span class="pkm-slider-value" id="pkm-pu-target-val">40</span>
                            </div>
                        </div>
                    </div>

                    <div class="pkm-toggles">
                        <label class="pkm-toggle-label">
                            <input type="checkbox" id="pkm-pu-lucky">
                            <span class="pkm-toggle-switch" aria-hidden="true"></span>
                            <span class="pkm-toggle-text"><?php echo esc_html( $t['toggle_lucky'] ); ?></span>
                        </label>
                        <label class="pkm-toggle-label">
                            <input type="checkbox" id="pkm-pu-shadow">
                            <span class="pkm-toggle-switch" aria-hidden="true"></span>
                            <span class="pkm-toggle-text"><?php echo esc_html( $t['toggle_shadow'] ); ?></span>
                        </label>
                        <label class="pkm-toggle-label">
                            <input type="checkbox" id="pkm-pu-buddy">
                            <span class="pkm-toggle-switch" aria-hidden="true"></span>
                            <span class="pkm-toggle-text"><?php echo esc_html( $t['toggle_buddy'] ); ?></span>
                        </label>
                    </div>

                    <ul id="pkm-pu-errors" class="pkm-validation-errors" role="alert" aria-live="polite"></ul>

                    <div class="pkm-btn-row">
                        <button type="button" class="pkm-btn-primary" id="pkm-pu-calc-btn">
                            <svg class="pkm-icon pkm-icon-md" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="4" y="5" width="16" height="16" rx="2"/>
                                <line x1="16" y1="3" x2="16" y2="7"/>
                                <line x1="8" y1="3" x2="8" y2="7"/>
                                <line x1="4" y1="11" x2="20" y2="11"/>
                                <line x1="11" y1="15" x2="12" y2="15"/>
                                <line x1="12" y1="15" x2="12" y2="18"/>
                            </svg>
                            <?php echo esc_html( $t['calculate_btn'] ); ?>
                        </button>
                        <button type="button" class="pkm-btn-secondary" id="pkm-pu-reset-btn">
                            <svg class="pkm-icon pkm-icon-md" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <polyline points="1 4 1 10 7 10"/>
                                <path d="M3.51 15a9 9 0 102.13-9.36L1 10"/>
                            </svg>
                            <?php echo esc_html( $t['reset_btn'] ); ?>
                        </button>
                    </div>
                </div>

                <div class="pkm-results-section" id="pkm-pu-results">
                    <div class="pkm-card">
                        <div class="pkm-result-summary" id="pkm-pu-summary"></div>
                        <button type="button" class="pkm-copy-btn" id="pkm-pu-copy">
                            <svg class="pkm-icon pkm-icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="9" y="9" width="13" height="13" rx="2" ry="2"/>
                                <path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/>
                            </svg>
                            <span><?php echo esc_html( $t['copy_btn'] ); ?></span>
                        </button>
                        <div class="pkm-table-wrapper">
                            <table class="pkm-step-table" id="pkm-pu-table">
                                <thead>
                                    <tr>
                                        <th><?php echo esc_html( $t['table_level'] ); ?></th>
                                        <th><?php echo esc_html( $t['table_stardust'] ); ?></th>
                                        <th><?php echo esc_html( $t['table_candy'] ); ?></th>
                                        <th><?php echo esc_html( $t['table_xl_candy'] ); ?></th>
                                        <th><?php echo esc_html( $t['table_cumulative'] ); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="pkm-pu-table-body"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pkm-tab-panel" id="pkm-panel-maxout"
                 role="tabpanel" aria-labelledby="pkm-tab-maxout">
                <div class="pkm-card">
                    <p class="pkm-card-title">
                        <svg class="pkm-icon pkm-icon-md" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="11" cy="11" r="8"/>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                        <?php echo esc_html( $t['select_pokemon'] ); ?>
                    </p>
                    <div class="pkm-search-wrapper" id="pkm-mo-search-wrapper">
                        <span class="pkm-search-icon" aria-hidden="true">
                            <svg class="pkm-icon pkm-icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"/>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                            </svg>
                        </span>
                        <input type="text" class="pkm-search-input" id="pkm-mo-search"
                               placeholder="<?php echo esc_attr( $t['select_pokemon'] ); ?>"
                               autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
                               aria-label="<?php echo esc_attr( $t['select_pokemon'] ); ?>"
                               aria-expanded="false" aria-owns="pkm-mo-dropdown" role="combobox">
                        <input type="hidden" id="pkm-mo-pokemon-id" value="">
                        <div class="pkm-search-dropdown" id="pkm-mo-dropdown" role="listbox"></div>
                    </div>
                    <div class="pkm-selected-pokemon" id="pkm-mo-selected">
                        <img src="" alt="" class="pkm-selected-sprite" id="pkm-mo-selected-sprite"
                             width="48" height="48" onerror="this.style.display='none'">
                        <span class="pkm-selected-name" id="pkm-mo-selected-name"></span>
                        <button type="button" class="pkm-clear-selection" id="pkm-mo-clear" aria-label="Clear selection">
                            <svg class="pkm-icon pkm-icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <line x1="18" y1="6" x2="6" y2="18"/>
                                <line x1="6" y1="6" x2="18" y2="18"/>
                            </svg>
                        </button>
                    </div>
                    <div class="pkm-calc-grid">
                        <div class="pkm-form-group">
                            <label class="pkm-label" for="pkm-mo-current-level"><?php echo esc_html( $t['current_level'] ); ?></label>
                            <div class="pkm-slider-wrapper">
                                <input type="range" class="pkm-slider" id="pkm-mo-current-level"
                                       min="1" max="50" step="0.5" value="1"
                                       aria-label="<?php echo esc_attr( $t['current_level'] ); ?>">
                                <span class="pkm-slider-value" id="pkm-mo-current-val">1</span>
                            </div>
                        </div>
                        <div class="pkm-form-group">
                            <label class="pkm-label" for="pkm-mo-max-select"><?php echo esc_html( $t['max_level_label'] ); ?></label>
                            <select class="pkm-select" id="pkm-mo-max-select"
                                    aria-label="<?php echo esc_attr( $t['max_level_label'] ); ?>">
                                <option value="40"><?php echo esc_html( $t['max_level_40'] ); ?></option>
                                <option value="50"><?php echo esc_html( $t['max_level_50'] ); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="pkm-toggles">
                        <label class="pkm-toggle-label">
                            <input type="checkbox" id="pkm-mo-lucky">
                            <span class="pkm-toggle-switch" aria-hidden="true"></span>
                            <span class="pkm-toggle-text"><?php echo esc_html( $t['toggle_lucky'] ); ?></span>
                        </label>
                        <label class="pkm-toggle-label">
                            <input type="checkbox" id="pkm-mo-shadow">
                            <span class="pkm-toggle-switch" aria-hidden="true"></span>
                            <span class="pkm-toggle-text"><?php echo esc_html( $t['toggle_shadow'] ); ?></span>
                        </label>
                        <label class="pkm-toggle-label">
                            <input type="checkbox" id="pkm-mo-buddy">
                            <span class="pkm-toggle-switch" aria-hidden="true"></span>
                            <span class="pkm-toggle-text"><?php echo esc_html( $t['toggle_buddy'] ); ?></span>
                        </label>
                    </div>
                    <ul id="pkm-mo-errors" class="pkm-validation-errors" role="alert" aria-live="polite"></ul>
                    <div class="pkm-btn-row">
                        <button type="button" class="pkm-btn-primary" id="pkm-mo-calc-btn">
                            <svg class="pkm-icon pkm-icon-md" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="4" y="5" width="16" height="16" rx="2"/>
                                <line x1="16" y1="3" x2="16" y2="7"/>
                                <line x1="8" y1="3" x2="8" y2="7"/>
                                <line x1="4" y1="11" x2="20" y2="11"/>
                                <line x1="11" y1="15" x2="12" y2="15"/>
                                <line x1="12" y1="15" x2="12" y2="18"/>
                            </svg>
                            <?php echo esc_html( $t['calculate_btn'] ); ?>
                        </button>
                        <button type="button" class="pkm-btn-secondary" id="pkm-mo-reset-btn">
                            <svg class="pkm-icon pkm-icon-md" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <polyline points="1 4 1 10 7 10"/>
                                <path d="M3.51 15a9 9 0 102.13-9.36L1 10"/>
                            </svg>
                            <?php echo esc_html( $t['reset_btn'] ); ?>
                        </button>
                    </div>
                </div>
                <div class="pkm-results-section" id="pkm-mo-results">
                    <div class="pkm-card">
                        <div class="pkm-result-summary" id="pkm-mo-summary"></div>
                        <button type="button" class="pkm-copy-btn" id="pkm-mo-copy">
                            <svg class="pkm-icon pkm-icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="9" y="9" width="13" height="13" rx="2" ry="2"/>
                                <path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/>
                            </svg>
                            <span><?php echo esc_html( $t['copy_btn'] ); ?></span>
                        </button>
                        <div class="pkm-table-wrapper">
                            <table class="pkm-step-table" id="pkm-mo-table">
                                <thead>
                                    <tr>
                                        <th><?php echo esc_html( $t['table_level'] ); ?></th>
                                        <th><?php echo esc_html( $t['table_stardust'] ); ?></th>
                                        <th><?php echo esc_html( $t['table_candy'] ); ?></th>
                                        <th><?php echo esc_html( $t['table_xl_candy'] ); ?></th>
                                        <th><?php echo esc_html( $t['table_cumulative'] ); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="pkm-mo-table-body"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pkm-tab-panel" id="pkm-panel-trade"
                 role="tabpanel" aria-labelledby="pkm-tab-trade">
                <div class="pkm-card">
                    <p class="pkm-card-title">
                        <svg class="pkm-icon pkm-icon-md" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M7 16V4M7 4L3 8M7 4l4 4"/>
                            <path d="M17 8v12m0 0l4-4m-4 4l-4-4"/>
                        </svg>
                        <?php echo esc_html( $t['tab_trade'] ); ?>
                    </p>
                    <div class="pkm-calc-grid">
                        <div class="pkm-form-group">
                            <label class="pkm-label" for="pkm-tr-tier"><?php echo esc_html( $t['trade_tier_label'] ); ?></label>
                            <select class="pkm-select" id="pkm-tr-tier"
                                    aria-label="<?php echo esc_attr( $t['trade_tier_label'] ); ?>">
                                <option value="standard"><?php echo esc_html( $t['trade_tier_standard'] ); ?></option>
                                <option value="special"><?php echo esc_html( $t['trade_tier_special'] ); ?></option>
                                <option value="ultra"><?php echo esc_html( $t['trade_tier_ultra'] ); ?></option>
                                <option value="legendary"><?php echo esc_html( $t['trade_tier_legendary'] ); ?></option>
                            </select>
                        </div>
                        <div class="pkm-form-group">
                            <label class="pkm-label" for="pkm-tr-friendship"><?php echo esc_html( $t['friendship_label'] ); ?></label>
                            <select class="pkm-select" id="pkm-tr-friendship"
                                    aria-label="<?php echo esc_attr( $t['friendship_label'] ); ?>">
                                <option value="good"><?php echo esc_html( $t['friendship_good'] ); ?></option>
                                <option value="great"><?php echo esc_html( $t['friendship_great'] ); ?></option>
                                <option value="ultra"><?php echo esc_html( $t['friendship_ultra'] ); ?></option>
                                <option value="best"><?php echo esc_html( $t['friendship_best'] ); ?></option>
                            </select>
                        </div>
                    </div>
                    <ul id="pkm-tr-errors" class="pkm-validation-errors" role="alert" aria-live="polite"></ul>
                    <div class="pkm-btn-row">
                        <button type="button" class="pkm-btn-primary" id="pkm-tr-calc-btn">
                            <svg class="pkm-icon pkm-icon-md" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="4" y="5" width="16" height="16" rx="2"/>
                                <line x1="16" y1="3" x2="16" y2="7"/>
                                <line x1="8" y1="3" x2="8" y2="7"/>
                                <line x1="4" y1="11" x2="20" y2="11"/>
                                <line x1="11" y1="15" x2="12" y2="15"/>
                                <line x1="12" y1="15" x2="12" y2="18"/>
                            </svg>
                            <?php echo esc_html( $t['calculate_btn'] ); ?>
                        </button>
                        <button type="button" class="pkm-btn-secondary" id="pkm-tr-reset-btn">
                            <svg class="pkm-icon pkm-icon-md" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <polyline points="1 4 1 10 7 10"/>
                                <path d="M3.51 15a9 9 0 102.13-9.36L1 10"/>
                            </svg>
                            <?php echo esc_html( $t['reset_btn'] ); ?>
                        </button>
                    </div>
                </div>
                <div class="pkm-results-section" id="pkm-tr-results">
                    <div class="pkm-card">
                        <div class="pkm-result-summary" id="pkm-tr-summary"></div>
                        <button type="button" class="pkm-copy-btn" id="pkm-tr-copy">
                            <svg class="pkm-icon pkm-icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="9" y="9" width="13" height="13" rx="2" ry="2"/>
                                <path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/>
                            </svg>
                            <span><?php echo esc_html( $t['copy_btn'] ); ?></span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="pkm-tab-panel" id="pkm-panel-purify"
                 role="tabpanel" aria-labelledby="pkm-tab-purify">
                <div class="pkm-card">
                    <p class="pkm-card-title">
                        <svg class="pkm-icon pkm-icon-md" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            <path d="M12 8v4"/>
                            <path d="M12 16h.01"/>
                        </svg>
                        <?php echo esc_html( $t['tab_purify'] ); ?>
                    </p>
                    <div class="pkm-search-wrapper" id="pkm-pu2-search-wrapper">
                        <span class="pkm-search-icon" aria-hidden="true">
                            <svg class="pkm-icon pkm-icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"/>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                            </svg>
                        </span>
                        <input type="text" class="pkm-search-input" id="pkm-py-search"
                               placeholder="<?php echo esc_attr( $t['select_pokemon'] ); ?>"
                               autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
                               aria-label="<?php echo esc_attr( $t['select_pokemon'] ); ?>"
                               aria-expanded="false" aria-owns="pkm-py-dropdown" role="combobox">
                        <input type="hidden" id="pkm-py-pokemon-id" value="">
                        <div class="pkm-search-dropdown" id="pkm-py-dropdown" role="listbox"></div>
                    </div>
                    <div class="pkm-selected-pokemon" id="pkm-py-selected">
                        <img src="" alt="" class="pkm-selected-sprite" id="pkm-py-selected-sprite"
                             width="48" height="48" onerror="this.style.display='none'">
                        <span class="pkm-selected-name" id="pkm-py-selected-name"></span>
                        <button type="button" class="pkm-clear-selection" id="pkm-py-clear" aria-label="Clear selection">
                            <svg class="pkm-icon pkm-icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <line x1="18" y1="6" x2="6" y2="18"/>
                                <line x1="6" y1="6" x2="18" y2="18"/>
                            </svg>
                        </button>
                    </div>
                    <ul id="pkm-py-errors" class="pkm-validation-errors" role="alert" aria-live="polite"></ul>
                    <div class="pkm-btn-row">
                        <button type="button" class="pkm-btn-primary" id="pkm-py-calc-btn">
                            <svg class="pkm-icon pkm-icon-md" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="4" y="5" width="16" height="16" rx="2"/>
                                <line x1="16" y1="3" x2="16" y2="7"/>
                                <line x1="8" y1="3" x2="8" y2="7"/>
                                <line x1="4" y1="11" x2="20" y2="11"/>
                                <line x1="11" y1="15" x2="12" y2="15"/>
                                <line x1="12" y1="15" x2="12" y2="18"/>
                            </svg>
                            <?php echo esc_html( $t['calculate_btn'] ); ?>
                        </button>
                        <button type="button" class="pkm-btn-secondary" id="pkm-py-reset-btn">
                            <svg class="pkm-icon pkm-icon-md" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <polyline points="1 4 1 10 7 10"/>
                                <path d="M3.51 15a9 9 0 102.13-9.36L1 10"/>
                            </svg>
                            <?php echo esc_html( $t['reset_btn'] ); ?>
                        </button>
                    </div>
                </div>
                <div class="pkm-results-section" id="pkm-py-results">
                    <div class="pkm-card">
                        <div class="pkm-result-summary" id="pkm-py-summary"></div>
                        <div class="pkm-purify-note" id="pkm-py-note">
                            <svg class="pkm-icon pkm-icon-md" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="12" y1="8" x2="12" y2="12"/>
                                <line x1="12" y1="16" x2="12.01" y2="16"/>
                            </svg>
                            <span><?php echo esc_html( $t['purify_note'] ); ?></span>
                        </div>
                        <button type="button" class="pkm-copy-btn" id="pkm-py-copy">
                            <svg class="pkm-icon pkm-icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="9" y="9" width="13" height="13" rx="2" ry="2"/>
                                <path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/>
                            </svg>
                            <span><?php echo esc_html( $t['copy_btn'] ); ?></span>
                        </button>
                    </div>
                </div>
            </div>

            <?php echo $pkm_render_ad( $ad_slot_b, 'pkm-ad-below-result' ); ?>

            <?php if ( ! empty( $t['intro_title'] ) ) : ?>
            <div class="pkm-section pkm-intro-section">
                <h2 class="pkm-section-title"><?php echo esc_html( $t['intro_title'] ); ?></h2>
                <div class="pkm-section-content"><?php echo wp_kses_post( $t['intro_content'] ); ?></div>
            </div>
            <?php endif; ?>

            <?php echo $pkm_render_ad( $ad_slot_c, 'pkm-ad-mid' ); ?>

            <?php if ( ! empty( $t['howto_title'] ) ) : ?>
            <div class="pkm-section pkm-howto-section">
                <h2 class="pkm-section-title">
                    <svg class="pkm-icon pkm-icon-lg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    <?php echo esc_html( $t['howto_title'] ); ?>
                </h2>
                <ol class="pkm-howto-steps">
                    <?php foreach ( [ 'howto_step1', 'howto_step2', 'howto_step3', 'howto_step4' ] as $sk ) : ?>
                        <?php if ( ! empty( $t[ $sk ] ) ) : ?>
                        <li><span><?php echo wp_kses_post( $t[ $sk ] ); ?></span></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ol>
            </div>
            <?php endif; ?>

            <?php if ( ! empty( $t['info_title'] ) ) : ?>
            <div class="pkm-section pkm-info-section">
                <h2 class="pkm-section-title"><?php echo esc_html( $t['info_title'] ); ?></h2>
                <div class="pkm-section-content"><?php echo wp_kses_post( $t['info_content'] ); ?></div>
                <?php if ( ! empty( $t['info_table_title'] ) ) : ?>
                <h3 style="font-family:var(--pkm-font-heading)!important;font-size:16px!important;font-weight:700!important;color:var(--pkm-text)!important;margin:20px 0 10px!important;"><?php echo esc_html( $t['info_table_title'] ); ?></h3>
                <div class="pkm-table-wrapper"><?php echo wp_kses_post( $t['info_table_html'] ); ?></div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <?php echo $pkm_render_ad( $ad_slot_d, 'pkm-ad-mid-faq' ); ?>

            <?php if ( ! empty( $t['faq_title'] ) ) : ?>
            <div class="pkm-section pkm-faq-section">
                <h2 class="pkm-section-title">
                    <svg class="pkm-icon pkm-icon-lg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/>
                        <line x1="12" y1="17" x2="12.01" y2="17"/>
                    </svg>
                    <?php echo esc_html( $t['faq_title'] ); ?>
                </h2>
                <div class="pkm-faq-list" id="pkm-faq-list">
                    <?php for ( $qi = 1; $qi <= 8; $qi++ ) : ?>
                        <?php if ( ! empty( $t[ 'faq_q' . $qi ] ) ) : ?>
                        <div class="pkm-faq-item">
                            <button class="pkm-faq-question" aria-expanded="false"
                                    aria-controls="pkm-faq-a<?php echo $qi; ?>"
                                    id="pkm-faq-q<?php echo $qi; ?>" type="button">
                                <span><?php echo esc_html( $t[ 'faq_q' . $qi ] ); ?></span>
                                <svg class="pkm-icon pkm-icon-sm pkm-faq-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <polyline points="6 9 12 15 18 9"/>
                                </svg>
                            </button>
                            <div class="pkm-faq-answer" id="pkm-faq-a<?php echo $qi; ?>"
                                 role="region" aria-labelledby="pkm-faq-q<?php echo $qi; ?>">
                                <?php echo wp_kses_post( $t[ 'faq_a' . $qi ] ); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </div>

            <?php echo ( '' !== trim( $ad_slot_d ) ) ? '<div class="pkm-calc-ad-block pkm-ad-below-faq">' . do_shortcode( $ad_slot_d ) . '</div>' : ''; ?>

            <?php if ( ! empty( $t['related_title'] ) ) : ?>
            <div class="pkm-section pkm-related-section">
                <h2 class="pkm-section-title"><?php echo esc_html( $t['related_title'] ); ?></h2>
                <?php
                $rel_list   = [];
                $current_id = get_queried_object_id();
                $parent_id  = wp_get_post_parent_id( $current_id );

                if ( $parent_id ) {
                    $sq = new WP_Query( [
                        'post_type'      => 'page',
                        'post_parent'    => $parent_id,
                        'post_status'    => 'publish',
                        'posts_per_page' => 6,
                        'post__not_in'   => [ $current_id ],
                        'orderby'        => 'menu_order',
                        'order'          => 'ASC',
                        'no_found_rows'  => true,
                    ] );
                    if ( $sq->have_posts() ) {
                        while ( $sq->have_posts() ) {
                            $sq->the_post();
                            $pid       = get_the_ID();
                            $acf_name  = function_exists( 'get_field' ) ? get_field( 'tool_short_name', $pid )             : '';
                            $acf_desc  = function_exists( 'get_field' ) ? get_field( 'tool_one_line_description', $pid )   : '';
                            $acf_icon  = function_exists( 'get_field' ) ? get_field( 'tool_svg_icon_text', $pid )          : '';
                            $rel_list[] = [
                                'url'   => get_permalink( $pid ),
                                'label' => $acf_name ?: get_the_title( $pid ),
                                'desc'  => $acf_desc ?: wp_trim_words( get_the_excerpt( $pid ), 12, '...' ),
                                'icon'  => $acf_icon ?: '',
                            ];
                        }
                        wp_reset_postdata();
                    }
                }

                if ( empty( $rel_list ) ) {
                    $rel_fallback = [
                        'en'    => [
                            [ 'url' => 'https://pokemoncalculator.online/en/pokemon-go-cp-calculator/', 'label' => 'CP Calculator',   'desc' => 'Calculate max CP for any Pokémon at any level.', 'icon' => '' ],
                            [ 'url' => 'https://pokemoncalculator.online/en/type-chart/',               'label' => 'Type Chart',       'desc' => 'Full type effectiveness chart for Pokémon GO.',  'icon' => '' ],
                        ],
                        'es'    => [
                            [ 'url' => 'https://pokemoncalculator.online/es/calculadora-cp-pokemon/',   'label' => 'Calculadora de CP',  'desc' => 'Calcula el CP máximo de cualquier Pokémon.',    'icon' => '' ],
                            [ 'url' => 'https://pokemoncalculator.online/es/tabla-de-tipos/',           'label' => 'Tabla de Tipos',     'desc' => 'Tabla completa de efectividad de tipos.',       'icon' => '' ],
                        ],
                        'pt-br' => [
                            [ 'url' => 'https://pokemoncalculator.online/pt-br/calculadora-pc-pokemon/', 'label' => 'Calculadora de PC', 'desc' => 'Calcule o PC máximo de qualquer Pokémon.',      'icon' => '' ],
                            [ 'url' => 'https://pokemoncalculator.online/pt-br/tabela-de-tipos/',        'label' => 'Tabela de Tipos',   'desc' => 'Tabela completa de efetividade de tipos.',      'icon' => '' ],
                        ],
                        'fr'    => [
                            [ 'url' => 'https://pokemoncalculator.online/fr/calculateur-cp-pokemon/',   'label' => 'Calculateur de CP',  'desc' => 'Calculez le CP maximum de n\'importe quel Pokémon.', 'icon' => '' ],
                            [ 'url' => 'https://pokemoncalculator.online/fr/tableau-des-types/',         'label' => 'Tableau des Types', 'desc' => 'Tableau complet des types pour Pokémon GO.',    'icon' => '' ],
                        ],
                        'de'    => [
                            [ 'url' => 'https://pokemoncalculator.online/de/kp-rechner-pokemon-go/',    'label' => 'KP-Rechner',         'desc' => 'Berechne den maximalen KP für jedes Pokémon.',  'icon' => '' ],
                            [ 'url' => 'https://pokemoncalculator.online/de/typen-tabelle/',             'label' => 'Typen-Tabelle',     'desc' => 'Vollständige Typ-Effektivitäts-Tabelle.',       'icon' => '' ],
                        ],
                    ];
                    $rel_list = $rel_fallback[ $lang ] ?? $rel_fallback['en'];
                }
                ?>
                <?php if ( ! empty( $rel_list ) ) : ?>
                <div class="pkm-related-grid">
                    <?php foreach ( $rel_list as $_rel ) : ?>
                    <a href="<?php echo esc_url( $_rel['url'] ); ?>" class="pkm-related-card">
                        <?php if ( ! empty( $_rel['icon'] ) ) : ?>
                        <span class="pkm-related-card-icon" aria-hidden="true"><?php
                            $allowed_svg = [
                                'svg'      => ['xmlns'=>[],'viewBox'=>[],'width'=>[],'height'=>[],'fill'=>[],'stroke'=>[],'stroke-width'=>[],'stroke-linecap'=>[],'stroke-linejoin'=>[],'class'=>[],'style'=>[],'aria-hidden'=>[]],
                                'path'     => ['d'=>[],'fill'=>[],'stroke'=>[],'stroke-width'=>[],'stroke-linecap'=>[],'stroke-linejoin'=>[]],
                                'circle'   => ['cx'=>[],'cy'=>[],'r'=>[],'fill'=>[],'stroke'=>[],'stroke-width'=>[]],
                                'rect'     => ['x'=>[],'y'=>[],'width'=>[],'height'=>[],'rx'=>[],'ry'=>[],'fill'=>[],'stroke'=>[]],
                                'polygon'  => ['points'=>[],'fill'=>[],'stroke'=>[]],
                                'polyline' => ['points'=>[],'fill'=>[],'stroke'=>[]],
                                'line'     => ['x1'=>[],'y1'=>[],'x2'=>[],'y2'=>[],'stroke'=>[],'stroke-width'=>[]],
                                'g'        => ['fill'=>[],'stroke'=>[],'transform'=>[]],
                                'title'    => [],
                            ];
                            echo wp_kses( $_rel['icon'], $allowed_svg );
                            ?></span>
                        <?php endif; ?>
                        <span class="pkm-related-card-label"><?php echo esc_html( $_rel['label'] ); ?></span>
                        <?php if ( ! empty( $_rel['desc'] ) ) : ?>
                        <span class="pkm-related-card-desc"><?php echo esc_html( $_rel['desc'] ); ?></span>
                        <?php endif; ?>
                    </a>
                    <?php endforeach; ?>
                </div>
                <?php else : ?>
                <p class="pkm-no-related"><?php echo esc_html( $t['no_related_tools'] ); ?></p>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <?php endif; ?>

        </div>
    </div>

    <?php
    echo '<script>const pkmData=' . wp_json_encode( $js_data ) . ';const pkmTrans=' . wp_json_encode( $js_trans ) . ';</script>';
    ?>
    <script>
    (function(){
    'use strict';

    if(typeof pkmData==='undefined'||!Array.isArray(pkmData)||pkmData.length===0){
        var _ce=document.getElementById('pkm-calc-error');
        if(_ce)_ce.classList.add('pkm-error-visible');
        return;
    }

    var _phpErr=document.getElementById('pkm-php-data-error');
    if(_phpErr)_phpErr.classList.remove('pkm-error-visible');

    var _SD={
        '1':   [200,1,0],  '1.5': [200,1,0],
        '2':   [200,1,0],  '2.5': [200,1,0],
        '3':   [400,1,0],  '3.5': [400,1,0],
        '4':   [400,1,0],  '4.5': [400,1,0],
        '5':   [600,1,0],  '5.5': [600,1,0],
        '6':   [600,1,0],  '6.5': [600,1,0],
        '7':   [800,1,0],  '7.5': [800,1,0],
        '8':   [800,1,0],  '8.5': [800,1,0],
        '9':   [1000,1,0], '9.5': [1000,1,0],
        '10':  [1000,1,0], '10.5':[1000,1,0],
        '11':  [1300,2,0], '11.5':[1300,2,0],
        '12':  [1300,2,0], '12.5':[1300,2,0],
        '13':  [1600,2,0], '13.5':[1600,2,0],
        '14':  [1600,2,0], '14.5':[1600,2,0],
        '15':  [1900,2,0], '15.5':[1900,2,0],
        '16':  [1900,2,0], '16.5':[1900,2,0],
        '17':  [2200,2,0], '17.5':[2200,2,0],
        '18':  [2200,2,0], '18.5':[2200,2,0],
        '19':  [2500,2,0], '19.5':[2500,2,0],
        '20':  [2500,2,0], '20.5':[2500,2,0],
        '21':  [3000,3,0], '21.5':[3000,3,0],
        '22':  [3000,3,0], '22.5':[3000,3,0],
        '23':  [3500,3,0], '23.5':[3500,3,0],
        '24':  [3500,3,0], '24.5':[3500,3,0],
        '25':  [4000,4,0], '25.5':[4000,4,0],
        '26':  [4000,4,0], '26.5':[4000,4,0],
        '27':  [4500,4,0], '27.5':[4500,4,0],
        '28':  [4500,4,0], '28.5':[4500,4,0],
        '29':  [5000,4,0], '29.5':[5000,4,0],
        '30':  [5000,4,0], '30.5':[5000,4,0],
        '31':  [6000,6,0], '31.5':[6000,6,0],
        '32':  [6000,6,0], '32.5':[6000,6,0],
        '33':  [7000,8,0], '33.5':[7000,8,0],
        '34':  [7000,8,0], '34.5':[7000,8,0],
        '35':  [8000,10,0],'35.5':[8000,10,0],
        '36':  [8000,10,0],'36.5':[8000,10,0],
        '37':  [9000,12,0],'37.5':[9000,12,0],
        '38':  [9000,12,0],'38.5':[9000,12,0],
        '39':  [10000,15,0],'39.5':[10000,15,0],
        '40':  [10000,15,0],
        '40.5':[10000,1,1],
        '41':  [11000,1,1],'41.5':[11000,1,1],
        '42':  [12000,1,1],'42.5':[12000,1,1],
        '43':  [13000,1,1],'43.5':[13000,1,1],
        '44':  [15000,1,1],'44.5':[15000,1,1],
        '45':  [17000,1,2],'45.5':[17000,1,2],
        '46':  [19000,1,2],'46.5':[19000,1,2],
        '47':  [21000,1,2],'47.5':[21000,1,2],
        '48':  [25000,1,3],'48.5':[25000,1,3],
        '49':  [30000,1,4],'49.5':[30000,1,4],
        '50':  [30000,1,4]
    };

    function _purifyTier(mon){
        if(!mon||!mon.stats)return{dust:3000,candy:3};
        var s=mon.stats;
        var bst=(s.hp||0)+(s.attack||0)+(s.defense||0)+(s.special_attack||0)+(s.special_defense||0)+(s.speed||0);
        if(bst<400)return{dust:1000,candy:1};
        if(bst<500)return{dust:3000,candy:3};
        return{dust:5000,candy:5};
    }

    var _TC={
        standard: {good:100,great:80,ultra:40,best:0},
        special:  {good:20000,great:16000,ultra:1600,best:800},
        ultra:    {good:2000000,great:1600000,ultra:80000,best:40000},
        legendary:{good:1000000,great:800000,ultra:80000,best:40000}
    };

    function _sn(v,fb){return(isNaN(v)||!isFinite(v))?(fb===undefined?0:fb):v;}
    function _fmt(n){return Number(_sn(n,0)).toLocaleString();}

    function _calcRange(fromLv,toLv,isLucky,isShadow,isBuddy){
        var steps=[];
        var totDust=0,totCandy=0,totXL=0,cumDust=0;
        var lv=parseFloat(fromLv);
        var target=parseFloat(toLv);

        while(lv<target){
            lv=Math.round((lv+0.5)*10)/10;
            var key=lv.toString();
            var entry=_SD[key];
            if(!entry)break;

            var dust=entry[0];
            var candy=entry[1];
            var xl=entry[2];

            if(isLucky) dust=Math.ceil(dust*0.5);
            if(isShadow)dust=Math.ceil(dust*1.2);
            if(isBuddy) dust=Math.ceil(dust*0.9);

            totDust+=dust; totCandy+=candy; totXL+=xl;
            cumDust+=dust;
            steps.push({level:key,dust:dust,candy:candy,xl:xl,cumDust:cumDust});
        }
        return{totalDust:totDust,totalCandy:totCandy,totalXL:totXL,steps:steps};
    }

    function _mkSearch(cfg){
        var inp=document.getElementById(cfg.inputId);
        var drop=document.getElementById(cfg.dropdownId);
        var hid=document.getElementById(cfg.hiddenId);
        var box=document.getElementById(cfg.selectedBoxId);
        var spr=document.getElementById(cfg.selectedSpriteId);
        var nm=document.getElementById(cfg.selectedNameId);
        var clr=document.getElementById(cfg.clearBtnId);

        if(!inp||!drop||!hid)return;

        var _debTimer=null;
        var _focusIdx=-1;

        function _open(){drop.classList.add('pkm-dropdown-open');inp.setAttribute('aria-expanded','true');}
        function _close(){drop.classList.remove('pkm-dropdown-open');inp.setAttribute('aria-expanded','false');_focusIdx=-1;}

        function _renderItems(query){
            var q=query.toLowerCase().trim();
            if(q.length<2){drop.innerHTML='';_close();return;}
            var matches=[];
            for(var i=0;i<pkmData.length;i++){
                if(pkmData[i].name.toLowerCase().indexOf(q)===0)matches.push(pkmData[i]);
            }
            for(var i=0;i<pkmData.length;i++){
                if(pkmData[i].name.toLowerCase().indexOf(q)>0)matches.push(pkmData[i]);
            }
            matches=matches.slice(0,30);

            if(matches.length===0){
                drop.innerHTML='<div class="pkm-no-results">'+pkmTrans.error_no_results+'</div>';
                _open();return;
            }
            var html='';
            for(var i=0;i<matches.length;i++){
                var m=matches[i];
                var types='';
                if(m.types&&m.types.length){
                    for(var t=0;t<Math.min(m.types.length,2);t++){
                        types+='<span class="pkm-type-badge pkm-type-'+m.types[t].toLowerCase()+'">'+m.types[t]+'</span>';
                    }
                }
                html+='<div class="pkm-search-result-item" data-id="'+m.id+'" data-name="'+m.name+'" data-sprite="'+m.sprite+'" role="option" tabindex="-1">'
                    +'<img src="'+m.sprite+'" alt="" class="pkm-search-result-sprite" width="32" height="32" loading="lazy" onerror="this.style.display=\'none\'">'
                    +'<span class="pkm-search-result-name">'+m.name.charAt(0).toUpperCase()+m.name.slice(1)+'</span>'
                    +'<span class="pkm-search-result-types">'+types+'</span>'
                    +'</div>';
            }
            drop.innerHTML=html;
            _open();
            _focusIdx=-1;

            var items=drop.querySelectorAll('.pkm-search-result-item');
            for(var i=0;i<items.length;i++){
                (function(item){
                    item.addEventListener('mousedown',function(e){e.preventDefault();_select(item);});
                })(items[i]);
            }
        }

        function _select(item){
            var id=item.getAttribute('data-id');
            var name=item.getAttribute('data-name');
            var sprite=item.getAttribute('data-sprite');
            inp.value=name.charAt(0).toUpperCase()+name.slice(1);
            hid.value=id;
            _close();
            if(box){box.classList.add('pkm-has-selection');}
            if(spr){spr.src=sprite;spr.style.display='';}
            if(nm){nm.textContent=name.charAt(0).toUpperCase()+name.slice(1);}
            if(cfg.onSelect)cfg.onSelect({id:parseInt(id,10),name:name,sprite:sprite});
        }

        function _clearSel(){
            inp.value='';hid.value='';_close();
            if(box)box.classList.remove('pkm-has-selection');
            if(spr){spr.src='';spr.style.display='none';}
            if(nm)nm.textContent='';
            if(cfg.onClear)cfg.onClear();
        }

        inp.addEventListener('input',function(){
            clearTimeout(_debTimer);
            _debTimer=setTimeout(function(){_renderItems(inp.value);},180);
        });

        inp.addEventListener('keydown',function(e){
            var items=drop.querySelectorAll('.pkm-search-result-item');
            if(e.key==='ArrowDown'){
                e.preventDefault();
                _focusIdx=Math.min(_focusIdx+1,items.length-1);
                _updateFocus(items);
            } else if(e.key==='ArrowUp'){
                e.preventDefault();
                _focusIdx=Math.max(_focusIdx-1,0);
                _updateFocus(items);
            } else if(e.key==='Enter'){
                e.preventDefault();
                if(_focusIdx>=0&&items[_focusIdx]){_select(items[_focusIdx]);}
            } else if(e.key==='Escape'){
                _close();
            }
        });

        function _updateFocus(items){
            for(var i=0;i<items.length;i++){
                items[i].classList.toggle('pkm-result-focused',i===_focusIdx);
            }
            if(items[_focusIdx])items[_focusIdx].scrollIntoView({block:'nearest'});
        }

        document.addEventListener('click',function(e){
            if(!inp.contains(e.target)&&!drop.contains(e.target))_close();
        });

        if(clr)clr.addEventListener('click',_clearSel);
    }

    var _ICONS = {
        stardust: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l2.4 7.2h7.6l-6 4.8 2.4 7.2-6-4.8-6 4.8 2.4-7.2-6-4.8h7.6z" fill="#F4D03F" stroke="#F4D03F"/></svg>',
        candy: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2C8 2 5 5 5 9c0 3 2 5 3 6v5c0 1.1.9 2 2 2h4c1.1 0 2-.9 2-2v-5c1-1 3-3 3-6 0-4-3-7-7-7z" fill="#E91E63" stroke="#E91E63"/><path d="M9 13h6M9 17h6" stroke="#fff"/></svg>',
        xlCandy: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L8 8H4l4 4-2 6 6-4 6 4-2-6 4-4h-4l-4-6z" fill="#9C27B0" stroke="#9C27B0"/><text x="12" y="16" text-anchor="middle" fill="#fff" font-size="8" font-weight="bold">XL</text></svg>',
        steps: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" fill="#2ECC71" stroke="#2ECC71"/></svg>',
        trade: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 16V4M7 4L3 8M7 4l4 4" stroke="#F4D03F"/><path d="M17 8v12m0 0l4-4m-4 4l-4-4" stroke="#F4D03F"/></svg>'
    };

    function _mkResultCard(cls,iconType,value,label){
        var iconSvg = _ICONS[iconType] || '';
        return '<div class="pkm-result-card '+cls+'">'
            +'<span class="pkm-result-card-icon" aria-hidden="true">'+iconSvg+'</span>'
            +'<div class="pkm-result-card-value">'+_fmt(value)+'</div>'
            +'<div class="pkm-result-card-label">'+label+'</div>'
            +'</div>';
    }

    function _mkTableBody(steps){
        var html='';
        var totDust=0,totCandy=0,totXL=0;
        for(var i=0;i<steps.length;i++){
            var s=steps[i];
            totDust+=s.dust;totCandy+=s.candy;totXL+=s.xl;
            html+='<tr>'
                +'<td>'+s.level+'</td>'
                +'<td class="pkm-col-stardust">'+_fmt(s.dust)+'</td>'
                +'<td class="pkm-col-candy">'+s.candy+'</td>'
                +'<td class="pkm-col-xl">'+(s.xl>0?s.xl:'-')+'</td>'
                +'<td class="pkm-col-cumul">'+_fmt(s.cumDust)+'</td>'
                +'</tr>';
        }
        html+='<tr class="pkm-row-total">'
            +'<td><strong>Total</strong></td>'
            +'<td class="pkm-col-stardust"><strong>'+_fmt(totDust)+'</strong></td>'
            +'<td class="pkm-col-candy"><strong>'+totCandy+'</strong></td>'
            +'<td class="pkm-col-xl"><strong>'+(totXL>0?totXL:'-')+'</strong></td>'
            +'<td class="pkm-col-cumul"></td>'
            +'</tr>';
        return html;
    }

    function _showResults(el){if(el)el.classList.add('pkm-results-visible');}
    function _hideResults(el){if(el)el.classList.remove('pkm-results-visible');}

    function _showErr(ul,msgs){
        if(!ul)return;
        if(!msgs||msgs.length===0){ul.classList.remove('pkm-error-visible');ul.innerHTML='';return;}
        ul.innerHTML=msgs.map(function(m){return'<li>'+m+'</li>';}).join('');
        ul.classList.add('pkm-error-visible');
    }

    function _setupCopy(btnId,getTextFn){
        var btn=document.getElementById(btnId);
        if(!btn)return;
        btn.addEventListener('click',function(){
            var txt=getTextFn();
            if(!txt)return;
            try{
                navigator.clipboard.writeText(txt).then(function(){
                    var sp=btn.querySelector('span');
                    if(sp){var old=sp.textContent;sp.textContent=pkmTrans.copied;btn.classList.add('pkm-copied');setTimeout(function(){sp.textContent=old;btn.classList.remove('pkm-copied');},2000);}
                });
            }catch(e){}
        });
    }

    var _tabs=document.querySelectorAll('.pkm-tab-btn');
    var _panels=document.querySelectorAll('.pkm-tab-panel');

    function _switchTab(tabId){
        _tabs.forEach(function(t){
            var active=t.getAttribute('data-tab')===tabId;
            t.classList.toggle('pkm-tab-active',active);
            t.setAttribute('aria-selected',active?'true':'false');
        });
        _panels.forEach(function(p){
            p.classList.toggle('pkm-panel-active',p.id==='pkm-panel-'+tabId);
        });
    }

    _tabs.forEach(function(t){
        t.addEventListener('click',function(){_switchTab(t.getAttribute('data-tab'));});
    });

    function _bindSlider(sliderId,labelId){
        var s=document.getElementById(sliderId);
        var l=document.getElementById(labelId);
        if(!s||!l)return;
        l.textContent=s.value;
        s.addEventListener('input',function(){l.textContent=s.value;});
    }
    _bindSlider('pkm-pu-current-level','pkm-pu-current-val');
    _bindSlider('pkm-pu-target-level','pkm-pu-target-val');
    _bindSlider('pkm-mo-current-level','pkm-mo-current-val');

    _mkSearch({
        inputId:'pkm-pu-search', dropdownId:'pkm-pu-dropdown', hiddenId:'pkm-pu-pokemon-id',
        selectedBoxId:'pkm-pu-selected', selectedSpriteId:'pkm-pu-selected-sprite',
        selectedNameId:'pkm-pu-selected-name', clearBtnId:'pkm-pu-clear'
    });

    var _puCalcBtn=document.getElementById('pkm-pu-calc-btn');
    var _puResetBtn=document.getElementById('pkm-pu-reset-btn');
    var _puResults=document.getElementById('pkm-pu-results');
    var _puSummary=document.getElementById('pkm-pu-summary');
    var _puTableBody=document.getElementById('pkm-pu-table-body');
    var _puErrors=document.getElementById('pkm-pu-errors');
    var _puCopyData={text:''};

    if(_puCalcBtn)_puCalcBtn.addEventListener('click',function(){
        _showErr(_puErrors,[]);
        var errs=[];
        var fromLv=parseFloat(document.getElementById('pkm-pu-current-level').value);
        var toLv=parseFloat(document.getElementById('pkm-pu-target-level').value);
        var isLucky=document.getElementById('pkm-pu-lucky').checked;
        var isShadow=document.getElementById('pkm-pu-shadow').checked;
        var isBuddy=document.getElementById('pkm-pu-buddy').checked;

        if(isNaN(fromLv)||fromLv<1||fromLv>50)errs.push(pkmTrans.error_invalid_level);
        if(isNaN(toLv)||toLv<1||toLv>50)errs.push(pkmTrans.error_invalid_level);
        if(errs.length===0&&toLv<=fromLv)errs.push(pkmTrans.error_same_level);

        if(errs.length){_showErr(_puErrors,errs);return;}

        try{
            var res=_calcRange(fromLv,toLv,isLucky,isShadow,isBuddy);
            if(res.steps.length===0){_showErr(_puErrors,[pkmTrans.error_same_level]);return;}

            var html='';
            html+=_mkResultCard('pkm-result-stardust','stardust',res.totalDust,pkmTrans.result_stardust);
            html+=_mkResultCard('pkm-result-candy','candy',res.totalCandy,pkmTrans.result_candy);
            if(res.totalXL>0)html+=_mkResultCard('pkm-result-xl','xlCandy',res.totalXL,pkmTrans.result_xl_candy);
            html+=_mkResultCard('pkm-result-steps','steps',res.steps.length,pkmTrans.result_steps);
            if(_puSummary)_puSummary.innerHTML=html;
            if(_puTableBody)_puTableBody.innerHTML=_mkTableBody(res.steps);
            _showResults(_puResults);
            _puCopyData.text=pkmTrans.result_stardust+': '+_fmt(res.totalDust)+'\n'
                +pkmTrans.result_candy+': '+res.totalCandy+'\n'
                +pkmTrans.result_xl_candy+': '+res.totalXL+'\n'
                +'Steps: '+res.steps.length;
        }catch(e){_showErr(_puErrors,[pkmTrans.error_calculation]);}
    });

    if(_puResetBtn)_puResetBtn.addEventListener('click',function(){
        var s=document.getElementById('pkm-pu-current-level');
        var t=document.getElementById('pkm-pu-target-level');
        if(s){s.value=1;document.getElementById('pkm-pu-current-val').textContent='1';}
        if(t){t.value=40;document.getElementById('pkm-pu-target-val').textContent='40';}
        document.getElementById('pkm-pu-lucky').checked=false;
        document.getElementById('pkm-pu-shadow').checked=false;
        document.getElementById('pkm-pu-buddy').checked=false;
        _showErr(_puErrors,[]);
        _hideResults(_puResults);
        var inp=document.getElementById('pkm-pu-search');
        if(inp)inp.value='';
        document.getElementById('pkm-pu-pokemon-id').value='';
        var box=document.getElementById('pkm-pu-selected');
        if(box)box.classList.remove('pkm-has-selection');
    });

    _setupCopy('pkm-pu-copy',function(){return _puCopyData.text;});

    _mkSearch({
        inputId:'pkm-mo-search', dropdownId:'pkm-mo-dropdown', hiddenId:'pkm-mo-pokemon-id',
        selectedBoxId:'pkm-mo-selected', selectedSpriteId:'pkm-mo-selected-sprite',
        selectedNameId:'pkm-mo-selected-name', clearBtnId:'pkm-mo-clear'
    });

    var _moCalcBtn=document.getElementById('pkm-mo-calc-btn');
    var _moResetBtn=document.getElementById('pkm-mo-reset-btn');
    var _moResults=document.getElementById('pkm-mo-results');
    var _moSummary=document.getElementById('pkm-mo-summary');
    var _moTableBody=document.getElementById('pkm-mo-table-body');
    var _moErrors=document.getElementById('pkm-mo-errors');
    var _moCopyData={text:''};

    if(_moCalcBtn)_moCalcBtn.addEventListener('click',function(){
        _showErr(_moErrors,[]);
        var fromLv=parseFloat(document.getElementById('pkm-mo-current-level').value);
        var maxLv=parseFloat(document.getElementById('pkm-mo-max-select').value);
        var isLucky=document.getElementById('pkm-mo-lucky').checked;
        var isShadow=document.getElementById('pkm-mo-shadow').checked;
        var isBuddy=document.getElementById('pkm-mo-buddy').checked;
        var errs=[];
        if(isNaN(fromLv)||fromLv<1||fromLv>50)errs.push(pkmTrans.error_invalid_level);
        if(errs.length){_showErr(_moErrors,errs);return;}
        if(fromLv>=maxLv){_showErr(_moErrors,[pkmTrans.error_same_level]);return;}

        try{
            var res=_calcRange(fromLv,maxLv,isLucky,isShadow,isBuddy);
            var html='';
            html+=_mkResultCard('pkm-result-stardust','stardust',res.totalDust,pkmTrans.result_stardust);
            html+=_mkResultCard('pkm-result-candy','candy',res.totalCandy,pkmTrans.result_candy);
            if(res.totalXL>0)html+=_mkResultCard('pkm-result-xl','xlCandy',res.totalXL,pkmTrans.result_xl_candy);
            html+=_mkResultCard('pkm-result-steps','steps',res.steps.length,pkmTrans.result_steps);
            if(_moSummary)_moSummary.innerHTML=html;
            if(_moTableBody)_moTableBody.innerHTML=_mkTableBody(res.steps);
            _showResults(_moResults);
            _moCopyData.text=pkmTrans.result_stardust+': '+_fmt(res.totalDust)+'\n'
                +pkmTrans.result_candy+': '+res.totalCandy+'\n'
                +pkmTrans.result_xl_candy+': '+res.totalXL;
        }catch(e){_showErr(_moErrors,[pkmTrans.error_calculation]);}
    });

    if(_moResetBtn)_moResetBtn.addEventListener('click',function(){
        var s=document.getElementById('pkm-mo-current-level');
        if(s){s.value=1;document.getElementById('pkm-mo-current-val').textContent='1';}
        document.getElementById('pkm-mo-max-select').value='40';
        document.getElementById('pkm-mo-lucky').checked=false;
        document.getElementById('pkm-mo-shadow').checked=false;
        document.getElementById('pkm-mo-buddy').checked=false;
        _showErr(_moErrors,[]);
        _hideResults(_moResults);
        var inp=document.getElementById('pkm-mo-search');
        if(inp)inp.value='';
        document.getElementById('pkm-mo-pokemon-id').value='';
        var box=document.getElementById('pkm-mo-selected');
        if(box)box.classList.remove('pkm-has-selection');
    });

    _setupCopy('pkm-mo-copy',function(){return _moCopyData.text;});

    var _trCalcBtn=document.getElementById('pkm-tr-calc-btn');
    var _trResetBtn=document.getElementById('pkm-tr-reset-btn');
    var _trResults=document.getElementById('pkm-tr-results');
    var _trSummary=document.getElementById('pkm-tr-summary');
    var _trErrors=document.getElementById('pkm-tr-errors');
    var _trCopyData={text:''};

    if(_trCalcBtn)_trCalcBtn.addEventListener('click',function(){
        _showErr(_trErrors,[]);
        var tier=document.getElementById('pkm-tr-tier').value;
        var friend=document.getElementById('pkm-tr-friendship').value;

        try{
            var tierData=_TC[tier];
            if(!tierData){_showErr(_trErrors,[pkmTrans.error_calculation]);return;}
            var cost=tierData[friend];
            if(typeof cost==='undefined'){_showErr(_trErrors,[pkmTrans.error_calculation]);return;}

            var html=_mkResultCard('pkm-result-trade','trade',cost,pkmTrans.result_trade_cost);
            if(_trSummary)_trSummary.innerHTML=html;
            _showResults(_trResults);
            _trCopyData.text=pkmTrans.result_trade_cost+': '+_fmt(cost);
        }catch(e){_showErr(_trErrors,[pkmTrans.error_calculation]);}
    });

    if(_trResetBtn)_trResetBtn.addEventListener('click',function(){
        document.getElementById('pkm-tr-tier').value='standard';
        document.getElementById('pkm-tr-friendship').value='good';
        _showErr(_trErrors,[]);
        _hideResults(_trResults);
    });

    _setupCopy('pkm-tr-copy',function(){return _trCopyData.text;});

    var _pySelId={id:null};

    _mkSearch({
        inputId:'pkm-py-search', dropdownId:'pkm-py-dropdown', hiddenId:'pkm-py-pokemon-id',
        selectedBoxId:'pkm-py-selected', selectedSpriteId:'pkm-py-selected-sprite',
        selectedNameId:'pkm-py-selected-name', clearBtnId:'pkm-py-clear',
        onSelect:function(mon){_pySelId.id=mon.id;},
        onClear:function(){_pySelId.id=null;}
    });

    var _pyCalcBtn=document.getElementById('pkm-py-calc-btn');
    var _pyResetBtn=document.getElementById('pkm-py-reset-btn');
    var _pyResults=document.getElementById('pkm-py-results');
    var _pySummary=document.getElementById('pkm-py-summary');
    var _pyErrors=document.getElementById('pkm-py-errors');
    var _pyCopyData={text:''};

    if(_pyCalcBtn)_pyCalcBtn.addEventListener('click',function(){
        _showErr(_pyErrors,[]);
        var pid=parseInt(document.getElementById('pkm-py-pokemon-id').value,10);
        if(!pid||isNaN(pid)){_showErr(_pyErrors,[pkmTrans.error_select_pokemon]);return;}

        var mon=null;
        for(var i=0;i<pkmData.length;i++){if(pkmData[i].id===pid){mon=pkmData[i];break;}}
        if(!mon){_showErr(_pyErrors,[pkmTrans.error_select_pokemon]);return;}

        try{
            var tier=_purifyTier(mon);
            var html='';
            html+=_mkResultCard('pkm-result-stardust','stardust',tier.dust,pkmTrans.result_stardust);
            html+=_mkResultCard('pkm-result-candy','candy',tier.candy,pkmTrans.result_candy);
            if(_pySummary)_pySummary.innerHTML=html;
            _showResults(_pyResults);
            _pyCopyData.text=pkmTrans.result_stardust+': '+_fmt(tier.dust)+'\n'
                +pkmTrans.result_candy+': '+tier.candy;
        }catch(e){_showErr(_pyErrors,[pkmTrans.error_calculation]);}
    });

    if(_pyResetBtn)_pyResetBtn.addEventListener('click',function(){
        var inp=document.getElementById('pkm-py-search');
        if(inp)inp.value='';
        document.getElementById('pkm-py-pokemon-id').value='';
        _pySelId.id=null;
        var box=document.getElementById('pkm-py-selected');
        if(box)box.classList.remove('pkm-has-selection');
        _showErr(_pyErrors,[]);
        _hideResults(_pyResults);
    });

    _setupCopy('pkm-py-copy',function(){return _pyCopyData.text;});

    var _faqBtns=document.querySelectorAll('.pkm-faq-question');
    _faqBtns.forEach(function(btn){
        btn.addEventListener('click',function(){
            var expanded=btn.getAttribute('aria-expanded')==='true';
            var answerId=btn.getAttribute('aria-controls');
            var answerEl=answerId?document.getElementById(answerId):null;
            _faqBtns.forEach(function(b){
                b.setAttribute('aria-expanded','false');
                var aid=b.getAttribute('aria-controls');
                var ael=aid?document.getElementById(aid):null;
                if(ael)ael.classList.remove('pkm-faq-open');
            });
            if(!expanded&&answerEl){
                btn.setAttribute('aria-expanded','true');
                answerEl.classList.add('pkm-faq-open');
            }
        });
    });

    })();
    </script>
    <?php

    return ob_get_clean();
}
add_shortcode( 'pkm_stardust_calc', 'pkm_stardust_calc_shortcode' );