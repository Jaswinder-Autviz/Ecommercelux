<footer class="site-footer">
    <div class="footer-inner container">
        <div class="footer-grid">

            {{-- Brand --}}
            <div class="footer-col footer-brand-col">
                <span class="footer-logo">HUSTLER</span>
                <p class="footer-tagline">Premium wall posters for spaces that demand attention. Museum-grade prints, exclusive designs.</p>
                <div class="footer-social">
                    <a href="#" aria-label="Instagram" class="footer-social-link">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="5"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>
                    </a>
                    <a href="#" aria-label="Facebook" class="footer-social-link">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                    </a>
                    <a href="#" aria-label="Pinterest" class="footer-social-link">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 2C6.48 2 2 6.48 2 12c0 4.24 2.65 7.86 6.39 9.29-.09-.78-.17-1.98.04-2.83.18-.77 1.22-5.17 1.22-5.17s-.31-.62-.31-1.54c0-1.45.84-2.53 1.88-2.53.89 0 1.32.67 1.32 1.47 0 .9-.57 2.24-.87 3.48-.25 1.04.52 1.88 1.54 1.88 1.85 0 3.09-2.37 3.09-5.17 0-2.14-1.44-3.64-3.5-3.64-2.38 0-3.78 1.79-3.78 3.63 0 .72.28 1.49.62 1.91.07.08.08.15.06.23-.06.26-.2.82-.23.94-.04.15-.13.18-.3.11-1.12-.52-1.82-2.17-1.82-3.49 0-2.84 2.06-5.44 5.94-5.44 3.12 0 5.55 2.22 5.55 5.19 0 3.1-1.95 5.59-4.66 5.59-.91 0-1.77-.47-2.06-1.03l-.56 2.09c-.2.78-.75 1.76-1.12 2.35.84.26 1.74.4 2.67.4 5.52 0 10-4.48 10-10S17.52 2 12 2z"/></svg>
                    </a>
                </div>
            </div>

            {{-- Shop --}}
            <div class="footer-col">
                <h4>Shop</h4>
                <ul>
                    <li><a href="{{ route('shop') }}">All Posters</a></li>
                    <li><a href="{{ route('shop') }}">New Arrivals</a></li>
                    <li><a href="{{ route('shop') }}">Best Sellers</a></li>
                    @foreach(\App\Models\Category::where('status', true)->take(4)->get() as $cat)
                    <li><a href="{{ route('shop') }}?category={{ $cat->slug ?? strtolower($cat->name) }}">{{ $cat->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Help --}}
            <div class="footer-col">
                <h4>Help</h4>
                <ul>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    <li><a href="#">Shipping Info</a></li>
                    <li><a href="#">Returns & Refunds</a></li>
                    <li><a href="#">FAQs</a></li>
                    <li><a href="{{ route('affiliate.register') }}">Affiliate Program</a></li>
                </ul>
            </div>

            {{-- Company --}}
            <div class="footer-col">
                <h4>Company</h4>
                <ul>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="{{ route('customer.account') }}">My Account</a></li>
                    <li><a href="{{ route('wishlist') }}">Wishlist</a></li>
                </ul>
            </div>

        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Hustler Posters. All rights reserved. Premium Wall Art.</p>
        </div>
    </div>
</footer>
