<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    @if (!empty(Request::url()))
        <link rel="canonical" href="{{ Request::url() }}"/>
    @endif
    @include('front.partials.head')
    <link rel="alternate" href="{{url('/')}}/@yield('az_slug')" hreflang="az">
    <link rel="alternate" href="{{url('/')}}/@yield('en_slug')" hreflang="en">
    <link rel="alternate" href="{{url('/')}}/@yield('ru_slug')" hreflang="ru">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    @if($logo)
        <meta property="og:image" content="{{ asset('storage/' . $logo->image) }}">
    @endif
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
