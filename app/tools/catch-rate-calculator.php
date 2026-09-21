<?php
/**
 * Pokemon GO Catch Rate Calculator
 * Standalone & WordPress Shortcode Tool
 * Design System: Emerald Teal / Dark Slate
 */

if (!function_exists('pkm_calc_catch_rate_core')) {
    function pkm_calc_catch_rate_core(array $params): array {
        $pokemon_id = isset($params['pokemon_id']) ? intval($params['pokemon_id']) : 25;
        $ball       = isset($params['ball']) ? sanitize_text_field($params['ball']) : 'greatball';
        $berry      = isset($params['berry']) ? sanitize_text_field($params['berry']) : 'none';
        $medal      = isset($params['medal']) ? sanitize_text_field($params['medal']) : 'none';
        $status     = isset($params['status']) ? sanitize_text_field($params['status']) : 'none';
        $weather    = !empty($params['weather']) && ($params['weather'] === 'true' || $params['weather'] === true || $params['weather'] === '1');
        $throw_type = isset($params['throw_type']) ? sanitize_text_field($params['throw_type']) : 'curve_great';
        $hp         = isset($params['hp']) ? max(1, min(100, intval($params['hp']))) : 100;
        $encounter  = isset($params['encounter']) ? sanitize_text_field($params['encounter']) : 'wild';

        $pkm_data = $pokemon_id ? get_pokemon_data($pokemon_id) : null;
        $bcr = 0.20; // Default base catch rate
        if ($pkm_data && isset($pkm_data['base_catch_rate'])) {
            $bcr = floatval($pkm_data['base_catch_rate']);
        }

        // Ball Multipliers
        $ball_mults = [
            'pokeball'   => 1.0,
            'greatball'  => 1.5,
            'ultraball'  => 2.0,
            'masterball' => 100.0,
            'premier'    => 1.0,
            'safari'     => 1.0,
            'sport'      => 1.0
        ];

        // Berry Multipliers
        $berry_mults = [
            'none'         => 1.0,
            'razz'         => 1.5,
            'silver_pinap' => 1.8,
            'golden_razz'  => 2.5
        ];

        // Medal Bonuses
        $medal_mults = [
            'none'   => 1.0,
            'bronze' => 1.1,
            'silver' => 1.2,
            'gold'   => 1.3,
            'plat'   => 1.4
        ];

        // Throw & Curve Multipliers
        $throw_mults = [
            'regular'      => 1.0,
            'curve'        => 1.7,
            'nice'         => 1.15,
            'curve_nice'   => 1.7 * 1.15,
            'great'        => 1.5,
            'curve_great'  => 1.7 * 1.5,
            'excellent'    => 1.85,
            'curve_excel'  => 1.7 * 1.85
        ];

        // Status Multipliers
        $status_mults = [
            'none'         => 1.0,
            'sleep_freeze' => 2.0,
            'other'        => 1.5
        ];

        $ball_mult   = $ball_mults[$ball] ?? 1.5;
        $berry_mult  = $berry_mults[$berry] ?? 1.0;
        $medal_mult  = $medal_mults[$medal] ?? 1.0;
        $throw_mult  = $throw_mults[$throw_type] ?? 2.55;
        $status_mult = $status_mults[$status] ?? 1.0;
        $weather_mult= $weather ? 1.1 : 1.0;

        // CPM level table (Wild level 20 default vs Raid level 20/25)
        $cpm = ($encounter === 'raid') ? 0.78960001 : 0.59740001;

        // HP modifier
        $hp_mod = 1 + (1 - $hp / 100) * 0.5;
        $effective_bcr = min($bcr * $hp_mod, 1.0);

        // Core Catch Rate Formula
        $inner = 1 - ($effective_bcr / (2 * $cpm));
        $inner = max(0, min(1, $inner));

        $total_mult = $ball_mult * $berry_mult * $medal_mult * $throw_mult * $status_mult * $weather_mult;
        $catch_prob = 1 - pow($inner, $total_mult);
        $catch_prob = max(0, min(1, $catch_prob));

        $pct = $catch_prob * 100;
        $throws = ($pct >= 100) ? 1 : ($catch_prob > 0 ? ceil(1 / $catch_prob) : 99);

        if ($pct >= 100) $diff = 'Guaranteed (100%)';
        elseif ($pct >= 70) $diff = 'Very Easy';
        elseif ($pct >= 40) $diff = 'Easy';
        elseif ($pct >= 20) $diff = 'Moderate';
        elseif ($pct >= 8) $diff = 'Hard';
        else $diff = 'Very Hard';

        return [
            'pct'         => round($pct, 2),
            'throws'      => $throws > 999 ? 999 : $throws,
            'difficulty'  => $diff,
            'bcr'         => round($bcr * 100, 1),
            'total_mult'  => round($total_mult, 2)
        ];
    }
}

if (!function_exists('pkm_catch_rate_shortcode')) {
    function pkm_catch_rate_shortcode(): string {
        $raw = get_pokemon_data();
        $data_ok = !empty($raw) && is_array($raw);

        $js_data = [];
        if ($data_ok) {
            $js_data = array_map(function($p) {
                return [
                    'id'      => intval($p['id'] ?? 0),
                    'name'    => sanitize_text_field($p['name'] ?? ''),
                    'types'   => array_values($p['types'] ?? []),
                    'bcr'     => floatval($p['base_catch_rate'] ?? 0.20),
                    'sprite'  => esc_url(trim($p['sprite_default'] ?? '')),
                    'spriteO' => esc_url(trim($p['sprite_official'] ?? $p['sprite_default'] ?? ''))
                ];
            }, $raw);
        }

        // Header preview sprites
        $pokemon_a = $data_ok ? (get_pokemon_data(25) ?? []) : [];
        $pokemon_b = $data_ok ? (get_pokemon_data(150) ?? []) : [];

        ob_start();
        ?>
        <style>
        /* ═══════════════════════════════════════════════════
           PKM CATCH RATE CALCULATOR — UNIFIED DESIGN SYSTEM
           ═══════════════════════════════════════════════════ */
        .pkm-calc-outer {
            position: relative !important;
            width: 100% !important;
            background: var(--pkm-bg) !important;
        }
        .pkm-calc-wrapper {
            max-width: 1080px !important;
            margin: 0 auto !important;
            padding: 0 20px 48px !important;
            width: 100% !important;
            box-sizing: border-box !important;
            font-family: var(--pkm-font-body) !important;
            color: var(--pkm-text) !important;
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
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        .pkm-calc-title {
            font-family: var(--pkm-font-display) !important;
            font-size: clamp(16px, 3.2vw, 24px) !important;
            color: #FFFFFF !important;
            margin: 0 0 12px !important;
            line-height: 1.4 !important;
            text-shadow: 0 2px 8px rgba(0,0,0,0.3) !important;
            position: relative !important;
            z-index: 1 !important;
        }
        .pkm-calc-description {
            font-family: var(--pkm-font-heading) !important;
            font-size: clamp(14px, 2vw, 17px) !important;
            color: rgba(255,255,255,0.88) !important;
            margin: 0 auto !important;
            max-width: 640px !important;
            line-height: 1.6 !important;
            position: relative !important;
            z-index: 1 !important;
        }
        .pkm-calc-card {
            background: var(--pkm-bg-card) !important;
            border: 1px solid var(--pkm-border) !important;
            border-radius: var(--pkm-radius-lg) !important;
            padding: 28px !important;
            box-shadow: var(--pkm-shadow) !important;
            backdrop-filter: blur(8px) !important;
            margin-bottom: 24px !important;
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

        /* Search bar */
        .pkm-search-wrap {
            position: relative !important;
            margin-bottom: 20px !important;
            width: 100% !important;
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
        }
        .pkm-search-input:focus {
            border-color: var(--pkm-primary) !important;
            box-shadow: 0 0 0 3px var(--pkm-primary-light) !important;
            background: var(--pkm-bg-2) !important;
        }
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
        }
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
        .pkm-selected-pokemon {
            display: flex !important;
            align-items: center !important;
            gap: 14px !important;
            background: var(--pkm-bg-3) !important;
            border-radius: var(--pkm-radius) !important;
            padding: 12px 16px !important;
            margin-bottom: 24px !important;
            border: 1px solid var(--pkm-border) !important;
        }
        .pkm-selected-sprite {
            width: 52px !important;
            height: 52px !important;
            object-fit: contain !important;
            flex-shrink: 0 !important;
        }
        .pkm-selected-name {
            font-family: var(--pkm-font-heading) !important;
            font-size: 17px !important;
            font-weight: 700 !important;
            color: var(--pkm-text) !important;
            text-transform: capitalize !important;
            margin: 0 0 4px !important;
        }
        .pkm-type-badge {
            font-size: 10px !important;
            font-weight: 700 !important;
            color: #fff !important;
            padding: 2px 8px !important;
            border-radius: 20px !important;
            text-transform: capitalize !important;
            display: inline-block !important;
        }

        /* Form Grid */
        .pkm-calc-form-grid {
            display: grid !important;
            grid-template-columns: 1fr !important;
            gap: 20px !important;
        }
        @media (min-width: 768px) {
            .pkm-calc-form-grid { grid-template-columns: repeat(2, 1fr) !important; }
        }
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
        }
        .pkm-select-input {
            width: 100% !important;
            box-sizing: border-box !important;
            background: var(--pkm-input-bg) !important;
            border: 2px solid var(--pkm-border) !important;
            border-radius: var(--pkm-radius-sm) !important;
            padding: 12px 14px !important;
            font-size: 15px !important;
            font-family: var(--pkm-font-body) !important;
            color: var(--pkm-text) !important;
            outline: none !important;
            transition: var(--pkm-transition) !important;
            min-height: 48px !important;
        }
        .pkm-select-input:focus {
            border-color: var(--pkm-primary) !important;
            box-shadow: 0 0 0 3px var(--pkm-primary-light) !important;
        }
        .pkm-checkbox-row {
            display: flex !important;
            align-items: center !important;
            gap: 10px !important;
            padding: 12px 16px !important;
            background: var(--pkm-bg-3) !important;
            border: 1px solid var(--pkm-border) !important;
            border-radius: var(--pkm-radius-sm) !important;
            cursor: pointer !important;
            user-select: none !important;
        }
        .pkm-checkbox-row input {
            width: 18px !important;
            height: 18px !important;
            accent-color: var(--pkm-primary) !important;
            cursor: pointer !important;
        }
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
            padding: 12px 22px !important;
            font-family: var(--pkm-font-heading) !important;
            font-size: 14px !important;
            font-weight: 700 !important;
            border-radius: var(--pkm-radius-sm) !important;
            cursor: pointer !important;
            border: none !important;
            transition: var(--pkm-transition) !important;
            min-height: 46px !important;
        }
        .pkm-btn-primary {
            background: var(--pkm-primary) !important;
            color: #fff !important;
            flex: 1 !important;
            min-width: 160px !important;
        }
        .pkm-btn-primary:hover {
            background: var(--pkm-primary-hover) !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 6px 20px var(--pkm-glow) !important;
        }
        .pkm-btn-secondary {
            background: var(--pkm-bg-3) !important;
            color: var(--pkm-text-muted) !important;
            border: 1px solid var(--pkm-border) !important;
        }
        .pkm-btn-secondary:hover {
            background: var(--pkm-bg-2) !important;
            color: var(--pkm-text) !important;
        }
        .pkm-btn-accent {
            background: var(--pkm-primary-light) !important;
            color: var(--pkm-primary) !important;
            border: 1px solid var(--pkm-primary) !important;
        }

        /* Result Card */
        .pkm-result-card {
            background: var(--pkm-bg-card) !important;
            border: 1px solid var(--pkm-border) !important;
            border-radius: var(--pkm-radius-lg) !important;
            padding: 28px !important;
            box-shadow: var(--pkm-shadow) !important;
            margin-bottom: 24px !important;
        }
        .pkm-result-pct-display {
            text-align: center !important;
            padding: 20px 0 10px !important;
        }
        .pkm-result-pct-num {
            font-family: var(--pkm-font-heading) !important;
            font-size: clamp(3rem, 7vw, 4.2rem) !important;
            font-weight: 900 !important;
            color: var(--pkm-primary) !important;
            line-height: 1 !important;
            margin-bottom: 6px !important;
        }
        .pkm-result-pct-sub {
            font-size: 14px !important;
            color: var(--pkm-text-muted) !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
        }
        .pkm-gauge-bar-outer {
            width: 100% !important;
            height: 14px !important;
            background: var(--pkm-bg-3) !important;
            border-radius: 20px !important;
            overflow: hidden !important;
            margin: 16px 0 24px !important;
            border: 1px solid var(--pkm-border) !important;
        }
        .pkm-gauge-bar-inner {
            height: 100% !important;
            background: linear-gradient(90deg, #0D9488, #2ECC71) !important;
            border-radius: 20px !important;
            transition: width 0.4s cubic-bezier(0.4,0,0.2,1) !important;
        }
        .pkm-result-metrics-grid {
            display: grid !important;
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 16px !important;
            margin-bottom: 20px !important;
        }
        .pkm-metric-box {
            background: var(--pkm-bg-3) !important;
            border: 1px solid var(--pkm-border) !important;
            border-radius: var(--pkm-radius) !important;
            padding: 16px !important;
            text-align: center !important;
        }
        .pkm-metric-label {
            font-size: 12px !important;
            color: var(--pkm-text-muted) !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            margin-bottom: 4px !important;
        }
        .pkm-metric-val {
            font-family: var(--pkm-font-heading) !important;
            font-size: 20px !important;
            font-weight: 800 !important;
            color: var(--pkm-text) !important;
        }
        .pkm-result-footer-text {
            font-size: 13px !important;
            color: var(--pkm-text-muted) !important;
            line-height: 1.6 !important;
            border-top: 1px solid var(--pkm-border) !important;
            padding-top: 16px !important;
            display: flex !important;
            justify-content: space-between !important;
            flex-wrap: wrap !important;
            gap: 8px !important;
        }

        /* FAQ & Prose */
        .pkm-prose-wrap {
            background: var(--pkm-bg-card) !important;
            border: 1px solid var(--pkm-border) !important;
            border-radius: var(--pkm-radius-lg) !important;
            padding: 32px !important;
            box-shadow: var(--pkm-shadow-sm) !important;
            margin-top: 32px !important;
            line-height: 1.75 !important;
            color: var(--pkm-text) !important;
        }
        .pkm-prose-wrap h2 {
            font-family: var(--pkm-font-heading) !important;
            font-size: 22px !important;
            font-weight: 800 !important;
            color: var(--pkm-text) !important;
            margin: 0 0 16px !important;
            padding-bottom: 12px !important;
            border-bottom: 2px solid var(--pkm-border) !important;
        }
        .pkm-prose-wrap h3 {
            font-family: var(--pkm-font-heading) !important;
            font-size: 17px !important;
            font-weight: 700 !important;
            color: var(--pkm-text) !important;
            margin: 24px 0 10px !important;
        }
        .pkm-prose-wrap ul {
            padding-left: 20px !important;
            margin-bottom: 20px !important;
            color: var(--pkm-text-muted) !important;
        }
        .pkm-formula-box {
            background: var(--pkm-bg-3) !important;
            border: 1px solid var(--pkm-border) !important;
            border-left: 4px solid var(--pkm-primary) !important;
            border-radius: var(--pkm-radius) !important;
            padding: 16px 20px !important;
            margin: 16px 0 !important;
            font-family: monospace !important;
            font-size: 13px !important;
            color: var(--pkm-text) !important;
            overflow-x: auto !important;
        }

        @media (max-width: 480px) {
            .pkm-calc-header { padding: 32px 16px 24px !important; }
            .pkm-calc-card, .pkm-result-card, .pkm-prose-wrap { padding: 18px !important; }
            .pkm-header-sprite { width: 56px !important; height: 56px !important; }
            .pkm-result-metrics-grid { grid-template-columns: 1fr !important; }
            .pkm-btn-row { flex-direction: column !important; }
        }
        </style>

        <div class="pkm-calc-outer">
            <div class="pkm-calc-wrapper">
                
                <!-- HEADER HERO -->
                <div class="pkm-calc-header">
                    <div class="pkm-calc-header-glow" aria-hidden="true"></div>
                    <div class="pkm-calc-header-sprites" aria-hidden="true">
                        <img src="<?= esc_url(trim($pokemon_a['sprite_official'] ?? $pokemon_a['sprite_default'] ?? '')) ?>"
                             alt="" width="80" height="80" class="pkm-header-sprite pkm-header-sprite-left" onerror="this.style.display='none'">
                        <img src="<?= esc_url(trim($pokemon_b['sprite_official'] ?? $pokemon_b['sprite_default'] ?? '')) ?>"
                             alt="" width="80" height="80" class="pkm-header-sprite pkm-header-sprite-right" onerror="this.style.display='none'">
                    </div>
                    <h1 class="pkm-calc-title">POKÉMON GO CATCH RATE CALCULATOR</h1>
                    <p class="pkm-calc-description">Calculate exact catch probabilities for any Pokémon with Poké Balls, Berries, Medals, and Curveball multipliers.</p>
                </div>

                <!-- MAIN CALCULATOR CARD -->
                <div class="pkm-calc-card">
                    <p class="pkm-card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/><line x1="12" y1="2" x2="12" y2="9"/><line x1="12" y1="15" x2="12" y2="22"/></svg>
                        SELECT POKÉMON & THROW PARAMETERS
                    </p>

                    <!-- SEARCH BAR -->
                    <div class="pkm-search-wrap">
                        <span class="pkm-search-icon-wrap" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        </span>
                        <input type="text" id="cr_search_input" class="pkm-search-input" placeholder="Search Pokémon by name or Pokédex #..." autocomplete="off">
                        <div id="cr_search_dropdown" class="pkm-search-dropdown"></div>
                    </div>

                    <!-- SELECTED POKEMON BADGE -->
                    <div class="pkm-selected-pokemon" id="cr_selected_badge">
                        <img id="cr_selected_sprite" src="<?= esc_url(trim($pokemon_a['sprite_official'] ?? $pokemon_a['sprite_default'] ?? '')) ?>" alt="" class="pkm-selected-sprite">
                        <div style="flex:1;">
                            <div class="pkm-selected-name" id="cr_selected_name">Pikachu (#0025)</div>
                            <div style="font-size:12px; color:var(--pkm-text-muted);">
                                Base Catch Rate: <strong id="cr_badge_bcr" style="color:var(--pkm-primary);">20.0%</strong>
                            </div>
                        </div>
                        <div id="cr_badge_types">
                            <span class="pkm-type-badge" style="background:#F8D030;">Electric</span>
                        </div>
                    </div>

                    <!-- FORM GRID -->
                    <div class="pkm-calc-form-grid">
                        <!-- Poké Ball -->
                        <div class="pkm-field">
                            <label class="pkm-field-label" for="cr_ball">Poké Ball Type:</label>
                            <select id="cr_ball" class="pkm-select-input" onchange="calcCR()">
                                <option value="pokeball">Regular Poké Ball (1.0×)</option>
                                <option value="greatball" selected>Great Ball (1.5×)</option>
                                <option value="ultraball">Ultra Ball (2.0×)</option>
                                <option value="masterball">Master Ball (Guaranteed 100%)</option>
                                <option value="premier">Premier Ball (1.0× / Raid)</option>
                            </select>
                        </div>

                        <!-- Berry -->
                        <div class="pkm-field">
                            <label class="pkm-field-label" for="cr_berry">Berry Used:</label>
                            <select id="cr_berry" class="pkm-select-input" onchange="calcCR()">
                                <option value="none" selected>No Berry (1.0×)</option>
                                <option value="razz">Razz Berry (1.5×)</option>
                                <option value="silver_pinap">Silver Pinap Berry (1.8×)</option>
                                <option value="golden_razz">Golden Razz Berry (2.5×)</option>
                            </select>
                        </div>

                        <!-- Throw Technique -->
                        <div class="pkm-field">
                            <label class="pkm-field-label" for="cr_throw">Throw Accuracy & Curve:</label>
                            <select id="cr_throw" class="pkm-select-input" onchange="calcCR()">
                                <option value="regular">Straight Regular (1.0×)</option>
                                <option value="curve">Curveball (1.7×)</option>
                                <option value="nice">Nice Throw (1.15×)</option>
                                <option value="curve_nice">Curveball + Nice Throw (1.95×)</option>
                                <option value="great">Great Throw (1.5×)</option>
                                <option value="curve_great" selected>Curveball + Great Throw (2.55×)</option>
                                <option value="excellent">Excellent Throw (1.85×)</option>
                                <option value="curve_excel">Curveball + Excellent Throw (3.15×)</option>
                            </select>
                        </div>

                        <!-- Medal Bonus -->
                        <div class="pkm-field">
                            <label class="pkm-field-label" for="cr_medal">Type Catch Medal:</label>
                            <select id="cr_medal" class="pkm-select-input" onchange="calcCR()">
                                <option value="none">No Medal (1.0×)</option>
                                <option value="bronze">Bronze Medal (1.1×)</option>
                                <option value="silver">Silver Medal (1.2×)</option>
                                <option value="gold" selected>Gold Medal (1.3×)</option>
                                <option value="plat">Platinum Medal (1.4×)</option>
                            </select>
                        </div>

                        <!-- Encounter Type -->
                        <div class="pkm-field">
                            <label class="pkm-field-label" for="cr_encounter">Encounter Type / Level:</label>
                            <select id="cr_encounter" class="pkm-select-input" onchange="calcCR()">
                                <option value="wild" selected>Wild Encounter (Standard Level 20 CPM)</option>
                                <option value="raid">Raid Boss (Level 20/25 CPM)</option>
                            </select>
                        </div>

                        <!-- Weather Boost -->
                        <div class="pkm-field" style="justify-content:flex-end;">
                            <label class="pkm-checkbox-row">
                                <input type="checkbox" id="cr_weather" onchange="calcCR()">
                                <span>Weather Boosted Encounter (+10% Multiplier)</span>
                            </label>
                        </div>
                    </div>

                    <!-- BUTTONS -->
                    <div class="pkm-btn-row">
                        <button type="button" class="pkm-btn pkm-btn-primary" onclick="calcCR()">
                            🎯 Calculate Catch Rate
                        </button>
                        <button type="button" class="pkm-btn pkm-btn-accent" onclick="applyPreset('raid')">
                            👑 Raid Boss Preset
                        </button>
                        <button type="button" class="pkm-btn pkm-btn-secondary" onclick="resetCR()">
                            🔄 Reset
                        </button>
                    </div>
                </div>

                <!-- RESULT CARD -->
                <div class="pkm-result-card" id="cr_result_card">
                    <p class="pkm-card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        CATCH PROBABILITY RESULTS
                    </p>

                    <div class="pkm-result-pct-display">
                        <div class="pkm-result-pct-num" id="cr_out_pct">50.4%</div>
                        <div class="pkm-result-pct-sub">Per Throw Catch Probability</div>
                    </div>

                    <div class="pkm-gauge-bar-outer">
                        <div class="pkm-gauge-bar-inner" id="cr_out_bar" style="width: 50.4%;"></div>
                    </div>

                    <div class="pkm-result-metrics-grid">
                        <div class="pkm-metric-box">
                            <div class="pkm-metric-label">Expected Throws</div>
                            <div class="pkm-metric-val" id="cr_out_throws">1 – 2 Throws</div>
                        </div>
                        <div class="pkm-metric-box">
                            <div class="pkm-metric-label">Difficulty Rating</div>
                            <div class="pkm-metric-val" id="cr_out_diff" style="color:#2ECC71;">Easy</div>
                        </div>
                    </div>

                    <div class="pkm-result-footer-text">
                        <span>Base Catch Rate (BCR): <strong id="cr_out_bcr" style="color:var(--pkm-text);">20.0%</strong></span>
                        <span>Total Catch Multiplier: <strong id="cr_out_mult" style="color:var(--pkm-text);">3.82×</strong></span>
                        <span>✨ Tip: Always use Curveballs for a 1.7× flat boost!</span>
                    </div>
                </div>

                <!-- GUIDE & EXPLANATION -->
                <div class="pkm-prose-wrap">
                    <h2>How Pokémon GO Catch Rate is Calculated</h2>
                    <p>
                        In Pokémon GO, capture probability is determined by the official Niantic CPM catch formula which evaluates the Pokémon's <strong>Base Catch Rate (BCR)</strong>, its current level factor (<strong>CPM</strong>), ball multiplier, berry bonus, medal tier, and throw quality.
                    </p>

                    <div class="pkm-formula-box">
                        Catch Probability = 1 - (1 - BCR / (2 * CPM)) ^ (Ball * Berry * Medal * Throw * Weather)
                    </div>

                    <h3>Catch Multiplier Breakdown</h3>
                    <ul>
                        <li><strong>Poké Balls:</strong> Regular (1.0×), Great Ball (1.5×), Ultra Ball (2.0×), Master Ball (Guaranteed 100%).</li>
                        <li><strong>Berries:</strong> Razz Berry (1.5×), Silver Pinap (1.8×), Golden Razz Berry (2.5×).</li>
                        <li><strong>Curveball Bonus:</strong> Grants a flat 1.7× multiplier on any successful throw.</li>
                        <li><strong>Throw Quality:</strong> Nice (1.15×), Great (1.5×), Excellent (1.85×).</li>
                        <li><strong>Medals:</strong> Bronze (1.1×), Silver (1.2×), Gold (1.3×), Platinum (1.4×).</li>
                    </ul>
                </div>

            </div>
        </div>

        <script>
        (function() {
            var pokemonData = <?= json_encode($js_data) ?>;
            var currentPokemon = pokemonData.length ? pokemonData[24] || pokemonData[0] : { id: 25, name: 'pikachu', bcr: 0.20, types: ['electric'] };

            var ballMults = { 'pokeball': 1.0, 'greatball': 1.5, 'ultraball': 2.0, 'masterball': 100.0, 'premier': 1.0 };
            var berryMults = { 'none': 1.0, 'razz': 1.5, 'silver_pinap': 1.8, 'golden_razz': 2.5 };
            var medalMults = { 'none': 1.0, 'bronze': 1.1, 'silver': 1.2, 'gold': 1.3, 'plat': 1.4 };
            var throwMults = {
                'regular': 1.0,
                'curve': 1.7,
                'nice': 1.15,
                'curve_nice': 1.7 * 1.15,
                'great': 1.5,
                'curve_great': 1.7 * 1.5,
                'excellent': 1.85,
                'curve_excel': 1.7 * 1.85
            };

            var typeColors = {
                'normal':'#A8A878','fire':'#F08030','water':'#6890F0','electric':'#F8D030',
                'grass':'#78C850','ice':'#98D8D8','fighting':'#C03028','poison':'#A040A0',
                'ground':'#E0C068','flying':'#A890F0','psychic':'#F85888','bug':'#A8B820',
                'rock':'#B8A038','ghost':'#705898','dragon':'#7038F8','dark':'#705848',
                'steel':'#B8B8D0','fairy':'#EE99AC'
            };

            // Search autocomplete
            var searchInput = document.getElementById('cr_search_input');
            var searchDropdown = document.getElementById('cr_search_dropdown');

            if (searchInput && searchDropdown) {
                searchInput.addEventListener('input', function() {
                    var q = this.value.trim().toLowerCase();
                    if (q.length < 1) {
                        searchDropdown.classList.remove('active');
                        return;
                    }

                    var matches = pokemonData.filter(function(p) {
                        return p.name.toLowerCase().includes(q) || String(p.id) === q || String(p.id).padStart(4, '0').includes(q);
                    }).slice(0, 10);

                    if (!matches.length) {
                        searchDropdown.innerHTML = '<div style="padding:12px; text-align:center; color:var(--pkm-text-muted);">No Pokémon found</div>';
                    } else {
                        searchDropdown.innerHTML = matches.map(function(p) {
                            var spriteUrl = p.sprite || p.spriteO || '';
                            return '<div class="pkm-search-item" data-id="' + p.id + '">' +
                                   (spriteUrl ? '<img src="' + spriteUrl + '" class="pkm-search-item-sprite">' : '') +
                                   '<span class="pkm-search-item-name">#' + String(p.id).padStart(4, '0') + ' ' + p.name + '</span>' +
                                   '<span style="font-size:12px; color:var(--pkm-primary); font-weight:700;">BCR ' + Math.round(p.bcr * 100) + '%</span>' +
                                   '</div>';
                        }).join('');
                    }
                    searchDropdown.classList.add('active');
                });

                searchDropdown.addEventListener('click', function(e) {
                    var item = e.target.closest('.pkm-search-item');
                    if (!item) return;
                    var id = parseInt(item.getAttribute('data-id'), 10);
                    var found = pokemonData.find(function(p) { return p.id === id; });
                    if (found) {
                        currentPokemon = found;
                        updatePokemonBadge();
                        calcCR();
                    }
                    searchDropdown.classList.remove('active');
                    searchInput.value = '';
                });

                document.addEventListener('click', function(e) {
                    if (!searchInput.contains(e.target) && !searchDropdown.contains(e.target)) {
                        searchDropdown.classList.remove('active');
                    }
                });
            }

            function updatePokemonBadge() {
                var nameEl = document.getElementById('cr_selected_name');
                var spriteEl = document.getElementById('cr_selected_sprite');
                var bcrEl = document.getElementById('cr_badge_bcr');
                var typesEl = document.getElementById('cr_badge_types');

                if (nameEl) nameEl.textContent = currentPokemon.name.charAt(0).toUpperCase() + currentPokemon.name.slice(1) + ' (#' + String(currentPokemon.id).padStart(4, '0') + ')';
                if (spriteEl) spriteEl.src = currentPokemon.spriteO || currentPokemon.sprite || '';
                if (bcrEl) bcrEl.textContent = (currentPokemon.bcr * 100).toFixed(1) + '%';
                if (typesEl && currentPokemon.types) {
                    typesEl.innerHTML = currentPokemon.types.map(function(t) {
                        var bg = typeColors[t.toLowerCase()] || '#0D9488';
                        return '<span class="pkm-type-badge" style="background:' + bg + ';">' + t + '</span>';
                    }).join(' ');
                }
            }

            window.calcCR = function() {
                var ball = document.getElementById('cr_ball').value;
                var berry = document.getElementById('cr_berry').value;
                var medal = document.getElementById('cr_medal').value;
                var throwT = document.getElementById('cr_throw').value;
                var enc = document.getElementById('cr_encounter').value;
                var weather = document.getElementById('cr_weather').checked;

                var bcr = currentPokemon.bcr || 0.20;
                var ballM = ballMults[ball] || 1.0;
                var berryM = berryMults[berry] || 1.0;
                var medalM = medalMults[medal] || 1.0;
                var throwM = throwMults[throwT] || 1.0;
                var weatherM = weather ? 1.1 : 1.0;
                var cpm = (enc === 'raid') ? 0.78960001 : 0.59740001;

                if (ball === 'masterball') {
                    renderResult(100, 1, 'Guaranteed (100%)', bcr, 100);
                    return;
                }

                var inner = 1 - (bcr / (2 * cpm));
                inner = Math.max(0, Math.min(1, inner));

                var totalM = ballM * berryM * medalM * throwM * weatherM;
                var prob = 1 - Math.pow(inner, totalM);
                prob = Math.max(0, Math.min(1, prob));

                var pct = prob * 100;
                var throws = (pct >= 100) ? 1 : (prob > 0 ? Math.ceil(1 / prob) : 99);

                var diff = 'Easy';
                var diffColor = '#2ECC71';
                if (pct >= 100) { diff = 'Guaranteed (100%)'; diffColor = '#2ECC71'; }
                else if (pct >= 70) { diff = 'Very Easy'; diffColor = '#2ECC71'; }
                else if (pct >= 40) { diff = 'Easy'; diffColor = '#0D9488'; }
                else if (pct >= 20) { diff = 'Moderate'; diffColor = '#F4D03F'; }
                else if (pct >= 8) { diff = 'Hard'; diffColor = '#E67E22'; }
                else { diff = 'Very Hard'; diffColor = '#E74C3C'; }

                renderResult(pct, throws, diff, bcr, totalM, diffColor);
            };

            function renderResult(pct, throws, diff, bcr, totalM, diffColor) {
                var outPct = document.getElementById('cr_out_pct');
                var outBar = document.getElementById('cr_out_bar');
                var outThrows = document.getElementById('cr_out_throws');
                var outDiff = document.getElementById('cr_out_diff');
                var outBcr = document.getElementById('cr_out_bcr');
                var outMult = document.getElementById('cr_out_mult');

                if (outPct) outPct.textContent = pct.toFixed(1) + '%';
                if (outBar) outBar.style.width = Math.min(100, pct) + '%';
                if (outThrows) outThrows.textContent = throws <= 1 ? '1 Throw' : (throws > 20 ? '20+ Throws' : '1 – ' + throws + ' Throws');
                if (outDiff) {
                    outDiff.textContent = diff;
                    if (diffColor) outDiff.style.color = diffColor;
                }
                if (outBcr) outBcr.textContent = (bcr * 100).toFixed(1) + '%';
                if (outMult) outMult.textContent = totalM.toFixed(2) + '×';
            }

            window.applyPreset = function(preset) {
                if (preset === 'raid') {
                    document.getElementById('cr_ball').value = 'premier';
                    document.getElementById('cr_berry').value = 'golden_razz';
                    document.getElementById('cr_throw').value = 'curve_excel';
                    document.getElementById('cr_medal').value = 'plat';
                    document.getElementById('cr_encounter').value = 'raid';
                    calcCR();
                }
            };

            window.resetCR = function() {
                document.getElementById('cr_ball').value = 'greatball';
                document.getElementById('cr_berry').value = 'none';
                document.getElementById('cr_throw').value = 'curve_great';
                document.getElementById('cr_medal').value = 'gold';
                document.getElementById('cr_encounter').value = 'wild';
                document.getElementById('cr_weather').checked = false;
                calcCR();
            };

            updatePokemonBadge();
            calcCR();
        })();
        </script>
        <?php
        return ob_get_clean();
    }
}
