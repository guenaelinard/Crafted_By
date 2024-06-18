<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderProduct>
 */
class OrderProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => function () {
                return Product::factory()->create()->id;
            },
            'order_id' => function () {
                return Order::factory()->create()->id;
            }
        ];
    }
}
