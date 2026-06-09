@extends('frontend.layouts.app')

@section('title', 'All Products - Hustler')

@section('content')
<section class="shop-page">
    <div class="container">
        <div class="shop-header">
            <h1 class="shop-title">ALL COLLECTIONS</h1>
        </div>
        <div class="shop-grid">
            @foreach($products as $product)
                @include('frontend.components.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/product-card.css') }}">
<style>
    .shop-page { padding: 60px 0; }
    .shop-header { margin-bottom: 40px; text-align: center; }
    .shop-title { font-size: 32px; font-weight: 700; letter-spacing: 1px; }
    .shop-grid { 
        display: grid; 
        grid-template-columns: repeat(4, 1fr); 
        gap: 30px; 
    }
    @media (max-width: 1024px) { .shop-grid { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 768px) { .shop-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 480px) { .shop-grid { grid-template-columns: 1fr; } }
</style>
@endpush
