@extends('layouts.user')

@section('title', 'Dashboard Saya')

@section('content')
    <div class="bg-white py-4 shadow-sm">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-0">Dashboard Saya</h2>
                <p class="text-muted mb-0">Jalur belajar yang sedang Anda ikuti.</p>
            </div>
            <a href="{{ route('learn.index') }}" class="btn btn-primary fw-semibold">Jelajahi Jalur Lainnya</a>
        </div>
    </div>

    <div class="container py-5">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row row-cols-1 row-cols-md-2 g-4">
            @forelse ($enrolledTracks as $track)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold fs-4 mb-2">{{ $track->name }}</h5>
                            <p class="card-text text-muted small flex-grow-1">{{ $track->description }}</p>

                            {{-- [BARU] Bagian Progress Bar --}}
                            <div class="mt-4">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted small">Progress</span>
                                    <span class="fw-semibold small">{{ round($track->progressPercentage) }}%</span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: {{ $track->progressPercentage }}%;"
                                        aria-valuenow="{{ $track->progressPercentage }}" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 p-4 pt-0">
                            <a href="{{ route('learn.track.show', $track) }}"
                                class="btn btn-outline-primary w-100 fw-semibold">Lanjutkan Belajar</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 bg-light rounded-3">
                    <i class="fas fa-search fa-3x text-muted mb-4"></i>
                    <h4 class="fw-bold">Anda belum mengambil jalur belajar apapun.</h4>
                    <p class="text-muted">Ayo jelajahi dan pilih jalur belajar pertama Anda!</p>
                    <a href="{{ route('learn.index') }}" class="btn btn-primary btn-lg mt-3">Mulai Jelajahi</a>
                </div>
            @endforelse
            @can('upload-materi')
                <a href="{{ route('materials.create') }}" class="btn btn-primary">
                    Upload Materi Baru
                </a>
            @endcan
        </div>
    </div>
@endsection
