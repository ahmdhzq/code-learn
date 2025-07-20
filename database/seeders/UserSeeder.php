<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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

        // Membuat 5 User biasa menggunakan factory
        User::factory(5)->create();
    }
}
