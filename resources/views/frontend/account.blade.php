@extends('frontend.layouts.app')

@section('title', 'My Account - Hustler')

@section('content')
<div class="account-page">
    
    <section style="padding: 60px 0;">
        <div class="container" style="max-width: 1000px;">
            <h1 style="font-size: 42px; font-weight: 300; margin-bottom: 40px; text-align: center;">My Account</h1>
            
            <div style="display: grid; grid-template-columns: 250px 1fr; gap: 60px;">
                
                <div>
                    <nav style="display: flex; flex-direction: column; gap: 4px;">
                        <a href="#" style="padding: 12px 20px; text-decoration: none; color: #1a1a1a; background: #f8f8f8; font-weight: 600;">Dashboard</a>
                        <a href="#" style="padding: 12px 20px; text-decoration: none; color: #666;">Orders</a>
                        <a href="#" style="padding: 12px 20px; text-decoration: none; color: #666;">Addresses</a>
                        <a href="#" style="padding: 12px 20px; text-decoration: none; color: #666;">Account Details</a>
                        <a href="#" style="padding: 12px 20px; text-decoration: none; color: #666;">Logout</a>
                    </nav>
                </div>

                <div>
                    <h2 style="font-size: 24px; font-weight: 400; margin-bottom: 30px;">Welcome back!</h2>
                    <p style="color: #666; line-height: 1.8;">From your account dashboard you can view your recent orders, manage your shipping and billing addresses, and edit your password and account details.</p>
                </div>

            </div>
        </div>
    </section>

</div>
@endsection
