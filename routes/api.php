<?php

use App\Http\Controllers\Admin\Api\ApiController;
use Illuminate\Support\Facades\Route;


Route::get('/chart/orders-chart', [ApiController::class, 'orders_chart']);
Route::get('/chart/products-chart', [ApiController::class, 'products_chart']);
