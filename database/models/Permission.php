<?php

namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function groups_list()
    {
        return $this->hasMany('App\Database\Models\PermissionGroupList');
    }

    public function user_has_permission(User $user)
    {
        foreach ($this->groups_list as $group) {
            $result = PermissionGroupUser::where('group_id', $group->group_id)
                ->count();

            if ($result > 0)
                return true;
        }
        return false;
    }
}
