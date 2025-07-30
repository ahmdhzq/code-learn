@extends('layouts.user')

@section('title', 'Konfirmasi Kuis - ' . $quiz->title)

@section('content')
<div class="quiz-confirmation-page">
    <div class="container py-5">
        <div class="quiz-container">
            <div class="mb-4">
                <a href="{{ route('learn.track.show', $quiz->material->track) }}" class="btn-back">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <div class="quiz-header text-center mb-5">
                <h1>Kuis: {{ $quiz->title }}</h1>
                <p class="lead">Learning Path: {{ $quiz->material->track->name }}</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="info-box">
                        <h5 class="box-title">Tentang Kuis Ini</h5>
                        <p class="box-text">
                            Kuis ini dirancang untuk menguji pemahaman Anda tentang konsep dasar dari materi yang telah dipelajari. Anda akan diuji mengenai sintaks, struktur data, control flow, dan konsep penting lainnya. Pastikan Anda sudah memahami materi sebelumnya.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="info-box">
                        <h5 class="box-title">Aturan dan Ketentuan Quiz:</h5>
                        <ul class="box-list">
                            <li>Setiap pertanyaan bernilai 10 poin.</li>
                            <li>Anda dapat mengubah jawaban sebelum menyelesaikan kuis.</li>
                            <li>Passing score minimum adalah 70%.</li>
                            <li>Kuis hanya dapat dikerjakan 1 kali.</li>
                            <li>Pastikan koneksi internet stabil selama mengerjakan.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <button type="button" class="btn btn-start-quiz" data-bs-toggle="modal" data-bs-target="#confirmStartModal">
                    Mulai Quiz
                </button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="confirmStartModal" tabindex="-1" aria-labelledby="confirmStartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h4 class="modal-title mb-3" id="confirmStartModalLabel">Mulai Kuis?</h4>
                <p class="text-muted">
                    Pastikan Anda sudah siap untuk mengerjakan kuis ini. Apakah Anda yakin ingin memulai sekarang?
                </p>
                <div class="d-flex justify-content-center gap-2 mt-4">
                    <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                    {{-- Form tersembunyi untuk memulai kuis --}}
                    <form action="{{ route('user.quiz.start', $quiz) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-modal-start">Mulai</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .quiz-confirmation-page {
        background-color: #317a75;
        color: #ffffff;
        min-height: 100vh;
    }
    .quiz-container {
        max-width: 900px;
        margin: auto;
    }
    .btn-back {
        color: #ffffff;
        text-decoration: none;
        font-weight: 500;
        opacity: 0.8;
        transition: opacity 0.2s;
    }
    .btn-back:hover {
        color: #ffffff;
        opacity: 1;
    }
    .quiz-header h1 {
        font-weight: 700;
    }
    .quiz-header .lead {
        color: #ffffff;
        opacity: 0.9;
    }
    .info-box {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 2rem;
        height: 100%;
    }
    .box-title {
        font-weight: 600;
        margin-bottom: 1rem;
    }
    .box-text, .box-list {
        opacity: 0.9;
        font-size: 0.95rem;
    }
    .box-list {
        padding-left: 1.2rem;
    }
    .box-list li {
        margin-bottom: 0.5rem;
    }
    .btn-start-quiz {
        background-color: #ffffff;
        color: #317a75;
        font-weight: 700;
        padding: 0.8rem 2.5rem;
        border-radius: 50px;
        border: none;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .btn-start-quiz:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    .modal-content {
        background-color: #ffffff;
        color: #333;
        border-radius: 20px;
        border: none;
        padding: 1.5rem;
    }
    .btn-modal-cancel {
        background-color: #dc3545;
        color: white;
        font-weight: 600;
        padding: 0.6rem 2rem;
        border-radius: 50px;
        border: none;
    }
    .btn-modal-start {
        background-color: #317a75;
        color: white;
        font-weight: 600;
        padding: 0.6rem 2rem;
        border-radius: 50px;
        border: none;
    }
</style>
@endpush