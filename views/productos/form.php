<?php
declare(strict_types=1);
?>
<h1><?= e($titulo) ?></h1>

<?php if ($errores !== []): ?>
    <div class="errores">
        <ul>
            <?php foreach ($errores as $mensaje): ?>
                <li><?= e($mensaje) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" action="<?= e($accion) ?>">
    <div class="campo">
        <label for="nombre">Nombre *</label>
        <input type="text" id="nombre" name="nombre" value="<?= e($producto['nombre'] ?? '') ?>" required maxlength="80">
        <?php if (isset($errores['nombre'])): ?>
            <div class="error-campo"><?= e($errores['nombre']) ?></div>
        <?php endif; ?>
    </div>

    <div class="campo">
        <label for="precio">Precio *</label>
        <input type="number" id="precio" name="precio" value="<?= e((string) ($producto['precio'] ?? '')) ?>" required min="0.01" step="0.01">
        <?php if (isset($errores['precio'])): ?>
            <div class="error-campo"><?= e($errores['precio']) ?></div>
        <?php endif; ?>
    </div>

    <div class="campo">
        <label for="stock">Stock *</label>
        <input type="number" id="stock" name="stock" value="<?= e((string) ($producto['stock'] ?? '')) ?>" required min="0" step="1">
        <?php if (isset($errores['stock'])): ?>
            <div class="error-campo"><?= e($errores['stock']) ?></div>
        <?php endif; ?>
    </div>

    <div class="campo">
        <label for="proveedor_id">Proveedor *</label>
        <select id="proveedor_id" name="proveedor_id" required>
            <option value="">Seleccione un proveedor</option>
            <?php foreach ($proveedores as $proveedor): ?>
                <option value="<?= e((string) $proveedor['id']) ?>" <?= ((string) ($producto['proveedor_id'] ?? '') === (string) $proveedor['id']) ? 'selected' : '' ?>>
                    <?= e($proveedor['nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($errores['proveedor_id'])): ?>
            <div class="error-campo"><?= e($errores['proveedor_id']) ?></div>
        <?php endif; ?>
    </div>

    <p class="acciones">
        <button type="submit" class="btn">Guardar</button>
        <a class="btn btn-sec" href="/productos">Cancelar</a>
    </p>
</form>
