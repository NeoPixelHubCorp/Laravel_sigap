<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $fillable = [
        'admin_id',     // Admin yang memberi respon
        'complain_id',  // Relasi ke complain
        'response',     // Isi respon
        'updated_by',   // Admin yang update status
    ];

    // Relasi ke tabel Complains
    public function complain()
    {
        return $this->belongsTo(Complain::class, 'complain_id');
    }

    // Relasi ke tabel Users (Admin yang memberi respon)
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // Relasi ke tabel Users (Admin yang mengupdate status)
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }


}
