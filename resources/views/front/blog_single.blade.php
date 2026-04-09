@extends('front.layouts.master')

@section('title', $blog->seo_title ?? $blog->title)
@section('description', $blog->seo_description ?? Str::limit(strip_tags($blog->description), 160))
@section('keywords', $blog->seo_keywords ?? '')

@section('content')

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>{{ $blog->title }}</h1>
            <div class="breadcrumb">
                <a href="{{ route('welcome') }}">{{ word('home', 'Ana səhifə') }}</a>
                <span>/</span>
                <a href="{{ route('dynamic.page', $blog_page->slug ?? 'bloq') }}">{{ word('blog', 'Bloq') }}</a>
                <span>/</span>
                <span>{{ Str::limit($blog->title, 30) }}</span>
            </div>
        </div>
    </section>

    <!-- Blog Detail -->
    <section class="section">
        <div class="container">
            <div style="max-width: 800px; margin: 0 auto;">
                <div class="blog-meta" style="margin-bottom: 20px;">
                    <span><i class="far fa-calendar"></i> {{ $blog->created_at->format('d.m.Y') }}</span>
                    <span><i class="far fa-eye"></i> {{ $blog->views ?? 0 }} {{ word('views', 'baxış') }}</span>
                </div>

                @if($blog->image)
                <div style="margin-bottom: 30px; border-radius: var(--radius-lg); overflow: hidden;">
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" style="width: 100%;">
                </div>
                @endif

                <div class="blog-description" style="line-height: 1.8; color: var(--text-light);">
                    {!! $blog->description !!}
                </div>

                @if($blog->tags->count() > 0)
                <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid var(--border-color);">
                    <strong>{{ word('tags', 'Etiketlər') }}:</strong>
                    @foreach($blog->tags as $tag)
                    <span style="display: inline-block; padding: 5px 12px; background: var(--bg-light); border-radius: 20px; font-size: 13px; margin: 5px 5px 5px 0;">{{ $tag->title }}</span>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Related Blogs -->
    @if($relatedBlogs->count() > 0)
    <section class="section section-light">
        <div class="container">
            <div class="section-header">
                <h2>{{ word('related_posts', 'Oxşar yazılar') }}</h2>
            </div>
            <div class="blog-grid">
                @foreach($relatedBlogs as $relatedBlog)
                <div class="blog-card">
                    <div class="blog-image">
                        @if($relatedBlog->image)
                        <a href="{{ route('dynamic.page', $relatedBlog->slug) }}">
                            <img src="{{ asset('storage/' . $relatedBlog->image) }}" alt="{{ $relatedBlog->title }}">
                        </a>
                        @endif
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span><i class="far fa-calendar"></i> {{ $relatedBlog->created_at->format('d.m.Y') }}</span>
                        </div>
                        <h3><a href="{{ route('dynamic.page', $relatedBlog->slug) }}">{{ $relatedBlog->title }}</a></h3>
                        <p>{{ Str::limit(strip_tags($relatedBlog->short_description ?? $relatedBlog->description), 100) }}</p>
                        <a href="{{ route('dynamic.page', $relatedBlog->slug) }}" class="service-link">
                            {{ word('read_more', 'Ətraflı') }} <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

@endsection
