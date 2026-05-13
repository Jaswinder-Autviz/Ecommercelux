@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/hero-banner.css') }}">
@endpush

<section class="hero-banner" aria-label="Featured collection banner">

    <div class="swiper hero-swiper">
        <div class="swiper-wrapper">

            {{-- SLIDE 1 --}}
            <div class="swiper-slide">
                <div class="hero-slide-inner">
                    <img src="https://images.unsplash.com/photo-1580813089103-119575a0a880?q=80&w=1631&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                         alt="Sneaker Collection" class="hero-slide-img" loading="eager" fetchpriority="high">
                    <div class="hero-slide-overlay"></div>
                    <div class="hero-slide-content">
                        <span class="hsc-tag">New Season 2025</span>
                        <h1 class="hsc-title">STEP INTO<br>THE FUTURE</h1>
                        <p class="hsc-sub">Premium sneakers crafted for those who dare to stand out.</p>
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
                    <img src="https://images.unsplash.com/photo-1581343600721-f4ea1318ec57?q=80&w=1062&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                         alt="Street Sneakers" class="hero-slide-img" loading="lazy">
                    <div class="hero-slide-overlay"></div>
                    <div class="hero-slide-content">
                        <span class="hsc-tag">Street Culture</span>
                        <h1 class="hsc-title">BORN ON<br>THE STREETS</h1>
                        <p class="hsc-sub">Where style meets the pavement. Raw. Bold. Unapologetic.</p>
                        <div class="hsc-actions">
                            <a href="{{ route('shop', ['category' => 'sneakers']) }}" class="hsc-btn hsc-btn-primary">Explore</a>
                            <a href="{{ route('shop') }}" class="hsc-btn hsc-btn-ghost">View All</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SLIDE 3 --}}
            <div class="swiper-slide">
                <div class="hero-slide-inner">
                    <img src="https://images.unsplash.com/photo-1552346154-21d32810aba3?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                         alt="Premium Sneakers" class="hero-slide-img" loading="lazy">
                    <div class="hero-slide-overlay"></div>
                    <div class="hero-slide-content">
                        <span class="hsc-tag">Exclusive Drop</span>
                        <h1 class="hsc-title">DEFINE YOUR<br>LEGACY</h1>
                        <p class="hsc-sub">Limited edition. Unlimited expression. Get yours before it's gone.</p>
                        <div class="hsc-actions">
                            <a href="{{ route('shop') }}" class="hsc-btn hsc-btn-primary">Shop Drop</a>
                            <a href="{{ route('shop') }}" class="hsc-btn hsc-btn-ghost">View All</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Navigation --}}
    <button class="hero-nav hero-nav-prev" aria-label="Previous slide">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M15 18l-6-6 6-6"/></svg>
    </button>
    <button class="hero-nav hero-nav-next" aria-label="Next slide">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 18l6-6-6-6"/></svg>
    </button>

    {{-- Bottom Bar: progress + bullets only --}}
    <div class="hero-bottom-bar">
        <div class="hero-progress-wrap">
            <div class="hero-progress-bar"></div>
        </div>
        <div class="hero-pagination"></div>
    </div>

</section>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('assets/js/hero-banner.js') }}"></script>
@endpush
