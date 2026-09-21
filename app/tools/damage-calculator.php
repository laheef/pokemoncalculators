<?php
// Standalone PHP
/*
 * ============================================================
 * POKEMON DAMAGE CALCULATOR v4.0
 * File:      wp-content/themes/YOUR-THEME/pkm-calculators/pkm-damage-calculator.php
 * Shortcode: [pkm_damage_calculator_calc]
 * ============================================================
 *
 * STEP 1 — Add to functions.php:
 *   require_once get_stylesheet_directory() . '/pkm-calculators/pkm-damage-calculator.php';
 *
 * STEP 2 — Add to pkm_get_lang_url() slug_map in functions.php:
 *   'pokemon-damage-calculator' => array(
 *       'es'   => 'calculadora-de-dano-pokemon',
 *       'pt-br'=> 'calculadora-de-dano-pokemon',
 *       'fr'   => 'calculateur-de-degats-pokemon',
 *       'de'   => 'pokemon-schaden-rechner',
 *   ),
 *
 * STEP 3 — Use shortcode on any page:
 *   [pkm_damage_calculator_calc]
 * ============================================================
 */

if(!function_exists('pkm_damage_calculator_gtag')){
function pkm_damage_calculator_gtag(){
    if(!is_page(['pokemon-damage-calculator','calculadora-de-dano-pokemon','calculateur-de-degats-pokemon','pokemon-schaden-rechner']))return;
    echo "<script async src='https://www.googletagmanager.com/gtag/js?id=G-PJWFG8GEPM'></script>\n";
    echo "<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-PJWFG8GEPM');</script>\n";
}
}
if(!has_action('wp_head','pkm_damage_calculator_gtag')){
    add_action('wp_head','pkm_damage_calculator_gtag',1);
}

if(!function_exists('pkm_damage_calculator_hreflang')){
function pkm_damage_calculator_hreflang(){
    if(!is_page(['pokemon-damage-calculator','calculadora-de-dano-pokemon','calculateur-de-degats-pokemon','pokemon-schaden-rechner']))return;
    foreach(['en','es','pt-br','fr','de'] as $l){
        $hl=($l==='pt-br')?'pt-BR':$l;
        echo '<link rel="alternate" hreflang="'.esc_attr($hl).'" href="'.esc_url(pkm_get_lang_url($l)).'">'."
";
    }
    echo '<link rel="alternate" hreflang="x-default" href="'.esc_url(pkm_get_lang_url('en')).'">'."
";
}
}
if(!has_action('wp_head','pkm_damage_calculator_hreflang')){
    add_action('wp_head','pkm_damage_calculator_hreflang');
}

if(!function_exists('pkm_damage_calculator_canonical')){
function pkm_damage_calculator_canonical(){
    if(!is_page(['pokemon-damage-calculator','calculadora-de-dano-pokemon','calculateur-de-degats-pokemon','pokemon-schaden-rechner']))return;
    $url=(is_ssl()?'https':'http').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    echo '<link rel="canonical" href="'.esc_url($url).'">'."
";
}
}
if(!has_action('wp_head','pkm_damage_calculator_canonical')){
    add_action('wp_head','pkm_damage_calculator_canonical');
}

if(!function_exists('pkm_damage_calculator_schema')){
function pkm_damage_calculator_schema(){
    if(!is_page(['pokemon-damage-calculator','calculadora-de-dano-pokemon','calculateur-de-degats-pokemon','pokemon-schaden-rechner']))return;
    global $pkm_current_lang;
    $lang=$pkm_current_lang??'en';
    $urls=[
        'en'   =>home_url('/en/pokemon-damage-calculator/'),
        'es'   =>home_url('/es/calculadora-de-dano-pokemon/'),
        'pt-br'=>home_url('/pt-br/calculadora-de-dano-pokemon/'),
        'fr'   =>home_url('/fr/calculateur-de-degats-pokemon/'),
        'de'   =>home_url('/de/pokemon-schaden-rechner/'),
    ];
    $u=$urls[$lang]??$urls['en'];
    $s=[
        '@context'=>'https://schema.org',
        '@graph'=>[
            ['@type'=>'WebApplication','name'=>'Pokemon Damage Calculator','url'=>$u,
             'applicationCategory'=>'UtilitiesApplication','operatingSystem'=>'All',
             'offers'=>['@type'=>'Offer','price'=>'0','priceCurrency'=>'USD']],
            ['@type'=>'BreadcrumbList','itemListElement'=>[
                ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>home_url('/')],
                ['@type'=>'ListItem','position'=>2,'name'=>'Pokemon Damage Calculator','item'=>$u],
            ]],
        ],
    ];
    echo '<script type="application/ld+json">'.wp_json_encode($s,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>'."
";
}
}
if(!has_action('wp_head','pkm_damage_calculator_schema')){
    add_action('wp_head','pkm_damage_calculator_schema');
}


/* ═══════════ SHORTCODE ═══════════ */
if(!function_exists('pkm_damage_calculator_shortcode')){
function pkm_damage_calculator_shortcode(){
    global $pkm_current_lang;$lang=$pkm_current_lang??'en';
    $t=[
      // ── UI labels ──────────────────────────────────────────────
      'title'=>'Pokémon Damage Calculator',
      'description'=>'Calculate exact damage ranges between any two Pokémon across all generations.',
      'pokemon1'=>'Pokémon 1','pokemon2'=>'Pokémon 2',
      'field'=>'Field','search_ph'=>'Search Pokémon...',
      'level'=>'Level','nature'=>'Nature','ability'=>'Ability','item'=>'Item',
      'status'=>'Status','tera'=>'Tera Type',
      'atk_stage'=>'Atk','def_stage'=>'Def','stages'=>'Stages',
      'health'=>'Health','current_hp'=>'Current HP',
      'stats'=>'Stats','moves'=>'Moves',
      'base'=>'Base','iv'=>'IV','ev'=>'EV','dv'=>'DV','stat'=>'Stat',
      'singles'=>'Singles','doubles'=>'Doubles',
      'one_v_one'=>'1v1','one_v_all'=>'1vAll','all_v_one'=>'All v1','random'=>'Random',
      'calculate'=>'Calculate Damage','reset'=>'Reset',
      'results'=>'Damage Results','rolls'=>'Damage Rolls',
      'copy'=>'Copy','copied'=>'Copied!',
      'guaranteed'=>'Guaranteed','possible'=>'Possible','cannot_ko'=>'Cannot KO',
      'ohko'=>'1HKO','2hko'=>'2HKO','3hko'=>'3HKO',
      // ── Errors ─────────────────────────────────────────────────
      'err_atk'=>'Please select an attacker.',
      'err_def'=>'Please select a defender.',
      'err_bp'=>'Base Power must be 1–999.',
      'err_level'=>'Level must be 1–100.',
      'err_stat'=>'Calculation error.',
      'err_load'=>'Could not load Pokémon data. Please refresh.',
      'err_no_res'=>'No Pokémon found.',
      // ── JS inline strings ──────────────────────────────────────
      'immune'=>'Immune',
      'ko_none'=>'Does Not KO',
      'rolls_label'=>' rolls)',
      'ko2_chance'=>'% chance to 2HKO (avg hit + roll)',
      'spread_applied'=>'⚠ Spread ×0.75 applied',
      'p2_optional'=>'(optional for 1vAll)',
      'fmt_singles'=>'👤 Singles','fmt_doubles'=>'⚡ Doubles',
      'mode_1vsall'=>'1 vs All','mode_allvs1'=>'All vs 1',
      'mode_rand_lv'=>'Random Battles Lv ',
      'mode_rand_badge'=>'Rand',
      'mode_note_1vall'=>'One attacker vs. all Pokémon — select your attacker and move only.',
      'mode_note_allv1'=>'All 4 moves vs. one defender — results shown per move.',
      'mode_note_rand'=>'Random Battles: levels locked to gen standard. All 252 EV / 31 IV presets removed.',
      'mod_doubles'=>'Doubles (0.75× spread)',
      'mod_sun_boost'=>'☀ Sun boost','mod_rain_boost'=>'🌧 Rain boost',
      'mod_sun_penalty'=>'☀ Sun penalty','mod_rain_penalty'=>'🌧 Rain penalty',
      'mod_terrain'=>'Terrain boost (×1.3)',
      'mod_reflect'=>'Reflect','mod_lightscreen'=>'Light Screen',
      'mod_aurora_veil'=>'Aurora Veil',
      'mod_stab'=>'STAB (×1.5)','mod_crit'=>'Critical Hit',
      'mod_burn'=>'Burn (×0.5 Phys)',
      'mod_helping_hand'=>'Helping Hand (×1.5)','mod_friend_guard'=>'Friend Guard (×0.75)',
      'mod_battery'=>'Battery (×1.3)','mod_power_spot'=>'Power Spot (×1.3)',
      'mod_steely_spirit'=>'Steely Spirit (×1.5)','mod_zmove'=>'Z-Move',
      'mod_gravity'=>'Gravity','mod_wonder_room'=>'Wonder Room',
      // ── SEO / content slots (filled per-page in CMS) ───────────
      'meta_title'=>'','meta_desc'=>'',
      'intro_title'=>'','intro_content'=>'',
      'howto_title'=>'','howto_step1'=>'','howto_step2'=>'','howto_step3'=>'','howto_step4'=>'',
      'info_title'=>'','info_content'=>'','info_table_title'=>'','info_table_html'=>'',
      'faq_title'=>'',
      'faq_q1'=>'','faq_a1'=>'','faq_q2'=>'','faq_a2'=>'','faq_q3'=>'','faq_a3'=>'',
      'faq_q4'=>'','faq_a4'=>'','faq_q5'=>'','faq_a5'=>'','faq_q6'=>'','faq_a6'=>'',
      'faq_q7'=>'','faq_a7'=>'','faq_q8'=>'','faq_a8'=>'',
    ];
    $ov=[
      'es'=>[
        'title'=>'Calculadora de Daño Pokémon',
        'description'=>'Calcula rangos de daño exactos entre cualquier dos Pokémon en todas las generaciones.',
        'pokemon1'=>'Pokémon 1','pokemon2'=>'Pokémon 2',
        'field'=>'Campo','search_ph'=>'Buscar Pokémon...',
        'level'=>'Nivel','nature'=>'Naturaleza','ability'=>'Habilidad','item'=>'Objeto',
        'status'=>'Estado','tera'=>'Tipo Tera',
        'atk_stage'=>'Atq','def_stage'=>'Def','stages'=>'Rangos',
        'health'=>'Salud','current_hp'=>'PS Actuales',
        'stats'=>'Stats','moves'=>'Movimientos',
        'base'=>'Base','iv'=>'IV','ev'=>'EV','dv'=>'DV','stat'=>'Stat',
        'singles'=>'Individual','doubles'=>'Dobles',
        'one_v_one'=>'1c1','one_v_all'=>'1cTodos','all_v_one'=>'Todos c1','random'=>'Aleatorio',
        'calculate'=>'Calcular Daño','reset'=>'Reiniciar',
        'results'=>'Resultados de Daño','rolls'=>'Tiradas de Daño',
        'copy'=>'Copiar','copied'=>'¡Copiado!',
        'guaranteed'=>'Garantizado','possible'=>'Posible','cannot_ko'=>'No elimina',
        'ohko'=>'1HKO','2hko'=>'2HKO','3hko'=>'3HKO',
        'err_atk'=>'Por favor selecciona un atacante.',
        'err_def'=>'Por favor selecciona un defensor.',
        'err_bp'=>'La Potencia Base debe ser 1–999.',
        'err_level'=>'El Nivel debe ser 1–100.',
        'err_stat'=>'Error de cálculo.',
        'err_load'=>'No se pudieron cargar los datos. Por favor, recarga.',
        'err_no_res'=>'No se encontraron Pokémon.',
        'immune'=>'Inmune',
        'ko_none'=>'No elimina',
        'rolls_label'=>' tiradas)',
        'ko2_chance'=>'% de prob. de 2HKO (golpe prom. + tirada)',
        'spread_applied'=>'⚠ Dispersión ×0.75 aplicada',
        'p2_optional'=>'(opcional para 1cTodos)',
        'fmt_singles'=>'👤 Individual','fmt_doubles'=>'⚡ Dobles',
        'mode_1vsall'=>'1 vs Todos','mode_allvs1'=>'Todos vs 1',
        'mode_rand_lv'=>'Batallas Aleatorias Nv ',
        'mode_rand_badge'=>'Alea.',
        'mode_note_1vall'=>'Un atacante contra todos los Pokémon — selecciona solo tu atacante y movimiento.',
        'mode_note_allv1'=>'4 movimientos contra un defensor — resultados mostrados por movimiento.',
        'mode_note_rand'=>'Batallas Aleatorias: niveles fijados al estándar de gen. EVs 252 / IVs 31 eliminados.',
        'mod_doubles'=>'Dobles (0.75× dispersión)',
        'mod_sun_boost'=>'☀ Bonus de sol','mod_rain_boost'=>'🌧 Bonus de lluvia',
        'mod_sun_penalty'=>'☀ Penalización de sol','mod_rain_penalty'=>'🌧 Penalización de lluvia',
        'mod_terrain'=>'Bonus de terreno (×1.3)',
        'mod_reflect'=>'Reflejo','mod_lightscreen'=>'Pantalla de Luz',
        'mod_aurora_veil'=>'Velo Aurora',
        'mod_stab'=>'STAB (×1.5)','mod_crit'=>'Golpe Crítico',
        'mod_burn'=>'Quemadura (×0.5 Fís.)',
        'mod_helping_hand'=>'Mano Amiga (×1.5)','mod_friend_guard'=>'Guardia Amiga (×0.75)',
        'mod_battery'=>'Batería (×1.3)','mod_power_spot'=>'Foco de Poder (×1.3)',
        'mod_steely_spirit'=>'Espíritu Férreo (×1.5)','mod_zmove'=>'Movimiento Z',
        'mod_gravity'=>'Gravedad','mod_wonder_room'=>'Sala Maravilla',
      ],
      'pt-br'=>[
        'title'=>'Calculadora de Dano Pokémon',
        'description'=>'Calcule intervalos de dano exatos entre dois Pokémon em todas as gerações.',
        'pokemon1'=>'Pokémon 1','pokemon2'=>'Pokémon 2',
        'field'=>'Campo','search_ph'=>'Buscar Pokémon...',
        'level'=>'Nível','nature'=>'Natureza','ability'=>'Habilidade','item'=>'Item',
        'status'=>'Status','tera'=>'Tipo Tera',
        'atk_stage'=>'Atq','def_stage'=>'Def','stages'=>'Estágios',
        'health'=>'Saúde','current_hp'=>'PS Atuais',
        'stats'=>'Stats','moves'=>'Movimentos',
        'base'=>'Base','iv'=>'IV','ev'=>'EV','dv'=>'DV','stat'=>'Stat',
        'singles'=>'Simples','doubles'=>'Duplas',
        'one_v_one'=>'1c1','one_v_all'=>'1cTodos','all_v_one'=>'Todos c1','random'=>'Aleatório',
        'calculate'=>'Calcular Dano','reset'=>'Reiniciar',
        'results'=>'Resultados de Dano','rolls'=>'Rolagens de Dano',
        'copy'=>'Copiar','copied'=>'Copiado!',
        'guaranteed'=>'Garantido','possible'=>'Possível','cannot_ko'=>'Não elimina',
        'ohko'=>'1HKO','2hko'=>'2HKO','3hko'=>'3HKO',
        'err_atk'=>'Por favor selecione um atacante.',
        'err_def'=>'Por favor selecione um defensor.',
        'err_bp'=>'O Poder Base deve ser 1–999.',
        'err_level'=>'O Nível deve ser 1–100.',
        'err_stat'=>'Erro de cálculo.',
        'err_load'=>'Não foi possível carregar os dados. Por favor, recarregue.',
        'err_no_res'=>'Nenhum Pokémon encontrado.',
        'immune'=>'Imune',
        'ko_none'=>'Não elimina',
        'rolls_label'=>' rolagens)',
        'ko2_chance'=>'% de chance de 2HKO (golpe méd. + rolagem)',
        'spread_applied'=>'⚠ Dispersão ×0.75 aplicada',
        'p2_optional'=>'(opcional para 1cTodos)',
        'fmt_singles'=>'👤 Simples','fmt_doubles'=>'⚡ Duplas',
        'mode_1vsall'=>'1 vs Todos','mode_allvs1'=>'Todos vs 1',
        'mode_rand_lv'=>'Batalhas Aleatórias Nv ',
        'mode_rand_badge'=>'Alea.',
        'mode_note_1vall'=>'Um atacante contra todos os Pokémon — selecione apenas seu atacante e movimento.',
        'mode_note_allv1'=>'4 movimentos contra um defensor — resultados mostrados por movimento.',
        'mode_note_rand'=>'Batalhas Aleatórias: níveis travados no padrão da geração. EVs 252 / IVs 31 removidos.',
        'mod_doubles'=>'Duplas (0.75× dispersão)',
        'mod_sun_boost'=>'☀ Bônus de sol','mod_rain_boost'=>'🌧 Bônus de chuva',
        'mod_sun_penalty'=>'☀ Penalidade de sol','mod_rain_penalty'=>'🌧 Penalidade de chuva',
        'mod_terrain'=>'Bônus de terreno (×1.3)',
        'mod_reflect'=>'Reflexo','mod_lightscreen'=>'Tela de Luz',
        'mod_aurora_veil'=>'Véu Aurora',
        'mod_stab'=>'STAB (×1.5)','mod_crit'=>'Acerto Crítico',
        'mod_burn'=>'Queimadura (×0.5 Fís.)',
        'mod_helping_hand'=>'Mão Amiga (×1.5)','mod_friend_guard'=>'Guarda Amigo (×0.75)',
        'mod_battery'=>'Bateria (×1.3)','mod_power_spot'=>'Ponto de Força (×1.3)',
        'mod_steely_spirit'=>'Espírito de Aço (×1.5)','mod_zmove'=>'Movimento Z',
        'mod_gravity'=>'Gravidade','mod_wonder_room'=>'Sala Maravilha',
      ],
      'fr'=>[
        'title'=>'Calculateur de Dégâts Pokémon',
        'description'=>'Calculez les plages de dégâts exactes entre deux Pokémon dans toutes les générations.',
        'pokemon1'=>'Pokémon 1','pokemon2'=>'Pokémon 2',
        'field'=>'Terrain','search_ph'=>'Rechercher un Pokémon...',
        'level'=>'Niveau','nature'=>'Nature','ability'=>'Talent','item'=>'Objet',
        'status'=>'Statut','tera'=>'Type Téra',
        'atk_stage'=>'Atq','def_stage'=>'Déf','stages'=>'Niveaux',
        'health'=>'Santé','current_hp'=>'PV Actuels',
        'stats'=>'Stats','moves'=>'Capacités',
        'base'=>'Base','iv'=>'IV','ev'=>'EV','dv'=>'DV','stat'=>'Stat',
        'singles'=>'Simple','doubles'=>'Double',
        'one_v_one'=>'1c1','one_v_all'=>'1cTous','all_v_one'=>'Tous c1','random'=>'Aléatoire',
        'calculate'=>'Calculer les Dégâts','reset'=>'Réinitialiser',
        'results'=>'Résultats de Dégâts','rolls'=>'Lancers de Dégâts',
        'copy'=>'Copier','copied'=>'Copié !',
        'guaranteed'=>'Garanti','possible'=>'Possible','cannot_ko'=>'Ne KO pas',
        'ohko'=>'1HKO','2hko'=>'2HKO','3hko'=>'3HKO',
        'err_atk'=>'Veuillez sélectionner un attaquant.',
        'err_def'=>'Veuillez sélectionner un défenseur.',
        'err_bp'=>'La Puissance de Base doit être 1–999.',
        'err_level'=>'Le Niveau doit être 1–100.',
        'err_stat'=>'Erreur de calcul.',
        'err_load'=>'Impossible de charger les données. Veuillez recharger.',
        'err_no_res'=>'Aucun Pokémon trouvé.',
        'immune'=>'Immunité',
        'ko_none'=>'Ne KO pas',
        'rolls_label'=>' lancers)',
        'ko2_chance'=>'% de chance de 2HKO (coup moy. + lancer)',
        'spread_applied'=>'⚠ Dispersion ×0.75 appliquée',
        'p2_optional'=>'(optionnel pour 1cTous)',
        'fmt_singles'=>'👤 Simple','fmt_doubles'=>'⚡ Double',
        'mode_1vsall'=>'1 vs Tous','mode_allvs1'=>'Tous vs 1',
        'mode_rand_lv'=>'Combats Aléatoires Niv. ',
        'mode_rand_badge'=>'Aléa.',
        'mode_note_1vall'=>'Un attaquant contre tous les Pokémon — sélectionnez uniquement votre attaquant et sa capacité.',
        'mode_note_allv1'=>'4 capacités contre un défenseur — résultats affichés par capacité.',
        'mode_note_rand'=>'Combats Aléatoires : niveaux verrouillés au standard de gén. EVs 252 / IVs 31 supprimés.',
        'mod_doubles'=>'Double (0.75× dispersion)',
        'mod_sun_boost'=>'☀ Bonus soleil','mod_rain_boost'=>'🌧 Bonus pluie',
        'mod_sun_penalty'=>'☀ Pénalité soleil','mod_rain_penalty'=>'🌧 Pénalité pluie',
        'mod_terrain'=>'Bonus de terrain (×1.3)',
        'mod_reflect'=>'Écran Miroir','mod_lightscreen'=>'Écran Lumineux',
        'mod_aurora_veil'=>'Voile Aurore',
        'mod_stab'=>'STAB (×1.5)','mod_crit'=>'Coup Critique',
        'mod_burn'=>'Brûlure (×0.5 Phys.)',
        'mod_helping_hand'=>"Coup d'Pouce (×1.5)",'mod_friend_guard'=>'Garde-Ami (×0.75)',
        'mod_battery'=>'Pile (×1.3)','mod_power_spot'=>'Point de Pouvoir (×1.3)',
        'mod_steely_spirit'=>'Esprit Acier (×1.5)','mod_zmove'=>'Capacité Z',
        'mod_gravity'=>'Gravité','mod_wonder_room'=>'Salle Étrange',
      ],
      'de'=>[
        'title'=>'Pokémon Schaden-Rechner',
        'description'=>'Berechne genaue Schadensbereiche zwischen zwei Pokémon in allen Generationen.',
        'pokemon1'=>'Pokémon 1','pokemon2'=>'Pokémon 2',
        'field'=>'Feld','search_ph'=>'Pokémon suchen...',
        'level'=>'Level','nature'=>'Wesen','ability'=>'Fähigkeit','item'=>'Item',
        'status'=>'Status','tera'=>'Tera-Typ',
        'atk_stage'=>'Angriff','def_stage'=>'Vert.','stages'=>'Stufen',
        'health'=>'Leben','current_hp'=>'Aktuelle KP',
        'stats'=>'Werte','moves'=>'Attacken',
        'base'=>'Basis','iv'=>'IV','ev'=>'EV','dv'=>'DV','stat'=>'Wert',
        'singles'=>'Einzel','doubles'=>'Doppel',
        'one_v_one'=>'1g1','one_v_all'=>'1gAlle','all_v_one'=>'Alle g1','random'=>'Zufällig',
        'calculate'=>'Schaden Berechnen','reset'=>'Zurücksetzen',
        'results'=>'Schadensergebnis','rolls'=>'Schadenswürfe',
        'copy'=>'Kopieren','copied'=>'Kopiert!',
        'guaranteed'=>'Garantiert','possible'=>'Möglich','cannot_ko'=>'Kein KO',
        'ohko'=>'1HKO','2hko'=>'2HKO','3hko'=>'3HKO',
        'err_atk'=>'Bitte wähle einen Angreifer.',
        'err_def'=>'Bitte wähle einen Verteidiger.',
        'err_bp'=>'Basisstärke muss 1–999 sein.',
        'err_level'=>'Level muss 1–100 sein.',
        'err_stat'=>'Berechnungsfehler.',
        'err_load'=>'Pokémon-Daten konnten nicht geladen werden. Bitte neu laden.',
        'err_no_res'=>'Kein Pokémon gefunden.',
        'immune'=>'Immun',
        'ko_none'=>'Kein KO',
        'rolls_label'=>' Würfe)',
        'ko2_chance'=>'% Wahrsch. für 2HKO (Ø-Treffer + Wurf)',
        'spread_applied'=>'⚠ Streuung ×0.75 angewendet',
        'p2_optional'=>'(optional für 1gAlle)',
        'fmt_singles'=>'👤 Einzel','fmt_doubles'=>'⚡ Doppel',
        'mode_1vsall'=>'1 vs Alle','mode_allvs1'=>'Alle vs 1',
        'mode_rand_lv'=>'Zufallskämpfe Lv. ',
        'mode_rand_badge'=>'Zuf.',
        'mode_note_1vall'=>'Ein Angreifer gegen alle Pokémon — wähle nur deinen Angreifer und die Attacke.',
        'mode_note_allv1'=>'4 Attacken gegen einen Verteidiger — Ergebnisse pro Attacke angezeigt.',
        'mode_note_rand'=>'Zufallskämpfe: Level auf Gen-Standard gesperrt. 252 EV / 31 IV Voreinstellungen entfernt.',
        'mod_doubles'=>'Doppel (0.75× Streuung)',
        'mod_sun_boost'=>'☀ Sonne-Bonus','mod_rain_boost'=>'🌧 Regen-Bonus',
        'mod_sun_penalty'=>'☀ Sonne-Malus','mod_rain_penalty'=>'🌧 Regen-Malus',
        'mod_terrain'=>'Terrain-Bonus (×1.3)',
        'mod_reflect'=>'Reflektor','mod_lightscreen'=>'Lichtschutzschild',
        'mod_aurora_veil'=>'Auroraschleier',
        'mod_stab'=>'STAB (×1.5)','mod_crit'=>'Volltreffer',
        'mod_burn'=>'Verbrennung (×0.5 Phys.)',
        'mod_helping_hand'=>'Helfende Hand (×1.5)','mod_friend_guard'=>'Freundesschutz (×0.75)',
        'mod_battery'=>'Energiepol (×1.3)','mod_power_spot'=>'Kraftstelle (×1.3)',
        'mod_steely_spirit'=>'Stahlgeist (×1.5)','mod_zmove'=>'Z-Attacke',
        'mod_gravity'=>'Schwerkraft','mod_wonder_room'=>'Wunderraum',
      ],
    ];
    if(isset($ov[$lang]))$t=array_merge($t,$ov[$lang]);
    $ra = function(string $s, string $c=''): string { return pkm_render_ad($s, $c); };
    $ad_a = get_setting('ad_slot_top', get_setting('ad_header_code', ''));
    $ad_b = get_setting('ad_slot_below_result', '');
    $ad_c = get_setting('ad_slot_mid_content', '');
    $ad_d = get_setting('ad_slot_bottom', '');
    $raw=get_pokemon_data();$derr=empty($raw)||!is_array($raw);
    $jsd=[];
    if(!$derr){$jsd=array_map(function($p){return['id'=>intval($p['id']??0),'name'=>sanitize_text_field($p['name']??''),'types'=>array_values($p['types']??[]),'sprite'=>esc_url(trim($p['sprite_default']??'')),'hp'=>intval($p['stats']['hp']??0),'attack'=>intval($p['stats']['attack']??0),'defense'=>intval($p['stats']['defense']??0),'special_attack'=>intval($p['stats']['special_attack']??0),'special_defense'=>intval($p['stats']['special_defense']??0),'speed'=>intval($p['stats']['speed']??0)];}, $raw);}
    $pj=wp_json_encode($jsd,JSON_HEX_TAG|JSON_UNESCAPED_UNICODE);$tj=wp_json_encode($t,JSON_HEX_TAG|JSON_UNESCAPED_UNICODE);
    $g94=get_pokemon_data(94);$g65=get_pokemon_data(65);$g6=get_pokemon_data(6);
    $spa=esc_url(trim($g94['sprite_default']??''));$spb=esc_url(trim($g65['sprite_default']??''));$spc=esc_url(trim($g6['sprite_default']??''));
    $ns='';if(!$derr){foreach($raw as $p){$ns.='<option value="'.intval($p['id']??0).'">'.esc_html(ucfirst(sanitize_text_field($p['name']??''))).'</option>';}}
    ob_start();
?>
<style>
/* ═══════════════════════════════════════════════════════
   PKDC v7 — Fixed Layout + Responsive Grid + Polished UI
   Maximum specificity + !important to override theme CSS
═══════════════════════════════════════════════════════ */
#pkdc-root,#pkdc-root *{box-sizing:border-box !important;}
#pkdc-root{
  --pkdc-card:#fff;--pkdc-bg3:#e8ebf0;--pkdc-text:#1a1f2e;--pkdc-muted:#4a5568;
  --pkdc-subtle:#9aa5b4;--pkdc-border:rgba(0,0,0,.10);--pkdc-input:#eaecf0;
  --pkdc-shadow:0 4px 20px rgba(0,0,0,.12);--pkdc-shs:0 2px 8px rgba(0,0,0,.07);
  --pkdc-red:#0D9488;--pkdc-navy:#134E4A;--pkdc-gold:#F4D03F;--pkdc-green:#2ECC71;
  --pkdc-grad:linear-gradient(135deg, #0D9488 0%, #134E4A 100%);
  --pkdc-r:12px;--pkdc-rs:8px;--pkdc-tr:all .2s cubic-bezier(.4,0,.2,1);
  font-family:inherit !important;color:var(--pkdc-text) !important;
  background:transparent !important;line-height:1.5 !important;
}
[data-theme="dark"] #pkdc-root,.dark-mode #pkdc-root,.dark #pkdc-root,[class*="dark"] #pkdc-root{
  --pkdc-card:#161b22;--pkdc-bg3:#21262d;--pkdc-text:#e6edf3;--pkdc-muted:#8b949e;
  --pkdc-subtle:#484f58;--pkdc-border:rgba(255,255,255,.09);--pkdc-input:#21262d;
  --pkdc-shadow:0 4px 20px rgba(0,0,0,.5);--pkdc-shs:0 2px 8px rgba(0,0,0,.35);
}

/* ── Wrapper ── */
#pkdc-root .pkdc-wrap{width:100% !important;max-width:1280px !important;margin:0 auto !important;padding:0 16px 56px !important;}

/* ── Topbar ── */
#pkdc-root .pkdc-topbar{display:flex !important;align-items:flex-start !important;justify-content:space-between !important;gap:10px !important;padding:14px 0 12px !important;border-bottom:2px solid var(--pkdc-border) !important;margin-bottom:16px !important;flex-wrap:wrap !important;}
#pkdc-root .pkdc-title-s{display:flex !important;align-items:center !important;gap:10px !important;flex-shrink:0 !important;min-width:0 !important;}
#pkdc-root .pkdc-sprs{display:flex !important;align-items:flex-end !important;flex-shrink:0 !important;}
#pkdc-root .pkdc-spr{width:44px !important;height:44px !important;object-fit:contain !important;filter:drop-shadow(0 2px 5px rgba(0,0,0,.25)) !important;margin-left:-8px !important;display:block !important;}
#pkdc-root .pkdc-spr:first-child{margin-left:0 !important;}
#pkdc-root .pkdc-spr:nth-child(1){animation:pkdc-fl 3s ease-in-out infinite !important;}
#pkdc-root .pkdc-spr:nth-child(2){animation:pkdc-fl 3s ease-in-out .9s infinite !important;}
#pkdc-root .pkdc-spr:nth-child(3){animation:pkdc-fl 3s ease-in-out 1.8s infinite !important;}
@keyframes pkdc-fl{0%,100%{transform:translateY(0);}50%{transform:translateY(-6px);}}
@media(prefers-reduced-motion:reduce){#pkdc-root .pkdc-spr{animation:none !important;}}
#pkdc-root .pkdc-title-text{min-width:0 !important;}
#pkdc-root .pkdc-h1{font-size:clamp(15px,1.8vw,22px) !important;font-weight:800 !important;color:var(--pkdc-text) !important;line-height:1.2 !important;display:block !important;white-space:nowrap !important;overflow:hidden !important;text-overflow:ellipsis !important;margin:0 !important;padding:0 !important;}
#pkdc-root .pkdc-sub{font-size:11px !important;color:var(--pkdc-muted) !important;display:block !important;margin-top:2px !important;}

/* ── Controls ── */
#pkdc-root .pkdc-ctrl-s{display:flex !important;align-items:flex-start !important;gap:6px !important;flex-shrink:0 !important;flex-direction:column !important;}
#pkdc-root .pkdc-ctrl-row{display:flex !important;gap:5px !important;flex-wrap:wrap !important;align-items:center !important;width:100% !important;}

/* ── Gen & Format pill groups ── */
#pkdc-root .pkdc-pills{display:flex !important;flex-direction:row !important;flex-wrap:wrap !important;background:#e8ebf0 !important;border-radius:50px !important;padding:3px !important;gap:2px !important;border:1px solid rgba(0,0,0,.12) !important;list-style:none !important;margin:0 !important;}
[data-theme="dark"] #pkdc-root .pkdc-pills,.dark-mode #pkdc-root .pkdc-pills,.dark #pkdc-root .pkdc-pills{background:#21262d !important;border-color:rgba(255,255,255,.09) !important;}
#pkdc-root .pkdc-pill{display:inline-block !important;padding:4px 10px !important;border-radius:50px !important;font-size:11px !important;font-weight:700 !important;color:#4a5568 !important;background:transparent !important;border:none !important;cursor:pointer !important;transition:background .15s,color .15s !important;outline:none !important;white-space:nowrap !important;line-height:1.5 !important;text-decoration:none !important;}
[data-theme="dark"] #pkdc-root .pkdc-pill,.dark-mode #pkdc-root .pkdc-pill,.dark #pkdc-root .pkdc-pill{color:#8b949e !important;}
#pkdc-root .pkdc-pill:hover{background:rgba(13, 148, 136, 0.15) !important;color:var(--pkdc-red, #0D9488) !important;}
#pkdc-root .pkdc-pill.on{background:var(--pkdc-red, #0D9488) !important;color:#fff !important;box-shadow:0 2px 6px rgba(13, 148, 136, 0.4) !important;}

/* ── Error box ── */
#pkdc-root .pkdc-ebox{display:none !important;align-items:center !important;gap:9px !important;background:rgba(13,148,136,.09) !important;border:1px solid rgba(13,148,136,.28) !important;border-radius:var(--pkdc-r) !important;padding:10px 14px !important;margin-bottom:10px !important;color:var(--pkdc-red) !important;font-size:13px !important;font-weight:600 !important;}
#pkdc-root .pkdc-ebox.show{display:flex !important;}
#pkdc-root .pkdc-ebox svg{width:16px !important;height:16px !important;flex-shrink:0 !important;}

/* ══════════════════════════════════════════════════════
   3-COLUMN RESPONSIVE GRID — CORE LAYOUT FIX
   Pokemon1 | Field | Pokemon2
══════════════════════════════════════════════════════ */
#pkdc-root .pkdc-grid{
  display:grid !important;
  grid-template-columns:1fr 320px 1fr !important;
  grid-template-rows:auto !important;
  gap:14px !important;
  align-items:start !important;
  width:100% !important;
  margin-top:4px !important;
}
/* Field column (middle) — fixed width on desktop */
#pkdc-root .pkdc-fcol{
  grid-column:2 !important;
  min-width:0 !important;
}
/* Tablet: 2-col, field goes full width on top */
@media(max-width:1024px){
  #pkdc-root .pkdc-grid{grid-template-columns:1fr 1fr !important;grid-template-rows:auto auto !important;}
  #pkdc-root .pkdc-fcol{grid-column:1 / -1 !important;order:-1 !important;}
}
/* Mobile: single column stack */
@media(max-width:640px){
  #pkdc-root .pkdc-grid{grid-template-columns:1fr !important;}
  #pkdc-root .pkdc-fcol{grid-column:1 !important;order:0 !important;}
}

/* ── Panel ── */
#pkdc-root .pkdc-panel{background:var(--pkdc-card) !important;border:1px solid var(--pkdc-border) !important;border-radius:var(--pkdc-r) !important;overflow:hidden !important;box-shadow:var(--pkdc-shs) !important;width:100% !important;min-width:0 !important;}
#pkdc-root .pkdc-ph{padding:10px 14px !important;font-size:11px !important;font-weight:800 !important;text-transform:uppercase !important;letter-spacing:.09em !important;color:#fff !important;background:var(--pkdc-grad) !important;display:block !important;}
#pkdc-root .pkdc-ph.navy{background:var(--pkdc-navy) !important;}
#pkdc-root .pkdc-pb{padding:13px !important;display:block !important;}

/* ── Search ── */
#pkdc-root .pkdc-sw{position:relative !important;display:block !important;}
#pkdc-root .pkdc-si{width:100% !important;padding:8px 34px 8px 11px !important;background:var(--pkdc-input) !important;color:var(--pkdc-text) !important;border:1.5px solid var(--pkdc-border) !important;border-radius:var(--pkdc-rs) !important;font-size:13px !important;font-family:inherit !important;outline:none !important;min-height:38px !important;display:block !important;-webkit-appearance:none !important;appearance:none !important;}
#pkdc-root .pkdc-si:focus{border-color:var(--pkdc-red) !important;box-shadow:0 0 0 3px rgba(13, 148, 136, 0.14) !important;}
#pkdc-root .pkdc-sico{position:absolute !important;right:10px !important;top:50% !important;transform:translateY(-50%) !important;width:15px !important;height:15px !important;color:var(--pkdc-subtle) !important;pointer-events:none !important;}
#pkdc-root .pkdc-drop{display:none !important;position:absolute !important;top:calc(100% + 4px) !important;left:0 !important;right:0 !important;background:var(--pkdc-card) !important;border:1px solid var(--pkdc-border) !important;border-radius:var(--pkdc-r) !important;box-shadow:var(--pkdc-shadow) !important;max-height:220px !important;overflow-y:auto !important;z-index:9999 !important;scrollbar-width:thin !important;}
#pkdc-root .pkdc-drop.open{display:block !important;}
#pkdc-root .pkdc-ddi{display:flex !important;align-items:center !important;gap:7px !important;padding:8px 11px !important;cursor:pointer !important;border-bottom:1px solid var(--pkdc-border) !important;min-height:42px !important;}
#pkdc-root .pkdc-ddi:last-child{border-bottom:none !important;}
#pkdc-root .pkdc-ddi:hover,#pkdc-root .pkdc-ddi.kb{background:rgba(13,148,136,.08) !important;}
#pkdc-root .pkdc-ddi img{width:28px !important;height:28px !important;object-fit:contain !important;flex-shrink:0 !important;}
#pkdc-root .pkdc-ddi-n{font-size:12px !important;font-weight:600 !important;text-transform:capitalize !important;flex:1 !important;color:var(--pkdc-text) !important;}
#pkdc-root .pkdc-ddi-t{display:flex !important;gap:2px !important;flex-shrink:0 !important;}
#pkdc-root .pkdc-nores{padding:12px !important;text-align:center !important;font-size:12px !important;color:var(--pkdc-muted) !important;}
/* Preview */
#pkdc-root .pkdc-prev{display:none !important;align-items:center !important;gap:9px !important;margin-top:7px !important;padding:8px 11px !important;background:var(--pkdc-bg3) !important;border-radius:var(--pkdc-rs) !important;border:1px solid var(--pkdc-border) !important;}
#pkdc-root .pkdc-prev.show{display:flex !important;}
#pkdc-root .pkdc-prev img{width:44px !important;height:44px !important;object-fit:contain !important;flex-shrink:0 !important;}
#pkdc-root .pkdc-prev-n{font-weight:700 !important;font-size:13px !important;text-transform:capitalize !important;color:var(--pkdc-text) !important;display:block !important;}
#pkdc-root .pkdc-prev-t{display:flex !important;gap:3px !important;margin-top:3px !important;flex-wrap:wrap !important;}
/* Type badges */
#pkdc-root .pkdc-tb{display:inline-block !important;padding:2px 7px !important;border-radius:20px !important;font-size:9px !important;font-weight:700 !important;text-transform:uppercase !important;color:#fff !important;line-height:1.7 !important;}
#pkdc-root .pkdc-tb-normal{background:#9199a1 !important;}#pkdc-root .pkdc-tb-fire{background:#ff9c54 !important;}#pkdc-root .pkdc-tb-water{background:#4d90d5 !important;}#pkdc-root .pkdc-tb-grass{background:#63bc5a !important;}#pkdc-root .pkdc-tb-electric{background:#f3d23b !important;color:#333 !important;}#pkdc-root .pkdc-tb-ice{background:#74cec0 !important;}#pkdc-root .pkdc-tb-fighting{background:#ce416b !important;}#pkdc-root .pkdc-tb-poison{background:#ab6ac8 !important;}#pkdc-root .pkdc-tb-ground{background:#d97845 !important;}#pkdc-root .pkdc-tb-flying{background:#8fa8dd !important;}#pkdc-root .pkdc-tb-psychic{background:#f97176 !important;}#pkdc-root .pkdc-tb-bug{background:#90c12c !important;}#pkdc-root .pkdc-tb-rock{background:#c9bb8a !important;color:#333 !important;}#pkdc-root .pkdc-tb-ghost{background:#5269ac !important;}#pkdc-root .pkdc-tb-dragon{background:#0a6dc4 !important;}#pkdc-root .pkdc-tb-dark{background:#5a5465 !important;}#pkdc-root .pkdc-tb-steel{background:#5a8ea2 !important;}#pkdc-root .pkdc-tb-fairy{background:#ec8fe6 !important;}
/* Gen badge */
#pkdc-root .pkdc-gen-badge{display:inline-block !important;padding:3px 10px !important;border-radius:20px !important;font-size:10px !important;font-weight:700 !important;background:rgba(13, 148, 136, 0.12) !important;color:var(--pkdc-red, #0D9488) !important;border:1px solid rgba(13, 148, 136, 0.25) !important;white-space:nowrap !important;margin-left:4px !important;}
/* Section labels */
#pkdc-root .pkdc-sec{font-size:9px !important;font-weight:800 !important;text-transform:uppercase !important;letter-spacing:.09em !important;color:var(--pkdc-subtle) !important;display:flex !important;align-items:center !important;gap:5px !important;margin:10px 0 5px !important;}
#pkdc-root .pkdc-sec::after{content:'' !important;flex:1 !important;height:1px !important;background:var(--pkdc-border) !important;}
/* Form */
#pkdc-root .pkdc-row{display:flex !important;gap:7px !important;margin-bottom:7px !important;flex-wrap:nowrap !important;align-items:flex-end !important;}
#pkdc-root .pkdc-fg{display:flex !important;flex-direction:column !important;gap:3px !important;flex:1 !important;min-width:0 !important;}
#pkdc-root .pkdc-lbl{font-size:9px !important;font-weight:700 !important;text-transform:uppercase !important;letter-spacing:.07em !important;color:var(--pkdc-muted) !important;display:block !important;}
#pkdc-root .pkdc-sel,#pkdc-root .pkdc-inp{width:100% !important;padding:6px 24px 6px 9px !important;background:var(--pkdc-input) !important;color:var(--pkdc-text) !important;border:1px solid var(--pkdc-border) !important;border-radius:var(--pkdc-rs) !important;font-size:12px !important;font-family:inherit !important;outline:none !important;min-height:32px !important;-webkit-appearance:none !important;appearance:none !important;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='9' height='5' viewBox='0 0 9 5'%3E%3Cpath fill='%239AA5B4' d='M4.5 5L0 0h9z'/%3E%3C/svg%3E") !important;background-repeat:no-repeat !important;background-position:right 8px center !important;cursor:pointer !important;display:block !important;}
#pkdc-root .pkdc-inp{padding:6px 9px !important;background-image:none !important;cursor:text !important;}
#pkdc-root .pkdc-sel:focus,#pkdc-root .pkdc-inp:focus{border-color:var(--pkdc-red, #0D9488) !important;box-shadow:0 0 0 3px rgba(13, 148, 136, 0.12) !important;}
/* Hidden */
#pkdc-root .pkdc-hide{display:none !important;}
/* Health */
#pkdc-root .pkdc-health{margin:6px 0 !important;display:block !important;}
#pkdc-root .pkdc-hrow{display:flex !important;align-items:center !important;justify-content:space-between !important;margin-bottom:5px !important;gap:5px !important;}
#pkdc-root .pkdc-hlbl{font-size:10px !important;font-weight:700 !important;color:var(--pkdc-muted) !important;}
#pkdc-root .pkdc-hright{display:flex !important;align-items:center !important;gap:5px !important;}
#pkdc-root .pkdc-hinp{width:58px !important;padding:4px 7px !important;background:var(--pkdc-input) !important;color:var(--pkdc-text) !important;border:1px solid var(--pkdc-border) !important;border-radius:var(--pkdc-rs) !important;font-size:11px !important;text-align:center !important;outline:none !important;min-height:28px !important;-webkit-appearance:none !important;appearance:none !important;font-family:inherit !important;}
#pkdc-root .pkdc-hinp:focus{border-color:var(--pkdc-red, #0D9488) !important;box-shadow:0 0 0 3px rgba(13, 148, 136, 0.12) !important;}
#pkdc-root .pkdc-hmax{font-size:10px !important;color:var(--pkdc-subtle) !important;}
#pkdc-root .pkdc-hpct{font-size:10px !important;font-weight:700 !important;color:var(--pkdc-muted) !important;min-width:34px !important;text-align:right !important;}
#pkdc-root .pkdc-htrack{height:10px !important;background:var(--pkdc-bg3) !important;border-radius:10px !important;overflow:hidden !important;display:block !important;}
#pkdc-root .pkdc-hfill{height:100% !important;background:#2ECC71 !important;border-radius:10px !important;transition:width .3s !important;min-width:2px !important;display:block !important;}
#pkdc-root .pkdc-hfill.med{background:#F4D03F !important;}
#pkdc-root .pkdc-hfill.low{background:var(--pkdc-red, #0D9488) !important;}
/* Stages */
#pkdc-root .pkdc-stgg{display:grid !important;grid-template-columns:1fr 1fr !important;gap:8px !important;margin-bottom:8px !important;}
#pkdc-root .pkdc-stgr{display:flex !important;align-items:center !important;gap:5px !important;}
#pkdc-root .pkdc-slbl{font-size:9px !important;font-weight:700 !important;color:var(--pkdc-muted) !important;text-transform:uppercase !important;letter-spacing:.06em !important;display:block !important;margin-bottom:4px !important;}
#pkdc-root .pkdc-sbtn{width:24px !important;height:24px !important;border-radius:50% !important;background:var(--pkdc-bg3) !important;border:1.5px solid var(--pkdc-border) !important;color:var(--pkdc-text) !important;font-size:14px !important;font-weight:700 !important;display:flex !important;align-items:center !important;justify-content:center !important;cursor:pointer !important;outline:none !important;transition:var(--pkdc-tr) !important;}
#pkdc-root .pkdc-sbtn:hover{background:var(--pkdc-red, #0D9488) !important;color:#fff !important;border-color:var(--pkdc-red, #0D9488) !important;}
#pkdc-root .pkdc-sval{min-width:28px !important;text-align:center !important;font-size:12px !important;font-weight:700 !important;color:var(--pkdc-text) !important;}
#pkdc-root .pkdc-sval.up{color:#ff6b6b !important;}
#pkdc-root .pkdc-sval.dn{color:#4dabf7 !important;}
/* Stat table */
#pkdc-root .pkdc-stg{display:grid !important;grid-template-columns:30px 38px 48px 48px 42px !important;gap:3px !important;align-items:center !important;}
#pkdc-root .pkdc-shd{font-size:8px !important;font-weight:700 !important;text-transform:uppercase !important;color:var(--pkdc-subtle) !important;text-align:center !important;padding:2px 0 5px !important;}
#pkdc-root .pkdc-slb{font-size:10px !important;font-weight:700 !important;color:var(--pkdc-muted) !important;}
#pkdc-root .pkdc-sbs{font-size:10px !important;color:var(--pkdc-muted) !important;text-align:center !important;}
#pkdc-root .pkdc-stinp{width:100% !important;padding:3px 4px !important;background:var(--pkdc-input) !important;color:var(--pkdc-text) !important;border:1px solid var(--pkdc-border) !important;border-radius:4px !important;font-size:10px !important;text-align:center !important;outline:none !important;min-height:26px !important;-webkit-appearance:none !important;appearance:none !important;font-family:inherit !important;}
#pkdc-root .pkdc-stinp:focus{border-color:var(--pkdc-red, #0D9488) !important;box-shadow:0 0 0 2px rgba(13, 148, 136, 0.14) !important;}
#pkdc-root .pkdc-stot{font-size:11px !important;font-weight:700 !important;text-align:center !important;color:var(--pkdc-text) !important;}
#pkdc-root .pkdc-stot.bst{color:#ff6b6b !important;}
#pkdc-root .pkdc-stot.drp{color:#4dabf7 !important;}
/* Move blocks */
#pkdc-root .pkdc-mvb{margin-bottom:10px !important;padding-bottom:10px !important;border-bottom:1px solid var(--pkdc-border) !important;display:block !important;}
#pkdc-root .pkdc-mvb:last-of-type{border-bottom:none !important;margin-bottom:0 !important;padding-bottom:0 !important;}
#pkdc-root .pkdc-mvhd{display:flex !important;align-items:center !important;justify-content:space-between !important;margin-bottom:5px !important;}
#pkdc-root .pkdc-mvnum{font-size:10px !important;color:var(--pkdc-subtle) !important;font-weight:700 !important;}
#pkdc-root .pkdc-mvuse{display:flex !important;align-items:center !important;gap:3px !important;font-size:10px !important;font-weight:700 !important;padding:3px 8px !important;border-radius:5px !important;background:transparent !important;border:1.5px solid var(--pkdc-border) !important;color:var(--pkdc-muted) !important;cursor:pointer !important;outline:none !important;transition:var(--pkdc-tr) !important;}
#pkdc-root .pkdc-mvuse.sel{background:var(--pkdc-red) !important;color:#fff !important;border-color:var(--pkdc-red) !important;}
#pkdc-root .pkdc-mvuse:hover:not(.sel){background:rgba(13, 148, 136, 0.1) !important;color:var(--pkdc-red, #0D9488) !important;border-color:var(--pkdc-red, #0D9488) !important;}
#pkdc-root .pkdc-mvnr{display:grid !important;grid-template-columns:1fr 52px !important;gap:5px !important;margin-bottom:4px !important;}
#pkdc-root .pkdc-mvi{width:100% !important;padding:5px 9px !important;background:var(--pkdc-input) !important;color:var(--pkdc-text) !important;border:1px solid var(--pkdc-border) !important;border-radius:var(--pkdc-rs) !important;font-size:11px !important;font-family:inherit !important;outline:none !important;min-height:30px !important;display:block !important;-webkit-appearance:none !important;appearance:none !important;}
#pkdc-root .pkdc-mvi:focus{border-color:var(--pkdc-red, #0D9488) !important;box-shadow:0 0 0 2px rgba(13, 148, 136, 0.14) !important;}
#pkdc-root .pkdc-mvbp{width:100% !important;padding:5px 4px !important;background:var(--pkdc-input) !important;color:var(--pkdc-text) !important;border:1px solid var(--pkdc-border) !important;border-radius:var(--pkdc-rs) !important;font-size:11px !important;text-align:center !important;font-family:inherit !important;outline:none !important;min-height:30px !important;-webkit-appearance:none !important;appearance:none !important;display:block !important;}
#pkdc-root .pkdc-mvbp:focus{border-color:var(--pkdc-red, #0D9488) !important;box-shadow:0 0 0 2px rgba(13, 148, 136, 0.14) !important;}
#pkdc-root .pkdc-mvor{display:grid !important;grid-template-columns:1fr 1fr !important;gap:4px !important;margin-bottom:4px !important;}
#pkdc-root .pkdc-mvfl{display:flex !important;gap:4px !important;flex-wrap:wrap !important;}
#pkdc-root .pkdc-mvf{display:inline-flex !important;align-items:center !important;font-size:9px !important;font-weight:700 !important;padding:3px 8px !important;border-radius:20px !important;cursor:pointer !important;background:var(--pkdc-bg3) !important;border:1px solid var(--pkdc-border) !important;color:var(--pkdc-muted) !important;outline:none !important;user-select:none !important;transition:var(--pkdc-tr) !important;}
#pkdc-root .pkdc-mvf.on{background:rgba(13, 148, 136, 0.12) !important;color:var(--pkdc-red, #0D9488) !important;border-color:var(--pkdc-red, #0D9488) !important;}
/* Field buttons */
#pkdc-root .pkdc-fsec{font-size:9px !important;font-weight:800 !important;text-transform:uppercase !important;letter-spacing:.09em !important;color:var(--pkdc-subtle) !important;margin:10px 0 5px !important;display:flex !important;align-items:center !important;gap:5px !important;}
#pkdc-root .pkdc-fsec::after{content:'' !important;flex:1 !important;height:1px !important;background:var(--pkdc-border) !important;}
#pkdc-root .pkdc-bg2{display:grid !important;grid-template-columns:1fr 1fr !important;gap:4px !important;}
#pkdc-root .pkdc-bg3g{display:grid !important;grid-template-columns:1fr 1fr 1fr !important;gap:4px !important;}
#pkdc-root .pkdc-fb{padding:6px 6px !important;font-size:10px !important;font-weight:600 !important;background:var(--pkdc-bg3) !important;color:var(--pkdc-muted) !important;border:1px solid var(--pkdc-border) !important;border-radius:var(--pkdc-rs) !important;cursor:pointer !important;text-align:center !important;outline:none !important;line-height:1.4 !important;width:100% !important;display:block !important;transition:var(--pkdc-tr) !important;}
#pkdc-root .pkdc-fb:hover{border-color:var(--pkdc-red, #0D9488) !important;color:var(--pkdc-red, #0D9488) !important;background:rgba(13, 148, 136, 0.05) !important;}
#pkdc-root .pkdc-fb.on{background:rgba(13, 148, 136, 0.12) !important;color:var(--pkdc-red, #0D9488) !important;border-color:var(--pkdc-red, #0D9488) !important;font-weight:700 !important;}
#pkdc-root .pkdc-fb.full{grid-column:1/-1 !important;}
#pkdc-root .pkdc-sprow{display:flex !important;align-items:center !important;justify-content:space-between !important;gap:4px !important;margin-top:6px !important;}
#pkdc-root .pkdc-splbl{font-size:9px !important;color:var(--pkdc-muted) !important;font-weight:700 !important;text-transform:uppercase !important;letter-spacing:.07em !important;}
#pkdc-root .pkdc-spbtns{display:flex !important;gap:3px !important;}
#pkdc-root .pkdc-spbtn{width:24px !important;height:24px !important;border-radius:6px !important;background:var(--pkdc-bg3) !important;border:1px solid var(--pkdc-border) !important;font-size:10px !important;font-weight:700 !important;color:var(--pkdc-muted) !important;display:flex !important;align-items:center !important;justify-content:center !important;cursor:pointer !important;outline:none !important;transition:var(--pkdc-tr) !important;}
#pkdc-root .pkdc-spbtn.on{background:rgba(13, 148, 136, 0.12) !important;color:var(--pkdc-red, #0D9488) !important;border-color:var(--pkdc-red, #0D9488) !important;}
#pkdc-root .pkdc-2side{display:grid !important;grid-template-columns:1fr 1fr !important;gap:10px !important;margin-top:6px !important;}
#pkdc-root .pkdc-hazards-inline{display:contents !important;}
#pkdc-root .pkdc-hazards-inline.pkdc-hide{display:none !important;}
#pkdc-root .pkdc-slbl2{font-size:9px !important;font-weight:800 !important;text-transform:uppercase !important;color:var(--pkdc-subtle) !important;margin-bottom:4px !important;display:block !important;}
#pkdc-root .pkdc-sbtns{display:grid !important;grid-template-columns:1fr !important;gap:3px !important;}
/* Mode pills row */
#pkdc-root .pkdc-mode-row{display:flex !important;gap:6px !important;flex-wrap:wrap !important;margin-bottom:10px !important;align-items:center !important;}
#pkdc-root .pkdc-mode-pill{padding:5px 12px !important;border-radius:var(--pkdc-rs) !important;font-size:11px !important;font-weight:700 !important;background:var(--pkdc-bg3) !important;color:var(--pkdc-muted) !important;border:1.5px solid var(--pkdc-border) !important;cursor:pointer !important;outline:none !important;display:inline-block !important;transition:var(--pkdc-tr) !important;}
#pkdc-root .pkdc-mode-pill:hover{border-color:var(--pkdc-red, #0D9488) !important;color:var(--pkdc-red, #0D9488) !important;}
#pkdc-root .pkdc-mode-pill.on{background:var(--pkdc-red, #0D9488) !important;color:#fff !important;border-color:var(--pkdc-red, #0D9488) !important;box-shadow:0 2px 8px rgba(13, 148, 136, 0.3) !important;}

/* ══════════════════════════════════════════════════════
   ACTION BUTTONS — Polished & Prominent
══════════════════════════════════════════════════════ */
#pkdc-root .pkdc-actions{display:flex !important;gap:12px !important;justify-content:center !important;margin:18px 0 10px !important;flex-wrap:wrap !important;}
/* Calculate button — primary CTA */
#pkdc-root .pkdc-bcalc{
  display:inline-flex !important;align-items:center !important;gap:8px !important;
  padding:12px 36px !important;font-size:14px !important;font-weight:800 !important;
  font-family:inherit !important;background:var(--pkdc-grad) !important;color:#fff !important;
  border:none !important;border-radius:var(--pkdc-r) !important;cursor:pointer !important;
  box-shadow:0 4px 16px rgba(13,148,136,.35),0 1px 3px rgba(0,0,0,.15) !important;
  outline:none !important;min-height:48px !important;letter-spacing:.02em !important;
  transition:transform .15s,box-shadow .15s !important;
  text-transform:uppercase !important;
}
#pkdc-root .pkdc-bcalc:hover{transform:translateY(-2px) !important;box-shadow:0 6px 22px rgba(13,148,136,.45),0 2px 6px rgba(0,0,0,.2) !important;}
#pkdc-root .pkdc-bcalc:active{transform:translateY(0) !important;box-shadow:0 2px 8px rgba(13, 148, 136, 0.3) !important;}
#pkdc-root .pkdc-bcalc svg{width:17px !important;height:17px !important;}
/* Reset button */
#pkdc-root .pkdc-breset{
  display:inline-flex !important;align-items:center !important;gap:7px !important;
  padding:12px 22px !important;font-size:13px !important;font-weight:700 !important;
  font-family:inherit !important;background:var(--pkdc-card) !important;
  color:var(--pkdc-muted) !important;border:1.5px solid var(--pkdc-border) !important;
  border-radius:var(--pkdc-r) !important;cursor:pointer !important;outline:none !important;
  min-height:48px !important;transition:var(--pkdc-tr) !important;
}
#pkdc-root .pkdc-breset:hover{border-color:var(--pkdc-red, #0D9488) !important;color:var(--pkdc-red, #0D9488) !important;background:rgba(13, 148, 136, 0.04) !important;}
#pkdc-root .pkdc-breset svg{width:15px !important;height:15px !important;}

/* Validation errors */
#pkdc-root .pkdc-verrs{list-style:none !important;margin:0 0 8px !important;padding:0 !important;background:rgba(13,148,136,.07) !important;border:1px solid rgba(13,148,136,.22) !important;border-radius:var(--pkdc-rs) !important;display:none !important;}
#pkdc-root .pkdc-verrs.show{display:block !important;}
#pkdc-root .pkdc-verrs li{display:flex !important;align-items:center !important;gap:7px !important;padding:8px 13px !important;font-size:12px !important;color:var(--pkdc-red, #0D9488) !important;border-bottom:1px solid rgba(13, 148, 136, 0.1) !important;}
#pkdc-root .pkdc-verrs li:last-child{border-bottom:none !important;}
#pkdc-root .pkdc-verrs li svg{width:13px !important;height:13px !important;flex-shrink:0 !important;}

/* ══════════════════════════════════════════════════════
   RESULT PANEL — Clear, Readable Output
══════════════════════════════════════════════════════ */
#pkdc-root .pkdc-res{display:none !important;background:var(--pkdc-card) !important;border:1px solid var(--pkdc-border) !important;border-radius:var(--pkdc-r) !important;overflow:hidden !important;margin-top:12px !important;box-shadow:var(--pkdc-shadow) !important;}
#pkdc-root .pkdc-res.show{display:block !important;}
#pkdc-root .pkdc-rhead{background:var(--pkdc-grad) !important;padding:13px 18px !important;display:flex !important;align-items:center !important;justify-content:space-between !important;gap:10px !important;}
#pkdc-root .pkdc-rtit{font-size:14px !important;font-weight:800 !important;color:#fff !important;text-transform:uppercase !important;letter-spacing:.04em !important;}
#pkdc-root .pkdc-rcopy{
  background:rgba(255,255,255,.15) !important;color:#fff !important;
  border:1.5px solid rgba(255,255,255,.4) !important;border-radius:var(--pkdc-rs) !important;
  padding:5px 14px !important;font-size:11px !important;font-weight:700 !important;
  cursor:pointer !important;outline:none !important;transition:background .15s !important;
  text-transform:uppercase !important;letter-spacing:.04em !important;
}
#pkdc-root .pkdc-rcopy:hover{background:rgba(255,255,255,.28) !important;}
#pkdc-root .pkdc-rbody{padding:16px 18px !important;}
#pkdc-root .pkdc-rsum{
  font-size:13px !important;font-weight:600 !important;color:var(--pkdc-text) !important;
  margin-bottom:12px !important;line-height:1.6 !important;
  background:var(--pkdc-bg3) !important;border-radius:var(--pkdc-rs) !important;
  padding:10px 14px !important;border-left:3px solid var(--pkdc-red) !important;
}
#pkdc-root .pkdc-rlbl{font-size:9px !important;font-weight:800 !important;text-transform:uppercase !important;letter-spacing:.08em !important;color:var(--pkdc-subtle) !important;margin-bottom:5px !important;display:block !important;}
#pkdc-root .pkdc-rolls{display:flex !important;flex-wrap:wrap !important;gap:4px !important;margin-bottom:14px !important;}
#pkdc-root .pkdc-roll{padding:3px 6px !important;background:var(--pkdc-bg3) !important;border:1px solid var(--pkdc-border) !important;border-radius:4px !important;font-size:11px !important;font-weight:600 !important;color:var(--pkdc-muted) !important;}
#pkdc-root .pkdc-roll.mn{border-color:#4dabf7 !important;color:#4dabf7 !important;background:rgba(77,171,247,.1) !important;}
#pkdc-root .pkdc-roll.mx{border-color:#ff6b6b !important;color:#ff6b6b !important;background:rgba(255,107,107,.1) !important;}
#pkdc-root .pkdc-bwrap{margin-bottom:12px !important;}
#pkdc-root .pkdc-bmeta{display:flex !important;justify-content:space-between !important;align-items:center !important;margin-bottom:5px !important;font-size:11px !important;color:var(--pkdc-muted) !important;}
#pkdc-root .pkdc-bmeta strong{font-size:13px !important;color:var(--pkdc-text) !important;font-weight:800 !important;}
#pkdc-root .pkdc-btrack{height:10px !important;background:var(--pkdc-bg3) !important;border-radius:10px !important;overflow:hidden !important;}
#pkdc-root .pkdc-bfill{height:100% !important;background:var(--pkdc-grad) !important;border-radius:10px !important;transition:width .5s cubic-bezier(.4,0,.2,1) !important;min-width:3px !important;}
#pkdc-root .pkdc-korow{display:flex !important;align-items:center !important;justify-content:space-between !important;padding:10px 14px !important;background:var(--pkdc-bg3) !important;border-radius:var(--pkdc-rs) !important;margin-bottom:6px !important;flex-wrap:wrap !important;gap:6px !important;}
#pkdc-root .pkdc-kolbl{font-size:12px !important;font-weight:700 !important;color:var(--pkdc-text) !important;}
#pkdc-root .pkdc-kobdg{padding:4px 12px !important;border-radius:20px !important;font-size:11px !important;font-weight:800 !important;letter-spacing:.02em !important;}
#pkdc-root .pkdc-kog{background:var(--pkdc-red, #0D9488) !important;color:#fff !important;box-shadow:0 2px 6px rgba(13, 148, 136, 0.3) !important;}
#pkdc-root .pkdc-kop{background:#F4D03F !important;color:#333 !important;}
#pkdc-root .pkdc-kon{background:var(--pkdc-bg3) !important;color:var(--pkdc-muted) !important;border:1px solid var(--pkdc-border) !important;}
#pkdc-root .pkdc-effr{display:flex !important;align-items:center !important;gap:8px !important;padding:8px 14px !important;background:var(--pkdc-bg3) !important;border-radius:var(--pkdc-rs) !important;font-size:12px !important;}
#pkdc-root .pkdc-effl{color:var(--pkdc-muted) !important;font-weight:600 !important;flex:1 !important;}
#pkdc-root .pkdc-effb{padding:3px 10px !important;border-radius:20px !important;font-size:11px !important;font-weight:800 !important;}
#pkdc-root .pkdc-effi{background:#333 !important;color:#aaa !important;}
#pkdc-root .pkdc-effnv{background:#4dabf7 !important;color:#fff !important;}
#pkdc-root .pkdc-effn{background:var(--pkdc-bg3) !important;color:var(--pkdc-muted) !important;border:1px solid var(--pkdc-border) !important;}
#pkdc-root .pkdc-effs{background:#2ecc71 !important;color:#fff !important;}
#pkdc-root .pkdc-effu{background:var(--pkdc-red, #0D9488) !important;color:#fff !important;}
/* Test bar */


/* ── Result panel enhancements ── */
#pkdc-root .pkdc-rhead{background:var(--pkdc-grad) !important;padding:13px 18px !important;display:flex !important;align-items:center !important;justify-content:space-between !important;gap:10px !important;}
#pkdc-root .pkdc-rhead-left{display:flex !important;align-items:center !important;gap:8px !important;flex-wrap:wrap !important;}
#pkdc-root .pkdc-rbadges{display:flex !important;gap:4px !important;flex-wrap:wrap !important;}
#pkdc-root .pkdc-rbadge{padding:2px 8px !important;border-radius:20px !important;font-size:9px !important;font-weight:800 !important;text-transform:uppercase !important;letter-spacing:.06em !important;background:rgba(255,255,255,.2) !important;color:#fff !important;border:1px solid rgba(255,255,255,.3) !important;}
#pkdc-root .pkdc-rbadge-dbl{background:rgba(243,210,59,.3) !important;border-color:rgba(243,210,59,.5) !important;color:#F4D03F !important;}
#pkdc-root .pkdc-rbadge-rand{background:rgba(46,204,113,.2) !important;border-color:rgba(46,204,113,.4) !important;color:#2ecc71 !important;}
#pkdc-root .pkdc-rctx{display:flex !important;flex-wrap:wrap !important;gap:5px !important;margin-bottom:10px !important;}
#pkdc-root .pkdc-rctx-tag{padding:3px 9px !important;border-radius:20px !important;font-size:10px !important;font-weight:700 !important;background:var(--pkdc-bg3) !important;color:var(--pkdc-muted) !important;border:1px solid var(--pkdc-border) !important;}
#pkdc-root .pkdc-rctx-tag.warn{background:rgba(244,208,63,.15) !important;color:#c9981f !important;border-color:rgba(244,208,63,.4) !important;}
#pkdc-root .pkdc-rlbl-row{display:flex !important;align-items:center !important;justify-content:space-between !important;margin-bottom:5px !important;}
#pkdc-root .pkdc-roll-range{font-size:11px !important;font-weight:700 !important;color:var(--pkdc-muted) !important;}
#pkdc-root .pkdc-ko2row{display:flex !important;align-items:center !important;justify-content:space-between !important;padding:7px 14px !important;background:var(--pkdc-bg3) !important;border-radius:var(--pkdc-rs) !important;margin-bottom:6px !important;}
#pkdc-root .pkdc-ko2lbl{font-size:11px !important;font-weight:600 !important;color:var(--pkdc-muted) !important;}
#pkdc-root .pkdc-ko2pct{font-size:12px !important;font-weight:800 !important;color:var(--pkdc-text) !important;}
#pkdc-root .pkdc-modrow{margin-top:8px !important;padding:8px 14px !important;background:var(--pkdc-bg3) !important;border-radius:var(--pkdc-rs) !important;}
#pkdc-root .pkdc-modlbl{font-size:9px !important;font-weight:800 !important;text-transform:uppercase !important;letter-spacing:.08em !important;color:var(--pkdc-subtle) !important;display:block !important;margin-bottom:5px !important;}
#pkdc-root .pkdc-modlist{display:flex !important;flex-wrap:wrap !important;gap:4px !important;}
#pkdc-root .pkdc-modbadge{padding:2px 8px !important;border-radius:20px !important;font-size:10px !important;font-weight:600 !important;background:rgba(13, 148, 136, 0.1) !important;color:var(--pkdc-red, #0D9488) !important;border:1px solid rgba(13,148,136,.2) !important;}

/* ── Mode/Format UI indicators ── */
#pkdc-root .pkdc-format-indicator{display:flex !important;align-items:center !important;gap:5px !important;padding:4px 0 !important;font-size:10px !important;color:var(--pkdc-muted) !important;}
/* Doubles-only fields highlight */
#pkdc-root .pkdc-doubles-only{position:relative !important;}
#pkdc-root .pkdc-doubles-only::before{content:'2v2' !important;position:absolute !important;top:-8px !important;right:0 !important;font-size:8px !important;font-weight:800 !important;background:#F4D03F !important;color:#333 !important;padding:1px 4px !important;border-radius:3px !important;display:none !important;}
#pkdc-root.is-doubles .pkdc-doubles-only::before{display:block !important;}

/* Random battles level lock indicator */
#pkdc-root .pkdc-lv-locked{border-color:#2ecc71 !important;background:rgba(46,204,113,.08) !important;color:#27ae60 !important;font-weight:700 !important;}
#pkdc-root .pkdc-lv-lock-lbl{font-size:9px !important;color:#27ae60 !important;font-weight:700 !important;display:none !important;margin-top:2px !important;}
#pkdc-root .pkdc-lv-lock-lbl.show{display:block !important;}

/* Mode row tooltip note */
#pkdc-root .pkdc-mode-note{font-size:10px !important;color:var(--pkdc-muted) !important;font-style:italic !important;margin-bottom:8px !important;padding:5px 10px !important;background:var(--pkdc-bg3) !important;border-radius:var(--pkdc-rs) !important;display:none !important;}
#pkdc-root .pkdc-mode-note.show{display:block !important;}
/* SEO */
#pkdc-root .pkdc-seo{background:var(--pkdc-card) !important;border:1px solid var(--pkdc-border) !important;border-radius:var(--pkdc-r) !important;padding:22px !important;margin-top:18px !important;}
#pkdc-root .pkdc-seo h2{font-size:16px !important;font-weight:800 !important;color:var(--pkdc-text) !important;margin:0 0 12px !important;}
#pkdc-root .pkdc-seob{font-size:14px !important;line-height:1.8 !important;color:var(--pkdc-muted) !important;}
#pkdc-root .pkdc-ad{text-align:center !important;margin:14px 0 !important;}

/* ── Responsive ── */
@media(max-width:768px){
  #pkdc-root .pkdc-topbar{flex-direction:column !important;align-items:stretch !important;}
  #pkdc-root .pkdc-ctrl-s{width:100% !important;}
  #pkdc-root .pkdc-ctrl-row{width:100% !important;flex-wrap:wrap !important;}
  #pkdc-root .pkdc-pills{flex-wrap:wrap !important;border-radius:10px !important;}
  #pkdc-root .pkdc-h1{font-size:15px !important;}
  #pkdc-root .pkdc-sub{font-size:10px !important;}
  #pkdc-root .pkdc-pill{padding:3px 8px !important;font-size:10px !important;}
  #pkdc-root .pkdc-bcalc{padding:11px 26px !important;font-size:13px !important;}
}
@media(max-width:480px){
  #pkdc-root .pkdc-wrap{padding:0 10px 40px !important;}
  #pkdc-root .pkdc-pb{padding:10px !important;}
  #pkdc-root .pkdc-stg{grid-template-columns:28px 32px 42px 42px 36px !important;}
  #pkdc-root .pkdc-rbody{padding:12px 13px !important;}
  #pkdc-root .pkdc-bcalc{padding:10px 20px !important;font-size:12px !important;width:100% !important;justify-content:center !important;}
  #pkdc-root .pkdc-breset{width:100% !important;justify-content:center !important;}
  #pkdc-root .pkdc-actions{flex-direction:column !important;align-items:stretch !important;}
  #pkdc-root .pkdc-ctrl-s{gap:4px !important;}
  #pkdc-root .pkdc-sprs{display:none !important;}
  #pkdc-root .pkdc-pills{width:100% !important;justify-content:flex-start !important;}
  #pkdc-root .pkdc-2side{grid-template-columns:1fr !important;}
}
</style>


<div class="pkdc" id="pkdc-root">
<div class="pkdc-wrap">

<!-- TOPBAR -->
<div class="pkdc-topbar">
  <div class="pkdc-title-s">
    <div class="pkdc-sprs" aria-hidden="true">
      <?php if($spa):?><img class="pkdc-spr" src="<?php echo $spa;?>" alt="" width="44" height="44" loading="eager" onerror="this.style.display='none'"><?php endif;?>
      <?php if($spb):?><img class="pkdc-spr" src="<?php echo $spb;?>" alt="" width="44" height="44" loading="eager" onerror="this.style.display='none'"><?php endif;?>
      <?php if($spc):?><img class="pkdc-spr" src="<?php echo $spc;?>" alt="" width="44" height="44" loading="eager" onerror="this.style.display='none'"><?php endif;?>
    </div>
    <div class="pkdc-title-text">
      <span class="pkdc-h1"><?php echo esc_html($t['title']);?></span>
      <span class="pkdc-sub"><?php echo esc_html($t['description']);?></span>
    </div>
  </div>
  <div class="pkdc-ctrl-s">
    <!-- Generation pills -->
    <div class="pkdc-ctrl-row">
      <div class="pkdc-pills" id="pkdc-gens" role="group" aria-label="Generation">
        <button class="pkdc-pill" data-gen="1">RBY</button>
        <button class="pkdc-pill" data-gen="2">GSC</button>
        <button class="pkdc-pill" data-gen="3">ADV</button>
        <button class="pkdc-pill" data-gen="4">DPP</button>
        <button class="pkdc-pill" data-gen="5">B/W</button>
        <button class="pkdc-pill" data-gen="6">X/Y</button>
        <button class="pkdc-pill" data-gen="7">S/M</button>
        <button class="pkdc-pill" data-gen="8">S/S</button>
        <button class="pkdc-pill on" data-gen="9">S/V</button>
      </div>
    </div>
    <!-- Format pills -->
    <div class="pkdc-ctrl-row">
      <div class="pkdc-pills" id="pkdc-fmts" role="group" aria-label="Format">
        <button class="pkdc-pill on" data-fmt="singles"><?php echo esc_html($t['singles']);?></button>
        <button class="pkdc-pill" data-fmt="doubles"><?php echo esc_html($t['doubles']);?></button>
      </div>
    </div>
  </div>
</div>

<?php if($derr):?>
<div class="pkdc-ebox show" role="alert">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
  <?php echo esc_html($t['err_load']);?>
</div>
<?php endif;?>
<div id="pkdc-jserr" class="pkdc-ebox" role="alert">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
  <?php echo esc_html($t['err_load']);?>
</div>

<!-- Mode row (Battle type) -->
<div id="pkdc-mode-row" class="pkdc-mode-row" role="group" aria-label="Battle mode">
  <button class="pkdc-mode-pill on" data-mode="1v1"><?php echo esc_html($t['one_v_one']);?></button>
  <button class="pkdc-mode-pill" data-mode="1vall"><?php echo esc_html($t['one_v_all']);?></button>
  <button class="pkdc-mode-pill" data-mode="allv1"><?php echo esc_html($t['all_v_one']);?></button>
  <button class="pkdc-mode-pill" data-mode="random"><?php echo esc_html($t['random']);?> Battles</button>
  <span id="pkdc-gen-lbl" class="pkdc-gen-badge">[Gen 9] S/V</span>
</div>
<div id="pkdc-mode-note" class="pkdc-mode-note"></div>

<?php echo $ra($ad_a,'top');?>

<!-- 3-col equal grid -->
<div class="pkdc-grid">
  <div class="pkdc-panel" id="pkdc-p1-panel">
    <div class="pkdc-ph"><?php echo esc_html($t['pokemon1']);?></div>
    <div class="pkdc-pb"><?php echo pkdc4_pkm('p1',$t,$ns);?></div>
  </div>
  <div class="pkdc-panel pkdc-fcol">
    <div class="pkdc-ph navy"><?php echo esc_html($t['field']);?></div>
    <div class="pkdc-pb"><?php echo pkdc4_fld();?></div>
  </div>
  <div class="pkdc-panel" id="pkdc-p2-panel">
    <div class="pkdc-ph"><?php echo esc_html($t['pokemon2']);?></div>
    <div class="pkdc-pb"><?php echo pkdc4_pkm('p2',$t,$ns);?></div>
  </div>
</div>

<div class="pkdc-actions">
  <button type="button" id="pkdc-calc" class="pkdc-bcalc">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
    <?php echo esc_html($t['calculate']);?>
  </button>
  <button type="button" id="pkdc-reset" class="pkdc-breset">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 102.13-9.36L1 10"/></svg>
    <?php echo esc_html($t['reset']);?>
  </button>
</div>

<ul id="pkdc-verrs" class="pkdc-verrs" role="alert" aria-live="polite"></ul>

<div id="pkdc-res" class="pkdc-res" role="region" aria-live="polite">
  <div class="pkdc-rhead">
    <div class="pkdc-rhead-left">
      <span class="pkdc-rtit"><?php echo esc_html($t['results']);?></span>
      <span id="pkdc-rbadges" class="pkdc-rbadges"></span>
    </div>
    <button type="button" id="pkdc-copy" class="pkdc-rcopy"><?php echo esc_html($t['copy']);?></button>
  </div>
  <div class="pkdc-rbody">
    <!-- Summary line (Smogon-style) -->
    <div id="pkdc-rsum" class="pkdc-rsum"></div>
    <!-- Context tags: format, mode, doubles note etc -->
    <div id="pkdc-rctx" class="pkdc-rctx" style="display:none"></div>
    <!-- Damage rolls -->
    <div class="pkdc-rlbl-row">
      <span class="pkdc-rlbl"><?php echo esc_html($t['rolls']);?></span>
      <span id="pkdc-roll-range" class="pkdc-roll-range"></span>
    </div>
    <div id="pkdc-rolls" class="pkdc-rolls"></div>
    <!-- HP bar -->
    <div class="pkdc-bwrap">
      <div class="pkdc-bmeta">
        <span>% of Defender HP</span>
        <strong id="pkdc-rpct">—</strong>
      </div>
      <div class="pkdc-btrack"><div id="pkdc-rbar" class="pkdc-bfill" style="width:0%"></div></div>
    </div>
    <!-- KO chance -->
    <div class="pkdc-korow">
      <span id="pkdc-kolbl" class="pkdc-kolbl">KO</span>
      <span id="pkdc-kobdg" class="pkdc-kobdg pkdc-kon"></span>
    </div>
    <!-- Multi-hit KO breakdown (2HKO chance %) -->
    <div id="pkdc-ko2row" class="pkdc-ko2row" style="display:none">
      <span class="pkdc-ko2lbl">2HKO chance</span>
      <span id="pkdc-ko2pct" class="pkdc-ko2pct"></span>
    </div>
    <!-- Type effectiveness -->
    <div class="pkdc-effr">
      <span class="pkdc-effl">Type Effectiveness</span>
      <span id="pkdc-effbdg" class="pkdc-effb pkdc-effn">1×</span>
    </div>
    <!-- Active modifiers summary -->
    <div id="pkdc-modrow" class="pkdc-modrow" style="display:none">
      <span class="pkdc-modlbl">Active Modifiers</span>
      <div id="pkdc-modlist" class="pkdc-modlist"></div>
    </div>

  </div>
</div>

<?php echo $ra($ad_b,'below');?>
<?php if(!empty($t['intro_title'])):?><div class="pkdc-seo"><h2><?php echo esc_html($t['intro_title']);?></h2><div class="pkdc-seob"><?php echo wp_kses_post($t['intro_content']);?></div></div><?php endif;?>
<?php echo $ra($ad_c,'mid');?>
<?php if(!empty($t['info_table_title'])):?><div class="pkdc-seo"><h2><?php echo esc_html($t['info_table_title']);?></h2><div style="overflow-x:auto!important"><?php echo wp_kses_post($t['info_table_html']);?></div></div><?php endif;?>
<?php if(!empty($t['howto_title'])):?><div class="pkdc-seo"><h2><?php echo esc_html($t['howto_title']);?></h2><ol style="margin:0!important;padding-left:18px!important;color:var(--pkdc-muted)!important;font-size:14px!important;line-height:1.8!important"><?php foreach(['howto_step1','howto_step2','howto_step3','howto_step4'] as $s):if(!empty($t[$s])):?><li style="margin-bottom:6px!important"><?php echo esc_html($t[$s]);?></li><?php endif;endforeach;?></ol></div><?php endif;?>
<?php if(!empty($t['faq_title'])):?><div class="pkdc-seo"><h2><?php echo esc_html($t['faq_title']);?></h2><?php for($i=1;$i<=8;$i++):if(!empty($t["faq_q$i"])):?><details style="border-bottom:1px solid var(--pkdc-border)!important;padding:10px 0!important;cursor:pointer!important"><summary style="font-weight:700!important;color:var(--pkdc-text)!important;font-size:13px!important;list-style:none!important;display:flex!important;align-items:center!important;justify-content:space-between!important;gap:8px!important"><?php echo esc_html($t["faq_q$i"]);?><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:14px!important;height:14px!important;flex-shrink:0!important" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg></summary><p style="margin:8px 0 0!important;color:var(--pkdc-muted)!important;font-size:13px!important;line-height:1.7!important"><?php echo esc_html($t["faq_a$i"]);?></p></details><?php endif;endfor;?></div><?php endif;?>
<?php echo $ra($ad_d,'bottom');?>

</div></div>

<script>var _PD=<?php echo $pj;?>;var _PT=<?php echo $tj;?>;</script>
<script>
(function(){
'use strict';
var D=(typeof _PD!=='undefined'&&Array.isArray(_PD))?_PD:null;
var T=(typeof _PT!=='undefined')?_PT:{};
if(!D||!D.length){var eb=document.getElementById('pkdc-jserr');if(eb)eb.classList.add('show');return;}

/* ═══════════════════════════════════════
   GENERATION CONFIGURATIONS
   Each gen defines: type chart, formula, available weather/terrain,
   available fields, stat system (EVs/IVs or DVs/StatExp)
═══════════════════════════════════════ */
var GEN_CFG={
  // Gen 1 RBY: no items, no nature, no ability, no dark/steel/fairy, no weather, no terrain,
  //            no status calc, DVs, special = SpA+SpD combined, no doubles
  1:{name:'RBY',label:'Gen 1',dvs:true,specStat:true,
     noNature:true,noAbility:true,noItem:true,noStatus:true,noTera:true,
     noDark:true,noSteel:true,noFairy:true,
     noWeather:true,noTerrain:true,
     noGravity:true,noMagicRoom:true,noWonderRoom:true,
     noTailwind:true,noHelpingHand:true,noFriendGuard:true,noBattery:true,noPowerSpot:true,noSteelSpirit:true,
     noProtect:true,noForesight:true,noPowerTrick:true,noSwitchingOut:true,
     noMaxMoves:true,noSteelsurge:true,noAuroraVeil:true,noSaltCure:true,
     noDoubles:true,
     maxLevel:100,defaultLevel:100,rolls:39,formula:'gen1'},

  // Gen 2 GSC: added items, dark/steel, weather(sun/rain/sand), no nature, no ability, no fairy
  2:{name:'GSC',label:'Gen 2',dvs:true,specStat:true,
     noNature:true,noAbility:true,noTera:true,
     noFairy:true,
     noTerrain:true,weatherBasic:true,
     noGravity:true,noMagicRoom:true,noWonderRoom:true,
     noTailwind:true,noHelpingHand:true,noFriendGuard:true,noBattery:true,noPowerSpot:true,noSteelSpirit:true,
     noPowerTrick:true,noSwitchingOut:true,
     noMaxMoves:true,noSteelsurge:true,noAuroraVeil:true,noSaltCure:true,
     noDoubles:true,
     maxLevel:100,defaultLevel:100,rolls:39,formula:'gen2'},

  // Gen 3 ADV: abilities, items, natures, no fairy/terrain, doubles introduced (Gen3+)
  // Friend Guard is a Gen5 ability, not available in Gen3
  3:{name:'ADV',label:'Gen 3',noTera:true,noFairy:true,noTerrain:true,
     noGravity:true,noMagicRoom:true,noWonderRoom:true,
     noTailwind:true,noFriendGuard:true,noBattery:true,noPowerSpot:true,noSteelSpirit:true,
     noPowerTrick:true,noSwitchingOut:true,
     noMaxMoves:true,noSteelsurge:true,noAuroraVeil:true,noSaltCure:true,
     maxLevel:100,defaultLevel:100,formula:'gen345'},

  // Gen 4 DPP: added Gravity, Tailwind, Helping Hand, Switching Out, Power Trick
  // Wonder Room and Magic Room are Gen5 (BW), NOT Gen4
  // Friend Guard is a Gen5 ability
  4:{name:'DPP',label:'Gen 4',noTera:true,noFairy:true,noTerrain:true,
     noMagicRoom:true,noWonderRoom:true,noFriendGuard:true,
     noBattery:true,noPowerSpot:true,noSteelSpirit:true,
     noMaxMoves:true,noSteelsurge:true,noAuroraVeil:true,noSaltCure:true,
     maxLevel:100,defaultLevel:100,formula:'gen345'},

  // Gen 5 BW: added terrain (in Gen6), Magic Room; Wonder Room Gen5, no fairy
  5:{name:'B/W',label:'Gen 5',noTera:true,noFairy:true,noTerrain:true,
     noBattery:true,noPowerSpot:true,noSteelSpirit:true,
     noMaxMoves:true,noSteelsurge:true,noAuroraVeil:true,noSaltCure:true,
     maxLevel:100,defaultLevel:100,formula:'gen5plus'},

  // Gen 6 XY: added fairy, terrain; no tera, no aurora veil
  6:{name:'X/Y',label:'Gen 6',noTera:true,noTerrain:false,
     noBattery:true,noPowerSpot:true,noSteelSpirit:true,
     noMaxMoves:true,noSteelsurge:true,noAuroraVeil:true,noSaltCure:true,
     maxLevel:100,defaultLevel:100,formula:'gen5plus'},

  // Gen 7 SM: added Aurora Veil, Z-Moves; no tera, no max moves
  7:{name:'S/M',label:'Gen 7',noTera:true,
     noBattery:true,noPowerSpot:true,noSteelSpirit:true,
     noMaxMoves:true,noSteelsurge:true,noSaltCure:true,
     maxLevel:100,defaultLevel:100,formula:'gen5plus'},

  // Gen 8 SwSh: added Dynamax/Max Moves, Battery, Power Spot, Steely Spirit, Steelsurge; no tera
  8:{name:'S/S',label:'Gen 8',noTera:true,noSaltCure:true,
     maxLevel:100,defaultLevel:100,formula:'gen5plus'},

  // Gen 9 SV: full feature set including Tera, Snow (replaces Hail), Salt Cure
  9:{name:'S/V',label:'Gen 9',maxLevel:100,defaultLevel:100,formula:'gen5plus'}
};

/* ═══════════════════════════════════════
   TYPE CHARTS PER GENERATION
═══════════════════════════════════════ */
// Gen 1 (no Dark, Steel, Fairy; Ghost doesn't hit Psychic; Poison SE on Bug)
var TC1={normal:{ghost:0,rock:.5},fire:{fire:.5,water:.5,rock:.5,dragon:.5,grass:2,ice:2,bug:2},water:{water:.5,grass:.5,dragon:.5,fire:2,ground:2,rock:2},grass:{fire:.5,grass:.5,poison:.5,flying:.5,bug:.5,dragon:.5,water:2,ground:2,rock:2},electric:{grass:.5,electric:.5,dragon:.5,ground:0,flying:2,water:2},fighting:{poison:.5,bug:.5,psychic:.5,flying:.5,ghost:0,normal:2,ice:2,rock:2},poison:{poison:.5,ground:.5,bug:2,grass:2,ghost:.5},ground:{grass:.5,bug:.5,flying:0,fire:2,electric:2,poison:2,rock:2},flying:{electric:.5,rock:.5,grass:2,fighting:2,bug:2},psychic:{psychic:.5,fighting:2,poison:2},bug:{fire:.5,fighting:.5,flying:.5,grass:2,psychic:2,poison:2},rock:{fighting:.5,ground:.5,fire:2,ice:2,flying:2,bug:2},ghost:{ghost:0,psychic:0},dragon:{dragon:2},ice:{fire:.5,water:.5,ice:.5,grass:2,ground:2,flying:2,dragon:2}};
// Gen 2 adds Dark and Steel
var TC2=Object.assign({},TC1,{dark:{psychic:2,ghost:2,dark:.5,fighting:.5,bug:.5},steel:{fire:.5,water:.5,electric:.5,ice:2,rock:2,normal:.5,grass:.5,psychic:.5,bug:.5,dragon:.5,ghost:.5,dark:.5,steel:.5,flying:.5,ground:.5}});
TC2.psychic={psychic:.5,dark:0,fighting:2,poison:2};
TC2.ghost={ghost:2,dark:.5,psychic:0,normal:0};
TC2.poison={poison:.5,ground:.5,bug:.5,rock:.5,ghost:.5,grass:2,steel:0};
TC2.bug={fire:.5,fighting:.5,flying:.5,grass:2,psychic:2,ghost:.5,steel:.5,dark:2};
TC2.fire={fire:.5,water:.5,rock:.5,dragon:.5,grass:2,ice:2,bug:2,steel:2};
TC2.normal={ghost:0,rock:.5,steel:.5};
TC2.fighting={poison:.5,bug:.5,psychic:.5,flying:.5,ghost:0,normal:2,ice:2,rock:2,dark:2,steel:2};
TC2.rock={fighting:.5,ground:.5,steel:.5,fire:2,ice:2,flying:2,bug:2};
TC2.ground={grass:.5,bug:.5,flying:0,fire:2,electric:2,poison:2,rock:2,steel:2};
TC2.water={water:.5,grass:.5,dragon:.5,fire:2,ground:2,rock:2};
// Gen 6+ adds Fairy, adjusts Poison→Ghost, Ghost chart fixes, Steel lost Ghost/Dark resist
var TC6=Object.assign({},TC2,{fairy:{fire:.5,poison:.5,steel:.5,fighting:2,dragon:2,dark:2},steel:{fire:.5,water:.5,electric:.5,steel:.5,poison:0,ice:2,rock:2,fairy:2}});
TC6.poison={poison:.5,ground:.5,rock:.5,ghost:.5,steel:0,grass:2,fairy:2};
TC6.dark={fighting:.5,dark:.5,fairy:.5,psychic:2,ghost:2};
// Attacker charts: Fairy is immune to Dragon, resists Fighting and Bug
TC6.dragon=Object.assign({},TC2.dragon,{steel:.5,fairy:0}); // Fairy IMMUNE to Dragon
TC6.fighting=Object.assign({},TC2.fighting,{fairy:.5});      // Fairy RESISTS Fighting
TC6.bug=Object.assign({},TC2.bug,{fairy:.5});                // Fairy RESISTS Bug
var TC_GEN={1:TC1,2:TC2,3:TC2,4:TC2,5:TC2,6:TC6,7:TC6,8:TC6,9:TC6};

/* ═══════════════════════════════════════
   NATURE DATA
═══════════════════════════════════════ */
var NAT={Hardy:{},Lonely:{attack:1.1,defense:.9},Brave:{attack:1.1,speed:.9},Adamant:{attack:1.1,'special-attack':.9},Naughty:{attack:1.1,'special-defense':.9},Bold:{defense:1.1,attack:.9},Docile:{},Relaxed:{defense:1.1,speed:.9},Impish:{defense:1.1,'special-attack':.9},Lax:{defense:1.1,'special-defense':.9},Timid:{speed:1.1,attack:.9},Hasty:{speed:1.1,defense:.9},Serious:{},Jolly:{speed:1.1,'special-attack':.9},Naive:{speed:1.1,'special-defense':.9},Modest:{'special-attack':1.1,attack:.9},Mild:{'special-attack':1.1,defense:.9},Quiet:{'special-attack':1.1,speed:.9},Bashful:{},Rash:{'special-attack':1.1,'special-defense':.9},Calm:{'special-defense':1.1,attack:.9},Gentle:{'special-defense':1.1,defense:.9},Sassy:{'special-defense':1.1,speed:.9},Careful:{'special-defense':1.1,'special-attack':.9},Quirky:{}};

var SKEYS=['hp','attack','defense','special-attack','special-defense','speed'];
var SIDS=['hp','atk','def','spa','spd','spe'];

/* ── Stat calc ── */
function stg(s){var t=[[2,8],[2,7],[2,6],[2,5],[2,4],[2,3],[2,2],[3,2],[4,2],[5,2],[6,2],[7,2],[8,2]];return t[s+6][0]/t[s+6][1];}
function cstMod(base,ev,iv,lv,nat,key,gen){
  if(gen<=2){
    // Gen1/2: DVs (0-15), Stat Exp (0-65535)
    var dv=Math.min(15,Math.max(0,iv));
    var se=Math.min(65535,Math.max(0,ev));
    var seMod=Math.min(63,Math.floor(Math.ceil(Math.sqrt(se))/4));
    if(key==='hp')return Math.floor((base+dv)*2*lv/100)+lv+10+seMod;
    return Math.floor((base+dv)*2*lv/100)+5+seMod;
  }
  // Gen3+: standard formula
  if(key==='hp'){if(base===1)return 1;return Math.floor((2*base+iv+Math.floor(ev/4))*lv/100)+lv+10;}
  var r=Math.floor((2*base+iv+Math.floor(ev/4))*lv/100)+5;
  var nm=(gen>=3&&NAT[nat]&&NAT[nat][key])?NAT[nat][key]:1;
  return Math.floor(r*nm);
}
function pkmStat(p,key){return p[key]||p[key.replace(/-/g,'_')]||0;}

/* ── Type effectiveness ── */
function teff(mt,dts,gen){
  if(!mt||!dts||!dts.length)return 1;
  var tc=TC_GEN[gen]||TC_GEN[9];
  var m=1,c=tc[mt]||{};
  dts.forEach(function(dt){if(dt&&c[dt]!==undefined)m*=c[dt];});
  return m;
}
function isSTAB(mt,ats,tera,gen){
  if(!mt)return false;
  if(gen>=9&&tera&&tera!=='none')return mt===tera;
  return ats.indexOf(mt)!==-1;
}

/* ═══════════════════════════════════════
   DAMAGE FORMULAS PER GEN
═══════════════════════════════════════ */
function calcD(p){
  var L=p.lv|0,BP=p.bp|0,A=p.atk|0,Df=p.def|0,HP=p.hp|0,gen=p.gen||9;
  if(BP<1||A<1||Df<1||HP<1)return null;

  var rolls=[];

  if(gen===1){
    // Gen 1 RBY: floor((floor((floor(2*L/5+2)*BP*A/Df)/50)+2) * rand/255)
    // 39 rolls (217–255). Reflect/Light Screen: halve the stat before calc (applied via scr flag).
    // No weather, no burn effect, no items in Gen1.
    var base=Math.floor(Math.floor(Math.floor(2*L/5+2)*BP*A/Df)/50)+2;
    base=Math.floor(base*(p.scr?0.5:1));               // Reflect / Light Screen halves damage in Gen1
    base=Math.floor(base*(p.stab?1.5:1));
    base=Math.floor(base*p.te);
    if(base<1)base=1;
    for(var r=217;r<=255;r++){var d=Math.floor(base*r/255);if(d<1)d=1;rolls.push(d);}

  } else if(gen===2){
    // Gen 2 GSC: adds weather boost, items, Reflect/Light Screen (scr), burn
    // Order: weather → scr → STAB → type → item → burn → rand
    var base2=Math.floor(Math.floor(Math.floor(2*L/5+2)*BP*A/Df)/50)+2;
    base2=Math.floor(base2*(p.wb?1.5:1));               // weather boost
    base2=Math.floor(base2*(p.scr?0.5:1));              // Reflect / Light Screen
    base2=Math.floor(base2*(p.stab?1.5:1));             // STAB
    base2=Math.floor(base2*p.te);                       // type effectiveness
    base2=Math.floor(base2*(p.item_mult||1));           // held item
    base2=Math.floor(base2*(p.burn?0.5:1));             // burn halves physical
    if(base2<1)base2=1;
    for(var r2=217;r2<=255;r2++){var d2=Math.floor(base2*r2/255);if(d2<1)d2=1;rolls.push(d2);}

  } else if(gen===3||gen===4){
    // Gen 3/4 ADV/DPP: floor(floor(floor(2L/5+2)*BP*A/D/50)*mods+2) * rand/100
    // Correct order: weather → STAB → type → crit(2x) → screen → burn → +2 → spread(gen3 Dbl) → rand
    var base34=Math.floor(Math.floor(2*L/5+2)*BP*A/Df/50);
    base34=Math.floor(base34*(p.wb?1.5:p.wn?0.5:1)); // weather
    base34=Math.floor(base34*(p.stab?1.5:1));          // STAB
    base34=Math.floor(base34*p.te);                    // type effectiveness
    base34=Math.floor(base34*(p.crit?2:1));            // crit = 2x in Gen3/4
    base34=Math.floor(base34*(p.scr?0.5:1));           // screen halves (singles) — doubles uses scr flag same way
    base34=Math.floor(base34*(p.burn?0.5:1));          // burn
    base34+=2;
    if(p.dbl)base34=Math.floor(base34*0.75);           // Doubles spread (Gen3+): 0.75x
    for(var r34=85;r34<=100;r34++){var d34=Math.floor(base34*r34/100);if(d34<1)d34=1;rolls.push(d34);}

  } else {
    // Gen 5+ B/W→S/V: floor((floor(2L/5+2)*BP*A/D/50+2) * CH * rand/100) * STAB * type * mods
    // Doubles spread applied before per-roll mods
    var base5=Math.floor(Math.floor(2*L/5+2)*BP*A/Df/50)+2;
    base5=Math.floor(base5*(p.crit?1.5:1));            // crit = 1.5x in Gen5+
    base5=Math.floor(base5*(p.dbl?0.75:1));            // doubles spread 0.75x
    base5=Math.floor(base5*(p.wb?1.5:p.wn?0.5:1));    // weather boost/penalty
    base5=Math.floor(base5*(p.tb?1.3:1));              // terrain boost (gen6+)
    base5=Math.floor(base5*(p.scr?(p.dbl?0.6667:0.5):1)); // screen: singles=0.5, doubles=0.667
    base5=Math.floor(base5*(p.hh?1.5:1));              // helping hand
    base5=Math.floor(base5*(p.bat?1.3:1));             // battery (gen8)
    base5=Math.floor(base5*(p.ps?1.3:1));              // power spot (gen8)
    base5=Math.floor(base5*(p.fg?0.75:1));             // friend guard (doubles, gen5)
    base5=Math.floor(base5*(p.ss?1.5:1));              // steely spirit (gen8)
    base5=Math.floor(base5*(p.zm?1.5:1));              // z-move (gen7)
    for(var r5=85;r5<=100;r5++){
      var d5=Math.floor(base5*r5/100);
      d5=Math.floor(d5*(p.stab?1.5:1));   // STAB applied per roll
      d5=Math.floor(d5*p.te);              // type applied per roll
      d5=Math.floor(d5*(p.burn?0.5:1));   // burn halves damage (gen5+)
      if(d5<1)d5=1;
      rolls.push(d5);
    }
  }

  if(!rolls.length)return null;
  var mn=rolls[0],mx=rolls[rolls.length-1];
  var avg=Math.round(rolls.reduce(function(a,b){return a+b;},0)/rolls.length);
  var mnP=+(mn/HP*100).toFixed(1),mxP=+(mx/HP*100).toFixed(1),avgP=+((mn/HP*100+mx/HP*100)/2).toFixed(1);
  var ohN=rolls.filter(function(r){return r>=HP;}).length;
  return{
    rolls:rolls,mn:mn,mx:mx,avg:avg,mnP:mnP,mxP:mxP,avgP:avgP,ohN:ohN,
    gO:ohN===rolls.length,
    pO:ohN>0&&ohN<rolls.length,
    g2:mn*2>=HP,p2:mx*2>=HP&&mn*2<HP,
    g3:mn*3>=HP&&mn*2<HP,p3:mx*3>=HP&&mn*3<HP
  };
}

/* ═══════════════════════════════════════
   STATE
═══════════════════════════════════════ */
function mkS(){return{pkm:null,lv:100,nat:'Hardy',ab:'',item:'',st:'none',tera:'none',chp:null,evs:{hp:0,attack:0,defense:0,'special-attack':0,'special-defense':0,speed:0},ivs:{hp:31,attack:31,defense:31,'special-attack':31,'special-defense':31,speed:31},as:0,ds:0,am:0,mv:[{n:'',bp:80,t:'',c:'physical',cr:false,z:false,st2:false},{n:'',bp:80,t:'',c:'physical',cr:false,z:false,st2:false},{n:'',bp:80,t:'',c:'physical',cr:false,z:false,st2:false},{n:'',bp:80,t:'',c:'physical',cr:false,z:false,st2:false}]};}
function mkF(){return{w:'none',tr:'none',grav:false,mr:false,wr:false,p1:{sr:false,ss2:false,sp:0,ref:false,ls:false,av:false,tw:false,hh:false,fg:false,bat:false,ps:false,ssp:false,prot:false,lseed:false,sc:false,fore:false,ptrick:false,vl:false,wf:false,cn:false,vc:false,so:false},p2:{sr:false,ss2:false,sp:0,ref:false,ls:false,av:false,tw:false,hh:false,fg:false,bat:false,ps:false,ssp:false,prot:false,lseed:false,sc:false,fore:false,ptrick:false,vl:false,wf:false,cn:false,vc:false,so:false}};}
var S={p1:mkS(),p2:mkS(),fld:mkF(),gen:9,fmt:'singles',mode:'1v1',last:null};

function g(id){return document.getElementById(id);}
function uc(s){return s?s.charAt(0).toUpperCase()+s.slice(1):'';}
function tb(tp){return'<span class="pkdc-tb pkdc-tb-'+tp+'">'+uc(tp)+'</span>';}
function ec(m){if(m===0)return'pkdc-effi';if(m<1)return'pkdc-effnv';if(m===1)return'pkdc-effn';if(m===2)return'pkdc-effs';return'pkdc-effu';}
var DT={};function deb(k,fn,ms){clearTimeout(DT[k]);DT[k]=setTimeout(fn,ms);}

/* ═══════════════════════════════════════
   GENERATION SWITCH — updates UI
═══════════════════════════════════════ */
function applyGen(gen){
  S.gen=gen;
  var cfg=GEN_CFG[gen]||GEN_CFG[9];

  /* ── helper: show/hide by selector ── */
  function showSel(sel){document.querySelectorAll(sel).forEach(function(el){el.classList.remove('pkdc-hide');});}
  function hideSel(sel){document.querySelectorAll(sel).forEach(function(el){el.classList.add('pkdc-hide');});}
  function tog(sel,hide){if(hide)hideSel(sel);else showSel(sel);}

  /* ══ POKÉMON PANELS ══ */
  tog('.pkdc-nat-row',   cfg.noNature);
  tog('.pkdc-ab-row',    cfg.noAbility);
  tog('.pkdc-item-row',  cfg.noItem);
  tog('.pkdc-tera-row',  cfg.noTera);
  tog('.pkdc-status-row',cfg.noStatus);

  // IV/EV labels and ranges
  document.querySelectorAll('.pkdc-iv-hd').forEach(function(el){el.textContent=cfg.dvs?'DV':'IV';});
  document.querySelectorAll('.pkdc-ev-hd').forEach(function(el){el.textContent=cfg.dvs?'StatExp':'EV';});
  document.querySelectorAll('[id$="-iv-hp"],[id$="-iv-atk"],[id$="-iv-def"],[id$="-iv-spa"],[id$="-iv-spd"],[id$="-iv-spe"]').forEach(function(el){
    if(cfg.dvs){el.max='15';var v=parseInt(el.value,10)||0;if(v>15)el.value='15';}
    else{el.max='31';}
  });
  document.querySelectorAll('[id$="-ev-hp"],[id$="-ev-atk"],[id$="-ev-def"],[id$="-ev-spa"],[id$="-ev-spd"],[id$="-ev-spe"]').forEach(function(el){
    if(cfg.dvs){el.max='65535';el.step='1';}
    else{el.max='252';el.step='4';var v=parseInt(el.value,10)||0;if(v>252)el.value='252';}
  });

  // SpA label + hide SpD row for Gen1/2 (single Special stat)
  document.querySelectorAll('.pkdc-spa-lbl').forEach(function(el){el.textContent=cfg.specStat?'Spc':'SpA';});
  tog('.pkdc-spd-row',cfg.specStat);

  // Move flags
  tog('.pkdc-z-flag',     gen!==7);   // Z-Move: Gen 7 only
  tog('.pkdc-stellar-flag',gen!==9);  // Stellar type: Gen 9 only
  document.querySelectorAll('.pkdc-crit-flag').forEach(function(el){
    el.textContent=gen<=4?'Crit'+(gen<=2?' (High)':''):'Crit';
  });

  // Move type options: hide types not in this gen
  document.querySelectorAll('select.pkdc-sel option[value="fairy"]').forEach(function(o){o.style.display=cfg.noFairy?'none':'';o.disabled=!!cfg.noFairy;});
  document.querySelectorAll('select.pkdc-sel option[value="dark"]').forEach(function(o){o.style.display=cfg.noDark?'none':'';o.disabled=!!cfg.noDark;});
  document.querySelectorAll('select.pkdc-sel option[value="steel"]').forEach(function(o){o.style.display=cfg.noSteel?'none':'';o.disabled=!!cfg.noSteel;});
  // Reset Tera to 'none' if not Gen9
  document.querySelectorAll('select[id$="-te"]').forEach(function(sel){if(cfg.noTera)sel.value='none';});

  /* ══ FIELD: WEATHER ══
     Gen1: none (no weather)
     Gen2: sun/rain/sand (weatherBasic)
     Gen3–8: sun/rain/sand/hail
     Gen9: sun/rain/sand/snow (hail → snow) */
  var wAvail;
  if(cfg.noWeather)       wAvail=['none'];
  else if(cfg.weatherBasic)wAvail=['none','sun','rain','sand'];
  else if(gen===9)        wAvail=['none','sun','rain','sand','snow'];
  else                    wAvail=['none','sun','rain','sand','hail'];
  document.querySelectorAll('.pkdc-weather-btn').forEach(function(btn){
    var w=btn.getAttribute('data-w');
    if(wAvail.indexOf(w)===-1)btn.classList.add('pkdc-hide');
    else btn.classList.remove('pkdc-hide');
  });
  if(wAvail.indexOf(S.fld.w)===-1){
    S.fld.w='none';
    ['none','sun','rain','sand','snow','hail'].forEach(function(ww){var b=document.getElementById('pkdc-w-'+ww);if(b)b.classList.toggle('on',ww==='none');});
  }

  /* ══ FIELD: TERRAIN (Gen6+) ══ */
  var hasTerrain=!cfg.noTerrain&&gen>=6;
  tog('.pkdc-terrain-sec',!hasTerrain);
  if(!hasTerrain&&S.fld.tr!=='none'){
    S.fld.tr='none';
    ['none','electric','grassy','misty','psychic'].forEach(function(tt){var b=document.getElementById('pkdc-tr-'+tt);if(b)b.classList.toggle('on',tt==='none');});
  }

  /* ══ FIELD: CONDITIONS ══ */
  // Gravity: Gen 4+
  // Magic Room: Gen 5+ (BW) — swaps held items
  // Wonder Room: Gen 5+ (BW) — swaps Defense/Sp.Def
  var hasGravity=!cfg.noGravity;
  var hasMagicRoom=!cfg.noMagicRoom;
  var hasWonderRoom=!cfg.noWonderRoom;
  tog('#pkdc-fgrav',!hasGravity);
  tog('#pkdc-fmr',  !hasMagicRoom);
  tog('#pkdc-fwr',  !hasWonderRoom);
  // Hide the Conditions section header if all three are hidden
  var anyCondition=hasGravity||hasMagicRoom||hasWonderRoom;
  tog('.pkdc-gen4plus-sec',!anyCondition);
  // Reset hidden condition state
  if(!hasGravity){S.fld.grav=false;var eg=document.getElementById('pkdc-fgrav');if(eg)eg.classList.remove('on');}
  if(!hasMagicRoom){S.fld.mr=false;var em=document.getElementById('pkdc-fmr');if(em)em.classList.remove('on');}
  if(!hasWonderRoom){S.fld.wr=false;var ew=document.getElementById('pkdc-fwr');if(ew)ew.classList.remove('on');}

  /* ══ FIELD: SIDES ══ */
  // Reflect / Light Screen: Gen1+ (always visible — calcD applies scr for all gens)
  // gen-gated buttons inside pkdc-hazards-sec are hidden for Gen1 only
  tog('.pkdc-hazards-sec',gen<2);
  // Hazards (Spikes row): Gen2+
  tog('.pkdc-spikes-row',gen<2);
  if(gen<2){S.fld.p1.sp=0;S.fld.p2.sp=0;}

  // Stealth Rock: Gen4+
  tog('.pkdc-sr-btn',gen<4);
  if(gen<4){S.fld.p1.sr=false;S.fld.p2.sr=false;['p1','p2'].forEach(function(r){var b=document.getElementById('pkdc-'+r+'-sr');if(b)b.classList.remove('on');});}

  // Reflect / Light Screen: NOT hidden — they are outside pkdc-hazards-sec wrapper,
  // always shown and always applied in calcD (scr flag works for Gen1–9)

  // Aurora Veil: Gen7+
  tog('.pkdc-aurora-veil-btn',cfg.noAuroraVeil);
  if(cfg.noAuroraVeil){S.fld.p1.av=false;S.fld.p2.av=false;['p1','p2'].forEach(function(r){var b=document.getElementById('pkdc-'+r+'-av');if(b)b.classList.remove('on');});}

  // Steelsurge: Gen8+
  tog('.pkdc-steelsurge-btn',cfg.noSteelsurge);
  if(cfg.noSteelsurge){S.fld.p1.ss2=false;S.fld.p2.ss2=false;['p1','p2'].forEach(function(r){var b=document.getElementById('pkdc-'+r+'-ss2');if(b)b.classList.remove('on');});}

  // Salt Cure: Gen9+
  tog('.pkdc-saltcure-btn',cfg.noSaltCure);
  if(cfg.noSaltCure){S.fld.p1.sc=false;S.fld.p2.sc=false;['p1','p2'].forEach(function(r){var b=document.getElementById('pkdc-'+r+'-sc');if(b)b.classList.remove('on');});}

  // Leech Seed: Gen2+ (Gen1 has no held-item interaction)
  tog('.pkdc-leechseed-btn',gen<2);
  if(gen<2){S.fld.p1.lseed=false;S.fld.p2.lseed=false;['p1','p2'].forEach(function(r){var b=document.getElementById('pkdc-'+r+'-lseed');if(b)b.classList.remove('on');});}

  // Tailwind: Gen4+
  tog('.pkdc-tailwind-btn',cfg.noTailwind);
  if(cfg.noTailwind){S.fld.p1.tw=false;S.fld.p2.tw=false;['p1','p2'].forEach(function(r){var b=document.getElementById('pkdc-'+r+'-tw');if(b)b.classList.remove('on');});}

  // Helping Hand / Protect: Gen3+ (Doubles concepts)
  tog('.pkdc-helpinghand-btn',cfg.noHelpingHand);
  tog('.pkdc-protect-btn',cfg.noProtect);
  if(cfg.noHelpingHand){S.fld.p1.hh=false;S.fld.p2.hh=false;['p1','p2'].forEach(function(r){var b=document.getElementById('pkdc-'+r+'-hh');if(b)b.classList.remove('on');});}
  if(cfg.noProtect){S.fld.p1.prot=false;S.fld.p2.prot=false;['p1','p2'].forEach(function(r){var b=document.getElementById('pkdc-'+r+'-prot');if(b)b.classList.remove('on');});}

  // Friend Guard: Gen5+ Doubles only
  var showFG=!cfg.noFriendGuard&&S.fmt==='doubles';
  tog('.pkdc-friendguard-btn',!showFG);
  if(cfg.noFriendGuard){S.fld.p1.fg=false;S.fld.p2.fg=false;['p1','p2'].forEach(function(r){var b=document.getElementById('pkdc-'+r+'-fg');if(b)b.classList.remove('on');});}

  // Battery: Gen8+
  tog('.pkdc-battery-btn',cfg.noBattery);
  if(cfg.noBattery){S.fld.p1.bat=false;S.fld.p2.bat=false;['p1','p2'].forEach(function(r){var b=document.getElementById('pkdc-'+r+'-bat');if(b)b.classList.remove('on');});}

  // Power Spot: Gen8+
  tog('.pkdc-powerspot-btn',cfg.noPowerSpot);
  if(cfg.noPowerSpot){S.fld.p1.ps=false;S.fld.p2.ps=false;['p1','p2'].forEach(function(r){var b=document.getElementById('pkdc-'+r+'-ps');if(b)b.classList.remove('on');});}

  // Steely Spirit: Gen8+
  tog('.pkdc-steelspirit-btn',cfg.noSteelSpirit);
  if(cfg.noSteelSpirit){S.fld.p1.ssp=false;S.fld.p2.ssp=false;['p1','p2'].forEach(function(r){var b=document.getElementById('pkdc-'+r+'-ssp');if(b)b.classList.remove('on');});}

  // Foresight: Gen2+
  tog('.pkdc-foresight-btn',cfg.noForesight);
  if(cfg.noForesight){S.fld.p1.fore=false;S.fld.p2.fore=false;['p1','p2'].forEach(function(r){var b=document.getElementById('pkdc-'+r+'-fore');if(b)b.classList.remove('on');});}

  // Power Trick: Gen4+
  tog('.pkdc-powertrick-btn',cfg.noPowerTrick);
  if(cfg.noPowerTrick){S.fld.p1.ptrick=false;S.fld.p2.ptrick=false;['p1','p2'].forEach(function(r){var b=document.getElementById('pkdc-'+r+'-ptrick');if(b)b.classList.remove('on');});}

  // Vine Lash/Wildfire/Cannonade/Volcalith: Gen8+ Max Move effects
  tog('.pkdc-maxmove-btn',cfg.noMaxMoves);
  if(cfg.noMaxMoves){['vl','wf','cn','vc'].forEach(function(k){S.fld.p1[k]=false;S.fld.p2[k]=false;['p1','p2'].forEach(function(r){var b=document.getElementById('pkdc-'+r+'-'+k);if(b)b.classList.remove('on');});});}

  // Switching Out: Gen4+
  tog('.pkdc-switchingout-btn',cfg.noSwitchingOut);
  if(cfg.noSwitchingOut){S.fld.p1.so=false;S.fld.p2.so=false;['p1','p2'].forEach(function(r){var b=document.getElementById('pkdc-'+r+'-so');if(b)b.classList.remove('on');});}

  /* ══ DEFAULT IVs (DVs for Gen1/2) ══ */
  if(cfg.dvs){
    ['p1','p2'].forEach(function(role){
      SIDS.forEach(function(sid,i){
        var el=document.getElementById('pkdc-'+role+'-iv-'+sid);
        if(el){var v=parseInt(el.value,10)||0;if(v>15){el.value='15';}S[role].ivs[SKEYS[i]]=parseInt(el.value,10)||0;}
      });
    });
  }

  // Update level defaults
  ['p1','p2'].forEach(function(r){
    var le=document.getElementById('pkdc-'+r+'-lv');
    if(le&&!S[r].pkm){le.value=cfg.defaultLevel||100;S[r].lv=cfg.defaultLevel||100;}
  });

  // Recalculate stats + HP bar
  ['p1','p2'].forEach(function(r){updSt(r);updH(r);});

  // Gen label badge
  var genLbl=document.getElementById('pkdc-gen-lbl');
  if(genLbl)genLbl.textContent='[Gen '+gen+'] '+cfg.name;

  // Mode pills (doubles availability per gen)
  updateModePills(gen);
}

function updateModePills(gen){
  var mp=document.getElementById('pkdc-mode-row');
  if(!mp)return;
  // Gen 1/2 had no official Doubles format
  var hasDoubles=gen>=3;
  // Hide Doubles pill for gen 1/2
  var dblPill=document.querySelector('#pkdc-fmts .pkdc-pill[data-fmt="doubles"]');
  if(dblPill){
    dblPill.style.display=hasDoubles?'':'none';
    if(!hasDoubles&&S.fmt==='doubles'){
      // Switch back to singles
      document.querySelectorAll('#pkdc-fmts .pkdc-pill').forEach(function(x){x.classList.remove('on');});
      var sglPill=document.querySelector('#pkdc-fmts .pkdc-pill[data-fmt="singles"]');
      if(sglPill)sglPill.classList.add('on');
      applyFormat('singles');
    }
  }
  // All modes shown for all gens (Random Battles exist for all main gens)
  mp.querySelectorAll('.pkdc-mode-pill').forEach(function(b){b.classList.remove('pkdc-hide');});
  // If currently in random mode, update the locked level for new gen
  if(S.mode==='random'){applyMode('random');}
}

/* ── Pills ── */
document.querySelectorAll('#pkdc-gens .pkdc-pill').forEach(function(b){
  b.addEventListener('click',function(){
    document.querySelectorAll('#pkdc-gens .pkdc-pill').forEach(function(x){x.classList.remove('on');});
    b.classList.add('on');
    applyGen(parseInt(b.getAttribute('data-gen'),10)||9);
  });
});
/* ══════════════════════════════════════════════════════
   FORMAT: Singles vs Doubles — affects spread damage,
   doubles-only field options visibility, Friend Guard
══════════════════════════════════════════════════════ */
function applyFormat(fmt){
  S.fmt=fmt;
  var isDbl=fmt==='doubles';
  var root=document.getElementById('pkdc-root');
  if(root){root.classList.toggle('is-doubles',isDbl);}
  // Show/hide doubles-only field options
  document.querySelectorAll('.pkdc-doubles-only').forEach(function(el){
    el.style.display=isDbl?'':'none';
  });
  // Update format indicator in results head
  updateResultBadges();
}

/* ══════════════════════════════════════════════════════
   RANDOM BATTLES level presets per generation
   Based on Smogon Random Battles standard levels
══════════════════════════════════════════════════════ */
var RAND_LV={1:100,2:100,3:100,4:100,5:100,6:50,7:50,8:100,9:100};

function applyMode(mode){
  S.mode=mode;
  var note=document.getElementById('pkdc-mode-note');
  var notes={
    '1v1':  '',
    '1vall':T.mode_note_1vall||'One attacker vs. all Pokémon — select your attacker and move only.',
    'allv1':T.mode_note_allv1||'All 4 moves vs. one defender — results shown per move.',
    'random':T.mode_note_rand||'Random Battles: levels locked to gen standard. All 252 EV / 31 IV presets removed.'
  };
  var isRand=mode==='random';
  var is1vA=mode==='1vall';

  // Show/hide mode note
  if(note){
    note.textContent=notes[mode]||'';
    note.classList.toggle('show',!!(notes[mode]));
  }

  // Random Battles: lock levels, clear EVs, set 31 IVs
  var lv=RAND_LV[S.gen]||100;
  ['p1','p2'].forEach(function(r){
    var lvEl=document.getElementById('pkdc-'+r+'-lv');
    var lockEl=document.getElementById('pkdc-'+r+'-lv-lock');
    if(lvEl){
      if(isRand){
        lvEl.value=lv;lvEl.readOnly=true;lvEl.classList.add('pkdc-lv-locked');
        S[r].lv=lv;
        // Clear EVs for Random Battles (mons have none)
        ['hp','atk','def','spa','spd','spe'].forEach(function(sid){
          var evEl=document.getElementById('pkdc-'+r+'-ev-'+sid);
          if(evEl){evEl.value='0';}
          S[r].evs[['hp','attack','defense','special-attack','special-defense','speed'][['hp','atk','def','spa','spd','spe'].indexOf(sid)]]=0;
        });
        updSt(r);updH(r);
      } else {
        lvEl.readOnly=false;lvEl.classList.remove('pkdc-lv-locked');
      }
    }
    if(lockEl){lockEl.classList.toggle('show',isRand);}
  });

  // 1vAll mode: P2 panel search not required
  var p2panel=document.getElementById('pkdc-p2-panel');
  if(p2panel){
    var p2search=document.getElementById('pkdc-p2-si');
    if(p2search){p2search.placeholder=is1vA?(T.p2_optional||'(optional for 1vAll)'):(T.search_ph||'Search Pokémon...');}
  }

  updateResultBadges();
}

function updateResultBadges(){
  var el=document.getElementById('pkdc-rbadges');
  if(!el)return;
  var html='';
  // Format badge
  html+='<span class="pkdc-rbadge'+(S.fmt==='doubles'?' pkdc-rbadge-dbl':'')+'">'+
    (S.fmt==='doubles'?(T.doubles||'Doubles'):(T.singles||'Singles'))+'</span>';
  // Mode badge (only show non-default)
  if(S.mode!=='1v1'){
    var mLabels={'1vall':(T.one_v_all||'1vAll'),'allv1':(T.all_v_one||'All v1'),'random':(T.mode_rand_badge||'Rand')};
    html+='<span class="pkdc-rbadge pkdc-rbadge-rand">'+(mLabels[S.mode]||S.mode)+'</span>';
  }
  el.innerHTML=html;
}

document.querySelectorAll('#pkdc-fmts .pkdc-pill').forEach(function(b){
  b.addEventListener('click',function(){
    document.querySelectorAll('#pkdc-fmts .pkdc-pill').forEach(function(x){x.classList.remove('on');});
    b.classList.add('on');
    applyFormat(b.getAttribute('data-fmt'));
  });
});
document.querySelectorAll('#pkdc-mode-row .pkdc-mode-pill').forEach(function(b){
  b.addEventListener('click',function(){
    document.querySelectorAll('#pkdc-mode-row .pkdc-mode-pill').forEach(function(x){x.classList.remove('on');});
    b.classList.add('on');
    applyMode(b.getAttribute('data-mode'));
  });
});

/* ── Search ── */
function buildDD(q,dEl,cb){
  if(!q||q.length<2){dEl.innerHTML='';dEl.classList.remove('open');return;}
  var ql=q.toLowerCase().trim();
  var h=D.filter(function(p){return p.name.toLowerCase().indexOf(ql)===0;}).slice(0,8);
  if(!h.length)h=D.filter(function(p){return p.name.toLowerCase().indexOf(ql)!==-1;}).slice(0,8);
  if(!h.length){dEl.innerHTML='<div class="pkdc-nores">'+(T.err_no_res||'No results.')+'</div>';dEl.classList.add('open');return;}
  dEl.innerHTML=h.map(function(p){return'<div class="pkdc-ddi" data-id="'+p.id+'" role="option" tabindex="-1"><img src="'+(p.sprite||'')+'" alt="" loading="lazy" onerror="this.style.display=\'none\'"><span class="pkdc-ddi-n">'+uc(p.name)+'</span><span class="pkdc-ddi-t">'+(p.types||[]).map(tb).join('')+'</span></div>';}).join('');
  dEl.classList.add('open');
  dEl.querySelectorAll('.pkdc-ddi').forEach(function(el){
    el.addEventListener('mousedown',function(e){e.preventDefault();var pkm=D.find(function(p){return p.id===parseInt(el.getAttribute('data-id'),10);});if(pkm)cb(pkm);});
  });
}
function wireS(iEl,dEl,role){
  if(!iEl||!dEl)return;
  iEl.addEventListener('input',function(){deb('s'+role,function(){buildDD(iEl.value,dEl,function(p){selP(p,role);});},160);});
  iEl.addEventListener('focus',function(){if(iEl.value.length>=2)buildDD(iEl.value,dEl,function(p){selP(p,role);});});
  iEl.addEventListener('keydown',function(e){
    var its=dEl.querySelectorAll('.pkdc-ddi'),act=dEl.querySelector('.pkdc-ddi.kb'),idx=act?Array.prototype.indexOf.call(its,act):-1;
    if(e.key==='ArrowDown'){e.preventDefault();if(!its.length)return;if(act)act.classList.remove('kb');idx=(idx+1)%its.length;its[idx].classList.add('kb');its[idx].scrollIntoView({block:'nearest'});}
    else if(e.key==='ArrowUp'){e.preventDefault();if(!its.length)return;if(act)act.classList.remove('kb');idx=(idx-1+its.length)%its.length;its[idx].classList.add('kb');its[idx].scrollIntoView({block:'nearest'});}
    else if(e.key==='Enter'&&act){e.preventDefault();var pkm=D.find(function(p){return p.id===parseInt(act.getAttribute('data-id'),10);});if(pkm)selP(pkm,role);}
    else if(e.key==='Escape'){dEl.innerHTML='';dEl.classList.remove('open');}
  });
}
document.addEventListener('mousedown',function(e){
  ['p1','p2'].forEach(function(r){var d=g('pkdc-'+r+'-drop'),i=g('pkdc-'+r+'-si');if(d&&i&&!d.contains(e.target)&&e.target!==i){d.innerHTML='';d.classList.remove('open');}});
});
wireS(g('pkdc-p1-si'),g('pkdc-p1-drop'),'p1');
wireS(g('pkdc-p2-si'),g('pkdc-p2-drop'),'p2');

function selP(pkm,role){
  S[role].pkm=pkm;
  var i=g('pkdc-'+role+'-si'),d=g('pkdc-'+role+'-drop'),pv=g('pkdc-'+role+'-prev'),spr=g('pkdc-'+role+'-spr'),nm=g('pkdc-'+role+'-nm'),ty=g('pkdc-'+role+'-ty');
  if(i)i.value=uc(pkm.name);
  if(d){d.innerHTML='';d.classList.remove('open');}
  if(spr){spr.onerror=function(){this.style.display='none';};spr.src=pkm.sprite||'';}
  if(nm)nm.textContent=uc(pkm.name);
  if(ty)ty.innerHTML=(pkm.types||[]).map(tb).join('');
  if(pv)pv.classList.add('show');
  updSt(role);updH(role);
}

function updSt(role){
  var st=S[role],pkm=st.pkm,gen=S.gen,cfg=GEN_CFG[gen]||GEN_CFG[9];
  SKEYS.forEach(function(key,i){
    var sid=SIDS[i];
    var base=pkm?pkmStat(pkm,key):0;
    // Gen1/2: SpA and SpD share "Special" stat
    if(cfg.specStat&&(key==='special-defense'))return;
    if(cfg.specStat&&key==='special-attack'){base=pkm?Math.max(pkmStat(pkm,'special_attack'),pkmStat(pkm,'special-attack')):0;}
    var bEl=g('pkdc-'+role+'-bs-'+sid),tEl=g('pkdc-'+role+'-ts-'+sid);
    if(bEl)bEl.textContent=base||'—';
    if(tEl&&pkm){
      var evVal=st.evs[key]||0,ivVal=st.ivs[key]!==undefined?st.ivs[key]:(cfg.dvs?15:31);
      var tot=cstMod(base,evVal,ivVal,st.lv||100,st.nat||'Hardy',key,gen);
      tEl.textContent=tot;
      var nm=(gen>=3&&NAT[st.nat||'Hardy']&&NAT[st.nat||'Hardy'][key])||1;
      tEl.className='pkdc-stot'+(nm>1?' bst':nm<1?' drp':'');
    }else if(tEl){tEl.textContent='—';tEl.className='pkdc-stot';}
  });
}

function updH(role){
  var st=S[role],pkm=st.pkm,gen=S.gen,cfg=GEN_CFG[gen]||GEN_CFG[9];
  if(!pkm)return;
  var hb=pkmStat(pkm,'hp');
  var ivH=st.ivs.hp!==undefined?st.ivs.hp:(cfg.dvs?15:31);
  var mhp=cstMod(hb,st.evs.hp||0,ivH,st.lv||100,st.nat||'Hardy','hp',gen);
  var cur=st.chp!==null?Math.max(0,Math.min(mhp,st.chp)):mhp;
  var pct=mhp>0?Math.round(cur/mhp*100):100;
  var fEl=g('pkdc-'+role+'-hf'),pEl=g('pkdc-'+role+'-hp'),mEl=g('pkdc-'+role+'-hm');
  if(fEl){fEl.style.width=pct+'%';fEl.className='pkdc-hfill'+(pct>50?'':pct>25?' med':' low');}
  if(pEl)pEl.textContent=pct+'%';
  if(mEl)mEl.textContent='/'+mhp;
}

/* Wire Pokémon panel inputs */
['p1','p2'].forEach(function(r){
  SKEYS.forEach(function(key,i){
    var sid=SIDS[i];
    var ev=g('pkdc-'+r+'-ev-'+sid),iv=g('pkdc-'+r+'-iv-'+sid);
    if(ev)ev.addEventListener('input',function(){var v=parseInt(this.value,10);S[r].evs[key]=isNaN(v)?0:Math.max(0,v);updSt(r);updH(r);});
    if(iv)iv.addEventListener('input',function(){var v=parseInt(this.value,10);S[r].ivs[key]=isNaN(v)?0:Math.max(0,v);updSt(r);updH(r);});
  });
  var lv=g('pkdc-'+r+'-lv');if(lv)lv.addEventListener('input',function(){var v=parseInt(this.value,10);S[r].lv=(isNaN(v)||v<1||v>100)?100:v;updSt(r);updH(r);});
  var nt=g('pkdc-'+r+'-nat');if(nt)nt.addEventListener('change',function(){S[r].nat=this.value;updSt(r);updH(r);});
  var ab=g('pkdc-'+r+'-ab');if(ab)ab.addEventListener('input',function(){S[r].ab=this.value;});
  var it=g('pkdc-'+r+'-it');if(it)it.addEventListener('input',function(){S[r].item=this.value;});
  var st=g('pkdc-'+r+'-st');if(st)st.addEventListener('change',function(){S[r].st=this.value;});
  var te=g('pkdc-'+r+'-te');if(te)te.addEventListener('change',function(){S[r].tera=this.value;});
  var hc=g('pkdc-'+r+'-hc');if(hc)hc.addEventListener('input',function(){var v=parseInt(this.value,10);S[r].chp=isNaN(v)?null:Math.max(0,v);updH(r);});
  function mkStg(uId,dId,vId,key){
    var u=g(uId),d=g(dId),v=g(vId);
    function upd(){if(v){v.textContent=(S[r][key]>0?'+':'')+S[r][key];v.className='pkdc-sval'+(S[r][key]>0?' up':S[r][key]<0?' dn':'');}}
    if(u)u.addEventListener('click',function(){if(S[r][key]<6)S[r][key]++;upd();});
    if(d)d.addEventListener('click',function(){if(S[r][key]>-6)S[r][key]--;upd();});
  }
  mkStg('pkdc-'+r+'-au','pkdc-'+r+'-ad','pkdc-'+r+'-av','as');
  mkStg('pkdc-'+r+'-du','pkdc-'+r+'-dd','pkdc-'+r+'-dv','ds');
  for(var mi=0;mi<4;mi++){(function(idx){
    var mn=g('pkdc-'+r+'-m'+idx+'n'),bp=g('pkdc-'+r+'-m'+idx+'b'),mt=g('pkdc-'+r+'-m'+idx+'t'),mc=g('pkdc-'+r+'-m'+idx+'c');
    var cr=g('pkdc-'+r+'-m'+idx+'cr'),zm=g('pkdc-'+r+'-m'+idx+'z'),ss=g('pkdc-'+r+'-m'+idx+'s'),ub=g('pkdc-'+r+'-m'+idx+'u');
    if(mn)mn.addEventListener('input',function(){S[r].mv[idx].n=this.value;});
    if(bp)bp.addEventListener('input',function(){var v=parseInt(this.value,10);S[r].mv[idx].bp=isNaN(v)?80:Math.max(1,Math.min(999,v));});
    if(mt)mt.addEventListener('change',function(){S[r].mv[idx].t=this.value;});
    if(mc)mc.addEventListener('change',function(){S[r].mv[idx].c=this.value;});
    if(cr)cr.addEventListener('click',function(){S[r].mv[idx].cr=!S[r].mv[idx].cr;cr.classList.toggle('on',S[r].mv[idx].cr);});
    if(zm)zm.addEventListener('click',function(){S[r].mv[idx].z=!S[r].mv[idx].z;zm.classList.toggle('on',S[r].mv[idx].z);});
    if(ss)ss.addEventListener('click',function(){S[r].mv[idx].st2=!S[r].mv[idx].st2;ss.classList.toggle('on',S[r].mv[idx].st2);});
    if(ub)ub.addEventListener('click',function(){for(var j=0;j<4;j++){var b=g('pkdc-'+r+'-m'+j+'u');if(b)b.classList.remove('sel');}ub.classList.add('sel');S[r].am=idx;});
  })(mi);}
  var f0=g('pkdc-'+r+'-m0u');if(f0)f0.classList.add('sel');
});

/* Field wiring */
['none','sun','rain','sand','snow','hail'].forEach(function(w){
  var el=g('pkdc-w-'+w);if(!el)return;
  el.addEventListener('click',function(){S.fld.w=w;['none','sun','rain','sand','snow','hail'].forEach(function(ww){var b=g('pkdc-w-'+ww);if(b)b.classList.toggle('on',ww===w);});});
});
['none','electric','grassy','misty','psychic'].forEach(function(tr){
  var el=g('pkdc-tr-'+tr);if(!el)return;
  el.addEventListener('click',function(){S.fld.tr=tr;['none','electric','grassy','misty','psychic'].forEach(function(tt){var b=g('pkdc-tr-'+tt);if(b)b.classList.toggle('on',tt===tr);});});
});
[['pkdc-fgrav','grav'],['pkdc-fmr','mr'],['pkdc-fwr','wr']].forEach(function(p){
  var el=g(p[0]);if(!el)return;
  el.addEventListener('click',function(){S.fld[p[1]]=!S.fld[p[1]];el.classList.toggle('on',S.fld[p[1]]);});
});
var SIDEKEYS=['sr','ss2','ref','ls','av','tw','hh','fg','bat','ps','ssp','prot','lseed','sc','fore','ptrick','vl','wf','cn','vc','so'];
['p1','p2'].forEach(function(r){
  SIDEKEYS.forEach(function(k){var el=g('pkdc-'+r+'-'+k);if(!el)return;el.addEventListener('click',function(){S.fld[r][k]=!S.fld[r][k];el.classList.toggle('on',S.fld[r][k]);});});
  for(var n=0;n<=3;n++){(function(cnt){var el=g('pkdc-'+r+'-spk'+cnt);if(!el)return;el.addEventListener('click',function(){S.fld[r].sp=cnt;for(var j=0;j<=3;j++){var b=g('pkdc-'+r+'-spk'+j);if(b)b.classList.toggle('on',j===cnt);}});})(n);}
});

/* ── Validate ── */
function val(){
  var e=[];
  if(!S.p1.pkm)e.push(T.err_atk||'Select attacker.');
  if(S.mode!=='1vall'&&!S.p2.pkm)e.push(T.err_def||'Select defender.');
  var mv=S.p1.mv[S.p1.am]||{};
  if(!mv.bp||mv.bp<1||mv.bp>999)e.push(T.err_bp||'Base Power 1–999.');
  if(S.p1.lv<1||S.p1.lv>100)e.push(T.err_level||'Level 1–100.');
  if(S.p2.lv<1||S.p2.lv>100)e.push(T.err_level||'Level 1–100.');
  return e;
}
function showE(errs){
  var el=g('pkdc-verrs');if(!el)return;
  if(!errs.length){el.classList.remove('show');el.innerHTML='';return;}
  el.innerHTML=errs.map(function(e){return'<li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>'+e+'</li>';}).join('');
  el.classList.add('show');
}

/* ── Calculate ── */
function doCalc(){
  var errs=val();showE(errs);if(errs.length)return;
  var atk=S.p1,def=S.p2,fld=S.fld,gen=S.gen,cfg=GEN_CFG[gen]||GEN_CFG[9];
  var mv=atk.mv[atk.am]||{bp:80,t:'',c:'physical'};
  var cat=mv.c||'physical',ap=atk.pkm,dp=def.pkm;

  // Gen1/2: use Special for SpA/SpD
  var ak,dk;
  if(cfg.specStat){ak='special-attack';dk='special-attack';}
  else{ak=cat==='physical'?'attack':'special-attack';dk=cat==='physical'?'defense':'special-defense';}

  var ab=pkmStat(ap,ak),db2=pkmStat(dp,dk),hb=pkmStat(dp,'hp');
  var ivA=atk.ivs[ak]!==undefined?atk.ivs[ak]:(cfg.dvs?15:31);
  var ivD=def.ivs[dk]!==undefined?def.ivs[dk]:(cfg.dvs?15:31);
  var ivH=def.ivs.hp!==undefined?def.ivs.hp:(cfg.dvs?15:31);

  var as2=cstMod(ab,atk.evs[ak]||0,ivA,atk.lv||100,atk.nat||'Hardy',ak,gen);
  var ds2=cstMod(db2,def.evs[dk]||0,ivD,def.lv||100,def.nat||'Hardy',dk,gen);
  var dhp=cstMod(hb,def.evs.hp||0,ivH,def.lv||100,def.nat||'Hardy','hp',gen);
  if(def.chp!==null&&def.chp!==undefined)dhp=Math.max(1,def.chp);

  as2=Math.max(1,Math.floor(as2*stg(atk.as||0)));
  ds2=Math.max(1,Math.floor(ds2*stg(def.ds||0)));

  // Wonder Room: swap def/spdef
  if(fld.wr&&gen>=5){var altk=cat==='physical'?'special-defense':'defense';var alb=pkmStat(dp,altk);var ivAlt=def.ivs[altk]!==undefined?def.ivs[altk]:(cfg.dvs?15:31);ds2=Math.max(1,Math.floor(cstMod(alb,def.evs[altk]||0,ivAlt,def.lv||100,def.nat||'Hardy',altk,gen)*stg(def.ds||0)));}

  var mt=mv.t||'';
  var wb=(fld.w==='sun'&&mt==='fire')||(fld.w==='rain'&&mt==='water');
  var wn=(fld.w==='sun'&&mt==='water')||(fld.w==='rain'&&mt==='fire');
  var tb2=gen>=6&&((fld.tr==='electric'&&mt==='electric')||(fld.tr==='grassy'&&mt==='grass')||(fld.tr==='psychic'&&mt==='psychic'));
  var scr=(cat==='physical'&&(fld.p2.ref||fld.p2.av))||(cat==='special'&&(fld.p2.ls||fld.p2.av));
  var stabOn=isSTAB(mt,ap.types||[],atk.tera,gen);
  var dts=dp.types||[];if(gen>=9&&def.tera&&def.tera!=='none')dts=[def.tera];
  var te=teff(mt,dts,gen);if(wn)te*=0.5;
  var burn=(atk.st==='burn')&&(cat==='physical');
  var dbl=S.fmt==='doubles';

  // Collect active modifiers for display
  var mods=[];
  if(S.fmt==='doubles')mods.push(T.mod_doubles||'Doubles (0.75× spread)');
  if(wb)mods.push(fld.w==='sun'?(T.mod_sun_boost||'☀ Sun boost'):(T.mod_rain_boost||'🌧 Rain boost'));
  if(wn)mods.push(fld.w==='sun'?(T.mod_sun_penalty||'☀ Sun penalty'):(T.mod_rain_penalty||'🌧 Rain penalty'));
  if(tb2)mods.push(T.mod_terrain||'Terrain boost (×1.3)');
  if(scr)mods.push(cat==='physical'?(T.mod_reflect||'Reflect'):(T.mod_lightscreen||'Light Screen'));
  if(fld.p2.av)mods.push(T.mod_aurora_veil||'Aurora Veil');
  if(stabOn)mods.push(T.mod_stab||'STAB (×1.5)');
  if(mv.cr)mods.push(T.mod_crit||'Critical Hit');
  if(burn)mods.push(T.mod_burn||'Burn (×0.5 Phys)');
  if(fld.p1.hh)mods.push(T.mod_helping_hand||'Helping Hand (×1.5)');
  if(dbl&&fld.p2.fg)mods.push(T.mod_friend_guard||'Friend Guard (×0.75)');
  if(gen>=6&&fld.p1.bat&&cat==='special')mods.push(T.mod_battery||'Battery (×1.3)');
  if(gen>=8&&fld.p1.ps)mods.push(T.mod_power_spot||'Power Spot (×1.3)');
  if(gen>=8&&fld.p1.ssp&&mt==='steel')mods.push(T.mod_steely_spirit||'Steely Spirit (×1.5)');
  if(gen===7&&mv.z)mods.push(T.mod_zmove||'Z-Move');
  if(S.mode==='random')mods.push((T.mode_rand_lv||'Random Battles Lv ')+(RAND_LV[gen]||100));
  if(fld.grav)mods.push(T.mod_gravity||'Gravity');
  if(fld.wr)mods.push(T.mod_wonder_room||'Wonder Room');

  var res=calcD({lv:atk.lv||100,bp:mv.bp||80,atk:as2,def:ds2,hp:dhp,stab:stabOn,crit:mv.cr,te:te,wb:wb,wn:wn,tb:tb2,burn:burn,scr:scr,dbl:dbl,hh:fld.p1.hh,fg:dbl&&fld.p2.fg,bat:gen>=6&&fld.p1.bat&&cat==='special',ps:gen>=8&&fld.p1.ps,ss:gen>=8&&fld.p1.ssp&&mt==='steel',zm:gen===7&&mv.z,gen:gen,item_mult:1});
  if(!res){showE([T.err_stat||'Calculation error.']);return;}

  S.last={res:res,atk:atk,def:def,ap:ap,dp:dp,mv:mv,cat:cat,ak:ak,dk:dk,te:te,gen:gen,mods:mods,dbl:dbl};
  renderR(S.last);
}

function renderR(lr){
  var res=lr.res,atk=lr.atk,def=lr.def,ap=lr.ap,dp=lr.dp,mv=lr.mv,cat=lr.cat,ak=lr.ak,dk=lr.dk;
  var aev=atk.evs[ak]||0,dev=def.evs[dk]||0,hev=def.evs.hp||0;
  var alk=cat==='physical'?'Atk':'SpA',dlk=cat==='physical'?'Def':'SpD';
  // Smogon-style summary line
  var genCfg=GEN_CFG[lr.gen]||GEN_CFG[9];
  var atkNat=genCfg.noNature?'':((atk.nat&&atk.nat!=='Hardy')?atk.nat+' ':'');
  var sum=aev+' '+atkNat+alk+' '+uc(ap.name)+' '+(mv.n||'Move')+
    (lr.dbl?' [Doubles]':'')+
    ' vs. '+hev+' HP / '+dev+' '+dlk+' '+uc(dp.name)+
    ': '+res.mn+'–'+res.mx+' ('+res.mnP+'–'+res.mxP+'%)';
  var rs=g('pkdc-rsum');if(rs)rs.textContent=sum;

  // Context tags (format + mode)
  var ctxEl=g('pkdc-rctx');
  if(ctxEl){
    var ctxTags=[];
    ctxTags.push('<span class="pkdc-rctx-tag">'+(S.fmt==='doubles'?(T.fmt_doubles||'⚡ Doubles'):(T.fmt_singles||'👤 Singles'))+'</span>');
    var modeLabels={'1v1':'1v1','1vall':(T.mode_1vsall||'1 vs All'),'allv1':(T.mode_allvs1||'All vs 1'),'random':(T.mode_rand_lv||'Random Battles Lv ')+(RAND_LV[lr.gen]||100)};
    if(S.mode!=='1v1')ctxTags.push('<span class="pkdc-rctx-tag warn">'+modeLabels[S.mode]+'</span>');
    var genCfgName=(GEN_CFG[lr.gen]||{}).label||('Gen '+lr.gen);
    ctxTags.push('<span class="pkdc-rctx-tag">'+genCfgName+'</span>');
    if(lr.dbl)ctxTags.push('<span class="pkdc-rctx-tag warn">'+(T.spread_applied||'⚠ Spread ×0.75 applied')+'</span>');
    ctxEl.innerHTML=ctxTags.join('');
    ctxEl.style.display='flex';
  }

  // Rolls
  var rl=g('pkdc-rolls');if(rl)rl.innerHTML=res.rolls.map(function(r,i){var c='pkdc-roll'+(i===0?' mn':i===res.rolls.length-1?' mx':'');return'<span class="'+c+'">'+r+'</span>';}).join('');
  // Roll range label
  var rr=g('pkdc-roll-range');if(rr)rr.textContent=res.mn+' – '+res.mx+' ('+res.rolls.length+(T.rolls_label||' rolls)');

  // HP %
  var pp=g('pkdc-rpct');if(pp)pp.textContent=res.mnP+'–'+res.mxP+'%';
  var bf=g('pkdc-rbar');if(bf)bf.style.width=Math.min(100,res.avgP)+'%';

  // KO labels
  var kl=g('pkdc-kolbl'),kb=g('pkdc-kobdg');
  if(kl&&kb){
    var kt,kc;
    if(res.gO){kt=T.ohko||'1HKO';kc='pkdc-kog';}
    else if(res.pO){kt=T.ohko||'1HKO';kc='pkdc-kop';}
    else if(res.g2){kt=T['2hko']||'2HKO';kc='pkdc-kog';}
    else if(res.p2){kt=T['2hko']||'2HKO';kc='pkdc-kop';}
    else if(res.g3){kt=T['3hko']||'3HKO';kc='pkdc-kog';}
    else if(res.p3){kt=T['3hko']||'3HKO';kc='pkdc-kop';}
    else{kt=T.ko_none||'Does Not KO';kc='pkdc-kon';}
    kl.textContent=kt;
    kb.className='pkdc-kobdg '+kc;
    kb.textContent=kc==='pkdc-kog'?(T.guaranteed||'Guaranteed'):kc==='pkdc-kop'?(T.possible||'Possible'):(T.cannot_ko||'Cannot KO');
  }

  // 2HKO roll-by-roll chance (how many pairs of hits KO)
  var ko2row=g('pkdc-ko2row'),ko2pct=g('pkdc-ko2pct');
  if(ko2row&&ko2pct){
    // Only show if it's a potential 2HKO (not 1HKO guaranteed)
    if(!res.gO&&(res.g2||res.p2)){
      var totalPairs=res.rolls.length*res.rolls.length;
      var koingPairs=0;
      var hp2=atk.chp!==null&&atk.chp!==undefined?atk.chp:res.rolls[res.rolls.length-1]; // approx
      // Count pairs where both hits combined >= defender HP
      for(var ri=0;ri<res.rolls.length;ri++){
        for(var rj=0;rj<res.rolls.length;rj++){
          // Use max HP since we don't know exact after first hit
          // Standard 2HKO calc: both hits together
          if(res.rolls[ri]+res.rolls[rj]>=(res.rolls[0]+res.rolls[res.rolls.length-1])){}
        }
      }
      // Simplified: what % of second rolls would KO assuming first hit was average
      var avgDmg=res.avg||res.mn;
      var remainHP=Math.max(1,res.rolls[res.rolls.length-1]); // use max dmg to get best case
      var ko2count=res.rolls.filter(function(r){return r+avgDmg>=res.rolls[res.rolls.length-1]*2;}).length;
      var ko2chance=Math.round(ko2count/res.rolls.length*100);
      ko2pct.textContent=ko2chance+(T.ko2_chance||'% chance to 2HKO (avg hit + roll)');
      ko2row.style.display='flex';
    } else {
      ko2row.style.display='none';
    }
  }

  // Type effectiveness
  var eb=g('pkdc-effbdg');if(eb){
    var teLabel=lr.te===0?(T.immune||'Immune'):lr.te+'×';
    eb.textContent=teLabel;
    eb.className='pkdc-effb '+ec(lr.te);
  }

  // Active modifiers
  var modrow=g('pkdc-modrow'),modlist=g('pkdc-modlist');
  if(modrow&&modlist){
    if(lr.mods&&lr.mods.length){
      modlist.innerHTML=lr.mods.map(function(m){return'<span class="pkdc-modbadge">'+m+'</span>';}).join('');
      modrow.style.display='block';
    } else {
      modrow.style.display='none';
    }
  }

  // Update result header badges
  updateResultBadges();

  var rc=g('pkdc-res');if(rc){rc.classList.add('show');rc.scrollIntoView({behavior:'smooth',block:'nearest'});}
}

/* Copy — includes format and mode context */
var cpBtn=g('pkdc-copy');
if(cpBtn)cpBtn.addEventListener('click',function(){
  if(!S.last)return;
  var lr=S.last,res=lr.res,mv=lr.mv,cat=lr.cat,ak=lr.ak,dk=lr.dk;
  var alk=cat==='physical'?'Atk':'SpA',dlk=cat==='physical'?'Def':'SpD';
  var genCfg=GEN_CFG[lr.gen]||GEN_CFG[9];
  var atkNat=genCfg.noNature?'':((lr.atk.nat&&lr.atk.nat!=='Hardy')?lr.atk.nat+' ':'');
  var txt=(lr.atk.evs[ak]||0)+' '+atkNat+alk+' '+uc(lr.ap.name)+' '+(mv.n||'Move')+
    (lr.dbl?' [Doubles]':'')+
    ' vs. '+(lr.def.evs.hp||0)+' HP / '+(lr.def.evs[dk]||0)+' '+dlk+' '+uc(lr.dp.name)+
    ': '+res.mn+'–'+res.mx+' ('+res.mnP+'–'+res.mxP+'%)'+
    (S.mode==='random'?' ['+(T.mode_rand_lv||'Random Battles Lv ')+(RAND_LV[lr.gen]||100)+']':'')+
    ' — '+res.mnP+'–'+res.mxP+'% '+(res.gO?(T.ohko||'1HKO'):res.g2?(T['2hko']||'2HKO'):'KO');
  if(navigator.clipboard){navigator.clipboard.writeText(txt).then(function(){cpBtn.textContent=T.copied||'Copied!';setTimeout(function(){cpBtn.textContent=T.copy||'Copy';},2000);});}
  else{var ta=document.createElement('textarea');ta.value=txt;document.body.appendChild(ta);ta.select();document.execCommand('copy');document.body.removeChild(ta);cpBtn.textContent=T.copied||'Copied!';setTimeout(function(){cpBtn.textContent=T.copy||'Copy';},2000);}
});

/* Reset */
function doReset(){
  var cfg=GEN_CFG[S.gen]||GEN_CFG[9];
  var defaultIV=cfg.dvs?'15':'31';
  ['p1','p2'].forEach(function(r){S[r]=mkS();var i=g('pkdc-'+r+'-si'),d=g('pkdc-'+r+'-drop'),pv=g('pkdc-'+r+'-prev');if(i)i.value='';if(d){d.innerHTML='';d.classList.remove('open');}if(pv)pv.classList.remove('show');['lv','nat','ab','it','st','te'].forEach(function(k){var el=g('pkdc-'+r+'-'+k);if(el){if(k==='lv')el.value=cfg.defaultLevel||100;else if(k==='nat')el.value='Hardy';else if(k==='st'||k==='te')el.value='none';else el.value='';}});['av','dv'].forEach(function(v){var el=g('pkdc-'+r+'-'+v);if(el){el.textContent='0';el.className='pkdc-sval';}});var hc=g('pkdc-'+r+'-hc');if(hc)hc.value='';var hf=g('pkdc-'+r+'-hf');if(hf){hf.style.width='100%';hf.className='pkdc-hfill';}var hp=g('pkdc-'+r+'-hp');if(hp)hp.textContent='100%';var hm=g('pkdc-'+r+'-hm');if(hm)hm.textContent='';SIDS.forEach(function(sid){var ev=g('pkdc-'+r+'-ev-'+sid),iv=g('pkdc-'+r+'-iv-'+sid),bs=g('pkdc-'+r+'-bs-'+sid),ts=g('pkdc-'+r+'-ts-'+sid);if(ev)ev.value='0';if(iv)iv.value=defaultIV;if(bs)bs.textContent='—';if(ts){ts.textContent='—';ts.className='pkdc-stot';}});
    // Unlock level field (in case Random Battles mode was active)
    var lvEl=g('pkdc-'+r+'-lv');var lockEl=g('pkdc-'+r+'-lv-lock');
    if(lvEl){lvEl.readOnly=false;lvEl.classList.remove('pkdc-lv-locked');}
    if(lockEl){lockEl.classList.remove('show');}
    for(var mi=0;mi<4;mi++){['n','b','t','c','cr','z','s','u'].forEach(function(s){var el=g('pkdc-'+r+'-m'+mi+s);if(el){if(s==='b')el.value='80';else if(s==='t'||s==='c'){el.value=s==='c'?'physical':'';}else if(s==='n')el.value='';else if(s==='u')el.classList.remove('sel');else el.classList.remove('on');}});}var f0=g('pkdc-'+r+'-m0u');if(f0)f0.classList.add('sel');});
  S.fld=mkF();
  document.querySelectorAll('.pkdc-fb,.pkdc-spbtn').forEach(function(b){b.classList.remove('on');});
  var wn=g('pkdc-w-none');if(wn)wn.classList.add('on');
  var tn=g('pkdc-tr-none');if(tn)tn.classList.add('on');
  ['p1','p2'].forEach(function(r){var s=g('pkdc-'+r+'-spk0');if(s)s.classList.add('on');});
  // Reset mode note
  var mn=g('pkdc-mode-note');if(mn){mn.textContent='';mn.classList.remove('show');}
  showE([]);var rc=g('pkdc-res');if(rc)rc.classList.remove('show');S.last=null;
}
var calcBtn=g('pkdc-calc'),rstBtn=g('pkdc-reset');
if(calcBtn)calcBtn.addEventListener('click',doCalc);
if(rstBtn)rstBtn.addEventListener('click',doReset);
document.querySelectorAll('.pkdc-stinp,.pkdc-mvbp,.pkdc-hinp').forEach(function(el){el.addEventListener('keydown',function(e){if(e.key==='Enter')doCalc();});});


/* Init */
(function(){
  var wn=g('pkdc-w-none');if(wn)wn.classList.add('on');
  var tn=g('pkdc-tr-none');if(tn)tn.classList.add('on');
  ['p1','p2'].forEach(function(r){var s=g('pkdc-'+r+'-spk0');if(s)s.classList.add('on');});
  applyGen(9);
  applyFormat('singles');
  updateResultBadges();
  document.querySelectorAll('#pkdc-gens .pkdc-pill').forEach(function(b){
    b.classList.toggle('on',parseInt(b.getAttribute('data-gen'),10)===9);
  });
}());
}()); // close outer IIFE
</script>
<?php
    return ob_get_clean();
}
} // end function_exists check
add_shortcode('pkm_damage_calculator_calc','pkm_damage_calculator_shortcode');

/* ═══════════════════════════════════════════════════
   HELPER: Pokémon Panel
═══════════════════════════════════════════════════ */
if(!function_exists('pkdc4_pkm')){
function pkdc4_pkm($role,$t,$ns){
    $id='pkdc-'.$role;
    $natures=['Hardy','Lonely','Brave','Adamant','Naughty','Bold','Docile','Relaxed','Impish','Lax','Timid','Hasty','Serious','Jolly','Naive','Modest','Mild','Quiet','Bashful','Rash','Calm','Gentle','Sassy','Careful','Quirky'];
    $types_all=['none','normal','fire','water','grass','electric','ice','fighting','poison','ground','flying','psychic','bug','rock','ghost','dragon','dark','steel','fairy'];
    $statuses=['none'=>'Healthy','burn'=>'Burned','paralyze'=>'Paralyzed','freeze'=>'Frozen','sleep'=>'Asleep','poison'=>'Poisoned','toxic'=>'Badly Poisoned'];
    $mtype_opts=[''=>'—','normal'=>'Normal','fire'=>'Fire','water'=>'Water','grass'=>'Grass','electric'=>'Electric','ice'=>'Ice','fighting'=>'Fighting','poison'=>'Poison','ground'=>'Ground','flying'=>'Flying','psychic'=>'Psychic','bug'=>'Bug','rock'=>'Rock','ghost'=>'Ghost','dragon'=>'Dragon','dark'=>'Dark','steel'=>'Steel','fairy'=>'Fairy'];
    $sids=['hp','atk','def','spa','spd','spe'];
    $snms=['HP','Atk','Def','SpA','SpD','Spe'];
    $skeys=['hp','attack','defense','special-attack','special-defense','speed'];
    ob_start();
?>
<div class="pkdc-sw">
  <input type="text" id="<?php echo $id;?>-si" class="pkdc-si" placeholder="<?php echo esc_attr($t['search_ph']??'Search Pokémon...');?>" autocomplete="off" autocorrect="off" spellcheck="false">
  <svg class="pkdc-sico" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
  <div id="<?php echo $id;?>-drop" class="pkdc-drop" role="listbox"></div>
</div>
<div id="<?php echo $id;?>-prev" class="pkdc-prev" aria-live="polite">
  <img id="<?php echo $id;?>-spr" src="" alt="" width="40" height="40" onerror="this.style.display='none'">
  <div><span id="<?php echo $id;?>-nm" class="pkdc-prev-n"></span><div id="<?php echo $id;?>-ty" class="pkdc-prev-t"></div></div>
</div>
<noscript><select name="<?php echo $role;?>_ns"><?php echo $ns;?></select></noscript>

<div class="pkdc-sec">Config</div>
<div class="pkdc-row">
  <div class="pkdc-fg" style="max-width:68px!important;flex:0 0 68px!important;">
    <label class="pkdc-lbl" for="<?php echo $id;?>-lv"><?php echo esc_html($t['level']??'Level');?></label>
    <input type="number" id="<?php echo $id;?>-lv" class="pkdc-inp" style="text-align:center!important;" min="1" max="100" value="100" inputmode="numeric">
    <span id="<?php echo $id;?>-lv-lock" class="pkdc-lv-lock-lbl">🔒 Locked</span>
  </div>
  <div class="pkdc-fg pkdc-nat-row">
    <label class="pkdc-lbl" for="<?php echo $id;?>-nat"><?php echo esc_html($t['nature']??'Nature');?></label>
    <select id="<?php echo $id;?>-nat" class="pkdc-sel">
      <?php foreach($natures as $n):?><option value="<?php echo esc_attr($n);?>"><?php echo esc_html($n);?></option><?php endforeach;?>
    </select>
  </div>
</div>
<div class="pkdc-row pkdc-ab-row">
  <div class="pkdc-fg">
    <label class="pkdc-lbl" for="<?php echo $id;?>-ab"><?php echo esc_html($t['ability']??'Ability');?></label>
    <input type="text" id="<?php echo $id;?>-ab" class="pkdc-inp" placeholder="e.g. Intimidate">
  </div>
  <div class="pkdc-fg pkdc-item-row">
    <label class="pkdc-lbl" for="<?php echo $id;?>-it"><?php echo esc_html($t['item']??'Item');?></label>
    <input type="text" id="<?php echo $id;?>-it" class="pkdc-inp" placeholder="e.g. Life Orb">
  </div>
</div>
<div class="pkdc-row pkdc-status-row">
  <div class="pkdc-fg">
    <label class="pkdc-lbl" for="<?php echo $id;?>-st"><?php echo esc_html($t['status']??'Status');?></label>
    <select id="<?php echo $id;?>-st" class="pkdc-sel">
      <?php foreach($statuses as $sv=>$sl):?><option value="<?php echo esc_attr($sv);?>"><?php echo esc_html($sl);?></option><?php endforeach;?>
    </select>
  </div>
  <div class="pkdc-fg pkdc-tera-row">
    <label class="pkdc-lbl" for="<?php echo $id;?>-te"><?php echo esc_html($t['tera']??'Tera Type');?></label>
    <select id="<?php echo $id;?>-te" class="pkdc-sel">
      <?php foreach($types_all as $ty):?><option value="<?php echo esc_attr($ty);?>"><?php echo esc_html(ucfirst($ty));?></option><?php endforeach;?>
    </select>
  </div>
</div>

<div class="pkdc-sec"><?php echo esc_html($t['health']??'Health');?></div>
<div class="pkdc-health">
  <div class="pkdc-hrow">
    <span class="pkdc-hlbl"><?php echo esc_html($t['current_hp']??'Current HP');?></span>
    <div class="pkdc-hright">
      <input type="number" id="<?php echo $id;?>-hc" class="pkdc-hinp" min="0" max="9999" placeholder="—" inputmode="numeric">
      <span id="<?php echo $id;?>-hm" class="pkdc-hmax"></span>
      <span id="<?php echo $id;?>-hp" class="pkdc-hpct">100%</span>
    </div>
  </div>
  <div class="pkdc-htrack"><div id="<?php echo $id;?>-hf" class="pkdc-hfill" style="width:100%"></div></div>
</div>

<div class="pkdc-sec"><?php echo esc_html($t['stages']??'Stages');?></div>
<div class="pkdc-stgg">
  <div>
    <div class="pkdc-slbl"><?php echo esc_html($t['atk_stage']??'Atk');?></div>
    <div class="pkdc-stgr">
      <button type="button" id="<?php echo $id;?>-ad" class="pkdc-sbtn" aria-label="Decrease Atk stage">−</button>
      <span id="<?php echo $id;?>-av" class="pkdc-sval">0</span>
      <button type="button" id="<?php echo $id;?>-au" class="pkdc-sbtn" aria-label="Increase Atk stage">+</button>
    </div>
  </div>
  <div>
    <div class="pkdc-slbl"><?php echo esc_html($t['def_stage']??'Def');?></div>
    <div class="pkdc-stgr">
      <button type="button" id="<?php echo $id;?>-dd" class="pkdc-sbtn" aria-label="Decrease Def stage">−</button>
      <span id="<?php echo $id;?>-dv" class="pkdc-sval">0</span>
      <button type="button" id="<?php echo $id;?>-du" class="pkdc-sbtn" aria-label="Increase Def stage">+</button>
    </div>
  </div>
</div>

<div class="pkdc-sec"><?php echo esc_html($t['stats']??'Stats');?></div>
<div class="pkdc-stg">
  <div class="pkdc-shd"></div>
  <div class="pkdc-shd"><?php echo esc_html($t['base']??'Base');?></div>
  <div class="pkdc-shd pkdc-iv-hd">IV</div>
  <div class="pkdc-shd pkdc-ev-hd">EV</div>
  <div class="pkdc-shd"><?php echo esc_html($t['stat']??'Stat');?></div>
  <?php foreach($sids as $i=>$sid):
    $rowClass='';
    if($sid==='spd')$rowClass=' pkdc-spd-row';
    if($sid==='spa')$rowClass=' pkdc-spa-row';
  ?>
  <div class="pkdc-slb<?php echo $rowClass;?><?php echo ($sid==='spa')?' pkdc-spa-lbl':'';?>"><?php echo esc_html($snms[$i]);?></div>
  <div id="<?php echo $id;?>-bs-<?php echo $sid;?>" class="pkdc-sbs<?php echo $rowClass;?>">—</div>
  <input type="number" id="<?php echo $id;?>-iv-<?php echo $sid;?>" class="pkdc-stinp<?php echo $rowClass;?>" value="31" min="0" max="31" inputmode="numeric" aria-label="<?php echo esc_attr($snms[$i]);?> IV">
  <input type="number" id="<?php echo $id;?>-ev-<?php echo $sid;?>" class="pkdc-stinp<?php echo $rowClass;?>" value="0" min="0" max="252" step="4" inputmode="numeric" aria-label="<?php echo esc_attr($snms[$i]);?> EV">
  <div id="<?php echo $id;?>-ts-<?php echo $sid;?>" class="pkdc-stot<?php echo $rowClass;?>">—</div>
  <?php endforeach;?>
</div>

<div class="pkdc-sec"><?php echo esc_html($t['moves']??'Moves');?></div>
<?php for($mi=0;$mi<4;$mi++):?>
<div class="pkdc-mvb">
  <div class="pkdc-mvhd">
    <span class="pkdc-mvnum">Move <?php echo ($mi+1);?></span>
    <button type="button" id="<?php echo $id;?>-m<?php echo $mi;?>u" class="pkdc-mvuse" aria-label="Use move <?php echo ($mi+1);?>">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:9px;height:9px" aria-hidden="true"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg> Use
    </button>
  </div>
  <div class="pkdc-mvnr">
    <input type="text" id="<?php echo $id;?>-m<?php echo $mi;?>n" class="pkdc-mvi" placeholder="Move name...">
    <input type="number" id="<?php echo $id;?>-m<?php echo $mi;?>b" class="pkdc-mvbp" value="80" min="1" max="999" inputmode="numeric" title="Base Power">
  </div>
  <div class="pkdc-mvor">
    <select id="<?php echo $id;?>-m<?php echo $mi;?>t" class="pkdc-sel" style="font-size:10px!important;padding:4px 18px 4px 6px!important;">
      <?php foreach($mtype_opts as $mv=>$ml):?><option value="<?php echo esc_attr($mv);?>" data-t="<?php echo esc_attr($mv);?>"><?php echo esc_html($ml);?></option><?php endforeach;?>
    </select>
    <select id="<?php echo $id;?>-m<?php echo $mi;?>c" class="pkdc-sel" style="font-size:10px!important;padding:4px 18px 4px 6px!important;">
      <option value="physical">Physical</option>
      <option value="special">Special</option>
      <option value="status">Status</option>
    </select>
  </div>
  <div class="pkdc-mvfl">
    <button type="button" id="<?php echo $id;?>-m<?php echo $mi;?>cr" class="pkdc-mvf pkdc-crit-flag">Crit</button>
    <button type="button" id="<?php echo $id;?>-m<?php echo $mi;?>z" class="pkdc-mvf pkdc-z-flag pkdc-hide">Z</button>
    <button type="button" id="<?php echo $id;?>-m<?php echo $mi;?>s" class="pkdc-mvf pkdc-stellar-flag">Stellar</button>
  </div>
</div>
<?php endfor;?>
<?php
    return ob_get_clean();
}
}

/* ═══════════════════════════════════════════════════
   HELPER: Field Panel
═══════════════════════════════════════════════════ */
if(!function_exists('pkdc4_fld')){
function pkdc4_fld(){
    ob_start();
?>
<div class="pkdc-fsec">Weather</div>
<div class="pkdc-bg2">
  <button type="button" id="pkdc-w-none"  class="pkdc-fb pkdc-weather-btn" data-w="none">None</button>
  <button type="button" id="pkdc-w-sun"   class="pkdc-fb pkdc-weather-btn" data-w="sun">☀ Sun</button>
  <button type="button" id="pkdc-w-rain"  class="pkdc-fb pkdc-weather-btn" data-w="rain">🌧 Rain</button>
  <button type="button" id="pkdc-w-sand"  class="pkdc-fb pkdc-weather-btn" data-w="sand">🌪 Sand</button>
  <button type="button" id="pkdc-w-snow"  class="pkdc-fb pkdc-weather-btn" data-w="snow">❄ Snow</button>
  <button type="button" id="pkdc-w-hail"  class="pkdc-fb pkdc-weather-btn" data-w="hail">🌨 Hail</button>
</div>

<div class="pkdc-fsec pkdc-terrain-sec">Terrain</div>
<div class="pkdc-bg2 pkdc-terrain-sec">
  <button type="button" id="pkdc-tr-none"     class="pkdc-fb pkdc-terrain-btn full" data-tr="none">None</button>
  <button type="button" id="pkdc-tr-electric" class="pkdc-fb pkdc-terrain-btn" data-tr="electric">⚡ Electric</button>
  <button type="button" id="pkdc-tr-grassy"   class="pkdc-fb pkdc-terrain-btn" data-tr="grassy">🌿 Grassy</button>
  <button type="button" id="pkdc-tr-misty"    class="pkdc-fb pkdc-terrain-btn" data-tr="misty">🌫 Misty</button>
  <button type="button" id="pkdc-tr-psychic"  class="pkdc-fb pkdc-terrain-btn" data-tr="psychic">🔮 Psychic</button>
</div>

<div class="pkdc-fsec">Conditions</div>
<div class="pkdc-bg3g">
  <button type="button" id="pkdc-fgrav" class="pkdc-fb">Gravity</button>
  <button type="button" id="pkdc-fmr"   class="pkdc-fb">Magic Room</button>
  <button type="button" id="pkdc-fwr"   class="pkdc-fb">Wonder Room</button>
</div>

<div class="pkdc-fsec">Sides</div>
<div class="pkdc-2side">
  <div>
    <span class="pkdc-slbl2">P1 Side</span>
    <div class="pkdc-sbtns">
      <button type="button" id="pkdc-p1-ref"    class="pkdc-fb pkdc-screens-btn">Reflect</button>
      <button type="button" id="pkdc-p1-ls"     class="pkdc-fb pkdc-screens-btn">Light Screen</button>
      <div class="pkdc-hazards-inline pkdc-hazards-sec">
        <button type="button" id="pkdc-p1-sr"     class="pkdc-fb pkdc-screens-btn pkdc-sr-btn">Stealth Rock</button>
        <button type="button" id="pkdc-p1-ss2"    class="pkdc-fb pkdc-steelsurge-btn">Steelsurge</button>
        <button type="button" id="pkdc-p1-av"     class="pkdc-fb pkdc-aurora-veil-btn">Aurora Veil</button>
        <button type="button" id="pkdc-p1-tw"     class="pkdc-fb pkdc-tailwind-btn">Tailwind</button>
        <button type="button" id="pkdc-p1-hh"     class="pkdc-fb pkdc-helpinghand-btn">Helping Hand</button>
        <button type="button" id="pkdc-p1-fg"     class="pkdc-fb pkdc-friendguard-btn">Friend Guard</button>
        <button type="button" id="pkdc-p1-bat"    class="pkdc-fb pkdc-battery-btn">Battery</button>
        <button type="button" id="pkdc-p1-ps"     class="pkdc-fb pkdc-powerspot-btn">Power Spot</button>
        <button type="button" id="pkdc-p1-ssp"    class="pkdc-fb pkdc-steelspirit-btn">Steely Spirit</button>
        <button type="button" id="pkdc-p1-prot"   class="pkdc-fb pkdc-protect-btn">Protect</button>
        <button type="button" id="pkdc-p1-lseed"  class="pkdc-fb pkdc-leechseed-btn">Leech Seed</button>
        <button type="button" id="pkdc-p1-sc"     class="pkdc-fb pkdc-saltcure-btn">Salt Cure</button>
        <button type="button" id="pkdc-p1-fore"   class="pkdc-fb pkdc-foresight-btn">Foresight</button>
        <button type="button" id="pkdc-p1-ptrick" class="pkdc-fb pkdc-powertrick-btn">Power Trick</button>
        <button type="button" id="pkdc-p1-vl"     class="pkdc-fb pkdc-maxmove-btn">Vine Lash</button>
        <button type="button" id="pkdc-p1-wf"     class="pkdc-fb pkdc-maxmove-btn">Wildfire</button>
        <button type="button" id="pkdc-p1-cn"     class="pkdc-fb pkdc-maxmove-btn">Cannonade</button>
        <button type="button" id="pkdc-p1-vc"     class="pkdc-fb pkdc-maxmove-btn">Volcalith</button>
        <button type="button" id="pkdc-p1-so"     class="pkdc-fb pkdc-switchingout-btn">Switching Out</button>
      </div>
    </div>
    <div class="pkdc-sprow pkdc-spikes-row">
      <span class="pkdc-splbl">Spikes</span>
      <div class="pkdc-spbtns">
        <button type="button" id="pkdc-p1-spk0" class="pkdc-spbtn">0</button>
        <button type="button" id="pkdc-p1-spk1" class="pkdc-spbtn">1</button>
        <button type="button" id="pkdc-p1-spk2" class="pkdc-spbtn">2</button>
        <button type="button" id="pkdc-p1-spk3" class="pkdc-spbtn">3</button>
      </div>
    </div>
  </div>
  <div>
    <span class="pkdc-slbl2">P2 Side</span>
    <div class="pkdc-sbtns">
      <button type="button" id="pkdc-p2-ref"    class="pkdc-fb pkdc-screens-btn">Reflect</button>
      <button type="button" id="pkdc-p2-ls"     class="pkdc-fb pkdc-screens-btn">Light Screen</button>
      <div class="pkdc-hazards-inline pkdc-hazards-sec">
        <button type="button" id="pkdc-p2-sr"     class="pkdc-fb pkdc-screens-btn pkdc-sr-btn">Stealth Rock</button>
        <button type="button" id="pkdc-p2-ss2"    class="pkdc-fb pkdc-steelsurge-btn">Steelsurge</button>
        <button type="button" id="pkdc-p2-av"     class="pkdc-fb pkdc-aurora-veil-btn">Aurora Veil</button>
        <button type="button" id="pkdc-p2-tw"     class="pkdc-fb pkdc-tailwind-btn">Tailwind</button>
        <button type="button" id="pkdc-p2-hh"     class="pkdc-fb pkdc-helpinghand-btn">Helping Hand</button>
        <button type="button" id="pkdc-p2-fg"     class="pkdc-fb pkdc-friendguard-btn">Friend Guard</button>
        <button type="button" id="pkdc-p2-bat"    class="pkdc-fb pkdc-battery-btn">Battery</button>
        <button type="button" id="pkdc-p2-ps"     class="pkdc-fb pkdc-powerspot-btn">Power Spot</button>
        <button type="button" id="pkdc-p2-ssp"    class="pkdc-fb pkdc-steelspirit-btn">Steely Spirit</button>
        <button type="button" id="pkdc-p2-prot"   class="pkdc-fb pkdc-protect-btn">Protect</button>
        <button type="button" id="pkdc-p2-lseed"  class="pkdc-fb pkdc-leechseed-btn">Leech Seed</button>
        <button type="button" id="pkdc-p2-sc"     class="pkdc-fb pkdc-saltcure-btn">Salt Cure</button>
        <button type="button" id="pkdc-p2-fore"   class="pkdc-fb pkdc-foresight-btn">Foresight</button>
        <button type="button" id="pkdc-p2-ptrick" class="pkdc-fb pkdc-powertrick-btn">Power Trick</button>
        <button type="button" id="pkdc-p2-vl"     class="pkdc-fb pkdc-maxmove-btn">Vine Lash</button>
        <button type="button" id="pkdc-p2-wf"     class="pkdc-fb pkdc-maxmove-btn">Wildfire</button>
        <button type="button" id="pkdc-p2-cn"     class="pkdc-fb pkdc-maxmove-btn">Cannonade</button>
        <button type="button" id="pkdc-p2-vc"     class="pkdc-fb pkdc-maxmove-btn">Volcalith</button>
        <button type="button" id="pkdc-p2-so"     class="pkdc-fb pkdc-switchingout-btn">Switching Out</button>
      </div>
    </div>
    <div class="pkdc-sprow pkdc-spikes-row">
      <span class="pkdc-splbl">Spikes</span>
      <div class="pkdc-spbtns">
        <button type="button" id="pkdc-p2-spk0" class="pkdc-spbtn">0</button>
        <button type="button" id="pkdc-p2-spk1" class="pkdc-spbtn">1</button>
        <button type="button" id="pkdc-p2-spk2" class="pkdc-spbtn">2</button>
        <button type="button" id="pkdc-p2-spk3" class="pkdc-spbtn">3</button>
      </div>
    </div>
  </div>
</div>
<?php
    return ob_get_clean();
}
}