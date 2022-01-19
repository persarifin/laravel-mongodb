<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class PaymentExpired extends Model
{
    use HasFactory;

    protected $fillabel = [
        'hours'
    ];
}
