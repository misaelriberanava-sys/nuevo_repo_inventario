<?php
declare(strict_types=1);

$pdo = require __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/ProductoController.php';

$ruta = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
$ruta = rtrim($ruta, '/');

if ($ruta === '') {
    $ruta = '/';
}

$controlador = new ProductoController($pdo);

if ($ruta === '/productos') {
    $controlador->index();
} elseif (preg_match('#^/productos/(\d+)$#', $ruta, $coincidencias) === 1) {
    $controlador->show((int) $coincidencias[1]);
} else {
    http_response_code(404);
    require __DIR__ . '/../views/404.php';
}
