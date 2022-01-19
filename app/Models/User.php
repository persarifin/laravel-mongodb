<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class User extends Model
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

