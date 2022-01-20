<?php

namespace Tests\Unit;

use Tests\TestCase;

class PaymentExpiredTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get()
    {
        $this->runGet([
            'route'=> 'payment-expireds.index', 
            'status' => 200,
            'authorize' => true
        ]);
    }

    public function test_store()
    {
        $data = new \Database\Factories\PaymentExpiredFactory;
        $data = $data->definition();

        $this->runPost([
            'data' => $data, 
            'route'=> 'payment-expireds.store', 
            'status' => 200,
            'authorize' => true
        ]);
    }

    public function test_update()
    {
        $old = \App\Models\PaymentExpired::factory()->create();
        $data = new \Database\Factories\PaymentExpiredFactory;
        $data = $data->definition();

        $this->runUpdate([
            'id' => $old->_id,
            'data' => $data, 
            'route'=> 'payment-expireds.update', 
            'status' => 200,
            'authorize' => true
        ]);
    }

    public function test_destroy()
    {
        $old = \App\Models\PaymentExpired::factory()->create();
        $this->runDestroy([
            'id' => $old->_id,
            'route'=> 'payment-expireds.destroy', 
            'status' => 200,
            'authorize' => true
        ]);
    }
}
