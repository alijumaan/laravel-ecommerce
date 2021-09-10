<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ProfileRequest;
use App\Services\ImageService;
use Illuminate\Support\Facades\Hash;
use App\Traits\ImageUploadTrait;

class UserController extends Controller
{
    use ImageUploadTrait;

    public function dashboard()
    {
        return view('frontend.user.dashboard');
    }

    public function profile()
    {
        return view('frontend.user.profile');
    }

    public function updateProfile(ProfileRequest $request)
    {
        $user = auth()->user();
        if (!empty($request->password) && !Hash::check($request->password, $user->password)) {
            $password = bcrypt($request->password);
        }

        if ($request->hasFile('user_image')) {
            if ($user->user_image) {
                (new ImageService())->unlinkImage($user->user_image, 'users');
            }
            $userImage = (new ImageService())->storeUserImages($user->username, $request->user_image);
        }

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'receive_email' => $request->receive_email,
            'user_image' => $userImage ?? $user->user_image,
            'password' => $password ?? $user->password
        ]);

        toast('Updated profile successfully', 'success');
        return redirect()->route('user.dashboard');
    }

    public function removeImage()
    {
        if (auth()->user()->user_image) {
            (new ImageService())->unlinkImage(auth()->user()->user_image, 'users');
            auth()->user()->update(['user_image' => NULL]);

            toast('Image removed successfully', 'success');
            return redirect()->back();
        }

        toast('please try again later', 'warning');
        return redirect()->back();
    }

    public function addresses()
    {
        return view('frontend.user.addresses');
    }

    public function orders()
    {
        return view('frontend.user.orders');
    }
}
