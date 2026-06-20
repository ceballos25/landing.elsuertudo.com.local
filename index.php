<?php
/**
 * Punto de entrada de la aplicación (document root)
 * Todas las peticiones web pasan por este archivo
 */

declare(strict_types=1);

// Bootstrap de la aplicación
require_once __DIR__ . '/app/bootstrap.php';

// Autoload simple para controladores (PSR-4 con directorio lowercase)
spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/app/';

    if (!str_starts_with($class, $prefix)) {
        return;
    }

    $relativeClass = substr($class, strlen($prefix));
    $parts = explode('\\', $relativeClass);

    // Normalizar directorios a lowercase (controllers, models, etc.)
    if (count($parts) > 1) {
        $parts[0] = strtolower($parts[0]);
    }

    $file = $baseDir . implode('/', $parts) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

/**
 * Resuelve y ejecuta la ruta solicitada
 */
function dispatch(): void
{
    $routes = require __DIR__ . '/routes/web.php';
    $uri    = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

    // Normalizar URI (remover trailing slash excepto root)
    if ($uri !== '/' && str_ends_with($uri, '/')) {
        $uri = rtrim($uri, '/');
    }

    // Buscar ruta exacta
    if (!isset($routes[$uri])) {
        http_response_code(404);
        echo '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><title>404</title></head>';
        echo '<body style="font-family:sans-serif;text-align:center;padding:4rem;">';
        echo '<h1>404 — Página no encontrada</h1>';
        echo '<p><a href="/">Volver al inicio</a></p></body></html>';
        return;
    }

    [$controllerClass, $method] = $routes[$uri];

    if (!class_exists($controllerClass)) {
        throw new RuntimeException("Controlador no encontrado: {$controllerClass}");
    }

    $controller = new $controllerClass();

    if (!method_exists($controller, $method)) {
        throw new RuntimeException("Método no encontrado: {$method}");
    }

    $controller->$method();
}

dispatch();
