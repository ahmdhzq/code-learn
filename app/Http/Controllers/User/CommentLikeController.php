<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentLikeController extends Controller
{
    /**
     * Menangani aksi like/unlike pada sebuah komentar.
     */
    public function toggle(Comment $comment)
    {
        // Perintah 'toggle' akan menambah/menghapus record di tabel comment_likes
        Auth::user()->commentLikes()->toggle($comment->id);

        // Kembalikan jumlah like yang baru setelah di-refresh dari database
        return response()->json([
            'likes_count' => $comment->fresh()->likes_count
        ]);
    }
}