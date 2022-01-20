<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PaymenExpiredSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\PaymentExpired::updateOrCreate([
            'hours' => 12
        ],['hours' => 12]);
    }
}
