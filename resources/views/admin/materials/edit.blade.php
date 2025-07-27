@extends('layouts.admin')

@section('title', 'Edit Materi')
@section('page-title', 'Manajemen Materi')

@section('page-content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
        <div class="d-flex align-items-center mb-3 mb-md-0">
            <div>
                <h4 class="mb-0 fw-bold text-dark">Edit materi <span class="text-primary">{{ $material->title }}</span></h4>
                <p class="text-muted mb-0 small">Kelola semua materi pembelajaran</p>
            </div>
        </div>
    </div>
<div class="card stat-card">
    <div class="card-body">
        <form action="{{ route('admin.tracks.materials.update', [$track, $material]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="title" class="form-label">Judul Materi</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $material->title) }}" required>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="type" class="form-label">Tipe Materi</label>
                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                        <option value="article" @if(old('type', $material->type) == 'article') selected @endif>Artikel</option>
                        <option value="video" @if(old('type', $material->type) == 'video') selected @endif>Video (YouTube)</option>
                        <option value="pdf" @if(old('type', $material->type) == 'pdf') selected @endif>PDF</option>
                    </select>
                    @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <!-- Input Dinamis Berdasarkan Tipe -->
            <div id="content-fields">
                <!-- Field untuk Artikel dengan CKEditor -->
                <div id="field-article" class="mb-3 content-field">
                    <label for="content_article" class="form-label">Isi Artikel</label>
                    <textarea name="content_article" id="content_article" class="form-control @error('content_article') is-invalid @enderror">{{ old('content_article', $material->type == 'article' ? $material->content : '') }}</textarea>
                    @error('content_article') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <!-- Field untuk Video -->
                <div id="field-video" class="mb-3 content-field">
                    <label for="content_video" class="form-label">URL Video YouTube</label>
                    <input type="text" name="content_video" id="content_video" class="form-control @error('content_video') is-invalid @enderror" value="{{ old('content_video', $material->type == 'video' ? 'https://www.youtube.com/watch?v=' . $material->content : '') }}" placeholder="Contoh: https://www.youtube.com/watch?v=xxxxxx">
                    @error('content_video') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <!-- Field untuk PDF -->
                <div id="field-pdf" class="mb-3 content-field">
                    <label for="content_pdf" class="form-label">Upload File PDF Baru (Opsional)</label>
                    <input type="file" name="content_pdf" id="content_pdf" class="form-control @error('content_pdf') is-invalid @enderror" accept=".pdf">
                    @if($material->type == 'pdf')
                        <small class="form-text text-muted">File saat ini: <a href="{{ asset('storage/' . $material->content) }}" target="_blank">Lihat PDF</a>. Kosongkan jika tidak ingin mengubah.</small>
                    @endif
                    @error('content_pdf') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            
            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('admin.tracks.materials.index', $track) }}" class="btn btn-light me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Update Materi</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('type');
        const contentFields = {
            article: document.getElementById('field-article'),
            video: document.getElementById('field-video'),
            pdf: document.getElementById('field-pdf'),
        };

        let ckEditorInstance = null;

        function initCKEditor() {
            if (!ckEditorInstance) {
                ckEditorInstance = CKEDITOR.replace('content_article', {
                    height: 300,
                    toolbar: [
                        { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
                        { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },
                        { name: 'links', items: ['Link', 'Unlink'] },
                        { name: 'insert', items: ['Image', 'Table', 'HorizontalRule'] },
                        { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
                        { name: 'colors', items: ['TextColor', 'BGColor'] },
                        { name: 'tools', items: ['Maximize', 'Source'] }
                    ],
                    removeButtons: 'Save,NewPage,Preview,Print',
                    filebrowserUploadMethod: 'form'
                });
            }
        }

        function destroyCKEditor() {
            if (ckEditorInstance) {
                ckEditorInstance.destroy();
                ckEditorInstance = null;
            }
        }

        function toggleContentFields() {
            for (const key in contentFields) {
                if (contentFields[key]) {
                    contentFields[key].style.display = 'none';
                }
            }

            const selectedType = typeSelect.value;
            
            if (contentFields[selectedType]) {
                contentFields[selectedType].style.display = 'block';
                
                // Jika artikel dipilih, inisialisasi CKEditor
                if (selectedType === 'article') {
                    setTimeout(initCKEditor, 100);
                } else {
                    destroyCKEditor();
                }
            }
        }

        toggleContentFields();
        
        typeSelect.addEventListener('change', toggleContentFields);

        document.querySelector('form').addEventListener('submit', function(e) {
            if (ckEditorInstance) {
                ckEditorInstance.updateElement();
            }
        });
    });
</script>
@endpush