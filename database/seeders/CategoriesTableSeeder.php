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
        Category::create(['name' => 'Phones', 'status' => 1]);
        Category::create(['name' => 'Computers', 'status' => 1]);
        Category::create(['name' => 'Headphones', 'status' => 1]);
        Category::create(['name' => 'Televisions', 'status' => 1]);
    }
}
