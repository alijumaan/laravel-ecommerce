<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

if (App::environment('production')) {
    URL::forceScheme('https');
}

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Admin'], function() {

    Route::group(['middleware' => ['roles', 'role:admin|editor']], function () {

        // Dashboard
        Route::get('/', 'AdminController@index')->name('admin.index');
        Route::get('/index', 'AdminController@index')->name('admin.index_route');

        // Products
        Route::post('/products/remove-image/{mediaId}', 'ProductController@removeImage')->name('products.media.destroy');
        Route::resource('products', 'ProductController', ['as' => 'admin']);

        // Product Comments
        Route::resource('product-comments', 'ProductCommentsController', ['as' => 'admin']);

        // Product Categories
        Route::resource('product-categories', 'ProductCategoriesController', ['as' => 'admin']);

        // Users
        Route::post('/users/remove-image', 'UserController@removeImage')->name('admin.users.remove-image');
        Route::resource('users', 'UserController', ['as' => 'admin']);

        // Supervisors
        Route::post('/supervisors/remove-image', 'SupervisorController@removeImage')->name('admin.supervisors.remove-image');
        Route::resource('supervisors', 'SupervisorController', ['as' => 'admin']);

        // Contacts
        Route::resource('contacts', 'ContactController', ['as' => 'admin']);

        // Tags
        Route::resource('tags', 'TagController', ['as' => 'admin']);

        // Settings
        Route::resource('settings', 'SettingController', ['as' => 'admin'])->only('index', 'update');

        // Orders
        Route::get('confirm/{id}', 'OrderController@confirm')->name('order.confirm');
        Route::get('pending/{id}', 'OrderController@pending')->name('order.pending');
        Route::resource('orders', 'OrderController', ['as' => 'admin'])->only('index', 'show');

        // Coupons
        Route::resource('coupons', 'CouponsController', ['as' => 'admin']);
    });

    Route::group(['namespace' => 'Auth'], function () {

        Route::get('/login', 'LoginController@showLoginForm')->name('admin.login.form');
        Route::post('/login', 'LoginController@login')->name('admin.login');
        Route::post('/logout', 'LoginController@logout')->name('admin.logout');

    });

});

