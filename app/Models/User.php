<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Nicolaslopezj\Searchable\SearchableTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, searchableTrait;

    use HasFactory;

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

    // If You Use This Method To Set Password Hashed, Don't Use Hash Or Bcrypt Method Controller Or Seeder
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

//    public function setPasswordAttribute($password)
//    {
//        $this->attributes['password'] = bcrypt($password);
//    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function status()
    {
        return $this->status == 1 ? 'Active' : 'Inactive';
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
        return \Cart::session(auth()->id())->getContent();
    }

    public function orderTotal()
    {
        return \Cart::session(auth()->id())->getTotal();
    }

    public function orderSubTotal()
    {
        return \Cart::session(auth()->id())->getSubTotal();
    }

    public function totalQuantity()
    {
        return \Cart::session(auth()->id())->getTotalQuantity();
    }

    public function tax()
    {
        return $this->orderTotal() - $this->orderSubTotal();
    }

    public function ratedPurches()
    {
        return $this->belongsToMany(Product::class)->withPivot(['is_paid'])->wherePivot('id_paid', true);

    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isSuperAdmin()
    {
        return $this->role->id == 1;
    }

    public function isAdmin()
    {
        return $this->role->id <= 2;
//        return null !== $this->role()->where('role', $role)->first();
    }

    public function roleId()
    {
        switch ($this->role_id) {
            case 1:
                return 'Admin';

            case 2:
                return 'Supervisor';

            case 3:
                return 'User';
        }
    }

    public function hasAllow($permission)
    {
        $role = $this->role()->first();
        return $role->permissions()->whereName($permission)->first() ? true : false;
    }

    public function favProduct()
    {
        return $this->belongsToMany(Product::class, 'favorites')->withTimestamps();
    }

}
