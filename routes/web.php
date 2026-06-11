<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Admin\AffiliateController;
use App\Http\Controllers\Frontend\AffiliateAuthController;
use App\Http\Controllers\Frontend\AffiliateCouponController;

// ─── Frontend Routes ───────────────────────────────────────────────────────────

Route::get('/', function () {
    $reels = \App\Models\InstagramReel::where('status', true)->orderBy('sort_order')->get();
    return view('frontend.home', compact('reels'));
})->name('home');

// Shop Routes
Route::get('/shop', [ProductController::class, 'index'])->name('shop');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/cart', function () {
    return view('frontend.cart.index');
})->name('cart');

Route::get('/checkout', function () {
    return view('frontend.checkout');
})->name('checkout');

Route::post('/coupon/apply', [AffiliateCouponController::class, 'apply'])->name('coupon.apply');

Route::get('/affiliate/register', [AffiliateAuthController::class, 'showRegister'])->name('affiliate.register');
Route::post('/affiliate/register', [AffiliateAuthController::class, 'register'])->name('affiliate.register.post');
Route::get('/affiliate/login', [AffiliateAuthController::class, 'showLogin'])->name('affiliate.login');
Route::post('/affiliate/login', [AffiliateAuthController::class, 'login'])->name('affiliate.login.post');
Route::post('/affiliate/logout', [AffiliateAuthController::class, 'logout'])->name('affiliate.logout');
Route::middleware('affiliate.auth')->group(function () {
    Route::get('/affiliate/dashboard', [AffiliateAuthController::class, 'dashboard'])->name('affiliate.dashboard');
});

// Payment Routes
Route::post('/payment/create-order', [\App\Http\Controllers\Frontend\PaymentController::class, 'createOrder'])->name('payment.create');
Route::post('/payment/verify', [\App\Http\Controllers\Frontend\PaymentController::class, 'verifyPayment'])->name('payment.verify');
Route::post('/payment/submit-order', [\App\Http\Controllers\Frontend\PaymentController::class, 'submitOrder'])->name('payment.submit');
Route::get('/payment/success', function () {
    return view('frontend.payment-success');
})->name('payment.success');

Route::get('/wishlist', function () {
    return view('frontend.wishlist');
})->name('wishlist');

Route::get('/account', function () {
    return view('frontend.account');
})->name('account');

Route::get('/contact', function () {
    return view('frontend.contact');
})->name('contact');

Route::get('/about', function () {
    return view('frontend.about');
})->name('about');

// ─── Admin Routes ───────────────────────────────────────────────────────────

Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Login
    Route::get('/login', function () {
        return view('admin.auth.login');
    })->name('login');

    Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.post');

    // Protected Admin Routes
    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        
        // Products CRUD
        Route::delete('/products/gallery-images/{productImage}', [\App\Http\Controllers\Admin\ProductController::class, 'destroyGalleryImage'])->name('products.gallery-images.destroy');
        Route::delete('/products/{product}/main-image', [\App\Http\Controllers\Admin\ProductController::class, 'destroyMainImage'])->name('products.main-image.destroy');
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);

        // Categories CRUD
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);

        // Customers Management
        Route::resource('customers', \App\Http\Controllers\Admin\CustomerController::class)->only(['index', 'show', 'destroy']);

        // Affiliators
        Route::get('/affiliates', [AffiliateController::class, 'index'])->name('affiliates.index');
        Route::get('/affiliates/create', [AffiliateController::class, 'create'])->name('affiliates.create');
        Route::post('/affiliates', [AffiliateController::class, 'store'])->name('affiliates.store');
        Route::get('/affiliates/{affiliate}/edit', [AffiliateController::class, 'edit'])->name('affiliates.edit');
        Route::put('/affiliates/{affiliate}', [AffiliateController::class, 'update'])->name('affiliates.update');
        Route::delete('/affiliates/{affiliate}', [AffiliateController::class, 'destroy'])->name('affiliates.destroy');
        Route::post('/affiliates/{affiliate}/approve', [AffiliateController::class, 'approve'])->name('affiliates.approve');
        Route::post('/affiliates/{affiliate}/reject', [AffiliateController::class, 'reject'])->name('affiliates.reject');
        
        // Orders
        Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{id}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.status');

        // Instagram Reels
        Route::get('/reels', [\App\Http\Controllers\Admin\InstagramReelController::class, 'index'])->name('reels.index');
        Route::post('/reels', [\App\Http\Controllers\Admin\InstagramReelController::class, 'store'])->name('reels.store');
        Route::delete('/reels/{instagramReel}', [\App\Http\Controllers\Admin\InstagramReelController::class, 'destroy'])->name('reels.destroy');
    });
});

use App\Http\Controllers\Frontend\CustomerAuthController;
use App\Http\Controllers\Frontend\CustomerAccountController;

// Customer Auth Routes
Route::post('/customer/send-otp', [CustomerAuthController::class, 'sendOtp'])->name('customer.sendOtp');
Route::post('/customer/verify-otp', [CustomerAuthController::class, 'verifyOtp'])->name('customer.verifyOtp');
Route::post('/customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

// Protected Customer Routes
Route::middleware(['customer.auth'])->group(function () {
    Route::get('/my-account', [CustomerAccountController::class, 'index'])->name('customer.account');
    Route::get('/my-account/profile', [CustomerAccountController::class, 'profile'])->name('customer.profile');
    Route::post('/my-account/profile/update', [CustomerAccountController::class, 'updateProfile'])->name('customer.profile.update');
    Route::get('/my-account/addresses', [CustomerAccountController::class, 'addresses'])->name('customer.addresses');
    Route::post('/my-account/addresses/store', [CustomerAccountController::class, 'storeAddress'])->name('customer.addresses.store');
    Route::post('/my-account/addresses/{id}/update', [CustomerAccountController::class, 'updateAddress'])->name('customer.addresses.update');
    Route::get('/my-account/orders', [CustomerAccountController::class, 'orders'])->name('customer.orders');
});
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register.post');

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
