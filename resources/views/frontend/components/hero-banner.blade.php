@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/hero-banner.css') }}">
@endpush

<div class="container p-0">
<div class="hero-banner" aria-label="Featured wall art collection">
    <div class="swiper hero-swiper">
        <div class="swiper-wrapper">

            {{-- SLIDE 1 --}}
            <div class="swiper-slide">
                <div class="hero-slide-inner">
                    <img src="{{ asset('assets/images/banners/Banner_1.png') }}"
                         alt="Premium Wall Poster Collection" class="hero-slide-img" loading="eager" fetchpriority="high">
                    <div class="hero-slide-overlay  absolute inset-0 z-10"></div>
                    <div class="hero-slide-content z-20">
                        <span class="hsc-tag">New Collection</span>
                        <h1 class="hsc-title"><span class="hsc-title-inner">ART THAT<br>SPEAKS</span></h1>
                        <p class="hsc-sub"><span class="hsc-sub-inner">Premium wall posters crafted for spaces that demand attention.</span></p>
                        <div class="hsc-actions">
                            <a href="{{ route('shop') }}" class="hsc-btn hsc-btn-primary">Shop Posters</a>
                            <a href="{{ route('shop') }}" class="hsc-btn hsc-btn-ghost">View All</a>
                        </div>
                    </div>
                </div>
            </div>

              {{-- SLIDE 2 --}}
            <div class="swiper-slide">
                <div class="hero-slide-inner">
                    <img src="{{ asset('assets/images/banners/Banner_2.png') }}"
                         alt="Premium Wall Poster Collection" class="hero-slide-img" loading="eager" fetchpriority="high">
                    <div class="hero-slide-overlay  absolute inset-0 z-10"></div>
                    <div class="hero-slide-content z-20">
                        <span class="hsc-tag">New Collection</span>
                        <h1 class="hsc-title"><span class="hsc-title-inner">ART THAT<br>SPEAKS</span></h1>
                        <p class="hsc-sub"><span class="hsc-sub-inner">Premium wall posters crafted for spaces that demand attention.</span></p>
                        <div class="hsc-actions">
                            <a href="{{ route('shop') }}" class="hsc-btn hsc-btn-primary">Shop Posters</a>
                            <a href="{{ route('shop') }}" class="hsc-btn hsc-btn-ghost">View All</a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <div class="hero-bottom-bar">
        <div class="hero-pagination"></div>
    </div>
</div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('assets/js/hero-banner.js') }}"></script>
@endpush
