<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        return view('frontend.cart.index');
    }
}
