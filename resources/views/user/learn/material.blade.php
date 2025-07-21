@extends('layouts.user')

@section('title', $material->title)

@section('content')
    <div class="bg-white py-4 shadow-sm">
        <div class="container">
            {{-- Breadcrumb Navigasi --}}
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('learn.track.show', $track) }}"
                            class="text-decoration-none">{{ $track->name }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $material->title }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container py-5">
        <h1 class="fw-bold display-6 mb-4">{{ $material->title }}</h1>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">

                {{-- Menampilkan Konten Dinamis --}}
                @if ($material->type === 'video')
                    {{-- Tipe Video: Embed dari YouTube/Vimeo --}}
                    <div style="max-width: 800px; margin: auto;">
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/{{ $material->content }}"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                @elseif($material->type === 'article')
                    {{-- Tipe Artikel: Render konten HTML dari database --}}
                    <div class="article-content">
                        {!! $material->content !!}
                    </div>
                @elseif($material->type === 'pdf')
                    {{-- Tipe PDF: Embed penampil PDF --}}
                    <div class="ratio ratio-4x3">
                        <iframe src="{{ Storage::url($material->content) }}" allowfullscreen></iframe>
                    </div>
                @endif

            </div>
        </div>

        {{-- Tombol Navigasi Materi --}}
        <div class="d-flex justify-content-between mt-5">
            <a href="{{ route('learn.track.show', $track) }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Materi
            </a>
            <a href="#" class="btn btn-primary fw-semibold">
                Materi Selanjutnya <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Tambahan style untuk artikel agar lebih rapi */
        .article-content h1,
        .article-content h2,
        .article-content h3 {
            margin-top: 1.5rem;
            margin-bottom: 1rem;
        }

        .article-content p {
            line-height: 1.8;
            margin-bottom: 1.2rem;
        }

        .article-content pre {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 0.5rem;
        }
    </style>
@endpush
