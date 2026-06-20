<?php
/**
 * Header: promo en flujo + navbar sticky (evita solapamiento al scroll)
 */
?>
<?php component('promo-bar'); ?>
<header class="site-header" id="siteHeader">
    <?php component('navbar'); ?>
    <div class="scroll-progress" id="scrollProgress" aria-hidden="true"></div>
</header>
