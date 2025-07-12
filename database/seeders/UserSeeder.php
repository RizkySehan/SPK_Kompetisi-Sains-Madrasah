<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Administration',
                'email' => 'administration@example.com',
                'password' => Hash::make('password'),
                'role' => 'administration',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Homeroom Teacher',
                'email' => 'homeroom@example.com',
                'password' => Hash::make('password'),
                'role' => 'homeroom-teacher',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Headmaster',
                'email' => 'headmaster@example.com',
                'password' => Hash::make('password'),
                'role' => 'headmaster',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'KSM-teacher',
                'email' => 'ksm-teacher@example.com',
                'password' => Hash::make('password'),
                'role' => 'ksm-teacher',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
