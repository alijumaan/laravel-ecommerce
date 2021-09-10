<?php

namespace App\Traits;

use App\Models\Media;
use Illuminate\Support\Facades\File;

trait RemoveImageTrait
{
    public function removeAvatar($request, $user): string
    {
        if ($user) {
            if ($request->user_image != '') {
                if ($user->user_image != 'images/avatar.png') {
                    if (File::exists('storage/' . $user->user_image)){
                        unlink('storage/' . $user->user_image);
                    }
                }
            }

            $user->user_image = null;
            $user->save();

            return 'true';
        }

        return 'false';
    }

    public function removeProductImage($request): bool
    {
        $media = Media::whereId($request->mediaId)->first();

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
