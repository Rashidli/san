<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">

    {{-- Basic SEO --}}
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">

    {{-- Canonical --}}
    <link rel="canonical" href="{{ url()->current() }}"/>

    {{-- Dynamic Hreflang --}}
    @include('front.partials.hreflang')

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:locale" content="{{ app()->getLocale() }}_{{ strtoupper(app()->getLocale()) }}">
    @if($logo)
    <meta property="og:image" content="{{ asset('storage/' . $logo->image) }}">
    @endif

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title')">
    <meta name="twitter:description" content="@yield('description')">
    @if($logo)
    <meta name="twitter:image" content="{{ asset('storage/' . $logo->image) }}">
    @endif

    @include('front.partials.head')
</head>
<body>

@include('front.partials.header')

<main id="main-content">
    @yield('content')
</main>

@include('front.partials.footer')

@stack('scripts')
</body>
</html>
