<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $table = "pertanyaan";
    protected $fillable = ["id", "judul", "isi", "tanggal_dibuat", "tanggal_diperbaharui", "jawaban_tepat_id", "profil_id"];
    use HasFactory;

}
