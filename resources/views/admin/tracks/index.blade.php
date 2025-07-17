@extends('layouts.admin')

@section('title', 'Kelola Tracks')
@section('page-title', 'Manajemen Learning Tracks')

@section('page-content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
        <div class="d-flex align-items-center mb-3 mb-md-0">
            <div>
                <h4 class="mb-0 fw-bold text-dark">Learning Tracks</h4>
                <p class="text-muted mb-0 small">Kelola semua track pembelajaran</p>
            </div>
        </div>
        <a href="{{ route('admin.tracks.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Track
        </a>
    </div>

    <!-- Success Alert -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <div class="d-flex align-items-center">
                <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                    <i class="fas fa-check text-success"></i>
                </div>
                <div>
                    <strong>Berhasil!</strong> {{ session('success') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Data Table Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-3">
            <div class="table-responsive">
                <table id="tracks-table" class="table table-hover mb-0" style="width:100%">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3 border-0 fw-semibold text-dark">No</th>
                            <th class="px-4 py-3 border-0 fw-semibold text-dark">Track</th>
                            <th class="px-4 py-3 border-0 fw-semibold text-dark">Deskripsi</th>
                            <th class="px-4 py-3 border-0 fw-semibold text-dark">Dibuat</th>
                            <th class="px-4 py-3 border-0 fw-semibold text-dark text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tracks as $track)
                        <tr>
                            <td class="px-4 py-3 border-0">
                                <span class="badge bg-light text-dark">#{{ $track->id }}</span>
                            </td>
                            <td class="px-4 py-3 border-0">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6 class="mb-0">{{ $track->name }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 border-0">
                                <span class="text-muted">{{ Str::limit($track->description, 60) }}</span>
                            </td>
                            <td class="px-4 py-3 border-0">
                                <small class="text-muted">{{ $track->created_at->format('d M Y') }}</small>
                            </td>
                            <td class=" text-end">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.tracks.edit', $track) }}" 
                                       class="btn rounded btn-outline-warning btn-sm mx-2" 
                                       title="Edit Track">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.tracks.destroy', $track) }}" 
                                          method="POST" 
                                          class="d-inline" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus track ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-outline-danger btn-sm" 
                                                title="Hapus Track">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <div class="bg-light rounded-circle p-4 mb-3">
                                        <i class="fas fa-route text-muted fs-1"></i>
                                    </div>
                                    <h6 class="text-muted mb-2">Belum ada track</h6>
                                    <p class="text-muted small mb-3">Mulai dengan menambahkan track pembelajaran pertama</p>
                                    <a href="{{ route('admin.tracks.create') }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus me-1"></i>Tambah Track
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#tracks-table').DataTable({
            order: [[0, 'desc']],
            pageLength: 10,
            responsive: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data yang tersedia",
                infoFiltered: "(difilter dari _MAX_ total data)",
                emptyTable: "Tidak ada data yang tersedia dalam tabel"
            },
            columnDefs: [{
                targets: -1,
                orderable: false
            }]
        });
    });
</script>
@endpush

@push('styles')
<style>
    .btn {
        border-radius: 0.5rem;
        font-weight: 500;
        padding: 0.625rem 1.25rem;
    }
    
    .btn-sm {
        padding: 0.375rem 0.75rem;
    }
    
    .card {
        border-radius: 1rem;
    }
    
    .table > :not(caption) > * > * {
        border-bottom-width: 0;
    }
    
    .table tbody tr {
        border-bottom: 1px solid #f0f0f0;
    }
    
    .table tbody tr:hover {
        background-color: #f8f9fa;
    }
    
    .alert {
        border-radius: 0.75rem;
    }
    
    .badge {
        font-size: 0.75rem;
        font-weight: 500;
    }
    
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        padding: 1rem;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 0.5rem;
        margin: 0 0.125rem;
    }
</style>
@endpush