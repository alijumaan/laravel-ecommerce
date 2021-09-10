<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderTransaction;
use App\Models\User;
use App\Notifications\Frontend\User\OrderStatusNotification;
use App\Services\OmnipayService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(): View
    {
        $this->authorize('access_order');

        $orders = Order::with('user', 'paymentMethod')
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereOrderStatus(\request()->status);
            })
            ->orderBy(\request()->sortBy ?? 'id', \request()->orderBy ?? 'desc')
            ->paginate(\request()->limitBy ?? 10);

        return view('backend.orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        $this->authorize('show_order');

        $orderStatusArray = [
            '0' => 'New order',
            '1' => 'Paid',
            '2' => 'Under process',
            '3' => 'Finished',
            '4' => 'Rejected',
            '5' => 'Canceled',
            '6' => 'Refund requested',
            '7' => 'Returned order',
            '8' => 'Refunded',
        ];

        $key = array_search($order->order_status, array_keys($orderStatusArray));
        foreach ($orderStatusArray as $k => $v) {
            if ($k <= $key) {
                unset($orderStatusArray[$k]);
            }
        }

        return view('backend.orders.show', compact('order', 'orderStatusArray'));
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $this->authorize('edit_order');

        $user = User::find($order->user_id);

        if ($request->order_status == Order::REFUNDED){
            $omniPay = new OmnipayService('PayPal_Express');
            $response = $omniPay->refund([
                'amount' => $order->total,
                'transactionReference' => $order->transactions()->where('transaction_status', OrderTransaction::PAID)
                    ->first()->transaction_number,
                'cancelUrl' => $omniPay->getCancelUrl($order->id),
                'returnUrl' => $omniPay->getReturnUrl($order->id),
                'notifyUrl' => $omniPay->getNotifyUrl($order->id),
            ]);

            if ($response->isSuccessful()) {
                $order->update(['order_status' => Order::REFUNDED]);
                $order->transactions()->create([
                    'transaction_status' => OrderTransaction::REFUNDED,
                    'transaction_number' => $response->getTransactionReference(), // coming from PayPal
                    'payment_result' => 'success'
                ]);

                $user->notify(new OrderStatusNotification($order));

                return back()->with([
                    'message' => 'Refunded successfully',
                    'alert-type' => 'success',
                ]);
            }

        } else {

            $order->update(['order_status'=> $request->order_status]);

            $order->transactions()->create([
                'transaction_status' => $request->order_status,
                'transaction_number'=> null,
                'payment_result'=> null,
            ]);

            $user->notify(new OrderStatusNotification($order));

            return back()->with([
                'message' => 'updated successfully',
                'alert-type' => 'success',
            ]);

        }
    }

    public function destroy(Order $order): RedirectResponse
    {
        $this->authorize('delete_order');

        $order->delete();

        return redirect()->route('admin.orders.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
