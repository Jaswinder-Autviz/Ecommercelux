@extends('frontend.layouts.app')

@section('title', 'Shopping Bag - Hustler')

@section('content')
<div class="cart-page-wrapper">
    <div class="container">
        <!-- Steps Bar -->
        <div class="checkout-steps">
            <div class="step active">BAG</div>
            <div class="step-line"></div>
            <div class="step">ADDRESS</div>
            <div class="step-line"></div>
            <div class="step">PAYMENT</div>
        </div>

        <div class="cart-main-layout">
            <!-- Left: Cart Items -->
            <div class="cart-left">
                <div class="cart-header">
                    <div class="ch-select-all">
                        <i class="fas fa-layer-group" style="color:#111;margin-right:4px;"></i>
                        <span id="selected-count-text">0 BUNDLES SELECTED</span>
                    </div>
                    <div class="ch-actions">
                        <button id="remove-selected"><i class="fas fa-trash-alt"></i> CLEAR ALL</button>
                    </div>
                </div>

                <div id="cart-items-container">
                    <!-- Dynamic items will be injected here via JS -->
                    <div class="cart-empty-state" style="display: none;">
                        <img src="{{ asset('assets/images/empty-cart.png') }}" alt="Empty Cart">
                        <h3>Hey, it feels so light!</h3>
                        <p>There is nothing in your bag. Let's add some items.</p>
                        <a href="{{ route('shop') }}" class="shop-now-btn">SHOP NOW</a>
                    </div>
                </div>
            </div>

            <!-- Right: Summary -->
            <div class="cart-right">
                @include('frontend.components.cart-summary')
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/cart.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/cart-summary.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/js/cart-summary.js') }}"></script>
@endpush
