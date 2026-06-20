<?php
/**
 * Componente: CTA Final
 */
$brand    = e(config('brand'));
$whatsapp = e(config('whatsapp'));
$phone    = e(config('contact.phone'));
?>
<section class="cta-section section-block" id="unete" aria-label="Llamado a la acción">
    <div class="container">
        <div class="cta-card text-center">
            <h2 class="cta-title">¿Vas a quedarte fuera?</h2>
            <p class="cta-subtitle mx-auto">
                La próxima dinámica puede ser la tuya. Entra al grupo ahora — es gratis.
            </p>
            <a href="<?= $whatsapp ?>" class="btn btn-whatsapp btn-cta-large mx-auto"
               target="_blank" rel="noopener noreferrer" data-track="cta-final">
                <i class="bi bi-whatsapp"></i>
                <span>
                    <strong>Entrar al grupo YA</strong>
                    <small><?= $phone ?></small>
                </span>
            </a>
        </div>
    </div>
</section>
