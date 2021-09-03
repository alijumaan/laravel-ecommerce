<?php

namespace App\Notifications\Backend\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class ReturnRequestOrderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable): array
    {
        return $this->data();
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'data' => $this->data()
        ]);
    }

    protected function data(): array
    {
        return [
            'user_id' => $this->order->user_id,
            'user_name' => $this->order->user->full_name,
            'order_id' => $this->order->id,
            'amount' => $this->order->total,
            'order_url' => route('admin.orders.show', $this->order->id),
            'created_date' => $this->order->created_at->format('M d, Y'),
        ];
    }
}
