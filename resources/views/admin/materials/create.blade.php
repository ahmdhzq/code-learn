@extends('layouts.admin')

@section('title', 'Tambah Materi Baru')
@section('page-title', 'Tambah Materi untuk Track: ' . $track->name)

@section('page-content')
<div class="card stat-card">
    <div class="card-body">
        <form action="{{ route('admin.tracks.materials.store', $track) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="title" class="form-label">Judul Materi</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="type" class="form-label">Tipe Materi</label>
                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                        <option value="article" @if(old('type') == 'article') selected @endif>Artikel</option>
                        <option value="video" @if(old('type') == 'video') selected @endif>Video (YouTube)</option>
                        <option value="pdf" @if(old('type') == 'pdf') selected @endif>PDF</option>
                    </select>
                    @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <!-- Input Dinamis Berdasarkan Tipe -->
            <div id="content-fields">
                <!-- Field untuk Artikel -->
                <div id="field-article" class="mb-3 content-field">
                    <label for="content_article" class="form-label">Isi Artikel</label>
                    <textarea name="content_article" id="content_article" class="form-control @error('content_article') is-invalid @enderror" rows="10">{{ old('content_article') }}</textarea>
                    @error('content_article') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <!-- Field untuk Video -->
                <div id="field-video" class="mb-3 content-field">
                    <label for="content_video" class="form-label">URL Video YouTube</label>
                    <input type="text" name="content_video" id="content_video" class="form-control @error('content_video') is-invalid @enderror" value="{{ old('content_video') }}" placeholder="Contoh: https://www.youtube.com/watch?v=xxxxxx">
                    @error('content_video') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <!-- Field untuk PDF -->
                <div id="field-pdf" class="mb-3 content-field">
                    <label for="content_pdf" class="form-label">Upload File PDF</label>
                    <input type="file" name="content_pdf" id="content_pdf" class="form-control @error('content_pdf') is-invalid @enderror" accept=".pdf">
                    @error('content_pdf') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            
            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('admin.tracks.materials.index', $track) }}" class="btn btn-light me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Materi</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('type');
        const contentFields = {
            article: document.getElementById('field-article'),
            video: document.getElementById('field-video'),
            pdf: document.getElementById('field-pdf'),
        };

        function toggleContentFields() {
            for (const key in contentFields) {
                if (contentFields[key]) {
                    contentFields[key].style.display = 'none';
                }
            }
            const selectedType = typeSelect.value;
            if (contentFields[selectedType]) {
                contentFields[selectedType].style.display = 'block';
            }
        }

        toggleContentFields();
        typeSelect.addEventListener('change', toggleContentFields);
    });
</script>
@endpush
