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
        <input type="text" id="nombre" name="nombre" value="<?= e($proveedor['nombre'] ?? '') ?>" required maxlength="120">
        <?php if (isset($errores['nombre'])): ?>
            <div class="error-campo"><?= e($errores['nombre']) ?></div>
        <?php endif; ?>
    </div>

    <div class="campo">
        <label for="contacto">Contacto *</label>
        <input type="text" id="contacto" name="contacto" value="<?= e($proveedor['contacto'] ?? '') ?>" required maxlength="120">
        <?php if (isset($errores['contacto'])): ?>
            <div class="error-campo"><?= e($errores['contacto']) ?></div>
        <?php endif; ?>
    </div>

    <div class="campo">
        <label for="email">Email *</label>
        <input type="email" id="email" name="email" value="<?= e($proveedor['email'] ?? '') ?>" required maxlength="120">
        <?php if (isset($errores['email'])): ?>
            <div class="error-campo"><?= e($errores['email']) ?></div>
        <?php endif; ?>
    </div>

    <div class="campo">
        <label for="telefono">Teléfono</label>
        <input type="text" id="telefono" name="telefono" value="<?= e($proveedor['telefono'] ?? '') ?>" maxlength="30">
        <?php if (isset($errores['telefono'])): ?>
            <div class="error-campo"><?= e($errores['telefono']) ?></div>
        <?php endif; ?>
    </div>

    <p class="acciones">
        <button type="submit" class="btn">Guardar</button>
        <a class="btn btn-sec" href="/proveedores">Cancelar</a>
    </p>
</form>
