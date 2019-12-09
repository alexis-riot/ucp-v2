<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestLeave extends Model
{
    protected $table = "cp_request_leaves";

    protected $fillable = [
        'account_id', 'status', 'approved_by',
        'interim_head', 'type', 'reason',
        'date_start', 'date_end',
    ];

    public static $statusString = [
        '<span class="kt-badge kt-badge--info kt-badge--inline kt-badge--pill kt-badge--rounded">Waiting Approval</span>', // 0
        '<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill kt-badge--rounded">Approved</span>', // 1
        '<span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">Declined</span>', // 2
    ];
    public static $typeString = [
        'Absent', // 0
        'Reduced Activity', // 1
        'Extreme Reduced Activity', // 2
    ];

    public function getStatus()
    {
        return (self::$statusString[$this->status]);
    }

    public function getType()
    {
        return (self::$typeString[$this->type]);
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'account_id');
    }
}
