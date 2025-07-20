@extends('layouts.admin')

@section('title', 'Manajemen Modul')
@section('page-title', 'Manajemen Modul')

@section('page-content')
    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
        <div class="d-flex align-items-center mb-3 mb-md-0">
            <div>
                <h4 class="mb-0 fw-bold text-dark">Modul untuk Learning Path: <span class="text-primary">{{ $track->name }}</span>
                </h4>
                <p class="text-muted mb-0 small">Kelola materi pembelajaran</p>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('admin.materials.all') }}" class="btn btn-light">
            <i class="fas fa-arrow-left me-1"></i>
            Kembali
        </a>
        <a href="{{ route('admin.tracks.materials.create', $track) }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>
            Tambah Materi Baru
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card stat-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Judul Materi</th>
                            <th>Tipe</th>
                            <th>Kuis</th> {{-- Kolom Baru --}}
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($materials as $material)
                            <tr>
                                <td>{{ $material->title }}</td>
                                <td><span class="badge bg-info text-white">{{ ucfirst($material->type) }}</span></td>
                                <td>
                                    {{-- Cek apakah materi sudah punya kuis --}}
                                    @if ($material->quiz)
                                        <span class="badge bg-success">Sudah Ada</span>
                                    @else
                                        <span class="badge bg-secondary">Belum Ada</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    {{-- Tombol Baru untuk Kelola Kuis --}}
                                    <a href="{{ route('admin.quizzes.show', $material) }}" class="btn btn-success btn-sm"
                                        title="Kelola Kuis">
                                        <i class="fas fa-question-circle"></i>
                                    </a>
                                    <a href="{{ route('admin.tracks.materials.edit', [$track, $material]) }}"
                                        class="btn btn-warning btn-sm" title="Edit Materi">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.tracks.materials.destroy', [$track, $material]) }}"
                                        method="POST" class="d-inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus Materi">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <p class="mb-2">Belum ada materi di track ini.</p>
                                    <a href="{{ route('admin.tracks.materials.create', $track) }}"
                                        class="btn btn-primary btn-sm">Tambah Materi Pertama</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
