@extends('layouts.user')

@section('title', 'Profil Saya')

@section('content')
<div class="bg-white py-5">
    <div class="container">
        <div class="d-flex align-items-center">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=128&background=random" alt="Avatar" class="rounded-circle me-4">
            <div>
                <h1 class="display-5 fw-bold">{{ $user->name }}</h1>
                <p class="text-muted fs-5 mb-0">{{ $user->email }}</p>
                <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-secondary mt-2">Edit Profil</a>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    {{-- Statistik Pengguna --}}
    <h3 class="fw-semibold mb-4">Statistik Saya</h3>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0 p-4">
                <div class="display-4 fw-bold text-primary">{{ $user->points ?? 0 }}</div>
                <div class="text-muted mt-1">Total Poin</div> [cite: 21]
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0 p-4">
                <div class="display-4 fw-bold text-success">{{ $user->rank ?? 'Bronze' }}</div>
                <div class="text-muted mt-1">Peringkat Saat Ini</div> 
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0 p-4">
                <div class="display-4 fw-bold text-warning">0</div>
                <div class="text-muted mt-1">Materi Selesai</div>
            </div>
        </div>
    </div>

    {{-- Lencana Pencapaian --}}
    <h3 class="fw-semibold mb-4 mt-5">Pencapaian Saya</h3>
    <div class="row g-3">
        {{-- Contoh Lencana --}}
        <div class="col-md-6">
            <div class="d-flex align-items-center bg-light p-3 rounded-3">
                <i class="fas fa-check-double fa-2x text-success me-3"></i>
                <div>
                    <h6 class="fw-semibold mb-0">Kuis Pertama</h6>
                    <small class="text-muted">Menyelesaikan kuis pertamamu.</small>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="d-flex align-items-center bg-light p-3 rounded-3">
                <i class="fas fa-fire fa-2x text-danger me-3"></i>
                <div>
                    <h6 class="fw-semibold mb-0">Belajar Beruntun</h6>
                    <small class="text-muted">Login selama 7 hari berturut-turut.</small> [cite: 24]
                </div>
            </div>
        </div>
        {{-- Tambahkan lencana lainnya di sini --}}
    </div>
</div>
@endsection