<?php

namespace Database\Factories;

use App\Models\Unit;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category_id'  => fake()->randomElement(Category::pluck('id')->toArray()),
            'name'         => Str::title(fake()->word()) . " " . Str::title(fake()->word()),
            'sku'          => "WP" . fake()->randomNumber(4),
            'price'        => fake()->numberBetween(1, 100) * 10,
            'quantity'     => fake()->numberBetween(1, 100) * 10,
            'description'  => fake()->paragraph,
            'unit_id'      => fake()->randomElement(Unit::pluck('id')->toArray()),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure(): static
    {
        return $this->afterMaking(function (Product $product) {
            //
        })->afterCreating(function (Product $product) {
            $product->addMediaFromUrl(asset('images/foods/' . fake()->numberBetween(1, 12) . '.png'))->toMediaCollection('product-photo');
        });
    }
}