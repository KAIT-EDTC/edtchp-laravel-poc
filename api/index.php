<?php

/**
 * Vercel serverless entry point for Laravel.
 * Routes all requests through the Laravel application.
 */

// Vercel環境用に、パスの解決をLaravel本体（ルート）に向ける
require __DIR__ . '/../public/index.php';
// Change working directory to the project root
chdir(dirname(__DIR__));

define('LARAVEL_START', microtime(true));

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
