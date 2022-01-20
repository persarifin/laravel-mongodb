<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentMethodResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    protected $availableRelations = [];
    protected $resourceType = 'payment_method';
    
    public function toArray($request)
    {
        return $this->transformResponse([
            'id'              => $this->getIdentifier(),
            'method_name'       => $this->method_name,
            'created_at'      => $this->created_at,
            'updated_at'      => $this->updated_at
        ]);
    }
}
