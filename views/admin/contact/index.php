<?php
/**
 * Admin Contact Messages Inbox View
 * Pokemon Calculator Hub Custom CMS
 */
?>

<div class="pkm-admin-header">
    <div>
        <h1 class="pkm-admin-title">Contact Messages Inbox</h1>
        <p class="pkm-admin-subtitle">User inquiries, feedback, bug reports, and partnership messages.</p>
    </div>
</div>

<div class="pkm-card">
    <div class="pkm-table-responsive">
        <table class="pkm-table">
            <thead>
                <tr>
                    <th style="width:130px;">Received</th>
                    <th style="width:180px;">Sender</th>
                    <th>Subject & Message</th>
                    <th style="width:100px;">Status</th>
                    <th style="text-align: right; width:140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($messages)): ?>
                    <?php foreach ($messages as $msg): ?>
                        <tr style="<?= !$msg['is_read'] ? 'font-weight:600; background:rgba(59, 130, 246, 0.04);' : '' ?>">
                            <td style="font-size:0.85rem; color:var(--pkm-admin-text-muted);">
                                <?= date('M j, Y H:i', strtotime($msg['created_at'])) ?>
                            </td>
                            <td>
                                <div><?= esc_html($msg['name']) ?></div>
                                <a href="mailto:<?= esc_attr($msg['email']) ?>" style="font-size:0.8rem; color:var(--pkm-admin-primary); text-decoration:none;">
                                    <?= esc_html($msg['email']) ?>
                                </a>
                            </td>
                            <td>
                                <strong style="display:block; margin-bottom:4px;"><?= esc_html($msg['subject'] ?: '(No Subject)') ?></strong>
                                <div style="font-size:0.85rem; color:var(--pkm-admin-text); white-space:pre-wrap; max-height:120px; overflow-y:auto; line-height:1.4;">
                                    <?= esc_html($msg['message']) ?>
                                </div>
                            </td>
                            <td>
                                <?php if ($msg['is_read']): ?>
                                    <span class="pkm-badge pkm-badge-secondary">Read</span>
                                <?php else: ?>
                                    <span class="pkm-badge pkm-badge-warning">New</span>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: right; white-space: nowrap;">
                                <?php if (!$msg['is_read']): ?>
                                    <a href="<?= esc_url(home_url('admin/contact/read?id=' . $msg['id'])) ?>" class="pkm-btn pkm-btn-secondary pkm-btn-sm">
                                        Mark Read
                                    </a>
                                <?php endif; ?>
                                <form method="POST" action="<?= esc_url(home_url('admin/contact/delete')) ?>" class="confirm-delete" style="display:inline-block; margin-left:4px;">
                                    <?= \App\Admin\Auth::csrfInput() ?>
                                    <input type="hidden" name="id" value="<?= intval($msg['id']) ?>">
                                    <button type="submit" class="pkm-btn pkm-btn-danger pkm-btn-sm" style="padding:4px 8px;">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center; padding:40px; color:var(--pkm-admin-text-muted);">
                            Your inbox is clean! No messages received yet.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
