<?php
/**
 * Type Chart Controller
 * Pokemon Calculator Hub
 */

namespace App\Pages;

use App\Core\Request;
use App\Core\View;

class TypeChartController {
    public function index(Request $request): void {
        $html = $this->renderTypeChart();
        $seoData = [
            'title'       => 'Pokemon Type Chart & Matchup Matrix [Gen 1–9]',
            'meta_desc'   => 'Interactive Pokemon Type Chart showing strengths, weaknesses, resistances, and immunities for all 18 Pokemon types across Gen 1–9.',
            'canonical'   => home_url('type-chart'),
            'breadcrumbs' => [
                'Home'       => home_url('/'),
                'Type Chart' => home_url('type-chart')
            ]
        ];
        View::render('pages/type-chart', [
            'type_chart_html' => $html,
            'seo_data'        => $seoData,
            'body_class'      => 'pkm-type-chart-page'
        ]);
    }

    public function renderTypeChart(): string {
        $lang = pkm_get_current_lang();

        // All 18 types with colors and SVG icons
        $types = array(
            'Normal'   => array('color'=>'#9FA19F','bg'=>'#9FA19F20'),
            'Fire'     => array('color'=>'#FF6B35','bg'=>'#FF6B3520'),
            'Water'    => array('color'=>'#6890F0','bg'=>'#6890F020'),
            'Electric' => array('color'=>'#F8C030','bg'=>'#F8C03020'),
            'Grass'    => array('color'=>'#78C850','bg'=>'#78C85020'),
            'Ice'      => array('color'=>'#98D8D8','bg'=>'#98D8D820'),
            'Fighting' => array('color'=>'#C03028','bg'=>'#C0302820'),
            'Poison'   => array('color'=>'#A040A0','bg'=>'#A040A020'),
            'Ground'   => array('color'=>'#E0C068','bg'=>'#E0C06820'),
            'Flying'   => array('color'=>'#A890F0','bg'=>'#A890F020'),
            'Psychic'  => array('color'=>'#F85888','bg'=>'#F8588820'),
            'Bug'      => array('color'=>'#A8B820','bg'=>'#A8B82020'),
            'Rock'     => array('color'=>'#B8A038','bg'=>'#B8A03820'),
            'Ghost'    => array('color'=>'#705898','bg'=>'#70589820'),
            'Dragon'   => array('color'=>'#7038F8','bg'=>'#7038F820'),
            'Dark'     => array('color'=>'#705848','bg'=>'#70584820'),
            'Steel'    => array('color'=>'#B8B8D0','bg'=>'#B8B8D020'),
            'Fairy'    => array('color'=>'#EE99AC','bg'=>'#EE99AC20'),
        );

        $type_order = array_keys($types);

        // Matchup table
        $chart = [
            'Normal'   => ['Rock'=>0.5,'Ghost'=>0,'Steel'=>0.5],
            'Fire'     => ['Fire'=>0.5,'Water'=>0.5,'Grass'=>2,'Ice'=>2,'Bug'=>2,'Rock'=>0.5,'Dragon'=>0.5,'Steel'=>2],
            'Water'    => ['Fire'=>2,'Water'=>0.5,'Grass'=>0.5,'Ground'=>2,'Rock'=>2,'Dragon'=>0.5],
            'Electric' => ['Water'=>2,'Electric'=>0.5,'Grass'=>0.5,'Ground'=>0,'Flying'=>2,'Dragon'=>0.5],
            'Grass'    => ['Fire'=>0.5,'Water'=>2,'Grass'=>0.5,'Poison'=>0.5,'Ground'=>2,'Flying'=>0.5,'Bug'=>0.5,'Rock'=>2,'Dragon'=>0.5,'Steel'=>0.5],
            'Ice'      => ['Fire'=>0.5,'Water'=>0.5,'Grass'=>2,'Ice'=>0.5,'Ground'=>2,'Flying'=>2,'Dragon'=>2,'Steel'=>0.5],
            'Fighting' => ['Normal'=>2,'Ice'=>2,'Poison'=>0.5,'Flying'=>0.5,'Psychic'=>0.5,'Bug'=>0.5,'Rock'=>2,'Ghost'=>0,'Dark'=>2,'Steel'=>2,'Fairy'=>0.5],
            'Poison'   => ['Grass'=>2,'Poison'=>0.5,'Ground'=>0.5,'Rock'=>0.5,'Ghost'=>0.5,'Steel'=>0,'Fairy'=>2],
            'Ground'   => ['Fire'=>2,'Electric'=>2,'Grass'=>0.5,'Poison'=>2,'Flying'=>0,'Bug'=>0.5,'Rock'=>2,'Steel'=>2],
            'Flying'   => ['Electric'=>0.5,'Grass'=>2,'Fighting'=>2,'Bug'=>2,'Rock'=>0.5,'Steel'=>0.5],
            'Psychic'  => ['Fighting'=>2,'Poison'=>2,'Psychic'=>0.5,'Dark'=>0,'Steel'=>0.5],
            'Bug'      => ['Fire'=>0.5,'Grass'=>2,'Fighting'=>0.5,'Poison'=>0.5,'Flying'=>0.5,'Psychic'=>2,'Ghost'=>0.5,'Dark'=>2,'Steel'=>0.5,'Fairy'=>0.5],
            'Rock'     => ['Fire'=>2,'Ice'=>2,'Fighting'=>0.5,'Ground'=>0.5,'Flying'=>2,'Bug'=>2,'Steel'=>0.5],
            'Ghost'    => ['Normal'=>0,'Psychic'=>2,'Ghost'=>2,'Dark'=>0.5],
            'Dragon'   => ['Dragon'=>2,'Steel'=>0.5,'Fairy'=>0],
            'Dark'     => ['Fighting'=>0.5,'Psychic'=>2,'Ghost'=>2,'Dark'=>0.5,'Fairy'=>0.5],
            'Steel'    => ['Fire'=>0.5,'Water'=>0.5,'Electric'=>0.5,'Ice'=>2,'Rock'=>2,'Steel'=>0.5,'Fairy'=>2],
            'Fairy'    => ['Fire'=>0.5,'Fighting'=>2,'Poison'=>0.5,'Dragon'=>2,'Dark'=>2,'Steel'=>0.5],
        ];

        ob_start();
        ?>
        <div class="pkm-tc-page">
            <header class="pkm-tc-header" style="text-align:center; margin-bottom:32px;">
                <span style="display:inline-block; padding:4px 12px; background:var(--pkm-primary-light); color:var(--pkm-primary); font-weight:700; border-radius:20px; font-size:0.85rem; margin-bottom:12px;">GEN 1–9 REFERENCE</span>
                <h1 style="font-size:clamp(1.8rem, 4vw, 2.6rem); color:var(--pkm-text); margin-bottom:12px;">Pokemon Type Chart & Matchup Matrix</h1>
                <p style="color:var(--pkm-text-muted); max-width:680px; margin:0 auto; font-size:1.05rem; line-height:1.6;">
                    Complete weaknesses, resistances, and immunities for all 18 types. Hover or click any cell to highlight attack vs. defense effectiveness.
                </p>
            </header>

            <div class="pkm-tc-table-wrap" style="overflow-x:auto; background:var(--pkm-bg-card); border:1px solid var(--pkm-border); border-radius:var(--pkm-radius-lg); padding:20px; box-shadow:var(--pkm-shadow);">
                <table class="pkm-tc-table" style="width:100%; border-collapse:collapse; text-align:center; font-size:0.85rem;">
                    <thead>
                        <tr>
                            <th style="padding:10px; border:1px solid var(--pkm-border); background:var(--pkm-bg-3); color:var(--pkm-text); min-width:90px;">Attacking ↓ \ Defending →</th>
                            <?php foreach ($type_order as $def): ?>
                                <th style="padding:8px 4px; border:1px solid var(--pkm-border); background:<?= $types[$def]['color'] ?>; color:#fff; font-weight:700; min-width:40px;">
                                    <?= substr($def, 0, 3) ?>
                                </th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($type_order as $atk): ?>
                            <tr>
                                <th style="padding:8px 12px; border:1px solid var(--pkm-border); background:<?= $types[$atk]['color'] ?>; color:#fff; font-weight:700; text-align:left;">
                                    <?= $atk ?>
                                </th>
                                <?php foreach ($type_order as $def): ?>
                                    <?php
                                    $eff = $chart[$atk][$def] ?? 1.0;
                                    $cellBg = 'transparent';
                                    $cellText = '1';
                                    $cellColor = 'var(--pkm-text-muted)';
                                    if ($eff == 2.0) {
                                        $cellBg = 'rgba(46, 204, 113, 0.25)';
                                        $cellText = '2×';
                                        $cellColor = '#27ae60';
                                    } elseif ($eff == 0.5) {
                                        $cellBg = 'rgba(231, 76, 60, 0.2)';
                                        $cellText = '½';
                                        $cellColor = '#c0392b';
                                    } elseif ($eff == 0.0) {
                                        $cellBg = 'rgba(52, 73, 94, 0.35)';
                                        $cellText = '0';
                                        $cellColor = '#7f8c8d';
                                    }
                                    ?>
                                    <td style="padding:8px 4px; border:1px solid var(--pkm-border); background:<?= $cellBg ?>; color:<?= $cellColor ?>; font-weight:<?= $eff != 1 ? '700' : '400' ?>;">
                                        <?= $cellText ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}
