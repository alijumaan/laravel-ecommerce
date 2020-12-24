<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Tag extends Model
{
    use HasFactory;
    use Sluggable;
    use SearchableTrait;

    protected $guarded = [];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $searchable = [
        'columns' => [
            'tags.name'        => 10,
            'tags.slug'        => 10,
        ],
    ];

//    public function products()
//    {
//        return $this->belongsToMany(Product::class);
//    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_tags');
    }
}
