<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\FindDataRule;

class TransportationRequest extends FormRequest
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
            'release_year' => 'required|date',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'producer' => 'required|string',
            'cars' => [Rule::requiredIf($this->input('motorcycles') == null),'array'],
            'cars.machine' => [Rule::requiredIf($this->input('cars') != null),'string'],
            'cars.capacity' => [Rule::requiredIf($this->input('cars') != null),'numeric'],
            'cars.transmission_type' => [Rule::requiredIf($this->input('cars') != null),Rule::in(['Manual','Auto'])], 
            'motorcycles' => [Rule::requiredIf($this->input('cars') == null),'array'],
            'motorcycles.machine' => [Rule::requiredIf($this->input('motorcycles') != null),'string'],
            'motorcycles.suspension_type' => [Rule::requiredIf($this->input('motorcycles') != null),'string'],
            'motorcycles.transmission_type' => ['nullable',Rule::in(['Manual','Auto'])],     
        ];
    }
}
