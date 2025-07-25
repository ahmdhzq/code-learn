<?php

namespace App\Http\Controllers;

use App\Models\Track;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialSubmissionController extends Controller
{
    public function create()
{
    $tracks = Track::all();
    return view('user.submit_material', compact('tracks')); 
}

    // Menyimpan materi baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:video,article',
            'content' => 'required|string',
            'track_id' => 'required|exists:tracks,id',
        ]);

        Material::create([
            'title' => $request->title,
            'type' => $request->type,
            'content' => $request->content,
            'track_id' => $request->track_id,
            'user_id' => auth()->id(), 
        ]);

        return redirect()->route('dashboard')->with('success', 'Materi Anda telah dikirim dan menunggu approval admin.');
    }
}