@extends('layouts.user')

@section('title', 'Profil Saya')

@section('content')
<!-- Profile Header -->
<div class="bg-gradient-to-r from-success to-info text-white py-5" style="background: linear-gradient(135deg, #198754 0%, #0dcaf0 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-auto">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=120&background=ffffff&color=198754&bold=true" 
                     alt="Avatar" class="rounded-circle border border-4 border-white shadow">
            </div>
            <div class="col">
                <h1 class="display-5 fw-bold mb-2">{{ $user->name }}</h1>
                <p class="fs-5 mb-3 opacity-75">{{ $user->email }}</p>
                <a href="{{ route('profile.edit') }}" class="btn btn-light btn-lg rounded-pill px-4">
                    <i class="fas fa-edit me-2"></i>Edit Profil
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <!-- Statistics Cards -->
    <div class="mb-5">
        <h3 class="fw-bold mb-4">
            <i class="fas fa-chart-line text-success me-2"></i>
            Statistik Saya
        </h3>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="display-4 fw-bold text-primary mb-2">
                            {{ $user->points ?? 0 }}
                        </div>
                        <h6 class="text-muted mb-0">Total Poin</h6>
                        <div class="progress mt-3" style="height: 4px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 70%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="display-4 fw-bold text-success mb-2">
                            {{ $user->rank ?? 'Bronze' }}
                        </div>
                        <h6 class="text-muted mb-0">Peringkat Saat Ini</h6>
                        <div class="mt-3">
                            <span class="badge bg-success-subtle text-success px-3 py-2">
                                <i class="fas fa-trophy me-1"></i>Active Learner
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="display-4 fw-bold text-warning mb-2">0</div>
                        <h6 class="text-muted mb-0">Materi Selesai</h6>
                        <div class="progress mt-3" style="height: 4px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Achievements Section -->
    <div class="mb-5">
        <h3 class="fw-bold mb-4">
            <i class="fas fa-medal text-warning me-2"></i>
            Pencapaian Saya
        </h3>
        <div class="row g-3">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="fas fa-check-double fa-lg text-success"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Kuis Pertama</h6>
                                <small class="text-muted">Menyelesaikan kuis pertamamu</small>
                                <div class="mt-1">
                                    <span class="badge bg-success-subtle text-success">Completed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-danger bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="fas fa-fire fa-lg text-danger"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Belajar Beruntun</h6>
                                <small class="text-muted">Login selama 7 hari berturut-turut</small>
                                <div class="mt-1">
                                    <span class="badge bg-warning-subtle text-warning">In Progress</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="fas fa-book fa-lg text-primary"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Pembaca Aktif</h6>
                                <small class="text-muted">Membaca lebih dari 10 materi</small>
                                <div class="mt-1">
                                    <span class="badge bg-secondary-subtle text-secondary">Locked</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="fas fa-star fa-lg text-info"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Bintang Terang</h6>
                                <small class="text-muted">Mendapat rating 5 bintang</small>
                                <div class="mt-1">
                                    <span class="badge bg-secondary-subtle text-secondary">Locked</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="mb-5">
        <h3 class="fw-bold mb-4">
            <i class="fas fa-clock text-info me-2"></i>
            Aktivitas Terbaru
        </h3>
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada aktivitas</h5>
                    <p class="text-muted">Mulai belajar untuk melihat aktivitas terbaru Anda</p>
                    <a href="#" class="btn btn-success btn-lg rounded-pill px-4">
                        <i class="fas fa-play me-2"></i>Mulai Belajar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 1rem !important;
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-2px);
}

.progress {
    border-radius: 10px;
}

.badge {
    font-size: 0.75rem;
}
</style>
@endsection