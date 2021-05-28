<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{

    public function index()
    {
        $userFav = auth()->user()->favProduct()->get();

        return view('frontend.users.wishlist', compact('userFav'));
    }

    public function store(Request $request)
    {
        $request->user()->favProduct()->attach($request->id);
    }

    public function destroy($id)
    {
        auth()->user()->favProduct()->detach($id);
    }
}
