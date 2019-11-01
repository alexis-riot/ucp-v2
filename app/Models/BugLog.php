<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BugLog extends Model
{
    protected $table = "cp_bugs_logs";
    protected $fillable = [
        'bug_id', 'account_id', 'logs',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'account_id');
    }
}
