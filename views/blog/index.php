<?php
/**
 * Frontend Blog Listing View
 * Pokemon Calculator Hub Custom CMS
 */

$hero_title = pkm_t('blog_title', 'Pokémon Guides & Battle Strategy Blog');
$hero_sub   = pkm_t('blog_subtitle', 'In-depth Community Day guides, competitive VGC spreads, and calculator tutorials.');
$search_placeholder = pkm_t('blog_search_placeholder', 'Search articles, guides, strategies...');
?>

<!-- HERO SECTION -->
<section class="pkm-blog-hero">
    <div class="pkm-blog-hero-inner">
        <h1><?= esc_html($hero_title) ?></h1>
        <p><?= esc_html($hero_sub) ?></p>
        
        <!-- Search bar -->
        <form method="GET" action="<?= esc_url(home_url('blog')) ?>" class="pkm-search-wrap" style="max-width:600px; margin:24px auto 0;">
            <input type="text"
                   name="q"
                   class="pkm-search-input"
                   placeholder="<?= esc_attr($search_placeholder) ?>"
                   value="<?= esc_attr($search_query ?? '') ?>"
                   aria-label="<?= esc_attr($search_placeholder) ?>" />
            <button type="submit" class="pkm-search-icon" style="background:none; border:none; cursor:pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </button>
        </form>
    </div>
</section>

<!-- MAIN BLOG CONTAINER -->
<div class="pkm-blog-listing">
    <div class="pkm-blog-listing-inner" style="max-width:1200px; margin:0 auto; padding:48px 24px;">
        
        <!-- CATEGORY PILLS BAR -->
        <?php if (!empty($categories)): ?>
        <div class="pkm-cat-pills-wrap" style="margin-bottom:36px;">
            <a href="<?= esc_url(home_url('blog')) ?>" class="pkm-cat-pill <?= empty($active_cat) ? 'active' : '' ?>">
                All Articles (<?= count($posts ?? []) ?>)
            </a>
            <?php foreach ($categories as $cat): ?>
                <a href="<?= esc_url(home_url('blog?cat=' . urlencode($cat['slug']))) ?>" 
                   class="pkm-cat-pill <?= ($active_cat ?? '') === $cat['slug'] ? 'active' : '' ?>">
                    <?= esc_html($cat['name']) ?> (<?= intval($cat['post_count'] ?? 0) ?>)
                </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- POSTS GRID -->
        <?php if (!empty($posts)): ?>
            <div class="pkm-blog-grid" style="display:grid; grid-template-columns:repeat(auto-fill, minmax(320px, 1fr)); gap:28px;">
                <?php foreach ($posts as $post): ?>
                    <article class="pkm-calc-card" style="display:flex; flex-direction:column; justify-content:space-between; padding:28px; background:var(--pkm-bg-card); border:1px solid var(--pkm-border); border-radius:var(--pkm-radius-lg); box-shadow:var(--pkm-shadow-sm); transition:var(--pkm-transition);">
                        <div>
                            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:14px; font-size:0.85rem;">
                                <span class="pkm-calc-card-cat" style="font-size:0.75rem; font-weight:700; color:var(--pkm-primary); background:var(--pkm-primary-light); padding:3px 10px; border-radius:20px; text-transform:uppercase;">
                                    <?= esc_html($post['category_name'] ?? 'Guides') ?>
                                </span>
                                <span style="color:var(--pkm-text-muted); font-size:0.8rem;">
                                    <?= date('M j, Y', strtotime($post['published_at'])) ?>
                                </span>
                            </div>
                            
                            <h2 style="font-size:1.2rem; font-family:var(--pkm-font-heading); font-weight:800; color:var(--pkm-text); margin-bottom:12px; line-height:1.4;">
                                <a href="<?= esc_url(home_url('blog/' . $post['slug'])) ?>" style="color:inherit; text-decoration:none;">
                                    <?= esc_html($post['title']) ?>
                                </a>
                            </h2>
                            
                            <p style="color:var(--pkm-text-muted); font-size:0.92rem; line-height:1.6; margin-bottom:20px;">
                                <?= esc_html($post['excerpt'] ?: wp_trim_words(strip_tags($post['content']), 22)) ?>
                            </p>
                        </div>
                        
                        <div style="border-top:1px solid var(--pkm-border); padding-top:14px; display:flex; justify-content:space-between; align-items:center;">
                            <span style="font-size:0.8rem; color:var(--pkm-text-muted);">By <?= esc_html($post['author_name'] ?? 'Pokemon Hub Team') ?></span>
                            <a href="<?= esc_url(home_url('blog/' . $post['slug'])) ?>" class="pkm-calc-card-btn" style="color:var(--pkm-primary); font-weight:700; text-decoration:none; display:inline-flex; align-items:center; gap:4px; font-size:0.875rem;">
                                Read Guide &rarr;
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div style="text-align:center; padding:60px 20px; background:var(--pkm-bg-card); border-radius:var(--pkm-radius-lg); border:1px solid var(--pkm-border);">
                <h3 style="font-size:1.3rem; color:var(--pkm-text); margin-bottom:8px;">No Articles Found</h3>
                <p style="color:var(--pkm-text-muted);">No guides matched your search or category filter. Check back soon for new articles!</p>
            </div>
        <?php endif; ?>

    </div>
</div>
