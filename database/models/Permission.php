<?php

namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function groupsList()
    {
        return $this->hasMany('App\Database\Models\PermissionGroupList');
    }

    public function userHasPermission(User $user)
    {
        foreach ($this->groupsList as $group) {
            $result = PermissionGroupUser::where('group_id', $group->group_id)
                ->count();

            if ($result > 0)
                return true;
        }
        return false;
    }
}
