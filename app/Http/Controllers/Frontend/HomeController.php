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
        $products = Product::active()->with('media')
            ->whereHas('category', function ($query){
                $query->whereStatus(1);
            })->orderBy('id', 'desc')->paginate(8);

        return view('frontend.index', compact('products'))->with(['message' => 'searching...', 'alert-type' => 'success']);

    }

    public function search()
    {
        $query = Product::where('in_stock', '>=', 1)->with(['category', 'media', 'tags'])->whereHas('category', function ($query) {
            $query->whereStatus(1);
        });

        $products = $this->filter($query);

        return view('frontend.product.index', compact('products'))->with(['message' => 'Products not found.', 'alert-type' => 'warning']);
    }

    public function category($slug)
    {
        $category = Category::whereSlug($slug)
            ->orWhere('id', $slug)
            ->whereStatus(1)->first()->id;

        $products = Product::with('tags', 'media')
            ->whereCategoryId($category)
            ->orderBy('id', 'desc')
            ->paginate(5);

        if ($products){
            return view('frontend.product.index', compact('products'));
        }

        return redirect()->route('home');
    }

    public function archive($date)
    {
        $exploded_date = explode('-', $date);
        $month = $exploded_date[0];
        $year = $exploded_date[1];

        $products = Product::with('tags', 'media')->active()
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('frontend.product.index', compact('products'));
    }

}
