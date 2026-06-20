<?php
/**
 * Componente: Cómo Funciona — 3 pasos
 *
 * @var array $howItWorks
 */
$steps = $howItWorks ?? [];
$whatsapp = e(config('whatsapp'));
?>
<section class="how-section section-block" id="como-funciona" aria-label="Cómo funciona">
    <div class="container">
        <div class="section-header text-center mb-4">
            <h2 class="section-title">Así de fácil</h2>
        </div>

        <div class="row g-3 steps-grid">
            <?php foreach ($steps as $index => $step): ?>
            <div class="col-md-4">
                <div class="step-card step-card-compact">
                    <div class="step-icon">
                        <i class="bi <?= e($step['icon'] ?? 'bi-circle') ?>"></i>
                    </div>
                    <h3 class="step-title"><?= e($step['title'] ?? '') ?></h3>
                    <p class="step-description"><?= e($step['description'] ?? '') ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-4">
            <a href="<?= $whatsapp ?>" class="btn btn-whatsapp px-5" target="_blank" rel="noopener noreferrer" data-track="how-cta">
                <i class="bi bi-whatsapp me-2"></i>Empezar ahora
            </a>
        </div>
    </div>
</section>
