<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'invoice',
        'quantity',
        'customer_name',
        'selling_date',
        'transportation_id',
        'user_id'
    ];

    public function transportation()
    {
        return $this->belongsTo(Transportation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
