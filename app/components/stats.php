<?php
/**
 * Componente: Estadísticas compactas
 *
 * @var array $stats
 */
$stats = $stats ?? [
    ['value' => '100+',  'label' => 'En el grupo'],
    ['value' => '1',     'label' => 'Dinámica activa'],
    ['value' => 'Nueva', 'label' => 'Comunidad en marcha'],
    ['value' => '5.0★',  'label' => 'Opiniones recientes'],
];
?>
<section class="stats-section section-block" id="estadisticas" aria-label="Estadísticas">
    <div class="container">
        <div class="row g-3 stats-grid">
            <?php foreach ($stats as $index => $stat): ?>
            <div class="col-6 col-lg-3">
                <div class="stat-card stat-card-compact">
                    <div class="stat-value"><?= e($stat['value'] ?? '0') ?></div>
                    <div class="stat-label"><?= e($stat['label'] ?? '') ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
