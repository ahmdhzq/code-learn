<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Material;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua user biasa dan semua materi yang ada
        $users = User::where('role', 'user')->get();
        $materials = Material::all();

        // Pastikan ada user dan materi sebelum membuat komentar
        if ($users->isEmpty() || $materials->isEmpty()) {
            $this->command->info('Tidak dapat membuat komentar karena tidak ada user atau materi.');
            return;
        }

        // Buat 25 komentar utama (induk)
        for ($i = 0; $i < 25; $i++) {
            Comment::create([
                'user_id' => $users->random()->id,
                'material_id' => $materials->random()->id,
                'parent_id' => null, // Ini adalah komentar induk
                'body' => fake()->paragraph(2), // Menggunakan helper fake() untuk teks acak
            ]);
        }

        // Ambil beberapa komentar yang sudah ada untuk dijadikan induk balasan
        $parentComments = Comment::inRandomOrder()->take(10)->get();

        foreach ($parentComments as $parent) {
            // Buat 1 sampai 3 balasan untuk setiap komentar induk
            $replyCount = rand(1, 3);
            for ($j = 0; $j < $replyCount; $j++) {
                Comment::create([
                    'user_id' => $users->random()->id,
                    'material_id' => $parent->material_id, // Balasan harus di materi yang sama
                    'parent_id' => $parent->id, // Menandakan ini adalah balasan
                    'body' => fake()->sentence(10),
                ]);
            }
        }
    }
}
