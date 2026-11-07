<?php
declare(strict_types=1);
?>
<h1><?= e($proveedor['nombre']) ?></h1>

<p class="acciones">
    <a class="btn btn-sec" href="/proveedores">Volver al listado</a>
    <a class="btn" href="/proveedores/<?= e((string) $proveedor['id']) ?>/editar">Editar</a>
</p>

<table>
    <tr><th>ID</th><td><?= e((string) $proveedor['id']) ?></td></tr>
    <tr><th>Nombre</th><td><?= e($proveedor['nombre']) ?></td></tr>
    <tr><th>Contacto</th><td><?= e($proveedor['contacto']) ?></td></tr>
    <tr><th>Email</th><td><?= e($proveedor['email']) ?></td></tr>
    <tr><th>Teléfono</th><td><?= e($proveedor['telefono'] ?? '') ?></td></tr>
</table>

<h2>Productos del proveedor</h2>

<?php if ($productos === []): ?>
    <p class="vacio">Este proveedor no tiene productos.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= e((string) $producto['id']) ?></td>
                    <td><?= e($producto['nombre']) ?></td>
                    <td><?= e((string) $producto['precio']) ?></td>
                    <td><?= e((string) $producto['stock']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
