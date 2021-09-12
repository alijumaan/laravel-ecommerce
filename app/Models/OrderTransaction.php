<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderTransaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const NEW_ORDER = 0;
    public const PAID = 1;
    public const UNDER_PROCESS = 2;
    public const FINISHED = 3;
    public const REJECTED = 4;
    public const CANCELED = 5;
    public const REFUNDED_REQUEST = 6;
    public const RETURNED = 7;
    public const REFUNDED = 8;

    public function status($transactionStatus = null)
    {
        $transaction = $transactionStatus != '' ? $transactionStatus : $this->transaction_status;

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

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
