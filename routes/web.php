<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend;
use App\Http\Controllers\Backend;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

if (App::environment('production')) {
    URL::forceScheme('https');
}

Auth::routes(['verify' => true]);

Route::get('/', [Frontend\HomeController::class, 'index'])->name('home');
Route::get('/cart', [Frontend\HomeController::class, 'cart'])->name('cart.index');
Route::get('/shop/{slug?}', [Frontend\HomeController::class, 'shop'])->name('shop.index');
Route::get('/shop/tag/{slug}', [Frontend\HomeController::class, 'shopTag'])->name('shop.tag');
Route::get('/wishlist', [Frontend\HomeController::class, 'wishlist'])->name('wishlist.index');
Route::get('/product/{slug}', [Frontend\HomeController::class, 'product'])->name('product.show');
Route::post('/product/review', [Frontend\HomeController::class, 'storeReview'])->name('review.store');
//Route::post('product/{slug}/rate', [Frontend\HomeController::class, 'rate'])->name('products.rate');
Route::get('/search', [Frontend\HomeController::class, 'search'])->name('search');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'verified'], function () {
        Route::get('/user/dashboard', [Frontend\UserController::class, 'dashboard'])->name('user.dashboard');
        Route::get('/user/profile', [Frontend\UserController::class, 'profile'])->name('user.profile');
        Route::patch('/user/profile', [Frontend\UserController::class, 'updateProfile'])->name('user.update_profile');
        Route::get('/user/profile/remove-image', [Frontend\UserController::class, 'removeImage'])->name('user.remove_image');
        Route::get('/user/addresses', [Frontend\UserController::class, 'addresses'])->name('user.addresses');
        Route::get('/user/orders', [Frontend\UserController::class, 'orders'])->name('user.orders');
    });

    Route::group(['middleware' => 'checkCart'], function () {
        Route::get('/checkout', [Frontend\PaymentController::class, 'checkout'])->name('checkout.index');
        Route::post('/checkout/payment', [Frontend\PaymentController::class, 'checkoutPayment'])->name('checkout.payment');
        Route::get('/checkout/{orderId}/cancelled', [Frontend\PaymentController::class, 'cancelled'])->name('checkout.cancelled');
        Route::get('/checkout/{orderId}/completed', [Frontend\PaymentController::class, 'completed'])->name('checkout.completed');
        Route::get('/checkout/webhook/{order?}/{env?}', [Frontend\PaymentController::class, 'webhook'])->name('checkout.webhook.ipn');
    });

    // tap gateway ****/
//    Route::get('/cart/charge-request', [OrderController::class, 'chargeRequest'])->name('checkout.charge_request');
//    Route::get('/cart/charge-update', [OrderController::class, 'chargeUpdate'])->name('checkout.charge_update');
});

// contacts
Route::get('/contact', [Frontend\ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [Frontend\ContactController::class, 'store'])->name('contact.store');

// login by social media [ Facebook - Twitter - Google ]
Route::get('login/{provider}', [LoginController::class, 'redirectToProvider'])->name('social_login');
Route::get('login/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('social_login_callback');

// admin
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', [Backend\BackendController::class, 'login'])->name('login');
        Route::get('/forgot-password', [Backend\BackendController::class, 'forgot_password'])->name('forgot_password');
    });

    Route::group(['middleware' => ['roles']], function () {
        Route::get('/', [Backend\BackendController::class, 'index'])->name('index');
        Route::get('/account-settings', [Backend\BackendController::class, 'account_setting'])->name('account_setting');
        Route::patch('/account-settings', [Backend\BackendController::class, 'update_account_setting'])->name('account_setting.update');
        Route::get('/categories/{category}/remove-image', [Backend\CategoryController::class, 'removeImage'])->name('categories.remove_image');
        Route::resource('categories', Backend\CategoryController::class);
        Route::post('/products/remove-image', [Backend\ProductController::class, 'removeImage'])->name('products.remove_image');
        Route::resource('products', Backend\ProductController::class);
        Route::resource('tags', Backend\TagController::class);
        Route::resource('coupons', Backend\CouponController::class);
        Route::resource('reviews', Backend\ReviewController::class);
        Route::get('/supervisors/{supervisor}/remove-image', [Backend\SupervisorController::class, 'removeImage'])->name('supervisors.remove_image');
        Route::resource('supervisors', Backend\SupervisorController::class);
        Route::resource('countries', Backend\CountryController::class);
        Route::get('/states/get-states', [Backend\StateController::class, 'get_states'])->name('states.get_states');
        Route::resource('states', Backend\StateController::class);
        Route::get('/cities/get-cities', [Backend\CityController::class, 'get_cities'])->name('cities.get_cities');
        Route::resource('cities', Backend\CityController::class);
        Route::get('users/get-users', [Backend\UserController::class, 'get_users'])->name('users.get_users');
        Route::resource('users', Backend\UserController::class);
        Route::resource('user_addresses', Backend\UserAddressController::class);
        Route::resource('shipping_companies', Backend\ShippingCompanyController::class);
        Route::resource('payment_methods', Backend\PaymentMethodController::class);
        Route::resource('orders', Backend\OrderController::class)->except('create', 'edit');
    });
});

//Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
//    Route::get('/', [Backend_old\DashboardController::class, 'index'])->name('index');
//
//    Route::group(['middleware' => 'guest'], function () {
//        Route::get('/login', [Backend_old\DashboardController::class, 'login'])->name('login');
//        Route::get('/forgot-password', [Backend_old\DashboardController::class, 'forgot_password'])->name('forgot_password');
//    });
//
//    // PRODUCTS
//    Route::post('/products/remove-image/{mediaId}', [Backend_old\ProductController::class, 'removeImage'])->name('products.media.destroy');
//    Route::resource('products', Backend_old\ProductController::class)->names('products');
//
//    Route::resource('payment-methods', Backend_old\PaymentMethodController::class)->names('payment_methods');
//    Route::resource('user-addresses', Backend_old\UserAddressController::class)->names('user_addresses');
//    Route::resource('shipping-companies', Backend_old\ShippingCompanyController::class)->names('shipping_companies');
//    Route::resource('reviews', Backend_old\ReviewController::class)->names('reviews');
//
//    // CATEGORIES
//    Route::resource('categories', Backend_old\CategoryController::class)->names('categories');
//
//    // USERS
//    Route::post('/users/remove-image', [Backend_old\UserController::class, 'removeImage'])->name('users.remove-image');
//    Route::resource('users', Backend_old\UserController::class)->names('users');
//
//    // CONTACTS
//    Route::resource('contacts', Backend_old\ContactController::class)->names('contacts');
//
//    // TAGS
//    Route::resource('tags', Backend_old\TagController::class)->names('tags');
//
//    // SETTINGS
//    Route::resource('settings', Backend_old\SettingController::class)->names('settings')->only('index', 'update');
//
//    // ORDERS
//    Route::get('confirm/{id}', [Backend_old\OrderController::class, 'confirm'])->name('order.confirm');
//    Route::get('pending/{id}', [Backend_old\OrderController::class, 'pending'])->name('order.pending');
//    Route::resource('orders', Backend_old\OrderController::class)->names('orders')->only('index', 'show');
//
//    // COUPONS
//    Route::resource('coupons', Backend_old\CouponsController::class)->names('coupons');
//
//    Route::group(['middleware' => 'superAdmin'], function () {
//        /* Change Role By Ajax JavaScript */
//        Route::post('permissions/byRole', [Backend_old\PermissionController::class, 'getByRole'])->name('permission_byRole');
//        Route::resource('permissions', Backend_old\PermissionController::class);
//
//        // SUPERVISORS
//        Route::post('/supervisors/remove-image', [Backend_old\SupervisorController::class, 'removeImage'])->name('supervisors.remove-image');
//        Route::resource('supervisors', Backend_old\SupervisorController::class)->names('supervisors');
//    });
//
//    // Pages
//    Route::resource('pages', Backend_old\PageController::class);
//});
