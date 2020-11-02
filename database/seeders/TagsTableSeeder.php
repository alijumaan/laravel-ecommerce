<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create(['name' => 'Dell']);
        Tag::create(['name' => 'Hp']);
        Tag::create(['name' => 'Acer']);
        Tag::create(['name' => 'Mac']);
        Tag::create(['name' => 'Sony']);
        Tag::create(['name' => 'Toshiba']);
        Tag::create(['name' => 'Asus']);
        Tag::create(['name' => 'Samsung']);
        Tag::create(['name' => 'Apple']);
        Tag::create(['name' => 'Playstation']);
        Tag::create(['name' => 'Xbox']);
        Tag::create(['name' => 'Corsair']);
    }
}
