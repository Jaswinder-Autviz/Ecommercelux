@extends('frontend.layouts.app')

@section('title', 'About Us - Hustler')

@section('content')
<div class="about-page">
    
    <section style="padding: 80px 0;">
        <div class="container" style="max-width: 900px;">
            <h1 style="font-size: 48px; font-weight: 300; margin-bottom: 30px; text-align: center; letter-spacing: -1px;">About Hustler</h1>
            
            <div style="text-align: center; margin-bottom: 60px;">
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 300px; margin-bottom: 40px; border-radius: 4px;"></div>
            </div>

            <div style="color: #666; line-height: 1.9; font-size: 17px;">
                <p style="margin-bottom: 24px;">
                    Founded with a passion for bold design and everyday comfort, Hustler curates premium t-shirts for people who move with purpose.
                </p>
                
                <p style="margin-bottom: 24px;">
                    We believe in the power of thoughtful design and sustainable practices. Each piece in our collection is carefully selected to ensure it meets our high standards of quality, style, and ethical production.
                </p>

                <p style="margin-bottom: 24px;">
                    Our mission is to provide you with fashion that not only looks good but feels good—pieces that you'll treasure for years to come.
                </p>

                <div style="margin-top: 60px; padding: 40px; background: #f8f8f8; border-radius: 4px; text-align: center;">
                    <h2 style="font-size: 24px; font-weight: 600; margin-bottom: 16px; color: #1a1a1a;">Our Values</h2>
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 40px; margin-top: 30px;">
                        <div>
                            <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 8px; color: #1a1a1a;">Quality</h3>
                            <p style="font-size: 14px;">Premium materials and craftsmanship</p>
                        </div>
                        <div>
                            <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 8px; color: #1a1a1a;">Sustainability</h3>
                            <p style="font-size: 14px;">Ethical and eco-conscious practices</p>
                        </div>
                        <div>
                            <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 8px; color: #1a1a1a;">Timeless</h3>
                            <p style="font-size: 14px;">Designs that transcend trends</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
