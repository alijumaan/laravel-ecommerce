<?php

use App\Http\Controllers\Backend\Api\ApiController;
use App\Http\Controllers\Frontend\PurchaseController;
use Illuminate\Support\Facades\Route;


/**** PAYPAL ****/
Route::post('/create-payment' , [PurchaseController::class, 'createPayment']);
Route::post('/execute-payment' , [PurchaseController::class, 'executePayment']);

/*** CART ADMIN PANEL ***/
Route::get('/chart/orders-chart', [ApiController::class, 'orders_chart']);
Route::get('/chart/products-chart', [ApiController::class, 'products_chart']);
