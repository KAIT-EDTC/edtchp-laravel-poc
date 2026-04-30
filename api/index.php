<?php

/**
 * Vercel serverless entry point for Laravel.
 * Routes all requests through the Laravel application.
 */

error_reporting(E_ALL);
ini_set('display_errors', '1');

// Change working directory to the project root
chdir(dirname(__DIR__));

define('LARAVEL_START', microtime(true));

// Ensure /tmp directories exist for Vercel's read-only filesystem
$dirs = ['/tmp/storage/views', '/tmp/storage/cache', '/tmp/storage/sessions', '/tmp/storage/logs', '/tmp/storage/framework/cache', '/tmp/storage/framework/views', '/tmp/storage/framework/sessions'];
foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

try {
    // Register the Composer autoloader
    require __DIR__ . '/../vendor/autoload.php';

    // Bootstrap Laravel and handle the request
    $app = require_once __DIR__ . '/../bootstrap/app.php';

    // Override storage path to writable /tmp
    $app->useStoragePath('/tmp/storage');

    use Illuminate\Http\Request;

    // Diagnostic: test if Laravel can return a response
    $kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
    $request = Request::capture();
    $response = $kernel->handle($request);
    
    if (empty($response->getContent())) {
        header('Content-Type: application/json');
        echo json_encode([
            'debug' => 'Empty response',
            'status' => $response->getStatusCode(),
            'headers' => $response->headers->all(),
        ]);
        exit;
    }
    
    $response->send();
    $kernel->terminate($request, $response);
} catch (\Throwable $e) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode([
        'error' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'trace' => array_slice(explode("\n", $e->getTraceAsString()), 0, 20),
    ]);
    exit(1);
}
