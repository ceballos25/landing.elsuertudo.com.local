<?php
/**
 * Componente: Testimonios — slider horizontal
 *
 * @var array $testimonials
 */
$testimonials = $testimonials ?? [];
?>
<section class="testimonials-section section-block" id="testimonios" aria-label="Testimonios">
    <div class="container">
        <div class="section-header text-center mb-4">
            <h2 class="section-title">Lo dicen ellos</h2>
            <p class="section-subtitle">Opiniones reales de quienes ya están en la comunidad.</p>
        </div>

        <?php if (!empty($testimonials)): ?>
        <div class="testimonials-carousel">
            <div class="testimonials-fade testimonials-fade-left" aria-hidden="true"></div>
            <div class="testimonials-scroll" role="list">
                <?php foreach ($testimonials as $testimonial): ?>
                <article class="testimonial-slide" role="listitem">
                    <blockquote class="testimonial-card testimonial-card-compact">
                        <div class="testimonial-rating" aria-label="<?= (int) ($testimonial['rating'] ?? 5) ?> de 5 estrellas">
                            <?php for ($i = 0; $i < (int) ($testimonial['rating'] ?? 5); $i++): ?>
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            <?php endfor; ?>
                        </div>
                        <p class="testimonial-text">"<?= e($testimonial['text'] ?? '') ?>"</p>
                        <footer class="testimonial-author">
                            <div>
                                <cite class="testimonial-name"><?= e(maskName($testimonial['name'] ?? '')) ?></cite>
                                <span class="testimonial-city"><?= e($testimonial['city'] ?? '') ?></span>
                            </div>
                        </footer>
                    </blockquote>
                </article>
                <?php endforeach; ?>
            </div>
            <div class="testimonials-fade testimonials-fade-right" aria-hidden="true"></div>
        </div>
        <div class="testimonials-dots" role="tablist" aria-label="Testimonios"></div>
        <p class="testimonials-hint text-center">
            <i class="bi bi-arrow-left-right"></i> Desliza para ver más opiniones
        </p>
        <?php endif; ?>
    </div>
</section>
