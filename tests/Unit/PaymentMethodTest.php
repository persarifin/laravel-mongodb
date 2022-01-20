<?php

namespace Tests\Unit;

use Tests\TestCase;

class PaymentMethodTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get()
    {
        $this->runGet([
            'route'=> 'payment-methods.index', 
            'status' => 200,
            'authorize' => true
        ]);
    }

    public function test_store()
    {
        $data = new \Database\Factories\PaymentMethodFactory;
        $data = $data->definition();

        $this->runPost([
            'data' => $data, 
            'route'=> 'payment-methods.store', 
            'status' => 200,
            'authorize' => true
        ]);
    }

    public function test_update()
    {
        $old = \App\Models\PaymentMethod::factory()->create();
        $data = new \Database\Factories\PaymentMethodFactory;
        $data = $data->definition();

        $this->runUpdate([
            'id' => $old->_id,
            'data' => $data, 
            'route'=> 'payment-methods.update', 
            'status' => 200,
            'authorize' => true
        ]);
    }

    public function test_destroy()
    {
        $old = \App\Models\PaymentMethod::factory()->create();
        $this->runDestroy([
            'id' => $old->_id,
            'route'=> 'payment-methods.destroy', 
            'status' => 200,
            'authorize' => true
        ]);
    }

}
