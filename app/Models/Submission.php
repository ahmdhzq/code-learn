<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quiz_id',
        'score',
    ];

    // Relasi: Submission ini milik satu User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Submission ini milik satu Kuis
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }
}
