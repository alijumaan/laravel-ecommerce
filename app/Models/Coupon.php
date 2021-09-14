<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Coupon extends Model
{
    use HasFactory, SearchableTrait;

    protected $guarded = [];

    protected $searchable = [
        'columns' => [
            'coupons.code' => 10,
            'coupons.description' => 10
        ],
    ];

    protected $dates = ['start_date', 'expire_date'];

    public function getStatusAttribute(): string
    {
        return $this->attributes['status'] == 0 ? 'Inactive' : 'Active';
    }

    public function getIsPublicAttribute(): string
    {
        return $this->attributes['is_public'] == 0 ? 'Private' : 'Public';
    }

    public function scopeActive($query)
    {
        return $query->whereStatus(true);
    }

    public function scopePublic($query)
    {
        return $query->whereIsPublic(true);
    }

    public function discount($total)
    {
        if (!$this->checkDate() || !$this->checkUsedTimes()) {
            return 0;
        }
        return $this->checkGreaterThan($total) ? $this->doProcess($total) : 0;
    }

    protected function checkDate()
    {
        if ($this->expire_date != '') {
            return Carbon::now()->between($this->start_date, $this->expire_date, true);
        }
        return true;
    }

    protected function checkUsedTimes()
    {
        if ($this->use_times != '') {
            return $this->use_times > $this->used_times;
        }
        return true;
    }

    protected function checkGreaterThan($total)
    {
        if ($this->greater_than != '') {
            return $this->greater_than <= $total;
        }
        return true;
    }

    protected function doProcess($total)
    {
        switch ($this->type) {
            case 'fixed':
                return $this->value;
            case 'percentage':
                return ($this->value / 100) * $total;
            default:
                return 0;
        }
    }
}
