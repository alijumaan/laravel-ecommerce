<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Repositories\Backend\CategoryRepository;
use App\Traits\FilterTrait;

class CategoryController extends Controller
{
    use FilterTrait;

    public $category;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $query = Category::withCount('products');
        $categories = $this->filter($query);

        return view('backend.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = $this->category->create();

        return view('backend.categories.create', compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $this->category->store($request);

        return redirect()->route('admin.categories.index')->with(['message' => 'Category create successfully', 'alert-type' => 'success',]);
    }

    public function edit(Category $category)
    {
        $categories = $this->category->edit();

        return view('backend.categories.edit', compact('category', 'categories'));
    }

    public function update(StoreCategoryRequest $request, Category $category)
    {
        if ($category) {

            $this->category->update($request, $category);

            return redirect()->route('admin.categories.index')->with(['message' => 'Product updated successfully', 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => 'Something was wrong', 'alert-type' => 'danger']);
    }

    public function destroy(Category $category)
    {
        $this->category->delete($category);

        return redirect()->route('admin.categories.index')->with(['message' => 'Category deleted successfully', 'alert-type' => 'success',]);
    }
}
