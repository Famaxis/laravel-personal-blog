<?php

namespace App\Models;

use App\Traits\CacheClear;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory, CacheClear;

    public $timestamps = false;

    protected $guarded = [];
}
