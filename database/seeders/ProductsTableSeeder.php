<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $categories = Category::whereNotNull('parent_id')->pluck('id');

        for($i = 1; $i <= 50; $i ++) {
            $products[] = [
                'name'          => $faker->sentence(2, true),
                'slug'          => $faker->unique()->slug(2, true),
                'description'   => $faker->paragraph,
                'details'       => $faker->paragraph,
                'price'         => $faker->numberBetween(5, 200),
                'quantity'      => $faker->numberBetween(10, 100),
                'category_id'   => $categories->random(),
                'featured'      => rand(0, 1),
                'status'        => true,
                'created_at'    => now(),
                'updated_at'    => now()
            ];
        }

        $chunks = array_chunk($products, 50);
        foreach ($chunks as $chunk) {
            Product::insert($chunk);
        }
    }
}
