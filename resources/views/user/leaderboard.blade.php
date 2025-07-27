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
    <div class="card border-0 shadow-sm animate__animated animate__fadeInUp">
        <div class="card-body">
            <div class="list-group list-group-flush">
                @forelse ($users as $user)
                    @php
                        $points = $user->points ?? 0;
                        $badge = '🥉 Bronze';
                        $badgeColor = 'text-warning'; // default bronze
                        
                        if ($points >= 400) {
                            $badge = '🥇 Gold';
                            $badgeColor = 'text-warning-emphasis'; // emas
                        } elseif ($points >= 200) {
                            $badge = '🥈 Silver';
                            $badgeColor = 'text-secondary'; // perak
                        }

                        $isCurrentUser = auth()->id() == $user->id ? 'bg-primary-subtle' : '';
                    @endphp

                    <div class="list-group-item d-flex align-items-center p-3 {{ $isCurrentUser }} hover-shadow-sm" style="transition: background 0.2s;">
                        <!-- Rank -->
                        <div class="col-1 fw-bold fs-5 text-center text-muted">
                            {{ $loop->iteration }}
                        </div>

                        <!-- Avatar and Info -->
                        <div class="col-8 d-flex align-items-center">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random" alt="Avatar" class="rounded-circle me-3" width="50">
                            <div>
                                <h5 class="fw-semibold mb-0">{{ $user->name }}</h5>
                                <small class="{{ $badgeColor }}">{{ $badge }}</small>
                            </div>
                        </div>

                        <!-- Points -->
                        <div class="col-3 text-end fw-bold fs-5 text-primary">
                            {{ number_format($points) }} Poin
                        </div>
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
