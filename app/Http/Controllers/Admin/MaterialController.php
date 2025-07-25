<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Track;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MaterialController extends Controller
{
    /**
     * Menampilkan halaman "Kelola Materi" yang berisi daftar semua track.
     */
    public function all(): View
    {
        $tracks = Track::withCount(['materials' => function ($query) {
            $query->where('status', 'approved');
        }])->latest()->get();

        return view('admin.materials.all', compact('tracks'));
    }

    /**
     * Menampilkan daftar materi untuk sebuah track.
     */
    public function index(Track $track): View
    {
        $materials = $track->materials()
            ->where('status', 'approved')
            ->with('quiz')
            ->orderBy('order')
            ->get();

        return view('admin.materials.index', compact('track', 'materials'));
    }

    /**
     * Method menampilkan form untuk membuat materi dari halaman global.
     */
    public function createGlobal(): View
    {
        // Ambil semua tracks untuk ditampilkan di dropdown
        $tracks = Track::all();
        return view('admin.materials.create_global', compact('tracks'));
    }

    /**
     * Method menyimpan materi baru dari form global.
     */
    public function storeGlobal(Request $request): RedirectResponse
    {
        $request->validate([
            'track_id' => 'required|exists:tracks,id',
            'title' => 'required|string|max:255',
            'type' => 'required|in:article,video,pdf',
            'content_article' => 'required_if:type,article|nullable|string',
            'content_video' => 'required_if:type,video|nullable|string|max:255',
            'content_pdf' => 'required_if:type,pdf|nullable|file|mimes:pdf|max:10240',
        ]);

        $data = $request->only('track_id', 'title', 'type');

        if ($request->type === 'article') {
            $data['content'] = $request->content_article;
        } elseif ($request->type === 'video') {
            $data['content'] = $this->extractYouTubeId($request->content_video);
        } elseif ($request->hasFile('content_pdf')) {
            $path = $request->file('content_pdf')->store('pdfs', 'public');
            $data['content'] = $path;
        }

        Material::create($data);

        return redirect()->route('admin.materials.all')
            ->with('success', 'Materi baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk membuat materi baru.
     */
    public function create(Track $track): View
    {
        return view('admin.materials.create', compact('track'));
    }

    /**
     * Menyimpan materi baru ke database.
     */
    public function store(Request $request, Track $track): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:article,video,pdf',
            'content_article' => 'required_if:type,article|nullable|string',
            'content_video' => 'required_if:type,video|nullable|string|max:255',
            'content_pdf' => 'required_if:type,pdf|nullable|file|mimes:pdf|max:10240', // max 10MB
        ]);

        $data = $request->only('title', 'type');
        $data['track_id'] = $track->id;

        if ($request->type === 'article') {
            $data['content'] = $request->content_article;
        } elseif ($request->type === 'video') {
            $data['content'] = $this->extractYouTubeId($request->content_video);
        } elseif ($request->hasFile('content_pdf')) {
            $path = $request->file('content_pdf')->store('pdfs', 'public');
            $data['content'] = $path;
        }

        Material::create($data);

        return redirect()->route('admin.tracks.materials.index', $track)
            ->with('success', 'Materi baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit materi.
     */
    public function edit(Track $track, Material $material): View
    {
        return view('admin.materials.edit', compact('track', 'material'));
    }

    /**
     * Mengupdate data materi di database.
     */
    public function update(Request $request, Track $track, Material $material): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:article,video,pdf',
            'content_article' => 'required_if:type,article|nullable|string',
            'content_video' => 'required_if:type,video|nullable|string|max:255',
            'content_pdf' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $data = $request->only('title', 'type');

        if ($request->type === 'article') {
            $data['content'] = $request->content_article;
        } elseif ($request->type === 'video') {
            $data['content'] = $this->extractYouTubeId($request->content_video);
        } elseif ($request->hasFile('content_pdf')) {
            if ($material->type === 'pdf' && Storage::disk('public')->exists($material->content)) {
                Storage::disk('public')->delete($material->content);
            }
            $path = $request->file('content_pdf')->store('pdfs', 'public');
            $data['content'] = $path;
        }

        $material->update($data);

        return redirect()->route('admin.tracks.materials.index', $track)
            ->with('success', 'Materi berhasil diperbarui.');
    }

    /**
     * Menghapus materi dari database.
     */
    public function destroy(Track $track, Material $material): RedirectResponse
    {
        if ($material->type === 'pdf' && Storage::disk('public')->exists($material->content)) {
            Storage::disk('public')->delete($material->content);
        }

        $material->delete();

        return redirect()->route('admin.tracks.materials.index', $track)
            ->with('success', 'Materi berhasil dihapus.');
    }

    /**
     * Helper function untuk mengekstrak ID video dari URL YouTube.
     */
    private function extractYouTubeId(string $url): ?string
    {
        preg_match('/(v=|vi=|youtu.be\/|embed\/|\/v\/|\?v=|\&v=)(.+?)\b/i', $url, $matches);
        return $matches[2] ?? $url;
    }
}
