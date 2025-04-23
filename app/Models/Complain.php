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

    // Boot method untuk menangani event saat menyimpan
    protected static function boot()
    {
        parent::boot();

        // Menetapkan user_id secara otomatis saat membuat aduan
        static::creating(function ($complain) {
            if (auth()->check()) {
                $complain->user_id = auth()->id();
            }
        });

        // Mengatur nomor aduan otomatis saat menyimpan
        static::saving(function ($complain) {
            if (empty($complain->no_aduan)) {
                $complain->no_aduan = 'ADUAN-' . strtoupper(uniqid());
            }
        });
    }
}
