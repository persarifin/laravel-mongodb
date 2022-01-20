<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransportationResource extends BaseResource
{
    protected $availableRelations = ['car','sales_report','motorcycle'];
    protected $resourceType = 'transportation';

    public function toArray($request)
    {
        return $this->transformResponse([
            'id' => $this->getIdentifier(),
            'release_year' => $this->release_year,
            'price' => $this->price,
            'stock' => $this->stock,
            'producer' => $this->producer,
            'motorcycle' => $this->motorcycle ? $this->motorcycle : null,
            'car' => $this->car ? $this->car : null,
        ]);

    }  
    public function getCarRelation()
    {
      return new CarResource($this->car);
    }
     
    public function getMotorcycleRelation()
    {
      return new MotorcycleResource($this->motorcycle);
    }

    public function getSalesReportRelation()
    {
      return new SalesResource($this->sales_report);
    }
}
