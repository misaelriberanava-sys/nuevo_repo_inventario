<?php
declare(strict_types=1);
?>
<h1><?= e($producto['nombre']) ?></h1>

<p class="acciones">
    <a class="btn btn-sec" href="/productos">Volver al listado</a>
    <a class="btn" href="/productos/<?= e((string) $producto['id']) ?>/editar">Editar</a>
</p>

<table>
    <tr><th>ID</th><td><?= e((string) $producto['id']) ?></td></tr>
    <tr><th>Producto</th><td><?= e($producto['nombre']) ?></td></tr>
    <tr><th>Precio</th><td><?= e((string) $producto['precio']) ?></td></tr>
    <tr><th>Stock</th><td><?= e((string) $producto['stock']) ?></td></tr>
    <tr><th>Proveedor</th><td><?= e($producto['proveedor']) ?></td></tr>
    <tr><th>Email proveedor</th><td><?= e($producto['proveedor_email']) ?></td></tr>
</table>
