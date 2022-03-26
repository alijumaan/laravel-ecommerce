<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Product;
use App\Services\CartService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class RelatedProductsComponent extends Component
{
    use LivewireAlert;

    public $relatedProducts;

    public function mount($relatedProducts)
    {
        $this->relatedProducts = $relatedProducts;
    }

    public function addToCart($id)
    {
        $product = Product::whereId($id)->Active()->HasQuantity()->ActiveCategory()->firstOrFail();
        try {
            (new CartService())->addToList('default', $product);
            $this->emit('update_cart');
            $this->alert('success', 'added to Cart.');
        } catch(\Exception $exception) {
            $this->alert('warning', $exception->getMessage());
        }
    }

    public function addToWishList($id)
    {
        $product = Product::whereId($id)->Active()->HasQuantity()->ActiveCategory()->firstOrFail();
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
        return view('livewire.frontend.product.related-products-component');
    }
}
