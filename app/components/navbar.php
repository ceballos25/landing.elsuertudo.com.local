<?php
/**
 * Componente: Navbar
 */
$whatsapp = e(config('whatsapp'));
?>
<nav class="navbar navbar-expand-lg" id="mainNavbar" aria-label="Navegación principal">
        <div class="container">
            <?php component('brand-logo', ['size' => 'md', 'asNav' => true]); ?>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarContent" aria-controls="navbarContent"
                    aria-expanded="false" aria-label="Abrir menú">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                    <li class="nav-item">
                        <a class="nav-link" href="#como-funciona">Cómo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonios">Opiniones</a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a href="<?= $whatsapp ?>" class="btn btn-whatsapp btn-sm px-4" target="_blank" rel="noopener noreferrer"
                           data-track="navbar-cta">
                            <i class="bi bi-whatsapp me-1"></i> Únete ahora
                        </a>
                    </li>
                </ul>
            </div>
        </div>
</nav>
