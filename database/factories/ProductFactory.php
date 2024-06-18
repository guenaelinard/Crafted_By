<?php

namespace Database\Factories;

use App\Models\Shop;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'story' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'image' => $this->faker->imageUrl(),
            'color' => $this->faker->colorName,
            'size' => $this->faker->randomElement(['Smol', 'Medium', 'Large', 'Extra Large', 'Big Chonk']),
            'category' => $this->faker->numberBetween(1,5),
            'shop_id' => function () {
                return Shop::factory()->create()->id;
            },
        ];
    }
}
