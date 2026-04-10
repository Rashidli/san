@extends('front.layouts.master')

@section('title', $single->seo_title ?? $single->title ?? word('portfolio', 'Portfolio'))
@section('description', $single->seo_description ?? '')
@section('keywords', $single->seo_keywords ?? '')

@section('content')

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>{{ $single->title ?? word('portfolio', 'Portfolio') }}</h1>
            <div class="breadcrumb">
                <a href="{{ route('welcome') }}">{{ $home_page->title ?? word('home', 'Ana səhifə') }}</a>
                <span>/</span>
                <span>{{ $single->title ?? word('portfolio', 'Portfolio') }}</span>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section class="section">
        <div class="container">
            @if($portfolios->count() > 0)
            <div class="portfolio-grid">
                @foreach($portfolios as $portfolio)
                <a href="{{ route('dynamic.page', $portfolio->slug) }}" class="portfolio-card">
                    @if($portfolio->image)
                    <img src="{{ asset('storage/' . $portfolio->image) }}" alt="{{ $portfolio->title }}">
                    @endif
                    <div class="portfolio-overlay">
                        <h3>{{ $portfolio->title }}</h3>
                        @if($portfolio->service)
                        <span>{{ $portfolio->service->title }}</span>
                        @endif
                    </div>
                </a>
                @endforeach
            </div>

            @if($portfolios->hasPages())
            <div class="pagination-wrapper">
                {{ $portfolios->links() }}
            </div>
            @endif
            @else
            <div style="text-align: center; padding: 60px 0;">
                <p>{{ word('no_portfolios', 'Hal-hazırda portfolio yoxdur') }}</p>
            </div>
            @endif
        </div>
    </section>

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
                    {{ word('contact_us', 'Əlaqə saxlayın') }}
                </a>
            </div>
        </div>
    </section>

@endsection
