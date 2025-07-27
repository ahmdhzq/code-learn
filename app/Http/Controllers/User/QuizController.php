<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class QuizController extends Controller
{
    public function start(Request $request, Quiz $quiz)
    {
        $questions = $quiz->questions()->with('answers')->orderBy('id')->get();
        $currentQuestion = $questions->first();

        if ($request->has('q')) {
            $currentQuestion = $questions->firstWhere('id', $request->get('q')) ?? $currentQuestion;
        }

        $questionIndex = $questions->search(fn($q) => $q->id === $currentQuestion->id);
        $isLastQuestion = $questionIndex === $questions->count() - 1;

        return view('user.quiz.start', compact('quiz', 'currentQuestion', 'questionIndex', 'isLastQuestion'));
    }

    public function answer(Request $request, Quiz $quiz, Question $question)
    {
        $request->validate([
            'answer' => 'required|exists:answers,id',
        ]);

        if ($question->quiz_id !== $quiz->id) {
            abort(403);
        }

        $answers = Session::get("quiz_{$quiz->id}_answers", []);
        $answers[$question->id] = $request->input('answer');
        Session::put("quiz_{$quiz->id}_answers", $answers);

        $questions = $quiz->questions()->orderBy('id')->get();
        $currentIndex = $questions->search(fn($q) => $q->id === $question->id);

        $isLast = $currentIndex === $questions->count() - 1;

        if ($isLast) {
            return redirect()->route('user.quiz.submit', $quiz);
        }

        $nextQuestion = $questions[$currentIndex + 1];
        return redirect()->route('user.quiz.start', [$quiz->id, 'q' => $nextQuestion->id]);
    }

    public function submit(Request $request, Quiz $quiz)
{
    $answers = Session::get("quiz_{$quiz->id}_answers", []);
    $questions = $quiz->questions()->with('answers')->get();

    $score = 0;
    foreach ($questions as $question) {
        $selected = $answers[$question->id] ?? null;
        $correct = $question->answers()
            ->where('id', $selected)
            ->where('is_correct', true)
            ->exists();

        if ($correct) {
            $score++;
        }
    }

    $submission = Submission::create([
        'user_id' => Auth::id(),
        'quiz_id' => $quiz->id,
        'score' => $score,
    ]);

    $user = Auth::user();
    $user->points += $score * 10;
    $user->save();

    Session::put("quiz_result_{$quiz->id}_answers", $answers);

    return redirect()->route('user.quiz.result', $submission->id);
}


    public function result(Submission $submission)
{
    if ($submission->user_id !== Auth::id()) {
        abort(403);
    }

    // Ambil jawaban dari session
    $answers = Session::get("quiz_result_{$submission->quiz_id}_answers", []);

    // Simpan di property sementara
    $submission->answers = $answers;

    return view('user.quiz.result', compact('submission'));
}


}