<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            //DocSeeder::class,
        ]);

        User::create([
            'name' => 'Mr. Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'name' => 'Mr. User',
            'email' => 'user@gmail.com',
            'role' => 'user',
            'password' => bcrypt('12345678'),
        ]);
    }
}
