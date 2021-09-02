<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\ShippingCompany;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ShippingCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('shipping_companies')->truncate();
        DB::table('shipping_company_country')->truncate();
        Schema::enableForeignKeyConstraints();

        // Shipping inside Saudi Arabia
        $sh1 = ShippingCompany::create([
            'name' => 'Aramex Inside',
            'code' => 'ARA',
            'description' => '8 - 10 days',
            'fast' => false,
            'cost' => '15.00',
            'status' => true,
        ]);
        $sh1->countries()->attach([194]);

        $sh2 = ShippingCompany::create([
            'name' => 'Aramex Inside Speed Shipping',
            'code' => 'ARA-SPD',
            'description' => '1 - 3 days',
            'fast' => true,
            'cost' => '25.00',
            'status' => true,
        ]);
        $sh2->countries()->attach([194]);

        // Shipping outside Saudi Arabia
        $countries = Country::where('id', '!=', 194)->pluck('id')->toArray();

        $sh3 = ShippingCompany::create([
            'name' => 'Aramex Outside',
            'code' => 'ARA-O',
            'description' => '15 - 20 days',
            'fast' => false,
            'cost' => '50.00',
            'status' => true,
        ]);
        $sh3->countries()->attach($countries);

        $sh4 = ShippingCompany::create([
            'name' => 'Aramex Outside Speed Shipping',
            'code' => 'ARA-O->SPD',
            'description' => '5 - 10 days',
            'fast' => true,
            'cost' => '80.00',
            'status' => true,
        ]);
        $sh4->countries()->attach($countries);
    }
}
