<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserDashboardController extends Controller
{
    /**
     * Menampilkan dashboard pribadi pengguna.
     * Hanya menampilkan track yang sudah diambil (enrolled).
     */
    public function index(): View
    {
        $user = Auth::user();
        // Ambil semua track yang sudah diikuti oleh pengguna
        $enrolledTracks = $user->enrolledTracks()->withCount('materials')->get();

        return view('user.dashboard', compact('enrolledTracks'));
    }
}