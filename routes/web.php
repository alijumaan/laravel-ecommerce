<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\UserController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

if (App::environment('production')) {
    URL::forceScheme('https');
}

Auth::routes(['verify' => true]);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cart', [HomeController::class, 'cart'])->name('cart.index');
Route::get('/shop/{slug?}', [HomeController::class, 'shop'])->name('shop.index');
Route::get('/shop/tag/{slug}', [HomeController::class, 'shopTag'])->name('shop.tag');
Route::get('/wishlist', [HomeController::class, 'wishlist'])->name('wishlist.index');
Route::get('/product/{slug}', [HomeController::class, 'product'])->name('product.show');
Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'verified'], function () {
        Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
        Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
        Route::patch('/user/profile', [UserController::class, 'updateProfile'])->name('user.update_profile');
        Route::get('/user/profile/remove-image', [UserController::class, 'removeImage'])->name('user.remove_image');
        Route::get('/user/addresses', [UserController::class, 'addresses'])->name('user.addresses');
        Route::get('/user/orders', [UserController::class, 'orders'])->name('user.orders');
    });

    Route::group(['middleware' => 'checkCart'], function () {
        Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout.index');
        Route::post('/checkout/payment', [PaymentController::class, 'checkoutPayment'])->name('checkout.payment');
        Route::get('/checkout/{orderId}/cancelled', [PaymentController::class, 'cancelled'])->name('checkout.cancelled');
        Route::get('/checkout/{orderId}/completed', [PaymentController::class, 'completed'])->name('checkout.completed');
        Route::get('/checkout/webhook/{order?}/{env?}', [PaymentController::class, 'webhook'])->name('checkout.webhook.ipn');
        // tap gateway
        Route::get('/checkout/charge-request', [PaymentController::class, 'chargeRequest'])->name('checkout.charge_request');
        Route::get('/checkout/charge-update', [PaymentController::class, 'chargeUpdate'])->name('checkout.charge_update');
    });
});

// contacts
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// login by social media [ Facebook - Twitter - Google ]
Route::get('login/{provider}', [LoginController::class, 'redirectToProvider'])->name('social_login');
Route::get('login/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('social_login_callback');
