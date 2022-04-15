<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ImageSight>
 */
class ImageSightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sight_id' => rand(1, 200),
            'image_id' => rand(1, 400),
            'description' => $this->faker->text(150),
        ];
    }
}
