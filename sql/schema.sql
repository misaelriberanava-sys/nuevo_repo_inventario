CREATE DATABASE IF NOT EXISTS tienda
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE tienda;

CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(80) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    creado_en DATE NOT NULL DEFAULT (CURRENT_DATE)
);

INSERT INTO productos (nombre, precio, stock) VALUES
    ('Cafetera', 89.90, 12),
    ('Tostadora', 45.50, 3),
    ('Licuadora', 62.00, 8);
