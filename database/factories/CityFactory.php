<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\City>
 */
class CityFactory extends Factory
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
            'name' => $this->faker->city(),
            'description' => $this->faker->text(150),
            'slug' => $this->faker->word(),
        ];
    }
}
