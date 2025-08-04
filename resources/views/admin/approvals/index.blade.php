@extends('layouts.admin')

@section('title', 'Manajemen Approval')
@section('page-title', 'Persetujuan Materi')

@section('page-content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-0 fw-bold text-dark">Materi Menunggu Persetujuan</h4>
                <p class="text-muted mb-0 small">Setujui atau tolak materi yang dikirim oleh kontributor.</p>
            </div>
        </div>

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

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table id="approvals-table" class="table table-striped table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Materi</th>
                                <th>Learning Path</th>
                                <th>Pengirim</th>
                                <th>Tanggal Kirim</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pendingMaterials as $material)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ Str::limit($material->title, 50) }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $material->track->name }}</span>
                                    </td>
                                    <td>{{ $material->user?->name ?? 'Admin' }}</td>
                                    <td>{{ $material->created_at->format('d M Y') }}</td>
                                    <td class="text-center">
                                        {{-- Tombol untuk membuka modal detail --}}
                                        <button type="button" class="btn btn-warning btn-sm view-detail-btn"
                                            data-bs-toggle="modal" data-bs-target="#approvalDetailModal"
                                            data-approve-url="{{ route('admin.approvals.approve', $material) }}"
                                            data-reject-url="{{ route('admin.approvals.reject', $material) }}"
                                            data-title="{{ e($material->title) }}" data-track="{{ $material->track->name }}"
                                            data-user="{{ $material->user?->name ?? 'Admin' }}"
                                            data-date="{{ $material->created_at->format('d M Y, H:i') }}"data-material-type="{{ $material->type }}"
                                            data-material-content="{{ $material->type === 'pdf' ? Storage::url($material->content) : e($material->content) }}"
                                            title="Lihat Detail & Aksi">
                                            <i class="fas fa-search-plus"></i> Lihat
                                        </button>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="approvalDetailModal" tabindex="-1" aria-labelledby="approvalDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approvalDetailModalLabel">Detail Materi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <label class="form-label fw-bold">Judul Materi:</label>
                            <p id="modal-title" class="text-dark fs-5"></p>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Learning Path:</label>
                            <p id="modal-track" class="text-muted"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <label class="form-label fw-bold">Pengirim:</label>
                            <p id="modal-user" class="text-muted"></p>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Tanggal Kirim:</label>
                            <p id="modal-date" class="text-muted"></p>
                        </div>
                    </div>
                    <hr>
                    <hr>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Preview Konten Materi:</label>
                        <div id="modal-content-area" class="p-3 bg-light rounded border">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    {{-- Tombol Tolak --}}
                    <form id="modal-reject-form" method="POST"
                        onsubmit="return confirm('Anda yakin ingin MENOLAK materi ini?');">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-times me-2"></i>Tolak
                        </button>
                    </form>
                    {{-- Tombol Setujui --}}
                    <form id="modal-approve-form" method="POST"
                        onsubmit="return confirm('Anda yakin ingin MENYETUJUI materi ini?');">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check me-2"></i>Setujui
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#approvals-table').DataTable({
                order: [
                    [4, 'asc']
                ],
                pageLength: 10,
                responsive: true,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data yang tersedia",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    zeroRecords: "Tidak ada data yang cocok dengan pencarian Anda",
                    emptyTable: "Tidak ada materi yang menunggu persetujuan."
                },
                columnDefs: [{
                    targets: -1,
                    orderable: false,
                    searchable: false
                }]
            });
            const approvalDetailModal = document.getElementById('approvalDetailModal');
            approvalDetailModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;

                const title = button.getAttribute('data-title');
                const track = button.getAttribute('data-track');
                const user = button.getAttribute('data-user');
                const date = button.getAttribute('data-date');
                const approveUrl = button.getAttribute('data-approve-url');
                const rejectUrl = button.getAttribute('data-reject-url');

                const materialType = button.getAttribute('data-material-type');
                const materialContent = button.getAttribute('data-material-content');

                let contentHtml = '';
                if (materialType === 'video') {
                    contentHtml = `
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/${materialContent}" title="${title}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>`;
                } else if (materialType === 'article') {
                    contentHtml = `<div class="article-content">${materialContent}</div>`;
                } else if (materialType === 'pdf') {
                    contentHtml = `
                        <div class="ratio" style="--bs-aspect-ratio: 141.42%;">
                            <iframe src="${materialContent}" title="${title}" allowfullscreen></iframe>
                        </div>`;
                } else {
                    contentHtml =
                        `<div class="alert alert-warning">Tipe konten tidak didukung atau konten kosong.</div>`;
                }

                // Masukkan semua data ke modal
                approvalDetailModal.querySelector('#modal-title').textContent = title;
                approvalDetailModal.querySelector('#modal-track').textContent = track;
                approvalDetailModal.querySelector('#modal-user').textContent = user;
                approvalDetailModal.querySelector('#modal-date').textContent = date;
                approvalDetailModal.querySelector('#modal-content-area').innerHTML = contentHtml;
                approvalDetailModal.querySelector('#modal-approve-form').action = approveUrl;
                approvalDetailModal.querySelector('#modal-reject-form').action = rejectUrl;
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
