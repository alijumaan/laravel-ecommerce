<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UpdatePasswordRequest;
use App\Http\Requests\Backend\UserRequest;
use App\Models\User;
use App\Services\UserImageService;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    use ImageUploadTrait;

    protected $userImageService;

    public function __construct(UserImageService $userImageService)
    {
        $this->userImageService = $userImageService;
    }

    public function index()
    {
        $this->authorize('access_user');

        $users = User::role(['user'])
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sortBy ?? 'id', \request()->orderBy ?? 'desc')
            ->paginate(\request()->limitBy ?? 10);

        return view('backend.users.index', compact('users'));
    }

    public function create()
    {
        $this->authorize('create_user');

        return view('backend.users.create');
    }

    public function store(UserRequest $request)
    {
        $this->authorize('create_user');

        if ($request->hasFile('user_image')) {
            $userImage = $this->userImageService->storeImages($request->username, $request->user_image);
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'email_verified_at' => now(),
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'status' => $request->status,
            'receive_email' => true,
           'user_image' => $userImage ?? NULL
        ]);

        $user->markEmailAsVerified();
        $user->assignRole('user');

        return redirect()->route('admin.users.index')->with([
            'message' => 'Created successfully',
            'alert-type' => 'success'
        ]);
    }

    public function show(User $user)
    {
        $this->authorize('user_show');

        return view('backend.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('edit_user');

        return view('backend.users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $this->authorize('edit_user');

        if ($request->hasFile('user_image')) {
            if ($user->user_image) {
                $this->userImageService->unlinkFile($user->user_image);
            }
            $userImage = $this->userImageService->storeImages($request->username,  $request->user_image);
        }

        if ($request->password){
            $password = bcrypt($request->password);
        }

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
            'receive_email' => $request->receive_email,
            'user_image' => $userImage ?? $user->user_image,
            'password' => $password ?? $user->password
        ]);

        return redirect()->route('admin.users.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(User $user)
    {
        $this->authorize('delete_user');

        if ($user->user_image) {
            $this->userImageService->unlinkFile($user->user_image);
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }

    public function get_users()
    {
        $users = User::role(['user'])
            ->when(\request()->input('query') != '', function ($query) {
                $query->search(\request()->input('query'));
            })
            ->get(['id', 'first_name', 'last_name', 'email'])->toArray();

        return response()->json($users);
    }
}
