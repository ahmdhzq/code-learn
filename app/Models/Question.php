<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'question_text',
    ];

    // Relasi: Pertanyaan ini milik satu Kuis
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    // Relasi: Pertanyaan memiliki banyak Jawaban
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
