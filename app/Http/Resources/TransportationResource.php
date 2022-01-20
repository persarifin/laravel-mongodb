<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransportationResource extends BaseResource
{
    protected $availableRelations = [];
    protected $resourceType = 'transportation';

    public function toArray($request)
    {
        return $this->transformResponse([
            'id' => $this->getIdentifier(),
            'release_year' => $this->release_year,
            'price' => $this->price,
            'stock' => $this->stock,
            'producer' => $this->producer,
            // 'motorcycle' => $this->motorcycle ? $this->motorcycle : null,
            // 'car' => $this->car ? $this->car : null,
        ]);

    }

  

}
