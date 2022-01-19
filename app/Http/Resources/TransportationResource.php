<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransportationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'release_year' => $this->release_year,
            'price' => $this->price,
            'stock' => $this->stock,
            'producer' => $this->producer
        ];

        if ($this->motorcycle_id > 0){
            array_merge($data, ['motorcycle' => $this->motorcycle]);
        }
        elseif($this->car_id > 0){
            array_merge($data, ['car' => $this->car]);
        }

        return $data;
    }
    public function with($request)
    {
        return [
            'status'    => 200,
            'error'     => 0,
        ];
    }
}
