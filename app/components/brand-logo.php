<?php
/**
 * Componente: Logo de marca reutilizable
 *
 * @var string $size Tamaño: sm | md | lg
 */
$size    = $size ?? 'md';
$asNav   = $asNav ?? false;
$brand   = e(config('brand'));
$logoUrl = e(cdnLogoNav());
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
?>
<a href="#inicio" class="<?= $classes ?>" aria-label="<?= $brand ?> — Inicio">
    <img src="<?= $logoUrl ?>"
         alt="<?= $brand ?>"
         width="<?= $imgWidth ?>"
         height="<?= $imgHeight ?>"
         fetchpriority="<?= $fetchPriority ?>"
         decoding="async"
         loading="<?= $loading ?>">
</a>
