<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    protected $listeners = ['cartUpdated' => '$refresh'];
    public $cartItems = [];

//    public function mount()
//    {
//        $this->cartItems = \Cart::session(auth()->id())->getContent()->toArray();
//    }
//
//    public function onCartUpdate()
//    {
//        $this->mount();
//    }

    public function render()
    {
        $this->cartItems = \Cart::session(auth()->id())->getContent()->toArray();
        return view('livewire.counter');
    }
}

