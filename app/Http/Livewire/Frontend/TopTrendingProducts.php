<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class TopTrendingProducts extends Component
{
    public function addToCart($productId)
    {
        $product = Product::whereId($productId)->active()->hasQuantity()->activeCategory()->firstOrFail();

        $duplicated = Cart::instance('default')->search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        });

        if ($duplicated->isNotEmpty()) {
            $this->alert('warning', 'Product already exist!');
        } else {
            Cart::instance('default')->add($product->id, $product->name, 1, $product->price)
                ->associate(Product::class);
            $this->emit('update_cart');
            $this->alert('success', 'added successfully.');
        }
    }

    public function addToWishList($productId)
    {
        $product = Product::whereId($productId)->active()->hasQuantity()->activeCategory()->firstOrFail();

        $duplicated = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        });

        if ($duplicated->isNotEmpty()) {
            $this->alert('warning', 'Product already exist!');
        } else {
            Cart::instance('wishlist')->add($product->id, $product->name, 1, $product->price)
                ->associate(Product::class);
            $this->emit('update_wishlist');
            $this->alert('success', 'added successfully.');
        }
    }

    public function render()
    {
        return view('livewire.frontend.top-trending-products', [
            'products' => Product::with('firstMedia')
                ->inRandomOrder()
                ->featured()
                ->active()
                ->hasQuantity()
                ->activeCategory()
                ->take(8)
                ->get()
        ]);
    }
}
