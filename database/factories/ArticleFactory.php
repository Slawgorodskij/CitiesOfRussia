<?php

namespace Database\Factories;

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
        return [
            'image_id' =>rand(1,400),
            'user_id'=>rand(1,10),
            'title' => $this->faker->sentence(9),
            'description'=>$this->faker->text(50),
            'article_body'=>$this->faker->word(),
        ];
    }
}
