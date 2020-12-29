<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();

        DB::table('permissions')->insert(['name' => 'add-product', 'desc' => 'Add product']);
        DB::table('permissions')->insert(['name' => 'edit-product', 'desc' => 'Edit product']);
        DB::table('permissions')->insert(['name' => 'delete-product', 'desc' => 'Delete product']);

        DB::table('permissions')->insert(['name' => 'add-category', 'desc' => 'Add category']);
        DB::table('permissions')->insert(['name' => 'edit-category', 'desc' => 'Edit category']);
        DB::table('permissions')->insert(['name' => 'delete-category', 'desc' => 'Delete category']);

        DB::table('permissions')->insert(['name' => 'add-page', 'desc' => 'Add page']);
        DB::table('permissions')->insert(['name' => 'edit-page', 'desc' => 'Edit page']);
        DB::table('permissions')->insert(['name' => 'delete-page', 'desc' => 'Delete page']);

        DB::table('permissions')->insert(['name' => 'add-coupon', 'desc' => 'Add coupon']);
        DB::table('permissions')->insert(['name' => 'edit-coupon', 'desc' => 'Edit coupon']);
        DB::table('permissions')->insert(['name' => 'delete-coupon', 'desc' => 'Delete coupon']);

        DB::table('permissions')->insert(['name' => 'edit-review', 'desc' => 'Edit review']);
        DB::table('permissions')->insert(['name' => 'delete-review', 'desc' => 'Delete review']);

        DB::table('permissions')->insert(['name' => 'add-user', 'desc' => 'Add users']);
        DB::table('permissions')->insert(['name' => 'edit-user', 'desc' => 'Edit users']);
        DB::table('permissions')->insert(['name' => 'delete-user', 'desc' => 'Delete users']);

        DB::table('permissions')->insert(['name' => 'show-message', 'desc' => 'Show message']);
        DB::table('permissions')->insert(['name' => 'delete-message', 'desc' => 'Delete message']);

    }

}

