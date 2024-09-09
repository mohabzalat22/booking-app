<?php

namespace Database\Factories;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Price>
 */
class PriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type_id' => Type::factory(),
            'price' => fake()->randomDigit(0 , 1000),
            'discount' => fake()->randomDigit()/10,
            'tax' => fake()->numberBetween(0,100),
        ];
    }
}
