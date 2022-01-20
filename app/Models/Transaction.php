<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'sales_id',
        'payment_method_id',
        'transaction_date',
    ];

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
