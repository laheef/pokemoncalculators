<?php
/**
 * Calculators Hub Listing View
 * Pokemon Calculator Hub
 */

$hero_title = pkm_t('popular_title', 'All Pokémon Calculators & Tools');
$hero_sub   = pkm_t('popular_subtitle', 'Explore our complete suite of free, accurate battle and GO calculators.');
$search_placeholder = pkm_t('search_placeholder', 'Search calculators, tools, mechanics...');
?>

<!-- HERO SECTION -->
<section class="pkm-calc-hero">
    <div class="pkm-calc-hero-inner">
        <h1><?= esc_html($hero_title) ?></h1>
        <p><?= esc_html($hero_sub) ?></p>
        
        <!-- Live AJAX Search -->
        <div class="pkm-search-wrap">
            <input type="text"
                   id="pkm-calc-search"
                   class="pkm-search-input"
                   placeholder="<?= esc_attr($search_placeholder) ?>"
                   autocomplete="off"
                   aria-label="<?= esc_attr($search_placeholder) ?>"
                   oninput="pkmSearchTools(this.value)" />
            <span class="pkm-search-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </span>
        </div>
        <div id="pkm-search-count" style="margin-top:12px; font-size:0.9rem; opacity:0.9; color:#fff;"></div>
    </div>
</section>

<!-- MAIN LISTING CONTAINER -->
<div class="pkm-calc-listing">
    <div class="pkm-calc-listing-inner">
        <!-- CATEGORY PILLS BAR -->
        <div class="pkm-cat-pills-wrap">
            <button class="pkm-cat-pill active" onclick="filterByCat('all', this)">
                All Tools (<?= count($tools ?? []) ?>)
            </button>
            <?php foreach ($categories ?? [] as $cat): ?>
                <button class="pkm-cat-pill" onclick="filterByCat('<?= esc_attr($cat['slug']) ?>', this)">
                    <?= esc_html($cat['name']) ?>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- CALCULATOR CARDS GRID -->
        <div class="pkm-calc-grid" id="pkm-tools-grid">
            <?php if (!empty($tools)): ?>
                <?php foreach ($tools as $tool): ?>
                    <a href="<?= esc_url(home_url($tool['slug'])) ?>" 
                       class="pkm-calc-card" 
                       data-cat="<?= esc_attr($tool['category_slug'] ?? 'general') ?>"
                       data-name="<?= esc_attr($tool['name'] . ' ' . ($tool['short_name'] ?? '')) ?>"
                       data-desc="<?= esc_attr($tool['short_description'] ?? '') ?>">
                        
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
            <?php else: ?>
                <p style="text-align:center; grid-column:1/-1; padding:40px; color:var(--pkm-text-muted);">No calculators found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
function filterByCat(catSlug, btn) {
    document.querySelectorAll('.pkm-cat-pill').forEach(function(b) { b.classList.remove('active'); });
    if (btn) btn.classList.add('active');

    var cards = document.querySelectorAll('.pkm-calc-card');
    cards.forEach(function(card) {
        if (catSlug === 'all' || card.getAttribute('data-cat') === catSlug) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}

function pkmSearchTools(val) {
    var q = val.trim().toLowerCase();
    var cards = document.querySelectorAll('.pkm-calc-card');
    var visibleCount = 0;

    cards.forEach(function(card) {
        var name = (card.getAttribute('data-name') || '').toLowerCase();
        var desc = (card.getAttribute('data-desc') || '').toLowerCase();
        if (name.includes(q) || desc.includes(q)) {
            card.style.display = 'flex';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });

    var countEl = document.getElementById('pkm-search-count');
    if (countEl) {
        if (q.length > 0) {
            countEl.textContent = 'Found ' + visibleCount + ' matching calculator' + (visibleCount === 1 ? '' : 's');
        } else {
            countEl.textContent = '';
        }
    }
}
</script>
