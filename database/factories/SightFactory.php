<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sight>
 */
class SightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'image_id' => rand(1, 400),
            'city_id' => rand(1, 20),
            'name' => $this->faker->sentence(5),
            'description' => $this->faker->text(200),
        ];
    }
}
