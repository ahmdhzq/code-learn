<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Perintah ini akan memanggil seeder lain secara berurutan
        $this->call([
            UserSeeder::class,
            TrackSeeder::class,
            // Jika nanti ada seeder lain, tambahkan di sini
        ]);
    }
}
