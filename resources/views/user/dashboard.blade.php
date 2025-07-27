@extends('layouts.user')

@section('title', 'Dashboard Saya')

@section('content')
    <div class="bg-white py-4 shadow-sm">
        <div class="container d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div>
                <h2 class="fw-bold mb-0">Dashboard Saya</h2>
                <p class="text-muted mb-0">Selamat datang kembali! Lanjutkan progres belajar Anda.</p>
            </div>
            <a href="{{ route('learn.index') }}" class="btn btn-primary fw-semibold">
                <i class="fas fa-search me-2"></i>Jelajahi Jalur Lainnya
            </a>
        </div>
    </div>

    <div class="container py-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4 g-lg-5">

            <div class="{{ auth()->user()->can('upload-materi') ? 'col-lg-8' : 'col-12' }} border border-1 rounded-4 py-4">
                <h4 class="fw-bold mb-3">Jalur Belajar yang Sedang Diikuti</h4>

                <div class="row row-cols-1 row-cols-md-1 row-cols-xl-2 g-4">
                    @forelse ($enrolledTracks as $track)
                        <div class="col">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body p-4 d-flex flex-column">
                                    <h5 class="card-title fw-bold fs-4 mb-2">{{ $track->name }}</h5>
                                    <p class="card-text text-muted small flex-grow-1">{{ $track->description }}</p>
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
                        <div class="col-12">
                            <div class="text-center py-5 bg-light rounded-3">
                                <i class="fas fa-search fa-3x text-muted mb-4"></i>
                                <h4 class="fw-bold">Anda belum mengambil jalur belajar apapun.</h4>
                                <p class="text-muted">Ayo jelajahi dan pilih jalur belajar pertama Anda!</p>
                                <a href="{{ route('learn.index') }}" class="btn btn-primary btn-lg mt-3">Mulai Jelajahi</a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            @can('upload-materi')
                <div class="col-lg-4">
                    <div class="card border border-1 rounded-4 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">Kontribusi Saya</h5>
                            <div class="d-grid gap-2">
                                <a href="{{ route('materials.history') }}"
                                    class="btn btn-outline-secondary fw-semibold text-start">
                                    <i class="fas fa-history fa-fw me-2"></i>Riwayat Pengajuan
                                </a>

                                <a href="{{ route('materials.create') }}" class="btn btn-primary fw-semibold text-start">
                                    <i class="fas fa-plus-circle fa-fw me-2"></i>Ajukan Materi Baru
                                </a>
                            </div>
                            <p class="text-muted small mt-3 mb-0">Lihat riwayat atau ajukan materi baru jika Anda termasuk
                                kontributor teratas.</p>
                        </div>
                    </div>
                </div>
            @endcan

        </div>
    </div>
    @include('user.partials.footer')
@endsection
