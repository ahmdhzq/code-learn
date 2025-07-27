<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_id',
        'title',
        'description',
    ];

    // Relasi: Kuis ini milik satu Materi
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }

    // Relasi: Kuis memiliki banyak Pertanyaan
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function submissions()
    {
        return $this->hasMany(\App\Models\Submission::class);
    }


    
}
