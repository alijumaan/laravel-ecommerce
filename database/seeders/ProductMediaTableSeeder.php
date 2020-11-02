<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductMedia;
use Illuminate\Database\Seeder;

class ProductMediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $products = Product::all();

        foreach ($products as $product) {
            for ($i = 1; $i <= 5; $i++) {
                ProductMedia::create([
                    'file_name'      => 'https://via.placeholder.com/300?text='.str_replace(' ', '+', $product->name) . '+' .$i,
                    'product_id'   => $product->id,
                ]);
            }

        }
    }
}
