<?php

namespace sisVentas;

use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use sisVentas\TipoUsuario;

class User extends Authenticatable
{
    protected $table='users';

    protected $primaryKey='id';
    
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'tipousuario',
        'idempleado',
        'estado'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
