<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Traits\FilterTrait;

class HomeController extends Controller
{
    use FilterTrait;

    public function index()
    {
        $categories = Category::whereStatus(1)->whereParentId(null)->limit(4)->get();

        return view('frontend.index', compact('categories'));
    }

    public function shop($slug = null)
    {
        return view('frontend.shop.index', compact('slug'));
    }

    public function shopTag($slug)
    {
        return view('frontend.shop.tag', compact('slug'));
    }

    public function product($slug)
    {
        $product = Product::with('media', 'category', 'tags', 'approvedReviews')
            ->withAvg('approvedReviews', 'rating')
            ->withCount('approvedReviews')
            ->whereSlug($slug)
            ->active()
            ->hasQuantity()
            ->activeCategory()
            ->firstOrFail();

        $relatedProducts = Product::with('firstMedia')->whereHas('category', function ($query) use ($product) {
            $query->whereId($product->category_id);
            $query->whereStatus(true);
        })->where('id', '<>', $product->id)
            ->inRandomOrder()
            ->active()
            ->hasQuantity()
            ->take(4)
            ->get(['id', 'slug', 'name', 'price']);

        return view('frontend.product.show', compact('product', 'relatedProducts'));
    }

    public function cart()
    {
        return view('frontend.cart.index');
    }

    public function wishlist()
    {
        return view('frontend.wishlist.index');
    }

    public function search($slug = null)
    {
        $query = Product::with('category')->hasQuantity()->activeCategory();

        $products = $this->filter($query);

        return view('frontend.shop.index', compact('products', 'slug'));
    }
}
