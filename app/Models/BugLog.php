<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BugLog extends Model
{
    protected $table = "bugs_logs";

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'account_id');
    }
}
