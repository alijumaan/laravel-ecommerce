<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRole = Role::create(['name' => 'user']);
        $user = User::create([
            'first_name' => 'Ali',
            'last_name' => 'Al Qahtani',
            'username' => 'ali',
            'email' => 'ali@ali.com',
            'phone' => '0505050500',
            'password' => bcrypt('ali'),
            'email_verified_at' => Carbon::now(),
        ]);
        $user->assignRole('user');

//        $userPermissions = [
//            'create_review',
//            'edit_review',
//            'show_review',
//            'delete_review',
//        ];
//        foreach ($userPermissions as $permission) {
//            $userRole->givePermissionTo($permission);
//        }

        /*
         * Create 1000 fake users with their addresses (each user has one address).
         */
        User::factory()->count(100)->hasAddresses(1)->create();
    }
}
