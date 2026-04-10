@extends('front.layouts.master')

@section('title', $single->seo_title ?? $single->title ?? word('blog', 'Bloq'))
@section('description', $single->seo_description ?? '')
@section('keywords', $single->seo_keywords ?? '')

@section('content')

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>{{ $single->title ?? word('blog', 'Bloq') }}</h1>
            <div class="breadcrumb">
                <a href="{{ route('welcome') }}">{{ $home_page->title ?? word('home', 'Ana səhifə') }}</a>
                <span>/</span>
                <span>{{ $single->title ?? word('blog', 'Bloq') }}</span>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="section">
        <div class="container">
            @if($blogs->count() > 0)
            <div class="blog-grid">
                @foreach($blogs as $blog)
                <div class="blog-card">
                    <div class="blog-image">
                        @if($blog->image)
                        <a href="{{ route('dynamic.page', $blog->slug) }}">
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                        </a>
                        @endif
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span><i class="far fa-calendar"></i> {{ $blog->created_at->format('d.m.Y') }}</span>
                            <span><i class="far fa-eye"></i> {{ $blog->views ?? 0 }}</span>
                        </div>
                        <h3><a href="{{ route('dynamic.page', $blog->slug) }}">{{ $blog->title }}</a></h3>
                        <p>{{ Str::limit(strip_tags($blog->short_description ?? $blog->description), 120) }}</p>
                        <a href="{{ route('dynamic.page', $blog->slug) }}" class="service-link">
                            {{ word('read_more', 'Ətraflı') }} <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            @if($blogs->hasPages())
            <div class="pagination-wrapper">
                {{ $blogs->links() }}
            </div>
            @endif
            @else
            <div style="text-align: center; padding: 60px 0;">
                <p>{{ word('no_blogs', 'Hal-hazırda bloq yazısı yoxdur') }}</p>
            </div>
            @endif
        </div>
    </section>

@endsection
