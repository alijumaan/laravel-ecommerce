<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Permission;
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

        // This function works in all views except admin pages
        if (!request()->is('admin/*')) {
            // Use my paginator as default in all site
            Paginator::defaultView('vendor.pagination.cart-white');

            // Save recent products on redis cache
            view()->composer('*', function ($view) {

                // RECENT PRODUCTS.
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

                // RECENT COMMENTS.
                if (!Cache::has('recent_comments')) {
                    $recent_comments = Comment::whereStatus(1)->orderBy('id', 'desc')->limit(5)->get();

                    Cache::remember('recent_comments', 3600, function () use ($recent_comments) {
                        return $recent_comments;
                    });
                }

                $recent_comments = Cache::get('recent_comments');


                // GLOBAL CATEGORIES.
                if (!Cache::has('global_categories')) {
                    $global_categories = Category::whereStatus(1)->orderBy('name', 'desc')->limit(5)->get();

                    Cache::remember('global_categories', 3600, function () use ($global_categories) {
                        return $global_categories;
                    });
                }

                $global_categories = Cache::get('global_categories');


                // GLOBAL TAGS.
                if (!Cache::has('global_tags')) {
                    $global_tags = Tag::withCount('products')->get();

                    Cache::remember('global_tags', 3600, function () use ($global_tags) {
                        return $global_tags;
                    });
                }

                $global_tags = Cache::get('global_tags');

                // GLOBAL ARCHIVES.
                if (!Cache::has('global_archives')) {
                    $global_archives = Product::whereStatus(1)->orderBy('created_at', 'desc')
                    ->select(DB::raw("Year(created_at) as year"), DB::raw("Month(created_at) as month"))
                    ->pluck('year', 'month')->toArray();

                    Cache::remember('global_archives', 3600, function () use ($global_archives) {
                        return $global_archives;
                    });
                }

                $global_archives = Cache::get('global_archives');

                $view->with([
                    'recent_products' => $recent_products,
                    'recent_comments' => $recent_comments,
                    'global_categories' => $global_categories,
                    'global_tags' => $global_tags,
                    'global_archives' => $global_archives,
                ]);

            });

        }


        // Word with only Admin
        if (request()->is('admin/*')) {

            view()->composer('*', function ($view) {

                if (!Cache::has('admin_side_menu')) {
                    Cache::forever('admin_side_menu', Permission::tree());
                }
                $admin_side_menu = Cache::get('admin_side_menu');

                $view->with([
                    'admin_side_menu' => $admin_side_menu,
                ]);

            });

        }

    }
}
