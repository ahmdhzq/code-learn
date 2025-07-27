@extends('layouts.user') 

@section('title', 'Ajukan Materi Baru')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4 class="mb-0">Formulir Pengajuan Materi</h4>
                </div>
                <div class="card-body">
                    {{-- PENTING: Tambahkan enctype untuk upload file --}}
                    <form action="{{ route('materials.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Materi</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required value="{{ old('title') }}">
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="track_id" class="form-label">Pilih Track</label>
                            <select name="track_id" id="track_id" class="form-select @error('track_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Track --</option>
                                @foreach($tracks as $track)
                                    <option value="{{ $track->id }}" @if(old('track_id') == $track->id) selected @endif>{{ $track->name }}</option>
                                @endforeach
                            </select>
                            @error('track_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="type" class="form-label">Tipe Konten</label>
                            <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                                <option value="article" @if(old('type') == 'article') selected @endif>Artikel</option>
                                <option value="video" @if(old('type') == 'video') selected @endif>Video (YouTube)</option>
                                <option value="pdf" @if(old('type') == 'pdf') selected @endif>PDF</option>
                            </select>
                            @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Input dinamis berdasarkan Tipe Konten --}}
                        <div id="content-article" class="content-field mb-3">
                            <label for="content_article" class="form-label">Konten Artikel</label>
                            <textarea name="content_article" id="content_article" class="form-control @error('content_article') is-invalid @enderror">{{ old('content_article') }}</textarea>
                            @error('content_article') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div id="content-video" class="content-field mb-3" style="display: none;">
                            <label for="content_video" class="form-label">URL Video YouTube</label>
                            <input type="text" name="content_video" id="content_video" class="form-control @error('content_video') is-invalid @enderror" placeholder="Contoh: https://www.youtube.com/watch?v=XXXXXXX" value="{{ old('content_video') }}">
                            @error('content_video') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div id="content-pdf" class="content-field mb-3" style="display: none;">
                            <label for="content_pdf" class="form-label">Upload File PDF</label>
                            <input type="file" name="content_pdf" id="content_pdf" class="form-control @error('content_pdf') is-invalid @enderror" accept=".pdf">
                            @error('content_pdf') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <div class="form-text">Ukuran maksimal: 10MB. Format yang diizinkan: PDF</div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Kirim untuk Approval</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('user.partials.footer')
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('type');
        const contentFields = {
            article: document.getElementById('content-article'),
            video: document.getElementById('content-video'),
            pdf: document.getElementById('content-pdf')
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
                    // Konfigurasi upload untuk browse image
                    filebrowserImageUploadUrl: "{{ route('user.ckeditor.upload') }}",
                    // Allow all content
                    allowedContent: true,
                    // Auto grow
                    autoGrow_onStartup: true,
                    autoGrow_maxHeight: 600,
                    // Upload URL untuk drag & drop dan paste
                    uploadUrl: "{{ route('user.ckeditor.upload') }}",
                    // Extra plugins untuk clipboard dan upload
                    extraPlugins: 'uploadimage,clipboard',
                    // Image upload configuration
                    imageUploadUrl: "{{ route('user.ckeditor.upload') }}"
                });

                // Add CSRF token to all AJAX requests
                ckEditorInstance.on('fileUploadRequest', function(evt) {
                    var fileLoader = evt.data.fileLoader,
                        formData = new FormData(),
                        xhr = fileLoader.xhr;

                    xhr.setRequestHeader('X-CSRF-TOKEN', "{{ csrf_token() }}");
                    
                    formData.append('upload', fileLoader.file);
                    formData.append('_token', "{{ csrf_token() }}");
                    
                    fileLoader.xhr.send(formData);
                });

                // Handle upload response
                ckEditorInstance.on('fileUploadResponse', function(evt) {
                    var data = evt.data,
                        xhr = data.fileLoader.xhr,
                        response = xhr.responseText.split('|');

                    if (response.length == 2) {
                        data.url = response[1];
                        evt.stop();
                    }
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
            // Hide semua field
            for (const key in contentFields) {
                if (contentFields[key]) {
                    contentFields[key].style.display = 'none';
                }
            }

            const selectedType = typeSelect.value;
            
            // Show field yang dipilih
            if (contentFields[selectedType]) {
                contentFields[selectedType].style.display = 'block';
                
                // Inisialisasi CKEditor untuk artikel
                if (selectedType === 'article') {
                    setTimeout(initCKEditor, 100);
                } else {
                    destroyCKEditor();
                }
            }
        }

        // Inisialisasi pertama kali
        toggleContentFields();

        // Event listener untuk perubahan tipe
        typeSelect.addEventListener('change', toggleContentFields);

        // Update CKEditor sebelum submit form
        document.querySelector('form').addEventListener('submit', function(e) {
            if (ckEditorInstance) {
                ckEditorInstance.updateElement();
            }
        });
    });
</script>
@endpush