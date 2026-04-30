<?php

// Diagnostic: verify PHP is working on Vercel
phpinfo();
exit;

/**
 * Vercel serverless entry point for Laravel.
 * Routes all requests through the Laravel application.
 */

// Change working directory to the project root
chdir(dirname(__DIR__));

define('LARAVEL_START', microtime(true));

try {
    // Ensure /tmp directories exist for Vercel's read-only filesystem
    if (!is_dir('/tmp/views')) {
        mkdir('/tmp/views', 0755, true);
    }
    if (!is_dir('/tmp/cache')) {
        mkdir('/tmp/cache', 0755, true);
    }
    if (!is_dir('/tmp/sessions')) {
        mkdir('/tmp/sessions', 0755, true);
    }
    if (!is_dir('/tmp/logs')) {
        mkdir('/tmp/logs', 0755, true);
    }

    // Determine if the application is in maintenance mode
    if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
        require $maintenance;
    }

    // Register the Composer autoloader
    require __DIR__ . '/../vendor/autoload.php';

    // Bootstrap Laravel and handle the request
    $app = require_once __DIR__ . '/../bootstrap/app.php';

    use Illuminate\Http\Request;

    $app->handleRequest(Request::capture());
} catch (\Throwable $e) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode([
        'error' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'trace' => array_slice(explode("\n", $e->getTraceAsString()), 0, 15),
    ]);
    exit(1);
}
