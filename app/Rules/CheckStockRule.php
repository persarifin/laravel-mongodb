<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckStockRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $id;
    protected $message;

    public function __construct($id)
    {
        $this->id = $id;
        $this->message = '';
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $data  = \DB::table('transportations')->where(['id' => $this->id])->first();

        if (!$data) {
            return true;
        }

        return $value <= (int)$data->stock;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'quantity exceed available stock.';
    }
}
