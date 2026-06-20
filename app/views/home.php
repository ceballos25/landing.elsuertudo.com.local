<?php
/**
 * Vista principal — flujo de conversión directa
 */

component('hero');

if (config('show_comprobantes', false)) {
    component('comprobantes', ['comprobantes' => $comprobantes ?? []]);
}

component('stats', ['stats' => $stats ?? []]);
component('how-it-works', ['howItWorks' => $howItWorks ?? []]);
component('testimonials', ['testimonials' => $testimonials ?? []]);
component('cta');
