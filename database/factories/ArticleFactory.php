<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Sight;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $articleables = [City::class, Sight::class];
        $articleable_type = $articleables[array_rand($articleables)];

        return [
            'user_id' => rand(1, 10),
            'title' => $this->faker->sentence(9),
            'description' => $this->faker->text(50),
            'article_body' => $this->faker->text(100),
            'articleable_id' => $articleable_type == City::class ? rand(1, 20) : rand(1, 220),
            'articleable_type' => $articleable_type,
        ];
    }
}
