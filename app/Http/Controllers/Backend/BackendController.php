<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\UserImageService;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        return view('backend.index');
    }

    public function login()
    {
        return view('backend.login');
    }

    public function forgot_password()
    {
        return view('backend.forgot-password');
    }

    public function account_setting()
    {
        return view('backend.account_setting');
    }

    public function update_account_setting(Request $request)
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
