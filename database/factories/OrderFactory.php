<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'command_number' => $this->faker->unique()->randomNumber(5, true),
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'datetime' => $this->faker->date,
        ];
    }
}
