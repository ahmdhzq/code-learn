<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Track;     // <-- Tambahkan ini
use App\Models\User;      // <-- Tambahkan ini
use App\Models\Material;  // <-- Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    /**
     * Menampilkan daftar semua komentar untuk DataTables dengan filter.
     */
    public function index(): View
    {
        // Ambil data untuk dropdown filter
        $tracks = Track::all();
        $users = User::where('role', 'user')->orderBy('name')->get();
        $materials = Material::orderBy('title')->get();

        // Ambil SEMUA komentar. DataTables akan menangani sisanya.
        $comments = Comment::with(['user', 'material.track'])->latest()->get();

        // Kirim semua data yang dibutuhkan ke view
        return view('admin.comments.index', compact('comments', 'tracks', 'users', 'materials'));
    }

    /**
     * Menghapus komentar dari database.
     */
    public function destroy(Comment $comment): RedirectResponse
    {
        $comment->delete();

        return redirect()->route('admin.comments.index')
                         ->with('success', 'Komentar berhasil dihapus.');
    }
}
