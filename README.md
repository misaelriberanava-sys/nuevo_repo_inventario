# Proyecto Ventas (MVC + PDO)

Mini tienda en PHP con arquitectura MVC y PDO.

## Estructura

```
public/index.php                  Punto de entrada y router
config/db.php                     Conexión PDO
models/Producto.php               Consultas a la base de datos
controllers/ProductoController.php Orquesta modelo y vista
views/productos/index.php         Lista de productos
views/productos/show.php          Detalle de un producto
views/404.php                     Página no encontrada
sql/schema.sql                    Base de datos y datos de prueba
```

## Requisitos

- PHP 8 o superior
- MySQL o MariaDB (XAMPP)

## Puesta en marcha

1. Crear la base de datos:

   ```bash
   mysql -u root -p < sql/schema.sql
   ```

2. Levantar el servidor desde la raíz del proyecto:

   ```bash
   php -S localhost:8000 -t public
   ```

3. Abrir en el navegador:

   - http://localhost:8000/productos
   - http://localhost:8000/productos/1

## Rutas

- `GET /productos` lista todos los productos
- `GET /productos/{id}` muestra el detalle o responde 404

## Ramas

- `main`: base común del proyecto
- `CONF`: configuración
- `PROV`: proveedores
- `PROD`: productos
