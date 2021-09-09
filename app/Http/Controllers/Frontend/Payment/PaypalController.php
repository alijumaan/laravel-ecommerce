<?php

namespace App\Http\Controllers\Frontend\Payment;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderTransaction;
use App\Models\Product;
use App\Models\User;
use App\Notifications\Backend\User\OrderCreatedNotification;
use App\Notifications\Frontend\User\OrderThanksNotification;
use App\Services\OmnipayService;
use App\Services\OrderService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Meneses\LaravelMpdf\Facades\LaravelMpdf as PDF;

class PaypalController extends Controller
{
    public function store(Request $request)
    {
        $order = (new OrderService())->createOrder($request->except(['_token', 'submit']));

        $omniPay = new OmnipayService('PayPal_Express');
        $response = $omniPay->purchase([
            'amount' => $order->total,
            'transactionId' => $order->id,
            'currency' => $order->currency,
            'cancelUrl' => $omniPay->getCancelUrl($order->id),
            'returnUrl' => $omniPay->getReturnUrl($order->id)
        ]);

        if ($response->isRedirect()) {
            $response->redirect();
        }

        toast($response->getMessage(), 'error');
        return redirect()->route('home');
    }

    public function cancelled($orderId): RedirectResponse
    {
        $order = Order::find($orderId);

        $order->update([
            'order_status' => Order::CANCELED
        ]);
        $order->products()->each(function ($orderProduct) {
            $product = Product::whereId($orderProduct->pivot->product_id)->first();
            $product->update([
                'quantity' => $product->quantity + $orderProduct->pivot->quantity
            ]);
        });

        toast('You have canceled your order payment!', 'error');
        return redirect()->route('home');
    }

    public function completed($orderId): RedirectResponse
    {
        $order = Order::with('products', 'user', 'paymentMethod')->find($orderId);

        $omniPay = new OmnipayService('PayPal_Express');
        $response = $omniPay->complete([
            'amount' => $order->total,
            'transactionId' => $order->id,
            'currency' => $order->currency,
            'cancelUrl' => $omniPay->getCancelUrl($order->id),
            'returnUrl' => $omniPay->getReturnUrl($order->id),
            'notifyUrl' => $omniPay->getNotifyUrl($order->id)
        ]);

        if ($response->isSuccessful()) {
            $order->update(['order_status' => Order::PAID]);
            $order->transactions()->create([
                'transaction_status' => OrderTransaction::PAID,
                'transaction_number' => $response->getTransactionReference(),
                'payment_result' => 'success'
            ]);
        }

        if (session()->has('coupon')) {
            $coupon = Coupon::whereCode(session()->get('coupon')['code'])->first();
            $coupon->increment('used_times');
        }

        Cart::instance('default')->destroy();

        session()->forget([
            'coupon',
            'saved_user_address_id',
            'saved_shipping_company_id',
            'saved_payment_method_id',
            'shipping'
        ]);

        // Notification to admins.
        User::role(['admin', 'supervisor'])->each(function ($admin, $key) use ($order) {
            $admin->notify(new OrderCreatedNotification($order));
        });

        // Send email with PDF invoice
        $data = $order->toArray();
        $data['currency_symbol'] = $order->currency == 'USD' ? '$' : $order->currency;
        $pdf = PDF::loadView('layouts.invoice', $data);
        $saved_file = storage_path('app/pdf/files/' . $data['ref_id'] . '.pdf');
        $pdf->save($saved_file);

        $user = User::find($order->user_id);
        $user->notify(new OrderThanksNotification($order, $saved_file));

        toast('You have recent payment is successful with reference code: ' . $response->getTransactionReference(), 'success');
        return redirect()->route('home');
    }

    public function webhook($order, $env)
    {
        // feature..
    }
}
