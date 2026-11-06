<?php
declare(strict_types=1);

if (!function_exists('e')) {
    function e(?string $valor): string
    {
        return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('redirect')) {
    function redirect(string $ruta): void
    {
        header('Location: ' . $ruta);
        exit;
    }
}
