<?php

namespace App\Models;

use Conner\Tagging\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    use Taggable;

    protected $guarded = [];

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at','DESC');
    }
}
