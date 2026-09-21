<?php
/**
 * Admin Login View
 * Pokemon Calculator Hub Custom CMS
 */

$flashError = \App\Admin\Auth::getFlash('error');
$flashSuccess = \App\Admin\Auth::getFlash('success');
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Pokemon Calculator Hub</title>
    <link rel="stylesheet" href="<?= esc_url(home_url('css/admin.css')) ?>">
    <style>
        body.pkm-login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1A1F2E 0%, #0D1117 100%);
            padding: 20px;
        }
        .pkm-login-box {
            width: 100%;
            max-width: 420px;
            background: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
            padding: 40px 32px;
        }
        [data-theme="dark"] .pkm-login-box {
            background: #161B22;
            border: 1px solid #30363D;
        }
        .pkm-login-header {
            text-align: center;
            margin-bottom: 28px;
        }
        .pkm-login-logo {
            width: 48px;
            height: 48px;
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(239, 68, 68, 0.1);
            border-radius: 50%;
        }
        .pkm-login-logo svg {
            width: 28px;
            height: 28px;
            fill: #EF4444;
        }
        .pkm-login-title {
            font-size: 1.4rem;
            font-weight: 800;
            color: #1E293B;
            margin-bottom: 4px;
        }
        [data-theme="dark"] .pkm-login-title {
            color: #E6EDF3;
        }
        .pkm-login-sub {
            font-size: 0.85rem;
            color: #64748B;
        }
        .pkm-login-btn {
            width: 100%;
            padding: 12px;
            background: #3B82F6;
            color: #FFFFFF;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            transition: background 0.15s;
            margin-top: 8px;
        }
        .pkm-login-btn:hover {
            background: #2563EB;
        }
    </style>
</head>
<body class="pkm-login-page">

<div class="pkm-login-box">
    <div class="pkm-login-header">
        <div class="pkm-login-logo">
            <svg viewBox="0 0 24 24">
                <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 18a8 8 0 0 1-7.93-7h4.07a3.86 3.86 0 0 0 7.72 0h4.07A8 8 0 0 1 12 20zm0-16a8 8 0 0 1 7.93 7h-4.07a3.86 3.86 0 0 0-7.72 0H4.07A8 8 0 0 1 12 4zm0 6a2 2 0 1 0 2 2 2 2 0 0 0-2-2z"/>
            </svg>
        </div>
        <h1 class="pkm-login-title">Admin Sign In</h1>
        <p class="pkm-login-sub">Pokemon Calculator Hub CMS</p>
    </div>

    <?php if ($flashError): ?>
        <div class="pkm-admin-alert error" style="margin-bottom:20px; font-size:0.85rem;">
            <?= esc_html($flashError) ?>
        </div>
    <?php endif; ?>

    <?php if ($flashSuccess): ?>
        <div class="pkm-admin-alert success" style="margin-bottom:20px; font-size:0.85rem;">
            <?= esc_html($flashSuccess) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= esc_url(home_url('admin/login')) ?>">
        <?= \App\Admin\Auth::csrfInput() ?>

        <div class="pkm-form-group">
            <label class="pkm-form-label" for="username">Username or Email</label>
            <input type="text" id="username" name="username" class="pkm-form-control" required autofocus placeholder="admin">
        </div>

        <div class="pkm-form-group">
            <label class="pkm-form-label" for="password">Password</label>
            <input type="password" id="password" name="password" class="pkm-form-control" required placeholder="••••••••">
        </div>

        <button type="submit" class="pkm-login-btn">
            Sign In to Dashboard
        </button>
    </form>

    <div style="text-align:center; margin-top:24px;">
        <a href="<?= esc_url(home_url('/')) ?>" style="color:#64748B; font-size:0.85rem; text-decoration:none;">
            &larr; Back to Public Hub
        </a>
    </div>
</div>

</body>
</html>
