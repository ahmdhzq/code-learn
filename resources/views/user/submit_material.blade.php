<h1>Upload Materi Baru</h1>

<form action="{{ route('materials.store') }}" method="POST">
    @csrf

    <div>
        <label for="title">Judul Materi</label>
        <input type="text" id="title" name="title" required>
    </div>

    <div>
        <label for="track_id">Pilih Track</label>
        <select name="track_id" id="track_id" required>
            @foreach($tracks as $track)
                <option value="{{ $track->id }}">{{ $track->name }}</option>
            @endforeach
        </select>
    </div>
    
    <div>
        <label for="type">Tipe Konten</label>
        <select name="type" id="type" required>
            <option value="video">Video</option>
            <option value="article">Artikel</option>
        </select>
    </div>

    <div>
        <label for="content">Konten</label>
        <textarea name="content" id="content" rows="4" required></textarea>
        <small>Jika video, masukkan ID YouTube. Jika artikel, masukkan konten HTML.</small>
    </div>

    <button type="submit">Kirim untuk Approval</button>
</form>