<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class HourlyWeatherInformationByCityFactory extends Factory
{
    public function definition(): array
    {
        return [
            'temp_c' => $this->faker->randomFloat(2, 2, 2),
            'temp_f' => $this->faker->randomFloat(2, 2, 2),
            'condition' => json_encode([
                'text' => 'Patchy rain nearby',
                'icon' => 'cdn.weatherapi.com/weather/64x64/day/176.png',
                'code' => 1063
            ]),
            'wind_mph' => $this->faker->randomFloat(2, 2, 2),
            'wind_kph' => $this->faker->randomFloat(2, 2, 2),
            'wind_degree' => $this->faker->randomFloat(2, 2, 2),
            'wind_dir' => $this->faker->randomElement(['ESE', 'SE']),
            'pressure_mb' => 1024,
            'pressure_in' => $this->faker->randomFloat(2, 2, 2),
            'cloud' => $this->faker->randomFloat(2, 2, 2),
            'city_id' => self::factoryForModel(City::class)->create()->id,
            'localtime' => $this->faker,
        ];
    }
}
