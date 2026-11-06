<?php
declare(strict_types=1);
?>
<h1>Productos</h1>

<?php if (($ok ?? null) === 'creado'): ?>
    <div class="aviso aviso-ok">Producto creado correctamente.</div>
<?php elseif (($ok ?? null) === 'actualizado'): ?>
    <div class="aviso aviso-ok">Producto actualizado correctamente.</div>
<?php elseif (($ok ?? null) === 'eliminado'): ?>
    <div class="aviso aviso-ok">Producto eliminado correctamente.</div>
<?php endif; ?>

<form method="get" action="/productos" class="acciones">
    <label for="proveedor_id" class="filtro-label">Filtrar por proveedor:</label>
    <select id="proveedor_id" name="proveedor_id">
        <option value="">Todos</option>
        <?php foreach ($proveedores as $proveedor): ?>
            <option value="<?= e((string) $proveedor['id']) ?>" <?= ($proveedorId !== null && (int) $proveedorId === (int) $proveedor['id']) ? 'selected' : '' ?>>
                <?= e($proveedor['nombre']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button type="submit" class="btn">Filtrar</button>
    <?php if ($proveedorId !== null): ?>
        <a class="btn btn-sec" href="/productos">Limpiar</a>
    <?php endif; ?>
</form>

<p><a class="btn" href="/productos/crear">Nuevo producto</a></p>

<?php if ($productos === []): ?>
    <p class="vacio">No hay productos para mostrar.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Proveedor</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= e((string) $producto['id']) ?></td>
                    <td><?= e($producto['nombre']) ?></td>
                    <td><?= e($producto['proveedor']) ?></td>
                    <td><?= e((string) $producto['precio']) ?></td>
                    <td><?= e((string) $producto['stock']) ?></td>
                    <td>
                        <div class="acciones">
                            <a class="btn btn-sec" href="/productos/<?= e((string) $producto['id']) ?>">Ver</a>
                            <a class="btn btn-sec" href="/productos/<?= e((string) $producto['id']) ?>/editar">Editar</a>
                            <form method="post" action="/productos/<?= e((string) $producto['id']) ?>/eliminar" onsubmit="return confirm('¿Eliminar este producto?');">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
