<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('frontend.checkout.index');
    }
}
