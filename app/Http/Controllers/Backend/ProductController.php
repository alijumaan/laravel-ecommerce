<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductMedia;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Traits\ImageUploadTrait;


class ProductController extends Controller
{

    use ImageUploadTrait;

    public $product;
    public $category;
    public $tag;

    public function __construct(Product $product, Category $category, Tag $tag)
    {
        $this->product = $product;
        $this->category = $category;
        $this->tag = $tag;
    }

    public function index()
    {

        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $categoryId = (isset(\request()->category_id) && \request()->category_id != '') ? \request()->category_id : null;
        $tagId = (isset(\request()->tag_id) && \request()->tag_id != '') ? \request()->tag_id : null;
        $status = (isset(\request()->status) && \request()->status != '') ? \request()->status : null;
        $sortBy = (isset(\request()->sort_by) && \request()->sort_by != '') ? \request()->sort_by : 'id';
        $orderBy = (isset(\request()->order_by) && \request()->order_by != '') ? \request()->order_by : 'desc';
        $limitBy = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : '10';

        $products = Product::with(['category', 'reviews']);
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
        return view('backend.products.index', compact( 'categories', 'tags',  'products'));
    }

    public function show(Product $product)
    {
        return view('backend.products.show', compact('product'));
    }

    public function create()
    {
        abort_if(!auth()->user()->can('add-product'), 403, 'You have not permission to access this page!');
        $categories = $this->category::orderBy('name')->pluck('name', 'id');
        $tags = $this->tag::orderBy('name')->pluck('name', 'id');
        return view('backend.products.create', compact('categories', 'tags'));
    }

    public function store(StoreProductRequest $request)
    {
        $data['name']         = $request->name;
        $data['description']  = $request->description;
        $data['details']      = $request->details;
        $data['price']        = $request->price;
        $data['in_stock']     = $request->in_stock;
        $data['review_able']  = $request->review_able;
        $data['category_id']  = $request->category_id;

        $product = new $this->product;
        $created = $product->create($data);

        $created->tags()->attach($request->tags);

        if ($request->images && count($request->images) > 0) {
            $i = 1;
            foreach ($request->images as $file) {
                $created->media()->create([
                    'file_name' => $this->uploadImage($file)
                ]);
                $i++;
            }
        }

        if ($request->status == 1) {
            clear_cache();
        }
        return redirect()->route('admin.products.index')->with(['message' => 'Product create successfully', 'alert-type' => 'success',]);
    }

    public function edit(Product $product)
    {
        abort_if(!auth()->user()->can('edit-product'), 403, 'You have not permission to access this page!');
        $categories = $this->category::orderBy('name')->pluck('name', 'id');
        $tags = $this->tag::orderBy('name')->pluck('name', 'id');
        return view('backend.products.edit', compact('categories', 'product', 'tags'));

    }

    public function update(StoreProductRequest $request, Product $product)
    {
        if($product) {
            $product->name         = $request->name;
            $product->slug         = null;
            $product->description  = $request->description;
            $product->details      = $request->details;
            $product->price        = $request->price;
            $product->in_stock     = $request->in_stock;
            $product->review_able  = $request->review_able;
            $product->category_id  = $request->category_id;
            $product->save();

            if (isset($request->tags) && count($request->tags) > 0) {
                $new_tags = array();
                foreach ($request->tags as $tag) {
                    $tag = $this->tag::firstOrCreate(['id' => $tag], ['name' => $tag]);
                    $new_tags[] = $tag->id;
                }
                $product->tags()->sync($new_tags);
            }
            clear_cache();
            if ($request->images && count($request->images) > 0) {
                $i = 1;
                foreach ($request->images as $file) {
                    $product->media()->create([
                        'file_name' => $this->uploadImage($file)
                    ]);
                    $i++;
                }
            }

            return redirect()->route('admin.products.index')->with(['message' => 'Product updated successfully', 'alert-type' => 'success']);
        }

        return redirect()->back()->with(['message' => 'Something was wrong', 'alert-type' => 'danger']);
    }

    public function destroy(Product $product)
    {
        abort_if(!auth()->user()->can('delete-product'), 403, 'You have not permission to access this page!');
        if($product) {
            if ($product->media->count() > 0) {
                foreach ($product->media as $media) {
                    if (File::exists('storage/' . $media->file_name)) {
                        unlink('storage/' . $media->file_name);
                    }
                }
            }
            $product->delete();
            clear_cache();

            return redirect()->route('admin.products.index')->with(['message' => 'Product deleted successfully', 'alert-type' => 'success']);
        }
        return redirect()->route('admin.products.index')->with(['message' => 'Something was wrong', 'alert-type' => 'danger']);
    }

    public function removeImage(Request $request)
    {
        abort_if(!auth()->user()->can('delete-product'), 403, 'You have not permission to access this page!');
        $media = ProductMedia::whereId($request->mediaId)->first();
        if ($media) {
            if (File::exists('storage/' . $media->file_name)) {
                unlink('storage/' . $media->file_name);
            }
            $media->delete();
            return true;
        }

        return false;
    }

}
