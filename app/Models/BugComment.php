<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BugComment extends Model
{
    protected $table = "bugs_comments";

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'account_id');
    }
}
