<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(2, true),
            'description' => fake()->paragraph(),
            'category' => fake()->word(),
            'date_time' => fake()->date(),
            'country' => fake()->state(),
            'city' => fake()->city(),
            'place' => fake()->word(),
            'location' => fake()->address(),
            'price' => fake()->randomDigit(0 , 1000),
            'image' => fake()->randomElement(['http://127.0.0.1:8000/images/1.jpg', 'http://127.0.0.1:8000/images/2.png']),
            'discount' => fake()->randomDigit()/10,
            'tax' => fake()->numberBetween(0,100),
            'reserved_bool' => fake()->boolean(),
        ];
    }
}
