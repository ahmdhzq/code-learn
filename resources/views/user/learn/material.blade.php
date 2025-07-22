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
                    <div class="article-content">
                        {!! $material->content !!}
                    </div>
                @elseif($material->type === 'pdf')
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

            {{-- Tombol Kerjakan Kuis (hanya muncul jika ada kuis) --}}
            {{-- @if ($material->quiz)
                <a href="{{ route('quiz.start', $material) }}" class="btn btn-success fw-semibold">
                    <i class="fas fa-tasks me-2"></i> Kerjakan Kuis
                </a>
            @endif --}}
        </div>

        {{-- ====================================================== --}}
        {{-- SISTEM KOMENTAR DAN DISKUSI --}}
        {{-- ====================================================== --}}
        <hr class="my-5">

        <div class="mt-5">
            <h3 class="fw-semibold mb-4">Diskusi Materi</h3>

            {{-- Form untuk Menambah Komentar Baru --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="material_id" value="{{ $material->id }}">
                        <div class="mb-3">
                            <textarea class="form-control" name="body" rows="3"
                                placeholder="Tulis komentar atau pertanyaan Anda di sini..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary fw-semibold">Kirim Komentar</button>
                    </form>
                </div>
            </div>

            {{-- Daftar Komentar --}}
            @forelse ($comments as $comment)
                @include('user.partials.comment', ['comment' => $comment, 'material' => $material])
            @empty
                <div class="text-center p-4 bg-light rounded-3">
                    <p class="text-muted mb-0">Jadilah yang pertama berkomentar di materi ini.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@push('styles')
    <style>
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
@push('scripts')
    <script>
        document.querySelectorAll('.like-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                const button = this.querySelector('.like-btn');
                const countSpan = this.querySelector('.likes-count');

                fetch(this.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        countSpan.textContent = data.likes_count;
                        button.classList.toggle('text-primary');
                        button.classList.toggle('text-muted');
                    });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const collapseElements = document.querySelectorAll('.replies-container .collapse');

            collapseElements.forEach(el => {
                const triggerButton = document.querySelector(`[href="#${el.id}"]`);
                if (!triggerButton) return;

                const icon = triggerButton.querySelector('.toggle-icon');
                const text = triggerButton.querySelector('.toggle-text');
                const showText = triggerButton.dataset.showText;
                const hideText = triggerButton.dataset.hideText;

                // Saat balasan akan ditampilkan
                el.addEventListener('show.bs.collapse', function() {
                    text.textContent = hideText;
                    icon.classList.remove('fa-plus');
                    icon.classList.add('fa-minus');
                });

                // Saat balasan akan disembunyikan
                el.addEventListener('hide.bs.collapse', function() {
                    text.textContent = showText;
                    icon.classList.remove('fa-minus');
                    icon.classList.add('fa-plus');
                });
            });
        });
    </script>
@endpush
