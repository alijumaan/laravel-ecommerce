<?php

namespace App\Repositories\Backend;

use App\Models\Category;
use Illuminate\Support\Facades\File;

class CategoryRepository
{
    public $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function create()
    {
        abort_if(!auth()->user()->can('add-category'), 403, 'You did not have permission to access this page!');
        return $this->category::orderBy('id', 'desc')->pluck('name', 'id');
    }

    public function store($request)
    {
        $this->category->create($request->validated());
        if ($request->status == 1)

            clear_cache();
    }

    public function edit()
    {
        abort_if(!auth()->user()->can('edit-category'), 403, 'You did not have permission to access this page!');
        return $this->category::orderBy('id', 'desc')->pluck('name', 'id');
    }

    public function update($request, $category)
    {
        $category->name         = $request->name;
        $category->slug         = null;
        $category->parent_id    = $request->parent_id;
        $category->status       = $request->status;
        $category->description  = $request->description;
        $category->save();

        clear_cache();
    }

    public function delete($category)
    {
        abort_if(!auth()->user()->can('delete-category'), 403, 'You did not have permission to access this page!');
        foreach ($category->products as $product) {
            if ($product->media->count() > 0) {
                foreach ($product->media as $media) {
                    if (File::exists('storage/' . $media->file_name))
                        unlink('storage/' . $media->file_name);
                }
            }
        }
        $category->delete();

        clear_cache();
    }
}
