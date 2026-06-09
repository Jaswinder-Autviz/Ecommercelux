@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/hero-banner.css') }}">
@endpush

<div class="container p-0">
<div class="hero-banner" aria-label="Featured collection banner">
    <div class="swiper hero-swiper">
        <div class="swiper-wrapper">

            {{-- SLIDE 1 --}}
            <div class="swiper-slide">
                <div class="hero-slide-inner">
                    
                    <img src="{{ asset('assets/images/banners/Banner2.png') }}"
                         alt="Hustler T-shirt Collection" class="hero-slide-img" loading="eager" fetchpriority="high">
                    <div class="hero-slide-overlay"></div>
                    <div class="hero-slide-content">
                        <span class="hsc-tag">New Season</span>
                        <h1 class="hsc-title">HUSTLER<br>TEES</h1>
                        <p class="hsc-sub">Premium t-shirts made for people who keep moving.</p>
                        <div class="hsc-actions">
                            <a href="{{ route('shop') }}" class="hsc-btn hsc-btn-primary">Shop Now</a>
                            <a href="{{ route('shop') }}" class="hsc-btn hsc-btn-ghost">View All</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SLIDE 2 --}}
            <div class="swiper-slide">
                <div class="hero-slide-inner">
                    <img src="{{ asset('assets/images/banners/Banner6.jpg') }}"
                         alt="Streetwear T-shirts" class="hero-slide-img" loading="lazy">
                    <div class="hero-slide-overlay"></div>
                    <div class="hero-slide-content">
                        <span class="hsc-tag">Street Culture</span>
                        <h1 class="hsc-title">BORN ON<br>THE STREETS</h1>
                        <p class="hsc-sub">Street-ready staples with bold everyday attitude.</p>
                        <div class="hsc-actions">
                            <a href="{{ route('shop') }}" class="hsc-btn hsc-btn-primary">Explore</a>
                            <a href="{{ route('shop') }}" class="hsc-btn hsc-btn-ghost">View All</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SLIDE 3 --}}
            <div class="swiper-slide">
                <div class="hero-slide-inner">
                    <img src="{{ asset('assets/images/banners/Banner2.webp') }}"
                         alt="Premium Hustler T-shirts" class="hero-slide-img" loading="lazy">
                    <div class="hero-slide-overlay"></div>
                    <div class="hero-slide-content">
                        <span class="hsc-tag">Exclusive Drop</span>
                        <h1 class="hsc-title">DEFINE YOUR<br>LEGACY</h1>
                        <p class="hsc-sub">Limited drops. Strong fits. Get yours before it's gone.</p>
                        <div class="hsc-actions">
                            <a href="{{ route('shop') }}" class="hsc-btn hsc-btn-primary">Shop Drop</a>
                            <a href="{{ route('shop') }}" class="hsc-btn hsc-btn-ghost">View All</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Bottom Bar: dots only --}}
    <div class="hero-bottom-bar">
        <div class="hero-pagination"></div>
    </div>

</div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('assets/js/hero-banner.js') }}"></script>
@endpush
