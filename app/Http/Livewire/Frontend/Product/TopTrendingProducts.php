<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Product;
use App\Services\CartService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class TopTrendingProducts extends Component
{
    use LivewireAlert;

    public function addToCart($productId)
    {
        $product = Product::whereId($productId)->active()->hasQuantity()->activeCategory()->firstOrFail();
        try {
            (new CartService())->addToList('default', $product);
            $this->emit('update_cart');
            $this->alert('success', 'added to Cart.');
        } catch(\Exception $exception) {
            $this->alert('warning', $exception->getMessage());
        }
    }

    public function addToWishList($productId)
    {
        $product = Product::whereId($productId)->active()->hasQuantity()->activeCategory()->firstOrFail();
        try {
            (new CartService())->addToList('wishlist', $product);
            $this->emit('update_wishlist');
            $this->alert('success', 'added to Wishlist.');
        } catch(\Exception $exception) {
            $this->alert('warning', $exception->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.frontend.product.top-trending-products', [
            'products' => Product::select('id', 'slug', 'name', 'price')
                ->with('firstMedia')
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
