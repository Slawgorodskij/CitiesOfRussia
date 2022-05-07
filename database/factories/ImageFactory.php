<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Driver;
use App\Models\Sight;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $imageables = [City::class, Sight::class, User::class, Driver::class];
        $imageable_type = $imageables[array_rand($imageables)];

        return [
            'name' => $this->faker->imageUrl(800, 800),
            'description' => $this->faker->text(150),
            'imageable_id' => $imageable_type == Sight::class ? rand(1, 200) : rand(1, 20),
            'imageable_type' => $imageable_type,
        ];
    }
}
