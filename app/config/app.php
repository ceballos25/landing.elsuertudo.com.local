<?php
/**
 * Configuración global de la aplicación
 * Valores cargados desde .env-la con fallbacks seguros
 */

declare(strict_types=1);

return [
    'name'        => env('APP_NAME', 'EL SUERTUDO'),
    'url'         => rtrim((string) env('APP_URL', 'http://localhost'), '/'),
    'brand'       => env('BRAND_NAME', 'El Suertudo'),
    'logo'        => env('BRAND_LOGO', 'logo.jpg'),
    'whatsapp'    => env('WHATSAPP_URL', '#'),
    'show_comprobantes' => filter_var(env('SHOW_COMPROBANTES', false), FILTER_VALIDATE_BOOLEAN),
    'cdn'         => [
        'base'         => rtrim((string) env('CDN_URL', 'https://cdn-el.elsuertudo.com.co'), '/'),
        'logos'        => rtrim((string) env('CDN_LOGOS_URL', 'https://cdn-el.elsuertudo.com.co/logos'), '/'),
        'comprobantes' => rtrim((string) env('CDN_COMPROBANTES_URL', 'https://cdn-el.elsuertudo.com.co/comprobantes'), '/'),
    ],
    'colors'      => [
        'primary'       => env('PRIMARY_COLOR', '#014005'),
        'primary_light' => env('PRIMARY_LIGHT', '#04D912'),
        'secondary'     => env('SECONDARY_COLOR', '#F29F05'),
        'accent'        => env('ACCENT_COLOR', '#AAF20F'),
        'dark'          => env('DARK_COLOR', '#014005'),
        'gold_light'    => env('GOLD_LIGHT', '#F2E205'),
        'gold_dark'     => env('GOLD_DARK', '#F29F05'),
    ],
    'analytics'   => [
        'meta_pixel' => env('META_PIXEL_ID', ''),
        'google'     => env('GOOGLE_ANALYTICS_ID', ''),
    ],
    'seo'         => [
        'description' => env('META_DESCRIPTION', 'Únete a la comunidad El Suertudo en Colombia.'),
        'keywords'    => env('META_KEYWORDS', 'comunidad,participaciones,dinámicas,Colombia,El Suertudo,bendecidos'),
        'og_image'    => env('OG_IMAGE', 'logo.jpg'),
    ],
    'contact'     => [
        'email'   => env('CONTACT_EMAIL', 'info@elsuertudo.com.co'),
        'phone'   => env('CONTACT_PHONE', '+57 320 5817000'),
        'country' => env('CONTACT_COUNTRY', 'Colombia'),
    ],
    'developer'   => [
        'name' => env('DEVELOPER_NAME', 'Cristian Ceballos'),
        'url'  => env('DEVELOPER_URL', 'https://rifacloud-landing.cristianceballos.com/'),
    ],
    'social'      => [
        'facebook'  => env('SOCIAL_FACEBOOK', '#'),
        'instagram' => env('SOCIAL_INSTAGRAM', '#'),
        'twitter'   => env('SOCIAL_TWITTER', '#'),
        'tiktok'    => env('SOCIAL_TIKTOK', '#'),
    ],
    'paths'       => [
        'root'    => dirname(__DIR__, 2),
        'app'     => dirname(__DIR__),
        'public'  => dirname(__DIR__, 2),
        'storage' => dirname(__DIR__, 2) . '/storage',
    ],
];
