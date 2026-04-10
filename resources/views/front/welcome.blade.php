@extends('front.layouts.master')

@section('title', $seo->seo_title ?? $seo->title ?? config('app.name'))
@section('description', $seo->seo_description ?? '')
@section('keywords', $seo->seo_keywords ?? '')

@section('content')

    <!-- Hero Slider -->
    @if($sliders->count() > 0)
    <section class="hero-section">
        <div class="hero-slider">
            <div class="swiper">
                <div class="swiper-wrapper">
                    @foreach($sliders as $slider)
                    <div class="swiper-slide">
                        <div class="hero-slide" style="background-image: url('{{ asset('storage/' . $slider->image) }}')">
                            <div class="container">
                                <div class="hero-content">
                                    <h1>{{ $slider->title }}</h1>
                                    <p>{{ $slider->description }}</p>
                                    <div class="hero-buttons">
                                        @if($slider->button_text && $slider->button_link)
                                        <a href="{{ $slider->button_link }}" class="btn btn-primary">{{ $slider->button_text }}</a>
                                        @endif
                                        <a href="{{ route('dynamic.page', $contact->slug ?? 'elaqe') }}" class="btn btn-white">{{ word('contact_us', 'Əlaqə saxla') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="hero-pagination"></div>
        </div>
    </section>
    @endif

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
                        <h3>{{ $stat_years }}</h3>
                        <span>{{ word('years_experience', 'İllik təcrübə') }}</span>
                    </div>
                </div>
                <div class="about-content">
                    <h2>{{ $about->title }}</h2>
                    <p>{!! $about->description !!}</p>
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
                    <a href="{{ route('dynamic.page', $about_page->slug ?? 'haqqimizda') }}" class="btn btn-primary">{{ word('learn_more', 'Daha ətraflı') }}</a>
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

    <!-- Services Section -->
    @if($services->count() > 0)
    <section class="section">
        <div class="container">
            <div class="section-header">
                <h2>{{ word('our_services', 'Xidmətlərimiz') }}</h2>
                <p>{{ word('services_description', 'Sizə təklif etdiyimiz peşəkar xidmətlər') }}</p>
            </div>
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
                        <p>{{ Str::limit(strip_tags($service->short_description ?? $service->description), 100) }}</p>
                        <a href="{{ route('dynamic.page', $service->slug) }}" class="service-link">
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
                <a href="{{ route('dynamic.page', $contact->slug ?? 'elaqe') }}" class="btn btn-outline" style="border-color: #fff; color: #fff;">
                    {{ word('get_quote', 'Qiymət alın') }}
                </a>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    @if($portfolios->count() > 0)
    <section class="section">
        <div class="container">
            <div class="section-header">
                <h2>{{ word('our_work', 'İşlərimiz') }}</h2>
                <p>{{ word('portfolio_description', 'Tamamladığımız layihələrdən nümunələr') }}</p>
            </div>
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
            <div style="text-align: center; margin-top: 40px;">
                <a href="{{ route('dynamic.page', $portfolio_page->slug ?? 'portfolio') }}" class="btn btn-primary">{{ word('view_all', 'Hamısına bax') }}</a>
            </div>
        </div>
    </section>
    @endif

    <!-- Reviews Section -->
    @if($reviews->count() > 0)
    <section class="section section-light">
        <div class="container">
            <div class="section-header">
                <h2>{{ word('customer_reviews', 'Müştəri rəyləri') }}</h2>
                <p>{{ word('reviews_description', 'Müştərilərimizin haqqımızda fikirləri') }}</p>
            </div>
            <div class="reviews-slider">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        @foreach($reviews as $review)
                        <div class="swiper-slide">
                            <div class="review-card">
                                <div class="review-header">
                                    <div class="review-avatar">
                                        @if($review->image)
                                        <img src="{{ asset('storage/' . $review->image) }}" alt="{{ $review->name }}">
                                        @else
                                        <img src="{{ asset('front/img/avatar-placeholder.png') }}" alt="{{ $review->name }}">
                                        @endif
                                    </div>
                                    <div class="review-info">
                                        <h4>{{ $review->name }}</h4>
                                        <span>{{ $review->position }}</span>
                                    </div>
                                </div>
                                <div class="review-rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                    @endfor
                                </div>
                                <div class="review-content">
                                    <p>"{{ $review->content }}"</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="reviews-pagination"></div>
            </div>
        </div>
    </section>
    @endif

    <!-- Blog Section -->
    @if($blogs->count() > 0)
    <section class="section">
        <div class="container">
            <div class="section-header">
                <h2>{{ word('latest_news', 'Son xəbərlər') }}</h2>
                <p>{{ word('blog_description', 'Faydalı məqalələr və yeniliklər') }}</p>
            </div>
            <div class="blog-grid">
                @foreach($blogs as $blog)
                <div class="blog-card">
                    <div class="blog-image">
                        @if($blog->image)
                        <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                        @endif
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span><i class="far fa-calendar"></i> {{ $blog->created_at->format('d.m.Y') }}</span>
                            <span><i class="far fa-eye"></i> {{ $blog->views ?? 0 }}</span>
                        </div>
                        <h3><a href="{{ route('dynamic.page', $blog->slug) }}">{{ $blog->title }}</a></h3>
                        <p>{{ Str::limit(strip_tags($blog->short_description ?? $blog->description), 100) }}</p>
                        <a href="{{ route('dynamic.page', $blog->slug) }}" class="service-link">
                            {{ word('read_more', 'Ətraflı') }} <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- FAQ Section -->
    @if($faqs->count() > 0)
    <section class="section section-light">
        <div class="container">
            <div class="section-header">
                <h2>{{ word('faq', 'Tez-tez verilən suallar') }}</h2>
                <p>{{ word('faq_description', 'Ən çox soruşulan suallara cavablar') }}</p>
            </div>
            <div class="faq-list">
                @foreach($faqs as $index => $faq)
                <div class="faq-item{{ $index === 0 ? ' active' : '' }}">
                    <div class="faq-question">
                        <span>{{ $faq->question }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>{!! $faq->answer !!}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

@endsection
