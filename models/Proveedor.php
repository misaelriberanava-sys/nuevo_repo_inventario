<?php
declare(strict_types=1);

class Proveedor
{
    public function __construct(private PDO $pdo)
    {
    }

    public function listar(): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, nombre, contacto, email, telefono
             FROM proveedores
             ORDER BY nombre'
        );
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function buscarPorId(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, nombre, contacto, email, telefono
             FROM proveedores
             WHERE id = :id'
        );
        $stmt->execute([':id' => $id]);
        $proveedor = $stmt->fetch();

        return $proveedor === false ? null : $proveedor;
    }

    public function emailExiste(string $email, ?int $excluirId = null): bool
    {
        $sql = 'SELECT COUNT(*) FROM proveedores WHERE email = :email';
        $parametros = [':email' => $email];

        if ($excluirId !== null) {
            $sql .= ' AND id <> :id';
            $parametros[':id'] = $excluirId;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($parametros);

        return (int) $stmt->fetchColumn() > 0;
    }

    public function crear(array $datos): int
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO proveedores (nombre, contacto, email, telefono)
             VALUES (:nombre, :contacto, :email, :telefono)'
        );
        $stmt->execute([
            ':nombre' => $datos['nombre'],
            ':contacto' => $datos['contacto'],
            ':email' => $datos['email'],
            ':telefono' => $datos['telefono'] !== '' ? $datos['telefono'] : null,
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function actualizar(int $id, array $datos): bool
    {
        $stmt = $this->pdo->prepare(
            'UPDATE proveedores
             SET nombre = :nombre,
                 contacto = :contacto,
                 email = :email,
                 telefono = :telefono
             WHERE id = :id'
        );

        return $stmt->execute([
            ':nombre' => $datos['nombre'],
            ':contacto' => $datos['contacto'],
            ':email' => $datos['email'],
            ':telefono' => $datos['telefono'] !== '' ? $datos['telefono'] : null,
            ':id' => $id,
        ]);
    }

    public function listarConProductos(int $id): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, nombre, precio, stock
             FROM productos
             WHERE proveedor_id = :id
             ORDER BY nombre'
        );
        $stmt->execute([':id' => $id]);

        return $stmt->fetchAll();
    }

    public function contarProductos(int $id): int
    {
        $stmt = $this->pdo->prepare(
            'SELECT COUNT(*) FROM productos WHERE proveedor_id = :id'
        );
        $stmt->execute([':id' => $id]);

        return (int) $stmt->fetchColumn();
    }

    public function eliminar(int $id): bool
    {
        if ($this->contarProductos($id) > 0) {
            return false;
        }

        $stmt = $this->pdo->prepare('DELETE FROM proveedores WHERE id = :id');
        $stmt->execute([':id' => $id]);

        return $stmt->rowCount() > 0;
    }
}
