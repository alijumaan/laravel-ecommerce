<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Order;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $orders = auth()->user()->orders()->with(['OrderItems', 'items', 'user'])->orderBy('id', 'desc')->paginate(1);

        return view('front.users.index', compact('orders'));
    }

    public function show($id)
    {
//        $order = Order::find($id);
//        return view('front.users.details', compact('order'));
    }

    public function show_comments()
    {
        $comments = Comment::with('user')
            ->whereUserId(auth()->user()->id)
            ->whereStatus(1)
            ->paginate(5);

        return view('front.users.comments', compact('comments'));
    }

    public function edit_info()
    {
        return view('front.users.edit');
    }

    public function update_info(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'nullable|numeric',
            'bio' => 'nullable',
            'receive_email' => 'required',
            'user_image' => 'nullable|image|max:20000|mimes:jpeg,jpg,png'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['mobile'] = $request->mobile;
        $data['bio'] = $request->bio;
        $data['receive_email'] = $request->receive_email;

        if ($image = $request->file('user_image')) {
            if (auth()->user()->user_image != '') {
                if (File::exists('uploads/users/' . auth()->user()->user_image)) {
                    unlink('uploads/users/' . auth()->user()->user_image);
                }
            }

            $fileName = Str::slug(auth()->user()->username).'.'.$image->getClientOriginalExtension();
            $path = public_path('uploads/users/' . $fileName);
            Image::make($image->getRealPath())->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);

            $data['user_image'] = $fileName;
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
                return redirect()->route('front.login')->with(['message' => 'Password updated successfully', 'alert-type' => 'success',]);
            }else {
                return redirect()->back()->with(['message' => 'Something was wrong', 'alert-type' => 'danger',]);
            }
        }else {
            return redirect()->back()->with(['message' => 'Something was wrong', 'alert-type' => 'danger',]);
        }


    }
}
