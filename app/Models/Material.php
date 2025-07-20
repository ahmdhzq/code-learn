<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'track_id',
        'title',
        'content',
        'type',
        'order',
    ];

    // Relasi: Materi ini milik satu Track
    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class);
    }

    // Relasi: Materi memiliki satu Kuis
    public function quiz(): HasOne
    {
        return $this->hasOne(Quiz::class);
    }

    // Relasi: Materi memiliki banyak Komentar
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
