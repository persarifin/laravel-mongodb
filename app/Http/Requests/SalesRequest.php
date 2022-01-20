<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckStockRule;

class SalesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tax' => 'numeric',
            'customer_name'  => 'required|string',
            'transportation_id' => ['required', 'gt:0', 'integer', new \App\Rules\FindDataRule('transportations')],
            'quantity' => ['required','numeric','gt:0', new CheckStockRule($this->input('transportation_id'))],
            'payment_expired_id' => ['required','gt:0','integer', new \App\Rules\FindDataRule('payment_expireds')],
        ];
    }
}
