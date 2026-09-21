<?php
/**
 * Admin Profile & Account Settings View
 * Pokemon Calculator Hub Custom CMS
 */
?>

<div class="pkm-admin-header">
    <div>
        <h1 class="pkm-admin-title">My Profile & Account</h1>
        <p class="pkm-admin-subtitle">Update your personal account information, email address, and login credentials.</p>
    </div>
</div>

<div style="max-width:680px; margin:0 auto;">
    <div class="pkm-card">
        <div class="pkm-card-header">
            <h2 class="pkm-card-title">Account Details</h2>
            <span class="pkm-badge pkm-badge-primary">Role: <?= esc_html(ucfirst($user['role'] ?? 'admin')) ?></span>
        </div>

        <form method="POST" action="<?= esc_url(home_url('admin/profile/update')) ?>">
            <?= \App\Admin\Auth::csrfInput() ?>

            <div class="pkm-form-group">
                <label class="pkm-form-label" for="username">Username *</label>
                <input type="text" id="username" name="username" class="pkm-form-control" required
                       value="<?= esc_attr($user['username'] ?? '') ?>">
            </div>

            <div class="pkm-form-group">
                <label class="pkm-form-label" for="email">Email Address *</label>
                <input type="email" id="email" name="email" class="pkm-form-control" required
                       value="<?= esc_attr($user['email'] ?? '') ?>">
            </div>

            <div style="margin-top:28px; padding-top:20px; border-top:1px solid var(--pkm-admin-card-border);">
                <h3 style="font-size:1.05rem; color:var(--pkm-admin-text); margin-bottom:14px;">Change Password (Optional)</h3>

                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="current_password">Current Password</label>
                    <input type="password" id="current_password" name="current_password" class="pkm-form-control" placeholder="Required only if changing password">
                </div>

                <div class="pkm-form-row">
                    <div class="pkm-form-group">
                        <label class="pkm-form-label" for="new_password">New Password</label>
                        <input type="password" id="new_password" name="new_password" class="pkm-form-control" placeholder="Minimum 6 characters">
                    </div>

                    <div class="pkm-form-group">
                        <label class="pkm-form-label" for="confirm_password">Confirm New Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="pkm-form-control" placeholder="Re-type new password">
                    </div>
                </div>
            </div>

            <div style="margin-top:24px; padding-top:16px; border-top:1px solid var(--pkm-admin-card-border); text-align:right;">
                <button type="submit" class="pkm-btn pkm-btn-primary" style="padding:10px 24px;">
                    Save Profile Changes
                </button>
            </div>
        </form>
    </div>
</div>
