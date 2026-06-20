<?php
/**
 * Cargador de variables de entorno desde .env-la
 * El archivo vive un nivel arriba del document root (websites/.env-la)
 */

declare(strict_types=1);

/**
 * Resuelve la ruta del archivo de entorno (.env-la)
 */
function resolveEnvPath(string $publicRoot): string
{
    $publicRoot = rtrim($publicRoot, '/\\');
    $candidates = [
        dirname($publicRoot) . '/.env-la',
        $publicRoot . '/.env-la',
    ];

    foreach ($candidates as $path) {
        $real = realpath($path);
        if ($real !== false && is_readable($real)) {
            return $real;
        }
    }

    return $candidates[0];
}

/**
 * Carga y parsea el archivo .env-la
 */
function loadEnv(string $envPath): void
{
    if (!file_exists($envPath)) {
        return;
    }

    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if ($lines === false) {
        return;
    }

    foreach ($lines as $line) {
        $line = trim($line);

        // Ignorar comentarios y líneas vacías
        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }

        // Separar clave=valor
        if (!str_contains($line, '=')) {
            continue;
        }

        [$key, $value] = explode('=', $line, 2);
        $key   = trim($key);
        $value = trim($value);

        // Remover comillas envolventes
        if (
            (str_starts_with($value, '"') && str_ends_with($value, '"')) ||
            (str_starts_with($value, "'") && str_ends_with($value, "'"))
        ) {
            $value = substr($value, 1, -1);
        }

        // No sobrescribir variables del sistema
        if (!array_key_exists($key, $_ENV)) {
            $_ENV[$key] = $value;
            putenv("{$key}={$value}");
        }
    }
}

/**
 * Obtiene una variable de entorno con valor por defecto
 */
function env(string $key, mixed $default = null): mixed
{
    $value = $_ENV[$key] ?? getenv($key);

    if ($value === false || $value === '') {
        return $default;
    }

    // Convertir valores booleanos
    return match (strtolower((string) $value)) {
        'true', '(true)'  => true,
        'false', '(false)' => false,
        'null', '(null)'  => null,
        'empty', '(empty)' => '',
        default           => $value,
    };
}
