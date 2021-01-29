<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = DB::table('roles')->insert(['id' => 1, 'role' => 'Admin']);
        $supervisorRole = DB::table('roles')->insert(['id' => 2, 'role' => 'Supervisor']);
        $userRole = DB::table('roles')->insert(['id' => 3, 'role' => 'User']);

        $admin = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'mobile' => '966500000001',
            'role_id' => 1,
            'status' => 1,
            'email_verified_at' => Carbon::now(),
            'bio' => 'Administrator',
            'password' => 'admin',

        ]);

        $supervisor = User::create([
            'name' => 'Supervisor',
            'username' => 'supervisor',
            'email' => 'supervisor@supervisor.com',
            'mobile' => '966500000002',
            'role_id' => 2,
            'status' => 1,
            'email_verified_at' => Carbon::now(),
            'bio' => 'Supervisor',
            'password' => 'admin',
        ]);


        $user = User::create([
            'name' => 'Ali',
            'username' => 'ali',
            'email' => 'ali@ali.com',
            'mobile' => '966500000003',
            'role_id' => 3,
            'status' => 1,
            'email_verified_at' => Carbon::now(),
            'bio' => 'User',
            'password' => 'ali',
        ]);

    }
}
