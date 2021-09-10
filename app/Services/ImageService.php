<?php

namespace App\Services;

use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\File;

class ImageService
{
    use ImageUploadTrait;

    public function storeProductImages($images, $product, $i = 1)
    {
        foreach ($images as $image) {
            $product->media()->create([
                'file_name' => $this->uploadImages($product->name, $image, $i, 'products', 500, NULL),
                'file_size' => $image->getSize(),
                'file_type' => $image->getMimeType(),
                'file_status' => true,
                'file_sort' => $i
            ]);

            $i++;
        }
    }

    public function storeUserImages($fileName, $image): string
    {
        return $this->uploadImage(
            $fileName,
            $image,
            'users',
            300,
            NULL
        );
    }

    public function unlinkImage($image, $folderName)
    {
        if (File::exists('storage/images/'. $folderName .'/' . $image)) {
            unlink('storage/images/'. $folderName .'/' . $image);
        }
    }
}
