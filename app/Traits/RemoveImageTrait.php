<?php

namespace App\Traits;

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
}
