<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($producto['nombre']) ?></title>
    <style>
        body { font-family: system-ui, sans-serif; margin: 2rem; }
        dl { display: grid; grid-template-columns: max-content 1fr; gap: 8px 24px; }
        dt { font-weight: bold; }
    </style>
</head>
<body>
    <h1><?= htmlspecialchars($producto['nombre']) ?></h1>
    <dl>
        <dt>ID</dt>
        <dd><?= (int) $producto['id'] ?></dd>
        <dt>Precio</dt>
        <dd><?= htmlspecialchars(number_format((float) $producto['precio'], 2)) ?></dd>
        <dt>Stock</dt>
        <dd><?= (int) $producto['stock'] ?></dd>
    </dl>
    <p><a href="/productos">Volver a la lista</a></p>
</body>
</html>
