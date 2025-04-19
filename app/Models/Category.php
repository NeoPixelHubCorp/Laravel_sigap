<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'category',
        'slug',
    ];
        public function complains()
    {
        return $this->hasMany(Complain::class, 'category_id');
    }
    //  Override supaya route model binding pakai slug,
    //  bukan id.
    //
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
    // Auto-generate slug saat create & update.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->category);
        });

        static::updating(function ($category) {
            $category->slug = Str::slug($category->category);
        });
    }
}
