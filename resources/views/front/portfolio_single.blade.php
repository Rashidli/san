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
                <a href="{{ route('welcome') }}">{{ word('home', 'Ana səhifə') }}</a>
                <span>/</span>
                <a href="{{ route('dynamic.page', $portfolio_page->slug ?? 'portfolio') }}">{{ word('portfolio', 'Portfolio') }}</a>
                <span>/</span>
                <span>{{ Str::limit($portfolio->title, 30) }}</span>
            </div>
        </div>
    </section>

    <!-- Portfolio Detail -->
    <section class="section">
        <div class="container">
            <div class="about-grid">
                <div class="about-image">
                    @if($portfolio->image)
                    <img src="{{ asset('storage/' . $portfolio->image) }}" alt="{{ $portfolio->title }}">
                    @endif

                    @if($portfolio->images && $portfolio->images->count() > 0)
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-top: 15px;">
                        @foreach($portfolio->images as $image)
                        <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $portfolio->title }}" style="border-radius: var(--radius); cursor: pointer;">
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="about-content">
                    <h2>{{ $portfolio->title }}</h2>

                    @if($portfolio->service)
                    <div style="margin-bottom: 15px;">
                        <span style="display: inline-block; padding: 6px 12px; background: var(--primary-color); color: #fff; border-radius: 20px; font-size: 13px;">
                            {{ $portfolio->service->title }}
                        </span>
                    </div>
                    @endif

                    <div class="portfolio-description" style="color: var(--text-light); line-height: 1.8;">
                        {!! $portfolio->description !!}
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

    <!-- Related Portfolio -->
    @php
        $relatedPortfolios = \App\Models\Portfolio::active()->where('id', '!=', $portfolio->id)->ordered()->take(3)->get();
    @endphp
    @if($relatedPortfolios->count() > 0)
    <section class="section section-light">
        <div class="container">
            <div class="section-header">
                <h2>{{ word('other_works', 'Digər işlərimiz') }}</h2>
            </div>
            <div class="portfolio-grid">
                @foreach($relatedPortfolios as $relatedPortfolio)
                <a href="{{ route('dynamic.page', $relatedPortfolio->slug) }}" class="portfolio-card">
                    @if($relatedPortfolio->image)
                    <img src="{{ asset('storage/' . $relatedPortfolio->image) }}" alt="{{ $relatedPortfolio->title }}">
                    @endif
                    <div class="portfolio-overlay">
                        <h3>{{ $relatedPortfolio->title }}</h3>
                        @if($relatedPortfolio->service)
                        <span>{{ $relatedPortfolio->service->title }}</span>
                        @endif
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

@endsection
