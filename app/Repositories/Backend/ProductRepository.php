<?php

namespace App\Repositories\Backend;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductMedia;
use App\Models\Tag;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\File;

class ProductRepository
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

    public function store($request)
    {
        $data['name']         = $request->name;
        $data['description']  = $request->description;
        $data['details']      = $request->details;
        $data['price']        = $request->price;
        $data['in_stock']     = $request->in_stock;
        $data['review_able']  = $request->review_able;
        $data['category_id']  = $request->category_id;

        $product = $this->product::create($data);

        $product->tags()->sync($request->tags);

        if ($request->images && count($request->images) > 0) {
            $i = 1;
            foreach ($request->images as $file) {
                $product->media()->create([
                    'file_name' => $this->uploadImage($file)
                ]);
                $i++;
            }
        }
        if ($request->status == 1)

            clear_cache();
    }

    public function update($request, $product)
    {
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
    }

    public function delete(Product $product)
    {
        abort_if(!auth()->user()->can('delete-product'), 403, 'You have not permission to access this page!');

        if ($product->media->count() > 0) {
            foreach ($product->media as $media) {
                if (File::exists('storage/' . $media->file_name)) {
                    unlink('storage/' . $media->file_name);
                }
            }
        }
        $product->delete();

        clear_cache();
    }

    public function removeImage($request)
    {
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
