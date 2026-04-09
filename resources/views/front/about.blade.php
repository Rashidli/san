@extends('front.layouts.master')

@section('title', $single->seo_title ?? $single->title ?? word('about', 'Haqqımızda'))
@section('description', $single->seo_description ?? '')
@section('keywords', $single->seo_keywords ?? '')

@section('content')

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>{{ $single->title ?? word('about', 'Haqqımızda') }}</h1>
            <div class="breadcrumb">
                <a href="{{ route('welcome') }}">{{ word('home', 'Ana səhifə') }}</a>
                <span>/</span>
                <span>{{ $single->title ?? word('about', 'Haqqımızda') }}</span>
            </div>
        </div>
    </section>

    <!-- About Section -->
    @if($about)
    <section class="about-section section">
        <div class="container">
            <div class="about-grid">
                <div class="about-image">
                    @if($about->image)
                    <img src="{{ asset('storage/' . $about->image) }}" alt="{{ $about->title }}">
                    @endif
                    <div class="about-image-badge">
                        <h3>10+</h3>
                        <span>{{ word('years_experience', 'İllik təcrübə') }}</span>
                    </div>
                </div>
                <div class="about-content">
                    <h2>{{ $about->title }}</h2>
                    <div class="about-text">
                        {!! $about->description !!}
                    </div>
                    <div class="about-features">
                        <div class="about-feature">
                            <i class="fas fa-check"></i>
                            <span>{{ word('quality_service', 'Keyfiyyətli xidmət') }}</span>
                        </div>
                        <div class="about-feature">
                            <i class="fas fa-check"></i>
                            <span>{{ word('professional_team', 'Peşəkar komanda') }}</span>
                        </div>
                        <div class="about-feature">
                            <i class="fas fa-check"></i>
                            <span>{{ word('fast_service', 'Sürətli xidmət') }}</span>
                        </div>
                        <div class="about-feature">
                            <i class="fas fa-check"></i>
                            <span>{{ word('warranty', 'Zəmanət') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Why Us Section -->
    @if($whyUs->count() > 0)
    <section class="section section-light">
        <div class="container">
            <div class="section-header">
                <h2>{{ word('why_choose_us', 'Niyə bizi seçməlisiniz?') }}</h2>
                <p>{{ word('why_choose_us_desc', 'Peşəkar xidmətlərimizlə fərqlənən üstünlüklərimiz') }}</p>
            </div>
            <div class="why-us-grid">
                @foreach($whyUs as $item)
                <div class="why-us-card">
                    <div class="why-us-icon">
                        @if($item->icon)
                            <i class="{{ $item->icon }}"></i>
                        @else
                            <i class="fas fa-star"></i>
                        @endif
                    </div>
                    <h3>{{ $item->title }}</h3>
                    <p>{{ $item->description }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2>{{ word('cta_title', 'Peşəkar xidmət üçün bizimlə əlaqə saxlayın') }}</h2>
            <p>{{ word('cta_description', 'İşlərinizi keyfiyyətlə yerinə yetirmək üçün 24/7 sizin xidmətinizdəyik') }}</p>
            <div class="cta-buttons">
                <a href="tel:{{ $global_whatsapp ?? '' }}" class="btn btn-white">
                    <i class="fas fa-phone"></i> {{ word('call_now', 'İndi zəng edin') }}
                </a>
                <a href="{{ route('dynamic.page', $contact->slug ?? 'elaqe') }}" class="btn btn-outline" style="border-color: #fff; color: #fff;">
                    {{ word('get_quote', 'Qiymət alın') }}
                </a>
            </div>
        </div>
    </section>

@endsection
