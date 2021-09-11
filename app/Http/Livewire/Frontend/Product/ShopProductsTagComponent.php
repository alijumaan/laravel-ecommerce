<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Product;
use App\Services\CartService;
use Livewire\Component;
use Livewire\WithPagination;

class ShopProductsTagComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $paginationLimit = 12;
    public $slug;
    public $sortingBy = 'default';

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
        switch ($this->sortingBy) {
            case 'popularity':
                $sortField = 'id';
                $sortType = 'desc';
                break;
            case 'low-high':
                $sortField = 'price';
                $sortType = 'asc';
                break;
            case 'high-low':
                $sortField = 'price';
                $sortType = 'desc';
                break;
            default:
                $sortField = 'id';
                $sortType = 'asc';
        }

        $products = Product::with('media');

        $products = $products->with('tags')->whereHas('tags', function ($query) {
            $query->where([
                'slug' => $this->slug,
                'status' => true
            ]);
        })
            ->active()
            ->hasQuantity()
            ->orderBy($sortField, $sortType)
            ->paginate($this->paginationLimit);

        return view('livewire.frontend.product.shop-products-component', compact('products'));
    }
}
