@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')
@section('page-title', 'Manajemen Pengguna')

@section('page-content')
    <div class="card stat-card">
        <div class="card-body">
            <h5 class="card-title mb-4">Daftar Pengguna Terdaftar</h5>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Peran (Role)</th>
                            <th>Tanggal Bergabung</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration + $users->firstItem() - 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ ucfirst($user->role) }}</span>
                                </td>
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                                <td class="text-end">
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus Pengguna">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <p class="mb-0">Tidak ada data pengguna untuk ditampilkan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Link untuk Pagination --}}
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
