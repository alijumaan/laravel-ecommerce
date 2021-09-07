<?php

namespace App\Services;

use App\Mail\OrderCompleted;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderTransaction;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class OrderService
{
    public function createOrder($request)
    {
        $order = Order::create([
            'ref_id' => 'ORD-' . Str::random(15),
            'user_id' => auth()->id(),
            'user_address_id' => $request['userAddressId'],
            'shipping_company_id' => $request['shippingCompanyId'],
            'payment_method_id' => $request['paymentMethodId'],
            'subtotal' => getNumbersOfCart()->get('subtotal'),
            'discount_code' => session()->has('coupon') ? session()->get('coupon')['code'] : NULL,
            'discount' => getNumbersOfCart()->get('discount'),
            'shipping' => getNumbersOfCart()->get('shipping'),
            'tax' => getNumbersOfCart()->get('productTaxes'),
            'total' => getNumbersOfCart()->get('total'),
            'currency' => 'USD',
            'order_status' => 0,
        ]);

        foreach (Cart::content() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty
            ]);
            $product = Product::find($item->model->id);
            $product->update(['quantity' => $product->quantity - $item->qty]);
        }

        $order->transactions()->create([
            'transaction_status' => OrderTransaction::NEW_ORDER
        ]);

        return $order;
    }

    public function getChargeRequest($amount, $name, $email, $number)
    {
        $client = new Client([
            'base_uri' => 'https://api.tap.company/v2/charges', // Base URI is used with relative requests
            'timeout'  => 30.0, // You can set any number of default request options.
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
                'redirect' => ['url' => config('app.url') . '/orders/charge-update']
            ]
        ]);

        $info = json_decode($response->getBody(), true);

        return $info['transaction']['url'];
    }

    public function validateRequest($request, $id)
    {
        $client = new Client([
            'base_uri' => 'https://api.tap.company/v2/charges/', // Base URI is used with relative requests
            'timeout'  => 30.0, // You can set any number of default request options.
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
        $order->ref_id = 'ORD-' . request()->tap_id;
        $order['user_id'] = auth()->id();
        $order['total'] = getNumbersOfCart()->get('total');
        $order['user_address_id'] = $request['userAddressId'];
        $order['shipping_company_id'] = $request['shippingCompanyId'];
        $order['payment_method_id'] = $request['paymentMethodId'];
        $order['subtotal'] = getNumbersOfCart()->get('subtotal');
        $order['discount_code'] = session()->has('coupon') ? session()->get('coupon')['code'] : NULL;
        $order['discount'] = getNumbersOfCart()->get('discount');
        $order['shipping'] = getNumbersOfCart()->get('shipping');
        $order['tax'] = getNumbersOfCart()->get('productTaxes');
        $order['total'] = getNumbersOfCart()->get('total');
        $order['currency'] = 'USD';
        $order->order_status = $response['status'];

        $items = Cart::instance('default')->content();

        foreach ($items as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty
            ]);
            $product = Product::find($item->model->id);
            $product->update(['quantity' => $product->quantity - $item->qty]);
        }

        $order->transactions()->create([
            'transaction_status' => OrderTransaction::NEW_ORDER
        ]);

        return $order;
    }
}
