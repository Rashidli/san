<!-- Preconnect to Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<!-- Google Fonts - Inter & Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<!-- Font Awesome 6 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

<!-- Main Styles -->
<link rel="stylesheet" href="{{ asset('front/css/style.css') }}?v={{ filemtime(public_path('front/css/style.css')) ?? time() }}">
<link rel="stylesheet" href="{{ asset('front/css/responsive.css') }}?v={{ filemtime(public_path('front/css/responsive.css')) ?? time() }}">

<!-- Favicon -->
@if($favicon)
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $favicon->image) }}">
    <link rel="shortcut icon" href="{{ asset('storage/' . $favicon->image) }}">
    <link rel="apple-touch-icon" href="{{ asset('storage/' . $favicon->image) }}">
@endif

<!-- Theme Color for Mobile Browsers -->
<meta name="theme-color" content="#FF6B00">
<meta name="msapplication-navbutton-color" content="#FF6B00">
<meta name="apple-mobile-web-app-status-bar-style" content="#FF6B00">
