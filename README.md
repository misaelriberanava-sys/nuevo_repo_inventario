# Proyecto Ventas (MVC + PDO)

Base común del proyecto. Aquí se integran las ramas de cada módulo
(proveedores y productos) sobre la configuración PDO y la estructura de carpetas.

## Estructura

```
config/db.php             Conexión PDO a la base tienda
public/index.php          Punto de entrada único
database/schema.sql       Tablas proveedores/productos y vista
database/seed.sql         Datos de prueba
models/                   Modelos
controllers/              Controladores
views/                    Vistas
```

## Requisitos

- PHP 8 o superior
- MySQL o MariaDB (XAMPP)

## Puesta en marcha

1. Crear la base de datos y cargar los datos de prueba:

   ```bash
   C:\xampp\mysql\bin\mysql.exe -u root < database/schema.sql
   C:\xampp\mysql\bin\mysql.exe -u root < database/seed.sql
   ```

2. Levantar el servidor desde la raíz del proyecto:

   ```bash
   C:\xampp\php\php.exe -S localhost:8000 -t public
   ```

3. Abrir:

   - http://localhost:8000

## Ramas

- `main`: base común (integración)
- `CONF`: épica 0, configuración base
- `PROV`: épica proveedores
- `PROD`: épica productos
