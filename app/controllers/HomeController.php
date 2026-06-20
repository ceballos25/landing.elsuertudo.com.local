<?php
/**
 * Controlador principal de la landing page
 */

declare(strict_types=1);

namespace App\Controllers;

class HomeController
{
    public function index(): void
    {
        $data = [
            'pageTitle'    => config('brand') . ' — Entra al grupo · Colombia',
            'testimonials' => loadJson('testimonials.json'),
            'stats'        => loadJson('stats.json'),
            'howItWorks'   => $this->getHowItWorksSteps(),
        ];

        if (config('show_comprobantes', false)) {
            $data['comprobantes'] = loadJson('comprobantes.json');
        }

        view('home', $data);
    }

    private function getHowItWorksSteps(): array
    {
        $steps = [
            [
                'icon'        => 'bi-whatsapp',
                'title'       => 'Entra al grupo',
                'description' => 'Un clic y ya estás dentro.',
            ],
            [
                'icon'        => 'bi-hand-thumbs-up',
                'title'       => 'Participa',
                'description' => 'Dinámicas diarias, fáciles y claras.',
            ],
        ];

        if (config('show_comprobantes', false)) {
            $steps[] = [
                'icon'        => 'bi-shield-check',
                'title'       => 'Comprobante publicado',
                'description' => 'Cada pago queda verificado para todos.',
            ];
        } else {
            $steps[] = [
                'icon'        => 'bi-stars',
                'title'       => 'Vive la experiencia',
                'description' => 'Conoce la comunidad y crece con nosotros desde el inicio.',
            ];
        }

        return $steps;
    }
}
