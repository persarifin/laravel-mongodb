<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    protected $availableRelations = ['transaction','transportation'];
    protected $resourceType = 'sales';

    public function toArray($request)
    {
        return $this->transformResponse([
            'id' => $this->getIdentifier(),
            'invoice' => $this->invoice,
            'quantity' => $this->quantity,
            'customer_name' => $this->customer_name,
            'tax' => $this->tax == null? '0.00' : $this->tax ,
            'amount' => $this->amount,
            'status' => $this->status,
            'payment_expired_at' => $this->payment_expired_at,
            'customer_name' => $this->customer_name,
            'customer_name' => $this->customer_name,
            'selling_date' => $this->selling_date,
            'transportation' => $this->transportation ? $this->transportation : null,
            'user' => $this->user ? $this->user : null
        ]);
    }

    public function getTransactionRelation()
    {
      return new TransactionResource($this->transaction);
    }

    public function getTransportationRelation()
    {
      return new TransportationResource($this->transportation);
    }
}
