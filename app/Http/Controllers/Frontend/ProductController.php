<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use App\Traits\FilterTrait;

class ProductController extends Controller
{
    use FilterTrait;

    public function index()
    {
        $query = Product::with('media', 'tags');
        $products = $this->filter($query);
        return view('frontend.product.index', compact( 'products'));
    }

    public function show($id)
    {
        $product = Product::with(['media', 'approved_reviews' => function($query) {
            $query->orderBy('id', 'desc');
        }])->whereHas('category', function ($query) {
            $query->whereStatus(1);
        })->whereSlug($id)->active()->first();

        $favorite = $this->show_favorite($product->id);

        $productFind = 0;
        if (Auth::check())
            $productFind = auth()->user()->orderItems()->where('product_id', $product->id)->where('user_id', auth()->user()->id)->where('is_paid', true)->first();

        if ($product)
            return view('frontend.product.show', compact('product', 'productFind', 'favorite'));

        return redirect()->route('home');

    }

    public function storeReview(Request $request, $slug)
    {
        $validation = Validator::make($request->all(), ['review' => 'required',]);

        if ($validation->fails()) {return redirect()->back()->withErrors($validation)->withInput();}

        $product = Product::whereSlug($slug)->first();

        $userId = auth()->check() ?  auth()->id() : null;
        $userName = auth()->user()->name;
        $userEmail = auth()->user()->email;

        $data['name']             = $userName;
        $data['email']            = $userEmail;
        $data['ip_address']       = $request->ip();
        $data['status']           = 1;
        $data['review']          = $request->review;
        $data['product_id']       = $product->id;
        $data['user_id']          = $userId;

        $review = $product->reviews()->create($data);

        if ($review) {
            Cache::forget('recent_reviews');
        }

        return redirect()->back()->with(['message' => 'Review added successfully', 'alert-type' => 'success']);

    }

    public function tag($slug)
    {
        $tag = Tag::whereSlug($slug)->orWhere('id', $slug)->first()->id;

        if ($tag) {
            $products = Product::with(['media', 'tags'])
                ->whereHas('tags', function ($query) use ($slug) {
                    $query->where('slug', $slug);
                })
                ->active()
                ->orderBy('id', 'desc')
                ->paginate(5);

            return view('frontend.product.index', compact( 'products'));
        }

        return redirect()->back();
    }

    public function rate(Request $request, Product $product)
    {
        if (auth()->user()->rated($product)) {
            $rating = auth()->user()->ratings()->where('product_id', $product->id)->first();
            $rating->value = $request->value;
            $rating->save();
        } else {
            $rating = new Rating;
            $rating->user_id = auth()->id();
            $rating->product_id = $product->id;
            $rating->value = $request->value;
            $rating->save();
        }
        return back();
    }

    public function show_favorite($id)
    {
        if (auth()->check())
        {
            $favorite = Auth::user()->favProduct()->whereProduct_id($id)->first();

            return $favorite ? true : false;
        }
    }
}
