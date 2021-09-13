<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Rest cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            'access_user_management',
            'access_permission',
            'create_permission',
            'show_permission',
            'edit_permission',
            'access_setting',
            'create_setting',
            'show_setting',
            'edit_setting',
            'delete_setting',
            'access_page',
            'create_page',
            'show_page',
            'edit_page',
            'delete_page',
            'access_supervisor',
            'create_supervisor',
            'show_supervisor',
            'edit_supervisor',
            'delete_supervisor',
            'access_role',
            'create_role',
            'show_role',
            'edit_role',
            'delete_role',
            'access_user',
            'create_user',
            'show_user',
            'edit_user',
            'delete_user',
            'access_category',
            'create_category',
            'show_category',
            'edit_category',
            'delete_category',
            'access_product',
            'create_product',
            'show_product',
            'edit_product',
            'delete_product',
            'access_coupon',
            'create_coupon',
            'show_coupon',
            'edit_coupon',
            'delete_coupon',
            'access_review',
            'create_review',
            'show_review',
            'edit_review',
            'delete_review',
            'access_shipping_company',
            'create_shipping_company',
            'show_shipping_company',
            'edit_shipping_company',
            'delete_shipping_company',
            'access_user_address',
            'create_user_address',
            'show_user_address',
            'edit_user_address',
            'delete_user_address',
            'access_payment_method',
            'create_payment_method',
            'show_payment_method',
            'edit_payment_method',
            'delete_payment_method',
            'access_order',
            'show_order',
            'edit_order',
            'delete_order',
            'access_contact',
            'show_contact',
            'edit_contact',
            'delete_contact',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}

