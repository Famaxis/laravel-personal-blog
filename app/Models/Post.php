<?php

namespace App\Models;

use Conner\Tagging\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CacheClear;

class Post extends Model
{
    use HasFactory;
    use Taggable;
    use CacheClear;

    protected $guarded = [];

    public function comments()
    {
        //eager load
        return $this->hasMany(Comment::class)->orderBy('created_at','DESC')->with('user');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', 1);
    }
}
