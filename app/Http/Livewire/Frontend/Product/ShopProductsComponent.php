<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Category;
use App\Models\Product;
use App\Services\CartService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ShopProductsComponent extends Component
{
    use WithPagination, LivewireAlert;

    protected $paginationTheme = 'bootstrap';
    public $paginationLimit = 12;
    public $slug;
    public $sortingBy = 'default';

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

    public function addToWishList($id)
    {
        $product = Product::whereId($id)->active()->hasQuantity()->activeCategory()->firstOrFail();
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
                $products = $products->with('category')
                    ->whereHas('category', function ($query) {
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

        return view('livewire.frontend.product.shop-products-component', compact('products'));
    }
}
