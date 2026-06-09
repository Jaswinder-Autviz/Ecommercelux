<section class="choose-section">
    <div class="container p-0">
        <div class="choose-title reveal">
           <h2>CHOOSE YOUR UNIVERSE</h2>
         </div>
        <div class="choose-grid">
            <div class="choose-item reveal-left">
                <div class="choose-image">
                    <img src="{{ asset('assets/images/choose/b2.jpeg') }}" alt="Choose 1">
                </div>
            </div>
            <div class="choose-item reveal" style="transition-delay:0.1s">
                <div class="choose-image">
                    <img src="{{ asset('assets/images/choose/b1.jpeg') }}" alt="Choose 2">
                </div>
            </div>
            <div class="choose-item reveal-right">
                <div class="choose-image">
                    <img src="{{ asset('assets/images/choose/b3.jpeg') }}" alt="Choose 3">
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/choose.css') }}">
@endpush
