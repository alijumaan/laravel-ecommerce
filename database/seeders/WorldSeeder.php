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
            'host' => config('database.connections.mysql.host'),
            'database' => config('database.connections.mysql.database'),
            'username' => config('database.connections.mysql.username'),
            'password' => config('database.connections.mysql.password'),
        ];

        exec("mysql --user={$db['username']} --password={$db['password']} --host={$db['host']} --database={$db['database']} < $sqlFIle");
    }
}
