<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $connection = "db_server";
    protected $table = "characters";

    public function slug(): string
    {
        return str_slug($this->name);
    }
}
