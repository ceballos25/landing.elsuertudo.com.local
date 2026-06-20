<?php
/**
 * Componente: Hero Section — conversión directa
 */
$brand            = e(config('brand'));
$whatsapp         = e(config('whatsapp'));
$showBanner       = (bool) config('show_banner', true);
$showComprobantes = (bool) config('show_comprobantes', false);
$comprobantes     = $showComprobantes ? ($comprobantes ?? loadJson('comprobantes.json')) : [];
$destacado        = $comprobantes[0] ?? null;
?>
<section class="hero-section" id="inicio" aria-label="Sección principal">
    <div class="hero-bg-elements" aria-hidden="true">
        <div class="hero-gradient-orb hero-orb-1"></div>
        <div class="hero-gradient-orb hero-orb-2"></div>
    </div>

    <div class="container">
        <?php if ($showBanner): ?>
        <div class="hero-layout hero-layout--banner">
            <span class="hero-badge">
                <i class="bi bi-geo-alt-fill me-1"></i> Colombia · Comunidad activa
            </span>

            <h1 class="hero-title">
                Dinámicas reales.<br>Comunidad <span class="text-gradient">creciendo hoy</span>.
            </h1>

            <div class="hero-layout__banner">
                <?php component('hero-banner'); ?>
            </div>

            <p class="hero-subtitle">
                Únete al grupo de WhatsApp. Participaciones claras, acompañamiento cercano y dinámicas para empezar con confianza.
            </p>

            <a href="<?= $whatsapp ?>" class="btn btn-whatsapp btn-hero-cta"
               target="_blank" rel="noopener noreferrer" data-track="hero-cta-primary">
                <i class="bi bi-whatsapp"></i>
                <span>
                    <strong>Entrar al grupo ahora</strong>
                    <small>Gratis · Respuesta inmediata</small>
                </span>
            </a>

            <div class="hero-trust-badges">
                <div class="trust-badge"><i class="bi bi-lightning-charge"></i> Dinámicas activas</div>
                <div class="trust-badge"><i class="bi bi-people-fill"></i> +100 en el grupo</div>
            </div>
        </div>
        <?php else: ?>
        <div class="row align-items-center hero-row g-4 g-lg-5">
            <div class="col-lg-6 hero-col-content">
                <div class="hero-content">
                    <span class="hero-badge">
                        <i class="bi bi-geo-alt-fill me-1"></i> Colombia · Comunidad activa
                    </span>

                    <h1 class="hero-title">
                        Dinámicas reales.<br>Comunidad <span class="text-gradient">creciendo hoy</span>.
                    </h1>

                    <p class="hero-subtitle">
                        Únete al grupo de WhatsApp. Participaciones claras, acompañamiento cercano y dinámicas para empezar con confianza.
                    </p>

                    <a href="<?= $whatsapp ?>" class="btn btn-whatsapp btn-hero-cta"
                       target="_blank" rel="noopener noreferrer" data-track="hero-cta-primary">
                        <i class="bi bi-whatsapp"></i>
                        <span>
                            <strong>Entrar al grupo ahora</strong>
                            <small>Gratis · Respuesta inmediata</small>
                        </span>
                    </a>

                    <div class="hero-trust-badges">
                        <div class="trust-badge"><i class="bi bi-lightning-charge"></i> Dinámicas activas</div>
                        <div class="trust-badge"><i class="bi bi-people-fill"></i> +100 en el grupo</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 hero-col-visual">
                <?php if ($showComprobantes && $destacado): ?>
                <div class="hero-proof-card">
                    <div class="hero-proof-label">
                        <i class="bi bi-receipt"></i> Último comprobante publicado
                    </div>
                    <img src="<?= e(cdnComprobante($destacado['image'] ?? '')) ?>"
                         alt="Comprobante — <?= e($destacado['name'] ?? '') ?>"
                         class="hero-proof-image"
                         loading="eager">
                    <div class="hero-proof-info">
                        <strong><?= e($destacado['name'] ?? '') ?></strong>
                        <span class="hero-proof-amount"><?= e($destacado['amount'] ?? '') ?></span>
                    </div>
                    <a href="<?= $whatsapp ?>" class="btn btn-primary btn-sm w-100 mt-3"
                       target="_blank" rel="noopener noreferrer" data-track="hero-proof-cta">
                        Yo también quiero participar
                    </a>
                </div>
                <?php else: ?>
                <div class="hero-proof-card hero-community-card">
                    <div class="hero-proof-label">
                        <i class="bi bi-stars"></i> Estamos empezando contigo
                    </div>
                    <p class="hero-community-text">
                        Somos una comunidad nueva en Colombia. Entra al grupo, conoce cómo funciona
                        y sé parte desde el inicio de esta dinámica.
                    </p>
                    <ul class="hero-community-list">
                        <li><i class="bi bi-check-circle-fill"></i> Explicación clara paso a paso</li>
                        <li><i class="bi bi-check-circle-fill"></i> Grupo activo con respuesta rápida</li>
                    </ul>
                    <a href="<?= $whatsapp ?>" class="btn btn-primary btn-sm w-100 mt-3"
                       target="_blank" rel="noopener noreferrer" data-track="hero-community-cta">
                        Quiero unirme al grupo
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>
