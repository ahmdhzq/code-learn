@extends('layouts.admin')

@section('title', 'Manajemen Materi')
@section('page-title', 'Manajemen Materi')

@section('page-content')
    <div class="container-fluid">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
            <div class="d-flex align-items-center mb-3 mb-md-0">
                <div>
                    <h4 class="mb-0 fw-bold text-dark">Materi untuk Learning Path: <span class="text-primary">{{ $track->name }}</span></h4>
                    <p class="text-muted mb-0 small">Kelola semua materi pembelajaran untuk track ini</p>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('admin.tracks.index') }}" class="btn btn-light">
                <i class="fas fa-arrow-left me-1"></i>
                Kembali ke Semua Track
            </a>
            <a href="{{ route('admin.tracks.materials.create', $track) }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>
                Tambah Materi Baru
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="table-responsive">
                    {{-- Beri ID pada tabel untuk DataTables --}}
                    <table id="materials-table" class="table table-striped table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Materi</th>
                                <th>Tipe</th>
                                <th>Kuis</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($materials as $material)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $material->title }}</td>
                                    <td><span class="badge bg-info text-white">{{ ucfirst($material->type) }}</span></td>
                                    <td>
                                        @if ($material->quiz)
                                            <span class="badge bg-success">Sudah Ada</span>
                                        @else
                                            <span class="badge bg-secondary">Belum Ada</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.quizzes.show', $material) }}" class="btn btn-success btn-sm"
                                            title="Kelola Kuis">
                                            <i class="fas fa-question-circle"></i>
                                        </a>
                                        <a href="{{ route('admin.tracks.materials.edit', [$track, $material]) }}"
                                            class="btn btn-warning btn-sm" title="Edit Materi">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.tracks.materials.destroy', [$track, $material]) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus Materi">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    {{-- Sesuaikan colspan menjadi 5 --}}
                                    <td colspan="5" class="text-center py-4">
                                        <p class="mb-2">Belum ada materi di track ini.</p>
                                        <a href="{{ route('admin.tracks.materials.create', $track) }}"
                                            class="btn btn-primary btn-sm">Tambah Materi Pertama</a>
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
    {{-- Inisialisasi DataTables --}}
    <script>
        $(document).ready(function() {
            $('#materials-table').DataTable({
                order: [
                    [0, 'asc'] 
                ],
                pageLength: 10,
                responsive: true,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data yang tersedia",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    emptyTable: "Tidak ada data yang tersedia dalam tabel",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    },
                },
                // Nonaktifkan pengurutan untuk kolom "Aksi"
                columnDefs: [{
                    targets: -1, 
                    orderable: false
                }]
            });
        });
    </script>
@endpush

@push('styles')
    {{-- Style yang sama dengan halaman tracks untuk konsistensi --}}
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

        .table> :not(caption)>*>* {
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