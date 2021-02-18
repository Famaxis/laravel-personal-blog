<?php

namespace App\Models;

use App\Services\MetadataHandler;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function template()
    {
        return $this->belongsTo(Template::class, 'custom_template');
    }
}
