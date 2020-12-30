<?php

namespace App\Repositories\Backend;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Traits\RemoveImageTrait;

class SupervisorRepository
{

    use RemoveImageTrait;

    public $supervisor;

    public function __construct(User $supervisor)
    {
        $this->supervisor = $supervisor;
    }
    public function index()
    {
        return $this->supervisor::whereHas('role', function ($query) {
            $query->where('id', 2);
        })->orderBy('name')->paginate(5);
    }

    public function store($request)
    {
        $data['name']                   = $request->name;
        $data['username']               = $request->username;
        $data['email']                  = $request->email;
        $data['email_verified_at']      = Carbon::now();
        $data['mobile']                 = $request->mobile;
        $data['password']               = bcrypt($request->password);
        $data['status']                 = $request->status;
        $data['bio']                    = $request->bio;
        $data['receive_email']          = $request->receive_email;
        $data['role_id']                = 2;
        $user = $this->supervisor::create($data);

        if (isset($request->permissions) && count($request->permissions) > 0) {
            $user->role->permissions()->sync($request->permissions);
        }
        return redirect()->route('admin.supervisors.index')->with(['message' => 'User create successfully', 'alert-type' => 'success']);
    }

    public function update($request, $supervisor)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'username'      => 'required|max:20|unique:users,username,'.$supervisor->id,
            'email'         => 'required|email|unique:users,email,'.$supervisor->id,
            'mobile'        => 'nullable|numeric|unique:users,mobile,'.$supervisor->id,
            'status'        => 'required',
            'password'      => 'nullable|min:8',
            'permission.*'  => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $data['name']                   = $request->name;
        $data['username']               = $request->username;
        $data['email']                  = $request->email;
        $data['mobile']                 = $request->mobile;
        if (trim($request->password) != '') {
            $data['password']  = bcrypt($request->password);
        }
        $data['status']                 = $request->status;
        $data['bio']                    = $request->bio;
        $data['receive_email']          = $request->receive_email;

        $supervisor->update($data);

        if (isset($request->permissions) && count($request->permissions) > 0) {
            $supervisor->role->permissions()->sync($request->permissions);
        }
    }

    public function delete($supervisor)
    {
        abort_if(!auth()->user()->can('delete-user'), 403, 'You did not have permission to access this page!');

        $supervisor->delete();
    }

    public function removeImage($request, $supervisor)
    {
        abort_if(!auth()->user()->can('delete-user'), 403, 'You did not have permission to access this page!');

        $this->removeAvatar($request, $supervisor);
    }

}
