@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('page-content')
{{-- Baris untuk kartu statistik --}}
<div class="row g-4 mb-4">
    <!-- Kartu Total Pengguna -->
    <div class="col-md-6 col-xl-3">
        <div class="card stat-card fade-in">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="flex-grow-1">
                        <h6 class="text-muted mb-1">Total Pengguna</h6>
                        <h3 class="fw-bold mb-2">{{ number_format($totalUsers) }}</h3>
                        {{-- [DYNAMIC] Menampilkan pengguna baru --}}
                        <small class="text-success">
                            <i class="fas fa-arrow-up me-1"></i>
                            +{{ $newUsersThisWeek }} baru minggu ini
                        </small>
                    </div>
                    <div class="stat-icon icon-primary">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kartu Total Tracks -->
    <div class="col-md-6 col-xl-3">
        <div class="card stat-card fade-in-delay-1">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="flex-grow-1">
                        <h6 class="text-muted mb-1">Total Learning Path</h6>
                        <h3 class="fw-bold mb-2">{{ number_format($totalTracks) }}</h3>
                        <small class="text-muted">Jalur belajar tersedia</small>
                    </div>
                    <div class="stat-icon icon-warning">
                        <i class="fas fa-road"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kartu Total Materi -->
    <div class="col-md-6 col-xl-3">
        <div class="card stat-card fade-in-delay-2">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="flex-grow-1">
                        <h6 class="text-muted mb-1">Total Modul</h6>
                        <h3 class="fw-bold mb-2">{{ number_format($totalMaterials) }}</h3>
                        <small class="text-muted">Modul telah dibuat</small>
                    </div>
                    <div class="stat-icon icon-info">
                        <i class="fas fa-book-open"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kartu Total Kuis -->
    <div class="col-md-6 col-xl-3">
        <div class="card stat-card fade-in-delay-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="flex-grow-1">
                        <h6 class="text-muted mb-1">Total Kuis</h6>
                        <h3 class="fw-bold mb-2">{{ number_format($totalQuizzes) }}</h3>
                        <small class="text-muted">Kuis telah dibuat</small>
                    </div>
                    <div class="stat-icon icon-success">
                        <i class="fas fa-question-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Baris untuk Grafik dan Aktivitas Terbaru --}}
<div class="row g-4">
    <!-- Kolom untuk Grafik -->
    <div class="col-xl-8">
        <div class="card stat-card h-100 p-3">
            <div class="card-header bg-transparent border-0 pb-0">
                <h5 class="card-title mb-0 fw-semibold">Konten Dibuat per Bulan</h5>
            </div>
            <div class="card-body">
                <div class="chart-card">
                    <canvas id="contentChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    
      <!-- Kolom untuk Aktivitas Terbaru -->
    <div class="col-xl-4">
        <div class="card stat-card h-100 p-3">
            <div class="card-header bg-transparent border-0 pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 fw-semibold">Learning Path Terbaru</h5>
                    <a href="{{ route('admin.tracks.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
            </div>
            <div class="card-body">
                <div class="activity-list">
                    {{-- [DYNAMIC] Daftar aktivitas dari controller --}}
                    @forelse ($latestTracks as $track)
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-road"></i>
                            </div>
                            <div class="activity-content">
                                <h6 class="mb-1">{{ $track->name }}</h6>
                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i>Dibuat {{ $track->created_at->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted py-4">
                            <p>Belum ada aktivitas.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Data untuk chart (diambil dari controller)
        const chartLabels = {!! json_encode($chartLabels) !!};
        const chartData = {!! json_encode($chartData) !!};

        const ctx = document.getElementById('contentChart').getContext('2d');
        
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(37, 99, 235, 0.8)');
        gradient.addColorStop(1, 'rgba(37, 99, 235, 0.1)');
        
        const contentChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Konten Baru',
                    data: chartData,
                    backgroundColor: gradient,
                    borderColor: '#2563eb',
                    borderWidth: 2,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                },
                scales: {
                    x: { grid: { display: false } },
                    y: { beginAtZero: true }
                }
            }
        });
    });
</script>
@endpush

{{-- [NEW] Menambahkan styling kustom untuk daftar aktivitas --}}
@push('styles')
<style>
    .activity-list {
        max-height: 350px;
        overflow-y: auto;
        padding-right: 10px;
    }
    .activity-item {
        display: flex;
        align-items: center;
        padding: 0.8rem 0.5rem;
        border-bottom: 1px solid #e9ecef;
        transition: background-color 0.2s ease-in-out;
    }
    .activity-item:last-child {
        border-bottom: none;
    }
    .activity-item:hover {
        background-color: #f8f9fa;
        border-radius: 0.5rem;
    }
    .activity-icon {
        flex-shrink: 0;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin-right: 1rem;
        background-color: rgba(37, 99, 235, 0.1);
    }
    .activity-icon i {
        color: #2563eb;
        font-size: 1rem;
    }
    .activity-content {
        flex-grow: 1;
        min-width: 0;
    }
    .activity-content h6 {
        font-size: 0.9rem;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 0.25rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .activity-content small {
        color: #6c757d;
        font-size: 0.8rem;
    }
</style>
@endpush
