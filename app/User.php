<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password','company','title_id','first_name','last_name','address','city','state_id','country_id','postal_code','tel'
    ];

    protected $primaryKey='user_id';
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_user', 'user_id', 'role_id');
    }

    public function hasRole($role)
    {
        return null !== $this->roles()->where('role',$role)->first();

    }

    public function authorizeRole($role)
    {
        return $this->hasRole($role);
    }

    public function full_name()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function state()
    {
        return $this->hasOne(State::class, 'state_id','state_id');
    }

    public function country()
    {
        return $this->hasOne(Country::class,'country_id','country_id');
    }

    public function address_2()
    {
        return $this->city. ", " . $this->state->state . ", " . $this->country->country . ", " . $this->postal_code;
    }

}
