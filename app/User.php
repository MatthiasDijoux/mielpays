<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

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

    function role()
    {
        return $this->belongsTo(RolesModel::class, 'id_role');
    }
    function roles()
    {
        return $this->belongsTo(RolesModel::class, 'id_role');
    }
    function orders()
    {
        return $this->hasMany(OrderModel::class, 'id_user');
    }
    function producer()
    {
        return $this->hasMany(ProducerModel::class, 'id_user');
    }
    function adresses()
    {
        return $this->hasMany(AdresseModel::class, 'id_adresse');
    }
}
