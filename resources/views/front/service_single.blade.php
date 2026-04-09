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
            <div class="single-layout">
                <div class="single-main">
                    <!-- Featured Image -->
                    @if($service->image)
                    <div class="single-featured-image">
                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                        @if($service->icon)
                        <div class="single-icon">
                            <i class="{{ $service->icon }}"></i>
                        </div>
                        @endif
                    </div>
                    @endif

                    <!-- Content -->
                    <div class="single-content-box">
                        <h2>{{ $service->title }}</h2>
                        <div class="single-text">
                            {!! $service->description !!}
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="single-sidebar">
                    <!-- CTA Card -->
                    <div class="sidebar-card sidebar-cta">
                        <div class="sidebar-cta-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h4>{{ word('need_help', 'Kömək lazımdır?') }}</h4>
                        <p>{{ word('call_anytime', '24/7 zəng edə bilərsiniz') }}</p>
                        @php
                            $phoneItem = $footer_contact_items->first(function($item) {
                                return str_contains($item->link ?? '', 'tel:');
                            });
                        @endphp
                        @if($phoneItem)
                        <a href="{{ $phoneItem->link }}" class="sidebar-phone">
                            <i class="fas fa-phone-alt"></i>
                            {{ $phoneItem->value }}
                        </a>
                        @endif
                        <a href="{{ route('dynamic.page', $contact->slug ?? 'elaqe') }}" class="btn btn-primary btn-block">
                            <i class="fas fa-envelope"></i> {{ word('contact_us', 'Əlaqə') }}
                        </a>
                    </div>

                    <!-- Other Services -->
                    @php
                        $sidebarServices = \App\Models\Service::active()->where('id', '!=', $service->id)->ordered()->take(5)->get();
                    @endphp
                    @if($sidebarServices->count() > 0)
                    <div class="sidebar-card">
                        <h4 class="sidebar-title">{{ word('our_services', 'Xidmətlərimiz') }}</h4>
                        <ul class="sidebar-services">
                            @foreach($sidebarServices as $sideService)
                            <li>
                                <a href="{{ route('dynamic.page', $sideService->slug) }}">
                                    @if($sideService->icon)
                                        <i class="{{ $sideService->icon }}"></i>
                                    @else
                                        <i class="fas fa-chevron-right"></i>
                                    @endif
                                    {{ $sideService->title }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Other Services Grid -->
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
                @if($phoneItem)
                <a href="{{ $phoneItem->link }}" class="btn btn-white">
                    <i class="fas fa-phone"></i> {{ word('call_now', 'İndi zəng edin') }}
                </a>
                @endif
                <a href="{{ route('dynamic.page', $contact->slug ?? 'elaqe') }}" class="btn btn-outline-white">
                    <i class="fas fa-envelope"></i> {{ word('contact_us', 'Əlaqə') }}
                </a>
            </div>
        </div>
    </section>

@endsection
