<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cartItems = \Cart::session(auth()->id())->getContent();

        return view('frontend.cart.checkout', compact('cartItems'));

    }

    public function store(Request $request)
    {
        // Insert into orders table
        $order = Order::create([
            'user_id' => auth()->user()->id,
//            'date' => Carbon::now(),
            'address' => $request['address'],
            'status' => 0
        ]);

        // Insert into order items table
        foreach (\Cart::session(auth()->id())->getContent() as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'quantity' => $item->quantity,
                'price' => $item->price
            ]);


            // payment
            if ($request['payment_method'] == 'paypal') {

                // Redirect to paypal
                return redirect()->route('paypal.checkout', $order->id);
            }

            // Empty cart
//        \Cart::session(auth()->id())->remove($item['id']);
            \Cart::session(auth()->id())->clear();
        }

        return redirect()->route('home')->with('msg', 'Order has been placed successfully');

    }
}
