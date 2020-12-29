<?php

namespace App\Http\Livewire\Backend;

use App\Models\Review;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Livewire\Component;

class LastProductReviews extends Component
{
    public function render()
    {
        $products = Product::whereInStock(1)->withCount('reviews')->withCount('orderItems')->orderBy('id', 'desc')->take(5)->get();
        $reviews = Review::orderBy('id', 'desc')->take(5)->get();

        return view('livewire.backend.last-product-reviews', [
            'products' => $products,
            'reviews' => $reviews,
        ]);
    }
}
