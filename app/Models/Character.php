<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $table = "characters";

    public function slug(): string
    {
        return str_slug($this->name);
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'accountID');
    }
}
