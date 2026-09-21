<?php
/**
 * Admin Page Create/Edit Form View
 * Pokemon Calculator Hub Custom CMS
 */

$isEdit = !empty($page['id']);
$formAction = $isEdit ? home_url('admin/pages/update') : home_url('admin/pages/store');
$currentWidthTemplate = $page['page_width_template'] ?? 'boxed';
?>

<div class="pkm-admin-header">
    <div>
        <h1 class="pkm-admin-title"><?= $isEdit ? 'Edit Page: ' . esc_html($page['title']) : 'Create New Page' ?></h1>
        <p class="pkm-admin-subtitle">Design your page, set layout width, category associations, and SEO metadata.</p>
    </div>
    <div class="pkm-admin-actions">
        <a href="<?= esc_url(home_url('admin/pages')) ?>" class="pkm-btn pkm-btn-secondary">
            &larr; Back to Pages
        </a>
    </div>
</div>

<form method="POST" action="<?= esc_url($formAction) ?>">
    <?= \App\Admin\Auth::csrfInput() ?>
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?= intval($page['id']) ?>">
    <?php endif; ?>

    <div style="display:grid; grid-template-columns: 2.5fr 1fr; gap:24px;">
        
        <!-- MAIN CONTENT COLUMN -->
        <div>
            <div class="pkm-card">
                <div class="pkm-card-header">
                    <h2 class="pkm-card-title">Page Content</h2>
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="itemTitle">Page Title *</label>
                    <input type="text" id="itemTitle" name="title" class="pkm-form-control" required 
                           value="<?= esc_attr($page['title'] ?? '') ?>" placeholder="e.g. About Us">
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="itemSlug">URL Slug *</label>
                    <input type="text" id="itemSlug" name="slug" class="pkm-form-control" required 
                           value="<?= esc_attr($page['slug'] ?? '') ?>" placeholder="about-us"
                           <?= $isEdit ? 'data-autogen="false"' : 'data-autogen="true"' ?>>
                    <span class="pkm-form-help">Accessible at: <code><?= esc_url(home_url('')) ?>[slug]</code></span>
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="excerpt">Excerpt / Subtitle</label>
                    <textarea id="excerpt" name="excerpt" class="pkm-form-control" style="min-height:70px;"
                              placeholder="Brief summary or introductory lead..."><?= esc_html($page['excerpt'] ?? '') ?></textarea>
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="content">Page Body / HTML Content *</label>
                    <textarea id="content" name="content" class="pkm-form-control" style="min-height:380px; font-family:monospace; font-size:0.9rem;"
                              placeholder="Write clean HTML or formatted text content here..."><?= esc_html($page['content'] ?? '') ?></textarea>
                </div>
            </div>

            <!-- SEO & Metadata -->
            <div class="pkm-card">
                <div class="pkm-card-header">
                    <h2 class="pkm-card-title">SEO & OpenGraph Configuration</h2>
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="meta_title">Custom Meta Title</label>
                    <input type="text" id="meta_title" name="meta_title" class="pkm-form-control"
                           value="<?= esc_attr($page['meta_title'] ?? '') ?>" placeholder="Leave blank to use Page Title">
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="meta_description">Meta Description</label>
                    <textarea id="meta_description" name="meta_description" class="pkm-form-control" style="min-height:70px;"
                              placeholder="Search engine snippet description (recommended 140-160 characters)..."><?= esc_html($page['meta_description'] ?? '') ?></textarea>
                </div>
            </div>
        </div>

        <!-- SIDEBAR CONFIG COLUMN -->
        <div>
            <div class="pkm-card">
                <div class="pkm-card-header">
                    <h2 class="pkm-card-title">Publishing & Layout</h2>
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="status">Publish Status</label>
                    <select id="status" name="status" class="pkm-form-control">
                        <option value="published" <?= ($page['status'] ?? 'published') === 'published' ? 'selected' : '' ?>>Published</option>
                        <option value="draft" <?= ($page['status'] ?? '') === 'draft' ? 'selected' : '' ?>>Draft</option>
                    </select>
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="category_id">Category Association</label>
                    <select id="category_id" name="category_id" class="pkm-form-control">
                        <option value="">-- No Category Association --</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= intval($cat['id']) ?>" <?= intval($page['category_id'] ?? 0) === intval($cat['id']) ? 'selected' : '' ?>>
                                <?= esc_html($cat['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="pkm-form-help">Automatically displays matching calculators at the bottom of the page!</span>
                </div>

                <!-- Page Width Template Selection -->
                <div class="pkm-form-group" style="margin-top:16px;">
                    <label class="pkm-form-label" for="page_width_template">Page Width Template</label>
                    <select id="page_width_template" name="page_width_template" class="pkm-form-control" onchange="toggleCustomWidthField(this.value)">
                        <option value="boxed" <?= $currentWidthTemplate === 'boxed' ? 'selected' : '' ?>>Boxed (Max 1280px)</option>
                        <option value="full" <?= $currentWidthTemplate === 'full' ? 'selected' : '' ?>>Full Width (100% Fluid)</option>
                        <option value="custom" <?= $currentWidthTemplate === 'custom' ? 'selected' : '' ?>>Custom Pixel Width</option>
                    </select>
                </div>

                <div class="pkm-form-group" id="customWidthWrap" style="display: <?= $currentWidthTemplate === 'custom' ? 'block' : 'none' ?>;">
                    <label class="pkm-form-label" for="custom_width">Custom Width (px)</label>
                    <input type="number" id="custom_width" name="custom_width" class="pkm-form-control"
                           value="<?= intval($page['custom_width'] ?? 1000) ?>" min="400" max="2400" step="10">
                </div>

                <div style="margin-top:24px; padding-top:16px; border-top:1px solid var(--pkm-admin-card-border);">
                    <button type="submit" class="pkm-btn pkm-btn-primary" style="width:100%; justify-content:center;">
                        <?= $isEdit ? 'Save Changes' : 'Publish Page' ?>
                    </button>
                </div>
            </div>
        </div>

    </div>
</form>

<script>
function toggleCustomWidthField(val) {
    const wrap = document.getElementById('customWidthWrap');
    if (wrap) {
        wrap.style.display = (val === 'custom') ? 'block' : 'none';
    }
}
</script>
