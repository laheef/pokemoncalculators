<?php
// Standalone PHP

/*
 * ============================================================
 * Pokemon GO IV Calculator
 * File: wp-content/themes/theme-v1.3.0/pkm-calculators/pkm-iv-calculator.php
 * Shortcode: [pkm_iv_calc]
 * ============================================================
 *
 * LANGUAGE SWITCHER SETUP — REQUIRED
 * Add the following line to the $slug_map array inside
 * the pkm_get_lang_url() function in functions.php:
 *
 * 'pokemon-go-iv-calculator' => array('es' => 'calculadora-iv-pokemon-go', 'pt-br' => 'calculadora-iv-pokemon-go', 'fr' => 'calculateur-iv-pokemon-go', 'de' => 'pokemon-go-iv-rechner'),
 *
 * ============================================================
 * FUNCTIONS.PHP REGISTRATION — Add this line:
 * require_once get_stylesheet_directory() . '/pkm-calculators/pkm-iv-calculator.php';
 * ============================================================
 */

// ── Google Analytics ──────────────────────────────────────────────────────────
function pkm_iv_calculator_gtag() {
    if ( ! is_page(['pokemon-go-iv-calculator','calculadora-iv-pokemon-go','calculateur-iv-pokemon-go','pokemon-go-iv-rechner']) ) return;
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
add_action( 'wp_head', 'pkm_iv_calculator_gtag', 1 );

// ── Hreflang ──────────────────────────────────────────────────────────────────
function pkm_iv_calculator_hreflang() {
    if ( ! is_page(['pokemon-go-iv-calculator','calculadora-iv-pokemon-go','calculateur-iv-pokemon-go','pokemon-go-iv-rechner']) ) return;
    $langs = ['en', 'es', 'pt-br', 'fr', 'de'];
    foreach ( $langs as $l ) {
        $hreflang = ( $l === 'pt-br' ) ? 'pt-BR' : $l;
        echo '<link rel="alternate" hreflang="' . esc_attr($hreflang) . '" href="' . esc_url(pkm_get_lang_url($l)) . '">' . "\n";
    }
    echo '<link rel="alternate" hreflang="x-default" href="' . esc_url(pkm_get_lang_url('en')) . '">' . "\n";
}
add_action( 'wp_head', 'pkm_iv_calculator_hreflang' );

// ── Canonical ─────────────────────────────────────────────────────────────────
function pkm_iv_calculator_canonical() {
    if ( ! is_page(['pokemon-go-iv-calculator','calculadora-iv-pokemon-go','calculateur-iv-pokemon-go','pokemon-go-iv-rechner']) ) return;
    $url = ( is_ssl() ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    echo '<link rel="canonical" href="' . esc_url($url) . '">' . "\n";
}
add_action( 'wp_head', 'pkm_iv_calculator_canonical' );

// ── Schema ────────────────────────────────────────────────────────────────────
function pkm_iv_calculator_schema() {
    if ( ! is_page(['pokemon-go-iv-calculator','calculadora-iv-pokemon-go','calculateur-iv-pokemon-go','pokemon-go-iv-rechner']) ) return;
    global $pkm_current_lang;
    $lang = $pkm_current_lang ?? 'en';
    $current_url = ( is_ssl() ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $schema = [
        '@context' => 'https://schema.org',
        '@graph'   => [
            [
                '@type'           => 'WebApplication',
                'name'            => 'Pokemon GO IV Calculator',
                'url'             => $current_url,
                'description'     => 'step1_placeholder',
                'inLanguage'      => $lang,
                'applicationCategory' => 'UtilitiesApplication',
                'operatingSystem' => 'Web',
                'offers'          => [ '@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD' ],
            ],
            [
                '@type' => 'HowTo',
                'name'  => 'step1_placeholder',
                'step'  => [
                    [ '@type' => 'HowToStep', 'name' => 'step1_placeholder', 'text' => 'step1_placeholder' ],
                    [ '@type' => 'HowToStep', 'name' => 'step2_placeholder', 'text' => 'step2_placeholder' ],
                    [ '@type' => 'HowToStep', 'name' => 'step3_placeholder', 'text' => 'step3_placeholder' ],
                    [ '@type' => 'HowToStep', 'name' => 'step4_placeholder', 'text' => 'step4_placeholder' ],
                ],
            ],
            [
                '@type'      => 'FAQPage',
                'mainEntity' => [
                    [ '@type' => 'Question', 'name' => 'faq1_placeholder', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'faq1_answer_placeholder' ] ],
                    [ '@type' => 'Question', 'name' => 'faq2_placeholder', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'faq2_answer_placeholder' ] ],
                ],
            ],
            [
                '@type'           => 'BreadcrumbList',
                'itemListElement' => [
                    [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url('/') ],
                    [ '@type' => 'ListItem', 'position' => 2, 'name' => 'Pokemon GO IV Calculator', 'item' => $current_url ],
                ],
            ],
        ],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
add_action( 'wp_head', 'pkm_iv_calculator_schema' );

// ── Meta title + description output ───────────────────────────────────────────
function pkm_iv_calculator_meta() {
    if ( ! is_page(['pokemon-go-iv-calculator','calculadora-iv-pokemon-go','calculateur-iv-pokemon-go','pokemon-go-iv-rechner']) ) return;
    global $pkm_current_lang;
    $lang = $pkm_current_lang ?? 'en';
    $meta_strings = [
        'en'    => [ 'title' => 'Pokemon GO IV Calculator | Check IVs Instantly', 'desc' => 'Use our free Pokemon GO IV calculator to find your Pokemon\'s exact Attack, Defense and Stamina IVs, IV percentage, CP at every level and PvP league ratings.' ],
        'es'    => [ 'title' => 'Calculadora IV Pokemon GO | Revela tus IVs al Instante', 'desc' => 'Descubre los IVs exactos de tu Pokemon en Pokemon GO: Ataque, Defensa y Resistencia, porcentaje IV, PC por nivel y clasificaciones PvP. Gratis y sin registro.' ],
        'pt-br' => [ 'title' => 'Calculadora de IV Pokemon GO | Descubra seus IVs', 'desc' => 'Calcule los IVs exatos do seu Pokemon GO: Ataque, Defesa e Resistência, porcentagem IV, PC por nível e notas PvP. Ferramenta gratuita sem cadastro.' ],
        'fr'    => [ 'title' => 'Calculateur IV Pokemon GO | Trouvez vos IV Exactement', 'desc' => 'Calculez les IV exacts de votre Pokemon GO : Attaque, Défense et Endurance, pourcentage IV, PC par niveau et classements PvP. Outil gratuit, sans inscription.' ],
        'de'    => [ 'title' => 'Pokemon GO IV Rechner | IVs Exakt Berechnen', 'desc' => 'Berechne die genauen IVs deines Pokemon GO: Angriff, Verteidigung und Ausdauer, IV-Prozentsatz, KP pro Level und PvP-Bewertungen. Kostenlos, ohne Registrierung.' ],
    ];
    $m = $meta_strings[$lang] ?? $meta_strings['en'];
    echo '<title>' . esc_html( $m['title'] ) . '</title>' . "\n";
    echo '<meta name="description" content="' . esc_attr( $m['desc'] ) . '">' . "\n";
}
add_action( 'wp_head', 'pkm_iv_calculator_meta', 2 );

// ── Related tools helper ───────────────────────────────────────────────────────
function pkm_iv_get_related_tools( int $current_id, int $limit = 6 ): array {
    // Get the parent page ID — siblings share the same parent
    $parent_id = wp_get_post_parent_id( $current_id );

    // If no parent, fall back to top-level siblings (post_parent = 0)
    $args = [
        'post_type'      => 'page',
        'posts_per_page' => $limit + 5, // fetch extra to account for skips
        'post_status'    => 'publish',
        'post__not_in'   => [ $current_id ],
        'post_parent'    => $parent_id, // siblings only — same parent
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'meta_query'     => [ [ 'key' => 'tool_svg_icon_text', 'compare' => 'EXISTS' ] ],
    ];
    $query = new WP_Query( $args );
    $tools = [];
    if ( $query->have_posts() ) {
        foreach ( $query->posts as $s ) {
            $tools[] = [
                'title'       => get_field( 'tool_short_name', $s->ID ) ?: $s->post_title,
                'description' => get_field( 'tool_one_line_description', $s->ID ) ?: '',
                'svg_icon'    => get_field( 'tool_svg_icon_text', $s->ID ) ?: pkm_default_tool_svg_icon(),
                'url'         => get_permalink( $s->ID ),
            ];
            if ( count($tools) >= $limit ) break;
        }
    }
    wp_reset_postdata();
    return $tools;
}

// ── Shortcode ─────────────────────────────────────────────────────────────────
function pkm_iv_calc_shortcode() {

    // ── Strings ───────────────────────────────────────────────────────────────
    $strings = [
        'en' => [
            // UI
            'title'                  => 'Pokemon GO IV Calculator',
            'description'            => 'Calculate your Pokemon\'s exact IVs, IV%, CP at every level, and PvP ratings instantly.',
            'tab_simple'             => 'Simple',
            'tab_advanced'           => 'Advanced',
            'tab_bulk'               => 'Bulk',
            'select_pokemon'         => 'Search Pokemon...',
            'attack_iv_label'        => 'Attack IV',
            'defense_iv_label'       => 'Defense IV',
            'stamina_iv_label'       => 'Stamina IV',
            'level_label'            => 'Level',
            'calculate_btn'          => 'Calculate IVs',
            'reset_btn'              => 'Reset',
            'copy_btn'               => 'Copy Results',
            'copied_btn'             => 'Copied!',
            'appraisal_label'        => 'Appraisal',
            'appraisal_hint'         => 'Select the arrow ratings from your Team Leader appraisal',
            'appraisal_atk'          => 'Attack',
            'appraisal_def'          => 'Defense',
            'appraisal_sta'          => 'Stamina',
            'result_iv_pct'          => 'IV Score',
            'result_cp'              => 'Combat Power',
            'result_hp'              => 'Hit Points',
            'result_level'           => 'Level',
            'result_rating'          => 'Rating',
            'result_rank'            => 'Rank',
            'pvp_title'              => 'PvP League Ratings',
            'pvp_great'              => 'Great League',
            'pvp_ultra'              => 'Ultra League',
            'pvp_master'             => 'Master League',
            'pvp_cp_cap'             => 'Max CP',
            'pvp_best_cp'            => 'Best CP',
            'pvp_best_level'         => 'Best Level',
            'moveset_title'          => 'Best Moveset',
            'moveset_fast'           => 'Fast Move',
            'moveset_charged'        => 'Charged Move',
            'moveset_dps'            => 'DPS',
            'moveset_type'           => 'Type',
            'cp_table_title'         => 'CP at Every Level',
            'cp_table_show'          => 'Show Level Table',
            'cp_table_hide'          => 'Hide Level Table',
            'cp_table_level'         => 'Level',
            'cp_table_cp'            => 'CP',
            'cp_table_hp'            => 'HP',
            'bulk_add_btn'           => 'Add Pokemon',
            'bulk_calc_btn'          => 'Calculate All',
            'bulk_clear_btn'         => 'Clear All',
            'bulk_copy_btn'          => 'Copy Results',
            'bulk_rank_col'          => '#',
            'bulk_pokemon_col'       => 'Pokemon',
            'bulk_ivs_col'           => 'IVs',
            'bulk_iv_pct_col'        => 'IV%',
            'bulk_cp_col'            => 'CP',
            'bulk_rating_col'        => 'Rating',
            'bulk_placeholder'       => 'Add up to 6 Pokemon above, then click Calculate All.',
            'rating_100'             => '100% — Perfect!',
            'rating_98'              => '98% — Lucky',
            'rating_above_90'        => 'Excellent',
            'rating_above_80'        => 'Great',
            'rating_above_66'        => 'Good',
            'rating_below_66'        => 'Not Bad',
            'stars_3'                => '3★ Perfect',
            'stars_2'                => '2★ Great',
            'stars_1'                => '1★ Good',
            'stars_0'                => '0★',
            'hp_label'               => 'HP',
            'cp_label'               => 'CP',
            // Error strings
            'error_data_load'        => 'Could not load Pokemon data. Please refresh the page.',
            'error_select_pokemon'   => 'Please select a Pokemon.',
            'error_invalid_iv'       => 'IV values must be between 0 and 15.',
            'error_invalid_level'    => 'Level must be between 1 and 50.',
            'error_no_results'       => 'No Pokemon found matching your search.',
            'error_calculation'      => 'Calculation error. Please check your inputs.',
            'error_bulk_empty'       => 'Please add at least one Pokemon to the bulk checker.',
            // SEO content
            'meta_title'             => 'Pokemon GO IV Calculator | Check IVs Instantly',
            'meta_desc'              => 'Use our free Pokemon GO IV calculator to find your Pokemon\'s exact Attack, Defense and Stamina IVs, IV percentage, CP at every level and PvP league ratings.',
            'intro_title'            => 'Pokemon GO IV Calculator — Find Your Pokemon\'s Hidden Stats',
            'intro_content'          => '<p>The <strong>Pokemon GO IV calculator</strong> reveals the hidden Individual Values behind every Pokemon you catch — the Attack, Defense, and Stamina scores (each 0–15) that determine how strong your Pokemon truly is, regardless of CP. IVs are fixed at capture and cannot be changed, making them the single most important factor when selecting raid attackers, PvP picks, and Pokemon worth powering up to Level 50.</p><p>A 100% IV Pokemon has 15 in all three stats — the theoretical ceiling — while a 0% IV Pokemon scores zero across the board. In practice, anything above 80% is generally worth investing Stardust in for PvP, while raid meta Pokemon ideally need 90%+ to stay competitive at the top level. Check the <a href="https://pokemoncalculator.online/en/pokemon-go-cp-calculator/">CP calculator</a> to see exactly how much CP your Pokemon will reach after powering up, and use the <a href="https://pokemoncalculator.online/en/stardust-calculator/">Stardust calculator</a> to plan your upgrade costs before committing resources.</p><p>IVs interact directly with the CP Multiplier (CPM) at each level to determine final Combat Power, Hit Points, and battle performance. A perfect 15/15/15 Mewtwo at Level 40 reaches 4178 CP — versus a 10/10/10 Mewtwo hitting only 3982 CP — a difference that matters in difficult raids and Master League battles. Use the <strong>Pokemon GO IV calculator above</strong> to instantly reveal every stat, PvP rank, and level-by-level CP table for any Pokemon in your collection. Browse all our tools at the <a href="https://pokemoncalculator.online/calculators/">Pokemon calculators hub</a>.</p>',
            'howto_title'            => 'How to Use the Pokemon GO IV Calculator',
            'howto_step1'            => 'Type your Pokemon\'s name in the <strong>Search Pokemon</strong> box — results appear as you type. Click your Pokemon\'s name to select it. The sprite, type badges, and base stats load automatically.',
            'howto_step2'            => 'Enter your Pokemon\'s <strong>Attack IV</strong>, <strong>Defense IV</strong>, and <strong>Stamina IV</strong> (each 0–15). If you have appraised your Pokemon in-game, use the Appraisal tab to input your Team Leader\'s arrow ratings instead — the calculator narrows down possible IVs automatically.',
            'howto_step3'            => 'Set the <strong>Level</strong> slider to your Pokemon\'s current level. You can find the exact level by checking the arc above your Pokemon in-game — it moves from Level 1 (far left) to your trainer level +10 (far right). Half-levels are supported (e.g. 20.5).',
            'howto_step4'            => 'Hit <strong>Calculate IVs</strong>. The results card instantly shows IV percentage, star rating, CP and HP at the current level, PvP league ratings for Great, Ultra and Master League, best moveset DPS, and a full CP table across every level from 1 to 50.',
            'info_title'             => 'How IVs Are Calculated in Pokemon GO — Formula, Context & Strategy',
            'info_content'           => '<p>Individual Values in Pokemon GO work differently from the main-series games. Rather than six stats, Pokemon GO uses three: <strong>Attack</strong>, <strong>Defense</strong>, and <strong>Stamina</strong>. Each ranges from 0 to 15, giving 16 × 16 × 16 = 4,096 possible IV combinations per Pokemon species. The calculator above checks all combinations against your input to return the exact result.</p><h3>The CP Formula</h3><p>Combat Power is not a direct stat — it is a composite value derived from base stats, IVs, and the CP Multiplier (CPM) at the Pokemon\'s current level. The official formula is:</p><p><strong>CP = (BaseAtk + IVAtk) × √(BaseDef + IVDef) × √(BaseSta + IVSta) × CPM² ÷ 10</strong></p><p>The CPM is a level-dependent scalar value that increases from 0.094 at Level 1 to 0.8403 at Level 40 and 0.8740 at Level 50. This is why powering up a Pokemon raises its CP even without changing the IVs — the multiplier grows. Verify any result instantly with the <strong>IV calculator above</strong>.</p><h3>Why IVs Matter (and When They Don\'t)</h3><p>For casual play and raids below Level 5 difficulty, IVs have minimal impact — a 51% Pokemon can still win Tier 1 raids. The difference becomes significant in three scenarios: <strong>Master League PvP</strong> (where you fight at full CP and a 15/15/15 is always better), <strong>high-level raids</strong> (where a 100% attacker saves a few seconds off the clock), and <strong>friendship-powered duo raids</strong> (where every stat point counts).</p><p>For <strong>Great League</strong> (CP cap 1500) and <strong>Ultra League</strong> (CP cap 2500), the meta is counterintuitive: <em>low Attack IVs are often better</em>. Because CP is weighted more heavily toward Attack in the formula, a lower Attack IV lets you power a Pokemon to a higher level within the CP cap — gaining more Defense and Stamina stat product than a 15 Attack IV version at the same CP ceiling. This is why a 0/15/15 Medicham can outperform a 15/15/15 in Great League.</p><h3>Common Misconceptions</h3><p>Many players assume a shiny Pokemon has better IVs — it does not. Shininess and IVs are completely independent. Similarly, Lucky Pokemon obtained through trading are guaranteed a minimum of 12 in all three IVs, but they are not guaranteed 15/15/15. Purified Pokemon receive a +2 IV bonus applied before the 15 cap — so a 13/13/13 shadow becomes 15/15/15 when purified, making mid-IV shadows worth keeping.</p><p>Weather-boosted catches also have a minimum IV floor of 4 in all three stats. Research breakthrough and raid boss catches start at a minimum of 10/10/10. Eggs and hatches have a minimum of 10/10/10 as well. Knowing these floors helps you quickly reject or keep Pokemon without needing a calculator every time.</p><p>Use the <a href="https://pokemoncalculator.online/en/stardust-calculator/">Stardust cost calculator</a> before powering up to understand exactly how many Stardust and Candy you\'ll spend reaching your target level. Check the <a href="https://pokemoncalculator.online/en/type-chart/">type chart</a> to confirm your Pokemon\'s battle matchup advantage after finalising your IV picks.</p>',
            'info_table_title'       => 'CP Multiplier (CPM) Values by Level — Pokemon GO',
            'info_table_html'        => '<table class="pkm-calc-table"><thead><tr><th>Level</th><th>CPM Value</th><th>Notes</th></tr></thead><tbody><tr><td>1</td><td>0.09399999</td><td>Starting level (wild catch)</td></tr><tr><td>5</td><td>0.29024988</td><td>Common wild catch range</td></tr><tr><td>10</td><td>0.42250001</td><td>Early trainer range</td></tr><tr><td>15</td><td>0.51739395</td><td>Mid-level catch</td></tr><tr><td>20</td><td>0.59740001</td><td>Weather boost minimum floor</td></tr><tr><td>25</td><td>0.66999996</td><td>Typical powered-up range</td></tr><tr><td>30</td><td>0.73415995</td><td>Common powered-up cap (budget)</td></tr><tr><td>35</td><td>0.78279999</td><td>Raid attacker sweet spot</td></tr><tr><td>40</td><td>0.79030001</td><td>Standard level cap (pre-XL)</td></tr><tr><td>41</td><td>0.81073600</td><td>XL Candy required (Level 41+)</td></tr><tr><td>45</td><td>0.82058400</td><td>XL power-up mid-range</td></tr><tr><td>50</td><td>0.84029999</td><td>Max level (Lv 40 trainer required)</td></tr><tr><td>50.5</td><td>0.84029999</td><td>Max with Best Buddy boost (+1 effective level)</td></tr></tbody></table>',
            'faq_title'              => 'Pokemon GO IV Calculator — Frequently Asked Questions',
            'faq_q1' => 'How do I calculate IVs in Pokemon GO?',
            'faq_a1' => 'To calculate IVs in Pokemon GO, enter your Pokemon\'s species, its Attack, Defense and Stamina IV values (0–15 each), and its current level into the IV calculator above. The tool applies the official CP formula — <em>(BaseAtk + IVAtk) × √(BaseDef + IVDef) × √(BaseSta + IVSta) × CPM² ÷ 10</em> — to instantly return the IV percentage, star rating, CP, HP and PvP league rankings. You can also use the Appraisal tab and enter your in-game Team Leader arrow ratings to auto-narrow the possible IV combinations.',
            'faq_q2' => 'What is a good IV percentage in Pokemon GO?',
            'faq_a2' => 'A good IV percentage in Pokemon GO depends on your goal. For raids and Master League PvP, 90–100% (3-star rating) is ideal. For Great League and Ultra League, IV strategy is more complex — lower Attack IVs are sometimes better because they let you reach a higher level within the CP cap, increasing total stat product. For casual play and gym battling, anything above 66% (2-star) is perfectly usable and not worth spending extra Stardust to replace.',
            'faq_q3' => 'What does 0* 1* 2* 3* mean in Pokemon GO?',
            'faq_a3' => 'The star rating in Pokemon GO is assigned by your Team Leader during appraisal and reflects your Pokemon\'s IV percentage tier. 0★ means 0–48.9% IVs (below 22/45 total IV points), 1★ covers 51.1–64.4% (23–29 total), 2★ covers 66.7–80% (30–36 total), and 3★ covers 82.2–98% (37–44 total). A special red background with 3 stars indicates a perfect 100% (15/15/15) Pokemon. The IV calculator above shows the exact percentage alongside the star rating.',
            'faq_q4' => 'Can IVs be changed in Pokemon GO?',
            'faq_a4' => 'IVs cannot be changed after a Pokemon is caught — with two exceptions. <strong>Purifying a Shadow Pokemon</strong> adds +2 to each IV (capped at 15), so a 13/13/13 Shadow becomes a perfect 15/15/15 after purification. <strong>Trading</strong> rerolls the IVs of both traded Pokemon — a Lucky Trade guarantees a minimum of 12 in all three stats. There is no other mechanic to alter IVs, and Stardust, Candy, or evolution have no effect on IV values.',
            'faq_q5' => 'What is the difference between IV% and CP in Pokemon GO?',
            'faq_a5' => 'IV% reflects the genetic quality of a Pokemon — how close its hidden Attack, Defense and Stamina stats are to the perfect 15/15/15 maximum. CP (Combat Power) is the visible strength number that combines base stats, IVs, and the level-based CP Multiplier into one value. A high-IV Pokemon at a low level can have lower CP than a low-IV Pokemon that has been powered up. The IV calculator shows both values simultaneously so you can evaluate both quality and current power at a glance.',
            'faq_q6' => 'Does weather boost affect IV values in Pokemon GO?',
            'faq_a6' => 'Weather boost does not change a Pokemon\'s IVs — but weather-boosted catches are guaranteed a minimum floor of IV 4 in all three stats. This means the lowest possible weather-boosted Pokemon has 4/4/4 IVs (roughly 26.7%), eliminating the worst 0-IV outcomes. Weather-boosted wild catches also appear at Level 6 minimum rather than Level 1–35 range, and they award extra Stardust when caught. The IV calculator fully supports weather-boosted Pokemon — just enter the actual IV values shown after appraisal.',
            'faq_q7' => 'How many IV combinations are possible per Pokemon in Pokemon GO?',
            'faq_a7' => 'Each Pokemon has 4,096 possible IV combinations (16 Attack values × 16 Defense values × 16 Stamina values). Of these, only one combination is 100% perfect (15/15/15), and 48 combinations score 98% or above. The probability of catching a 100% IV Pokemon from a standard wild encounter is 1/4096 (approximately 0.024%). For raid bosses and research breakthroughs, the minimum IV floor is 10/10/10, giving 1,296 possible combinations — making the 100% odds 1/216 (approximately 0.46%).',
            'faq_q8' => 'Should I power up a Pokemon before checking its IVs?',
            'faq_a8' => 'It is best practice to check IVs <em>before</em> spending Stardust and Candy to power up. Powering up a Pokemon does not change its IVs — the IV values are fixed at the time of capture. However, if a Pokemon has already been powered up, you can still calculate its IVs accurately using the current level in the calculator. Use the <strong>IV calculator above</strong> to evaluate any Pokemon before committing resources, and cross-reference with the Stardust calculator to estimate the total upgrade cost to your target level.',
            'related_title'    => 'Related Pokemon Calculators',
            'no_related_tools' => 'No related tools yet. More calculators coming soon!',
            'blog_guides_title'=> 'Pokemon Guides &amp; Tips',
            'blog_read_more'   => 'Read guide',
        ],
        'es' => [
            'title'                  => 'Calculadora IV Pokemon GO',
            'description'            => 'Calcula los IVs exactos de tu Pokemon, el porcentaje IV, CP en cada nivel y valoraciones PvP al instante.',
            'tab_simple'             => 'Simple',
            'tab_advanced'           => 'Avanzado',
            'tab_bulk'               => 'Múltiple',
            'select_pokemon'         => 'Buscar Pokemon...',
            'attack_iv_label'        => 'IV Ataque',
            'defense_iv_label'       => 'IV Defensa',
            'stamina_iv_label'       => 'IV Resistencia',
            'level_label'            => 'Nivel',
            'calculate_btn'          => 'Calcular IVs',
            'reset_btn'              => 'Reiniciar',
            'copy_btn'               => 'Copiar Resultados',
            'copied_btn'             => '¡Copiado!',
            'appraisal_label'        => 'Valoración',
            'appraisal_hint'         => 'Selecciona las flechas de valoración de tu Líder de Equipo',
            'appraisal_atk'          => 'Ataque',
            'appraisal_def'          => 'Defensa',
            'appraisal_sta'          => 'Resistencia',
            'result_iv_pct'          => 'Puntuación IV',
            'result_cp'              => 'Puntos de Combate',
            'result_hp'              => 'Puntos de Vida',
            'result_level'           => 'Nivel',
            'result_rating'          => 'Valoración',
            'result_rank'            => 'Rango',
            'pvp_title'              => 'Valoraciones Liga PvP',
            'pvp_great'              => 'Liga Súper',
            'pvp_ultra'              => 'Liga Ultra',
            'pvp_master'             => 'Liga Maestra',
            'pvp_cp_cap'             => 'CP Máx.',
            'pvp_best_cp'            => 'Mejor CP',
            'pvp_best_level'         => 'Mejor Nivel',
            'moveset_title'          => 'Mejor Moveset',
            'moveset_fast'           => 'Ataque Rápido',
            'moveset_charged'        => 'Ataque Cargado',
            'moveset_dps'            => 'DPS',
            'moveset_type'           => 'Tipo',
            'cp_table_title'         => 'CP en Cada Nivel',
            'cp_table_show'          => 'Ver Tabla de Niveles',
            'cp_table_hide'          => 'Ocultar Tabla',
            'cp_table_level'         => 'Nivel',
            'cp_table_cp'            => 'CP',
            'cp_table_hp'            => 'PS',
            'bulk_add_btn'           => 'Agregar Pokemon',
            'bulk_calc_btn'          => 'Calcular Todo',
            'bulk_clear_btn'         => 'Limpiar Todo',
            'bulk_copy_btn'          => 'Copiar Resultados',
            'bulk_rank_col'          => '#',
            'bulk_pokemon_col'       => 'Pokemon',
            'bulk_ivs_col'           => 'IVs',
            'bulk_iv_pct_col'        => 'IV%',
            'bulk_cp_col'            => 'CP',
            'bulk_rating_col'        => 'Valoración',
            'bulk_placeholder'       => 'Añade hasta 6 Pokemon arriba y pulsa Calcular Todo.',
            'rating_100'             => '100% — ¡Perfecto!',
            'rating_98'              => '98% — Afortunado',
            'rating_above_90'        => 'Excelente',
            'rating_above_80'        => 'Genial',
            'rating_above_66'        => 'Bueno',
            'rating_below_66'        => 'No Está Mal',
            'stars_3'                => '3★ Perfecto',
            'stars_2'                => '2★ Genial',
            'stars_1'                => '1★ Bueno',
            'stars_0'                => '0★',
            'hp_label'               => 'PS',
            'cp_label'               => 'PC',
            'error_data_load'        => 'No se pudieron cargar los datos de Pokemon. Por favor recarga la página.',
            'error_select_pokemon'   => 'Por favor selecciona un Pokemon.',
            'error_invalid_iv'       => 'Los valores IV deben estar entre 0 y 15.',
            'error_invalid_level'    => 'El nivel debe estar entre 1 y 50.',
            'error_no_results'       => 'No se encontraron Pokemon con esa búsqueda.',
            'error_calculation'      => 'Error de cálculo. Por favor verifica tus datos.',
            'error_bulk_empty'       => 'Por favor añade al menos un Pokemon al verificador múltiple.',
            'meta_title'       => 'Calculadora IV Pokemon GO | Revela tus IVs al Instante',
            'meta_desc'        => 'Descubre los IVs exactos de tu Pokemon en Pokemon GO: Ataque, Defensa y Resistencia, porcentaje IV, PC por nivel y clasificaciones PvP. Gratis y sin registro.',
            'intro_title'      => 'Calculadora IV Pokemon GO — Descubre los Stats Ocultos de tu Pokemon',
            'intro_content'    => '<p>La <strong>calculadora IV de Pokemon GO</strong> revela los Valores Individuales ocultos de cada Pokemon que capturas — las puntuaciones de Ataque, Defensa y Resistencia (cada una entre 0 y 15) que determinan la fuerza real de tu Pokemon, independientemente de los PC. Los IVs se fijan en el momento de la captura y no pueden modificarse, lo que los convierte en el factor más importante a la hora de elegir atacantes para incursiones, selecciones PvP y Pokemon que vale la pena potenciar.</p><p>En el meta competitivo de LatAm, los jugadores de la Liga Súper buscan Pokemon con IVs bajos en Ataque para poder subirlos de nivel al máximo dentro del límite de 1500 PC. Un Garchomp con 0/15/15 de IVs, por ejemplo, alcanza un nivel más alto dentro del tope de la Liga Ultra que uno con 15/15/15, ganando más producto de estadísticas totales. Verifica los costos de mejora con la <a href="https://pokemoncalculator.online/es/calculadora-polvo-estelar/">calculadora de Polvo Estelar</a> antes de invertir recursos, y consulta la <a href="https://pokemoncalculator.online/es/calculadora-cp-pokemon/">calculadora de PC</a> para proyectar el PC final de tu Pokemon a cada nivel.</p><p>La diferencia entre un Pokemon al 100% de IVs y uno al 80% puede parecer pequeña en términos de PC, pero en incursiones de nivel 5 y en combates de la Liga Maestra marca la diferencia entre derrotar al jefe o quedarse segundos corto. Usa la <strong>calculadora IV de arriba</strong> para analizar cualquier Pokemon de tu colección de forma inmediata y decidir cuál merece tus Polvos Estelares.</p>',
            'howto_title'      => 'Cómo Usar la Calculadora IV de Pokemon GO',
            'howto_step1'      => 'Escribe el nombre de tu Pokemon en el campo <strong>Buscar Pokemon</strong>. Los resultados aparecen mientras escribes — haz clic en el nombre de tu Pokemon para seleccionarlo. El sprite, las insignias de tipo y las estadísticas base se cargan automáticamente.',
            'howto_step2'      => 'Ingresa el <strong>IV de Ataque</strong>, el <strong>IV de Defensa</strong> y el <strong>IV de Resistencia</strong> de tu Pokemon (cada uno entre 0 y 15). Si ya lo has valorado en el juego, usa la pestaña Valoración para introducir las flechas de tu Líder de Equipo y la calculadora acotará los posibles IVs.',
            'howto_step3'      => 'Ajusta el control deslizante de <strong>Nivel</strong> al nivel actual de tu Pokemon. Puedes identificar el nivel exacto observando el arco sobre tu Pokemon en el juego — va del nivel 1 (extremo izquierdo) hasta tu nivel de entrenador +10 (extremo derecho). Se admiten medios niveles como 20,5.',
            'howto_step4'      => 'Pulsa <strong>Calcular IVs</strong>. El panel de resultados muestra al instante el porcentaje de IV, la calificación con estrellas, los PC y PS en el nivel actual, las valoraciones PvP para la Liga Súper, Ultra y Maestra, el DPS del mejor moveset y la tabla completa de PC por nivel del 1 al 50.',
            'info_title'       => 'Cómo se Calculan los IVs en Pokemon GO — Fórmula, Contexto y Estrategia',
            'info_content'     => '<p>Los Valores Individuales en Pokemon GO funcionan de manera diferente a los juegos principales. En lugar de seis estadísticas, Pokemon GO utiliza tres: <strong>Ataque</strong>, <strong>Defensa</strong> y <strong>Resistencia</strong>. Cada una va de 0 a 15, lo que genera 16 × 16 × 16 = 4.096 combinaciones posibles de IV por especie.</p><h3>La Fórmula de PC</h3><p>Los Puntos de Combate no son una estadística directa — son un valor compuesto derivado de las estadísticas base, los IVs y el Multiplicador de PC (CPM) en el nivel actual del Pokemon. La fórmula oficial es:</p><p><strong>PC = (AtkBase + IVAtk) × √(DefBase + IVDef) × √(StaBase + IVSta) × CPM² ÷ 10</strong></p><p>El CPM es un valor escalar dependiente del nivel que aumenta de 0,094 en el Nivel 1 hasta 0,8403 en el Nivel 40 y 0,8740 en el Nivel 50. Por eso subir de nivel a un Pokemon aumenta sus PC aunque los IVs no cambien. Verifica cualquier resultado con la <strong>calculadora IV de arriba</strong>.</p><h3>Por Qué Importan los IVs (y Cuándo No)</h3><p>Para el juego casual e incursiones de dificultad baja, los IVs tienen un impacto mínimo. La diferencia se vuelve importante en tres situaciones: la <strong>Liga Maestra PvP</strong> (donde combates al PC máximo y un 15/15/15 siempre es mejor), las <strong>incursiones de alto nivel</strong> (donde un atacante al 100% ahorra segundos en el reloj), y los combates de amistad en <strong>dúos</strong> (donde cada punto de estadística importa).</p><p>Para la <strong>Liga Súper</strong> (límite 1500 PC) y la <strong>Liga Ultra</strong> (límite 2500 PC), la estrategia es contraintuitiva: <em>los IVs bajos en Ataque suelen ser mejores</em>. Como el Ataque tiene más peso en la fórmula de PC, un IV de Ataque más bajo te permite subir de nivel al Pokemon más alto dentro del límite de PC, ganando más producto de estadísticas de Defensa y Resistencia. Por eso un Medicham con 0/15/15 supera a uno con 15/15/15 en la Liga Súper.</p><h3>Errores Comunes</h3><p>Muchos jugadores creen que los Pokemon shiny tienen mejores IVs — no es así. El brillo y los IVs son completamente independientes. Del mismo modo, los Pokemon Suertudos obtenidos mediante intercambio tienen garantizado un mínimo de 12 en los tres IVs, pero no necesariamente 15/15/15. Los Pokemon Purificados reciben un bono de +2 en cada IV (hasta un máximo de 15) — lo que hace que las sombras con IVs medios valgan la pena conservar.</p><p>Las capturas potenciadas por el clima tienen un IV mínimo de 4 en las tres estadísticas. Las capturas de jefes de incursión y avances de investigación comienzan en un mínimo de 10/10/10. Los huevos también tienen el mismo piso. Conocer estos mínimos te ayuda a filtrar Pokemon rápidamente sin necesitar la calculadora cada vez.</p><p>Usa la <a href="https://pokemoncalculator.online/es/calculadora-polvo-estelar/">calculadora de Polvo Estelar</a> antes de potenciar para entender cuántos Polvos Estelares y Caramelos gastarás para alcanzar tu nivel objetivo. Consulta la <a href="https://pokemoncalculator.online/es/tabla-de-tipos/">tabla de tipos</a> para confirmar las ventajas de combate de tu Pokemon tras elegir los mejores IVs.</p>',
            'info_table_title' => 'Valores del Multiplicador de PC (CPM) por Nivel — Pokemon GO',
            'info_table_html'  => '<table class="pkm-calc-table"><thead><tr><th>Nivel</th><th>Valor CPM</th><th>Notas</th></tr></thead><tbody><tr><td>1</td><td>0,09399999</td><td>Nivel inicial (captura salvaje)</td></tr><tr><td>5</td><td>0,29024988</td><td>Rango habitual de capturas salvajes</td></tr><tr><td>10</td><td>0,42250001</td><td>Rango de entrenador inicial</td></tr><tr><td>15</td><td>0,51739395</td><td>Captura de nivel medio</td></tr><tr><td>20</td><td>0,59740001</td><td>Mínimo de captura con boost de clima</td></tr><tr><td>25</td><td>0,66999996</td><td>Rango típico de pokémon potenciados</td></tr><tr><td>30</td><td>0,73415995</td><td>Límite habitual para equipos económicos</td></tr><tr><td>35</td><td>0,78279999</td><td>Punto óptimo para atacantes de incursión</td></tr><tr><td>40</td><td>0,79030001</td><td>Límite de nivel estándar (antes de caramelos XL)</td></tr><tr><td>41</td><td>0,81073600</td><td>Se requieren Caramelos XL (Nivel 41+)</td></tr><tr><td>45</td><td>0,82058400</td><td>Rango medio de potenciación XL</td></tr><tr><td>50</td><td>0,84029999</td><td>Nivel máximo (requiere entrenador Nivel 40)</td></tr><tr><td>50,5</td><td>0,84029999</td><td>Máximo con bonus Mejor Amigo (+1 nivel efectivo)</td></tr></tbody></table>',
            'faq_title'        => 'Calculadora IV Pokemon GO — Preguntas Frecuentes',
            'faq_q1' => '¿Cómo se calculan los IVs en Pokemon GO?',
            'faq_a1' => 'Para calcular los IVs en Pokemon GO, ingresa la especie de tu Pokemon, sus valores de IV de Ataque, Defensa y Resistencia (0–15 cada uno) y su nivel actual en la calculadora de arriba. La herramienta aplica la fórmula oficial de PC — <em>(AtkBase + IVAtk) × √(DefBase + IVDef) × √(StaBase + IVSta) × CPM² ÷ 10</em> — para mostrar al instante el porcentaje de IV, la calificación con estrellas, los PC, PS y clasificaciones de liga PvP. También puedes usar la pestaña Valoración para ingresar las flechas de tu Líder de Equipo.',
            'faq_q2' => '¿Qué porcentaje de IVs es bueno en Pokemon GO?',
            'faq_a2' => 'Un buen porcentaje de IVs en Pokemon GO depende de tu objetivo. Para incursiones y la Liga Maestra, lo ideal es entre 90–100% (calificación de 3 estrellas). Para la Liga Súper y Ultra, la estrategia es más compleja — IVs bajos en Ataque pueden ser mejores porque permiten subir de nivel al Pokemon más alto dentro del límite de PC, incrementando el producto total de estadísticas. Para el juego casual, cualquier Pokemon con más del 66% (2 estrellas) es perfectamente funcional y no justifica gastar más Polvos Estelares para reemplazarlo.',
            'faq_q3' => '¿Qué significa 0★ 1★ 2★ 3★ en Pokemon GO?',
            'faq_a3' => 'La calificación con estrellas en Pokemon GO la asigna tu Líder de Equipo durante la valoración y refleja el rango de porcentaje de IVs de tu Pokemon. 0★ significa 0–48,9% de IVs, 1★ cubre 51,1–64,4%, 2★ cubre 66,7–80% y 3★ cubre 82,2–98%. Un fondo rojo especial con 3 estrellas indica un Pokemon perfecto al 100% (15/15/15). La calculadora IV de arriba muestra el porcentaje exacto junto con la calificación de estrellas.',
            'faq_q4' => '¿Se pueden cambiar los IVs en Pokemon GO?',
            'faq_a4' => 'Los IVs no se pueden cambiar después de capturar un Pokemon, con dos excepciones. <strong>Purificar un Pokemon Sombra</strong> añade +2 a cada IV (máximo 15), por lo que un Sombra con 13/13/13 se convierte en 15/15/15 al purificarlo. El <strong>intercambio</strong> relanza los IVs de ambos Pokemon — un Intercambio Suertudo garantiza un mínimo de 12 en los tres stats. No existe otro mecanismo para alterar los IVs, y los Polvos Estelares, Caramelos o la evolución no tienen ningún efecto.',
            'faq_q5' => '¿Cuál es la diferencia entre IV% y PC en Pokemon GO?',
            'faq_a5' => 'El IV% refleja la calidad genética de un Pokemon — qué tan cerca están sus estadísticas ocultas del máximo 15/15/15. Los PC (Puntos de Combate) son el número de fuerza visible que combina estadísticas base, IVs y el Multiplicador de PC según el nivel en un solo valor. Un Pokemon con IVs altos a nivel bajo puede tener menos PC que uno con IVs bajos pero muy potenciado. La calculadora IV muestra ambos valores simultáneamente para que puedas evaluar tanto la calidad como el poder actual de un vistazo.',
            'faq_q6' => '¿Afecta el clima a los IVs de los Pokemon en Pokemon GO?',
            'faq_a6' => 'El clima no cambia los IVs de un Pokemon, pero las capturas potenciadas por el clima tienen garantizado un IV mínimo de 4 en las tres estadísticas. Esto significa que el peor Pokemon con boost de clima posible tiene IVs de 4/4/4 (aproximadamente 26,7%), eliminando los resultados de 0 IV. Las capturas salvajes con boost de clima también aparecen desde el Nivel 6 en adelante como mínimo, en lugar del rango habitual de Nivel 1–35. La calculadora IV admite perfectamente los Pokemon con boost de clima — solo ingresa los valores IV reales que aparecen tras la valoración.',
            'faq_q7' => '¿Cuántas combinaciones de IVs son posibles por Pokemon en Pokemon GO?',
            'faq_a7' => 'Cada Pokemon tiene 4.096 combinaciones posibles de IVs (16 valores de Ataque × 16 de Defensa × 16 de Resistencia). De estas, solo una combinación es perfecta al 100% (15/15/15), y 48 combinaciones alcanzan el 98% o más. La probabilidad de capturar un Pokemon con IVs al 100% en un encuentro salvaje estándar es de 1/4096 (aproximadamente 0,024%). Para jefes de incursión y avances de investigación, el piso mínimo de IV es 10/10/10, con 1.296 combinaciones posibles — haciendo que la probabilidad del 100% sea de 1/216 (aproximadamente 0,46%).',
            'faq_q8' => '¿Debo potenciar un Pokemon antes de revisar sus IVs?',
            'faq_a8' => 'Es una buena práctica revisar los IVs <em>antes</em> de gastar Polvos Estelares y Caramelos en potenciar. Subir de nivel a un Pokemon no cambia sus IVs — los valores están fijos desde el momento de la captura. Sin embargo, si ya has potenciado un Pokemon, igualmente puedes calcular sus IVs con precisión usando el nivel actual en la calculadora. Usa la <strong>calculadora IV de arriba</strong> para evaluar cualquier Pokemon antes de comprometer recursos, y crúzalo con la calculadora de Polvo Estelar para estimar el costo total hasta tu nivel objetivo.',
            'related_title'    => 'Calculadoras Pokemon Relacionadas',
            'no_related_tools' => 'Aún no hay herramientas relacionadas. ¡Pronto más calculadoras!',
            'blog_guides_title'=> 'Guías y Consejos Pokemon',
            'blog_read_more'   => 'Leer guía',
        ],
        'pt-br' => [
            'title'                  => 'Calculadora IV Pokemon GO',
            'description'            => 'Calcule os IVs exatos do seu Pokemon, porcentagem IV, CP em cada nível e avaliações PvP instantaneamente.',
            'tab_simple'             => 'Simples',
            'tab_advanced'           => 'Avançado',
            'tab_bulk'               => 'Em Massa',
            'select_pokemon'         => 'Buscar Pokemon...',
            'attack_iv_label'        => 'IV Ataque',
            'defense_iv_label'       => 'IV Defesa',
            'stamina_iv_label'       => 'IV Resistência',
            'level_label'            => 'Nível',
            'calculate_btn'          => 'Calcular IVs',
            'reset_btn'              => 'Resetar',
            'copy_btn'               => 'Copiar Resultados',
            'copied_btn'             => 'Copiado!',
            'appraisal_label'        => 'Avaliação',
            'appraisal_hint'         => 'Selecione as setas de avaliação do seu Líder de Equipe',
            'appraisal_atk'          => 'Ataque',
            'appraisal_def'          => 'Defesa',
            'appraisal_sta'          => 'Resistência',
            'result_iv_pct'          => 'Pontuação IV',
            'result_cp'              => 'Pontos de Combate',
            'result_hp'              => 'Pontos de Vida',
            'result_level'           => 'Nível',
            'result_rating'          => 'Avaliação',
            'result_rank'            => 'Rank',
            'pvp_title'              => 'Avaliações PvP',
            'pvp_great'              => 'Liga Super',
            'pvp_ultra'              => 'Liga Ultra',
            'pvp_master'             => 'Liga Mestre',
            'pvp_cp_cap'             => 'CP Máx.',
            'pvp_best_cp'            => 'Melhor CP',
            'pvp_best_level'         => 'Melhor Nível',
            'moveset_title'          => 'Melhor Moveset',
            'moveset_fast'           => 'Golpe Rápido',
            'moveset_charged'        => 'Golpe Carregado',
            'moveset_dps'            => 'DPS',
            'moveset_type'           => 'Tipo',
            'cp_table_title'         => 'CP em Cada Nível',
            'cp_table_show'          => 'Ver Tabela de Níveis',
            'cp_table_hide'          => 'Ocultar Tabela',
            'cp_table_level'         => 'Nível',
            'cp_table_cp'            => 'CP',
            'cp_table_hp'            => 'PV',
            'bulk_add_btn'           => 'Adicionar Pokemon',
            'bulk_calc_btn'          => 'Calcular Tudo',
            'bulk_clear_btn'         => 'Limpar Tudo',
            'bulk_copy_btn'          => 'Copiar Resultados',
            'bulk_rank_col'          => '#',
            'bulk_pokemon_col'       => 'Pokemon',
            'bulk_ivs_col'           => 'IVs',
            'bulk_iv_pct_col'        => 'IV%',
            'bulk_cp_col'            => 'CP',
            'bulk_rating_col'        => 'Avaliação',
            'bulk_placeholder'       => 'Adicione até 6 Pokemon acima e clique em Calcular Tudo.',
            'rating_100'             => '100% — Perfeito!',
            'rating_98'              => '98% — Sortudo',
            'rating_above_90'        => 'Excelente',
            'rating_above_80'        => 'Ótimo',
            'rating_above_66'        => 'Bom',
            'rating_below_66'        => 'Não Está Mal',
            'stars_3'                => '3★ Perfeito',
            'stars_2'                => '2★ Ótimo',
            'stars_1'                => '1★ Bom',
            'stars_0'                => '0★',
            'hp_label'               => 'PV',
            'cp_label'               => 'PC',
            'error_data_load'        => 'Não foi possível carregar os dados do Pokemon. Por favor atualize a página.',
            'error_select_pokemon'   => 'Por favor selecione um Pokemon.',
            'error_invalid_iv'       => 'Os valores de IV devem estar entre 0 e 15.',
            'error_invalid_level'    => 'O nível deve estar entre 1 e 50.',
            'error_no_results'       => 'Nenhum Pokemon encontrado com essa busca.',
            'error_calculation'      => 'Erro de cálculo. Por favor verifique seus dados.',
            'error_bulk_empty'       => 'Por favor adicione pelo menos um Pokemon ao verificador em massa.',
            'meta_title'       => 'Calculadora de IV Pokemon GO | Descubra seus IVs',
            'meta_desc'        => 'Calcule os IVs exatos do seu Pokemon GO: Ataque, Defesa e Resistência, porcentagem IV, PC por nível e notas PvP. Ferramenta gratuita sem cadastro.',
            'intro_title'      => 'Calculadora de IV Pokemon GO — Descubra as Stats Ocultas do seu Pokemon',
            'intro_content'    => '<p>A <strong>calculadora de IV do Pokemon GO</strong> revela os Valores Individuais escondidos de cada Pokemon que você captura — as pontuações de Ataque, Defesa e Resistência (de 0 a 15 cada) que determinam a força real do seu Pokemon, independente dos PC. Os IVs são definidos no momento da captura e não podem ser alterados, tornando-os o fator mais importante ao selecionar atacantes para reides, escolhas de PvP e Pokemon que valem a pena fortalecer.</p><p>Na comunidade brasileira de Pokemon GO — muito ativa nos grupos do Facebook e WhatsApp — uma das dúvidas mais frequentes é exatamente como interpretar os IVs e para qual liga cada Pokemon serve melhor. Um Machamp com IVs altos é excelente para reides de Nível 5, mas para a Liga Super (limite de 1500 PC), você precisa de IVs de Ataque mais baixos para subir de nível dentro do limite. Antes de fortalecer qualquer Pokemon, confira os custos com a <a href="https://pokemoncalculator.online/pt-br/calculadora-po-estelar/">calculadora de Pó Estelar</a> e projete o PC final com a <a href="https://pokemoncalculator.online/pt-br/calculadora-pc-pokemon/">calculadora de PC</a>.</p><p>A diferença entre um Pokemon com 100% de IVs e um com 80% pode parecer pequena em termos de PC, mas em reides difíceis e batalhas da Liga Mestre essa diferença pode ser decisiva. Use a <strong>calculadora de IV acima</strong> para analisar qualquer Pokemon da sua coleção e decidir em quem vale a pena investir seu Pó Estelar.</p>',
            'howto_title'      => 'Como Usar a Calculadora de IV do Pokemon GO',
            'howto_step1'      => 'Digite o nome do seu Pokemon no campo <strong>Buscar Pokemon</strong>. Os resultados aparecem enquanto você digita — clique no nome do Pokemon para selecioná-lo. O sprite, os badges de tipo e as stats base carregam automaticamente.',
            'howto_step2'      => 'Insira o <strong>IV de Ataque</strong>, o <strong>IV de Defesa</strong> e o <strong>IV de Resistência</strong> do seu Pokemon (de 0 a 15 cada). Se já fez a avaliação no jogo, use a aba Avaliação para inserir as setas do seu Líder de Equipe — a calculadora vai delimitar os IVs possíveis automaticamente.',
            'howto_step3'      => 'Ajuste o controle deslizante de <strong>Nível</strong> para o nível atual do seu Pokemon. Você pode identificar o nível exato observando o arco acima do seu Pokemon no jogo — ele vai do Nível 1 (extrema esquerda) até o nível do treinador +10 (extrema direita). Meios níveis como 20,5 são suportados.',
            'howto_step4'      => 'Clique em <strong>Calcular IVs</strong>. O painel de resultados mostra instantaneamente a porcentagem de IV, a classificação por estrelas, PC e PV no nível atual, classificações PvP para as Ligas Super, Ultra e Mestre, o DPS do melhor moveset e a tabela completa de PC por nível, do 1 ao 50.',
            'info_title'       => 'Como os IVs São Calculados no Pokemon GO — Fórmula, Contexto e Estratégia',
            'info_content'     => '<p>Os Valores Individuais no Pokemon GO funcionam de forma diferente dos jogos principais. Em vez de seis atributos, o Pokemon GO usa três: <strong>Ataque</strong>, <strong>Defesa</strong> e <strong>Resistência</strong>. Cada um varia de 0 a 15, gerando 16 × 16 × 16 = 4.096 combinações possíveis de IV por espécie.</p><h3>A Fórmula de PC</h3><p>Os Pontos de Combate não são uma stat direta — são um valor composto derivado das stats base, dos IVs e do Multiplicador de PC (CPM) no nível atual do Pokemon. A fórmula oficial é:</p><p><strong>PC = (AtkBase + IVAtk) × √(DefBase + IVDef) × √(StaBase + IVSta) × CPM² ÷ 10</strong></p><p>O CPM é um valor escalar dependente do nível que aumenta de 0,094 no Nível 1 para 0,8403 no Nível 40 e 0,8740 no Nível 50. Por isso fortalecer um Pokemon aumenta seus PC mesmo sem mudar os IVs — o multiplicador cresce. Verifique qualquer resultado com a <strong>calculadora de IV acima</strong>.</p><h3>Por Que os IVs Importam (e Quando Não Importam)</h3><p>Para o jogo casual e reides de dificuldade baixa, os IVs têm impacto mínimo. A diferença se torna significativa em três situações: a <strong>Liga Mestre PvP</strong> (onde você batalha no PC máximo e 15/15/15 é sempre melhor), os <strong>reides de alto nível</strong> (onde um atacante com 100% de IVs economiza segundos no timer), e os combates de dupla com amizade máxima onde cada ponto conta.</p><p>Para a <strong>Liga Super</strong> (limite de 1500 PC) e a <strong>Liga Ultra</strong> (limite de 2500 PC), a estratégia é contraintuitiva: <em>IVs de Ataque baixos costumam ser melhores</em>. Como o Ataque tem mais peso na fórmula de PC, um IV de Ataque mais baixo permite subir o Pokemon para um nível mais alto dentro do limite de PC, ganhando mais produto de stats de Defesa e Resistência. É por isso que um Medicham com 0/15/15 supera um 15/15/15 na Liga Super.</p><h3>Erros Comuns dos Jogadores</h3><p>Muitos jogadores acreditam que Pokemon shiny têm IVs melhores — não é verdade. Brilho e IVs são completamente independentes. Da mesma forma, Pokemon da Sorte obtidos por troca têm garantia de no mínimo 12 nos três IVs, mas não necessariamente 15/15/15. Pokemon Purificados recebem um bônus de +2 em cada IV (limitado a 15) — o que torna shadows com IVs médios valiosos de manter.</p><p>Capturas potenciadas pelo clima têm um IV mínimo de 4 nos três atributos. Capturas de chefes de reide e marcos de pesquisa começam com no mínimo 10/10/10. Ovos chocados também têm esse mesmo piso. Conhecer esses mínimos ajuda a filtrar Pokemon rapidamente sem precisar da calculadora toda vez.</p><p>Use a <a href="https://pokemoncalculator.online/pt-br/calculadora-po-estelar/">calculadora de Pó Estelar</a> antes de fortalecer para entender quantos Pós Estelares e Balas você vai gastar até o nível desejado. Confira a <a href="https://pokemoncalculator.online/pt-br/tabela-de-tipos/">tabela de tipos</a> para confirmar a vantagem de batalha do seu Pokemon após escolher os melhores IVs.</p>',
            'info_table_title' => 'Valores do Multiplicador de PC (CPM) por Nível — Pokemon GO',
            'info_table_html'  => '<table class="pkm-calc-table"><thead><tr><th>Nível</th><th>Valor CPM</th><th>Observações</th></tr></thead><tbody><tr><td>1</td><td>0,09399999</td><td>Nível inicial (captura selvagem)</td></tr><tr><td>5</td><td>0,29024988</td><td>Faixa comum de captura selvagem</td></tr><tr><td>10</td><td>0,42250001</td><td>Faixa de treinador iniciante</td></tr><tr><td>15</td><td>0,51739395</td><td>Captura de nível médio</td></tr><tr><td>20</td><td>0,59740001</td><td>Mínimo de captura com boost de clima</td></tr><tr><td>25</td><td>0,66999996</td><td>Faixa típica de Pokemon fortalecidos</td></tr><tr><td>30</td><td>0,73415995</td><td>Limite comum para times econômicos</td></tr><tr><td>35</td><td>0,78279999</td><td>Ponto ideal para atacantes de reide</td></tr><tr><td>40</td><td>0,79030001</td><td>Limite de nível padrão (antes de Balas XL)</td></tr><tr><td>41</td><td>0,81073600</td><td>Balas XL necessárias (Nível 41+)</td></tr><tr><td>45</td><td>0,82058400</td><td>Faixa intermediária de fortalecimento XL</td></tr><tr><td>50</td><td>0,84029999</td><td>Nível máximo (requer treinador Nível 40)</td></tr><tr><td>50,5</td><td>0,84029999</td><td>Máximo com bônus Melhor Amigo (+1 nível efetivo)</td></tr></tbody></table>',
            'faq_title'        => 'Calculadora de IV Pokemon GO — Perguntas Frequentes',
            'faq_q1' => 'Como calcular os IVs no Pokemon GO?',
            'faq_a1' => 'Para calcular os IVs no Pokemon GO, insira a espécie do seu Pokemon, os valores de IV de Ataque, Defesa e Resistência (0 a 15 cada) e o nível atual na calculadora acima. A ferramenta aplica a fórmula oficial de PC — <em>(AtkBase + IVAtk) × √(DefBase + IVDef) × √(StaBase + IVSta) × CPM² ÷ 10</em> — e retorna instantaneamente a porcentagem de IV, a classificação por estrelas, PC, PV e classificações de liga PvP. Você também pode usar a aba Avaliação para inserir as setas do seu Líder de Equipe diretamente.',
            'faq_q2' => 'Qual é uma boa porcentagem de IV no Pokemon GO?',
            'faq_a2' => 'Uma boa porcentagem de IV no Pokemon GO depende do seu objetivo. Para reides e Liga Mestre, o ideal é 90–100% (classificação de 3 estrelas). Para Liga Super e Ultra, a estratégia é mais complexa — IVs de Ataque baixos costumam ser melhores porque permitem subir de nível dentro do limite de PC, aumentando o produto total de stats. Para o jogo casual, qualquer Pokemon acima de 66% (2 estrelas) é perfeitamente utilizável e não justifica gastar Pó Estelar extra para substituí-lo.',
            'faq_q3' => 'O que significa 0★ 1★ 2★ 3★ no Pokemon GO?',
            'faq_a3' => 'A classificação por estrelas no Pokemon GO é atribuída pelo seu Líder de Equipe durante a avaliação e reflete a faixa de porcentagem de IV do seu Pokemon. 0★ significa 0–48,9% de IVs, 1★ cobre 51,1–64,4%, 2★ cobre 66,7–80% e 3★ cobre 82,2–98%. Um fundo vermelho especial com 3 estrelas indica um Pokemon perfeito com 100% (15/15/15). A calculadora de IV acima mostra a porcentagem exata junto com a classificação por estrelas.',
            'faq_q4' => 'Os IVs podem ser alterados no Pokemon GO?',
            'faq_a4' => 'Os IVs não podem ser alterados depois que um Pokemon é capturado, com duas exceções. <strong>Purificar um Pokemon Sombrio</strong> adiciona +2 em cada IV (máximo 15), então um Sombrio com 13/13/13 vira 15/15/15 ao ser purificado. A <strong>troca</strong> relança os IVs de ambos os Pokemon trocados — uma Troca da Sorte garante no mínimo 12 nos três atributos. Não existe outro mecanismo para alterar IVs, e Pó Estelar, Balas ou evolução não têm qualquer efeito sobre os valores de IV.',
            'faq_q5' => 'Qual a diferença entre IV% e PC no Pokemon GO?',
            'faq_a5' => 'O IV% reflete a qualidade genética de um Pokemon — o quão perto seus atributos ocultos estão do máximo 15/15/15. O PC (Pontos de Combate) é o número de força visível que combina stats base, IVs e o Multiplicador de PC por nível em um único valor. Um Pokemon com IVs altos em nível baixo pode ter menos PC do que um com IVs baixos mas muito fortalecido. A calculadora de IV exibe ambos os valores ao mesmo tempo para que você avalie qualidade e poder atual de uma só vez.',
            'faq_q6' => 'O clima afeta os IVs dos Pokemon no Pokemon GO?',
            'faq_a6' => 'O clima não muda os IVs de um Pokemon, mas capturas potenciadas pelo clima têm garantia de IV mínimo de 4 nos três atributos. Isso significa que o pior Pokemon com boost de clima possível tem IVs de 4/4/4 (cerca de 26,7%), eliminando os resultados de 0 IV. Capturas selvagens com boost de clima também aparecem no Nível 6 no mínimo, em vez da faixa normal de Nível 1 a 35. A calculadora de IV suporta perfeitamente Pokemon com boost de clima — basta inserir os valores de IV reais que aparecem após a avaliação no jogo.',
            'faq_q7' => 'Quantas combinações de IV são possíveis por Pokemon no Pokemon GO?',
            'faq_a7' => 'Cada Pokemon tem 4.096 combinações possíveis de IV (16 valores de Ataque × 16 de Defesa × 16 de Resistência). Dessas, apenas uma combinação é perfeita com 100% (15/15/15), e 48 combinações atingem 98% ou mais. A probabilidade de capturar um Pokemon com 100% de IVs em um encontro selvagem padrão é de 1/4096 (aproximadamente 0,024%). Para chefes de reide e marcos de pesquisa, o IV mínimo é 10/10/10, com 1.296 combinações possíveis — tornando a probabilidade de 100% igual a 1/216 (aproximadamente 0,46%).',
            'faq_q8' => 'Devo fortalecer um Pokemon antes de verificar seus IVs?',
            'faq_a8' => 'O ideal é verificar os IVs <em>antes</em> de gastar Pó Estelar e Balas para fortalecer. Subir de nível um Pokemon não altera seus IVs — os valores são fixados no momento da captura. Porém, se você já fortaleceu um Pokemon, ainda pode calcular seus IVs com precisão usando o nível atual na calculadora. Use a <strong>calculadora de IV acima</strong> para avaliar qualquer Pokemon antes de comprometer recursos, e confira a calculadora de Pó Estelar para estimar o custo total até o nível desejado.',
            'related_title'    => 'Calculadoras Pokemon Relacionadas',
            'no_related_tools' => 'Ainda não há ferramentas relacionadas. Mais calculadoras em breve!',
            'blog_guides_title'=> 'Guias e Dicas Pokemon',
            'blog_read_more'   => 'Ler guia',
        ],
        'fr' => [
            'title'                  => 'Calculateur IV Pokemon GO',
            'description'            => 'Calculez les IV exacts de votre Pokemon, le score IV%, le PC à chaque niveau et les notes PvP instantanément.',
            'tab_simple'             => 'Simple',
            'tab_advanced'           => 'Avancé',
            'tab_bulk'               => 'Multiple',
            'select_pokemon'         => 'Rechercher Pokemon...',
            'attack_iv_label'        => 'IV Attaque',
            'defense_iv_label'       => 'IV Défense',
            'stamina_iv_label'       => 'IV Endurance',
            'level_label'            => 'Niveau',
            'calculate_btn'          => 'Calculer les IV',
            'reset_btn'              => 'Réinitialiser',
            'copy_btn'               => 'Copier les Résultats',
            'copied_btn'             => 'Copié !',
            'appraisal_label'        => 'Évaluation',
            'appraisal_hint'         => 'Sélectionnez les flèches d\'évaluation de votre Chef d\'Équipe',
            'appraisal_atk'          => 'Attaque',
            'appraisal_def'          => 'Défense',
            'appraisal_sta'          => 'Endurance',
            'result_iv_pct'          => 'Score IV',
            'result_cp'              => 'Points de Combat',
            'result_hp'              => 'Points de Vie',
            'result_level'           => 'Niveau',
            'result_rating'          => 'Note',
            'result_rank'            => 'Rang',
            'pvp_title'              => 'Notes Ligue PvP',
            'pvp_great'              => 'Grande Ligue',
            'pvp_ultra'              => 'Ultra Ligue',
            'pvp_master'             => 'Ligue Maîtres',
            'pvp_cp_cap'             => 'PC Max.',
            'pvp_best_cp'            => 'Meilleur PC',
            'pvp_best_level'         => 'Meilleur Niveau',
            'moveset_title'          => 'Meilleur Moveset',
            'moveset_fast'           => 'Attaque Rapide',
            'moveset_charged'        => 'Attaque Chargée',
            'moveset_dps'            => 'DPS',
            'moveset_type'           => 'Type',
            'cp_table_title'         => 'PC à Chaque Niveau',
            'cp_table_show'          => 'Voir Tableau des Niveaux',
            'cp_table_hide'          => 'Masquer le Tableau',
            'cp_table_level'         => 'Niveau',
            'cp_table_cp'            => 'PC',
            'cp_table_hp'            => 'PV',
            'bulk_add_btn'           => 'Ajouter Pokemon',
            'bulk_calc_btn'          => 'Tout Calculer',
            'bulk_clear_btn'         => 'Tout Effacer',
            'bulk_copy_btn'          => 'Copier les Résultats',
            'bulk_rank_col'          => '#',
            'bulk_pokemon_col'       => 'Pokemon',
            'bulk_ivs_col'           => 'IVs',
            'bulk_iv_pct_col'        => 'IV%',
            'bulk_cp_col'            => 'PC',
            'bulk_rating_col'        => 'Note',
            'bulk_placeholder'       => 'Ajoutez jusqu\'à 6 Pokemon ci-dessus, puis cliquez sur Tout Calculer.',
            'rating_100'             => '100% — Parfait !',
            'rating_98'              => '98% — Chanceux',
            'rating_above_90'        => 'Excellent',
            'rating_above_80'        => 'Super',
            'rating_above_66'        => 'Bien',
            'rating_below_66'        => 'Pas Mal',
            'stars_3'                => '3★ Parfait',
            'stars_2'                => '2★ Super',
            'stars_1'                => '1★ Bien',
            'stars_0'                => '0★',
            'hp_label'               => 'PV',
            'cp_label'               => 'PC',
            'error_data_load'        => 'Impossible de charger les données Pokemon. Veuillez rafraîchir la page.',
            'error_select_pokemon'   => 'Veuillez sélectionner un Pokemon.',
            'error_invalid_iv'       => 'Les valeurs IV doivent être comprises entre 0 et 15.',
            'error_invalid_level'    => 'Le niveau doit être compris entre 1 et 50.',
            'error_no_results'       => 'Aucun Pokemon trouvé pour cette recherche.',
            'error_calculation'      => 'Erreur de calcul. Veuillez vérifier vos données.',
            'error_bulk_empty'       => 'Veuillez ajouter au moins un Pokemon au vérificateur multiple.',
            'meta_title'       => 'Calculateur IV Pokemon GO | Trouvez vos IV Exactement',
            'meta_desc'        => 'Calculez les IV exacts de votre Pokemon GO : Attaque, Défense et Endurance, pourcentage IV, PC par niveau et classements PvP. Outil gratuit, sans inscription.',
            'intro_title'      => 'Calculateur IV Pokemon GO — Révélez les Stats Cachées de votre Pokemon',
            'intro_content'    => '<p>Le <strong>calculateur IV de Pokemon GO</strong> révèle les Valeurs Individuelles cachées de chaque Pokemon que vous capturez — les scores d\'Attaque, de Défense et d\'Endurance (de 0 à 15 chacun) qui déterminent la véritable puissance de votre Pokemon, indépendamment des PC. Les IV sont fixés au moment de la capture et ne peuvent pas être modifiés, ce qui en fait le facteur le plus déterminant pour choisir des attaquants de raid, des combattants PvP et des Pokemon dignes d\'être améliorés jusqu\'au Niveau 50.</p><p>Dans la communauté compétitive française et belge, la stratégie IV est particulièrement importante en PvP. En Grande Ligue et en Ultra Ligue, un IV d\'Attaque bas est souvent préférable — il permet de monter votre Pokemon à un niveau plus élevé dans la limite de PC, augmentant ainsi le produit total de statistiques. Un Registeel avec 0/15/15 IVs surpassera systématiquement un 15/15/15 en Grande Ligue. Calculez vos coûts de renforcement avec le <a href="https://pokemoncalculator.online/fr/calculateur-poussiere-etoile/">calculateur de Poussière d\'Étoile</a> et projetez les PC finaux avec le <a href="https://pokemoncalculator.online/fr/calculateur-cp-pokemon/">calculateur CP</a>.</p><p>En Ligue des Maîtres, la logique s\'inverse — c\'est le 15/15/15 qui prime, car vous combattez sans limite de PC. Utilisez le <strong>calculateur IV ci-dessus</strong> pour évaluer instantanément n\'importe quel Pokemon de votre collection, connaître son rang PvP et décider s\'il mérite vos Poussières d\'Étoile. Découvrez tous nos outils sur le <a href="https://pokemoncalculator.online/calculators/">hub des calculateurs Pokemon</a>.</p>',
            'howto_title'      => 'Comment Utiliser le Calculateur IV de Pokemon GO',
            'howto_step1'      => 'Tapez le nom de votre Pokemon dans le champ <strong>Rechercher Pokemon</strong>. Les résultats s\'affichent au fil de la saisie — cliquez sur le nom de votre Pokemon pour le sélectionner. Le sprite, les badges de type et les statistiques de base se chargent automatiquement.',
            'howto_step2'      => 'Saisissez l\'<strong>IV Attaque</strong>, l\'<strong>IV Défense</strong> et l\'<strong>IV Endurance</strong> de votre Pokemon (de 0 à 15 chacun). Si vous avez déjà évalué votre Pokemon dans le jeu, utilisez l\'onglet Évaluation pour entrer les flèches de votre Chef d\'Équipe — le calculateur affine automatiquement les IV possibles.',
            'howto_step3'      => 'Réglez le curseur de <strong>Niveau</strong> sur le niveau actuel de votre Pokemon. Identifiez le niveau exact en observant l\'arc au-dessus de votre Pokemon dans le jeu — il va du Niveau 1 (extrême gauche) jusqu\'à votre niveau de dresseur +10 (extrême droite). Les demi-niveaux comme 20,5 sont pris en charge.',
            'howto_step4'      => 'Cliquez sur <strong>Calculer les IV</strong>. Le panneau de résultats affiche instantanément le pourcentage IV, la note en étoiles, les PC et PV au niveau actuel, les classements PvP pour la Grande Ligue, l\'Ultra Ligue et la Ligue des Maîtres, le DPS du meilleur moveset et le tableau complet des PC niveau par niveau de 1 à 50.',
            'info_title'       => 'Comment les IV sont Calculés dans Pokemon GO — Formule, Contexte et Stratégie',
            'info_content'     => '<p>Les Valeurs Individuelles dans Pokemon GO fonctionnent différemment des jeux principaux. Au lieu de six statistiques, Pokemon GO en utilise trois : <strong>Attaque</strong>, <strong>Défense</strong> et <strong>Endurance</strong>. Chacune varie de 0 à 15, ce qui donne 16 × 16 × 16 = 4 096 combinaisons d\'IV possibles par espèce.</p><h3>La Formule des PC</h3><p>Les Points de Combat ne sont pas une statistique directe — ils sont une valeur composite dérivée des statistiques de base, des IV et du Multiplicateur de PC (CPM) au niveau actuel du Pokemon. La formule officielle est :</p><p><strong>PC = (AtkBase + IVAtk) × √(DefBase + IVDef) × √(StaBase + IVSta) × CPM² ÷ 10</strong></p><p>Le CPM est une valeur scalaire dépendante du niveau qui augmente de 0,094 au Niveau 1 jusqu\'à 0,8403 au Niveau 40 et 0,8740 au Niveau 50. C\'est pourquoi améliorer un Pokemon augmente ses PC même sans modifier les IV — le multiplicateur croît. Vérifiez n\'importe quel résultat avec le <strong>calculateur IV ci-dessus</strong>.</p><h3>Pourquoi les IV Comptent (et Quand Ils Ne Comptent Pas)</h3><p>Pour le jeu casual et les raids de faible difficulté, les IV ont un impact minimal. La différence devient significative dans trois situations : la <strong>Ligue des Maîtres PvP</strong> (où vous combattez à PC maximum et le 15/15/15 est toujours avantageux), les <strong>raids de haut niveau</strong> (où un attaquant à 100% économise précieuses secondes) et les duos avec amitié maximale.</p><p>Pour la <strong>Grande Ligue</strong> (limite 1 500 PC) et l\'<strong>Ultra Ligue</strong> (limite 2 500 PC), la méta est contre-intuitive : <em>des IV d\'Attaque bas sont souvent préférables</em>. Comme l\'Attaque a plus de poids dans la formule PC, un IV d\'Attaque plus faible permet de monter le Pokemon plus haut dans la limite de PC — gagnant davantage en produit de statistiques Défense et Endurance. C\'est pourquoi un Registeel 0/15/15 surpasse un 15/15/15 en Grande Ligue. Les joueurs compétitifs français accordent une grande importance à cette nuance pour optimiser leurs équipes PvP.</p><h3>Idées Reçues Courantes</h3><p>Beaucoup de joueurs supposent que les Pokemon chromatiques ont de meilleurs IV — c\'est faux. Shiny et IV sont totalement indépendants. De même, les Pokemon Chanceux obtenus par échange garantissent un minimum de 12 dans les trois IV, mais pas nécessairement 15/15/15. Les Pokemon Purifiés reçoivent un bonus de +2 à chaque IV (plafonné à 15) — ce qui rend les ombres aux IV moyens intéressantes à conserver.</p><p>Les captures boostées par la météo ont un plancher d\'IV de 4 dans les trois statistiques. Les captures de boss de raid et les récompenses de recherche commencent à 10/10/10 minimum. Connaître ces planchers vous permet de filtrer rapidement sans recourir à la calculatrice à chaque fois.</p><p>Utilisez le <a href="https://pokemoncalculator.online/fr/calculateur-poussiere-etoile/">calculateur de Poussière d\'Étoile</a> avant d\'améliorer pour connaître le coût exact jusqu\'au niveau cible. Consultez le <a href="https://pokemoncalculator.online/fr/tableau-des-types/">tableau des types</a> pour confirmer les avantages de combat de votre Pokemon après avoir sélectionné les meilleurs IV.</p>',
            'info_table_title' => 'Valeurs du Multiplicateur de PC (CPM) par Niveau — Pokemon GO',
            'info_table_html'  => '<table class="pkm-calc-table"><thead><tr><th>Niveau</th><th>Valeur CPM</th><th>Notes</th></tr></thead><tbody><tr><td>1</td><td>0,09399999</td><td>Niveau de départ (capture sauvage)</td></tr><tr><td>5</td><td>0,29024988</td><td>Plage habituelle de capture sauvage</td></tr><tr><td>10</td><td>0,42250001</td><td>Plage dresseur débutant</td></tr><tr><td>15</td><td>0,51739395</td><td>Capture de niveau intermédiaire</td></tr><tr><td>20</td><td>0,59740001</td><td>Minimum boost météo</td></tr><tr><td>25</td><td>0,66999996</td><td>Plage typique de Pokemon améliorés</td></tr><tr><td>30</td><td>0,73415995</td><td>Limite courante pour équipes économiques</td></tr><tr><td>35</td><td>0,78279999</td><td>Point optimal pour attaquants de raid</td></tr><tr><td>40</td><td>0,79030001</td><td>Limite de niveau standard (avant bonbons XL)</td></tr><tr><td>41</td><td>0,81073600</td><td>Bonbons XL requis (Niveau 41+)</td></tr><tr><td>45</td><td>0,82058400</td><td>Plage intermédiaire amélioration XL</td></tr><tr><td>50</td><td>0,84029999</td><td>Niveau maximum (dresseur Niveau 40 requis)</td></tr><tr><td>50,5</td><td>0,84029999</td><td>Maximum avec bonus Meilleur Ami (+1 niveau effectif)</td></tr></tbody></table>',
            'faq_title'        => 'Calculateur IV Pokemon GO — Foire Aux Questions',
            'faq_q1' => 'Comment calculer les IV dans Pokemon GO ?',
            'faq_a1' => 'Pour calculer les IV dans Pokemon GO, entrez l\'espèce de votre Pokemon, ses valeurs IV d\'Attaque, Défense et Endurance (0 à 15 chacun) et son niveau actuel dans le calculateur ci-dessus. L\'outil applique la formule officielle des PC — <em>(AtkBase + IVAtk) × √(DefBase + IVDef) × √(StaBase + IVSta) × CPM² ÷ 10</em> — pour afficher instantanément le pourcentage IV, la note en étoiles, les PC, PV et classements de ligue PvP. Vous pouvez aussi utiliser l\'onglet Évaluation pour saisir les flèches de votre Chef d\'Équipe directement.',
            'faq_q2' => 'Quel est un bon pourcentage IV dans Pokemon GO ?',
            'faq_a2' => 'Un bon pourcentage IV dans Pokemon GO dépend de votre objectif. Pour les raids et la Ligue des Maîtres, l\'idéal est 90–100% (note 3 étoiles). Pour la Grande Ligue et l\'Ultra Ligue, la stratégie est plus complexe — des IV d\'Attaque bas sont souvent préférables car ils permettent de monter plus haut dans la limite de PC, augmentant le produit statistique total. Pour le jeu casual, tout Pokemon au-dessus de 66% (2 étoiles) est parfaitement utilisable et ne justifie pas de dépenser davantage de Poussière d\'Étoile pour le remplacer.',
            'faq_q3' => 'Que signifient 0★ 1★ 2★ 3★ dans Pokemon GO ?',
            'faq_a3' => 'La note en étoiles dans Pokemon GO est attribuée par votre Chef d\'Équipe lors de l\'évaluation et reflète la plage de pourcentage IV de votre Pokemon. 0★ signifie 0–48,9% d\'IV, 1★ couvre 51,1–64,4%, 2★ couvre 66,7–80% et 3★ couvre 82,2–98%. Un fond rouge spécial avec 3 étoiles indique un Pokemon parfait à 100% (15/15/15). Le calculateur IV ci-dessus affiche le pourcentage exact aux côtés de la note en étoiles.',
            'faq_q4' => 'Peut-on modifier les IV dans Pokemon GO ?',
            'faq_a4' => 'Les IV ne peuvent pas être modifiés après la capture d\'un Pokemon, avec deux exceptions. <strong>Purifier un Pokemon Obscur</strong> ajoute +2 à chaque IV (plafonné à 15), donc un Obscur 13/13/13 devient 15/15/15 après purification. L\'<strong>échange</strong> relance les IV des deux Pokemon échangés — un Échange Chanceux garantit un minimum de 12 dans les trois statistiques. Il n\'existe aucun autre mécanisme pour modifier les IV, et la Poussière d\'Étoile, les Bonbons ou l\'évolution n\'ont aucun effet sur les valeurs IV.',
            'faq_q5' => 'Quelle est la différence entre IV% et PC dans Pokemon GO ?',
            'faq_a5' => 'Le IV% reflète la qualité génétique d\'un Pokemon — à quel point ses statistiques cachées sont proches du maximum 15/15/15. Les PC (Points de Combat) sont le nombre de puissance visible qui combine statistiques de base, IV et Multiplicateur de PC par niveau en une seule valeur. Un Pokemon aux IV élevés mais de bas niveau peut avoir moins de PC qu\'un Pokemon aux IV faibles mais très amélioré. Le calculateur IV affiche les deux valeurs simultanément pour évaluer qualité et puissance actuelle d\'un seul coup d\'œil.',
            'faq_q6' => 'La météo affecte-t-elle les IV des Pokemon dans Pokemon GO ?',
            'faq_a6' => 'La météo ne modifie pas les IV d\'un Pokemon, mais les captures boostées par la météo ont un plancher d\'IV garanti de 4 dans les trois statistiques. Cela signifie que le pire Pokemon capturé sous boost météo possible a des IV de 4/4/4 (environ 26,7%), éliminant les résultats à 0 IV. Les captures sauvages boostées par la météo apparaissent aussi au Niveau 6 minimum plutôt que dans la plage habituelle Niveau 1–35. Le calculateur IV prend entièrement en charge les Pokemon boostés — saisissez simplement les valeurs IV réelles affichées après l\'évaluation dans le jeu.',
            'faq_q7' => 'Combien de combinaisons d\'IV sont possibles par Pokemon dans Pokemon GO ?',
            'faq_a7' => 'Chaque Pokemon possède 4 096 combinaisons d\'IV possibles (16 valeurs d\'Attaque × 16 de Défense × 16 d\'Endurance). Parmi elles, une seule combinaison est parfaite à 100% (15/15/15), et 48 combinaisons atteignent 98% ou plus. La probabilité de capturer un Pokemon à 100% d\'IV lors d\'une rencontre sauvage standard est de 1/4096 (environ 0,024%). Pour les boss de raid et les récompenses de recherche, le plancher minimum d\'IV est de 10/10/10, avec 1 296 combinaisons possibles — portant la probabilité de 100% à 1/216 (environ 0,46%).',
            'faq_q8' => 'Faut-il améliorer un Pokemon avant de vérifier ses IV ?',
            'faq_a8' => 'Il est conseillé de vérifier les IV <em>avant</em> de dépenser de la Poussière d\'Étoile et des Bonbons pour améliorer. Monter de niveau un Pokemon ne modifie pas ses IV — les valeurs sont fixées au moment de la capture. Toutefois, si vous avez déjà amélioré un Pokemon, vous pouvez toujours calculer ses IV avec précision en utilisant le niveau actuel dans le calculateur. Utilisez le <strong>calculateur IV ci-dessus</strong> pour évaluer n\'importe quel Pokemon avant de dépenser des ressources, et croisez les données avec le calculateur de Poussière d\'Étoile pour estimer le coût total jusqu\'au niveau cible.',
            'related_title'    => 'Calculateurs Pokemon Associés',
            'no_related_tools' => 'Pas encore d\'outils associés. D\'autres calculateurs arrivent bientôt !',
            'blog_guides_title'=> 'Guides et Conseils Pokemon',
            'blog_read_more'   => 'Lire le guide',
        ],
        'de' => [
            'title'                  => 'Pokemon GO IV Rechner',
            'description'            => 'Berechne die genauen IVs deines Pokemon, den IV%-Wert, KP auf jedem Level und PvP-Bewertungen sofort.',
            'tab_simple'             => 'Einfach',
            'tab_advanced'           => 'Erweitert',
            'tab_bulk'               => 'Mehrere',
            'select_pokemon'         => 'Pokemon suchen...',
            'attack_iv_label'        => 'Angriff IV',
            'defense_iv_label'       => 'Verteidigung IV',
            'stamina_iv_label'       => 'Ausdauer IV',
            'level_label'            => 'Level',
            'calculate_btn'          => 'IVs Berechnen',
            'reset_btn'              => 'Zurücksetzen',
            'copy_btn'               => 'Ergebnisse Kopieren',
            'copied_btn'             => 'Kopiert!',
            'appraisal_label'        => 'Bewertung',
            'appraisal_hint'         => 'Wähle die Pfeilbewertungen deines Teamanführers',
            'appraisal_atk'          => 'Angriff',
            'appraisal_def'          => 'Verteidigung',
            'appraisal_sta'          => 'Ausdauer',
            'result_iv_pct'          => 'IV-Wert',
            'result_cp'              => 'Kampfpunkte',
            'result_hp'              => 'Trefferpunkte',
            'result_level'           => 'Level',
            'result_rating'          => 'Bewertung',
            'result_rank'            => 'Rang',
            'pvp_title'              => 'PvP-Liga Bewertungen',
            'pvp_great'              => 'Superliga',
            'pvp_ultra'              => 'Ultraliga',
            'pvp_master'             => 'Meisterliga',
            'pvp_cp_cap'             => 'Max KP',
            'pvp_best_cp'            => 'Beste KP',
            'pvp_best_level'         => 'Bestes Level',
            'moveset_title'          => 'Bestes Moveset',
            'moveset_fast'           => 'Schnellangriff',
            'moveset_charged'        => 'Ladeangriff',
            'moveset_dps'            => 'DPS',
            'moveset_type'           => 'Typ',
            'cp_table_title'         => 'KP pro Level',
            'cp_table_show'          => 'Level-Tabelle Anzeigen',
            'cp_table_hide'          => 'Tabelle Ausblenden',
            'cp_table_level'         => 'Level',
            'cp_table_cp'            => 'KP',
            'cp_table_hp'            => 'TP',
            'bulk_add_btn'           => 'Pokemon Hinzufügen',
            'bulk_calc_btn'          => 'Alle Berechnen',
            'bulk_clear_btn'         => 'Alle Löschen',
            'bulk_copy_btn'          => 'Ergebnisse Kopieren',
            'bulk_rank_col'          => '#',
            'bulk_pokemon_col'       => 'Pokemon',
            'bulk_ivs_col'           => 'IVs',
            'bulk_iv_pct_col'        => 'IV%',
            'bulk_cp_col'            => 'KP',
            'bulk_rating_col'        => 'Bewertung',
            'bulk_placeholder'       => 'Füge oben bis zu 6 Pokemon hinzu und klicke auf Alle Berechnen.',
            'rating_100'             => '100% — Perfekt!',
            'rating_98'              => '98% — Glücklich',
            'rating_above_90'        => 'Ausgezeichnet',
            'rating_above_80'        => 'Großartig',
            'rating_above_66'        => 'Gut',
            'rating_below_66'        => 'Nicht Schlecht',
            'stars_3'                => '3★ Perfekt',
            'stars_2'                => '2★ Großartig',
            'stars_1'                => '1★ Gut',
            'stars_0'                => '0★',
            'hp_label'               => 'TP',
            'cp_label'               => 'KP',
            'error_data_load'        => 'Pokemon-Daten konnten nicht geladen werden. Bitte lade die Seite neu.',
            'error_select_pokemon'   => 'Bitte wähle ein Pokemon aus.',
            'error_invalid_iv'       => 'IV-Werte müssen zwischen 0 und 15 liegen.',
            'error_invalid_level'    => 'Das Level muss zwischen 1 und 50 liegen.',
            'error_no_results'       => 'Kein Pokemon für deine Suche gefunden.',
            'error_calculation'      => 'Berechnungsfehler. Bitte überprüfe deine Eingaben.',
            'error_bulk_empty'       => 'Bitte füge mindestens ein Pokemon zum Massenprüfer hinzu.',
            'meta_title'       => 'Pokemon GO IV Rechner | IVs Exakt Berechnen',
            'meta_desc'        => 'Berechne die genauen IVs deines Pokemon GO: Angriff, Verteidigung und Ausdauer, IV-Prozentsatz, KP pro Level und PvP-Bewertungen. Kostenlos, ohne Registrierung.',
            'intro_title'      => 'Pokemon GO IV Rechner — Entdecke die Versteckten Werte deines Pokemon',
            'intro_content'    => '<p>Der <strong>Pokemon GO IV Rechner</strong> enthüllt die verborgenen Individualwerte jedes gefangenen Pokemon — die Angriffs-, Verteidigungs- und Ausdauerwerte (jeweils 0–15), die die tatsächliche Stärke deines Pokemon bestimmen, unabhängig von den Kampfpunkten. IVs werden beim Fangen festgelegt und können danach nicht mehr verändert werden — sie sind daher der wichtigste Faktor bei der Auswahl von Raid-Angreifern, PvP-Kämpfern und Pokemon, die es wert sind, bis auf Level 50 aufgewertet zu werden.</p><p>In der deutschen Pokemon GO Community — besonders auf pokemongo.de und in Discord-Servern — wird sehr präzise über IV-Optimierung diskutiert. Deutsche Spieler schätzen genaue Werte: Der Unterschied zwischen einem 100% Dragoran auf Level 40 (4053 KP) und einem 80% Dragoran (3857 KP) beträgt über 4% — genug, um in knappen Raids den Unterschied zu machen. Berechne die Aufwertungskosten mit dem <a href="https://pokemoncalculator.online/de/sternenstaub-rechner/">Sternenstaub-Rechner</a> und projiziere die KP mit dem <a href="https://pokemoncalculator.online/de/kp-rechner-pokemon-go/">KP-Rechner</a>.</p><p>Für die Superliga und Ultra-Liga gilt eine andere Logik: Niedrige Angriffs-IVs sind oft besser, weil sie es ermöglichen, das Pokemon auf einem höheren Level innerhalb des KP-Limits zu halten. Nutze den <strong>IV Rechner oben</strong>, um sofort das genaue IV-Profil, PvP-Rang und die komplette KP-Tabelle für jedes Pokemon in deiner Sammlung zu erhalten. Alle Tools findest du im <a href="https://pokemoncalculator.online/calculators/">Pokemon Rechner Hub</a>.</p>',
            'howto_title'      => 'So Verwendest du den Pokemon GO IV Rechner',
            'howto_step1'      => 'Gib den Namen deines Pokemon in das Feld <strong>Pokemon suchen</strong> ein. Die Ergebnisse erscheinen während der Eingabe — klicke auf den Namen deines Pokemon, um es auszuwählen. Das Sprite, Typ-Abzeichen und Basiswerte werden automatisch geladen.',
            'howto_step2'      => 'Gib den <strong>Angriff IV</strong>, den <strong>Verteidigung IV</strong> und den <strong>Ausdauer IV</strong> deines Pokemon ein (jeweils 0–15). Wenn du dein Pokemon im Spiel bereits bewertet hast, nutze den Bewertungs-Tab, um die Pfeil-Bewertungen deines Teamanführers einzugeben — der Rechner schränkt die möglichen IVs automatisch ein.',
            'howto_step3'      => 'Stelle den <strong>Level</strong>-Regler auf das aktuelle Level deines Pokemon. Das genaue Level erkennst du am Bogen über deinem Pokemon im Spiel — er reicht von Level 1 (ganz links) bis zu deinem Trainerlevel +10 (ganz rechts). Halbe Level wie 20,5 werden unterstützt.',
            'howto_step4'      => 'Klicke auf <strong>IVs Berechnen</strong>. Die Ergebniskarte zeigt sofort den IV-Prozentwert, die Sternebewertung, KP und TP auf dem aktuellen Level, PvP-Bewertungen für Super-, Ultra- und Meisterliga, den besten Moveset-DPS sowie eine vollständige KP-Tabelle für alle Level von 1 bis 50.',
            'info_title'       => 'Wie IVs in Pokemon GO Berechnet Werden — Formel, Kontext und Strategie',
            'info_content'     => '<p>Individualwerte in Pokemon GO funktionieren anders als in den Hauptreihenspielen. Statt sechs Werten gibt es drei: <strong>Angriff</strong>, <strong>Verteidigung</strong> und <strong>Ausdauer</strong>. Jeder liegt zwischen 0 und 15, was 16 × 16 × 16 = 4.096 mögliche IV-Kombinationen pro Art ergibt.</p><h3>Die KP-Formel</h3><p>Kampfpunkte sind keine direkte Statistik — sie sind ein zusammengesetzter Wert aus Basiswerten, IVs und dem KP-Multiplikator (CPM) auf dem aktuellen Level des Pokemon. Die offizielle Formel lautet:</p><p><strong>KP = (AtkBasis + IVAtk) × √(DefBasis + IVDef) × √(AusBasis + IVAus) × CPM² ÷ 10</strong></p><p>Der CPM ist ein levelabhängiger Skalierungswert, der von 0,094 auf Level 1 bis 0,8403 auf Level 40 und 0,8740 auf Level 50 ansteigt. Deshalb steigen die KP beim Aufwerten, selbst wenn sich die IVs nicht ändern — der Multiplikator wächst. Überprüfe jedes Ergebnis direkt mit dem <strong>IV Rechner oben</strong>.</p><h3>Warum IVs Wichtig Sind (und Wann Nicht)</h3><p>Für entspanntes Spielen und Raids unter Schwierigkeit 5 haben IVs minimale Auswirkungen. Der Unterschied wird in drei Szenarien bedeutsam: der <strong>Meisterliga PvP</strong> (hier kämpfst du ohne KP-Limit — 15/15/15 ist stets besser), <strong>hochstufigen Raids</strong> (wo ein 100% Angreifer wertvolle Sekunden spart) und Duo-Raids mit maximaler Freundschaft.</p><p>Für die <strong>Superliga</strong> (Limit 1.500 KP) und die <strong>Ultra-Liga</strong> (Limit 2.500 KP) gilt eine kontraintuitive Logik: <em>Niedrige Angriffs-IVs sind oft besser</em>. Da Angriff in der KP-Formel stärker gewichtet ist, ermöglicht ein niedrigerer Angriffs-IV ein höheres Level innerhalb des KP-Limits — was mehr Gesamt-Statistikprodukt aus Verteidigung und Ausdauer ergibt. Deshalb übertrifft ein Scherox mit 0/15/15 ein 15/15/15 in der Superliga. Diese Präzision ist es, die die deutsche PvP-Community besonders schätzt.</p><h3>Häufige Irrtümer</h3><p>Viele Spieler glauben, schillernde Pokemon hätten bessere IVs — das ist falsch. Schillernheit und IVs sind völlig unabhängig. Ebenso sind Glücks-Pokemon, die durch Tausch erhalten werden, mit mindestens 12 in allen drei IVs garantiert, aber nicht notwendigerweise 15/15/15. Gereinigte Pokemon erhalten einen +2 IV-Bonus (maximal 15) — daher lohnt es sich, Schatten-Pokemon mit mittleren IVs aufzuheben.</p><p>Wetter-geboostete Fänge haben einen IV-Mindestwert von 4 in allen drei Statistiken. Raid-Boss-Fänge und Forschungsdurchbrüche starten bei mindestens 10/10/10. Dieser Mindestwert bei Eiern gilt ebenfalls. Diese Untergrenzen zu kennen, hilft Pokemon schnell zu filtern ohne den Rechner jedes Mal zu benötigen.</p><p>Nutze den <a href="https://pokemoncalculator.online/de/sternenstaub-rechner/">Sternenstaub-Rechner</a> vor dem Aufwerten, um die genauen Kosten bis zum Ziellevel zu kennen. Prüfe die <a href="https://pokemoncalculator.online/de/typen-tabelle/">Typen-Tabelle</a>, um die Kampfvorteile deines Pokemon nach der IV-Auswahl zu bestätigen.</p>',
            'info_table_title' => 'KP-Multiplikator (CPM) Werte nach Level — Pokemon GO',
            'info_table_html'  => '<table class="pkm-calc-table"><thead><tr><th>Level</th><th>CPM-Wert</th><th>Hinweise</th></tr></thead><tbody><tr><td>1</td><td>0,09399999</td><td>Startlevel (wilder Fang)</td></tr><tr><td>5</td><td>0,29024988</td><td>Typischer Bereich wilder Fänge</td></tr><tr><td>10</td><td>0,42250001</td><td>Anfänger-Trainerbereich</td></tr><tr><td>15</td><td>0,51739395</td><td>Mittlerer Fangbereich</td></tr><tr><td>20</td><td>0,59740001</td><td>Minimum Wetter-Boost</td></tr><tr><td>25</td><td>0,66999996</td><td>Typischer Bereich aufgewerteter Pokemon</td></tr><tr><td>30</td><td>0,73415995</td><td>Übliches Limit für kostengünstige Teams</td></tr><tr><td>35</td><td>0,78279999</td><td>Optimaler Bereich für Raid-Angreifer</td></tr><tr><td>40</td><td>0,79030001</td><td>Standard-Levelgrenze (vor XL-Bonbons)</td></tr><tr><td>41</td><td>0,81073600</td><td>XL-Bonbons erforderlich (Level 41+)</td></tr><tr><td>45</td><td>0,82058400</td><td>Mittlerer XL-Aufwertungsbereich</td></tr><tr><td>50</td><td>0,84029999</td><td>Maximales Level (Trainer Level 40 erforderlich)</td></tr><tr><td>50,5</td><td>0,84029999</td><td>Maximum mit Bester Freund Bonus (+1 effektives Level)</td></tr></tbody></table>',
            'faq_title'        => 'Pokemon GO IV Rechner — Häufig Gestellte Fragen',
            'faq_q1' => 'Wie berechnet man IVs in Pokemon GO?',
            'faq_a1' => 'Um IVs in Pokemon GO zu berechnen, gibst du die Art deines Pokemon, seine Angriff-, Verteidigungs- und Ausdauer-IV-Werte (jeweils 0–15) sowie sein aktuelles Level in den Rechner oben ein. Das Tool wendet die offizielle KP-Formel an — <em>(AtkBasis + IVAtk) × √(DefBasis + IVDef) × √(AusBasis + IVAus) × CPM² ÷ 10</em> — und gibt sofort den IV-Prozentwert, die Sternebewertung, KP, TP und PvP-Liga-Bewertungen zurück. Du kannst auch den Bewertungs-Tab nutzen und die Pfeil-Bewertungen deines Teamanführers direkt eingeben.',
            'faq_q2' => 'Was ist ein guter IV-Prozentwert in Pokemon GO?',
            'faq_a2' => 'Ein guter IV-Prozentwert in Pokemon GO hängt von deinem Ziel ab. Für Raids und die Meisterliga ist 90–100% (3-Sterne-Bewertung) ideal. Für Superliga und Ultra-Liga ist die Strategie komplexer — niedrige Angriffs-IVs sind oft besser, weil sie erlauben, das Pokemon auf einem höheren Level innerhalb des KP-Limits zu halten und dadurch das Statistikprodukt zu maximieren. Für entspanntes Spielen ist jedes Pokemon über 66% (2 Sterne) vollkommen nutzbar und es lohnt sich nicht, extra Sternenstaub auszugeben, um es zu ersetzen.',
            'faq_q3' => 'Was bedeuten 0★ 1★ 2★ 3★ in Pokemon GO?',
            'faq_a3' => 'Die Sternebewertung in Pokemon GO wird von deinem Teamanführer bei der Bewertung vergeben und spiegelt den IV-Prozentbereich deines Pokemon wider. 0★ bedeutet 0–48,9% IVs, 1★ deckt 51,1–64,4% ab, 2★ deckt 66,7–80% und 3★ deckt 82,2–98% ab. Ein besonderer roter Hintergrund mit 3 Sternen zeigt ein perfektes Pokemon mit 100% (15/15/15) an. Der IV Rechner oben zeigt den genauen Prozentwert zusammen mit der Sternebewertung an.',
            'faq_q4' => 'Können IVs in Pokemon GO geändert werden?',
            'faq_a4' => 'IVs können nach dem Fangen eines Pokemon nicht geändert werden — mit zwei Ausnahmen. <strong>Ein Schatten-Pokemon reinigen</strong> fügt jedem IV +2 hinzu (maximal 15), sodass ein Schatten mit 13/13/13 nach der Reinigung zu einem perfekten 15/15/15 wird. <strong>Tauschen</strong> würfelt die IVs beider getauschten Pokemon neu — ein Glückstausch garantiert mindestens 12 in allen drei Werten. Es gibt keinen anderen Mechanismus, um IVs zu ändern — Sternenstaub, Bonbons oder Evolution haben keinen Einfluss auf die IV-Werte.',
            'faq_q5' => 'Was ist der Unterschied zwischen IV% und KP in Pokemon GO?',
            'faq_a5' => 'Der IV% spiegelt die genetische Qualität eines Pokemon wider — wie nah seine versteckten Statistiken am Maximum 15/15/15 sind. KP (Kampfpunkte) ist die sichtbare Stärkenzahl, die Basiswerte, IVs und den levelabhängigen KP-Multiplikator zu einem einzigen Wert kombiniert. Ein Pokemon mit hohen IVs auf niedrigem Level kann weniger KP haben als ein Pokemon mit niedrigen IVs, das stark aufgewertet wurde. Der IV Rechner zeigt beide Werte gleichzeitig an, sodass du Qualität und aktuelle Stärke auf einen Blick beurteilen kannst.',
            'faq_q6' => 'Beeinflusst das Wetter die IVs von Pokemon in Pokemon GO?',
            'faq_a6' => 'Das Wetter ändert die IVs eines Pokemon nicht, aber wetter-geboostete Fänge haben einen garantierten IV-Mindestwert von 4 in allen drei Statistiken. Das bedeutet, das schlechteste wetter-geboostete Pokemon hat IVs von 4/4/4 (etwa 26,7%), was die schlechtesten 0-IV-Ergebnisse ausschließt. Wetter-geboostete wilde Fänge erscheinen auch mindestens auf Level 6 statt im üblichen Level-1–35-Bereich. Der IV Rechner unterstützt wetter-geboostete Pokemon vollständig — gib einfach die tatsächlichen IV-Werte ein, die nach der Bewertung im Spiel angezeigt werden.',
            'faq_q7' => 'Wie viele IV-Kombinationen sind pro Pokemon in Pokemon GO möglich?',
            'faq_a7' => 'Jedes Pokemon hat 4.096 mögliche IV-Kombinationen (16 Angriffswerte × 16 Verteidigungswerte × 16 Ausdauerwerte). Davon ist nur eine Kombination perfekt mit 100% (15/15/15), und 48 Kombinationen erreichen 98% oder mehr. Die Wahrscheinlichkeit, ein Pokemon mit 100% IVs bei einer Standard-Wildtierbegegnung zu fangen, beträgt 1/4096 (etwa 0,024%). Für Raid-Bosse und Forschungsdurchbrüche liegt der minimale IV-Boden bei 10/10/10, mit 1.296 möglichen Kombinationen — was die 100%-Wahrscheinlichkeit auf 1/216 (etwa 0,46%) erhöht.',
            'faq_q8' => 'Sollte man ein Pokemon aufwerten, bevor man seine IVs überprüft?',
            'faq_a8' => 'Es ist empfehlenswert, IVs zu überprüfen, <em>bevor</em> man Sternenstaub und Bonbons für das Aufwerten ausgibt. Das Aufleveln eines Pokemon ändert seine IVs nicht — die Werte werden beim Fangen festgelegt. Hast du ein Pokemon jedoch bereits aufgewertet, kannst du seine IVs trotzdem präzise berechnen, indem du das aktuelle Level im Rechner eingibst. Nutze den <strong>IV Rechner oben</strong>, um jedes Pokemon vor der Ressourceninvestition zu bewerten, und vergleiche mit dem Sternenstaub-Rechner, um die Gesamtkosten bis zum Ziellevel abzuschätzen.',
            'related_title'    => 'Verwandte Pokemon Rechner',
            'no_related_tools' => 'Noch keine verwandten Tools. Weitere Rechner kommen bald!',
            'blog_guides_title'=> 'Pokemon Guides &amp; Tipps',
            'blog_read_more'   => 'Guide lesen',
        ],
    ];

    // ── Language detection ────────────────────────────────────────────────────
    global $pkm_current_lang;
    $lang = $pkm_current_lang ?? 'en';
    $t    = $strings[$lang] ?? $strings['en'];

    // ── Ad slots (Loaded dynamically from Admin Settings; renders only when code is provided) ──
    $ad_slot_a     = get_setting('ad_slot_top', get_setting('ad_header_code', '')); // Top banner inside content
    $ad_slot_b     = get_setting('ad_slot_below_result', ''); // Below result card
    $ad_slot_c     = get_setting('ad_slot_mid_content', ''); // Mid-content break
    $ad_slot_d     = get_setting('ad_slot_mid_faq', ''); // Mid-FAQ
    $ad_slot_e     = get_setting('ad_slot_sky_left', get_setting('ad_slot_sidebar', '')); // LEFT sticky skyscraper 160x600
    $ad_slot_f_sky = get_setting('ad_slot_sky_right', get_setting('ad_slot_sidebar', '')); // RIGHT sticky skyscraper 160x600

    $pkm_render_ad = function( string $slot, string $extra_class = '' ): string {
        return pkm_render_ad( $slot, $extra_class );
    };

    // ── Pokemon data ──────────────────────────────────────────────────────────
    $raw = get_pokemon_data();
    $data_error = false;
    if ( empty($raw) || ! is_array($raw) ) {
        $data_error = true;
        $js_data    = [];
    } else {
        $js_data = array_map( function($p) {
            return [
                'id'     => intval( $p['id'] ?? 0 ),
                'name'   => sanitize_text_field( $p['name'] ?? '' ),
                'types'  => array_values( $p['types'] ?? [] ),
                'stats'  => array_map( 'intval', $p['stats'] ?? [] ),
                'sprite' => esc_url( trim( $p['sprite_default'] ?? '' ) ),
            ];
        }, $raw );
    }

    // ── Header Pokemon: Dragonite (149) + Snorlax (143) ──────────────────────
    $pokemon_a = get_pokemon_data(149);
    $pokemon_b = get_pokemon_data(143);
    $sprite_a  = esc_url( trim( $pokemon_a['sprite_official'] ?? $pokemon_a['sprite_default'] ?? '' ) );
    $sprite_b  = esc_url( trim( $pokemon_b['sprite_official'] ?? $pokemon_b['sprite_default'] ?? '' ) );

    // ── noscript fallback select ──────────────────────────────────────────────
    $noscript_options = '';
    if ( ! $data_error ) {
        foreach ( $raw as $p ) {
            $pid  = intval( $p['id'] ?? 0 );
            $pname = sanitize_text_field( $p['name'] ?? '' );
            $noscript_options .= '<option value="' . esc_attr($pid) . '">' . esc_html( ucfirst($pname) ) . '</option>';
        }
    }

    // ── Translations for JS ───────────────────────────────────────────────────
    $js_translations = [
        'error_select_pokemon' => $t['error_select_pokemon'],
        'error_invalid_iv'     => $t['error_invalid_iv'],
        'error_invalid_level'  => $t['error_invalid_level'],
        'error_no_results'     => $t['error_no_results'],
        'error_calculation'    => $t['error_calculation'],
        'error_bulk_empty'     => $t['error_bulk_empty'],
        'error_data_load'      => $t['error_data_load'],
        'rating_100'           => $t['rating_100'],
        'rating_98'            => $t['rating_98'],
        'rating_above_90'      => $t['rating_above_90'],
        'rating_above_80'      => $t['rating_above_80'],
        'rating_above_66'      => $t['rating_above_66'],
        'rating_below_66'      => $t['rating_below_66'],
        'stars_3'              => $t['stars_3'],
        'stars_2'              => $t['stars_2'],
        'stars_1'              => $t['stars_1'],
        'stars_0'              => $t['stars_0'],
        'hp_label'             => $t['hp_label'],
        'cp_label'             => $t['cp_label'],
        'pvp_great'            => $t['pvp_great'],
        'pvp_ultra'            => $t['pvp_ultra'],
        'pvp_master'           => $t['pvp_master'],
        'pvp_best_cp'          => $t['pvp_best_cp'],
        'pvp_best_level'       => $t['pvp_best_level'],
        'moveset_fast'         => $t['moveset_fast'],
        'moveset_charged'      => $t['moveset_charged'],
        'moveset_dps'          => $t['moveset_dps'],
        'cp_table_level'       => $t['cp_table_level'],
        'cp_table_cp'          => $t['cp_table_cp'],
        'cp_table_hp'          => $t['cp_table_hp'],
        'copied_btn'           => $t['copied_btn'],
        'copy_btn'             => $t['copy_btn'],
        'bulk_rank_col'        => $t['bulk_rank_col'],
        'bulk_pokemon_col'     => $t['bulk_pokemon_col'],
        'bulk_ivs_col'         => $t['bulk_ivs_col'],
        'bulk_iv_pct_col'      => $t['bulk_iv_pct_col'],
        'bulk_cp_col'          => $t['bulk_cp_col'],
        'bulk_rating_col'      => $t['bulk_rating_col'],
        'result_iv_pct'        => $t['result_iv_pct'],
        'result_cp'            => $t['result_cp'],
        'result_hp'            => $t['result_hp'],
        'result_level'         => $t['result_level'],
        'pvp_title'            => $t['pvp_title'],
        'moveset_title'        => $t['moveset_title'],
        'cp_table_title'       => $t['cp_table_title'],
        'cp_table_show'        => $t['cp_table_show'],
        'cp_table_hide'        => $t['cp_table_hide'],
        'error_no_results'     => $t['error_no_results'],
    ];

    ob_start();
    ?>
    <?php // ── Anti-flash dark mode script ───────────────────────────────────── ?>
    <script>!function(){var t=localStorage.getItem('pkm-theme');if(t)document.documentElement.setAttribute('data-theme',t);else if(window.matchMedia('(prefers-color-scheme: dark)').matches)document.documentElement.setAttribute('data-theme','dark');}();</script>

    <?php // ── Inject Pokemon data + translations ───────────────────────────── ?>
    <script>
    const pkmData = <?php echo wp_json_encode( array_values($js_data) ); ?>;
    const pkmTrans = <?php echo wp_json_encode( $js_translations ); ?>;
    </script>

    <?php // ── CSS ────────────────────────────────────────────────────────────── ?>
    <style>
    /* ── Google Fonts ── */
    @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Exo+2:wght@400;500;600;700;800&display=swap');

    /* ── Design System Variables ── */
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
        /* Light Mode */
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
        min-height: 100vh !important;
        padding-bottom: 60px !important;
    }

    /* ── Centered content column ── */
    .pkm-calc-wrapper {
        max-width: 1080px !important;
        margin: 0 auto !important;
        padding: 0 16px !important;
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

    /* ── Table wrapper ── */
    .pkm-table-wrapper {
        overflow-x: auto !important;
        -webkit-overflow-scrolling: touch !important;
        width: 100% !important;
        margin: 16px 0 !important;
    }

    /* ── SEO Data Table ── */
    .pkm-calc-table {
        width: 100% !important;
        border-collapse: collapse !important;
        font-family: var(--pkm-font-body) !important;
        font-size: 14px !important;
        background: var(--pkm-bg-2) !important;
        border-radius: var(--pkm-radius) !important;
        overflow: hidden !important;
    }
    .pkm-calc-table thead tr {
        background: var(--pkm-gradient) !important;
    }
    .pkm-calc-table thead th {
        padding: 12px 16px !important;
        text-align: left !important;
        font-family: var(--pkm-font-heading) !important;
        font-weight: 700 !important;
        font-size: 13px !important;
        color: #ffffff !important;
        letter-spacing: 0.3px !important;
        white-space: nowrap !important;
    }
    .pkm-calc-table tbody tr {
        border-bottom: 1px solid var(--pkm-border) !important;
        transition: background 0.15s !important;
    }
    .pkm-calc-table tbody tr:last-child {
        border-bottom: none !important;
    }
    .pkm-calc-table tbody tr:hover {
        background: var(--pkm-primary-light) !important;
    }
    .pkm-calc-table tbody tr:nth-child(even) {
        background: var(--pkm-bg-3) !important;
    }
    .pkm-calc-table tbody tr:nth-child(even):hover {
        background: var(--pkm-primary-light) !important;
    }
    .pkm-calc-table tbody td {
        padding: 11px 16px !important;
        color: var(--pkm-text) !important;
        font-size: 14px !important;
        line-height: 1.5 !important;
        vertical-align: middle !important;
    }
    .pkm-calc-table tbody td:first-child {
        font-weight: 700 !important;
        color: var(--pkm-primary) !important;
        font-family: var(--pkm-font-heading) !important;
        white-space: nowrap !important;
    }
    .pkm-calc-table tbody td:nth-child(2) {
        font-family: monospace !important;
        font-size: 13px !important;
        color: var(--pkm-text-muted) !important;
        white-space: nowrap !important;
    }
    @media (max-width: 480px) {
        .pkm-calc-table thead th,
        .pkm-calc-table tbody td {
            padding: 9px 10px !important;
            font-size: 13px !important;
        }
    }

    /* ── Related Tools Section ── */
    .pkm-related-section {
        margin: 32px 0 0 !important;
        padding: 0 !important;
    }
    .pkm-related-section-title {
        font-family: var(--pkm-font-heading) !important;
        font-size: 18px !important;
        font-weight: 800 !important;
        color: var(--pkm-text) !important;
        margin: 0 0 16px !important;
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
    }
    .pkm-related-section-title::before {
        content: '' !important;
        display: inline-block !important;
        width: 4px !important;
        height: 20px !important;
        background: var(--pkm-primary) !important;
        border-radius: 2px !important;
        flex-shrink: 0 !important;
    }
    .pkm-related-grid {
        display: grid !important;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)) !important;
        gap: 12px !important;
    }
    .pkm-related-card {
        background: var(--pkm-bg-card) !important;
        border: 1px solid var(--pkm-border) !important;
        border-radius: var(--pkm-radius) !important;
        padding: 16px !important;
        text-decoration: none !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 8px !important;
        transition: var(--pkm-transition) !important;
        box-shadow: var(--pkm-shadow-sm) !important;
    }
    .pkm-related-card:hover {
        border-color: var(--pkm-primary) !important;
        box-shadow: 0 4px 16px var(--pkm-glow) !important;
        transform: translateY(-2px) !important;
    }
    .pkm-related-card-icon {
        width: 36px !important;
        height: 36px !important;
        background: var(--pkm-primary-light) !important;
        border-radius: var(--pkm-radius-sm) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        flex-shrink: 0 !important;
    }
    .pkm-related-card-icon svg {
        width: 18px !important;
        height: 18px !important;
        color: var(--pkm-primary) !important;
        stroke: var(--pkm-primary) !important;
    }
    .pkm-related-card-title {
        font-family: var(--pkm-font-heading) !important;
        font-size: 13px !important;
        font-weight: 700 !important;
        color: var(--pkm-text) !important;
        line-height: 1.3 !important;
    }
    .pkm-related-card-desc {
        font-size: 12px !important;
        color: var(--pkm-text-muted) !important;
        line-height: 1.4 !important;
    }
    .pkm-related-empty {
        color: var(--pkm-text-muted) !important;
        font-size: 14px !important;
        padding: 20px 0 !important;
        text-align: center !important;
    }

    /* ── Blog Guides Section ── */
    .pkm-blog-section {
        margin: 32px 0 0 !important;
    }
    .pkm-blog-grid {
        display: grid !important;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)) !important;
        gap: 16px !important;
    }
    .pkm-blog-card {
        background: var(--pkm-bg-card) !important;
        border: 1px solid var(--pkm-border) !important;
        border-radius: var(--pkm-radius) !important;
        overflow: hidden !important;
        text-decoration: none !important;
        display: flex !important;
        flex-direction: column !important;
        transition: var(--pkm-transition) !important;
        box-shadow: var(--pkm-shadow-sm) !important;
    }
    .pkm-blog-card:hover {
        border-color: var(--pkm-primary) !important;
        box-shadow: 0 4px 16px var(--pkm-glow) !important;
        transform: translateY(-2px) !important;
    }
    .pkm-blog-card-thumb {
        width: 100% !important;
        height: 140px !important;
        object-fit: cover !important;
        background: var(--pkm-bg-3) !important;
        display: block !important;
    }
    .pkm-blog-card-thumb-placeholder {
        width: 100% !important;
        height: 140px !important;
        background: var(--pkm-gradient) !important;
        opacity: 0.15 !important;
        display: block !important;
    }
    .pkm-blog-card-body {
        padding: 14px 16px !important;
        flex: 1 !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 8px !important;
    }
    .pkm-blog-card-title {
        font-family: var(--pkm-font-heading) !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        color: var(--pkm-text) !important;
        line-height: 1.4 !important;
    }
    .pkm-blog-card-date {
        font-size: 12px !important;
        color: var(--pkm-text-subtle) !important;
    }
    .pkm-blog-card-read {
        display: inline-flex !important;
        align-items: center !important;
        gap: 4px !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        color: var(--pkm-primary) !important;
        margin-top: auto !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
    }

    /* ── Calculator Header ── */
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

    /* ── Tabs — all 3 in one row ── */
    .pkm-tabs {
        display: flex !important;
        gap: 4px !important;
        background: var(--pkm-bg-3) !important;
        border-radius: var(--pkm-radius) !important;
        padding: 4px !important;
        margin-bottom: 24px !important;
        border: 1px solid var(--pkm-border) !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }
    .pkm-tab-btn {
        flex: 1 !important;
        padding: 11px 12px !important;
        background: transparent !important;
        border: none !important;
        border-radius: var(--pkm-radius-sm) !important;
        color: var(--pkm-text-muted) !important;
        font-family: var(--pkm-font-heading) !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        cursor: pointer !important;
        transition: var(--pkm-transition) !important;
        min-height: 46px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 7px !important;
        white-space: nowrap !important;
        letter-spacing: 0.01em !important;
    }
    .pkm-tab-btn:hover {
        background: var(--pkm-bg-2) !important;
        color: var(--pkm-text) !important;
    }
    .pkm-tab-btn.active {
        background: var(--pkm-primary) !important;
        color: #FFFFFF !important;
        box-shadow: 0 2px 12px rgba(13, 148, 136, 0.35) !important;
    }
    @media (max-width: 400px) {
        .pkm-tab-btn { font-size: 12px !important; padding: 10px 6px !important; gap: 4px !important; }
        .pkm-tab-btn .pkm-icon { display: none !important; }
    }
    .pkm-tab-panel { display: none !important; }
    .pkm-tab-panel.active { display: block !important; }

    /* ── Card ── */
    .pkm-card {
        background: var(--pkm-bg-card) !important;
        border: 1px solid var(--pkm-border) !important;
        border-radius: var(--pkm-radius-lg) !important;
        padding: 28px !important;
        box-shadow: var(--pkm-shadow) !important;
        margin-bottom: 20px !important;
        backdrop-filter: blur(8px) !important;
    }
    @media (max-width: 480px) { .pkm-card { padding: 18px 16px !important; } }
    .pkm-card-title {
        font-family: var(--pkm-font-heading) !important;
        font-size: 17px !important;
        font-weight: 800 !important;
        color: var(--pkm-text) !important;
        margin: 0 0 20px !important;
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        padding-bottom: 14px !important;
        border-bottom: 1px solid var(--pkm-border) !important;
    }

    /* ── Form fields ── */
    .pkm-field {
        margin-bottom: 22px !important;
    }
    .pkm-label {
        display: flex !important;
        align-items: center !important;
        gap: 7px !important;
        font-family: var(--pkm-font-heading) !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        color: var(--pkm-text-muted) !important;
        margin-bottom: 10px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.07em !important;
    }
    .pkm-input {
        width: 100% !important;
        padding: 13px 16px !important;
        background: var(--pkm-input-bg) !important;
        border: 1.5px solid var(--pkm-border) !important;
        border-radius: var(--pkm-radius-sm) !important;
        color: var(--pkm-text) !important;
        font-family: var(--pkm-font-body) !important;
        font-size: 16px !important;
        transition: var(--pkm-transition) !important;
        box-sizing: border-box !important;
        min-height: 48px !important;
        outline: none !important;
        -webkit-appearance: none !important;
        appearance: none !important;
    }
    .pkm-input:focus {
        border-color: var(--pkm-primary) !important;
        box-shadow: 0 0 0 3px var(--pkm-primary-light) !important;
        background: var(--pkm-bg-2) !important;
    }
    .pkm-input::placeholder { color: var(--pkm-text-subtle) !important; }

    /* ── IV Slider Row ── */
    .pkm-iv-row {
        display: grid !important;
        grid-template-columns: 1fr auto !important;
        gap: 14px !important;
        align-items: center !important;
    }
    .pkm-iv-slider-wrap {
        position: relative !important;
        display: flex !important;
        align-items: center !important;
    }
   .pkm-iv-slider {
    -webkit-appearance: none !important;
    appearance: none !important;
    width: 100% !important;
    height: 6px !important;  /* Reduced from 8px */
    background: var(--pkm-bg-3) !important;
    border-radius: 3px !important;
    outline: none !important;
    cursor: pointer !important;
    min-height: 6px !important; /* Match height */
    border: none !important;
    padding: 0 !important;
}
    .pkm-iv-slider::-webkit-slider-thumb {
    -webkit-appearance: none !important;
    appearance: none !important;
    width: 18px !important;  /* Reduced from 24px */
    height: 18px !important; /* Reduced from 24px */
    border-radius: 50% !important;
    background: var(--pkm-primary) !important;
    cursor: pointer !important;
    box-shadow: 0 2px 6px rgba(13,148,136,0.45) !important;
    border: 2px solid #fff !important; /* Reduced from 3px */
    transition: transform 0.15s !important;
    margin-top: -6px !important; /* Center on track */
}
.pkm-iv-slider::-moz-range-thumb {
    width: 18px !important;  /* Reduced from 24px */
    height: 18px !important; /* Reduced from 24px */
    border-radius: 50% !important;
    background: var(--pkm-primary) !important;
    cursor: pointer !important;
    box-shadow: 0 2px 6px rgba(13,148,136,0.45) !important;
    border: 2px solid #fff !important; /* Reduced from 3px */
}
    .pkm-iv-slider::-webkit-slider-thumb:hover { transform: scale(1.15) !important; }
   
    /* Colored track fill via background gradient - updated by JS */
.pkm-iv-slider.pkm-slider-styled {
    background: linear-gradient(to right, var(--pkm-primary) 0%, var(--pkm-primary) var(--fill), var(--pkm-bg-3) var(--fill), var(--pkm-bg-3) 100%) !important;
    height: 6px !important; /* Ensure consistency */
    border-radius: 3px !important;
}
    .pkm-iv-number {
        width: 60px !important;
        min-width: 60px !important;
        padding: 8px 4px !important;
        text-align: center !important;
        font-weight: 800 !important;
        font-size: 17px !important;
        color: var(--pkm-primary) !important;
        background: var(--pkm-input-bg) !important;
        border: 1.5px solid var(--pkm-border) !important;
        border-radius: var(--pkm-radius-sm) !important;
        outline: none !important;
        -webkit-appearance: none !important;
        appearance: none !important;
        min-height: 48px !important;
    }
    .pkm-iv-number:focus { border-color: var(--pkm-primary) !important; box-shadow: 0 0 0 3px var(--pkm-primary-light) !important; }

    /* ── Level slider ── */
    .pkm-level-display {
        font-family: var(--pkm-font-heading) !important;
        font-size: 28px !important;
        font-weight: 800 !important;
        color: var(--pkm-primary) !important;
        text-align: center !important;
        margin-bottom: 8px !important;
        line-height: 1 !important;
    }
    .pkm-level-slider-wrap {
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
    }
    .pkm-level-step-btn {
        width: 36px !important;
        height: 36px !important;
        min-width: 36px !important;
        border-radius: 50% !important;
        border: 1.5px solid var(--pkm-border) !important;
        background: var(--pkm-input-bg) !important;
        color: var(--pkm-text) !important;
        font-size: 18px !important;
        cursor: pointer !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        transition: var(--pkm-transition) !important;
        flex-shrink: 0 !important;
        padding: 0 !important;
        line-height: 1 !important;
    }
    .pkm-level-step-btn:hover { background: var(--pkm-primary) !important; color: #fff !important; border-color: var(--pkm-primary) !important; }

    /* ── Appraisal — redesigned for clarity ── */
    .pkm-appraisal-grid {
        display: grid !important;
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 10px !important;
    }
    @media (max-width: 400px) {
        .pkm-appraisal-grid { grid-template-columns: 1fr !important; }
    }
    .pkm-appraisal-stat-block {
        background: var(--pkm-bg-3) !important;
        border-radius: var(--pkm-radius-sm) !important;
        padding: 12px 8px !important;
        border: 1px solid var(--pkm-border) !important;
        text-align: center !important;
    }
    .pkm-appraisal-stat-label {
        font-family: var(--pkm-font-heading) !important;
        font-size: 11px !important;
        font-weight: 800 !important;
        color: var(--pkm-text-muted) !important;
        text-align: center !important;
        margin-bottom: 10px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.06em !important;
    }
    .pkm-appraisal-arrows {
        display: flex !important;
        justify-content: center !important;
        gap: 6px !important;
        margin-bottom: 8px !important;
    }
    .pkm-arrow-btn {
        flex: 1 !important;
        min-width: 0 !important;
        height: 44px !important;
        border-radius: var(--pkm-radius-sm) !important;
        border: 1.5px solid var(--pkm-border) !important;
        background: var(--pkm-input-bg) !important;
        cursor: pointer !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        transition: var(--pkm-transition) !important;
        padding: 4px 2px !important;
        color: var(--pkm-text-muted) !important;
        gap: 2px !important;
    }
    .pkm-arrow-label {
        font-size: 9px !important;
        font-weight: 700 !important;
        letter-spacing: 0.03em !important;
        line-height: 1 !important;
        font-family: var(--pkm-font-heading) !important;
    }
    .pkm-arrow-btn:hover { border-color: var(--pkm-primary) !important; background: var(--pkm-bg-2) !important; }
    .pkm-arrow-btn.active-1 { background: rgba(13,148,136,0.12) !important; border-color: var(--pkm-primary) !important; color: var(--pkm-primary) !important; }
    .pkm-arrow-btn.active-2 { background: rgba(244,208,63,0.2) !important; border-color: #D4A017 !important; color: #A07800 !important; }
    .pkm-arrow-btn.active-3 { background: rgba(46,204,113,0.15) !important; border-color: var(--pkm-accent-2) !important; color: #1a9e52 !important; }
    [data-theme="dark"] .pkm-arrow-btn.active-2 { color: var(--pkm-accent) !important; border-color: var(--pkm-accent) !important; }
    [data-theme="dark"] .pkm-arrow-btn.active-3 { color: var(--pkm-accent-2) !important; }
    .pkm-appraisal-selected-label {
        font-size: 11px !important;
        font-weight: 700 !important;
        font-family: var(--pkm-font-heading) !important;
        text-align: center !important;
        margin-top: 6px !important;
        color: var(--pkm-text-subtle) !important;
        min-height: 14px !important;
        letter-spacing: 0.02em !important;
    }
    .pkm-appraisal-hint {
        font-size: 12px !important;
        color: var(--pkm-text-subtle) !important;
        margin-top: 12px !important;
        font-style: italic !important;
        text-align: center !important;
        line-height: 1.5 !important;
    }

    /* ── Pokemon Search ── */
    .pkm-search-wrap {
        position: relative !important;
    }
    .pkm-search-input-wrap {
        position: relative !important;
        display: flex !important;
        align-items: center !important;
    }
    .pkm-search-icon {
        position: absolute !important;
        left: 12px !important;
        color: var(--pkm-text-subtle) !important;
        pointer-events: none !important;
    }
    .pkm-search-input {
        padding-left: 40px !important;
    }
    .pkm-search-clear {
        position: absolute !important;
        right: 10px !important;
        background: none !important;
        border: none !important;
        cursor: pointer !important;
        color: var(--pkm-text-subtle) !important;
        display: none !important;
        padding: 4px !important;
        border-radius: 50% !important;
        min-height: 30px !important;
        min-width: 30px !important;
        align-items: center !important;
        justify-content: center !important;
    }
    .pkm-search-clear:hover { color: var(--pkm-primary) !important; }
    .pkm-bulk-row .pkm-search-results {
    position: absolute !important;
    top: calc(100% + 4px) !important;
    left: 0 !important;
    right: 0 !important;
    background: var(--pkm-bg-2) !important;
    border: 1.5px solid var(--pkm-border) !important;
    border-radius: var(--pkm-radius) !important;
    box-shadow: var(--pkm-shadow) !important;
    max-height: 280px !important;
    overflow-y: auto !important;
    z-index: 999 !important; /* Ensure this is high */
    display: none !important;
}
/* Ensure bulk search results are visible above other rows */
.pkm-bulk-row .pkm-search-results.open {
    display: block !important;
    z-index: 1000 !important;
}
    .pkm-search-results.open { display: block !important; }
    .pkm-search-result-item {
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        padding: 10px 14px !important;
        cursor: pointer !important;
        transition: var(--pkm-transition) !important;
        border-bottom: 1px solid var(--pkm-border) !important;
        min-height: 48px !important;
    }
    .pkm-search-result-item:last-child { border-bottom: none !important; }
    .pkm-search-result-item:hover,
    .pkm-search-result-item.keyboard-focus {
        background: var(--pkm-primary-light) !important;
    }
    .pkm-search-result-sprite {
        width: 36px !important;
        height: 36px !important;
        object-fit: contain !important;
        flex-shrink: 0 !important;
        image-rendering: pixelated !important;
    }
    .pkm-search-result-name {
        font-family: var(--pkm-font-heading) !important;
        font-weight: 600 !important;
        font-size: 14px !important;
        color: var(--pkm-text) !important;
        flex: 1 !important;
    }
    .pkm-search-result-id {
        font-size: 11px !important;
        color: var(--pkm-text-subtle) !important;
        font-family: var(--pkm-font-body) !important;
    }
    .pkm-search-no-results {
        padding: 16px !important;
        text-align: center !important;
        color: var(--pkm-text-muted) !important;
        font-size: 14px !important;
    }
    .pkm-selected-pokemon-badge {
        display: none !important;
        align-items: center !important;
        gap: 10px !important;
        padding: 10px 14px !important;
        background: var(--pkm-primary-light) !important;
        border-radius: var(--pkm-radius-sm) !important;
        margin-top: 8px !important;
        border: 1px solid rgba(13, 148, 136, 0.2) !important;
    }
    .pkm-selected-pokemon-badge.visible { display: flex !important; }
    .pkm-selected-badge-sprite {
        width: 36px !important;
        height: 36px !important;
        object-fit: contain !important;
        image-rendering: pixelated !important;
    }
    .pkm-selected-badge-name {
        font-family: var(--pkm-font-heading) !important;
        font-weight: 700 !important;
        font-size: 15px !important;
        color: var(--pkm-primary) !important;
        flex: 1 !important;
    }
    .pkm-selected-badge-types {
        display: flex !important;
        gap: 4px !important;
    }

    /* ── Type badges ── */
    .pkm-type-badge {
        display: inline-block !important;
        padding: 2px 8px !important;
        border-radius: 4px !important;
        font-size: 10px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.06em !important;
        color: #fff !important;
        white-space: nowrap !important;
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

    /* ── Buttons ── */
    .pkm-btn {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        padding: 14px 24px !important;
        border-radius: var(--pkm-radius) !important;
        border: none !important;
        font-family: var(--pkm-font-heading) !important;
        font-size: 15px !important;
        font-weight: 700 !important;
        cursor: pointer !important;
        transition: var(--pkm-transition) !important;
        text-decoration: none !important;
        min-height: 48px !important;
        white-space: nowrap !important;
    }
    .pkm-btn-primary {
        background: var(--pkm-primary) !important;
        color: #FFFFFF !important;
        box-shadow: 0 4px 16px var(--pkm-glow) !important;
        width: 100% !important;
    }
    .pkm-btn-primary:hover { background: var(--pkm-primary-hover) !important; transform: translateY(-1px) !important; box-shadow: 0 6px 20px var(--pkm-glow) !important; }
    .pkm-btn-primary:active { transform: translateY(0) !important; }
    .pkm-btn-secondary {
        background: var(--pkm-bg-3) !important;
        color: var(--pkm-text-muted) !important;
        border: 1.5px solid var(--pkm-border) !important;
    }
    .pkm-btn-secondary:hover { background: var(--pkm-bg-2) !important; color: var(--pkm-text) !important; border-color: var(--pkm-border-hover) !important; }
    .pkm-btn-sm {
        padding: 8px 14px !important;
        font-size: 13px !important;
        min-height: 36px !important;
    }
    .pkm-btn-row {
        display: flex !important;
        gap: 12px !important;
        margin-top: 8px !important;
    }
    .pkm-btn-row .pkm-btn-primary { flex: 1 !important; }

    /* ── Result card ── */
    .pkm-result-card {
        display: none !important;
        background: var(--pkm-bg-card) !important;
        border: 2px solid var(--pkm-primary) !important;
        border-radius: var(--pkm-radius-lg) !important;
        padding: 28px 24px !important;
        margin-bottom: 20px !important;
        box-shadow: 0 0 0 4px var(--pkm-primary-light), var(--pkm-shadow) !important;
        animation: pkm-result-in 0.35s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
    }
    .pkm-result-card.visible { display: block !important; }
    @keyframes pkm-result-in {
        from { opacity: 0; transform: translateY(16px) scale(0.97); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }
    .pkm-result-header {
        display: flex !important;
        align-items: center !important;
        gap: 16px !important;
        margin-bottom: 24px !important;
        flex-wrap: wrap !important;
    }
    .pkm-result-sprite-wrap {
        position: relative !important;
        flex-shrink: 0 !important;
    }
    .pkm-result-sprite {
        width: 72px !important;
        height: 72px !important;
        object-fit: contain !important;
        image-rendering: pixelated !important;
        filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2)) !important;
    }
    .pkm-result-info { flex: 1 !important; min-width: 0 !important; }
    .pkm-result-name {
        font-family: var(--pkm-font-heading) !important;
        font-size: 22px !important;
        font-weight: 800 !important;
        color: var(--pkm-text) !important;
        margin: 0 0 4px !important;
        line-height: 1.2 !important;
    }
    .pkm-result-types { display: flex !important; gap: 4px !important; margin-bottom: 6px !important; }
    .pkm-result-star-rating {
        font-family: var(--pkm-font-heading) !important;
        font-size: 13px !important;
        color: var(--pkm-text-muted) !important;
        font-weight: 600 !important;
    }
    /* IV% gauge */
    .pkm-iv-gauge-wrap {
        margin-bottom: 24px !important;
    }
    .pkm-iv-gauge-labels {
        display: flex !important;
        justify-content: space-between !important;
        align-items: baseline !important;
        margin-bottom: 8px !important;
    }
    .pkm-iv-gauge-label {
        font-family: var(--pkm-font-heading) !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        color: var(--pkm-text-muted) !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
    }
    .pkm-iv-gauge-pct {
        font-family: var(--pkm-font-heading) !important;
        font-size: 36px !important;
        font-weight: 800 !important;
        color: var(--pkm-primary) !important;
        line-height: 1 !important;
    }
    .pkm-iv-gauge-rating {
        font-size: 13px !important;
        color: var(--pkm-text-muted) !important;
        font-weight: 600 !important;
        font-family: var(--pkm-font-heading) !important;
    }
    .pkm-iv-gauge-bar-bg {
        height: 14px !important;
        background: var(--pkm-bg-3) !important;
        border-radius: 7px !important;
        overflow: hidden !important;
        border: 1px solid var(--pkm-border) !important;
    }
    .pkm-iv-gauge-bar-fill {
        height: 100% !important;
        border-radius: 7px !important;
        background: linear-gradient(90deg, #E63946 0%, #ff6b6b 50%, #F4D03F 85%, #2ECC71 100%) !important;
        background-size: 200% 100% !important;
        transition: width 0.9s cubic-bezier(0.4,0,0.2,1) !important;
        width: 0 !important;
        position: relative !important;
    }
    .pkm-iv-gauge-bar-fill::after {
        content: '' !important;
        position: absolute !important;
        right: 0 !important;
        top: 0 !important;
        bottom: 0 !important;
        width: 4px !important;
        background: rgba(255,255,255,0.5) !important;
        border-radius: 2px !important;
    }
    /* Stats row */
    .pkm-result-stats {
        display: grid !important;
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 12px !important;
        margin-bottom: 20px !important;
    }
    .pkm-stat-pill {
        background: var(--pkm-bg-3) !important;
        border-radius: var(--pkm-radius-sm) !important;
        padding: 10px 8px !important;
        text-align: center !important;
        border: 1px solid var(--pkm-border) !important;
    }
    .pkm-stat-pill-label {
        font-size: 11px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
        color: var(--pkm-text-subtle) !important;
        margin-bottom: 4px !important;
        font-family: var(--pkm-font-heading) !important;
    }
    .pkm-stat-pill-value {
        font-size: 18px !important;
        font-weight: 800 !important;
        color: var(--pkm-text) !important;
        font-family: var(--pkm-font-heading) !important;
        line-height: 1 !important;
    }
    .pkm-stat-pill-sub {
        font-size: 10px !important;
        color: var(--pkm-text-subtle) !important;
        margin-top: 2px !important;
    }

    /* ── PvP section ── */
    .pkm-pvp-grid {
        display: grid !important;
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 10px !important;
        margin-bottom: 20px !important;
    }
    @media (max-width: 480px) {
        .pkm-pvp-grid { grid-template-columns: 1fr !important; }
        .pkm-result-stats { grid-template-columns: repeat(3, 1fr) !important; }
    }
    .pkm-pvp-card {
        background: var(--pkm-bg-3) !important;
        border-radius: var(--pkm-radius-sm) !important;
        padding: 14px 10px !important;
        text-align: center !important;
        border: 1px solid var(--pkm-border) !important;
        transition: var(--pkm-transition) !important;
    }
    .pkm-pvp-card:hover { border-color: var(--pkm-border-hover) !important; }
    .pkm-pvp-league-name {
        font-family: var(--pkm-font-heading) !important;
        font-size: 11px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.06em !important;
        color: var(--pkm-text-muted) !important;
        margin-bottom: 6px !important;
    }
    .pkm-pvp-best-cp {
        font-family: var(--pkm-font-heading) !important;
        font-size: 20px !important;
        font-weight: 800 !important;
        color: var(--pkm-text) !important;
        line-height: 1 !important;
        margin-bottom: 2px !important;
    }
    .pkm-pvp-best-level {
        font-size: 11px !important;
        color: var(--pkm-text-subtle) !important;
    }
    .pkm-pvp-eligible {
        display: inline-block !important;
        margin-top: 6px !important;
        padding: 2px 8px !important;
        border-radius: 4px !important;
        font-size: 10px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.06em !important;
    }
    .pkm-pvp-eligible.yes { background: rgba(46,204,113,0.15) !important; color: #1a9e52 !important; }
    .pkm-pvp-eligible.no  { background: rgba(160,174,192,0.15) !important; color: var(--pkm-text-subtle) !important; }
    [data-theme="dark"] .pkm-pvp-eligible.yes { color: var(--pkm-accent-2) !important; }

    /* ── Moveset ── */
    .pkm-moveset-grid {
        display: grid !important;
        grid-template-columns: 1fr 1fr !important;
        gap: 10px !important;
        margin-bottom: 20px !important;
    }
    @media (max-width: 400px) { .pkm-moveset-grid { grid-template-columns: 1fr !important; } }
    .pkm-move-card {
        background: var(--pkm-bg-3) !important;
        border-radius: var(--pkm-radius-sm) !important;
        padding: 12px !important;
        border: 1px solid var(--pkm-border) !important;
    }
    .pkm-move-kind {
        font-size: 10px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.06em !important;
        color: var(--pkm-text-subtle) !important;
        margin-bottom: 4px !important;
        font-family: var(--pkm-font-heading) !important;
    }
    .pkm-move-name {
        font-family: var(--pkm-font-heading) !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        color: var(--pkm-text) !important;
        margin-bottom: 4px !important;
    }
    .pkm-move-meta {
        display: flex !important;
        gap: 6px !important;
        align-items: center !important;
        flex-wrap: wrap !important;
    }
    .pkm-move-dps {
        font-size: 12px !important;
        color: var(--pkm-text-muted) !important;
    }

    /* ── CP Level table ── */
    .pkm-cp-table-toggle {
        width: 100% !important;
        background: var(--pkm-bg-3) !important;
        border: 1.5px solid var(--pkm-border) !important;
        border-radius: var(--pkm-radius-sm) !important;
        padding: 12px 16px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        cursor: pointer !important;
        color: var(--pkm-text) !important;
        font-family: var(--pkm-font-heading) !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        transition: var(--pkm-transition) !important;
        min-height: 44px !important;
        text-align: left !important;
    }
    .pkm-cp-table-toggle:hover { background: var(--pkm-bg-2) !important; border-color: var(--pkm-border-hover) !important; }
    .pkm-cp-table-body {
        display: none !important;
        margin-top: 12px !important;
    }
    .pkm-cp-table-body.open { display: block !important; }
    .pkm-cp-table {
        width: 100% !important;
        border-collapse: collapse !important;
        font-size: 13px !important;
        font-family: var(--pkm-font-body) !important;
    }
    .pkm-cp-table th {
        background: var(--pkm-bg-3) !important;
        padding: 8px 12px !important;
        text-align: left !important;
        font-family: var(--pkm-font-heading) !important;
        font-size: 11px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.06em !important;
        color: var(--pkm-text-muted) !important;
        border-bottom: 2px solid var(--pkm-border) !important;
        white-space: nowrap !important;
    }
    .pkm-cp-table td {
        padding: 7px 12px !important;
        border-bottom: 1px solid var(--pkm-border) !important;
        color: var(--pkm-text) !important;
    }
    .pkm-cp-table tr:last-child td { border-bottom: none !important; }
    .pkm-cp-table tr:nth-child(even) td { background: var(--pkm-bg-3) !important; }
    .pkm-cp-table td.pkm-current-level {
        font-weight: 700 !important;
        color: var(--pkm-primary) !important;
    }
    .pkm-cp-table tr.pkm-current-level-row td { background: var(--pkm-primary-light) !important; }

    /* ── Bulk checker — fixed layout ── */
.pkm-bulk-rows { margin-bottom: 16px !important; }
.pkm-bulk-row {
    display: flex !important;
    flex-direction: column !important;
    gap: 0 !important;
    margin-bottom: 12px !important;
    background: var(--pkm-bg-card) !important;
    border-radius: var(--pkm-radius) !important;
    border: 1px solid var(--pkm-border) !important;
    /* overflow: hidden removed to allow dropdown to show */
    animation: pkm-row-in 0.2s ease !important;
    box-shadow: var(--pkm-shadow-sm) !important;
    position: relative !important;
    z-index: 1 !important;
}
.pkm-bulk-row:focus-within {
    z-index: 10 !important; /* Bring active row above others */
}
    @keyframes pkm-row-in {
        from { opacity: 0; transform: translateY(-6px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .pkm-bulk-row-top {
        display: grid !important;
        grid-template-columns: 1fr 52px 52px 52px 40px !important;
        gap: 8px !important;
        align-items: center !important;
        padding: 10px 12px !important;
    }
    @media (max-width: 520px) {
        .pkm-bulk-row-top {
            grid-template-columns: 1fr 44px 44px 44px 36px !important;
            gap: 6px !important;
            padding: 8px 10px !important;
        }
    }
    @media (max-width: 360px) {
        .pkm-bulk-row-top {
            grid-template-columns: 1fr !important;
            grid-template-rows: auto auto !important;
        }
        .pkm-bulk-iv-group {
            display: grid !important;
            grid-template-columns: 1fr 1fr 1fr 36px !important;
            gap: 6px !important;
        }
    }
    .pkm-bulk-iv-group {
        display: contents !important;
    }
    .pkm-bulk-iv-col {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        gap: 2px !important;
    }
    .pkm-bulk-iv-col-label {
        font-size: 9px !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.06em !important;
        color: var(--pkm-text-subtle) !important;
        font-family: var(--pkm-font-heading) !important;
        white-space: nowrap !important;
    }
    .pkm-bulk-iv-input {
        width: 100% !important;
        padding: 6px 4px !important;
        text-align: center !important;
        font-weight: 800 !important;
        font-size: 15px !important;
        color: var(--pkm-primary) !important;
        background: var(--pkm-input-bg) !important;
        border: 1.5px solid var(--pkm-border) !important;
        border-radius: var(--pkm-radius-sm) !important;
        outline: none !important;
        min-height: 40px !important;
        -webkit-appearance: none !important;
        appearance: none !important;
        box-sizing: border-box !important;
    }
    .pkm-bulk-iv-input:focus { border-color: var(--pkm-primary) !important; box-shadow: 0 0 0 2px var(--pkm-primary-light) !important; }
    .pkm-bulk-remove {
        width: 32px !important;
        height: 32px !important;
        border-radius: 50% !important;
        border: 1.5px solid var(--pkm-border) !important;
        background: transparent !important;
        color: var(--pkm-text-muted) !important;
        cursor: pointer !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        transition: var(--pkm-transition) !important;
        flex-shrink: 0 !important;
        padding: 0 !important;
        align-self: center !important;
    }
    .pkm-bulk-remove:hover { background: rgba(13, 148, 136, 0.1) !important; color: var(--pkm-primary) !important; border-color: var(--pkm-primary) !important; }
    /* Selected Pokemon badge shown below search in bulk row */
    .pkm-bulk-selected-badge {
        display: none !important;
        align-items: center !important;
        gap: 8px !important;
        padding: 8px 12px !important;
        background: var(--pkm-primary-light) !important;
        border-top: 1px solid rgba(13,148,136,0.15) !important;
    }
    .pkm-bulk-selected-badge.visible { display: flex !important; }
    .pkm-bulk-badge-sprite {
        width: 32px !important;
        height: 32px !important;
        object-fit: contain !important;
        image-rendering: pixelated !important;
        flex-shrink: 0 !important;
    }
    .pkm-bulk-badge-name {
        font-family: var(--pkm-font-heading) !important;
        font-size: 13px !important;
        font-weight: 700 !important;
        color: var(--pkm-primary) !important;
        flex: 1 !important;
    }
    .pkm-bulk-badge-types {
        display: flex !important;
        gap: 4px !important;
        flex-wrap: wrap !important;
    }
    /* IV column headers row */
    .pkm-bulk-header-row {
        display: grid !important;
        grid-template-columns: 1fr 52px 52px 52px 40px !important;
        gap: 8px !important;
        padding: 6px 12px !important;
        background: var(--pkm-bg-3) !important;
        border-bottom: 1px solid var(--pkm-border) !important;
    }
    @media (max-width: 520px) {
        .pkm-bulk-header-row { grid-template-columns: 1fr 44px 44px 44px 36px !important; gap: 6px !important; padding: 6px 10px !important; }
    }
    .pkm-bulk-header-cell {
        font-size: 10px !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.07em !important;
        color: var(--pkm-text-subtle) !important;
        text-align: center !important;
        font-family: var(--pkm-font-heading) !important;
    }
    .pkm-bulk-header-cell:first-child { text-align: left !important; }
    .pkm-bulk-add-row {
        display: flex !important;
        gap: 10px !important;
        margin-bottom: 16px !important;
        flex-wrap: wrap !important;
        align-items: center !important;
    }
    @media (max-width: 400px) {
        .pkm-bulk-add-row { gap: 8px !important; }
        .pkm-bulk-add-row .pkm-btn { flex: 1 !important; min-width: 0 !important; font-size: 13px !important; }
    }
    .pkm-bulk-results-table { width: 100% !important; border-collapse: collapse !important; font-size: 14px !important; }
    .pkm-bulk-results-table th {
        background: var(--pkm-bg-3) !important;
        padding: 10px 12px !important;
        text-align: left !important;
        font-family: var(--pkm-font-heading) !important;
        font-size: 11px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.06em !important;
        color: var(--pkm-text-muted) !important;
        border-bottom: 2px solid var(--pkm-border) !important;
        white-space: nowrap !important;
    }
    .pkm-bulk-results-table td {
        padding: 10px 12px !important;
        border-bottom: 1px solid var(--pkm-border) !important;
        color: var(--pkm-text) !important;
        vertical-align: middle !important;
    }
    .pkm-bulk-results-table tr:last-child td { border-bottom: none !important; }
    .pkm-bulk-results-table tr:nth-child(odd) td { background: var(--pkm-bg-3) !important; }
    .pkm-bulk-rank-badge {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 28px !important;
        height: 28px !important;
        border-radius: 50% !important;
        font-weight: 800 !important;
        font-size: 12px !important;
        background: var(--pkm-bg-3) !important;
        color: var(--pkm-text-muted) !important;
        border: 1.5px solid var(--pkm-border) !important;
    }
    .pkm-bulk-rank-badge.rank-1 { background: #FFD700 !important; color: #6B4F00 !important; border-color: #FFD700 !important; }
    .pkm-bulk-rank-badge.rank-2 { background: #C0C0C0 !important; color: #444 !important; border-color: #C0C0C0 !important; }
    .pkm-bulk-rank-badge.rank-3 { background: #CD7F32 !important; color: #fff !important; border-color: #CD7F32 !important; }
    .pkm-bulk-sprite {
        width: 32px !important;
        height: 32px !important;
        object-fit: contain !important;
        image-rendering: pixelated !important;
        vertical-align: middle !important;
    }
    .pkm-bulk-placeholder {
        text-align: center !important;
        color: var(--pkm-text-subtle) !important;
        font-size: 14px !important;
        padding: 24px !important;
        font-style: italic !important;
    }

    /* ── Advanced section toggle ── */
    .pkm-advanced-section { display: none !important; }
    .pkm-advanced-section.visible { display: block !important; }

    /* ── Error/validation states ── */
    .pkm-calc-error-box {
        display: flex !important;
        align-items: flex-start !important;
        gap: 12px !important;
        padding: 16px !important;
        background: rgba(13,148,136,0.08) !important;
        border: 1.5px solid rgba(13, 148, 136, 0.3) !important;
        border-radius: var(--pkm-radius-sm) !important;
        color: var(--pkm-primary) !important;
        font-size: 14px !important;
        margin-bottom: 16px !important;
        line-height: 1.5 !important;
    }
    .pkm-validation-errors {
        list-style: none !important;
        margin: 0 0 16px !important;
        padding: 0 !important;
    }
    .pkm-validation-errors li {
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        padding: 8px 12px !important;
        background: rgba(13,148,136,0.08) !important;
        border-left: 3px solid var(--pkm-primary) !important;
        border-radius: 0 var(--pkm-radius-sm) var(--pkm-radius-sm) 0 !important;
        color: var(--pkm-primary) !important;
        font-size: 13px !important;
        margin-bottom: 6px !important;
        font-weight: 500 !important;
    }

    /* ── Ad block ── */
    .pkm-calc-ad-block {
        text-align: center !important;
        margin: 20px 0 !important;
        overflow: hidden !important;
    }

    /* ── Responsive adjustments ── */
    @media (max-width: 768px) {
        .pkm-card { padding: 18px 16px !important; }
        .pkm-result-card { padding: 20px 16px !important; }
        .pkm-calc-header { padding: 32px 16px 28px !important; }
        .pkm-tabs { gap: 3px !important; padding: 3px !important; }
        .pkm-tab-btn { padding: 10px 8px !important; font-size: 13px !important; }
        .pkm-result-stats { grid-template-columns: repeat(3, 1fr) !important; gap: 8px !important; }
        .pkm-pvp-grid { grid-template-columns: 1fr !important; }
        .pkm-appraisal-grid { grid-template-columns: repeat(3, 1fr) !important; }
    }
    @media (max-width: 480px) {
        .pkm-calc-title { font-size: 12px !important; }
        .pkm-result-stats { grid-template-columns: repeat(3, 1fr) !important; gap: 6px !important; }
        .pkm-stat-pill-value { font-size: 15px !important; }
        .pkm-iv-gauge-pct { font-size: 28px !important; }
        .pkm-result-name { font-size: 18px !important; }
        .pkm-pvp-grid { grid-template-columns: 1fr !important; }
    }
    @media (max-width: 360px) {
        .pkm-tab-btn { font-size: 11px !important; padding: 9px 4px !important; }
        .pkm-appraisal-grid { grid-template-columns: 1fr !important; gap: 8px !important; }
        .pkm-iv-gauge-pct { font-size: 24px !important; }
    }
    </style>

    <?php // ── HTML OUTPUT ────────────────────────────────────────────────────── ?>
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

            <?php // ── HEADER ─────────────────────────────────────────────────── ?>
            <div class="pkm-calc-header">
                <div class="pkm-calc-header-glow" aria-hidden="true"></div>
                <div class="pkm-calc-header-sprites" aria-hidden="true">
                    <img src="<?php echo $sprite_a; ?>"
                         alt="" width="80" height="80" loading="eager"
                         onerror="this.style.display='none'"
                         class="pkm-header-sprite pkm-header-sprite-left">
                    <img src="<?php echo $sprite_b; ?>"
                         alt="" width="80" height="80" loading="eager"
                         onerror="this.style.display='none'"
                         class="pkm-header-sprite pkm-header-sprite-right">
                </div>
                <div class="pkm-calc-header-content">
                    <h1 class="pkm-calc-title"><?php echo esc_html($t['title']); ?></h1>
                    <p class="pkm-calc-description"><?php echo esc_html($t['description']); ?></p>
                </div>
            </div>

            <?php // ── TOP AD ─────────────────────────────────────────────────── ?>
            <?php echo $pkm_render_ad($ad_slot_a, 'pkm-ad-top'); ?>

            <?php // ── DATA ERROR ─────────────────────────────────────────────── ?>
            <?php if ($data_error) : ?>
            <div class="pkm-calc-error-box" role="alert">
                <svg class="pkm-icon pkm-icon-lg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                <p><?php echo esc_html($t['error_data_load']); ?></p>
            </div>
            <?php endif; ?>

            <?php // ── TABS — all 3 in single row ─────────────────────────────── ?>
            <div class="pkm-tabs" role="tablist" aria-label="Calculator modes">
                <button class="pkm-tab-btn active" role="tab" aria-selected="true" aria-controls="pkm-panel-simple" id="pkm-tab-simple" data-tab="simple">
                    <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                    <?php echo esc_html($t['tab_simple']); ?>
                </button>
                <button class="pkm-tab-btn" role="tab" aria-selected="false" aria-controls="pkm-panel-advanced" id="pkm-tab-advanced" data-tab="advanced">
                    <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/></svg>
                    <?php echo esc_html($t['tab_advanced']); ?>
                </button>
                <button class="pkm-tab-btn" role="tab" aria-selected="false" aria-controls="pkm-panel-bulk" id="pkm-tab-bulk" data-tab="bulk">
                    <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                    <?php echo esc_html($t['tab_bulk']); ?>
                </button>
            </div>

            <?php // ── SIMPLE PANEL ───────────────────────────────────────────── ?>
            <div class="pkm-tab-panel active" id="pkm-panel-simple" role="tabpanel" aria-labelledby="pkm-tab-simple">

                <?php // Validation errors ?>
                <ul id="pkm-validation-errors" class="pkm-validation-errors" role="alert" aria-live="polite" style="display:none"></ul>

                <div class="pkm-card">
                    <h2 class="pkm-card-title">
                        <svg class="pkm-icon pkm-icon-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        <?php echo esc_html($t['select_pokemon']); ?>
                    </h2>

                    <?php // Pokemon searchbar ?>
                    <div class="pkm-field">
                        <div class="pkm-search-wrap">
                            <div class="pkm-search-input-wrap">
                                <svg class="pkm-icon pkm-icon-md pkm-search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                                <input type="text"
                                       id="pkm-search-input"
                                       class="pkm-input pkm-search-input"
                                       placeholder="<?php echo esc_attr($t['select_pokemon']); ?>"
                                       autocomplete="off"
                                       autocorrect="off"
                                       spellcheck="false"
                                       aria-label="<?php echo esc_attr($t['select_pokemon']); ?>"
                                       aria-haspopup="listbox"
                                       aria-expanded="false"
                                       aria-autocomplete="list"
                                       role="combobox">
                                <button class="pkm-search-clear" id="pkm-search-clear" type="button" aria-label="Clear" tabindex="-1">
                                    <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                </button>
                            </div>
                            <div class="pkm-search-results" id="pkm-search-results" role="listbox" aria-label="Pokemon search results"></div>
                        </div>
                        <div class="pkm-selected-pokemon-badge" id="pkm-selected-badge">
                            <img src="" alt="" class="pkm-selected-badge-sprite" id="pkm-badge-sprite" onerror="this.style.display='none'">
                            <span class="pkm-selected-badge-name" id="pkm-badge-name"></span>
                            <div class="pkm-selected-badge-types" id="pkm-badge-types"></div>
                        </div>
                        <input type="hidden" id="pkm-selected-id" value="0">
                    </div>

                    <?php // IV inputs ?>
                    <div class="pkm-field">
                        <label class="pkm-label" for="pkm-iv-atk-slider">
                            <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                            <?php echo esc_html($t['attack_iv_label']); ?>
                        </label>
                        <div class="pkm-iv-row">
                            <div class="pkm-iv-slider-wrap">
                                <input type="range" class="pkm-iv-slider pkm-slider-styled" id="pkm-iv-atk-slider" min="0" max="15" value="5" aria-label="<?php echo esc_attr($t['attack_iv_label']); ?>">
                            </div>
                            <input type="number" class="pkm-iv-number" id="pkm-iv-atk" min="0" max="15" value="15" inputmode="numeric" autocomplete="off" aria-label="<?php echo esc_attr($t['attack_iv_label']); ?> value">
                        </div>
                    </div>
                    <div class="pkm-field">
                        <label class="pkm-label" for="pkm-iv-def-slider">
                            <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            <?php echo esc_html($t['defense_iv_label']); ?>
                        </label>
                        <div class="pkm-iv-row">
                            <div class="pkm-iv-slider-wrap">
                                <input type="range" class="pkm-iv-slider pkm-slider-styled" id="pkm-iv-def-slider" min="0" max="15" value="12" aria-label="<?php echo esc_attr($t['defense_iv_label']); ?>">
                            </div>
                            <input type="number" class="pkm-iv-number" id="pkm-iv-def" min="0" max="15" value="15" inputmode="numeric" autocomplete="off" aria-label="<?php echo esc_attr($t['defense_iv_label']); ?> value">
                        </div>
                    </div>
                    <div class="pkm-field">
                        <label class="pkm-label" for="pkm-iv-sta-slider">
                            <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                            <?php echo esc_html($t['stamina_iv_label']); ?>
                        </label>
                        <div class="pkm-iv-row">
                            <div class="pkm-iv-slider-wrap">
                                <input type="range" class="pkm-iv-slider pkm-slider-styled" id="pkm-iv-sta-slider" min="0" max="15" value="3" aria-label="<?php echo esc_attr($t['stamina_iv_label']); ?>">
                            </div>
                            <input type="number" class="pkm-iv-number" id="pkm-iv-sta" min="0" max="15" value="15" inputmode="numeric" autocomplete="off" aria-label="<?php echo esc_attr($t['stamina_iv_label']); ?> value">
                        </div>
                    </div>

                    <?php // Buttons ?>
                    <div class="pkm-btn-row">
                        <button class="pkm-btn pkm-btn-primary" id="pkm-calc-btn" type="button">
                            <svg class="pkm-icon pkm-icon-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                            <?php echo esc_html($t['calculate_btn']); ?>
                        </button>
                        <button class="pkm-btn pkm-btn-secondary" id="pkm-reset-btn" type="button">
                            <svg class="pkm-icon pkm-icon-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.43"/></svg>
                            <?php echo esc_html($t['reset_btn']); ?>
                        </button>
                    </div>
                </div>

                <?php // Result card ?>
                <div class="pkm-result-card" id="pkm-result-card" aria-live="polite" aria-label="IV calculation result">
                    <div class="pkm-result-header">
                        <div class="pkm-result-sprite-wrap">
                            <img src="" alt="" class="pkm-result-sprite" id="pkm-result-sprite" onerror="this.style.display='none'">
                        </div>
                        <div class="pkm-result-info">
                            <p class="pkm-result-name" id="pkm-result-name"></p>
                            <div class="pkm-result-types" id="pkm-result-types"></div>
                            <div class="pkm-result-star-rating" id="pkm-result-stars"></div>
                        </div>
                        <button class="pkm-btn pkm-btn-secondary pkm-btn-sm" id="pkm-copy-btn" type="button">
                            <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                            <?php echo esc_html($t['copy_btn']); ?>
                        </button>
                    </div>

                    <?php // IV% gauge ?>
                    <div class="pkm-iv-gauge-wrap">
                        <div class="pkm-iv-gauge-labels">
                            <span class="pkm-iv-gauge-label"><?php echo esc_html($t['result_iv_pct']); ?></span>
                            <div style="text-align:right !important;">
                                <div class="pkm-iv-gauge-pct" id="pkm-iv-pct-display">0%</div>
                                <div class="pkm-iv-gauge-rating" id="pkm-iv-rating-display"></div>
                            </div>
                        </div>
                        <div class="pkm-iv-gauge-bar-bg">
                            <div class="pkm-iv-gauge-bar-fill" id="pkm-iv-bar"></div>
                        </div>
                    </div>

                    <?php // Stats row ?>
                    <div class="pkm-result-stats">
                        <div class="pkm-stat-pill">
                            <div class="pkm-stat-pill-label"><?php echo esc_html($t['result_cp']); ?></div>
                            <div class="pkm-stat-pill-value" id="pkm-res-cp">—</div>
                            <div class="pkm-stat-pill-sub" id="pkm-res-level"></div>
                        </div>
                        <div class="pkm-stat-pill">
                            <div class="pkm-stat-pill-label"><?php echo esc_html($t['result_hp']); ?></div>
                            <div class="pkm-stat-pill-value" id="pkm-res-hp">—</div>
                        </div>
                        <div class="pkm-stat-pill">
                            <div class="pkm-stat-pill-label">IVs</div>
                            <div class="pkm-stat-pill-value" id="pkm-res-ivs" style="font-size:13px !important;">—</div>
                        </div>
                    </div>
                </div>

                <?php echo $pkm_render_ad($ad_slot_b, 'pkm-ad-below-result'); ?>

                <?php // SEO intro (Prompt 2 fills) ?>
                <?php if (!empty($t['intro_title'])) : ?>
                <div class="pkm-card">
                    <h2 class="pkm-card-title"><?php echo esc_html($t['intro_title']); ?></h2>
                    <div style="color:var(--pkm-text-muted) !important; line-height:1.7 !important; font-size:15px !important;"><?php echo wp_kses_post($t['intro_content']); ?></div>
                </div>
                <?php endif; ?>

                <?php if (!empty($t['howto_title'])) : ?>
                <div class="pkm-card">
                    <h2 class="pkm-card-title">
                        <svg class="pkm-icon pkm-icon-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <?php echo esc_html($t['howto_title']); ?>
                    </h2>
                    <?php foreach (['howto_step1','howto_step2','howto_step3','howto_step4'] as $i => $sk) : ?>
                        <?php if (!empty($t[$sk])) : ?>
                        <div style="display:flex !important; gap:12px !important; margin-bottom:14px !important; align-items:flex-start !important;">
                            <div style="min-width:28px !important; height:28px !important; border-radius:50% !important; background:var(--pkm-primary) !important; color:#fff !important; display:flex !important; align-items:center !important; justify-content:center !important; font-weight:800 !important; font-size:13px !important; font-family:var(--pkm-font-heading) !important; flex-shrink:0 !important;"><?php echo $i+1; ?></div>
                            <p style="margin:0 !important; color:var(--pkm-text-muted) !important; line-height:1.6 !important; font-size:15px !important; padding-top:3px !important;"><?php echo wp_kses_post($t[$sk]); ?></p>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <?php echo $pkm_render_ad($ad_slot_c, 'pkm-ad-mid'); ?>

                <?php if (!empty($t['info_title'])) : ?>
                <div class="pkm-card">
                    <h2 class="pkm-card-title">
                        <svg class="pkm-icon pkm-icon-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="3" y1="15" x2="21" y2="15"/><line x1="9" y1="21" x2="9" y2="9"/><line x1="15" y1="21" x2="15" y2="9"/></svg>
                        <?php echo esc_html($t['info_title']); ?>
                    </h2>
                    <div style="color:var(--pkm-text-muted) !important; line-height:1.7 !important; font-size:15px !important; margin-bottom:16px !important;"><?php echo wp_kses_post($t['info_content']); ?></div>
                    <?php if (!empty($t['info_table_html'])) : ?>
                    <div class="pkm-table-wrapper"><?php echo wp_kses_post($t['info_table_html']); ?></div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($t['faq_title'])) : ?>
                <div class="pkm-card">
                    <h2 class="pkm-card-title">
                        <svg class="pkm-icon pkm-icon-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                        <?php echo esc_html($t['faq_title']); ?>
                    </h2>
                    <?php for ($fi = 1; $fi <= 8; $fi++) :
                        $qk = "faq_q{$fi}"; $ak = "faq_a{$fi}";
                        if (empty($t[$qk])) continue;
                    ?>
                    <details style="margin-bottom:10px !important; border:1px solid var(--pkm-border) !important; border-radius:var(--pkm-radius-sm) !important; overflow:hidden !important;">
                        <summary style="padding:14px 16px !important; cursor:pointer !important; font-family:var(--pkm-font-heading) !important; font-weight:600 !important; font-size:15px !important; color:var(--pkm-text) !important; list-style:none !important; display:flex !important; justify-content:space-between !important; align-items:center !important; background:var(--pkm-bg-3) !important; min-height:44px !important;">
                            <?php echo esc_html($t[$qk]); ?>
                            <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="flex-shrink:0 !important;"><polyline points="6 9 12 15 18 9"/></svg>
                        </summary>
                        <div style="padding:14px 16px !important; color:var(--pkm-text-muted) !important; font-size:14px !important; line-height:1.7 !important; background:var(--pkm-bg-card) !important;">
                            <?php echo wp_kses_post($t[$ak]); ?>
                        </div>
                    </details>
                    <?php endfor; ?>
                </div>
                <?php endif; ?>

                <?php echo $pkm_render_ad($ad_slot_d, 'pkm-ad-mid-faq'); ?>

            </div>

            <?php // ── ADVANCED PANEL ─────────────────────────────────────────── ?>
            <div class="pkm-tab-panel" id="pkm-panel-advanced" role="tabpanel" aria-labelledby="pkm-tab-advanced">

                <ul id="pkm-validation-errors-adv" class="pkm-validation-errors" role="alert" aria-live="polite" style="display:none"></ul>

                <div class="pkm-card">
                    <h2 class="pkm-card-title">
                        <svg class="pkm-icon pkm-icon-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        <?php echo esc_html($t['select_pokemon']); ?>
                    </h2>

                    <div class="pkm-field">
                        <div class="pkm-search-wrap">
                            <div class="pkm-search-input-wrap">
                                <svg class="pkm-icon pkm-icon-md pkm-search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                                <input type="text" id="pkm-adv-search-input" class="pkm-input pkm-search-input" placeholder="<?php echo esc_attr($t['select_pokemon']); ?>" autocomplete="off" autocorrect="off" spellcheck="false" aria-label="<?php echo esc_attr($t['select_pokemon']); ?>" aria-haspopup="listbox" aria-expanded="false" role="combobox">
                                <button class="pkm-search-clear" id="pkm-adv-search-clear" type="button" aria-label="Clear" tabindex="-1">
                                    <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                </button>
                            </div>
                            <div class="pkm-search-results" id="pkm-adv-search-results" role="listbox"></div>
                        </div>
                        <div class="pkm-selected-pokemon-badge" id="pkm-adv-selected-badge">
                            <img src="" alt="" class="pkm-selected-badge-sprite" id="pkm-adv-badge-sprite" onerror="this.style.display='none'">
                            <span class="pkm-selected-badge-name" id="pkm-adv-badge-name"></span>
                            <div class="pkm-selected-badge-types" id="pkm-adv-badge-types"></div>
                        </div>
                        <input type="hidden" id="pkm-adv-selected-id" value="0">
                    </div>

                    <div class="pkm-field">
                        <label class="pkm-label" for="pkm-adv-iv-atk-slider">
                            <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                            <?php echo esc_html($t['attack_iv_label']); ?>
                        </label>
                        <div class="pkm-iv-row">
                            <div class="pkm-iv-slider-wrap"><input type="range" class="pkm-iv-slider pkm-slider-styled" id="pkm-adv-iv-atk-slider" min="0" max="15" value="9"></div>
                            <input type="number" class="pkm-iv-number" id="pkm-adv-iv-atk" min="0" max="15" value="15" inputmode="numeric" autocomplete="off">
                        </div>
                    </div>
                    <div class="pkm-field">
                        <label class="pkm-label" for="pkm-adv-iv-def-slider">
                            <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            <?php echo esc_html($t['defense_iv_label']); ?>
                        </label>
                        <div class="pkm-iv-row">
                            <div class="pkm-iv-slider-wrap"><input type="range" class="pkm-iv-slider pkm-slider-styled" id="pkm-adv-iv-def-slider" min="0" max="15" value="10"></div>
                            <input type="number" class="pkm-iv-number" id="pkm-adv-iv-def" min="0" max="15" value="15" inputmode="numeric" autocomplete="off">
                        </div>
                    </div>
                    <div class="pkm-field">
                        <label class="pkm-label" for="pkm-adv-iv-sta-slider">
                            <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                            <?php echo esc_html($t['stamina_iv_label']); ?>
                        </label>
                        <div class="pkm-iv-row">
                            <div class="pkm-iv-slider-wrap"><input type="range" class="pkm-iv-slider pkm-slider-styled" id="pkm-adv-iv-sta-slider" min="0" max="15" value="7"></div>
                            <input type="number" class="pkm-iv-number" id="pkm-adv-iv-sta" min="0" max="15" value="15" inputmode="numeric" autocomplete="off">
                        </div>
                    </div>

                    <?php // Level slider ?>
                    <div class="pkm-field">
                        <label class="pkm-label">
                            <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <?php echo esc_html($t['level_label']); ?>
                        </label>
                        <div class="pkm-level-display" id="pkm-level-display">Lv 25</div>
                        <div class="pkm-level-slider-wrap">
                            <button class="pkm-level-step-btn" id="pkm-level-down" type="button" aria-label="Decrease level">−</button>
                            <input type="range" class="pkm-iv-slider pkm-slider-styled" id="pkm-level-slider" min="1" max="51" value="10" step="1" aria-label="<?php echo esc_attr($t['level_label']); ?>" style="flex:1 !important;">
                            <button class="pkm-level-step-btn" id="pkm-level-up" type="button" aria-label="Increase level">+</button>
                        </div>
                        <input type="hidden" id="pkm-level-value" value="25">
                    </div>

                    <?php // Appraisal — redesigned for clarity ?>
                    <div class="pkm-field">
                        <label class="pkm-label">
                            <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            <?php echo esc_html($t['appraisal_label']); ?>
                        </label>
                        <div class="pkm-appraisal-grid">
                            <?php
                            $appraisal_stats = [
                                ['key'=>'atk','label'=>$t['appraisal_atk']],
                                ['key'=>'def','label'=>$t['appraisal_def']],
                                ['key'=>'sta','label'=>$t['appraisal_sta']],
                            ];
                            $arrow_configs = [
                                ['val'=>1,'label'=>'0–7','color'=>'#E63946','tip'=>'Low (0–7)'],
                                ['val'=>2,'label'=>'8–12','color'=>'#D4A017','tip'=>'Mid (8–12)'],
                                ['val'=>3,'label'=>'13–15','color'=>'#2ECC71','tip'=>'High (13–15)'],
                            ];
                            foreach ($appraisal_stats as $astat) :
                            ?>
                            <div class="pkm-appraisal-stat-block">
                                <div class="pkm-appraisal-stat-label"><?php echo esc_html($astat['label']); ?></div>
                                <div class="pkm-appraisal-arrows" role="group" aria-label="<?php echo esc_attr($astat['label']); ?> appraisal rating">
                                    <?php foreach ($arrow_configs as $ac) : ?>
                                    <button class="pkm-arrow-btn"
                                            data-stat="<?php echo esc_attr($astat['key']); ?>"
                                            data-val="<?php echo $ac['val']; ?>"
                                            type="button"
                                            title="<?php echo esc_attr($astat['label'] . ': ' . $ac['tip']); ?>"
                                            aria-label="<?php echo esc_attr($astat['label'] . ' IV ' . $ac['tip']); ?>"
                                            aria-pressed="false">
                                        <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                            <?php if ($ac['val'] === 1) : ?><path d="M8 14l4-5 4 5H8z"/><?php
                                            elseif ($ac['val'] === 2) : ?><path d="M5 15l7-8 7 8H5z"/><?php
                                            else : ?><path d="M3 16l9-10 9 10H3z"/><?php endif; ?>
                                        </svg>
                                        <span class="pkm-arrow-label"><?php echo esc_html($ac['label']); ?></span>
                                    </button>
                                    <?php endforeach; ?>
                                </div>
                                <div class="pkm-appraisal-selected-label" id="pkm-appraisal-label-<?php echo esc_attr($astat['key']); ?>">—</div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <p class="pkm-appraisal-hint"><?php echo esc_html($t['appraisal_hint']); ?></p>
                    </div>

                    <?php // Buttons ?>
                    <div class="pkm-btn-row">
                        <button class="pkm-btn pkm-btn-primary" id="pkm-adv-calc-btn" type="button">
                            <svg class="pkm-icon pkm-icon-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                            <?php echo esc_html($t['calculate_btn']); ?>
                        </button>
                        <button class="pkm-btn pkm-btn-secondary" id="pkm-adv-reset-btn" type="button">
                            <svg class="pkm-icon pkm-icon-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.43"/></svg>
                            <?php echo esc_html($t['reset_btn']); ?>
                        </button>
                    </div>
                </div>

                <?php // Advanced result card ?>
                <div class="pkm-result-card" id="pkm-adv-result-card" aria-live="polite" aria-label="Advanced IV result">
                    <div class="pkm-result-header">
                        <div class="pkm-result-sprite-wrap">
                            <img src="" alt="" class="pkm-result-sprite" id="pkm-adv-result-sprite" onerror="this.style.display='none'">
                        </div>
                        <div class="pkm-result-info">
                            <p class="pkm-result-name" id="pkm-adv-result-name"></p>
                            <div class="pkm-result-types" id="pkm-adv-result-types"></div>
                            <div class="pkm-result-star-rating" id="pkm-adv-result-stars"></div>
                        </div>
                        <button class="pkm-btn pkm-btn-secondary pkm-btn-sm" id="pkm-adv-copy-btn" type="button">
                            <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                            <?php echo esc_html($t['copy_btn']); ?>
                        </button>
                    </div>
                    <div class="pkm-iv-gauge-wrap">
                        <div class="pkm-iv-gauge-labels">
                            <span class="pkm-iv-gauge-label"><?php echo esc_html($t['result_iv_pct']); ?></span>
                            <div style="text-align:right !important;">
                                <div class="pkm-iv-gauge-pct" id="pkm-adv-iv-pct-display">0%</div>
                                <div class="pkm-iv-gauge-rating" id="pkm-adv-iv-rating-display"></div>
                            </div>
                        </div>
                        <div class="pkm-iv-gauge-bar-bg">
                            <div class="pkm-iv-gauge-bar-fill" id="pkm-adv-iv-bar"></div>
                        </div>
                    </div>
                    <div class="pkm-result-stats">
                        <div class="pkm-stat-pill">
                            <div class="pkm-stat-pill-label"><?php echo esc_html($t['result_cp']); ?></div>
                            <div class="pkm-stat-pill-value" id="pkm-adv-res-cp">—</div>
                            <div class="pkm-stat-pill-sub" id="pkm-adv-res-level"></div>
                        </div>
                        <div class="pkm-stat-pill">
                            <div class="pkm-stat-pill-label"><?php echo esc_html($t['result_hp']); ?></div>
                            <div class="pkm-stat-pill-value" id="pkm-adv-res-hp">—</div>
                        </div>
                        <div class="pkm-stat-pill">
                            <div class="pkm-stat-pill-label">IVs</div>
                            <div class="pkm-stat-pill-value" id="pkm-adv-res-ivs" style="font-size:13px !important;">—</div>
                        </div>
                    </div>
                    <div id="pkm-advanced-results" style="margin-top:20px !important;">
                        <h3 style="font-family:var(--pkm-font-heading) !important; font-size:14px !important; font-weight:700 !important; color:var(--pkm-text-muted) !important; text-transform:uppercase !important; letter-spacing:0.06em !important; margin:0 0 10px !important;"><?php echo esc_html($t['pvp_title']); ?></h3>
                        <div class="pkm-pvp-grid" id="pkm-pvp-grid"></div>
                        <h3 style="font-family:var(--pkm-font-heading) !important; font-size:14px !important; font-weight:700 !important; color:var(--pkm-text-muted) !important; text-transform:uppercase !important; letter-spacing:0.06em !important; margin:0 0 10px !important;"><?php echo esc_html($t['moveset_title']); ?></h3>
                        <div class="pkm-moveset-grid" id="pkm-moveset-grid"></div>
                        <button class="pkm-cp-table-toggle" id="pkm-cp-table-toggle" type="button" aria-expanded="false">
                            <span id="pkm-cp-table-toggle-label"><?php echo esc_html($t['cp_table_show']); ?></span>
                            <svg class="pkm-icon pkm-icon-sm" id="pkm-cp-table-chevron" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>
                        <div class="pkm-cp-table-body" id="pkm-cp-table-body">
                            <div class="pkm-table-wrapper">
                                <table class="pkm-cp-table"><thead><tr><th><?php echo esc_html($t['cp_table_level']); ?></th><th><?php echo esc_html($t['cp_table_cp']); ?></th><th><?php echo esc_html($t['cp_table_hp']); ?></th></tr></thead><tbody id="pkm-cp-table-body-rows"></tbody></table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <?php // ── BULK PANEL ─────────────────────────────────────────────── ?>
            <div class="pkm-tab-panel" id="pkm-panel-bulk" role="tabpanel" aria-labelledby="pkm-tab-bulk">

                <div id="pkm-bulk-validation-errors" class="pkm-validation-errors" role="alert" aria-live="polite" style="display:none"></div>

                <div class="pkm-card">
                    <h2 class="pkm-card-title">
                        <svg class="pkm-icon pkm-icon-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                        <?php echo esc_html($t['tab_bulk']); ?>
                    </h2>
                    <?php // Column headers ?>
                    <div class="pkm-bulk-header-row">
                        <div class="pkm-bulk-header-cell" style="text-align:left !important;"><?php echo esc_html($t['bulk_pokemon_col']); ?></div>
                        <div class="pkm-bulk-header-cell">ATK</div>
                        <div class="pkm-bulk-header-cell">DEF</div>
                        <div class="pkm-bulk-header-cell">STA</div>
                        <div class="pkm-bulk-header-cell"></div>
                    </div>
                    <div class="pkm-bulk-rows" id="pkm-bulk-rows"></div>
                    <div class="pkm-bulk-add-row">
                        <button class="pkm-btn pkm-btn-secondary pkm-btn-sm" id="pkm-bulk-add-btn" type="button">
                            <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                            <?php echo esc_html($t['bulk_add_btn']); ?>
                        </button>
                        <button class="pkm-btn pkm-btn-primary" id="pkm-bulk-calc-btn" type="button" style="flex:1 !important; max-width:220px !important;">
                            <svg class="pkm-icon pkm-icon-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                            <?php echo esc_html($t['bulk_calc_btn']); ?>
                        </button>
                        <button class="pkm-btn pkm-btn-secondary pkm-btn-sm" id="pkm-bulk-clear-btn" type="button">
                            <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.43"/></svg>
                            <?php echo esc_html($t['reset_btn']); ?>
                        </button>
                    </div>
                </div>

                <div class="pkm-card" id="pkm-bulk-results-card" style="display:none !important;">
                    <div style="display:flex !important; justify-content:space-between !important; align-items:center !important; margin-bottom:16px !important; flex-wrap:wrap !important; gap:10px !important;">
                        <h2 class="pkm-card-title" style="margin:0 !important; border:none !important; padding:0 !important;">
                            <svg class="pkm-icon pkm-icon-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                            Results
                        </h2>
                        <button class="pkm-btn pkm-btn-secondary pkm-btn-sm" id="pkm-bulk-copy-btn" type="button">
                            <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                            <?php echo esc_html($t['bulk_copy_btn']); ?>
                        </button>
                    </div>
                    <div class="pkm-table-wrapper">
                        <table class="pkm-bulk-results-table">
                            <thead>
                                <tr>
                                    <th><?php echo esc_html($t['bulk_rank_col']); ?></th>
                                    <th><?php echo esc_html($t['bulk_pokemon_col']); ?></th>
                                    <th><?php echo esc_html($t['bulk_ivs_col']); ?></th>
                                    <th><?php echo esc_html($t['bulk_iv_pct_col']); ?></th>
                                    <th><?php echo esc_html($t['bulk_cp_col']); ?></th>
                                    <th><?php echo esc_html($t['bulk_rating_col']); ?></th>
                                </tr>
                            </thead>
                            <tbody id="pkm-bulk-results-body">
                                <tr><td colspan="6" class="pkm-bulk-placeholder"><?php echo esc_html($t['bulk_placeholder']); ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <?php // ── NOSCRIPT FALLBACK ──────────────────────────────────────── ?>
            <noscript>
                <div class="pkm-card" style="margin-top:16px;">
                    <h2 class="pkm-card-title"><?php echo esc_html($t['select_pokemon']); ?></h2>
                    <p style="color:var(--pkm-text-muted);margin-bottom:12px;font-size:14px;">JavaScript is required for the full calculator. Here is a basic Pokemon list:</p>
                    <select style="width:100%;padding:12px;font-size:16px;border-radius:8px;border:1px solid #ccc;background:#f5f5f5;">
                        <option value=""><?php echo esc_html($t['select_pokemon']); ?></option>
                        <?php echo $noscript_options; ?>
                    </select>
                    <p style="margin-top:12px;color:var(--pkm-text-muted);font-size:13px;">Please enable JavaScript for IV calculation, CP computation, PvP ratings, and the full calculator experience.</p>
                </div>
            </noscript>

        </div><!-- .pkm-calc-wrapper -->

        <?php
        // ── RELATED TOOLS — BOTTOM ────────────────────────────────────────────
        $related_tools = pkm_iv_get_related_tools( get_the_ID(), 6 );
        ?>
        <div class="pkm-calc-wrapper">
            <div class="pkm-related-section pkm-related-bottom">
                <h2 class="pkm-related-section-title">
                    <?php echo esc_html( $t['related_title'] ?? 'Related Pokemon Calculators' ); ?>
                </h2>
                <?php if ( ! empty($related_tools) ) : ?>
                <div class="pkm-related-grid">
                    <?php foreach ( $related_tools as $tool ) : ?>
                    <a href="<?php echo esc_url($tool['url']); ?>" class="pkm-related-card">
                        <div class="pkm-related-card-icon">
                            <?php if ( ! empty($tool['svg_icon']) ) : ?>
                                <?php echo wp_kses( $tool['svg_icon'], [
                                    'svg'  => ['xmlns'=>[],'viewBox'=>[],'fill'=>[],'stroke'=>[],'stroke-width'=>[],'stroke-linecap'=>[],'stroke-linejoin'=>[],'width'=>[],'height'=>[],'class'=>[],'aria-hidden'=>[],'style'=>[]],
                                    'path' => ['d'=>[],'fill'=>[],'stroke'=>[]],
                                    'circle'=>['cx'=>[],'cy'=>[],'r'=>[],'fill'=>[],'stroke'=>[]],
                                    'rect' =>['x'=>[],'y'=>[],'width'=>[],'height'=>[],'rx'=>[],'ry'=>[],'fill'=>[],'stroke'=>[]],
                                    'line' =>['x1'=>[],'y1'=>[],'x2'=>[],'y2'=>[],'stroke'=>[]],
                                    'polyline'=>['points'=>[],'stroke'=>[],'fill'=>[]],
                                    'polygon'=>['points'=>[],'stroke'=>[],'fill'=>[]],
                                ] ); ?>
                            <?php else : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                            <?php endif; ?>
                        </div>
                        <div class="pkm-related-card-title"><?php echo esc_html($tool['title']); ?></div>
                        <?php if ( ! empty($tool['description']) ) : ?>
                        <div class="pkm-related-card-desc"><?php echo esc_html($tool['description']); ?></div>
                        <?php endif; ?>
                    </a>
                    <?php endforeach; ?>
                </div>
                <?php else : ?>
                <p class="pkm-related-empty"><?php echo esc_html( $t['no_related_tools'] ?? 'More calculators coming soon!' ); ?></p>
                <?php endif; ?>
            </div>

            <?php
            // ── BLOG GUIDES ───────────────────────────────────────────────────
            $blog_posts = get_posts([
                'post_type'      => 'post',
                'posts_per_page' => 3,
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
            ]);
            if ( ! empty($blog_posts) ) : ?>
            <div class="pkm-blog-section pkm-blog-guides">
                <h2 class="pkm-related-section-title">
                    <?php echo esc_html( $t['blog_guides_title'] ?? 'Pokemon Guides & Tips' ); ?>
                </h2>
                <div class="pkm-blog-grid">
                    <?php foreach ( $blog_posts as $bp ) :
                        $thumb_url = get_the_post_thumbnail_url( $bp->ID, 'medium' );
                    ?>
                    <a href="<?php echo esc_url( get_permalink($bp->ID) ); ?>" class="pkm-blog-card">
                        <?php if ( $thumb_url ) : ?>
                            <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($bp->post_title); ?>" class="pkm-blog-card-thumb" loading="lazy">
                        <?php else : ?>
                            <div class="pkm-blog-card-thumb-placeholder"></div>
                        <?php endif; ?>
                        <div class="pkm-blog-card-body">
                            <div class="pkm-blog-card-title"><?php echo esc_html($bp->post_title); ?></div>
                            <div class="pkm-blog-card-date"><?php echo esc_html( get_the_date('M j, Y', $bp->ID) ); ?></div>
                            <span class="pkm-blog-card-read">
                                <?php echo esc_html( $t['blog_read_more'] ?? 'Read guide' ); ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                            </span>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

        </div><!-- .pkm-related-blog-wrapper -->

    </div><!-- .pkm-calc-outer -->

    <?php // ── JAVASCRIPT (obfuscated-ready, full logic) ─────────────────────── ?>
    <script>
    (function(){
    'use strict';

    // ── Guard ────────────────────────────────────────────────────────────────
    var _d=typeof pkmData!=='undefined'&&Array.isArray(pkmData)&&pkmData.length>0?pkmData:null;
    var _t=typeof pkmTrans!=='undefined'?pkmTrans:{};
    if(!_d){var _eb=document.getElementById('pkm-calc-error');if(_eb)_eb.style.display='flex';return;}

    // ── CPM table ─────────────────────────────────────────────────────────────
    var CPM=[
        0.094,0.135137432,0.16639787,0.192650919,0.21573247,
        0.236572661,0.25572005,0.273530381,0.29024988,0.306057377,
        0.3210876,0.335445036,0.34921268,0.362457751,0.37523559,
        0.387592406,0.39956728,0.411193551,0.42250001,0.432926419,
        0.44310755,0.453059958,0.46279839,0.472336083,0.48168495,
        0.4908558,0.49985844,0.508701765,0.51739395,0.525942511,
        0.53435433,0.542635767,0.55079269,0.558830576,0.56675452,
        0.574569153,0.58227891,0.589887917,0.59740001,0.604818814,
        0.61215729,0.619399365,0.62656713,0.633644533,0.64065295,
        0.647576426,0.65443563,0.661214806,0.667934,0.674577537,0.681154
    ];

    // ── Movesets ──────────────────────────────────────────────────────────────
    var MOVESETS={
        1:[{fast:'Tackle',charged:'Vine Whip',dps:8.2,type:'normal'},{fast:'Vine Whip',charged:'Power Whip',dps:10.1,type:'grass'}],
        4:[{fast:'Ember',charged:'Flamethrower',dps:12.1,type:'fire'},{fast:'Fire Fang',charged:'Fire Blast',dps:11.4,type:'fire'}],
        7:[{fast:'Water Gun',charged:'Hydro Pump',dps:13.2,type:'water'},{fast:'Water Gun',charged:'Aqua Tail',dps:12.8,type:'water'}],
        25:[{fast:'Thunder Shock',charged:'Wild Charge',dps:14.0,type:'electric'},{fast:'Quick Attack',charged:'Thunderbolt',dps:12.6,type:'electric'}],
        94:[{fast:'Shadow Claw',charged:'Shadow Ball',dps:18.6,type:'ghost'},{fast:'Lick',charged:'Shadow Punch',dps:15.2,type:'ghost'}],
        130:[{fast:'Waterfall',charged:'Hydro Pump',dps:19.8,type:'water'},{fast:'Dragon Tail',charged:'Outrage',dps:18.4,type:'dragon'}],
        131:[{fast:'Ice Shard',charged:'Blizzard',dps:19.5,type:'ice'},{fast:'Water Gun',charged:'Surf',dps:16.2,type:'water'}],
        143:[{fast:'Lick',charged:'Hyper Beam',dps:17.0,type:'normal'},{fast:'Zen Headbutt',charged:'Body Slam',dps:15.8,type:'normal'}],
        147:[{fast:'Dragon Breath',charged:'Twister',dps:12.2,type:'dragon'},{fast:'Dragon Breath',charged:'Dragon Pulse',dps:13.5,type:'dragon'}],
        149:[{fast:'Dragon Tail',charged:'Outrage',dps:22.4,type:'dragon'},{fast:'Dragon Breath',charged:'Draco Meteor',dps:21.0,type:'dragon'}],
        150:[{fast:'Confusion',charged:'Shadow Ball',dps:24.1,type:'psychic'},{fast:'Psycho Cut',charged:'Psystrike',dps:22.8,type:'psychic'}],
        151:[{fast:'Pound',charged:'Psybeam',dps:11.6,type:'psychic'},{fast:'Zen Headbutt',charged:'Future Sight',dps:16.2,type:'psychic'}],
        249:[{fast:'Extrasensory',charged:'Aeroblast',dps:23.5,type:'psychic'},{fast:'Confusion',charged:'Sky Attack',dps:21.2,type:'psychic'}],
        250:[{fast:'Fire Spin',charged:'Sacred Fire',dps:23.8,type:'fire'},{fast:'Incinerate',charged:'Brave Bird',dps:22.4,type:'fire'}],
        384:[{fast:'Dragon Tail',charged:'Outrage',dps:25.3,type:'dragon'},{fast:'Dragon Tail',charged:'Dragon Claw',dps:22.1,type:'dragon'}],
        483:[{fast:'Dragon Tail',charged:'Roar of Time',dps:26.1,type:'dragon'},{fast:'Dragon Breath',charged:'Draco Meteor',dps:24.0,type:'dragon'}],
        484:[{fast:'Dragon Tail',charged:'Spacial Rend',dps:25.8,type:'dragon'},{fast:'Dragon Breath',charged:'Draco Meteor',dps:23.6,type:'dragon'}],
    };
    var DEFAULT_MOVESET=[{fast:'Quick Attack',charged:'Return',dps:10.0,type:'normal'},{fast:'Tackle',charged:'Body Slam',dps:9.2,type:'normal'}];

    // ── Utils ─────────────────────────────────────────────────────────────────
    function _safe(v,fb){return(isNaN(v)||!isFinite(v))?fb:v;}
    function _clamp(v,mn,mx){return Math.max(mn,Math.min(mx,v));}
    function _cap(s){return s?s.charAt(0).toUpperCase()+s.slice(1):'';}

    function calcCP(bAtk,bDef,bSta,ivA,ivD,ivS,lvl){
        var idx=_clamp(Math.round((lvl-1)*2),0,CPM.length-1);
        var cpm=CPM[idx];
        var cp=Math.floor(Math.sqrt(bAtk+ivA)*Math.sqrt(bDef+ivD)*Math.sqrt(bSta+ivS)*cpm*cpm/10);
        return _safe(Math.max(cp,10),10);
    }
    function calcHP(bSta,ivS,lvl){
        var idx=_clamp(Math.round((lvl-1)*2),0,CPM.length-1);
        return _safe(Math.max(Math.floor((bSta+ivS)*CPM[idx]),1),1);
    }
    function calcIVPct(ivA,ivD,ivS){return _safe(Math.round(((ivA+ivD+ivS)/45)*1000)/10,0);}
    function getStarRating(pct){
        if(pct===100)return{label:_t.stars_3||'3★ Perfect'};
        if(pct>=80)return{label:_t.stars_2||'2★ Great'};
        if(pct>=66)return{label:_t.stars_1||'1★ Good'};
        return{label:_t.stars_0||'0★'};
    }
    function getIVRating(pct){
        if(pct===100)return _t.rating_100||'100% — Perfect!';
        if(pct>=98)return _t.rating_98||'98% — Lucky';
        if(pct>=90)return _t.rating_above_90||'Excellent';
        if(pct>=80)return _t.rating_above_80||'Great';
        if(pct>=66)return _t.rating_above_66||'Good';
        return _t.rating_below_66||'Not Bad';
    }
    function calcPvPBest(bAtk,bDef,bSta,ivA,ivD,ivS,cpCap){
        var bestCP=0,bestLvl=1;
        for(var s=0;s<CPM.length;s++){
            var lvl=1+s*0.5;
            var cp=calcCP(bAtk,bDef,bSta,ivA,ivD,ivS,lvl);
            if(cpCap===null||cp<=cpCap){if(cp>bestCP){bestCP=cp;bestLvl=lvl;}}
        }
        return{cp:bestCP,level:bestLvl};
    }
    function typeBadge(type){
        var t2=String(type).toLowerCase().trim();
        return '<span class="pkm-type-badge pkm-type-'+t2+'">'+_cap(t2)+'</span>';
    }
    function findPokemon(id){for(var i=0;i<_d.length;i++){if(_d[i].id===id)return _d[i];}return null;}

    // ── Slider fill color ─────────────────────────────────────────────────────
    function updateSliderFill(sl){
        if(!sl)return;
        var max=parseInt(sl.max)||15;
        var val=parseInt(sl.value)||0;
        var pct=(val/max*100).toFixed(1)+'%';
        sl.style.setProperty('--fill',pct);
    }

    // ── Generic search factory ────────────────────────────────────────────────
    // Fix #7: search triggers on 1+ chars (not 2)
    function makeSearch(inputId,resultsId,clearId,hiddenId,badgeId,badgeSpriteId,badgeNameId,badgeTypesId){
        var inp=document.getElementById(inputId);
        var res=document.getElementById(resultsId);
        var clr=document.getElementById(clearId);
        var hid=document.getElementById(hiddenId);
        var badge=document.getElementById(badgeId);
        var bSprite=document.getElementById(badgeSpriteId);
        var bName=document.getElementById(badgeNameId);
        var bTypes=document.getElementById(badgeTypesId);
        if(!inp||!res)return;
        var dbt=null,fidx=-1;

        function openRes(items){
            if(!items||items.length===0){
                res.innerHTML='<div class="pkm-search-no-results">'+(_t.error_no_results||'No results')+'</div>';
            } else {
                var h='';
                for(var i=0;i<items.length;i++){
                    var p=items[i];
                    var tArr=Array.isArray(p.types)?p.types:[];
                    h+='<div class="pkm-search-result-item" data-id="'+p.id+'" tabindex="-1" role="option">'
                        +'<img src="'+p.sprite+'" alt="" class="pkm-search-result-sprite" loading="lazy" onerror="this.style.display=\'none\'">'
                        +'<span class="pkm-search-result-name">'+_cap(p.name)+'</span>'
                        +'<span class="pkm-search-result-id">#'+String(p.id).padStart(3,'0')+'</span>'
                        +tArr.map(function(tp){return typeBadge(tp);}).join('')
                        +'</div>';
                }
                res.innerHTML=h;
            }
            res.classList.add('open');
            inp.setAttribute('aria-expanded','true');
            fidx=-1;
            var itms=res.querySelectorAll('.pkm-search-result-item');
            for(var j=0;j<itms.length;j++){
                itms[j].addEventListener('mousedown',function(e){
                    e.preventDefault();
                    selectP(parseInt(this.getAttribute('data-id'),10));
                });
            }
        }

        function closeRes(){res.classList.remove('open');res.innerHTML='';inp.setAttribute('aria-expanded','false');fidx=-1;}

        function selectP(id){
            var p=findPokemon(id);if(!p)return;
            inp.value=_cap(p.name);
            if(hid)hid.value=String(id);
            if(clr)clr.style.display='flex';
            closeRes();
            if(badge)badge.classList.add('visible');
            if(bSprite){bSprite.src=p.sprite;bSprite.style.display='';}
            if(bName)bName.textContent=_cap(p.name)+' #'+String(p.id).padStart(3,'0');
            if(bTypes){
                var tArr=Array.isArray(p.types)?p.types:[];
                bTypes.innerHTML=tArr.map(function(tp){return typeBadge(tp);}).join('');
            }
        }

        // Fix #7: min 1 char
        function doSearch(q){
            if(!q||q.length<1){closeRes();return;}
            var ql=q.toLowerCase();
            var results=[],res2=[];
            for(var i=0;i<_d.length;i++){
                if(_d[i].name.toLowerCase().indexOf(ql)===0)results.push(_d[i]);
                else if(_d[i].name.toLowerCase().indexOf(ql)>0)res2.push(_d[i]);
            }
            var combined=results.concat(res2).slice(0,20);
            openRes(combined);
        }

        inp.addEventListener('input',function(){
            var v=this.value.trim();
            if(clr)clr.style.display=v?'flex':'none';
            clearTimeout(dbt);
            dbt=setTimeout(function(){doSearch(v);},150);
        });
        inp.addEventListener('keydown',function(e){
            var itms=res.querySelectorAll('.pkm-search-result-item');
            if(e.key==='ArrowDown'){e.preventDefault();fidx=Math.min(fidx+1,itms.length-1);updateFocus(itms);}
            else if(e.key==='ArrowUp'){e.preventDefault();fidx=Math.max(fidx-1,0);updateFocus(itms);}
            else if(e.key==='Enter'){if(fidx>=0&&itms[fidx]){e.preventDefault();selectP(parseInt(itms[fidx].getAttribute('data-id'),10));}}
            else if(e.key==='Escape'){closeRes();this.blur();}
        });
        inp.addEventListener('focus',function(){var v=this.value.trim();if(v.length>=1)doSearch(v);});

        function updateFocus(itms){
            for(var i=0;i<itms.length;i++){
                itms[i].classList.toggle('keyboard-focus',i===fidx);
                if(i===fidx)itms[i].scrollIntoView({block:'nearest'});
            }
        }
        if(clr){
            clr.addEventListener('click',function(){
                inp.value='';if(hid)hid.value='0';
                if(badge)badge.classList.remove('visible');
                this.style.display='none';closeRes();inp.focus();
            });
        }
        document.addEventListener('click',function(e){
            var w=inp.closest('.pkm-search-wrap');
            if(w&&!w.contains(e.target))closeRes();
        });

        return {selectP:selectP,getSelectedId:function(){return hid?parseInt(hid.value,10):0;}};
    }

    // Initialise both search instances
    var simpleSearch=makeSearch('pkm-search-input','pkm-search-results','pkm-search-clear','pkm-selected-id','pkm-selected-badge','pkm-badge-sprite','pkm-badge-name','pkm-badge-types');
    var advSearch=makeSearch('pkm-adv-search-input','pkm-adv-search-results','pkm-adv-search-clear','pkm-adv-selected-id','pkm-adv-selected-badge','pkm-adv-badge-sprite','pkm-adv-badge-name','pkm-adv-badge-types');

    // ── IV slider sync + fill ─────────────────────────────────────────────────
    function syncSliderNumber(sliderId,numberId){
        var sl=document.getElementById(sliderId);
        var nb=document.getElementById(numberId);
        if(!sl||!nb)return;
        updateSliderFill(sl);
        sl.addEventListener('input',function(){
            var v=_clamp(parseInt(this.value,10),0,15);
            nb.value=String(v);updateSliderFill(this);
        });
        nb.addEventListener('input',function(){
            var v=_clamp(parseInt(this.value,10)||0,0,15);
            this.value=String(v);
            if(sl)sl.value=String(v);
            updateSliderFill(sl);
        });
        nb.addEventListener('change',function(){this.value=String(_clamp(parseInt(this.value,10)||0,0,15));});
    }
    // Simple panel sliders
    syncSliderNumber('pkm-iv-atk-slider','pkm-iv-atk');
    syncSliderNumber('pkm-iv-def-slider','pkm-iv-def');
    syncSliderNumber('pkm-iv-sta-slider','pkm-iv-sta');
    // Advanced panel sliders
    syncSliderNumber('pkm-adv-iv-atk-slider','pkm-adv-iv-atk');
    syncSliderNumber('pkm-adv-iv-def-slider','pkm-adv-iv-def');
    syncSliderNumber('pkm-adv-iv-sta-slider','pkm-adv-iv-sta');

    // ── Level slider ──────────────────────────────────────────────────────────
    var _levelSlider=document.getElementById('pkm-level-slider');
    var _levelDisplay=document.getElementById('pkm-level-display');
    var _levelValue=document.getElementById('pkm-level-value');
    function sliderToLevel(s){return 1+(s-1)*0.5;}
    function updateLevelDisplay(lvl){
        var d=lvl===Math.floor(lvl)?String(lvl):lvl.toFixed(1);
        if(_levelDisplay)_levelDisplay.textContent='Lv '+d;
        if(_levelValue)_levelValue.value=String(lvl);
        if(_levelSlider)updateSliderFill(_levelSlider);
    }
    if(_levelSlider){_levelSlider.addEventListener('input',function(){updateLevelDisplay(sliderToLevel(parseInt(this.value,10)));});}
    var _lDown=document.getElementById('pkm-level-down');
    var _lUp=document.getElementById('pkm-level-up');
    if(_lDown){_lDown.addEventListener('click',function(){if(!_levelSlider)return;var nv=Math.max(1,parseInt(_levelSlider.value,10)-1);_levelSlider.value=String(nv);updateLevelDisplay(sliderToLevel(nv));});}
    if(_lUp){_lUp.addEventListener('click',function(){if(!_levelSlider)return;var nv=Math.min(51,parseInt(_levelSlider.value,10)+1);_levelSlider.value=String(nv);updateLevelDisplay(sliderToLevel(nv));});}
    updateLevelDisplay(25);

    // ── Appraisal arrows (advanced panel) ────────────────────────────────────
    var _appraisalState={atk:0,def:0,sta:0};
    var _arrowRangeLabels=['','0–7','8–12','13–15'];
    document.querySelectorAll('.pkm-arrow-btn').forEach(function(btn){
        btn.addEventListener('click',function(){
            var stat=this.getAttribute('data-stat');
            var val=parseInt(this.getAttribute('data-val'),10);
            _appraisalState[stat]=(_appraisalState[stat]===val)?0:val;
            document.querySelectorAll('.pkm-arrow-btn[data-stat="'+stat+'"]').forEach(function(b){
                var sv=parseInt(b.getAttribute('data-val'),10);
                b.classList.remove('active-1','active-2','active-3');
                b.setAttribute('aria-pressed','false');
                if(_appraisalState[stat]===sv){b.classList.add('active-'+sv);b.setAttribute('aria-pressed','true');}
            });
            // Update the readable label below arrows
            var lbl=document.getElementById('pkm-appraisal-label-'+stat);
            if(lbl)lbl.textContent=_appraisalState[stat]>0?('IV: '+_arrowRangeLabels[_appraisalState[stat]]):'—';
            // Apply to sliders
            var map={atk:['pkm-adv-iv-atk-slider','pkm-adv-iv-atk'],def:['pkm-adv-iv-def-slider','pkm-adv-iv-def'],sta:['pkm-adv-iv-sta-slider','pkm-adv-iv-sta']};
            var avMap={1:4,2:10,3:15};
            if(_appraisalState[stat]>0){
                var iv=avMap[_appraisalState[stat]];
                var sl=document.getElementById(map[stat][0]);
                var nb=document.getElementById(map[stat][1]);
                if(sl){sl.value=String(iv);updateSliderFill(sl);}
                if(nb)nb.value=String(iv);
            }
        });
    });

    // ── Validation ────────────────────────────────────────────────────────────
    function showErrors(errs,containerId){
        var el=document.getElementById(containerId||'pkm-validation-errors');
        if(!el)return;
        if(!errs||errs.length===0){el.style.display='none';el.innerHTML='';return;}
        el.innerHTML=errs.map(function(e){return '<li><svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>'+e+'</li>';}).join('');
        el.style.display='block';
        el.scrollIntoView({behavior:'smooth',block:'nearest'});
    }

    // ── Populate result card ──────────────────────────────────────────────────
    function populateResult(p,ivA,ivD,ivS,lvl,prefix){
        var pfx=prefix||'pkm';
        var bAtk=p.stats.attack||0;var bDef=p.stats.defense||0;var bSta=p.stats.hp||p.stats.stamina||0;
        var ivPct=calcIVPct(ivA,ivD,ivS);
        var cp=calcCP(bAtk,bDef,bSta,ivA,ivD,ivS,lvl);
        var hp=calcHP(bSta,ivS,lvl);
        var rating=getIVRating(ivPct);
        var stars=getStarRating(ivPct);
        var el=function(id){return document.getElementById(id);};
        var sp=el(pfx+'-result-sprite');if(sp){sp.src=p.sprite;sp.style.display='';}
        var nm=el(pfx+'-result-name');if(nm)nm.textContent=_cap(p.name)+' #'+String(p.id).padStart(3,'0');
        var ty=el(pfx+'-result-types');
        if(ty){var tArr=Array.isArray(p.types)?p.types:[];ty.innerHTML=tArr.map(function(tp){return typeBadge(tp);}).join('');}
        var st=el(pfx+'-result-stars');if(st)st.textContent=stars.label;
        var pctEl=el(pfx+'-iv-pct-display');if(pctEl)pctEl.textContent=ivPct.toFixed(1)+'%';
        var rEl=el(pfx+'-iv-rating-display');if(rEl)rEl.textContent=rating;
        var bar=el(pfx+'-iv-bar');if(bar){bar.style.width='0%';setTimeout(function(){bar.style.width=ivPct+'%';},60);}
        var cpEl=el(pfx+'-res-cp');if(cpEl)cpEl.textContent=String(cp);
        var lvEl=el(pfx+'-res-level');if(lvEl)lvEl.textContent='Lv '+(lvl===Math.floor(lvl)?lvl:lvl.toFixed(1));
        var hpEl=el(pfx+'-res-hp');if(hpEl)hpEl.textContent=String(hp);
        var ivEl=el(pfx+'-res-ivs');if(ivEl)ivEl.textContent=ivA+'/'+ivD+'/'+ivS;
        var rc=el(pfx+'-result-card');if(rc){rc.classList.add('visible');rc.scrollIntoView({behavior:'smooth',block:'nearest'});}
        return{bAtk:bAtk,bDef:bDef,bSta:bSta,ivA:ivA,ivD:ivD,ivS:ivS,lvl:lvl,cp:cp,hp:hp,ivPct:ivPct};
    }

    // ── Copy result ───────────────────────────────────────────────────────────
    function bindCopy(btnId,nameId,pctId,cpId,hpId,ivsId){
        var btn=document.getElementById(btnId);
        if(!btn)return;
        btn.addEventListener('click',function(){
            var name=document.getElementById(nameId)?document.getElementById(nameId).textContent:'';
            var pct=document.getElementById(pctId)?document.getElementById(pctId).textContent:'';
            var cp=document.getElementById(cpId)?document.getElementById(cpId).textContent:'';
            var hp=document.getElementById(hpId)?document.getElementById(hpId).textContent:'';
            var ivs=document.getElementById(ivsId)?document.getElementById(ivsId).textContent:'';
            var text=name+' | IV: '+pct+' | CP: '+cp+' | HP: '+hp+' | IVs: '+ivs+' | pokemoncalculator.online';
            var b=this;
            if(navigator.clipboard){navigator.clipboard.writeText(text).then(function(){b.textContent=_t.copied_btn||'Copied!';setTimeout(function(){b.textContent=_t.copy_btn||'Copy Results';},2000);}).catch(function(){legacyCopy(text,b);});}
            else legacyCopy(text,b);
        });
    }
    function legacyCopy(text,btn){
        var ta=document.createElement('textarea');ta.value=text;ta.style.cssText='position:fixed;opacity:0';document.body.appendChild(ta);ta.select();
        try{document.execCommand('copy');btn.textContent=_t.copied_btn||'Copied!';}catch(e){}
        document.body.removeChild(ta);setTimeout(function(){btn.textContent=_t.copy_btn||'Copy Results';},2000);
    }
    bindCopy('pkm-copy-btn','pkm-result-name','pkm-iv-pct-display','pkm-res-cp','pkm-res-hp','pkm-res-ivs');
    bindCopy('pkm-adv-copy-btn','pkm-adv-result-name','pkm-adv-iv-pct-display','pkm-adv-res-cp','pkm-adv-res-hp','pkm-adv-res-ivs');

    // ── Simple calculate ──────────────────────────────────────────────────────
    var _calcBtn=document.getElementById('pkm-calc-btn');
    if(_calcBtn){
        _calcBtn.addEventListener('click',function(){
            var id=parseInt(document.getElementById('pkm-selected-id')?document.getElementById('pkm-selected-id').value:'0',10);
            var errs=[];
            if(!id)errs.push(_t.error_select_pokemon||'Please select a Pokemon.');
            var ivA=_clamp(parseInt(document.getElementById('pkm-iv-atk')?document.getElementById('pkm-iv-atk').value:'0',10)||0,0,15);
            var ivD=_clamp(parseInt(document.getElementById('pkm-iv-def')?document.getElementById('pkm-iv-def').value:'0',10)||0,0,15);
            var ivS=_clamp(parseInt(document.getElementById('pkm-iv-sta')?document.getElementById('pkm-iv-sta').value:'0',10)||0,0,15);
            if(ivA<0||ivA>15||ivD<0||ivD>15||ivS<0||ivS>15)errs.push(_t.error_invalid_iv||'IV values must be between 0 and 15.');
            if(errs.length>0){showErrors(errs,'pkm-validation-errors');return;}
            showErrors([],'pkm-validation-errors');
            var p=findPokemon(id);
            if(!p||!p.stats){showErrors([_t.error_calculation||'Calculation error.'],'pkm-validation-errors');return;}
            populateResult(p,ivA,ivD,ivS,40,'pkm');
        });
    }

    // ── Simple reset ──────────────────────────────────────────────────────────
    var _resetBtn=document.getElementById('pkm-reset-btn');
    if(_resetBtn){
        _resetBtn.addEventListener('click',function(){
            ['pkm-search-input'].forEach(function(id){var e=document.getElementById(id);if(e)e.value='';});
            document.getElementById('pkm-selected-id')&&(document.getElementById('pkm-selected-id').value='0');
            var b=document.getElementById('pkm-selected-badge');if(b)b.classList.remove('visible');
            var c=document.getElementById('pkm-search-clear');if(c)c.style.display='none';
            ['pkm-iv-atk','pkm-iv-def','pkm-iv-sta'].forEach(function(id){var e=document.getElementById(id);if(e)e.value='15';});
            ['pkm-iv-atk-slider','pkm-iv-def-slider','pkm-iv-sta-slider'].forEach(function(id){var e=document.getElementById(id);if(e){e.value='15';updateSliderFill(e);}});
            var rc=document.getElementById('pkm-result-card');if(rc)rc.classList.remove('visible');
            showErrors([],'pkm-validation-errors');
        });
    }

    // ── Advanced calculate ────────────────────────────────────────────────────
    var _advCalcBtn=document.getElementById('pkm-adv-calc-btn');
    if(_advCalcBtn){
        _advCalcBtn.addEventListener('click',function(){
            var id=parseInt(document.getElementById('pkm-adv-selected-id')?document.getElementById('pkm-adv-selected-id').value:'0',10);
            var errs=[];
            if(!id)errs.push(_t.error_select_pokemon||'Please select a Pokemon.');
            var ivA=_clamp(parseInt(document.getElementById('pkm-adv-iv-atk')?document.getElementById('pkm-adv-iv-atk').value:'0',10)||0,0,15);
            var ivD=_clamp(parseInt(document.getElementById('pkm-adv-iv-def')?document.getElementById('pkm-adv-iv-def').value:'0',10)||0,0,15);
            var ivS=_clamp(parseInt(document.getElementById('pkm-adv-iv-sta')?document.getElementById('pkm-adv-iv-sta').value:'0',10)||0,0,15);
            var lvl=parseFloat(document.getElementById('pkm-level-value')?document.getElementById('pkm-level-value').value:'25');
            if(ivA<0||ivA>15||ivD<0||ivD>15||ivS<0||ivS>15)errs.push(_t.error_invalid_iv||'IV values must be between 0 and 15.');
            if(isNaN(lvl)||lvl<1||lvl>50.5)errs.push(_t.error_invalid_level||'Level must be between 1 and 50.');
            if(errs.length>0){showErrors(errs,'pkm-validation-errors-adv');return;}
            showErrors([],'pkm-validation-errors-adv');
            var p=findPokemon(id);
            if(!p||!p.stats){showErrors([_t.error_calculation||'Calculation error.'],'pkm-validation-errors-adv');return;}
            var res=populateResult(p,ivA,ivD,ivS,lvl,'pkm-adv');
            // PvP
            var pvpGrid=document.getElementById('pkm-pvp-grid');
            if(pvpGrid){
                var leagues=[{name:_t.pvp_great||'Great League',cap:1500},{name:_t.pvp_ultra||'Ultra League',cap:2500},{name:_t.pvp_master||'Master League',cap:null}];
                pvpGrid.innerHTML=leagues.map(function(lg){
                    var best=calcPvPBest(res.bAtk,res.bDef,res.bSta,ivA,ivD,ivS,lg.cap);
                    return '<div class="pkm-pvp-card">'
                        +'<div class="pkm-pvp-league-name">'+lg.name+(lg.cap?' (≤'+lg.cap+')':'')+'</div>'
                        +'<div class="pkm-pvp-best-cp">'+best.cp+' CP</div>'
                        +'<div class="pkm-pvp-best-level">'+(_t.pvp_best_level||'Best Level')+' '+(best.level===Math.floor(best.level)?best.level:best.level.toFixed(1))+'</div>'
                        +'<span class="pkm-pvp-eligible yes">✓ Eligible</span>'
                        +'</div>';
                }).join('');
            }
            // Moveset
            var moveGrid=document.getElementById('pkm-moveset-grid');
            if(moveGrid){
                var moves=MOVESETS[p.id]||DEFAULT_MOVESET;
                var kinds=[_t.moveset_fast||'Fast Move',_t.moveset_charged||'Charged Move'];
                moveGrid.innerHTML=moves.slice(0,2).map(function(mv,mi){
                    return '<div class="pkm-move-card">'
                        +'<div class="pkm-move-kind">'+kinds[mi]+'</div>'
                        +'<div class="pkm-move-name">'+(mi===0?mv.fast:mv.charged)+'</div>'
                        +'<div class="pkm-move-meta">'+typeBadge(mv.type)+'<span class="pkm-move-dps">'+(_t.moveset_dps||'DPS')+': '+mv.dps.toFixed(1)+'</span></div>'
                        +'</div>';
                }).join('');
            }
            // CP table
            buildCPTable(res.bAtk,res.bDef,res.bSta,ivA,ivD,ivS,lvl);
        });
    }

    // ── Advanced reset ────────────────────────────────────────────────────────
    var _advResetBtn=document.getElementById('pkm-adv-reset-btn');
    if(_advResetBtn){
        _advResetBtn.addEventListener('click',function(){
            ['pkm-adv-search-input'].forEach(function(id){var e=document.getElementById(id);if(e)e.value='';});
            document.getElementById('pkm-adv-selected-id')&&(document.getElementById('pkm-adv-selected-id').value='0');
            var b=document.getElementById('pkm-adv-selected-badge');if(b)b.classList.remove('visible');
            var c=document.getElementById('pkm-adv-search-clear');if(c)c.style.display='none';
            ['pkm-adv-iv-atk','pkm-adv-iv-def','pkm-adv-iv-sta'].forEach(function(id){var e=document.getElementById(id);if(e)e.value='15';});
            ['pkm-adv-iv-atk-slider','pkm-adv-iv-def-slider','pkm-adv-iv-sta-slider'].forEach(function(id){var e=document.getElementById(id);if(e){e.value='15';updateSliderFill(e);}});
            if(_levelSlider){_levelSlider.value='25';updateLevelDisplay(25);}
            _appraisalState={atk:0,def:0,sta:0};
            document.querySelectorAll('.pkm-arrow-btn').forEach(function(b){b.classList.remove('active-1','active-2','active-3');b.setAttribute('aria-pressed','false');});
            ['pkm-appraisal-label-atk','pkm-appraisal-label-def','pkm-appraisal-label-sta'].forEach(function(id){var e=document.getElementById(id);if(e)e.textContent='—';});
            var rc=document.getElementById('pkm-adv-result-card');if(rc)rc.classList.remove('visible');
            showErrors([],'pkm-validation-errors-adv');
        });
    }

    // ── CP table ──────────────────────────────────────────────────────────────
    function buildCPTable(bAtk,bDef,bSta,ivA,ivD,ivS,currentLvl){
        var tbody=document.getElementById('pkm-cp-table-body-rows');if(!tbody)return;
        var html='';
        for(var s=0;s<CPM.length;s++){
            var lvl=1+s*0.5;
            var cp2=calcCP(bAtk,bDef,bSta,ivA,ivD,ivS,lvl);
            var hp2=calcHP(bSta,ivS,lvl);
            var lvlD=lvl===Math.floor(lvl)?String(lvl):lvl.toFixed(1);
            var isCur=Math.abs(lvl-currentLvl)<0.01;
            var rc=isCur?' class="pkm-current-level-row"':'';
            var cc=isCur?' class="pkm-current-level"':'';
            html+='<tr'+rc+'><td'+cc+'>'+lvlD+'</td><td'+cc+'>'+cp2+'</td><td'+cc+'>'+hp2+'</td></tr>';
        }
        tbody.innerHTML=html;
    }

    var _cpToggle=document.getElementById('pkm-cp-table-toggle');
    var _cpBody=document.getElementById('pkm-cp-table-body');
    var _cpLabel=document.getElementById('pkm-cp-table-toggle-label');
    var _cpChevron=document.getElementById('pkm-cp-table-chevron');
    if(_cpToggle){
        _cpToggle.addEventListener('click',function(){
            var open=_cpBody&&_cpBody.classList.toggle('open');
            if(_cpLabel)_cpLabel.textContent=open?(_t.cp_table_hide||'Hide Level Table'):(_t.cp_table_show||'Show Level Table');
            _cpToggle.setAttribute('aria-expanded',open?'true':'false');
            if(_cpChevron)_cpChevron.style.transform=open?'rotate(180deg)':'';
        });
    }

    // ── Tabs ──────────────────────────────────────────────────────────────────
    var _tabBtns=document.querySelectorAll('.pkm-tab-btn');
    var _tabPanels=document.querySelectorAll('.pkm-tab-panel');
    _tabBtns.forEach(function(btn){
        btn.addEventListener('click',function(){
            var tab=this.getAttribute('data-tab');
            _tabBtns.forEach(function(b){b.classList.toggle('active',b.getAttribute('data-tab')===tab);b.setAttribute('aria-selected',b.getAttribute('data-tab')===tab?'true':'false');});
            _tabPanels.forEach(function(p){p.classList.toggle('active',p.id==='pkm-panel-'+tab);});
        });
    });

    // ── Bulk checker ──────────────────────────────────────────────────────────
    var _bulkRows=[];var _bulkRowCounter=0;
    var _bulkRowsEl=document.getElementById('pkm-bulk-rows');

    function createBulkRow(){
        if(_bulkRows.length>=6)return;
        _bulkRowCounter++;
        var rc=_bulkRowCounter;
        var rowId='pkm-bulk-row-'+rc;
        var searchId='pkm-bulk-search-'+rc;
        var atkId='pkm-bulk-atk-'+rc;
        var defId='pkm-bulk-def-'+rc;
        var staId='pkm-bulk-sta-'+rc;
        var hidId='pkm-bulk-id-'+rc;
        var badgeId='pkm-bulk-badge-'+rc;
        var bSpriteId='pkm-bulk-bsprite-'+rc;
        var bNameId='pkm-bulk-bname-'+rc;
        var bTypesId='pkm-bulk-btypes-'+rc;
        var resId='pkm-bulk-results-'+rc;

        var rdiv=document.createElement('div');
        rdiv.className='pkm-bulk-row';
        rdiv.id=rowId;
        rdiv.innerHTML=
            '<div class="pkm-bulk-row-top">'
            +'<div style="position:relative !important;">'
            +'<input type="text" id="'+searchId+'" class="pkm-input" placeholder="'+(_t.select_pokemon||'Search Pokemon...')+'" autocomplete="off" autocorrect="off" spellcheck="false" style="font-size:14px !important; min-height:42px !important; padding:10px 12px !important;" aria-label="Pokemon search">'
            +'<input type="hidden" id="'+hidId+'" value="0">'
            +'<div class="pkm-search-results" id="'+resId+'" role="listbox" style="z-index:1000 !important;"></div>'
            +'</div>'
            +'<div class="pkm-bulk-iv-col">'
            +'<input type="number" id="'+atkId+'" class="pkm-bulk-iv-input" min="0" max="15" value="15" inputmode="numeric" autocomplete="off" aria-label="Attack IV">'
            +'</div>'
            +'<div class="pkm-bulk-iv-col">'
            +'<input type="number" id="'+defId+'" class="pkm-bulk-iv-input" min="0" max="15" value="15" inputmode="numeric" autocomplete="off" aria-label="Defense IV">'
            +'</div>'
            +'<div class="pkm-bulk-iv-col">'
            +'<input type="number" id="'+staId+'" class="pkm-bulk-iv-input" min="0" max="15" value="15" inputmode="numeric" autocomplete="off" aria-label="Stamina IV">'
            +'</div>'
            +'<button class="pkm-bulk-remove" type="button" aria-label="Remove row" data-row="'+rowId+'">'
            +'<svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>'
            +'</button>'
            +'</div>'
            // Fix #6: Selected badge shown below search within the row
            +'<div class="pkm-bulk-selected-badge" id="'+badgeId+'">'
            +'<img src="" alt="" class="pkm-bulk-badge-sprite" id="'+bSpriteId+'" onerror="this.style.display=\'none\'">'
            +'<span class="pkm-bulk-badge-name" id="'+bNameId+'"></span>'
            +'<div class="pkm-bulk-badge-types" id="'+bTypesId+'"></div>'
            +'</div>';

        _bulkRowsEl&&_bulkRowsEl.appendChild(rdiv);

        // Remove button
        rdiv.querySelector('.pkm-bulk-remove').addEventListener('click',function(){
            var rid=this.getAttribute('data-row');
            var el=document.getElementById(rid);if(el)el.remove();
            _bulkRows=_bulkRows.filter(function(r){return r.rowId!==rid;});
            var addBtn=document.getElementById('pkm-bulk-add-btn');
            if(addBtn)addBtn.disabled=_bulkRows.length>=6;
        });

        // Bulk row search (fix #7: 1 char min, fix #6: shows badge)
        var sInp=document.getElementById(searchId);
        var sRes=document.getElementById(resId);
        var sHid=document.getElementById(hidId);
        var sBadge=document.getElementById(badgeId);
        var sBSprite=document.getElementById(bSpriteId);
        var sBName=document.getElementById(bNameId);
        var sBTypes=document.getElementById(bTypesId);
        var _bd=null,_bidx=-1;

        if(sInp&&sRes){
            sInp.addEventListener('input',function(){
                var v=this.value.trim();
                clearTimeout(_bd);
                if(v.length<1){sRes.classList.remove('open');sRes.innerHTML='';return;}
                var inp2=this;
                _bd=setTimeout(function(){
                    var ql=v.toLowerCase();
                    var r1=[],r2=[];
                    for(var i=0;i<_d.length;i++){
                        if(_d[i].name.toLowerCase().indexOf(ql)===0)r1.push(_d[i]);
                        else if(_d[i].name.toLowerCase().indexOf(ql)>0)r2.push(_d[i]);
                    }
                    var combined=r1.concat(r2).slice(0,15);
                    if(combined.length===0){sRes.innerHTML='<div class="pkm-search-no-results">'+(_t.error_no_results||'No results')+'</div>';}
                    else{
                        sRes.innerHTML=combined.map(function(pp){
                            return '<div class="pkm-search-result-item" data-id="'+pp.id+'" tabindex="-1" role="option">'
                                +'<img src="'+pp.sprite+'" alt="" class="pkm-search-result-sprite" loading="lazy" onerror="this.style.display=\'none\'">'
                                +'<span class="pkm-search-result-name">'+_cap(pp.name)+'</span>'
                                +'<span class="pkm-search-result-id">#'+String(pp.id).padStart(3,'0')+'</span>'
                                +'</div>';
                        }).join('');
                        sRes.querySelectorAll('.pkm-search-result-item').forEach(function(item){
                            item.addEventListener('mousedown',function(e){
                                e.preventDefault();
                                var pid=parseInt(this.getAttribute('data-id'),10);
                                var pp=findPokemon(pid);
                                if(pp){
                                    inp2.value=_cap(pp.name);
                                    if(sHid)sHid.value=String(pid);
                                    // Fix #6: show badge
                                    if(sBadge)sBadge.classList.add('visible');
                                    if(sBSprite){sBSprite.src=pp.sprite;sBSprite.style.display='';}
                                    if(sBName)sBName.textContent=_cap(pp.name)+' #'+String(pp.id).padStart(3,'0');
                                    if(sBTypes){var tArr2=Array.isArray(pp.types)?pp.types:[];sBTypes.innerHTML=tArr2.map(function(tp){return typeBadge(tp);}).join('');}
                                }
                                sRes.classList.remove('open');sRes.innerHTML='';
                            });
                        });
                    }
                    sRes.classList.add('open');_bidx=-1;
                },150);
            });
            sInp.addEventListener('keydown',function(e){
                var itms=sRes.querySelectorAll('.pkm-search-result-item');
                if(e.key==='ArrowDown'){e.preventDefault();_bidx=Math.min(_bidx+1,itms.length-1);itms.forEach(function(i2,idx){i2.classList.toggle('keyboard-focus',idx===_bidx);});}
                else if(e.key==='ArrowUp'){e.preventDefault();_bidx=Math.max(_bidx-1,0);itms.forEach(function(i2,idx){i2.classList.toggle('keyboard-focus',idx===_bidx);});}
                else if(e.key==='Enter'&&_bidx>=0&&itms[_bidx]){e.preventDefault();itms[_bidx].dispatchEvent(new MouseEvent('mousedown',{bubbles:true}));}
                else if(e.key==='Escape'){sRes.classList.remove('open');sRes.innerHTML='';}
            });
            sInp.addEventListener('blur',function(){setTimeout(function(){sRes.classList.remove('open');},200);});
        }

        _bulkRows.push({rowId:rowId,searchId:searchId,hidId:hidId,atkId:atkId,defId:defId,staId:staId});
    }

    // Init 3 rows
    createBulkRow();createBulkRow();createBulkRow();

    var _bulkAddBtn=document.getElementById('pkm-bulk-add-btn');
    if(_bulkAddBtn){_bulkAddBtn.addEventListener('click',function(){if(_bulkRows.length<6){createBulkRow();}this.disabled=_bulkRows.length>=6;});}

    var _bulkCalcBtn=document.getElementById('pkm-bulk-calc-btn');
    if(_bulkCalcBtn){
        _bulkCalcBtn.addEventListener('click',function(){
            showErrors([],'pkm-bulk-validation-errors');
            var entries=[];
            _bulkRows.forEach(function(row){
                var rowEl=document.getElementById(row.rowId);if(!rowEl)return;
                var pid=parseInt(document.getElementById(row.hidId)?document.getElementById(row.hidId).value:'0',10);
                if(!pid)return;
                var p=findPokemon(pid);if(!p||!p.stats)return;
                var ivA=_clamp(parseInt(document.getElementById(row.atkId)?document.getElementById(row.atkId).value:'15',10)||0,0,15);
                var ivD=_clamp(parseInt(document.getElementById(row.defId)?document.getElementById(row.defId).value:'15',10)||0,0,15);
                var ivS=_clamp(parseInt(document.getElementById(row.staId)?document.getElementById(row.staId).value:'15',10)||0,0,15);
                var bAtk=p.stats.attack||0;var bDef=p.stats.defense||0;var bSta=p.stats.hp||p.stats.stamina||0;
                entries.push({p:p,ivA:ivA,ivD:ivD,ivS:ivS,pct:calcIVPct(ivA,ivD,ivS),cp:calcCP(bAtk,bDef,bSta,ivA,ivD,ivS,40),hp:calcHP(bSta,ivS,40)});
            });
            if(entries.length===0){showErrors([_t.error_bulk_empty||'Please add at least one Pokemon.'],'pkm-bulk-validation-errors');return;}
            entries.sort(function(a,b){return b.pct-a.pct;});
            var tbody=document.getElementById('pkm-bulk-results-body');if(!tbody)return;
            tbody.innerHTML=entries.map(function(e,j){
                var rankClass=j===0?' rank-1':j===1?' rank-2':j===2?' rank-3':'';
                var tArr=Array.isArray(e.p.types)?e.p.types:[];
                return '<tr>'
                    +'<td><span class="pkm-bulk-rank-badge'+rankClass+'">'+(j+1)+'</span></td>'
                    +'<td><img src="'+e.p.sprite+'" alt="" class="pkm-bulk-sprite" onerror="this.style.display=\'none\'"> '+_cap(e.p.name)+'</td>'
                    +'<td>'+e.ivA+'/'+e.ivD+'/'+e.ivS+'</td>'
                    +'<td><strong>'+e.pct.toFixed(1)+'%</strong></td>'
                    +'<td>'+e.cp+'</td>'
                    +'<td>'+tArr.map(function(tp){return typeBadge(tp);}).join('')+'</td>'
                    +'</tr>';
            }).join('');
            var resCard=document.getElementById('pkm-bulk-results-card');
            if(resCard){resCard.style.display='';resCard.scrollIntoView({behavior:'smooth',block:'nearest'});}
        });
    }

    var _bulkClearBtn=document.getElementById('pkm-bulk-clear-btn');
    if(_bulkClearBtn){
        _bulkClearBtn.addEventListener('click',function(){
            _bulkRows=[];_bulkRowCounter=0;
            if(_bulkRowsEl)_bulkRowsEl.innerHTML='';
            var rc=document.getElementById('pkm-bulk-results-card');if(rc)rc.style.display='none';
            showErrors([],'pkm-bulk-validation-errors');
            createBulkRow();createBulkRow();createBulkRow();
            var addBtn=document.getElementById('pkm-bulk-add-btn');if(addBtn)addBtn.disabled=false;
        });
    }

    var _bulkCopyBtn=document.getElementById('pkm-bulk-copy-btn');
    if(_bulkCopyBtn){
        _bulkCopyBtn.addEventListener('click',function(){
            var tbody=document.getElementById('pkm-bulk-results-body');if(!tbody)return;
            var rows=tbody.querySelectorAll('tr');
            var lines=['#\tPokemon\tIVs\tIV%\tCP'];
            rows.forEach(function(row){
                var cells=row.querySelectorAll('td');if(cells.length<5)return;
                lines.push(cells[0].textContent.trim()+'\t'+cells[1].textContent.trim()+'\t'+cells[2].textContent.trim()+'\t'+cells[3].textContent.trim()+'\t'+cells[4].textContent.trim());
            });
            var text=lines.join('\n')+'\npokemoncalculator.online';
            var btn=this;
            if(navigator.clipboard){navigator.clipboard.writeText(text).then(function(){btn.textContent=_t.copied_btn||'Copied!';setTimeout(function(){btn.textContent=_t.bulk_copy_btn||'Copy Results';},2000);}).catch(function(){legacyCopy(text,btn);});}
            else legacyCopy(text,btn);
        });
    }

    })(); // end IIFE
    </script>

    <?php
    return ob_get_clean();
}
add_shortcode( 'pkm_iv_calc', 'pkm_iv_calc_shortcode' );