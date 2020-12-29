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

class ProductController extends Controller
{
    public function index()
    {
        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $categoryId = (isset(\request()->category_id) && \request()->category_id != '') ? \request()->category_id : null;
        $sortBy = (isset(\request()->sort_by) && \request()->sort_by != '') ? \request()->sort_by : 'id';
        $orderBy = (isset(\request()->order_by) && \request()->order_by != '') ? \request()->order_by : 'desc';
        $limitBy = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : '15';

        $products = Product::with('media', 'tags')->orderBy($sortBy, $orderBy);
        $products = $products->paginate($limitBy);

        if ($keyword != null) {
            $products = $products->search($keyword);
        }
        if ($categoryId != null) {
            $products = $products->whereCategoryId($categoryId);
        }

        return view('frontend.product.index', compact( 'products'));
    }

    public function show($id)
    {
        $product = Product::with(['media', 'approved_reviews' => function($query) {
                $query->orderBy('id', 'desc');
            }
        ]);

        $product = $product->whereHas('category', function ($query) {
            $query->whereStatus(1);
        });

        $product = $product->whereSlug($id);
        $product = $product->active()->first();

        $productFind = 0;
        if (Auth::check()) {
            $productFind = auth()->user()->orderItems()->where('product_id', $product->id)->where('user_id', auth()->user()->id)->where('is_paid', true)->first();
        }

        if ($product) {
            return view('frontend.product.show', compact('product', 'productFind'));
        }else {
            return redirect()->route('home');
        }

    }

    public function store_review(Request $request, $slug)
    {
        $validation = Validator::make($request->all(), [
            'review' => 'required',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $product = Product::whereSlug($slug)->first();
        if ($product) {

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

                return redirect()->back()->with([
                    'message' => 'Review added successfully',
                    'alert-type' => 'success'
                ]);
            }

            return redirect()->back()->with(['message' => 'Something was wrong', 'alert-type' => 'warning']);

        }

        return redirect()->back()->with(['message' => 'Something was wrong', 'alert-type' => 'danger']);

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
        if(auth()->user()->rated($product)) {
            $rating = Rating::where(['user_id' => auth()->user()->id, 'product_id' => $product->id])->first();
            $rating->value = $request->value;
            $rating->save();
        } else {
            $rating = new Rating;
            $rating->user_id = auth()->user()->id;
            $rating->product_id = $product->id;
            $rating->value = $request->value;
            $rating->save();
        }
        return back();
    }
}
