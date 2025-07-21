<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Track extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    // Relasi: Track memiliki banyak materi
    public function materials(): HasMany
    {
        return $this->hasMany(Material::class);
    }

    /**
     * Relasi untuk mengambil semua pengguna yang mengikuti track ini.
     */
    public function enrolledUsers()
    {
        return $this->belongsToMany(User::class);
    }
}
