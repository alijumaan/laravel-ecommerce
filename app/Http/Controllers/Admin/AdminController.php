<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login.form');
        }
    }

    public function index()
    {
        if (Auth::check()) {
            $products = new Product();
            $orders = new Order();
            $users = new User();

            return view('admin.index', compact('products', 'orders', 'users'));
        }

        return redirect()->route('admin.login.form');

    }
}
