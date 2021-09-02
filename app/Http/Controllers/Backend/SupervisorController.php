<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\SupervisorRequest;
use App\Models\User;
use App\Services\UserImageService;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Permission;

class SupervisorController extends Controller
{
    use ImageUploadTrait;

    protected $userImageService;

    public function __construct(UserImageService $userImageService)
    {
        $this->userImageService = $userImageService;
    }

    public function index()
    {
        $this->authorize('access_supervisor');

        $supervisors = User::role(['supervisor'])
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sortBy ?? 'id', \request()->orderBy ?? 'desc')
            ->paginate(\request()->limitBy ?? 10);

        return view('backend.supervisors.index', compact('supervisors'));
    }

    public function create()
    {
        $this->authorize('create_supervisor');

        $permissions = Permission::orderBy('created_at')->get(['id', 'name']);

        return view('backend.supervisors.create', compact('permissions'));
    }

    public function store(SupervisorRequest $request)
    {
        $this->authorize('create_supervisor');

        if ($request->hasFile('user_image')) {
            $supervisorImage = $this->userImageService->storeImages($request->username, $request->user_image);
        }

        $supervisor = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'status' => $request->status,
            'receive_email' => $request->receive_email,
            'email_verified_at' => now(),
            'user_image' => $supervisorImage ?? NULL
        ]);

        $supervisor->markEmailAsVerified();

        // Assigning Role supervisor to this user
        $supervisor->assignRole('supervisor');

        // Assigning Permissions to this supervisor
        if (isset($request->permissions)) {
            $supervisor->givePermissionTo($request->permissions);
        }

        return redirect()->route('admin.supervisors.index')->with([
            'message' => 'Created successfully',
            'alert-type' => 'success'
        ]);
    }

    public function show(User $supervisor)
    {
        $this->authorize('show_supervisor');

        return view('backend.supervisors.show', compact('supervisor'));
    }

    public function edit(User $supervisor)
    {
        $this->authorize('edit_supervisor');

        $permissions = Permission::orderBy('created_at')->get(['id', 'name']);
        $supervisorPermissions = $supervisor->getPermissionNames()->toArray();

        return view('backend.supervisors.edit', compact('supervisor', 'permissions', 'supervisorPermissions'));
    }

    public function update(SupervisorRequest $request, User $supervisor)
    {
        $this->authorize('edit_supervisor');

        if ($request->hasFile('user_image')) {
            if ($supervisor->user_image) {
                $this->userImageService->unlinkFile($supervisor->user_image);
            }
            $supervisorImage = $this->userImageService->storeImages($request->username, $request->user_image);
        }

        if ($request->password){
            $password = bcrypt($request->password);
        }

        $supervisor->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
            'receive_email' => $request->receive_email,
            'user_image' => $supervisorImage ?? $supervisor->user_image,
            'password' => $password ?? $supervisor->password
        ]);


        if ($request->has('permissions')) {
            foreach ($supervisor->getPermissionNames() as $permissionName) {
                $supervisor->revokePermissionTo($permissionName);
            }

            $supervisor->givePermissionTo($request->permissions);
        }

        return redirect()->route('admin.supervisors.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(User $supervisor)
    {
        $this->authorize('delete_supervisor');

        if ($supervisor->user_image) {
            $this->userImageService->unlinkFile($supervisor->user_image);
        }

        $supervisor->delete();

        return redirect()->route('admin.supervisors.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }

    public function removeImage(User $supervisor)
    {
        $this->authorize('delete_user');

        if (File::exists('storage/images/users/'. $supervisor->user_image)) {
            unlink('storage/images/users/'. $supervisor->user_image);
            $supervisor->user_image = null;
            $supervisor->save();
        }

        return back()->with([
            'message' => 'Image deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
