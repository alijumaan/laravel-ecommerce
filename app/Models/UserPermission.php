<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    protected $guarded = [];

    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'id', 'permission_id');
    }

    public function user()
    {
        return $this->belongsToMany(Permission::class, 'id', 'user_id');
    }
}
