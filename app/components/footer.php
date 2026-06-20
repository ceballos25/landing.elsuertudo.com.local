<?php
/**
 * Componente: Footer
 */
$brand   = e(config('brand'));
$email   = e(config('contact.email'));
$phone   = e(config('contact.phone'));
$phoneTel = preg_replace('/\D/', '', (string) config('contact.phone', ''));
$country = e(config('contact.country', 'Colombia'));
$devUrl  = e(config('developer.url', 'https://rifacloud-landing.cristianceballos.com/'));
$devName = e(config('developer.name', 'Cristian Ceballos'));
$social  = config('social', []);
$year    = date('Y');
?>
<footer class="site-footer" aria-label="Pie de página">
    <div class="container">
        <div class="row g-4 footer-main">
            <div class="col-lg-4">
                <p class="footer-brand-name"><?= $brand ?></p>
                <p class="footer-description">
                    Tu suerte se construye en comunidad. Dinámicas claras, grupo activo
                    y la energía de El Suertudo desde Colombia.
                </p>
            </div>

            <div class="col-6 col-lg-2">
                <h2 class="footer-heading">Navegación</h2>
                <ul class="footer-links">
                    <li><a href="#inicio">Inicio</a></li>
                    <li><a href="#como-funciona">Cómo funciona</a></li>
                    <li><a href="#testimonios">Opiniones</a></li>
                </ul>
            </div>

            <div class="col-6 col-lg-3">
                <h2 class="footer-heading">Contacto</h2>
                <ul class="footer-contact">
                    <li>
                        <a href="tel:+<?= e($phoneTel) ?>">
                            <i class="bi bi-telephone"></i> <?= $phone ?>
                        </a>
                    </li>
                    <li>
                        <a href="mailto:<?= $email ?>">
                            <i class="bi bi-envelope"></i> <?= $email ?>
                        </a>
                    </li>
                    <li>
                        <i class="bi bi-geo-alt"></i> <?= $country ?>
                    </li>
                    <li>
                        <a href="<?= e(config('whatsapp')) ?>" target="_blank" rel="noopener noreferrer">
                            <i class="bi bi-whatsapp"></i> WhatsApp
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-3">
                <h2 class="footer-heading">Síguenos</h2>
                <div class="footer-social">
                    <?php if (!empty($social['facebook']) && $social['facebook'] !== '#' && $social['facebook'] !== ''): ?>
                    <a href="<?= e($social['facebook']) ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <?php endif; ?>
                    <?php if (!empty($social['instagram']) && $social['instagram'] !== '#' && $social['instagram'] !== ''): ?>
                    <a href="<?= e($social['instagram']) ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <?php endif; ?>
                    <?php if (!empty($social['twitter']) && $social['twitter'] !== '#'): ?>
                    <a href="<?= e($social['twitter']) ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                        <i class="bi bi-twitter-x"></i>
                    </a>
                    <?php endif; ?>
                    <?php if (!empty($social['tiktok']) && $social['tiktok'] !== '#'): ?>
                    <a href="<?= e($social['tiktok']) ?>" target="_blank" rel="noopener noreferrer" aria-label="TikTok">
                        <i class="bi bi-tiktok"></i>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?= $year ?> <?= $brand ?> · Colombia. Todos los derechos reservados.</p>
            <p class="footer-legal">
                Participa responsablemente. <?= $brand ?> promueve la transparencia y la confianza en cada actividad.
            </p>
            <p class="footer-dev">
                Desarrollado por
                <a href="<?= $devUrl ?>" class="footer-dev-link" target="_blank" rel="noopener noreferrer">
                    <?= $devName ?>
                    <i class="bi bi-box-arrow-up-right" aria-hidden="true"></i>
                </a>
            </p>
        </div>
    </div>
</footer>
