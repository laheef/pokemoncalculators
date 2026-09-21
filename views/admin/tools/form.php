<?php
/**
 * Admin Tool Create/Edit Form View
 * Pokemon Calculator Hub Custom CMS
 */

$isEdit = !empty($tool['id']);
$formAction = $isEdit ? home_url('admin/tools/update') : home_url('admin/tools/store');
?>

<div class="pkm-admin-header">
    <div>
        <h1 class="pkm-admin-title"><?= $isEdit ? 'Edit Calculator: ' . esc_html($tool['name']) : 'Add New Calculator' ?></h1>
        <p class="pkm-admin-subtitle">Configure calculator metadata, execution script, icons, and SEO parameters.</p>
    </div>
    <div class="pkm-admin-actions">
        <a href="<?= esc_url(home_url('admin/tools')) ?>" class="pkm-btn pkm-btn-secondary">
            &larr; Back to Tools List
        </a>
    </div>
</div>

<form method="POST" action="<?= esc_url($formAction) ?>">
    <?= \App\Admin\Auth::csrfInput() ?>
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?= intval($tool['id']) ?>">
    <?php endif; ?>

    <div style="display:grid; grid-template-columns: 2fr 1fr; gap:24px;">
        
        <!-- LEFT COLUMN: Main Info -->
        <div>
            <div class="pkm-card">
                <div class="pkm-card-header">
                    <h2 class="pkm-card-title">Basic Information</h2>
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="name">Tool Name *</label>
                    <input type="text" id="name" name="name" class="pkm-form-control" required 
                           value="<?= esc_attr($tool['name'] ?? '') ?>" placeholder="e.g. CP Calculator">
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="slug">URL Slug *</label>
                    <input type="text" id="slug" name="slug" class="pkm-form-control" required 
                           value="<?= esc_attr($tool['slug'] ?? '') ?>" placeholder="cp-calculator"
                           <?= $isEdit ? 'data-autogen="false"' : 'data-autogen="true"' ?>>
                    <span class="pkm-form-help">Will be accessible at: <code><?= esc_url(home_url('')) ?>[slug]</code></span>
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="short_description">Short Description</label>
                    <textarea id="short_description" name="short_description" class="pkm-form-control" style="min-height:80px;"
                              placeholder="Brief 1-2 sentence description for homepage cards and category grids..."><?= esc_html($tool['short_description'] ?? '') ?></textarea>
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="description">Full Description / Guide Notes</label>
                    <textarea id="description" name="description" class="pkm-form-control" style="min-height:120px;"
                              placeholder="Comprehensive description, how-to instructions, or formula explanations..."><?= esc_html($tool['description'] ?? '') ?></textarea>
                </div>
            </div>

            <!-- SEO & Meta Tags -->
            <div class="pkm-card">
                <div class="pkm-card-header">
                    <h2 class="pkm-card-title">SEO & Metadata</h2>
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="meta_title">Custom Meta Title</label>
                    <input type="text" id="meta_title" name="meta_title" class="pkm-form-control"
                           value="<?= esc_attr($tool['meta_title'] ?? '') ?>" placeholder="Leave blank to use Tool Name">
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="meta_description">Custom Meta Description</label>
                    <textarea id="meta_description" name="meta_description" class="pkm-form-control" style="min-height:70px;"
                              placeholder="Search engine snippet description (recommended 140-160 characters)..."><?= esc_html($tool['meta_description'] ?? '') ?></textarea>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: Configuration & Attributes -->
        <div>
            <div class="pkm-card">
                <div class="pkm-card-header">
                    <h2 class="pkm-card-title">Execution & Association</h2>
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="file_name">PHP Calculator File *</label>
                    <select id="file_name" name="file_name" class="pkm-form-control" required>
                        <?php foreach ($available_files as $f): ?>
                            <option value="<?= esc_attr($f) ?>" <?= ($tool['file_name'] ?? '') === $f ? 'selected' : '' ?>>
                                <?= esc_html($f) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="pkm-form-help">Located in <code>pkm-calculators/</code></span>
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="category_id">Category</label>
                    <select id="category_id" name="category_id" class="pkm-form-control">
                        <option value="">-- Uncategorized --</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= intval($cat['id']) ?>" <?= intval($tool['category_id'] ?? 0) === intval($cat['id']) ? 'selected' : '' ?>>
                                <?= esc_html($cat['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="sort_order">Display Order</label>
                    <input type="number" id="sort_order" name="sort_order" class="pkm-form-control" 
                           value="<?= intval($tool['sort_order'] ?? 10) ?>" min="0">
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="icon_svg">Icon SVG Markup or Keyword</label>
                    <input type="text" id="icon_svg" name="icon_svg" class="pkm-form-control"
                           value="<?= esc_attr($tool['icon_svg'] ?? '') ?>" placeholder="lightning, shield, sword, star, or SVG markup">
                </div>

                <div class="pkm-form-group" style="margin-top:16px;">
                    <label style="display:flex; align-items:center; gap:8px; cursor:pointer; font-weight:600;">
                        <input type="checkbox" name="is_active" value="1" <?= (!isset($tool['is_active']) || $tool['is_active']) ? 'checked' : '' ?>>
                        Publish & Enable Calculator
                    </label>
                </div>

                <div style="margin-top:24px; padding-top:16px; border-top:1px solid var(--pkm-admin-card-border);">
                    <button type="submit" class="pkm-btn pkm-btn-primary" style="width:100%; justify-content:center;">
                        <?= $isEdit ? 'Save Changes' : 'Create Calculator' ?>
                    </button>
                </div>
            </div>
        </div>

    </div>
</form>
