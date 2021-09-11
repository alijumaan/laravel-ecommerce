<?php

namespace App\Http\Livewire\Frontend\Message;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartNotFoundComponent extends Component
{
    public $cartNoFound;

    protected $listeners = [
        'update_message_cart_not_found' => 'mount'
    ];

    public function mount()
    {
        $this->cartNoFound = false;

        if (Cart::instance('default')->count() == 0) {
            $this->cartNoFound = true;
        }
    }

    public function render()
    {
        return view('livewire.frontend.message.cart-not-found-component');
    }
}
