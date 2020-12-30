<?php
namespace App\Http\View\Composers;

use App\Models\Permission;
use Illuminate\View\View;

class PermissionComposer
{
    public $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function compose(View $view)
    {
        return $view->with('permissions', $this->permission->orderBy('name')->pluck('name', 'id'));
    }
}
