<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public $permission;
    public $role;

    public function __construct(Permission $permission, Role $role)
    {
        $this->permission = $permission;
        $this->role = $role;
        $this->middleware('superAdmin');
    }

    public function index()
    {
        $permissions = $this->permission->all();
        $roles = $this->role->all();
        return view('backend.permissions.index', compact('permissions', 'roles'));
    }

    public function store(Request $request)
    {
        $this->role->find($request->role_id)->permissions()->sync($request->permission);
        return back();
    }

    public function getByRole(Request $data)
    {
        $permissions = $this->role->find($data->id)->permissions()->pluck('permission_id');
        return $permissions;
    }
}
