@extends('frontend.layouts.app')

@section('title', 'Shop - Hustler')

@section('content')
<div class="shop-page">
    
    <section style="padding: 60px 0;">
        <div class="container">
            <h1 style="font-size: 42px; font-weight: 300; margin-bottom: 40px; text-align: center;">Shop All</h1>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 40px;">
                @for ($i = 1; $i <= 12; $i++)
                <div style="text-align: center;">
                    <a href="{{ route('product', $i) }}" style="text-decoration: none; color: inherit;">
                        <div style="background: #f8f8f8; aspect-ratio: 3/4; margin-bottom: 20px;"></div>
                        <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 8px;">Product {{ $i }}</h3>
                        <p style="color: #666; font-size: 15px;">${{ 89 + $i * 15 }}</p>
                    </a>
                </div>
                @endfor
            </div>
        </div>
    </section>

</div>
@endsection
