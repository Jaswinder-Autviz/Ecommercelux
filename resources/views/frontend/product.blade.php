@extends('frontend.layouts.app')

@section('title', 'Product Details - LuxeStore')

@section('content')
<div class="product-page">
    
    <section style="padding: 60px 0;">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 80px; max-width: 1200px; margin: 0 auto;">
                
                <div>
                    <div style="background: #f8f8f8; aspect-ratio: 3/4; margin-bottom: 20px;"></div>
                </div>

                <div>
                    <h1 style="font-size: 32px; font-weight: 400; margin-bottom: 16px;">Premium Product</h1>
                    <p style="font-size: 24px; color: #666; margin-bottom: 30px;">$149.00</p>
                    
                    <p style="line-height: 1.8; color: #666; margin-bottom: 40px;">
                        Crafted with premium materials and attention to detail. This piece combines modern design with timeless elegance.
                    </p>

                    <div style="margin-bottom: 30px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 12px;">Size</label>
                        <div style="display: flex; gap: 12px;">
                            <button style="padding: 12px 24px; border: 1px solid #e5e5e5; background: white; cursor: pointer;">S</button>
                            <button style="padding: 12px 24px; border: 1px solid #e5e5e5; background: white; cursor: pointer;">M</button>
                            <button style="padding: 12px 24px; border: 1px solid #e5e5e5; background: white; cursor: pointer;">L</button>
                            <button style="padding: 12px 24px; border: 1px solid #e5e5e5; background: white; cursor: pointer;">XL</button>
                        </div>
                    </div>

                    <button style="width: 100%; padding: 18px; background: #1a1a1a; color: white; border: none; font-size: 15px; font-weight: 600; letter-spacing: 0.5px; cursor: pointer; margin-bottom: 16px;">Add to Cart</button>
                    <button style="width: 100%; padding: 18px; background: white; color: #1a1a1a; border: 1px solid #e5e5e5; font-size: 15px; font-weight: 600; letter-spacing: 0.5px; cursor: pointer;">Add to Wishlist</button>
                </div>

            </div>
        </div>
    </section>

</div>
@endsection
