<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Transportation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'type',
        'release_year',
        'price',
        'stock',
        'producer',
    ];

    public function car()
    {
        return $this->type == 'CAR' ? $this->hasOne(Car::class) : null;
    }

    public function motorcycle()
    {
        return $this->type == 'MOTORCYCLE'? $this->hasOne(Motorcycle::class) : null;
    }

    protected $appends = ['already_sold'];

    public function getAlreadySoldAttribute()
    {
        $return = $this->hasMany(Sales::class)->where(['transportation_id' => $this->id,'sales.status' => "PAID"])->sum('quantity');

        return $return > 0 ? $return : 0;
    }
}
