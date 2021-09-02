<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;

class NotificationComponent extends Component
{
    public $unReadNotificationsCount = '';
    public $unReadNotifications;

    protected function getListeners(): array
    {
        $userId = auth()->id();
        return [
            "echo-notification:App.Models.User.{$userId},notification" => 'mount'
        ];
    }

    public function mount()
    {
        $this->unReadNotificationsCount = auth()->user()->unreadNotifications()->count();
        $this->unReadNotifications = auth()->user()->unreadNotifications()->get();
    }

    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->unreadNotifications->where('id', $notificationId)->first();
        $notification->markAsRead();
        return redirect()->to($notification->data['order_url']);
    }

    public function render()
    {
        return view('livewire.backend.notification-component');
    }
}
