<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{
    public function show($slug)
    {
        $static_page = Page::active()->whereSlug($slug)->firstOrFail();
        if (!Cache::has('static_page')) {
            Cache::remember('static_page', 3600, function () use ($static_page) {
                return $static_page;
            });
        }

        return view('frontend.pages.show', compact('static_page'));
    }
}
