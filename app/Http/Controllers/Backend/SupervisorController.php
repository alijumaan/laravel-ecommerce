<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupervisorRequest;
use App\Models\User;
use App\Traits\RemoveImageTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupervisorController extends Controller
{
    use RemoveImageTrait;

    public $supervisor;

    public function __construct()
    {
        $this->middleware('superAdmin');
    }

    public function index()
    {
        $supervisors = User::whereHas('role', function ($query) {
            $query->where('id', 2);
        })->orderBy('name')->paginate(5);

        return view('backend.supervisors.index', compact('supervisors'));
    }

    public function create()
    {
        abort_if(!auth()->user()->can('add-user'), 403, 'You did not have permission to access this page!');

        return view('backend.supervisors.create');
    }

    public function store(StoreSupervisorRequest $request)
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
        $user = User::create($data);

        if (isset($request->permissions) && count($request->permissions) > 0) {
            $user->role->permissions()->sync($request->permissions);
        }
        return redirect()->route('admin.supervisors.index')->with(['message' => 'User create successfully', 'alert-type' => 'success']);
    }

    public function show(User $supervisor)
    {
        return view('backend.supervisors.show', compact('supervisor'));
    }

    public function edit(User $supervisor)
    {
        abort_if(!auth()->user()->can('edit-user'), 403, 'You did not have permission to access this page!');

        return view('backend.supervisors.edit', compact('supervisor'));
    }

    public function update(Request $request, User $supervisor)
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

        return redirect()->route('admin.supervisors.index')->with(['message' => 'Supervisor updated successfully', 'alert-type' => 'success']);
    }

    public function destroy(User $supervisor)
    {
        abort_if(!auth()->user()->can('delete-user'), 403, 'You did not have permission to access this page!');

        $supervisor->delete();

        return redirect()->route('admin.supervisors.index')->with(['message' => 'Supervisor deleted successfully', 'alert-type' => 'success']);
    }

    public function removeImage(Request $request, User $supervisor)
    {
        abort_if(!auth()->user()->can('delete-user'), 403, 'You did not have permission to access this page!');

        $this->removeAvatar($request, $supervisor);
    }
}
