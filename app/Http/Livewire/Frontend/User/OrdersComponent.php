<?php

namespace App\Http\Livewire\Frontend\User;

use App\Models\Order;
use App\Models\OrderTransaction;
use App\Models\User;
use App\Notifications\Backend\User\ReturnRequestOrderNotification;
use Livewire\Component;

class OrdersComponent extends Component
{
    public $showOrder = false;
    public $order;

    public function displayOrder($orderId)
    {
        $this->order = Order::with('products')->find($orderId);
        $this->showOrder = true;
    }

    public function requestReturnOrder($orderId)
    {
        $order = Order::whereId($orderId)->first();

        $order->update([
            'order_status' => Order::REFUNDED_REQUEST
        ]);

        $order->transactions()->create([
            'transaction_status' => OrderTransaction::REFUNDED_REQUEST,
            'transaction_number' => $order->transactions()->whereTransactionStatus(OrderTransaction::PAID)
                ->first()->transaction_number,
        ]);

        User::role(['admin', 'supervisor'])->each(function ($admin, $key) use ($order) {
            $admin->notify(new ReturnRequestOrderNotification($order));
        });

        $this->alert('success', 'Your request is sent successfully');
    }

    public function render()
    {
        return view('livewire.frontend.user.orders-component', [
            'orders' => auth()->user()->orders
        ]);
    }
}
