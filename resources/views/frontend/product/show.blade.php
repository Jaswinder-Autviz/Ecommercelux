@extends('frontend.layouts.app')

@section('title', $product->name . ' - LuxeStore')

@section('content')
<div class="product-page">
    <div class="container">
        <div class="product-main-layout">
            <!-- Left: Gallery -->
            <div class="pml-left">
                @include('frontend.components.product-gallery', ['product' => $product])
            </div>

            <!-- Right: Info -->
            <div class="pml-right">
                @include('frontend.components.product-info', ['product' => $product])
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @include('frontend.components.related-products', ['relatedProducts' => $relatedProducts])
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/product-card.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/product-details.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/js/product-gallery.js') }}"></script>
<script src="{{ asset('assets/js/product-details.js') }}"></script>
@endpush
