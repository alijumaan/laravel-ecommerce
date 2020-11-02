<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        if (\auth()->check()) {
            $this->middleware('auth');
        } else {
            return view('admin.index');
        }
    }

    public function index()
    {
        if (!\auth()->user()->ability('admin', 'manage_order, show_order')) {
            return redirect('admin/index');
        }

        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($orderId)
    {
        if (!\auth()->user()->ability('admin', 'display_orders')) {
            return redirect('admin/index');
        }

        $order = Order::find($orderId);
        return view('admin.orders.details', compact('order'));
    }

    public function confirm($id)
    {
        // Find the order
        $order = Order::find($id);

        // Update the order
        $order->update(['status' => 1]);

        //Redirect the page
        return redirect()->back()->with([
            'message' => 'Order has been again into confirm',
            'alert-type' => 'success'
        ]);

    }

    public function pending($id)
    {
        // Find the order
        $order = Order::find($id);

        // Update the order
        $order->update(['status' => 0]);

        //Redirect the page
        return redirect()->back()->with([
            'message' => 'Order has been pending',
            'alert-type' => 'warning'
        ]);

    }

}
