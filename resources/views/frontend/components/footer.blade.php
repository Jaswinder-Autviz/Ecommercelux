<footer class="site-footer">
    <div class="footer-inner container">
        <div class="footer-grid">
            <div class="footer-col">
                <span class="footer-logo">HUSTLER</span>
                <p class="footer-tagline">Statement tees for everyday ambition.</p>
            </div>
            <div class="footer-col">
                <h4>Shop</h4>
                <ul>
                    <li><a href="{{ route('shop') }}">All Products</a></li>
                    <li><a href="{{ route('shop') }}">New Arrivals</a></li>
                    <li><a href="{{ route('shop') }}">Sale</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Help</h4>
                <ul>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Account</h4>
                <ul>
                    <li><a href="{{ route('account') }}">My Account</a></li>
                    <li><a href="{{ route('wishlist') }}">Wishlist</a></li>
                    <li><a href="{{ route('cart') }}">Cart</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Hustler. All rights reserved.</p>
        </div>
    </div>
</footer>
