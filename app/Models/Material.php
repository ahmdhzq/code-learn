<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    /**
     * Mengizinkan semua kolom untuk diisi secara massal.
     * Ini akan menyelesaikan masalah data yang tidak tersimpan.
     */
    protected $guarded = [];

    // Relasi: Materi ini milik satu Track
    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    // Relasi: Materi memiliki satu Kuis
    public function quiz()
    {
        return $this->hasOne(Quiz::class);
    }

    // Relasi: Materi memiliki banyak Komentar
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
    
    // Relasi: Materi dimiliki oleh satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}