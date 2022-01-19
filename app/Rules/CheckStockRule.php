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

    public function __construct($id)
    {
        $this->id = $id;
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
        $data  = \DB::table('transportations')->where(['id' => $this->id])->where('stock', '>=',$value)->count();
        return $data == 1;
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
