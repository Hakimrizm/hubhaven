<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'partner_id' => fake()->numberBetween(1, 5),
            'place_name' => fake()->sentence(),
            'place_description' => fake()->paragraph(),
            'place_type' => fake()->randomElement(['studio', 'field', 'co_working', 'meeting_room']),
            'place_price_per_hour' => fake()->numberBetween(20000, 200000),
            'place_address' => fake()->address(),
            'place_open_time'=> fake()->time('H:i:s'),
            'place_close_time'=> fake()->time('H:i:s')
        ];
    }
}
