<link rel="stylesheet" href="{{ asset('front/css/style.css') }}?v={{ filemtime(public_path('front/css/style.css')) ?? time() }}">
<link rel="stylesheet" href="{{ asset('front/css/responsive.css') }}?v={{ filemtime(public_path('front/css/responsive.css')) ?? time() }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@if($favicon)
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $favicon->image) }}">
    <link rel="shortcut icon" href="{{ asset('storage/' . $favicon->image) }}">
    <link rel="apple-touch-icon" href="{{ asset('storage/' . $favicon->image) }}">
@endif
