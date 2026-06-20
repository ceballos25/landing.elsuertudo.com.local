<?php
/**
 * Banner promocional — CDN /logos/
 * Subir: banner.webp, banner-sm.webp, banner.png
 */
$alt       = e(config('banner.alt'));
$width     = (int) config('banner.width', 941);
$height    = (int) config('banner.height', 1672);
$webpFull  = e(cdnBanner((string) config('banner.image_webp', 'banner.webp')));
$webpSm    = e(cdnBanner((string) config('banner.image_sm', 'banner-sm.webp')));
$pngFull   = e(cdnBanner((string) config('banner.image', 'banner.png')));
?>
<figure class="hero-banner">
    <picture>
        <source srcset="<?= $webpSm ?> 720w, <?= $webpFull ?> 941w"
                sizes="(max-width:575.98px) 100vw, (max-width:991.98px) min(380px, 92vw), 420px"
                type="image/webp">
        <img src="<?= $pngFull ?>"
             alt="<?= $alt ?>"
             width="<?= $width ?>"
             height="<?= $height ?>"
             class="hero-banner-img"
             decoding="async"
             loading="eager"
             fetchpriority="high">
    </picture>
</figure>
