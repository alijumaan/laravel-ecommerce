<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CategoryRequest;
use App\Models\Category;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        $this->authorize('access_category');

        $categories = Category::with('parent')
            ->withCount('products')
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sortBy ?? 'id', \request()->orderBy ?? 'asc')
            ->paginate(\request()->limitBy ?? 10);

        return view('backend.categories.index', compact('categories'));
    }

    public function create()
    {
        $this->authorize('create_category');

        $mainCategories = Category::whereNull('parent_id')->get(['id', 'name']);

        return view('backend.categories.create', compact('mainCategories'));
    }

    public function store(CategoryRequest $request)
    {
        $this->authorize('create_category');

        $image = NULL;
        if ($request->hasFile('cover')) {
            $image = $this->uploadImage($request->name, $request->cover, 'categories', 500, NULL);
        }

        Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'status' => $request->status,
            'cover' => $image
        ]);

        clear_cache();

        return redirect()->route('admin.categories.index')->with([
            'message' => 'Created successfully',
            'alert-type' => 'success'
        ]);
    }

    public function show(Category $category)
    {
        $this->authorize('show_category');

        return view('backend.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $this->authorize('edit_category');

        $mainCategories = Category::whereNull('parent_id')->get(['id', 'name']);

        return view('backend.categories.edit', compact('category', 'mainCategories'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $this->authorize('edit_category');

        $image = $category->cover;
        if ($request->has('cover')) {
            if ($category->cover != null && File::exists('storage/assets/images/categories/'. $category->cover)) {
                unlink('storage/assets/images/categories/'. $category->cover);
            }
            $image = $this->uploadImage($request->name, $request->cover, 'categories', 500, NULL);
        }

        $category->update([
            'name' => $request->name,
            'slug' => null,
            'parent_id' => $request->parent_id,
            'status' => $request->status,
            'cover' => $image
        ]);

        clear_cache();
        return redirect()->route('admin.categories.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete_category');

        if ($category->cover) {
            if (File::exists('storage/assets/images/categories/'. $category->cover)) {
                unlink('storage/assets/images/categories/'. $category->cover);
            }
        }

        $category->delete();

        clear_cache();
        return redirect()->route('admin.categories.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);

    }

    public function removeImage(Category $category)
    {
        $this->authorize('delete_category');

        if (File::exists('storage/images/categories/'. $category->cover)) {
            unlink('storage/images/categories/'. $category->cover);
            $category->cover = null;
            $category->save();
        }

        clear_cache();
        return back()->with([
            'message' => 'Image deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
