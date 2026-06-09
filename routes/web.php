<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\ProductController;

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
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);

        // Categories CRUD
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);

        // Customers Management
        Route::resource('customers', \App\Http\Controllers\Admin\CustomerController::class)->only(['index', 'show', 'destroy']);
        
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
