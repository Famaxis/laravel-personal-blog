<?php

namespace App\Models;

use App\Services\MetadataHandler;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $guarded = [];
    private $metadataHandler;

    function __construct($attributes = array())
    {
        parent::__construct($attributes);
        $this->metadataHandler = new MetadataHandler;
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = $this->metadataHandler->generateSlug($value);
    }
}
