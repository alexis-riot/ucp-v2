<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BugTicket extends Model
{
    protected $table = "cp_bugs_tickets";
    protected $fillable = [
        'type', 'account_id', 'subject', 'priority',
        'status', 'tester_assigned', 'developer_assigned',
    ];
    public $timestamps = true;

    public static $statusString = [
        '<span class="kt-badge kt-badge--info kt-badge--inline kt-badge--pill kt-badge--rounded">Pending Review</span>', // 0
        '<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill kt-badge--rounded">Pending Testing</span>', // 1
        '<span class="kt-badge kt-badge--primary kt-badge--inline kt-badge--pill kt-badge--rounded">Not a bug</span>', // 2
        '<span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill kt-badge--rounded">User Reply</span>', // 3
        '<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill kt-badge--rounded">Pending Developer</span>', // 4
        '<span class="kt-badge kt-badge--warning kt-badge--inline kt-badge--pill kt-badge--rounded">Processed</span>', // 5
        '<span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">Pending User Reply</span>', // 6
        '<span class="kt-badge kt-badge--dark kt-badge--inline kt-badge--pill kt-badge--rounded">Closed</span>', // 7
    ];
    public static $typeString = [
        'Game Server', // 0
        'Control Panel', // 1
    ];
    public static $priorityString = [
        '<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill kt-badge--rounded">Low</span>', // 0
        '<span class="kt-badge kt-badge--warning kt-badge--inline kt-badge--pill kt-badge--rounded">Medium</span>', // 1
        '<span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">High</span>', // 2
        '<span class="kt-badge kt-badge--dark kt-badge--inline kt-badge--pill kt-badge--rounded">Urgent</span>', // 3
    ];

    public function getStatus()
    {
        return (self::$statusString[$this->status]);
    }

    public function getType()
    {
        return (self::$typeString[$this->type]);
    }

    public function getPriority()
    {
        return (self::$priorityString[$this->priority]);
    }

    public function comments()
    {
        return $this->hasMany('App\Models\BugComment', 'bug_id', 'id');
    }

    public function logs()
    {
        return $this->hasMany('App\Models\BugLog', 'bug_id', 'id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\BugImage', 'bug_id', 'id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'account_id');
    }

    public function developer()
    {
        if ($this->developer_assigned == -1)
            return NULL;
        return $this->hasOne('App\Models\User', 'id', 'developer_assigned');
    }

    public function tester()
    {
        if ($this->tester_assigned == -1)
            return NULL;
        return $this->hasOne('App\Models\User', 'id', 'tester_assigned');
    }
}
