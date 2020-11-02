<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
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

        $products = Product::orderBy($sortBy, $orderBy);
        $products = $products->paginate($limitBy);

        if ($keyword != null) {
            $products = $products->search($keyword);
        }
        if ($categoryId != null) {
            $products = $products->whereCategoryId($categoryId);
        }

        return view('front.product.index', compact( 'products'));
    }

    public function show($id)
    {
        $product = Product::with(['media',
            'approved_comments' => function($query) {
                $query->orderBy('id', 'desc');
            }
        ]);

        $product = $product->whereHas('category', function ($query) {
            $query->whereStatus(1);
        });

        $product = $product->whereSlug($id);
        $product = $product->whereStatus(1)->first();

        if ($product) {
            return view('front.product.show', compact('product'));
        }else {
            return redirect()->route('home');
        }

    }

    public function store_comment(Request $request, $slug)
    {
        $validation = Validator::make($request->all(), [
            'name'    => 'required',
            'email'   => 'required|email',
            'comment' => 'required',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $product = Product::whereSlug($slug)->whereStatus(1)->first();
        if ($product) {

            $userId = auth()->check() ?  auth()->id() : null;

            $data['name']             = $request->name;
            $data['email']            = $request->email;
            $data['ip_address']       = $request->ip();
            $data['status']           = 1;
            $data['comment']          = $request->comment;
            $data['product_id']       = $product->id;
            $data['user_id']          = $userId;

            $comment = $product->comments()->create($data);

            if ($comment) {

                Cache::forget('recent_comments');

                return redirect()->back()->with([
                    'message' => 'Comment added successfully',
                    'alert-type' => 'success'
                ]);
            }

            return redirect()->back()->with([
                'message' => 'Something was wrong',
                'alert-type' => 'warning'
            ]);

        }

        return redirect()->back()->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger'
        ]);

    }

    public function tag($slug)
    {
        $tag = Tag::whereSlug($slug)->orWhere('id', $slug)->first()->id;

        if ($tag) {
            $products = Product::with(['media', 'tags', 'category'])
                ->whereHas('tags', function ($query) use ($slug) {
                    $query->where('slug', $slug);
                })
                ->active()
                ->orderBy('id', 'desc')
                ->paginate(5);

            return view('front.product.index', compact( 'products'));
        }

        return redirect()->back();
    }
}
