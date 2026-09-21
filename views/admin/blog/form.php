<?php
/**
 * Admin Blog Post Create/Edit Form View
 * Pokemon Calculator Hub Custom CMS
 */

$isEdit = !empty($post['id']);
$formAction = $isEdit ? home_url('admin/blog/update') : home_url('admin/blog/store');
$postTagsStr = !empty($post_tags) ? implode(', ', array_column($post_tags, 'name')) : '';
?>

<div class="pkm-admin-header">
    <div>
        <h1 class="pkm-admin-title"><?= $isEdit ? 'Edit Article: ' . esc_html($post['title']) : 'Write New Article' ?></h1>
        <p class="pkm-admin-subtitle">Publish Pokémon guides, strategy breakdowns, and SEO-optimized news.</p>
    </div>
    <div class="pkm-admin-actions">
        <a href="<?= esc_url(home_url('admin/blog')) ?>" class="pkm-btn pkm-btn-secondary">
            &larr; Back to Blog
        </a>
    </div>
</div>

<form method="POST" action="<?= esc_url($formAction) ?>">
    <?= \App\Admin\Auth::csrfInput() ?>
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?= intval($post['id']) ?>">
    <?php endif; ?>

    <div style="display:grid; grid-template-columns: 2.5fr 1fr; gap:24px;">
        
        <!-- MAIN CONTENT COLUMN -->
        <div>
            <div class="pkm-card">
                <div class="pkm-card-header">
                    <h2 class="pkm-card-title">Article Details</h2>
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="itemTitle">Post Title *</label>
                    <input type="text" id="itemTitle" name="title" class="pkm-form-control" required 
                           value="<?= esc_attr($post['title'] ?? '') ?>" placeholder="e.g. Complete IV and CP Guide for Great League Battles">
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="itemSlug">URL Slug *</label>
                    <input type="text" id="itemSlug" name="slug" class="pkm-form-control" required 
                           value="<?= esc_attr($post['slug'] ?? '') ?>" placeholder="iv-cp-guide-great-league"
                           <?= $isEdit ? 'data-autogen="false"' : 'data-autogen="true"' ?>>
                    <span class="pkm-form-help">Accessible at: <code><?= esc_url(home_url('blog/')) ?>[slug]</code></span>
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="excerpt">Excerpt / Preview Text</label>
                    <textarea id="excerpt" name="excerpt" class="pkm-form-control" style="min-height:70px;"
                              placeholder="Summary shown on article cards and search results..."><?= esc_html($post['excerpt'] ?? '') ?></textarea>
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="content">Article Content (HTML/Markdown) *</label>
                    <textarea id="content" name="content" class="pkm-form-control" style="min-height:420px; font-family:monospace; font-size:0.9rem;"
                              placeholder="Write your article content here..."><?= esc_html($post['content'] ?? '') ?></textarea>
                </div>
            </div>

            <!-- SEO & OpenGraph -->
            <div class="pkm-card">
                <div class="pkm-card-header">
                    <h2 class="pkm-card-title">SEO Optimization</h2>
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="meta_title">Custom SEO Title</label>
                    <input type="text" id="meta_title" name="meta_title" class="pkm-form-control"
                           value="<?= esc_attr($post['meta_title'] ?? '') ?>" placeholder="Leave empty to use Post Title">
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="meta_description">Custom Meta Description</label>
                    <textarea id="meta_description" name="meta_description" class="pkm-form-control" style="min-height:70px;"
                              placeholder="Recommended 140-160 characters..."><?= esc_html($post['meta_description'] ?? '') ?></textarea>
                </div>
            </div>
        </div>

        <!-- SIDEBAR CONFIG COLUMN -->
        <div>
            <div class="pkm-card">
                <div class="pkm-card-header">
                    <h2 class="pkm-card-title">Publishing & Taxonomy</h2>
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="status">Publish Status</label>
                    <select id="status" name="status" class="pkm-form-control">
                        <option value="published" <?= ($post['status'] ?? 'published') === 'published' ? 'selected' : '' ?>>Published</option>
                        <option value="draft" <?= ($post['status'] ?? '') === 'draft' ? 'selected' : '' ?>>Draft</option>
                    </select>
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="category_id">Category</label>
                    <select id="category_id" name="category_id" class="pkm-form-control">
                        <option value="">-- Uncategorized --</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= intval($cat['id']) ?>" <?= intval($post['category_id'] ?? 0) === intval($cat['id']) ? 'selected' : '' ?>>
                                <?= esc_html($cat['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="tags">Tags (Comma-separated)</label>
                    <input type="text" id="tags" name="tags" class="pkm-form-control"
                           value="<?= esc_attr($postTagsStr) ?>" placeholder="e.g. IV, Great League, PVP, CP">
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="featured_image">Featured Image URL</label>
                    <input type="text" id="featured_image" name="featured_image" class="pkm-form-control"
                           value="<?= esc_attr($post['featured_image'] ?? '') ?>" placeholder="uploads/2026/09/banner.jpg">
                    <span class="pkm-form-help">Tip: Upload in Media Library, then paste path or URL here.</span>
                </div>

                <div style="margin-top:24px; padding-top:16px; border-top:1px solid var(--pkm-admin-card-border);">
                    <button type="submit" class="pkm-btn pkm-btn-primary" style="width:100%; justify-content:center;">
                        <?= $isEdit ? 'Update Article' : 'Publish Article' ?>
                    </button>
                </div>
            </div>
        </div>

    </div>
</form>
