<?php

namespace App\Http\Livewire\Frontend\Message;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class WishlistNotFoundComponent extends Component
{
    public $wishlistNoFound;

    protected $listeners = [
        'update_message_wishlist_not_found' => 'mount'
    ];

    public function mount()
    {
        $this->wishlistNoFound = false;

        if (Cart::instance('wishlist')->count() == 0) {
            $this->wishlistNoFound = true;
        }
    }

    public function render()
    {
        return view('livewire.frontend.message.wishlist-not-found-component');
    }
}
