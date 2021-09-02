<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderTransaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    const NEW_ORDER = 0;
    const PAID = 1;
    const UNDER_PROCESS = 2;
    const FINISHED = 3;
    const REJECTED = 4;
    const CANCELED = 5;
    const REFUNDED_REQUEST = 6;
    const RETURNED = 7;
    const REFUNDED = 8;


    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

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
}
