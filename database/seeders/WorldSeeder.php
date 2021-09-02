<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WorldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sqlFIle = public_path('ecommerce_world.sql');
        $db = [
            'host' => '127.0.0.1',
            'database' => 'laravel_ecommerce',
            'username' => 'root',
            'password' => 'password'
        ];

        exec("mysql --user={$db['username']} --password={$db['password']} --host={$db['host']} --database={$db['database']} < $sqlFIle");
    }
}
