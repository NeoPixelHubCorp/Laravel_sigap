<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'no_aduan',
        'title',
        'description',
        'image',
        'latitude',
        'longitude',
        'address',
        'city',
        'district',
        'status',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke Rating jika ada

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
