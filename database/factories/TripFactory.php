<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'driver' => rand(1, 20),
            'passenger_first' => rand(1, 20),
            'passenger_two' => rand(1, 20),
            'passenger_three' => rand(1, 20),
            'departure_city' => rand(1, 20),
            'city_of_arrival' => rand(1, 20),
            'start' => date('Y-m-d'),
            'finish' => date('Y-m-d'),
        ];
    }
}
