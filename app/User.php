<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(\App\Role::class);
    }

    /**
     * @param $roles
     * @return bool
     */
    public function hasAnyRoles($roles)
    {
        if ($this->roles()->whereIn('name', $roles)->first()) {
            return true;
        }

        return false;
    }

    /**
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }

        return false;
    }

    public function getRoleNamesAttribute()
    {
        return $this->roles()->pluck('name')
            ->map(function ($name) {
                return __('users.' . $name);
            })->sort()->implode(', ');
    }
}
