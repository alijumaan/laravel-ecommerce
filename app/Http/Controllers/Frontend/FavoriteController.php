<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
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

    public function destroy(Favorite $favorite)
    {
        auth()->user()->favProduct()->detach($favorite);
    }
}
