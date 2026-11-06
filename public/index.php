<?php
declare(strict_types=1);

$pdo = require __DIR__ . '/../config/db.php';

require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../controllers/ProveedorController.php';

$ruta = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
$ruta = rtrim($ruta, '/');

if ($ruta === '') {
    $ruta = '/';
}

$metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$controlador = new ProveedorController($pdo);

$proveedorId = null;
$editarId = null;
$eliminarId = null;

if (preg_match('#^/proveedores/(\d+)$#', $ruta, $coincidencias) === 1) {
    $proveedorId = (int) $coincidencias[1];
}

if (preg_match('#^/proveedores/(\d+)/editar$#', $ruta, $coincidencias) === 1) {
    $editarId = (int) $coincidencias[1];
}

if (preg_match('#^/proveedores/(\d+)/eliminar$#', $ruta, $coincidencias) === 1) {
    $eliminarId = (int) $coincidencias[1];
}

if ($ruta === '/') {
    redirect('/proveedores');
}

if ($ruta === '/proveedores' && $metodo === 'GET') {
    $controlador->index();
    return;
}

if ($ruta === '/proveedores' && $metodo === 'POST') {
    $controlador->store();
    return;
}

if ($ruta === '/proveedores/crear' && $metodo === 'GET') {
    $controlador->create();
    return;
}

if ($proveedorId !== null && $metodo === 'GET') {
    $controlador->show($proveedorId);
    return;
}

if ($editarId !== null && $metodo === 'GET') {
    $controlador->edit($editarId);
    return;
}

if ($proveedorId !== null && $metodo === 'POST') {
    $controlador->update($proveedorId);
    return;
}

if ($eliminarId !== null && $metodo === 'POST') {
    $controlador->destroy($eliminarId);
    return;
}

http_response_code(404);
$contenido = __DIR__ . '/../views/404.php';
require __DIR__ . '/../views/layout.php';
