@extends('layouts.admin')

@section('title', 'Edit Learning Path')
@section('page-title', 'Edit Learning Path')

@section('page-content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
            <!-- Header Section -->
            <div class="d-flex align-items-center mb-4">
                <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3">
                    <i class="fas fa-edit text-warning fs-5"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold text-dark">Form edit path</h4>
                    <p class="text-muted mb-0 small">Perbarui informasi learning path pembelajaran</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <!-- Track Info Header -->
                    <div class="bg-light rounded-3 p-3 mb-4">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0 fw-bold">{{ $track->name }}</h6>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('admin.tracks.update', $track) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        
                        <!-- Nama Track -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold text-dark mb-2">
                                <i class="fas fa-tag text-primary me-2"></i>Nama Learning Path
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $track->name) }}" 
                                   placeholder="Masukkan nama learning path pembelajaran..."
                                   required>
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
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="4" 
                                      placeholder="Jelaskan tujuan dan materi yang akan dipelajari dalam path ini...">{{ old('description', $track->description) }}</textarea>
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
                            <button type="submit" class="btn btn-warning px-4">
                                <i class="fas fa-save me-2"></i>Update Path
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