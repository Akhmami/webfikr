<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Views\Composers\PopupComposer;
use App\Views\Composers\NavbarComposer;
use App\Views\Composers\ProfileComposer;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.web', NavbarComposer::class);
        view()->composer('layouts.web', PopupComposer::class);
        view()->composer('layouts.profile', ProfileComposer::class);
        // view()->composer('layouts.sidebar', function($view) {
        //     $categories = Category::with(['posts' => function($query) {
        //         $query->published();
        //     }])->orderBy('title', 'asc')->get();
        //
        //     return $view->with('categories', $categories);
        // });
        //
        // view()->composer('layouts.sidebar', function($view) {
        //     $popularPosts = Post::published()->popular()->take(3)->get();
        //     return $view->with('popularPosts', $popularPosts);
        // });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
