<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionGroupUser extends Model
{
    protected $table = "cp_permissions_groups_users";
    protected $fillable = [
        'account_id', 'group_id',
    ];
    public $timestamps = false;
}
