<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = "cp_permissions";
    protected $fillable = ['permission', 'tag', 'description', 'slug'];
    public $timestamps = false;

    public function groupsList()
    {
        return $this->hasMany('App\Models\PermissionGroupList');
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
