<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'sales_id' => $this->sales_id,
            'payment_method_name' => $this->payment_method ? $this->payment_method->method_name : null,
            'transaction_date' => $this->transaction_date
        ];
    }
    
    public function with($request)
    {
        return [
            'status'    => 200,
            'error'     => 0,
        ];
    }
}