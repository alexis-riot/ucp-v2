<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogPanel extends Model
{
    protected $table = "cp_logs";
    public $timestamps = false;

    public static function add(User $user, $type, $category, $message)
    {
        self::create([
            'account_id' => $user->id,
            'type' => $type,
            'category' => $category,
            'message' => $message,
        ]);
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'account_id');
    }
}
