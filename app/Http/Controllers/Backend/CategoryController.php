<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Traits\FilterTrait;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    use FilterTrait;

    public function index()
    {
        $query = Category::withCount('products');
        $categories = $this->filter($query);

        return view('backend.categories.index', compact('categories'));
    }

    public function create()
    {
        abort_if(!auth()->user()->can('add-category'), 403, 'You did not have permission to access this page!');

        $categories = Category::orderBy('id', 'desc')->pluck('name', 'id');

        return view('backend.categories.create', compact('categories'));
    }

    public function store(StoreCategoryRequest $request, Category $category)
    {
        $category->create($request->validated());

        if ($request->status == 1) {
            clear_cache();
        }

        return redirect()->route('admin.categories.index')->with(['message' => 'Category create successfully', 'alert-type' => 'success',]);
    }

    public function edit(Category $category)
    {
        abort_if(!auth()->user()->can('edit-category'), 403, 'You did not have permission to access this page!');

        $categories = Category::orderBy('id', 'desc')->pluck('name', 'id');

        return view('backend.categories.edit', compact('category', 'categories'));
    }

    public function update(StoreCategoryRequest $request, Category $category)
    {
        abort_if(!auth()->user()->can('edit-category'), 403, 'You did not have permission to access this page!');

        $category->update($request->validated());

        clear_cache();

        return redirect()->route('admin.categories.index')->with(['message' => 'Product updated successfully', 'alert-type' => 'success']);
    }

    public function destroy(Category $category)
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

        return redirect()->route('admin.categories.index')->with(['message' => 'Category deleted successfully', 'alert-type' => 'success',]);
    }
}
