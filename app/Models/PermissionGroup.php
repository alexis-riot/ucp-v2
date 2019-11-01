<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{
    protected $table = "cp_permissions_groups";
    protected $fillable = [
        'name',
    ];
    public $timestamps = false;

    public function group_user()
    {
        return $this->hasMany('App\Models\PermissionGroupUser', 'group_id', 'id');
    }

    public function group_list()
    {
        return $this->hasMany('App\Models\PermissionGroupList', 'group_id', 'id');
    }
}
