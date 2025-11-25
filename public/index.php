<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Jika aplikasi sedang dalam mode maintenance, jalankan file maintenance
if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Autoload Composer (agar bisa pakai semua class PHP yang dibutuhkan)
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel dan tangani permintaan (request)
/** @var Application $app */
$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->handleRequest(Request::capture());
