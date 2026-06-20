<?php
/**
 * Componente: Comprobantes — carrusel horizontal en móvil
 *
 * @var array $comprobantes
 */
$comprobantes = $comprobantes ?? [];
$whatsapp     = e(config('whatsapp'));
?>
<section class="comprobantes-section section-block" id="comprobantes" aria-label="Comprobantes verificados">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title">Algunos de nuestros bendecidos</h2>
            <p class="section-subtitle">Comprobantes recientes de la comunidad en Colombia.</p>
        </div>

        <?php if (!empty($comprobantes)): ?>
        <div class="comprobantes-carousel">
            <div class="comprobantes-fade comprobantes-fade-left" aria-hidden="true"></div>
            <div class="comprobantes-scroll" role="list">
                <?php foreach ($comprobantes as $comp): ?>
                <article class="comprobante-card comprobante-slide" role="listitem">
                    <div class="comprobante-image-wrap">
                        <img src="<?= e(cdnComprobante($comp['image'] ?? '')) ?>"
                             alt="Comprobante — <?= e($comp['name'] ?? '') ?>"
                             class="comprobante-image"
                             loading="lazy"
                             decoding="async">
                        <span class="comprobante-amount-badge"><?= e($comp['amount'] ?? '') ?></span>
                    </div>
                    <div class="comprobante-info">
                        <p class="comprobante-person"><?= e($comp['name'] ?? '') ?></p>
                        <span class="comprobante-platform">
                            <?= e($comp['platform'] ?? 'Nequi') ?> · <?= e(formatDate($comp['date'] ?? date('Y-m-d'))) ?>
                        </span>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
            <div class="comprobantes-fade comprobantes-fade-right" aria-hidden="true"></div>
        </div>
        <div class="comprobantes-dots d-lg-none" role="tablist" aria-label="Comprobantes"></div>
        <p class="comprobantes-hint d-lg-none text-center">
            <i class="bi bi-arrow-left-right"></i> Desliza para ver más
        </p>
        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="<?= $whatsapp ?>" class="btn btn-whatsapp btn-lg px-5"
               target="_blank" rel="noopener noreferrer" data-track="comprobantes-cta">
                <i class="bi bi-whatsapp me-2"></i>Quiero entrar al grupo
            </a>
        </div>
    </div>
</section>
