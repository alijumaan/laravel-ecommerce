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
//        $images = glob(public_path('frontend/images/products/*.*'));
//        foreach ($images as $image) {
//            unlink($image);
//        }

        $this->call(WorldSeeder::class);
        $this->call(WorldStatusSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(SupervisorSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UserAddressSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ProductTagTableSeeder::class);
        $this->call(ReviewSeeder::class);
//        $this->call(ProductMediaTableSeeder::class);
        $this->call(PagesSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(ShippingCompanySeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(CouponSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(LinkSeeder::class);
    }
}
