<?php
/**
 * Componente: Barra de urgencia superior
 */
$whatsapp = e(config('whatsapp'));
?>
<div class="promo-bar">
    <div class="container promo-bar-inner">
        <span class="promo-bar-text">
            <i class="bi bi-lightning-charge-fill" aria-hidden="true"></i>
            Dinámica activa hoy · Cupos limitados
        </span>
        <a href="<?= $whatsapp ?>" class="promo-bar-cta" target="_blank" rel="noopener noreferrer" data-track="promo-bar">
            Entrar ahora <i class="bi bi-whatsapp" aria-hidden="true"></i>
        </a>
    </div>
</div>
