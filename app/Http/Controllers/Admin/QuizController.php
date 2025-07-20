<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class QuizController extends Controller
{
    /**
     * Menampilkan halaman manajemen kuis untuk sebuah materi.
     * Jika kuis belum ada, kuis baru akan dibuat secara otomatis.
     */
    public function show(Material $material): View
    {
        // Cari kuis yang terhubung dengan materi ini.
        // Jika tidak ada, buat kuis baru dengan judul default.
        $quiz = $material->quiz()->firstOrCreate(
            ['material_id' => $material->id],
            ['title' => 'Kuis untuk ' . $material->title]
        );

        // Ambil semua pertanyaan yang terhubung dengan kuis ini, beserta jawabannya.
        $questions = $quiz->questions()->with('answers')->get();

        return view('admin.quizzes.show', compact('material', 'quiz', 'questions'));
    }

    /**
     * Mengupdate detail kuis (judul dan deskripsi).
     */
    public function update(Request $request, Quiz $quiz): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $quiz->update($request->all());

        // Menggunakan $quiz->material untuk kembali ke halaman kuis
        return redirect()->route('admin.quizzes.show', $quiz)
                         ->with('success', 'Detail kuis berhasil diperbarui.');
    }

}
