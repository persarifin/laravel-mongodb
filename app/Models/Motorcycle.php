<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Motorcycle extends Model
{
    use HasFactory;

    protected $fillable = [
        'machine',
        'suspension_id',
        'transmission_type'
    ];

    public function suspension()
    {
        return $this->belongsTo(Suspension::class);
    }
}
