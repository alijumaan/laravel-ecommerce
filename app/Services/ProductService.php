<?php

namespace App\Services;

use App\Models\Tag;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\File;

class ProductService
{
    use ImageUploadTrait;

    public function storeProductImages($request, $product)
    {
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

    public function storeProductTags($request, $product)
    {
        if (isset($request->tags) && count($request->tags) > 0) {
            $new_tags = array();
            foreach ($request->tags as $tag) {
                $tag = Tag::firstOrCreate(['id' => $tag], ['name' => $tag]);
                $new_tags[] = $tag->id;
            }
            $product->tags()->sync($new_tags);
        }
    }

    public function unlinkImageAfterDelete($product)
    {
        if ($product->media->count() > 0) {
            foreach ($product->media as $media) {
                if (File::exists('storage/' . $media->file_name)) {
                    unlink('storage/' . $media->file_name);
                }
            }
        }
    }
}
