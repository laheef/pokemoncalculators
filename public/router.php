<?php
/**
 * Router script for PHP Built-in Web Server
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// If static file exists, serve it directly
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false;
}

// Otherwise pass to index.php
require_once __DIR__ . '/index.php';
