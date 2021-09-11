<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
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
        $duplicated = Cart::instance('default')->search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        });

        if ($duplicated->isNotEmpty()) {
            $this->alert('warning', 'Product already exist!');
        } else {
            Cart::instance('default')->add($product->id, $product->name, 1, $product->price)
                ->associate(Product::class);
            $this->emit('update_cart');
            $this->alert('success', 'Added to Cart.');
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
            $this->emit('update_wishlist');
            $this->alert('success', 'added to Wishlist.');
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

        return view('livewire.frontend.shop-products-component', compact('products'));
    }
}
