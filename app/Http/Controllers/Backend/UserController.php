<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Traits\ImageUploadTrait;

class UserController extends Controller
{
    use ImageUploadTrait;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $users = $this->user::Paginate(5);
        return view('backend.users.index', compact(  'users'));
    }

    public function create()
    {
        return view('backend.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $data = $this->createNewData($request);
        $data['email_verified_at'] = Carbon::now();
        $data['password'] = bcrypt($request->password);
        $this->user::create($data);
        return redirect()->route('admin.users.index')->with(['message' => 'User create successfully', 'alert-type' => 'success']);
    }

    public function show(User $user)
    {
        $user = $user->withCount('orders')->first();
        if ($user) {
            return view('backend.users.show', compact('user'));
        }

        return redirect()->route('admin.users.index')->with(['message' => 'Something was wrong', 'alert-type' => 'danger']);
    }

    public function edit(User $user)
    {
        if ($user) {
            return view('backend.users.edit', compact('user'));
        }
        return redirect()->route('admin.users.index')->with(['message' => 'Something was wrong', 'alert-type' => 'danger']);
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'username'      => 'required|max:20|unique:users,username,'.$user->id,
            'email'         => 'required|email|unique:users,email,'.$user->id,
            'mobile'        => 'nullable|numeric|unique:users,mobile,'.$user->id,
            'status'        => 'required',
            'password'      => 'nullable|min:8',
        ]);
        if ($validator->fails()) { return redirect()->back()->withErrors($validator)->withInput(); }

        if($user) {
            $data = $this->createNewData($request);

            if (trim($request->password) != '')
                $data['password']  = bcrypt($request->password);

            if ($request->has('avatar')) {
                if (File::exists('storage/' . $user->avatar)) {
                    unlink('storage/' . $user->avatar);
                }
                $data['avatar'] = $this->uploadAvatar($request->avatar);
            }

            $user->update($data);
            return redirect()->route('admin.users.index')->with(['message' => 'User updated successfully', 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => 'Something was wrong', 'alert-type' => 'danger']);
    }

    public function destroy($id)
    {

        $user = User::whereId($id)->first();
        if($user) {
            if ($user->user_image != '') {
                if (File::exists('uploads/users/' . $user->user_image)) {
                    unlink('uploads/users/' . $user->user_image);
                }
            }

            $user->delete();

            return redirect()->route('admin.users.index')->with([
                'message' => 'User deleted successfully',
                'alert-type' => 'success',
            ]);
        }

        return redirect()->route('admin.users.index')->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);
    }

    public function removeImage(Request $request, User $user)
    {
        if ($user) {
            if ($user->avatar != '') {
                if (File::exists('storage/' . $user->avatar)) {
                    unlink('storage/' . $user->avatar);
                }
            }
            $user->avatar = null;
            $user->save();
            return 'true';
        }

        return 'false';
    }

    protected function createNewData($request)
    {
        $data['name']                   = $request->name;
        $data['username']               = $request->username;
        $data['email']                  = $request->email;
        $data['mobile']                 = $request->mobile;
        $data['role_id']                = $request->role_id;
        $data['status']                 = $request->status;
        $data['bio']                    = $request->bio;
        $data['receive_email']          = $request->receive_email;

        return $data;
    }
}
