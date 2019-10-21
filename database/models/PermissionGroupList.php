<?php

namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionGroupList extends Model
{
    protected $table = "permissions_groups_lists";
    public function test()
    {
        return $this->hasMany('App\Database\Models\PermissionGroup');
    }
}
