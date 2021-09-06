<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Traits\FilterTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

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

//    public function storeReview(Request $request, $slug)
//    {
//        $validation = Validator::make($request->all(), ['review' => 'required',]);
//
//        if ($validation->fails()) {return redirect()->back()->withErrors($validation)->withInput();}
//
//        $product = Product::whereSlug($slug)->first();
//
//        $userId = auth()->check() ?  auth()->id() : null;
//        $userName = auth()->user()->name;
//        $userEmail = auth()->user()->email;
//
//        $data['name']             = $userName;
//        $data['email']            = $userEmail;
//        $data['ip_address']       = $request->ip();
//        $data['status']           = 1;
//        $data['review']          = $request->review;
//        $data['product_id']       = $product->id;
//        $data['user_id']          = $userId;
//
//        $review = $product->reviews()->create($data);
//
//        if ($review) {
//            Cache::forget('recent_reviews');
//        }
//
//        return redirect()->back()->with(['message' => 'Review added successfully', 'alert-type' => 'success']);
//
//    }

//    public function rate(Request $request, Product $product)
//    {
//        if (auth()->user()->rated($product)) {
//            $rating = auth()->user()->ratings()->where('product_id', $product->id)->first();
//            $rating->value = $request->value;
//            $rating->save();
//        } else {
//            $rating = new Review();
//            $rating->user_id = auth()->id();
//            $rating->product_id = $product->id;
//            $rating->value = $request->value;
//            $rating->save();
//        }
//        return back();
//    }
}
