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

        // MAIN
        $manageMain = Permission::create(['name' => 'main', 'display_name' => 'Main', 'description' => 'Administrator Dashboard', 'route' => 'index', 'module' => 'index', 'as' => 'index', 'icon' => 'fa fa-home', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '1']);
        $manageMain->parent_show = $manageMain->id; $manageMain->save();

        // PRODUCTS
        $manageProducts = Permission::create(['name' => 'manage_products', 'display_name' => 'Manage Products', 'route' => 'products', 'module' => 'products', 'as' => 'products.index', 'icon' => 'fas fa-shopping-basket', 'parent' => '0', 'parent_original' => '0', 'appear' => '1', 'ordering' => '5']);
        $manageProducts->parent_show = $manageProducts->id; $manageProducts->save();
        $showProducts = Permission::create(['name' => 'show_products', 'display_name' => 'Products', 'route' => 'products', 'module' => 'products', 'as' => 'products.index', 'icon' => 'fas fa-shopping-basket', 'parent' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'appear' => '1', 'ordering' => '0']);
        $createProducts = Permission::create(['name' => 'create_products', 'display_name' => 'Create Products', 'route' => 'products/create', 'module' => 'products', 'as' => 'products.create', 'icon' => null, 'parent' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'appear' => '0', 'ordering' => '0']);
        $displayProducts = Permission::create(['name' => 'display_products', 'display_name' => 'Show Products', 'route' => 'products/{product}', 'module' => 'products', 'as' => 'products.show', 'icon' => null, 'parent' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'appear' => '0', 'ordering' => '0']);
        $updateProducts = Permission::create(['name' => 'update_products', 'display_name' => 'Update Products', 'route' => 'products/{product}/edit', 'module' => 'products', 'as' => 'products.edit', 'icon' => null, 'parent' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'appear' => '0', 'ordering' => '0']);
        $destroyProducts = Permission::create(['name' => 'delete_products', 'display_name' => 'Delete Products', 'route' => 'products/{product}', 'module' => 'products', 'as' => 'products.destroy', 'icon' => null, 'parent' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'appear' => '0', 'ordering' => '0']);

        // PRODUCTS COMMENTS
        $manageComments = Permission::create(['name' => 'manage_product_comments', 'display_name' => 'Manage Comments', 'route' => 'product-comments', 'module' => 'product_comments', 'as' => 'product-comments.index', 'icon' => 'fas fa-comments-alt', 'parent' => $manageProducts->id, 'parent_original' => '0', 'appear' => '0', 'ordering' => '10']);
        $manageComments->parent_show = $manageComments->id; $manageComments->save();
        $createComments = Permission::create(['name' => 'create_product_comments', 'display_name' => 'Create Comments', 'route' => 'product-comments/create', 'module' => 'product_comments', 'as' => 'product-comments.create', 'icon' => null, 'parent' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'parent_original' => $manageComments->id, 'appear' => '0', 'ordering' => '0']);
        $updateComments = Permission::create(['name' => 'update_product_comments', 'display_name' => 'Update Comments', 'route' => 'product-comments/{product_comment}/edit', 'module' => 'product_comments', 'as' => 'product-comments.edit', 'icon' => null, 'parent' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'parent_original' => $manageComments->id, 'appear' => '0', 'ordering' => '0']);
        $destroyComments = Permission::create(['name' => 'delete_product_comments', 'display_name' => 'Delete Comments', 'route' => 'product-comments/{product_comment}', 'module' => 'product_comments', 'as' => 'product-comments.destroy', 'icon' => null, 'parent' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'parent_original' => $manageComments->id, 'appear' => '0', 'ordering' => '0']);

        // PRODUCTS CATEGORIES
        $manageProductCategories = Permission::create(['name' => 'manage_product_categories', 'display_name' => 'Manage Product Categories', 'route' => 'product-categories', 'module' => 'product_categories', 'as' => 'product-categories.index', 'icon' => 'fas fa-comments-alt', 'parent' => $manageProducts->id, 'parent_original' => '0', 'appear' => '0', 'ordering' => '15']);
        $manageProductCategories->parent_show = $manageProductCategories->id; $manageProductCategories->save();
        $showProductCategories = Permission::create(['name' => 'show_product_categories', 'display_name' => 'Product Categories', 'route' => 'product-categories', 'module' => 'product_categories', 'as' => 'product-categories.index', 'icon' => 'fas fa-shopping-basket', 'parent' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'parent_original' => $manageProductCategories->id, 'appear' => '1', 'ordering' => '0']);
        $createProductCategories = Permission::create(['name' => 'create_product_categories', 'display_name' => 'Create Product Categories', 'route' => 'product-categories/create', 'module' => 'product_categories', 'as' => 'product-categories.create', 'icon' => null, 'parent' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'parent_original' => $manageProductCategories->id, 'appear' => '0', 'ordering' => '0']);
        $updateProductCategories = Permission::create(['name' => 'update_product_categories', 'display_name' => 'Update Product Categories', 'route' => 'product-categories/{product_category}/edit', 'module' => 'product_categories', 'as' => 'product-categories.edit', 'icon' => null, 'parent' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'parent_original' => $manageProductCategories->id, 'appear' => '0', 'ordering' => '0']);
        $destroyProductCategories = Permission::create(['name' => 'delete_product_categories', 'display_name' => 'Delete Product Categories', 'route' => 'product-categories/{product_category}', 'module' => 'product_categories', 'as' => 'product-categories.destroy', 'icon' => null, 'parent' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'parent_original' => $manageProductCategories->id, 'appear' => '0', 'ordering' => '0']);

        // Tags
        $manageTags = Permission::create(['name' => 'manage_tags', 'display_name' => 'Manage Tags', 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.index', 'icon' => 'fas fa-tags', 'parent' => '0', 'parent_original' => '0', 'appear' => '1', 'ordering' => '20']);
        $manageTags->parent_show = $manageTags->id; $manageTags->save();
        $showTags = Permission::create(['name' => 'show_tags', 'display_name' => 'Tags', 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.index', 'icon' => 'fas fa-tags', 'parent' => $manageTags->id, 'parent_show' => $manageTags->id, 'parent_original' => $manageTags->id, 'appear' => '1', 'ordering' => '0']);
        $createTags = Permission::create(['name' => 'create_tags', 'display_name' => 'Create Tags', 'route' => 'tags/create', 'module' => 'tags', 'as' => 'product-tags.create', 'icon' => null, 'parent' => $manageTags->id, 'parent_show' => $manageTags->id, 'parent_original' => $manageTags->id, 'appear' => '0', 'ordering' => '0']);
        $updateTags = Permission::create(['name' => 'update_tags', 'display_name' => 'Update Tags', 'route' => 'tags/{tag}/edit', 'module' => 'tags', 'as' => 'tags.edit', 'icon' => null, 'parent' => $manageTags->id, 'parent_show' => $manageTags->id, 'parent_original' => $manageTags->id, 'appear' => '0', 'ordering' => '0']);
        $destroyTags = Permission::create(['name' => 'delete_tags', 'display_name' => 'Delete Tags', 'route' => 'tags/{tag}', 'module' => 'tags', 'as' => 'tags.destroy', 'icon' => null, 'parent' => $manageTags->id, 'parent_show' => $manageTags->id, 'parent_original' => $manageTags->id, 'appear' => '0', 'ordering' => '0']);

        // CONTACT US
        $manageContactUs = Permission::create(['name' => 'manage_contact_us', 'display_name' => 'Manage Contact Us', 'route' => 'contacts', 'module' => 'contacts', 'as' => 'contacts.index', 'icon' => 'fas fa-shopping-basket', 'parent' => '0', 'parent_original' => '0', 'appear' => '1', 'ordering' => '25']);
        $manageContactUs->parent_show = $manageContactUs->id; $manageContactUs->save();
        $showContactUs = Permission::create(['name' => 'show_contact_us', 'display_name' => 'Contact Us', 'route' => 'contacts', 'module' => 'contacts', 'as' => 'contacts.index', 'icon' => 'fas fa-shopping-basket', 'parent' => $manageContactUs->id, 'parent_show' => $manageContactUs->id, 'parent_original' => $manageContactUs->id, 'appear' => '1', 'ordering' => '0']);
        $displayContactUs = Permission::create(['name' => 'display_contact_us', 'display_name' => 'Display Message', 'route' => 'contacts/{contact}', 'module' => 'contacts', 'as' => 'contacts.show', 'icon' => null, 'parent' => $manageContactUs->id, 'parent_show' => $manageContactUs->id, 'parent_original' => $manageContactUs->id, 'appear' => '0', 'ordering' => '0']);

        // Orders
        $manageOrders = Permission::create(['name' => 'manage_orders', 'display_name' => 'Manage Orders', 'route' => 'orders', 'module' => 'orders', 'as' => 'orders.index', 'icon' => 'fas fa-shopping-basket', 'parent' => '0', 'parent_original' => '0', 'appear' => '1', 'ordering' => '30']);
        $manageOrders->parent_show = $manageOrders->id; $manageOrders->save();
        $createOrders = Permission::create(['name' => 'create_orders', 'display_name' => 'Create Orders', 'route' => 'orders/create', 'module' => 'orders', 'as' => 'orders.create', 'icon' => null, 'parent' => $manageOrders->id, 'parent_show' => $manageOrders->id, 'parent_original' => $manageOrders->id, 'appear' => '0', 'ordering' => '0']);
        $updateOrders = Permission::create(['name' => 'update_orders', 'display_name' => 'Update Orders', 'route' => 'orders/{order}/edit', 'module' => 'orders', 'as' => 'orders.edit', 'icon' => null, 'parent' => $manageOrders->id, 'parent_show' => $manageOrders->id, 'parent_original' => $manageOrders->id, 'appear' => '0', 'ordering' => '0']);
        $showOrders = Permission::create(['name' => 'show_orders', 'display_name' => 'Show Orders', 'route' => 'orders/{order}', 'module' => 'orders', 'as' => 'orders.index', 'icon' => 'fas fa-shopping-basket', 'parent' => $manageOrders->id, 'parent_show' => $manageOrders->id, 'parent_original' => $manageOrders->id, 'appear' => '1', 'ordering' => '0']);
        $displayOrders = Permission::create(['name' => 'display_orders', 'display_name' => 'Display Orders', 'route' => 'orders/{order}', 'module' => 'orders', 'as' => 'orders.show', 'icon' => null, 'parent' => $manageOrders->id, 'parent_show' => $manageOrders->id, 'parent_original' => $manageOrders->id, 'appear' => '0', 'ordering' => '0']);

        // Coupons
        $manageCoupons = Permission::create(['name' => 'manage_coupons', 'display_name' => 'Manage Coupons', 'route' => 'coupons', 'module' => 'coupons', 'as' => 'coupons.index', 'icon' => 'fas fa-shopping-basket', 'parent' => '0', 'parent_original' => '0', 'appear' => '1', 'ordering' => '35']);
        $manageCoupons->parent_show = $manageCoupons->id; $manageCoupons->save();
        $showCoupons = Permission::create(['name' => 'show_coupons', 'display_name' => 'Coupons', 'route' => 'coupons', 'module' => 'coupons', 'as' => 'coupons.index', 'icon' => 'fas fa-shopping-basket', 'parent' => $manageCoupons->id, 'parent_show' => $manageCoupons->id, 'parent_original' => $manageCoupons->id, 'appear' => '1', 'ordering' => '0']);
        $createCoupons = Permission::create(['name' => 'create_coupons', 'display_name' => 'Create Coupons', 'route' => 'coupons/create', 'module' => 'coupons', 'as' => 'product-coupons.create', 'icon' => null, 'parent' => $manageCoupons->id, 'parent_show' => $manageCoupons->id, 'parent_original' => $manageCoupons->id, 'appear' => '0', 'ordering' => '0']);
        $updateCoupons = Permission::create(['name' => 'update_coupons', 'display_name' => 'Update coupons', 'route' => 'coupons/{coupon}/edit', 'module' => 'coupons', 'as' => 'coupons.edit', 'icon' => null, 'parent' => $manageCoupons->id, 'parent_show' => $manageCoupons->id, 'parent_original' => $manageCoupons->id, 'appear' => '0', 'ordering' => '0']);
        $destroyCoupons = Permission::create(['name' => 'delete_coupons', 'display_name' => 'Delete coupons', 'route' => 'coupons/{coupon}', 'module' => 'coupons', 'as' => 'coupons.destroy', 'icon' => null, 'parent' => $manageCoupons->id, 'parent_show' => $manageCoupons->id, 'parent_original' => $manageCoupons->id, 'appear' => '0', 'ordering' => '0']);


        //USERS
        $manageUsers = Permission::create(['name' => 'manage_users', 'display_name' => 'Manage Users', 'route' => 'users', 'module' => 'users', 'as' => 'users.index', 'icon' => 'fas fa-shopping-user', 'parent' => '0', 'parent_original' => '0', 'appear' => '1', 'ordering' => '40']);
        $manageUsers->parent_show = $manageUsers->id; $manageUsers->save();
        $showUsers = Permission::create(['name' => 'show_users', 'display_name' => 'Users', 'route' => 'users', 'module' => 'users', 'as' => 'users.index', 'icon' => 'fas fa-shopping-basket', 'parent' => $manageUsers->id, 'parent_show' => $manageUsers->id, 'parent_original' => $manageUsers->id, 'appear' => '1', 'ordering' => '0']);
        $createUsers = Permission::create(['name' => 'create_users', 'display_name' => 'Create Users', 'route' => 'users/create', 'module' => 'users', 'as' => 'users.create', 'icon' => null, 'parent' => $manageUsers->id, 'parent_show' => $manageUsers->id, 'parent_original' => $manageUsers->id, 'appear' => '0', 'ordering' => '0']);
        $displayUsers = Permission::create(['name' => 'display_users', 'display_name' => 'Show Users', 'route' => 'users/{user}', 'module' => 'users', 'as' => 'users.show', 'icon' => null, 'parent' => $manageUsers->id, 'parent_show' => $manageUsers->id, 'parent_original' => $manageUsers->id, 'appear' => '0', 'ordering' => '0']);
        $updateUsers = Permission::create(['name' => 'update_users', 'display_name' => 'Update Users', 'route' => 'users/{user}/edit', 'module' => 'users', 'as' => 'users.edit', 'icon' => null, 'parent' => $manageUsers->id, 'parent_show' => $manageUsers->id, 'parent_original' => $manageUsers->id, 'appear' => '0', 'ordering' => '0']);
        $destroyUsers = Permission::create(['name' => 'delete_users', 'display_name' => 'Delete Users', 'route' => 'users/{user}', 'module' => 'users', 'as' => 'users.destroy', 'icon' => null, 'parent' => $manageUsers->id, 'parent_show' => $manageUsers->id, 'parent_original' => $manageUsers->id, 'appear' => '0', 'ordering' => '0']);

        // EDITORS
        // SUPERVISORS
        $manageSupervisors = Permission::create(['name' => 'manage_supervisors', 'display_name' => 'Manage Supervisors', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.index', 'icon' => 'fas fa-shopping-basket', 'parent' => '0', 'parent_original' => '0', 'appear' => '0', 'ordering' => '700', 'sidebar_link' => '0']);
        $manageSupervisors->parent_show = $manageSupervisors->id; $manageSupervisors->save();
        $showSupervisors = Permission::create(['name' => 'show_supervisor', 'display_name' => 'Supervisors', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.index', 'icon' => 'fas fa-shopping-shield', 'parent' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'appear' => '1', 'ordering' => '0']);
        $createSupervisors = Permission::create(['name' => 'create_supervisors', 'display_name' => 'Create Supervisors', 'route' => 'supervisors/create', 'module' => 'supervisor', 'as' => 'supervisors.create', 'icon' => null, 'parent' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'appear' => '0', 'ordering' => '0']);
        $displaySupervisors = Permission::create(['name' => 'display_supervisors', 'display_name' => 'Show Supervisors', 'route' => 'supervisors/{supervisor}', 'module' => 'supervisors', 'as' => 'supervisors.show', 'icon' => null, 'parent' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'appear' => '0', 'ordering' => '0']);
        $updateSupervisors = Permission::create(['name' => 'update_supervisors', 'display_name' => 'Update Supervisors', 'route' => 'supervisors/{supervisor}/edit', 'module' => 'supervisor', 'as' => 'supervisors.edit', 'icon' => null, 'parent' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'appear' => '0', 'ordering' => '0']);
        $destroySupervisors = Permission::create(['name' => 'delete_supervisors', 'display_name' => 'Delete Supervisors', 'route' => 'supervisors/{supervisor}', 'module' => 'supervisor', 'as' => 'supervisors.destroy', 'icon' => null, 'parent' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'appear' => '0', 'ordering' => '0']);

        // SETTINGS
        $manageSettings = Permission::create(['name' => 'manage_settings', 'display_name' => 'Manage Settings', 'route' => 'settings', 'module' => 'supervisors', 'as' => 'supervisors.index', 'icon' => 'fas fa-shopping-basket', 'parent' => '0', 'parent_original' => '0', 'appear' => '0', 'ordering' => '600', 'sidebar_link' => '0']);
        $manageSettings->parent_show = $manageSettings->id; $manageSettings->save();
        $showSettings = Permission::create(['name' => 'show_settings', 'display_name' => 'Settings', 'route' => 'settings', 'module' => 'settings', 'as' => 'settings.index', 'icon' => 'fas fa-shopping-cog', 'parent' => $manageSettings->id, 'parent_show' => $manageSettings->id, 'parent_original' => $manageSettings->id, 'appear' => '1', 'ordering' => '0']);
        $updateSettings = Permission::create(['name' => 'update_settings', 'display_name' => 'Update Settings', 'route' => 'settings', 'module' => 'settings', 'as' => 'settings.edit', 'icon' => null, 'parent' => $manageSettings->id, 'parent_show' => $manageSettings->id, 'parent_original' => $manageSettings->id, 'appear' => '0', 'ordering' => '0']);

    }

}

