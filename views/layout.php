<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Ventas</title>
    <style>
        body { font-family: system-ui, Arial, sans-serif; margin: 0; background: #f5f6f8; color: #222; }
        header { background: #1f2937; padding: 0.75rem 1.5rem; }
        header a { color: #fff; text-decoration: none; font-weight: 600; }
        main { max-width: 960px; margin: 1.5rem auto; padding: 0 1rem; }
        h1, h2 { margin-top: 0; }
        table { width: 100%; border-collapse: collapse; background: #fff; margin-bottom: 1rem; }
        th, td { padding: 0.6rem 0.75rem; border-bottom: 1px solid #e5e7eb; text-align: left; }
        th { background: #f3f4f6; }
        .acciones { display: flex; gap: 0.5rem; flex-wrap: wrap; align-items: center; }
        .btn { display: inline-block; padding: 0.45rem 0.8rem; border-radius: 6px; border: 0; background: #2563eb; color: #fff; text-decoration: none; font-size: 0.9rem; cursor: pointer; }
        .btn-sec { background: #6b7280; }
        .btn-danger { background: #dc2626; }
        .aviso { padding: 0.6rem 0.9rem; border-radius: 6px; margin-bottom: 1rem; }
        .aviso-ok { background: #dcfce7; color: #166534; }
        .aviso-error { background: #fee2e2; color: #991b1b; }
        .errores { background: #fee2e2; color: #991b1b; padding: 0.75rem 1rem; border-radius: 6px; margin-bottom: 1rem; }
        .errores ul { margin: 0; padding-left: 1.2rem; }
        .campo { margin-bottom: 1rem; }
        label { display: block; font-weight: 600; margin-bottom: 0.25rem; }
        input[type="text"], input[type="email"] { width: 100%; max-width: 420px; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 6px; }
        .error-campo { color: #991b1b; font-size: 0.85rem; margin-top: 0.25rem; }
        .vacio { color: #6b7280; }
    </style>
</head>
<body>
    <header>
        <a href="/proveedores">Proveedores</a>
    </header>
    <main>
        <?php require $contenido; ?>
    </main>
</body>
</html>
