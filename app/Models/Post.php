<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    //PostCategory model
    public function categories()
    {
        return $this->belongsToMany(PostCategory::class, 'post_categories');
    }

    //get postcategory
    public function postCategory()
    {
        return $this->hasMany(PostCategory::class, 'post_id');
    }

}
