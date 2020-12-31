<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Frontend\FavoriteRepository;
use App\Repositories\Frontend\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Traits\FilterTrait;

class ProductController extends Controller
{
    use FilterTrait;

    protected $product;
    protected $favorite;

    public function __construct(ProductRepository $product, FavoriteRepository $favorite)
    {
        $this->product = $product;
        $this->favorite = $favorite;
    }

    public function index()
    {
        $query = Product::with('media', 'tags');
        $products = $this->filter($query);
        return view('frontend.product.index', compact( 'products'));
    }

    public function show($id)
    {
        $product = $this->product->show($id);
        $favorite = $this->favorite->show($product->id);

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

        $this->product->storeReview($request, $slug);

        return redirect()->back()->with(['message' => 'Review added successfully', 'alert-type' => 'success']);

    }

    public function tag($slug)
    {
        $products = $this->product->tag($slug);

        if ($products)
            return view('frontend.product.index', compact( 'products'));

        return redirect()->back();
    }

    public function rate(Request $request, Product $product)
    {
        $this->product->rate($request, $product);
    }
}
