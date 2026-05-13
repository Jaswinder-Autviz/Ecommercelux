<section class="choose-section">
    <div class="container">
        <div class="choose-title reveal">
           <h2>CHOOSE YOUR UNIVERSE</h2>
         </div>
        <div class="choose-grid">
            <div class="choose-item reveal-left">
                <div class="choose-image">
                    <img src="{{ asset('assets/images/choose/choose1.jpg') }}" alt="Choose 1">
                </div>
            </div>
            <div class="choose-item reveal" style="transition-delay:0.1s">
                <div class="choose-image">
                    <img src="{{ asset('assets/images/choose/choose2.jpg') }}" alt="Choose 2">
                </div>
            </div>
            <div class="choose-item reveal-right">
                <div class="choose-image">
                    <img src="{{ asset('assets/images/choose/choose3.jpg') }}" alt="Choose 3">
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/choose.css') }}">
@endpush
