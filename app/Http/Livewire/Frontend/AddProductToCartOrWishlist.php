<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class AddProductToCartOrWishlist extends Component
{
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
        $duplicated = Cart::instance('default')->search(function ($cartItem, $rowId) {
            return $cartItem->id === $this->product->id;
        });

        if ($duplicated->isNotEmpty()) {
            $this->alert('warning', 'Product already exist!');
        } else {
            Cart::instance('default')->add($this->product->id, $this->product->name, $this->quantity, $this->product->price)
                ->associate(Product::class);
            $this->quantity = 1;
            $this->emit('update_cart');
            $this->alert('success', 'added successfully.');
        }
    }

    public function addToWishList()
    {
        $duplicated = Cart::instance('wishlist')->search(function ($cartItem, $rowId) {
            return $cartItem->id === $this->product->id;
        });

        if ($duplicated->isNotEmpty()) {
            $this->alert('warning', 'Product already exist!');
        } else {
            Cart::instance('wishlist')->add($this->product->id, $this->product->name, $this->quantity, $this->product->price)
                ->associate(Product::class);
            $this->emit('update_wishlist');
            $this->alert('success', 'added successfully.');
        }
    }

    public function render()
    {
        return view('livewire.frontend.add-product-to-cart-or-wishlist');
    }
}
