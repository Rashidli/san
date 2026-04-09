<footer class="footer">
    <div class="footer-main">
        <div class="container">
            <div class="footer-grid">
                <!-- Footer About -->
                <div class="footer-col footer-about">
                    @if($logo_white)
                        <img src="{{ asset('storage/' . $logo_white->image) }}" alt="{{ config('app.name') }}" class="footer-logo">
                    @elseif($logo)
                        <img src="{{ asset('storage/' . $logo->image) }}" alt="{{ config('app.name') }}" class="footer-logo">
                    @endif
                    <p>{{ word('footer_description', 'Peşəkar elektrik və santexnik xidmətləri ilə evinizi güvənli saxlayırıq. Keyfiyyətli iş və müştəri məmnuniyyəti bizim prioritetimizdir.') }}</p>
                    <div class="footer-social">
                        @foreach($footer_socials as $social)
                            <a href="{{ $social->link }}" target="_blank" title="{{ $social->title }}">
                                @if($social->icon)
                                    <i class="{{ $social->icon }}"></i>
                                @elseif($social->image)
                                    <img src="{{ asset($social->image) }}" alt="{{ $social->title }}">
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="footer-col">
                    <h4>{{ word('quick_links', 'Keçidlər') }}</h4>
                    <ul>
                        <li>
                            <a href="{{ route('welcome') }}">
                                <i class="fas fa-chevron-right"></i>
                                {{ $home_page->title ?? word('home', 'Ana Səhifə') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dynamic.page', $about_page->slug ?? 'haqqimizda') }}">
                                <i class="fas fa-chevron-right"></i>
                                {{ $about_page->title ?? word('about', 'Haqqımızda') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dynamic.page', $service_page->slug ?? 'xidmetler') }}">
                                <i class="fas fa-chevron-right"></i>
                                {{ $service_page->title ?? word('services', 'Xidmətlər') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dynamic.page', $portfolio_page->slug ?? 'portfolio') }}">
                                <i class="fas fa-chevron-right"></i>
                                {{ $portfolio_page->title ?? word('portfolio', 'Portfolio') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dynamic.page', $blog_page->slug ?? 'bloq') }}">
                                <i class="fas fa-chevron-right"></i>
                                {{ $blog_page->title ?? word('blog', 'Bloq') }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Our Services -->
                <div class="footer-col">
                    <h4>{{ word('our_services', 'Xidmətlərimiz') }}</h4>
                    <ul>
                        @php
                            $footerServices = \App\Models\Service::active()->ordered()->take(5)->get();
                        @endphp
                        @foreach($footerServices as $fService)
                            <li>
                                <a href="{{ route('dynamic.page', $fService->slug) }}">
                                    <i class="fas fa-chevron-right"></i>
                                    {{ $fService->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="footer-col">
                    <h4>{{ word('contact_info', 'Əlaqə') }}</h4>
                    <ul class="contact-list">
                        @foreach($footer_contact_items as $item)
                            <li>
                                <a href="{{ $item->link ?? '#' }}">
                                    @if($item->icon)
                                        <i class="{{ $item->icon }}"></i>
                                    @endif
                                    <span>{{ $item->value }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-inner">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. {{ word('all_rights_reserved', 'Bütün hüquqlar qorunur.') }}</p>
                <p>{{ word('developed_by', 'Hazırladı') }}: <a href="#">Santexnik Team</a></p>
            </div>
        </div>
    </div>
</footer>

<!-- WhatsApp Float Button -->
@php
    $whatsappItem = $footer_contact_items->first(function($item) {
        return str_contains($item->link ?? '', 'wa.me') || str_contains($item->link ?? '', 'whatsapp');
    });
    $whatsappLink = $whatsappItem ? $whatsappItem->link : '#';
@endphp
<a href="{{ $whatsappLink }}" class="whatsapp-float" target="_blank" title="WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>

<!-- Scroll to Top -->
<button class="scroll-top" id="scrollTop" aria-label="Scroll to top">
    <i class="fas fa-arrow-up"></i>
</button>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<!-- Main JS -->
<script src="{{ asset('front/js/main.js') }}?v={{ filemtime(public_path('front/js/main.js')) ?? time() }}"></script>
