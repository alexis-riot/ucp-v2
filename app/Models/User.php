<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = "accounts";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'authip',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function characters()
    {
        return $this->hasMany('App\Models\Character', 'accountID', 'id');
    }

    public function staff_level()
    {
        return $this->hasOne('App\Models\StaffLevel', 'levelID', 'admin');
    }

    public function warns()
    {
        return $this->hasMany('App\Models\Warn', 'account', 'id');
    }

    public function hasPermission($permissionSlug)
    {
        $result = Permission::where('slug', $permissionSlug)
            ->first();

        if ($result != null)
            return $result->userHasPermission($this);

        return false;
    }

    public function getRank()
    {
        $rankName = "Player";
        if ($this->donator > 0)
            $rankName = "Donator";
        if ($this->developer > 0)
            $rankName = "Developer";
        if ($this->admin > 0) {
            $rankName = DB::table('staff_levels')->where('levelID', $this->admin)->value('levelName');
        }
        return $rankName;
    }
}
