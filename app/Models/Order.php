<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Nicolaslopezj\Searchable\SearchableTrait;

class Order extends Model
{
    use HasFactory, SearchableTrait;

    protected $guarded = [];

    protected $searchable = [
        'columns' => [
            'orders.ref_id' => 10,
            'users.first_name' => 10,
            'users.last_name' => 10,
            'users.username' => 10,
            'users.email' => 10,
            'users.phone' => 10,
            'user_addresses.address_title' => 10,
            'user_addresses.first_name' => 10,
            'user_addresses.last_name' => 10,
            'user_addresses.email' => 10,
            'user_addresses.phone' => 10,
            'user_addresses.address' => 10,
            'user_addresses.address2' => 10,
            'user_addresses.zip_code' => 10,
            'user_addresses.po_box' => 10,
            'shipping_companies.name' => 10,
            'shipping_companies.code' => 10,
        ],
        'joins' => [
            'users' => ['users.id', 'orders.user_id'],
            'user_addresses' => ['user_addresses.id', 'orders.user_address_id'],
            'shipping_companies' => ['shipping_companies.id', 'orders.shipping_company_id']
        ]
    ];

    public const NEW_ORDER = 0;
    public const PAID = 1;
    public const UNDER_PROCESS = 2;
    public const FINISHED = 3;
    public const REJECTED = 4;
    public const CANCELED = 5;
    public const REFUNDED_REQUEST = 6;
    public const RETURNED = 7;
    public const REFUNDED = 8;

    public function currency(): string
    {
        switch ($this->currency) {
            case 'USD': return '$';
            case 'SAR': return 'SR';
            default: return $this->currency;
        }
    }

    public function status($transaction_number = null)
    {
        $transaction = $transaction_number != '' ? $transaction_number : $this->order_status;

        switch ($transaction) {
            case 0: return 'New order';
            case 1: return 'Paid';
            case 2: return 'Under process';
            case 3: return 'Finished';
            case 4: return 'Rejected';
            case 5: return 'Canceled';
            case 6: return 'Refund requested';
            case 7: return 'Returned order';
            case 8: return 'Refunded';
            default: return 0;
        }
    }

    public function statusWithBadge(): string
    {
        switch ($this->order_status) {
            case 0: return '<label class="badge badge-success">New order</label>';
            case 1: return '<label class="badge badge-warning">Paid</label>';
            case 2: return '<label class="badge badge-warning">Under process</label>';
            case 3: return '<label class="badge badge-primary">Finished</label>';
            case 4: return '<label class="badge badge-danger">Rejected</label>';
            case 5: return '<label class="badge badge-dark text-white">Canceled</label>';
            case 6: return '<label class="badge bg-dark text-white">Refund requested</label>';
            case 7: return '<label class="badge bg-warning">Returned order</label>';
            case 8: return '<label class="badge bg-success text-white">Refunded order</label>';
            default: return $this->order_status;
        }
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function userAddress(): BelongsTo
    {
        return $this->belongsTo(UserAddress::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(OrderTransaction::class);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function shippingCompany(): BelongsTo
    {
        return $this->belongsTo(ShippingCompany::class);
    }
}
