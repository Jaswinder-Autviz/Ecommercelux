@extends('frontend.layouts.app')
@section('title', 'Order Confirmed - LuxeStore')
@section('content')
<div style="min-height:70vh;display:flex;align-items:center;justify-content:center;padding:60px 20px;background:#fafafa">
    <div style="text-align:center;max-width:480px">
        <div style="width:80px;height:80px;background:#e8f5e9;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 24px">
            <i class="fas fa-check" style="font-size:32px;color:#2e7d32"></i>
        </div>
        <h1 style="font-size:26px;font-weight:900;letter-spacing:1px;color:#292b2c;margin-bottom:12px">ORDER CONFIRMED!</h1>
        <p style="font-size:15px;color:#666;margin-bottom:8px">Thank you for your purchase.</p>
        @if(request('payment_id'))
            <p style="font-size:12px;color:#aaa;margin-bottom:32px">Payment ID: {{ request('payment_id') }}</p>
        @elseif(request('method') === 'cod')
            <p style="font-size:13px;color:#666;margin-bottom:32px">You chose Cash on Delivery. Pay when your order arrives.</p>
        @endif
        <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
            <a href="{{ route('shop') }}" style="display:inline-block;padding:14px 32px;background:#292b2c;color:#fff;font-size:12px;font-weight:700;letter-spacing:2px;text-transform:uppercase;text-decoration:none">Continue Shopping</a>
            <a href="{{ route('home') }}" style="display:inline-block;padding:14px 32px;border:1.5px solid #292b2c;color:#292b2c;font-size:12px;font-weight:700;letter-spacing:2px;text-transform:uppercase;text-decoration:none">Go Home</a>
        </div>
    </div>
</div>
@endsection
