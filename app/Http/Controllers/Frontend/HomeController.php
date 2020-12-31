<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Frontend\HomeRepository;
use App\Traits\FilterTrait;

class HomeController extends Controller
{
    use FilterTrait;

    public $homeRepository;
    public $product;

    public function __construct(HomeRepository $homeRepository, Product $product)
    {
        $this->homeRepository = $homeRepository;
        $this->product = $product;
    }

    public function index()
    {
        $products = $this->homeRepository->index();

        return view('frontend.index', compact('products'))->with(['message' => 'searching...', 'alert-type' => 'success']);

    }

    public function search()
    {
        $query = $this->product::where('in_stock', '>=', 1)->with(['category', 'media', 'tags'])->whereHas('category', function ($query)
        {
            $query->whereStatus(1);
        });

        $products = $this->filter($query);

        return view('frontend.product.index', compact('products'))->with(['message' => 'Products not found.', 'alert-type' => 'warning']);
    }

    public function category($slug)
    {
        $products = $this->homeRepository->category($slug);

        if ($products)
            return view('frontend.product.index', compact('products'));

        return redirect()->route('home');
    }

    public function archive($date)
    {
        $products = $this->homeRepository->archive($date);

        return view('frontend.product.index', compact('products'));
    }

}
