@extends('layouts.user')

@section('title', 'Mengerjakan Kuis: ' . $quiz->title)

@section('content')
@php
    // Perbaikan logika progress bar
    $progressPercent = $totalQuestions > 0 ? round(($questionIndex / $totalQuestions) * 100) : 0;
    $allQuestions = $quiz->questions()->orderBy('id')->get();
@endphp

<div class="quiz-page">
    <div class="container py-4">
        
        <!-- Header Kuis -->
        <div class="quiz-header">
            <div>
                <h1 class="quiz-title">Kuis: {{ $quiz->title }}</h1>
                <p class="quiz-subtitle">Learning Path: {{ $quiz->material->track->name }}</p>
            </div>
            <div class="quiz-actions">
                <span class="question-indicator">Pertanyaan nomor {{ $questionIndex + 1 }} dari {{ $totalQuestions }}</span>
                <a href="{{ route('user.quiz.submit', $quiz) }}" class="btn btn-submit-quiz" onclick="return confirm('Apakah Anda yakin ingin menyelesaikan kuis sekarang?')">Submit</a>
            </div>
        </div>

        <!-- Konten Kuis -->
        <div class="row g-4">
            <!-- Kolom Pertanyaan (Kiri) -->
            <div class="col-lg-8">
                <div class="question-panel">
                    <form id="quiz-form" method="POST" action="{{ route('user.quiz.answer', [$quiz->id, $currentQuestion->id]) }}">
                        @csrf
                        <div class="question-content">
                            <p class="question-text">{{ $currentQuestion->question_text }}</p>
                            
                            {{-- Cek jika ada blok kode --}}
                            @if(Str::contains($currentQuestion->question_text, '```'))
                                @php
                                    // Logika sederhana untuk memisahkan teks biasa dan kode
                                    $parts = preg_split('/(```.*```)/s', $currentQuestion->question_text, -1, PREG_SPLIT_DELIM_CAPTURE);
                                @endphp
                                <div class="question-text-container">
                                @foreach($parts as $part)
                                    @if(Str::startsWith($part, '```'))
                                        <pre><code class="language-python">{{ trim(str_replace('```', '', $part)) }}</code></pre>
                                    @else
                                        <p>{{ $part }}</p>
                                    @endif
                                @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="answer-options">
                            @foreach ($currentQuestion->answers as $answer)
                                <div class="form-check answer-option">
                                    <input class="form-check-input" type="radio" name="answer" id="answer_{{ $answer->id }}" value="{{ $answer->id }}" required>
                                    <label class="form-check-label" for="answer_{{ $answer->id }}">
                                        {{ $answer->answer_text }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="navigation-buttons">
                            {{-- Logika untuk tombol "Sebelumnya" --}}
                            @php
                                $previousQuestion = $questionIndex > 0 ? $allQuestions[$questionIndex - 1] : null;
                            @endphp
                            @if($previousQuestion)
                                <a href="{{ route('user.quiz.question.show', [$quiz->id, $previousQuestion->id]) }}" class="btn btn-nav-secondary">Sebelumnya</a>
                            @else
                                <div></div> {{-- Placeholder untuk alignment --}}
                            @endif
                            
                            <button type="submit" class="btn btn-nav-primary">
                                {{ $isLastQuestion ? 'Selesaikan Kuis' : 'Selanjutnya' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Kolom Navigasi Soal (Kanan) -->
            <div class="col-lg-4">
                <div class="review-panel">
                    <h5 class="review-title">Review Jawaban</h5>
                    <div class="review-grid">
                        @foreach ($allQuestions as $index => $q)
                            <a href="{{ route('user.quiz.question.show', [$quiz->id, $q->id]) }}" 
                               class="review-button {{ $q->id == $currentQuestion->id ? 'active' : '' }}">
                                {{ $index + 1 }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
{{-- Tambahkan Prism.js untuk syntax highlighting jika ada kode --}}
<link rel="stylesheet" href="[https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-okaidia.min.css](https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-okaidia.min.css)">
<style>
    .quiz-page {
        background-color: #317a75;
        min-height: 100vh;
        color: white;
    }
    .quiz-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid rgba(255,255,255,0.2);
    }
    .quiz-title { font-weight: 700; margin-bottom: 0.25rem; }
    .quiz-subtitle { color: rgba(255,255,255,0.8); margin-bottom: 0; }
    .quiz-actions { display: flex; align-items: center; gap: 1rem; }
    .question-indicator {
        background: rgba(255,255,255,0.1);
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 500;
        font-size: 0.9rem;
    }
    .btn-submit-quiz {
        background-color: #f0ad4e;
        color: white;
        font-weight: 600;
        border: none;
        border-radius: 50px;
        padding: 0.5rem 1.5rem;
        text-decoration: none;
        transition: background-color 0.2s;
    }
    .btn-submit-quiz:hover { background-color: #ec971f; }
    
    /* Panel Pertanyaan */
    .question-panel {
        background-color: white;
        color: #333;
        border-radius: 20px;
        padding: 2.5rem;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .question-content {
        flex-grow: 1;
    }
    .question-text {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 2rem;
    }
    pre[class*="language-"] {
        background: #2d2d2d;
        border-radius: 8px;
        padding: 1rem !important;
        margin: 1.5rem 0;
    }

    /* Opsi Jawaban */
    .answer-options { margin-bottom: 2rem; }
    .answer-option {
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1rem;
        cursor: pointer;
        transition: border-color 0.2s, background-color 0.2s;
    }
    .answer-option:hover { background-color: #f7f7f7; }
    .answer-option .form-check-input {
        margin-top: 0.2em;
        margin-right: 0.75rem;
        width: 1.25em;
        height: 1.25em;
    }
    .answer-option .form-check-input:checked {
        background-color: #317a75;
        border-color: #317a75;
    }
    .answer-option input:checked + label {
        font-weight: 600;
        color: #317a75;
    }
    .answer-option .form-check-label {
        width: 100%;
    }

    /* Tombol Navigasi */
    .navigation-buttons {
        display: flex;
        justify-content: space-between;
        border-top: 1px solid #eee;
        padding-top: 1.5rem;
        margin-top: auto;
    }
    .btn-nav-primary, .btn-nav-secondary {
        padding: 0.75rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        border: none;
        text-decoration: none;
    }
    .btn-nav-primary { background-color: #317a75; color: white; }
    .btn-nav-secondary { background-color: #6c757d; color: white; }

    /* Panel Review */
    .review-panel {
        background-color: white;
        color: #333;
        border-radius: 20px;
        padding: 1.5rem;
        height: 100%;
    }
    .review-title {
        font-weight: 600;
        text-align: center;
        margin-bottom: 1.5rem;
    }
    .review-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(45px, 1fr));
        gap: 0.75rem;
    }
    .review-button {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 45px;
        height: 45px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        color: #555;
        transition: all 0.2s;
    }
    .review-button:hover {
        border-color: #317a75;
        color: #317a75;
    }
    .review-button.active {
        background-color: #317a75;
        color: white;
        border-color: #317a75;
    }
</style>
@endpush

@push('scripts')
<script src="[https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js](https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js)"></script>
<script src="[https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-python.min.js](https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-python.min.js)"></script>
@endpush