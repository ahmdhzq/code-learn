<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class QuestionController extends Controller
{
    /**
     * Menampilkan form untuk membuat pertanyaan baru untuk kuis tertentu.
     */
    public function create(Quiz $quiz): View
    {
        return view('admin.quizzes.questions.create', compact('quiz'));
    }

    /**
     * Menyimpan pertanyaan baru beserta jawabannya ke database.
     */
    public function store(Request $request, Quiz $quiz): RedirectResponse
    {
        $request->validate([
            'question_text' => 'required|string|max:255',
            'answers' => 'required|array|min:2',
            'answers.*' => 'required|string|max:255',
            'correct_answer' => 'required|numeric',
        ], [
            'question_text.required' => 'Teks pertanyaan tidak boleh kosong.',
            'answers.required' => 'Minimal harus ada 2 pilihan jawaban.',
            'answers.min' => 'Minimal harus ada 2 pilihan jawaban.',
            'answers.*.required' => 'Semua pilihan jawaban tidak boleh kosong.',
            'correct_answer.required' => 'Anda harus memilih satu jawaban yang benar.',
        ]);

        DB::transaction(function () use ($request, $quiz) {
            $question = $quiz->questions()->create([
                'question_text' => $request->question_text,
            ]);

            foreach ($request->answers as $index => $answerText) {
                $isCorrect = ($index == $request->correct_answer);
                $question->answers()->create([
                    'answer_text' => $answerText,
                    'is_correct' => $isCorrect,
                ]);
            }
        });

        return redirect()->route('admin.quizzes.show', $quiz)
                         ->with('success', 'Pertanyaan baru berhasil ditambahkan.');
    }

    /**
     * Hanya menerima $question karena rutenya shallow.
     */
    public function edit(Question $question): View
    {
        // Ambil objek Quiz melalui relasi dari Question
        $quiz = $question->quiz;
        
        $question->load('answers');

        return view('admin.quizzes.questions.edit', compact('quiz', 'question'));
    }

    /**
     * Hanya menerima $question karena rutenya shallow.
     */
    public function update(Request $request, Question $question): RedirectResponse
    {
         $request->validate([
            'question_text' => 'required|string|max:255',
            'answers' => 'required|array|min:2',
            'answers.*' => 'required|string|max:255',
            'correct_answer' => 'required|numeric',
        ]);

        DB::transaction(function () use ($request, $question) {
            $question->update(['question_text' => $request->question_text]);
            $question->answers()->delete();

            foreach ($request->answers as $index => $answerText) {
                $isCorrect = ($index == $request->correct_answer);
                $question->answers()->create([
                    'answer_text' => $answerText,
                    'is_correct' => $isCorrect,
                ]);
            }
        });

        // Kembali ke halaman show quiz menggunakan relasi
        return redirect()->route('admin.quizzes.show', $question->quiz)
                         ->with('success', 'Pertanyaan berhasil diperbarui.');
    }

    /**
     * Hanya menerima $question karena rutenya shallow.
     */
    public function destroy(Question $question): RedirectResponse
    {
        // Simpan quiz object sebelum question dihapus, untuk redirect
        $quiz = $question->quiz;
        
        $question->delete();

        return redirect()->route('admin.quizzes.show', $quiz)
                         ->with('success', 'Pertanyaan berhasil dihapus.');
    }
}