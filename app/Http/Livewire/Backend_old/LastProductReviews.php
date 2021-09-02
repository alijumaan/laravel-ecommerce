<?php

namespace App\Http\Livewire\Backend_old;

use App\Models\Review;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Livewire\Component;

class LastProductReviews extends Component
{
    public function render()
    {
//        $products = Product::withCount('reviews')
//            ->withCount('orderItems')
//            ->hasQuantity()
//            ->orderBy('id', 'desc')
//            ->take(5)
//            ->get();

        $products = Product::all();

        $reviews = Review::orderBy('id', 'desc')->take(5)->get();

        return view('livewire.backend.last-product-reviews', [
            'products' => $products,
            'reviews' => $reviews,
        ]);
    }
}
