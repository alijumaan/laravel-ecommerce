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
        $images = glob(public_path('frontend/images/products/*.*'));
        foreach ($images as $image) {
            unlink($image);
        }

        $this->call(RolesTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ProductTagTableSeeder::class);
        $this->call(ProductMediaTableSeeder::class);
        $this->call(PagesSeeder::class);
        $this->call(SettingSeeder::class);
    }
}
