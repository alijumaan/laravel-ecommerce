<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Repositories\Backend\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $users = $this->user->index();

        return view('backend.users.index', compact('users'));
    }

    public function create()
    {
        abort_if(!auth()->user()->can('add-user'), 403, 'You did not have permission to access this page!');

        return view('backend.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $this->user->store($request);

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
        $this->user->update($request, $user);

        return redirect()->route('admin.users.index')->with(['message' => 'User updated successfully', 'alert-type' => 'success']);
    }

    public function destroy(User $user)
    {
        $this->user->delete($user);

        return redirect()->route('admin.users.index')->with(['message' => 'User deleted successfully', 'alert-type' => 'success',]);
    }

    public function removeImage(Request $request, User $user)
    {
        $this->user->removeImage($request, $user);
    }
}
