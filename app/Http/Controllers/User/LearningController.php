<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Track;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class LearningController extends Controller
{
    /**
     * Menampilkan halaman jelajah yang berisi daftar semua Learning Path (Tracks).
     */
    public function index(): View
    {
        $allTracks = Track::withCount('materials')->latest()->get();
        $enrolledTrackIds = Auth::user()->enrolledTracks->pluck('id');

        return view('user.learn.index', compact('allTracks', 'enrolledTrackIds'));
    }

    /**
     * Menampilkan halaman detail sebuah Learning Path.
     */
    public function showTrack(Track $track): View
    {
        $materials = $track->materials()->orderBy('order')->get();
        $completedMaterials = Auth::user()
            ->completedMaterials()
            ->whereIn('material_id', $materials->pluck('id'))
            ->pluck('material_id');

        $totalMaterials = $materials->count();
        $completedCount = $completedMaterials->count();
        $progressPercentage = ($totalMaterials > 0) ? ($completedCount / $totalMaterials) * 100 : 0;

        $isEnrolled = Auth::user()->enrolledTracks()->where('track_id', $track->id)->exists();

        return view('user.learn.track', compact(
            'track',
            'materials',
            'completedMaterials',
            'progressPercentage',
            'isEnrolled'
        ));
    }

    /**
     * Mendaftarkan pengguna ke sebuah track.
     */
    public function enroll(Track $track): RedirectResponse
    {
        $user = Auth::user();
        $user->enrolledTracks()->syncWithoutDetaching($track->id);

        return redirect()->route('learn.track.show', $track)->with('success', 'Anda berhasil mengambil jalur belajar ini!');
    }

    /**
     * Menampilkan konten sebuah materi dan menandainya sebagai selesai.
     */
    public function showMaterial(Track $track, Material $material): View|RedirectResponse
    {
        if (!Auth::user()->enrolledTracks()->where('track_id', $track->id)->exists()) {
            return redirect()->route('learn.track.show', $track)->with('error', 'Anda harus mengambil jalur belajar ini terlebih dahulu.');
        }

        Auth::user()->completedMaterials()->syncWithoutDetaching($material->id);

        // Ambil data komentar untuk materi ini
        // Ambil semua ID komentar yang sudah di-like oleh user saat ini
        $userLikes = Auth::user()->commentLikes()->pluck('comment_id');
        $comments = $material->comments()->with('user', 'replies.user', 'replies.parent.user')->latest()->get();

        // Pastikan 'userLikes' dikirim ke view
        return view('user.learn.material', compact('track', 'material', 'comments', 'userLikes'));
    }
}
