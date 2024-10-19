<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'firstName' => fake()->firstName(),
            'lastName'  => fake()->lastName(),
            'email'     => fake()->safeEmail,
            'phone'     => fake()->phoneNumber,
            'password'  => bcrypt(111111),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure():static
    {
        return $this->afterMaking(function (Customer $customer) {
            //
        })->afterCreating(function (Customer $customer) {
            $customer->addMediaFromUrl(asset('images/avatars/' . $this->faker->numberBetween(1, 10) . '.png'))->toMediaCollection('profile-photo');
        });
    }
}