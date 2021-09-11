<?php

namespace App\Http\Livewire\Frontend\Header;

use Livewire\Component;

class NotificationComponent extends Component
{
    public $unReadNotificationsCount = '';
    public $unReadNotifications;

    public function getListeners(): array
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

    public function markAsRead($id)
    {
        $notification = auth()->user()->unreadNotifications->where('id', $id)->first();
        $notification->markAsRead();
        return redirect()->to($notification->data['order_url']);
    }

    public function render()
    {
        return view('livewire.frontend.header.notification-component');
    }
}
