<?php

namespace App\Repositories\Backend;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Traits\ImageUploadTrait;
use App\Traits\RemoveImageTrait;

class UserRepository
{
    use ImageUploadTrait, RemoveImageTrait;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return $this->user::Paginate(5);
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

    public function store($request)
    {
        $data = $this->createNewData($request);
        $data['email_verified_at'] = Carbon::now();
        $data['password'] = bcrypt($request->password);
        $this->user::create($data);
    }

    public function update($request, $user)
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
    }

    public function delete($user)
    {
        abort_if(!auth()->user()->can('delete-user'), 403, 'You did not have permission to access this page!');

        if ($user->avatar != '') {
            if (File::exists('storage/' . $user->avatar)) {
                unlink('storage/' . $user->avatar);
            }
        }

        $user->delete();
    }

    public function removeImage($request, $user)
    {
        abort_if(!auth()->user()->can('delete-user'), 403, 'You did not have permission to access this page!');

//        $this->removeAvatar($request, $user);
    }

}
