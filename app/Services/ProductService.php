<?php

namespace App\Services;

use App\Models\Tag;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\File;

class ProductService
{
    use ImageUploadTrait;

    public function storeImages($request, $product, $i)
    {
        if ($request->images && count($request->images) > 0) {
            foreach ($request->images as $image) {
                $file_size = $image->getSize();
                $file_type = $image->getMimeType();

                $product->media()->create([
                    'file_name' => $this->uploadImages($product->name, $image, $i, 'products', 500, NULL),
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                    'file_status' => true,
                    'file_sort' => $i
                ]);

                $i++;
            }
        }
    }

    public function unlinkAndDeleteImage($product)
    {
        if ($product->media->count() > 0) {
            foreach ($product->media as $media) {
                if (File::exists('storage/images/products/' . $media->file_name)) {
                    unlink('storage/images/products/' . $media->file_name);
                }
                $media->delete();
            }
        }
    }
}
