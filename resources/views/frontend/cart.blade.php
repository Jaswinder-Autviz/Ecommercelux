@extends('frontend.layouts.app')

@section('title', 'Shopping Cart - LuxeStore')

@section('content')
<div class="cart-page">
    
    <section style="padding: 60px 0; min-height: 60vh;">
        <div class="container" style="max-width: 1000px;">
            <h1 style="font-size: 42px; font-weight: 300; margin-bottom: 40px; text-align: center;">Shopping Cart</h1>
            
            <div style="text-align: center; padding: 60px 20px; color: #666;">
                <svg width="64" height="64" viewBox="0 0 20 20" fill="none" style="margin: 0 auto 20px; opacity: 0.3;"><path d="M2 2h2l2.5 10h9l2-7H6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><circle cx="8.5" cy="16.5" r="1.5" fill="currentColor"/><circle cx="14.5" cy="16.5" r="1.5" fill="currentColor"/></svg>
                <p style="font-size: 18px; margin-bottom: 30px;">Your cart is empty</p>
                <a href="{{ route('shop') }}" style="display: inline-block; background: #1a1a1a; color: white; padding: 14px 40px; text-decoration: none; font-weight: 600;">Continue Shopping</a>
            </div>
        </div>
    </section>

</div>
@endsection
