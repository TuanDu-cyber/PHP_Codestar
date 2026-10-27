<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'category', 'image', 'content', 'published_at'];

    protected $casts = ['published_at' => 'datetime'];
}
