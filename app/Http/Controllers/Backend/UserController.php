<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::Paginate(5);

        return view('backend.users.index', compact('users'));
    }

    public function create()
    {
        abort_if(!auth()->user()->can('add-user'), 403, 'You did not have permission to access this page!');

        return view('backend.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $data = $this->createNewData($request);
        $data['email_verified_at'] = Carbon::now();
        $data['password'] = bcrypt($request->password);
        User::create($data);

        return redirect()->route('admin.users.index')->with(['message' => 'User create successfully', 'alert-type' => 'success']);
    }

    public function show(User $user)
    {
        return view('backend.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        abort_if(!auth()->user()->can('edit-user'), 403, 'You did not have permission to access this page!');

        return view('backend.users.edit', compact('user'));
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

        $data = $this->createNewData($request);

        if (trim($request->password) != '')
            $data['password']  = bcrypt($request->password);

        if ($request->has('avatar')) {
            if ($user->avatar != 'images/avatar.png') {
                if (File::exists('storage/' . $user->avatar))
                    unlink('storage/' . $user->avatar);
            }
            $data['avatar'] = $this->uploadAvatar($request->avatar);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with(['message' => 'User updated successfully', 'alert-type' => 'success']);
    }

    public function destroy(User $user)
    {
        abort_if(!auth()->user()->can('delete-user'), 403, 'You did not have permission to access this page!');

        if ($user->avatar != '') {
            if (File::exists('storage/' . $user->avatar)) {
                unlink('storage/' . $user->avatar);
            }
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with(['message' => 'User deleted successfully', 'alert-type' => 'success',]);
    }

    public function removeImage(Request $request, User $user)
    {
        abort_if(!auth()->user()->can('delete-user'), 403, 'You did not have permission to access this page!');
//        $this->removeAvatar($request, $user);

        $user->removeImage($request, $user);
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
