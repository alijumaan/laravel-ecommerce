<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\CouponsController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\SupervisorController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

if (App::environment('production')) {
    URL::forceScheme('https');
}


Route::group(['middleware' => 'admin'], function () {

    /** DASHBOARD */
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    /** PRODUCTS */
    Route::post('/products/remove-image/{mediaId}', [ProductController::class, 'removeImage'])->name('products.media.destroy');
    Route::resource('products', ProductController::class)->names('admin.products');

    /** REVIEWS */
    Route::resource('reviews', ReviewController::class)->names('admin.reviews');

    /** CATEGORIES */
    Route::resource('categories', CategoryController::class)->names('admin.categories');

    /** USERS */
    Route::post('/users/remove-image', [UserController::class, 'removeImage'])->name('admin.users.remove-image');
    Route::resource('users', UserController::class)->names('admin.users');

    /** SUPERVISORS */
    Route::post('/supervisors/remove-image', [SupervisorController::class, 'removeImage'])->name('admin.supervisors.remove-image');
    Route::resource('supervisors', SupervisorController::class)->names('admin.supervisors');

    /** CONTACTS */
    Route::resource('contacts', ContactController::class)->names('admin.contacts');

    /** TAGS */
    Route::resource('tags', TagController::class)->names('admin.tags');

    /** SETTINGS */
    Route::resource('settings', SettingController::class)->names('admin.settings')->only('index', 'update');

    /** ORDERS */
    Route::get('confirm/{id}', [OrderController::class, 'confirm'])->name('order.confirm');
    Route::get('pending/{id}', [OrderController::class, 'pending'])->name('order.pending');
    Route::resource('orders', OrderController::class)->names('admin.orders')->only('index', 'show');

    /** COUPONS */
    Route::resource('coupons', CouponsController::class)->names('admin.coupons');

    /***** PERMISSION *****/
    /* Change Role By Ajax JavaScript */
    Route::post('permissions/byRole', [PermissionController::class, 'getByRole'])->name('permission_byRole');
    Route::resource('permissions', PermissionController::class);

    /** Pages */
    Route::resource('pages', PageController::class);
});

Route::group(['namespace' => 'Auth'], function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login.form');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');

});


