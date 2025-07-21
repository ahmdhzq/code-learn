<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman depan publik (landing page) untuk tamu.
     * Halaman ini menampilkan daftar Learning Path sebagai "thumbnail".
     */
    public function index(): View
    {
        // Mengambil semua track yang memiliki setidaknya satu materi
        $tracks = Track::whereHas('materials')
                    ->withCount('materials')
                    ->latest()
                    ->get();
        
        // Menggunakan view 'welcome' sebagai landing page
        return view('user.welcome', compact('tracks'));
    }
}
