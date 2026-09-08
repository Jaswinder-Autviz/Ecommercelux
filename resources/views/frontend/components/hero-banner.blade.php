@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/hero-banner.css') }}">
@endpush

<div class="container p-0">
<div class="hero-banner" aria-label="Featured wall art collection">
    <div class="hero-slide-inner">
        <img src="{{ asset('assets/images/banners/Banner_1.png') }}"
             alt="Premium Wall Poster Collection" class="hero-slide-img" loading="eager" fetchpriority="high">
        <!-- <div class="hero-slide-overlay absolute inset-0 z-10"></div> -->
        <div class="hero-slide-content z-20">
            <span class="hsc-tag slide-animate">New Collection</span>
            <h1 class="hsc-title slide-animate"><span class="hsc-title-inner">ART THAT<br>SPEAKS</span></h1>
            <p class="hsc-sub slide-animate"><span class="hsc-sub-inner">Premium wall posters crafted for spaces that demand attention.</span></p>
            <div class="hsc-actions slide-animate">
                <a href="{{ route('shop') }}" class="hsc-btn hsc-btn-primary">Shop Posters</a>
                <a href="{{ route('shop') }}" class="hsc-btn hsc-btn-ghost">View All</a>
            </div>
        </div>
    </div>
</div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Trigger animations on load
    setTimeout(() => {
        document.querySelectorAll('.slide-animate').forEach(el => {
            el.classList.add('slide-animate');
        });
    }, 100);
});
</script>
@endpush
