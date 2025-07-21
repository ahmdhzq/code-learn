<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserDashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $enrolledTracks = $user->enrolledTracks()->withCount('materials')->get();

        // [DIUBAH] Iterasi untuk menghitung progres setiap track
        foreach ($enrolledTracks as $track) {
            // Hitung materi yang selesai oleh user di track ini
            $completedCount = $user->completedMaterials()
                                    ->where('track_id', $track->id)
                                    ->count();
            
            // Hitung total materi di track ini
            $totalMaterials = $track->materials_count;

            // Hitung persentase dan tambahkan sebagai properti baru
            $track->progressPercentage = ($totalMaterials > 0) 
                                        ? ($completedCount / $totalMaterials) * 100 
                                        : 0;
        }

        return view('user.dashboard', compact('enrolledTracks'));
    }
}