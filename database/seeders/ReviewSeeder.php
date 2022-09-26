<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        Product::all()->each(function ($product) {
            for ($i = 1; $i < rand(1, 3); $i++) {
                $product->reviews()->create([
                    'user_id' => User::all()->random()->id,
                    'content' => fake()->paragraph,
                    'status' => rand(0,1),
                    'rating' => rand(1,5),
                ]);
            }
        });

        Schema::enableForeignKeyConstraints();
    }
}
