@extends('layouts.admin')

@section('title', 'Manajemen Learning Path')
@section('page-title', 'Manajemen Learning Path')

@section('page-content')
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
            <div class="d-flex align-items-center mb-3 mb-md-0">
                <div>
                    <h4 class="mb-0 fw-bold text-dark">Daftar Learning Path</h4>
                    <p class="text-muted mb-0 small">Manajemen semua learning path</p>
                </div>
            </div>
            <a href="{{ route('admin.tracks.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Learning Path
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
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table id="tracks-table" class="table table-striped table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Learning Path</th>
                                <th>Deskripsi</th>
                                <th>Jumlah Modul</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tracks as $track)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $track->name }}</td>
                                    <td>{{ Str::limit($track->description, 50) }}</td>
                                    <td>{{ $track->materials()->count() }}</td>
                                    <td class="text-end">
                                        {{-- Tombol Baru untuk Kelola Materi --}}
                                        <a href="{{ route('admin.tracks.materials.index', $track) }}"
                                            class="btn btn-info btn-sm" title="Kelola Materi">
                                            <i class="fas fa-list-ul"></i>
                                        </a>
                                        <a href="{{ route('admin.tracks.edit', $track) }}" class="btn btn-warning btn-sm"
                                            title="Edit Track">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.tracks.destroy', $track) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Menghapus track akan menghapus semua materinya. Yakin?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus Track">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data track.</td>
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
