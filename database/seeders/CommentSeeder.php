<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Material;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua user biasa
        $users = User::where('role', 'user')->get();

        // Pastikan ada user sebelum melanjutkan
        if ($users->isEmpty()) {
            $this->command->info('Tidak ada user, seeding komentar dibatalkan.');
            return;
        }

        // =================================================================
        // Komentar untuk Materi "Pengenalan Python & Instalasi"
        // =================================================================
        $materiPythonInstall = Material::where('title', 'Pengenalan Python & Instalasi')->first();
        if ($materiPythonInstall) {
            $comment1 = Comment::create([
                'user_id' => $users->random()->id,
                'material_id' => $materiPythonInstall->id,
                'body' => 'Terima kasih banyak! Akhirnya bisa install Python di Windows 11 setelah mengikuti video ini.',
            ]);

            Comment::create([
                'user_id' => $users->random()->id,
                'material_id' => $materiPythonInstall->id,
                'parent_id' => $comment1->id,
                'body' => 'Sama-sama kak! Saya juga berhasil. Penjelasannya mudah diikuti.',
            ]);
        }

        // =================================================================
        // Komentar untuk Materi "Pengenalan HTML untuk Pemula"
        // =================================================================
        $materiHtmlIntro = Material::where('title', 'Pengenalan HTML untuk Pemula')->first();
        if ($materiHtmlIntro) {
            Comment::create([
                'user_id' => $users->random()->id,
                'material_id' => $materiHtmlIntro->id,
                'body' => 'Baru tahu kalau HTML itu bukan bahasa pemrograman. Terima kasih pencerahannya!',
            ]);
        }
        
        // =================================================================
        // Komentar untuk Materi "Routing Dasar" di track Laravel
        // =================================================================
        $materiLaravelRouting = Material::where('title', 'Routing Dasar')->first();
        if($materiLaravelRouting){
            $comment_laravel_1 = Comment::create([
                'user_id' => $users->random()->id,
                'material_id' => $materiLaravelRouting->id,
                'body' => 'Penjelasan soal routes/web.php sangat membantu!'
            ]);

            Comment::create([
                'user_id' => $users->random()->id,
                'material_id' => $materiLaravelRouting->id,
                'parent_id' => $comment_laravel_1->id,
                'body' => 'Betul, saya sering bingung bedanya dengan routes/api.php, sekarang jadi paham.'
            ]);
        }
    }
}