<?php

header('Content-Type: text/html; charset=utf-8');
echo '<!DOCTYPE html><html><body><h1>PHP is working on Vercel!</h1>';
echo '<p>PHP Version: ' . phpversion() . '</p>';
echo '<p>Working dir: ' . getcwd() . '</p>';
echo '<p>File exists vendor/autoload.php: ' . (file_exists(__DIR__ . '/../vendor/autoload.php') ? 'YES' : 'NO') . '</p>';
echo '<p>File exists bootstrap/app.php: ' . (file_exists(__DIR__ . '/../bootstrap/app.php') ? 'YES' : 'NO') . '</p>';
echo '<p>File exists public/build/manifest.json: ' . (file_exists(__DIR__ . '/../public/build/manifest.json') ? 'YES' : 'NO') . '</p>';
echo '</body></html>';
