<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a default admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Replace with your desired password
        ]);

        // Create some other users
        User::create([
            'name' => 'Najwan',
            'email' => 'najwan@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'temp',
            'email' => 'temp@example.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
