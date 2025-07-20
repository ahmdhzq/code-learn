@extends('layouts.admin')

@section('title', 'Edit Pertanyaan')
@section('page-title', 'Edit Pertanyaan untuk Kuis: ' . $quiz->title)

@section('page-content')
<div class="card stat-card">
    <div class="card-body">
        <form action="{{ route('admin.questions.update', $question) }}" method="POST">
            @csrf
            @method('PUT')
            {{-- Input untuk Teks Pertanyaan --}}
            <div class="mb-4">
                <label for="question_text" class="form-label fw-bold">Teks Pertanyaan</label>
                <textarea name="question_text" id="question_text" class="form-control @error('question_text') is-invalid @enderror" rows="3" required>{{ old('question_text', $question->question_text) }}</textarea>
                @error('question_text') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Bagian untuk Pilihan Jawaban --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Pilihan Jawaban</label>
                <p class="text-muted small">Edit pilihan jawaban dan pilih kembali jawaban yang benar.</p>
                <div id="answers-container">
                    {{-- Jawaban yang ada akan dimuat di sini oleh JS --}}
                </div>
                @error('answers') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
                @error('answers.*') <div class="text-danger small mt-2">Semua pilihan jawaban tidak boleh kosong.</div> @enderror
                @error('correct_answer') <div class="text-danger small mt-2">Anda harus memilih satu jawaban yang benar.</div> @enderror

                <button type="button" id="add-answer-btn" class="btn btn-outline-primary btn-sm mt-2">
                    <i class="fas fa-plus me-1"></i>
                    Tambah Pilihan Jawaban
                </button>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('admin.quizzes.show', $quiz) }}" class="btn btn-light me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Update Pertanyaan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('answers-container');
    const addBtn = document.getElementById('add-answer-btn');
    let answerIndex = 0;

    // Data jawaban yang ada dari controller
    const existingAnswers = @json($question->answers->map(function($answer, $index) {
        return ['text' => $answer->answer_text, 'is_correct' => $answer->is_correct];
    }));

    function addAnswerField(text = '', isCorrect = false) {
        const answerId = answerIndex;
        const div = document.createElement('div');
        div.classList.add('input-group', 'mb-2');
        div.innerHTML = `
            <div class="input-group-text">
                <input class="form-check-input mt-0" type="radio" name="correct_answer" value="${answerId}" ${isCorrect ? 'checked' : ''} required title="Pilih sebagai jawaban benar">
            </div>
            <input type="text" name="answers[]" class="form-control" placeholder="Tulis pilihan jawaban di sini" value="${text}">
            <button type="button" class="btn btn-outline-danger remove-answer-btn" title="Hapus jawaban ini">
                <i class="fas fa-trash"></i>
            </button>
        `;
        container.appendChild(div);

        div.querySelector('.remove-answer-btn').addEventListener('click', function () {
            div.remove();
        });

        answerIndex++;
    }

    addBtn.addEventListener('click', function() { addAnswerField(); });

    // Muat jawaban yang sudah ada
    if (existingAnswers.length > 0) {
        existingAnswers.forEach(answer => {
            addAnswerField(answer.text, answer.is_correct);
        });
    } else {
        // Jika tidak ada jawaban (kasus aneh), tambahkan 2 field kosong
        addAnswerField();
        addAnswerField();
    }
});
</script>
@endpush
