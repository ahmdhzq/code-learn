<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Data dummy untuk kartu statistik
        $totalUsers = 125;
        $totalTracks = 8;
        $totalMaterials = 72;
        $totalQuizzes = 45;

        // Data dummy untuk chart
        $chartLabels = ['Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'];
        $chartData = [12, 19, 8, 15, 20, 25];

        // Mengirim semua data ke view 'admin.dashboard'
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalTracks',
            'totalMaterials',
            'totalQuizzes',
            'chartLabels',
            'chartData'
        ));
    }
}
