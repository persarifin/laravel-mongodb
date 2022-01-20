<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    protected $availableRelations = [];
    protected $resourceType = 'car';
    
    public function toArray($request)
    {
        return $this->transformResponse([
            'id' => $this->getIdentifier(),
            'machine' => $this->machine,
            'capacity' => $this->capacity,
            'transmission_type'=> $this->transmission_type
        ]);
    }
}
