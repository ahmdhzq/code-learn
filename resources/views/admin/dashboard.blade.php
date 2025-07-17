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
                        <small class="text-success">
                            <i class="fas fa-arrow-up me-1"></i>
                            +5 baru minggu ini
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
                        <h6 class="text-muted mb-1">Total Tracks</h6>
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
                        <h6 class="text-muted mb-1">Total Materi</h6>
                        <h3 class="fw-bold mb-2">{{ number_format($totalMaterials) }}</h3>
                        <small class="text-success">
                            <i class="fas fa-arrow-up me-1"></i>
                            +12 baru bulan ini
                        </small>
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
        <div class="card stat-card h-100">
            <div class="card-header bg-transparent border-0 pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 fw-semibold">Konten Dibuat per Bulan</h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-calendar-alt me-1"></i>
                            6 Bulan Terakhir
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">3 Bulan Terakhir</a></li>
                            <li><a class="dropdown-item" href="#">6 Bulan Terakhir</a></li>
                            <li><a class="dropdown-item" href="#">1 Tahun Terakhir</a></li>
                        </ul>
                    </div>
                </div>
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
        <div class="card stat-card h-100">
            <div class="card-header bg-transparent border-0 pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 fw-semibold">Tracks Terbaru</h5>
                    <a href="{{ route('admin.tracks.index') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-external-link-alt me-1"></i>
                        Lihat Semua
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-python text-primary"></i>
                        </div>
                        <div class="activity-content">
                            <h6 class="mb-1">Dasar Pemrograman Python</h6>
                            <small class="text-muted">Dibuat 2 jam yang lalu</small>
                        </div>
                        <span class="badge bg-primary">Baru</span>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-code text-warning"></i>
                        </div>
                        <div class="activity-content">
                            <h6 class="mb-1">Belajar HTML & CSS</h6>
                            <small class="text-muted">Diperbarui 2 hari lalu</small>
                        </div>
                        <span class="badge bg-light text-dark">Update</span>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fab fa-laravel text-danger"></i>
                        </div>
                        <div class="activity-content">
                            <h6 class="mb-1">Laravel untuk Pemula</h6>
                            <small class="text-muted">Dibuat 5 hari lalu</small>
                        </div>
                        <span class="badge bg-light text-dark">Aktif</span>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fab fa-js-square text-success"></i>
                        </div>
                        <div class="activity-content">
                            <h6 class="mb-1">Javascript Modern</h6>
                            <small class="text-muted">Dibuat 1 minggu lalu</small>
                        </div>
                        <span class="badge bg-light text-dark">Populer</span>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-database text-info"></i>
                        </div>
                        <div class="activity-content">
                            <h6 class="mb-1">Database MySQL</h6>
                            <small class="text-muted">Dibuat 2 minggu lalu</small>
                        </div>
                        <span class="badge bg-light text-dark">Selesai</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Baris tambahan untuk statistik lanjutan --}}
<div class="row g-4 mt-4">
    <div class="col-md-6">
        <div class="card stat-card">
            <div class="card-header bg-transparent border-0 pb-0">
                <h5 class="card-title mb-0 fw-semibold">Pengguna Aktif</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="progress mb-2" style="height: 8px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 75%"></div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">Aktif minggu ini</small>
                            <small class="fw-semibold">75%</small>
                        </div>
                    </div>
                    <div class="ms-3">
                        <i class="fas fa-users-cog fs-2 text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card stat-card">
            <div class="card-header bg-transparent border-0 pb-0">
                <h5 class="card-title mb-0 fw-semibold">Completion Rate</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="progress mb-2" style="height: 8px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 68%"></div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">Rata-rata penyelesaian</small>
                            <small class="fw-semibold">68%</small>
                        </div>
                    </div>
                    <div class="ms-3">
                        <i class="fas fa-chart-line fs-2 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Activity List Styling */
.activity-list {
    max-height: 400px;
    overflow-y: auto;
}

.activity-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid var(--sidebar-border);
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 2.5rem;
    height: 2.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--sidebar-link-hover);
    border-radius: var(--border-radius);
    margin-right: 0.75rem;
    font-size: 1.125rem;
}

.activity-content {
    flex: 1;
    min-width: 0;
}

.activity-content h6 {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-color);
    margin-bottom: 0.25rem;
}

.activity-content small {
    color: var(--text-muted-color);
    font-size: 0.75rem;
}

.badge {
    font-size: 0.625rem;
    padding: 0.25rem 0.5rem;
    border-radius: var(--border-radius);
}

/* Progress bars */
.progress {
    background-color: var(--sidebar-link-hover);
    border-radius: 4px;
}

.progress-bar {
    border-radius: 4px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .activity-item {
        padding: 0.5rem 0;
    }
    
    .activity-icon {
        width: 2rem;
        height: 2rem;
        font-size: 1rem;
        margin-right: 0.5rem;
    }
    
    .activity-content h6 {
        font-size: 0.8125rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Data untuk chart (diambil dari controller)
        const chartLabels = {!! json_encode($chartLabels) !!};
        const chartData = {!! json_encode($chartData) !!};

        // Konfigurasi Chart.js dengan style modern
        const ctx = document.getElementById('contentChart').getContext('2d');
        
        // Gradient untuk chart
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
                    borderRadius: 6,
                    borderSkipped: false,
                    barThickness: 'flex',
                    maxBarThickness: 40
                }]
            },
            options: {
                ...window.chartDefaults,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                animation: {
                    duration: 1000,
                    easing: 'easeInOutQuart'
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `Konten: ${context.parsed.y}`;
                            }
                        }
                    }
                }
            }
        });
        
        // Animate number counters
        const counters = document.querySelectorAll('.stat-card h3');
        counters.forEach(counter => {
            const target = parseInt(counter.textContent.replace(/,/g, ''));
            let current = 0;
            const increment = target / 100;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                counter.textContent = Math.floor(current).toLocaleString();
            }, 20);
        });
    });
</script>
@endpush