<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplainRating extends Model
{
     protected $table = 'complains_ratings'; // Nama tabel

    protected $fillable = [
        'complains_id',      // Relasi ke complain
        'user_id',           // Relasi ke user yang memberi rating
        'complain_rating',   // Rating yang diberikan
        'complain_feedback', // Feedback dari user (opsional)
    ];

    // Relasi ke tabel Complains
    public function complain()
    {
        return $this->belongsTo(Complain::class, 'complains_id');
    }

    // Relasi ke tabel Users (Pengguna yang memberi rating)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
