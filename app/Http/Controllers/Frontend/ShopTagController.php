<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class ShopTagController extends Controller
{
    public function index($slug)
    {
        return view('frontend.shop_tag.index', compact('slug'));
    }
}
