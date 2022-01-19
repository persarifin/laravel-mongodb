<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Laravel\Passport\HasApiTokens;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Contracts\Auth\Authenticatable;

class User extends Eloquent implements Authenticatable
{   
    use AuthenticatableTrait, HasApiTokens, HasFactory, Notifiable;

    protected $guard_name = 'api';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'address'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
      'email_verified_at' => 'datetime',
  ];
}

