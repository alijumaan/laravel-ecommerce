<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Link;
use App\Models\Page;
use App\Models\Review;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (request()->is('admin') || request()->is('admin/*')) {
            view()->composer('*', function ($view) {
                if (!Cache::has('admin_side_menu')) {
                    Cache::forever('admin_side_menu', Link::whereStatus(true)->get());
                }
                $admin_side_menu = Cache::get('admin_side_menu');

                $routes_name = [];
                foreach (Route::getRoutes()->getRoutes() as $route) {
                    $action = $route->getAction();
                    if (array_key_exists('as', $action)) {
                        $routes_name[] = $action['as'];
                    }
                }

                $view->with([
                    'admin_side_menu' => $admin_side_menu,
                    'routes_name' => $routes_name
                ]);
            });
        }

        if (!request()->is('admin/*')) {
            view()->composer('*', function ($view) {
                if (!Cache::has('recent_reviews')) {
                    $recent_reviews = Review::whereStatus(1)->orderBy('id', 'desc')->limit(5)->get();
                    Cache::remember('recent_reviews', 3600, function () use ($recent_reviews) {
                        return $recent_reviews;
                    });
                }
                $recent_reviews = Cache::get('recent_reviews');

                /* Categories */
                if (!Cache::has('shop_categories_menu')) {
                    $global_categories = Category::tree();
                    Cache::remember('shop_categories_menu', 3600, function () use ($global_categories) {
                        return $global_categories;
                    });
                }
                $shop_categories_menu = Cache::get('shop_categories_menu');

                /* Tags */
                if (!Cache::has('shop_tags_menu')) {
                    $shop_tags_menu = Tag::whereStatus(true)->withCount('products')->get();
                    Cache::remember('shop_tags_menu', 3600, function () use ($shop_tags_menu) {
                        return $shop_tags_menu;
                    });
                }
                $shop_tags_menu = Cache::get('shop_tags_menu');

                /* Pages */
                if (!Cache::has('pages_menu')) {
                    $pages_menu = Page::active()->get();
                    Cache::remember('pages_menu', 3600, function () use ($pages_menu) {
                        return $pages_menu;
                    });
                }
                $pages_menu = Cache::get('pages_menu');

                $view->with([
                    'recent_reviews' => $recent_reviews,
                    'shop_categories_menu' => $shop_categories_menu,
                    'shop_tags_menu' => $shop_tags_menu,
                    'pages_menu' => $pages_menu
                ]);
            });
        }
    }
}
