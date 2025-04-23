<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'complains_id',
        'parent_id',
        'user_id',
        'comment',
    ];

    // Relasi ke Complain
    public function complain()
    {
        return $this->belongsTo(Complain::class, 'complains_id');
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke komentar induk (jika ini reply)
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Relasi ke komentar anak (semua reply ke comment ini)
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
