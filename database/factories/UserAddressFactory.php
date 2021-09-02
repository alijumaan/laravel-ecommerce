<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $ksa   = Country::with('states')->whereId(194)->first();
        $state = $ksa->states->random()->id;
        $city = City::whereStateId($state)->inRandomOrder()->first()->id;

        return [
            'user_id' => User::factory(),
            'address_title' => $this->faker->randomElement(['Home', 'Work', 'Father', 'Mother']),
            'default_address' => rand(0, 1),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->streetAddress,
            'address2' => $this->faker->address,
            'country_id' => $ksa->id,
            'state_id' => $state,
            'city_id' => $city,
            'zip_code' => $this->faker->postcode,
            'po_box' => $this->faker->numberBetween(1000, 9999),
        ];
    }
}
