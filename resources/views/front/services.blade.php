@extends('front.layouts.master')

@section('title', $single->seo_title ?? $single->title ?? word('services', 'Xidmətlər'))
@section('description', $single->seo_description ?? '')
@section('keywords', $single->seo_keywords ?? '')

@section('content')

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>{{ $single->title ?? word('services', 'Xidmətlər') }}</h1>
            <div class="breadcrumb">
                <a href="{{ route('welcome') }}">{{ $home_page->title ?? word('home', 'Ana səhifə') }}</a>
                <span>/</span>
                <span>{{ $single->title ?? word('services', 'Xidmətlər') }}</span>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="section">
        <div class="container">
            @if($services->count() > 0)
            <div class="services-grid">
                @foreach($services as $service)
                <div class="service-card">
                    <div class="service-image">
                        @if($service->image)
                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                        @endif
                        <div class="service-icon">
                            @if($service->icon)
                                <i class="{{ $service->icon }}"></i>
                            @else
                                <i class="fas fa-tools"></i>
                            @endif
                        </div>
                    </div>
                    <div class="service-content">
                        <h3><a href="{{ route('dynamic.page', $service->slug) }}">{{ $service->title }}</a></h3>
                        <p>{{ Str::limit(strip_tags($service->short_description ?? $service->description), 120) }}</p>
                        <a href="{{ route('dynamic.page', $service->slug) }}" class="service-link">
                            {{ word('read_more', 'Ətraflı') }} <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div style="text-align: center; padding: 60px 0;">
                <p>{{ word('no_services', 'Hal-hazırda xidmət yoxdur') }}</p>
            </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2>{{ word('need_help', 'Köməyə ehtiyacınız var?') }}</h2>
            <p>{{ word('cta_description', 'İşlərinizi keyfiyyətlə yerinə yetirmək üçün 24/7 sizin xidmətinizdəyik') }}</p>
            <div class="cta-buttons">
                <a href="tel:{{ $global_whatsapp ?? '' }}" class="btn btn-white">
                    <i class="fas fa-phone"></i> {{ word('call_now', 'İndi zəng edin') }}
                </a>
                <a href="{{ route('dynamic.page', $contact->slug ?? 'elaqe') }}" class="btn btn-outline" style="border-color: #fff; color: #fff;">
                    {{ word('contact_us', 'Əlaqə saxlayın') }}
                </a>
            </div>
        </div>
    </section>

@endsection
