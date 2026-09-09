<footer class="site-footer">
    {{-- Newsletter Bar --}}
    <div class="footer-newsletter">
        <div class="container">
            <div class="newsletter-inner">
                <div class="newsletter-text">
                    <h3>JOIN THE INNER CIRCLE</h3>
                    <p>Get early access to drops and exclusive offers.</p>
                </div>
                <form class="newsletter-form">
                    <input type="email" placeholder="Enter your email address" required>
                    <button type="submit">SUBSCRIBE</button>
                </form>
            </div>
        </div>
    </div>

    <div class="footer-inner container">
        <div class="footer-grid">

            {{-- Brand --}}
            <div class="footer-col footer-brand-col">
                <div class="footer-logo">HUSTLER<span>.</span></div>
                <p class="footer-tagline">Curating premium archival wall posters for spaces that demand attention. Museum-grade quality, global shipping.</p>
                <div class="footer-social">
                    <a href="#" aria-label="Instagram" class="footer-social-link">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" aria-label="Facebook" class="footer-social-link">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" aria-label="Pinterest" class="footer-social-link">
                        <i class="fab fa-pinterest-p"></i>
                    </a>
                    <a href="#" aria-label="Twitter" class="footer-social-link">
                        <i class="fab fa-x-twitter"></i>
                    </a>
                </div>
            </div>

            {{-- Shop --}}
            <div class="footer-col">
                <h4 class="footer-title">Collections</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('shop') }}">Best Sellers</a></li>
                    <li><a href="{{ route('shop') }}">New Arrivals</a></li>
                    <li><a href="{{ route('shop') }}">Limited Editions</a></li>
                    @foreach(\App\Models\Category::where('status', true)->take(3)->get() as $cat)
                    <li><a href="{{ route('shop') }}?category={{ $cat->slug ?? strtolower($cat->name) }}">{{ $cat->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Support --}}
            <div class="footer-col">
                <h4 class="footer-title">Support</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    <li><a href="#">Track Order</a></li>
                    <li><a href="#">Shipping Policy</a></li>
                    <li><a href="#">Returns & Refunds</a></li>
                    <li><a href="{{ route('affiliate.register') }}">Affiliate Program</a></li>
                </ul>
            </div>

            {{-- Legal --}}
            <div class="footer-col">
                <h4 class="footer-title">Explore</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('about') }}">Our Story</a></li>
                    <li><a href="#">Sustainability</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="{{ route('wishlist') }}">Wishlist</a></li>
                </ul>
            </div>

        </div>

        <div class="footer-bottom">
            <div class="footer-bottom-inner">
                <div class="copyright">
                    &copy; {{ date('Y') }} <span>HUSTLER POSTERS</span>. ALL RIGHTS RESERVED.
                </div>
                <div class="payment-methods">
                    <i class="fab fa-cc-visa"></i>
                    <i class="fab fa-cc-mastercard"></i>
                    <i class="fab fa-cc-apple-pay"></i>
                    <i class="fab fa-cc-paypal"></i>
                </div>
            </div>
        </div>
    </div>
</footer>
