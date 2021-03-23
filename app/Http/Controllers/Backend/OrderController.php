<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\OrderCompleted;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::all();

        return view('backend.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('backend.orders.details', compact('order'));
    }

    public function confirm($id)
    {
        $order = Order::find($id);

        $order->confirm();

        Mail::to($order->user)->send(new OrderCompleted());

        return redirect()->back()->with(['message' => 'Order has been again into confirm', 'alert-type' => 'success']);
    }

    public function pending($id)
    {
        $order = Order::find($id);

        $order->pending();

        return redirect()->back()->with(['message' => 'Order has been pending', 'alert-type' => 'warning']);

    }

}
