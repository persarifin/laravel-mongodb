<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TransactionCollection extends ResourceCollection
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
                return [
                    'id' => $page->id,
                    'amount' => $page->amount,
                    'sales_id' => $page->sales_id,
                    'payment_method_name' => $page->payment_method? $page->payment_method->method_name : null,
                    'transaction_date' => $page->transaction_date
                ];
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