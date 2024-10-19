<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */

class OrderItemFactory extends Factory
{
 

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $product = Product::inRandomOrder()->first();
        return [
            'product_id' => $product->id,
            'quantity'   => fake()->numberBetween(1, 5),
            'rate'       => $product->price,
            'unit_id'    => $product->unitId,
            'amount'     => function ($attributes) {
                return $attributes['quantity'] * $attributes['rate'];
            }
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure(): static
    {
        return $this->afterMaking(function (OrderItem $orderItem) {
            //
        })->afterCreating(function (OrderItem $orderItem) {
            // Update order totals
            $orderItem->order->updateTotals();
        });
    }
}