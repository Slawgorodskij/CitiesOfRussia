<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Sight;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $commentable = [City::class, Sight::class, User::class];
        $commentable_type = $commentable[array_rand($commentable)];

        return [
            'user_id' => rand(1, 20),
            'comment_body' => $this->faker->text(100),
            'commentable_id' => $commentable_type == Sight::class ? rand(1, 200) : rand(1, 20),
            'commentable_type' => $commentable_type,
        ];
    }
}
