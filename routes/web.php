<?php

use App\Http\Controllers\Front\Auth\LoginController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

if (App::environment('production')) {
    URL::forceScheme('https');
}


Route::group(['namespace' => 'Front'], function () {
    Route::get('/', 'IndexController@index')->name('home');

    /***** ROUTE CATEGORY - ARCHIVE(SIDEBAR SECTIONS) *****/
    Route::get('/category/{category_slug}', 'IndexController@category')->name('category.product');
    Route::get('/archive/{date}', 'IndexController@archive')->name('archive.product');

    /***** SEARCH *****/
    Route::get('/search', 'IndexController@search')->name('search');

    /***** TAGS *****/
    Route::get('/tag/{tag_slug}', 'ProductController@tag')->name('tag.products');
    /***** PRODUCTS *****/
    Route::post('products/{product}', 'ProductController@store_comment')->name('products.add_comment');
    Route::post('products/{product}/rate', 'ProductController@rate')->name('products.rate');
    Route::resource('products', 'ProductController', ['as' => 'front']);

    /***** CONTACTS *****/
    Route::get('/contact', 'ContactController@index')->name('contact.index');
    Route::post('/contact', 'ContactController@store')->name('contact.store');

    /***** CART *****/
    Route::get('/cart', 'CartController@index')->name('cart.index');
    Route::get('/cart/apply-coupon', 'CartController@applyCoupon')->name('cart.coupon');
    Route::get('/add-to-cart/{product}', 'CartController@add')->name('cart.add');
    Route::get('/destroy/{product}', 'CartController@destroy')->name('cart.destroy');

    /***** CHECKOUT *****/
    Route::get('/cart/checkout', 'CheckoutController@index')->name('checkout.index');

    /***** ORDER STORE *****/
    Route::post('/cart/checkout', 'OrderController@store')->name('checkout.store');


    /***** PAYPAL *****/
    Route::get('paypal/checkout/{order}', 'PayPalController@getExpressCheckout')->name('paypal.checkout');
    Route::get('paypal/checkout-success/{order}', 'PayPalController@getExpressCheckoutSuccess')->name('paypal.success');
    Route::get('paypal/checkout-cancel', 'PayPalController@cancelPage')->name('paypal.cancel');


    Route::group(['middleware' => 'verified'], function () {
        Route::get('/dashboard', 'UserController@index')->name('dashboard');
//        Route::get('/dashboard/{id}', 'UserController@show')->name('user.order');
        Route::get('/edit-info', 'UserController@edit_info')->name('front.users.edit');
        Route::post('/edit-info', 'UserController@update_info')->name('users.update_info');
        Route::post('/edit-password', 'UserController@update_password')->name('users.update_password');

        /***** USERS COMMENTS *****/
        Route::get('/comments', 'UserController@show_comments')->name('users.comments');
    });


    /***** AUTHENTICATION ROUTES *****/
    Route::get('/login',                            ['as' => 'front.login.form',           'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('login',                            ['as' => 'front.login',                'uses' => 'Auth\LoginController@login']);

    /***** LOGIN BY SOCIAL MEDIA [ FACEBOOK - TWITTER - GOOGLE ] *****/
    Route::get('login/{provider}',                  [LoginController::class, 'redirectToProvider'])->name('front.social_login');
    Route::get('login/{provider}/callback',         [LoginController::class, 'handleProviderCallback'])->name('front.social_login_callback');

    Route::post('logout',                           ['as' => 'front.logout',               'uses' => 'Auth\LoginController@logout']);
    Route::get('register',                          ['as' => 'front.register.form',        'uses' => 'Auth\RegisterController@showRegistrationForm']);
    Route::post('register',                         ['as' => 'front.register',             'uses' => 'Auth\RegisterController@register']);
    Route::get('password/reset',                    ['as' => 'password.request',           'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
    Route::post('password/email',                   ['as' => 'password.email',             'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
    Route::get('password/reset/{token}',            ['as' => 'password.reset',             'uses' => 'Auth\ResetPasswordController@showResetForm']);
    Route::post('password/reset',                   ['as' => 'password.update',            'uses' => 'Auth\ResetPasswordController@reset']);
    Route::get('email/verify',                      ['as' => 'verification.notice',        'uses' => 'Auth\VerificationController@show']);
    Route::get('/email/verify/{id}/{hash}',         ['as' => 'verification.verify',        'uses' => 'Auth\VerificationController@verify']);
    Route::post('email/resend',                     ['as' => 'verification.resend',        'uses' => 'Auth\VerificationController@resend']);
});
