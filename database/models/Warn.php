<?php

namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Warn extends Model
{
    protected $connection = "db_server";
    protected $table = "warns";

    public function author()
    {
        return $this->hasOne('App\Database\Models\User', 'id', 'punisher');
    }

    public function isExpired()
    {
        $expired = false;
        if (strtotime($this->expiration) < time())
            $expired = true;
        return ($expired);
    }
}
