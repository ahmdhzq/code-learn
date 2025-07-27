@extends('layouts.user')

@section('title', 'Profil Saya')

@section('content')
<div class="py-5" style="background: linear-gradient(135deg, #198754 0%, #0dcaf0 100%);">
    <div class="container text-white">
        <div class="row align-items-center">
            <div class="col-auto">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=120&background=ffffff&color=198754&bold=true" 
                     alt="Avatar" class="rounded-circle border border-4 border-white shadow">
            </div>
            <div class="col">
                <h1 class="display-5 fw-bold mb-1">{{ $user->name }}</h1>
                <p class="fs-5 mb-3 opacity-75">{{ $user->email }}</p>
                <a href="{{ route('profile.edit') }}" class="btn btn-light rounded-pill px-4">
                    <i class="fas fa-edit me-2"></i>Edit Profil
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="mb-5">
        <h3 class="fw-bold mb-4">
            <i class="fas fa-chart-line text-success me-2"></i>
            Statistik Saya
        </h3>
        <div class="row g-4">
            {{-- Total Poin --}}
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="display-4 fw-bold text-primary mb-2">{{ $user->points ?? 0 }}</div>
                        <h6 class="text-muted mb-0">Total Poin</h6>
                    </div>
                </div>
            </div>
            {{-- Materi Selesai --}}
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        {{-- Menghitung jumlah materi yang sudah diselesaikan --}}
                        <div class="display-4 fw-bold text-success mb-2">{{ $user->completedMaterials->count() }}</div>
                        <h6 class="text-muted mb-0">Materi Selesai</h6>
                    </div>
                </div>
            </div>
            {{-- Jalur Belajar Diikuti --}}
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                         {{-- Menghitung jumlah track yang diikuti --}}
                        <div class="display-4 fw-bold text-warning mb-2">{{ $user->enrolledTracks->count() }}</div>
                        <h6 class="text-muted mb-0">Jalur Belajar Diikuti</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5">
        <h3 class="fw-bold mb-4">
            <i class="fas fa-road text-info me-2"></i>
            Jalur Belajar yang Sedang Diikuti
        </h3>
        <div class="list-group">
            @forelse($user->enrolledTracks as $track)
                <a href="{{ route('learn.track.show', $track) }}" class="list-group-item list-group-item-action p-3">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1 fw-semibold">{{ $track->name }}</h5>
                        <small class="text-muted">{{ round($track->progressPercentage) }}% selesai</small>
                    </div>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar" role="progressbar" style="width: {{ $track->progressPercentage }}%;"></div>
                    </div>
                </a>
            @empty
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center p-5">
                        <p class="text-muted">Anda belum mengambil jalur belajar apapun.</p>
                        <a href="{{ route('learn.index') }}" class="btn btn-primary">Mulai Jelajahi</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@include('user.partials.footer')
@endsection