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
                    <img src="{{ asset('assets/images/banners/Banner_2.png') }}"
                         alt="Streetwear T-shirts" class="hero-slide-img" loading="lazy">
                    <div class="hero-slide-overlay bg-black/40 absolute inset-0 z-10"></div>
                    <div class="hero-slide-content z-20">
                        <span class="hsc-tag">Street Culture</span>
                        <h1 class="hsc-title"><span class="hsc-title-inner">BORN ON<br>THE STREETS</span></h1>
                        <p class="hsc-sub"><span class="hsc-sub-inner">Street-ready staples with bold everyday attitude.</span></p>
                        <div class="hsc-actions">
                            <a href="{{ route('shop') }}" class="hsc-btn hsc-btn-primary">Explore</a>
                            <a href="{{ route('shop') }}" class="hsc-btn hsc-btn-ghost">View All</a>
                        </div>
                    </div>
                </div>
            </div>

            
            {{-- SLIDE 2 --}}
          <div class="swiper-slide">
                <div class="hero-slide-inner">
                    <img src="{{ asset('assets/images/banners/Banner_1.png') }}"
                         alt="Hustler T-shirt Collection" class="hero-slide-img" loading="eager" fetchpriority="high">
                    <div class="hero-slide-overlay bg-black/40 absolute inset-0 z-10"></div>
                    <div class="hero-slide-content z-20">
                        <span class="hsc-tag">New Season</span>
                        <h1 class="hsc-title"><span class="hsc-title-inner">HUSTLER<br>TEES</span></h1>
                        <p class="hsc-sub"><span class="hsc-sub-inner">Premium t-shirts made for people who keep moving.</span></p>
                        <div class="hsc-actions">
                            <a href="{{ route('shop') }}" class="hsc-btn hsc-btn-primary">Shop Now</a>
                            <a href="{{ route('shop') }}" class="hsc-btn hsc-btn-ghost">View All</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SLIDE 3 --}}
            <div class="swiper-slide">
                <div class="hero-slide-inner">
                    <img src="{{ asset('assets/images/banners/Banner_3.png') }}"
                         alt="Premium Hustler T-shirts" class="hero-slide-img" loading="lazy">
                    <div class="hero-slide-overlay bg-black/40 absolute inset-0 z-10"></div>
                    <div class="hero-slide-content z-20">
                        <span class="hsc-tag">Exclusive Drop</span>
                        <h1 class="hsc-title"><span class="hsc-title-inner">DEFINE YOUR<br>LEGACY</span></h1>
                        <p class="hsc-sub"><span class="hsc-sub-inner">Limited drops. Strong fits. Get yours before it's gone.</span></p>
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
