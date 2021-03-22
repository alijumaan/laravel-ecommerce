<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Traits\RemoveImageTrait;
use Illuminate\Http\Request;
use App\Traits\FilterTrait;
use App\Services\ProductService;

class ProductController extends Controller
{
    use FilterTrait, RemoveImageTrait;

    public function index()
    {
        $query = Product::with(['category', 'reviews', 'media']);

        $products = $this->filter($query);

        return view('backend.products.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('backend.products.show', compact('product'));
    }

    public function create()
    {
        abort_if(!auth()->user()->can(['add-product', 'add-tag']), 403, 'You have not permission to access this page!');

        $categories = Category::orderBy('name')->pluck('name', 'id');

        $tags = Tag::orderBy('name')->pluck('name', 'id');

        return view('backend.products.create', compact('categories', 'tags'));
    }

    public function store(StoreProductRequest $request)
    {

        $product = Product::create($request->validated());
        $product->tags()->sync($request->tags);

        (new ProductService())->storeProductImages($request, $product);

        if ($request->status == 1) {
            clear_cache();
        }

        return redirect()->route('admin.products.index')->with(['message' => 'Product create successfully', 'alert-type' => 'success',]);
    }

    public function edit(Product $product)
    {
        abort_if(!auth()->user()->can('edit-product'), 403, 'You have not permission to access this page!');

        $categories = Category::orderBy('name')->pluck('name', 'id');

        $tags = Tag::orderBy('name')->pluck('name', 'id');

        return view('backend.products.edit', compact('categories', 'product', 'tags'));

    }

    public function update(StoreProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        (new ProductService())->storeProductTags($request, $product);
        (new ProductService())->storeProductImages($request, $product);

        clear_cache();

        return redirect()->route('admin.products.index')->with(['message' => 'Product updated successfully', 'alert-type' => 'success']);
    }

    public function destroy(Product $product)
    {
        abort_if(!auth()->user()->can('delete-product'), 403, 'You have not permission to access this page!');

        (new ProductService())->unlinkImageAfterDelete($product);

        $product->delete();

        clear_cache();

        return redirect()->route('admin.products.index')->with(['message' => 'Product deleted successfully', 'alert-type' => 'success']);
    }

    public function removeImage(Request $request)
    {
        abort_if(!auth()->user()->can('delete-product'), 403, 'You have not permission to access this page!');

        return ($this->removeProductImage($request));
    }

}
