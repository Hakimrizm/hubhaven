<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Partner>
 */
class PartnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $partnerName = fake()->company();

        return [
            'user_id' => User::factory()->state([
                'role' => 'partner',
            ]),
            'partner_address' => fake()->address(),
            'partner_bussiness_name' => $partnerName,
            'partner_phone' => fake()->phoneNumber(),
            'partner_description' => fake()->paragraph()
        ];
    }
}
