<?php
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . $path)) {
    return false;
}

$_GET['route'] = urldecode(ltrim($path, '/'));
require __DIR__ . '/index.php';