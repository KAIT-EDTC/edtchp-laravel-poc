<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

chdir(dirname(__DIR__));

define('LARAVEL_START', microtime(true));

// Create writable directories in /tmp for Vercel
$dirs = [
    '/tmp/storage/logs',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/sessions',
    '/tmp/cache',
];
foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Copy bootstrap cache files to writable /tmp
// Laravel needs these to know which providers to load
$cacheFiles = ['packages.php', 'services.php'];
foreach ($cacheFiles as $file) {
    $src = __DIR__ . '/../bootstrap/cache/' . $file;
    $dest = '/tmp/cache/' . $file;
    if (file_exists($src) && !file_exists($dest)) {
        copy($src, $dest);
    }
}

// Set environment variables to point to writable cache
putenv('APP_SERVICES_CACHE=/tmp/cache/services.php');
putenv('APP_PACKAGES_CACHE=/tmp/cache/packages.php');
putenv('APP_CONFIG_CACHE=/tmp/cache/config.php');
putenv('APP_ROUTES_CACHE=/tmp/cache/routes.php');
putenv('APP_EVENTS_CACHE=/tmp/cache/events.php');

$_ENV['APP_SERVICES_CACHE'] = '/tmp/cache/services.php';
$_ENV['APP_PACKAGES_CACHE'] = '/tmp/cache/packages.php';
$_ENV['APP_CONFIG_CACHE'] = '/tmp/cache/config.php';
$_ENV['APP_ROUTES_CACHE'] = '/tmp/cache/routes.php';
$_ENV['APP_EVENTS_CACHE'] = '/tmp/cache/events.php';

try {
    require __DIR__ . '/../vendor/autoload.php';

    $app = require_once __DIR__ . '/../bootstrap/app.php';

    $app->useStoragePath('/tmp/storage');

    $app->handleRequest(
        \Illuminate\Http\Request::capture()
    );
} catch (\Throwable $e) {
    http_response_code(500);
    header('Content-Type: text/html; charset=utf-8');
    echo '<!DOCTYPE html><html><body>';
    echo '<h1>Error: ' . htmlspecialchars($e->getMessage()) . '</h1>';
    echo '<p><strong>File:</strong> ' . htmlspecialchars($e->getFile()) . ':' . $e->getLine() . '</p>';
    echo '<pre>' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
    if ($e->getPrevious()) {
        echo '<h2>Previous: ' . htmlspecialchars($e->getPrevious()->getMessage()) . '</h2>';
    }
    echo '</body></html>';
}
