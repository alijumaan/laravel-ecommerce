<?php

namespace App\Http\Livewire\Frontend\Button;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ProceedCheckoutButtonComponent extends Component
{
    public $showButton;

    protected $listeners = [
        'update_show_proceed_to_checkout' => 'mount'
    ];

    public function mount()
    {
        $this->showButton = true;

        if (Cart::instance('default')->count() == 0) {
            $this->showButton = false;
        }
    }

    public function render()
    {
        return view('livewire.frontend.button.proceed-checkout-button-component');
    }
}
