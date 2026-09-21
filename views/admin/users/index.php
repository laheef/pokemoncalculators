<?php
/**
 * Admin Users List View
 * Pokemon Calculator Hub Custom CMS
 */
?>

<div class="pkm-admin-header">
    <div>
        <h1 class="pkm-admin-title">Users & Team Management</h1>
        <p class="pkm-admin-subtitle">Manage administrator, editor, and author accounts with role-based access control.</p>
    </div>
    <div class="pkm-admin-actions">
        <a href="<?= esc_url(home_url('admin/users/create')) ?>" class="pkm-btn pkm-btn-primary">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add New User
        </a>
    </div>
</div>

<div class="pkm-card">
    <div class="pkm-table-responsive">
        <table class="pkm-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Articles Authored</th>
                    <th>Created</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                    <tr>
                        <td>
                            <div style="display:flex; align-items:center; gap:12px;">
                                <div style="width:36px; height:36px; border-radius:50%; background:var(--pkm-admin-primary); color:#FFF; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:0.9rem;">
                                    <?= strtoupper(substr($u['username'], 0, 1)) ?>
                                </div>
                                <div>
                                    <strong style="font-size:0.95rem;"><?= esc_html($u['username']) ?></strong>
                                    <?php if (intval($u['id']) === intval(\App\Admin\Auth::user()['id'] ?? 0)): ?>
                                        <span class="pkm-badge pkm-badge-primary" style="font-size:0.65rem; margin-left:4px;">You</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="mailto:<?= esc_attr($u['email']) ?>" style="color:var(--pkm-admin-primary); text-decoration:none;">
                                <?= esc_html($u['email']) ?>
                            </a>
                        </td>
                        <td>
                            <?php if ($u['role'] === 'admin'): ?>
                                <span class="pkm-badge pkm-badge-danger" style="background:rgba(239, 68, 68, 0.15); color:#EF4444;">Administrator</span>
                            <?php elseif ($u['role'] === 'editor'): ?>
                                <span class="pkm-badge pkm-badge-primary">Editor</span>
                            <?php else: ?>
                                <span class="pkm-badge pkm-badge-secondary">Author</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span style="font-size:0.9rem; font-weight:600;"><?= intval($u['posts_count'] ?? 0) ?></span> posts
                        </td>
                        <td style="font-size:0.85rem; color:var(--pkm-admin-text-muted);">
                            <?= date('M j, Y', strtotime($u['created_at'])) ?>
                        </td>
                        <td style="text-align: right; white-space: nowrap;">
                            <a href="<?= esc_url(home_url('admin/users/edit?id=' . $u['id'])) ?>" class="pkm-btn pkm-btn-secondary pkm-btn-sm">
                                Edit
                            </a>
                            <?php if (intval($u['id']) !== intval(\App\Admin\Auth::user()['id'] ?? 0)): ?>
                                <form method="POST" action="<?= esc_url(home_url('admin/users/delete')) ?>" class="confirm-delete" style="display:inline-block; margin-left:4px;">
                                    <?= \App\Admin\Auth::csrfInput() ?>
                                    <input type="hidden" name="id" value="<?= intval($u['id']) ?>">
                                    <button type="submit" class="pkm-btn pkm-btn-danger pkm-btn-sm" style="padding:4px 8px;">
                                        Delete
                                    </button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
