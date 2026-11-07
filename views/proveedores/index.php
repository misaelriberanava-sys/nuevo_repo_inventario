<?php
declare(strict_types=1);
?>
<h1>Proveedores</h1>

<?php if (($ok ?? null) === 'creado'): ?>
    <div class="aviso aviso-ok">Proveedor creado correctamente.</div>
<?php elseif (($ok ?? null) === 'actualizado'): ?>
    <div class="aviso aviso-ok">Proveedor actualizado correctamente.</div>
<?php elseif (($ok ?? null) === 'eliminado'): ?>
    <div class="aviso aviso-ok">Proveedor eliminado correctamente.</div>
<?php endif; ?>

<?php if (($error ?? null) === 'tiene_productos'): ?>
    <div class="aviso aviso-error">No se puede eliminar: el proveedor tiene productos asociados.</div>
<?php endif; ?>

<p><a class="btn" href="/proveedores/crear">Nuevo proveedor</a></p>

<?php if ($proveedores === []): ?>
    <p class="vacio">No hay proveedores registrados.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Contacto</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($proveedores as $proveedor): ?>
                <tr>
                    <td><?= e((string) $proveedor['id']) ?></td>
                    <td><?= e($proveedor['nombre']) ?></td>
                    <td><?= e($proveedor['contacto']) ?></td>
                    <td><?= e($proveedor['email']) ?></td>
                    <td><?= e($proveedor['telefono'] ?? '') ?></td>
                    <td>
                        <div class="acciones">
                            <a class="btn btn-sec" href="/proveedores/<?= e((string) $proveedor['id']) ?>">Ver</a>
                            <a class="btn btn-sec" href="/proveedores/<?= e((string) $proveedor['id']) ?>/editar">Editar</a>
                            <form method="post" action="/proveedores/<?= e((string) $proveedor['id']) ?>/eliminar" onsubmit="return confirm('¿Eliminar este proveedor?');">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
