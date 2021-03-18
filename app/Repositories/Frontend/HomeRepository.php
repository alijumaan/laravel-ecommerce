<?php

namespace App\Repositories\Frontend;

use App\Models\Category;
use App\Models\Product;

class HomeRepository
{
    public $product;
    public $category;

    public function __construct(Product $product, Category $category)
    {
        $this->product = $product;
        $this->category = $category;
    }

    public function index()
    {
        return $this->product::active()->with('media')
            ->whereHas('category', function ($query){
                $query->whereStatus(1);
            })->orderBy('id', 'desc')->paginate(8);
    }

    public function category($slug)
    {
        $category = $this->category::whereSlug($slug)->orWhere('id', $slug)->whereStatus(1)->first()->id;

        return $this->product::with('tags', 'media')
            ->whereCategoryId($category)
            ->orderBy('id', 'desc')
            ->paginate(5);

    }

    public function archive($date)
    {
        $exploded_date = explode('-', $date);
        $month = $exploded_date[0];
        $year = $exploded_date[1];

        return Product::with('tags', 'media')->active()
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->paginate(5);
    }
}
