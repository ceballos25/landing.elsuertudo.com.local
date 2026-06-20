<?php
/**
 * Bootstrap de la aplicación
 * Inicializa entorno, configuración y helpers
 */

declare(strict_types=1);

// Definir constantes de rutas
define('ROOT_PATH', dirname(__DIR__));
define('APP_ROOT', dirname(ROOT_PATH));
define('APP_PATH', ROOT_PATH . '/app');
define('PUBLIC_PATH', ROOT_PATH);
define('STORAGE_PATH', ROOT_PATH . '/storage');

// Cargar variables de entorno desde websites/.env-la
require_once APP_PATH . '/config/env.php';
loadEnv(resolveEnvPath(ROOT_PATH));

// Cargar helpers
require_once APP_PATH . '/helpers/functions.php';

// Configuración de errores según entorno
$isProduction = env('APP_ENV', 'production') === 'production';

if ($isProduction) {
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
    ini_set('display_errors', '0');
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}

// Headers de seguridad básicos
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('X-XSS-Protection: 1; mode=block');
header('Referrer-Policy: strict-origin-when-cross-origin');

// Charset UTF-8
header('Content-Type: text/html; charset=UTF-8');
