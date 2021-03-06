<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
        'first_name', 'last_name','phone', 'email', 'password', 'api_token', 'activated'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function fullname()
    {
        return $this->first_name. " ".$this->last_name;
    }


    public function social()
    {
        return $this->hasMany(Social::class);
    }

    public function calls()
    {
        return $this->hasMany(Call::class);
    }

    public function sms()
    {
        return $this->hasMany(Sms::class);
    }

}
