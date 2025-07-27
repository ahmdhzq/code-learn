@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-sm border-0 mx-auto" style="max-width: 700px;">
        <div class="card-body p-5">

            {{-- Judul Kuis --}}
            <h2 class="mb-4 text-center text-primary fw-bold">{{ $quiz->title }}</h2>

            {{-- Progress Bar Visual --}}
            @php
                $totalQuestions = $quiz->questions->count();
                $progressPercent = round((($questionIndex + 1) / $totalQuestions) * 100);
            @endphp
            <div class="mb-4">
                <label class="form-label fw-semibold">Progress: {{ $progressPercent }}%</label>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $progressPercent }}%;" aria-valuenow="{{ $progressPercent }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            {{-- Indikator Soal --}}
            <div class="mb-3 text-center text-muted">
                <span class="badge bg-secondary fs-6">
                    Soal {{ $questionIndex + 1 }} dari {{ $totalQuestions }}
                </span>
            </div>

            {{-- Form Jawaban --}}
            <form method="POST" action="{{ route('user.quiz.answer', [$quiz->id, $currentQuestion->id]) }}">
                @csrf

                {{-- Pertanyaan --}}
                <div class="mb-4">
                    <p class="fs-5 fw-semibold">{{ $currentQuestion->question_text }}</p>
                </div>

                {{-- Pilihan Jawaban --}}
                <div class="mb-4">
                    @foreach ($currentQuestion->answers as $answer)
                        <div class="form-check mb-2 p-2 rounded bg-light">
                            <input class="form-check-input" type="radio" name="answer" id="answer_{{ $answer->id }}" value="{{ $answer->id }}" required>
                            <label class="form-check-label" for="answer_{{ $answer->id }}">
                                {{ $answer->answer_text }}
                            </label>
                        </div>
                    @endforeach
                </div>

                {{-- Navigasi --}}
                <input type="hidden" name="question_index" value="{{ $questionIndex }}">
                <div class="text-center">
                    <button type="submit" class="btn btn-lg {{ $isLastQuestion ? 'btn-success' : 'btn-primary' }} px-5">
                        {{ $isLastQuestion ? 'Selesaikan Kuis' : 'Selanjutnya' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .form-check-input:checked {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    .form-check:hover {
        background-color: #e7f1ff;
    }
</style>
@endpush
