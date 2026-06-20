<?php
/**
 * Componente: Botón flotante de WhatsApp
 */
$whatsapp = e(config('whatsapp'));
?>
<a href="<?= $whatsapp ?>"
   class="whatsapp-float"
   target="_blank"
   rel="noopener noreferrer"
   aria-label="Contactar por WhatsApp"
   data-track="float-whatsapp"
   id="whatsappFloat">
    <i class="bi bi-whatsapp"></i>
    <span class="whatsapp-float-tooltip">¡Únete ahora!</span>
</a>
