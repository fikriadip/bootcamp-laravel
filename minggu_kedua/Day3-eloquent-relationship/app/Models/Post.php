<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    // bisa menggunakan fillable atau guarded
    protected $table = "posts";
    // protected $fillable = ["title", "body"];

    // ketika menggunakan guarded di peruntukan untuk data yang banyak
    protected $guarded = []; // artinya semua column di tale boleh diisi
    // protected $guarded = ["body"]; artinya column body di table akan di blacklist dan tidak akan diisi
    public function maker()
    {
        // one to many 
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }

}


