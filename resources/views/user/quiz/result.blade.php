@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-0 mx-auto text-center" style="max-width: 700px;">
        <div class="card-body p-5">

            {{-- Judul Kuis --}}
            <h2 class="text-primary fw-bold mb-4">
                <i class="fas fa-poll-check me-2"></i> Hasil Kuis: {{ $submission->quiz->title }}
            </h2>

            {{-- Skor Besar --}}
            <div class="display-3 fw-bold text-success mb-2">
                {{ $submission->score }}
            </div>

            {{-- Detail Skor --}}
            <div class="fs-4 fw-semibold text-secondary mb-1">
                Skor: {{ $submission->score }} / {{ $submission->quiz->questions->count() }}
            </div>
            <p class="text-muted mb-4">
                ({{ round(($submission->score / $submission->quiz->questions->count()) * 100) }}% benar)
            </p>

            {{-- Motivasi --}}
            @if ($submission->score >= ceil($submission->quiz->questions->count() / 2))
                <div class="alert alert-success fw-semibold rounded-3">
                    🎉 Kerja bagus! Kamu mulai menguasai materi ini.
                </div>
            @else
                <div class="alert alert-warning fw-semibold rounded-3">
                    💡 Jangan menyerah, tetap semangat belajar!
                </div>
            @endif

            {{-- Tombol Aksi --}}
            <div class="mt-4 d-grid gap-3">
                <a href="{{ route('learn.track.show', $submission->quiz->material->track_id) }}"
                   class="btn btn-lg btn-primary shadow-sm">
                    <i class="fas fa-book me-2"></i> Kembali ke Materi
                </a>
                <a href="{{ route('dashboard') }}"
                   class="btn btn-lg btn-outline-secondary shadow-sm">
                    <i class="fas fa-home me-2"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

   {{-- Review Jawaban yang Salah --}}
@php
    $jawabanSalah = $submission->quiz->questions->filter(function ($question) use ($submission) {
        $userAnswerId = $submission->answers[$question->id] ?? null;
        $userAnswer = $question->answers->firstWhere('id', $userAnswerId);
        return $userAnswer?->is_correct !== true;
    });
@endphp

@if (!empty($submission->answers))
    @php
        $jawabanSalah = $submission->quiz->questions->filter(function ($question) use ($submission) {
            $userAnswerId = $submission->answers[$question->id] ?? null;
            $userAnswer = $question->answers->firstWhere('id', $userAnswerId);
            return $userAnswer?->is_correct !== true;
        });
    @endphp

@if ($jawabanSalah->count() > 0)
    <div class="card mt-5 shadow-sm border-0">
        <div class="card-body">
            <h4 class="fw-bold mb-4 text-danger">
                <i class="fas fa-exclamation-circle me-2"></i> Review Jawaban yang Salah
            </h4>

            @foreach ($jawabanSalah as $index => $question)
                @php
                    $userAnswerId = $submission->answers[$question->id] ?? null;
                    $userAnswer = $question->answers->firstWhere('id', $userAnswerId);
                    $correctAnswer = $question->answers->firstWhere('is_correct', true);
                @endphp

                <div class="mb-4 p-4 bg-white rounded-4 border border-2 border-opacity-25 border-danger-subtle shadow">
                    <p class="fw-semibold text-dark mb-2">
                        {{ $index + 1 }}. {{ $question->question_text }}
                    </p>

                    <div class="mb-2">
                        <span class="badge bg-secondary me-2">Jawaban Kamu:</span>
                        <strong class="text-danger">
                            {{ $userAnswer ? $userAnswer->answer_text : '-' }}
                        </strong> ❌
                    </div>

                    <div class="mb-3">
                        <span class="badge bg-success me-2">Jawaban Benar:</span>
                        <strong class="text-success">
                            {{ $correctAnswer ? $correctAnswer->answer_text : '-' }}
                        </strong> ✅
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
@endif 


</div>
@endsection

@push('styles')
<style>
    .card-body {
        background: linear-gradient(135deg, #fdfbfb 0%, #f0f4f7 100%);
        border-radius: 1.25rem;
    }

    .btn-lg {
        border-radius: 1rem;
    }

    .alert {
        border-radius: 1rem;
    }

    .badge {
        font-size: 0.9rem;
        border-radius: 0.5rem;
        padding: 0.5em 0.75em;
    }

    .bg-danger-subtle {
        background-color: #f8d7da;
    }

    .bg-success-subtle {
        background-color: #d1e7dd;
    }

    .rounded-4 {
        border-radius: 1.25rem !important;
    }

    .shadow {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    }

    .text-danger strong,
    .text-success strong {
        font-weight: 600;
    }
</style>
@endpush
