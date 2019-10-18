<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warn extends Model
{
    protected $table = "warns";

    public function author()
    {
        return $this->hasOne('App\User', 'id', 'punisher');
    }

    public function is_expired()
    {
        $expired = false;
        if (strtotime($this->expiration) < time())
            $expired = true;
        return ($expired);
    }
}
