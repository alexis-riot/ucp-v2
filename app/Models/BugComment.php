<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BugComment extends Model
{
    protected $table = "cp_bugs_comments";
    protected $fillable = [
        'bug_id', 'account_id', 'comment',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'account_id');
    }
}
