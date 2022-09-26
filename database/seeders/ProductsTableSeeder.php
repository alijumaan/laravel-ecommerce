<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
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
        $categories = Category::whereNotNull('parent_id')->pluck('id');

        for($i = 1; $i <= 20; $i ++) {
            $products[] = [
                'name'          => fake()->sentence(2, true),
                'slug'          => fake()->unique()->slug(2, true),
                'description'   => fake()->paragraph,
                'details'       => fake()->paragraph,
                'price'         => fake()->numberBetween(5, 200),
                'quantity'      => fake()->numberBetween(10, 100),
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
