@extends('layouts.admin')

@section('title', 'Manajemen Materi')
@section('page-title', 'Manajemen Materi Edukasi')

@section('page-content')
    {{-- Tombol Tambah Materi Baru --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
        <div class="d-flex align-items-center mb-3 mb-md-0">
            <div>
                <h4 class="mb-0 fw-bold text-dark">Materi Edukasi</h4>
                <p class="text-muted mb-0 small">Kelola semua materi pembelajaran</p>
            </div>
        </div>
        <a href="{{ route('admin.materials.create_global') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Materi Baru
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Grid untuk Kartu Tracks --}}
    <div class="row g-4">
        @forelse ($tracks as $track)
            <div class="col-md-6 col-lg-4">
                <div class="card stat-card h-100 d-flex flex-column">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $track->name }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($track->description, 100) }}</p>
                    </div>
                    <div class="card-footer bg-transparent border-top-0 pt-0">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <i class="fas fa-book-open me-2 text-primary"></i>
                                <span>{{ $track->materials_count }} Materi</span>
                            </div>
                            <small class="text-muted">Dibuat: {{ $track->created_at->format('d M Y') }}</small>
                        </div>
                        {{-- Tombol Aksi Utama: Mengarah ke daftar materi untuk track ini --}}
                        <a href="{{ route('admin.tracks.materials.index', $track) }}" class="btn btn-primary w-100">
                            Lihat Daftar Materi
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <p class="mb-2">Belum ada track yang dibuat.</p>
                    <a href="{{ route('admin.tracks.create') }}" class="btn btn-primary">Buat Track Pertama Anda</a>
                </div>
            </div>
        @endforelse
    </div>
@endsection

@push('scripts')
    <script>
        // Inisialisasi DataTables jika diperlukan
        $(document).ready(function() {
            new DataTable('#all-materials-table');
        });
    </script>
@endpush
