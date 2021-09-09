<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\UserImageService;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    use ImageUploadTrait;

    public function login()
    {
        return view('backend.login');
    }

    public function forgotPassword()
    {
        return view('backend.forgot-password');
    }

    public function accountSetting()
    {
        return view('backend.account_setting');
    }

    public function updateAccount(Request $request)
    {
        if ($request->hasFile('user_image')) {
            if (auth()->user()->user_image) {
                (new UserImageService)->unlinkFile(auth()->user()->user_image);
            }
            $adminImage = (new UserImageService)->storeImages($request);
        }

        if ($request->password){
            $password = bcrypt($request->password);
        }

        auth()->user()->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
            'user_image' => $adminImage ?? auth()->user()->user_image,
            'password' => $password ?? auth()->user()->password
        ]);

        return redirect()->route('admin.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }
}
