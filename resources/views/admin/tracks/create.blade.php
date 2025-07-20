@extends('layouts.admin')

@section('title', 'Tambah Path Baru')
@section('page-title', 'Tambah Learning path')

@section('page-content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <!-- Header Section -->
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                        <i class="fas fa-plus text-primary fs-5"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-bold text-dark">Tambah Path Baru</h4>
                        <p class="text-muted mb-0 small">Buat learning path untuk mengorganisir pembelajaran</p>
                    </div>
                </div>

                <!-- Form Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <form action="{{ route('admin.tracks.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf

                            <!-- Nama Track -->
                            <div class="mb-4">
                                <label for="name" class="form-label fw-semibold text-dark mb-2">
                                    <i class="fas fa-tag text-primary me-2"></i>Nama learning path
                                </label>
                                <input type="text"
                                    class="form-control form-control-lg @error('name') is-invalid @enderror" id="name"
                                    name="name" value="{{ old('name') }}"
                                    placeholder="Masukkan nama path pembelajaran..." required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="mb-4">
                                <label for="description" class="form-label fw-semibold text-dark mb-2">
                                    <i class="fas fa-align-left text-primary me-2"></i>Deskripsi
                                </label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                    rows="4" placeholder="Jelaskan tujuan dan materi yang akan dipelajari dalam path ini...">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex gap-2 justify-content-end pt-3 border-top">
                                <a href="{{ route('admin.tracks.index') }}" class="btn btn-light px-4">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-save me-2"></i>Simpan Path
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
        }

        .form-control-lg {
            padding: 0.75rem 1rem;
            font-size: 1rem;
        }

        .btn {
            border-radius: 0.5rem;
            font-weight: 500;
            padding: 0.625rem 1.25rem;
        }

        .card {
            border-radius: 1rem;
        }

        .form-label {
            font-size: 0.9rem;
        }
    </style>
@endpush
