<?php

namespace App\Services;

use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\File;

class UserImageService
{
    use ImageUploadTrait;

    public function storeImages($fileName, $image)
    {
        return $this->uploadImage(
            $fileName,
            $image,
            'users',
            300,
            NULL
        );
    }

    public function unlinkFile($userImage)
    {
        if (File::exists('storage/images/users/'. $userImage)) {
            unlink('storage/images/users/'. $userImage);
        }
    }
}
