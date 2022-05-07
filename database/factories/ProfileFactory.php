<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => rand(1, 20),
            'lastname' => $this->faker->lastName(),
            'firstname' => $this->faker->firstName(),
            'patronymic' => $this->faker->firstNameMale(),
            'date_of_birth' => date('Y-m-d'),
        ];
    }
}