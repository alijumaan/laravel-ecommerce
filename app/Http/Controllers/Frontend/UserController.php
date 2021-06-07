<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateInfoRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\Review;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Traits\ImageUploadTrait;

class UserController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        $orders = auth()->user()->orders()->with(['items', 'user'])->orderBy('id', 'desc')->paginate(1);

        return view('frontend.users.index', compact('orders'));
    }

    public function show_reviews()
    {
        $reviews = Review::with('user')
            ->whereUserId(auth()->id())
            ->whereStatus(1)
            ->paginate(5);

        return view('frontend.users.reviews', compact('reviews'));
    }

    public function edit_info()
    {
        return view('frontend.users.edit');
    }

    public function update_info(UpdateInfoRequest $request)
    {
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['mobile'] = $request->mobile;
        $data['bio'] = $request->bio;
        $data['receive_email'] = $request->receive_email;

        if ($request->has('avatar')) {
            if (auth()->user()->avatar != 'images/avatar.png') {
                if (File::exists('storage/' . auth()->user()->avatar))
                    unlink('storage/' . auth()->user()->avatar);
            }
            $data['avatar'] = $this->uploadAvatar($request->avatar);
        }

        $update = auth()->user()->update($data);

        if ($update) {
            return redirect()->back()->with(['message' => 'Information updated successfully', 'alert-type' => 'success',]);
        } else {
            return redirect()->back()->with(['message' => 'Something was wrong', 'alert-type' => 'danger',]);
        }
    }

    public function update_password(UpdatePasswordRequest $request)
    {
        $user = auth()->user();
        if (Hash::check($request->current_password, $user->password)) {
            $update = $user->update([
                'password' => bcrypt($request->password),
            ]);

            if ($update) {
                auth()->logout();
                return redirect()->route('frontend.login.form')->with(['message' => 'Password updated successfully', 'alert-type' => 'success',]);
            } else {
                return redirect()->back()->with(['message' => 'Something was wrong', 'alert-type' => 'danger',]);
            }
        } else {
            return redirect()->back()->with(['message' => 'Something was wrong', 'alert-type' => 'danger',]);
        }
    }
}
