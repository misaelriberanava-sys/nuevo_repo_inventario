<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/Producto.php';

class ProductoController
{
    private Producto $modelo;

    public function __construct(PDO $pdo)
    {
        $this->modelo = new Producto($pdo);
    }

    public function index(): void
    {
        $productos = $this->modelo->findAll();

        require __DIR__ . '/../views/productos/index.php';
    }

    public function show(int $id): void
    {
        $producto = $this->modelo->findById($id);

        if ($producto === null) {
            http_response_code(404);
            require __DIR__ . '/../views/404.php';

            return;
        }

        require __DIR__ . '/../views/productos/show.php';
    }
}
