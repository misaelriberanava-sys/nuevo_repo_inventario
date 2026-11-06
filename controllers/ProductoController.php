<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Proveedor.php';

class ProductoController
{
    private Producto $productos;
    private Proveedor $proveedores;

    public function __construct(private PDO $pdo)
    {
        $this->productos = new Producto($pdo);
        $this->proveedores = new Proveedor($pdo);
    }

    public function index(): void
    {
        $proveedorId = null;

        if (isset($_GET['proveedor_id']) && $_GET['proveedor_id'] !== '') {
            $proveedorId = (int) $_GET['proveedor_id'];
        }

        $this->render('productos/index', [
            'productos' => $this->productos->listar($proveedorId),
            'proveedores' => $this->proveedores->listar(),
            'proveedorId' => $proveedorId,
            'ok' => $_GET['ok'] ?? null,
            'error' => $_GET['error'] ?? null,
        ]);
    }

    public function show(int $id): void
    {
        $producto = $this->productos->buscarPorId($id);

        if ($producto === null) {
            $this->notFound();
            return;
        }

        $this->render('productos/show', ['producto' => $producto]);
    }

    public function create(): void
    {
        $this->render('productos/form', [
            'producto' => ['nombre' => '', 'precio' => '', 'stock' => '0', 'proveedor_id' => ''],
            'proveedores' => $this->proveedores->listar(),
            'errores' => [],
            'accion' => '/productos',
            'titulo' => 'Nuevo producto',
        ]);
    }

    public function store(): void
    {
        $datos = $this->datosFormulario();
        $errores = $this->validar($datos);

        if ($errores !== []) {
            $this->render('productos/form', [
                'producto' => $datos,
                'proveedores' => $this->proveedores->listar(),
                'errores' => $errores,
                'accion' => '/productos',
                'titulo' => 'Nuevo producto',
            ]);
            return;
        }

        $this->productos->crear($this->datosParaGuardar($datos));
        redirect('/productos?ok=creado');
    }

    public function edit(int $id): void
    {
        $producto = $this->productos->buscarPorId($id);

        if ($producto === null) {
            $this->notFound();
            return;
        }

        $this->render('productos/form', [
            'producto' => $producto,
            'proveedores' => $this->proveedores->listar(),
            'errores' => [],
            'accion' => '/productos/' . $id,
            'titulo' => 'Editar producto',
        ]);
    }

    public function update(int $id): void
    {
        if ($this->productos->buscarPorId($id) === null) {
            $this->notFound();
            return;
        }

        $datos = $this->datosFormulario();
        $errores = $this->validar($datos);

        if ($errores !== []) {
            $this->render('productos/form', [
                'producto' => array_merge($datos, ['id' => $id]),
                'proveedores' => $this->proveedores->listar(),
                'errores' => $errores,
                'accion' => '/productos/' . $id,
                'titulo' => 'Editar producto',
            ]);
            return;
        }

        $this->productos->actualizar($id, $this->datosParaGuardar($datos));
        redirect('/productos?ok=actualizado');
    }

    public function destroy(int $id): void
    {
        if ($this->productos->buscarPorId($id) === null) {
            $this->notFound();
            return;
        }

        $this->productos->eliminar($id);
        redirect('/productos?ok=eliminado');
    }

    private function datosFormulario(): array
    {
        return [
            'nombre' => trim((string) ($_POST['nombre'] ?? '')),
            'precio' => trim((string) ($_POST['precio'] ?? '')),
            'stock' => trim((string) ($_POST['stock'] ?? '')),
            'proveedor_id' => trim((string) ($_POST['proveedor_id'] ?? '')),
        ];
    }

    private function datosParaGuardar(array $datos): array
    {
        return [
            'proveedor_id' => (int) $datos['proveedor_id'],
            'nombre' => $datos['nombre'],
            'precio' => (float) $datos['precio'],
            'stock' => (int) $datos['stock'],
        ];
    }

    private function validar(array $datos): array
    {
        $errores = [];

        if ($datos['nombre'] === '') {
            $errores['nombre'] = 'El nombre es obligatorio.';
        }

        if ($datos['precio'] === '') {
            $errores['precio'] = 'El precio es obligatorio.';
        } elseif (!is_numeric($datos['precio']) || (float) $datos['precio'] <= 0) {
            $errores['precio'] = 'El precio debe ser mayor que 0.';
        }

        if ($datos['stock'] === '') {
            $errores['stock'] = 'El stock es obligatorio.';
        } elseif (preg_match('/^\d+$/', $datos['stock']) !== 1) {
            $errores['stock'] = 'El stock debe ser un entero mayor o igual a 0.';
        }

        if ($datos['proveedor_id'] === '') {
            $errores['proveedor_id'] = 'Debes seleccionar un proveedor.';
        } elseif ($this->proveedores->buscarPorId((int) $datos['proveedor_id']) === null) {
            $errores['proveedor_id'] = 'El proveedor seleccionado no existe.';
        }

        return $errores;
    }

    private function render(string $vista, array $datos = []): void
    {
        extract($datos, EXTR_SKIP);
        $contenido = __DIR__ . '/../views/' . $vista . '.php';
        require __DIR__ . '/../views/layout.php';
    }

    private function notFound(): void
    {
        http_response_code(404);
        $contenido = __DIR__ . '/../views/404.php';
        require __DIR__ . '/../views/layout.php';
    }
}
