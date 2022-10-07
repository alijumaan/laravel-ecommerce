<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => 'Discount200',
            'type' => 'fixed',
            'value' => "200",
            'description' => 'Discount 200 SAR on your first sale',
            'use_times' => 20,
            'start_date' => Carbon::now(),
            'expire_date' => Carbon::now()->addMonth(),
            'greater_than' => 600,
            'status' => true,
            'is_public' => true
        ];
    }
}
