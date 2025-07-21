@extends('layouts.user')

@section('title', 'Selamat Datang di CodeLearn')

@section('content')
    <div class="bg-white">
        <div class="container text-center py-5">
            <h1 class="display-4 fw-bold">Tingkatkan Skill Koding Anda.</h1>
            <p class="text-primary fw-bold fs-1" style="color: #317a75 !important;">Mulai Belajar Hari Ini.</p>
            <p class="col-lg-8 mx-auto fs-5 text-muted">
                Jelajahi berbagai jalur belajar terstruktur yang dirancang untuk membawa Anda dari pemula menjadi seorang
                profesional.
            </p>
        </div>
    </div>

    <div class="py-5" style="background-color: #f0f2f5;">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Jelajahi Jalur Belajar Populer</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @forelse ($tracks as $track)
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0 rounded-3">
                            <div class="card-body d-flex flex-column p-4">
                                <h5 class="card-title fw-bold fs-4 mb-2">{{ $track->name }}</h5>
                                <p class="card-text text-muted small flex-grow-1">{{ $track->description }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <span class="badge bg-light text-dark rounded-pill px-3 py-2">
                                        <i class="fas fa-book-open me-2"></i>{{ $track->materials_count }} Materi
                                    </span>

                                    {{-- [LOGIKA UTAMA] Tombol Cerdas --}}
                                    @auth
                                        {{-- Jika sudah login, arahkan ke detail track --}}
                                        <a href="{{ route('learn.track.show', $track) }}" class="btn btn-primary fw-semibold">
                                            Mulai Belajar
                                        </a>
                                    @else
                                        {{-- Jika belum login (tamu), arahkan ke halaman login --}}
                                        <a href="{{ route('login') }}" class="btn btn-primary fw-semibold">
                                            Mulai Belajar
                                        </a>
                                    @endauth

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
    </div>
@endsection
