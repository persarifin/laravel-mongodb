<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentMethodRequest extends FormRequest
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
        if ($this->method() == "PUT" || $this->method() == "PATCH") {
            return [
                'method_name' => ['required','string', Rule::unique('payment_methods')->ignore($this->route('payment_method'))]
            ];
        }
        else{
            return [
                'method_name' => 'required|string|unique:payment_methods'
            ];
        }
    }
}
