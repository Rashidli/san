# Santexnik Ustası - Style Guide

## Rəng Paleti

```css
--primary: #FF6B00;        /* Narıncı - əsas rəng */
--primary-dark: #E55A00;   /* Tünd narıncı - hover */
--primary-light: #FF8533;  /* Açıq narıncı */
--secondary: #1E1E1E;      /* Qara - ikinci rəng */
--secondary-light: #2D2D2D;/* Tünd boz */
```

## Tipografiya

- **Başlıqlar:** Poppins (600, 700)
- **Mətn:** Inter (400, 500, 600)
- **Font ölçüləri:**
  - H1: 48px (hero), 36px (səhifə)
  - H2: 32-36px
  - H3: 20-24px
  - Body: 15-16px
  - Small: 13-14px

## Border Radius

```css
--radius-sm: 6px;
--radius-md: 8px;
--radius-lg: 12px;
--radius-xl: 16px;
--radius-2xl: 20px;
--radius-full: 50%;
```

## Kölgələr

```css
--shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
--shadow-md: 0 4px 6px rgba(0,0,0,0.07);
--shadow-lg: 0 10px 25px rgba(0,0,0,0.1);
--shadow-xl: 0 20px 40px rgba(0,0,0,0.15);
```

## Breakpoints

| Ad | Ölçü | İstifadə |
|-----|------|----------|
| xl | 1400px | Böyük desktop |
| lg | 1200px | Desktop |
| md | 992px | Tablet landscape |
| sm | 768px | Tablet portrait |
| xs | 576px | Mobil landscape |
| xxs | 480px | Mobil portrait |

## Komponent Strukturu

### Buttons
```html
<a href="#" class="btn btn-primary">Primary</a>
<a href="#" class="btn btn-outline">Outline</a>
<a href="#" class="btn btn-white">White</a>
<a href="#" class="btn btn-outline-white">Outline White</a>
```

### Cards
```html
<!-- Service Card -->
<div class="service-card">
    <div class="service-image">
        <img src="..." alt="">
        <div class="service-icon"><i class="fas fa-..."></i></div>
    </div>
    <div class="service-content">
        <h3><a href="#">Title</a></h3>
        <p>Description</p>
        <a href="#" class="service-link">Ətraflı <i class="fas fa-arrow-right"></i></a>
    </div>
</div>

<!-- Blog Card -->
<div class="blog-card">
    <div class="blog-image"><a href="#"><img src="..." alt=""></a></div>
    <div class="blog-content">
        <div class="blog-meta"><span><i class="far fa-calendar"></i> 01.01.2024</span></div>
        <h3><a href="#">Title</a></h3>
        <p>Excerpt</p>
        <a href="#" class="blog-link">Ətraflı <i class="fas fa-arrow-right"></i></a>
    </div>
</div>

<!-- Portfolio Card -->
<a href="#" class="portfolio-card">
    <img src="..." alt="">
    <div class="portfolio-overlay">
        <div class="portfolio-overlay-content">
            <h3>Title</h3>
            <span>Category</span>
        </div>
    </div>
</a>
```

### Single Page Layout
```html
<div class="single-layout">
    <div class="single-main">
        <div class="single-featured-image">
            <img src="..." alt="">
            <div class="single-icon"><i class="fas fa-..."></i></div>
        </div>
        <div class="single-content-box">
            <h2>Title</h2>
            <div class="single-text">{!! $content !!}</div>
        </div>
    </div>
    <div class="single-sidebar">
        <div class="sidebar-card sidebar-cta">...</div>
        <div class="sidebar-card">...</div>
    </div>
</div>
```

### Sidebar Components
```html
<!-- CTA Card -->
<div class="sidebar-card sidebar-cta">
    <div class="sidebar-cta-icon"><i class="fas fa-headset"></i></div>
    <h4>Kömək lazımdır?</h4>
    <p>24/7 zəng edə bilərsiniz</p>
    <a href="tel:..." class="sidebar-phone"><i class="fas fa-phone-alt"></i> +994 XX XXX XX XX</a>
    <a href="#" class="btn btn-primary btn-block">Əlaqə</a>
</div>

<!-- Search -->
<div class="sidebar-card">
    <h4 class="sidebar-title">Axtar</h4>
    <form class="sidebar-search">
        <input type="text" name="q" placeholder="Açar söz..." class="form-control">
        <button type="submit"><i class="fas fa-search"></i></button>
    </form>
</div>

<!-- Services List -->
<div class="sidebar-card">
    <h4 class="sidebar-title">Xidmətlərimiz</h4>
    <ul class="sidebar-services">
        <li><a href="#"><i class="fas fa-chevron-right"></i> Service Name</a></li>
    </ul>
</div>

<!-- Recent Posts -->
<div class="sidebar-card">
    <h4 class="sidebar-title">Son yazılar</h4>
    <div class="sidebar-posts">
        <a href="#" class="sidebar-post">
            <div class="sidebar-post-image"><img src="..." alt=""></div>
            <div class="sidebar-post-content">
                <h5>Post Title</h5>
                <span><i class="far fa-calendar-alt"></i> 01.01.2024</span>
            </div>
        </a>
    </div>
</div>

<!-- Tags -->
<div class="sidebar-card">
    <h4 class="sidebar-title">Etiketlər</h4>
    <div class="sidebar-tags">
        <a href="#" class="sidebar-tag">Tag Name</a>
    </div>
</div>
```

### Portfolio Single
```html
<div class="portfolio-single">
    <div class="portfolio-gallery">
        <div class="portfolio-main-image"><img src="..." alt=""></div>
        <div class="portfolio-thumbnails">
            <div class="portfolio-thumb"><img src="..." alt=""></div>
        </div>
    </div>
    <div class="portfolio-info-box">
        <div class="portfolio-info-header">
            <span class="portfolio-category"><i class="fas fa-folder"></i> Category</span>
            <h2>Title</h2>
        </div>
        <div class="portfolio-details">
            <div class="portfolio-detail-item">
                <span class="detail-label">Xidmət</span>
                <span class="detail-value">Value</span>
            </div>
        </div>
        <div class="portfolio-description">
            <h3>Layihə haqqında</h3>
            <div class="single-text">{!! $description !!}</div>
        </div>
        <div class="portfolio-actions">
            <a href="#" class="btn btn-primary">Sifariş et</a>
            <a href="#" class="btn btn-outline">Xidmətə bax</a>
        </div>
    </div>
</div>
```

### Blog Single Meta & Share
```html
<div class="blog-single-meta">
    <span class="meta-item"><i class="far fa-calendar-alt"></i> 01.01.2024</span>
    <span class="meta-item"><i class="far fa-eye"></i> 100 baxış</span>
    <span class="meta-item"><i class="far fa-folder"></i> Category</span>
</div>

<div class="blog-tags">
    <span class="tags-label"><i class="fas fa-tags"></i> Etiketlər:</span>
    <div class="tags-list">
        <a href="#" class="tag-item">Tag</a>
    </div>
</div>

<div class="blog-share">
    <span class="share-label">Paylaş:</span>
    <div class="share-buttons">
        <a href="#" class="share-btn share-facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="share-btn share-twitter"><i class="fab fa-twitter"></i></a>
        <a href="#" class="share-btn share-whatsapp"><i class="fab fa-whatsapp"></i></a>
        <a href="#" class="share-btn share-linkedin"><i class="fab fa-linkedin-in"></i></a>
    </div>
</div>
```

## Section Struktur

```html
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="subtitle">Alt başlıq</span>
            <h2>Əsas başlıq</h2>
            <p>Açıqlama mətni</p>
        </div>
        <!-- Content -->
    </div>
</section>

<!-- Alternativ fon -->
<section class="section section-light">...</section>
```

## Grid Sistemləri

```css
/* Services */
.services-grid { grid-template-columns: repeat(3, 1fr); }

/* Portfolio */
.portfolio-grid { grid-template-columns: repeat(3, 1fr); }
.portfolio-grid-4 { grid-template-columns: repeat(4, 1fr); }

/* Blog */
.blog-grid { grid-template-columns: repeat(3, 1fr); }

/* Why Us */
.why-us-grid { grid-template-columns: repeat(4, 1fr); }

/* Contact */
.contact-grid { grid-template-columns: 1fr 1fr; }

/* Footer */
.footer-grid { grid-template-columns: 1.5fr 1fr 1fr 1.2fr; }
```

## Animasiyalar

```css
--transition-fast: 0.2s ease;
--transition-normal: 0.3s ease;
--transition-slow: 0.4s ease;
```

### Hover Effektləri
- Cards: `translateY(-5px)` + shadow artır
- Links: `color: var(--primary)`
- Buttons: `background darken` + `translateY(-2px)`
- Images: `scale(1.05)`

## İkon Kitabxanası

Font Awesome 6 istifadə olunur:
- Solid: `fas fa-*`
- Regular: `far fa-*`
- Brands: `fab fa-*`

### Çox istifadə olunan ikonlar:
```
fa-phone, fa-phone-alt, fa-envelope, fa-map-marker-alt,
fa-clock, fa-calendar-alt, fa-eye, fa-tags, fa-folder,
fa-arrow-right, fa-chevron-right, fa-check, fa-star,
fa-tools, fa-wrench, fa-cog, fa-headset
```

## Fayl Strukturu

```
public/front/
├── css/
│   ├── style.css      # Əsas stillər
│   └── responsive.css # Responsive stillər
├── js/
│   └── main.js        # JavaScript
└── images/
    ├── logo.png
    └── favicon.png

resources/views/front/
├── layouts/
│   └── master.blade.php
├── partials/
│   ├── head.blade.php
│   ├── header.blade.php
│   └── footer.blade.php
├── welcome.blade.php
├── service_single.blade.php
├── blog_single.blade.php
├── portfolio_single.blade.php
└── contact.blade.php
```

---

Son yenilənmə: 2026-04-10
