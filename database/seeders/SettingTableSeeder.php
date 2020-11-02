<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create(['display_name' => 'Site Title', 'key' => 'site_title', 'value' => 'Cart White', 'type' => 'text', 'section' => 'general', 'ordering' => 1]);
        Setting::create(['display_name' => 'Site Slogan', 'key' => 'site_slogan', 'value' => 'Amazing shop!', 'type' => 'text', 'section' => 'general', 'ordering' => 2]);
        Setting::create(['display_name' => 'Site Description', 'key' => 'site_description', 'value' => 'ORIGINAL PRODUCTS', 'type' => 'text', 'section' => 'general', 'ordering' => 3]);
        Setting::create(['display_name' => 'Site Keywords', 'key' => 'site_keywords', 'value' => 'Store, Shop, Product', 'type' => 'text', 'section' => 'general', 'ordering' => 4]);
        Setting::create(['display_name' => 'Site Email', 'key' => 'site_email', 'value' => 'info@cartwhite.com', 'type' => 'text', 'section' => 'general', 'ordering' => 5]);
        Setting::create(['display_name' => 'Site Status', 'key' => 'site_status', 'value' => 'Active', 'type' => 'text', 'section' => 'general', 'ordering' => 6]);
        Setting::create(['display_name' => 'Admin Title', 'key' => 'admin_title', 'value' => 'Cart White', 'type' => 'text', 'section' => 'general', 'ordering' => 7]);
        Setting::create(['display_name' => 'Phone Number', 'key' => 'phone_number', 'value' => '0123456789', 'type' => 'text', 'section' => 'general', 'ordering' => 8]);
        Setting::create(['display_name' => 'Address', 'key' => 'address', 'value' => 'M57F+QM King Abdulaziz International Airport, Jeddah', 'type' => 'text', 'section' => 'general', 'ordering' => 9]);
        Setting::create(['display_name' => 'Map Latitude', 'key' => 'address_altitude', 'value' => '21.671914', 'type' => 'text', 'section' => 'general', 'ordering' => 10]);
        Setting::create(['display_name' => 'Map Longitude', 'key' => 'address_longitude', 'value' => '39.173875', 'type' => 'text', 'section' => 'general', 'ordering' => 11]);

        Setting::create(['display_name' => 'Google Maps API Key', 'key' => 'google_map_api_key', 'value' => null, 'type' => 'text', 'section' => 'social_account', 'ordering' => 1]);
        Setting::create(['display_name' => 'Google Recaptcha API key', 'key' => 'google_recaptcha_api_key', 'value' => null, 'type' => 'text', 'section' => 'social_account', 'ordering' => 2]);
        Setting::create(['display_name' => 'Google Analytics Client ID', 'key' => 'google_analytics_client_id', 'value' => null, 'type' => 'text', 'section' => 'social_account', 'ordering' => 3]);
        Setting::create(['display_name' => 'Twitter ID', 'key' => 'twitter_id', 'value' => 'https://www.twitter.com/Aalhbbash', 'type' => 'text', 'section' => 'social_account', 'ordering' => 4]);
    }
}
