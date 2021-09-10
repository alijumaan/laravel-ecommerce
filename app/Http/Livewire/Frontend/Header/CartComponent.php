<?php

namespace App\Http\Livewire\Frontend\Header;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartComponent extends Component
{
    public $cartCount;

    protected $listeners = [
        'update_cart' => 'cartCount',
        'remove_from_cart' => 'removeFromCart'
    ];

    public function mount()
    {
        $this->cartCount();
    }

    public function cartCount()
    {
        $this->cartCount = Cart::instance('default')->count();
    }

    public function removeFromCart($rowId)
    {
        Cart::instance('default')->remove($rowId);
        $this->emit('update_cart');
        if (Cart::instance('default')->count() == 0) {
            return redirect()->route('cart.index');
        }
    }

    public function render()
    {
        return view('livewire.frontend.header.cart-component');
    }
}
