<section class="choose-section">
        <div class="container p-0">
        <div class="choose-title reveal">
           <h2>SHOP THE VIBE</h2>
           <p>Pick your lane: oversized comfort, loud graphics, or clean everyday staples.</p>
         </div>
        <div class="choose-grid">
            <a href="{{ route('shop') }}" class="choose-item reveal-left">
                <div class="choose-image">
                    <img src="{{ asset('assets/images/choose/choose1.png') }}" alt="Oversized Hustler tees">
                </div>
                <!-- <div class="choose-caption">
                    <span>Oversized</span>
                    <strong>Relaxed fits for daily movement</strong>
                </div> -->
         
            </a>
            <a href="{{ route('shop') }}" class="choose-item reveal" style="transition-delay:0.1s">
                <div class="choose-image">
                    <img src="{{ asset('assets/images/choose/choose2.png') }}" alt="Graphic Hustler tees">
                </div>
                <!-- <div class="choose-caption">
                    <span>Graphic</span>
                    <strong>Bold prints with street energy</strong>
                </div> -->
            </a>
            <a href="{{ route('shop') }}" class="choose-item reveal-right">
                <div class="choose-image">
                    <img src="{{ asset('assets/images/choose/choose3.png') }}" alt="Everyday Hustler basics">
                </div>
                <!-- <div class="choose-caption">
                    <span>Essentials</span>
                    <strong>Clean staples made to repeat</strong>
                </div> -->
            </a>
        </div>
    </div>
</section>

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/choose.css') }}">
@endpush
