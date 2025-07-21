@extends('layouts.user')

@section('title', 'Papan Peringkat')

@section('content')
<div class="bg-white py-4 shadow-sm">
    <div class="container">
        <h2 class="fw-bold mb-0">Papan Peringkat</h2>
        <p class="text-muted mb-0">Lihat posisimu di antara para pembelajar lainnya!</p>
    </div>
</div>

<div class="container py-5">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="list-group list-group-flush">
                @forelse ($users as $user)
                    {{-- Beri sorotan jika itu adalah pengguna yang sedang login --}}
                    <div class="list-group-item d-flex align-items-center p-3 {{ auth()->id() == $user->id ? 'bg-primary-subtle' : '' }}">
                        <div class="col-1 fw-bold fs-4 text-center">{{ $loop->iteration }}</div>
                        <div class="col-8 d-flex align-items-center">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random" alt="Avatar" class="rounded-circle me-3" width="50">
                            <div>
                                <h5 class="fw-semibold mb-0">{{ $user->name }}</h5>
                                <small class="text-muted">Peringkat: {{ $user->rank ?? 'Bronze' }}</small> [cite: 22]
                            </div>
                        </div>
                        <div class="col-3 text-end fw-bold fs-5">{{ $user->points ?? 0 }} Poin</div> [cite: 21]
                    </div>
                @empty
                    <div class="text-center p-5">
                        <p class="text-muted">Papan peringkat masih kosong.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection