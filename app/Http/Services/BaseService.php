<?php

namespace App\Http\Services;

class BaseService 
{
    public function formatDate($date)
    {
        return date_format($date,"Y-m-d H:i:s");
    }
}
