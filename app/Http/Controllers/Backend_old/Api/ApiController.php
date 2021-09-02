<?php

namespace App\Http\Controllers\Backend_old\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function orders_chart()
    {
        $orders = Order::select(DB::raw('COUNT(*) as count'), DB::raw('Month(created_at) as month'))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('Month(created_at)'))
            ->pluck('count', 'month');

        foreach ($orders->keys() as $month_number) {
            $labels[] = date('F', mktime(0, 0, 0, $month_number, 1));
        }

        $chart['labels'] = $labels;
        $chart['datasets'][0]['name'] = 'Orders';
        $chart['datasets'][0]['values'] = $orders->values()->toArray();

        return response()->json($chart);

    }

    public function products_chart()
    {
        $products = Product::withCount('orders')
            ->orderBy('orders_count', 'desc')
            ->take(3)
            ->pluck('orders_count', 'name');

        $chart['labels'] = $products->keys()->toArray();
        $chart['datasets']['name'] = 'To Products';
        $chart['datasets']['values'] = $products->values()->toArray();

        return response()->json($chart);
    }
}
