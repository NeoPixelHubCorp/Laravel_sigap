<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Category extends Model
{
    protected $fillable = [
        'name',
    ];
        public function complains()
    {
        return $this->hasMany(Complain::class, 'category_id');
    }
}
