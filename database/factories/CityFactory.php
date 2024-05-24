<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->city,
            'region' => 'some regions',
            'country' => $this->faker->country,
            'lat' => $this->faker->randomFloat(2, 2, 2),
            'lon' => $this->faker->randomFloat(2, 2, 2),
        ];
    }
}
