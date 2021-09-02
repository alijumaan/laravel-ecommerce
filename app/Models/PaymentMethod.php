<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Nicolaslopezj\Searchable\SearchableTrait;

class PaymentMethod extends Model
{
    use HasFactory, SearchableTrait;

    protected $guarded = [];

    protected $searchable = [
        'columns' => [
            'payment_methods.name' => 10,
            'payment_methods.code' => 10,
            'payment_methods.merchant_email' => 10,
        ],
    ];

    public function getStatusAttribute(): string
    {
        return $this->attributes['status'] == 1 ? 'Active' : 'Inactive';
    }

    public function getSandboxAttribute(): string
    {
        return $this->attributes['sandbox'] == 1 ? 'Sandbox' : 'Live';
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
