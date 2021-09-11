<div>
    <a class="notification" href="#" id="alertsDropdown" role="button"
       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-alt text-dark"></i>
        <span class="badge">{{ $unReadNotificationsCount }}</span>
    </a>
    <div class=" dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header"></h6>
        @forelse($unReadNotifications as $notification)
            @if ($notification->type == 'App\Notifications\Frontend\User\OrderThanksNotification')
                <a class="dropdown-item d-flex align-items-center" wire:click="markAsRead('{{ $notification->id }}')">
                    <div>
                        <div class="small text-gray-500">
                            {{ $notification->data['created_date'] }}
                        </div>
                        <span class="font-weight-bold">
                            Order #{{ $notification->data['order_ref'] }} completed successfully.
                        </span>
                    </div>
                </a>
            @endif
            @if ($notification->type == 'App\Notifications\Frontend\User\OrderStatusNotification')
                <a class="dropdown-item d-flex align-items-center" wire:click="markAsRead('{{ $notification->id }}')">
                    <div>
                        <div class="small text-gray-500">
                            {{ $notification->data['created_date'] }}
                        </div>
                        <span class="font-weight-bold text-secondary">Order #{{ $notification->data['order_ref'] }}</span>
                        <span class="badge badge-danger">{{ $notification->data['last_transaction'] }}</span>
                    </div>
                </a>
            @endif
        @empty
            <div class="dropdown-item text-center">No notifications found!</div>
        @endforelse
    </div>
</div>
