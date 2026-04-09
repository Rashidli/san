<header class="header" id="header">
    <!-- Header Top Bar -->
    <div class="header-top">
        <div class="container">
            <div class="header-top-inner">
                <div class="header-top-left">
                    <div class="header-top-contact">
                        @foreach($footer_contact_items->take(2) as $item)
                            <a href="{{ $item->link ?? '#' }}">
                                @if($item->icon)
                                    <i class="{{ $item->icon }}"></i>
                                @endif
                                <span>{{ $item->value }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="header-top-right">
                    <div class="header-social">
                        @foreach($footer_socials as $social)
                            <a href="{{ $social->link }}" target="_blank" title="{{ $social->title }}">
                                @if($social->icon)
                                    <i class="{{ $social->icon }}"></i>
                                @elseif($social->image)
                                    <img src="{{ asset($social->image) }}" alt="{{ $social->title }}">
                                @endif
                            </a>
                        @endforeach
                    </div>
                    <div class="header-divider"></div>
                    <div class="language-switcher">
                        @php
                            $locales = LaravelLocalization::getSupportedLanguagesKeys();
                            $currentLocale = app()->getLocale();
                        @endphp
                        <div class="lang-dropdown">
                            <button class="lang-btn" type="button">
                                <span>{{ strtoupper($currentLocale) }}</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="lang-menu">
                                @foreach($locales as $locale)
                                    @if($locale != $currentLocale)
                                        <a href="{{ LaravelLocalization::localizeURL(url()->current(), $locale) }}">
                                            {{ strtoupper($locale) }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Main -->
    <div class="header-main">
        <div class="container">
            <div class="header-main-inner">
                <!-- Logo -->
                <a href="{{ route('welcome') }}" class="logo">
                    @if($logo)
                        <img src="{{ asset('storage/' . $logo->image) }}" alt="{{ config('app.name') }}">
                    @else
                        <span class="logo-text">{{ config('app.name') }}</span>
                    @endif
                </a>

                <!-- Main Navigation -->
                <nav class="main-nav">
                    <ul class="nav-menu">
                        <li class="nav-item">
                            <a href="{{ route('welcome') }}" class="nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}">
                                {{ $home_page->title ?? word('home', 'Ana Səhifə') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dynamic.page', $about_page->slug ?? 'haqqimizda') }}" class="nav-link {{ request()->is('*' . ($about_page->slug ?? 'haqqimizda')) ? 'active' : '' }}">
                                {{ $about_page->title ?? word('about', 'Haqqımızda') }}
                            </a>
                        </li>
                        <li class="nav-item has-dropdown">
                            <a href="{{ route('dynamic.page', $service_page->slug ?? 'xidmetler') }}" class="nav-link {{ request()->is('*' . ($service_page->slug ?? 'xidmetler') . '*') ? 'active' : '' }}">
                                {{ $service_page->title ?? word('services', 'Xidmətlər') }}
                                <i class="fas fa-chevron-down"></i>
                            </a>
                            @php
                                $headerServices = \App\Models\Service::active()->ordered()->get();
                            @endphp
                            @if($headerServices->count() > 0)
                                <ul class="dropdown-menu">
                                    @foreach($headerServices as $hService)
                                        <li>
                                            <a href="{{ route('dynamic.page', $hService->slug) }}">
                                                @if($hService->icon)
                                                    <i class="{{ $hService->icon }}"></i>
                                                @endif
                                                {{ $hService->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dynamic.page', $portfolio_page->slug ?? 'portfolio') }}" class="nav-link {{ request()->is('*' . ($portfolio_page->slug ?? 'portfolio') . '*') ? 'active' : '' }}">
                                {{ $portfolio_page->title ?? word('portfolio', 'Portfolio') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dynamic.page', $blog_page->slug ?? 'bloq') }}" class="nav-link {{ request()->is('*' . ($blog_page->slug ?? 'bloq') . '*') ? 'active' : '' }}">
                                {{ $blog_page->title ?? word('blog', 'Bloq') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dynamic.page', $contact->slug ?? 'elaqe') }}" class="nav-link {{ request()->is('*' . ($contact->slug ?? 'elaqe')) ? 'active' : '' }}">
                                {{ $contact->title ?? word('contact', 'Əlaqə') }}
                            </a>
                        </li>
                    </ul>
                </nav>

                <!-- Header CTA & Mobile Toggle -->
                <div class="header-actions">
                    @php
                        $phoneItem = $footer_contact_items->first(function($item) {
                            return str_contains($item->link ?? '', 'tel:');
                        });
                        $phoneNumber = $phoneItem ? str_replace('tel:', '', $phoneItem->link) : '';
                    @endphp
                    <a href="tel:{{ $phoneNumber }}" class="header-cta btn btn-primary">
                        <i class="fas fa-phone-alt"></i>
                        <span>{{ word('call_now', 'Zəng et') }}</span>
                    </a>
                    <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Menu -->
<div class="mobile-menu" id="mobileMenu">
    <div class="mobile-menu-header">
        @if($logo)
            <img src="{{ asset('storage/' . $logo->image) }}" alt="{{ config('app.name') }}" class="mobile-logo">
        @else
            <span class="logo-text">{{ config('app.name') }}</span>
        @endif
        <button class="mobile-menu-close" id="closeMobileMenu" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <nav class="mobile-nav">
        <a href="{{ route('welcome') }}" class="mobile-nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}">
            {{ $home_page->title ?? word('home', 'Ana Səhifə') }}
        </a>
        <a href="{{ route('dynamic.page', $about_page->slug ?? 'haqqimizda') }}" class="mobile-nav-link {{ request()->is('*' . ($about_page->slug ?? 'haqqimizda')) ? 'active' : '' }}">
            {{ $about_page->title ?? word('about', 'Haqqımızda') }}
        </a>
        <a href="{{ route('dynamic.page', $service_page->slug ?? 'xidmetler') }}" class="mobile-nav-link {{ request()->is('*' . ($service_page->slug ?? 'xidmetler') . '*') ? 'active' : '' }}">
            {{ $service_page->title ?? word('services', 'Xidmətlər') }}
        </a>
        @if($headerServices->count() > 0)
            <div class="mobile-nav-submenu">
                @foreach($headerServices as $hService)
                    <a href="{{ route('dynamic.page', $hService->slug) }}" class="mobile-nav-link sub-link">
                        {{ $hService->title }}
                    </a>
                @endforeach
            </div>
        @endif
        <a href="{{ route('dynamic.page', $portfolio_page->slug ?? 'portfolio') }}" class="mobile-nav-link {{ request()->is('*' . ($portfolio_page->slug ?? 'portfolio') . '*') ? 'active' : '' }}">
            {{ $portfolio_page->title ?? word('portfolio', 'Portfolio') }}
        </a>
        <a href="{{ route('dynamic.page', $blog_page->slug ?? 'bloq') }}" class="mobile-nav-link {{ request()->is('*' . ($blog_page->slug ?? 'bloq') . '*') ? 'active' : '' }}">
            {{ $blog_page->title ?? word('blog', 'Bloq') }}
        </a>
        <a href="{{ route('dynamic.page', $contact->slug ?? 'elaqe') }}" class="mobile-nav-link {{ request()->is('*' . ($contact->slug ?? 'elaqe')) ? 'active' : '' }}">
            {{ $contact->title ?? word('contact', 'Əlaqə') }}
        </a>
    </nav>
    <div class="mobile-menu-contact">
        @foreach($footer_contact_items as $item)
            <a href="{{ $item->link ?? '#' }}">
                @if($item->icon)
                    <i class="{{ $item->icon }}"></i>
                @endif
                {{ $item->value }}
            </a>
        @endforeach
    </div>
    <a href="tel:{{ $phoneNumber }}" class="mobile-menu-btn-call">
        <i class="fas fa-phone-alt"></i>
        {{ word('call_now', 'Zəng et') }}
    </a>
</div>
<div class="mobile-menu-overlay" id="mobileOverlay"></div>
