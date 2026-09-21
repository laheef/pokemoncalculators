<?php
/**
 * 1-Click Database Installer & Hostinger Diagnostic Tool
 * Pokemon Calculator Hub
 */

error_reporting(E_ALL);
ini_set('display_errors', '1');

$configFile = dirname(__DIR__) . '/config/config.php';
if (!file_exists($configFile)) {
    $configFile = __DIR__ . '/config/config.php';
}

$dbConnected = false;
$dbError = null;
$installed = false;
$msg = null;

if (file_exists($configFile)) {
    require_once $configFile;
    
    // Check PHP Extensions
    $extensions = [
        'pdo_mysql' => extension_loaded('pdo_mysql'),
        'openssl'   => extension_loaded('openssl'),
        'curl'      => extension_loaded('curl'),
        'json'      => extension_loaded('json'),
        'mbstring'  => extension_loaded('mbstring')
    ];

    try {
        $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        $dbConnected = true;

        // Check if tables exist
        $stmt = $pdo->query("SHOW TABLES LIKE 'users'");
        $hasUsers = $stmt->fetch();
        if ($hasUsers) {
            $installed = true;
        }

        // Handle auto-import if requested
        if (isset($_POST['import_db']) && $dbConnected) {
            $sqlFile = dirname(__DIR__) . '/database.sql';
            if (!file_exists($sqlFile)) {
                $sqlFile = __DIR__ . '/database.sql';
            }
            if (file_exists($sqlFile)) {
                $sql = file_get_contents($sqlFile);
                $pdo->exec($sql);
                $installed = true;
                $msg = "Database tables and seed data successfully imported!";
            } else {
                $dbError = "database.sql file not found in root directory.";
            }
        }
    } catch (PDOException $e) {
        $dbError = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostinger Setup & Diagnostics - Pokémon Calculator Hub</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #0D1117; color: #E6EDF3; padding: 40px 20px; line-height: 1.6; }
        .card { max-width: 680px; margin: 0 auto; background: #161B22; border: 1px solid #30363D; border-radius: 12px; padding: 32px; box-shadow: 0 8px 24px rgba(0,0,0,0.5); }
        h1 { font-size: 1.6rem; color: #58A6FF; margin-top: 0; }
        .status-badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-weight: 700; font-size: 0.85rem; }
        .ok { background: rgba(46, 160, 67, 0.2); color: #3FB950; border: 1px solid rgba(46, 160, 67, 0.4); }
        .err { background: rgba(248, 81, 73, 0.2); color: #F85149; border: 1px solid rgba(248, 81, 73, 0.4); }
        .box { background: #21262D; border: 1px solid #30363D; border-radius: 8px; padding: 16px; margin: 16px 0; }
        .btn { display: inline-block; background: #238636; color: #FFF; font-weight: 700; padding: 10px 20px; border-radius: 6px; text-decoration: none; border: none; cursor: pointer; font-size: 0.95rem; }
        .btn:hover { background: #2EA043; }
        code { background: #30363D; padding: 2px 6px; border-radius: 4px; font-size: 0.9rem; color: #79C0FF; }
    </style>
</head>
<body>

<div class="card">
    <h1>🚀 Pokémon Calculator Hub — Setup Diagnostics</h1>
    <p>This diagnostic tool verifies your Hostinger server environment, database connectivity, and PHP extensions.</p>

    <div class="box">
        <h3>Server Checks</h3>
        <div>PHP Version: <code><?= phpversion() ?></code> (Required: 8.0+) &rarr; <span class="status-badge ok">PASS</span></div>
        <div>MySQL PDO Extension: &rarr; <?= extension_loaded('pdo_mysql') ? '<span class="status-badge ok">OK</span>' : '<span class="status-badge err">MISSING</span>' ?></div>
        <div>OpenSSL Extension (Google API): &rarr; <?= extension_loaded('openssl') ? '<span class="status-badge ok">OK</span>' : '<span class="status-badge err">MISSING</span>' ?></div>
        <div>cURL Extension: &rarr; <?= extension_loaded('curl') ? '<span class="status-badge ok">OK</span>' : '<span class="status-badge err">MISSING</span>' ?></div>
    </div>

    <div class="box">
        <h3>Database Connection</h3>
        <div>Host: <code><?= defined('DB_HOST') ? DB_HOST : 'N/A' ?></code></div>
        <div>Database: <code><?= defined('DB_NAME') ? DB_NAME : 'N/A' ?></code></div>
        <div>User: <code><?= defined('DB_USER') ? DB_USER : 'N/A' ?></code></div>
        <div style="margin-top:10px;">
            Connection Status: 
            <?php if ($dbConnected): ?>
                <span class="status-badge ok">CONNECTED</span>
            <?php else: ?>
                <span class="status-badge err">FAILED</span>
                <div style="color:#F85149; margin-top:8px; font-size:0.85rem;">Error: <?= esc_html($dbError) ?></div>
                <p style="font-size:0.85rem; color:#8B949E; margin-top:6px;">Update your database credentials in <code>.env</code> file in your <code>public_html/</code> folder.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php if ($msg): ?>
        <div style="background:rgba(46, 160, 67, 0.2); border:1px solid #3FB950; color:#3FB950; padding:12px; border-radius:6px; margin:16px 0;">
            <?= esc_html($msg) ?>
        </div>
    <?php endif; ?>

    <div class="box">
        <h3>Database Tables Status</h3>
        <?php if ($installed): ?>
            <div style="color:#3FB950; font-weight:700;">✅ Tables are installed and ready!</div>
            <div style="margin-top:16px;">
                <a href="<?= esc_url(home_url('/')) ?>" class="btn">View Website &rarr;</a>
                <a href="<?= esc_url(home_url('admin/login')) ?>" class="btn" style="background:#1F6FEB; margin-left:8px;">Admin Login &rarr;</a>
            </div>
        <?php elseif ($dbConnected): ?>
            <p>Database connected, but tables have not been imported yet.</p>
            <form method="POST">
                <button type="submit" name="import_db" value="1" class="btn">
                    📥 1-Click Import database.sql Now
                </button>
            </form>
        <?php else: ?>
            <p style="color:#8B949E;">Connect database in <code>.env</code> first to enable table import.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
