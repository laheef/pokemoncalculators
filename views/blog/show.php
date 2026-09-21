<?php
/**
 * Frontend Single Blog Post View
 * Pokemon Calculator Hub Custom CMS
 */
?>

<div class="pkm-single-post-wrap" style="max-width:880px; margin:40px auto 80px; padding:0 24px;">
    
    <!-- Article Header -->
    <header class="pkm-post-header" style="text-align:center; margin-bottom:32px;">
        <?php if (!empty($post['category_name'])): ?>
            <a href="<?= esc_url(home_url('blog?cat=' . urlencode($post['category_slug'] ?? ''))) ?>" 
               style="display:inline-block; padding:4px 14px; background:var(--pkm-primary-light); color:var(--pkm-primary); border-radius:20px; font-size:0.85rem; font-weight:700; text-decoration:none; margin-bottom:14px;">
                <?= esc_html($post['category_name']) ?>
            </a>
        <?php endif; ?>
        
        <h1 style="font-size:clamp(1.8rem, 4vw, 2.8rem); font-weight:800; color:var(--pkm-text); line-height:1.2; margin-bottom:16px;">
            <?= esc_html($post['title']) ?>
        </h1>

        <div class="pkm-post-meta" style="color:var(--pkm-text-muted); font-size:0.9rem; display:flex; justify-content:center; gap:16px; align-items:center;">
            <span>By <strong><?= esc_html($post['author_name'] ?? 'Pokemon Hub Team') ?></strong></span>
            <span>&bull;</span>
            <time datetime="<?= esc_attr($post['published_at']) ?>"><?= date('F j, Y', strtotime($post['published_at'])) ?></time>
            <span>&bull;</span>
            <span><?= intval($post['views_count'] ?? 0) ?> views</span>
        </div>
    </header>

    <!-- Featured Image -->
    <?php if (!empty($post['featured_image'])): ?>
        <div class="pkm-post-featured-img" style="margin-bottom:36px; border-radius:var(--pkm-radius-lg); overflow:hidden; box-shadow:var(--pkm-shadow-sm);">
            <img src="<?= esc_url(home_url($post['featured_image'])) ?>" alt="<?= esc_attr($post['title']) ?>" style="width:100%; height:auto; display:block;">
        </div>
    <?php endif; ?>

    <!-- Article Body -->
    <article class="pkm-post-content pkm-prose" style="background:var(--pkm-bg-card); border:1px solid var(--pkm-border); border-radius:var(--pkm-radius-lg); padding:36px; box-shadow:var(--pkm-shadow-sm); line-height:1.8; color:var(--pkm-text); font-size:1.05rem;">
        <?= $post['content'] ?>
    </article>

    <!-- Post Tags -->
    <?php if (!empty($tags)): ?>
        <div class="pkm-post-tags" style="margin-top:24px; display:flex; gap:8px; flex-wrap:wrap; align-items:center;">
            <span style="font-size:0.9rem; font-weight:700; color:var(--pkm-text-muted);">Tags:</span>
            <?php foreach ($tags as $tag): ?>
                <span style="background:var(--pkm-bg-3); border:1px solid var(--pkm-border); color:var(--pkm-text); padding:4px 10px; border-radius:var(--pkm-radius-sm); font-size:0.85rem;">
                    #<?= esc_html($tag['name']) ?>
                </span>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Related Articles -->
    <?php if (!empty($related_posts)): ?>
        <section class="pkm-related-articles" style="margin-top:60px; padding-top:40px; border-top:1px solid var(--pkm-border);">
            <h3 style="font-size:1.4rem; color:var(--pkm-text); margin-bottom:20px;">Related Guides & Articles</h3>
            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(250px, 1fr)); gap:20px;">
                <?php foreach ($related_posts as $rel): ?>
                    <a href="<?= esc_url(home_url('blog/' . $rel['slug'])) ?>" class="pkm-calc-card" style="padding:20px;">
                        <span style="font-size:0.75rem; color:var(--pkm-primary); font-weight:700; text-transform:uppercase;">
                            <?= esc_html($rel['category_name'] ?? 'Guide') ?>
                        </span>
                        <h4 style="font-size:1.05rem; font-weight:700; color:var(--pkm-text); margin:8px 0;">
                            <?= esc_html($rel['title']) ?>
                        </h4>
                        <p style="font-size:0.85rem; color:var(--pkm-text-muted);">
                            <?= esc_html($rel['excerpt'] ?: wp_trim_words(strip_tags($rel['content']), 12)) ?>
                        </p>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

</div>
