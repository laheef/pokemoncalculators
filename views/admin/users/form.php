<?php
/**
 * Admin User Create/Edit Form View
 * Pokemon Calculator Hub Custom CMS
 */

$isEdit = !empty($edit_user['id']);
$formAction = $isEdit ? home_url('admin/users/update') : home_url('admin/users/store');
?>

<div class="pkm-admin-header">
    <div>
        <h1 class="pkm-admin-title"><?= $isEdit ? 'Edit User: ' . esc_html($edit_user['username']) : 'Add New User' ?></h1>
        <p class="pkm-admin-subtitle">Configure credentials, email, and assign role-based permissions.</p>
    </div>
    <div class="pkm-admin-actions">
        <a href="<?= esc_url(home_url('admin/users')) ?>" class="pkm-btn pkm-btn-secondary">
            &larr; Back to Users
        </a>
    </div>
</div>

<div style="max-width:640px; margin:0 auto;">
    <div class="pkm-card">
        <form method="POST" action="<?= esc_url($formAction) ?>">
            <?= \App\Admin\Auth::csrfInput() ?>
            <?php if ($isEdit): ?>
                <input type="hidden" name="id" value="<?= intval($edit_user['id']) ?>">
            <?php endif; ?>

            <div class="pkm-form-group">
                <label class="pkm-form-label" for="username">Username *</label>
                <input type="text" id="username" name="username" class="pkm-form-control" required
                       value="<?= esc_attr($edit_user['username'] ?? '') ?>" placeholder="e.g. RedTrainer">
            </div>

            <div class="pkm-form-group">
                <label class="pkm-form-label" for="email">Email Address *</label>
                <input type="email" id="email" name="email" class="pkm-form-control" required
                       value="<?= esc_attr($edit_user['email'] ?? '') ?>" placeholder="user@example.com">
            </div>

            <div class="pkm-form-group">
                <label class="pkm-form-label" for="role">Role & Access Level *</label>
                <select id="role" name="role" class="pkm-form-control" required>
                    <option value="author" <?= ($edit_user['role'] ?? '') === 'author' ? 'selected' : '' ?>>
                        Author — Can write & publish own blog guides
                    </option>
                    <option value="editor" <?= ($edit_user['role'] ?? 'editor') === 'editor' ? 'selected' : '' ?>>
                        Editor — Can manage all tools, pages, articles & media
                    </option>
                    <option value="admin" <?= ($edit_user['role'] ?? '') === 'admin' ? 'selected' : '' ?>>
                        Administrator — Full system, settings & user management access
                    </option>
                </select>
            </div>

            <div class="pkm-form-group">
                <label class="pkm-form-label" for="password">
                    <?= $isEdit ? 'Change Password (leave empty to keep current)' : 'Password *' ?>
                </label>
                <input type="password" id="password" name="password" class="pkm-form-control" 
                       <?= $isEdit ? '' : 'required' ?> placeholder="••••••••">
            </div>

            <div style="margin-top:24px; padding-top:16px; border-top:1px solid var(--pkm-admin-card-border); display:flex; justify-content:space-between;">
                <a href="<?= esc_url(home_url('admin/users')) ?>" class="pkm-btn pkm-btn-secondary">Cancel</a>
                <button type="submit" class="pkm-btn pkm-btn-primary">
                    <?= $isEdit ? 'Update User' : 'Create User' ?>
                </button>
            </div>
        </form>
    </div>
</div>
