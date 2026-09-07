<!-- <section class="choose-section">
    <div class="container p-0">
        <div class="choose-title reveal">
            <h2>SHOP BY STYLE</h2>
            <p>From bold abstract art to calm minimalist prints — find the perfect poster for every room.</p>
        </div>
        <div class="choose-grid">
            <a href="{{ route('shop') }}" class="choose-item reveal-left">
                <div class="choose-image">
                    <img src="{{ asset('assets/images/choose/choose1.png') }}" alt="Abstract wall posters">
                </div>
            </a>
            <a href="{{ route('shop') }}" class="choose-item reveal" style="transition-delay:0.1s">
                <div class="choose-image">
                    <img src="{{ asset('assets/images/choose/choose2.png') }}" alt="Minimalist wall art">
                </div>
            </a>
            <a href="{{ route('shop') }}" class="choose-item reveal-right">
                <div class="choose-image">
                    <img src="{{ asset('assets/images/choose/choose3.png') }}" alt="Motivational posters">
                </div>
            </a>
        </div>
    </div>
</section> -->

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/choose.css') }}">
@endpush
