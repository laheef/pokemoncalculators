<?php
// Standalone PHP

/*
 * ============================================================
 * Pokemon Speed Tiers Calculator — v3 (UX Logic Rebuild)
 * File: wp-content/themes/theme-v1.3.0/pkm-calculators/pkm-speed-tiers.php
 * Shortcode: [pkm_speed_tiers_calc]
 * ============================================================
 *
 * LANGUAGE SWITCHER SETUP — REQUIRED
 * Add the following line to the $slug_map array inside
 * the pkm_get_lang_url() function in functions.php:
 *
 * 'speed-tiers' => array('es' => 'niveles-velocidad', 'pt-br' => 'niveis-velocidade', 'fr' => 'niveaux-vitesse', 'de' => 'geschwindigkeit-stufen'),
 *
 * ============================================================
 * FUNCTIONS.PHP REGISTRATION — Add this single line:
 * require_once get_stylesheet_directory() . '/pkm-calculators/pkm-speed-tiers.php';
 * ============================================================
 */

// ── Google Analytics ─────────────────────────────────────────
function pkm_speed_tiers_gtag() {
    if ( ! is_page( [ 'speed-tiers', 'niveles-velocidad', 'niveis-velocidade', 'niveaux-vitesse', 'geschwindigkeit-stufen' ] ) ) return;
    ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-PJWFG8GEPM"></script>
    <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-PJWFG8GEPM');</script>
    <?php
}
add_action( 'wp_head', 'pkm_speed_tiers_gtag', 1 );

function pkm_speed_tiers_fonts() {
    if ( ! is_page( [ 'speed-tiers', 'niveles-velocidad', 'niveis-velocidade', 'niveaux-vitesse', 'geschwindigkeit-stufen' ] ) ) return;
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
    echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Exo+2:wght@400;500;600;700;800;900&display=swap">' . "\n";
}
add_action( 'wp_head', 'pkm_speed_tiers_fonts', 2 );

// ── Hreflang ─────────────────────────────────────────────────
function pkm_speed_tiers_hreflang() {
    if ( ! is_page( [ 'speed-tiers', 'niveles-velocidad', 'niveis-velocidade', 'niveaux-vitesse', 'geschwindigkeit-stufen' ] ) ) return;
    foreach ( [ 'en', 'es', 'pt-br', 'fr', 'de' ] as $l ) {
        $hl = ( $l === 'pt-br' ) ? 'pt-BR' : $l;
        echo '<link rel="alternate" hreflang="' . esc_attr( $hl ) . '" href="' . esc_url( pkm_get_lang_url( $l ) ) . '">' . "\n";
    }
    echo '<link rel="alternate" hreflang="x-default" href="' . esc_url( pkm_get_lang_url( 'en' ) ) . '">' . "\n";
}
add_action( 'wp_head', 'pkm_speed_tiers_hreflang' );

// ── Canonical ────────────────────────────────────────────────
function pkm_speed_tiers_canonical() {
    if ( ! is_page( [ 'speed-tiers', 'niveles-velocidad', 'niveis-velocidade', 'niveaux-vitesse', 'geschwindigkeit-stufen' ] ) ) return;
    $url = ( is_ssl() ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    echo '<link rel="canonical" href="' . esc_url( $url ) . '">' . "\n";
}
add_action( 'wp_head', 'pkm_speed_tiers_canonical' );

// ── Schema ───────────────────────────────────────────────────
function pkm_speed_tiers_schema() {
    if ( ! is_page( [ 'speed-tiers', 'niveles-velocidad', 'niveis-velocidade', 'niveaux-vitesse', 'geschwindigkeit-stufen' ] ) ) return;
    global $pkm_current_lang;
    $lang    = $pkm_current_lang ?? 'en';
    $cur_url = ( is_ssl() ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $names = [ 'en' => 'Pokemon Speed Tiers Calculator', 'es' => 'Calculadora de Niveles de Velocidad Pokemon', 'pt-br' => 'Calculadora de Níveis de Velocidade Pokemon', 'fr' => 'Calculateur de Niveaux de Vitesse Pokemon', 'de' => 'Pokemon Geschwindigkeit Stufen Rechner' ];
    $descs = [ 'en' => 'Calculate and compare Pokemon speed tiers for VGC, Doubles, and OU formats.', 'es' => 'Calcula y compara los niveles de velocidad de Pokemon para VGC, Dobles y OU.', 'pt-br' => 'Calcule e compare os níveis de velocidade de Pokemon para VGC, Duplas e OU.', 'fr' => 'Calculez et comparez les niveaux de vitesse des Pokemon pour VGC, Doubles et OU.', 'de' => 'Berechne und vergleiche Pokemon-Geschwindigkeitsstufen für VGC, Doubles und OU.' ];
    $lmap  = [ 'en' => 'en', 'es' => 'es', 'pt-br' => 'pt-BR', 'fr' => 'fr', 'de' => 'de' ];
    $schema = [ '@context' => 'https://schema.org', '@graph' => [
        [ '@type' => 'WebApplication', 'name' => $names[$lang] ?? $names['en'], 'description' => $descs[$lang] ?? $descs['en'], 'url' => $cur_url, 'inLanguage' => $lmap[$lang] ?? 'en', 'applicationCategory' => 'GameApplication', 'operatingSystem' => 'Any', 'offers' => [ '@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD' ] ],
        [ '@type' => 'HowTo', 'name' => 'step1_placeholder', 'step' => [ [ '@type' => 'HowToStep', 'text' => 'step1_placeholder' ], [ '@type' => 'HowToStep', 'text' => 'step2_placeholder' ], [ '@type' => 'HowToStep', 'text' => 'step3_placeholder' ], [ '@type' => 'HowToStep', 'text' => 'step4_placeholder' ] ] ],
        [ '@type' => 'FAQPage', 'mainEntity' => [ [ '@type' => 'Question', 'name' => 'faq_q1_placeholder', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'faq_a1_placeholder' ] ] ] ],
        [ '@type' => 'BreadcrumbList', 'itemListElement' => [ [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url('/') ], [ '@type' => 'ListItem', 'position' => 2, 'name' => $names[$lang] ?? $names['en'], 'item' => $cur_url ] ] ],
    ] ];
    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'pkm_speed_tiers_schema' );

// ── Strings ──────────────────────────────────────────────────
$pkm_speed_tiers_strings = [
    'en' => [
        'title'                => 'Pokemon Speed Tiers',
        'description'          => 'Find any Pokemon\'s speed tier instantly. Search by name, then tweak nature, EVs, and Choice Scarf — the table updates live.',
        'search_label'         => 'Find a Pokemon',
        'search_placeholder'   => 'e.g. Garchomp, Pikachu, Miraidon...',
        'search_hint'          => 'Type to search — the table will highlight your Pokemon and show its exact speed',
        'modifiers_label'      => 'Modifiers',
        'modifiers_hint'       => 'Change any setting below — the full table recalculates live',
        'format_label'         => 'Format',
        'format_vgc'           => 'VGC / Doubles (Lv 50)',
        'format_ou'            => 'OU / Singles (Lv 100)',
        'nature_label'         => 'Speed Nature',
        'nature_neutral'       => 'Neutral ×1.0',
        'nature_plus'          => '+ Speed  ×1.1',
        'nature_minus'         => '− Speed  ×0.9',
        'evs_label'            => 'Speed EVs',
        'ivs_label'            => 'Speed IVs',
        'scarf_label'          => 'Choice Scarf ×1.5',
        'scarf_on'             => 'Scarf ON',
        'scarf_off'            => 'No Scarf',
        'reset_btn'            => 'Reset All',
        'result_title'         => 'Your Pokemon\'s Speed',
        'result_tier_label'    => 'Tier',
        'result_base_label'    => 'Base Speed',
        'result_final_label'   => 'Final Speed',
        'benchmark_title'      => 'What it outspeeds / is outsped by',
        'benchmark_outspeeds'  => 'Outspeeds',
        'benchmark_outsped_by' => 'Outsped by',
        'benchmark_ties'       => 'Speed Tie',
        'benchmark_none'       => 'No notable speed benchmarks found.',
        'table_title'          => 'Full Speed Tier Table',
        'table_hint'           => 'Showing calculated speed for current modifiers',
        'tier_label'           => 'Tier',
        'pokemon_label'        => 'Pokemon',
        'type_label'           => 'Type',
        'base_speed_label'     => 'Base',
        'final_speed_label'    => 'Speed',
        'rank_label'           => '#',
        'tier_s_label'         => 'S-Tier  — Lightning Fast',
        'tier_a_label'         => 'A-Tier  — Very Fast',
        'tier_b_label'         => 'B-Tier  — Above Average',
        'tier_c_label'         => 'C-Tier  — Average',
        'tier_d_label'         => 'D-Tier  — Below Average',
        'tier_e_label'         => 'E-Tier  — Very Slow',
        'filter_all'           => 'All Tiers',
        'filter_label'         => 'Show tier:',
        'results_count'        => 'Pokemon shown',
        'no_pokemon_found'     => 'No Pokemon found in this tier.',
        'clear_search'         => 'Clear',
        'ev_bonus_label'       => '+%d speed',
        'error_data_load'      => 'Could not load Pokemon data. Please refresh the page.',
        'error_invalid_iv'     => 'IVs must be between 0 and 31.',
        'error_invalid_ev'     => 'EVs must be between 0 and 252.',
        'error_no_results'     => 'No Pokemon found matching your search.',
        'noscript_msg'         => 'Please enable JavaScript to use this calculator.',
        'meta_title' => '', 'meta_desc' => '',
        'intro_title' => '', 'intro_content' => '',
        'howto_title' => '', 'howto_step1' => '', 'howto_step2' => '', 'howto_step3' => '', 'howto_step4' => '',
        'info_title' => '', 'info_content' => '', 'info_table_title' => '', 'info_table_html' => '',
        'faq_title' => '',
        'faq_q1'=>'','faq_a1'=>'','faq_q2'=>'','faq_a2'=>'','faq_q3'=>'','faq_a3'=>'',
        'faq_q4'=>'','faq_a4'=>'','faq_q5'=>'','faq_a5'=>'','faq_q6'=>'','faq_a6'=>'',
        'faq_q7'=>'','faq_a7'=>'','faq_q8'=>'','faq_a8'=>'',
    ],
    'es' => [
        'title'                => 'Niveles de Velocidad Pokemon',
        'description'          => 'Encuentra el nivel de velocidad de cualquier Pokemon al instante. Busca por nombre, ajusta naturaleza, EVs y Pañuelo Elegido.',
        'search_label'         => 'Buscar un Pokemon',
        'search_placeholder'   => 'p.ej. Garchomp, Pikachu, Miraidon...',
        'search_hint'          => 'Escribe para buscar — la tabla resaltará tu Pokemon y mostrará su velocidad exacta',
        'modifiers_label'      => 'Modificadores',
        'modifiers_hint'       => 'Cambia cualquier ajuste — la tabla completa se recalcula al instante',
        'format_label'         => 'Formato',
        'format_vgc'           => 'VGC / Dobles (Nv 50)',
        'format_ou'            => 'OU / Singles (Nv 100)',
        'nature_label'         => 'Naturaleza Velocidad',
        'nature_neutral'       => 'Neutral ×1.0',
        'nature_plus'          => '+ Velocidad  ×1.1',
        'nature_minus'         => '− Velocidad  ×0.9',
        'evs_label'            => 'EVs de Velocidad',
        'ivs_label'            => 'IVs de Velocidad',
        'scarf_label'          => 'Pañuelo Elegido ×1.5',
        'scarf_on'             => 'Pañuelo ON',
        'scarf_off'            => 'Sin Pañuelo',
        'reset_btn'            => 'Reiniciar Todo',
        'result_title'         => 'Velocidad de tu Pokemon',
        'result_tier_label'    => 'Nivel',
        'result_base_label'    => 'Vel. Base',
        'result_final_label'   => 'Vel. Final',
        'benchmark_title'      => 'A qué supera / qué lo supera',
        'benchmark_outspeeds'  => 'Supera a',
        'benchmark_outsped_by' => 'Superado por',
        'benchmark_ties'       => 'Empate',
        'benchmark_none'       => 'Sin referencias de velocidad notables.',
        'table_title'          => 'Tabla Completa de Niveles de Velocidad',
        'table_hint'           => 'Mostrando velocidad calculada para los modificadores actuales',
        'tier_label'           => 'Nivel',
        'pokemon_label'        => 'Pokemon',
        'type_label'           => 'Tipo',
        'base_speed_label'     => 'Base',
        'final_speed_label'    => 'Velocidad',
        'rank_label'           => '#',
        'tier_s_label'         => 'S — Rápido como un Rayo',
        'tier_a_label'         => 'A — Muy Rápido',
        'tier_b_label'         => 'B — Por Encima de la Media',
        'tier_c_label'         => 'C — Promedio',
        'tier_d_label'         => 'D — Por Debajo de la Media',
        'tier_e_label'         => 'E — Muy Lento',
        'filter_all'           => 'Todos',
        'filter_label'         => 'Mostrar nivel:',
        'results_count'        => 'Pokemon mostrados',
        'no_pokemon_found'     => 'No se encontraron Pokemon en este nivel.',
        'clear_search'         => 'Limpiar',
        'ev_bonus_label'       => '+%d velocidad',
        'error_data_load'      => 'No se pudieron cargar los datos de Pokemon. Actualiza la página.',
        'error_invalid_iv'     => 'Los IVs deben estar entre 0 y 31.',
        'error_invalid_ev'     => 'Los EVs deben estar entre 0 y 252.',
        'error_no_results'     => 'No se encontraron Pokemon para tu búsqueda.',
        'noscript_msg'         => 'Activa JavaScript para usar esta calculadora.',
        'meta_title' => '', 'meta_desc' => '',
        'intro_title' => '', 'intro_content' => '',
        'howto_title' => '', 'howto_step1' => '', 'howto_step2' => '', 'howto_step3' => '', 'howto_step4' => '',
        'info_title' => '', 'info_content' => '', 'info_table_title' => '', 'info_table_html' => '',
        'faq_title' => '',
        'faq_q1'=>'','faq_a1'=>'','faq_q2'=>'','faq_a2'=>'','faq_q3'=>'','faq_a3'=>'',
        'faq_q4'=>'','faq_a4'=>'','faq_q5'=>'','faq_a5'=>'','faq_q6'=>'','faq_a6'=>'',
        'faq_q7'=>'','faq_a7'=>'','faq_q8'=>'','faq_a8'=>'',
    ],
    'pt-br' => [
        'title'                => 'Níveis de Velocidade Pokemon',
        'description'          => 'Encontre o nível de velocidade de qualquer Pokemon instantaneamente. Pesquise por nome, ajuste natureza, EVs e Lenço Fino.',
        'search_label'         => 'Encontrar um Pokemon',
        'search_placeholder'   => 'ex. Garchomp, Pikachu, Miraidon...',
        'search_hint'          => 'Digite para pesquisar — a tabela destacará seu Pokemon e mostrará sua velocidade exata',
        'modifiers_label'      => 'Modificadores',
        'modifiers_hint'       => 'Mude qualquer configuração — a tabela completa recalcula instantaneamente',
        'format_label'         => 'Formato',
        'format_vgc'           => 'VGC / Duplas (Nv 50)',
        'format_ou'            => 'OU / Singles (Nv 100)',
        'nature_label'         => 'Natureza Velocidade',
        'nature_neutral'       => 'Neutro ×1.0',
        'nature_plus'          => '+ Velocidade  ×1.1',
        'nature_minus'         => '− Velocidade  ×0.9',
        'evs_label'            => 'EVs de Velocidade',
        'ivs_label'            => 'IVs de Velocidade',
        'scarf_label'          => 'Lenço Fino ×1.5',
        'scarf_on'             => 'Lenço ON',
        'scarf_off'            => 'Sem Lenço',
        'reset_btn'            => 'Redefinir Tudo',
        'result_title'         => 'Velocidade do seu Pokemon',
        'result_tier_label'    => 'Nível',
        'result_base_label'    => 'Vel. Base',
        'result_final_label'   => 'Vel. Final',
        'benchmark_title'      => 'O que ele supera / o que o supera',
        'benchmark_outspeeds'  => 'Mais rápido que',
        'benchmark_outsped_by' => 'Mais lento que',
        'benchmark_ties'       => 'Empate',
        'benchmark_none'       => 'Sem referências de velocidade notáveis.',
        'table_title'          => 'Tabela Completa de Níveis de Velocidade',
        'table_hint'           => 'Mostrando velocidade calculada para os modificadores atuais',
        'tier_label'           => 'Nível',
        'pokemon_label'        => 'Pokemon',
        'type_label'           => 'Tipo',
        'base_speed_label'     => 'Base',
        'final_speed_label'    => 'Velocidade',
        'rank_label'           => '#',
        'tier_s_label'         => 'S — Velocidade Relâmpago',
        'tier_a_label'         => 'A — Muito Rápido',
        'tier_b_label'         => 'B — Acima da Média',
        'tier_c_label'         => 'C — Médio',
        'tier_d_label'         => 'D — Abaixo da Média',
        'tier_e_label'         => 'E — Muito Lento',
        'filter_all'           => 'Todos',
        'filter_label'         => 'Mostrar nível:',
        'results_count'        => 'Pokemon exibidos',
        'no_pokemon_found'     => 'Nenhum Pokemon encontrado neste nível.',
        'clear_search'         => 'Limpar',
        'ev_bonus_label'       => '+%d velocidade',
        'error_data_load'      => 'Não foi possível carregar os dados. Atualize a página.',
        'error_invalid_iv'     => 'IVs devem estar entre 0 e 31.',
        'error_invalid_ev'     => 'EVs devem estar entre 0 e 252.',
        'error_no_results'     => 'Nenhum Pokemon encontrado para sua pesquisa.',
        'noscript_msg'         => 'Ative o JavaScript para usar esta calculadora.',
        'meta_title' => '', 'meta_desc' => '',
        'intro_title' => '', 'intro_content' => '',
        'howto_title' => '', 'howto_step1' => '', 'howto_step2' => '', 'howto_step3' => '', 'howto_step4' => '',
        'info_title' => '', 'info_content' => '', 'info_table_title' => '', 'info_table_html' => '',
        'faq_title' => '',
        'faq_q1'=>'','faq_a1'=>'','faq_q2'=>'','faq_a2'=>'','faq_q3'=>'','faq_a3'=>'',
        'faq_q4'=>'','faq_a4'=>'','faq_q5'=>'','faq_a5'=>'','faq_q6'=>'','faq_a6'=>'',
        'faq_q7'=>'','faq_a7'=>'','faq_q8'=>'','faq_a8'=>'',
    ],
    'fr' => [
        'title'                => 'Niveaux de Vitesse Pokemon',
        'description'          => 'Trouvez le niveau de vitesse de n\'importe quel Pokemon instantanément. Recherchez par nom, ajustez la nature, les EVs et l\'Écharpe Choix.',
        'search_label'         => 'Trouver un Pokemon',
        'search_placeholder'   => 'ex. Garchomp, Pikachu, Miraidon...',
        'search_hint'          => 'Tapez pour rechercher — le tableau mettra en évidence votre Pokemon et affichera sa vitesse exacte',
        'modifiers_label'      => 'Modificateurs',
        'modifiers_hint'       => 'Modifiez n\'importe quel paramètre — le tableau complet se recalcule instantanément',
        'format_label'         => 'Format',
        'format_vgc'           => 'VGC / Doubles (Nv 50)',
        'format_ou'            => 'OU / Singles (Nv 100)',
        'nature_label'         => 'Nature Vitesse',
        'nature_neutral'       => 'Neutre ×1.0',
        'nature_plus'          => '+ Vitesse  ×1.1',
        'nature_minus'         => '− Vitesse  ×0.9',
        'evs_label'            => 'EVs de Vitesse',
        'ivs_label'            => 'IVs de Vitesse',
        'scarf_label'          => 'Écharpe Choix ×1.5',
        'scarf_on'             => 'Écharpe ON',
        'scarf_off'            => 'Sans Écharpe',
        'reset_btn'            => 'Tout Réinitialiser',
        'result_title'         => 'Vitesse de votre Pokemon',
        'result_tier_label'    => 'Niveau',
        'result_base_label'    => 'Vit. Base',
        'result_final_label'   => 'Vit. Finale',
        'benchmark_title'      => 'Ce qu\'il dépasse / ce qui le dépasse',
        'benchmark_outspeeds'  => 'Plus rapide que',
        'benchmark_outsped_by' => 'Plus lent que',
        'benchmark_ties'       => 'Égalité',
        'benchmark_none'       => 'Aucune référence de vitesse notable.',
        'table_title'          => 'Tableau Complet des Niveaux de Vitesse',
        'table_hint'           => 'Vitesse calculée pour les modificateurs actuels',
        'tier_label'           => 'Niveau',
        'pokemon_label'        => 'Pokemon',
        'type_label'           => 'Type',
        'base_speed_label'     => 'Base',
        'final_speed_label'    => 'Vitesse',
        'rank_label'           => '#',
        'tier_s_label'         => 'S — Éclair',
        'tier_a_label'         => 'A — Très Rapide',
        'tier_b_label'         => 'B — Au-dessus de la Moyenne',
        'tier_c_label'         => 'C — Moyen',
        'tier_d_label'         => 'D — En-dessous de la Moyenne',
        'tier_e_label'         => 'E — Très Lent',
        'filter_all'           => 'Tous',
        'filter_label'         => 'Afficher niveau:',
        'results_count'        => 'Pokemon affichés',
        'no_pokemon_found'     => 'Aucun Pokemon trouvé dans ce niveau.',
        'clear_search'         => 'Effacer',
        'ev_bonus_label'       => '+%d vitesse',
        'error_data_load'      => 'Impossible de charger les données Pokemon. Actualisez la page.',
        'error_invalid_iv'     => 'Les IVs doivent être entre 0 et 31.',
        'error_invalid_ev'     => 'Les EVs doivent être entre 0 et 252.',
        'error_no_results'     => 'Aucun Pokemon trouvé pour votre recherche.',
        'noscript_msg'         => 'Activez JavaScript pour utiliser cette calculatrice.',
        'meta_title' => '', 'meta_desc' => '',
        'intro_title' => '', 'intro_content' => '',
        'howto_title' => '', 'howto_step1' => '', 'howto_step2' => '', 'howto_step3' => '', 'howto_step4' => '',
        'info_title' => '', 'info_content' => '', 'info_table_title' => '', 'info_table_html' => '',
        'faq_title' => '',
        'faq_q1'=>'','faq_a1'=>'','faq_q2'=>'','faq_a2'=>'','faq_q3'=>'','faq_a3'=>'',
        'faq_q4'=>'','faq_a4'=>'','faq_q5'=>'','faq_a5'=>'','faq_q6'=>'','faq_a6'=>'',
        'faq_q7'=>'','faq_a7'=>'','faq_q8'=>'','faq_a8'=>'',
    ],
    'de' => [
        'title'                => 'Pokemon Geschwindigkeit Stufen',
        'description'          => 'Finde die Geschwindigkeitsstufe jedes Pokemon sofort. Suche nach Name, passe Wesen, EVs und Wahlschal an — die Tabelle aktualisiert sich live.',
        'search_label'         => 'Pokemon suchen',
        'search_placeholder'   => 'z.B. Garchomp, Pikachu, Miraidon...',
        'search_hint'          => 'Tippe zum Suchen — die Tabelle hebt dein Pokemon hervor und zeigt seine genaue Geschwindigkeit',
        'modifiers_label'      => 'Modifikatoren',
        'modifiers_hint'       => 'Ändere eine Einstellung — die gesamte Tabelle wird sofort neu berechnet',
        'format_label'         => 'Format',
        'format_vgc'           => 'VGC / Doppel (Lv 50)',
        'format_ou'            => 'OU / Einzel (Lv 100)',
        'nature_label'         => 'Geschwindigkeit Wesen',
        'nature_neutral'       => 'Neutral ×1.0',
        'nature_plus'          => '+ Tempo  ×1.1',
        'nature_minus'         => '− Tempo  ×0.9',
        'evs_label'            => 'Tempo EVs',
        'ivs_label'            => 'Tempo IVs',
        'scarf_label'          => 'Wahlschal ×1.5',
        'scarf_on'             => 'Schal AN',
        'scarf_off'            => 'Ohne Schal',
        'reset_btn'            => 'Alles Zurücksetzen',
        'result_title'         => 'Geschwindigkeit deines Pokemon',
        'result_tier_label'    => 'Stufe',
        'result_base_label'    => 'Basis-Tempo',
        'result_final_label'   => 'End-Tempo',
        'benchmark_title'      => 'Was es übertrifft / was es übertrifft',
        'benchmark_outspeeds'  => 'Schneller als',
        'benchmark_outsped_by' => 'Langsamer als',
        'benchmark_ties'       => 'Gleichstand',
        'benchmark_none'       => 'Keine nennenswerten Geschwindigkeitsreferenzen.',
        'table_title'          => 'Vollständige Geschwindigkeitsstufentabelle',
        'table_hint'           => 'Berechnete Geschwindigkeit für aktuelle Modifikatoren',
        'tier_label'           => 'Stufe',
        'pokemon_label'        => 'Pokemon',
        'type_label'           => 'Typ',
        'base_speed_label'     => 'Basis',
        'final_speed_label'    => 'Tempo',
        'rank_label'           => '#',
        'tier_s_label'         => 'S — Blitzschnell',
        'tier_a_label'         => 'A — Sehr Schnell',
        'tier_b_label'         => 'B — Überdurchschnittlich',
        'tier_c_label'         => 'C — Durchschnittlich',
        'tier_d_label'         => 'D — Unterdurchschnittlich',
        'tier_e_label'         => 'E — Sehr Langsam',
        'filter_all'           => 'Alle',
        'filter_label'         => 'Stufe zeigen:',
        'results_count'        => 'Pokemon angezeigt',
        'no_pokemon_found'     => 'Keine Pokemon in dieser Stufe gefunden.',
        'clear_search'         => 'Löschen',
        'ev_bonus_label'       => '+%d Tempo',
        'error_data_load'      => 'Pokemon-Daten konnten nicht geladen werden. Bitte aktualisiere die Seite.',
        'error_invalid_iv'     => 'IVs müssen zwischen 0 und 31 liegen.',
        'error_invalid_ev'     => 'EVs müssen zwischen 0 und 252 liegen.',
        'error_no_results'     => 'Keine Pokemon für deine Suche gefunden.',
        'noscript_msg'         => 'Aktiviere JavaScript, um diesen Rechner zu nutzen.',
        'meta_title' => '', 'meta_desc' => '',
        'intro_title' => '', 'intro_content' => '',
        'howto_title' => '', 'howto_step1' => '', 'howto_step2' => '', 'howto_step3' => '', 'howto_step4' => '',
        'info_title' => '', 'info_content' => '', 'info_table_title' => '', 'info_table_html' => '',
        'faq_title' => '',
        'faq_q1'=>'','faq_a1'=>'','faq_q2'=>'','faq_a2'=>'','faq_q3'=>'','faq_a3'=>'',
        'faq_q4'=>'','faq_a4'=>'','faq_q5'=>'','faq_a5'=>'','faq_q6'=>'','faq_a6'=>'',
        'faq_q7'=>'','faq_a7'=>'','faq_q8'=>'','faq_a8'=>'',
    ],
];

// ── Shortcode ────────────────────────────────────────────────
function pkm_speed_tiers_calc_shortcode() {
    global $pkm_current_lang, $pkm_speed_tiers_strings;
    $lang = $pkm_current_lang ?? 'en';
    $t    = $pkm_speed_tiers_strings[ $lang ] ?? $pkm_speed_tiers_strings['en'];

    $ad_slot_a = get_setting('ad_slot_top', get_setting('ad_header_code', ''));
    $ad_slot_b = get_setting('ad_slot_mid_content', '');
    $ad_slot_c = get_setting('ad_slot_below_result', '');
    $ad_slot_d = get_setting('ad_slot_mid_faq', '');
    $ad_slot_e = get_setting('ad_slot_sky_left', get_setting('ad_slot_sidebar', ''));
    $ad_slot_f_sky = get_setting('ad_slot_sky_right', get_setting('ad_slot_sidebar', ''));

    $pkm_render_ad = function( string $slot, string $cls = '' ): string {
        return pkm_render_ad( $slot, $cls );
    };

    $raw = get_pokemon_data();
    $data_error = empty( $raw ) || ! is_array( $raw );
    $js_data = [];
    if ( ! $data_error ) {
        $js_data = array_map( function( $p ) {
            return [
                'id'     => intval( $p['id'] ?? 0 ),
                'name'   => sanitize_text_field( $p['name'] ?? '' ),
                'types'  => array_values( $p['types'] ?? [] ),
                'stats'  => array_map( 'intval', $p['stats'] ?? [] ),
                'sprite' => esc_url( trim( $p['sprite_default'] ?? '' ) ),
            ];
        }, $raw );
    }

    $regieleki = get_pokemon_data( 894 );
    $miraidon  = get_pokemon_data( 1007 );
    $electrode = get_pokemon_data( 101 );
    $sprite_a  = esc_url( trim( $regieleki['sprite_official'] ?? $regieleki['sprite_default'] ?? '' ) );
    $sprite_b  = esc_url( trim( $miraidon['sprite_official']  ?? $miraidon['sprite_default']  ?? '' ) );
    $sprite_c  = esc_url( trim( $electrode['sprite_official'] ?? $electrode['sprite_default'] ?? '' ) );

    $jst = [
        'scarf_on'             => $t['scarf_on'],
        'scarf_off'            => $t['scarf_off'],
        'error_data_load'      => $t['error_data_load'],
        'error_invalid_iv'     => $t['error_invalid_iv'],
        'error_invalid_ev'     => $t['error_invalid_ev'],
        'error_no_results'     => $t['error_no_results'],
        'benchmark_outspeeds'  => $t['benchmark_outspeeds'],
        'benchmark_outsped_by' => $t['benchmark_outsped_by'],
        'benchmark_ties'       => $t['benchmark_ties'],
        'benchmark_none'       => $t['benchmark_none'],
        'result_title'         => $t['result_title'],
        'result_tier_label'    => $t['result_tier_label'],
        'result_base_label'    => $t['result_base_label'],
        'result_final_label'   => $t['result_final_label'],
        'no_pokemon_found'     => $t['no_pokemon_found'],
        'results_count'        => $t['results_count'],
        'rank_label'           => $t['rank_label'],
        'pokemon_label'        => $t['pokemon_label'],
        'type_label'           => $t['type_label'],
        'base_speed_label'     => $t['base_speed_label'],
        'final_speed_label'    => $t['final_speed_label'],
        'tier_label'           => $t['tier_label'],
        'clear_search'         => $t['clear_search'],
        'tier_s_label'         => $t['tier_s_label'],
        'tier_a_label'         => $t['tier_a_label'],
        'tier_b_label'         => $t['tier_b_label'],
        'tier_c_label'         => $t['tier_c_label'],
        'tier_d_label'         => $t['tier_d_label'],
        'tier_e_label'         => $t['tier_e_label'],
    ];

    $noscript_opts = '';
    if ( ! $data_error ) {
        $sorted = $js_data;
        usort( $sorted, fn($a,$b) => ($b['stats']['speed'] ?? 0) <=> ($a['stats']['speed'] ?? 0) );
        foreach ( $sorted as $p ) {
            $noscript_opts .= '<option value="' . intval($p['id']) . '">'
                . esc_html(ucfirst($p['name'])) . ' (' . intval($p['stats']['speed'] ?? 0) . ')</option>';
        }
    }

    ob_start();
    ?>
    <script>(function(){var t=localStorage.getItem('pkm-theme');if(t)document.documentElement.setAttribute('data-theme',t);else if(window.matchMedia('(prefers-color-scheme:dark)').matches)document.documentElement.setAttribute('data-theme','dark');})();</script>

    <style>
    /* ════════════════════════════════════════════════════
       POKEMON SPEED TIERS v3 — UX LOGIC REBUILD
       Correct flow: Search first → Modifiers → Live table
    ════════════════════════════════════════════════════ */
    :root {
        --pkm-primary: #0D9488 !important; --pkm-primary-hover: #0F766E !important;
        --pkm-primary-light: rgba(13, 148, 136, 0.11) !important;
        --pkm-secondary: #134E4A !important;
        --pkm-accent:#F4D03F !important; --pkm-accent-2:#2ECC71 !important;
        --pkm-gradient:linear-gradient(135deg, #0D9488 0%, #134E4A 100%) !important;
        --pkm-radius:12px !important; --pkm-radius-sm:8px !important;
        --pkm-radius-lg:20px !important; --pkm-radius-xl:28px !important;
        --pkm-ease:all 0.22s cubic-bezier(0.4,0,0.2,1) !important;
        --pkm-font-display: 'Exo 2', sans-serif !important;
        --pkm-font-heading:'Exo 2',sans-serif !important;
        --pkm-font-body:system-ui,-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif !important;
        --pkm-bg:#F0F2F7 !important; --pkm-bg-2:#FFFFFF !important;
        --pkm-bg-3:#E8EBF2 !important; --pkm-bg-card:rgba(255,255,255,0.97) !important;
        --pkm-text:#1A1F2E !important; --pkm-text-muted:#4A5568 !important;
        --pkm-text-subtle:#A0AEC0 !important;
        --pkm-border:rgba(0,0,0,0.07) !important; --pkm-border-strong:rgba(0,0,0,0.14) !important;
        --pkm-shadow:0 8px 32px rgba(0,0,0,0.09) !important;
        --pkm-shadow-sm:0 2px 8px rgba(0,0,0,0.05) !important;
        --pkm-shadow-lg:0 20px 56px rgba(0,0,0,0.13) !important;
        --pkm-glow:rgba(13,148,136,0.18) !important;
        --pkm-input-bg:#E8EBF2 !important; --pkm-shell:#FFFFFF !important;
        --t-s-bg:#FFFBEB !important; --t-s-txt:#92680A !important; --t-s-bdr:#F4D03F !important;
        --t-a-bg:#EAFAF1 !important; --t-a-txt:#1A7A44 !important; --t-a-bdr:#2ECC71 !important;
        --t-b-bg:#EBF5FB !important; --t-b-txt:#1A5276 !important; --t-b-bdr:#3498DB !important;
        --t-c-bg:#F5EEF8 !important; --t-c-txt:#6C3483 !important; --t-c-bdr:#9B59B6 !important;
        --t-d-bg:#FEF5EC !important; --t-d-txt:#784212 !important; --t-d-bdr:#E67E22 !important;
        --t-e-bg:#F2F3F4 !important; --t-e-txt:#566573 !important; --t-e-bdr:#95A5A6 !important;
    }
    [data-theme="dark"] {
        --pkm-bg:#0A0E17 !important; --pkm-bg-2:#141921 !important;
        --pkm-bg-3:#1C2231 !important; --pkm-bg-card:rgba(20,25,33,0.95) !important;
        --pkm-text:#E8EDF6 !important; --pkm-text-muted:#8B95A8 !important;
        --pkm-text-subtle:#3D4558 !important;
        --pkm-border:rgba(255,255,255,0.07) !important; --pkm-border-strong:rgba(255,255,255,0.14) !important;
        --pkm-shadow:0 8px 32px rgba(0,0,0,0.5) !important;
        --pkm-shadow-sm:0 2px 8px rgba(0,0,0,0.35) !important;
        --pkm-shadow-lg:0 20px 56px rgba(0,0,0,0.6) !important;
        --pkm-glow:rgba(13,148,136,0.32) !important;
        --pkm-input-bg:#1C2231 !important; --pkm-shell:#141921 !important;
        --t-s-bg:rgba(244,208,63,0.09) !important;  --t-s-txt:#F4D03F !important;
        --t-a-bg:rgba(46,204,113,0.09) !important;  --t-a-txt:#2ECC71 !important;
        --t-b-bg:rgba(52,152,219,0.09) !important;  --t-b-txt:#3498DB !important;
        --t-c-bg:rgba(155,89,182,0.09) !important;  --t-c-txt:#9B59B6 !important;
        --t-d-bg:rgba(230,126,34,0.09) !important;  --t-d-txt:#E67E22 !important;
        --t-e-bg:rgba(149,165,166,0.09) !important; --t-e-txt:#95A5A6 !important;
    }
    .pkm-icon    { display:inline-block !important; vertical-align:middle !important; flex-shrink:0 !important; }
    .pkm-icon-sm { width:16px !important; height:16px !important; }
    .pkm-icon-md { width:20px !important; height:20px !important; }
    .pkm-icon-lg { width:24px !important; height:24px !important; }

    /* ── Outer / skyscrapers ── */
    .pkm-outer { position:relative !important; width:100% !important; background:var(--pkm-bg) !important; }
    .pkm-ad-sky { display:none !important; position:fixed !important; top:120px !important; width:160px !important; z-index:100 !important; }
    .pkm-ad-sky-l { left:0 !important; } .pkm-ad-sky-r { right:0 !important; }
    @media (min-width:1280px) { .pkm-ad-sky { display:block !important; } }

    /* ── Content column ── */
    .pkm-col {
        max-width:1080px !important; margin:0 auto !important;
        padding:0 16px 56px !important; width:100% !important;
        box-sizing:border-box !important; background:transparent !important;
        color:var(--pkm-text) !important; font-family:var(--pkm-font-body) !important;
    }

    /* ── App shell — header + ALL controls in ONE unified card ── */
    .pkm-shell {
        background:var(--pkm-shell) !important;
        border-radius:0 0 var(--pkm-radius-xl) var(--pkm-radius-xl) !important;
        border:1px solid var(--pkm-border) !important; border-top:none !important;
        box-shadow:var(--pkm-shadow-lg) !important;
        overflow:visible !important; /* allow dropdown to overflow */
        margin-bottom:24px !important;
    }

    /* ── Header ── */
    .pkm-hdr {
        background:var(--pkm-gradient) !important;
        border-radius:0 !important; padding:40px 28px 32px !important;
        text-align:center !important; overflow:hidden !important;
        position:relative !important;
    }
    .pkm-hdr-glow {
        position:absolute !important; top:-40% !important; left:50% !important;
        transform:translateX(-50%) !important; width:700px !important; height:320px !important;
        background:radial-gradient(ellipse at center,rgba(255,255,255,0.12) 0%,transparent 68%) !important;
        pointer-events:none !important;
    }
    .pkm-hdr-sprites {
        display:flex !important; justify-content:center !important; align-items:flex-end !important;
        gap:6px !important; margin-bottom:16px !important; position:relative !important; z-index:1 !important;
    }
    .pkm-spr { object-fit:contain !important; filter:drop-shadow(0 4px 14px rgba(0,0,0,0.35)) !important; animation:pkm-float 3s ease-in-out infinite !important; }
    .pkm-spr-l { width:68px !important; height:68px !important; }
    .pkm-spr-m { width:92px !important; height:92px !important; animation-delay:0.7s !important; }
    .pkm-spr-r { width:60px !important; height:60px !important; animation-delay:1.5s !important; }
    @keyframes pkm-float { 0%,100%{transform:translateY(0) !important;} 50%{transform:translateY(-7px) !important;} }
    @media (max-width:480px) {
        .pkm-spr{animation:none !important;}
        .pkm-spr-l{width:50px !important;height:50px !important;}
        .pkm-spr-m{width:66px !important;height:66px !important;}
        .pkm-spr-r{width:46px !important;height:46px !important;}
        .pkm-hdr{padding:24px 16px 20px !important;}
    }
    .pkm-hdr-title {
        font-family:var(--pkm-font-display) !important; font-size:clamp(12px,2.8vw,19px) !important;
        color:#fff !important; margin:0 0 10px !important; line-height:1.6 !important;
        text-shadow:0 2px 10px rgba(0,0,0,0.35) !important; position:relative !important; z-index:1 !important;
    }
    .pkm-hdr-desc {
        font-family:var(--pkm-font-heading) !important; font-size:clamp(13px,1.8vw,15px) !important;
        color:rgba(255,255,255,0.83) !important; margin:0 auto !important; max-width:500px !important;
        line-height:1.6 !important; position:relative !important; z-index:1 !important;
    }

    /* ── Shell divider ── */
    .pkm-divider {
        height:1px !important;
        background:linear-gradient(90deg,transparent,var(--pkm-border-strong),transparent) !important;
        margin:0 !important;
    }

    /* ── Search section — FIRST inside shell body ── */
    .pkm-shell-body { padding:24px 28px !important; }
    @media (max-width:480px) { .pkm-shell-body { padding:16px !important; } }

    .pkm-section-label {
        font-family:var(--pkm-font-heading) !important; font-weight:900 !important;
        font-size:11px !important; text-transform:uppercase !important; letter-spacing:0.09em !important;
        color:var(--pkm-text-muted) !important; margin-bottom:8px !important;
        display:flex !important; align-items:center !important; gap:6px !important;
    }
    .pkm-section-hint {
        font-size:12px !important; color:var(--pkm-text-subtle) !important;
        font-family:var(--pkm-font-body) !important; margin-bottom:10px !important;
        line-height:1.4 !important;
    }

    /* Search input row */
    .pkm-search-wrap { position:relative !important; margin-bottom:6px !important; }
    .pkm-search-icon {
        position:absolute !important; left:14px !important; top:50% !important;
        transform:translateY(-50%) !important; color:var(--pkm-text-subtle) !important;
        pointer-events:none !important; display:flex !important;
    }
    .pkm-search-input {
        width:100% !important; box-sizing:border-box !important;
        background:var(--pkm-input-bg) !important; border:2px solid var(--pkm-border) !important;
        border-radius:var(--pkm-radius-sm) !important; color:var(--pkm-text) !important;
        font-family:var(--pkm-font-body) !important; font-size:15px !important;
        padding:13px 46px 13px 44px !important; min-height:52px !important;
        outline:none !important; transition:var(--pkm-ease) !important;
    }
    .pkm-search-input:focus {
        border-color:var(--pkm-primary) !important;
        background:var(--pkm-bg-2) !important;
        box-shadow:0 0 0 3px var(--pkm-primary-light) !important;
    }
    .pkm-search-input::placeholder { color:var(--pkm-text-subtle) !important; }
    .pkm-search-clear {
        position:absolute !important; right:10px !important; top:50% !important;
        transform:translateY(-50%) !important; background:none !important; border:none !important;
        color:var(--pkm-text-subtle) !important; cursor:pointer !important;
        display:none !important; align-items:center !important; justify-content:center !important;
        width:30px !important; height:30px !important; border-radius:50% !important;
        transition:var(--pkm-ease) !important; padding:0 !important;
    }
    .pkm-search-clear:hover { background:var(--pkm-primary-light) !important; color:var(--pkm-primary) !important; }
    .pkm-search-clear.vis { display:flex !important; }
    .pkm-search-dd {
        position:absolute !important; top:calc(100% + 4px) !important; left:0 !important; right:0 !important;
        background:var(--pkm-bg-2) !important; border:1px solid var(--pkm-border) !important;
        border-radius:var(--pkm-radius-sm) !important; box-shadow:var(--pkm-shadow) !important;
        max-height:260px !important; overflow-y:auto !important; z-index:300 !important; display:none !important;
    }
    .pkm-search-dd.open { display:block !important; }
    .pkm-dd-item {
        display:flex !important; align-items:center !important; gap:10px !important;
        padding:9px 14px !important; cursor:pointer !important; border-bottom:1px solid var(--pkm-border) !important;
        transition:background 0.12s !important;
    }
    .pkm-dd-item:last-child { border-bottom:none !important; }
    .pkm-dd-item:hover,.pkm-dd-item.on { background:var(--pkm-primary-light) !important; }
    .pkm-dd-item img { width:32px !important; height:32px !important; object-fit:contain !important; flex-shrink:0 !important; }
    .pkm-dd-name { font-family:var(--pkm-font-heading) !important; font-weight:700 !important; font-size:14px !important; color:var(--pkm-text) !important; flex:1 !important; text-transform:capitalize !important; }
    .pkm-dd-types { display:flex !important; gap:3px !important; flex-shrink:0 !important; }
    .pkm-dd-spd { font-family:var(--pkm-font-heading) !important; font-weight:800 !important; font-size:13px !important; color:var(--pkm-primary) !important; min-width:28px !important; text-align:right !important; flex-shrink:0 !important; }
    .pkm-dd-none { padding:14px !important; text-align:center !important; color:var(--pkm-text-muted) !important; font-size:14px !important; }

    /* ── Result card — appears INSIDE shell below search, on selection ── */
    .pkm-result-card {
        background:linear-gradient(135deg,rgba(13,148,136,0.06) 0%,rgba(29,53,87,0.06) 100%) !important;
        border:2px solid var(--pkm-primary) !important;
        border-radius:var(--pkm-radius-lg) !important;
        padding:16px 20px !important;
        margin-top:14px !important;
        display:none !important;
        animation:pkm-fadein 0.28s ease !important;
        box-shadow:0 0 0 4px var(--pkm-glow) !important;
    }
    .pkm-result-card.vis { display:block !important; }
    @keyframes pkm-fadein { from{opacity:0;transform:translateY(4px)} to{opacity:1;transform:translateY(0)} }

    .pkm-result-top {
        display:flex !important; align-items:center !important; gap:14px !important;
        flex-wrap:wrap !important;
    }
    .pkm-result-sprite {
        width:64px !important; height:64px !important; object-fit:contain !important;
        filter:drop-shadow(0 2px 8px rgba(0,0,0,0.18)) !important; flex-shrink:0 !important;
    }
    .pkm-result-info { flex:1 !important; min-width:0 !important; }
    .pkm-result-name {
        font-family:var(--pkm-font-heading) !important; font-weight:900 !important;
        font-size:20px !important; color:var(--pkm-text) !important;
        text-transform:capitalize !important; margin:0 0 4px !important; line-height:1.2 !important;
    }
    .pkm-result-types { display:flex !important; gap:4px !important; flex-wrap:wrap !important; margin-bottom:6px !important; }
    .pkm-result-meta {
        font-family:var(--pkm-font-heading) !important; font-size:13px !important;
        color:var(--pkm-text-muted) !important;
    }
    /* Right: big speed number + tier badge stacked */
    .pkm-result-right { display:flex !important; flex-direction:column !important; align-items:flex-end !important; gap:6px !important; flex-shrink:0 !important; }
    .pkm-result-speed-num {
        font-family:var(--pkm-font-heading) !important; font-weight:900 !important;
        font-size:48px !important; color:var(--pkm-primary) !important; line-height:1 !important;
    }
    .pkm-result-speed-lbl { font-size:11px !important; font-weight:700 !important; color:var(--pkm-text-subtle) !important; text-transform:uppercase !important; letter-spacing:0.07em !important; text-align:right !important; }
    @media (max-width:480px) { .pkm-result-speed-num { font-size:36px !important; } }

    /* ── Modifiers section — inside shell, below result card ── */
    .pkm-mods-sep { height:1px !important; background:var(--pkm-border) !important; margin:20px 0 !important; }
    .pkm-mods-grid {
        display:grid !important; grid-template-columns:1fr !important; gap:14px 18px !important;
    }
    @media (min-width:540px) { .pkm-mods-grid { grid-template-columns:repeat(2,1fr) !important; } }
    @media (min-width:780px) { .pkm-mods-grid { grid-template-columns:repeat(3,1fr) !important; } }

    .pkm-ctrl { display:flex !important; flex-direction:column !important; gap:5px !important; }
    .pkm-ctrl-label {
        font-family:var(--pkm-font-heading) !important; font-weight:800 !important; font-size:11px !important;
        text-transform:uppercase !important; letter-spacing:0.08em !important;
        color:var(--pkm-text-muted) !important; display:flex !important; align-items:center !important; gap:5px !important;
    }
    .pkm-select {
        background-color:var(--pkm-input-bg) !important;
        background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%238B95A8' stroke-width='1.8' fill='none' stroke-linecap='round'/%3E%3C/svg%3E") !important;
        background-repeat:no-repeat !important; background-position:right 12px center !important; background-size:12px 8px !important;
        border:1.5px solid var(--pkm-border) !important; border-radius:var(--pkm-radius-sm) !important;
        color:var(--pkm-text) !important; font-family:var(--pkm-font-body) !important; font-size:14px !important;
        padding:9px 34px 9px 12px !important; width:100% !important; min-height:44px !important;
        box-sizing:border-box !important; outline:none !important; -webkit-appearance:none !important; appearance:none !important;
        cursor:pointer !important; transition:var(--pkm-ease) !important;
    }
    .pkm-select:focus { border-color:var(--pkm-primary) !important; box-shadow:0 0 0 3px var(--pkm-primary-light) !important; }
    .pkm-input {
        background:var(--pkm-input-bg) !important; border:1.5px solid var(--pkm-border) !important;
        border-radius:var(--pkm-radius-sm) !important; color:var(--pkm-text) !important;
        font-family:var(--pkm-font-body) !important; font-size:14px !important;
        padding:9px 12px !important; width:100% !important; min-height:44px !important;
        box-sizing:border-box !important; outline:none !important; transition:var(--pkm-ease) !important;
    }
    .pkm-input:focus { border-color:var(--pkm-primary) !important; box-shadow:0 0 0 3px var(--pkm-primary-light) !important; }
    .pkm-input-hint { font-size:11px !important; color:var(--pkm-text-subtle) !important; font-family:var(--pkm-font-body) !important; }

    /* EV slider with live bonus display */
    .pkm-ev-row { display:flex !important; align-items:center !important; gap:8px !important; }
    .pkm-ev-val { font-family:var(--pkm-font-heading) !important; font-weight:800 !important; font-size:14px !important; color:var(--pkm-primary) !important; min-width:28px !important; text-align:right !important; }
    input[type="range"].pkm-range {
        -webkit-appearance:none !important; appearance:none !important; flex:1 !important;
        height:5px !important; border-radius:3px !important; background:var(--pkm-border) !important;
        outline:none !important; cursor:pointer !important; min-height:auto !important;
        padding:0 !important; border:none !important;
    }
    input[type="range"].pkm-range::-webkit-slider-thumb {
        -webkit-appearance:none !important; width:18px !important; height:18px !important;
        border-radius:50% !important; background:var(--pkm-primary) !important;
        box-shadow:0 2px 6px rgba(13, 148, 136, 0.4) !important;
    }
    input[type="range"].pkm-range::-moz-range-thumb {
        width:18px !important; height:18px !important; border-radius:50% !important;
        background:var(--pkm-primary) !important; border:none !important;
    }
    .pkm-ev-bonus { font-size:11px !important; color:var(--pkm-accent-2) !important; font-family:var(--pkm-font-heading) !important; font-weight:700 !important; height:14px !important; }

    /* Scarf toggle */
    .pkm-scarf-wrap {
        display:flex !important; align-items:center !important; gap:10px !important;
        background:var(--pkm-input-bg) !important; border:1.5px solid var(--pkm-border) !important;
        border-radius:var(--pkm-radius-sm) !important; padding:9px 12px !important;
        min-height:44px !important; cursor:pointer !important; transition:var(--pkm-ease) !important;
        user-select:none !important;
    }
    .pkm-scarf-wrap:hover { border-color:var(--pkm-primary) !important; }
    .pkm-toggle {
        position:relative !important; width:40px !important; height:22px !important;
        background:var(--pkm-border-strong) !important; border-radius:11px !important;
        transition:var(--pkm-ease) !important; flex-shrink:0 !important;
    }
    .pkm-toggle::after {
        content:'' !important; position:absolute !important; width:16px !important; height:16px !important;
        border-radius:50% !important; background:#fff !important; top:3px !important; left:3px !important;
        transition:var(--pkm-ease) !important; box-shadow:0 1px 4px rgba(0,0,0,0.22) !important;
    }
    .pkm-scarf-wrap.on .pkm-toggle { background:var(--pkm-primary) !important; }
    .pkm-scarf-wrap.on .pkm-toggle::after { transform:translateX(18px) !important; }
    .pkm-scarf-txt { font-size:13px !important; color:var(--pkm-text) !important; font-family:var(--pkm-font-body) !important; line-height:1.3 !important; }
    .pkm-scarf-sub { display:block !important; font-size:11px !important; color:var(--pkm-text-subtle) !important; }

    /* Reset button row — bottom of shell */
    .pkm-shell-foot {
        padding:0 28px 20px !important; display:flex !important; justify-content:flex-end !important;
    }
    @media (max-width:480px) { .pkm-shell-foot { padding:0 16px 16px !important; } }
    .pkm-reset-btn {
        display:inline-flex !important; align-items:center !important; gap:7px !important;
        font-family:var(--pkm-font-heading) !important; font-weight:700 !important; font-size:13px !important;
        background:var(--pkm-bg-3) !important; border:1.5px solid var(--pkm-border) !important;
        border-radius:var(--pkm-radius-sm) !important; color:var(--pkm-text-muted) !important;
        cursor:pointer !important; transition:var(--pkm-ease) !important;
        min-height:40px !important; padding:8px 18px !important; outline:none !important;
    }
    .pkm-reset-btn:hover { border-color:var(--pkm-border-strong) !important; color:var(--pkm-text) !important; background:var(--pkm-border) !important; }

    /* ── Benchmark card — below shell ── */
    .pkm-bench-card {
        background:var(--pkm-bg-card) !important; border:1px solid var(--pkm-border) !important;
        border-radius:var(--pkm-radius-lg) !important; padding:18px 22px !important;
        box-shadow:var(--pkm-shadow-sm) !important; margin-bottom:20px !important;
        display:none !important; animation:pkm-fadein 0.28s ease !important;
    }
    .pkm-bench-card.vis { display:block !important; }
    .pkm-bench-title { font-family:var(--pkm-font-heading) !important; font-weight:800 !important; font-size:15px !important; color:var(--pkm-text) !important; margin:0 0 12px !important; display:flex !important; align-items:center !important; gap:8px !important; }
    .pkm-bench-grids { display:grid !important; grid-template-columns:1fr !important; gap:10px !important; }
    @media (min-width:500px) { .pkm-bench-grids { grid-template-columns:repeat(3,1fr) !important; } }
    .pkm-bench-grp { background:var(--pkm-bg-3) !important; border-radius:var(--pkm-radius-sm) !important; padding:10px 12px !important; }
    .pkm-bench-grp-lbl { font-size:11px !important; font-weight:800 !important; text-transform:uppercase !important; letter-spacing:0.07em !important; margin-bottom:7px !important; font-family:var(--pkm-font-heading) !important; display:flex !important; align-items:center !important; gap:5px !important; }
    .pkm-bg-out .pkm-bench-grp-lbl { color:var(--pkm-accent-2) !important; }
    .pkm-bg-tie .pkm-bench-grp-lbl { color:var(--pkm-accent) !important; }
    .pkm-bg-slw .pkm-bench-grp-lbl { color:var(--pkm-primary) !important; }
    .pkm-bench-item { display:flex !important; align-items:center !important; gap:5px !important; padding:3px 0 !important; font-size:12px !important; color:var(--pkm-text-muted) !important; text-transform:capitalize !important; }
    .pkm-bench-item img { width:22px !important; height:22px !important; object-fit:contain !important; }
    .pkm-bench-spd { margin-left:auto !important; font-size:11px !important; color:var(--pkm-text-subtle) !important; font-family:var(--pkm-font-heading) !important; font-weight:600 !important; }
    .pkm-bench-none { color:var(--pkm-text-subtle) !important; font-size:12px !important; font-style:italic !important; }

    /* ── Table section header ── */
    .pkm-table-header { margin-bottom:10px !important; }
    .pkm-table-header-top { display:flex !important; align-items:center !important; justify-content:space-between !important; flex-wrap:wrap !important; gap:8px !important; margin-bottom:8px !important; }
    .pkm-table-title { font-family:var(--pkm-font-heading) !important; font-weight:900 !important; font-size:16px !important; color:var(--pkm-text) !important; margin:0 !important; }
    .pkm-table-hint { font-size:12px !important; color:var(--pkm-text-subtle) !important; font-family:var(--pkm-font-body) !important; }
    .pkm-count { font-size:12px !important; color:var(--pkm-text-subtle) !important; font-family:var(--pkm-font-body) !important; }
    .pkm-count strong { color:var(--pkm-text-muted) !important; }

    /* Tier filter pills */
    .pkm-filter-bar { display:flex !important; align-items:center !important; gap:5px !important; flex-wrap:wrap !important; }
    .pkm-filter-lbl { font-family:var(--pkm-font-heading) !important; font-weight:700 !important; font-size:11px !important; color:var(--pkm-text-muted) !important; text-transform:uppercase !important; letter-spacing:0.07em !important; flex-shrink:0 !important; margin-right:2px !important; }
    .pkm-tbtn {
        font-family:var(--pkm-font-heading) !important; font-weight:800 !important; font-size:12px !important;
        padding:4px 11px !important; border-radius:20px !important; border:1.5px solid var(--pkm-border) !important;
        cursor:pointer !important; transition:var(--pkm-ease) !important; min-height:30px !important;
        background:var(--pkm-bg-3) !important; color:var(--pkm-text-muted) !important; white-space:nowrap !important;
    }
    .pkm-tbtn:hover { border-color:var(--pkm-border-strong) !important; color:var(--pkm-text) !important; }
    .pkm-tbtn[data-tier="all"].act { background:var(--pkm-secondary) !important; border-color:var(--pkm-secondary) !important; color:#fff !important; }
    .pkm-tbtn[data-tier="S"].act  { background:var(--t-s-bdr) !important; border-color:var(--t-s-bdr) !important; color:#1A1F2E !important; }
    .pkm-tbtn[data-tier="A"].act  { background:var(--t-a-bdr) !important; border-color:var(--t-a-bdr) !important; color:#fff !important; }
    .pkm-tbtn[data-tier="B"].act  { background:var(--t-b-bdr) !important; border-color:var(--t-b-bdr) !important; color:#fff !important; }
    .pkm-tbtn[data-tier="C"].act  { background:var(--t-c-bdr) !important; border-color:var(--t-c-bdr) !important; color:#fff !important; }
    .pkm-tbtn[data-tier="D"].act  { background:var(--t-d-bdr) !important; border-color:var(--t-d-bdr) !important; color:#fff !important; }
    .pkm-tbtn[data-tier="E"].act  { background:var(--t-e-bdr) !important; border-color:var(--t-e-bdr) !important; color:#fff !important; }

    /* ── Table ── */
    .pkm-tbl-wrap {
        overflow-x:auto !important; -webkit-overflow-scrolling:touch !important;
        border-radius:var(--pkm-radius-lg) !important; box-shadow:var(--pkm-shadow) !important;
        background:var(--pkm-bg-card) !important; border:1px solid var(--pkm-border) !important;
        margin-top:10px !important;
    }
    .pkm-tbl { width:100% !important; border-collapse:collapse !important; min-width:480px !important; font-family:var(--pkm-font-body) !important; font-size:14px !important; }
    .pkm-tbl thead tr { background:var(--pkm-bg-3) !important; border-bottom:2px solid var(--pkm-border) !important; position:sticky !important; top:0 !important; z-index:10 !important; }
    .pkm-tbl th { padding:10px 13px !important; text-align:left !important; font-family:var(--pkm-font-heading) !important; font-weight:800 !important; font-size:11px !important; text-transform:uppercase !important; letter-spacing:0.07em !important; color:var(--pkm-text-muted) !important; white-space:nowrap !important; border:none !important; }
    .pkm-tbl td { padding:8px 13px !important; border-bottom:1px solid var(--pkm-border) !important; vertical-align:middle !important; color:var(--pkm-text) !important; border-left:none !important; border-right:none !important; border-top:none !important; }
    .pkm-tbl tr:last-child td { border-bottom:none !important; }
    .pkm-tbl tbody tr { transition:background 0.12s !important; }
    .pkm-tbl tbody tr:hover { background:var(--pkm-primary-light) !important; }
    .pkm-tbl tbody tr.hl { background:rgba(244,208,63,0.15) !important; outline:2px solid var(--pkm-accent) !important; outline-offset:-2px !important; }
    /* Tier separators */
    .pkm-tsep td { padding:7px 13px !important; font-family:var(--pkm-font-heading) !important; font-weight:900 !important; font-size:11px !important; text-transform:uppercase !important; letter-spacing:0.08em !important; border:none !important; border-top:2px solid var(--pkm-border) !important; }
    .pkm-tsep:first-child td { border-top:none !important; }
    .pkm-ts-S td { background:var(--t-s-bg) !important; color:var(--t-s-txt) !important; }
    .pkm-ts-A td { background:var(--t-a-bg) !important; color:var(--t-a-txt) !important; }
    .pkm-ts-B td { background:var(--t-b-bg) !important; color:var(--t-b-txt) !important; }
    .pkm-ts-C td { background:var(--t-c-bg) !important; color:var(--t-c-txt) !important; }
    .pkm-ts-D td { background:var(--t-d-bg) !important; color:var(--t-d-txt) !important; }
    .pkm-ts-E td { background:var(--t-e-bg) !important; color:var(--t-e-txt) !important; }
    /* Table cells */
    .pkm-td-rank { font-family:var(--pkm-font-heading) !important; font-size:12px !important; font-weight:700 !important; color:var(--pkm-text-subtle) !important; width:34px !important; }
    .pkm-td-pkmn { display:flex !important; align-items:center !important; gap:8px !important; }
    .pkm-td-pkmn img { width:36px !important; height:36px !important; object-fit:contain !important; flex-shrink:0 !important; }
    .pkm-td-pkmn-name { font-family:var(--pkm-font-heading) !important; font-weight:600 !important; font-size:14px !important; text-transform:capitalize !important; color:var(--pkm-text) !important; white-space:nowrap !important; }
    .pkm-types { display:flex !important; gap:3px !important; flex-wrap:wrap !important; }
    .pkm-type { font-family:var(--pkm-font-heading) !important; font-weight:700 !important; font-size:10px !important; padding:2px 7px !important; border-radius:20px !important; text-transform:capitalize !important; color:#fff !important; white-space:nowrap !important; }
    .pkm-type-normal{background:#9FA19F !important;} .pkm-type-fire{background:#E62829 !important;} .pkm-type-water{background:#2980EF !important;}
    .pkm-type-electric{background:#FAC000 !important;color:#1A1F2E !important;} .pkm-type-grass{background:#3FA129 !important;} .pkm-type-ice{background:#3DCEF3 !important;color:#1A1F2E !important;}
    .pkm-type-fighting{background:#FF8000 !important;} .pkm-type-poison{background:#8F41CB !important;} .pkm-type-ground{background:#915121 !important;}
    .pkm-type-flying{background:#81B9EF !important;} .pkm-type-psychic{background:#EF4179 !important;} .pkm-type-bug{background:#91A119 !important;color:#1A1F2E !important;}
    .pkm-type-rock{background:#AFA981 !important;} .pkm-type-ghost{background:#704170 !important;} .pkm-type-dragon{background:#5060E1 !important;}
    .pkm-type-dark{background:#624D4E !important;} .pkm-type-steel{background:#60A1B8 !important;} .pkm-type-fairy{background:#EF70EF !important;}
    .pkm-type-stellar{background:linear-gradient(135deg,#2980EF,#EF4179,#FAC000) !important;} .pkm-type-unknown{background:#68A090 !important;}
    .pkm-td-base { font-family:var(--pkm-font-heading) !important; font-weight:600 !important; font-size:13px !important; color:var(--pkm-text-muted) !important; }
    .pkm-td-final { font-family:var(--pkm-font-heading) !important; font-weight:900 !important; font-size:15px !important; color:var(--pkm-text) !important; }
    .pkm-tier-badge { font-family:var(--pkm-font-heading) !important; font-weight:900 !important; font-size:13px !important; padding:3px 9px !important; border-radius:6px !important; display:inline-block !important; border:1.5px solid transparent !important; min-width:28px !important; text-align:center !important; }
    .pkm-tier-S { background:var(--t-s-bg) !important; color:var(--t-s-txt) !important; border-color:var(--t-s-bdr) !important; }
    .pkm-tier-A { background:var(--t-a-bg) !important; color:var(--t-a-txt) !important; border-color:var(--t-a-bdr) !important; }
    .pkm-tier-B { background:var(--t-b-bg) !important; color:var(--t-b-txt) !important; border-color:var(--t-b-bdr) !important; }
    .pkm-tier-C { background:var(--t-c-bg) !important; color:var(--t-c-txt) !important; border-color:var(--t-c-bdr) !important; }
    .pkm-tier-D { background:var(--t-d-bg) !important; color:var(--t-d-txt) !important; border-color:var(--t-d-bdr) !important; }
    .pkm-tier-E { background:var(--t-e-bg) !important; color:var(--t-e-txt) !important; border-color:var(--t-e-bdr) !important; }
    .pkm-tbl-empty { text-align:center !important; padding:40px 20px !important; color:var(--pkm-text-muted) !important; font-size:14px !important; }

    /* ── Misc ── */
    .pkm-ad { text-align:center !important; margin:20px 0 !important; }
    .pkm-error { background:rgba(13,148,136,0.09) !important; border:1px solid var(--pkm-primary) !important; border-radius:var(--pkm-radius) !important; padding:16px 20px !important; display:flex !important; align-items:center !important; gap:12px !important; color:var(--pkm-primary) !important; font-size:14px !important; margin-bottom:20px !important; }
    .pkm-noscript { background:var(--pkm-bg-card) !important; border:1px solid var(--pkm-border) !important; border-radius:var(--pkm-radius) !important; padding:22px !important; text-align:center !important; color:var(--pkm-text-muted) !important; font-size:15px !important; margin:20px 0 !important; }
    .pkm-val-errs { background:rgba(13,148,136,0.08) !important; border:1px solid var(--pkm-primary) !important; border-radius:var(--pkm-radius-sm) !important; padding:10px 14px 10px 28px !important; color:var(--pkm-primary) !important; font-size:13px !important; margin:8px 0 0 !important; list-style:disc !important; }
    /* SEO sections */
    .pkm-section { background:var(--pkm-bg-card) !important; border:1px solid var(--pkm-border) !important; border-radius:var(--pkm-radius-lg) !important; padding:24px !important; box-shadow:var(--pkm-shadow-sm) !important; margin-bottom:20px !important; }
    .pkm-section-h2 { font-family:var(--pkm-font-heading) !important; font-weight:800 !important; font-size:18px !important; color:var(--pkm-text) !important; margin:0 0 12px !important; display:flex !important; align-items:center !important; gap:10px !important; }
    .pkm-section p { font-size:15px !important; line-height:1.7 !important; color:var(--pkm-text-muted) !important; margin:0 0 10px !important; }
    .pkm-section p:last-child { margin-bottom:0 !important; }
    .pkm-steps { list-style:none !important; padding:0 !important; margin:0 !important; display:flex !important; flex-direction:column !important; gap:10px !important; }
    .pkm-step { display:flex !important; gap:12px !important; align-items:flex-start !important; background:var(--pkm-bg-3) !important; border-radius:var(--pkm-radius-sm) !important; padding:12px !important; }
    .pkm-step-n { background:var(--pkm-primary) !important; color:#fff !important; width:26px !important; height:26px !important; border-radius:50% !important; display:flex !important; align-items:center !important; justify-content:center !important; font-family:var(--pkm-font-heading) !important; font-weight:800 !important; font-size:13px !important; flex-shrink:0 !important; }
    .pkm-step-t { font-size:14px !important; color:var(--pkm-text-muted) !important; line-height:1.5 !important; }
    .pkm-faqs { display:flex !important; flex-direction:column !important; gap:7px !important; }
    .pkm-faq-i { background:var(--pkm-bg-3) !important; border:1px solid var(--pkm-border) !important; border-radius:var(--pkm-radius-sm) !important; overflow:hidden !important; }
    .pkm-faq-q { display:flex !important; justify-content:space-between !important; align-items:center !important; padding:12px 14px !important; cursor:pointer !important; font-family:var(--pkm-font-heading) !important; font-weight:600 !important; font-size:14px !important; color:var(--pkm-text) !important; gap:10px !important; min-height:48px !important; user-select:none !important; list-style:none !important; }
    .pkm-faq-q::-webkit-details-marker { display:none !important; }
    .pkm-faq-chev { flex-shrink:0 !important; color:var(--pkm-text-subtle) !important; transition:transform 0.2s ease !important; }
    details[open] .pkm-faq-chev { transform:rotate(180deg) !important; }
    .pkm-faq-a { padding:0 14px 12px !important; font-size:14px !important; line-height:1.7 !important; color:var(--pkm-text-muted) !important; }
    .pkm-tbl-outer { overflow-x:auto !important; -webkit-overflow-scrolling:touch !important; width:100% !important; }
    </style>

    <script>
    var pkmData=<?php echo wp_json_encode(array_values($js_data)); ?>;
    var pkmT=<?php echo wp_json_encode($jst); ?>;
    </script>

    <?php /* ═══════════════ HTML ═══════════════ */ ?>
    <div class="pkm-outer">
        <?php if(''!==trim($ad_slot_e)): ?><div class="pkm-ad-sky pkm-ad-sky-l"><?php echo do_shortcode($ad_slot_e); ?></div><?php endif; ?>
        <?php if(''!==trim($ad_slot_f_sky)): ?><div class="pkm-ad-sky pkm-ad-sky-r"><?php echo do_shortcode($ad_slot_f_sky); ?></div><?php endif; ?>

        <div class="pkm-col">

            <?php /* ═══ UNIFIED SHELL ═══ */ ?>
            <div class="pkm-shell">

                <?php /* Header */ ?>
                <div class="pkm-hdr">
                    <div class="pkm-hdr-glow" aria-hidden="true"></div>
                    <div class="pkm-hdr-sprites" aria-hidden="true">
                        <?php if($sprite_a): ?><img src="<?php echo $sprite_a;?>" class="pkm-spr pkm-spr-l" alt="" width="68" height="68" loading="eager" onerror="this.style.display='none'"><?php endif; ?>
                        <?php if($sprite_b): ?><img src="<?php echo $sprite_b;?>" class="pkm-spr pkm-spr-m" alt="" width="92" height="92" loading="eager" onerror="this.style.display='none'"><?php endif; ?>
                        <?php if($sprite_c): ?><img src="<?php echo $sprite_c;?>" class="pkm-spr pkm-spr-r" alt="" width="60" height="60" loading="eager" onerror="this.style.display='none'"><?php endif; ?>
                    </div>
                    <h1 class="pkm-hdr-title"><?php echo esc_html($t['title']); ?></h1>
                    <p  class="pkm-hdr-desc"><?php echo esc_html($t['description']); ?></p>
                </div>

                <div class="pkm-divider" aria-hidden="true"></div>

                <?php /* Shell body: search FIRST, then modifiers */ ?>
                <div class="pkm-shell-body">

                    <?php /* ── STEP 1: Search — primary entry point ── */ ?>
                    <div class="pkm-section-label">
                        <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        <?php echo esc_html($t['search_label']); ?>
                    </div>
                    <p class="pkm-section-hint"><?php echo esc_html($t['search_hint']); ?></p>

                    <div class="pkm-search-wrap">
                        <div class="pkm-search-icon" aria-hidden="true">
                            <svg class="pkm-icon pkm-icon-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        </div>
                        <input type="text" id="pst-search" class="pkm-search-input"
                               placeholder="<?php echo esc_attr($t['search_placeholder']); ?>"
                               autocomplete="off" role="combobox"
                               aria-expanded="false" aria-haspopup="listbox"
                               aria-controls="pst-dd" aria-autocomplete="list">
                        <button class="pkm-search-clear" id="pst-clear" type="button"
                                aria-label="<?php echo esc_attr($t['clear_search']); ?>">
                            <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        </button>
                        <input type="hidden" id="pst-hidden" value="">
                        <div id="pst-dd" class="pkm-search-dd" role="listbox"></div>
                    </div>

                    <ul id="pst-val-errs" class="pkm-val-errs" role="alert" aria-live="polite" style="display:none !important;"></ul>

                    <?php /* ── Result card — appears here immediately when Pokemon selected ── */ ?>
                    <div class="pkm-result-card" id="pst-result">
                        <div class="pkm-result-top">
                            <img id="pst-r-sprite" class="pkm-result-sprite" src="" alt="" width="64" height="64" onerror="this.style.display='none'">
                            <div class="pkm-result-info">
                                <div class="pkm-result-name" id="pst-r-name"></div>
                                <div class="pkm-result-types" id="pst-r-types"></div>
                                <div class="pkm-result-meta" id="pst-r-meta"></div>
                            </div>
                            <div class="pkm-result-right">
                                <div class="pkm-result-speed-num" id="pst-r-spd">—</div>
                                <div class="pkm-result-speed-lbl"><?php echo esc_html($t['result_final_label']); ?></div>
                                <span class="pkm-tier-badge" id="pst-r-tier"></span>
                            </div>
                        </div>
                    </div>

                    <?php /* ── STEP 2: Modifiers — clearly labelled as "optional tweaks" ── */ ?>
                    <div class="pkm-mods-sep" aria-hidden="true"></div>

                    <div class="pkm-section-label">
                        <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="4" y1="21" x2="4" y2="14"/><line x1="4" y1="10" x2="4" y2="3"/><line x1="12" y1="21" x2="12" y2="12"/><line x1="12" y1="8" x2="12" y2="3"/><line x1="20" y1="21" x2="20" y2="16"/><line x1="20" y1="12" x2="20" y2="3"/><line x1="1" y1="14" x2="7" y2="14"/><line x1="9" y1="8" x2="15" y2="8"/><line x1="17" y1="16" x2="23" y2="16"/></svg>
                        <?php echo esc_html($t['modifiers_label']); ?>
                    </div>
                    <p class="pkm-section-hint"><?php echo esc_html($t['modifiers_hint']); ?></p>

                    <div class="pkm-mods-grid">

                        <div class="pkm-ctrl">
                            <label class="pkm-ctrl-label" for="pst-format">
                                <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 010 14.14M4.93 4.93a10 10 0 000 14.14"/></svg>
                                <?php echo esc_html($t['format_label']); ?>
                            </label>
                            <select id="pst-format" class="pkm-select" autocomplete="off">
                                <option value="vgc"><?php echo esc_html($t['format_vgc']); ?></option>
                                <option value="ou"><?php echo esc_html($t['format_ou']); ?></option>
                            </select>
                        </div>

                        <div class="pkm-ctrl">
                            <label class="pkm-ctrl-label" for="pst-nature">
                                <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <?php echo esc_html($t['nature_label']); ?>
                            </label>
                            <select id="pst-nature" class="pkm-select" autocomplete="off">
                                <option value="1.0"><?php echo esc_html($t['nature_neutral']); ?></option>
                                <option value="1.1"><?php echo esc_html($t['nature_plus']); ?></option>
                                <option value="0.9"><?php echo esc_html($t['nature_minus']); ?></option>
                            </select>
                        </div>

                        <div class="pkm-ctrl">
                            <label class="pkm-ctrl-label" for="pst-ivs">
                                <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 9h1v6M15 9h-2v2h2v2h-2v2"/></svg>
                                <?php echo esc_html($t['ivs_label']); ?>
                            </label>
                            <input type="number" id="pst-ivs" class="pkm-input"
                                   value="31" min="0" max="31" step="1"
                                   inputmode="numeric" autocomplete="off"
                                   aria-describedby="pst-ivs-hint">
                            <div class="pkm-input-hint" id="pst-ivs-hint">0 – 31 (max = 31)</div>
                        </div>

                        <div class="pkm-ctrl">
                            <label class="pkm-ctrl-label" for="pst-evs">
                                <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                                <?php echo esc_html($t['evs_label']); ?>
                            </label>
                            <div>
                                <div class="pkm-ev-row">
                                    <input type="range" id="pst-evs" class="pkm-range"
                                           min="0" max="252" step="4" value="0"
                                           aria-label="<?php echo esc_attr($t['evs_label']); ?>">
                                    <span class="pkm-ev-val" id="pst-ev-val">0</span>
                                </div>
                                <div class="pkm-ev-bonus" id="pst-ev-bonus"></div>
                            </div>
                        </div>

                        <div class="pkm-ctrl">
                            <span class="pkm-ctrl-label">
                                <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                                <?php echo esc_html($t['scarf_label']); ?>
                            </span>
                            <div class="pkm-scarf-wrap" id="pst-scarf"
                                 role="button" tabindex="0" aria-pressed="false"
                                 aria-label="<?php echo esc_attr($t['scarf_label']); ?>">
                                <div class="pkm-toggle" aria-hidden="true"></div>
                                <div>
                                    <div class="pkm-scarf-txt" id="pst-scarf-txt"><?php echo esc_html($t['scarf_off']); ?></div>
                                    <span class="pkm-scarf-sub">×1.5 when ON</span>
                                </div>
                            </div>
                            <input type="hidden" id="pst-scarf-val" value="0">
                        </div>

                    </div>
                </div>

                <div class="pkm-shell-foot">
                    <button id="pst-reset" class="pkm-reset-btn" type="button">
                        <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 102.13-9.36L1 10"/></svg>
                        <?php echo esc_html($t['reset_btn']); ?>
                    </button>
                </div>

            </div><?php /* end .pkm-shell */ ?>

            <?php echo $pkm_render_ad($ad_slot_a, 'pkm-ad-top'); ?>

            <?php /* Data error */ ?>
            <?php if($data_error): ?>
            <div class="pkm-error" role="alert">
                <svg class="pkm-icon pkm-icon-lg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                <p style="margin:0 !important;"><?php echo esc_html($t['error_data_load']); ?></p>
            </div>
            <?php else: ?>

            <noscript>
                <div class="pkm-noscript">
                    <p><?php echo esc_html($t['noscript_msg']); ?></p>
                    <select style="margin-top:12px;width:100%;padding:10px;font-size:15px;"><?php echo $noscript_opts; ?></select>
                </div>
            </noscript>

            <div id="pst-data-err" class="pkm-error" role="alert" style="display:none !important;">
                <svg class="pkm-icon pkm-icon-lg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                <p style="margin:0 !important;"><?php echo esc_html($t['error_data_load']); ?></p>
            </div>

            <?php /* Benchmark card — below shell, only visible when Pokemon selected */ ?>
            <div class="pkm-bench-card" id="pst-bench">
                <div class="pkm-bench-title">
                    <svg class="pkm-icon pkm-icon-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                    <?php echo esc_html($t['benchmark_title']); ?>
                </div>
                <div class="pkm-bench-grids" id="pst-bench-grids"></div>
            </div>

            <?php echo $pkm_render_ad($ad_slot_b, 'pkm-ad-mid'); ?>

            <?php /* Table section */ ?>
            <div class="pkm-table-header">
                <div class="pkm-table-header-top">
                    <h2 class="pkm-table-title"><?php echo esc_html($t['table_title']); ?></h2>
                    <div class="pkm-count" id="pst-count" aria-live="polite"></div>
                </div>
                <p class="pkm-table-hint"><?php echo esc_html($t['table_hint']); ?></p>
                <div class="pkm-filter-bar" role="group" aria-label="<?php echo esc_attr($t['filter_label']); ?>">
                    <span class="pkm-filter-lbl">
                        <svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                        <?php echo esc_html($t['filter_label']); ?>
                    </span>
                    <button class="pkm-tbtn act" data-tier="all" type="button"><?php echo esc_html($t['filter_all']); ?></button>
                    <button class="pkm-tbtn" data-tier="S" type="button">S</button>
                    <button class="pkm-tbtn" data-tier="A" type="button">A</button>
                    <button class="pkm-tbtn" data-tier="B" type="button">B</button>
                    <button class="pkm-tbtn" data-tier="C" type="button">C</button>
                    <button class="pkm-tbtn" data-tier="D" type="button">D</button>
                    <button class="pkm-tbtn" data-tier="E" type="button">E</button>
                </div>
            </div>

            <div class="pkm-tbl-wrap">
                <table class="pkm-tbl" id="pst-table" role="grid">
                    <thead>
                        <tr>
                            <th scope="col"><?php echo esc_html($t['rank_label']); ?></th>
                            <th scope="col"><?php echo esc_html($t['pokemon_label']); ?></th>
                            <th scope="col"><?php echo esc_html($t['type_label']); ?></th>
                            <th scope="col"><?php echo esc_html($t['base_speed_label']); ?></th>
                            <th scope="col"><?php echo esc_html($t['final_speed_label']); ?></th>
                            <th scope="col"><?php echo esc_html($t['tier_label']); ?></th>
                        </tr>
                    </thead>
                    <tbody id="pst-tbody"></tbody>
                </table>
            </div>

            <?php echo $pkm_render_ad($ad_slot_c, 'pkm-ad-content'); ?>

            <?php /* SEO sections */ ?>
            <?php if(!empty($t['intro_title'])||!empty($t['intro_content'])): ?>
            <div class="pkm-section">
                <?php if(!empty($t['intro_title'])): ?><h2 class="pkm-section-h2"><svg class="pkm-icon pkm-icon-lg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg><?php echo esc_html($t['intro_title']); ?></h2><?php endif; ?>
                <?php if(!empty($t['intro_content'])): ?><div><?php echo wp_kses_post($t['intro_content']); ?></div><?php endif; ?>
            </div>
            <?php endif; ?>

            <?php if(!empty($t['howto_title'])): ?>
            <div class="pkm-section">
                <h2 class="pkm-section-h2"><svg class="pkm-icon pkm-icon-lg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 8 12 12 14 14"/></svg><?php echo esc_html($t['howto_title']); ?></h2>
                <ol class="pkm-steps">
                    <?php foreach(['howto_step1','howto_step2','howto_step3','howto_step4'] as $i=>$k): ?>
                    <?php if(!empty($t[$k])): ?><li class="pkm-step"><div class="pkm-step-n"><?php echo $i+1;?></div><div class="pkm-step-t"><?php echo esc_html($t[$k]);?></div></li><?php endif; ?>
                    <?php endforeach; ?>
                </ol>
            </div>
            <?php endif; ?>

            <?php if(!empty($t['info_title'])||!empty($t['info_content'])): ?>
            <div class="pkm-section">
                <?php if(!empty($t['info_title'])): ?><h2 class="pkm-section-h2"><svg class="pkm-icon pkm-icon-lg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg><?php echo esc_html($t['info_title']);?></h2><?php endif;?>
                <?php if(!empty($t['info_content'])): ?><div><?php echo wp_kses_post($t['info_content']);?></div><?php endif;?>
                <?php if(!empty($t['info_table_html'])): ?><div class="pkm-tbl-outer"><?php echo wp_kses_post($t['info_table_html']);?></div><?php endif;?>
            </div>
            <?php endif; ?>

            <?php echo $pkm_render_ad($ad_slot_d, 'pkm-ad-faq'); ?>

            <?php if(!empty($t['faq_title'])): ?>
            <div class="pkm-section">
                <h2 class="pkm-section-h2"><svg class="pkm-icon pkm-icon-lg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg><?php echo esc_html($t['faq_title']);?></h2>
                <div class="pkm-faqs">
                    <?php for($qi=1;$qi<=8;$qi++): $qk='faq_q'.$qi;$ak='faq_a'.$qi; if(empty($t[$qk]))continue; ?>
                    <details class="pkm-faq-i">
                        <summary class="pkm-faq-q"><span><?php echo esc_html($t[$qk]);?></span><svg class="pkm-icon pkm-icon-sm pkm-faq-chev" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg></summary>
                        <div class="pkm-faq-a"><?php echo wp_kses_post($t[$ak]);?></div>
                    </details>
                    <?php endfor; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php endif; /* end !data_error */ ?>

        </div><?php /* .pkm-col */ ?>
    </div><?php /* .pkm-outer */ ?>

    <script>
    (function(){
    'use strict';
    if(typeof pkmData==='undefined'||!Array.isArray(pkmData)||!pkmData.length){
        var e=document.getElementById('pst-data-err');
        if(e)e.style.removeProperty('display');
        return;
    }

    /* ── Helpers ── */
    var F=Math.floor;
    function cap(s){return s?s.charAt(0).toUpperCase()+s.slice(1):'';}
    function sn(v){return(isNaN(v)||!isFinite(v))?0:v;}

    /* ── Speed formula (Bulbapedia) ── */
    function calcSpd(base,iv,ev,lv,nat,scarf){
        var b=Math.max(1,F(base)),i=Math.max(0,Math.min(31,F(iv))),e=Math.max(0,Math.min(252,F(ev)));
        var s1=F((2*b+i+F(e/4))*lv/100+5);
        var s2=F(s1*(parseFloat(nat)||1.0));
        return sn(F(s2*(scarf?1.5:1.0)));
    }

    /* ── Tier ── */
    function tier(fs,lv){
        if(lv===50){if(fs>=150)return'S';if(fs>=120)return'A';if(fs>=100)return'B';if(fs>=80)return'C';if(fs>=60)return'D';return'E';}
        if(fs>=300)return'S';if(fs>=240)return'A';if(fs>=200)return'B';if(fs>=160)return'C';if(fs>=120)return'D';return'E';
    }

    /* ── EV speed bonus ── */
    function evBonus(ev,lv){return F(F(ev/4)*lv/100);}

    /* ── Type badge ── */
    function typeH(t){var c=(t||'').toLowerCase().replace(/\s/g,'-');return'<span class="pkm-type pkm-type-'+c+'">'+cap(t)+'</span>';}
    function typesH(arr){if(!arr||!arr.length)return'';return'<div class="pkm-types">'+arr.map(typeH).join('')+'</div>';}

    /* ── State ── */
    var S={fmt:'vgc',lv:50,nat:1.0,ev:0,iv:31,scarf:false,selId:null,filterTier:'all',rows:[]};

    /* ── DOM ── */
    var $=function(id){return document.getElementById(id);};
    var eFmt=$('pst-format'),eNat=$('pst-nature'),eIvs=$('pst-ivs'),
        eEvs=$('pst-evs'),eEvVal=$('pst-ev-val'),eEvBonus=$('pst-ev-bonus'),
        eScarfWrap=$('pst-scarf'),eScarfVal=$('pst-scarf-val'),eScarfTxt=$('pst-scarf-txt'),
        eSearch=$('pst-search'),eHidden=$('pst-hidden'),eClear=$('pst-clear'),eDD=$('pst-dd'),
        eReset=$('pst-reset'),eTbody=$('pst-tbody'),eCount=$('pst-count'),
        eResult=$('pst-result'),eRSprite=$('pst-r-sprite'),eRName=$('pst-r-name'),
        eRTypes=$('pst-r-types'),eRMeta=$('pst-r-meta'),eRSpd=$('pst-r-spd'),eRTier=$('pst-r-tier'),
        eBench=$('pst-bench'),eBenchGrds=$('pst-bench-grids'),
        eValErr=$('pst-val-errs'),
        eTierBtns=document.querySelectorAll('.pkm-tbtn');

    /* ── Read all controls into state ── */
    function readState(){
        S.fmt=eFmt?eFmt.value:'vgc';
        S.lv=(S.fmt==='ou')?100:50;
        S.nat=parseFloat(eNat?eNat.value:1.0)||1.0;
        S.iv=Math.max(0,Math.min(31,parseInt(eIvs?eIvs.value:31)||31));
        S.ev=Math.max(0,Math.min(252,parseInt(eEvs?eEvs.value:0)||0));
        S.scarf=!!(eScarfVal&&eScarfVal.value==='1');
        S.selId=eHidden&&eHidden.value?parseInt(eHidden.value):null;
    }

    /* ── Validate IVs/EVs only ── */
    function validate(){
        var errs=[];
        var iv=parseInt(eIvs?eIvs.value:31);
        if(isNaN(iv)||iv<0||iv>31)errs.push(pkmT.error_invalid_iv);
        var ev=parseInt(eEvs?eEvs.value:0);
        if(isNaN(ev)||ev<0||ev>252)errs.push(pkmT.error_invalid_ev);
        if(!eValErr)return!errs.length;
        if(!errs.length){eValErr.style.display='none';eValErr.innerHTML='';}
        else{eValErr.innerHTML=errs.map(function(e){return'<li>'+e+'</li>';}).join('');eValErr.style.removeProperty('display');}
        return!errs.length;
    }

    /* ── Compute sorted rows ── */
    function computeRows(){
        S.rows=pkmData
            .filter(function(p){return p&&p.stats&&p.stats.speed!=null;})
            .map(function(p){
                var base=p.stats.speed||0;
                var fs=calcSpd(base,S.iv,S.ev,S.lv,S.nat,S.scarf);
                return{id:p.id,name:p.name,types:p.types,sprite:p.sprite,base:base,final:fs,tier:tier(fs,S.lv)};
            })
            .sort(function(a,b){return b.final-a.final;});
    }

    /* ── Render table with tier separators ── */
    var tierLabels={};
    function buildTierLabels(){
        tierLabels={'S':pkmT.tier_s_label,'A':pkmT.tier_a_label,'B':pkmT.tier_b_label,'C':pkmT.tier_c_label,'D':pkmT.tier_d_label,'E':pkmT.tier_e_label};
    }
    buildTierLabels();

    function renderTable(){
        if(!eTbody)return;
        var filt=S.filterTier;
        var rows=S.rows.filter(function(r){return filt==='all'||r.tier===filt;});
        if(!rows.length){
            eTbody.innerHTML='<tr><td colspan="6" class="pkm-tbl-empty">'+pkmT.no_pokemon_found+'</td></tr>';
            if(eCount)eCount.innerHTML='';return;
        }
        var html='',rank=0,lastT='';
        rows.forEach(function(r){
            rank++;
            if(filt==='all'&&r.tier!==lastT){
                lastT=r.tier;
                html+='<tr class="pkm-tsep pkm-ts-'+r.tier+'"><td colspan="6">'+
                    '<span style="font-weight:900;font-family:var(--pkm-font-heading);font-size:13px;">'+r.tier+'</span>'+
                    '  '+(tierLabels[r.tier]||'')+'</td></tr>';
            }
            var hl=S.selId&&r.id===S.selId?' hl':'';
            html+='<tr class="'+hl.trim()+'" data-id="'+r.id+'">';
            html+='<td class="pkm-td-rank">'+rank+'</td>';
            html+='<td><div class="pkm-td-pkmn"><img src="'+r.sprite+'" alt="'+cap(r.name)+'" width="36" height="36" loading="lazy" onerror="this.style.display=\'none\'"><span class="pkm-td-pkmn-name">'+cap(r.name)+'</span></div></td>';
            html+='<td>'+typesH(r.types)+'</td>';
            html+='<td class="pkm-td-base">'+r.base+'</td>';
            html+='<td class="pkm-td-final">'+r.final+'</td>';
            html+='<td><span class="pkm-tier-badge pkm-tier-'+r.tier+'">'+r.tier+'</span></td>';
            html+='</tr>';
        });
        eTbody.innerHTML=html;
        if(eCount)eCount.innerHTML='<strong>'+rows.length+'</strong> '+pkmT.results_count;
        /* NO scroll — user stays exactly where they are.
           The result card inside the shell shows the Pokemon's speed.
           The highlighted row in the table is purely visual — no jumping. */
    }

    /* ── Render result card inside shell ── */
    function renderResult(){
        if(!S.selId){if(eResult)eResult.classList.remove('vis');return;}
        var mon=pkmData.find(function(p){return p.id===S.selId;});
        if(!mon){if(eResult)eResult.classList.remove('vis');return;}
        var base=mon.stats.speed||0;
        var fs=calcSpd(base,S.iv,S.ev,S.lv,S.nat,S.scarf);
        var t=tier(fs,S.lv);
        if(eRSprite){eRSprite.src=mon.sprite;eRSprite.alt=cap(mon.name);}
        if(eRName)eRName.textContent=cap(mon.name);
        if(eRTypes)eRTypes.innerHTML=typesH(mon.types);
        if(eRMeta)eRMeta.textContent=pkmT.result_base_label+': '+base+'  |  '+pkmT.result_tier_label+': '+t;
        if(eRSpd)eRSpd.textContent=sn(fs);
        if(eRTier){eRTier.textContent=t;eRTier.className='pkm-tier-badge pkm-tier-'+t;}
        if(eResult)eResult.classList.add('vis');
    }

    /* ── Benchmark card ── */
    var BENCH=[894,1007,896,717,716,384,382,383,150,445,248,149,887,795,6,130,
               243,245,249,250,380,381,488,143,282,373,376,448,483,484,487,
               644,646,800,888,889,890,892,905,1001,1002,1003,1004,1006,479,289,101,25,94,36];

    function renderBench(){
        if(!S.selId){if(eBench)eBench.classList.remove('vis');return;}
        var mon=pkmData.find(function(p){return p.id===S.selId;});
        if(!mon){if(eBench)eBench.classList.remove('vis');return;}
        var myFs=calcSpd(mon.stats.speed||0,S.iv,S.ev,S.lv,S.nat,S.scarf);
        var out=[],tie=[],slow=[];
        BENCH.forEach(function(bid){
            if(bid===S.selId)return;
            var p=pkmData.find(function(x){return x.id===bid;});
            if(!p)return;
            var bs=calcSpd(p.stats.speed||0,31,0,S.lv,1.0,false);
            if(myFs>bs)out.push({name:p.name,sprite:p.sprite,speed:bs});
            else if(myFs===bs)tie.push({name:p.name,sprite:p.sprite,speed:bs});
            else slow.push({name:p.name,sprite:p.sprite,speed:bs});
        });
        function dedup(a){var s={};return a.filter(function(x){if(s[x.name])return false;s[x.name]=1;return true;});}
        out=dedup(out).slice(0,6);tie=dedup(tie).slice(0,4);slow=dedup(slow).slice(0,6);
        function grp(items,lbl,cls,ico){
            var h='<div class="pkm-bench-grp pkm-bg-'+cls+'">';
            h+='<div class="pkm-bench-grp-lbl"><svg class="pkm-icon pkm-icon-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">'+ico+'</svg>'+lbl+'</div>';
            if(!items.length){h+='<div class="pkm-bench-none">—</div>';}
            else items.forEach(function(it){h+='<div class="pkm-bench-item"><img src="'+it.sprite+'" alt="'+cap(it.name)+'" loading="lazy" onerror="this.style.display=\'none\'" width="22" height="22">'+cap(it.name)+'<span class="pkm-bench-spd">'+it.speed+'</span></div>';});
            return h+'</div>';
        }
        if(eBenchGrds)eBenchGrds.innerHTML=
            grp(out, pkmT.benchmark_outspeeds, 'out','<polyline points="5 12 19 12"/><polyline points="14 7 19 12 14 17"/>')+
            grp(tie, pkmT.benchmark_ties,      'tie','<line x1="5" y1="9" x2="19" y2="9"/><line x1="5" y1="15" x2="19" y2="15"/>')+
            grp(slow,pkmT.benchmark_outsped_by,'slw','<polyline points="19 12 5 12"/><polyline points="10 7 5 12 10 17"/>');
        if(eBench)eBench.classList.add('vis');
    }

    /* ── Full recalc — triggered by ANY control change ── */
    function recalc(){
        if(!validate())return;
        computeRows();
        renderTable();
        renderResult();
        renderBench();
    }

    /* ── EV bonus label ── */
    function updateEvBonus(){
        if(!eEvBonus)return;
        var ev=parseInt(eEvs?eEvs.value:0)||0;
        var lv=S.lv||50;
        var bonus=evBonus(ev,lv);
        eEvBonus.textContent=bonus>0?'+'+bonus+' speed':'';
    }

    /* ── Wire ALL controls to live recalc — no Calculate button needed ── */
    function liveChange(){readState();recalc();updateEvBonus();}

    if(eFmt)eFmt.addEventListener('change',liveChange);
    if(eNat)eNat.addEventListener('change',liveChange);
    if(eIvs)eIvs.addEventListener('input',liveChange);
    if(eEvs){
        eEvs.addEventListener('input',function(){
            if(eEvVal)eEvVal.textContent=this.value;
            liveChange();
        });
    }

    /* Scarf toggle */
    function toggleScarf(){
        var on=eScarfWrap.classList.toggle('on');
        eScarfWrap.setAttribute('aria-pressed',on?'true':'false');
        if(eScarfVal)eScarfVal.value=on?'1':'0';
        if(eScarfTxt)eScarfTxt.textContent=on?(pkmT.scarf_on||'Scarf ON'):(pkmT.scarf_off||'No Scarf');
        liveChange();
    }
    if(eScarfWrap){
        eScarfWrap.addEventListener('click',toggleScarf);
        eScarfWrap.addEventListener('keydown',function(e){if(e.key===' '||e.key==='Enter'){e.preventDefault();toggleScarf();}});
    }

    /* ── Search ── */
    var debounce=null,focusIdx=-1;

    function openDD(){if(eDD)eDD.classList.add('open');if(eSearch)eSearch.setAttribute('aria-expanded','true');}
    function closeDD(){if(eDD){eDD.classList.remove('open');eDD.innerHTML='';}if(eSearch)eSearch.setAttribute('aria-expanded','false');focusIdx=-1;}

    function buildDD(q){
        if(!eDD)return;
        var query=q.toLowerCase().trim();
        if(query.length<2){closeDD();return;}
        var matches=pkmData.filter(function(p){return p.name&&p.name.toLowerCase().indexOf(query)!==-1;}).slice(0,12);
        if(!matches.length){eDD.innerHTML='<div class="pkm-dd-none">'+pkmT.error_no_results+'</div>';openDD();return;}
        var html='';
        matches.forEach(function(p,i){
            /* Show base speed in dropdown for context */
            var baseSpd=p.stats&&p.stats.speed?p.stats.speed:0;
            html+='<div class="pkm-dd-item" role="option" tabindex="-1" data-idx="'+i+'" data-id="'+p.id+'" data-name="'+p.name+'" aria-selected="false">';
            html+='<img src="'+p.sprite+'" alt="'+cap(p.name)+'" loading="lazy" onerror="this.style.display=\'none\'" width="32" height="32">';
            html+='<span class="pkm-dd-name">'+cap(p.name)+'</span>';
            html+='<div class="pkm-dd-types">'+p.types.map(typeH).join('')+'</div>';
            html+='<span class="pkm-dd-spd">'+baseSpd+'</span>';
            html+='</div>';
        });
        eDD.innerHTML=html;focusIdx=-1;openDD();
        eDD.querySelectorAll('.pkm-dd-item').forEach(function(item){
            item.addEventListener('mousedown',function(e){e.preventDefault();selectPkm(item.dataset.id,item.dataset.name);});
        });
    }

    function selectPkm(id,name){
        if(eSearch)eSearch.value=cap(name);
        if(eHidden)eHidden.value=id;
        if(eClear)eClear.classList.add('vis');
        S.selId=parseInt(id);
        closeDD();
        readState();
        recalc();
    }

    if(eClear){
        eClear.addEventListener('click',function(){
            if(eSearch)eSearch.value='';
            if(eHidden)eHidden.value='';
            eClear.classList.remove('vis');
            S.selId=null;
            closeDD();
            if(eResult)eResult.classList.remove('vis');
            if(eBench)eBench.classList.remove('vis');
            renderTable();
        });
    }

    if(eSearch){
        eSearch.addEventListener('input',function(){
            clearTimeout(debounce);
            var v=this.value;
            if(eClear)eClear.classList.toggle('vis',v.length>0);
            if(!v||v.trim().length<2){closeDD();if(eHidden)eHidden.value='';S.selId=null;return;}
            debounce=setTimeout(function(){buildDD(v);},180);
        });
        eSearch.addEventListener('keydown',function(e){
            var items=eDD?eDD.querySelectorAll('.pkm-dd-item'):[];
            if(e.key==='ArrowDown'){e.preventDefault();focusIdx=Math.min(focusIdx+1,items.length-1);items.forEach(function(it,i){it.classList.toggle('on',i===focusIdx);});}
            else if(e.key==='ArrowUp'){e.preventDefault();focusIdx=Math.max(focusIdx-1,0);items.forEach(function(it,i){it.classList.toggle('on',i===focusIdx);});}
            else if(e.key==='Enter'){e.preventDefault();if(focusIdx>=0&&items[focusIdx]){var it=items[focusIdx];selectPkm(it.dataset.id,it.dataset.name);}}
            else if(e.key==='Escape')closeDD();
        });
        eSearch.addEventListener('blur',function(){setTimeout(closeDD,180);});
    }

    /* ── Tier filter ── */
    function setFilter(t){
        S.filterTier=t;
        eTierBtns.forEach(function(b){b.classList.toggle('act',b.dataset.tier===t);});
        renderTable();
    }
    eTierBtns.forEach(function(b){b.addEventListener('click',function(){setFilter(this.dataset.tier);});});

    /* ── Reset ── */
    if(eReset){
        eReset.addEventListener('click',function(){
            if(eFmt)eFmt.value='vgc';
            if(eNat)eNat.value='1.0';
            if(eIvs)eIvs.value='31';
            if(eEvs)eEvs.value='0';
            if(eEvVal)eEvVal.textContent='0';
            if(eEvBonus)eEvBonus.textContent='';
            if(eScarfWrap){eScarfWrap.classList.remove('on');eScarfWrap.setAttribute('aria-pressed','false');}
            if(eScarfVal)eScarfVal.value='0';
            if(eScarfTxt)eScarfTxt.textContent=pkmT.scarf_off||'No Scarf';
            if(eSearch)eSearch.value='';
            if(eHidden)eHidden.value='';
            if(eClear)eClear.classList.remove('vis');
            closeDD();
            if(eResult)eResult.classList.remove('vis');
            if(eBench)eBench.classList.remove('vis');
            S.fmt='vgc';S.lv=50;S.nat=1.0;S.ev=0;S.iv=31;S.scarf=false;S.selId=null;
            setFilter('all');
            recalc();
        });
    }

    /* ── Click outside dropdown ── */
    document.addEventListener('click',function(e){
        if(eSearch&&eDD&&!eSearch.contains(e.target)&&!eDD.contains(e.target))closeDD();
    });

    /* ── Initial render on page load ── */
    readState();
    recalc();

    })();
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('pkm_speed_tiers_calc','pkm_speed_tiers_calc_shortcode');