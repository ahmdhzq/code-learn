<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat Admin
        User::updateOrCreate(
            ['email' => 'admin@codelearn.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Membuat 5 User biasa dengan password 'password'
        User::updateOrCreate(
            ['email' => 'budi@example.com'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('password'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'siti@example.com'],
            [
                'name' => 'Siti Aminah',
                'password' => Hash::make('password'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'eko@example.com'],
            [
                'name' => 'Eko Prasetyo',
                'password' => Hash::make('password'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'dewi@example.com'],
            [
                'name' => 'Dewi Lestari',
                'password' => Hash::make('password'),
            ]
        );
        
        User::updateOrCreate(
            ['email' => 'testing@gmail.com'],
            [
                'name' => 'testing',
                'password' => Hash::make('password'),
            ]
        );
    }
}