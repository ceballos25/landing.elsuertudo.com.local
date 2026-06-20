<?php
/**
 * Layout principal de la landing page
 *
 * @var string $content Contenido renderizado de la vista
 * @var string $pageTitle Título de la página
 */

$primaryColor   = e(config('colors.primary'));
$secondaryColor = e(config('colors.secondary'));
$brandName      = e(config('brand'));
$appUrl         = e(rtrim((string) config('url'), '/'));
$pageTitleSafe  = e($pageTitle ?? config('brand'));
$description    = e(config('seo.description'));
$keywords       = e(config('seo.keywords'));
$ogImageFile    = (string) config('seo.og_image', 'logo.jpg');
$ogImage        = e(cdnLogo($ogImageFile));
$faviconFile    = (string) config('favicon', 'logo.ico');
$faviconUrl     = e(cdnLogo($faviconFile));
$faviconType    = e(imageMimeType($faviconFile));
$ogImageAlt     = e(config('seo.og_image_alt', 'El Suertudo — Comunidad oficial en Colombia'));
$ogImageWidth   = (int) config('seo.og_image_width', 1200);
$ogImageHeight  = (int) config('seo.og_image_height', 1200);
$ogImageType    = e(imageMimeType($ogImageFile));
$whatsappUrl    = e(config('whatsapp'));
$socialFacebook = trim((string) config('social.facebook', ''));
$socialInstagram = trim((string) config('social.instagram', ''));
$pixelId        = preg_replace('/\D/', '', (string) config('analytics.meta_pixel', ''));
$gaId           = trim((string) config('analytics.google', ''));
$gaId           = str_starts_with($gaId, 'G-') && !str_contains($gaId, 'XXXX') ? $gaId : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="<?= $primaryColor ?>">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="<?= $brandName ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- SEO básico -->
    <title><?= $pageTitleSafe ?></title>
    <meta name="description" content="<?= $description ?>">
    <meta name="keywords" content="<?= $keywords ?>">
    <meta name="author" content="<?= $brandName ?>">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <meta name="googlebot" content="index, follow, max-image-preview:large">
    <link rel="canonical" href="<?= $appUrl ?>/">

    <!-- Open Graph — WhatsApp, Facebook, LinkedIn, etc. -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $appUrl ?>/">
    <meta property="og:title" content="<?= $pageTitleSafe ?>">
    <meta property="og:description" content="<?= $description ?>">
    <meta property="og:site_name" content="<?= $brandName ?>">
    <meta property="og:locale" content="es_CO">
    <meta property="og:locale:alternate" content="es_ES">
    <meta property="og:image" content="<?= $ogImage ?>">
    <meta property="og:image:secure_url" content="<?= $ogImage ?>">
    <meta property="og:image:type" content="<?= $ogImageType ?>">
    <meta property="og:image:width" content="<?= $ogImageWidth ?>">
    <meta property="og:image:height" content="<?= $ogImageHeight ?>">
    <meta property="og:image:alt" content="<?= $ogImageAlt ?>">

    <!-- Twitter / X Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $pageTitleSafe ?>">
    <meta name="twitter:description" content="<?= $description ?>">
    <meta name="twitter:image" content="<?= $ogImage ?>">
    <meta name="twitter:image:alt" content="<?= $ogImageAlt ?>">

    <!-- Schema.org / compatibilidad adicional -->
    <link rel="image_src" href="<?= $ogImage ?>">

    <?php if ($socialFacebook !== '' && $socialFacebook !== '#'): ?>
    <meta property="og:see_also" content="<?= e($socialFacebook) ?>">
    <?php endif; ?>
    <?php if ($socialInstagram !== '' && $socialInstagram !== '#'): ?>
    <meta property="og:see_also" content="<?= e($socialInstagram) ?>">
    <?php endif; ?>

    <!-- Favicon e iconos -->
    <link rel="icon" type="<?= $faviconType ?>" href="<?= $faviconUrl ?>">
    <link rel="shortcut icon" type="<?= $faviconType ?>" href="<?= $faviconUrl ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $ogImage ?>">

    <!-- Preconnect / DNS prefetch -->
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdn-el.elsuertudo.com.co" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Iconos: reservar espacio antes de cargar la fuente (reduce CLS) -->
    <link rel="preload" as="font" type="font/woff2" crossorigin
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/fonts/bootstrap-icons.woff2">

    <!-- CSS crítico inline + hojas completas sin bloquear render -->
    <style><?= criticalCss() ?></style>
    <?php asyncStylesheet('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css'); ?>
    <?php asyncStylesheet(asset('assets/css/main.css?v=14')); ?>

    <!-- Fuentes e iconos (no críticos) -->
    <?php asyncStylesheet('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=optional'); ?>
    <?php asyncStylesheet('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css'); ?>

    <!-- Variables de marca -->
    <style>
        :root {
            --color-primary: <?= $primaryColor ?>;
            --color-primary-light: <?= e(config('colors.primary_light', '#04D912')) ?>;
            --color-secondary: <?= e(config('colors.secondary')) ?>;
            --color-accent: <?= e(config('colors.accent', '#AAF20F')) ?>;
            --color-dark: <?= e(config('colors.dark', '#014005')) ?>;
            --color-gold-light: <?= e(config('colors.gold_light', '#F2E205')) ?>;
            --color-primary-rgb: <?= implode(',', sscanf($primaryColor, "#%02x%02x%02x") ?: [1, 64, 5]) ?>;
            --color-secondary-rgb: <?= implode(',', sscanf((string) config('colors.secondary'), "#%02x%02x%02x") ?: [242, 159, 5]) ?>;
        }
    </style>

    <?php if ($pixelId !== ''): ?>
    <!-- Meta Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
        n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
        document,'script','https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '<?= e($pixelId) ?>');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none"
             src="https://www.facebook.com/tr?id=<?= e($pixelId) ?>&ev=PageView&noscript=1"
             alt="">
    </noscript>
    <!-- End Meta Pixel Code -->
    <?php endif; ?>

    <?php if ($gaId !== ''): ?>
    <!-- Google Analytics (carga diferida) -->
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?= e($gaId) ?>');
        window.addEventListener('load', function () {
            var s = document.createElement('script');
            s.src = 'https://www.googletagmanager.com/gtag/js?id=<?= e($gaId) ?>';
            s.async = true;
            document.head.appendChild(s);
        }, { once: true });
    </script>
    <?php endif; ?>
</head>
<body>

    <?php component('site-header'); ?>

    <main id="main-content">
        <?= $content ?>
    </main>

    <?php component('footer'); ?>
    <?php component('mobile-cta-bar'); ?>
    <?php component('whatsapp-float'); ?>

    <!-- Custom JS (sin Bootstrap bundle — menú en vanilla) -->
    <script src="<?= asset('assets/js/main.js?v=11') ?>" defer></script>
</body>
</html>
