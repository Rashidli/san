@php
    $locales = ['az', 'en', 'ru'];
    $currentLocale = app()->getLocale();
    $hreflangs = [];

    // Check what type of page we're on and generate appropriate URLs
    if (isset($service)) {
        // Service single page
        foreach ($locales as $locale) {
            $translatedSlug = $service->translate($locale)->slug ?? $service->slug;
            $hreflangs[$locale] = LaravelLocalization::localizeURL(route('dynamic.page', $translatedSlug), $locale);
        }
    } elseif (isset($blog)) {
        // Blog single page
        foreach ($locales as $locale) {
            $translatedSlug = $blog->translate($locale)->slug ?? $blog->slug;
            $hreflangs[$locale] = LaravelLocalization::localizeURL(route('dynamic.page', $translatedSlug), $locale);
        }
    } elseif (isset($portfolio)) {
        // Portfolio single page
        foreach ($locales as $locale) {
            $translatedSlug = $portfolio->translate($locale)->slug ?? $portfolio->slug;
            $hreflangs[$locale] = LaravelLocalization::localizeURL(route('dynamic.page', $translatedSlug), $locale);
        }
    } elseif (isset($single)) {
        // SEO pages (about, contact, services list, etc.)
        foreach ($locales as $locale) {
            $translatedSlug = $single->translate($locale)->slug ?? $single->slug;
            $hreflangs[$locale] = LaravelLocalization::localizeURL(route('dynamic.page', $translatedSlug), $locale);
        }
    } elseif (isset($seo) && $seo && $seo->type === 'home') {
        // Home page
        foreach ($locales as $locale) {
            $hreflangs[$locale] = LaravelLocalization::localizeURL(route('welcome'), $locale);
        }
    } else {
        // Fallback - use current URL with locale
        foreach ($locales as $locale) {
            $hreflangs[$locale] = LaravelLocalization::localizeURL(url()->current(), $locale);
        }
    }
@endphp

{{-- Hreflang tags --}}
@foreach ($hreflangs as $locale => $url)
<link rel="alternate" hreflang="{{ $locale }}" href="{{ $url }}" />
@endforeach
<link rel="alternate" hreflang="x-default" href="{{ $hreflangs['az'] }}" />
