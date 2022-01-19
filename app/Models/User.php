<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Laravel\Passport\HasApiTokens;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Eloquent
{   
    use HasApiTokens, HasFactory, Notifiable;

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

