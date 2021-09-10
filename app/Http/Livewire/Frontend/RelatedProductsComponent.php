<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class RelatedProductsComponent extends Component
{
    public $relatedProducts;

    public function mount($relatedProducts)
    {
        $this->relatedProducts = $relatedProducts;
    }

    public function addToCart($id)
    {
        $product = Product::whereId($id)->Active()->HasQuantity()->ActiveCategory()->firstOrFail();
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

    public function addToWishList($id)
    {
        $product = Product::whereId($id)->Active()->HasQuantity()->ActiveCategory()->firstOrFail();
        $duplicated = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        });

        if ($duplicated->isNotEmpty()) {
            $this->alert('warning', 'Product already exist!');
        } else {
            Cart::instance('wishlist')->add($product->id, $product->name, 1, $product->price)
                ->associate(Product::class);
            $this->emit('update_cart');
            $this->alert('success', 'added successfully.');
        }
    }

    public function render()
    {
        return view('livewire.frontend.related-products-component');
    }
}
