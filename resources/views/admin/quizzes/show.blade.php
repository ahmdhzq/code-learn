@extends('layouts.admin')

@section('title', 'Kelola Kuis')
@section('page-title')
    Kelola Kuis untuk: <span class="text-primary">{{ $material->title }}</span>
@endsection

@section('page-content')
    <div class="mb-4">
        <a href="{{ route('admin.tracks.materials.index', $material->track) }}" class="btn btn-light">
            <i class="fas fa-arrow-left me-1"></i>
            Kembali ke Daftar Modul
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card stat-card mb-4">
        <div class="card-body">
            <h5 class="card-title">Detail Kuis</h5>
            <form action="{{ route('admin.quizzes.update', $quiz) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="quiz_title" class="form-label">Judul Kuis</label>
                    <input type="text" id="quiz_title" name="title" class="form-control"
                        value="{{ old('title', $quiz->title) }}" required>
                </div>
                <div class="mb-3">
                    <label for="quiz_description" class="form-label">Deskripsi (Opsional)</label>
                    <textarea id="quiz_description" name="description" class="form-control" rows="2">{{ old('description', $quiz->description) }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Update Detail Kuis</button>
            </form>
        </div>
    </div>

    <div class="card stat-card">
        <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Daftar Pertanyaan</h5>
            <a href="{{ route('admin.quizzes.questions.create', $quiz) }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>
                Tambah Pertanyaan
            </a>
        </div>
        <div class="card-body">
            @forelse ($questions as $question)
                <div class="accordion" id="accordion-{{ $question->id }}">
                    <div class="accordion-item mb-3 border rounded">
                        <h2 class="accordion-header" id="heading-{{ $question->id }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse-{{ $question->id }}">
                                {{ $loop->iteration }}. {{ $question->question_text }}
                            </button>
                        </h2>
                        <div id="collapse-{{ $question->id }}" class="accordion-collapse collapse"
                            aria-labelledby="heading-{{ $question->id }}">
                            <div class="accordion-body">
                                <h6 class="mb-2">Pilihan Jawaban:</h6>
                                <ul class="list-group">
                                    @foreach ($question->answers as $answer)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center {{ $answer->is_correct ? 'list-group-item-success' : '' }}">
                                            {{ $answer->answer_text }}
                                            @if ($answer->is_correct)
                                                <span class="badge bg-primary rounded-pill">Jawaban Benar</span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="mt-3">
                                    <a href="{{ route('admin.questions.edit', $question) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.questions.destroy', $question) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus pertanyaan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-4">
                    <p>Belum ada pertanyaan untuk kuis ini.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
