<?php

namespace App\Models;

use App\Services\MetadataHandler;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $guarded = [];

//    public function setSlugAttribute($value)
//    {
//        $this->attributes['slug'] = MetadataHandler::generateSlug($value);
//    }
//
//    public function setTemplateAttribute($value)
//    {
//        $this->attributes['template'] = MetadataHandler::generateTemplate($value);
//    }
}
