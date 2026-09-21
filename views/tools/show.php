<?php
/**
 * Single Calculator Page View
 * Pokemon Calculator Hub
 */
?>

<div class="pkm-tool-page-container">
    <!-- Tool Output Container -->
    <div class="pkm-tool-rendered-wrapper">
        <?= $tool_html ?? '' ?>
    </div>

    <!-- Related Tools Section -->
    <?php if (!empty($related_tools)): ?>
    <section class="pkm-related-tools-section" style="max-width:1080px; margin:48px auto; padding:0 20px;">
        <h2 style="font-size:1.6rem; font-family:var(--pkm-font-heading); color:var(--pkm-text); margin-bottom:24px; text-align:center;">
            Explore Related Calculators
        </h2>
        <div class="pkm-calc-grid">
            <?php foreach ($related_tools as $rel): ?>
                <a href="<?= esc_url(home_url($rel['slug'])) ?>" class="pkm-calc-card">
                    <div class="pkm-calc-card-top-row">
                        <div class="pkm-calc-card-icon">
                            <?= pkm_render_tool_icon($rel['icon_svg'] ?? '') ?>
                        </div>
                        <span class="pkm-calc-card-cat"><?= esc_html($rel['category_name'] ?? 'Tool') ?></span>
                    </div>
                    <div class="pkm-calc-card-body">
                        <h3 class="pkm-calc-card-title"><?= esc_html($rel['name']) ?></h3>
                        <p class="pkm-calc-card-desc"><?= esc_html($rel['short_description'] ?? '') ?></p>
                    </div>
                    <div class="pkm-calc-card-footer">
                        <span class="pkm-calc-card-btn">Open Calculator &rarr;</span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>
</div>
