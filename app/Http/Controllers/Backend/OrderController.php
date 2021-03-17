<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function index()
    {
        $orders = $this->order::all();
        return view('backend.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('backend.orders.details', compact('order'));
    }

    public function confirm($id)
    {
        $order = $this->order::find($id);

        $order->update(['status' => 1]);

        return redirect()->back()->with(['message' => 'Order has been again into confirm', 'alert-type' => 'success']);
    }

    public function pending($id)
    {
        $order = $this->order::find($id);

        $order->update(['status' => 0]);

        return redirect()->back()->with(['message' => 'Order has been pending', 'alert-type' => 'warning']);

    }

}
