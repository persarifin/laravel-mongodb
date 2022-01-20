<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    protected $availableRelations = ['payment_method','sales'];
    protected $resourceType = 'transaction';

    public function toArray($request)
    {
        return $this->transformResponse([
            'id' => $this->getIdentifier(),
            'amount' => $this->amount,
            'payment_method_name' => $this->payment_method ? $this->payment_method->method_name : null,
            'transaction_date' => $this->transaction_date
        ]);
    }

    public function getSalesRelation()
    {
      return new CompanyResource($this->sales);
    }

    public function getPaymentMethodRelation()
    {
      return new CompanyResource($this->payment_method);
    }
}
