<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@codelearn.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Membuat 5 User biasa dengan password 'password'
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Eko Prasetyo',
            'email' => 'eko@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Dewi Lestari',
            'email' => 'dewi@example.com',
            'password' => Hash::make('password'),
        ]);
        
        User::create([
            'name' => 'testing',
            'email' => 'testing@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}