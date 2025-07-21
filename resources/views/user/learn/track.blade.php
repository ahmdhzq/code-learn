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
                    <h1 class="fw-bold display-5">{{ $track->name }}</h1>
                    <p class="text-muted fs-5">{{ $track->description }}</p>

                    {{-- [BARU] Tombol untuk mengambil jalur belajar --}}
                    @if (!$isEnrolled)
                        <form action="{{ route('learn.track.enroll', $track) }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-lg fw-semibold">
                                <i class="fas fa-plus-circle me-2"></i> Ambil Jalur Belajar Ini
                            </button>
                        </form>
                    @else
                        <div class="alert alert-success mt-4">
                            <i class="fas fa-check-circle me-2"></i> Anda sudah terdaftar di jalur belajar ini.
                        </div>
                    @endif

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
                    {{-- [BARU] Cek apakah materi sudah selesai --}}
                    @php $isCompleted = $completedMaterials->contains($material->id); @endphp

                    <div
                        class="list-group-item d-flex justify-content-between align-items-center p-3 mb-3 border rounded-3 {{ $isCompleted ? 'bg-light' : '' }}">
                        <div class="d-flex align-items-center">
                            <span class="fa-stack fa-2x me-4">
                                <i
                                    class="fas fa-circle fa-stack-2x {{ $isCompleted ? 'text-success' : 'text-primary-subtle' }}"></i>
                                @if ($isCompleted)
                                    <i class="fas fa-check fa-stack-1x text-white"></i>
                                @elseif ($material->type === 'video')
                                    <i class="fas fa-play fa-stack-1x text-primary"></i>
                                @elseif ($material->type === 'article')
                                    <i class="fas fa-file-alt fa-stack-1x text-primary"></i>
                                @else
                                    <i class="fas fa-file-pdf fa-stack-1x text-primary"></i>
                                @endif
                            </span>
                            <div>
                                <h5
                                    class="mb-0 fw-semibold {{ $isCompleted ? 'text-decoration-line-through text-muted' : '' }}">
                                    {{ $material->title }}</h5>
                                <small class="text-muted text-capitalize">{{ $material->type }}</small>
                            </div>
                        </div>
                        {{-- [BARU] Tombol dinamis --}}
                        <a href="#"
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
