<?php

namespace App\Repositories\Frontend;

use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteRepository
{

    protected $favorite;

    public function __construct(Favorite $favorite)
    {
        $this->favorite = $favorite;
    }

    public function all()
    {
        return Auth::user()->favProduct;
    }

    public function store($request)
    {
        $request->user()->favProduct()->attach($request->id);
    }

    public function show($id)
    {
        if (Auth::check())
        {
            $favorite = Auth::user()->favProduct()->whereProduct_id($id)->first();

            return $favorite ? true : false;
        }
    }

    public function delete($id)
    {
        Auth::user()->favProduct()->detach($id);
    }


}
