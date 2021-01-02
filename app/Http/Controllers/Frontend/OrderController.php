<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Mail\OrderCompleted;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function store(StoreOrderRequest $request)
    {

        $order = new Order();

        if ($order) {
            $order['order_number'] = uniqid('OrderNumber-');
            $order['shipping_first_name'] = $request->input('shipping_first_name');
            $order['shipping_last_name'] = $request->input('shipping_last_name');
            $order['shipping_state'] = $request->input('shipping_state');
            $order['shipping_city'] = $request->input('shipping_city');
            $order['shipping_address'] = $request->input('shipping_address');
            $order['shipping_phone'] = $request->input('shipping_phone');

            if(!$request->has('billing_first_name')) {
                $order['billing_first_name'] = $request->input('shipping_first_name');
                $order['billing_last_name'] = $request->input('shipping_last_name');
                $order['billing_state'] = $request->input('shipping_state');
                $order['billing_city'] = $request->input('shipping_city');
                $order['billing_address'] = $request->input('shipping_address');
                $order['billing_phone'] = $request->input('shipping_phone');
            }else {
                $order['billing_first_name'] = $request->input('billing_first_name');
                $order['billing_last_name'] = $request->input('billing_last_name');
                $order['billing_state'] = $request->input('billing_state');
                $order['billing_city'] = $request->input('billing_city');
                $order['billing_address'] = $request->input('billing_address');
                $order['billing_phone'] = $request->input('billing_phone');
            }


            $order['grand_total'] = \Cart::session(auth()->id())->getTotal();
            $order['item_count']= \Cart::session(auth()->id())->getContent()->count();

            $userId = auth()->id();
            $order['user_id'] = $userId;

            if (request('payment_method') == 'paypal') {
                $order['payment_method'] = 'paypal';
            }

            $order->save();

            //save order items
            $cartItems = \Cart::session(auth()->id())->getContent();

            foreach($cartItems as $item) {
                $order->items()->attach($item->id, ['price'=> $item->price, 'quantity'=> $item->quantity, 'user_id' => $userId]);
            }

            //payment
//            if(request('payment_method') == 'paypal') {
//                //redirect to paypal
//                return redirect()->route('payWithPaypal', $order->id);
//
//            }

            //empty cart
            \Cart::session(auth()->id())->clear();

            Mail::to($request->user())->send(new OrderCompleted);

            //send email to customer
            return redirect()->route('home')->with([
                'message' => 'Order has been placed successfully',
                'alert-type' => 'success'
            ]);
        }

        return redirect()->back()->with([
            'message' => 'Something was wrong, please try again',
            'alert-type' => 'danger'
        ]);

    }

}
