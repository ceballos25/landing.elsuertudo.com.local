<?php
/**
 * Barra CTA fija inferior (móvil)
 */
$whatsapp = e(config('whatsapp'));
?>
<div class="mobile-cta-bar d-lg-none" aria-label="Acción rápida">
    <a href="<?= $whatsapp ?>" class="mobile-cta-btn" target="_blank" rel="noopener noreferrer" data-track="mobile-bar">
        <i class="bi bi-whatsapp"></i>
        <span>Entrar al grupo ahora</span>
    </a>
</div>
