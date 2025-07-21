@extends('layouts.user')

@section('title', 'Detail: ' . $track->name)

@section('content')
    <div class="bg-white py-4 shadow-sm">
        <div class="container">
            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('learn.index') }}" class="text-decoration-none">Jalur
                            Belajar</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $track->name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container py-5">
        {{-- Header dengan Progress Bar --}}
        <div class="mb-5">
            <div class="container py-5">
                {{-- Header dengan Progress Bar --}}
                <div class="mb-5">
                    {{-- Judul dan badge "Terdaftar" akan berada dalam satu baris --}}
                    <div class="d-flex align-items-center gap-3 mb-2">
                        <h1 class="fw-bold display-5 mb-0">{{ $track->name }}</h1>
                        @if ($isEnrolled)
                            <span class="badge bg-success-subtle text-success-emphasis rounded-pill px-3 py-2 fs-6">
                                <i class="fas fa-check-circle me-1"></i> Terdaftar
                            </span>
                        @endif
                    </div>
                    <p class="text-muted fs-5">{{ $track->description }}</p>
                    {{-- Progress Bar (hanya tampil jika sudah terdaftar) --}}
                    @if ($isEnrolled)
                        <div class="d-flex align-items-center mt-4">
                            <div class="progress flex-grow-1" style="height: 10px;">
                                <div class="progress-bar" role="progressbar" style="width: {{ $progressPercentage }}%;"
                                    aria-valuenow="{{ $progressPercentage }}"></div>
                            </div>
                            <span class="ms-3 fw-semibold text-muted">{{ round($progressPercentage) }}% Selesai</span>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Daftar Materi --}}
            <h3 class="fw-semibold mb-4">Daftar Materi</h3>
            <div class="list-group list-group-flush">
                @forelse ($materials as $material)
                    @php $isCompleted = $completedMaterials->contains($material->id); @endphp

                    <div
                        class="list-group-item d-flex justify-content-between align-items-center p-3 mb-2 border-0 rounded-3 {{ $isCompleted ? 'bg-light' : '' }}">
                        <div class="d-flex align-items-center">

                            {{-- [1] Tampilkan Nomor Urut --}}
                            <div class="fs-4 fw-bold text-muted me-4" style="width: 2rem; text-align: center;">
                                {{ $loop->iteration }}</div>

                            {{-- Lingkaran ikon --}}
                            <span class="fa-stack fa-2x me-3">
                                <i
                                    class="fas fa-circle fa-stack-2x {{ $isCompleted ? 'text-success' : 'text-primary-subtle' }}"></i>
                                @if ($isCompleted)
                                    {{-- [2] Tampilkan centang jika selesai --}}
                                    <i class="fas fa-check fa-stack-1x text-white"></i>
                                @endif
                            </span>

                            <div>
                                {{-- [3] Hapus coretan pada teks judul --}}
                                <h5 class="mb-0 fw-semibold">{{ $material->title }}</h5>
                                {{-- Teks jenis materi (video/pdf/dll.) sudah dihapus --}}
                            </div>

                        </div>
                        <a href="{{ route('learn.material.show', ['track' => $track, 'material' => $material]) }}"
                            class="btn {{ $isCompleted ? 'btn-success' : 'btn-outline-primary' }} fw-semibold">
                            {{ $isCompleted ? 'Lihat Lagi' : 'Lihat Materi' }} <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                @empty
                    <div class="text-center py-5 bg-light rounded-3">
                        <p class="text-muted fs-5">Belum ada materi di jalur belajar ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    @endsection
