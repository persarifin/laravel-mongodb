<?php

namespace App\Http\Services;

class BaseService 
{
    public function formatDate($date)
    {
        return date_format($date,"d-m-Y H:i:s");
    }
    
    public function formatCurrency(int $numeric)
    {
        if (str_contains($numeric, ',') || str_contains($numeric, '.'))
        return money_format('Rp'. $numeric);
    }
}
