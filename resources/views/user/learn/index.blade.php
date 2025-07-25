@extends('layouts.user')

@section('title', 'Practice - Semua Jalur Belajar')

@section('content')
    <div class="bg-white py-4 shadow-sm">
        <div class="container">
            <h2 class="fw-bold mb-0">Semua Jalur Belajar</h2>
            <p class="text-muted mb-0">Pilih dan mulai petualangan belajar Anda.</p>
        </div>
    </div>

    <div class="container py-5">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @forelse ($allTracks as $track)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 rounded-3">
                        <div class="card-body d-flex flex-column p-4">
                            <h5 class="card-title fw-bold fs-4 mb-2">{{ $track->name }}</h5>
                            <p class="card-text text-muted small">{{ $track->description }}</p>

                            {{-- [BARU] Daftar Preview Materi --}}
                            <div class="mt-3 mb-4 flex-grow-1">
                                <h6 class="small text-uppercase fw-bold text-muted">Beberapa Materi</h6>
                                <ul class="list-group list-group-flush small">
                                    @forelse($track->materials as $material)
                                        <li class="list-group-item px-0 py-1 border-0 bg-transparent">
                                            <i class="fas fa-check-circle text-primary me-2"></i>{{ $material->title }}
                                        </li>
                                    @empty
                                        <li class="list-group-item px-0 py-1 border-0 bg-transparent text-muted">
                                            Belum ada materi.
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-light text-dark rounded-pill px-3 py-2">
                                    <i class="fas fa-book-open me-2"></i>{{ $track->materials_count }} Materi
                                </span>
                                <a href="{{ route('learn.track.show', $track) }}" class="btn btn-primary fw-semibold">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Belum ada jalur belajar yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection