# El Suertudo — Landing Page

Landing page profesional para **El Suertudo** (Colombia), enfocada en generar confianza y conversión hacia el grupo de WhatsApp de la comunidad. Diseño claro, **mobile-first**, con identidad verde/amarilla y assets servidos desde CDN.

---

## Objetivo

Transmitir confianza, cercanía y comunidad activa para que los visitantes:

- Entren al grupo de WhatsApp
- Conozcan cómo funciona la participación
- Vean testimonios reales de la comunidad
- Confíen en la marca El Suertudo

---

## Stack tecnológico

| Capa | Tecnología |
|------|------------|
| Backend | PHP 8+ (sin frameworks) |
| Frontend | HTML5, CSS3, JavaScript vanilla |
| UI | Bootstrap 5.3 + Bootstrap Icons |
| Tipografía | Google Fonts — Montserrat |
| Datos | JSON estáticos en `storage/data/` |
| Configuración | Variables `.env-la` (un nivel arriba del proyecto) |
| CDN | Logos y comprobantes en `cdn-el.elsuertudo.com.co` |
| Servidor | Apache + `mod_rewrite` |

---

## Requisitos del sistema

- PHP 8.1 o superior
- Apache 2.4 con `mod_rewrite`, `mod_headers`, `mod_deflate` y `mod_expires`
- Extensiones PHP: `json`, `mbstring` (recomendado)
- Certificado SSL (HTTPS en producción)

---

## Estructura del proyecto

```
websites/
├── .env-la                              # Variables de entorno (no versionar)
│
└── landing.elsuertudo.com.local/
    ├── .htaccess                        # Rewrite, seguridad, caché y compresión
    ├── index.php                        # Punto de entrada (document root)
    ├── robots.txt
    ├── sitemap.xml
    │
    ├── app/
    │   ├── bootstrap.php                # Inicialización, seguridad y carga de .env-la
    │   ├── config/
    │   │   ├── env.php                  # Cargador de variables .env-la
    │   │   └── app.php                  # Configuración global
    │   ├── controllers/
    │   │   └── HomeController.php
    │   ├── helpers/
    │   │   └── functions.php            # e(), config(), cdnLogo(), view(), component()
    │   ├── layouts/
    │   │   └── main.php                 # Layout HTML, SEO, OG, analytics
    │   ├── components/                  # Componentes reutilizables PHP
    │   │   ├── site-header.php
    │   │   ├── promo-bar.php
    │   │   ├── navbar.php
    │   │   ├── brand-logo.php
    │   │   ├── hero.php
    │   │   ├── comprobantes.php
    │   │   ├── stats.php
    │   │   ├── how-it-works.php
    │   │   ├── testimonials.php
    │   │   ├── cta.php
    │   │   ├── footer.php
    │   │   ├── mobile-cta-bar.php
    │   │   └── whatsapp-float.php
    │   └── views/
    │       └── home.php                 # Vista principal
    │
    ├── assets/
    │   ├── css/main.css
    │   ├── js/main.js
    │   └── img/
    │       └── favicon.svg
    │
    ├── routes/
    │   └── web.php                      # Definición de rutas
    │
    └── storage/
        └── data/
            ├── comprobantes.json
            ├── testimonials.json
            ├── stats.json
            └── bendecidos.json
```

> **Importante:** El `DocumentRoot` de Apache apunta a la **raíz del proyecto**, no a una carpeta `/public`.

---

## Instalación

### 1. Clonar o subir el proyecto

```bash
cd /ruta/del/servidor
# Copiar archivos del proyecto
```

### 2. Configurar variables de entorno

El archivo de configuración vive **un nivel arriba** del proyecto, en la carpeta `websites/`:

```bash
# Ruta esperada:
# /ruta/websites/.env-la
```

Editar `.env-la` con los valores de producción (dominio, WhatsApp, colores, analytics, etc.).

### 3. Permisos

```bash
chmod 644 ../.env-la
chmod -R 755 assets/ app/ storage/
```

### 4. Virtual Host Apache (ejemplo)

```apache
<VirtualHost *:443>
    ServerName landing.elsuertudo.com.co
    DocumentRoot /var/www/landing.elsuertudo.com.local

    <Directory /var/www/landing.elsuertudo.com.local>
        AllowOverride All
        Require all granted
    </Directory>

    SSLEngine on
    # ... certificados SSL
</VirtualHost>
```

### 5. Verificar

Abrir el dominio en el navegador. Todos los assets deben cargar por HTTPS sin errores de mixed content.

---

## Variables de entorno (`.env-la`)

| Variable | Descripción |
|----------|-------------|
| `APP_NAME` | Nombre interno de la aplicación |
| `APP_URL` | URL base del sitio (con HTTPS en producción) |
| `BRAND_NAME` | Nombre de marca visible |
| `BRAND_LOGO` | Nombre del archivo del logo en CDN (`logo.jpg`) |
| `CDN_URL` | URL base del CDN |
| `CDN_LOGOS_URL` | URL de logos (`https://cdn-el.elsuertudo.com.co/logos`) |
| `CDN_COMPROBANTES_URL` | URL de comprobantes (`https://cdn-el.elsuertudo.com.co/comprobantes`) |
| `WHATSAPP_URL` | Enlace al grupo de WhatsApp |
| `SHOW_COMPROBANTES` | `true` para mostrar comprobantes (por defecto ocultos) |
| `PRIMARY_COLOR` | Verde oscuro principal (`#014005`) |
| `PRIMARY_LIGHT` | Verde brillante (`#04D912`) |
| `SECONDARY_COLOR` | Naranja acento (`#F29F05`) |
| `ACCENT_COLOR` | Verde lima (`#AAF20F`) |
| `GOLD_LIGHT` | Amarillo acento (`#F2E205`) |
| `DARK_COLOR` | Color oscuro auxiliar (`#014005`) |
| `META_PIXEL_ID` | ID de Meta Pixel (opcional) |
| `GOOGLE_ANALYTICS_ID` | ID de Google Analytics (opcional) |
| `OG_IMAGE` | Imagen para previsualización de enlaces (`logo.jpg` en CDN) |
| `OG_IMAGE_ALT` | Texto alternativo de la imagen OG |
| `OG_IMAGE_WIDTH` | Ancho de la imagen OG en píxeles (default `1200`) |
| `OG_IMAGE_HEIGHT` | Alto de la imagen OG en píxeles (default `1200`) |
| `META_DESCRIPTION` | Meta descripción SEO |
| `META_KEYWORDS` | Palabras clave SEO |
| `CONTACT_EMAIL` | Correo de contacto |
| `CONTACT_PHONE` | Teléfono de contacto |
| `CONTACT_COUNTRY` | País |
| `DEVELOPER_NAME` | Nombre del desarrollador |
| `DEVELOPER_URL` | URL del desarrollador |
| `SOCIAL_FACEBOOK` | URL de Facebook |
| `SOCIAL_INSTAGRAM` | URL de Instagram |
| `SOCIAL_TWITTER` | URL de Twitter/X (opcional) |
| `SOCIAL_TIKTOK` | URL de TikTok (opcional) |

---

## Rutas

| Ruta | Controlador | Método | Descripción |
|------|-------------|--------|-------------|
| `/` | `HomeController` | `index` | Landing principal |

Cualquier otra ruta devuelve **404**.

---

## Secciones de la landing

Orden de conversión en `app/views/home.php`:

1. **Hero** — Título, CTA principal y tarjeta de comunidad
2. **Estadísticas** — Cifras de la comunidad (100+ en el grupo, dinámica activa, etc.)
3. **Cómo funciona** — 3 pasos simples
4. **Testimonios** — Slider horizontal «Lo dicen ellos»
5. **CTA final** — Llamado a la acción

> **Comprobantes:** la sección está **oculta por defecto** mientras la dinámica arranca. Para activarla, agregar `SHOW_COMPROBANTES=true` en `.env-la`.

### Elementos globales

- Barra de urgencia superior (promo bar, scroll normal)
- Navbar sticky con scroll spy
- Barra CTA inferior en móvil
- Botón flotante de WhatsApp
- Barra de progreso de scroll

---

## Datos dinámicos (JSON)

Los contenidos editables están en `storage/data/`:

### `comprobantes.json`

Solo se usa si `SHOW_COMPROBANTES=true`. Las imágenes se cargan desde el CDN:

```json
{
  "image": "comprobante-01.png",
  "name": "Nombre",
  "amount": "$500.000",
  "platform": "Nequi",
  "date": "2026-06-05"
}
```

### `stats.json`

Estadísticas mostradas en la sección de números.

### `testimonials.json`

Testimonios con nombre, ciudad, texto y rating (slider horizontal).

### `bendecidos.json`

Datos de bendecidos (componente disponible, no activo en la vista principal).

---

## CDN

| Recurso | URL |
|---------|-----|
| Logo | `https://cdn-el.elsuertudo.com.co/logos/logo.jpg` |
| Comprobantes | `https://cdn-el.elsuertudo.com.co/comprobantes/{archivo}` |

Helpers en `app/helpers/functions.php`: `cdnLogo()` y `cdnComprobante()`.

---

## Funcionalidades JavaScript

Archivo: `assets/js/main.js`

- Navbar sticky con offset dinámico para anclas
- Scroll suave con offset correcto (`#estadisticas`, `#como-funciona`, etc.)
- Scroll spy — resalta la sección activa en el menú
- Barra de progreso de scroll
- Carrusel horizontal de testimonios con puntos de navegación
- Carrusel de comprobantes (si la sección está activa)
- Animaciones al scroll (sin bloquear contenido)
- Tracking de clics en CTAs de WhatsApp (Meta Pixel / Google Analytics)
- Ajuste de viewport en móvil (barra del navegador)

---

## Identidad visual

| Elemento | Valor |
|----------|-------|
| Color principal | `#014005` (verde oscuro) |
| Color secundario | `#04D912` (verde brillante) |
| Acento lima | `#AAF20F` |
| Acento amarillo | `#F2E205` |
| Acento naranja | `#F29F05` |
| Tema | Claro — blanco + verde + amarillo/naranja |
| Fuente | Montserrat |

---

## Seguridad

- `.env-la` vive fuera del document root (un nivel arriba)
- Directorios `app/`, `storage/` y `routes/` no accesibles directamente
- Archivos `.json`, `.log` y `.md` bloqueados en raíz
- Headers de seguridad: `X-Content-Type-Options`, `X-Frame-Options`, `Referrer-Policy`
- Escape HTML con helper `e()` en todas las salidas

---

## SEO

- Meta tags (title, description, keywords)
- Open Graph y Twitter Cards
- `canonical` URL
- `robots.txt` y `sitemap.xml` incluidos
- Estructura semántica HTML5 con `aria-label`

---

## Despliegue en producción

Checklist rápido:

- [ ] `APP_URL=https://landing.elsuertudo.com.co/` (HTTPS)
- [ ] `WHATSAPP_URL` apuntando al grupo correcto
- [ ] Logo subido en CDN (`cdn-el.elsuertudo.com.co/logos/logo.jpg`)
- [ ] Meta Pixel y Google Analytics configurados (si aplica)
- [ ] JSON actualizado en `storage/data/`
- [ ] SSL activo
- [ ] `mod_rewrite` habilitado
- [ ] Probar en móvil real: scroll, menú, slider de testimonios, CTAs de WhatsApp

---

## Convenciones de contenido (Meta Ads)

**Evitar** en textos públicos: rifa, rifas, sorteo, premio, lotería, ganadores.

**Usar en su lugar:** dinámicas, participaciones, comprobantes, bendecidos, comunidad, experiencias.

---

## Licencia y autoría

**Desarrollado por [Cristian Ceballos](https://rifacloud-landing.cristianceballos.com/)**

© 2026 Cristian Ceballos. Todos los derechos reservados.

Este proyecto es propiedad intelectual de su autor. Queda prohibida su reproducción, distribución o modificación sin autorización expresa.
