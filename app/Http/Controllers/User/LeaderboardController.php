<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LeaderboardController extends Controller
{
    public function index(): View
    {
        // Ambil 100 pengguna dengan poin tertinggi
        $users = User::orderBy('points', 'desc')->take(100)->get();

        return view('user.leaderboard', compact('users'));
    }
}