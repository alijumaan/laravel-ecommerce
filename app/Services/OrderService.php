<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderTransaction;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use GuzzleHttp\Client;
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
}
