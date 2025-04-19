<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    protected $table = 'complains'; // Nama tabel

    protected $fillable = [
        'user_id',        // Relasi ke tabel users (pelapor)
        'category_id',    // Relasi ke kategori aduan
        'no_aduan',       // Nomor aduan
        'title',          // Judul aduan
        'description',    // Deskripsi aduan
        'image',          // Gambar (opsional)
        'location',       // Lokasi aduan
        'status',         // Status aduan
        'visibility',     // Visibilitas aduan
        'tanggal_aduan',  // Tanggal aduan (opsional)
    ];

    // Relasi ke tabel users (pelapor)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke tabel category_reports (kategori aduan)
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
