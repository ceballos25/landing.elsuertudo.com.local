<?php
/**
 * Funciones helper globales reutilizables
 */

declare(strict_types=1);

/**
 * Escapa salida HTML para prevenir XSS
 */
function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

/**
 * Obtiene valor de configuración usando notación de punto
 * Ejemplo: config('colors.primary')
 */
function config(string $key, mixed $default = null): mixed
{
    static $config = null;

    if ($config === null) {
        $config = require dirname(__DIR__) . '/config/app.php';
    }

    $keys  = explode('.', $key);
    $value = $config;

    foreach ($keys as $segment) {
        if (!is_array($value) || !array_key_exists($segment, $value)) {
            return $default;
        }
        $value = $value[$segment];
    }

    return $value;
}

/**
 * Obtiene la URL base detectando HTTPS automáticamente
 */
function baseUrl(): string
{
    $configured = rtrim((string) config('url', ''), '/');

    // Detectar protocolo real de la petición (evita mixed content en HTTPS)
    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (isset($_SERVER['SERVER_PORT']) && (int) $_SERVER['SERVER_PORT'] === 443)
        || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');

    if ($configured !== '') {
        $parsed = parse_url($configured);
        $scheme = $isHttps ? 'https' : ($parsed['scheme'] ?? 'http');
        $host   = $parsed['host'] ?? ($_SERVER['HTTP_HOST'] ?? 'localhost');

        return "{$scheme}://{$host}";
    }

    $scheme = $isHttps ? 'https' : 'http';
    $host   = $_SERVER['HTTP_HOST'] ?? 'localhost';

    return "{$scheme}://{$host}";
}

/**
 * Genera URL absoluta del sitio
 */
function url(string $path = ''): string
{
    $base = baseUrl();
    $path = ltrim($path, '/');

    return $path === '' ? $base : "{$base}/{$path}";
}

/**
 * Genera URL de asset con cache busting opcional
 */
function asset(string $path): string
{
    return url(ltrim($path, '/'));
}

/**
 * Normaliza una ruta de imagen CDN (acepta filename, ruta local legacy o URL absoluta)
 */
function normalizeCdnPath(string $path): string
{
    if ($path === '') {
        return '';
    }

    if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
        return $path;
    }

    $path = ltrim($path, '/');
    $path = preg_replace('#^assets/img/comprobantes/#', '', $path) ?? $path;
    $path = preg_replace('#^assets/img/#', '', $path) ?? $path;

    return ltrim($path, '/');
}

/**
 * Genera URL absoluta en el CDN de logos o comprobantes
 */
function cdnAsset(string $bucket, string $path): string
{
    $path = normalizeCdnPath($path);

    if ($path === '') {
        return '';
    }

    if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
        return $path;
    }

    $base = rtrim((string) config("cdn.{$bucket}", ''), '/');

    return "{$base}/{$path}";
}

function cdnLogo(string $path): string
{
    return cdnAsset('logos', $path);
}

function cdnComprobante(string $path): string
{
    return cdnAsset('comprobantes', $path);
}

/**
 * Incluye un componente reutilizable
 */
function component(string $name, array $data = []): void
{
    $file = dirname(__DIR__) . "/components/{$name}.php";

    if (!file_exists($file)) {
        throw new RuntimeException("Componente no encontrado: {$name}");
    }

    extract($data, EXTR_SKIP);
    require $file;
}

/**
 * Renderiza una vista con layout
 */
function view(string $name, array $data = [], string $layout = 'main'): void
{
    $viewFile   = dirname(__DIR__) . "/views/{$name}.php";
    $layoutFile = dirname(__DIR__) . "/layouts/{$layout}.php";

    if (!file_exists($viewFile)) {
        throw new RuntimeException("Vista no encontrada: {$name}");
    }

    extract($data, EXTR_SKIP);

    ob_start();
    require $viewFile;
    $content = ob_get_clean();

    if (file_exists($layoutFile)) {
        require $layoutFile;
    } else {
        echo $content;
    }
}

/**
 * Carga datos JSON desde storage
 */
function loadJson(string $filename): array
{
    $path = config('paths.storage') . '/data/' . $filename;

    if (!file_exists($path)) {
        return [];
    }

    $content = file_get_contents($path);
    if ($content === false) {
        return [];
    }

    $data = json_decode($content, true);

    return is_array($data) ? $data : [];
}

/**
 * Enmascara nombre parcial para privacidad
 * Ejemplo: "Carlos Mendoza" → "Carlos M."
 */
function maskName(string $fullName): string
{
    $parts = explode(' ', trim($fullName));

    if (count($parts) === 1) {
        return $parts[0];
    }

    $firstName = $parts[0];
    $lastInitial = mb_substr($parts[count($parts) - 1], 0, 1);

    return "{$firstName} {$lastInitial}.";
}

/**
 * Formatea fecha en español
 */
function formatDate(string $date): string
{
    $timestamp = strtotime($date);

    if ($timestamp === false) {
        return $date;
    }

    $months = [
        1 => 'ene', 2 => 'feb', 3 => 'mar', 4 => 'abr',
        5 => 'may', 6 => 'jun', 7 => 'jul', 8 => 'ago',
        9 => 'sep', 10 => 'oct', 11 => 'nov', 12 => 'dic',
    ];

    $day   = date('j', $timestamp);
    $month = $months[(int) date('n', $timestamp)];
    $year  = date('Y', $timestamp);

    return "{$day} {$month} {$year}";
}
