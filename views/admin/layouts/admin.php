<?php
/**
 * Master Admin Layout
 * Pokemon Calculator Hub Custom CMS
 */

$user = \App\Admin\Auth::user();
$flashSuccess = \App\Admin\Auth::getFlash('success');
$flashError = \App\Admin\Auth::getFlash('error');

// Active page detection helper
$currentRoute = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
$isActive = function($prefix) use ($currentRoute) {
    if ($prefix === '/admin' && ($currentRoute === '/admin' || $currentRoute === '/admin/dashboard')) {
        return 'active';
    }
    return str_starts_with($currentRoute, $prefix) ? 'active' : '';
};
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc_html($title ?? 'Dashboard') ?> - Pokemon Calculator Hub Admin</title>
    <link rel="stylesheet" href="<?= esc_url(home_url('css/admin.css')) ?>">
    <script>
        // Sync theme with localStorage early to prevent flash
        const savedTheme = localStorage.getItem('pkm_theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
    </script>
</head>
<body class="pkm-admin-body">

<div class="pkm-admin-wrapper">

    <!-- SIDEBAR -->
    <aside class="pkm-admin-sidebar">
        <div class="pkm-admin-brand">
            <svg viewBox="0 0 24 24">
                <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 18a8 8 0 0 1-7.93-7h4.07a3.86 3.86 0 0 0 7.72 0h4.07A8 8 0 0 1 12 20zm0-16a8 8 0 0 1 7.93 7h-4.07a3.86 3.86 0 0 0-7.72 0H4.07A8 8 0 0 1 12 4zm0 6a2 2 0 1 0 2 2 2 2 0 0 0-2-2z"/>
            </svg>
            <h2>Pokemon Hub</h2>
            <span>CMS</span>
        </div>

        <nav class="pkm-admin-nav">
            <a href="<?= esc_url(home_url('admin')) ?>" class="pkm-admin-nav-item <?= $isActive('/admin') ?>">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                Dashboard
            </a>

            <div class="pkm-admin-nav-section-title">Content & Tools</div>

            <a href="<?= esc_url(home_url('admin/tools')) ?>" class="pkm-admin-nav-item <?= $isActive('/admin/tools') ?>">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                Calculators & Tools
            </a>

            <a href="<?= esc_url(home_url('admin/pages')) ?>" class="pkm-admin-nav-item <?= $isActive('/admin/pages') ?>">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                Pages Manager
            </a>

            <a href="<?= esc_url(home_url('admin/blog')) ?>" class="pkm-admin-nav-item <?= $isActive('/admin/blog') ?>">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                Blog & Articles
            </a>

            <a href="<?= esc_url(home_url('admin/categories')) ?>" class="pkm-admin-nav-item <?= $isActive('/admin/categories') ?>">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                Categories
            </a>

            <a href="<?= esc_url(home_url('admin/media')) ?>" class="pkm-admin-nav-item <?= $isActive('/admin/media') ?>">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                Media Library
            </a>

            <div class="pkm-admin-nav-section-title">System & Users</div>

            <a href="<?= esc_url(home_url('admin/indexing')) ?>" class="pkm-admin-nav-item <?= $isActive('/admin/indexing') ?>">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                Google Indexing API
            </a>

            <a href="<?= esc_url(home_url('admin/contact')) ?>" class="pkm-admin-nav-item <?= $isActive('/admin/contact') ?>">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                Contact Messages
            </a>

            <?php if (\App\Admin\Auth::isAdmin()): ?>
                <a href="<?= esc_url(home_url('admin/users')) ?>" class="pkm-admin-nav-item <?= $isActive('/admin/users') ?>">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    Users & Team
                </a>

                <a href="<?= esc_url(home_url('admin/settings')) ?>" class="pkm-admin-nav-item <?= $isActive('/admin/settings') ?>">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                    Site Settings
                </a>
            <?php endif; ?>

            <a href="<?= esc_url(home_url('admin/profile')) ?>" class="pkm-admin-nav-item <?= $isActive('/admin/profile') ?>">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                My Profile
            </a>
        </nav>

        <div class="pkm-admin-sidebar-footer">
            <a href="<?= esc_url(home_url('/')) ?>" target="_blank" class="pkm-admin-view-site-btn">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                View Live Site
            </a>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="pkm-admin-main">
        
        <!-- TOPBAR -->
        <header class="pkm-admin-topbar">
            <div class="pkm-admin-topbar-left">
                <button type="button" class="pkm-admin-menu-toggle" id="adminMenuToggle" aria-label="Toggle navigation">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </button>
                <span style="font-weight:600; font-size:0.95rem; color:var(--pkm-admin-text-muted);">
                    <?= esc_html($title ?? 'Control Center') ?>
                </span>
            </div>

            <div class="pkm-admin-topbar-right">
                <button type="button" class="pkm-admin-theme-toggle" id="adminThemeToggle" aria-label="Toggle dark mode">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
                    <span class="pkm-theme-label">Dark</span>
                </button>

                <a href="<?= esc_url(home_url('admin/profile')) ?>" class="pkm-admin-user-menu" style="text-decoration:none;">
                    <div class="pkm-admin-user-avatar">
                        <?= strtoupper(substr($user['username'] ?? 'A', 0, 1)) ?>
                    </div>
                    <div class="pkm-admin-user-info">
                        <div class="pkm-admin-user-name"><?= esc_html($user['username'] ?? 'Admin') ?></div>
                        <div class="pkm-admin-user-role"><?= esc_html(ucfirst($user['role'] ?? 'administrator')) ?></div>
                    </div>
                </a>

                <a href="<?= esc_url(home_url('admin/logout')) ?>" class="pkm-admin-logout-btn">
                    Logout
                </a>
            </div>
        </header>

        <!-- CONTENT BODY -->
        <main class="pkm-admin-content">
            <?php if ($flashSuccess): ?>
                <div class="pkm-admin-alert success">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    <?= esc_html($flashSuccess) ?>
                </div>
            <?php endif; ?>

            <?php if ($flashError): ?>
                <div class="pkm-admin-alert error">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    <?= esc_html($flashError) ?>
                </div>
            <?php endif; ?>

            <?= $content ?? '' ?>
        </main>
    </div>
</div>

<script src="<?= esc_url(home_url('js/admin.js')) ?>"></script>
</body>
</html>
