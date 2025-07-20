<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'material_id',
        'parent_id',
        'body',
    ];

    // Relasi: Komentar ini milik satu User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Komentar ini milik satu Materi
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
}
