<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\WithPagination;

class ShopProductsComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $paginationLimit = 12;
    public $slug;
    public $sortingBy = 'default';

    public function addToCart($productId)
    {
        $product = Product::whereId($productId)->active()->hasQuantity()->activeCategory()->firstOrFail();
        $duplicated = Cart::instance('default')->search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        });

        if ($duplicated->isNotEmpty()) {
            $this->alert('error', 'Product already exist!');
        } else {
            Cart::instance('default')->add($product->id, $product->name, 1, $product->price)
                ->associate(Product::class);
            $this->emit('update_cart');
            $this->alert('success', 'added successfully.');
        }
    }

    public function addToWishList($id)
    {
        $product = Product::whereId($id)->active()->hasQuantity()->activeCategory()->firstOrFail();
        $duplicated = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        });

        if ($duplicated->isNotEmpty()) {
            $this->alert('error', 'Product already exist!');
        } else {
            Cart::instance('wishlist')->add($product->id, $product->name, 1, $product->price)
                ->associate(Product::class);
            $this->emit('update_wishlist');
            $this->alert('success', 'added successfully.');
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

        $products = Product::with('firstMedia');

        if ($this->slug == '') {
            $products = $products->activeCategory();
        } else {
            $category = Category::whereSlug($this->slug)->whereStatus(true)->first();

            if (is_null($category->parent_id)) {
                $categoriesIds = Category::whereParentId($category->id)
                    ->whereStatus(true)->pluck('id')->toArray();

                $products = $products->whereHas('category', function ($query) use ($categoriesIds) {
                    $query->whereIn('id', $categoriesIds);
                });
            } else {
                $products = $products->with('category')->whereHas('category', function ($query) {
                    $query->where([
                        'slug' => $this->slug,
                        'status' => true
                    ]);
                });
            }
        }

        $products = $products->active()
            ->hasQuantity()
            ->orderBy($sortField, $sortType)
            ->paginate($this->paginationLimit);

        return view('livewire.frontend.shop-products-component', compact('products'));
    }
}
