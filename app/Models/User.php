<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Mindscms\Entrust\Traits\EntrustUserWithPermissionsTrait;
use Nicolaslopezj\Searchable\SearchableTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, EntrustUserWithPermissionsTrait, searchableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $searchable = [
        'columns' => [
            'users.name'        => 10,
            'users.username'    => 10,
            'users.email'       => 10,
            'users.mobile'      => 10,
            'users.bio'         => 10,
        ],
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function OrderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function status()
    {
        return $this->status == '1' ? 'Active' : 'Inactive';
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function rated(Product $product)
    {
        return $this->ratings->where('product_id', $product->id)->isNotEmpty();
    }

    public function productRating(Product $product)
    {
        return $this->rated($product) ? $this->ratings->where('product_id', $product->id)->first() : NULL;
    }

    public function productsInCart()
    {
        return $this->belongsToMany(Product::class)->withPivot(['in_stock', 'is_paid'])->wherePivot('is_paid', false);
    }

    public function ratedPurches()
    {
        return $this->belongsToMany(Product::class)->withPivot(['is_paid'])->wherePivot('id_paid', true);
    }
}
