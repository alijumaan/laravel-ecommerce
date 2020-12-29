<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Review extends Model
{
    use SearchableTrait;

    protected $guarded = [];

    protected $searchable = [

        'columns' => [
            'reviews.name'       => 10,
            'reviews.email'      => 10,
            'reviews.ip_address' => 10,
            'reviews.comment'    => 10,
        ],
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
//
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->status == 1 ? 'Active' : 'Inactive';
    }
}
