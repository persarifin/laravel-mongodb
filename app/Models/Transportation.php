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
        return $this->hasOne(Car::class);
    }

    public function motorcycle()
    {
        return $this->hasOne(Motorcycle::class);
    }

    // protected $appends = ['already_sold'];

    // public function getAlreadySoldAttribute()
    // {
    //     $return = $this->hasMany(Sales::class)->where(['transportation_id' => $this->id,'sales.status' => "PAID"])->sum('quantity');

    //     return !empty($return) && $return > 0 ? $return : 0;
    // }

    // public function salesReport()
    // {
    //     return $this->hasMany(Sales::class);
    // }
}
