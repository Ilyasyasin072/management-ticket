<?php

namespace Database\Factories;

use App\Models\Orders;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrdersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Orders::class;

    public function definition()
    {
        return [
            'user_id' => 1,
            'ticket_id' => 1,
            'ticket_count' => $this->faker->numerify,
            'price' => $this->faker->numerify,
            'status' => $this->faker->boolean,
        ];
    }

}
