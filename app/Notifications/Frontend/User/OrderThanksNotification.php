<?php

namespace App\Notifications\Frontend\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderThanksNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;
    public $attachment;

    public function __construct($order, $attachment)
    {
        $this->order = $order;
        $this->attachment = $attachment;
    }

    public function via($notifiable): array
    {
        $channels = ['database', 'broadcast'];
        if ($notifiable->receive_email) {
            $channels[] = 'mail';
        }
        return $channels;
    }


    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage())
            ->greeting('Dear, ' . $notifiable->full_name)
            ->line('Thank you for purchase the order.')
            ->line('Thank you for using our application!')
            ->attach($this->attachment, [
                'as' => 'order-'.$this->order->ref_id.'.pdf',
                'mime' => 'application/pdf',
            ]);
    }

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
            'user_name' => $this->order->user->full_name,
            'order_ref' => $this->order->ref_id,
            'order_url' => route('user.orders'),
            'created_date' => $this->order->created_at->format('M d, Y'),
        ];
    }
}
