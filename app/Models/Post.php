<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //PostCategory model
    public function categories()
    {
        return $this->belongsToMany(PostCategory::class, 'post_categories');
    }
}
