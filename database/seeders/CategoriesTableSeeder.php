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
        Category::create(['name' => 'Phones']);
        Category::create(['name' => 'Computers']);
        Category::create(['name' => 'Headphones']);
        Category::create(['name' => 'Televisions']);
    }
}
