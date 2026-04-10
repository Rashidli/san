@extends('front.layouts.master')

@section('title', $single->seo_title ?? $single->title ?? word('contact', 'Əlaqə'))
@section('description', $single->seo_description ?? '')
@section('keywords', $single->seo_keywords ?? '')

@section('content')

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>{{ $single->title ?? word('contact', 'Əlaqə') }}</h1>
            <div class="breadcrumb">
                <a href="{{ route('welcome') }}">{{ $home_page->title ?? word('home', 'Ana səhifə') }}</a>
                <span>/</span>
                <span>{{ $single->title ?? word('contact', 'Əlaqə') }}</span>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section">
        <div class="container">
            <div class="contact-grid">
                <div class="contact-info">
                    <h2>{{ word('get_in_touch', 'Bizimlə əlaqə saxlayın') }}</h2>
                    <p>{{ word('contact_description', 'Suallarınız və ya xidmət sifarişləriniz üçün aşağıdakı vasitələrlə bizimlə əlaqə saxlaya bilərsiniz.') }}</p>

                    <div class="contact-list">
                        @foreach($contactItems as $item)
                        <div class="contact-item">
                            <div class="contact-item-icon">
                                @if($item->icon)
                                    <i class="{{ $item->icon }}"></i>
                                @else
                                    <i class="fas fa-info"></i>
                                @endif
                            </div>
                            <div class="contact-item-text">
                                <h4>{{ $item->title }}</h4>
                                <p>{{ $item->value }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="footer-social">
                        @foreach($footer_socials as $social)
                            <a href="{{ $social->link }}" target="_blank">
                                @if($social->icon)
                                    <i class="{{ $social->icon }}"></i>
                                @elseif($social->image)
                                    <img src="{{ asset($social->image) }}" alt="{{ $social->title }}">
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="contact-form-wrapper">
                    <h3>{{ word('send_message', 'Mesaj göndərin') }}</h3>

                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('contact_post') }}" method="POST" class="contact-form" id="contactForm">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ word('full_name', 'Ad, Soyad') }} *</label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="{{ word('enter_name', 'Adınızı daxil edin') }}">
                            @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ word('phone', 'Telefon') }} *</label>
                            <input type="tel" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="{{ word('enter_phone', 'Telefon nömrənizi daxil edin') }}">
                            @error('phone')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        @if($services->count() > 0)
                        <div class="form-group">
                            <label for="service_id">{{ word('service', 'Xidmət') }}</label>
                            <select id="service_id" name="service_id" class="form-control">
                                <option value="">{{ word('select_service', 'Xidmət seçin') }}</option>
                                @foreach($services as $service)
                                <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>{{ $service->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="message">{{ word('message', 'Mesaj') }}</label>
                            <textarea id="message" name="message" class="form-control" rows="5" placeholder="{{ word('enter_message', 'Mesajınızı yazın') }}">{{ old('message') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> {{ word('send', 'Göndər') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    @if($global_map)
    <section class="map-section">
        <div class="map-container">
            {!! $global_map !!}
        </div>
    </section>
    @endif

@endsection
