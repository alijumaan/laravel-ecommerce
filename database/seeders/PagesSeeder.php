<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('pages')->insert([
            'title' => "About us",
            'slug' => "about-us",
            'content' => "<p><span style='font-size: 14.4px;'></span></p><p><span style='font-size: 14.4px;'>About Us.<br></span><br></p>",
        ]);

        DB::table('pages')->insert([
            'title' => "Blog page",
            'slug' => "blog-page",
            'content' => "<p><span style='font-size: 14.4px;'></span></p><p><span style='font-size: 14.4px;'>Blog page.<br></span><br></p>",
        ]);

        DB::table('pages')->insert([
            'title' => "Privacy policy",
            'slug' => "privacy-policy",
            'content' => "<p><span style='font-size: 14.4px;'></span></p><p><span style='font-size: 14.4px;'>Privacy policy.<br></span><br></p>",
        ]);

        DB::table('pages')->insert([
            'title' => "FAQ page",
            'slug' => "faq-page",
            'content' => "<p><span style='font-size: 14.4px;'></span></p><p><span style='font-size: 14.4px;'>FAQ page.<br></span><br></p>",
        ]);

        DB::table('pages')->insert([
            'title' => "Terms and conditions",
            'slug' => "terms-and-conditions",
            'content' => "<p><span style='font-size: 14.4px;'></span></p><p><span style='font-size: 14.4px;'>Terms and conditions.<br></span><br></p>",
        ]);
    }
}
