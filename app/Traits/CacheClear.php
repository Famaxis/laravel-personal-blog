<?php

namespace App\Traits;

use Artisan;

trait CacheClear
{
    protected static function boot()
    {
        parent::boot();

        /**
         * After model is created, updated, or deleted - clear cache.
         */
        static::saved(function () {
            Artisan::call('cache:clear');
        });
        static::deleted(function (){
            Artisan::call('cache:clear');
        });
    }
}