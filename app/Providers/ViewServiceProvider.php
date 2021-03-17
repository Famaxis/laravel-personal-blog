<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // checking table existence, or migrations will fail
        if (Schema::hasTable('settings')) {
            View::share('settings', Setting::first());
        }

        // view component 'chosen-posts'
        if (Schema::hasTable('posts')) {
            View::composer('components.chosen-posts', function ($view) {

                $chosenPosts = cache()->remember('chosen-posts', 86400, function () {
                    return Post::published()
                        ->chosen()
                        ->select(['first_sentence', 'slug'])
                        ->get();
                });

                $view->with(['chosenPosts' => $chosenPosts]);
            });
        }
    }
}
