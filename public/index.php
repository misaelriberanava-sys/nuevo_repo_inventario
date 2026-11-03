<?php
declare(strict_types=1);

$pdo = require __DIR__ . '/../config/db.php';

$ruta = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
$ruta = rtrim($ruta, '/');

if ($ruta === '') {
    $ruta = '/';
}

if ($ruta === '/') {
    header('Content-Type: text/plain; charset=utf-8');
    echo 'Proyecto base listo';

    exit;
}

http_response_code(404);
header('Content-Type: text/plain; charset=utf-8');
echo '404 - No encontrado';
