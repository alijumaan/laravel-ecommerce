<?php

use App\Http\Controllers\Frontend\Auth\ForgotPasswordController;
use App\Http\Controllers\Frontend\Auth\LoginController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Frontend\Auth\ResetPasswordController;
use App\Http\Controllers\Frontend\Auth\VerificationController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\FavoriteController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\UserController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

if (App::environment('production')) {
    URL::forceScheme('https');
}

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'verified'], function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/edit-info', [UserController::class, 'edit_info'])->name('frontend.users.edit');
    Route::post('/edit-info', [UserController::class, 'update_info'])->name('users.update_info');
    Route::post('/edit-password', [UserController::class, 'update_password'])->name('users.update_password');

    /***** FAVORITE *****/
    Route::post('/products/{id}/favorite', [FavoriteController::class, 'store']);
    Route::post('/products/{id}/unFavorite', [FavoriteController::class, 'destroy']);
    Route::get('/user-fav', [FavoriteController::class, 'index'])->name('userFav');

    /***** USERS REVIEWS *****/
    Route::get('/reviews', [UserController::class, 'show_reviews'])->name('users.reviews');
});

/***** ROUTE CATEGORY - ARCHIVE(SIDEBAR SECTIONS) *****/
Route::get('/category/{category_slug}', [HomeController::class, 'category'])->name('category.product');
Route::get('/archive/{date}', [HomeController::class, 'archive'])->name('archive.product');

/***** SEARCH *****/
Route::get('/search', [HomeController::class, 'search'])->name('search');

/***** TAGS *****/
Route::get('/tag/{tag_slug}', [ProductController::class, 'tag'])->name('tag.products');

/***** PRODUCTS *****/
Route::post('products/{product}', [ProductController::class, 'storeReview'])->name('products.add_review');
Route::post('products/{product}/rate', [ProductController::class, 'rate'])->name('products.rate');
Route::resource('products', ProductController::class)->names('frontend.products');

/***** CONTACTS *****/
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/***** CART *****/
Route::get('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.coupon');
Route::get('/add-to-cart/{product}', [CartController::class, 'aadToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/destroy/{product}', [CartController::class, 'destroy'])->name('cart.destroy');

/***** CHECKOUT *****/
Route::get('/cart/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/cart/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

/*****  TAP GATEWAY****/
Route::get('/cart/charge-request', [OrderController::class, 'chargeRequest'])->name('checkout.charge_request');
Route::get('/cart/charge-update', [OrderController::class, 'chargeUpdate'])->name('checkout.charge_update');

/***** AUTHENTICATION ROUTES *****/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('frontend.login.form');
Route::post('/login', [LoginController::class, 'login'])->name('frontend.login');

/***** LOGIN BY SOCIAL MEDIA [ FACEBOOK - TWITTER - GOOGLE ] *****/
Route::get('login/{provider}', [LoginController::class, 'redirectToProvider'])->name('frontend.social_login');
Route::get('login/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('frontend.social_login_callback');

Route::post('/logout', [LoginController::class, 'logout'])->name('frontend.logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('frontend.register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('frontend.register');
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');


