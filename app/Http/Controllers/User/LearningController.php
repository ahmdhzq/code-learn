<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Track;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Material;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class LearningController extends Controller
{
    /**
     * Menampilkan halaman utama pembelajaran yang berisi daftar semua Learning Path (Tracks).
     */
    public function index(): View
    {
        $allTracks = Track::withCount('materials')->latest()->get();
        $enrolledTrackIds = Auth::user()->enrolledTracks->pluck('id');

        return view('user.learn.index', compact('allTracks', 'enrolledTrackIds'));
    }

    /**
     * [NEW] Menampilkan halaman detail sebuah Learning Path, berisi daftar materi di dalamnya.
     */
    public function showTrack(Track $track): View
    {
        // Ambil semua materi untuk track ini
        $materials = $track->materials()->orderBy('order')->get();

        // Ambil ID materi yang sudah diselesaikan oleh pengguna yang sedang login
        $completedMaterials = Auth::user()
            ->completedMaterials()
            ->whereIn('material_id', $materials->pluck('id'))
            ->pluck('material_id');

        // Hitung persentase progres
        $totalMaterials = $materials->count();
        $completedCount = $completedMaterials->count();
        $progressPercentage = ($totalMaterials > 0) ? ($completedCount / $totalMaterials) * 100 : 0;

        $isEnrolled = Auth::user()->enrolledTracks()->where('track_id', $track->id)->exists();

        return view('user.learn.track', compact(
            'track',
            'materials',
            'completedMaterials',
            'progressPercentage',
            'isEnrolled' // <-- Kirim variabel baru ini ke view
        ));
    }

    /**
     * Mendaftarkan pengguna ke sebuah track.
     */
    public function enroll(Track $track): RedirectResponse
    {
        $user = Auth::user();
        // 'syncWithoutDetaching' akan mencegah error duplikat
        $user->enrolledTracks()->syncWithoutDetaching($track->id);

        // Arahkan langsung ke halaman detail track setelah berhasil
        return redirect()->route('learn.track.show', $track)->with('success', 'Anda berhasil mengambil jalur belajar ini!');
    }

    /**
     * [BARU] Menampilkan konten sebuah materi dan menandainya sebagai selesai.
     */
    public function showMaterial(Track $track, Material $material): View
    {
        // Pastikan pengguna sudah terdaftar di track ini sebelum akses materi
        if (!Auth::user()->enrolledTracks()->where('track_id', $track->id)->exists()) {
            // Jika belum, kembalikan ke halaman detail track dengan pesan error
            return redirect()->route('learn.track.show', $track)->with('error', 'Anda harus mengambil jalur belajar ini terlebih dahulu.');
        }

        // Tandai materi ini sebagai selesai untuk pengguna yang sedang login
        Auth::user()->completedMaterials()->syncWithoutDetaching($material->id);

        return view('user.learn.material', compact('track', 'material'));
    }
}
