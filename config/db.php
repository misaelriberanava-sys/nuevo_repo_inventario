<?php
declare(strict_types=1);

$dsn = 'mysql:host=localhost;dbname=tienda;charset=utf8mb4';
$usuario = 'root';
$password = '';

$pdo = new PDO($dsn, $usuario, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
]);

return $pdo;
