<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Payment::class;

    public function definition()
    {
        return [
            'order_id' => 1,
            'sum_price' => 2000,
            'status' => 'pay'
        ];
    }
}
