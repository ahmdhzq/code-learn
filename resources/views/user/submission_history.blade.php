@extends('layouts.user')

@section('title', 'Riwayat Pengajuan Materi')

@section('content')
    {{-- Bagian Header Halaman --}}
    <div class="bg-white py-4 shadow-sm">
        <div class="container">
            <h2 class="fw-bold mb-0">Riwayat Pengajuan Materi</h2>
            <p class="text-muted mb-0">Pantau status semua materi yang pernah Anda ajukan.</p>
        </div>
    </div>

    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Judul Materi</th>
                                <th scope="col">Track</th>
                                <th scope="col">Tanggal Diajukan</th>
                                <th scope="col" class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($submissions as $submission)
                                <tr>
                                    <td class="fw-semibold">{{ $submission->title }}</td>
                                    <td>{{ $submission->track->name }}</td>
                                    <td>{{ $submission->created_at->format('d M Y') }}</td>
                                    <td class="text-center">
                                        @if ($submission->status == 'approved')
                                            <span class="badge bg-success rounded-pill px-3 py-2">Disetujui</span>
                                        @elseif ($submission->status == 'rejected')
                                            <span class="badge bg-danger rounded-pill px-3 py-2">Ditolak</span>
                                        @else
                                            <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        <p class="mb-0 text-muted">Anda belum pernah mengajukan materi apapun.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- Link untuk pagination --}}
                <div class="mt-3">
                    {{ $submissions->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection