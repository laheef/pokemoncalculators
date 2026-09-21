<?php
/**
 * Application Configuration & Environment Loader
 * Pokemon Calculator Hub — Standalone PHP CMS
 */

// Define directory paths
define('ROOT_DIR', dirname(__DIR__));
define('APP_DIR', ROOT_DIR . '/app');
define('CONFIG_DIR', ROOT_DIR . '/config');
define('DATA_DIR', ROOT_DIR . '/data');
define('VIEWS_DIR', ROOT_DIR . '/views');
define('PUBLIC_DIR', ROOT_DIR . '/public');

// 1. Simple, Secure .env file parser (No external dependencies)
$envFile = ROOT_DIR . '/.env';
if (file_exists($envFile) && is_readable($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line) || str_starts_with($line, '#')) {
            continue;
        }
        if (str_contains($line, '=')) {
            [$key, $val] = explode('=', $line, 2);
            $key = trim($key);
            $val = trim($val);
            $val = trim($val, '"\'');
            if (!array_key_exists($key, $_SERVER) && !array_key_exists($key, $_ENV)) {
                putenv("{$key}={$val}");
                $_ENV[$key] = $val;
                $_SERVER[$key] = $val;
            }
        }
    }
}

// 2. Database Credentials (Hostinger or Local)
define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
define('DB_PORT', getenv('DB_PORT') ?: '3306');
define('DB_NAME', getenv('DB_NAME') ?: 'pokemon_calc_db');
define('DB_USER', getenv('DB_USER') ?: 'pokemon_user');
define('DB_PASS', getenv('DB_PASS') !== false ? getenv('DB_PASS') : 'PokemonCalc2026!');
define('DB_CHARSET', 'utf8mb4');

// 3. Application Settings
define('APP_NAME', 'Pokemon Calculator Hub');
define('APP_ENV', getenv('APP_ENV') ?: 'production');
define('APP_DEBUG', filter_var(getenv('APP_DEBUG') ?: false, FILTER_VALIDATE_BOOLEAN));
define('BASE_URL', rtrim(getenv('APP_URL') ?: getenv('BASE_URL') ?: '', '/'));

// 4. Secure Session & Cookie Hardening
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', '1');
    ini_set('session.use_only_cookies', '1');
    ini_set('session.cookie_samesite', 'Lax');
    
    // Enable secure cookies if on HTTPS
    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') 
            || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
            || (!empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
            
    if ($isHttps) {
        ini_set('session.cookie_secure', '1');
    }
    
    session_start();
}

// 5. Timezone & Error Reporting
date_default_timezone_set('UTC');

if (APP_DEBUG) {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
    error_reporting(0);
}
