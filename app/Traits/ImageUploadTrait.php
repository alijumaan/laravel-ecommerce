<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait ImageUploadTrait
{
    protected string $path  = 'app/public/images/';

    public function uploadImage($name, $img, $folderName, $image_width = NULL, $image_height = NULL): string
    {
        $image_name = $this->imageName($name, $img);

        $realPath = $this->path . $folderName;

        if (!file_exists(storage_path($realPath))) {
            mkdir(storage_path($realPath), 0755, true);
        }

        Image::make($img->getRealPath())->resize($image_width, $image_height, function ($constraint) {
            $constraint->aspectRatio();
        })->save(storage_path($this->path.$folderName.'/'.$image_name), 100);

        return $image_name;
    }

    public function uploadImages($name, $img, $i, $folderName, $image_width = NULL, $image_height = NULL): string
    {
        $image_name = $this->randomImageName($name, $img, $i);

        Image::make($img->getRealPath())
            ->resize($image_width, $image_height, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path($this->path.$folderName.'/'.$image_name), 100);

        return $image_name;
    }

    protected function imageName($imageName, $image): string
    {
        return Str::slug($imageName) . '.' . $image->getClientOriginalExtension();
    }

    protected function randomImageName($imageName, $image, $i): string
    {
        return Str::slug($imageName) . time() . '-' . $i . '.' . $image->getClientOriginalExtension();
    }
}
