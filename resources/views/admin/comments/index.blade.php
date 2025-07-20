@extends('layouts.admin')

@section('title', 'Manajemen Komentar')
@section('page-title', 'Manajemen Komentar')

@section('page-content')
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
            <div class="d-flex align-items-center mb-3 mb-md-0">
                <div>
                    <h4 class="mb-0 fw-bold text-dark">Daftar Semua Komentar</h4>
                    <p class="text-muted mb-0 small">Manajemen dan moderasi semua komentar</p>
                </div>
            </div>
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

        <!-- Filter Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h5 class="card-title fw-bold mb-3">Filter Lanjutan</h5>
                <div class="row">
                    <div class="col-md-4">
                        <label for="track-filter" class="form-label">Berdasarkan Path</label>
                        <select id="track-filter" class="form-select">
                            <option value="" data-track-id="">Semua Path</option>
                            @foreach ($tracks as $track)
                                <option value="{{ $track->name }}" data-track-id="{{ $track->id }}">{{ $track->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="user-filter" class="form-label">Berdasarkan Pengguna</label>
                        <select id="user-filter" class="form-select">
                            <option value="">Semua Pengguna</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->name }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="material-filter" class="form-label">Berdasarkan Materi</label>
                        <select id="material-filter" class="form-select">
                            <option value="">Semua Materi</option>
                             @foreach ($materials as $material)
                                <option value="{{ $material->title }}" data-track-id="{{ $material->track_id }}">{{ Str::limit($material->title, 40) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table Card -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table id="comments-table" class="table table-striped table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Komentar</th>
                                <th>Pengguna</th>
                                <th>Pada Materi</th>
                                <th>Path</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($comments as $comment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ Str::limit($comment->body, 70) }}</td>
                                    <td>{{ $comment->user->name ?? 'N/A' }}</td>
                                    <td>{{ $comment->material->title ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $comment->material->track->name ?? 'N/A' }}</span>
                                    </td>
                                    {{-- [FIXED] Tombol Aksi diubah menjadi tombol View Modal --}}
                                    <td class="text-center">
                                        <button type="button" class="btn btn-warning btn-sm view-comment-btn" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#commentDetailModal"
                                                data-comment-body="{{ e($comment->body) }}"
                                                data-comment-user="{{ $comment->user->name ?? 'N/A' }}"
                                                data-comment-material="{{ $comment->material->title ?? 'N/A' }}"
                                                data-comment-track="{{ $comment->material->track->name ?? 'N/A' }}"
                                                data-comment-date="{{ $comment->created_at->format('d M Y, H:i') }}"
                                                data-delete-url="{{ route('admin.comments.destroy', $comment) }}"
                                                title="Lihat Detail Komentar">
                                            <i class="fas fa-eye"></i>
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

    <!-- [NEW] Modal untuk Detail Komentar -->
    <div class="modal fade" id="commentDetailModal" tabindex="-1" aria-labelledby="commentDetailModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="commentDetailModalLabel">Detail Komentar</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Pengguna:</label>
                    <p id="modal-user" class="text-muted"></p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Tanggal:</label>
                    <p id="modal-date" class="text-muted"></p>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Pada Materi:</label>
                <p id="modal-material" class="text-muted"></p>
            </div>
             <div class="mb-3">
                <label class="form-label fw-bold">Learning Path:</label>
                <p id="modal-track" class="text-muted"></p>
            </div>
            <hr>
            <div class="mb-3">
                <label class="form-label fw-bold">Isi Komentar:</label>
                <div id="modal-body-content" class="p-3 bg-light rounded" style="white-space: pre-wrap; word-wrap: break-word;"></div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <form id="modal-delete-form" method="POST" class="d-inline" onsubmit="return confirm('Anda yakin ingin menghapus komentar ini secara permanen?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash me-2"></i>Hapus Komentar
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
            var table = $('#comments-table').DataTable({
                order: [[0, 'asc']],
                pageLength: 10,
                responsive: true,
                language: {
                    search: "Cari (Pencarian Umum):",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data yang tersedia",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    emptyTable: "Tidak ada data yang tersedia dalam tabel"
                },
                columnDefs: [{ targets: -1, orderable: false }]
            });

            const trackFilter = $('#track-filter');
            const materialFilter = $('#material-filter');
            const originalMaterialOptions = materialFilter.html();

            trackFilter.on('change', function() {
                const selectedTrackId = $(this).find(':selected').data('track-id');
                materialFilter.html(originalMaterialOptions);
                materialFilter.val('');
                table.column(3).search('').draw();
                if (selectedTrackId) {
                    materialFilter.find('option').each(function() {
                        const option = $(this);
                        if (option.val() !== "" && option.data('track-id') != selectedTrackId) {
                            option.remove();
                        }
                    });
                }
                table.column(4).search($(this).val()).draw();
            });
            
            $('#user-filter').on('change', function() {
                table.column(2).search($(this).val()).draw();
            });

            $('#material-filter').on('change', function() {
                table.column(3).search($(this).val()).draw();
            });

            // --- [NEW] Logika untuk Modal Detail Komentar ---
            const commentDetailModal = document.getElementById('commentDetailModal');
            commentDetailModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const commentBody = button.getAttribute('data-comment-body');
                const commentUser = button.getAttribute('data-comment-user');
                const commentMaterial = button.getAttribute('data-comment-material');
                const commentTrack = button.getAttribute('data-comment-track');
                const commentDate = button.getAttribute('data-comment-date');
                const deleteUrl = button.getAttribute('data-delete-url');

                commentDetailModal.querySelector('#modal-user').textContent = commentUser;
                commentDetailModal.querySelector('#modal-material').textContent = commentMaterial;
                commentDetailModal.querySelector('#modal-track').textContent = commentTrack;
                commentDetailModal.querySelector('#modal-date').textContent = commentDate;
                commentDetailModal.querySelector('#modal-body-content').textContent = commentBody;
                commentDetailModal.querySelector('#modal-delete-form').action = deleteUrl;
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        .btn { border-radius: 0.5rem; font-weight: 500; padding: 0.625rem 1.25rem; }
        .btn-sm { padding: 0.375rem 0.75rem; }
        .card { border-radius: 1rem; }
        .table > :not(caption) > * > * { border-bottom-width: 0; }
        .table tbody tr { border-bottom: 1px solid #f0f0f0; }
        .table tbody tr:hover { background-color: #f8f9fa; }
        .alert { border-radius: 0.75rem; }
        .badge { font-size: 0.75rem; font-weight: 500; }
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate { padding: 1rem; }
        .dataTables_wrapper .dataTables_paginate .paginate_button { border-radius: 0.5rem; margin: 0 0.125rem; }
    </style>
@endpush
