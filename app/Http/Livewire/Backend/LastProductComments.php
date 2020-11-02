<?php

namespace App\Http\Livewire\Backend;

use App\Models\Comment;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Livewire\Component;

class LastProductComments extends Component
{
    public function render()
    {
        $products = Product::whereStatus(1)->withCount('comments')->withCount('orderItems')->orderBy('id', 'desc')->take(5)->get();
        $comments = Comment::orderBy('id', 'desc')->take(5)->get();

        return view('livewire.backend.last-product-comments', [
            'products' => $products,
            'comments' => $comments,
        ]);
    }
}
