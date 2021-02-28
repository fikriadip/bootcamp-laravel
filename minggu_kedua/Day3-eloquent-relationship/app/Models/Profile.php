<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    public function user()
    {
        // belongsTo digunakan ketika menggunakan public function user di dalam class Profile
        // return $this->belongsTo(user::class);
    }
}
