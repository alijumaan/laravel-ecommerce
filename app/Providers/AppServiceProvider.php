<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Http\View\Composers\PageComposer');
        $this->app->singleton('App\Http\View\Composers\CategoryComposer');
        $this->app->singleton('App\Http\View\Composers\TagComposer');
        $this->app->singleton('App\Http\View\Composers\ProductComposer');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        View::composer('backend.partial.pages', 'App\Http\View\Composers\PageComposer');
        View::composer('backend.partial.categories', 'App\Http\View\Composers\CategoryComposer');
        View::composer('backend.partial.tags', 'App\Http\View\Composers\TagComposer');
        View::composer('backend.partial.products', 'App\Http\View\Composers\ProductComposer');
    }
}
