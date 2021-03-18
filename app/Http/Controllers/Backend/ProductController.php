<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Repositories\Backend\ProductRepository;
use Illuminate\Http\Request;
use App\Traits\FilterTrait;

class ProductController extends Controller
{
    use FilterTrait;

    public $product;
    public $category;
    public $tag;
    public $productRepository;

    public function __construct(ProductRepository $productRepository, Product $product, Category $category, Tag $tag)
    {
        $this->product = $product;
        $this->category = $category;
        $this->tag = $tag;
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $query = $this->product::with(['category', 'reviews', 'media']);

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

        $categories = $this->category::orderBy('name')->pluck('name', 'id');

        $tags = $this->tag::orderBy('name')->pluck('name', 'id');

        return view('backend.products.create', compact('categories', 'tags'));
    }

    public function store(StoreProductRequest $request)
    {
        $this->productRepository->store($request);

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
        $this->productRepository->update($request, $product);

        return redirect()->route('admin.products.index')->with(['message' => 'Product updated successfully', 'alert-type' => 'success']);
    }

    public function destroy(Product $product)
    {
        $this->productRepository->delete($product);

        return redirect()->route('admin.products.index')->with(['message' => 'Product deleted successfully', 'alert-type' => 'success']);
    }

    public function removeImage(Request $request)
    {
        abort_if(!auth()->user()->can('delete-product'), 403, 'You have not permission to access this page!');

        return $this->productRepository->removeImage($request);
    }

}
