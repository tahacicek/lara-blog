<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    //category->id PostCategory->category_id
    public function postCategory()
    {
        return $this->hasMany(PostCategory::class, 'category_id');
    }

}
