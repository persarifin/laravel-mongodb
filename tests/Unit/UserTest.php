<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
 
    public function test_register()
    {
        $data = new \Database\Factories\UserFactory;
        $data = $data->definition();

        $data['password_confirmation'] = $data['password'];

        $this->runPost([
            'data' => $data, 
            'route'=> 'register', 
            'status' => 201,
            'authorize' => false
        ]);
    }
    
}
