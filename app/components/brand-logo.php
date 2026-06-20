<?php
/**
 * Componente: Logo de marca — CDN únicamente
 * Base: https://cdn-el.elsuertudo.com.co/logos/
 *
 * @var string $size Tamaño: sm | md | lg
 */
$size    = $size ?? 'md';
$asNav   = $asNav ?? false;
$brand   = e(config('brand'));
$imgWidth = match ($size) {
    'sm'    => 130,
    'lg'    => 200,
    default => 160,
};
$imgHeight = match ($size) {
    'sm'    => 46,
    'lg'    => 80,
    default => 58,
};
$classes = match ($size) {
    'sm'    => 'brand-logo brand-logo-sm',
    'lg'    => 'brand-logo brand-logo-lg',
    default => 'brand-logo',
};
if ($asNav) {
    $classes .= ' navbar-brand';
}
$fetchPriority = $asNav ? 'high' : 'auto';
$loading       = $asNav ? 'eager' : 'lazy';
$sizes         = match ($size) {
    'sm'    => '130px',
    'lg'    => '200px',
    default => '(max-width:575.98px) 140px, 160px',
};

$webpSm = e(cdnLogo('logo-nav-sm.webp'));
$webpMd = e(cdnLogo('logo-nav.webp'));
$jpgSm  = e(cdnLogo('logo-nav-sm.jpg'));
$jpgMd  = e(cdnLogo('logo-nav.jpg'));
$webpSrcset = $size === 'sm'
    ? "{$webpSm} 280w"
    : "{$webpSm} 280w, {$webpMd} 320w";
$jpgSrcset = $size === 'sm'
    ? "{$jpgSm} 280w"
    : "{$jpgSm} 280w, {$jpgMd} 320w";
$jpgFallback = $size === 'sm' ? $jpgSm : $jpgMd;
?>
<a href="#inicio" class="<?= $classes ?>" aria-label="<?= $brand ?> — Inicio">
    <picture>
        <source srcset="<?= $webpSrcset ?>" sizes="<?= e($sizes) ?>" type="image/webp">
        <img src="<?= $jpgFallback ?>"
             srcset="<?= $jpgSrcset ?>"
             sizes="<?= e($sizes) ?>"
             alt="<?= $brand ?>"
             width="<?= $imgWidth ?>"
             height="<?= $imgHeight ?>"
             fetchpriority="<?= $fetchPriority ?>"
             decoding="async"
             loading="<?= $loading ?>">
    </picture>
</a>
