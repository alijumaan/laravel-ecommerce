<?php

namespace App\Http\Livewire;

use Livewire\Component;
use phpDocumentor\Reflection\Types\Void_;

class CartUpdateForm extends Component
{
    public $items = [];
    public $quantity = 1;

    public function mount($item)
    {

        $this->items = $item;

        $this->quantity = $item['quantity'];

    }

    public function updateCart()
    {

        \Cart::session(auth()->id())->update($this->items['id'], [
            'quantity' => [
                'relative' => false,
                'value' => $this->quantity
            ]
        ]);

        $qty = $this->emit('cartUpdated');

        if($qty < 1){
            return;
        }

    }

    public function render()
    {
        return view('livewire.cart-update-form');
    }

}
