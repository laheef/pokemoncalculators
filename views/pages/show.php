<?php
/**
 * Frontend Single Page View
 * Pokemon Calculator Hub Custom CMS
 */

$slug = $page['slug'] ?? '';
$template = $page['page_width_template'] ?? 'boxed';
$customWidth = intval($page['custom_width'] ?? 1080);

$maxWidth = '1040px';
if ($template === 'custom') {
    $maxWidth = "{$customWidth}px";
} elseif ($template === 'full') {
    $maxWidth = '1280px';
}

$contactSuccess = $_SESSION['contact_success'] ?? null;
$contactError = $_SESSION['contact_error'] ?? null;
unset($_SESSION['contact_success'], $_SESSION['contact_error']);

// Badge label
$badgeLabel = $page['category_name'] ?? '';
if (empty($badgeLabel)) {
    if (in_array($slug, ['about', 'about-us'])) {
        $badgeLabel = 'Our Mission & Story';
    } elseif (in_array($slug, ['contact', 'contact-us'])) {
        $badgeLabel = 'Get In Touch';
    } elseif (in_array($slug, ['privacy-policy', 'cookie-policy', 'terms-and-conditions'])) {
        $badgeLabel = 'Legal & Compliance';
    } else {
        $badgeLabel = 'Information';
    }
}
?>

<div class="pkm-static-page-root">
    
    <!-- Hero Header Banner -->
    <section class="pkm-page-hero" style="background: linear-gradient(135deg, #0D9488 0%, #134E4A 100%); color: #ffffff; padding: 64px 20px 80px; text-align: center; position: relative; overflow: hidden;">
        <div style="position: absolute; inset: 0; background: radial-gradient(circle at 20% 30%, rgba(255,255,255,0.08) 0%, transparent 50%), radial-gradient(circle at 80% 70%, rgba(20,184,166,0.2) 0%, transparent 60%); pointer-events: none;"></div>
        
        <div style="max-width: 860px; margin: 0 auto; position: relative; z-index: 2;">
            <?php if (!empty($badgeLabel)): ?>
                <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(255, 255, 255, 0.16); border: 1px solid rgba(255, 255, 255, 0.28); color: #FFFFFF; padding: 6px 18px; border-radius: 50px; font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 18px; backdrop-filter: blur(8px);">
                    <span style="width: 8px; height: 8px; background: #4ADE80; border-radius: 50%; display: inline-block;"></span>
                    <?= esc_html($badgeLabel) ?>
                </div>
            <?php endif; ?>

            <h1 style="font-size: clamp(2rem, 4.5vw, 2.9rem); font-weight: 800; font-family: var(--pkm-font-display, 'Exo 2', sans-serif); color: #ffffff; line-height: 1.2; margin: 0 0 16px; letter-spacing: -0.5px;">
                <?= esc_html($page['title']) ?>
            </h1>

            <?php if (!empty($page['excerpt'])): ?>
                <p style="color: rgba(255, 255, 255, 0.9); font-size: 1.125rem; line-height: 1.65; max-width: 720px; margin: 0 auto; font-family: var(--pkm-font-heading, sans-serif);">
                    <?= esc_html($page['excerpt']) ?>
                </p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Main Content Container -->
    <div class="pkm-page-container" style="max-width: <?= $maxWidth ?>; margin: -44px auto 64px; padding: 0 20px; position: relative; z-index: 10;">
        
        <?php if ($contactSuccess): ?>
            <div style="background: rgba(16, 185, 129, 0.15); border: 1px solid #10B981; color: #10B981; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px; font-weight: 600; text-align: center;">
                <?= esc_html($contactSuccess) ?>
            </div>
        <?php endif; ?>

        <?php if ($contactError): ?>
            <div style="background: rgba(239, 68, 68, 0.15); border: 1px solid #EF4444; color: #EF4444; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px; font-weight: 600; text-align: center;">
                <?= esc_html($contactError) ?>
            </div>
        <?php endif; ?>

        <!-- Content Card -->
        <article class="pkm-page-card pkm-prose" style="background: var(--pkm-bg-card, #ffffff); border: 1px solid var(--pkm-border, #e2e8f0); border-radius: 20px; padding: 48px; box-shadow: 0 12px 36px rgba(0,0,0,0.06); line-height: 1.8; color: var(--pkm-text); font-size: 1.02rem;">
            <?= $page['content'] ?>
        </article>

        <!-- Category Associated Tools Section -->
        <?php if (!empty($related_tools)): ?>
            <section class="pkm-category-tools-association" style="margin-top: 56px; margin-bottom: 24px;">
                <div class="pkm-section-title" style="text-align: center; margin-bottom: 28px;">
                    <h2 style="font-size: 1.6rem; font-weight: 800; font-family: var(--pkm-font-heading); color: var(--pkm-text);">
                        Featured <?= esc_html($page['category_name'] ?? 'Category') ?> Calculators
                    </h2>
                    <p style="color: var(--pkm-text-muted); font-size: 0.98rem; margin-top: 6px;">
                        Explore interactive tools related to this topic
                    </p>
                </div>
                <div class="pkm-calc-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
                    <?php foreach ($related_tools as $tool): ?>
                        <a href="<?= esc_url(home_url($tool['slug'])) ?>" class="pkm-calc-card">
                            <div class="pkm-calc-card-top-row">
                                <div class="pkm-calc-card-icon">
                                    <?= pkm_render_tool_icon($tool['icon_svg'] ?? '') ?>
                                </div>
                                <span class="pkm-calc-card-cat"><?= esc_html($tool['category_name'] ?? 'Tool') ?></span>
                            </div>
                            <div class="pkm-calc-card-body">
                                <h3 class="pkm-calc-card-title"><?= esc_html($tool['name']) ?></h3>
                                <p class="pkm-calc-card-desc"><?= esc_html($tool['short_description'] ?? '') ?></p>
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

</div>
