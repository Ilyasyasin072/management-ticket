<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Ticket::class;

    public function definition()
    {
        return [
            'from' => $this->faker->dateTime,
            'to' => $this->faker->dateTimeAD,
            'time' => $this->faker->time,
            'ticket_stock' => $this->faker->numerify,
            'price' => $this->faker->randomNumber(),
        ];
    }
}
