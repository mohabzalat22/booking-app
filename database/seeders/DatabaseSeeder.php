<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Venue;
use App\Models\Type;
use App\Models\Quantity;
use App\Models\Price;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Ticket::factory(10)
        ->has(Venue::factory())
        ->has(
            Type::factory(2)
            ->has(Quantity::factory())
            ->has(Price::factory())
            )
        ->create();

    }
}
