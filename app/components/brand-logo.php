<?php
/**
 * Componente: Logo de marca reutilizable
 *
 * @var string $size Tamaño: sm | md | lg
 */
$size    = $size ?? 'md';
$asNav   = $asNav ?? false;
$brand   = e(config('brand'));
$variant = match ($size) {
    'sm'    => 'logo-nav-sm',
    'lg'    => 'logo-nav',
    default => 'logo-nav',
};
$useLocal = hasLocalLogoNav() && is_readable(dirname(__DIR__, 2) . "/assets/img/{$variant}.webp");
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

if ($useLocal) {
    $webpSm = e(logoNavWebpUrl('logo-nav-sm'));
    $webpMd = e(logoNavWebpUrl('logo-nav'));
    $jpgSm  = e(logoNavJpgUrl('logo-nav-sm'));
    $jpgMd  = e(logoNavJpgUrl('logo-nav'));
    $webpSrcset = $size === 'sm'
        ? "{$webpSm} 280w"
        : "{$webpSm} 280w, {$webpMd} 320w";
    $jpgSrcset = $size === 'sm'
        ? "{$jpgSm} 280w"
        : "{$jpgSm} 280w, {$jpgMd} 320w";
    $jpgFallback = $size === 'sm' ? $jpgSm : $jpgMd;
} else {
    $jpgFallback = e(cdnLogoNav());
}
?>
<a href="#inicio" class="<?= $classes ?>" aria-label="<?= $brand ?> — Inicio">
    <?php if ($useLocal): ?>
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
    <?php else: ?>
    <img src="<?= $jpgFallback ?>"
         alt="<?= $brand ?>"
         width="<?= $imgWidth ?>"
         height="<?= $imgHeight ?>"
         fetchpriority="<?= $fetchPriority ?>"
         decoding="async"
         loading="<?= $loading ?>">
    <?php endif; ?>
</a>
