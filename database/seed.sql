USE inventario;

SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE productos;
TRUNCATE TABLE proveedores;
SET FOREIGN_KEY_CHECKS = 1;

INSERT INTO proveedores (nombre, contacto, email, telefono) VALUES
    ('Distribuidora ABC', 'Carlos Pérez', 'abc@distribuidora.com', '3001234567'),
    ('Comercial XYZ', 'Ana Gómez', 'xyz@comercial.com', '3109876543');

INSERT INTO productos (proveedor_id, nombre, precio, stock) VALUES
    (1, 'Cuaderno 100 hojas', 8500.00, 30),
    (1, 'Lápiz HB', 1200.00, 100),
    (2, 'Resma de papel', 24500.00, 15);
