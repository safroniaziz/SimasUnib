<?php

namespace App\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;
    protected $guard = 'admin';
    protected $table = 'tb_admin';
    protected $fillable = [
        'nm_admin','username','email', 'password','foto',
    ];
}
