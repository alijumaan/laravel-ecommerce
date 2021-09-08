<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::active()->whereParentId(null)->limit(4)->get();

        return view('frontend.index', compact('categories'));
    }

    public function search(Request $request)
    {
        $data = Product::where('name', 'LIKE', '%'.$request->searchName. '%')
            ->active()
            ->hasQuantity()
            ->activeCategory()
            ->take(5)
            ->get();

        return response()->json($data);
    }
}
