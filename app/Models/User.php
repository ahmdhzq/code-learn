<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'points',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi: User memiliki banyak komentar
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    // Relasi: User memiliki banyak submission (hasil kuis)
    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class);
    }

    // Relasi: User memiliki banyak materi yang telah diselesaikan
    public function completedMaterials()
    {
        return $this->belongsToMany(Material::class, 'user_material_progress');
    }

    /**
     * Relasi untuk mengambil semua track yang diikuti oleh pengguna.
     */
    public function enrolledTracks()
    {
        return $this->belongsToMany(Track::class);
    }

    // Relasi untuk mengambil comment yang telah diberikan suara oleh pengguna
    public function commentLikes()
    {
        return $this->belongsToMany(Comment::class, 'comment_likes');
    }

        public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
