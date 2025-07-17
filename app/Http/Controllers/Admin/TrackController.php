<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Track; // Impor model Track
use Illuminate\Http\Request;

class TrackController extends Controller
{
    /**
     * Menampilkan daftar semua track.
     */
    public function index()
    {
        // Ambil semua data tracks dari database
        $tracks = Track::latest()->get();
        // Kirim data ke view
        return view('admin.tracks.index', compact('tracks'));
    }

    /**
     * Menampilkan form untuk membuat track baru.
     */
    public function create()
    {
        // Tampilkan view dengan form untuk membuat track baru
        return view('admin.tracks.create');
    }

    /**
     * Menyimpan track baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255|unique:tracks',
            'description' => 'nullable|string|max:1000',
        ]);

        // Buat track baru di database
        Track::create($request->all());

        // Redirect kembali ke halaman daftar track dengan pesan sukses
        return redirect()->route('admin.tracks.index')->with('success', 'Track berhasil ditambahkan.');
    }


    /**
     * Menampilkan form untuk mengedit track.
     */
    public function edit(Track $track)
    {
        // Tampilkan form edit dengan data track yang dipilih
        return view('admin.tracks.edit', compact('track'));
    }

    /**
     * Memperbarui data track di database.
     */
    public function update(Request $request, Track $track)
    {
        // Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255|unique:tracks,name,' . $track->id,
            'description'=> 'required|string|max:1000,'. $track->description,
        ]);

        // Update data track
        $track->update($request->all());

        // Redirect kembali ke halaman daftar track dengan pesan sukses
        return redirect()->route('admin.tracks.index')->with('success', 'Track berhasil diperbarui.');
    }

    /**
     * Menghapus data track dari database.
     */
    public function destroy(Track $track)
    {
        // Hapus data track
        $track->delete();

        // Redirect kembali ke halaman daftar track dengan pesan sukses
        return redirect()->route('admin.tracks.index')->with('success', 'Track berhasil dihapus.');
    }
}
