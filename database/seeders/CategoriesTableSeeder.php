<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clothes = Category::create(['name' => 'Clothes', 'status' => true]);
        Category::create(['name' => 'Women\' Clothes', 'status' => true, 'parent_id' => $clothes->id]);
        Category::create(['name' => 'Men\' Clothes', 'status' => true, 'parent_id' => $clothes->id]);
        Category::create(['name' => 'Boy\' Clothes', 'status' => true, 'parent_id' => $clothes->id]);
        Category::create(['name' => 'Girls\' Clothes', 'status' => true, 'parent_id' => $clothes->id]);


        $shoes = Category::create(['name' => 'Shoes', 'status' => true]);
        Category::create(['name' => 'Women\' Shoes', 'status' => true, 'parent_id' => $shoes->id]);
        Category::create(['name' => 'Men\' Shoes', 'status' => true, 'parent_id' => $shoes->id]);
        Category::create(['name' => 'Boy\' Shoes', 'status' => true, 'parent_id' => $shoes->id]);
        Category::create(['name' => 'Girls\' Shoes', 'status' => true, 'parent_id' => $shoes->id]);

        $watches = Category::create(['name' => 'Watches', 'status' => true]);
        Category::create(['name' => 'Women\' Watches', 'status' => true, 'parent_id' => $watches->id]);
        Category::create(['name' => 'Men\' Watches', 'status' => true, 'parent_id' => $watches->id]);
        Category::create(['name' => 'Boy\' Watches', 'status' => true, 'parent_id' => $watches->id]);
        Category::create(['name' => 'Girls\' Watches', 'status' => true, 'parent_id' => $watches->id]);

        $electronics = Category::create(['name' => 'Electronics', 'status' => true]);
        Category::create(['name' => 'USB Flash drives', 'status' => true, 'parent_id' => $electronics->id]);
        Category::create(['name' => 'Headphone', 'status' => true, 'parent_id' => $electronics->id]);
        Category::create(['name' => 'Portable speakers', 'status' => true, 'parent_id' => $electronics->id]);
        Category::create(['name' => 'Keyboards', 'status' => true, 'parent_id' => $electronics->id]);
    }
}
