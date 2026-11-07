<?php
declare(strict_types=1);

class Producto
{
    public function __construct(private PDO $pdo)
    {
    }

    public function listar(?int $proveedorId = null): array
    {
        $sql = 'SELECT p.id, p.nombre, p.precio, p.stock,
                       pr.id AS proveedor_id, pr.nombre AS proveedor
                FROM productos AS p
                JOIN proveedores AS pr ON pr.id = p.proveedor_id';
        $parametros = [];

        if ($proveedorId !== null) {
            $sql .= ' WHERE p.proveedor_id = :proveedor_id';
            $parametros[':proveedor_id'] = $proveedorId;
        }

        $sql .= ' ORDER BY p.nombre';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($parametros);

        return $stmt->fetchAll();
    }

    public function listarConVista(?int $proveedorId = null): array
    {
        $sql = 'SELECT id, producto AS nombre, precio, stock, proveedor_id, proveedor
                FROM vista_productos_con_proveedor';
        $parametros = [];

        if ($proveedorId !== null) {
            $sql .= ' WHERE proveedor_id = :proveedor_id';
            $parametros[':proveedor_id'] = $proveedorId;
        }

        $sql .= ' ORDER BY producto';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($parametros);

        return $stmt->fetchAll();
    }

    public function buscarPorId(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            'SELECT p.id, p.nombre, p.precio, p.stock,
                    pr.id AS proveedor_id, pr.nombre AS proveedor, pr.email AS proveedor_email
             FROM productos AS p
             JOIN proveedores AS pr ON pr.id = p.proveedor_id
             WHERE p.id = :id'
        );
        $stmt->execute([':id' => $id]);
        $producto = $stmt->fetch();

        return $producto === false ? null : $producto;
    }

    public function listarPorProveedor(int $proveedorId): array
    {
        return $this->listar($proveedorId);
    }

    public function crear(array $datos): int
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO productos (proveedor_id, nombre, precio, stock)
             VALUES (:proveedor_id, :nombre, :precio, :stock)'
        );
        $stmt->execute([
            ':proveedor_id' => $datos['proveedor_id'],
            ':nombre' => $datos['nombre'],
            ':precio' => $datos['precio'],
            ':stock' => $datos['stock'],
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function actualizar(int $id, array $datos): bool
    {
        $stmt = $this->pdo->prepare(
            'UPDATE productos
             SET proveedor_id = :proveedor_id,
                 nombre = :nombre,
                 precio = :precio,
                 stock = :stock
             WHERE id = :id'
        );

        return $stmt->execute([
            ':proveedor_id' => $datos['proveedor_id'],
            ':nombre' => $datos['nombre'],
            ':precio' => $datos['precio'],
            ':stock' => $datos['stock'],
            ':id' => $id,
        ]);
    }

    public function eliminar(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM productos WHERE id = :id');
        $stmt->execute([':id' => $id]);

        return $stmt->rowCount() > 0;
    }
}
