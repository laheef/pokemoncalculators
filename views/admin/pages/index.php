<?php
/**
 * Admin Pages Management Index View
 * Pokemon Calculator Hub Custom CMS
 */
?>

<div class="pkm-admin-header">
    <div>
        <h1 class="pkm-admin-title">Pages Manager</h1>
        <p class="pkm-admin-subtitle">Create and customize standalone pages (About, Contact, Terms, Policies, or custom landing pages).</p>
    </div>
    <div class="pkm-admin-actions">
        <a href="<?= esc_url(home_url('admin/pages/create')) ?>" class="pkm-btn pkm-btn-primary">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add New Page
        </a>
    </div>
</div>

<div class="pkm-card">
    <div class="pkm-table-responsive">
        <table class="pkm-table">
            <thead>
                <tr>
                    <th>Page Title</th>
                    <th>URL Slug</th>
                    <th>Category Association</th>
                    <th>Width Template</th>
                    <th>Status</th>
                    <th>Updated</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($pages)): ?>
                    <?php foreach ($pages as $page): ?>
                        <tr>
                            <td>
                                <strong style="font-size:0.95rem;"><?= esc_html($page['title']) ?></strong>
                            </td>
                            <td>
                                <a href="<?= esc_url(home_url($page['slug'])) ?>" target="_blank" style="color:var(--pkm-admin-primary); text-decoration:none; font-family:monospace; font-size:0.85rem;">
                                    /<?= esc_html($page['slug']) ?> &nearr;
                                </a>
                            </td>
                            <td>
                                <?php if (!empty($page['category_name'])): ?>
                                    <span class="pkm-badge pkm-badge-primary">
                                        <?= esc_html($page['category_name']) ?>
                                    </span>
                                <?php else: ?>
                                    <span style="color:var(--pkm-admin-text-muted); font-size:0.85rem;">None</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="pkm-badge pkm-badge-secondary">
                                    <?= esc_html(ucfirst($page['page_width_template'] ?? 'full')) ?>
                                    <?= ($page['page_width_template'] === 'custom') ? '(' . intval($page['custom_width']) . 'px)' : '' ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($page['status'] === 'published'): ?>
                                    <span class="pkm-badge pkm-badge-success">Published</span>
                                <?php else: ?>
                                    <span class="pkm-badge pkm-badge-warning">Draft</span>
                                <?php endif; ?>
                            </td>
                            <td style="font-size:0.85rem; color:var(--pkm-admin-text-muted);">
                                <?= date('M j, Y', strtotime($page['updated_at'] ?? $page['created_at'])) ?>
                            </td>
                            <td style="text-align: right; white-space: nowrap;">
                                <a href="<?= esc_url(home_url('admin/pages/edit?id=' . $page['id'])) ?>" class="pkm-btn pkm-btn-secondary pkm-btn-sm">
                                    Edit
                                </a>
                                <form method="POST" action="<?= esc_url(home_url('admin/pages/delete')) ?>" class="confirm-delete" style="display:inline-block; margin-left:4px;">
                                    <?= \App\Admin\Auth::csrfInput() ?>
                                    <input type="hidden" name="id" value="<?= intval($page['id']) ?>">
                                    <button type="submit" class="pkm-btn pkm-btn-danger pkm-btn-sm" style="padding:4px 8px;">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align:center; padding:32px; color:var(--pkm-admin-text-muted);">
                            No pages found. Click "Add New Page" to create your first page.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
