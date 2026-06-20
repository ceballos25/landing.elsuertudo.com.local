/**
 * El Suertudo Landing — UX mobile-first, scroll y conversión
 */

'use strict';

const SECTION_IDS = ['inicio', 'estadisticas', 'como-funciona', 'testimonios', 'unete'];
const SCROLL_EXTRA_OFFSET = 16;
let scrollOffsetCache = 88;

document.addEventListener('DOMContentLoaded', () => {
    document.documentElement.classList.add('js-ready');
    initHeaderOffset();
    initNavbarToggle();
    initNavbarScroll();
    initSmoothScroll();
    initScrollSpy();
    initScrollProgress();
    initHorizontalCarousel({
        carouselSelector: '.comprobantes-carousel',
        scrollSelector: '.comprobantes-scroll',
        slideSelector: '.comprobante-slide',
        dotsSelector: '.comprobantes-dots',
        dotClass: 'comprobantes-dot',
        labelPrefix: 'Comprobante',
    });
    initHorizontalCarousel({
        carouselSelector: '.testimonials-carousel',
        scrollSelector: '.testimonials-scroll',
        slideSelector: '.testimonial-slide',
        dotsSelector: '.testimonials-dots',
        dotClass: 'testimonials-dot',
        labelPrefix: 'Testimonio',
    });
    initScrollAnimations();
    initLazyLoading();
    initCTATracking();
    initHashOnLoad();
    initMobileViewportFix();
});

/**
 * Corrige 100vh en móvil (barra del navegador) y recalcula header
 */
function initMobileViewportFix() {
    const setViewportHeight = () => {
        document.documentElement.style.setProperty(
            '--viewport-height',
            `${window.innerHeight}px`
        );
    };

    setViewportHeight();
    window.addEventListener('resize', setViewportHeight, { passive: true });
    window.addEventListener('orientationchange', () => {
        setTimeout(setViewportHeight, 150);
    }, { passive: true });
}

/**
 * Calcula altura del navbar sticky para offsets de scroll
 */
function initHeaderOffset() {
    const navbar = document.getElementById('mainNavbar');
    if (!navbar) return;

    const update = () => {
        const height = Math.ceil(navbar.getBoundingClientRect().height);
        document.documentElement.style.setProperty('--navbar-height', `${height}px`);
        document.documentElement.style.setProperty('--header-offset', `${height}px`);
        refreshScrollOffsetCache();
    };

    update();
    window.addEventListener('resize', update, { passive: true });
    window.addEventListener('scroll', () => requestAnimationFrame(update), { passive: true });

    if (typeof ResizeObserver !== 'undefined') {
        const observer = new ResizeObserver(update);
        observer.observe(navbar);
    }
}

/**
 * Offset total para scroll (header + margen) — cacheado para evitar reflows en scroll
 */
function refreshScrollOffsetCache() {
    scrollOffsetCache = computeScrollOffset();
}

function getScrollOffset() {
    return scrollOffsetCache;
}

function computeScrollOffset() {
    const navbar = document.getElementById('mainNavbar');
    const navbarHeight = navbar
        ? Math.ceil(navbar.getBoundingClientRect().height)
        : parseInt(getComputedStyle(document.documentElement).getPropertyValue('--navbar-height') || '72', 10);

    const promo = document.querySelector('.promo-bar');
    let promoOverlap = 0;

    if (promo) {
        const promoBottom = promo.getBoundingClientRect().bottom;
        if (promoBottom > 0) {
            promoOverlap = Math.ceil(promoBottom);
        }
    }

    const stickyOffset = promoOverlap > 0 ? promoOverlap + navbarHeight : navbarHeight;

    return stickyOffset + SCROLL_EXTRA_OFFSET;
}

function scrollToElement(target, { updateHash = true } = {}) {
    if (!target) return;

    const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const offset = getScrollOffset();
    const top = target.getBoundingClientRect().top + window.scrollY - offset;

    window.scrollTo({
        top: Math.max(0, top),
        behavior: prefersReduced ? 'auto' : 'smooth',
    });

    if (updateHash && target.id) {
        history.pushState(null, '', `#${target.id}`);
    }
}

/**
 * Menú mobile sin Bootstrap JS (~80 KB menos)
 */
function initNavbarToggle() {
    const navbar = document.getElementById('mainNavbar');
    if (!navbar) return;

    const toggler = navbar.querySelector('[data-nav-toggle]');
    const collapse = navbar.querySelector('.navbar-collapse');
    if (!toggler || !collapse) return;

    const setOpen = (open) => {
        collapse.classList.toggle('show', open);
        toggler.setAttribute('aria-expanded', open ? 'true' : 'false');
    };

    toggler.addEventListener('click', () => {
        setOpen(!collapse.classList.contains('show'));
    });

    document.addEventListener('click', (event) => {
        if (!collapse.classList.contains('show')) return;
        if (navbar.contains(event.target)) return;
        setOpen(false);
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 992) {
            setOpen(false);
        }
    }, { passive: true });
}

/**
 * Navbar: sombra al scroll + cerrar menú mobile
 */
function initNavbarScroll() {
    const navbar = document.getElementById('mainNavbar');
    if (!navbar) return;

    let ticking = false;

    const onScroll = () => {
        if (ticking) return;
        ticking = true;
        requestAnimationFrame(() => {
            navbar.classList.toggle('scrolled', window.scrollY > 8);
            ticking = false;
        });
    };

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    navbar.querySelectorAll('.nav-link[href^="#"]').forEach(link => {
        link.addEventListener('click', () => {
            const collapse = navbar.querySelector('.navbar-collapse');
            const toggler = navbar.querySelector('[data-nav-toggle]');
            if (collapse?.classList.contains('show')) {
                collapse.classList.remove('show');
                toggler?.setAttribute('aria-expanded', 'false');
            }
        });
    });
}

/**
 * Scroll suave con offset correcto para header fijo
 */
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', (e) => {
            const targetId = anchor.getAttribute('href');
            if (!targetId || targetId === '#') return;

            const target = document.querySelector(targetId);
            if (!target) return;

            e.preventDefault();
            scrollToElement(target);
        });
    });
}

/**
 * Scroll al hash si la URL trae ancla al cargar
 */
function initHashOnLoad() {
    const hash = window.location.hash;
    if (!hash || hash === '#') return;

    const target = document.querySelector(hash);
    if (!target) return;

    // Esperar a que el layout calcule el header real
    requestAnimationFrame(() => {
        requestAnimationFrame(() => {
            scrollToElement(target, { updateHash: false });
        });
    });
}

/**
 * Resalta sección activa en el menú al hacer scroll
 */
function initScrollSpy() {
    const navLinks = document.querySelectorAll('#mainNavbar .nav-link[href^="#"]');
    if (!navLinks.length) return;

    const sections = SECTION_IDS
        .map(id => document.getElementById(id))
        .filter(Boolean);

    if (!sections.length) return;

    let activeId = '';
    let ticking = false;

    const setActive = (id) => {
        if (id === activeId) return;
        activeId = id;

        navLinks.forEach(link => {
            const href = link.getAttribute('href')?.slice(1);
            link.classList.toggle('is-active', href === id);
        });
    };

    const update = () => {
        const offset = getScrollOffset() + 40;
        let current = sections[0]?.id || '';

        for (const section of sections) {
            if (section.getBoundingClientRect().top <= offset) {
                current = section.id;
            }
        }

        setActive(current);
        ticking = false;
    };

    const onScroll = () => {
        if (ticking) return;
        ticking = true;
        requestAnimationFrame(update);
    };

    window.addEventListener('scroll', onScroll, { passive: true });
    update();
}

/**
 * Barra de progreso de scroll bajo el header
 */
function initScrollProgress() {
    const bar = document.getElementById('scrollProgress');
    if (!bar) return;

    let ticking = false;

    const update = () => {
        const scrollTop = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        const progress = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
        bar.style.width = `${Math.min(100, Math.max(0, progress))}%`;
        ticking = false;
    };

    window.addEventListener('scroll', () => {
        if (ticking) return;
        ticking = true;
        requestAnimationFrame(update);
    }, { passive: true });

    update();
}

/**
 * Carrusel horizontal reutilizable (comprobantes, testimonios, etc.)
 */
function initHorizontalCarousel({
    carouselSelector,
    scrollSelector,
    slideSelector,
    dotsSelector,
    dotClass,
    labelPrefix,
}) {
    const carousel = document.querySelector(carouselSelector);
    const container = document.querySelector(scrollSelector);
    if (!container) return;

    const slides = [...container.querySelectorAll(slideSelector)];
    const dotsWrap = document.querySelector(dotsSelector);

    container.setAttribute('tabindex', '0');
    container.setAttribute('aria-label', `${labelPrefix}s — desliza horizontalmente`);

    if (dotsWrap && slides.length > 1) {
        slides.forEach((_, index) => {
            const dot = document.createElement('button');
            dot.type = 'button';
            dot.className = `${dotClass}${index === 0 ? ' is-active' : ''}`;
            dot.setAttribute('aria-label', `${labelPrefix} ${index + 1} de ${slides.length}`);
            dot.setAttribute('aria-pressed', index === 0 ? 'true' : 'false');

            dot.addEventListener('click', () => {
                slides[index].scrollIntoView({
                    behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth',
                    inline: 'center',
                    block: 'nearest',
                });
            });

            dotsWrap.appendChild(dot);
        });
    }

    let ticking = false;

    const update = () => {
        const maxScroll = container.scrollWidth - container.clientWidth;
        const atStart = container.scrollLeft <= 6;
        const atEnd = maxScroll <= 6 || container.scrollLeft >= maxScroll - 6;

        carousel?.classList.toggle('show-fade-left', !atStart);
        carousel?.classList.toggle('show-fade-right', !atEnd);

        if (dotsWrap && slides.length > 1) {
            const center = container.scrollLeft + container.clientWidth / 2;
            let activeIndex = 0;
            let minDistance = Infinity;

            slides.forEach((slide, index) => {
                const slideCenter = slide.offsetLeft + slide.offsetWidth / 2;
                const distance = Math.abs(center - slideCenter);
                if (distance < minDistance) {
                    minDistance = distance;
                    activeIndex = index;
                }
            });

            dotsWrap.querySelectorAll(`.${dotClass}`).forEach((dot, index) => {
                const isActive = index === activeIndex;
                dot.classList.toggle('is-active', isActive);
                dot.setAttribute('aria-pressed', isActive ? 'true' : 'false');
            });
        }

        ticking = false;
    };

    const onScroll = () => {
        if (ticking) return;
        ticking = true;
        requestAnimationFrame(update);
    };

    container.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', update, { passive: true });
    update();
}

/**
 * Animaciones suaves al scroll — nunca bloquean contenido
 */
function initScrollAnimations() {
    const elements = document.querySelectorAll('[data-animate]');
    if (!elements.length) return;

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        elements.forEach(el => el.classList.add('is-visible'));
        return;
    }

    const fallback = setTimeout(() => {
        elements.forEach(el => el.classList.add('is-visible'));
    }, 1200);

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;

                const delay = parseInt(entry.target.dataset.delay || '0', 10);
                setTimeout(() => {
                    entry.target.classList.add('is-visible');
                }, delay);

                observer.unobserve(entry.target);
            });
        },
        { threshold: 0.08, rootMargin: '0px 0px 8% 0px' }
    );

    elements.forEach(el => observer.observe(el));

    const checkDone = setInterval(() => {
        const pending = document.querySelectorAll('[data-animate]:not(.is-visible)');
        if (pending.length === 0) {
            clearTimeout(fallback);
            clearInterval(checkDone);
        }
    }, 200);
}

/**
 * Lazy loading con manejo de errores
 */
function initLazyLoading() {
    document.querySelectorAll('img[loading="lazy"]').forEach(img => {
        img.addEventListener('error', () => { img.style.opacity = '0.3'; });
    });
}

/**
 * Tracking de CTAs WhatsApp
 */
function initCTATracking() {
    document.querySelectorAll('[data-track]').forEach(button => {
        button.addEventListener('click', () => {
            const trackId = button.dataset.track;

            if (typeof gtag === 'function') {
                gtag('event', 'whatsapp_click', {
                    event_category: 'conversion',
                    event_label: trackId,
                });
            }

            if (typeof fbq === 'function') {
                fbq('track', 'Contact', { source: trackId });
            }
        });
    });
}
