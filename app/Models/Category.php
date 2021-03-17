<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Category extends Model
{
    protected $guarded = [];

    use Sluggable, SearchableTrait;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $searchable = [

        'columns' => [
            'categories.name' => 10,
            'categories.slug' => 10,
        ],
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function status()
    {
        return $this->status == 1 ? 'Active' : 'Inactive';
    }

    public function parent()
    {
        return $this->parent_id ? $this->parent_id : 'Parent';
    }

}
