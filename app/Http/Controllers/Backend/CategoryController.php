<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public $categories;
    public function __construct(Category $categories)
    {
        $this->categories = $categories;
    }

    public function index()
    {
        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $status = (isset(\request()->status) && \request()->status != '') ? \request()->status : null;
        $sortBy = (isset(\request()->sort_by) && \request()->sort_by != '') ? \request()->sort_by : 'id';
        $orderBy = (isset(\request()->order_by) && \request()->order_by != '') ? \request()->order_by : 'desc';
        $limitBy = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : '10';

        $categories = Category::withCount('products');
        if ($keyword != null) {
            $categories = $categories->search($keyword);
        }
        if ($status != null) {
            $categories = $categories->whereStatus($status);
        }

        $categories = $categories->orderBy($sortBy, $orderBy);
        $categories = $categories->paginate($limitBy);

        return view('backend.categories.index', compact(  'categories'));
    }

    public function create()
    {
        abort_if(!auth()->user()->can('add-category'), 403, 'You did not have permission to access this page!');
        $categories = Category::orderBy('id', 'desc')->pluck('name', 'id');
        return view('backend.categories.create', compact('categories'));
    }

    public function store(StoreCategoryRequest $request, Category $category)
    {
        $category->name         = $request->name;
        $category->description  = $request->description;
        $category->status       = $request->status;
        $category->parent_id    = $request->parent_id;
        $category->save();
        if ($request->status == 1)
            clear_cache();
        return redirect()->route('admin.categories.index')->with(['message' => 'Category create successfully', 'alert-type' => 'success',]);
    }

    public function edit(Category $category)
    {
        abort_if(!auth()->user()->can('edit-category'), 403, 'You did not have permission to access this page!');
        $categories = $this->categories::orderBy('id', 'desc')->pluck('name', 'id');
        return view('backend.categories.edit', compact('category', 'categories'));
    }

    public function update(StoreCategoryRequest $request, Category $category)
    {
        if($category) {
            $category->name         = $request->name;
            $category->slug         = null;
            $category->parent_id    = $request->parent_id;
            $category->status       = $request->status;
            $category->description  = $request->description;
            $category->save();

            clear_cache();
            return redirect()->route('admin.categories.index')->with(['message' => 'Product updated successfully', 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => 'Something was wrong', 'alert-type' => 'danger']);
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
