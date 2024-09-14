<?php

namespace Database\Factories;
use App\Models\Vendor;

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
            'vendor_id' => Vendor::factory(),
            'title' => fake()->words(2, true),
            'description' => fake()->paragraph(),
            'category' => fake()->word(),
            'date_time' => fake()->date(),
            'image' => fake()->randomElement(['http://127.0.0.1:8000/images/1.jpg', 'http://127.0.0.1:8000/images/2.png']),
        ];
    }
}
