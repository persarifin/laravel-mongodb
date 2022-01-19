<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TransportationCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function ($page) {
                $data = [
                    'id'    =>  $page->id,
                    'release_year' => $this->release_year,
                    'price' => $this->price,
                    'stock' => $this->stock,
                    'producer' => $this->producer
                ];
                if ($page->motorcycle_id > 0 && $page->motorcycle){
                    array_merge($data, ['motorcycle' => $page->motorcycle]);
                }
                elseif($page->car_id > 0 && $page->car){
                    array_merge($data, ['car' => $page->car]);
                }
                return $data;
            }),
        ];
    }
    public function with($request)
    {
        if(!empty($this->links())){
            return [
                'meta' => [
                    'ffrom'      => number_format($this->firstItem()),
                    'flast_page' => number_format($this->lastPage()),
                    'fper_page'  => number_format($this->perPage()),
                    'fto'        => number_format($this->lastItem()),
                    'ftotal'     => number_format($this->total()),
                ],
                'status'    => 200,
                'error'     => 0,
            ];
        }else{
            return [
                'status'    => 200,
                'error'     => 0,
            ];
        }
    }
}