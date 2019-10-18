<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $table = "characters";

    public function slug(): string
    {
        return str_slug($this->name);
    }

    public function getAbsoluteUrl(): string
    {
        return route('character', [
            'id' => $this->id,
            'slug' => $this->slug()
        ]);
    }
}
