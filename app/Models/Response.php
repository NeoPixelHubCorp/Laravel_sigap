<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $table = 'responses'; // Nama tabel

    protected $fillable = [
        'complain_id',  // Relasi ke complain
        'admin_id',     // Admin yang memberi respon
        'response',     // Isi respon
        'updated_by',   // Admin yang update status
        'handled_by',   // Admin yang menangani
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

    // Relasi ke tabel Users (Admin yang menangani)
    public function handledBy()
    {
        return $this->belongsTo(User::class, 'handled_by');
    }


}
