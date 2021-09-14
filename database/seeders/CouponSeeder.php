<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'code' => 'ALI20',
            'type' => 'fixed',
            'value' => "200",
            'description' => 'Discount 200 SAR on your first sale',
            'use_times' => 20,
            'start_date' => Carbon::now(),
            'expire_date' => Carbon::now()->addMonth(),
            'greater_than' => 600,
            'status' => true,
            'is_public' => false
        ]);

        Coupon::create([
            'code' => 'FIFTEEN',
            'type' => 'percentage',
            'value' => "15",
            'description' => 'Discount %15 SAR on your sales',
            'use_times' => 5,
            'start_date' => Carbon::now(),
            'expire_date' => Carbon::now()->addWeek(),
            'greater_than' => null,
            'status' => true,
            'is_public' => true
        ]);
    }
}
