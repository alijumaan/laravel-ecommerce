<?php

namespace App\Traits;

use App\Models\ProductMedia;
use Illuminate\Support\Facades\File;

trait RemoveImageTrait
{
    public function removeAvatar($request, $user)
    {
        if ($user) {
            if ($request->avatar != '') {
                if ($user->avatar != 'images/avatar.png') {
                    if (File::exists('storage/' . $user->avatar))
                        unlink('storage/' . $user->avatar);
                }
            }

            $user->avatar = null;
            $user->save();

            return 'true';
        }
        return 'false';
    }

    public function removeProductImage($request)
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
