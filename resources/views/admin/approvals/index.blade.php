@extends('layouts.admin')

@section('title', 'Manajemen Approval')
@section('page-title', 'Manajemen Approval')

@section('page-content')
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Judul</th>
                            <th scope="col">learning Path</th>
                            <th scope="col">Pengirim</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pendingMaterials as $material)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $material->title }}</td>
                                <td>{{ $material->track->name }}</td>
                                <td>{{ $material->user?->name ?? 'Dikirim oleh Admin' }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        {{-- Tombol Setujui --}}
                                        <form action="{{ route('admin.approvals.approve', $material) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                                        </form>

                                        {{-- Tombol Tolak --}}
                                        <form action="{{ route('admin.approvals.reject', $material) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    <div class="alert alert-info my-2">
                                        Tidak ada materi yang menunggu persetujuan saat ini.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection