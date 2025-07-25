<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Quiz;
use Illuminate\Support\Facades\DB;

class PointsSeeder extends Seeder
{
    const POINTS_PER_QUIZ = 10; // Poin untuk setiap kuis

    public function run(): void
    {
        $this->command->info('Memulai seeding poin untuk user...');

        $users = User::where('role', 'user')->get();
        $quizzes = Quiz::all();

        if ($quizzes->isEmpty() || $users->isEmpty()) {
            $this->command->warn('Tidak ada user atau kuis, seeding poin dibatalkan.');
            return;
        }

        $progressBar = $this->command->getOutput()->createProgressBar($users->count());
        $progressBar->start();

        foreach ($users as $user) {
            $quizzesToComplete = $quizzes->random(rand(1, $quizzes->count()));
            $totalPoints = 0;

            foreach ($quizzesToComplete as $quiz) {
                DB::table('submissions')->insert([
                    'user_id' => $user->id,
                    'quiz_id' => $quiz->id,
                    'score'   => 100,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $totalPoints += self::POINTS_PER_QUIZ;
            }

            $user->update(['points' => $totalPoints]);
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->command->info("\nSeeding poin telah selesai.");
    }
}
