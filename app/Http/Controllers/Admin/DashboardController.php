<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Track;
use App\Models\Material;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(): View
    {
        // === MENGAMBIL DATA UNTUK KARTU STATISTIK ===
        $totalUsers = User::where('role', 'user')->count();
        $totalTracks = Track::count();
        $totalMaterials = Material::count();
        $totalQuizzes = Quiz::count();

        // Menghitung pengguna baru dalam 7 hari terakhir
        $newUsersThisWeek = User::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        
        // Mengambil 5 learning path terbaru untuk daftar aktivitas
        $latestTracks = Track::latest()->take(5)->get();

        // === MENGAMBIL DATA UNTUK GRAFIK (CHART) ===
        $chartLabels = [];
        $chartData = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $chartLabels[] = $month->translatedFormat('M');
            
            $count = Material::whereYear('created_at', $month->year)
                             ->whereMonth('created_at', $month->month)
                             ->count();
            $chartData[] = $count;
        }

        // Mengirim semua data dinamis ke view 'admin.dashboard'
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalTracks',
            'totalMaterials',
            'totalQuizzes',
            'newUsersThisWeek', // Variabel yang dibutuhkan view
            'latestTracks',     // Variabel yang dibutuhkan view
            'chartLabels',
            'chartData'
        ));
    }
}
