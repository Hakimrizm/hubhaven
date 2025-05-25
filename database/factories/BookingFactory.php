<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::where('role', 'user')->inRandomOrder()->first()->id,
            'place_id' => fake()->numberBetween(1, 5),
            'booking_start_time' => fake()->dateTime(),
            'booking_end_time' => fake()->dateTime(),
            'status' => fake()->randomElement(['pending', 'canceled', 'confirmed', 'complete'])
        ];
    }
}
