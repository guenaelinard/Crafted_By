<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Shop>
 */
class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'theme' => $this->faker->hexColor,
            'biography' => $this->faker->text(420),
        ];
    }
}
