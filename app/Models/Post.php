<?php

namespace App\Models;

use Conner\Tagging\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CacheClear;

class Post extends Model
{
    use HasFactory, Taggable, CacheClear;

    protected $guarded = [];

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at','DESC');
    }

    public function template()
    {
        return $this->belongsTo(Template::class, 'custom_template');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', 1);
    }

    public function scopeChosen($query)
    {
        return $query->where('is_chosen', 1);
    }
}
