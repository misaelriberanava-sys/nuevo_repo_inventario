<?php
declare(strict_types=1);

$pdo = require __DIR__ . '/../config/db.php';

require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../controllers/ProveedorController.php';
require_once __DIR__ . '/../controllers/ProductoController.php';

$ruta = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
$ruta = rtrim($ruta, '/');

if ($ruta === '') {
    $ruta = '/';
}

$metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';

$controladorProveedor = new ProveedorController($pdo);
$controladorProducto = new ProductoController($pdo);

$proveedorId = null;
$proveedorEditar = null;
$proveedorEliminar = null;

if (preg_match('#^/proveedores/(\d+)$#', $ruta, $coincidencias) === 1) {
    $proveedorId = (int) $coincidencias[1];
}

if (preg_match('#^/proveedores/(\d+)/editar$#', $ruta, $coincidencias) === 1) {
    $proveedorEditar = (int) $coincidencias[1];
}

if (preg_match('#^/proveedores/(\d+)/eliminar$#', $ruta, $coincidencias) === 1) {
    $proveedorEliminar = (int) $coincidencias[1];
}

$productoId = null;
$productoEditar = null;
$productoEliminar = null;

if (preg_match('#^/productos/(\d+)$#', $ruta, $coincidencias) === 1) {
    $productoId = (int) $coincidencias[1];
}

if (preg_match('#^/productos/(\d+)/editar$#', $ruta, $coincidencias) === 1) {
    $productoEditar = (int) $coincidencias[1];
}

if (preg_match('#^/productos/(\d+)/eliminar$#', $ruta, $coincidencias) === 1) {
    $productoEliminar = (int) $coincidencias[1];
}

if ($ruta === '/') {
    redirect('/productos');
}

if ($ruta === '/proveedores' && $metodo === 'GET') {
    $controladorProveedor->index();
    return;
}

if ($ruta === '/proveedores' && $metodo === 'POST') {
    $controladorProveedor->store();
    return;
}

if ($ruta === '/proveedores/crear' && $metodo === 'GET') {
    $controladorProveedor->create();
    return;
}

if ($proveedorId !== null && $metodo === 'GET') {
    $controladorProveedor->show($proveedorId);
    return;
}

if ($proveedorEditar !== null && $metodo === 'GET') {
    $controladorProveedor->edit($proveedorEditar);
    return;
}

if ($proveedorId !== null && $metodo === 'POST') {
    $controladorProveedor->update($proveedorId);
    return;
}

if ($proveedorEliminar !== null && $metodo === 'POST') {
    $controladorProveedor->destroy($proveedorEliminar);
    return;
}

if ($ruta === '/productos' && $metodo === 'GET') {
    $controladorProducto->index();
    return;
}

if ($ruta === '/productos' && $metodo === 'POST') {
    $controladorProducto->store();
    return;
}

if ($ruta === '/productos/crear' && $metodo === 'GET') {
    $controladorProducto->create();
    return;
}

if ($productoId !== null && $metodo === 'GET') {
    $controladorProducto->show($productoId);
    return;
}

if ($productoEditar !== null && $metodo === 'GET') {
    $controladorProducto->edit($productoEditar);
    return;
}

if ($productoId !== null && $metodo === 'POST') {
    $controladorProducto->update($productoId);
    return;
}

if ($productoEliminar !== null && $metodo === 'POST') {
    $controladorProducto->destroy($productoEliminar);
    return;
}

http_response_code(404);
$contenido = __DIR__ . '/../views/404.php';
require __DIR__ . '/../views/layout.php';
