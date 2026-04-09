<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-top-inner">
                <div class="header-contact">
                    @foreach($footer_contact_items as $item)
                        <a href="{{ $item->link ?? '#' }}" class="header-contact-item">
                            @if($item->icon)
                                <i class="{{ $item->icon }}"></i>
                            @endif
                            <span>{{ $item->value }}</span>
                        </a>
                    @endforeach
                </div>
                <div class="header-right">
                    <div class="social-links">
                        @foreach($footer_socials as $social)
                            <a href="{{ $social->link }}" target="_blank" class="social-link">
                                @if($social->icon)
                                    <i class="{{ $social->icon }}"></i>
                                @elseif($social->image)
                                    <img src="{{ asset($social->image) }}" alt="{{ $social->title }}">
                                @endif
                            </a>
                        @endforeach
                    </div>
                    <div class="language-switcher">
                        @php
                            $locales = LaravelLocalization::getSupportedLanguagesKeys();
                            $currentLocale = app()->getLocale();
                        @endphp
                        <div class="lang-dropdown">
                            <button class="lang-btn">
                                {{ strtoupper($currentLocale) }}
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

    <div class="header-main">
        <div class="container">
            <div class="header-main-inner">
                <a href="{{ route('welcome') }}" class="logo">
                    @if($logo)
                        <img src="{{ asset('storage/' . $logo->image) }}" alt="Logo">
                    @else
                        <span class="logo-text">{{ config('app.name') }}</span>
                    @endif
                </a>

                <nav class="main-nav">
                    <a href="{{ route('welcome') }}" class="{{ request()->routeIs('welcome') ? 'active' : '' }}">
                        {{ $home_page->title ?? word('home', 'Ana Səhifə') }}
                    </a>
                    <a href="{{ route('dynamic.page', $about_page->slug ?? 'haqqimizda') }}" class="{{ request()->is('*' . ($about_page->slug ?? 'haqqimizda')) ? 'active' : '' }}">
                        {{ $about_page->title ?? word('about', 'Haqqımızda') }}
                    </a>
                    <div class="nav-dropdown">
                        <a href="{{ route('dynamic.page', $service_page->slug ?? 'xidmetler') }}" class="{{ request()->is('*' . ($service_page->slug ?? 'xidmetler') . '*') ? 'active' : '' }}">
                            {{ $service_page->title ?? word('services', 'Xidmətlər') }}
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        @php
                            $headerServices = \App\Models\Service::active()->ordered()->get();
                        @endphp
                        @if($headerServices->count() > 0)
                            <div class="dropdown-menu">
                                @foreach($headerServices as $hService)
                                    <a href="{{ route('dynamic.page', $hService->slug) }}">{{ $hService->title }}</a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <a href="{{ route('dynamic.page', $portfolio_page->slug ?? 'portfolio') }}" class="{{ request()->is('*' . ($portfolio_page->slug ?? 'portfolio') . '*') ? 'active' : '' }}">
                        {{ $portfolio_page->title ?? word('portfolio', 'Portfolio') }}
                    </a>
                    <a href="{{ route('dynamic.page', $blog_page->slug ?? 'bloq') }}" class="{{ request()->is('*' . ($blog_page->slug ?? 'bloq') . '*') ? 'active' : '' }}">
                        {{ $blog_page->title ?? word('blog', 'Bloq') }}
                    </a>
                    <a href="{{ route('dynamic.page', $contact->slug ?? 'elaqe') }}" class="{{ request()->is('*' . ($contact->slug ?? 'elaqe')) ? 'active' : '' }}">
                        {{ $contact->title ?? word('contact', 'Əlaqə') }}
                    </a>
                </nav>

                <div class="header-actions">
                    <a href="tel:{{ $global_whatsapp ?? '' }}" class="btn btn-primary">
                        <i class="fas fa-phone"></i>
                        {{ word('call_now', 'Zəng et') }}
                    </a>
                    <button class="mobile-menu-btn" id="mobileMenuBtn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-header">
            @if($logo)
                <img src="{{ asset('storage/' . $logo->image) }}" alt="Logo">
            @endif
            <button class="close-btn" id="closeMobileMenu">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <nav class="mobile-nav">
            <a href="{{ route('welcome') }}">{{ $home_page->title ?? word('home', 'Ana Səhifə') }}</a>
            <a href="{{ route('dynamic.page', $about_page->slug ?? 'haqqimizda') }}">{{ $about_page->title ?? word('about', 'Haqqımızda') }}</a>
            <a href="{{ route('dynamic.page', $service_page->slug ?? 'xidmetler') }}">{{ $service_page->title ?? word('services', 'Xidmətlər') }}</a>
            <a href="{{ route('dynamic.page', $portfolio_page->slug ?? 'portfolio') }}">{{ $portfolio_page->title ?? word('portfolio', 'Portfolio') }}</a>
            <a href="{{ route('dynamic.page', $blog_page->slug ?? 'bloq') }}">{{ $blog_page->title ?? word('blog', 'Bloq') }}</a>
            <a href="{{ route('dynamic.page', $contact->slug ?? 'elaqe') }}">{{ $contact->title ?? word('contact', 'Əlaqə') }}</a>
        </nav>
        <div class="mobile-contact">
            @foreach($footer_contact_items as $item)
                <a href="{{ $item->link ?? '#' }}">
                    @if($item->icon)
                        <i class="{{ $item->icon }}"></i>
                    @endif
                    {{ $item->value }}
                </a>
            @endforeach
        </div>
    </div>
    <div class="mobile-overlay" id="mobileOverlay"></div>
</header>
