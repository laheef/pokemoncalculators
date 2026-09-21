<?php
/**
 * Front Controller Entry Point
 * Pokemon Calculator Hub — Standalone Custom PHP CMS
 */

// Handle PHP CLI built-in dev server static files
if (php_sapi_name() === 'cli-server') {
    $filePath = __DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (is_file($filePath)) {
        return false;
    }
}

// 1. Load Configuration
require_once dirname(__DIR__) . '/config/config.php';

// Security & Performance Headers
if (!headers_sent()) {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
}

// 2. Class Autoloader
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $baseDir = APP_DIR . '/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relativeClass = substr($class, $len);
    $parts = explode('\\', $relativeClass);
    $className = array_pop($parts);
    
    // Subdirectories are lowercase: App\Core\Request -> app/core/Request.php
    $dir = strtolower(implode('/', $parts));
    $file = $baseDir . ($dir ? $dir . '/' : '') . $className . '.php';

    if (file_exists($file)) {
        require_once $file;
        return;
    }

    // Direct path fallback
    $altFile = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
    if (file_exists($altFile)) {
        require_once $altFile;
    }
});

// 3. Load Global Helpers & Core
require_once APP_DIR . '/core/Helpers.php';

// 4. Handle Request
use App\Core\Request;

$request = new Request();

// 5. Load Routes & Dispatch
$router = require_once CONFIG_DIR . '/routes.php';
$router->dispatch($request);
