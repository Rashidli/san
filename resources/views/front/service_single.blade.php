@extends('front.layouts.master')

@section('title', $service->seo_title ?? $service->title)
@section('description', $service->seo_description ?? Str::limit(strip_tags($service->description), 160))
@section('keywords', $service->seo_keywords ?? '')

@section('content')

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>{{ $service->title }}</h1>
            <div class="breadcrumb">
                <a href="{{ route('welcome') }}">{{ word('home', 'Ana səhifə') }}</a>
                <span>/</span>
                <a href="{{ route('dynamic.page', $service_page->slug ?? 'xidmetler') }}">{{ word('services', 'Xidmətlər') }}</a>
                <span>/</span>
                <span>{{ $service->title }}</span>
            </div>
        </div>
    </section>

    <!-- Service Detail -->
    <section class="section">
        <div class="container">
            <div class="about-grid">
                <div class="about-image">
                    @if($service->image)
                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                    @endif
                </div>
                <div class="about-content">
                    <h2>{{ $service->title }}</h2>
                    <div class="service-description">
                        {!! $service->description !!}
                    </div>
                    <div style="margin-top: 30px;">
                        <a href="{{ route('dynamic.page', $contact->slug ?? 'elaqe') }}" class="btn btn-primary">
                            <i class="fas fa-phone"></i> {{ word('order_service', 'Xidmət sifariş et') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Other Services -->
    @php
        $otherServices = \App\Models\Service::active()->where('id', '!=', $service->id)->ordered()->take(3)->get();
    @endphp
    @if($otherServices->count() > 0)
    <section class="section section-light">
        <div class="container">
            <div class="section-header">
                <h2>{{ word('other_services', 'Digər xidmətlər') }}</h2>
            </div>
            <div class="services-grid">
                @foreach($otherServices as $otherService)
                <div class="service-card">
                    <div class="service-image">
                        @if($otherService->image)
                        <img src="{{ asset('storage/' . $otherService->image) }}" alt="{{ $otherService->title }}">
                        @endif
                        <div class="service-icon">
                            @if($otherService->icon)
                                <i class="{{ $otherService->icon }}"></i>
                            @else
                                <i class="fas fa-tools"></i>
                            @endif
                        </div>
                    </div>
                    <div class="service-content">
                        <h3><a href="{{ route('dynamic.page', $otherService->slug) }}">{{ $otherService->title }}</a></h3>
                        <p>{{ Str::limit(strip_tags($otherService->short_description ?? $otherService->description), 100) }}</p>
                        <a href="{{ route('dynamic.page', $otherService->slug) }}" class="service-link">
                            {{ word('read_more', 'Ətraflı') }} <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
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
            </div>
        </div>
    </section>

@endsection
