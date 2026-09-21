<?php
/**
 * Admin Category Edit Form View
 * Pokemon Calculator Hub Custom CMS
 */
?>

<div class="pkm-admin-header">
    <div>
        <h1 class="pkm-admin-title">Edit Category: <?= esc_html($category['name']) ?></h1>
        <p class="pkm-admin-subtitle">Update taxonomy settings, slug, and description.</p>
    </div>
    <div class="pkm-admin-actions">
        <a href="<?= esc_url(home_url('admin/categories')) ?>" class="pkm-btn pkm-btn-secondary">
            &larr; Back to Categories
        </a>
    </div>
</div>

<div style="max-width:680px; margin:0 auto;">
    <div class="pkm-card">
        <form method="POST" action="<?= esc_url(home_url('admin/categories/update')) ?>">
            <?= \App\Admin\Auth::csrfInput() ?>
            <input type="hidden" name="id" value="<?= intval($category['id']) ?>">

            <div class="pkm-form-group">
                <label class="pkm-form-label" for="name">Category Name *</label>
                <input type="text" id="name" name="name" class="pkm-form-control" required 
                       value="<?= esc_attr($category['name']) ?>">
            </div>

            <div class="pkm-form-group">
                <label class="pkm-form-label" for="slug">Slug *</label>
                <input type="text" id="slug" name="slug" class="pkm-form-control" required 
                       value="<?= esc_attr($category['slug']) ?>">
            </div>

            <div class="pkm-form-group">
                <label class="pkm-form-label" for="type">Taxonomy Type *</label>
                <select id="type" name="type" class="pkm-form-control">
                    <option value="tool" <?= $category['type'] === 'tool' ? 'selected' : '' ?>>Tool / Calculator Category</option>
                    <option value="blog" <?= $category['type'] === 'blog' ? 'selected' : '' ?>>Blog Category</option>
                    <option value="general" <?= $category['type'] === 'general' ? 'selected' : '' ?>>General / Shared</option>
                </select>
            </div>

            <div class="pkm-form-group">
                <label class="pkm-form-label" for="description">Description</label>
                <textarea id="description" name="description" class="pkm-form-control" style="min-height:90px;"><?= esc_html($category['description'] ?? '') ?></textarea>
            </div>

            <div style="margin-top:24px; padding-top:16px; border-top:1px solid var(--pkm-admin-card-border); display:flex; justify-content:space-between;">
                <a href="<?= esc_url(home_url('admin/categories')) ?>" class="pkm-btn pkm-btn-secondary">Cancel</a>
                <button type="submit" class="pkm-btn pkm-btn-primary">Update Category</button>
            </div>
        </form>
    </div>
</div>
