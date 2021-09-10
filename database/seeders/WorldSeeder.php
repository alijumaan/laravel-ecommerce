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
            'host' => env('DB_HOST', '127.0.0.1'),
            'database' => env('DB_DATABASE', 'laravel_ecommerce'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', 'password'),
        ];

        exec("mysql --user={$db['username']} --password={$db['password']} --host={$db['host']} --database={$db['database']} < $sqlFIle");
    }
}
