<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Services\CartService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class SingleProductCartComponent extends Component
{
    use LivewireAlert;

    public $quantity = 1;
    public $product;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function decreaseQuantity()
    {
        if ($this->quantity > 1){
            $this->quantity--;
        }
    }

    public function increaseQuantity()
    {
        if ($this->product->quantity > $this->quantity){
            $this->quantity++;
        } else {
            $this->alert('warning', 'maximum quantity added!');
        }
    }

    public function addToCart()
    {
        try {
            (new CartService())->addToList('default', $this->product);
            $this->emit('update_cart');
            $this->alert('success', 'added to Cart.');
        } catch(\Exception $exception) {
            $this->alert('warning', $exception->getMessage());
        }
    }

    public function addToWishList()
    {
        try {
            (new CartService())->addToList('wishlist', $this->product);
            $this->emit('update_wishlist');
            $this->alert('success', 'added to Wishlist.');
        } catch(\Exception $exception) {
            $this->alert('warning', $exception->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.frontend.product.single-product-cart-component');
    }
}
