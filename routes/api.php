<?php

use App\Http\Controllers\Admin\Api\ApiController;
use App\Http\Controllers\Front\PurchaseController;
use Illuminate\Support\Facades\Route;

/*** CART ADMIN PANEL ***/
Route::get('/chart/orders-chart', [ApiController::class, 'orders_chart']);
Route::get('/chart/products-chart', [ApiController::class, 'products_chart']);


/**** PAYPAL ****/
Route::post('create-payment' , [PurchaseController::class, 'createPayment']);
Route::post('execute-payment' , [PurchaseController::class, 'executePayment']);
