<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductMedia;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
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
        if (!\auth()->user()->ability('admin', 'manage_products, show_products')) {
            return redirect('admin/index');
        }

        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $categoryId = (isset(\request()->category_id) && \request()->category_id != '') ? \request()->category_id : null;
        $tagId = (isset(\request()->tag_id) && \request()->tag_id != '') ? \request()->tag_id : null;
        $status = (isset(\request()->status) && \request()->status != '') ? \request()->status : null;
        $sortBy = (isset(\request()->sort_by) && \request()->sort_by != '') ? \request()->sort_by : 'id';
        $orderBy = (isset(\request()->order_by) && \request()->order_by != '') ? \request()->order_by : 'desc';
        $limitBy = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : '10';

        $products = Product::with(['category', 'comments']);
        if ($keyword != null) {
            $products = $products->search($keyword);
        }
        if ($categoryId != null) {
            $products = $products->whereCategoryId($categoryId);
        }
        if ($tagId != null) {
            $products = $products->whereHas('tags', function ($query) use ($tagId) {
                $query->where('id', $tagId);
            });
        }
        if ($status != null) {
            $products = $products->whereStatus($status);
        }

        $products = $products->orderBy($sortBy, $orderBy);
        $products = $products->paginate($limitBy);

        $categories = Category::orderBy('id', 'desc')->pluck('name', 'id');
        $tags = Tag::orderBy('id', 'desc')->pluck('name', 'id');
        return view('admin.products.index', compact( 'categories', 'tags',  'products'));
    }

    public function create()
    {
        if (!\auth()->user()->ability('admin', 'create_products')) {
            return redirect('admin/index');
        }

        $categories = Category::orderBy('id', 'desc')->pluck('name', 'id');
        $tags = Tag::orderBy('id', 'desc')->pluck('name', 'id');
        return view('admin.products.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        if (!\auth()->user()->ability('admin', 'create_products')) {
            return redirect('admin/index');
        }

        $validator = Validator::make($request->all(), [
            'name'           => 'required',
            'description'    => 'required',
            'details'        => 'required',
            'price'          => 'required|numeric',
            'status'         => 'required',
            'comment_able'   => 'required',
            'category_id'    => 'required',
            'tags.*'         => 'required',
            'images.*'       => 'nullable|mimes:jpg,jpeg,png,gif|max:20000'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data['name']         = $request->name;
        $data['description']  = $request->description;
        $data['details']      = $request->details;
        $data['price']        = $request->price;
        $data['status']       = $request->status;
        $data['comment_able'] = $request->comment_able;
        $data['category_id']  = $request->category_id;

        $product = auth()->user()->products()->create($data);

        $product->tags()->attach($request->tags);

        if ($request->images && count($request->images) > 0) {
            $i = 1;
            foreach ($request->images as $file) {
                $fileName = $product->slug.'-'.time().'-'.$i.'.'.$file->getClientOriginalExtension();
                $file_size = $file->getSize();
                $file_type = $file->getMimeType();
                $path = public_path('uploads/products/' . $fileName);
                Image::make($file->getRealPath())->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);

                $product->media()->create([
                    'file_name' => $fileName,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                ]);
                $i++;
            }
        }

        if ($request->status == 1) {
            Cache::forget('recent_products');
            Cache::forget('global_archives');
        }

        // Redirect
        return redirect()->route('admin.products.index')->with([
            'message' => 'Product create successfully',
            'alert-type' => 'success',
        ]);


    }

    public function edit($id)
    {
        if (!\auth()->user()->ability('admin', 'update_products')) {
            return redirect('admin/index');
        }

        $categories = Category::orderBy('id', 'desc')->pluck('name', 'id');
        $product = Product::with(['media'])->whereId($id)->first();
        $tags = Tag::orderBy('id', 'desc')->pluck('name', 'id');
        return view('admin.products.edit', compact('categories', 'product', 'tags'));

    }

    public function show($id)
    {
        if (!\auth()->user()->ability('admin', 'display_products')) {
            return redirect('admin/index');
        }

        $product = Product::with(['media', 'category', 'user', 'comments'])->whereId($id)->first();
        return view('admin.products.show', compact('product'));
    }

    public function update(Request $request, $id)
    {
        if (!\auth()->user()->ability('admin', 'update_products')) {
            return redirect('admin/index');
        }

        $validator = Validator::make($request->all(), [
            'name'           => 'required',
            'description'    => 'required',
            'details'        => 'required',
            'price'          => 'required|numeric',
            'status'         => 'required',
            'comment_able'   => 'required',
            'category_id'    => 'required',
            'tags.*'         => 'required',
            'images.*'       => 'nullable|mimes:jpg,jpeg,png,gif|max:20000'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = Product::whereId($id)->first();

        if($product) {
            $data['name']         = $request->name;
            $data['slug']         = null;
            $data['description']  = $request->description;
            $data['details']      = $request->details;
            $data['price']        = $request->price;
            $data['status']       = $request->status;
            $data['comment_able'] = $request->comment_able;
            $data['category_id']  = $request->category_id;

            $product->update($data);

            if (isset($request->tags) && count($request->tags) > 0) {

                $new_tags = [];
                foreach ($request->tags as $tag) {
                    $tag = Tag::firstOrCreate([
                        'id' => $tag
                    ], [
                        'name' => $tag
                    ]);

                    $new_tags[] = $tag->id;
                }

                $product->tags()->sync($new_tags);
            }

            clear_cache();

            if ($request->images && count($request->images) > 0) {
                $i = 1;
                foreach ($request->images as $file) {
                    $fileName = $product->slug.'-'.time().'-'.$i.'.'.$file->getClientOriginalExtension();
                    $file_size = $file->getSize();
                    $file_type = $file->getMimeType();
                    $path = public_path('uploads/products/' . $fileName);
                    Image::make($file->getRealPath())->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path, 100);

                    $product->media()->create([
                        'file_name' => $fileName,
                        'file_size' => $file_size,
                        'file_type' => $file_type,
                    ]);
                    $i++;
                }
            }

        // Redirect
        return redirect()->route('admin.products.index')->with([
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

        $product = Product::whereId($id)->first();
        if($product) {
            if ($product->media->count() > 0) {
                foreach ($product->media as $media) {
                    if (File::exists('uploads/products/' . $media->file_name)) {
                        unlink('uploads/products/' . $media->file_name);
                    }
                }
            }

            $product->delete();

            clear_cache();

            return redirect()->route('admin.products.index')->with([
                'message' => 'Product deleted successfully',
                'alert-type' => 'success',
            ]);
        }

        return redirect()->route('admin.products.index')->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);
    }

    public function removeImage(Request $request)
    {
        if (!\auth()->user()->ability('admin', 'delete_products')) {
            return redirect('admin/index');
        }

        $media = ProductMedia::whereId($request->mediaId)->first();

        if ($media) {

            if (File::exists('uploads/products/' . $media->file_name)) {

                unlink('uploads/products/' . $media->file_name);
            }

            $media->delete();

            return true;
        }

        return false;
    }


}
