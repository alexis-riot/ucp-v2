<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warn extends Model
{
    protected $table = "warns";

    public function author()
    {
        return $this->hasOne('App\Models\User', 'id', 'punisher');
    }

    public function isExpired()
    {
        return (strtotime($this->expiration) < time());
    }
}
