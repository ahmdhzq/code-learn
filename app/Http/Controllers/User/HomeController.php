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
     */
    public function index(): View
    {
        $tracks = Track::whereHas('materials')
                    ->withCount('materials')
                    ->latest()
                    ->limit(4)
                    ->get();

        return view('user.welcome', compact('tracks'));
    }
}
