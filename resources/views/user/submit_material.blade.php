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
                            <input type="text" class="form-control" id="title" name="title" required value="{{ old('title') }}">
                        </div>

                        <div class="mb-3">
                            <label for="track_id" class="form-label">Pilih Track</label>
                            <select name="track_id" id="track_id" class="form-select" required>
                                @foreach($tracks as $track)
                                    <option value="{{ $track->id }}">{{ $track->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="type" class="form-label">Tipe Konten</label>
                            <select name="type" id="type" class="form-select" required>
                                <option value="article" @if(old('type') == 'article') selected @endif>Artikel</option>
                                <option value="video" @if(old('type') == 'video') selected @endif>Video</option>
                                <option value="pdf" @if(old('type') == 'pdf') selected @endif>PDF</option>
                            </select>
                        </div>

                        {{-- Input dinamis berdasarkan Tipe Konten --}}
                        <div id="content-article" class="content-field mb-3">
                            <label for="content_article" class="form-label">Konten Artikel</label>
                            <textarea name="content_article" class="form-control" rows="8">{{ old('content_article') }}</textarea>
                        </div>

                        <div id="content-video" class="content-field mb-3" style="display: none;">
                            <label for="content_video" class="form-label">URL Video YouTube</label>
                            <input type="text" name="content_video" class="form-control" placeholder="Contoh: https://www.youtube.com/watch?v=XXXXXXX" value="{{ old('content_video') }}">
                        </div>

                        <div id="content-pdf" class="content-field mb-3" style="display: none;">
                            <label for="content_pdf" class="form-label">Upload File PDF</label>
                            <input type="file" name="content_pdf" class="form-control" accept=".pdf">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('type');
        const contentFields = {
            article: document.getElementById('content-article'),
            video: document.getElementById('content-video'),
            pdf: document.getElementById('content-pdf')
        };

        function toggleContentFields() {
            for (const key in contentFields) {
                contentFields[key].style.display = 'none';
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
@endsection