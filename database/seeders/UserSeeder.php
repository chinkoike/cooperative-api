<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Public User',
            'email'    => 'public@test.com',
            'password' => Hash::make('password'),
            'role'     => 'public',
        ]);

        User::create([
            'name'     => 'Staff User',
            'email'    => 'staff@test.com',
            'password' => Hash::make('password'),
            'role'     => 'staff',
        ]);
    }
}