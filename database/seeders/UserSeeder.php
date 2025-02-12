<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'u_name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),  // Hashing the password
            'role' => 'user'
        ]);

        User::create([
            'u_name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin'
        ]);

        User::create([
            'u_name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('adminpassword'),
            'role' => 'admin'
        ]);
    }
}