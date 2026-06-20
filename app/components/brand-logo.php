<?php
/**
 * Componente: Logo de marca reutilizable
 *
 * @var string $size Tamaño: sm | md | lg
 */
$size    = $size ?? 'md';
$asNav   = $asNav ?? false;
$brand   = e(config('brand'));
$logo    = e(cdnLogo((string) config('logo', 'logo.jpg')));
$classes = match ($size) {
    'sm'    => 'brand-logo brand-logo-sm',
    'lg'    => 'brand-logo brand-logo-lg',
    default => 'brand-logo',
};
if ($asNav) {
    $classes .= ' navbar-brand';
}
?>
<a href="#inicio" class="<?= $classes ?>" aria-label="<?= $brand ?> — Inicio">
    <img src="<?= $logo ?>" alt="<?= $brand ?>" loading="eager">
</a>
