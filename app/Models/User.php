<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
// use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
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

