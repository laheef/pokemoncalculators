<?php
/**
 * Admin Tools Management Index View
 * Pokemon Calculator Hub Custom CMS
 */
?>

<div class="pkm-admin-header">
    <div>
        <h1 class="pkm-admin-title">Calculators & Tools Manager</h1>
        <p class="pkm-admin-subtitle">Add, edit, reorder, or toggle Pokemon calculators across the hub.</p>
    </div>
    <div class="pkm-admin-actions">
        <a href="<?= esc_url(home_url('admin/tools/create')) ?>" class="pkm-btn pkm-btn-primary">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add New Calculator
        </a>
    </div>
</div>

<div class="pkm-card">
    <div class="pkm-table-responsive">
        <table class="pkm-table">
            <thead>
                <tr>
                    <th style="width: 50px;">Order</th>
                    <th style="width: 50px;">Icon</th>
                    <th>Name</th>
                    <th>Slug & Route</th>
                    <th>Category</th>
                    <th>PHP File</th>
                    <th>Status</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($tools)): ?>
                    <?php foreach ($tools as $tool): ?>
                        <tr>
                            <td>
                                <strong>#<?= intval($tool['sort_order']) ?></strong>
                            </td>
                            <td>
                                <div style="width: 32px; height: 32px; display:flex; align-items:center; justify-content:center; background:var(--pkm-admin-bg); border-radius:6px; color:var(--pkm-admin-primary);">
                                    <?= pkm_render_tool_icon($tool['icon_svg'] ?? '') ?>
                                </div>
                            </td>
                            <td>
                                <strong style="font-size:0.95rem;"><?= esc_html($tool['name']) ?></strong>
                                <div style="font-size:0.8rem; color:var(--pkm-admin-text-muted); max-width:280px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                                    <?= esc_html($tool['short_description'] ?? '') ?>
                                </div>
                            </td>
                            <td>
                                <a href="<?= esc_url(home_url($tool['slug'])) ?>" target="_blank" style="color:var(--pkm-admin-primary); text-decoration:none; font-family:monospace; font-size:0.85rem;">
                                    /<?= esc_html($tool['slug']) ?> &nearr;
                                </a>
                            </td>
                            <td>
                                <span class="pkm-badge pkm-badge-secondary">
                                    <?= esc_html($tool['category_name'] ?? 'General') ?>
                                </span>
                            </td>
                            <td>
                                <code style="font-size:0.8rem; background:var(--pkm-admin-bg); padding:2px 6px; border-radius:4px;">
                                    <?= esc_html($tool['file_name']) ?>
                                </code>
                            </td>
                            <td>
                                <a href="<?= esc_url(home_url('admin/tools/toggle?id=' . $tool['id'])) ?>" style="text-decoration:none;">
                                    <?php if ($tool['is_active']): ?>
                                        <span class="pkm-badge pkm-badge-success" title="Click to disable">Active</span>
                                    <?php else: ?>
                                        <span class="pkm-badge pkm-badge-warning" title="Click to enable">Inactive</span>
                                    <?php endif; ?>
                                </a>
                            </td>
                            <td style="text-align: right; white-space: nowrap;">
                                <a href="<?= esc_url(home_url('admin/tools/edit?id=' . $tool['id'])) ?>" class="pkm-btn pkm-btn-secondary pkm-btn-sm">
                                    Edit
                                </a>
                                <form method="POST" action="<?= esc_url(home_url('admin/tools/delete')) ?>" class="confirm-delete" style="display:inline-block; margin-left:4px;">
                                    <?= \App\Admin\Auth::csrfInput() ?>
                                    <input type="hidden" name="id" value="<?= intval($tool['id']) ?>">
                                    <button type="submit" class="pkm-btn pkm-btn-danger pkm-btn-sm" style="padding:4px 8px;">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align:center; padding:32px; color:var(--pkm-admin-text-muted);">
                            No tools found in the database.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
