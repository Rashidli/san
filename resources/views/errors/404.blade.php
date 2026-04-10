@extends('front.layouts.master')

@section('title', '404 - ' . word('page_not_found', 'Səhifə tapılmadı'))

@section('content')

    <section class="error-page">
        <div class="error-content">
            <div class="error-code">404</div>
            <h1>{{ word('page_not_found', 'Səhifə tapılmadı') }}</h1>
            <p>{{ word('page_not_found_desc', 'Axtardığınız səhifə mövcud deyil və ya silinmişdir.') }}</p>
            <div class="error-buttons">
                <a href="{{ route('welcome') }}" class="btn btn-primary">
                    <i class="fas fa-home"></i> {{ word('back_to_home', 'Ana səhifəyə qayıt') }}
                </a>
                <a href="{{ route('dynamic.page', $contact->slug ?? 'elaqe') }}" class="btn btn-outline">
                    <i class="fas fa-envelope"></i> {{ word('contact_us', 'Əlaqə') }}
                </a>
            </div>
        </div>
    </section>

@endsection
