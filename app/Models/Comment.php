<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'material_id',
        'parent_id',
        'body',
    ];

    /**
     * Mendapatkan pengguna (user) yang memiliki komentar ini.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mendapatkan materi (material) yang memiliki komentar ini.
     */
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    /**
     * Mendapatkan semua balasan dari sebuah komentar.
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
