<?php

namespace App\Repositories\Frontend;

use App\Mail\OrderCompleted;
use App\Models\Order;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Mail;

class OrderRepository
{

    public function getChargeRequest($amount, $name, $email, $number)
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://api.tap.company/v2/charges',
            // You can set any number of default request options.
            'timeout'  => 30.0,
        ]);

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer sk_test_XKokBfNWv6FIYuTMg5sLPjhJ'
        ];

        $response = $client->request('POST', 'charges', [
            'headers' => $headers,
            'form_params' => [
            'amount' => $amount,
            'currency' => 'SAR',
            'customer' =>
                 [
                    'first_name' => $name,
                    'email' => $email,
                    'phone' => ['country_code' => '966', 'number' => $number]
                 ],
            'source' => ['id' => 'src_sa.mada'],
            'redirect' => ['url' => 'http://127.0.0.1:8000/orders/charge-update']
            ]
        ]);

        $info = json_decode($response->getBody(), true);

        return $info['transaction']['url'];
    }

    public function validateRequest($id)
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://api.tap.company/v2/charges/',
            // You can set any number of default request options.
            'timeout'  => 30.0,
        ]);

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer sk_test_XKokBfNWv6FIYuTMg5sLPjhJ'
        ];

        $response = $client->request('GET', $id, [
            'headers' => $headers,
        ]);

        $response = json_decode($response->getBody(), true);

        $order = new Order();
        $order->order_number = request()->tap_id;
        $order->status = $response['status'];
        $order['grand_total'] = \Cart::session(auth()->id())->getTotal();
        $order['item_count']= \Cart::session(auth()->id())->getContent()->count();
        $userId = auth()->id();
        $order['user_id'] = $userId;

        if ($response['status'] == 'CAPTURED'){
            // success
        } else {
            // failed
        }

        $products = \Cart::session(auth()->id())->getContent();

        foreach($products as $product) {
            $order->items()->attach($product->id, ['price'=> $product->price, 'quantity'=> $product->quantity, 'user_id' => $userId]);
        }

        if ($response['status'] == 'CAPTURED')
            session()->forget('currentOrders');

        Mail::to($userId)->send(new OrderCompleted());

        $status = $response['status'];
        return view('frontend.orders.paymentResult', compact('status'));
    }


//    public function delivered($order)
//    {
//        if ($order->store->user->id != auth()->user()->id)
//            return __('messages.this_store_not_for_you');
//
////        if ($order->status == 'paid' || $order->status == 'pending')
//        if (!in_array($order->status,['paid', 'pending']))
//            return __('messages.you_cant_change_order_status');
//
//        $order->status = 'delivered';
//        $order->save();
//        return back();
//    }

}

