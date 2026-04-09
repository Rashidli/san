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
            <div class="single-layout">
                <div class="single-main">
                    <!-- Blog Meta -->
                    <div class="blog-single-meta">
                        <span class="meta-item">
                            <i class="far fa-calendar-alt"></i>
                            {{ $blog->created_at->format('d.m.Y') }}
                        </span>
                        <span class="meta-item">
                            <i class="far fa-eye"></i>
                            {{ $blog->views ?? 0 }} {{ word('views', 'baxış') }}
                        </span>
                        @if($blog->tags->count() > 0)
                        <span class="meta-item">
                            <i class="far fa-folder"></i>
                            {{ $blog->tags->first()->title }}
                        </span>
                        @endif
                    </div>

                    <!-- Featured Image -->
                    @if($blog->image)
                    <div class="single-featured-image">
                        <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                    </div>
                    @endif

                    <!-- Content -->
                    <div class="single-content-box">
                        <div class="single-text">
                            {!! $blog->description !!}
                        </div>

                        <!-- Tags -->
                        @if($blog->tags->count() > 0)
                        <div class="blog-tags">
                            <span class="tags-label"><i class="fas fa-tags"></i> {{ word('tags', 'Etiketlər') }}:</span>
                            <div class="tags-list">
                                @foreach($blog->tags as $tag)
                                <a href="#" class="tag-item">{{ $tag->title }}</a>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Share -->
                        <div class="blog-share">
                            <span class="share-label">{{ word('share', 'Paylaş') }}:</span>
                            <div class="share-buttons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="share-btn share-facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}" target="_blank" class="share-btn share-twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($blog->title . ' ' . request()->url()) }}" target="_blank" class="share-btn share-whatsapp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($blog->title) }}" target="_blank" class="share-btn share-linkedin">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="single-sidebar">
                    <!-- Search -->
                    <div class="sidebar-card">
                        <h4 class="sidebar-title">{{ word('search', 'Axtar') }}</h4>
                        <form action="{{ route('dynamic.page', $blog_page->slug ?? 'bloq') }}" method="GET" class="sidebar-search">
                            <input type="text" name="q" placeholder="{{ word('search_placeholder', 'Açar söz yazın...') }}" class="form-control">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>

                    <!-- Recent Posts -->
                    @php
                        $recentBlogs = \App\Models\Blog::active()->where('id', '!=', $blog->id)->latest()->take(4)->get();
                    @endphp
                    @if($recentBlogs->count() > 0)
                    <div class="sidebar-card">
                        <h4 class="sidebar-title">{{ word('recent_posts', 'Son yazılar') }}</h4>
                        <div class="sidebar-posts">
                            @foreach($recentBlogs as $recentBlog)
                            <a href="{{ route('dynamic.page', $recentBlog->slug) }}" class="sidebar-post">
                                @if($recentBlog->image)
                                <div class="sidebar-post-image">
                                    <img src="{{ asset('storage/' . $recentBlog->image) }}" alt="{{ $recentBlog->title }}">
                                </div>
                                @endif
                                <div class="sidebar-post-content">
                                    <h5>{{ Str::limit($recentBlog->title, 50) }}</h5>
                                    <span><i class="far fa-calendar-alt"></i> {{ $recentBlog->created_at->format('d.m.Y') }}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Tags Cloud -->
                    @php
                        $allTags = \App\Models\Tag::withCount('blogs')->orderBy('blogs_count', 'desc')->take(10)->get();
                    @endphp
                    @if($allTags->count() > 0)
                    <div class="sidebar-card">
                        <h4 class="sidebar-title">{{ word('tags', 'Etiketlər') }}</h4>
                        <div class="sidebar-tags">
                            @foreach($allTags as $tag)
                            <a href="#" class="sidebar-tag">{{ $tag->title }}</a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
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
                        <a href="{{ route('dynamic.page', $relatedBlog->slug) }}" class="blog-link">
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
