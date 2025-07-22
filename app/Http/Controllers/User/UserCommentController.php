<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCommentController extends Controller
{
    /**
     * Menyimpan komentar baru dari pengguna.
     */
    public function store(Request $request)
{
    $request->validate([
        'body' => 'required|string',
        'material_id' => 'required|exists:materials,id',
        'parent_id' => 'nullable|exists:comments,id',
    ]);

    Comment::create([
        'user_id' => Auth::id(),
        'material_id' => $request->material_id,
        'parent_id' => $request->parent_id,
        'body' => $request->body,
    ]);

    return back()->with('success', 'Komentar Anda berhasil dipublikasikan.');
}
}