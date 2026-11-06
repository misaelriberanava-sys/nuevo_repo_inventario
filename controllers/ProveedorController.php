<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/Proveedor.php';

class ProveedorController
{
    private Proveedor $modelo;

    public function __construct(private PDO $pdo)
    {
        $this->modelo = new Proveedor($pdo);
    }

    public function index(): void
    {
        $this->render('proveedores/index', [
            'proveedores' => $this->modelo->listar(),
            'ok' => $_GET['ok'] ?? null,
            'error' => $_GET['error'] ?? null,
        ]);
    }

    public function show(int $id): void
    {
        $proveedor = $this->modelo->buscarPorId($id);

        if ($proveedor === null) {
            $this->notFound();
            return;
        }

        $this->render('proveedores/show', [
            'proveedor' => $proveedor,
            'productos' => $this->modelo->listarConProductos($id),
        ]);
    }

    public function create(): void
    {
        $this->render('proveedores/form', [
            'proveedor' => ['nombre' => '', 'contacto' => '', 'email' => '', 'telefono' => ''],
            'errores' => [],
            'accion' => '/proveedores',
            'titulo' => 'Nuevo proveedor',
        ]);
    }

    public function store(): void
    {
        $datos = $this->datosFormulario();
        $errores = $this->validar($datos);

        if ($errores !== []) {
            $this->render('proveedores/form', [
                'proveedor' => $datos,
                'errores' => $errores,
                'accion' => '/proveedores',
                'titulo' => 'Nuevo proveedor',
            ]);
            return;
        }

        $this->modelo->crear($datos);
        redirect('/proveedores?ok=creado');
    }

    public function edit(int $id): void
    {
        $proveedor = $this->modelo->buscarPorId($id);

        if ($proveedor === null) {
            $this->notFound();
            return;
        }

        $this->render('proveedores/form', [
            'proveedor' => $proveedor,
            'errores' => [],
            'accion' => '/proveedores/' . $id,
            'titulo' => 'Editar proveedor',
        ]);
    }

    public function update(int $id): void
    {
        if ($this->modelo->buscarPorId($id) === null) {
            $this->notFound();
            return;
        }

        $datos = $this->datosFormulario();
        $errores = $this->validar($datos, $id);

        if ($errores !== []) {
            $this->render('proveedores/form', [
                'proveedor' => array_merge($datos, ['id' => $id]),
                'errores' => $errores,
                'accion' => '/proveedores/' . $id,
                'titulo' => 'Editar proveedor',
            ]);
            return;
        }

        $this->modelo->actualizar($id, $datos);
        redirect('/proveedores?ok=actualizado');
    }

    public function destroy(int $id): void
    {
        if ($this->modelo->buscarPorId($id) === null) {
            $this->notFound();
            return;
        }

        if (!$this->modelo->eliminar($id)) {
            redirect('/proveedores?error=tiene_productos');
        }

        redirect('/proveedores?ok=eliminado');
    }

    private function datosFormulario(): array
    {
        return [
            'nombre' => trim((string) ($_POST['nombre'] ?? '')),
            'contacto' => trim((string) ($_POST['contacto'] ?? '')),
            'email' => trim((string) ($_POST['email'] ?? '')),
            'telefono' => trim((string) ($_POST['telefono'] ?? '')),
        ];
    }

    private function validar(array $datos, ?int $excluirId = null): array
    {
        $errores = [];

        if ($datos['nombre'] === '') {
            $errores['nombre'] = 'El nombre es obligatorio.';
        }

        if ($datos['contacto'] === '') {
            $errores['contacto'] = 'El contacto es obligatorio.';
        }

        if ($datos['email'] === '') {
            $errores['email'] = 'El email es obligatorio.';
        } elseif (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = 'El email no tiene un formato válido.';
        } elseif ($this->modelo->emailExiste($datos['email'], $excluirId)) {
            $errores['email'] = 'Ese email ya está registrado.';
        }

        if ($datos['telefono'] !== '' && !preg_match('/^[0-9+\-\s]{7,30}$/', $datos['telefono'])) {
            $errores['telefono'] = 'El teléfono no tiene un formato válido.';
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
