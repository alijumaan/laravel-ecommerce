<?php

namespace App\Http\Livewire\Backend;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Livewire\Component;

class Statistics extends Component
{
    public function render()
    {

        $all_users = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->whereStatus(1)->count();

        $active_products     = Product::whereStatus(1)->count();
        $inactive_products   = Product::whereStatus(0)->count();
        $active_orders       = Order::whereStatus(1)->count();
        $inactive_orders     = Order::whereStatus(0)->count();
        $active_categories   = Category::whereStatus(1)->count();
        $inactive_categories = Category::whereStatus(0)->count();
        $active_comments     = Comment::whereStatus(1)->count();

        return view('livewire.backend.statistics', [
            'all_users'             => $all_users,
            'active_products'       => $active_products,
            'inactive_products'     => $inactive_products,
            'active_orders'         => $active_orders,
            'inactive_orders'       => $inactive_orders,
            'inactive_products'     => $inactive_products,
            'active_categories'     => $active_categories,
            'inactive_categories'   => $inactive_categories,
            'active_comments'       => $active_comments,
        ]);
    }
}
