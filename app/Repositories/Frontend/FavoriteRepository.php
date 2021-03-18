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
        return auth()->user()->favProduct;
    }

    public function store($request)
    {
        $request->user()->favProduct()->attach($request->id);
    }

    public function show($id)
    {
        if (auth()->check())
        {
            $favorite = Auth::user()->favProduct()->whereProduct_id($id)->first();

            return $favorite ? true : false;
        }
    }

    public function delete($id)
    {
        auth()->user()->favProduct()->detach($id);
    }


}
