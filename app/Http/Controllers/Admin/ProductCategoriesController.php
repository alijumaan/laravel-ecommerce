<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductCategoriesController extends Controller
{
    public function __construct()
    {
        if (\auth()->check()) {
            $this->middleware('auth');
        } else {
            return view('admin.index');
        }
    }

    public function index()
    {
        if (!\auth()->user()->ability('admin', 'manage_product_categories, show_product_categories')) {
            return redirect('admin/index');
        }

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

        return view('admin.product_categories.index', compact(  'categories'));
    }

    public function create()
    {
        if (!\auth()->user()->ability('admin', 'create_product_categories')) {
            return redirect('admin/index');
        }
        $categories = Category::orderBy('id', 'desc')->pluck('name', 'id');
        return view('admin.product_categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if (!\auth()->user()->ability('admin', 'create_product_categories')) {
            return redirect('admin/index');
        }

        $validator = Validator::make($request->all(), [
            'name'         => 'required',
            'status'       => 'required',
            'order'    => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['name']         = $request->name;
        $data['status']       = $request->status;
        $data['parent_id']    = $request->parent_id;
        $data['order']        = $request->order;

        Category::create($data);

        if ($request->status == 1) {
            Cache::forget('global_categories');
        }


        // Redirect
        return redirect()->route('admin.product-categories.index')->with([
            'message' => 'Category create successfully',
            'alert-type' => 'success',
        ]);


    }

    public function edit($id)
    {
        if (!\auth()->user()->ability('admin', 'update_product_categories')) {
            return redirect('admin/index');
        }
        $category = Category::whereId($id)->first();
        $categories = Category::orderBy('id', 'desc')->pluck('name', 'id');
        return view('admin.product_categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, $id)
    {
        if (!\auth()->user()->ability('admin', 'update_product_categories')) {
            return redirect('admin/index');
        }

        $validator = Validator::make($request->all(), [
            'name'         => 'required',
            'status'       => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = Category::whereId($id)->first();

        if($category) {
            $data['name']         = $request->name;
            $data['slug']         = null;
            $data['status']       = $request->status;
            $data['parent_id']    = $request->parent_id;
            $data['order']        = $request->order;

            $category->update($data);

            clear_cache();

            // Redirect
            return redirect()->route('admin.product-categories.index')->with([
                'message' => 'Product updated successfully',
                'alert-type' => 'success',
            ]);

        }

        // Redirect
        return redirect()->back()->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);


    }

    public function destroy($id)
    {
        if (!\auth()->user()->ability('admin', 'delete_products')) {
            return redirect('admin/index');
        }

        $category = Category::whereId($id)->first();

        foreach ($category->products as $product) {
            if ($product->media->count() > 0) {
                foreach ($product->media as $media) {
                    if (File::exists('uploads/products/' . $media->file_name)) {
                        unlink('uploads/products/' . $media->file_name);
                    }
                }
            }
        }

        $category->delete();

        clear_cache();

        return redirect()->route('admin.product-categories.index')->with([
            'message' => 'Category deleted successfully',
            'alert-type' => 'success',
        ]);
    }
}
