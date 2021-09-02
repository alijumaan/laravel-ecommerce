<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class SupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $supervisorRole = Role::create(['name' => 'supervisor']);

        $supervisor = User::create([
            'first_name' => 'Supervisor',
            'last_name' => 'Dashboard',
            'username' => 'supervisor',
            'email' => 'supervisor@supervisor.com',
            'phone' => '0512345678',
            'password' => bcrypt('supervisor'),
            'email_verified_at' => Carbon::now(),
        ]);

        $supervisor->assignRole('supervisor');

        $supervisorPermissions = [
            'create_user',
            'edit_user',
            'show_user',
            'access_user',
            'create_category',
            'edit_category',
            'show_category',
            'access_category',
            'create_product',
            'edit_product',
            'show_product',
            'access_product',
            'create_review',
            'edit_review',
            'show_review',
            'access_review',
            'access_order',
            'show_order',
            'edit_order'
        ];

        // Assigning Permissions to this supervisor:
        $supervisor->givePermissionTo($supervisorPermissions);

        // Assigning Permissions to supervisor Role, not for specific user
//        foreach ($supervisorPermissions as $permission) {
//            $supervisorRole->givePermissionTo($permission);
//        }
    }
}
