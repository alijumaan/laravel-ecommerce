<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\FavoriteRepository;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    protected $favorite;

    public function __construct(FavoriteRepository $favorite)
    {
        $this->favorite = $favorite;
    }

    public function index()
    {
        $userFav = $this->favorite->all();
        return view('frontend.users.wishlist', compact('userFav'));
    }

    public function store(Request $request)
    {
        $this->favorite->store($request);
    }

    public function destroy($id)
    {
        $this->favorite->delete($id);
    }
}
