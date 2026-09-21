<?php
/**
 * Admin Dashboard View
 * Pokemon Calculator Hub Custom CMS
 */
?>

<div class="pkm-admin-header">
    <div>
        <h1 class="pkm-admin-title">Dashboard Overview</h1>
        <p class="pkm-admin-subtitle">Welcome back! Manage calculators, static pages, blog guides, and site settings.</p>
    </div>
    <div class="pkm-admin-actions">
        <a href="<?= esc_url(home_url('admin/tools/create')) ?>" class="pkm-btn pkm-btn-primary">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add New Tool
        </a>
        <a href="<?= esc_url(home_url('admin/pages/create')) ?>" class="pkm-btn pkm-btn-secondary">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add Page
        </a>
    </div>
</div>

<!-- STATS METRICS GRID -->
<div class="pkm-stats-grid">
    <div class="pkm-stat-card">
        <div class="pkm-stat-icon blue">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
        </div>
        <div>
            <div class="pkm-stat-value"><?= intval($counts['tools'] ?? 0) ?></div>
            <div class="pkm-stat-label">Active Calculators</div>
        </div>
    </div>

    <div class="pkm-stat-card">
        <div class="pkm-stat-icon green">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        </div>
        <div>
            <div class="pkm-stat-value"><?= intval($counts['pages'] ?? 0) ?></div>
            <div class="pkm-stat-label">Published Pages</div>
        </div>
    </div>

    <div class="pkm-stat-card">
        <div class="pkm-stat-icon purple">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
        </div>
        <div>
            <div class="pkm-stat-value"><?= intval($counts['posts'] ?? 0) ?></div>
            <div class="pkm-stat-label">Blog Guides</div>
        </div>
    </div>

    <div class="pkm-stat-card">
        <div class="pkm-stat-icon <?= ($counts['unread_contacts'] > 0) ? 'red' : 'orange' ?>">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
        </div>
        <div>
            <div class="pkm-stat-value"><?= intval($counts['contacts'] ?? 0) ?></div>
            <div class="pkm-stat-label">
                Contacts (<?= intval($counts['unread_contacts'] ?? 0) ?> unread)
            </div>
        </div>
    </div>
</div>

<!-- TWO COLUMN SUMMARY -->
<div style="display:grid; grid-template-columns: 2fr 1fr; gap:24px;">

    <!-- LEFT COLUMN: Recent Content & Tools -->
    <div>
        <div class="pkm-card">
            <div class="pkm-card-header">
                <h2 class="pkm-card-title">Live Calculators & Tools</h2>
                <a href="<?= esc_url(home_url('admin/tools')) ?>" class="pkm-btn pkm-btn-secondary pkm-btn-sm">View All</a>
            </div>
            
            <div class="pkm-table-responsive">
                <table class="pkm-table">
                    <thead>
                        <tr>
                            <th>Tool Name</th>
                            <th>Slug</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tools as $t): ?>
                            <tr>
                                <td style="font-weight:600;"><?= esc_html($t['name']) ?></td>
                                <td><code>/<?= esc_html($t['slug']) ?></code></td>
                                <td>
                                    <span class="pkm-badge pkm-badge-secondary">
                                        <?= esc_html($t['category_name'] ?? 'General') ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($t['is_active']): ?>
                                        <span class="pkm-badge pkm-badge-success">Active</span>
                                    <?php else: ?>
                                        <span class="pkm-badge pkm-badge-secondary">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= esc_url(home_url('admin/tools/edit?id=' . $t['id'])) ?>" class="pkm-btn pkm-btn-secondary pkm-btn-sm">Edit</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Contact Submissions -->
        <div class="pkm-card">
            <div class="pkm-card-header">
                <h2 class="pkm-card-title">Recent Contact Inquiries</h2>
                <a href="<?= esc_url(home_url('admin/contact')) ?>" class="pkm-btn pkm-btn-secondary pkm-btn-sm">View Inbox</a>
            </div>
            <?php if (!empty($contacts)): ?>
                <div class="pkm-table-responsive">
                    <table class="pkm-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Sender</th>
                                <th>Subject</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($contacts as $c): ?>
                                <tr>
                                    <td><?= date('M j, Y', strtotime($c['created_at'])) ?></td>
                                    <td><strong><?= esc_html($c['name']) ?></strong><br><small><?= esc_html($c['email']) ?></small></td>
                                    <td><?= esc_html($c['subject'] ?: '(No Subject)') ?></td>
                                    <td>
                                        <?php if ($c['is_read']): ?>
                                            <span class="pkm-badge pkm-badge-secondary">Read</span>
                                        <?php else: ?>
                                            <span class="pkm-badge pkm-badge-warning">Unread</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p style="color:var(--pkm-admin-text-muted); font-size:0.9rem;">No contact messages received yet.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- RIGHT COLUMN: System & Quick Info -->
    <div>
        <div class="pkm-card">
            <div class="pkm-card-header">
                <h2 class="pkm-card-title">System Status</h2>
            </div>
            <div style="display:flex; flex-direction:column; gap:12px; font-size:0.9rem;">
                <div style="display:flex; justify-content:space-between; border-bottom:1px solid var(--pkm-admin-card-border); padding-bottom:8px;">
                    <span style="color:var(--pkm-admin-text-muted);">Database</span>
                    <strong>MySQL / MariaDB</strong>
                </div>
                <div style="display:flex; justify-content:space-between; border-bottom:1px solid var(--pkm-admin-card-border); padding-bottom:8px;">
                    <span style="color:var(--pkm-admin-text-muted);">PHP Engine</span>
                    <strong>PHP <?= phpversion() ?></strong>
                </div>
                <div style="display:flex; justify-content:space-between; border-bottom:1px solid var(--pkm-admin-card-border); padding-bottom:8px;">
                    <span style="color:var(--pkm-admin-text-muted);">Pokémon Dataset</span>
                    <strong>1,025 Records (Loaded)</strong>
                </div>
                <div style="display:flex; justify-content:space-between; border-bottom:1px solid var(--pkm-admin-card-border); padding-bottom:8px;">
                    <span style="color:var(--pkm-admin-text-muted);">Uploads Folder</span>
                    <span class="pkm-badge pkm-badge-success">Writable</span>
                </div>
                <div style="display:flex; justify-content:space-between; padding-bottom:4px;">
                    <span style="color:var(--pkm-admin-text-muted);">Active Theme Tokens</span>
                    <code>Light / Dark</code>
                </div>
            </div>
        </div>

        <div class="pkm-card">
            <div class="pkm-card-header">
                <h2 class="pkm-card-title">Recent Pages</h2>
                <a href="<?= esc_url(home_url('admin/pages')) ?>" class="pkm-btn pkm-btn-secondary pkm-btn-sm">All</a>
            </div>
            <div style="display:flex; flex-direction:column; gap:10px;">
                <?php foreach ($pages as $p): ?>
                    <div style="display:flex; justify-content:space-between; align-items:center; font-size:0.88rem;">
                        <a href="<?= esc_url(home_url($p['slug'])) ?>" target="_blank" style="color:var(--pkm-admin-primary); font-weight:600; text-decoration:none;">
                            <?= esc_html($p['title']) ?>
                        </a>
                        <span class="pkm-badge pkm-badge-secondary" style="font-size:0.7rem;">
                            <?= esc_html($p['page_width_template']) ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</div>
