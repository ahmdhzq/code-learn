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
        <div class="mb-5">
            <h1 class="fw-bold display-5 mb-0">{{ $track->name }}</h1>
            <p class="text-muted fs-5 mt-2">{{ $track->description }}</p>
        </div>

        {{-- ====================================================== --}}
        {{-- LOGIKA PENDAFTARAN & TAMPILAN MATERI --}}
        {{-- ====================================================== --}}
        @if ($isEnrolled)
            {{-- JIKA PENGGUNA SUDAH TERDAFTAR --}}
            <div class="d-flex align-items-center mt-4 mb-5">
                <div class="progress flex-grow-1" style="height: 10px;">
                    <div class="progress-bar" role="progressbar" style="width: {{ $progressPercentage }}%;"
                        aria-valuenow="{{ $progressPercentage }}"></div>
                </div>
                <span class="ms-3 fw-semibold text-muted">{{ round($progressPercentage) }}% Selesai</span>
            </div>

            <h3 class="fw-semibold mb-4">Daftar Materi</h3>
            <div class="list-group list-group-flush">
                {{-- LOGIKA ALUR BELAJAR BERURUTAN --}}
                @php $previousMaterialCompleted = true; @endphp
                
                @forelse ($materials as $material)
                    @php 
                        $isCompleted = $completedMaterials->contains($material->id);
                        $isLocked = !$previousMaterialCompleted;
                    @endphp

                    <div class="list-group-item d-flex justify-content-between align-items-center p-3 mb-2 border rounded-3 
                        {{ $isCompleted ? 'bg-success-subtle' : '' }} 
                        {{ $isLocked ? 'locked-material' : '' }}">
                        
                        <div class="d-flex align-items-center">
                            <div class="fs-4 fw-bold text-muted me-4" style="width: 2rem; text-align: center;">
                                {{ $loop->iteration }}</div>

                            <span class="fa-stack fa-2x me-3">
                                <i class="fas fa-circle fa-stack-2x {{ $isCompleted ? 'text-success' : 'text-light' }}"></i>
                                @if ($isLocked)
                                    <i class="fas fa-lock fa-stack-1x text-muted"></i>
                                @elseif ($isCompleted)
                                    <i class="fas fa-check fa-stack-1x text-white"></i>
                                @endif
                            </span>

                            <div>
                                <h5 class="mb-0 fw-semibold">{{ $material->title }}</h5>
                            </div>
                        </div>

                        <a href="{{ route('learn.material.show', ['track' => $track, 'material' => $material]) }}"
                            class="btn {{ $isCompleted ? 'btn-light' : 'btn-outline-primary' }} fw-semibold {{ $isLocked ? 'disabled' : '' }}">
                            {{ $isCompleted ? 'Lihat Lagi' : 'Lihat Materi' }} 
                            @if(!$isLocked) <i class="fas fa-arrow-right ms-2"></i> @endif
                        </a>
                    </div>
                    
                    @php $previousMaterialCompleted = $isCompleted; @endphp
                @empty
                    <div class="text-center py-5 bg-light rounded-3">
                        <p class="text-muted fs-5">Belum ada materi di jalur belajar ini.</p>
                    </div>
                @endforelse
            </div>

        @else
            {{-- JIKA PENGGUNA BELUM TERDAFTAR --}}
            <div class="text-center p-5 bg-light rounded-3">
                <i class="fas fa-book-open fa-3x text-primary mb-4"></i>
                <h4 class="fw-bold">Anda belum terdaftar di jalur belajar ini.</h4>
                <p class="text-muted">Ambil jalur belajar ini untuk mulai mengakses semua materinya.</p>
                <form action="{{ route('learn.track.enroll', $track) }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg fw-semibold">
                        <i class="fas fa-plus-circle me-2"></i> Ambil Jalur Belajar Ini
                    </button>
                </form>
            </div>
        @endif
        
    </div>
@endsection

@push('styles')
<style>
    .locked-material {
        background-color: #f8f9fa;
        opacity: 0.6;
        pointer-events: none;
    }
    .locked-material a.btn {
        pointer-events: auto;
    }
</style>
@endpush