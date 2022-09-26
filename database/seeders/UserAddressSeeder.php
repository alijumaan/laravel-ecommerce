<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UserAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $ali   = User::whereUsername('ali')->first();
        $ksa   = Country::with('states')->whereId(194)->first();
        $state = $ksa->states->random()->id;
        $city = City::whereStateId($state)->inRandomOrder()->first()->id;

        $ali->addresses()->create([
            'address_title'         => 'Home',
            'default_address'       => true,
            'first_name'            => 'Ali',
            'last_name'             => 'Al Qahtari',
            'email'                 => fake()->email,
            'phone'                => fake()->phoneNumber,
            'address'               => fake()->address,
            'address2'              => fake()->secondaryAddress,
            'country_id'            => $ksa->id,
            'state_id'              => $state,
            'city_id'               => $city,
            'zip_code'              => fake()->randomNumber(5),
            'po_box'                => fake()->randomNumber(4),
        ]);


        $ali->addresses()->create([
            'address_title'         => 'Work',
            'default_address'       => false,
            'first_name'            => 'Ali',
            'last_name'             => 'Al Qahtani',
            'email'                 => fake()->email,
            'phone'                => fake()->phoneNumber,
            'address'               => fake()->address,
            'address2'              => fake()->secondaryAddress,
            'country_id'            => 65,
            'state_id'              => 3223,
            'city_id'               => 31848,
            'zip_code'              => fake()->randomNumber(5),
            'po_box'                => fake()->randomNumber(4),
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
