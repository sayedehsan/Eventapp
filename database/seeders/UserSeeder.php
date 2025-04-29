<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => '[email address removed]',
            'password' => Hash::make('password'),
            'user_type' => 'admin',
        ]);

        User::factory()->count(10)->create(); // Generate 10 more sample users
    }
}
