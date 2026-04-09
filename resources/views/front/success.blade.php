@extends('front.layouts.master')

@section('title', word('success', 'Uğurla göndərildi'))

@section('content')

    <section class="success-page">
        <div class="success-content">
            <div class="success-icon">
                <i class="fas fa-check"></i>
            </div>
            <h1>{{ word('thank_you', 'Təşəkkür edirik!') }}</h1>
            <p>{{ word('success_message', 'Müraciətiniz uğurla qəbul edildi. Ən qısa zamanda sizinlə əlaqə saxlanılacaq.') }}</p>
            <a href="{{ route('welcome') }}" class="btn btn-primary">
                <i class="fas fa-home"></i> {{ word('back_to_home', 'Ana səhifəyə qayıt') }}
            </a>
        </div>
    </section>

@endsection
