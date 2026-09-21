<?php
/**
 * Admin Categories Index View
 * Pokemon Calculator Hub Custom CMS
 */
?>

<div class="pkm-admin-header">
    <div>
        <h1 class="pkm-admin-title">Categories Manager</h1>
        <p class="pkm-admin-subtitle">Organize calculators, pages, and blog posts into distinct Pokémon meta categories.</p>
    </div>
</div>

<div style="display:grid; grid-template-columns: 1fr 2fr; gap:24px;">

    <!-- QUICK ADD CATEGORY FORM -->
    <div>
        <div class="pkm-card">
            <div class="pkm-card-header">
                <h2 class="pkm-card-title">Add New Category</h2>
            </div>

            <form method="POST" action="<?= esc_url(home_url('admin/categories/store')) ?>">
                <?= \App\Admin\Auth::csrfInput() ?>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="itemTitle">Category Name *</label>
                    <input type="text" id="itemTitle" name="name" class="pkm-form-control" required placeholder="e.g. PvP & Battle Calculators">
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="itemSlug">Slug *</label>
                    <input type="text" id="itemSlug" name="slug" class="pkm-form-control" required placeholder="pvp-battle-calculators">
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="type">Taxonomy Type *</label>
                    <select id="type" name="type" class="pkm-form-control">
                        <option value="tool">Tool / Calculator Category</option>
                        <option value="blog">Blog Category</option>
                        <option value="general">General / Shared</option>
                    </select>
                </div>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="description">Description</label>
                    <textarea id="description" name="description" class="pkm-form-control" style="min-height:80px;"
                              placeholder="Brief category purpose..."></textarea>
                </div>

                <button type="submit" class="pkm-btn pkm-btn-primary" style="width:100%; justify-content:center;">
                    Save Category
                </button>
            </form>
        </div>
    </div>

    <!-- CATEGORIES TABLE -->
    <div>
        <div class="pkm-card">
            <div class="pkm-card-header">
                <h2 class="pkm-card-title">All Categories</h2>
            </div>

            <div class="pkm-table-responsive">
                <table class="pkm-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Type</th>
                            <th>Tools / Posts</th>
                            <th style="text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $cat): ?>
                                <tr>
                                    <td>
                                        <strong style="font-size:0.95rem;"><?= esc_html($cat['name']) ?></strong>
                                        <?php if (!empty($cat['description'])): ?>
                                            <div style="font-size:0.8rem; color:var(--pkm-admin-text-muted);"><?= esc_html($cat['description']) ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td><code><?= esc_html($cat['slug']) ?></code></td>
                                    <td>
                                        <span class="pkm-badge pkm-badge-primary">
                                            <?= esc_html(strtoupper($cat['type'])) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span style="font-size:0.85rem; color:var(--pkm-admin-text-muted);">
                                            <?= intval($cat['tool_count'] ?? 0) ?> tools / <?= intval($cat['post_count'] ?? 0) ?> posts
                                        </span>
                                    </td>
                                    <td style="text-align: right; white-space: nowrap;">
                                        <a href="<?= esc_url(home_url('admin/categories/edit?id=' . $cat['id'])) ?>" class="pkm-btn pkm-btn-secondary pkm-btn-sm">
                                            Edit
                                        </a>
                                        <form method="POST" action="<?= esc_url(home_url('admin/categories/delete')) ?>" class="confirm-delete" style="display:inline-block; margin-left:4px;">
                                            <?= \App\Admin\Auth::csrfInput() ?>
                                            <input type="hidden" name="id" value="<?= intval($cat['id']) ?>">
                                            <button type="submit" class="pkm-btn pkm-btn-danger pkm-btn-sm" style="padding:4px 8px;">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align:center; padding:32px; color:var(--pkm-admin-text-muted);">
                                    No categories created yet.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
