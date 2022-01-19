<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesResource extends JsonResource
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
            'invoice' => $this->invoice,
            'quantity' => $this->quantity,
            'customer_name' => $this->customer_name,
            'selling_date' => $this->selling_date,
            'transportation' => $this->transportation ? $this->transportation : null,
            'user' => $this->user ? $this->user : null
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
