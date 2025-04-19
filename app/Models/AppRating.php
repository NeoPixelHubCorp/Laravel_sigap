<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppRating extends Model
{
    protected $table = 'app_ratings'; // Nama tabel

    protected $fillable = [
        'user_id',        // Relasi ke user yang memberi rating
        'app_rating',     // Rating aplikasi
        'app_feedback',   // Feedback aplikasi
        'version',        // Versi aplikasi
    ];

    // Relasi ke tabel Users (Pengguna yang memberi rating)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
