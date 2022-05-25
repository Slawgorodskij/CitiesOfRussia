<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Driver>
 */
class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $verification = ['checked', 'unchecked'];
        return [
            'driving_license' => $this->faker->word(),
            'car' => $this->faker->word(),
            'registration_number' => $this->faker->word(),
            'vehicle_registration_certificate' => $this->faker->word(),
           'document_verification' => $verification[array_rand($verification)],
        ];
    }
}
