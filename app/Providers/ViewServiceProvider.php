<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Review;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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

        /**** This function works in all views except admin pages ****/
        if (!request()->is('admin/*')) {

            /**** Use my paginator as default in all site ****/
            Paginator::defaultView('vendor.pagination.cart-white');

            /**** Save recent products on redis cache ****/
            view()->composer('*', function ($view) {

                /**** RECENT PRODUCTS. ****/
                if (!Cache::has('recent_products')) {
                    $recent_products = Product::with(['category', 'media', 'user'])
                        ->whereHas('category', function ($query){
                            $query->whereStatus(1);
                        })->orderBy('id', 'desc')->limit(5)->get();
                    Cache::remember('recent_products', 3600, function () use ($recent_products) {
                        return $recent_products;
                    });
                }

                $recent_products = Cache::get('recent_products');

                /**** RECENT REVIEWS. ****/
                if (!Cache::has('recent_reviews')) {
                    $recent_reviews = Review::whereStatus(1)->orderBy('id', 'desc')->limit(5)->get();
                    Cache::remember('recent_reviews', 3600, function () use ($recent_reviews) {
                        return $recent_reviews;
                    });
                }
                $recent_reviews = Cache::get('recent_reviews');


                /**** GLOBAL CATEGORIES. ****/
                if (!Cache::has('global_categories')) {
                    $global_categories = Category::whereStatus(1)->orderBy('name', 'desc')->limit(5)->get();
                    Cache::remember('global_categories', 3600, function () use ($global_categories) {
                        return $global_categories;
                    });
                }
                $global_categories = Cache::get('global_categories');


                /**** GLOBAL TAGS. ****/
                if (!Cache::has('global_tags')) {
                    $global_tags = Tag::withCount('products')->get();
                    Cache::remember('global_tags', 3600, function () use ($global_tags) {
                        return $global_tags;
                    });
                }
                $global_tags = Cache::get('global_tags');

                /**** GLOBAL ARCHIVES. ****/
                if (!Cache::has('global_archives')) {
                    $global_archives = Product::active()->orderBy('created_at', 'desc')
                    ->select(DB::raw("Year(created_at) as year"), DB::raw("Month(created_at) as month"))
                    ->pluck('year', 'month')->toArray();
                    Cache::remember('global_archives', 3600, function () use ($global_archives) {
                        return $global_archives;
                    });
                }
                $global_archives = Cache::get('global_archives');

                $view->with([
                    'recent_products' => $recent_products,
                    'recent_reviews' => $recent_reviews,
                    'global_categories' => $global_categories,
                    'global_tags' => $global_tags,
                    'global_archives' => $global_archives,
                ]);

            });
        }

    }
}
