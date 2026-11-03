<?php
declare(strict_types=1);

class Producto
{
    public function __construct(private PDO $db)
    {
    }

    public function findAll(): array
    {
        $sql = 'SELECT id, nombre, precio, stock FROM productos ORDER BY id';
        $stmt = $this->db->query($sql);

        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $sql = 'SELECT id, nombre, precio, stock FROM productos WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $producto = $stmt->fetch();

        return $producto ?: null;
    }
}
