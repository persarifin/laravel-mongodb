<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Transportation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'release_year',
        'price',
        'stock',
        'producer',
        'car_id',
        'motorcycle_id'
    ];

    public function car()
    {
        return $this->hasOne(Car::class);
    }

    public function motorcycle()
    {
        return $this->hasOne(Motorcycle::class)->where();
    }
}
