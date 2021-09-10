<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\ImageService;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AdminAuthController extends Controller
{
    use ImageUploadTrait;

    public function login(): View
    {
        return view('backend.login');
    }

    public function forgotPassword(): View
    {
        return view('backend.forgot-password');
    }

    public function accountSetting(): View
    {
        return view('backend.account_setting');
    }

    public function updateAccount(Request $request): RedirectResponse
    {
        if ($request->hasFile('user_image')) {
            if (auth()->user()->user_image) {
                (new ImageService())->unlinkImage(auth()->user()->user_image, 'users');
            }
            $adminImage = (new ImageService())->storeUserImages(auth()->user()->username, $request->user_image);
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
