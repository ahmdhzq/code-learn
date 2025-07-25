<?php

namespace App\Http\Controllers;

use App\Models\Track;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialSubmissionController extends Controller
{
    public function create()
    {
        $this->authorize('upload-materi');
        $tracks = Track::all();
        return view('user.submit_material', compact('tracks'));
    }

    /**
     * Menyimpan materi baru yang diajukan oleh user.
     */
    public function store(Request $request)
    {
        $this->authorize('upload-materi');

        $request->validate([
            'track_id' => 'required|exists:tracks,id',
            'title' => 'required|string|max:255',
            'type' => 'required|in:article,video,pdf',
            'content_article' => 'required_if:type,article|nullable|string',
            'content_video' => 'required_if:type,video|nullable|string|max:255',
            'content_pdf' => 'required_if:type,pdf|nullable|file|mimes:pdf|max:10240', // Maksimal 10MB
        ]);

        $data = $request->only('track_id', 'title', 'type');
        $data['user_id'] = auth()->id();

        if ($request->type === 'article') {
            $data['content'] = $request->content_article;
        } elseif ($request->type === 'video') {
            $data['content'] = $this->extractYouTubeId($request->content_video);
        } elseif ($request->hasFile('content_pdf')) {
            $path = $request->file('content_pdf')->store('pdfs/submissions', 'public');
            $data['content'] = $path;
        }

        Material::create($data);

        return redirect()->route('dashboard')->with('success', 'Materi Anda telah dikirim dan menunggu approval admin.');
    }

    /**
     * Helper function untuk mengekstrak ID video dari URL YouTube.
     */
    private function extractYouTubeId(string $url): ?string
    {
        preg_match('/(v=|vi=|http:\/\/googleusercontent.com\/youtube.com\/0\/|embed\/|\/v\/|\?v=|\&v=)(.+?)\b/i', $url, $matches);
        return $matches[2] ?? $url;
    }

    /**
     * Menampilkan riwayat materi yang telah diajukan oleh user.
     */
    public function history()
    {
        $submissions = Material::where('user_id', auth()->id())
            ->with('track')
            ->latest()
            ->paginate(10);

        return view('user.submission_history', compact('submissions'));
    }
}