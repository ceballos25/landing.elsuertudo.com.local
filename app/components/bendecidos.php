<?php
/**
 * Componente: Bendecidos recientes
 *
 * @var array $bendecidos Lista desde JSON
 */
$bendecidos = $bendecidos ?? [];
?>
<section class="bendecidos-section section-padding" id="bendecidos" aria-label="Bendecidos recientes">
    <div class="container">
        <div class="section-header text-center" data-animate="fade-up">
            <span class="section-badge">Confirmados en Colombia</span>
            <h2 class="section-title">Bendecidos recientes</h2>
            <p class="section-subtitle">
                Cada participación cuenta. Conoce a quienes ya vivieron la experiencia <?= e(config('brand')) ?> en todo el país.
            </p>
        </div>

        <?php if (!empty($bendecidos)): ?>
        <div class="row g-4 bendecidos-grid">
            <?php foreach ($bendecidos as $index => $persona): ?>
            <div class="col-sm-6 col-lg-4 col-xl-3" data-animate="fade-up" data-delay="<?= ($index % 4) * 100 ?>">
                <article class="bendecido-card">
                    <div class="bendecido-card-header">
                        <div class="bendecido-avatar-placeholder" aria-hidden="true">
                            <i class="bi bi-person-heart"></i>
                        </div>
                        <div class="bendecido-verified">
                            <i class="bi bi-patch-check-fill"></i>
                        </div>
                    </div>

                    <div class="bendecido-card-body">
                        <h3 class="bendecido-name"><?= e(maskName($persona['name'] ?? 'Participante')) ?></h3>
                        <p class="bendecido-location">
                            <i class="bi bi-geo-alt-fill"></i>
                            <?= e($persona['city'] ?? 'Colombia') ?>
                        </p>
                        <?php if (!empty($persona['activity'])): ?>
                        <p class="bendecido-activity"><?= e($persona['activity']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="bendecido-card-footer">
                        <time datetime="<?= e($persona['date'] ?? '') ?>">
                            <i class="bi bi-calendar3"></i>
                            <?= e(formatDate($persona['date'] ?? date('Y-m-d'))) ?>
                        </time>
                    </div>
                </article>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="text-center mt-5" data-animate="fade-up">
            <a href="<?= e(config('whatsapp')) ?>" class="btn btn-primary btn-lg px-5"
               target="_blank" rel="noopener noreferrer" data-track="bendecidos-cta">
                <i class="bi bi-whatsapp me-2"></i>Quiero ser el próximo bendecido
            </a>
        </div>
    </div>
</section>
