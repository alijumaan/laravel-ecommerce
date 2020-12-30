<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\ImageUploadTrait;

class UserController extends Controller
{

    use ImageUploadTrait;

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $orders = auth()->user()->orders()->with(['items', 'user'])->orderBy('id', 'desc')->paginate(1);

        return view('frontend.users.index', compact('orders'));
    }

    public function show($id)
    {
//        $order = Order::find($id);
//        return view('frontend.users.details', compact('order'));
    }

    public function show_reviews()
    {
        $reviews = Review::with('user')
            ->whereUserId(auth()->user()->id)
            ->whereStatus(1)
            ->paginate(5);

        return view('frontend.users.reviews', compact('reviews'));
    }

    public function edit_info()
    {
        return view('frontend.users.edit');
    }

    public function update_info(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'nullable|numeric',
            'bio' => 'nullable',
            'receive_email' => 'required',
            'avatar' => 'nullable|image|max:20000|mimes:jpeg,jpg,png'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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
        }else {
            return redirect()->back()->with(['message' => 'Something was wrong', 'alert-type' => 'danger',]);
        }

    }

    public function update_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = auth()->user();
        if (Hash::check($request->current_password, $user->password)) {
            $update = $user->update([
                'password' => bcrypt($request->password),
            ]);

            if ($update) {
                auth()->logout();
                return redirect()->route('frontend.login.form')->with(['message' => 'Password updated successfully', 'alert-type' => 'success',]);
            }else {
                return redirect()->back()->with(['message' => 'Something was wrong', 'alert-type' => 'danger',]);
            }
        }else {
            return redirect()->back()->with(['message' => 'Something was wrong', 'alert-type' => 'danger',]);
        }


    }
}
