<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionGroupList extends Model
{
    protected $table = "cp_permissions_groups_lists";
    protected $fillable = [
        'group_id', 'permission_id',
    ];
    public $timestamps = false;

}
