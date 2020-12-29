<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
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

        $categories = Category::all();

        foreach ($categories as $category)  {
            for ($i = 1; $i <= 5; $i++) {
                $product = Product::create([
                    'name'      => $category->name . ' ' . $i,
                    'description'   => $faker->paragraph(),
                    'details'   => $faker->paragraph(),
                    'price'   => $faker->randomFloat(2, 100, 5000),
                    'in_stock'   => $faker->numberBetween(50, 2000),
                    'category_id'   => $category->id,
                ]);

                /*I Did It In ProductsTagsTableSeeder
                 *
                $tags = Tag::inRandomOrder()->take(3)->pluck('id')->toArray();
                $product->tags()->attach($tags);
                *
                */
            }
        }
    }
}
