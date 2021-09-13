<?php

namespace Database\Seeders;

use App\Models\Link;
use Illuminate\Database\Seeder;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Link::whereStatus(true)->create([
            'title' => 'Orders',
            'as' => 'Order',
            'to' => 'admin.orders.index',
            'icon' => 'fas fa-shopping-basket',
            'permission_title' => 'access_order',
            'status' => 1,
        ]);

        Link::whereStatus(true)->create([
            'title' => 'Users',
            'as' => 'User',
            'to' => 'admin.users.index',
            'icon' => 'fas fa-users',
            'permission_title' => 'access_user',
            'status' => 1,
        ]);

        Link::whereStatus(true)->create([
            'title' => 'Categories',
            'as' => 'Category',
            'to' => 'admin.categories.index',
            'icon' => 'fas fa-bars',
            'permission_title' => 'access_category',
            'status' => 1,
        ]);

        Link::whereStatus(true)->create([
            'title' => 'Products',
            'as' => 'Product',
            'to' => 'admin.products.index',
            'icon' => 'fas fa-tshirt',
            'permission_title' => 'access_product',
            'status' => 1,
        ]);

        Link::whereStatus(true)->create([
            'title' => 'Coupons',
            'as' => 'Coupon',
            'to' => 'admin.coupons.index',
            'icon' => 'fas fa-gift',
            'permission_title' => 'access_coupon',
            'status' => 1,
        ]);

        Link::whereStatus(true)->create([
            'title' => 'Product Reviews',
            'as' => 'Review',
            'to' => 'admin.reviews.index',
            'icon' => 'fas fa-comment',
            'permission_title' => 'access_review',
            'status' => 1,
        ]);

        Link::whereStatus(true)->create([
            'title' => 'Countries',
            'as' => 'Country',
            'to' => 'admin.countries.index',
            'icon' => 'far fa-flag',
            'permission_title' => 'access_country',
            'status' => 1,
        ]);

        Link::whereStatus(true)->create([
            'title' => 'States',
            'as' => 'State',
            'to' => 'admin.states.index',
            'icon' => 'fas fa-map-marker-alt',
            'permission_title' => 'access_state',
            'status' => 1,
        ]);

        Link::whereStatus(true)->create([
            'title' => 'Cities',
            'as' => 'City',
            'to' => 'admin.cities.index',
            'icon' => 'fas fa-city',
            'permission_title' => 'access_city',
            'status' => 1,
        ]);

        Link::whereStatus(true)->create([
            'title' => 'Tags',
            'as' => 'Tag',
            'to' => 'admin.tags.index',
            'icon' => 'fas fa-tags',
            'permission_title' => 'access_tag',
            'status' => 1,
        ]);

        Link::whereStatus(true)->create([
            'title' => 'User Addresses',
            'as' => 'Address',
            'to' => 'admin.user_addresses.index',
            'icon' => 'fas fa-address-book',
            'permission_title' => 'access_user_address',
            'status' => 1,
        ]);

        Link::whereStatus(true)->create([
            'title' => 'Shipping companies',
            'as' => 'Shipping',
            'to' => 'admin.shipping_companies.index',
            'icon' => 'fas fa-shipping-fast',
            'permission_title' => 'access_shipping_company',
            'status' => 1,
        ]);

        Link::whereStatus(true)->create([
            'title' => 'Payment methods',
            'as' => 'Payment',
            'to' => 'admin.payment_methods.index',
            'icon' => 'fas fa-money-check-alt',
            'permission_title' => 'access_payment_method',
            'status' => 1,
        ]);

        Link::whereStatus(true)->create([
            'title' => 'Contacts',
            'as' => 'Contact',
            'to' => 'admin.contacts.index',
            'icon' => 'far fa-comment',
            'permission_title' => 'access_contact',
            'status' => 1,
        ]);

        Link::whereStatus(true)->create([
            'title' => 'Pages',
            'as' => 'Page',
            'to' => 'admin.pages.index',
            'icon' => 'far fa-file',
            'permission_title' => 'access_page',
            'status' => 1,
        ]);

    }
}
