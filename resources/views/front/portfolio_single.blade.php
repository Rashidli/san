@extends('front.layouts.master')

@section('title', $portfolio->seo_title ?? $portfolio->title)
@section('description', $portfolio->seo_description ?? Str::limit(strip_tags($portfolio->description), 160))
@section('keywords', $portfolio->seo_keywords ?? '')

@section('content')

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>{{ $portfolio->title }}</h1>
            <div class="breadcrumb">
                <a href="{{ route('welcome') }}">{{ $home_page->title ?? word('home', 'Ana səhifə') }}</a>
                <span>/</span>
                <a href="{{ route('dynamic.page', $portfolio_page->slug ?? 'portfolio') }}">{{ $portfolio_page->title ?? word('portfolio', 'Portfolio') }}</a>
                <span>/</span>
                <span>{{ Str::limit($portfolio->title, 30) }}</span>
            </div>
        </div>
    </section>

    <!-- Portfolio Detail -->
    <section class="section">
        <div class="container">
            <div class="portfolio-single">
                <!-- Main Image Gallery -->
                <div class="portfolio-gallery">
                    @if($portfolio->image)
                    <a href="{{ asset('storage/' . $portfolio->image) }}" class="portfolio-main-image glightbox" data-gallery="portfolio-gallery" data-title="{{ $portfolio->title }}">
                        <img src="{{ asset('storage/' . $portfolio->image) }}" alt="{{ $portfolio->title }}">
                        <div class="gallery-zoom">
                            <i class="fas fa-search-plus"></i>
                        </div>
                    </a>
                    @endif

                    @if($portfolio->images && $portfolio->images->count() > 0)
                    <div class="portfolio-thumbnails">
                        @foreach($portfolio->images as $image)
                        <a href="{{ asset('storage/' . $image->image) }}" class="portfolio-thumb glightbox" data-gallery="portfolio-gallery" data-title="{{ $portfolio->title }}">
                            <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $portfolio->title }}">
                            <div class="gallery-zoom">
                                <i class="fas fa-search-plus"></i>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Portfolio Info -->
                <div class="portfolio-info-box">
                    <div class="portfolio-info-header">
                        @if($portfolio->service)
                        <span class="portfolio-category">
                            <i class="fas fa-folder"></i> {{ $portfolio->service->title }}
                        </span>
                        @endif
                        <h2>{{ $portfolio->title }}</h2>
                    </div>

                    <div class="portfolio-details">
                        @if($portfolio->service)
                        <div class="portfolio-detail-item">
                            <span class="detail-label">{{ word('service', 'Xidmət') }}</span>
                            <span class="detail-value">{{ $portfolio->service->title }}</span>
                        </div>
                        @endif
                        <div class="portfolio-detail-item">
                            <span class="detail-label">{{ word('client', 'Müştəri') }}</span>
                            <span class="detail-value">{{ $portfolio->client ?? word('private_client', 'Şəxsi müştəri') }}</span>
                        </div>
                        <div class="portfolio-detail-item">
                            <span class="detail-label">{{ word('date', 'Tarix') }}</span>
                            <span class="detail-value">{{ $portfolio->created_at->format('d.m.Y') }}</span>
                        </div>
                        <div class="portfolio-detail-item">
                            <span class="detail-label">{{ word('location', 'Ünvan') }}</span>
                            <span class="detail-value">{{ $portfolio->location ?? word('baku', 'Bakı, Azərbaycan') }}</span>
                        </div>
                    </div>

                    <div class="portfolio-description">
                        <h3>{{ word('project_details', 'Layihə haqqında') }}</h3>
                        <div class="single-text">
                            {!! $portfolio->description !!}
                        </div>
                    </div>

                    <div class="portfolio-actions">
                        <a href="{{ route('dynamic.page', $contact->slug ?? 'elaqe') }}" class="btn btn-primary">
                            <i class="fas fa-phone"></i> {{ word('order_service', 'Xidmət sifariş et') }}
                        </a>
                        @if($portfolio->service)
                        <a href="{{ route('dynamic.page', $portfolio->service->slug) }}" class="btn btn-outline">
                            <i class="fas fa-wrench"></i> {{ word('view_service', 'Xidmətə bax') }}
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Portfolio -->
    @php
        $relatedPortfolios = \App\Models\Portfolio::active()->where('id', '!=', $portfolio->id)->ordered()->take(4)->get();
    @endphp
    @if($relatedPortfolios->count() > 0)
    <section class="section section-light">
        <div class="container">
            <div class="section-header">
                <h2>{{ word('other_works', 'Digər işlərimiz') }}</h2>
            </div>
            <div class="portfolio-grid portfolio-grid-4">
                @foreach($relatedPortfolios as $relatedPortfolio)
                <a href="{{ route('dynamic.page', $relatedPortfolio->slug) }}" class="portfolio-card">
                    @if($relatedPortfolio->image)
                    <img src="{{ asset('storage/' . $relatedPortfolio->image) }}" alt="{{ $relatedPortfolio->title }}">
                    @endif
                    <div class="portfolio-overlay">
                        <div class="portfolio-overlay-content">
                            <h3>{{ $relatedPortfolio->title }}</h3>
                            @if($relatedPortfolio->service)
                            <span>{{ $relatedPortfolio->service->title }}</span>
                            @endif
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2>{{ word('start_project', 'Sizin layihənizi də həyata keçirək') }}</h2>
            <p>{{ word('cta_portfolio', 'Peşəkar komandamız sizin istəklərinizi ən yüksək səviyyədə yerinə yetirəcək') }}</p>
            <div class="cta-buttons">
                @php
                    $phoneItem = $footer_contact_items->first(function($item) {
                        return str_contains($item->link ?? '', 'tel:');
                    });
                @endphp
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
