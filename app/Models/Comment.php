<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    // Relasi ke dirinya sendiri untuk balasan
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Relasi ke tabel pivot untuk voting
    public function likes()
    {
        return $this->belongsToMany(User::class, 'comment_likes');
    }

    public function getLikesCountAttribute(): int
    {
        return $this->likes()->count();
    }
}
