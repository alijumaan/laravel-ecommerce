<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (app()->environment('local')) {
            $this->call([
                WorldSeeder::class,
                WorldStatusSeeder::class,
                PermissionTableSeeder::class,
                AdminSeeder::class,
                SupervisorSeeder::class,
                UserSeeder::class,
                UserAddressSeeder::class,
                CategoriesTableSeeder::class,
                TagsTableSeeder::class,
                ProductsTableSeeder::class,
                ProductTagTableSeeder::class,
                ReviewSeeder::class,
//                ProductMediaTableSeeder::class,
                PagesSeeder::class,
                SettingSeeder::class,
                ShippingCompanySeeder::class,
                PaymentMethodSeeder::class,
                CouponSeeder::class,
                OrderSeeder::class,
                LinkSeeder::class,
            ]);
        }
    }
}
