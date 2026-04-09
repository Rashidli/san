# San Proyekti - Elektrik/Santexnik Xidmətləri Saytı

## Ümumi Məlumat

- **Proyekt adı:** San (Santexnik Ustası)
- **Lokasiya:** `C:\laragon\www\san`
- **URL:** `http://san.test`
- **Framework:** Laravel 10
- **PHP versiyası:** 8.1+
- **Database:** MySQL (`san`)

---

## Admin Panel Giriş Məlumatları

- **URL:** `http://san.test/admin`
- **Email:** `admin@admin.com`
- **Parol:** `password`

---

## Quraşdırılmış Paketlər

```json
{
    "spatie/laravel-permission": "Rol və icazə sistemi",
    "mcamara/laravel-localization": "URL lokalizasiyası (az, en, ru)",
    "astrotomic/laravel-translatable": "Çoxdilli content idarəsi",
    "intervention/image": "Şəkil emalı və WebP çevirmə"
}
```

---

## Dil Dəstəyi

| Dil | Kod | Default |
|-----|-----|---------|
| Azərbaycan | az | Bəli |
| English | en | Xeyr |
| Русский | ru | Xeyr |

**Konfiqurasiya faylları:**
- `config/laravellocalization.php`
- `config/translatable.php`
- `config/app.php` (locale: az, timezone: Asia/Baku)

---

## Database Strukturu

### Cədvəllər (Migrations)

| # | Migration | Təsvir |
|---|-----------|--------|
| 1 | users | İstifadəçilər |
| 2 | socials | Sosial şəbəkə linkləri |
| 3 | settings | Sayt ayarları (key-value) |
| 4 | words + word_translations | Statik sözlər/tərcümələr |
| 5 | singles + single_translations | SEO səhifələri |
| 6 | images | Logo, favicon və s. |
| 7 | contact_items + translations | Əlaqə məlumatları |
| 8 | sliders + slider_translations | Ana səhifə slider |
| 9 | services + service_translations | Xidmətlər |
| 10 | tags + tag_translations | Bloq etiketləri |
| 11 | blogs + blog_translations + blog_tag | Bloq yazıları |
| 12 | portfolios + portfolio_translations + portfolio_images | Portfolio işləri |
| 13 | faqs + faq_translations | Tez-tez verilən suallar |
| 14 | reviews + review_translations | Müştəri rəyləri |
| 15 | abouts + about_translations | Haqqımızda bölmələri |
| 16 | contacts | Əlaqə formu mesajları |
| 17 | why_us + why_us_translations | Niyə bizi seçməlisiniz |
| 18 | permission_tables | Spatie rol/icazə cədvəlləri |

---

## Models

### Əsas Modellər

| Model | Translatable | Əlaqələr |
|-------|--------------|----------|
| User | Xeyr | HasRoles |
| Social | Xeyr | - |
| Setting | Xeyr | - |
| Word | Bəli | WordTranslation |
| Single | Bəli | SingleTranslation |
| Image | Xeyr | - |
| ContactItem | Bəli | ContactItemTranslation |
| Slider | Bəli | SliderTranslation |
| Service | Bəli | ServiceTranslation |
| Tag | Bəli | TagTranslation, Blogs |
| Blog | Bəli | BlogTranslation, Tags, Service |
| Portfolio | Bəli | PortfolioTranslation, Service, Images |
| PortfolioImage | Xeyr | Portfolio |
| Faq | Bəli | FaqTranslation |
| Review | Bəli | ReviewTranslation |
| About | Bəli | AboutTranslation |
| Contact | Xeyr | Service |
| WhyUs | Bəli | WhyUsTranslation |

---

## Controllers

### Admin Controllers (`app/Http/Controllers/Admin/`)

| Controller | Route Prefix | Funksiyalar |
|------------|--------------|-------------|
| PageController | - | login, authenticate, logout, home |
| AuthController | - | login, logout |
| UserController | users | CRUD |
| RoleController | roles | CRUD |
| PermissionController | permissions | CRUD |
| ServiceController | services | CRUD |
| BlogController | blogs | CRUD |
| TagController | tags | CRUD |
| PortfolioController | portfolios | CRUD |
| ReviewController | reviews | CRUD |
| WhyUsController | why_us | CRUD |
| SliderController | sliders | CRUD |
| FaqController | faqs | CRUD |
| AboutController | abouts | CRUD |
| ContactController | contacts | index, show, destroy |
| ContactItemController | contact_items | CRUD |
| SocialController | socials | CRUD |
| ImageController | images | CRUD |
| SingleController | singles | CRUD |
| WordController | words | CRUD |
| SettingController | settings | index, update |

### Front Controllers (`app/Http/Controllers/Front/`)

| Controller | Funksiyalar |
|------------|-------------|
| HomeController | welcome, dynamicPage, contact_post, success |

---

## Routes

### Admin Routes (`routes/web.php`)

```php
Route::prefix('admin')->group(function () {
    // Auth
    Route::get('/', [PageController::class, 'login'])->name('login');
    Route::post('/authenticate', [AuthController::class, 'authenticate']);
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected routes
    Route::middleware('auth')->group(function () {
        Route::get('/home', [PageController::class, 'home'])->name('home');

        // Resource routes
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::resource('services', ServiceController::class);
        Route::resource('portfolios', PortfolioController::class);
        Route::resource('blogs', BlogController::class);
        Route::resource('tags', TagController::class);
        Route::resource('sliders', SliderController::class);
        Route::resource('faqs', FaqController::class);
        Route::resource('reviews', ReviewController::class);
        Route::resource('why_us', WhyUsController::class);
        Route::resource('abouts', AboutController::class);
        Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);
        Route::resource('contact_items', ContactItemController::class);
        Route::resource('socials', SocialController::class);
        Route::resource('images', ImageController::class);
        Route::resource('singles', SingleController::class);
        Route::resource('words', WordController::class);
        Route::resource('settings', SettingController::class)->only(['index', 'update']);
    });
});
```

### Front Routes

```php
Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
    Route::post('/contact', [HomeController::class, 'contact_post'])->name('contact.post');
    Route::get('/success', [HomeController::class, 'success'])->name('success');
    Route::get('/{slug}', [HomeController::class, 'dynamicPage'])->name('dynamic.page');
});
```

---

## Front-end Səhifələr

### Views (`resources/views/front/`)

| Fayl | Təsvir |
|------|--------|
| layouts/master.blade.php | Əsas layout |
| partials/head.blade.php | CSS, meta tags |
| partials/header.blade.php | Header, nav, mobile menu |
| partials/footer.blade.php | Footer, JS |
| welcome.blade.php | Ana səhifə |
| about.blade.php | Haqqımızda |
| services.blade.php | Xidmətlər siyahısı |
| service_single.blade.php | Tək xidmət |
| portfolios.blade.php | Portfolio siyahısı |
| portfolio_single.blade.php | Tək portfolio |
| blogs.blade.php | Bloq siyahısı |
| blog_single.blade.php | Tək bloq yazısı |
| contact.blade.php | Əlaqə formu |
| success.blade.php | Form göndərildikdən sonra |

---

## CSS/JS Faylları

### CSS (`public/front/css/`)

| Fayl | Təsvir |
|------|--------|
| style.css | Əsas stillər (variables, reset, components, sections) |
| responsive.css | Media queries (1200px, 992px, 768px, 480px) |

### JS (`public/front/js/`)

| Fayl | Təsvir |
|------|--------|
| main.js | Mobile menu, language dropdown, sliders, FAQ accordion |

### Rəng Sxemi (CSS Variables)

```css
:root {
    --primary-color: #0056b3;
    --primary-dark: #003d82;
    --primary-light: #4d8fd6;
    --secondary-color: #ff6b00;
    --text-color: #333333;
    --text-light: #666666;
    --bg-color: #ffffff;
    --bg-light: #f8f9fa;
    --bg-dark: #1a1a2e;
}
```

---

## Helper Functions

### `app/Helpers/helpers.php`

```php
// Statik söz əldə etmək
function word(string $key, ?string $default = null): string

// Setting əldə etmək
function setting(string $key, $default = null)
```

**Composer autoload:**
```json
"autoload": {
    "files": [
        "app/Helpers/helpers.php"
    ]
}
```

---

## Services

### ImageUploadService (`app/Services/ImageUploadService.php`)

- Şəkil yükləmə
- WebP formatına çevirmə
- Avtomatik ölçüləndirmə

---

## Seeder Data

### DatabaseSeeder

**Rollar:**
- super-admin
- admin
- editor

**İcazələr (44 ədəd):**
- list/create/edit/delete: users, roles, permissions, services, blogs, portfolios, tags, sliders, faqs, reviews, abouts, contacts, contact_items, socials, singles, words, images, settings

**Default İstifadəçi:**
- Ad: Super Admin
- Email: admin@admin.com
- Parol: password
- Rol: super-admin

**SEO Səhifələri (Singles):**
- home (Ana Səhifə)
- about (Haqqımızda)
- services (Xidmətlər)
- portfolio (Portfolio)
- blogs (Bloq)
- contact (Əlaqə)

---

## Əmrlər

### İlk quraşdırma:
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
```

### Cache təmizləmə:
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Development server:
```bash
php artisan serve
```

---

## Qovluq Strukturu

```
san/
├── app/
│   ├── Helpers/
│   │   └── helpers.php
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Admin/
│   │       │   ├── PageController.php
│   │       │   ├── AuthController.php
│   │       │   ├── ServiceController.php
│   │       │   ├── PortfolioController.php
│   │       │   ├── ReviewController.php
│   │       │   ├── WhyUsController.php
│   │       │   └── ...
│   │       └── Front/
│   │           └── HomeController.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Service.php
│   │   ├── Portfolio.php
│   │   ├── Blog.php
│   │   └── ...
│   ├── Providers/
│   │   ├── AppServiceProvider.php (view composer)
│   │   └── AuthServiceProvider.php (super-admin bypass)
│   └── Services/
│       └── ImageUploadService.php
├── config/
│   ├── laravellocalization.php
│   └── translatable.php
├── database/
│   ├── migrations/
│   └── seeders/
│       └── DatabaseSeeder.php
├── public/
│   ├── assets/ (admin panel assets)
│   └── front/
│       ├── css/
│       │   ├── style.css
│       │   └── responsive.css
│       ├── js/
│       │   └── main.js
│       └── img/
├── resources/
│   └── views/
│       ├── admin/
│       │   ├── includes/
│       │   ├── portfolios/
│       │   ├── reviews/
│       │   ├── why_us/
│       │   └── ...
│       └── front/
│           ├── layouts/
│           ├── partials/
│           └── *.blade.php
└── routes/
    └── web.php
```

---

## Əlavə Qeydlər

1. **Super Admin:** `super-admin` rolu bütün icazələri bypass edir (AuthServiceProvider-da Gate::before)

2. **Şəkil yükləmə:** Bütün şəkillər `storage/app/public/uploads/` qovluğuna yüklənir və WebP formatına çevrilir

3. **Dil dəyişdirmə:** URL-də dil prefiksi ilə (`/en/about`, `/ru/o-nas`) və ya default dil üçün prefikssiz (`/haqqimizda`)

4. **Dynamic Routing:** `/{slug}` route-u avtomatik olaraq service, blog, portfolio və ya single səhifəni tapır

5. **View Composer:** `AppServiceProvider`-da front.* view-larına global dəyişənlər (logo, menu items, socials, contact items, translations) ötürülür

---

## Dəyişikliklər Jurnalı

### 2026-04-09 (Session 2)

#### Bug Fixes
| Problem | Həll |
|---------|------|
| `Route [contact.post] not defined` | `contact.blade.php` - `contact.post` → `contact_post` |
| `Route [projects.index] not defined` | Admin dashboard yeniləndi - projects/products silindi, portfolios əlavə edildi |
| `Target class [permission] does not exist` | `Kernel.php` - Spatie Permission middleware-ləri əlavə edildi |
| `Target class [Spatie\Permission\Middlewares\...]` | Spatie v6-da namespace dəyişib: `Middlewares` → `Middleware` |
| `Class "App\Models\ServiceCategory" not found` | ServiceCategory tamamilə silindi (brief-ə görə lazım deyil) |
| `Field 'slug' doesn't have a default value (tags)` | `TagController` - slug avtomatik title-dan yaradılır |
| `Field 'key' doesn't have a default value (abouts)` | `AboutController` - `key => 'main'` avtomatik əlavə edilir |
| `Class "App\Models\Category" not found (blogs)` | Blog-da Category əvəzinə Service istifadə olunur |
| Şəkillər görünmür | `php artisan storage:link` əmri icra edildi |
| Portfolio əlavə şəkillər yüklənmir | `PortfolioController` - images[] array emalı əlavə edildi |
| Mesajlar bölməsində xidmət JSON görünür | `contacts/index.blade.php` - `$contact->service?->title` |

#### Silinən Funksionallıqlar
- **ServiceCategory** - Model, Controller, Views tamamilə silindi
- **Sıra (order) sahəsi** - Portfolios, Reviews, WhyUs, Sliders view-larından silindi
- **Blog Category** - Service ilə əvəz edildi

#### Yeni Funksionallıqlar

**Validation Sistemi:**
- `lang/az/validation.php` - Azərbaycan dilində validation mesajları
- `admin/includes/validation_errors.blade.php` - Alert komponenti
- Toast notification (yuxarı sağ künc, 8 saniyə)
- Atribut adları AZ dilində: "Başlıq (AZ) sahəsi mütləqdir"

**Admin Mesajları AZ dilində:**
```
Tag added successfully → Tag uğurla əlavə edildi
Blog updated successfully → Bloq uğurla yeniləndi
İstifadəçi update edildi → İstifadəçi uğurla yeniləndi
```

**ContactItem yeni struktur:**
- `image`, `footer_icon` → `icon` (FontAwesome class)
- Yeni `link` sahəsi (tel:, mailto:)
- Yeni modern UI dizaynı

#### Middleware Konfiqurasiyası (`app/Http/Kernel.php`)
```php
'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
```

#### Blog-Service Əlaqəsi
- Blog artıq Category əvəzinə Service-ə bağlıdır
- Brief: "Hər bir Bloqun daxilində aid olduğu xidməti və tag-lər"

---

## Tarix

- **Yaradılma tarixi:** 2026-04-09
- **Son yenilənmə:** 2026-04-09
- **Laravel versiyası:** 10.x
- **Hazırlayan:** Claude Code (166 Tech)
