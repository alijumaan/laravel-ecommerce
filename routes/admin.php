<?php

use App\Http\Controllers\Backend_old;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

if (App::environment('production')) {
    URL::forceScheme('https');
}

Auth::routes();

Route::group(['middleware' => 'admin'], function () {
    Route::view('/', 'backend.index')->name('admin.index');
    Route::post('/products/remove-image/{mediaId}', [Backend_old\ProductController::class, 'removeImage'])->name('products.media.destroy');
    Route::resource('products', Backend_old\ProductController::class)->names('admin.products');
    Route::resource('payment-methods', Backend_old\PaymentMethodController::class)->names('admin.payment_methods');
    Route::resource('user-addresses', Backend_old\UserAddressController::class)->names('admin.user_addresses');
    Route::resource('shipping-companies', Backend_old\ShippingCompanyController::class)->names('admin.shipping_companies');
    Route::resource('reviews', Backend_old\ReviewController::class)->names('admin.reviews');
    Route::resource('categories', Backend_old\CategoryController::class)->names('admin.categories');
    Route::post('/users/remove-image', [Backend_old\UserController::class, 'removeImage'])->name('admin.users.remove-image');
    Route::resource('users', Backend_old\UserController::class)->names('admin.users');
    Route::resource('contacts', Backend_old\ContactController::class)->names('admin.contacts');
    Route::resource('tags', Backend_old\TagController::class)->names('admin.tags');
    Route::resource('settings', Backend_old\SettingController::class)->names('admin.settings')->only('index', 'update');
    Route::get('confirm/{id}', [Backend_old\OrderController::class, 'confirm'])->name('order.confirm');
    Route::get('pending/{id}', [Backend_old\OrderController::class, 'pending'])->name('order.pending');
    Route::resource('orders', Backend_old\OrderController::class)->names('admin.orders')->only('index', 'show');
    Route::resource('coupons', Backend_old\CouponsController::class)->names('admin.coupons');
    Route::resource('pages', Backend_old\PageController::class);

    Route::group(['middleware' => 'superAdmin'], function () {
        /* Change Role By Ajax JavaScript */
        Route::post('permissions/byRole', [Backend_old\PermissionController::class, 'getByRole'])->name('permission_byRole');
        Route::resource('permissions', Backend_old\PermissionController::class);
        Route::post('/supervisors/remove-image', [Backend_old\SupervisorController::class, 'removeImage'])->name('admin.supervisors.remove-image');
        Route::resource('supervisors', Backend_old\SupervisorController::class)->names('admin.supervisors');
    });
});


