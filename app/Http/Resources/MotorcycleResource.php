<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MotorcycleResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    protected $availableRelations = [];
    protected $resourceType = 'motorcycle';

    public function toArray($request)
    {
        return $this->transformResponse([
            'id' => $this->getIdentifier(),
            'machine' => $this->machine,
            'suspension_type' => $this->suspension_type,
            'transmission_type'=> $this->transmission_type
        ]);
    }
}
