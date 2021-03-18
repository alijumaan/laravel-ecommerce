<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $cartItems = [];
    protected $listeners = ['cartUpdated' => 'onCartUpdate'];

    public function mount()
    {
        $this->cartItems = \Cart::session(auth()->id())->getContent()->toArray();
    }

    public function onCartUpdate()
    {
        $this->mount();
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
