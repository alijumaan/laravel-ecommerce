<?php

namespace App\Repositories\Frontend;

use App\Models\Product;
use App\Models\Rating;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;

class ProductRepository
{
    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function show($id)
    {
        return $this->product::with(['media', 'approved_reviews' => function($query) {
            $query->orderBy('id', 'desc');
        }])->whereHas('category', function ($query) {
            $query->whereStatus(1);
        })->whereSlug($id)->active()->first();

    }

    public function storeReview($request, $slug)
    {
        $product = $this->product::whereSlug($slug)->first();

        $userId = auth()->check() ?  auth()->id() : null;
        $userName = auth()->user()->name;
        $userEmail = auth()->user()->email;

        $data['name']             = $userName;
        $data['email']            = $userEmail;
        $data['ip_address']       = $request->ip();
        $data['status']           = 1;
        $data['review']          = $request->review;
        $data['product_id']       = $product->id;
        $data['user_id']          = $userId;

        $review = $product->reviews()->create($data);

        if ($review)
            Cache::forget('recent_reviews');

    }

    public function tag($slug)
    {
        $tag = Tag::whereSlug($slug)->orWhere('id', $slug)->first()->id;

        if ($tag){
            return $this->product::with(['media', 'tags'])
                ->whereHas('tags', function ($query) use ($slug) {
                    $query->where('slug', $slug);
                })
                ->active()
                ->orderBy('id', 'desc')
                ->paginate(5);
        }

    }

    public function rate($request, $product)
    {
        if(auth()->user()->rated($product)) {
            $rating = auth()->user()->ratings()->where('product_id', $product->id)->first();
            $rating->value = $request->value;
            $rating->save();
        } else {
            $rating = new Rating;
            $rating->user_id = auth()->id();
            $rating->product_id = $product->id;
            $rating->value = $request->value;
            $rating->save();
        }
        return back();
    }
}
