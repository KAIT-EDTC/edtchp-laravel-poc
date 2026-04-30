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
];
foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

try {
    require __DIR__ . '/../vendor/autoload.php';

    $app = require_once __DIR__ . '/../bootstrap/app.php';

    // Must set storage path before handling request
    $app->useStoragePath('/tmp/storage');

    // Also override the cached config/routes paths
    $app->instance('path.config.cache', '/tmp/config.php');
    $app->instance('path.routes.cache', '/tmp/routes.php');

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
        echo '<p><strong>File:</strong> ' . htmlspecialchars($e->getPrevious()->getFile()) . ':' . $e->getPrevious()->getLine() . '</p>';
    }
    echo '</body></html>';
}
