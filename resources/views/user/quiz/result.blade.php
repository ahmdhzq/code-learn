@extends('layouts.user')

@section('title', 'Hasil Kuis - ' . $submission->quiz->title)

@section('content')
@php
    // Kalkulasi skor dan persentase
    $totalQuestions = $submission->quiz->questions->count();
    $correctAnswers = $submission->score;
    $wrongAnswers = $totalQuestions - $correctAnswers;
    $percentage = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100) : 0;
    $finalScore = $correctAnswers * 10; // Asumsi setiap soal 10 poin
@endphp

<div class="quiz-result-page">
    <div class="container py-5">
        <div class="result-header text-center">
            <h2>Kuis: {{ $submission->quiz->title }}</h2>
            <p>Learning Path: {{ $submission->quiz->material->track->name }}</p>
        </div>

        <div class="result-card mx-auto">
            <h1 class="result-title">Kuis Selesai!</h1>
            <p class="result-subtitle">Kerja bagus, {{ Auth::user()->name }}!</p>

            {{-- Lingkaran Progress Skor --}}
            <div class="progress-circle" style="--p:{{ $percentage }}; --c:#00b894;">
                <div class="progress-value">{{ $correctAnswers }}/{{ $totalQuestions }}</div>
            </div>

            <div class="final-score">{{ $finalScore }}</div>
            <p class="score-label">Skor Akhir</p>

            <div class="row g-3 my-4">
                <div class="col-6">
                    <div class="stat-box correct">
                        <div class="stat-value">{{ $correctAnswers }}</div>
                        <div class="stat-label">Benar</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stat-box wrong">
                        <div class="stat-value">{{ $wrongAnswers }}</div>
                        <div class="stat-label">Salah</div>
                    </div>
                </div>
            </div>

            <div class="feedback-box">
                @if ($percentage >= 70)
                    <h5 class="feedback-title">🎉 Terus semangat belajar!</h5>
                    <p class="feedback-text">Kamu sudah menguasai dasar-dasar materi ini. Praktik terus untuk meningkatkan kemampuanmu!</p>
                @else
                    <h5 class="feedback-title">💡 Jangan menyerah!</h5>
                    <p class="feedback-text">Setiap kesalahan adalah kesempatan belajar. Coba review kembali jawabanmu yang salah.</p>
                @endif
            </div>

            <a href="{{ route('learn.track.show', $submission->quiz->material->track_id) }}" class="btn btn-back-to-lp">
                Kembali ke Learning Path
            </a>
        </div>

        {{-- Logika untuk menampilkan review jawaban salah tetap ada di bawah --}}
        @if ($wrongAnswers > 0 && !empty($submission->answers))
            <div class="review-section mx-auto">
                <h4 class="review-title">
                    <i class="fas fa-exclamation-circle me-2"></i> Review Jawaban yang Salah
                </h4>
                @foreach ($submission->quiz->questions as $index => $question)
                    @php
                        $userAnswerId = $submission->answers[$question->id] ?? null;
                        $userAnswer = $question->answers->firstWhere('id', $userAnswerId);
                    @endphp
                    @if(!$userAnswer || !$userAnswer->is_correct)
                        @php
                            $correctAnswer = $question->answers->firstWhere('is_correct', true);
                        @endphp
                        <div class="review-item">
                            <p class="fw-semibold text-dark mb-2">
                                {{ $loop->iteration }}. {{ $question->question_text }}
                            </p>
                            <div class="mb-2">
                                <span class="badge bg-danger-subtle text-danger-emphasis me-2">Jawaban Kamu:</span>
                                <strong class="text-danger">
                                    {{ $userAnswer ? $userAnswer->answer_text : 'Tidak dijawab' }}
                                </strong> ❌
                            </div>
                            <div>
                                <span class="badge bg-success-subtle text-success-emphasis me-2">Jawaban Benar:</span>
                                <strong class="text-success">
                                    {{ $correctAnswer ? $correctAnswer->answer_text : '-' }}
                                </strong> ✅
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

    </div>
</div>
@endsection

@push('styles')
<style>
    .quiz-result-page {
        background-color: #317a75;
        min-height: 100vh;
        color: white;
    }
    .result-header {
        margin-bottom: 2rem;
    }
    .result-header h2 { font-weight: 600; }
    .result-header p { color: rgba(255,255,255,0.8); }
    .result-card {
        background-color: white;
        color: #333;
        border-radius: 24px;
        padding: 2.5rem;
        max-width: 500px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .result-title { font-weight: 700; color: #222; }
    .result-subtitle { color: #6c757d; margin-bottom: 2rem; }
    
    /* Progress Circle */
    @property --p{
        syntax: '<integer>';
        initial-value: 0;
        inherits: false;
    }
    .progress-circle {
        --p:0; /* persentase */
        --b:12px; /* ketebalan border */
        --c:#00b894; /* warna hijau */
        --bg:#dfe6e9; /* warna abu-abu */
        width: 150px;
        height: 150px;
        border-radius: 50%;
        display: grid;
        place-content: center;
        margin: 0 auto 1rem auto;
        animation: p 1s .5s both;
        position: relative;
    }
    .progress-circle::before, .progress-circle::after {
        content: "";
        position: absolute;
        border-radius: 50%;
    }
    .progress-circle::before {
        inset: 0;
        background: radial-gradient(farthest-side,var(--c) 98%,#0000) top/0 0 no-repeat, conic-gradient(var(--c) calc(var(--p) * 1%), var(--bg) 0);
        -webkit-mask: radial-gradient(farthest-side,#0000 calc(99% - var(--b)),#000 calc(100% - var(--b)));
        mask: radial-gradient(farthest-side,#0000 calc(99% - var(--b)),#000 calc(100% - var(--b)));
    }
    @keyframes p { from{--p:0} }

    .progress-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #333;
    }
    .final-score {
        font-size: 3.5rem;
        font-weight: 800;
        color: #317a75;
        line-height: 1;
    }
    .score-label {
        font-weight: 500;
        color: #6c757d;
    }
    .stat-box {
        border-radius: 12px;
        padding: 1rem;
    }
    .stat-box.correct { background-color: #d1e7dd; color: #0f5132; }
    .stat-box.wrong { background-color: #f8d7da; color: #842029; }
    .stat-value { font-size: 1.75rem; font-weight: 700; }
    .stat-label { font-size: 0.9rem; font-weight: 500; }

    .feedback-box {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        padding: 1rem;
        margin-top: 1.5rem;
    }
    .feedback-title { font-weight: 600; font-size: 1rem; }
    .feedback-text { font-size: 0.9rem; color: #495057; margin-bottom: 0; }

    .btn-back-to-lp {
        display: block;
        width: 100%;
        margin-top: 2rem;
        background-color: transparent;
        border: 2px solid #317a75;
        color: #317a75;
        padding: 0.75rem;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-back-to-lp:hover {
        background-color: #317a75;
        color: white;
    }
    
    /* Review Section */
    .review-section {
        background-color: white;
        color: #333;
        border-radius: 24px;
        padding: 2.5rem;
        max-width: 700px;
        margin-top: 2rem;
    }
    .review-title {
        color: #dc3545;
        font-weight: 700;
        text-align: center;
        margin-bottom: 2rem;
    }
    .review-item {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 1rem;
    }
</style>
@endpush