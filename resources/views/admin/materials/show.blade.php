@extends('layouts.admin')

@section('title', 'Kelola Kuis')
@section('page-title')
    Kelola Kuis untuk: <span class="text-primary">{{ $material->title }}</span>
@endsection

@section('page-content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        {{-- Tombol ini akan mengarahkan admin kembali ke halaman daftar materi --}}
        <a href="{{ route('admin.tracks.materials.index', $material->track) }}" class="btn btn-light">
            <i class="fas fa-arrow-left me-1"></i>
            Kembali ke Daftar Materi
        </a>
    </div>

    {{-- Bagian 1: Form untuk mengedit detail Kuis (judul & deskripsi) --}}
    <div class="card stat-card mb-4">
        <div class="card-body">
            <h5 class="card-title">Detail Kuis</h5>
            {{-- Form ini belum berfungsi penuh, akan kita lengkapi nanti --}}
            <form action="#" method="POST"> 
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="quiz_title" class="form-label">Judul Kuis</label>
                    <input type="text" id="quiz_title" name="title" class="form-control" value="{{ $quiz->title }}">
                </div>
                <div class="mb-3">
                    <label for="quiz_description" class="form-label">Deskripsi (Opsional)</label>
                    <textarea id="quiz_description" name="description" class="form-control" rows="2">{{ $quiz->description }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Update Detail Kuis</button>
            </form>
        </div>
    </div>

    {{-- Bagian 2: Bagian untuk mengelola Pertanyaan & Jawaban --}}
    <div class="card stat-card">
        <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Daftar Pertanyaan</h5>
            {{-- Tombol ini juga akan kita fungsikan pada langkah selanjutnya --}}
            <a href="#" class="btn btn-primary"> 
                <i class="fas fa-plus me-1"></i>
                Tambah Pertanyaan
            </a>
        </div>
        <div class="card-body">
            {{-- Looping untuk setiap pertanyaan yang ada di kuis ini --}}
            @forelse ($questions as $question)
                {{-- Kita menggunakan komponen Accordion dari Bootstrap agar rapi --}}
                <div class="accordion" id="accordion-{{ $question->id }}">
                    <div class="accordion-item mb-3 border rounded">
                        <h2 class="accordion-header" id="heading-{{ $question->id }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $question->id }}" aria-expanded="false" aria-controls="collapse-{{ $question->id }}">
                                {{ $loop->iteration }}. {{ $question->question_text }}
                            </button>
                        </h2>
                        <div id="collapse-{{ $question->id }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $question->id }}">
                            <div class="accordion-body">
                                {{-- Menampilkan daftar jawaban untuk pertanyaan ini --}}
                                <h6 class="mb-2">Pilihan Jawaban:</h6>
                                <ul class="list-group">
                                    @foreach ($question->answers as $answer)
                                        <li class="list-group-item d-flex justify-content-between align-items-center
                                            {{-- Memberi warna hijau jika jawaban benar --}}
                                            {{ $answer->is_correct ? 'list-group-item-success' : '' }}">
                                            {{ $answer->answer_text }}
                                            @if ($answer->is_correct)
                                                <span class="badge bg-primary rounded-pill">Jawaban Benar</span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                                {{-- Tombol aksi untuk setiap pertanyaan --}}
                                <div class="mt-3">
                                    <a href="#" class="btn btn-warning btn-sm">Edit Pertanyaan</a>
                                    <a href="#" class="btn btn-danger btn-sm">Hapus Pertanyaan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Pesan ini akan muncul jika belum ada pertanyaan sama sekali --}}
                <div class="text-center py-4">
                    <p>Belum ada pertanyaan untuk kuis ini.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
