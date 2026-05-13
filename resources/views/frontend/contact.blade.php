@extends('frontend.layouts.app')

@section('title', 'Contact Us - LuxeStore')

@section('content')
<div class="contact-page">
    
    <section style="padding: 60px 0;">
        <div class="container" style="max-width: 800px;">
            <h1 style="font-size: 42px; font-weight: 300; margin-bottom: 20px; text-align: center;">Get in Touch</h1>
            <p style="text-align: center; color: #666; margin-bottom: 50px; font-size: 17px;">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
            
            <form style="display: flex; flex-direction: column; gap: 24px;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                    <input type="text" placeholder="First Name" style="padding: 16px; border: 1px solid #e5e5e5; font-size: 15px;">
                    <input type="text" placeholder="Last Name" style="padding: 16px; border: 1px solid #e5e5e5; font-size: 15px;">
                </div>
                <input type="email" placeholder="Email Address" style="padding: 16px; border: 1px solid #e5e5e5; font-size: 15px;">
                <input type="text" placeholder="Subject" style="padding: 16px; border: 1px solid #e5e5e5; font-size: 15px;">
                <textarea placeholder="Your Message" rows="6" style="padding: 16px; border: 1px solid #e5e5e5; font-size: 15px; font-family: 'Montserrat', sans-serif; resize: vertical;"></textarea>
                <button type="submit" style="padding: 18px; background: #1a1a1a; color: white; border: none; font-size: 15px; font-weight: 600; letter-spacing: 0.5px; cursor: pointer;">Send Message</button>
            </form>
        </div>
    </section>

</div>
@endsection
