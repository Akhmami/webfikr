<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\View\Composers\BreadcrumbComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Fix for SwiftMailer Service;
        $_SERVER["SERVER_NAME"] = config('app.domain');
        View::composer('layouts.dash', BreadcrumbComposer::class);
    }
}
