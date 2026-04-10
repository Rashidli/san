<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">

    {{-- Home Page --}}
    @foreach($locales as $locale)
    <url>
        <loc>{{ LaravelLocalization::localizeURL(route('welcome'), $locale) }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
        @foreach($locales as $altLocale)
        <xhtml:link rel="alternate" hreflang="{{ $altLocale }}" href="{{ LaravelLocalization::localizeURL(route('welcome'), $altLocale) }}"/>
        @endforeach
    </url>
    @endforeach

    {{-- About Page --}}
    @if($aboutPage)
    @foreach($locales as $locale)
    <url>
        <loc>{{ LaravelLocalization::localizeURL(route('dynamic.page', $aboutPage->translate($locale)->slug ?? $aboutPage->slug), $locale) }}</loc>
        <lastmod>{{ $aboutPage->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
        @foreach($locales as $altLocale)
        <xhtml:link rel="alternate" hreflang="{{ $altLocale }}" href="{{ LaravelLocalization::localizeURL(route('dynamic.page', $aboutPage->translate($altLocale)->slug ?? $aboutPage->slug), $altLocale) }}"/>
        @endforeach
    </url>
    @endforeach
    @endif

    {{-- Services Page --}}
    @if($servicePage)
    @foreach($locales as $locale)
    <url>
        <loc>{{ LaravelLocalization::localizeURL(route('dynamic.page', $servicePage->translate($locale)->slug ?? $servicePage->slug), $locale) }}</loc>
        <lastmod>{{ $servicePage->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
        @foreach($locales as $altLocale)
        <xhtml:link rel="alternate" hreflang="{{ $altLocale }}" href="{{ LaravelLocalization::localizeURL(route('dynamic.page', $servicePage->translate($altLocale)->slug ?? $servicePage->slug), $altLocale) }}"/>
        @endforeach
    </url>
    @endforeach
    @endif

    {{-- Individual Services --}}
    @foreach($services as $service)
    @foreach($locales as $locale)
    <url>
        <loc>{{ LaravelLocalization::localizeURL(route('dynamic.page', $service->translate($locale)->slug ?? $service->slug), $locale) }}</loc>
        <lastmod>{{ $service->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
        @foreach($locales as $altLocale)
        <xhtml:link rel="alternate" hreflang="{{ $altLocale }}" href="{{ LaravelLocalization::localizeURL(route('dynamic.page', $service->translate($altLocale)->slug ?? $service->slug), $altLocale) }}"/>
        @endforeach
    </url>
    @endforeach
    @endforeach

    {{-- Portfolio Page --}}
    @if($portfolioPage)
    @foreach($locales as $locale)
    <url>
        <loc>{{ LaravelLocalization::localizeURL(route('dynamic.page', $portfolioPage->translate($locale)->slug ?? $portfolioPage->slug), $locale) }}</loc>
        <lastmod>{{ $portfolioPage->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
        @foreach($locales as $altLocale)
        <xhtml:link rel="alternate" hreflang="{{ $altLocale }}" href="{{ LaravelLocalization::localizeURL(route('dynamic.page', $portfolioPage->translate($altLocale)->slug ?? $portfolioPage->slug), $altLocale) }}"/>
        @endforeach
    </url>
    @endforeach
    @endif

    {{-- Individual Portfolios --}}
    @foreach($portfolios as $portfolio)
    @foreach($locales as $locale)
    <url>
        <loc>{{ LaravelLocalization::localizeURL(route('dynamic.page', $portfolio->translate($locale)->slug ?? $portfolio->slug), $locale) }}</loc>
        <lastmod>{{ $portfolio->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
        @foreach($locales as $altLocale)
        <xhtml:link rel="alternate" hreflang="{{ $altLocale }}" href="{{ LaravelLocalization::localizeURL(route('dynamic.page', $portfolio->translate($altLocale)->slug ?? $portfolio->slug), $altLocale) }}"/>
        @endforeach
    </url>
    @endforeach
    @endforeach

    {{-- Blog Page --}}
    @if($blogPage)
    @foreach($locales as $locale)
    <url>
        <loc>{{ LaravelLocalization::localizeURL(route('dynamic.page', $blogPage->translate($locale)->slug ?? $blogPage->slug), $locale) }}</loc>
        <lastmod>{{ $blogPage->updated_at->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
        @foreach($locales as $altLocale)
        <xhtml:link rel="alternate" hreflang="{{ $altLocale }}" href="{{ LaravelLocalization::localizeURL(route('dynamic.page', $blogPage->translate($altLocale)->slug ?? $blogPage->slug), $altLocale) }}"/>
        @endforeach
    </url>
    @endforeach
    @endif

    {{-- Individual Blogs --}}
    @foreach($blogs as $blog)
    @foreach($locales as $locale)
    <url>
        <loc>{{ LaravelLocalization::localizeURL(route('dynamic.page', $blog->translate($locale)->slug ?? $blog->slug), $locale) }}</loc>
        <lastmod>{{ $blog->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
        @foreach($locales as $altLocale)
        <xhtml:link rel="alternate" hreflang="{{ $altLocale }}" href="{{ LaravelLocalization::localizeURL(route('dynamic.page', $blog->translate($altLocale)->slug ?? $blog->slug), $altLocale) }}"/>
        @endforeach
    </url>
    @endforeach
    @endforeach

    {{-- Contact Page --}}
    @if($contactPage)
    @foreach($locales as $locale)
    <url>
        <loc>{{ LaravelLocalization::localizeURL(route('dynamic.page', $contactPage->translate($locale)->slug ?? $contactPage->slug), $locale) }}</loc>
        <lastmod>{{ $contactPage->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
        @foreach($locales as $altLocale)
        <xhtml:link rel="alternate" hreflang="{{ $altLocale }}" href="{{ LaravelLocalization::localizeURL(route('dynamic.page', $contactPage->translate($altLocale)->slug ?? $contactPage->slug), $altLocale) }}"/>
        @endforeach
    </url>
    @endforeach
    @endif

</urlset>
